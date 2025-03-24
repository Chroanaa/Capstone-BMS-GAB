<?php
// undoDocumentRequest.php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $id = $_POST['id'];
    try {
        $query = 'UPDATE `document_requested` SET `status` = "Pending", `timestamp` = `timestamp` WHERE `id` = :id';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        header('Location: ../views/AdminDocumentRequest.php?status=undone');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>