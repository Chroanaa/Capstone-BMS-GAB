<?php 
session_start();

include ('../databaseconn/connection.php');
include ('./performanceTrackerController.php');
$user_creds_conn = $GLOBALS['User_conn'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        recordTechnicalPerformance('login_start', 'login');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user_creds WHERE Username = :username";
        $stmt = $user_creds_conn->prepare($sql);
        $db = [
            'username' => $username,
        ];
        $stmt->execute($db);
        $user = $stmt->fetch();

      

        if($user && password_verify($password, $user['Password'])){
            $_SESSION['session'] = $user['id'];
            recordTechnicalPerformance('login_end', 'login');
            header('Location: ../views/index.php');
        } else {
            recordTechnicalPerformance('login_end', 'login');
            header('Location: ../views/Login.php?error=wrongcreds');
        }
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>