<?php
session_start();
include '../databaseconn/connection.php';
include './performanceTrackerController.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    try {
     recordTechnicalPerformance('delete_announcement_start', 'add_announcement');
        $id = $_POST['id'];
        $sql = "DELETE FROM announcement_tbl WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        http_response_code(200);
        exit();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        http_response_code(500);
        exit();
    }
}
?>