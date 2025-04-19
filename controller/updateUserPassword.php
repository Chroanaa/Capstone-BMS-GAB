<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include "../databaseconn/connection.php";
    $userId = $_POST['user_id'];
    $newPassword = $_POST['newPassword'];
    $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
    $query = "UPDATE user_creds SET password = ? WHERE id = ?";
    $stmt = $User_conn->prepare($query);
    $stmt->bindParam(1, $password_hash);
    $stmt->bindParam(2, $userId);
    $stmt->execute();
    header("Location: ../views/userProfile.php");
}
?>