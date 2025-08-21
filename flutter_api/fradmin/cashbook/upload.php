<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ✅ Your DB credentials
$host = 'localhost';
$db = 'vtechsolar_kwickbillnew';
$user = 'vtechsolar_kwickbillnew';
$pass = 'Qal4R*d8]{Y%VCb,';

// ✅ Connect to DB
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("❌ Database connection failed: " . $conn->connect_error);
}

// ✅ Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['userfile'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $file = $_FILES['userfile'];

  $filename = basename($file['name']);
  $tmpPath = $file['tmp_name'];
  $uploadDir = "uploads/";
  $newName = uniqid() . "_" . $filename;
  $targetPath = $uploadDir . $newName;

  // ✅ Check MIME type
  $allowed = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
  $mime = $file['type'];

  if (!in_array($mime, $allowed)) {
    die("❌ Invalid file type: $mime");
  }

  // ✅ Make sure upload dir exists
  if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
  }

  if (move_uploaded_file($tmpPath, $targetPath)) {
    $stmt = $conn->prepare("INSERT INTO user_uploads (username, filename) VALUES (?, ?)");
    if (!$stmt) {
      die("❌ SQL Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $newName);
    if ($stmt->execute()) {
      echo "✅ File uploaded and saved!";
    } else {
      echo "❌ Insert failed: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "❌ File move failed.";
  }
} else {
  echo "⚠️ No file uploaded.";
}

$conn->close();
?>
