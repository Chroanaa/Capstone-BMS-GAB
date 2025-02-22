<?php
session_start();
  include('../databaseconn/connection.php');
  $conn = $GLOBALS['conn'];
  $id = $_SESSION['session'];
  $purpose = $_POST['Purpose'];
  $documents = isset($_POST['documents']) ? $_POST['documents'] : [];

 if (!empty($documents)) {
    foreach ($documents as $document) {
      $doc_query = 'INSERT INTO `document_requested`(`user_id`, `documents_requested`,`purpose`, `status`) VALUES (:user_id, :documents_requested, :purpose, "Pending")';
      $doc_stmt = $conn->prepare($doc_query);
      $db_arr = [
        'user_id' => $id,
        'documents_requested' => $document,
        'purpose' => $purpose
      ];
      $doc_stmt->execute($db_arr);
      header('Location: ../views/AccountDashboard.php');
    }
  }

?>