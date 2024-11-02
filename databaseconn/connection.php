<?php
$servername = "localhost";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=$servername;dbname=user_request", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
try {
    $userCreds_conn = new PDO("mysql:host=$servername;dbname=user_creds", $username, $password);
    $userCreds_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed to user_Creds: " . $e->getMessage();
}
$GLOBALS['conn'] = $conn;
$GLOBALS['userCreds_conn'] = $userCreds_conn;

?>