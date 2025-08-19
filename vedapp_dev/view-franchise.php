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
               
                        <?php 
                            $sql = "SELECT tu.ShopName,tu.Phone,tu.Address,tp.id,tu.id AS FrId FROM tbl_cust_products_2025 tp INNER JOIN tbl_users_bill tu ON tu.id=tp.CreatedBy WHERE tp.ProdId='".$_GET['pid']."' AND tp.checkstatus=1 AND tp.delete_flag=0 ORDER BY tu.ShopName ASC";
                            $row = getList($sql);
                            foreach($row as $result){
                                $sql2 = "SELECT IFNULL(sum(creditqty)-sum(debitqty),0) AS balqty FROM (SELECT (case when Status='Dr' then sum(Qty) else '0' end) as debitqty,
                                (case when Status='Cr' then sum(Qty) else '0' end) as creditqty FROM `tbl_cust_prod_stock_2025` WHERE ProdId='".$result['id']."' 
                                GROUP by Status) as a";
	                            $row2 = getRecord($sql2);
	                            
	                            $sql3 = "SELECT IFNULL(SUM(Qty),0) AS TotQty FROM tbl_customer_invoice_details_2025 WHERE MainProdId='".$_GET['pid']."' AND FrId='".$result['FrId']."'";
                                $row3 = getRecord($sql3);
                            ?>
                        <div class="card mb-4">
                        
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1" style="color: dodgerblue;"><?php echo $result['ShopName'];?> </h5>
                                     <p class="text-secondary"><strong>Contact No : </strong><?php echo $result['Phone'];?><br>
                                     <strong>Address : </strong><?php echo $result['Address'];?><br>
                                     <strong style="color: red;padding: 2px 6px;border-radius: 4px;">Available Stock : <?php echo $row2['balqty'];?></strong> | 
                                     <strong style="color: blue;padding: 2px 6px;border-radius: 4px;">Total Sell : <?php echo $row3['TotQty'];?></strong>

<style>@keyframes blink { 0%   { opacity: 1; } 50%  { opacity: 0; } 100% { opacity: 1; }}</style>
                                     </p>

                                    </div>
                                   
                                </div>
                               
                            </div>
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
</script>
   
</body>

</html>
