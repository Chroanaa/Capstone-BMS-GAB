<?php
session_start();
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
    //get the image
    //eencode sa blob
}
  if($_SERVER["REQUEST_METHOD"] == "POST") {
  include('../databaseconn/connection.php');
  $conn = $GLOBALS['conn'];
  $id = $_SESSION['session'];
  $purpose = $_POST['Purpose'];
  $documents = isset($_POST['documents']) ? $_POST['documents'] : [];
  $signature = $_POST['signature'];
 if (!empty($documents)) {
    foreach ($documents as $document) {
      $doc_query = 'INSERT INTO `document_requested`(`user_id`, `documents_requested`,`purpose`, `status`,`signature`) VALUES (:user_id, :documents_requested, :purpose, "Pending", :signature)';
      $doc_stmt = $conn->prepare($doc_query);
      $db_arr = [
        'user_id' => $id,
        'documents_requested' => $document,
        'purpose' => $purpose,
        'signature' => $signature
      ];
      $doc_stmt->execute($db_arr);
    }
  }
}

?>