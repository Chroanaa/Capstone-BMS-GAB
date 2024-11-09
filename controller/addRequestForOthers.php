<?php 
include ('../databaseconn/connection.php');
$conn = $GLOBALS['conn'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    // Check if documents are set, otherwise initialize as an empty array
    $documents = isset($_POST['documents']) ? $_POST['documents'] : [];
    
    $name = $_POST['name'];
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

    $query = 'INSERT INTO `user_info`(`Fullname`, `House/floor/bldgno.`, `Street`, `from`, `to`, `date_of_birth`, `Age`, `place_of_birth`, `contact_number`, `gender`, `civil_status`, `time_Created`) VALUES 
    (:Fullname, :HouseBldgFloorno, :Street, :from, :to, :date_of_birth, :Age, :place_of_birth, :contact_number, :gender, :civil_status, :time_Created)';

    $stmt = $conn->prepare($query);
    $db_arr = [
        'Fullname' => $name,
        'HouseBldgFloorno' => $houseBLdgFloorno,
        'Street' => $street,
        'from' => $from,
        'to' => $to,
        'date_of_birth' => $dateofbirth,
        'Age' => $age,
        'place_of_birth' => $placeofbirth,
        'contact_number' => $contactnumber,
        'gender' => $gender,
        'civil_status' => $civilstatus,
        'time_Created' => date('Y-m-d H:i:s'),
    ];
    $stmt->execute($db_arr);

    // Get the last inserted user ID
    $user_id = $conn->lastInsertId();

    // Insert documents if any are selected
    if (!empty($documents)) {
      foreach ($documents as $document) {
        $doc_query = 'INSERT INTO `document_requested`(`user_id`, `documents_requested`) VALUES (:user_id, :documents_requested)';
        $doc_stmt = $conn->prepare($doc_query);
        $db_arr = [
          'user_id' => $user_id,
          'documents_requested' => $document,
        ];
        $doc_stmt->execute($db_arr);
      }
    }

    echo "New record created successfully";
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>