<?php
    session_start();
    if(!isset($_SESSION['session'])){
        header('Location: /login');
    }
    $loginSession = $_SESSION['session'];
    //get all document requested by the user
     function getAllDocumentRequested($requestor_id){
        include ('../databaseconn/connection.php');
        $conn = $GLOBALS['conn'];
        $sql = "SELECT * FROM document_requested WHERE user_id = '$requestor_id'";
        $result = $conn->prepare($sql);
        $result->execute();
        $document_requested = $result->fetchAll();
        $get_document_requested_for_others_qry = "SELECT * FROM  document_requested_for_others WHERE user_requestor_id = '$requestor_id'";
        $get_document_requested_for_others_result = $conn->prepare($get_document_requested_for_others_qry);
        $get_document_requested_for_others_result->execute();   
        $document_requested_for_others = $get_document_requested_for_others_result->fetchAll();
        $others_info_qry = "SELECT * FROM requested_for_others_info WHERE requestor_id = '$requestor_id'";
        $others_info_result = $conn->prepare($others_info_qry);
        $others_info_result->execute();
        $others_info = $others_info_result->fetchAll();
        return [
            'document_requested' => $document_requested,
            'document_requested_for_others' => $document_requested_for_others,
            'document_requested_for_others_id' => $document_requested_for_others,
            'others_info_fullname' => $others_info
        ];  
    }
    $document_requested = getAllDocumentRequested($loginSession);
    $documents = $document_requested['document_requested'];
    
    
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
</head>
<body>
    <div id="header">       
    </div>
     <div class="container mt-5 guardianship-certificate-form">
        <h2 class="text-center">Account Dashboard</h2>
            <table>
                <th>
                    <tr>
                        <td>Document Requested</td>
                        <td>Document Requested For</td>
                        <td>Document Requested Date</td>
                        <td>Document Status</td>
                    </tr>
                </th>
                <tbody>
                   
            </table>
        </div>
    <?php include 'modals/modalLogout.html'?>
    
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <script type="module">
      import {header} from './header.js';
      header(<?=$loginSession?>);
    </script>
</html>