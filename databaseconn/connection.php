<?php
$servername = "localhost";
$username = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=$servername;dbname=brgy_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=brgy_db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed to user_Creds: " . $e->getMessage();
}
$GLOBALS['conn'] = $conn;
$GLOBALS['conn'] = $conn;

?>