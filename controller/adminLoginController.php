<?php
session_start();
include './performanceTrackerController.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../databaseconn/connection.php';
    recordTechnicalPerformance("admin_login_start", "user_management");
    $conn = $GLOBALS['User_conn'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM admin_creds WHERE username = :username AND password = :password"); 
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch();
    recordTechnicalPerformance("admin_login_end", "user_management");
    if($result){
        $_SESSION['admin'] = $result['id'];
        header('Location: ../views/Admin.php');
    }else{
        header('Location: ../views/AdminLogin.php');
    }
   
}

?>