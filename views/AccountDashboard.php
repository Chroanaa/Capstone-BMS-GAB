<?php
    session_start();
    if(!isset($_SESSION['session'])){
        header('Location: /login');
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
    <div id="header"> </div> 
    </div>
     <div class="container mt-2 guardianship-certificate-form   rounded-3">
        <h2 class="text-center">Account Dashboard</h2>
        <h3 class="text-center">Your requested Documents</h3>
            <table>
                <th>
                    <tr>
                        <td> ID</td>
                        <td>Document Requested</td>
                        <td>Document Requested Date</td>
                        <td>purpose</td>
                        <td>Document Status</td>
                    </tr>
                </th>
                <tbody>
                   <?php
                foreach($documents as $document){
                    echo "<tr>";
                    echo "<td>".$loginSession."</td>";
                    echo "<td>".$document['documents_requested']."</td>";
                    echo "<td>".$document['timestamp']."</td>";
                    echo "<td>".$document['purpose']."</td>";
                    echo "<td>".$document['status']."</td>";
                    echo "</tr>";
                }
                
                   ?>
            </table>
             <h3 class="text-center">Your requested Documents for others</h3>
           
        </div>
             <div class="container mt-1 guardianship-certificate-form  rounded-3">
        <h3 class="text-center">Your requested Documents for others</h3>
         <table>
                <th>
                    <tr>
                        <td> ID</td>
                        <td>Document Requested</td>
                        <td>Full name</td>
                        <td>Document Requested Date</td>
                        <td>purpose</td>
                        <td>Document Status</td>
                    </tr>
                </th>
                <tbody>
              <?php
            foreach($other_documents as $document){
                foreach($others_info as $info){
                    if($info['requestor_id'] == $loginSession && $info['id'] == $document['requestor_id']){
                        echo "<tr>";
                        echo "<td>".$document['id']."</td>";
                        echo "<td>".$document['documents_requested']."</td>";
                        echo "<td>".$info['Fullname']."</td>";
                        echo "<td>".$document['time_Created']."</td>";
                        echo "<td>".$document['purpose']."</td>";
                        echo "<td>".$document['status']."</td>";
                        echo "</tr>";
                        break; // Exit the inner loop once a match is found
                    }
                }
            }
            ?>
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