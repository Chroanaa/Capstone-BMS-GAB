<?php 
session_start();

include ('../databaseconn/connection.php');
$user_creds_conn = $GLOBALS['User_conn'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user_creds WHERE Username = :username AND Password = :password";
    $stmt = $user_creds_conn->prepare($sql);
    $db = [
        'username' => $username,
        'password' => $password,
    ];
    $stmt->execute($db);
    $user = $stmt->fetch();
    $count = $stmt->rowCount();
    if($count > 0){
        header('Location: ../views/index.php');
        $_SESSION['session'] = $user['id'] ?? 'null';
      
    }else{
        header('Location: ../views/Login.php?error=true');
    }

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>