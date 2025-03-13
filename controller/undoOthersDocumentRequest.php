<?php
// undoOthersDocumentRequest.php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $id = $_POST['id'];
    try {
        $query = 'UPDATE `document_requested_for_others` SET `status` = "Pending" WHERE `id` = :id';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        header('Location: ../views/AdminDocumentRequest.php?status=undone');
        exit();
    } catch (PDOException $e) {
        header('Location: ../views/AdminDocumentRequest.php?status=error');
        exit();
    }
}
?>