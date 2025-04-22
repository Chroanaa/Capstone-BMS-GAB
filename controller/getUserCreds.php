<?php

function getUserCreds($id) {
    include '../databaseconn/connection.php';
    $User_conn = $GLOBALS['User_conn'];
    
    $query = "SELECT * FROM user_creds WHERE id = ?";
    $stmt = $User_conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}

// Function to get user credentials by username
function getUserCredsByUsername($username) {
    include '../databaseconn/connection.php';
    $User_conn = $GLOBALS['User_conn'];
    
    $query = "SELECT * FROM user_creds WHERE Username = ?";
    $stmt = $User_conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}
?>