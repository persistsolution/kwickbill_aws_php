<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Add Checklist";
$UserId = $_SESSION['User']['id']; 
?>
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
</head>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
     // Define the upload directory
    $targetDir = "../fuelimage/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); // Create directory if it doesn't exist
    }

    // Process each uploaded file
    $uploadOk = 1;
    $messages = [];
    foreach ($_FILES['photos']['name'] as $key => $name) {
        $targetFile = $targetDir . basename($name);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is a valid image
        $validFormats = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $validFormats)) {
            $messages[] = "File $name is not a valid image format.";
            $uploadOk = 0;
            continue;
        }

        // Check for upload errors
        if ($_FILES['photos']['error'][$key] !== UPLOAD_ERR_OK) {
            $messages[] = "Error uploading file $name.";
            $uploadOk = 0;
            continue;
        }

        // Move the file to the target directory
        if ($uploadOk === 1) {
            if (move_uploaded_file($_FILES['photos']['tmp_name'][$key], $targetFile)) {
                //$filename = $_FILES['photos']['name'][$key];
                $sql = "INSERT INTO tbl_fuel_checklist_images SET userid='$UserId',postid='$id',filename='$name',roll=1";
                $conn->query($sql);
                $messages[] = "File $name has been uploaded successfully.";
            } else {
                $messages[] = "Error moving file $name.";
            }
        }
    }

    // Display messages
    foreach ($messages as $message) {
        //echo $message . "<br>";
    }
    
    if(isset($_FILES['video']['name'])){
    // Define the upload directory
    $targetDir = "../fuelvideos/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); // Create directory if it doesn't exist
    }

    // Handle the uploaded video
    $targetFile = $targetDir . basename($_FILES['video']['name']);
    $uploadOk = 1;
    $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is a valid video format
    $validFormats = ['mp4', 'avi', 'mov', 'wmv'];
    if (!in_array($videoFileType, $validFormats)) {
        //echo "Sorry, only MP4, AVI, MOV, and WMV files are allowed.";
        $uploadOk = 0;
    }

    // Check for upload errors
    if ($_FILES['video']['error'] !== UPLOAD_ERR_OK) {
        //echo "Error uploading file.";
        $uploadOk = 0;
    }

    // Proceed with upload
    if ($uploadOk === 1) {
        if (move_uploaded_file($_FILES['video']['tmp_name'], $targetFile)) {
            $name2 = $_FILES['video']['name'];
        $sql = "INSERT INTO tbl_fuel_checklist_images SET userid='$UserId',postid='$id',filename='$name2',roll=2";
                $conn->query($sql);
         } else {
            //echo "Sorry, there was an error uploading your video.";
        }
    }
} else {
    //echo "Invalid request.";
}

?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript">
        setTimeout(function () { 
            swal({
                title: "Thank you",
                text: "Photos & Video Successfully has been uploaded successfully.",
                type: "success",
                confirmButtonText: "OK"
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "view-checklist.php";
                }
            }); 
        }, 500);
    </script>
           
        <?php
}
?>

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
    
   
</body>

</html>
