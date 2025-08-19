<?php session_start();
$sessionid = session_id();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Home";
$url = "home.php";
$user_id = $_SESSION['User']['id'];
$uid = $_REQUEST['uid']; 
if($_REQUEST['uid'] == ''){
$sql11 = "SELECT * FROM tbl_users_bill WHERE id='$user_id'";
$row = getRecord($sql11);
$_SESSION['User'] = $row;
}   
else{
$sql11 = "SELECT * FROM tbl_users_bill WHERE id='$uid'";
$row = getRecord($sql11);
$_SESSION['User'] = $row;
}
//echo $sql11;
$Roll = $row['Roll'];
if($Roll == 5){
    $BillSoftFrId = $row['id'];
}
else if($Roll != 5){
    $BillSoftFrId = $row['BillSoftFrId'];
}
else{
    $BillSoftFrId = 0;
}

if($Roll == 5){
    echo "<script>window.location.href='../billsoftmobappfr/home.php?frid=$BillSoftFrId';</script>";exit();
}
else if($BillSoftFrId!=0){
    echo "<script>window.location.href='../billsoftmobappfr/home.php?frid=$BillSoftFrId';</script>";exit();
}
if($_REQUEST['frid']!=''){
    $_SESSION['FranchiseId'] = $_REQUEST['frid'];
}
$FranchiseId = $_SESSION['FranchiseId'];
$sql55 = "SELECT * FROM tbl_users WHERE id='$FranchiseId'";
$row55 = getRecord($sql55);
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Maha Buddy</title>

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
 
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">

 <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">
   
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="shop">
    <!-- screen loader -->
   

    <!-- menu main -->
    <?php include_once 'sidebar.php';?>
    <div class="backdrop"></div>


    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
       <?php include 'top_header.php';?>

<?php if($_GET['ownfr']==''){
    $ownfr = 1;
}
else{
     $ownfr = $_GET['ownfr'];
}
?>
     

        <!-- page content start -->

        <div class="main-container" style="padding-top: 80px;">

            <div class="container">
               

<?php 

function countval($val,$frid,$Calendar){
        global $conn; 
   
    if($val == 'cash_payment'){
        $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice_2025 WHERE Roll=2 AND FrId='$frid' AND PayType='Cash'";
    }
    if($val == 'upi_payment'){
        $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice_2025 WHERE Roll=2 AND FrId='$frid' AND PayType IN ('Phone Pay','Paytm','UPI','Other UPI')";
    }
    
   if($Calendar == 'yesterday'){
            $Yesterday = date('Y-m-d',strtotime("-1 days"));
            $sql.=" AND InvoiceDate='$Yesterday'";
        }

        else if($Calendar == 'week'){
            $Week = date('Y-m-d',strtotime("-7 days"));
            $sql.=" AND InvoiceDate>='$Week' AND InvoiceDate<='".date('Y-m-d')."'";
        }
        else if($Calendar == 'month'){
            //$Week = date('Y-m-d',strtotime("-30 days"));
            $Week = date('Y-m')."-01";
            $sql.=" AND InvoiceDate>='$Week' AND InvoiceDate<='".date('Y-m-d')."'";
        }
        else if($Calendar == 'Custom'){
        if($_REQUEST['FromDate']){
                $FromDate = $_REQUEST['FromDate'];
                $sql.= " AND InvoiceDate>='$FromDate'";
            }
            if($_REQUEST['ToDate']){
                $ToDate = $_REQUEST['ToDate'];
                $sql.= " AND InvoiceDate<='$ToDate'";
            }
        }
        else{
           $sql.=" AND InvoiceDate='".date('Y-m-d')."'"; 
        }
     $res2 = $conn->query($sql);
    $row2 = $res2->fetch_assoc();
    return $row2['result'];
    }
    
$Calendar = $_REQUEST['calendar'];
 $sql = "SELECT SUM(NetAmount) AS NetAmount,COUNT(*) AS TotInv,tc.FrId,tu.ShopName,tu.Address FROM tbl_customer_invoice_2025 tc INNER JOIN tbl_users_bill tu ON tu.id=tc.FrId WHERE tu.Roll='5'";
if($Roll != 1){
    if($CocoFranchiseAccess != '' || $CocoFranchiseAccess != 0){
    $sql.=" AND tu.id IN ($CocoFranchiseAccess)";
    }
}
//echo $sql;

