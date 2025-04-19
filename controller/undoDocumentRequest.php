<?php
// undoDocumentRequest.php
include "./getIpAddress.php";
include './performanceTrackerController.php';
$ip = get_client_ip();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $id = $_POST['id'];
    try {
        recordTechnicalPerformance('undo_document_request_start', 'undo_document_request');
        $query = 'UPDATE `document_requested` SET `status` = "Pending", `timestamp` = `timestamp` WHERE `id` = :id';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
         $getName = 'SELECT CONCAT(`first_name`, " ", `last_name`) AS `full_name` FROM `user_info` WHERE `creds_id` = (SELECT `user_id` FROM `document_requested` WHERE `ID` = :id)';
        $stmt = $conn->prepare($getName);
        $stmt->execute(['id' => $id]);
        $name = $stmt->fetch();
        $insert_into_audit = "INSERT INTO `audit_log`( `action`, `ip_address`, `time_Created`) VALUES ('Document reverted to Pending for $name[0]','$ip',NOW())";
        $stmt = $conn->prepare($insert_into_audit);
        $stmt->execute();
        recordTechnicalPerformance('undo_document_request_end', 'undo_document_request');
        header('Location: ../views/AdminDocumentRequest.php?status=undone');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>