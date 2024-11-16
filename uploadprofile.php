<?php
session_start();

include 'connection.php';

$media_dir = "Images/User/Profile/Image/";
$userid = $_SESSION['userid'];

if (isset($_FILES['profilepic'])) {
    $file = $_FILES['profilepic'];

    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    // $fileSize = $file['size'];

    if ($fileError === 0) {
        $userSubfolder = $media_dir . $userid . '/';
        if (!is_dir($userSubfolder)) {
            mkdir($userSubfolder, 0755, true);
        } else {

            $existingFiles = glob($userSubfolder . '*');
            foreach ($existingFiles as $existingFile) {
                if (is_file($existingFile)) {
                    unlink($existingFile);
                }
            }
        }

        $uniqueFileName = uniqid() . '_' . $fileName;

        $destination = $userSubfolder . $uniqueFileName;
        if (move_uploaded_file($fileTmpName, $destination)) {

            $imagequery = "UPDATE users SET userprofileimg = ? WHERE user_id = ?";
            $imagestmt = mysqli_prepare($conn, $imagequery);
            $imagestmt -> bind_param("si", $uniqueFileName, $userid);
            $imagestmt -> execute();
            
            if ($imagestmt->affected_rows > 0) {
                echo "Image uploaded successfully.";
            } else {
                echo "Error";
            }

        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Error: " . $fileError;
    }
} else {
    echo "No image file uploaded.";
}
?>