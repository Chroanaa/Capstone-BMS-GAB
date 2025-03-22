<?php
    session_start();
    if(!isset($_SESSION['session'])){
        header('Location: Login.php');
    }
    $loginSession = $_SESSION['session'];
    //get all document requested by the user
 function getDocumentsRequested($id){
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM document_requested WHERE user_id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $documents = $stmt->fetchAll();
    return $documents;
 }
 function getOthersDocumentRequested($id){
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM document_requested_for_others WHERE user_requestor_id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $documents = $stmt->fetchAll();
    return $documents;
 }
 function getOthersInfo($id){
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    $sql = "SELECT * FROM requested_for_others_info WHERE requestor_id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $documents = $stmt->fetchAll();
    return $documents;
 }
 $others_info = getOthersInfo($loginSession);   
 $other_documents = getOthersDocumentRequested($loginSession);
 $documents = getDocumentsRequested($loginSession);

 function formatDocumentName($documentName) {
    return ucwords(str_replace('_', ' ', $documentName));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- Bootstrap Icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
</head>
<body>
    <div id="header"> </div> 
    <div class="guardianship-certificate-main-container">
        <div class="container guardianship-certificate-form rounded-3">
            <h2 class="text-center">Account Dashboard</h2>
            <h3 class="text-center">Your requested Documents</h3>
            <div class="table-responsive">
                <table id="requestedDocsTable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Document Requested</th>
                            <th>Document Requested Date</th>
                            <th>Purpose</th>
                            <th>Document Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($documents as $document){
                            echo "<tr>";
                            echo "<td>".$loginSession."</td>";
                            echo "<td>".formatDocumentName($document['documents_requested'])."</td>";
                            echo "<td>".date('Y-m-d', strtotime($document['timestamp']))."</td>";
                            echo "<td>".$document['purpose']."</td>";
                            echo "<td>".$document['status']."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Second table modification -->
        <div class="container mt-1 guardianship-certificate-form rounded-3">
            <h3 class="text-center">Your requested Documents for others</h3>
            <div class="table-responsive">
                <table id="requestedDocsOthersTable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Document Requested</th>
                            <th>Full name</th>
                            <th>Document Requested Date</th>
                            <th>Purpose</th>
                            <th>Document Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($other_documents as $document){
                            foreach($others_info as $info){
                                $fullname = $info['first_name'].' '.$info['middle_name'].' '.$info['last_name'];
                                if($info['requestor_id'] == $loginSession && $info['id'] == $document['requestor_id']){
                                    echo "<tr>";
                                    echo "<td>".$document['id']."</td>";
                                    echo "<td>".formatDocumentName($document['documents_requested'])."</td>";
                                    echo "<td>".$fullname."</td>";
                                    echo "<td>".date('Y-m-d', strtotime($document['time_Created']))."</td>";
                                    echo "<td>".$document['purpose']."</td>";
                                    echo "<td>".$document['status']."</td>";
                                    echo "</tr>";
                                    break;
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include 'modals/modalLogout.html'?>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#requestedDocsTable').DataTable({
                responsive: true,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                pageLength: 5
            });
            
            $('#requestedDocsOthersTable').DataTable({
                responsive: true,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                pageLength: 5
            });
        });
    </script>
    <script type="module">
        import {header} from './header.js';
        header(<?=$loginSession?>);
    </script>
</body>
</html>