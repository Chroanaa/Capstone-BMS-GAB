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
    $current_id = $_POST['id'];
    $query = "SELECT * FROM user_info WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $current_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //User Information
   $firstname = $_POST['firstName'] ?? $result['first_name'] ?? '';
$middlename = $_POST['middleName'] ?? $result['middle_name'] ?? '';
$lastname = $_POST['lastName'] ?? $result['last_name'] ?? '';
$houseBLdgFloorno = $_POST['bldg'] ?? $result['House/floor/bldgno.'] ?? '';
$street = $_POST['street'] ?? $result['Street'] ?? '';
$from = $_POST['From'] ?? $result['from'] ?? '';
$to = $_POST['to'] ?? $result['to'] ?? '';
$dateofbirth = $_POST['date'] ?? $result['date_of_birth'] ?? '';
$age = $_POST['Age'] ?? $result['Age'] ?? '';
$gender = $_POST['sex'] ?? $result['gender'] ?? '';
$civilstatus = $_POST['Civilstatus'] ?? $result['civil_status'] ?? '';
$placeofbirth = $_POST['placeofbirth'] ?? $result['place_of_birth'] ?? '';
$contactnumber = $_POST['Contactnumber'] ?? $result['contact_number'] ?? '';
$email = $_POST['Email'] ?? $result['email'] ?? '';
$typeOfId = $_POST['typeOfId'] ?? $result['type_of_id'] ?? '';
 $id = null;
if (isset($_FILES['id']['tmp_name']) && !empty($_FILES['id']['tmp_name'])) {
    $id = base64_encode(resizeImage($_FILES['id']['tmp_name'], 250, 250));
} elseif (!empty($result['id_picture'])) {
    $id = $result['id_picture']; // Keep existing ID picture
}

$do_you_own_a_vehicle = $_POST['vehicle'] ?? $result['own_vehicle'] ?? 'No';
$vehicle_count = $_POST['howManyVehicles'] ?? $result['vehicle_count'] ;
$house_floor = $_POST['houseFloors'] ?? $result['floor_count'] ?? 1;
$picture = null;
if (isset($_FILES['user_picture']['tmp_name']) && !empty($_FILES['user_picture']['tmp_name'])) {
    $picture = base64_encode(resizeImage($_FILES['user_picture']['tmp_name'], 250, 250));
} elseif (!empty($result['picture'])) {
    $picture = $result['picture']; // Keep existing picture
}   
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