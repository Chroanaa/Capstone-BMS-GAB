<?php
// approveOthersDocumentRequest.php
include "./getIpAddress.php";
include './performanceTrackerController.php';
$ip = get_client_ip();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include ('../databaseconn/connection.php');
    $conn = $GLOBALS['conn'];
    $id = $_POST['id'];
    try {
        // Update the status without changing the time_Created column
        $query = 'UPDATE `document_requested_for_others` SET `status` = "Approved", `time_Created` = `time_Created` WHERE `id` = :id';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
         $getName = 'SELECT CONCAT(`first_name`, " ", `last_name`) AS `full_name` FROM `requested_for_others_info` WHERE `id` = (SELECT `requestor_id` FROM `document_requested_for_others` WHERE `id` = :id)';
        $stmt = $conn->prepare($getName);
        $stmt->execute(['id' => $id]);
        $name = $stmt->fetch();
        recordDocumentProcessingTime($id, 'others', 'approve');
        $insert_into_audit = "INSERT INTO `audit_log`( `action`, `ip_address`, `time_Created`) VALUES ('Document Approved to Approved for $name[0]','$ip',NOW())";
        $stmt = $conn->prepare($insert_into_audit);
        $stmt->execute();
        header('Location: ../views/AdminDocumentRequest.php?status=approved');
        exit();
    } catch (PDOException $e) {
        header('Location: ../views/AdminDocumentRequest.php?status=error');
        exit();
    }
}
?>