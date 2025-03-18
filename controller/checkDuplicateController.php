<?php
$user = $_GET['username'] ?? "";
header('Content-Type: application/json');
if(CheckDuplicate($user)){
    echo json_encode([
    'status' => 'error', 
    'message' => 'Username already taken'
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
    $sql = "SELECT Username FROM user_creds WHERE Username = :username";
    $stmt = $User_conn->prepare($sql);
    $stmt->bindParam(':username', $param, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? true : false;
}
?>