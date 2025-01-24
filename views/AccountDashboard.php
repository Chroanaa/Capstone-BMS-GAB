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
        $qry = "SELECT d.*, dr.*, r.*
        FROM document_requested d
        LEFT JOIN document_requested_for_others dr ON d.id = dr.requestor_id
        LEFT JOIN requested_for_others_info r ON r.id = dr.requestor_id 
        WHERE d.user_id = :requestor_id";
        $result = $conn->prepare($qry);
        $result->bindParam(':requestor_id', $requestor_id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    $document_requested = getAllDocumentRequested($loginSession);
    // please ayaw ko na makakita ng table sa pag display for this be creative
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
        <!----------- display the fucking document requested sorted by name including yung requested for others reqd the db and you will understand what i mean ---------------->
            
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