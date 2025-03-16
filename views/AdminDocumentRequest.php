<?php
function getAllDocumentRequest(){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $sql = "SELECT d.*,u.*, d.id as 'document_id' 
    FROM document_requested d
    JOIN user_info u
    ON d.user_id = u.creds_id";
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
    ON d.requestor_id = u.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
$others = getOthersDocumentRequest();
$documents = getAllDocumentRequest();

function formatDocumentName($documentName) {
    return ucwords(str_replace('_', ' ', $documentName));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
  <div id="adminHeader"></div>
  <div class="residents-main-container">
    <h1 class="text-center h5 blue">Document Requests</h1>
    <table id="documentRequestTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>Document Requested</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($documents as $document): ?>
                <tr>
                    <td><?php echo $document['Fullname']; ?></td>
                    <td><?php echo formatDocumentName($document['documents_requested']); ?></td>
                    <td><?php echo $document['purpose']; ?></td>
                    <td><?php echo $document['status']; ?></td>
                    <td>
                        <?php if($document['status'] === 'Pending'): ?>
                            <form action="../controller/approveDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $document['document_id']; ?>">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="../controller/rejectDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $document['document_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        <?php else: ?>
                            <form action="../controller/undoDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $document['document_id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
                            </form>
                        <?php endif; ?>
</td>
                </tr>
            <?php endforeach; ?>
            <?php foreach($others as $other): ?>
                <tr>
                    <td><?php echo $other['Fullname']; ?></td>
                    <td><?php echo formatDocumentName($other['documents_requested']); ?></td>
                    <td><?php echo $other['purpose']; ?></td>
                    <td><?php echo $other['status']; ?></td>
                    <td>
                        <?php if($other['status'] === 'Pending'): ?>
                            <form action="../controller/approveOthersDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $other['document_id']; ?>">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="../controller/rejectOthersDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $other['document_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        <?php else: ?>
                            <form action="../controller/undoOthersDocumentRequest.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $other['document_id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Cancel</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="module">
        import { header } from './adminHeader.js';
        header(false); // Pass false since the user is not logged in
        const params = new URLSearchParams(window.location?.search);
        const error = params.get('error');
        if(error === 'wrongcreds'){
            document.querySelector('.card-error').innerHTML += `<div class="alert alert-danger mt-5" role="alert">
                <h4 class="text-center"> Wrong credentials </h4>
            </div>`;
            setTimeout(() => {
                document.querySelector('.card-error').innerHTML = "";
            }, 3000);
        }
        if(error === "notLoggedIn"){
            document.querySelector('.card-error').innerHTML += `<div class="alert alert-danger mt-5" role="alert">
                <h4 class="text-center"> Must be logged In</h4>
            </div>`;
            setTimeout(() => {
                document.querySelector('.card-error').innerHTML = "";
            }, 3000);
        }
    </script>
  <script>
  $(document).ready(function() {
    $('#documentRequestTable').DataTable({ /* ... existing datatable config ... */ });

    // SweetAlert for status messages
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    
    $(document).ready(function() {
    // ... existing datatable initialization ...

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    
    if (status === 'approved') {
        Swal.fire('Approved!', 'Document request has been approved.', 'success');
    } else if (status === 'rejected') {
        Swal.fire('Rejected!', 'Document request has been rejected.', 'error');
    } else if (status === 'undone') {
        Swal.fire('Cancelled!', 'Document Cancelled', 'info');
    } else if (status === 'error') {
        Swal.fire('Error!', 'An error occurred.', 'error');
    }
    
    // Clear URL parameters after showing alert
    history.replaceState({}, document.title, window.location.pathname);
  });
  $('.dataTables_filter input').attr('placeholder', 'Search by Name...');
    }
    
  );
</script>
</body>
</html>