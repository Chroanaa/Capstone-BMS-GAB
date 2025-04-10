<?php
include "./getIpAddress.php";
include './performanceTrackerController.php';
$ip = get_client_ip();
// rejectDocumentRequest.php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $id = $_POST['id'];
    try {
        $query = 'UPDATE `document_requested` SET `status` = "Rejected", `timestamp` = `timestamp` WHERE `id` = :id';

        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        $getName = 'SELECT CONCAT(`first_name`, " ", `last_name`) AS `full_name` FROM `user_info` WHERE `id` = (SELECT `user_id` FROM `document_requested` WHERE `id` = :id)';
        $stmt = $conn->prepare($getName);
        $stmt->execute(['id' => $id]);
         $getName = 'SELECT CONCAT(`first_name`, " ", `last_name`) AS `full_name` FROM `user_info` WHERE `creds_id` = (SELECT `user_id` FROM `document_requested` WHERE `ID` = :id)';
        $stmt = $conn->prepare($getName);
        $stmt->execute(['id' => $id]);
        $name = $stmt->fetch();
        recordDocumentProcessingTime($id, 'user', 'reject');
        $insert_into_audit = "INSERT INTO `audit_log`( `action`, `ip_address`, `time_Created`) VALUES ('Document Rejected for $name[0]','$ip',NOW())";
        $stmt = $conn->prepare($insert_into_audit);
        $stmt->execute();
        header('Location: ../views/AdminDocumentRequest.php?status=rejected');
        exit();
    } catch (PDOException $e) {
        header('Location: ../views/AdminDocumentRequest.php?status=error');
        exit();
    }
}
?>