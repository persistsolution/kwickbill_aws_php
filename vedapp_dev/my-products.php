<?php session_start();
require_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['User']['id'];
$PageName = "My Products";
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
                        if($AllocateProd!=''){
                             $sql = "SELECT id,ProductName FROM tbl_cust_products2 WHERE id IN ($AllocateProd) ORDER BY ProductName ASC";
                            $row = getList($sql);
                            foreach($row as $result){
                                $sql2 = "SELECT count(*) AS TotFr FROM tbl_cust_products_2025 WHERE ProdId='".$result['id']."' AND delete_flag=0 AND ProdType=0 AND checkstatus=1";
                                $row2 = getRecord($sql2);
                                
                                $sql3 = "SELECT SUM(Qty) AS TotQty FROM tbl_customer_invoice_details_2025 WHERE MainProdId='".$result['id']."'";
                                $row3 = getRecord($sql3);
                            ?>
                        <div class="card mb-4">
                            <a href="view-franchise.php?pid=<?php echo $result['id'];?>&type=mrp">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1"><?php echo $result['ProductName'];?> </h5>
                                     <p class="text-secondary">Total Franchise : <?php echo $row2['TotFr'];?> | Total Sell : <?php echo $row3['TotQty'];?></p>

                                    </div>
                                   
                                </div>
                               
                            </div></a>
                        </div>
                         <?php }} if($AllocateRawProd!=''){ 
                             
                         $sql = "SELECT id,ProductName,Unit FROM tbl_cust_products2 WHERE id IN ($AllocateRawProd) ORDER BY ProductName ASC";
                            $row = getList($sql);
                            foreach($row as $result){
                                $prod_id = $result['id'];
                                $sql4 = "SELECT count(*) AS TotFr FROM tbl_users WHERE Roll=5 AND FIND_IN_SET('$prod_id', AllocateRawProd) > 0";
                                $row4 = getRecord($sql4);
                                
                                $sql2 = "SELECT sum(creditqty) AS creditqty,sum(debitqty) AS debitqty,sum(creditqty)-sum(debitqty) AS balqty FROM 
                                (SELECT (case when Status='Dr' then sum(Qty2) else '0' end) as debitqty,(case when Status='Cr' then sum(Qty2) else '0' end) as creditqty 
                                FROM `tbl_cust_prod_stock_2025` WHERE ProdId='".$result['id']."' AND ProdType=1 GROUP by Status) as a";
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
                            
                            $sql3 = "SELECT * FROM tbl_units WHERE Name='".$result['Unit']."'";
                            $row3 = getRecord($sql3);
                            
                            ?>
                        <div class="card mb-4">
                            <a href="view-raw-franchise.php?pid=<?php echo $result['id'];?>&Unit=<?php echo $row3['Name2'];?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1"><?php echo $result['ProductName'];?> </h5>
                                     <p class="text-secondary">Total Franchise : <?php echo $row4['TotFr'];?> | Total Use : <?php echo $balqty." ".$row3['Name2'];?></p>

                                    </div>
                                   
                                </div>
                               
                            </div></a>
                        </div>
                         <?php }}
                         
                         else { ?>
                         
                         <!--<h3 style="color:red;">Product Not Allocated....</h3>-->
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
