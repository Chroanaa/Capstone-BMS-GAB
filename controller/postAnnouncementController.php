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
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../databaseconn/connection.php';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $picture = isset($_FILES['attachment']['tmp_name']) ? base64_encode( resizeImage($_FILES['attachment']['tmp_name'],250,250)) : null;
    $date = date('Y-m-d');
    try {
        $conn = $GLOBALS['conn'];
        $sql = "INSERT INTO announcement_tbl (title, content, attachment, time_Created) VALUES (:title, :content, :attachment, :time_Created)";
        $stmt = $conn->prepare($sql);
        $db = [
            'title' => $title,
            'content' => $content,
            'attachment' => $picture,
            'time_Created' => $date,
        ];
        $stmt->execute($db);
        header('Location: ../views/Admin.php?announcement=success');
    } catch (PDOException $e) {
        header('Location: ../views/Admin.php?announcement=failed');
    }
}
?>