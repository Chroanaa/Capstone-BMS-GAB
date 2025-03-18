<?php

if($_SERVER['REQUEST_METHOD'] == "POST") {
    include_once '../databaseconn/connection.php';
    try {
        $conn = $GLOBALS['conn'];
        $user_creds_conn = $GLOBALS['User_conn'];
        
        $id = $_POST['id'];
        $currentTime = date('Y-m-d H:i:s');
        $user = getCurrentUserData($id);

    // Inside the POST block where credentials are handled
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $creds_id = $_POST['creds_id']; // Get creds_id from the form
    
        if ($creds_id) {
            // Update existing credentials
            $sql_creds = "UPDATE user_creds 
                         SET username = :username, 
                             password = :password 
                         WHERE id = :creds_id";
            $stmt_creds = $user_creds_conn->prepare($sql_creds);
            $stmt_creds->execute([
                'username' => $username,
                'password' => $password,
                'creds_id' => $creds_id
            ]);
        } else {
            // Create new credentials
            $sql_creds = "INSERT INTO user_creds (username, password, time_created) 
                         VALUES (:username, :password, :time_created)";
            $stmt_creds = $user_creds_conn->prepare($sql_creds);
            $stmt_creds->execute([
                'username' => $username,
                'password' => $password,
                'time_created' => $currentTime
            ]);
            
            // Link new credentials to user
            $creds_id = $user_creds_conn->lastInsertId();
            $sql_update_creds = "UPDATE user_info SET creds_id = :creds_id WHERE id = :id";
            $stmt_update = $conn->prepare($sql_update_creds);
            $stmt_update->execute(['creds_id' => $creds_id, 'id' => $id]);
        }
    }

        // Update resident information
        $firstname = $_POST['firstName'] ?? $user['first_name'];
        $middlename = $_POST['middleName'] ?? $user['middle_name'];
        $lastname = $_POST['lastName'] ?? $user['last_name'];
        $houseBLdgFloorno = $_POST['bldg'] ?? $user['House/floor/bldgno.'];
        $street = $_POST['street'] ?? $user['street'];
        $from = $_POST['From'] ?? $user['from'];
        $to = $_POST['to'] ?? $user['to'];
        $age = $_POST['Age'] ?? $user['Age'];
        $dateofbirth = $_POST['date'] ?? $user['date_of_birth'];
        $placeofbirth = $_POST['placeofbirth'] ?? $user['place_of_birth'];
        $contactnumber = $_POST['Contactnumber'] ?? $user['contact_number'];
        $sex = $_POST['sex'] ?? $user['gender'];
        $civilstatus = $_POST['Civilstatus'] ?? $user['civil_status'];

        $sql = "UPDATE user_info SET 
                first_name = :firstname,
                middle_name = :middlename,
                last_name = :lastname,
                `House/floor/bldgno.` = :houseBLdgFloorno,
                street = :street,
                `from` = :from,
                `to` = :to,
                Age = :age,
                date_of_birth = :dateofbirth,
                place_of_birth = :placeofbirth,
                contact_number = :contactnumber,
                gender = :sex,
                civil_status = :civilstatus,
                time_Updated = :time_Updated
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':middlename', $middlename);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':houseBLdgFloorno', $houseBLdgFloorno);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':from', $from);
        $stmt->bindParam(':to', $to);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':dateofbirth', $dateofbirth);
        $stmt->bindParam(':placeofbirth', $placeofbirth);
        $stmt->bindParam(':contactnumber', $contactnumber);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':civilstatus', $civilstatus);
        $stmt->bindParam(':time_Updated', $currentTime);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        header('Location: ../views/AdminAllResidents.php?edit=success');
    } catch(PDOException $e) {
        error_log($e->getMessage());
        header('Location: ../views/AdminAllResidents.php?edit=failed');
    } finally {
        $conn = null;
        if (isset($user_creds_conn)) {
            $user_creds_conn = null;
        }
    }
}

function getCurrentUserData($id) {
    include_once '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    try {
        $sql = "SELECT u.*, c.Username, c.id as creds_id 
                FROM user_info u 
                LEFT JOIN user_creds.user_creds c ON u.creds_id = c.id 
                WHERE u.id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log($e->getMessage());
        return null;
    } finally {
        $conn = null;
    }
}
?>