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
    <link rel="stylesheet" href="videoplayercss/css/plyr.css">
  
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
    <main class="flex-shrink-0 main">
        <?php include_once 'back-header.php'; ?> 
        <div class="main-container">
            
            <div class="container mb-4">
               
               
                <div class="row" style="padding-left:10px;padding-right:10px;">
                  
                  
                    <video controls crossorigin playsinline poster="<?php echo $SiteUrl;?>/uploads/<?php echo $row['Photo']; ?>" id="player">
						
							<source src="../videos/v1.mp4" type="video/mp4" size="576">
							<source src="../videos/v1.mp4" type="video/mp4" size="720">
							<source src="../videos/v1.mp4" type="video/mp4" size="1080">

						
							<track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
							    default>
							<track kind="captions" label="Français" srclang="fr" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">

						
						</video>
						
						
						<video controls crossorigin playsinline poster="<?php echo $SiteUrl;?>/uploads/<?php echo $row['Photo']; ?>" id="player">
						
							<source src="../videos/v2.mp4" type="video/mp4" size="576">
							<source src="../videos/v2.mp4" type="video/mp4" size="720">
							<source src="../videos/v2.mp4" type="video/mp4" size="1080">

						
							<track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
							    default>
							<track kind="captions" label="Français" srclang="fr" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">

						
						</video>
                    
                    
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
<script src="videoplayercss/js/owl.carousel.min.js"></script>

	<script src="videoplayercss/js/select2.min.js"></script>

	<script src="videoplayercss/js/plyr.min.js"></script>
	<script src="videoplayercss/js/main.js"></script>
</body>
</html>
