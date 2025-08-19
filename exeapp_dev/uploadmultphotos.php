<?php
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadDir = "../pdffiles/";

    // Make sure uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . basename($file["name"]);

    if (move_uploaded_file($file["tmp_name"], $filePath)) {
        
        echo "File uploaded successfully: " . $filePath;
    } else {
        echo "Failed to upload file.";
    }
} else {
    echo "No file received.";
}
?>