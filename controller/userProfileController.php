<?php
session_start();
include './performanceTrackerController.php';

// Function to update user profile information
function updateUserProfile($userId, $data) {
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    
    try {
        recordTechnicalPerformance('update_user_profile_start', 'profile_management');
        
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
        $stmt->bindParam(':firstName', $data['firstName']);
        $stmt->bindParam(':middleName', $data['middleName']);
        $stmt->bindParam(':lastName', $data['lastName']);
        $stmt->bindParam(':bldg', $data['bldg']);
        $stmt->bindParam(':street', $data['street']);
        $stmt->bindParam(':from', $data['from']);
        $stmt->bindParam(':to', $data['to']);
        $stmt->bindParam(':dateOfBirth', $data['dateOfBirth']);
        $stmt->bindParam(':age', $data['age']);
        $stmt->bindParam(':placeOfBirth', $data['placeOfBirth']);
        $stmt->bindParam(':contactNumber', $data['contactNumber']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':civilStatus', $data['civilStatus']);
        $stmt->bindParam(':userId', $userId);
        
        $success = $stmt->execute();
        recordTechnicalPerformance('update_user_profile_end', 'profile_management');
        
        return $success;
    } catch (PDOException $e) {
        error_log("Error updating user profile: " . $e->getMessage());
        return false;
    }
}

// Function to update user profile picture
function updateUserProfilePicture($userId, $pictureData) {
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    
    try {
        recordTechnicalPerformance('update_profile_picture_start', 'profile_management');
        
        $sql = "UPDATE user_info SET picture = :picture WHERE creds_id = :userId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':picture', $pictureData, PDO::PARAM_LOB);
        $stmt->bindParam(':userId', $userId);
        
        $success = $stmt->execute();
        recordTechnicalPerformance('update_profile_picture_end', 'profile_management');
        
        return $success;
    } catch (PDOException $e) {
        error_log("Error updating profile picture: " . $e->getMessage());
        return false;
    }
}

// Function to change user password
function changeUserPassword($userId, $currentPassword, $newPassword) {
    include '../databaseconn/connection.php';
    $userConn = $GLOBALS['User_conn'];
    
    try {
        recordTechnicalPerformance('change_password_start', 'profile_management');
        
        // First verify current password
        $sql = "SELECT Password FROM user_creds WHERE id = :userId";
        $stmt = $userConn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$result || !password_verify($currentPassword, $result['Password'])) {
            return [
                'success' => false,
                'message' => 'Current password is incorrect'
            ];
        }
        
        // Update with new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE user_creds SET Password = :password WHERE id = :userId";
        $stmt = $userConn->prepare($sql);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':userId', $userId);
        
        $success = $stmt->execute();
        recordTechnicalPerformance('change_password_end', 'profile_management');
        
        return [
            'success' => $success,
            'message' => $success ? 'Password updated successfully' : 'Failed to update password'
        ];
    } catch (PDOException $e) {
        error_log("Error changing password: " . $e->getMessage());
        return [
            'success' => false,
            'message' => 'An error occurred while updating the password'
        ];
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['session'] ?? null;
    
    if (!$userId) {
        header('Location: ../views/Login.php?error=notLoggedIn');
        exit();
    }
    
    // Handle profile update
    if (isset($_POST['updateProfile'])) {
        $profileData = [
            'firstName' => $_POST['firstName'],
            'middleName' => $_POST['middleName'] ?? '',
            'lastName' => $_POST['lastName'],
            'bldg' => $_POST['bldg'],
            'street' => $_POST['street'],
            'from' => $_POST['From'],
            'to' => $_POST['to'],
            'dateOfBirth' => $_POST['date'],
            'age' => $_POST['Age'],
            'placeOfBirth' => $_POST['placeofbirth'],
            'contactNumber' => $_POST['Contactnumber'],
            'email' => $_POST['Email'],
            'gender' => $_POST['sex'] ?? '',
            'civilStatus' => $_POST['Civilstatus'] ?? ''
        ];
        
        $success = updateUserProfile($userId, $profileData);
        
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
        
        header('Location: ../views/userProfile.php');
        exit();
    }
    
    // Handle profile picture update
    if (isset($_POST['updatePicture']) && isset($_FILES['profilePicture'])) {
        if ($_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            // Resize and encode the image
            $pictureData = base64_encode(
                resizeImage($_FILES['profilePicture']['tmp_name'], 250, 250)
            );
            
            $success = updateUserProfilePicture($userId, $pictureData);
            
            if ($success) {
                $_SESSION['alert'] = [
                    'type' => 'success',
                    'title' => 'Success!',
                    'message' => 'Profile picture updated successfully'
                ];
            } else {
                $_SESSION['alert'] = [
                    'type' => 'error',
                    'title' => 'Error!',
                    'message' => 'Failed to update profile picture'
                ];
            }
        } else {
            $_SESSION['alert'] = [
                'type' => 'error',
                'title' => 'Error!',
                'message' => 'Invalid file upload'
            ];
        }
        
        header('Location: ../views/userProfile.php');
        exit();
    }
    
    // Handle password change
    if (isset($_POST['changePassword'])) {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];
        
        if ($newPassword !== $confirmPassword) {
            $_SESSION['alert'] = [
                'type' => 'error',
                'title' => 'Error!',
                'message' => 'New passwords do not match'
            ];
            header('Location: ../views/userProfile.php');
            exit();
        }
        
        $result = changeUserPassword($userId, $currentPassword, $newPassword);
        
        $_SESSION['alert'] = [
            'type' => $result['success'] ? 'success' : 'error',
            'title' => $result['success'] ? 'Success!' : 'Error!',
            'message' => $result['message']
        ];
        
        header('Location: ../views/userProfile.php');
        exit();
    }
}

// Helper function to resize image (reused from other controllers)
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
?>