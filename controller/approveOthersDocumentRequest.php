<?php
// approveOthersDocumentRequest.php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $id = $_POST['id'];
    try {
        // Update the status without changing the time_Created column
        $query = 'UPDATE `document_requested_for_others` SET `status` = "Approved", `time_Created` = `time_Created` WHERE `id` = :id';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        header('Location: ../views/AdminDocumentRequest.php?status=approved');
        exit();
    } catch (PDOException $e) {
        header('Location: ../views/AdminDocumentRequest.php?status=error');
        exit();
    }
}
?>