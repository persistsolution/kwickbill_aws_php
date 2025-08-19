<?php session_start();
require_once 'config.php';
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

if($_REQUEST['frid']!=''){
    $_SESSION['FranchiseId'] = $_REQUEST['frid'];
}
$FranchiseId = $_SESSION['FranchiseId'];
$sql55 = "SELECT * FROM tbl_users WHERE id='$FranchiseId'";
$row55 = getRecord($sql55);
$PageName = "My Expenses";
$Page = "Recharge";
$WallMsg = "NotShow"; 
$url = "home.php";?>
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
    <?php include 'sidebar.php';?>
    <div class="backdrop"></div>


    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
       
<?php include 'top_header.php';?>

        <!-- page content start -->
<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_cash_uses WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      //alert("Deleted Successfully!");
      window.location.href="view-cash-uses.php";
    </script>
<?php } ?>


        <div class="main-container" style="padding-top: 80px;">
            <div class="container">
               
               <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">



<div class="form-group col-md-3 col-6">
<label class="form-label">Month</label>
<select class="form-control" style="width: 100%" name="month" id="month" required>
<option <?php if($_REQUEST['month'] == '01'){?> selected <?php } ?> value="01">Jan</option>
<option <?php if($_REQUEST['month'] == '02'){?> selected <?php } ?> value="02">Feb</option>
<option <?php if($_REQUEST['month'] == '03'){?> selected <?php } ?> value="03">Mar</option>
<option <?php if($_REQUEST['month'] == '04'){?> selected <?php } ?> value="04">Apr</option>
<option <?php if($_REQUEST['month'] == '05'){?> selected <?php } ?> value="05">May</option>
<option <?php if($_REQUEST['month'] == '06'){?> selected <?php } ?> value="06">Jun</option>
<option <?php if($_REQUEST['month'] == '07'){?> selected <?php } ?> value="07">Jul</option>
<option <?php if($_REQUEST['month'] == '08'){?> selected <?php } ?> value="08">Aug</option>
<option <?php if($_REQUEST['month'] == '09'){?> selected <?php } ?> value="09">Sep</option>
<option <?php if($_REQUEST['month'] == '10'){?> selected <?php } ?> value="10">Oct</option>
<option <?php if($_REQUEST['month'] == '11'){?> selected <?php } ?> value="11">Nov</option>
<option <?php if($_REQUEST['month'] == '12'){?> selected <?php } ?> value="12">Dec</option>
  </select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3 col-6">
<label class="form-label">Year</label>
<select class="form-control" style="width: 100%" name="year" id="year" required>
    <option <?php if($_REQUEST['year'] == '2024'){?> selected <?php } ?> value="2024">2024</option>
  </select>
<div class="clearfix"></div>
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1">
    <label class="form-label">&nbsp;</label>
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
</div>

