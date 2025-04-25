<?php
$current_password = $_GET['current_password'];
$id = $_GET['id'] ?? "";
function checkPassword($current_password, $id) {
    include ('../databaseconn/connection.php');
    $User_conn = $GLOBALS['User_conn'];
    $sql = "SELECT * FROM user_creds WHERE id = :id";
    $stmt = $User_conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
   $match =  password_verify($current_password, $user['Password']);
    return $match ? true : false;
}
if(checkPassword($current_password, $id)) {
    echo json_encode(array("status" => "success", "message" => "Password is correct."));
} else {
    echo json_encode(array("status" => "error", "message" => "Password is incorrect."));
}
?>