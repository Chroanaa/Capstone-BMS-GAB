<?php
session_start();
$email = $_SESSION['email'] ;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '../databaseconn/connection.php';
    
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    try{
        if($password == $confirm){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $getUserId = "SELECT `creds_id` FROM `user_info` WHERE `email` = ?";
        $stmt = $conn->prepare($getUserId);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result['creds_id'];
        $sql = "UPDATE `user_creds` SET `password` = ? WHERE `id` = ?";
        $stmt = $User_conn->prepare($sql);
        $stmt->bindParam(1, $password);
        $stmt->bindParam(2, $id);
        $stmt->execute();
        header("Location: ../views/Login.php?password=changed");
    }else{
    }
        
       
    }catch(PDOException $e){
        echo "Error: ".$e->getMessage();
    }


}
?>