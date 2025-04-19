<?php
session_start();
include './performanceTrackerController.php';

// Check if the user is logged in
$userId = $_SESSION['session'] ?? null;
if (!$userId) {
    header('Location: ../views/Login.php?error=notLoggedIn');
    exit();
}

function getUserPrevData($id){
    include '../databaseconn/connection.php';
    $query = "SELECT * FROM user_info WHERE creds_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    $prevUserData = getUserPrevData($userId);
        recordTechnicalPerformance('update_user_profile_start', 'profile_management');
        
        // Collect form data
        $firstName = $_POST['firstName'] ?? $prevUserData['first_name'];
        $middleName = $_POST['middleName'] ?? $prevUserData['middle_name'];
        $lastName = $_POST['lastName'] ?? $prevUserData['last_name'];
        $bldg = $_POST['bldg'] ?? $prevUserData['House/floor/bldgno.'];
        $street = $_POST['street'] ?? $prevUserData['Street'];
        $from = $_POST['From'] ?? $prevUserData['from'];
        $to = $_POST['to'] ?? $prevUserData['to'];
        $dateOfBirth = $_POST['dateOfBirth'] ?? $prevUserData['date_of_birth'];
        $age = $_POST['age'] ?? $prevUserData['Age'];
        $placeOfBirth = $_POST['placeOfBirth'] ?? $prevUserData['place_of_birth'];
        $contactNumber = $_POST['contactNumber'] ?? $prevUserData['contact_number'];
        $email = $_POST['Email'] ?? $prevUserData['email'];
        $gender = $_POST['gender'] ?? $prevUserData;
        $civilStatus = $_POST['Civilstatus'] ?? $prevUserData['civil_status'];
        $typeOfId = $_POST['typeOfId'] ?? $prevUserData['type_of_id'];
        $do_you_own_a_vehicle = $_POST['vehicle'] ?? $prevUserData['own_vehicle'];
        $vehicle_count = $_POST['howManyVehicles'] ?? $prevUserData['vehicle_count'];

        // Prepare and execute the update query
        $sql = "UPDATE user_info SET
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
                email = :email,
                gender = :gender,
                civil_status = :civilStatus,
                type_of_id = :typeOfId,
                own_vehicle = :do_you_own_a_vehicle,
                vehicle_count = :vehicle_count

                WHERE creds_id = :userId";
        
        $stmt = $conn->prepare($sql);
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
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':civilStatus', $civilStatus);
        $stmt->bindParam(':typeOfId', $typeOfId);
        $stmt->bindParam(':do_you_own_a_vehicle', $do_you_own_a_vehicle);
        $stmt->bindParam(':vehicle_count', $vehicle_count);

        $stmt->bindParam(':userId', $userId);
        
        $success = $stmt->execute();
        recordTechnicalPerformance('update_user_profile_end', 'profile_management');
        

}
?>