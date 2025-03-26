<?php
$user = $_GET['email'] ?? "";
header('Content-Type: application/json');
if(CheckDuplicate($user)){
    echo json_encode([
    'status' => 'error', 
    'message' => 'Email already taken'
    ]);
  }
  else{
        echo json_encode([
        'status' => 'success', 
        'message' => 'Available'
    ]);
 }


function CheckDuplicate($param) {
    include ('../databaseconn/connection.php');
    $User_conn = $GLOBALS['User_conn'];
    $sql = "SELECT email FROM user_info WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $param, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? true : false;
}
?>