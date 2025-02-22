<?php
function getAllDocumentRequest(){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $sql = "SELECT d.*,u.*, d.id as 'document_id' 
    FROM document_requested d
    JOIN user_info u
    ON d.user_id = u.creds_id
";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
function getOthersDocumentRequest(){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $sql = "SELECT d.*,u.*,d.id as 'document_id' 
    FROM document_requested_for_others d
    JOIN requested_for_others_info u
    ON d.requestor_id = u.id
";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
$others = getOthersDocumentRequest();
$documents = getAllDocumentRequest();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request</title>
</head>
<body>
    <table>
        <thead>
            <th>Fullname</th>
            <th>Document Requested</th>
            <th>Purpose</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach($documents as $document): ?>
                <tr>
                    <td><?php echo $document['Fullname']; ?></td>
                    <td><?php echo $document['documents_requested']; ?></td>
                    <td><?php echo $document['purpose']; ?></td>
                    <td><?php echo $document['status']; ?></td>
                    <td>
                        <form action="../controller/approveDocumentRequest.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $document['document_id']; ?>">
                            <button type="submit">Approve</button>
                        </form>
                    </td>
                    <td>
                        <form action="../controller/rejectDocumentRequest.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $document['document_id']; ?>">
                            <button type="submit">Reject</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
            <?php foreach($others as $other): ?>
                <tr>
                    <td><?php echo $other['Fullname']; ?></td>
                    <td><?php echo $other['documents_requested']; ?></td>
                    <td><?php echo $other['purpose']; ?></td>
                    <td><?php echo $other['status']; ?></td>
                    <td>
                        <form action="../controller/approveOthersDocumentRequest.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $other['document_id']; ?>">
                            <button type="submit">Approve</button>
                        </form>
                    </td>
                    <td>
                        <form action="../controller/rejectOthersDocumentRequest.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $other['document_id']; ?>">
                            <button type="submit">Reject</button>
                        </form>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>