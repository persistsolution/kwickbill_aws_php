<?php session_start();
$sessionid = session_id();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Home";


$user_id = $_SESSION['User']['id'];
$uid = $_REQUEST['uid']; 
if($_REQUEST['uid'] == ''){
$sql11 = "SELECT * FROM tbl_users WHERE id='$user_id'";
$row = getRecord($sql11);
$_SESSION['User'] = $row;
}   
else{
$sql11 = "SELECT * FROM tbl_users WHERE id='$uid'";
$row = getRecord($sql11);
$_SESSION['User'] = $row;
}
/*if($row['Roll'] == 55){
  echo "<script>window.location.href='../custapp/home.php';</script>";
    exit();
}
if($row['Roll'] == 5){
  echo "<script>window.location.href='../mobapp/home.php';</script>";
    exit();
}*/

if($row['Roll'] == 5){
    echo "<script>window.location.href='../mobapp/home.php';</script>";
    exit();
}
else if($row['Roll'] == 55){
    echo "<script>window.location.href='../custapp/home.php';</script>";
    exit();
}
else if($row['Roll'] == 6){
    echo "<script>window.location.href='../exeapp/home.php';</script>";
    exit();
}
else{
    
}

// if($row['KycStatus'] != 1){
//  echo "<script>window.location.href='../mobapp/kyc-form.php';</script>";
//     exit();
// }

$Roll = $row['Roll'];
$names = array('9', '22', '23');
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
    <link rel="manifest" href="manifest.json" />

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
    <link rel="stylesheet" href="dist/css/styles.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
   
</head>
<div class="container-fluid h-100 loader-display">
        <div class="row h-100">
            <div class="align-self-center col">
                <div class="logo-loading">
                    <div class="icon  ">
                        <img src="logo33.png" alt="">
                    </div><br>
                    <div class="loader-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="shop">
    
    
    <?php include_once 'sidebar.php'; ?>

    <!-- Begin page content -->
   <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
      <?php include_once 'top_header.php'; ?>

 

        <div class="main-container  text-center" style="background-color:#fff;">

          
            
          
           
            <div class="container mb-4">
                <div class="">
                    <div class=" text-center ">
                        <div class="row justify-content-equal no-gutters mt-4">
                         
                            
 <a href="view-expenses.php">
                            <div class="col-4 col-md-2 mb-3">
                               
                                    <div class="avatar avatar-60 mb-1 rounded">
                                        <div class="background">
                                           
                                            
                                            <img src="icons/8.jpg" alt="">
                                          
                                        </div>
                                    </div>
                                
                                <a href="view-expenses.php"><p class="text-secondary"><small style="font-size: 12px;
font-weight: 700;
font-family: Sans-serif;
text-transform: uppercase;
color:#000;">My Expenses</small></p></a>
                            </div></a>
                            
                           <a href="add-expenses.php">
                            <div class="col-4 col-md-2 mb-3">
                                
                                    <div class="avatar avatar-60 mb-1 rounded">
                                        <div class="background">
                                           
                                            
                                            <img src="icons/7.jpg" alt="">
                                          
                                        </div>
                                    </div>
                               
                             <p class="text-secondary"><small style="font-size: 12px;
font-weight: 700;
font-family: Sans-serif;
text-transform: uppercase;
color:#000;">Add Expense</small></p></a>
</div></a>

<a href="view-invoice.php">
                            <div class="col-4 col-md-2 mb-3">
                                
                                    <div class="avatar avatar-60 mb-1 rounded">
                                        <div class="background">
                                           
                                            
                                            <img src="icons/7.jpg" alt="">
                                          
                                        </div>
                                    </div>
                               
                             <p class="text-secondary"><small style="font-size: 12px;
font-weight: 700;
font-family: Sans-serif;
text-transform: uppercase;
color:#000;">Vendor Payments</small></p></a>
</div></a>

<a href="my-products.php">
                            <div class="col-4 col-md-2 mb-3">
                                
                                    <div class="avatar avatar-60 mb-1 rounded">
                                        <div class="background">
                                           
                                            
                                            <img src="icons/product.png" alt="">
                                          
                                        </div>
                                    </div>
                               
                             <p class="text-secondary"><small style="font-size: 12px;
font-weight: 700;
font-family: Sans-serif;
text-transform: uppercase;
color:#000;">My Products</small></p></a>
</div></a>

<a href="franchises.php">
                            <div class="col-4 col-md-2 mb-3">
                                
                                    <div class="avatar avatar-60 mb-1 rounded">
                                        <div class="background">
                                           
                                            
                                            <img src="icons/franchise.jpg" alt="">
                                          
                                        </div>
                                    </div>
                               
                             <p class="text-secondary"><small style="font-size: 12px;
font-weight: 700;
font-family: Sans-serif;
text-transform: uppercase;
color:#000;">Franchise</small></p></a>
</div></a>

<a href="view-orders.php">
                            <div class="col-4 col-md-2 mb-3">
                                
                                    <div class="avatar avatar-60 mb-1 rounded">
                                        <div class="background">
                                           
                                            
                                            <img src="icons/orders.webp" alt="">
                                          
                                        </div>
                                    </div>
                               
                             <p class="text-secondary"><small style="font-size: 12px;
font-weight: 700;
font-family: Sans-serif;
text-transform: uppercase;
color:#000;">My Orders</small></p></a>
</div></a>
                            
                          <div class="col-4 col-md-2 mb-3">
                                <a href="javascript:void(0)" onclick="logout()">
                                    <div class="avatar avatar-60 mb-1 rounded">
                                        <div class="background">
                                           
                                            
                                            <img src="icons/logout.jpg" alt="">
                                          
                                        </div>
                                    </div>
                                </a>
                              <p class="text-secondary"><small style="font-size: 12px;
font-weight: 700;
font-family: Sans-serif;
text-transform: uppercase;
color:#000;">Logout</small></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <br><br>
              
 
    </main>

    <!-- footer-->
  <?php include_once 'footer.php'; ?>


<script src="dist/aos.js"></script>
    <script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>


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

    <!-- PWA app service registration and works -->
    <script src="js/pwa-services.js"></script>

    <!-- page level custom script -->
    <script src="js/app.js"></script>

   
</body>

</html>
