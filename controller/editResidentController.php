<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include_once '../databaseconn/connection.php';
    try{
        $conn = $GLOBALS['conn'];
    $id = $_POST['id'];
    $currentTime = date('Y-m-d H:i:s');
    $user = getCurrentUserData($id);
    $firstname = $_POST['firstName'] ?? $user['first_name'];
    $middlename = $_POST['middleName'] ?? $user['middle_name'];
    $lastname = $_POST['lastName'] ?? $user['last_name'];
    $houseBLdgFloorno = $_POST['bldg'] ?? $user['House/floor/bldgno.'];
    $street = $_POST['street'] ?? $user['street'];
    $from = $_POST['From'] ?? $user['from'];
    $to = $_POST['to'] ?? $user['to'];
    $age = $_POST['Age'] ?? $user['Age'];
    $dateofbirth = $_POST['date'] ?? $user['date_of_birth'];
    $placeofbirth = $_POST['place'] ?? $user['place_of_birth'];
    $contactnumber = $_POST['Contactnumber'] ?? $user['contact_number'];
    $sex = $_POST['sex'] ?? $user['gender'];
    $civilstatus = $_POST['Civilstatus'] ?? $user['civil_status'];
    $sql = "UPDATE user_info SET first_name = :firstname, middle_name = :middlename, last_name = :lastname, `House/floor/bldgno.` = :houseBLdgFloorno, street = :street, `from` = :from, 
    `to` = :to, Age = :age, date_of_birth = :dateofbirth, place_of_birth = :placeofbirth, contact_number = :contactnumber,gender = :sex, civil_status = :civilstatus,time_Updated = :time_Updated WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':middlename', $middlename);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':houseBLdgFloorno', $houseBLdgFloorno);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':from', $from);
    $stmt->bindParam(':to', $to);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':dateofbirth', $dateofbirth);
    $stmt->bindParam(':placeofbirth', $placeofbirth);
    $stmt->bindParam(':contactnumber', $contactnumber);
    $stmt->bindParam(":sex", $sex);
    $stmt->bindParam(":civilstatus", $civilstatus);
    $stmt->bindParam(":time_Updated", $currentTime);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('Location: ../views/AdminAllResidents.php?edit=success');
    }catch(PDOException $e){
    header('Location: ../views/AdminAllResidents.php?edit=failed');
    }finally{
        $conn = null;
    }
    

}

function getCurrentUserData($id){
    include_once '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    try{
    $sql = "SELECT * FROM user_info WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result;
    }catch(PDOException $e){
        return "No user found";
    }finally{
        $conn = null;
    }
}
?>