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
                        $prod_id = $_GET['pid'];
                            $sql = "SELECT id,ShopName,Phone,Address FROM tbl_users WHERE Roll=5 AND FIND_IN_SET('$prod_id', AllocateRawProd) > 0 ORDER BY ShopName ASC";
                            $row = getList($sql);
                            foreach($row as $result){
                                $sql2 = "SELECT sum(creditqty) AS creditqty,sum(debitqty) AS debitqty,sum(creditqty)-sum(debitqty) AS balqty FROM 
                                (SELECT (case when Status='Dr' then sum(Qty2) else '0' end) as debitqty,(case when Status='Cr' then sum(Qty2) else '0' end) as creditqty 
                                FROM `tbl_cust_prod_stock_2025` WHERE UserId='".$result['id']."' AND ProdId='$prod_id' AND ProdType=1 GROUP by Status) as a";
                                $row2 = getRecord($sql2);
                                
                                if($result['Unit']!='Pieces'){
                                $creditqty = ($row2['creditqty']/1000);
                                $debitqty = ($row2['debitqty']/1000);
                                $balqty = ($row2['balqty']/1000);
                                
                            }
                            else{
                                $creditqty = $row2['creditqty'];
                                $debitqty = $row2['debitqty'];
                                $balqty = $row2['balqty'];
                            }
	                            
	                     
                            ?>
                        <div class="card mb-4">
                        
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1" style="color: dodgerblue;"><?php echo $result['ShopName'];?> </h5>
                                     <p class="text-secondary"><strong>Contact No : </strong><?php echo $result['Phone'];?><br>
                                     <strong>Address : </strong><?php echo $result['Address'];?><br>
                                     <strong style="color: red;padding: 2px 6px;border-radius: 4px;">Available Stock : <?php echo $balqty." ".$_GET['Unit'];?></strong> | 
                                     <strong style="color: blue;padding: 2px 6px;border-radius: 4px;">Total Use : <?php echo $debitqty." ".$_GET['Unit'];?></strong>
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