if($Calendar == 'yesterday'){
            $Yesterday = date('Y-m-d',strtotime("-1 days"));
            $sql.=" AND tc.InvoiceDate='$Yesterday'";
        }

        else if($Calendar == 'week'){
            $Week = date('Y-m-d',strtotime("-7 days"));
            $sql.=" AND tc.InvoiceDate>='$Week' AND tc.InvoiceDate<='".date('Y-m-d')."'";
        }
        else if($Calendar == 'month'){
            //$Week = date('Y-m-d',strtotime("-30 days"));
            $Week = date('Y-m')."-01";
            $sql.=" AND tc.InvoiceDate>='$Week' AND tc.InvoiceDate<='".date('Y-m-d')."'";
        }
        else if($Calendar == 'Custom'){
        if($_REQUEST['FromDate']){
                $FromDate = $_REQUEST['FromDate'];
                $sql.= " AND tc.InvoiceDate>='$FromDate'";
            }
            if($_REQUEST['ToDate']){
                $ToDate = $_REQUEST['ToDate'];
                $sql.= " AND tc.InvoiceDate<='$ToDate'";
            }
        }
        else{
           $sql.=" AND tc.InvoiceDate='".date('Y-m-d')."'"; 
        }
        
$sql.=" GROUP BY tc.FrId  ORDER BY NetAmount DESC";
$row = getList($sql);
 foreach($row as $result){
     
    $NetAmount2 = $result['NetAmount'];
   if($NetAmount2 > 0){
       $NetAmount = $result['NetAmount'];
   }
   else{
       $NetAmount = 0;
   }
   
   $rncnt224+=$result['TotInv'];
    $TotNetAmount+=$NetAmount;
   $TotCashAmount+=countval('cash_payment',$result['FrId'],$Calendar);
   $TotUpiAmount+=countval('upi_payment',$result['FrId'],$Calendar);
    if($NetAmount > 0){
        
        $sql = "SELECT Max(modified_time) AS LastTime FROM `tbl_customer_invoice_2025` WHERE FrId='".$result['FrId']."'";
$row = getRecord($sql);
$LastTime = $row['LastTime'];
$date = $LastTime;
$currtime = gmdate("Y-m-d H:i:s");
// Create two DateTime objects
$dateTime1 = new DateTime($currtime); // Current date and time
$dateTime2 = new DateTime($date); // 1 hour 45 minutes ago

// Calculate the difference between the two dates
$interval = $dateTime1->diff($dateTime2);

// Format the difference
$hours = $interval->h;
$minutes = $interval->i;

if ($hours > 0 && $minutes > 0) {
    $timeDifference = "$hours hour" . ($hours > 1 ? 's' : '') . " $minutes minute" . ($minutes > 1 ? 's' : '') . " ago";
} elseif ($hours > 0) {
    $timeDifference = "$hours hour" . ($hours > 1 ? 's' : '') . " ago";
} elseif ($minutes > 0) {
    $timeDifference = "$minutes minute" . ($minutes > 1 ? 's' : '') . " ago";
} else {
    $timeDifference = "just now";
}


$sync_time = $timeDifference;
    ?>
                <div class="card mb-2">
                   <!-- <a href="product-lists.php?catid=<?php echo $result['id'];?>">-->
                    <div class=" px-0">
                        <ul class="list-group list-group-flush">
                             <a href="home2.php?frid=<?php echo $result['FrId'];?>">
                            <li class="list-group-item" style="border-radius: 10px;">
                                
                                <div class="row align-items-center">
                                    <div class="col align-self-center pr-0" width="80%">
                                        <h6 class=" mb-1" style="color:black;font-size:14px;font-weight:500;"><?php echo $result['ShopName'];?></h6>
                                          <span class="small text-secondary" style=""><?php echo $result['Address'];?></span>
                                       <p class="small " style="text-transform:capitalize;color:#009eff;">Last Sync : <?php echo $sync_time;?></p>
                                    </div>
                                    <div class="col-auto" align="right" >
                                         <p class="small text-secondary" style="font-size:15px;"><strong>&#8377;<?php echo number_format($NetAmount,2);?></strong>
                                         <br><span style="font-size:12px;">Cash : ₹<?php echo number_format(countval('cash_payment',$result['FrId'],$Calendar),2);?></span>
                                         <br><span style="font-size:12px;">UPI : ₹<?php echo number_format(countval('upi_payment',$result['FrId'],$Calendar),2);?></span>
                                         <br><span style="font-size:12px;">Avg : <?php echo number_format($NetAmount/$result['TotInv'],2);?></span></p>
                                    </div>
                                </div>
                            </li>
                            </a>
                        </ul>
                    </div>
               <!-- </a>-->
                </div>
            <?php } } ?>
                
                 <?php 
       $sql2 = "SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice_2025 WHERE InvoiceDate='".date('Y-m-d')."' AND FrId='0'";
   $row2 = getRecord($sql2);
   $NetAmount22 = $row2['NetAmount'];
   
   $sql22 = "SELECT * FROM tbl_customer_invoice_2025 WHERE InvoiceDate='".date('Y-m-d')."' AND FrId='0'";
   $rncnt223 = getRow($sql22);
   
   if($NetAmount22 > 0){
       $NetAmount3 = $row2['NetAmount'];
   }
   else{
       $NetAmount3 = 0;
   }
   $rncnt225 = $rncnt224+$rncnt223;
   if($NetAmount3 > 0){
   ?>

<div class="card mb-2">
                  <a href="home2.php?frid=0">
                    <div class=" px-0">
                        <ul class="list-group list-group-flush">
                            
                            <li class="list-group-item" style="border-radius: 10px;">
                                
                                <div class="row align-items-center">
                                    <div class="col align-self-center pr-0" width="80%">
                                        <h6 class="font-weight-normal mb-1" style="color:black;">MAHA CHAI PVT LTD - KHAMALA (Main)</h6>
                                        <p class="small text-secondary">Plot No, 3, Jetwan Society Rd, Agne Layout, Shastri Layout, Khamla, Nagpur, Maharashtra 440025</p>
                                       
                                       
                                    </div>
                                    <div class="col-auto" align="right" >
                                         <p class="small text-secondary"><strong>&#8377;<?php echo number_format($NetAmount3,2);?></strong><br><span style="font-size:12px;">Avg : <?php echo number_format($NetAmount/$rncnt22,2);?></span>
                                         </p>
                                         
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
              </a>
                </div>
                <?php } ?>
                
                <?php 
                $totamt = ($TotNetAmount+$NetAmount3)/1.05;
                $totcommamt = $totamt*($MyCommPercentage/100);
                ?>
