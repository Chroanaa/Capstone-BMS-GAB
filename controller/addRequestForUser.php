<?php
session_start();
  include('../databaseconn/connection.php');
  $conn = $GLOBALS['conn'];
  $id = $_SESSION['session'];
  $documents = isset($_POST['documents']) ? $_POST['documents'] : [];
  $query = "SELECT *";

 if (!empty($documents)) {
    foreach ($documents as $document) {
      $doc_query = 'INSERT INTO `document_requested`(`user_id`, `documents_requested`) VALUES (:user_id, :documents_requested)';
      $doc_stmt = $conn->prepare($doc_query);
      $db_arr = [
        'user_id' => $user_id,
        'documents_requested' => $document,
      ];
      $doc_stmt->execute($db_arr);
    }
  }

?>