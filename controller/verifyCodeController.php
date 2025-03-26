<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $code = $_POST['code'];
    $sessionCode = $_SESSION['code'];
    if($code == $sessionCode){
        header('Location: ../views/ResetPassword.php');
        unset($_SESSION['code']);
    }else{
        header('Location: ../views/VerifyCode.php?code=invalid');
    }
}
?>