</form>
                                            </div>
               
               <?php 
                $frid= $_REQUEST['fr_id'];
                $sql3 = "SELECT * FROM tbl_set_target WHERE frid='$frid'";
                if($_REQUEST['month']){
                $month = $_REQUEST['month'];
                $sql3.= " AND month='$month'";
                }
                if($_REQUEST['year']){
                    $year = $_REQUEST['year'];
                    $sql3.= " AND year='$year'";
                }
                $row3 = getRecord($sql3);
                $target = $row3['target'];
                
                 $sql2 = "SELECT SUM(NetAmount) AS TotAmt FROM tbl_customer_invoice WHERE FrId='$frid'";
                 if($_REQUEST['month']){
                $month = $_REQUEST['month'];
                $sql2.= " AND month(InvoiceDate)='$month'";
                }
                if($_REQUEST['year']){
                    $year = $_REQUEST['year'];
                    $sql2.= " AND year(InvoiceDate)='$year'";
                }
                $row2 = getRecord($sql2);
                $totamt =$row2['TotAmt'];
                ?>
                <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1"><strong>Target : </strong>&#8377;<?php echo number_format($target,2);?> <hr>
                                        <strong>Sell : </strong>&#8377;<?php echo number_format($totamt,2);?></h5>
                                       
                                       </p>
                                     
                                       
                                        
                                        

                                    </div>
                                    <div class="col-auto pl-0">
                                       
                                            <!--<a href="add-cash-book.php?id=<?php echo $result['id']; ?>" class="btn-danger btn btn-sm btn-30 rounded"><i class="fa fa-edit"></i></a>-->
                                        <!--<a href="javascript:void(0)" onclick="getExpId(<?php echo $result['id'];?>)"  class="btn-danger btn btn-sm btn-30 rounded"><i class="fa fa-trash"></i></a>-->
                                        <!--<a href="view-cash-uses.php?action=delete&id=<?php echo $result['id'];?>"  class="btn-danger btn btn-sm btn-30 rounded"><i class="fa fa-trash"></i></a>-->
                     
                                      
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        

                        <?php 
            $Month = $_REQUEST['Month'];
          if($Month == 1){$MonthName = "Jan";}
          if($Month == 2){$MonthName = "Feb";}
          if($Month == 3){$MonthName = "Mar";}
          if($Month == 4){$MonthName = "Apr";}
          if($Month == 5){$MonthName = "May";}
          if($Month == 6){$MonthName = "Jun";}
          if($Month == 7){$MonthName = "Jul";}
          if($Month == 8){$MonthName = "Aug";}
          if($Month == 9){$MonthName = "Sep";}
          if($Month == 10){$MonthName = "Oct";}
          if($Month == 11){$MonthName = "Nov";}
          if($Month == 12){$MonthName = "Dec";}
          $Year = $_REQUEST['Year'];
          
            $i=1;
            $sql = "SELECT tp.*,tu.ShopName FROM tbl_customer_invoice tp INNER JOIN tbl_users_bill tu ON tp.frid=tu.id WHERE tp.frid='$frid'";
            
           if($_REQUEST['month']){
                $month = $_REQUEST['month'];
                $sql.= " AND month(tp.InvoiceDate)='$month'";
            }
            if($_REQUEST['year']){
                $year = $_REQUEST['year'];
                $sql.= " AND year(tp.InvoiceDate)='$year'";
            }
            $sql.= " GROUP BY tp.InvoiceDate ORDER BY tp.InvoiceDate ASC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                $InvoiceDate = $row['InvoiceDate'];
                $sql2 = "SELECT SUM(NetAmount) AS TotAmt FROM tbl_customer_invoice WHERE InvoiceDate='$InvoiceDate' AND FrId='".$row['FrId']."'";
                $row2 = getRecord($sql2);
                
                $sql3 = "SELECT * FROM tbl_set_target WHERE frid='".$row['FrId']."'";
                if($_REQUEST['month']){
                $month = $_REQUEST['month'];
                $sql3.= " AND month='$month'";
                }
                if($_REQUEST['year']){
                    $year = $_REQUEST['year'];
                    $sql3.= " AND year='$year'";
                }
                $row3 = getRecord($sql3);
                $target = $row3['target'];
                $totamt+=$row2['TotAmt'];
                $totper+=round($target/$row2['TotAmt'],2);
             ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1" style="font-size: 15px;"><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['InvoiceDate'])))?>
                                         </h5>
                                        <p class="text-secondary">&#8377;<?php echo number_format($row2['TotAmt'],2);?> 
                                        
                                       </p>
                                     
                                       
                                        
                                        

                                    </div>
                                    <div class="col-auto pl-0">
                                       
                                   <?php echo round(($row2['TotAmt']/$target)*100,2); ?>%
                     
                                      
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                         <?php }  ?>
                        
                        
            </div>
        </div>
    </main>

<?php include 'footer.php';?>
  <?php include 'inc-fr-lists.php';include 'inc-calendar-lists.php';?>
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
