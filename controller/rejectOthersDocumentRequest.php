<?php
// rejectOthersDocumentRequest.php
include "./getIpAddress.php";
include './performanceTrackerController.php';
$ip = get_client_ip();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $id = $_POST['id'];
    try {
        recordTechnicalPerformance('reject_others_document_request_start', 'reject_others_document_request');
        $query = 'UPDATE `document_requested_for_others` SET `status` = "Rejected", `time_Created` = `time_Created` WHERE `id` = :id';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
         $getName = 'SELECT CONCAT(`first_name`, " ", `last_name`) AS `full_name` FROM `requested_for_others_info` WHERE `id` = (SELECT `requestor_id` FROM `document_requested_for_others` WHERE `id` = :id)';
        $stmt = $conn->prepare($getName);
        $stmt->execute(['id' => $id]);
        $name = $stmt->fetch();
        $insert_into_audit = "INSERT INTO `audit_log`( `action`, `ip_address`, `time_Created`) VALUES ('Document reverted to Rejected for $name[0]','$ip',NOW())";
        $stmt = $conn->prepare($insert_into_audit);
        $stmt->execute();
        recordTechnicalPerformance('reject_others_document_request_end', 'reject_others_document_request');
        header('Location: ../views/AdminDocumentRequest.php?status=rejected');
        exit();
    } catch (PDOException $e) {
        header('Location: ../views/AdminDocumentRequest.php?status=error');
        exit();
    }
}
?>