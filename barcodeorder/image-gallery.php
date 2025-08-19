<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Gallery";
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
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
    <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" id="style">
  
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="productdetails">
    <main class="flex-shrink-0 main">
        <?php include_once 'back-header.php'; ?> 
        <div class="main-container">
            
            <div class="container mb-4">
               
                <div class="card">
                <div class="card-body">
                    <!-- Swiper -->
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
                             <?php 
                                 $id = $_GET['id'];
                                  $sql2 = "SELECT * FROM tbl_image_gallery";
                                  $res2 = $conn->query($sql2);
                                  $rncnt = mysqli_num_rows($res2);
                                  if($rncnt > 0){
                                    while($row2 = $res2->fetch_assoc()){?>
                            <div class="swiper-slide has-background">
                                <div class="background">
                                    <img src="../uploads/<?php echo $row2['Photo'];?>" alt="">
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            <?php 
                                 $id = $_GET['id'];
                                  $sql2 = "SELECT * FROM tbl_image_gallery";
                                  $res2 = $conn->query($sql2);
                                  $rncnt = mysqli_num_rows($res2);
                                  if($rncnt > 0){
                                    while($row2 = $res2->fetch_assoc()){?>
                            <div class="swiper-slide has-background">
                                <div class="background">
                                    <img src="../uploads/<?php echo $row2['Photo'];?>" alt="">
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>

                </div>
            </div>
          

            </div>

        </div>
    </main>
 <?php include_once 'footer.php'; ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="vendor/swiper/js/swiper.min.js"></script>
<script src="js/main.js"></script>
<script src="js/color-scheme-demo.js"></script>
<script src="js/app.js"></script>

<script type="text/javascript">
     function onDownloadFileFromUrl(url,filename,Download){
         
            Android.onDownloadFileFromUrl(''+url+'',''+filename+'');
        
    }
</script>
</body>
</html>
