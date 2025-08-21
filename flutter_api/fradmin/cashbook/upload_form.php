<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db = 'vtechsolar_kwickbillnew';
$user = 'vtechsolar_kwickbillnew';
$pass = 'Qal4R*d8]{Y%VCb,';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("❌ DB connection failed: " . $conn->connect_error);
}

$uploadMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $uploadDir = 'uploads/';
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
  }

  $fileTypes = [
    'image_file' => 'image',
    'pdf_file'   => 'pdf',
    'other_file' => 'other',
    'camera_file' => 'camera'
  ];

  foreach ($fileTypes as $inputName => $type) {
    if (isset($_FILES[$inputName])) {
      $files = $_FILES[$inputName];

      foreach ($files['name'] as $index => $name) {
        if (!empty($name)) {
          $filename = basename($files['name'][$index]);
          $tmpName = $files['tmp_name'][$index];
          $targetFile = $uploadDir . $filename;

          if (move_uploaded_file($tmpName, $targetFile)) {
            $stmt = $conn->prepare("INSERT INTO user_uploads (username, filename, file_type, uploaded_at) VALUES (?, ?, ?, NOW())");
            if (!$stmt) {
              die("❌ SQL prepare failed: " . $conn->error);
            }

            $stmt->bind_param("sss", $username, $filename, $type);
            if (!$stmt->execute()) {
              die("❌ SQL execute failed: " . $stmt->error);
            }
            $stmt->close();
            $uploadMessage .= "✅ $filename uploaded successfully!<br>";
          } else {
            $uploadMessage .= "❌ Failed to upload $filename.<br>";
          }
        }
      }
    }
  }

  if (empty($uploadMessage)) {
    $uploadMessage = "❌ Please select at least one file.";
  }
}

$result = $conn->query("SELECT * FROM user_uploads ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Upload Files by Type</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      padding: 0;
      background-color: #f8f9fa;
    }

    h2 {
      margin-top: 0;
    }

    form {
      margin-bottom: 40px;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: 600;
    }

    input[type="text"], input[type="file"], input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      font-size: 16px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #007bff;
      color: white;
      border: none;
      margin-top: 20px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .success {
      color: green;
    }

    .error {
      color: red;
    }

    .table-wrapper {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
      font-size: 14px;
    }

    img {
      max-height: 60px;
    }

    @media screen and (max-width: 600px) {
      input[type="text"], input[type="file"], input[type="submit"] {
        font-size: 15px;
      }

      th, td {
        font-size: 13px;
        padding: 8px;
      }

      img {
        max-width: 100%;
        height: auto;
      }
    }
  </style>
</head>
<body>

  <h2>Upload Files by Type</h2>

  <?php if (!empty($uploadMessage)): ?>
    <p class="<?= strpos($uploadMessage, '✅') !== false ? 'success' : 'error' ?>">
      <?= $uploadMessage ?>
    </p>
  <?php endif; ?>

  <form action="" method="post" enctype="multipart/form-data">
    <label>Enter your name:</label>
    <input type="text" name="username" required>

    <label>Select Images (JPG, PNG):</label>
    <input type="file" name="image_file[]" accept=".jpg,.jpeg,.png" multiple>

    <label>Select PDFs:</label>
    <input type="file" name="pdf_file[]" accept=".pdf" multiple>

    <label>Select Others (DOCX, XLSX, TXT):</label>
    <input type="file" name="other_file[]" accept=".docx,.xlsx,.txt" multiple>

    <label>Capture Photo:</label>
    <input type="file" name="camera_file[]" accept="image/*" capture="environment" multiple>

    <input type="submit" value="Upload">
  </form>

  <h2>Uploaded Files</h2>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>File</th>
          <th>Type</th>
          <th>Preview</th>
          <th>Uploaded At</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['username']) ?></td>
          <td><a href="uploads/<?= $row['filename'] ?>" download><?= $row['filename'] ?></a></td>
          <td><?= $row['file_type'] ?></td>
          <td>
            <?php
              $ext = strtolower(pathinfo($row['filename'], PATHINFO_EXTENSION));
              if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                  echo '<img src="uploads/' . $row['filename'] . '" alt="Preview">';
              } else {
                  echo '📄 Document';
              }
            ?>
          </td>
          <td><?= $row['uploaded_at'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