<div class="card mb-2">
                
                    <div class=" px-0">
                        <ul class="list-group list-group-flush">
                            
                            
                            
                            
                            <li class="list-group-item" style="border-radius: 10px;">
                                
                                <div class="row align-items-center">
                                    <div class="col align-self-center pr-0" width="80%">
                                        <h6 class=" mb-1" style="color:black;font-size:14px;font-weight:500;"> Total Sell Amount</h6>
                                         
                                      
                                    </div>
                                    <div class="col-auto" align="right" >
                                         <p class="small text-secondary" style="font-size:15px;"><strong>&#8377;<?php echo number_format($TotNetAmount+$NetAmount3,2);?></strong></p>
                                    </div> 
                                </div>
                            </li>
                            
                            <li class="list-group-item" style="border-radius: 10px;">
                                
                                <div class="row align-items-center">
                                    <div class="col align-self-center pr-0" width="80%">
                                        <h6 class=" mb-1" style="color:black;font-size:14px;font-weight:500;">Non GST Amount</h6>
                                         
                                      
                                    </div>
                                    <div class="col-auto" align="right" >
                                         <p class="small text-secondary" style="font-size:15px;"><strong>&#8377;<?php echo number_format(round($totamt),2);?></strong></p>
                                    </div> 
                                </div>
                            </li>
                            
                             <li class="list-group-item" style="border-radius: 10px;">
                                
                                <div class="row align-items-center">
                                    <div class="col align-self-center pr-0" width="80%">
                                        <h6 class=" mb-1" style="color:black;font-size:14px;font-weight:500;">Partner Payout (<?php echo $MyCommPercentage;?>%)</h6>
                                         
                                      
                                    </div>
                                    <div class="col-auto" align="right" >
                                         <p class="small text-secondary" style="font-size:15px;"><strong>&#8377;<?php echo number_format(round($totcommamt),2);?></strong></p>
                                    </div> 
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                    
               
                    
                </div>
                

            </div>
        </div>
    </main>


     <?php include_once 'footer.php';?>

    <!-- color settings style switcher -->
   <?php include 'inc-fr-lists.php';include 'inc-calendar-lists.php';?>



    <!-- Required jquery and libraries -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
 <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- cookie js -->
    <script src="js/jquery.cookie.js"></script>

    <!-- Swiper slider  js-->
  
    <!-- Customized jquery file  -->
    <script src="js/main.js"></script>
    <script src="js/color-scheme-demo.js"></script>

    <!-- page level custom script -->
    <script src="js/app.js"></script>
 <script type="text/javascript" src="js/toastr.min.js"></script>
  
</body>

</html>
