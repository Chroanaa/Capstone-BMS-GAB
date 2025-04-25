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
    //get the image
    //eencode sa blob
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include "../databaseconn/connection.php";
    $userId = $_POST['user_id'];
    $picture = isset($_FILES['user_picture']) ? base64_encode( resizeImage($_FILES['user_picture']['tmp_name'], 250, 250) ) : "";
    $query = "UPDATE user_info SET picture = ? WHERE creds_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $picture);
    $stmt->bindParam(2, $userId);
    $stmt->execute();
    header("Location: ../views/userProfile.php");


}
?>