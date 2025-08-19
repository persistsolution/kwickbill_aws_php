<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Reports";
$Page = "Sell-Reports";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | Sell Reports</title>
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
<h4 class="font-weight-bold py-3 mb-0">View Sell Reports
</h4>
<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

        <div class="form-group col-md-4">
<label class="form-label">User Name <span class="text-danger">*</span></label>
     <select class="select2-demo form-control" name="UserId" id="UserId" required>
      <option value="all" selected>All</option>
      <optgroup label="Vendor">
    <?php 

        $q = "SELECT * FROM tbl_users WHERE Status=1 AND Roll=3";
        $r = $conn->query($q);
         while($rw = $r->fetch_assoc())
        {
        ?>
   <option <?php if($rw["id"] == $_POST['UserId']) { ?>selected="selected" <?php } ?> value="<?php echo $rw['id']; ?>"><?php echo $rw['Fname']." ".$rw['Lname']." (".$rw['Phone'].")"; ?></option>
   <?php } ?>
   </optgroup>

   <optgroup label="Customer">
    <?php 

        $q = "SELECT * FROM tbl_users WHERE Status=1 AND Roll=2";
        $r = $conn->query($q);
         while($rw = $r->fetch_assoc())
        {
        ?>
   <option <?php if($rw["id"] == $_POST['UserId']) { ?>selected="selected" <?php } ?> value="<?php echo $rw['id']; ?>"><?php echo $rw['Fname']." ".$rw['Lname']." (".$rw['Phone'].")"; ?></option>
   <?php } ?>
   </optgroup>
</select>
  </div>



<div class="form-group col-md-2">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-2">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top:20px;">
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_POST['Search'])) {?>
<div class="col-md-1">
<label class="form-label d-none d-md-block">&nbsp;</label>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" data-original-title="Clear Filter">X</a>
</div>
<?php } ?>
</div>

</form>
</div>
</div>

<style>
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
}
</style>
<?php  


if(isset($_POST['Search'])) {
?>
<div class="card">
<div class="card-datatable table-responsive" style="padding: 10px;">
<table id="example" class="table-striped table-bordered">
       <thead>
            <tr>
               <th>#</th>
               <th>Invoice No</th>
               <th>Invoice Date</th>
                <th>Vendor Name</th>
                <th>Contact No</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT * FROM tbl_vendor_orders WHERE Status=1 ";
            if($_POST['UserId']){
                $UserId = $_POST['UserId'];
                if($UserId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND VedId='$UserId'";
            }
            }
            if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND InvoiceDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND InvoiceDate<='$ToDate'";
            }
            $sql.=" ORDER BY InvoiceDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                /*if($row['CrDr']=='Cr'){
                    $CrQty+=$row['Qty'];
                }
                else{
                    $DrQty+=$row['Qty'];
                }*/
                $TotAmt+=$row['Amount'];
             ?>
            <tr>
               <td><?php echo $i; ?></td>
                <!-- <td><a href="javascript:void(0);" onclick="receiptPrint(<?php echo $row['id']; ?>)"><?php echo $row['InvoiceNo']; ?></a></td>-->
                 <td><?php echo $row['InvoiceNo']; ?></td>
              <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['InvoiceDate']))); ?></td>
              <td><?php echo $row['VedName']; ?></td>
                <td><?php echo $row['CellNo']; ?></td>
                <td>&#8377;<?php echo $row['Amount']; ?></td>
                
           
         
              
            </tr>
           <?php $i++;} ?>
           <tr>
                <th><?php echo $i; ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Total Sell Amount</th>
                <th>&#8377;<?php echo $TotAmt;?></th>
                
           </tr>
           
        </tbody>
    </table>
</div>
</div>
<?php } ?>
</div>


<?php include_once 'footer.php'; ?>

</div>

</div>

</div>

<div class="layout-overlay layout-sidenav-toggle"></div>
</div>


<?php include_once 'footer_script.php'; ?>

<script type="text/javascript">
  function receiptPrint(id){
     setTimeout(function() {
        window.open(
            'receipt.php?id=' + id + '&roll=vendor', 'stickerPrint',
            'toolbar=1, scrollbars=1, location=1,statusbar=0, menubar=1, resizable=1, width=800, height=800'
        );
    }, 1);
 }
	$(document).ready(function() {
    $('#example').DataTable({
       "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ]
    });
});
</script>
</body>
</html>
