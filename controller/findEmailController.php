<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require '../vendor/autoload.php';
$mail = new PHPMailer(true);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../databaseconn/connection.php';
    $email = $_POST['email'];
    $sql = "SELECT email FROM `user_info` WHERE `email` = :email"; // Use named placeholder
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email); // Bind the named placeholder
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $code = rand(1000, 9999);
   if($result){
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'perez.menard.nomiddlename@gmail.com';                     //SMTP username
    $mail->Password   = 'flfn cgjx ovxc pblx';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->setFrom('perez.menard.nomiddlename@gmail.com', 'Mailer');
    $mail->addAddress($email);     
    $mail->isHTML(true);                                 
    $mail->Subject = 'Verification code for password reset';
    $mail->Body    = 'NOTE: IF YOU DID NOT REQUEST THIS, PLEASE IGNORE THIS MESSAGE. YOUR VERIFICATION CODE IS: '.$code;
    $_SESSION['code'] = $code;
    $_SESSION['email'] = $email;
    $mail->send();
    header("Location: ../views/VerifyCode.php");
   }else{
       header("Location: ../views/ForgotPassword.php?email=notfound");
   }

}
?>