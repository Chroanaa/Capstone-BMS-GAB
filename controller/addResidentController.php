<?php
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
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $middlename = $_POST['middleName'] ?? "";
        $houseBLdgFloorno = $_POST['houseBLdgFloorno'] ?? "";
        $street = $_POST['street'] ?? "";
        $from = $_POST['from'] ?? null;
        $to = $_POST['to'] ?? null;
        $dateofbirth = $_POST['dateofbirth'] ?? null;
        $age = $_POST['age'] ?? null;
        $placeofbirth = $_POST['placeofbirth'] ?? "";
        $contactnumber = $_POST['contactnumber'] ?? "";
        $sex = $_POST['gender'] ?? "";
        $civilstatus = $_POST['civilstatus'] ?? "";
        $picture = null;
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $picture = resizeImage($_FILES['picture']['tmp_name'], 800, 600);
        }
        // ... existing code ...

        $sql = "INSERT INTO user_info (first_name, middle_name, last_name, picture, creds_id, `House/floor/bldgno.`, Street, `from`, `to`, date_of_birth, Age, place_of_birth, contact_number, gender, civil_status, time_Created) 
               VALUES (:first_name, :middle_name, :last_name, :picture, :creds_id, :house_bldg_floorno, :street, :from, :to, :date_of_birth, :age, :place_of_birth, :contact_number, :gender, :civil_status, :time_created)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':creds_id', $creds_id);
        $stmt->bindParam(':first_name', $firstname);
        $stmt->bindParam(':middle_name', $middlename);
        $stmt->bindParam(':last_name', $lastname);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':house_bldg_floorno', $houseBLdgFloorno);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':from', $from);
        $stmt->bindParam(':to', $to);
        $stmt->bindParam(':date_of_birth', $dateofbirth);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':place_of_birth', $placeofbirth);
        $stmt->bindParam(':contact_number', $contactnumber);
        $stmt->bindParam(':gender', $sex);
        $stmt->bindParam(':civil_status', $civilstatus);
        $stmt->bindParam(':time_created', $currentTime);

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