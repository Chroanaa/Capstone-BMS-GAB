<?php


function checkIfIdExists($id) {
    include '../databaseconn/connection.php';
    $query = "SELECT * FROM user_info WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return true;
    } else {
        return false; 
    }
}
function checkIfCrendetialsExist($id){
    include '../databaseconn/connection.php';
    $query = "SELECT creds_id FROM user_info WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $check = $stmt->fetch(PDO::FETCH_ASSOC);
     if($check['creds_id'] == null){
        return false;
     }else{
        return true;
     }
    
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    if(!checkIfIdExists($id)){
        header('Location: ../views/CheckId.php?id=notfound');
        exit();
    }
    if(checkIfCrendetialsExist($id)){
        header('Location: ../views/CheckId.php?creds=alreadyexists');
        exit();
    }
    header('Location: ../views/RegisterWithId.php?id='.$id);
}
?>