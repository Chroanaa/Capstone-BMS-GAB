<?php
session_start();
include './performanceTrackerController.php';

// Check if the user is logged in
$userId = $_SESSION['session'] ?? null;
if (!$userId) {
    header('Location: ../views/Login.php?error=notLoggedIn');
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    
    try {
        recordTechnicalPerformance('update_user_profile_start', 'profile_management');
        
        // Collect form data
        $firstName = $_POST['firstName'] ?? '';
        $middleName = $_POST['middleName'] ?? '';
        $lastName = $_POST['lastName'] ?? '';
        $bldg = $_POST['bldg'] ?? '';
        $street = $_POST['street'] ?? '';
        $from = $_POST['from'] ?? '';
        $to = $_POST['to'] ?? '';
        $dateOfBirth = $_POST['dateOfBirth'] ?? '';
        $age = $_POST['age'] ?? '';
        $placeOfBirth = $_POST['placeOfBirth'] ?? '';
        $contactNumber = $_POST['contactNumber'] ?? '';
        $email = $_POST['email'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $civilStatus = $_POST['civilStatus'] ?? '';
        
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
                civil_status = :civilStatus
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
        $stmt->bindParam(':userId', $userId);
        
        $success = $stmt->execute();
        recordTechnicalPerformance('update_user_profile_end', 'profile_management');
        
        // Set a session alert for feedback
        if ($success) {
            $_SESSION['alert'] = [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Profile updated successfully'
            ];
        } else {
            $_SESSION['alert'] = [
                'type' => 'error',
                'title' => 'Error!',
                'message' => 'Failed to update profile'
            ];
        }
    } catch (PDOException $e) {
        error_log("Error updating user profile: " . $e->getMessage());
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Error!',
            'message' => 'An error occurred while updating your profile'
        ];
    }
    
    // Redirect back to the user profile page
    header('Location: ../views/userProfile.php');
    exit();
} else {
    // If not a POST request, redirect to the user profile page
    header('Location: ../views/userProfile.php');
    exit();
}
?>