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
    //need mag dagdag ng username at password sa add resident
    try {
        $currentTime = date('Y-m-d H:i:s');
        $conn = $GLOBALS['conn'];
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $middlename = $_POST['middleName'] ?? "";
        $houseBLdgFloorno = $_POST['bldg'];
        $street = $_POST['street'];
        $from = $_POST['From'];
        $to = $_POST['to'];
        $dateofbirth = $_POST['date'];
        $age = $_POST['Age'];
        $placeofbirth = $_POST['placeofbirth'];
        $contactnumber = $_POST['Contactnumber'];
        $sex = $_POST['sex'];
        $picture = isset($_FILES['profilePicture']['tmp_name']) ? base64_encode(resizeImage($_FILES['profilePicture']['tmp_name'], 250, 250)) : null;
        $civilstatus = $_POST['Civilstatus'];

        $sql = "INSERT INTO user_info (first_name, middle_name, last_name, picture, `House/floor/bldgno.`, Street, `from`, `to`, date_of_birth, Age, place_of_birth, contact_number, gender, civil_status, time_Created) VALUES 
        (:first_name, :middle_name, :last_name, :picture, :house_bldg_floorno, :street, :from, :to, :date_of_birth, :age, :place_of_birth, :contact_number, :gender, :civil_status, :time_created)";
        
        $stmt = $conn->prepare($sql);
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