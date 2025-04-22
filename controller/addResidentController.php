<?php
include './performanceTrackerController.php';
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../databaseconn/connection.php';
    try {
        $conn = $GLOBALS['conn'];
        $user_creds_conn = $GLOBALS['User_conn'];
        $currentTime = date('Y-m-d H:i:s');
        $creds_id = null;
        recordTechnicalPerformance("add_resident_start", "user_management");
        // Create user credentials if username and password are provided
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO user_creds (Username, Password, time_Created) VALUES (:username, :password, :time_Created)";
            $stmt = $user_creds_conn->prepare($sql);
            $stmt->execute([
                'username' => $username,
                'password' => $password,
                'time_Created' => $currentTime
            ]);
            $creds_id = $user_creds_conn->lastInsertId();
        }

        // Insert resident information
        $firstname = $_POST['firstName'] ?? "";
        $lastname = $_POST['lastName'] ?? "";
        $middlename = $_POST['middleName'] ?? "";
        $email = $_POST['Email'] ?? "";
        $houseBLdgFloorno = $_POST['bldg'] ?? "";
        $street = $_POST['street'] ?? "";
        $from = $_POST['From'] ?? "";
        $to = $_POST['to'] ?? "";
        $dateofbirth = $_POST['date'] ?? "";
        $age = $_POST['Age'] ?? "";
        $placeofbirth = $_POST['placeofbirth'] ?? "";
        $contactnumber = $_POST['Contactnumber'] ?? "";
        $sex = $_POST['sex'] ?? "";
        $civilstatus = $_POST['Civilstatus'] ?? "";
        $typeOfId = $_POST['typeOfId'] ?? "";
        $vehicle = $_POST['vehicle'] ?? "No";
        $howManyVehicles = $_POST['howManyVehicles'] ?? 0;
        $picture = " ";
        if (isset($_FILES['user_picture']['tmp_name']) && !empty($_FILES['user_picture']['tmp_name']) && $_FILES['user_picture']['error'] === 0) {
    $picture = base64_encode(resizeImage($_FILES['user_picture']['tmp_name'], 250, 250));
        }

        $id = " ";
    if (isset($_FILES['id']['tmp_name']) && !empty($_FILES['id']['tmp_name']) && $_FILES['id']['error'] === 0) {
    $id = base64_encode(resizeImage($_FILES['id']['tmp_name'], 250, 250));
    }


        $sql = "INSERT INTO user_info (
                    first_name, middle_name, last_name, picture, creds_id, 
                    `House/floor/bldgno.`, Street, `from`, `to`, date_of_birth, Age, 
                    place_of_birth, contact_number, `email`, gender, civil_status, 
                    type_of_id, id_picture, own_vehicle, vehicle_count, time_Created
                ) 
                VALUES (
                    :first_name, :middle_name, :last_name, :picture, :creds_id, 
                    :house_bldg_floorno, :street, :from, :to, :date_of_birth, :age, 
                    :place_of_birth, :contact_number, :email, :gender, :civil_status, 
                    :type_of_id, :id_picture, :own_vehicle, :vehicle_count, :time_created
                )";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':creds_id', $creds_id);
        $stmt->bindParam(':first_name', $firstname);
        $stmt->bindParam(':middle_name', $middlename);
        $stmt->bindParam(':last_name', $lastname);
        $stmt->bindParam(':picture', $picture, PDO::PARAM_LOB);
        $stmt->bindParam(':house_bldg_floorno', $houseBLdgFloorno);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':from', $from);
        $stmt->bindParam(':to', $to);
        $stmt->bindParam(':date_of_birth', $dateofbirth);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':place_of_birth', $placeofbirth);
        $stmt->bindParam(':contact_number', $contactnumber);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $sex);
        $stmt->bindParam(':civil_status', $civilstatus);
        $stmt->bindParam(':type_of_id', $typeOfId);
        $stmt->bindParam(':id_picture', $id, PDO::PARAM_LOB);
        $stmt->bindParam(':own_vehicle', $vehicle);
        $stmt->bindParam(':vehicle_count', $howManyVehicles);
        $stmt->bindParam(':time_created', $currentTime);
        recordTechnicalPerformance("add_resident_end", "user_management");
        if ($stmt->execute()) {
            header('Location: ../views/AdminAllResidents.php?add=success');
        } else {
            header('Location: ../views/AdminAllResidents.php?add=failed');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>