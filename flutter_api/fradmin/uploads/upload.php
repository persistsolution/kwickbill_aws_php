<?php
header('Content-Type: application/json');

// Set upload directory
$uploadDir = __DIR__ . '/';  // current folder (uploads/)

// Check if file is uploaded
if (!isset($_FILES['file'])) {
    echo json_encode(['status' => false, 'message' => 'No file uploaded']);
    exit;
}

$file = $_FILES['file'];
$originalName = basename($file['name']);
$targetFile = $uploadDir . uniqid() . "_" . preg_replace("/[^A-Za-z0-9\.\-_]/", '', $originalName);

// Check for upload errors
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['status' => false, 'message' => 'Upload error: ' . $file['error']]);
    exit;
}

// Move file
if (move_uploaded_file($file['tmp_name'], $targetFile)) {
    $filename = basename($targetFile);
    echo json_encode(['status' => true, 'filename' => $filename, 'message' => 'File uploaded successfully']);
} else {
    echo json_encode(['status' => false, 'message' => 'Failed to move uploaded file']);
}
?>
