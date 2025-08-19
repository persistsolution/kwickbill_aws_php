<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Cash-Book";
$Page = "Franchise-Outstanding";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>
</head>
<body>

 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">





<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Franchise Kwick Bill Outstanding 
  
</h4>

<div class="card" style="padding: 10px;">
    
     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       

  <div class="form-group col-md-4">
<label class="form-label"> Franchise<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="UserId" id="UserId" required>
<option selected="" value="all">All</option>

 <?php 
  $sql12 = "SELECT * FROM tbl_users_bill WHERE Roll=5";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_REQUEST["UserId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['ShopName']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<!--<div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-3">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>-->
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1">
    <label class="form-label">&nbsp;</label>
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if($_REQUEST['Search'] == 'Search') {?>
<div class="form-group col-md-1">
<label class="form-label">&nbsp;</label>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" data-original-title="Clear Filter">X</a>
</div>
<?php } ?>
</div>

</form>
                                            </div>
                                        </div>
                                    </div>
   </div>
    <?php
    function calAmount($frid,$val){
        global $conn;
        //total
        if($val == 'totalincome'){
        $sql = "SELECT SUM(Result) AS Result FROM (SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice WHERE FrId='$frid' UNION ALL SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice_2025 WHERE FrId='$frid') as a";
        }
        if($val == 'yesterdayincome'){
        $sql = "SELECT SUM(Result) AS Result FROM (SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d',strtotime("-1 days"))."' UNION ALL SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice_2025 WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d',strtotime("-1 days"))."') as a";
        }
        if($val == 'todayincome'){
        $sql = "SELECT SUM(Result) AS Result FROM (SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d')."' UNION ALL SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice_2025 WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d')."') as a";
        }
        
        //cash
        if($val == 'totalcashincome'){
        $sql = "SELECT SUM(Result) AS Result FROM (SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice WHERE FrId='$frid' AND PayType='Cash' UNION ALL SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice_2025 WHERE FrId='$frid' AND PayType='Cash') as a";
        }
        if($val == 'yesterdaycashincome'){
        $sql = "SELECT SUM(Result) AS Result FROM (SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d',strtotime("-1 days"))."' AND PayType='Cash' UNION ALL SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice_2025 WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d',strtotime("-1 days"))."' AND PayType='Cash') as a";
        }
        if($val == 'todaycashincome'){
        $sql = "SELECT SUM(Result) AS Result FROM (SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d')."' AND PayType='Cash' UNION ALL SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice_2025 WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d')."' AND PayType='Cash') as a";
        }
        
        //upi
        if($val == 'totalupiincome'){
        $sql = "SELECT SUM(Result) AS Result FROM (SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice WHERE FrId='$frid' AND PayType IN ('Phone Pay','UPI','Paytm','Other UPI','Online Payment') UNION ALL SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice_2025 WHERE FrId='$frid' AND PayType IN ('Phone Pay','UPI','Paytm','Other UPI','Online Payment')) as a";
        }
        if($val == 'yesterdayupiincome'){
        $sql = "SELECT SUM(Result) AS Result FROM (SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d',strtotime("-1 days"))."' AND PayType IN ('Phone Pay','UPI','Paytm','Other UPI','Online Payment') UNION ALL SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice_2025 WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d',strtotime("-1 days"))."' AND PayType IN ('Phone Pay','UPI','Paytm','Other UPI','Online Payment')) as a";
        }
        if($val == 'todayupiincome'){
        $sql = "SELECT SUM(Result) AS Result FROM (SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d')."' AND PayType IN ('Phone Pay','UPI','Paytm','Other UPI','Online Payment') UNION ALL SELECT SUM(NetAmount) AS Result FROM tbl_customer_invoice_2025 WHERE FrId='$frid' AND InvoiceDate='".date('Y-m-d')."' AND PayType IN ('Phone Pay','UPI','Paytm','Other UPI','Online Payment')) as a";
        }
        
        //transfercash
        if($val == 'transfercash'){
        $sql = "SELECT SUM(Amount) AS Result FROM tbl_cash_book WHERE FrId='$frid' AND ApproveStatus='1'";
        }
        
        $res = $conn->query($sql);
	    $row = $res->fetch_assoc();
	    if($row['Result']==''){
	        $Result = 0;
	    }
	    else{
	        $Result = $row['Result'];
	    }
	    return $Result;
    }
    ?>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr No</th>
                 <th>Franchise Name</th>
                  <th>Total Income</th>
                   <th>Last Deposite Date</th>
                <th>Yesterday Income</th>
                <th>Today Income</th>
                <th>Total Cash Income</th>
                <th>Yesterday Cash Income</th>
                <th>Today Cash Income</th>
                <th>Total UPI Income</th>
                <th>Yesterday UPI Income</th>
                <th>Today UPI Income</th>
                <th>Transfer Cash Amount</th>
                <th>Balance Cash Amount</th>
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT * FROM tbl_users_bill WHERE roll=5";
             if($_REQUEST['UserId']){
                $ExeId = $_REQUEST['UserId'];
                if($ExeId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND id='$ExeId'";
                }
            }
           
            $sql.=" ORDER BY id";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                if($row['id'] == 5){
                    $frid = 0;
                }
                else{
                    $frid = $row['id'];
                }
                
                $sql2 = "SELECT TransferDate FROM tbl_cash_book WHERE FrId='$frid' AND TransferDate is not null ORDER BY TransferDate DESC LIMIT 1";
                $rncnt2 = getRow($sql2);
                $row2 = getRecord($sql2);
             ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['ShopName'];?></td>
                <td><?php echo calAmount($frid,'totalincome');?></td>
                <td><?php if($rncnt2 > 0) { echo date("d-m-Y", strtotime(str_replace('-', '/',$row2['TransferDate'])));} else {}?></td>
                <td><?php echo calAmount($frid,'yesterdayincome');?></td>
                <td><?php echo calAmount($frid,'todayincome');?></td>
                
                <td><?php echo calAmount($frid,'totalcashincome');?></td>
                <td><?php echo calAmount($frid,'yesterdaycashincome');?></td>
                <td><?php echo calAmount($frid,'todaycashincome');?></td>
                
                <td><?php echo calAmount($frid,'totalupiincome');?></td>
                <td><?php echo calAmount($frid,'yesterdayupiincome');?></td>
                <td><?php echo calAmount($frid,'todayupiincome');?></td>
                <td><?php echo calAmount($frid,'transfercash');?></td>
                <td><?php echo calAmount($frid,'totalcashincome') - calAmount($frid,'transfercash');?></td>
            </tr>
           <?php $i++;} ?>
        </tbody>
    </table>
</div>
</div>
</div>


<?php include_once 'footer.php'; ?>

</div>

</div>

</div>

<div class="layout-overlay layout-sidenav-toggle"></div>
</div>


<?php include_once 'footer_script.php'; ?>

<script type="text/javascript">

    $(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ]
    });
});
</script>
</body>
</html>
