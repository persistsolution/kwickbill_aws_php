<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "MahaTube";
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

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
    <main class="flex-shrink-0 main">
        <?php include_once 'back-header.php'; ?> 
        <div class="main-container">
            
            <div class="container mb-4">
               
                <div class="row">
                    <?php 
            $i=1;
            $sql3 = "SELECT * FROM tbl_video_gallery WHERE Status=1 AND VideoFor IN (4,3)";
                   $rncnt2 = getRow($sql3);
                   if($rncnt2 > 0){
                    $res2 = getList($sql3);
                    foreach($res2 as $row){ 
                         $url =  $SiteUrl.'videos/'.$row["Name"];
                        ?>
                    <div class="col-12 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                
						<iframe width="100%" height="200" src="https://www.youtube.com/embed/<?php echo $row["Name"]; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="allowfullscreen"
        mozallowfullscreen="mozallowfullscreen" 
        msallowfullscreen="msallowfullscreen" 
        oallowfullscreen="oallowfullscreen" 
        webkitallowfullscreen="webkitallowfullscreen"></iframe>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <?php } } else{?>
                        <h3 style="color:grey;padding-left: 10px;font-size: 15px;">No Videos Found</h3>
                    <?php } ?>
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

</body>
</html>
