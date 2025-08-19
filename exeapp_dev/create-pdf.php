<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Add Checklist";
$UserId = $_SESSION['User']['id']; ?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?php echo $Proj_Title; ?></title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
    <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
    <link href="css/toastr.min.css" rel="stylesheet">
    <script src="js/jquery.min3.5.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">

<style>
    .form-group {
        font-family: Arial, sans-serif;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .custom-file-upload {
        position: relative;
        margin-top: 10px;
    }

    .custom-upload-label {
        display: inline-block;
        padding: 12px 25px;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        border-radius: 50px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        font-size: 16px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .custom-upload-label:hover {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
        transform: scale(1.05);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .custom-upload-label.video {
        background: linear-gradient(135deg, #11998e, #38ef7d);
    }

    .custom-upload-label.video:hover {
        background: linear-gradient(135deg, #38ef7d, #11998e);
        transform: scale(1.05);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .custom-file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .fa-cloud-upload,
    .fa-video {
        margin-right: 8px;
    }

    .file-info {
        margin-top: 10px;
        font-size: 14px;
        color: #555;
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .file-info ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .file-info ul li {
        margin-bottom: 5px;
    }

    .file-info ul li span {
        font-weight: bold;
        color: #333;
    }

    #loading {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 1000;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #000;
        line-height: 100vh;
    }

    #progress-container {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 1001;
    }

    #progress-bar {
        width: 300px;
        height: 20px;
        background: #f3f3f3;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    #progress-bar div {
        height: 100%;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        width: 0;
    }

    #progress-text {
        font-size: 16px;
        font-weight: bold;
    }

    .screen-blur {
        filter: blur(5px);
        pointer-events: none;
    }
</style>

<div id="progress-container">
    <h3>Data Uploading Please Wait</h3>
    <div id="progress-bar">
        <div></div>
    </div>
    <div id="progress-text">0%</div>
</div>

<main class="flex-shrink-0 main">
    <?php include_once 'back-header.php'; ?>

    <div class="main-container" id="main-content">
        <div class="container">
            <div class="card">
                <form id="uploadForm" action="upload.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">

                        <div class="form-group col-md-12">
                            <label class="form-label">Upload Photos</label>
                            <div class="custom-file-upload">
                                <label for="photos" class="custom-upload-label">
                                    <i class="fa fa-cloud-upload"></i> Select Photos
                                </label>
                                <input type="file" name="photos[]" accept=".png" multiple id="photos" class="custom-file-input">
                            </div>
                            <div id="photo-info" class="file-info"></div>
                        </div>

                      
                    </div>

                  

                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="button" onclick="convertToPDF()">Convert to PDF</button>
                    </div>
                </form>
                
                 <br><br>
  <iframe id="pdfViewer" width="100%" height="600px" style="display:none;"></iframe>
  
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>

<!-- Required jquery and libraries -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- cookie js -->
<script src="js/jquery.cookie.js"></script>

<!-- Swiper slider  js-->
<script src="vendor/swiper/js/swiper.min.js"></script>

<!-- Customized jquery file  -->
<script src="js/main.js"></script>
<script src="js/color-scheme-demo.js"></script>

<!-- page level custom script -->
<script src="js/app.js"></script>

<script>
    const uploadForm = document.getElementById('uploadForm');
    const progressContainer = document.getElementById('progress-container');
    const progressBar = document.querySelector('#progress-bar div');
    const progressText = document.getElementById('progress-text');
    const mainContent = document.getElementById('main-content');
    const submitButton = document.getElementById('submit');

  

    document.getElementById('photos').addEventListener('change', function (event) {
        const fileList = event.target.files;
        const infoDiv = document.getElementById('photo-info');
        if (fileList.length > 0) {
            const fileDetails = Array.from(fileList).map(file => `<li><span>${file.name}</span> - ${(file.size / 1024).toFixed(2)} KB</li>`).join('');
            infoDiv.innerHTML = `<ul>${fileDetails}</ul>`;
        } else {
            infoDiv.innerHTML = '';
        }
    });


    
    
    async function convertToPDF() {
      const input = document.getElementById('photos');
      const files = input.files;

      if (files.length === 0) return alert("Please upload at least one image.");

      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF();

      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const imgData = await readFileAsDataURL(file);
        const img = new Image();
        img.src = imgData;

        await new Promise(resolve => {
          img.onload = () => {
            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();

            let imgWidth = img.width;
            let imgHeight = img.height;

            // Calculate scaling
            const widthScale = pageWidth / imgWidth;
            const heightScale = pageHeight / imgHeight;
            const scale = Math.min(widthScale, heightScale);

            const finalWidth = imgWidth * scale;
            const finalHeight = imgHeight * scale;

            // Center image
            const x = (pageWidth - finalWidth) / 2;
            const y = (pageHeight - finalHeight) / 2;

            if (i !== 0) pdf.addPage();
            pdf.addImage(imgData, 'JPEG', x, y, finalWidth, finalHeight);
            resolve();
          };
        });
      }

      // Save to user's device
      pdf.save("pdffiles/converted-images.pdf");

      // Upload to server
      const pdfBlob = pdf.output("blob");
      const formData = new FormData();
      formData.append("file", pdfBlob, "converted-images.pdf");

      fetch("uploadmultphotos.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        // alert("PDF uploaded successfully.");
        const viewer = document.getElementById('pdfViewer');
        viewer.src = "pdffiles/converted-images.pdf";  // show uploaded PDF
        viewer.style.display = 'block';
      })
      .catch(error => {
        console.error("Upload Error:", error);
        alert("PDF upload failed.");
      });
    }

    function readFileAsDataURL(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
        reader.readAsDataURL(file);
      });
    }
</script>

</body>

</html>
