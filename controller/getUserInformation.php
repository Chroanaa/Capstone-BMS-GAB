<?php

function getUserInfo($id) {
    include '../databaseconn/connection.php';
    $query = "SELECT * FROM user_info WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
?>