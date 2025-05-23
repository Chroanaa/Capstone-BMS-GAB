<?php
include ('../databaseconn/connection.php');
include ('./performanceTrackerController.php');
$conn = $GLOBALS['conn'];
$user_creds_conn = $GLOBALS['User_conn'];
function resizeImage($file, $max_width, $max_height) {
    list($width, $height) = getimagesize($file);
    $ratio = $width / $height;

    if ($max_width / $max_height > $ratio) {
        $max_width = $max_height * $ratio;
    } else {
        $max_height = $max_width / $ratio;
    }

    $src = imagecreatefromstring(file_get_contents($file));
    $dst = imagecreatetruecolor($max_width, $max_height);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $max_width, $max_height, $width, $height);

    ob_start();
    imagejpeg($dst);
    $data = ob_get_contents();
    ob_end_clean();

    imagedestroy($src);
    imagedestroy($dst);

    return $data;
    //get the image
    //eencode sa blob
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    recordTechnicalPerformance('sign_up_start', 'sign_up');
    //User Creds
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user_creds (Username, Password, time_Created) VALUES (:username, :password, :time_Created)";
    $stmt = $user_creds_conn->prepare($sql);
    $db = [
        'username' => $username,
        'password' => $hash_password,
        'time_Created' => date('Y-m-d H:i:s'),
    ];
    $stmt->execute($db);
    $creds_id = $user_creds_conn  ->lastInsertId();





    //User Information
    $firstname = $_POST['firstName'];
    $middlename = $_POST['middleName'] ?? "";
    $lastname = $_POST['lastName'];
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
    $email = $_POST['Email'];
    $typeOfId = $_POST['typeOfId'];
    $id = isset($_FILES['id']['tmp_name']) ? base64_encode( resizeImage($_FILES['id']['tmp_name'],250,250)) : null;
    $do_you_own_a_vehicle = $_POST['vehicle'];  
    $vehicle_count = $_POST['howManyVehicles'] ?? 0;
    $house_floor = $_POST['houseFloors'];
    $picture = isset($_FILES['user_picture']['tmp_name']) ? base64_encode( string: resizeImage($_FILES['user_picture']['tmp_name'],250,250)) : null;
   
   $sql = "INSERT INTO `user_info`( `first_name`,`middle_name`,`last_name`,`picture`, `creds_id`, `House/floor/bldgno.`, `Street`, `from`, `to`, `date_of_birth`, `Age`, `place_of_birth`, `contact_number`,`email`,
    `gender`, `civil_status`,`type_of_id`,`id_picture`,`own_vehicle`,`vehicle_count`,`floor_count`, `time_Created`)
    VALUES (:first_name,:middle_name,:last_name,:picture,:creds_id,:HouseBldgFloorno,:Street,:from,:to,:date_of_birth,:Age,
    :place_of_birth,:contact_number,:email,:gender,:civil_status,:type_of_id,:id_picture,:own_vehicle,:vehicle_count,:floor_count,:time_Created)";
    $stmt = $conn->prepare($sql);
    $db = [
        'first_name' => $firstname,
        'middle_name' => $middlename,
        'last_name' => $lastname,
        'picture' => $picture,
        'creds_id' => $creds_id,
        'HouseBldgFloorno' => $houseBLdgFloorno,
        'Street' => $street,
        'from' => $from,
        'to' => $to,
        'date_of_birth' => $dateofbirth,
        'Age' => $age,
        'place_of_birth' => $placeofbirth,
        'contact_number' => $contactnumber,
        'email' => $email,
        'gender' => $gender,
        'civil_status' => $civilstatus,
        'type_of_id' => $typeOfId,
        'id_picture' => $id,
        'own_vehicle' => $do_you_own_a_vehicle,
        'vehicle_count' => $vehicle_count,
        'floor_count' => $house_floor,
        
        'time_Created' => date('Y-m-d H:i:s'),
    ];
    recordTechnicalPerformance('sign_up_end', 'sign_up');
    $stmt->execute($db);
    header('Location: ../views/Login.php');
  }catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

?>