<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['User_conn'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM admin_creds WHERE username = :username AND password = :password"); 
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result){
        $_SESSION['username'] = $username;
        header('Location: ../views/Admin.php');
    }else{
        header('Location: ../views/AdminLogin.php');
    }
   
}

?>