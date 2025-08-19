<?php session_start();
require_once 'config.php';
$user_id = $_SESSION['User']['id'];
$PageName = "Company Policy";
$Page = "Recharge";
$WallMsg = "NotShow"; ?>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <?php include_once 'back-header.php'; ?>

        <!-- page content start -->

 <style>
#accordion .card {
    margin-bottom: 15px; /* gap between cards */
    border-radius: 12px;
    overflow: hidden;
}
</style>
        <div class="main-container">
            <div class="container">
 <div id="accordion" class="accordion">
  <?php 
    $sql = "SELECT * FROM tbl_company_policy WHERE Status='1' ORDER BY id DESC";
    $row = getList($sql);
    $index = 0;
    foreach ($row as $result) {
        $index++;
  ?>
  <div class="card shadow-sm mb-3 border-0">
    <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
      <a class="btn text-white fw-bold <?php echo $index > 1 ? 'collapsed' : ''; ?>" 
         data-bs-toggle="collapse" 
         href="#collapse<?php echo $index; ?>" 
         style="text-decoration:none;">
        <i class="bi bi-file-text me-2"></i> <?php echo $result['Title'];?>
      </a>
      <i class="bi bi-chevron-down"></i>
    </div>
    <div id="collapse<?php echo $index; ?>" 
         class="collapse <?php echo $index == 1 ? 'show' : ''; ?>" 
         data-bs-parent="#accordion">
      <div class="card-body p-4">
        <p class="mb-3 text-secondary">
          <?php echo nl2br($result['Details']);?>
        </p> 
        <?php if (!empty($result['Pdf'])) { ?>
          <!-- PDF Viewer -->
          <!--<div class="ratio ratio-16x9 border rounded shadow-sm">
            <iframe src="../company_policy/<?php echo $result['Pdf'];?>" 
                    style="border:0;" 
                    allowfullscreen></iframe>
          </div>-->
          <div class="mt-2">
            <a href="javascript:void()" onclick="openPdf('https://kwickfoods.in/company_policy/<?php echo $result['Pdf'];?>')"
               class="btn btn-outline-primary btn-sm">
              <i class="bi bi-file-earmark-pdf"></i> View Pdf
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>
</div>




                       

       

            </div>
        </div>
    </main>

<?php include 'footer.php';?>
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
    function openPdf(url){
        Android.onClickPdfReportView(''+url+'');
    }
</script>
</body>

</html>
