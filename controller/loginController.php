<?php 
session_start();

include ('../databaseconn/connection.php');
$user_creds_conn = $GLOBALS['User_conn'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user_creds WHERE Username = :username";
        $stmt = $user_creds_conn->prepare($sql);
        $db = [
            'username' => $username,
        ];
        $stmt->execute($db);
        $user = $stmt->fetch();

        // Debugging statements
        var_dump($username);
        var_dump($password);
        var_dump($user);

        if($user && password_verify($password, $user['Password'])){
            $_SESSION['session'] = $user['id'];
            header('Location: ../views/index.php');
        } else {
            header('Location: ../views/Login.php?error=wrongcreds');
        }
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>