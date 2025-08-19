<?php 
require_once 'config.php';

$encodedFrId = $_GET['page1'];
$monthHash = $_GET['page2'];
$yearEncoded = $_GET['page3'];

$FrId = base64_decode($encodedFrId);
$year = base64_decode(strrev($yearEncoded));

// Resolve the month using the hash
$possibleMonth = null;
for ($i = 1; $i <= 12; $i++) {
    $iPadded = str_pad($i, 2, '0', STR_PAD_LEFT);
    if (md5($iPadded . $FrId) === $monthHash) {
        $possibleMonth = $iPadded;
        break;
    }
}
$month = $possibleMonth;

if ($FrId && $month && $year) {
    $sql = "SELECT id, ShopName FROM tbl_users WHERE id = '" . intval($FrId) . "'";
    $row = getRecord($sql);
}

// Form submission
if (isset($_POST['submit'])) {
    $frid = addslashes(trim($_POST['frid']));
    $month = addslashes(trim($_POST['month']));
    $year = addslashes(trim($_POST['year']));
    $createddate = date('Y-m-d H:i:s');

    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/aliance_files/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $uploadedFile1 = '';
    $uploadedFile2 = '';
    $uploadedFile3 = '';

    if (!empty($_FILES['uploadFile']['name'])) {
        $fileName1 = time() . '_1_' . basename($_FILES['uploadFile']['name']);
        if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $targetDir . $fileName1)) {
            $uploadedFile1 = $fileName1;
        }
    }

    if (!empty($_FILES['uploadFile2']['name'])) {
        $fileName2 = time() . '_2_' . basename($_FILES['uploadFile2']['name']);
        if (move_uploaded_file($_FILES['uploadFile2']['tmp_name'], $targetDir . $fileName2)) {
            $uploadedFile2 = $fileName2;
        }
    }

    if (!empty($_FILES['uploadFile3']['name'])) {
        $fileName3 = time() . '_3_' . basename($_FILES['uploadFile3']['name']);
        if (move_uploaded_file($_FILES['uploadFile3']['tmp_name'], $targetDir . $fileName3)) {
            $uploadedFile3 = $fileName3;
        }
    }

    // Save to database
    $sql = "INSERT INTO tbl_save_aliance_mail_files 
            SET frid='$frid', files='$uploadedFile1', files2='$uploadedFile2', files3='$uploadedFile3',
            month='$month', year='$year', createddate='$createddate'";
    $conn->query($sql);

    echo "<script>window.location.href='../../../thankyou.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Invoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body { background-color: #f8f9fa; }
    .upload-card {
      max-width: 600px;
      margin: 60px auto;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      background-color: #fff;
    }
    .form-title {
      font-weight: bold;
      font-size: 1.5rem;
      color: #e50a80;
      margin-bottom: 20px;
      text-align: center;
    }
    .preview-container { margin-top: 15px; }
    .preview-img {
      max-width: 100%;
      border-radius: 10px;
      display: none;
    }
    .pdf-viewer {
      width: 100%;
      height: 300px;
      border: 1px solid #ccc;
      border-radius: 10px;
      display: none;
    }
    .file-info { margin-top: 10px; display: none; }
  </style>
</head>
<body>

<div class="upload-card">
  <div class="form-title">📄 Upload Invoices</div>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="frid" value="<?php echo $FrId; ?>">
    <input type="hidden" name="month" value="<?php echo $month; ?>">
    <input type="hidden" name="year" value="<?php echo $year; ?>">

    <div class="mb-3">
      <label class="form-label">Outlet Name</label>
      <input type="text" class="form-control" value="<?php echo $row['ShopName']; ?>" disabled>
    </div>

    <div class="mb-3">
      <label class="form-label">Month/Year</label>
      <input type="text" class="form-control" value="<?php echo $month . "/" . $year; ?>" disabled>
    </div>

    <div class="mb-3">
      <label class="form-label">Upload Invoice 1</label>
      <input class="form-control" type="file" id="uploadFile1" name="uploadFile" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Upload Invoice 2</label>
      <input class="form-control" type="file" id="uploadFile2" name="uploadFile2" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Upload Invoice 3</label>
      <input class="form-control" type="file" id="uploadFile3" name="uploadFile3" required>
    </div>

    <div class="preview-container" id="previewContainer">
      <img id="imgPreview" class="preview-img" />
      <iframe id="pdfPreview" class="pdf-viewer"></iframe>
      <div class="file-info" id="docInfo">
        📄 <span id="fileName"></span>
      </div>
    </div>

    <div class="d-grid mt-3">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>

<script>
  const inputs = ['uploadFile1', 'uploadFile2', 'uploadFile3'];

  inputs.forEach((inputId) => {
    const fileInput = document.getElementById(inputId);
    const imgPreview = document.getElementById('imgPreview');
    const pdfPreview = document.getElementById('pdfPreview');
    const docInfo = document.getElementById('docInfo');
    const fileNameSpan = document.getElementById('fileName');

    fileInput.addEventListener('change', function () {
      const file = this.files[0];

      imgPreview.style.display = 'none';
      pdfPreview.style.display = 'none';
      docInfo.style.display = 'none';

      if (file) {
        const fileType = file.type;
        const fileURL = URL.createObjectURL(file);
        const extension = file.name.split('.').pop().toLowerCase();

        if (fileType.startsWith("image/")) {
          imgPreview.src = fileURL;
          imgPreview.style.display = 'block';
        } else if (fileType === "application/pdf") {
          pdfPreview.src = fileURL;
          pdfPreview.style.display = 'block';
        } else if (extension === "doc" || extension === "docx") {
          fileNameSpan.textContent = file.name;
          docInfo.style.display = 'block';
        } else {
          fileNameSpan.textContent = "Unsupported file format.";
          docInfo.style.display = 'block';
        }
      }
    });
  });
</script>

</body>
</html>
