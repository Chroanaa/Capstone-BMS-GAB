<?php
include '../databaseconn/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = $GLOBALS['conn'];

        // Retrieve form data
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'] ?? '';
        $lastName = $_POST['lastName'];
        $bldg = $_POST['bldg'];
        $street = $_POST['street'];
        $from = $_POST['From'];
        $to = $_POST['to'];
        $dateOfBirth = $_POST['date'];
        $age = $_POST['Age'];
        $placeOfBirth = $_POST['placeofbirth'];
        $contactNumber = $_POST['Contactnumber'];
        $sex = $_POST['sex'];
        $civilStatus = $_POST['Civilstatus'];
        $typeOfId = $_POST['typeOfId'];
        $vehicle = $_POST['vehicle'];
        $howManyVehicles = $_POST['howManyVehicles'] ?? 0;

        // Handle profile picture upload
        $profilePicture = null;
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            $profilePicture = file_get_contents($_FILES['profilePicture']['tmp_name']);
        }

        // Handle ID picture upload
        $idPicture = null;
        if (isset($_FILES['idPicture']) && $_FILES['idPicture']['error'] === UPLOAD_ERR_OK) {
            $idPicture = file_get_contents($_FILES['idPicture']['tmp_name']);
        }

        // Update database
        $sql = "
            UPDATE user_info SET
                first_name = :firstName,
                middle_name = :middleName,
                last_name = :lastName,
                `House/floor/bldgno.` = :bldg,
                Street = :street,
                `from` = :from,
                `to` = :to,
                date_of_birth = :dateOfBirth,
                Age = :age,
                place_of_birth = :placeOfBirth,
                contact_number = :contactNumber,
                gender = :sex,
                civil_status = :civilStatus,
                type_of_id = :typeOfId,
                own_vehicle = :vehicle,
                vehicle_count = :howManyVehicles
                " . ($profilePicture ? ", picture = :profilePicture" : "") . "
                " . ($idPicture ? ", id_picture = :idPicture" : "") . "
            WHERE id = :id
        ";

        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':middleName', $middleName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':bldg', $bldg);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':from', $from);
        $stmt->bindParam(':to', $to);
        $stmt->bindParam(':dateOfBirth', $dateOfBirth);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':placeOfBirth', $placeOfBirth);
        $stmt->bindParam(':contactNumber', $contactNumber);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':civilStatus', $civilStatus);
        $stmt->bindParam(':typeOfId', $typeOfId);
        $stmt->bindParam(':vehicle', $vehicle);
        $stmt->bindParam(':howManyVehicles', $howManyVehicles);
        $stmt->bindParam(':id', $id);

        if ($profilePicture) {
            $stmt->bindParam(':profilePicture', $profilePicture, PDO::PARAM_LOB);
        }

        if ($idPicture) {
            $stmt->bindParam(':idPicture', $idPicture, PDO::PARAM_LOB);
        }

        $stmt->execute();

        header('Location: ../views/AdminAllResidents.php?edit=success');
    } catch (PDOException $e) {
        header('Location: ../views/AdminAllResidents.php?edit=failed');
    }
}
?>