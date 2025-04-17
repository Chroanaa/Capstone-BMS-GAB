<?php 
session_start();
include ('../databaseconn/connection.php');
include 'performanceTrackerController.php';
$conn = $GLOBALS['conn'];
$requestor_id = $_SESSION['session'] ?? null;

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
  try {
    $documents = isset($_POST['documents']) ? $_POST['documents'] : [];
    
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
    $gender = $_POST['sex'];
    $civilstatus = $_POST['Civilstatus'];
    $purpose = $_POST['Purpose'];
    $picture = isset($_FILES['profilePicture']['tmp_name']) ? base64_encode( resizeImage($_FILES['profilePicture']['tmp_name'],250,250)) : null;

    $query = 'INSERT INTO `requested_for_others_info`(`first_name`,`middle_name`,`last_name`,`picture`,`requestor_id`, `House/floor/bldgno.`, `street`, `from`, `to`, `date_of_birth`, `age`, `place_of_birth`, `contact_number`, `gender`, `civil_status`, `time_created`) VALUES 
    (:first_name,:middle_name,:last_name,:picture,:requestor_id, :house_bldg_floor_no, :street, :from, :to, :date_of_birth, :age, :place_of_birth, :contact_number, :gender, :civil_status, :time_created)';

    $stmt = $conn->prepare($query);
    $db_arr = [
        'first_name' => $firstname,
        'middle_name' => $middlename,
        'last_name' => $lastname,
        'picture' => $picture,
        'requestor_id' => $requestor_id,
        'house_bldg_floor_no' => $houseBLdgFloorno, // Updated key
        'street' => $street,
        'from' => $from,
        'to' => $to,
        'date_of_birth' => $dateofbirth,
        'age' => $age, // Updated key
        'place_of_birth' => $placeofbirth,
        'contact_number' => $contactnumber,
        'gender' => $gender,
        'civil_status' => $civilstatus,
        'time_created' => date('Y-m-d H:i:s'), // Updated key
    ];
    $stmt->execute($db_arr);

    // Get the last inserted user ID
    $others_id = $conn->lastInsertId();

    // Insert documents if any are selected
    if (!empty($documents)) {
      foreach ($documents as $document) {
        $doc_query = 'INSERT INTO `document_requested_for_others`(`requestor_id`,`user_requestor_id`,`documents_requested`,`purpose`, `status`) VALUES ( :requestor_id,:user_requestor_id,:documents_requested,:purpose, "Pending")';
        $doc_stmt = $conn->prepare($doc_query);
        $db_arr = [
          'requestor_id' => $others_id,
          'user_requestor_id' => $requestor_id,
          'documents_requested' => $document,
          'purpose' => $purpose
        ];
        $doc_stmt->execute($db_arr);
      }
    }
    $document_id = $conn->lastInsertId();
    recordDocumentProcessingTime($document_id, 'others', 'request');
    echo "New record created successfully";
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>