<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../views/AdminLogin.php?error=unauthorized');
    exit();
}

function resizeImage($file, $max_width, $max_height) {
    try {
        list($width, $height) = getimagesize($file);
        $ratio = $width / $height;

        if ($max_width / $max_height > $ratio) {
            $max_width = $max_height * $ratio;
        } else {
            $max_height = $max_width / $ratio;
        }

        $src = imagecreatefromstring(file_get_contents($file));
        if (!$src) {
            throw new Exception("Failed to create image from file.");
        }

        $dst = imagecreatetruecolor($max_width, $max_height);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $max_width, $max_height, $width, $height);

        ob_start();
        imagejpeg($dst);
        $data = ob_get_contents();
        ob_end_clean();

        imagedestroy($src);
        imagedestroy($dst);

        return $data;
    } catch (Exception $e) {
        error_log("Image resizing failed: " . $e->getMessage());
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../databaseconn/connection.php';
    if (!$conn) {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Error!',
            'message' => 'Failed to connect to the database.'
        ];
        header('Location: ../views/Announcement.php');
        exit();
    }

    // Validate and sanitize inputs
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $title = trim(htmlspecialchars($_POST['title']));
    $content = trim(htmlspecialchars($_POST['content']));

    // Validate file upload
    $picture = null;
    if (isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES['image']['tmp_name']);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($mimeType, $allowedTypes)) {
            $_SESSION['alert'] = [
                'type' => 'error',
                'title' => 'Error!',
                'message' => 'Invalid file type. Only JPG, PNG, and GIF are allowed.'
            ];
            header('Location: ../views/Announcement.php');
            exit();
        }

        $picture = base64_encode(resizeImage($_FILES['image']['tmp_name'], 250, 250));
        if (!$picture) {
            $_SESSION['alert'] = [
                'type' => 'error',
                'title' => 'Error!',
                'message' => 'Failed to process the uploaded image.'
            ];
            header('Location: ../views/Announcement.php');
            exit();
        }
    }

    try {
        if ($picture !== null) {
            $sql = "UPDATE announcement_tbl SET title = :title, content = :content, attachment = :attachment WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'title' => $title,
                'content' => $content,
                'attachment' => $picture,
                'id' => $id
            ]);
        } else {
            $sql = "UPDATE announcement_tbl SET title = :title, content = :content WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'title' => $title,
                'content' => $content,
                'id' => $id
            ]);
        }

        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Success!',
            'message' => 'Announcement updated successfully'
        ];
        header('Location: ../views/Announcement.php');
        exit();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Error!',
            'message' => 'Failed to update announcement'
        ];
        header('Location: ../views/Announcement.php');
        exit();
    }
}
?>