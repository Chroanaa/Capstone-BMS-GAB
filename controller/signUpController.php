<?php
include ('../databaseconn/connection.php');
$userCreds_conn = $GLOBALS['userCreds_conn'];
$conn = $GLOBALS['conn'];
if($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    //User Creds
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO user_creds (Username, Password) VALUES (:username, :password)";
    $stmt = $userCreds_conn->prepare($sql);
    $db = [
        'username' => $username,
        'password' => $password,
    ];
    $stmt->execute($db);
    $creds_id = $userCreds_conn->lastInsertId();





    //User Information
    $name = $_POST['name'];
    $houseBLdgFloorno = $_POST['bldg'];
    $street = $_POST['street'];
    $from = $_POST['From'];
    $to = $_POST['to'];
    $dateofbirth = $_POST['date'];
    $age = $_POST['Age'];
    $gender = $_POST['sex'];
    $civilstatus = $_POST['Civilstatus'];
    $placeofbirth = $_POST['placeofbirth'];
    $contactnumber = $_POST['Contactnumber'];
    $username = $_POST['username'];
    $password = $_POST['password'];
   $sql = "INSERT INTO `user_info`( `Fullname`, `creds_id`, `House/floor/bldgno.`, `Street`, `from`, `to`, `date_of_birth`, `Age`, `place_of_birth`, `contact_number`, `gender`, `civil_status`, `time_Created`)
    VALUES (:Fullname,:creds_id,:HouseBldgFloorno,:Street,:from,:to,:date_of_birth,:Age,:place_of_birth,:contact_number,:gender,:civil_status,:time_Created)";
    $stmt = $conn->prepare($sql);
    $db = [
        'Fullname' => $name,
        'creds_id' => $creds_id,
        'HouseBldgFloorno' => $houseBLdgFloorno,
        'Street' => $street,
        'from' => $from,
        'to' => $to,
        'date_of_birth' => $dateofbirth,
        'Age' => $age,
        'place_of_birth' => $placeofbirth,
        'contact_number' => $contactnumber,
        'gender' => $gender,
        'civil_status' => $civilstatus,
        'time_Created' => date('Y-m-d H:i:s'),
    ];
    $stmt->execute($db);
    header('Location: ../views/Login.php');
  }catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>