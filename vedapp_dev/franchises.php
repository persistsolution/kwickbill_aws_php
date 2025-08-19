<?php session_start();
require_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['User']['id'];
$PageName = "Franchises";
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <?php include_once 'back-header.php'; ?>

        <!-- page content start -->


        <div class="main-container">
             <div class="container">
               
                        <!-- 🔍 Search box -->
    <input type="text" id="searchFranchise" class="form-control mb-3" placeholder="Search Franchise by Name...">

    <?php 
    $sql2 = "SELECT GROUP_CONCAT(DISTINCT(FrId)) AS FrId 
             FROM `tbl_customer_invoice_details_2025` 
             WHERE MainProdId IN ($AllocateProd)";
    $row2 = getRecord($sql2);
    $FrId = $row2['FrId'];

    $sql = "SELECT tu.ShopName,tu.Phone,tu.Address,tu.id 
            FROM tbl_users_bill tu 
            WHERE tu.Roll=5 
              AND tu.ShopName!='' 
              AND tu.id IN($FrId) 
            ORDER BY tu.ShopName ASC";
    $row = getList($sql);
    foreach($row as $result){ ?>
        <div class="card mb-4 franchise-card">
            <a href="view-products.php?frid=<?php echo $result['id'];?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="mb-1 franchise-name" style="color: dodgerblue;">
                                <?php echo $result['ShopName'];?> 
                            </h5>
                            <p class="text-secondary">
                                <strong>Contact No : </strong><?php echo $result['Phone'];?><br>
                                <strong>Address : </strong><?php echo $result['Address'];?><br>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
                        
             

            </div>
        </div>
    </main>
<br><br><br><br>
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
    function getExpId(id){
        $('#myModal').modal('show');
        $('.Exp_Id').val(id);
    }
    
    document.getElementById('searchFranchise').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let cards = document.getElementsByClassName('franchise-card');
    
    Array.from(cards).forEach(function(card) {
        let name = card.querySelector('.franchise-name').textContent.toLowerCase();
        if (name.includes(filter)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
   
</body>

</html>
