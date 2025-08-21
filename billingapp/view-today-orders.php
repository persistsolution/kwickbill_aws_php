<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$AdminLoginId = $_SESSION['Admin']['id'];
$MainPage = "Customer-Invoice";
$Page = "View-Today-Orders";
?>
<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">
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

<div class="layout-wrapper layout-2">
<div class="layout-inner">

<?php include_once 'sidebar.php'; ?>


<div class="layout-container">

<?php include_once 'top_header.php'; ?>

<?php
if($_GET["action"]=="delete")
{
  $id = $_GET["id"];
//   $sql11 = "DELETE FROM tbl_customer_invoice WHERE id = '$id'";
//   $conn->query($sql11);
//   $sql11 = "DELETE FROM tbl_customer_invoice_details WHERE InvId = '$id'";
//   $conn->query($sql11);
//   $sql11 = "DELETE FROM tbl_general_ledger WHERE SellId = '$id' AND Flag='Customer-Invoice'";
//   $conn->query($sql11);
//   $sql = "DELETE FROM tbl_product_stocks WHERE InvId='$id'";
//   $conn->query($sql);
//   $sql = "DELETE FROM tbl_cust_prod_stock WHERE InvId='$id'";
//   $conn->query($sql);
$modified_time = gmdate('Y-m-d H:i:s.').gettimeofday()['usec'];
    $sql11 = "UPDATE tbl_customer_invoice SET delete_flag=1,modified_time='$modified_time',push_flag=1 WHERE id = '$id'";
    $conn->query($sql11);
    $sql11 = "UPDATE tbl_customer_invoice_details SET delete_flag=1,modified_time='$modified_time',push_flag=1 WHERE InvId = '$id'";
    $conn->query($sql11);
    
    

  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-customer-invoices.php";
    </script>
<?php } 

if($_GET["action"]=="cancel")
{
  $id = $_GET["id"];
  $sql = "INSERT INTO tbl_customer_invoice_temp SELECT * FROM tbl_customer_invoice WHERE id='$id'";
  $conn->query($sql);
  $sql = "INSERT INTO tbl_customer_invoice_details_temp SELECT * FROM tbl_customer_invoice_details WHERE InvId='$id'";
  $conn->query($sql);
  $sql11 = "DELETE FROM tbl_customer_invoice WHERE id = '$id'";
  $conn->query($sql11);
  $sql11 = "DELETE FROM tbl_customer_invoice_details WHERE InvId = '$id'";
  $conn->query($sql11);
  $sql11 = "DELETE FROM tbl_general_ledger WHERE SellId = '$id' AND Flag='Customer-Invoice'";
  $conn->query($sql11);
  $sql = "DELETE FROM tbl_product_stocks WHERE InvId='$id'";
  $conn->query($sql);
  /*$sql = "DELETE FROM tbl_cust_prod_stock WHERE InvId='$id'";
  $conn->query($sql);*/
  $url = $_SERVER['REQUEST_URI'];
  $createddate = date('Y-m-d H:i:s');
  $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$BillSoftFrId',url='$url',action='invoice cancelled',invid='$id',createddate='$createddate',roll='invoice'";
  $conn->query($sql);
    

  ?>
    <script type="text/javascript">
      alert("Invoice Cancelled Successfully!");
      window.location.href="view-today-orders.php";
    </script> 
<?php } 

if($_GET["action"]=="changestatus")
{
  $id = $_GET["id"];
  $status = $_GET['status'];
  if($status == 0){
      $sql = "UPDATE tbl_customer_invoice SET Status=1 WHERE id='$id'";
      $conn->query($sql);
  }
  else{
      $sql = "UPDATE tbl_customer_invoice SET Status=0 WHERE id='$id'";
      $conn->query($sql);
  }
  ?>
    <script type="text/javascript">
      alert("Status Updated Successfully!");
      window.location.href="view-customer-invoices.php";
    </script>
<?php }
?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Customer Invoice List
<span >
<a href="view-today-orders.php?val=all" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Show All</a></span>
<?php if(in_array("14", $Options)) {?>
  <!--<span style="float: right;">
<a href="javascript:void(0)" onclick="goToOffline()" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add More</a></span>-->
<?php } ?>
</h4>
<br>

<div class="card">
    <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding: 5px;padding-left: 20px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">



<!--<div class="form-group col-md-2">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-2">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>-->

<div class="form-group col-lg-3">
                                            <label class="form-label">Payment Type</label>
                                            <select class="form-control" id="PayType" name="PayType">
                                                <option selected=""  value="all">All</option>
                                                <option value="Cash" <?php if ($_POST['PayType'] == 'Cash') { ?> selected <?php } ?>>Cash</option>
                                                <option <?php if ($_POST['PayType'] == 'Phone Pay') { ?> selected <?php } ?> value="Phone Pay">Phone Pay</option>
                                                <option <?php if ($_POST['PayType'] == 'Google Pay') { ?> selected <?php } ?> value="UPI">Google Pay</option>
                                                <option <?php if ($_POST['PayType'] == 'Paytm') { ?> selected <?php } ?> value="Paytm">Paytm</option>
                                                 <option <?php if ($_POST['PayType'] == 'Other UPI') { ?> selected <?php } ?> value="Other UPI">Other UPI</option>
                                                 
                                                  <option <?php if ($_POST['PayType'] == 'Borrowing') { ?> selected <?php } ?> value="Borrowing">Credit / उधार</option>
                                                  
                                                  <option <?php if ($_POST['PayType'] == 'Zomato') { ?> selected <?php } ?> value="Zomato">Zomato</option>
                                                  
                                            </select>
                                            <div class="clearfix"></div>
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

<?php 
$sql = "SELECT SUM(NetAmount) AS NetAmount FROM (SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice WHERE Roll=2 AND Status=1 AND InvoiceDate='".date('Y-m-d')."' AND FrId='$BillSoftFrId' AND delete_flag=0 UNION ALL 
         SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice_2025 WHERE Roll=2 AND Status=1 AND InvoiceDate='".date('Y-m-d')."' AND FrId='$BillSoftFrId' AND delete_flag=0) as a";
$row = getRecord($sql);
?>
<div class="form-group col-md-3" style="padding-top:25px;padding-left: 50px;">
    <h5>Total: &#8377;<?php echo $row['NetAmount'];?></h5>
</div>

</div>

</form>

<?php 
    function calAmt($type,$BillSoftFrId){
        global $conn;
         $sql = "SELECT SUM(NetAmount) AS NetAmount FROM (SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice WHERE Roll=2 AND Status=1 AND InvoiceDate='".date('Y-m-d')."' AND FrId='$BillSoftFrId' AND PayType='$type' AND delete_flag=0 UNION ALL 
         SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice_2025 WHERE Roll=2 AND Status=1 AND InvoiceDate='".date('Y-m-d')."' AND FrId='$BillSoftFrId' AND PayType='$type' AND delete_flag=0) as a";
        $res = $conn->query($sql);
	    $row = $res->fetch_assoc();
	    if($row['NetAmount']==''){
	        $NetAmount = 0;
	    }
	    else{
	        $NetAmount = $row['NetAmount'];
	    }
	    return $NetAmount;
    }

 ?>
<div class="form-row">
            <div class="form-group col-md-2">
<label class="form-label">Cash</label>
<input type="text" class="form-control" value="&#8377;<?php echo calAmt('Cash',$BillSoftFrId); ?>" autocomplete="off" readonly>
</div>

<div class="form-group col-md-2">
<label class="form-label">Phone Pay</label>
<input type="text" class="form-control" value="&#8377;<?php echo calAmt('Phone Pay',$BillSoftFrId); ?>" autocomplete="off" readonly>
</div>

<div class="form-group col-md-2">
<label class="form-label">Google Pay</label>
<input type="text" class="form-control" value="&#8377;<?php echo calAmt('UPI',$BillSoftFrId); ?>" autocomplete="off" readonly>
</div>

<div class="form-group col-md-2">
<label class="form-label">Paytm</label>
<input type="text" class="form-control" value="&#8377;<?php echo calAmt('Paytm',$BillSoftFrId); ?>" autocomplete="off" readonly>
</div>

<div class="form-group col-md-2">
<label class="form-label">Other UPI</label>
<input type="text" class="form-control" value="&#8377;<?php echo calAmt('Other UPI',$BillSoftFrId); ?>" autocomplete="off" readonly>
</div>

<div class="form-group col-md-1">
<label class="form-label">Credit</label>
<input type="text" class="form-control" value="&#8377;<?php echo calAmt('Borrowing',$BillSoftFrId); ?>" autocomplete="off" readonly>
</div>

<div class="form-group col-md-1">
<label class="form-label">Zomato</label>
<input type="text" class="form-control" value="&#8377;<?php echo calAmt('Zomato',$BillSoftFrId); ?>" autocomplete="off" readonly>
</div>

</div>

                                            </div>
                                        </div>
                                    </div>
   </div>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="thead-light">
            <tr>
              <!-- <th>#</th>-->
               
              <!-- <th>Action</th>-->
                <?php if($AdminLoginId == 404 || $AdminLoginId == 2648) {?>
                <th>Cancel</th>
                <?php } ?>
             <th>Item</th>
                <!-- <th>QR Code</th> -->
               <!--  <th>Status</th> -->
               <th>Order No</th>
                <th>Invoice No</th>
                <th>Invoice Date</th>
                <th>Customer Name</th>
               
                <!--<th>Phone No</th>-->
                <th>Total Amount</th>
                <!--<th>Paid Amount</th>
                <th>Balance Amount</th>-->
                <th>Payment Mode</th>
                
                
   
            </tr>
        </thead>
        <tbody>
            <?php 
             //India time (GMT+5:30)
//echo date('d-m-Y H:i:s');
            $sql55 = "SELECT PrintCompName,Address,CinNo,PrintMobNo,GstNo,terms_condition,bottom_title FROM tbl_users_bill WHERE id='$BillSoftFrId'";
            $row55 = getRecord($sql55);
            $title = str_replace(" ","#",$row55['PrintCompName']);
            $Address = str_replace(" ","#",$row55['Address']);
             $CinNo = str_replace(" ","#",$row55['CinNo']);
            $Phone = str_replace(" ","#",$row55['PrintMobNo']);
            $GstNo = str_replace(" ","#",$row55['GstNo']);
            $terms_condition = str_replace(" ","#",$row55['terms_condition']);
            $bottom_title = str_replace(" ","#",$row55['bottom_title']);
            //$bottom_title = $bottom_title2."#".date('h:i a');
            //$bottom_title.="#".date('h:i a');
            //echo $bottom_title;
            $i=1;
            
           
             $sql = "SELECT *,'2024' AS Year FROM tbl_customer_invoice WHERE Roll=2 AND Status=1 AND InvoiceDate='".date('Y-m-d')."' AND FrId='$BillSoftFrId'  AND delete_flag=0";
            if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND InvoiceDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND InvoiceDate<='$ToDate'";
            }
            if($_POST['PayType']){
                $PayType = $_POST['PayType'];
                if($PayType == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND PayType='$PayType'";
                }
            }
            
            
            $sql.=" UNION ALL SELECT *,'2025' AS Year FROM tbl_customer_invoice_2025 WHERE Roll=2 AND Status=1 AND InvoiceDate='".date('Y-m-d')."' AND FrId='$BillSoftFrId'  AND delete_flag=0";
            if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND InvoiceDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND InvoiceDate<='$ToDate'";
            }
            if($_POST['PayType']){
                $PayType = $_POST['PayType'];
                if($PayType == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND PayType='$PayType'";
                }
            }
            if($_GET['val'] == 'all'){ 
            $sql.=" ORDER BY InvoiceDate DESC";
            }
            else{
             $sql.=" ORDER BY InvoiceDate DESC";   
            }
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                $TotAmt+=$row['NetAmount'];
                $CustName = str_replace(" ","#",$row['CustName']);
            $emparray = array();
            $sql12 = "SELECT * FROM tbl_customer_invoice_details WHERE InvId='".$row['Unqid']."' UNION ALL SELECT * FROM tbl_customer_invoice_details_2025 WHERE InvId='".$row['Unqid']."'";
            $row12 = getList($sql12);
            foreach($row12 as $result12){
                // $sql13 = "SELECT ProductName FROM tbl_cust_products WHERE id='".$result12['ProdId']."'";
                // $row13 = getRecord($sql13);
                // $TotQty+=$result12['Qty'];
                // $TotPrice+=$result12['Price'];
                // $TotGst+=number_format((float)$result12['GstAmt'], 2, '.', '');
                // //$TotGst+=round($result12['GstAmt'],2);
                // $Product_name2 = str_replace(" ","#",$row13['ProductName']);
                // $Product_name = substr($Product_name2,0,16);

                //  $emparray[] = array('item'=>$Product_name,'rate'=>$result12['Price'],'quantity'=>$result12['Qty'],'amount'=>$result12['Total']);
                $emparray[] = "";
            }
            $dados2 =  json_encode(array('productList' => $emparray));
$date = date("d/m/Y", strtotime(str_replace('-', '/',$row['InvoiceDate'])));

$dados1 = json_encode(array('CinNo'=>$CinNo,'title'=>$title,'address'=>$Address,'mobile'=>$Phone,'gstin'=>$GstNo,'customer_name'=>$CustName,'customer_phone_no'=>$row['CellNo'],'receipt_title'=>'Retail#Receipt','invoice_no'=>$row['InvoiceNo'],'date'=>$date,'sub_total'=>$row['SubTotal'],'discount'=>$row['Discount'],'service_charge'=>0,'gst'=>$TotGst,'total_bill'=>$row['NetAmount'],'total_payable'=>$row['NetAmount'],'terms_condition'=>$terms_condition,'bottom_title'=>$bottom_title)); 

           
     $invoice_data =  json_encode(array_merge(json_decode($dados1, true),json_decode($dados2, true)));
    //echo $invoice_data;
             ?>
            <tr>
               <!--<td><?php echo $i;?></td>-->
            
             <!--<td class="table-action">-->
                                                          <!-- <a href="javascript:void(0)" onClick=printReceipt('<?php echo $invoice_data;?>') class="btn btn-icon btn-outline-primary"><i class="feather icon-printer"></i></a>-->
                                                            <?php if(in_array("10", $Options)){?>
                                                            <!--<a href="edit-order.php?id=<?php echo $row['id']; ?>" class="btn btn-icon btn-outline-success"><i class="feather icon-edit"></i></a>-->
                                                            <?php } if(in_array("11", $Options)){?>
                                                            <!--<a onClick="return confirm('Are you sure you want delete this record. delete all record related this invoice.');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete" class="btn btn-icon btn-outline-danger"><i class="feather icon-trash-2"></i></a>-->
                                                            <?php } ?>
                                                            <!--<a href="javascript:void(0)" onclick="sendSms(<?php echo $row['id']; ?>)" class="btn btn-icon btn-outline-primary"><i class="feather icon-message-square"></i></a>-->
                                                        <!--</td>-->
               <?php if($AdminLoginId == 404 || $AdminLoginId == 2648) {?>                                         
              <td>
                 <a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=cancel" onClick="return confirm('Are you sure you want cancel this invoice. delete all record related this invoice.');" class="btn btn-danger btn-sm btn-round"> Cancel</a>
             </td><?php } ?>
           <!--  <td> <?php if($row["Barcode"] == '') {?>
                  -
                 <?php } else if(file_exists('../barcodes/'.$row["Barcode"])){?>
                 <a href="../barcodes/<?php echo $row["Barcode"];?>" target="_new"><img src="../barcodes/<?php echo $row["Barcode"];?>?nocache=<?php echo time(); ?>" class="d-block ui-w-40" alt="" style="width: 40px;height: 40px;"></a>
                  <?php }  else{?>
                 -
             <?php } ?></td> -->
            <!--  <td>
             <label class="switcher switcher-success">
                                        <input type="checkbox" class="switcher-input" <?php if($row['Status']=='1'){?>checked=""<?php } ?> onclick="approve('<?php echo $row['Status'];?>','<?php echo $row['id']; ?>')">
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes">
                                                <span class="ion ion-md-checkmark"></span>
                                            </span>
                                            <span class="switcher-no">
                                                <span class="ion ion-md-close"></span>
                                            </span>
                                        </span>
                                        <span class="switcher-label"><?php if($row['Status']=='1'){echo "<span style='color:green;'>Approved</span>";} else { echo "<span style='color:red;'>Pending</span>";} ?></span>
                                    </label>
             </td> -->
             <td class="align-middle"><a href="view-order-items.php?id=<?php echo $row['Unqid']; ?>&year=<?php echo $row['Year'];?>" target="_blank">View</a></td>
             <td class="align-middle"><?php echo $row['OrderNo']; ?></td>
              <td class="align-middle"><?php echo $row['InvoiceNo']; ?></td>
              <td class="align-middle"><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['InvoiceDate']))); ?></td>
           
                <td class="align-middle"><?php echo $row['CustName']; ?></td>
               <!-- <td><?php echo $row['CellNo']; ?></td>-->
                
                  <td class="align-middle">&#8377; <?php echo number_format($row['NetAmount'],2); ?></td>
                 <!-- <td>&#8377; <?php echo number_format($row['Advance'],2); ?></td>
                  <td>&#8377; <?php echo number_format($row['Balance'],2); ?></td>-->
                  <td class="align-middle"><?php echo $row['PayType']; ?></td>
                
            
         
              
            </tr>
           <?php $i++;} ?>
           
           <tr>
               <!--<th></th>-->
              <!-- <th></th>-->
               <th></th>
                <th></th>
                <th></th>
                 <th></th>
               <th>Total</th>
               <th>&#8377;<?php echo number_format($TotAmt,2);?></th>
              
               <th></th>
               
           </tr>
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
    function error_toast(){
    var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
   $.growl.error({
      title:    'Error',
      message:  'Email Id / Phone No Already Exists',
      location: isRtl ? 'tl' : 'tr'
    });
  }
    function success_toast(){
    var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
   $.growl.success({
      title:    'Success',
      message:  'SMS Sent...',
      location: isRtl ? 'tl' : 'tr'
    });
  }
    function sendSms(id){
         var action = "sendSms";
    $.ajax({
  type: "POST",
  url: "ajax_files/ajax_customer_products.php",
  data: {action:action,id:id},
  success: function(data){
         success_toast();
      }
});
    }
function printReceipt(invdata){
    console.log(invdata);
   // alert(invdata);
     Android.printReceiptOnline(''+invdata+'');
}
function goToOffline(){
      Android.goToOfflinePage();
   }
 function approve(status,id){
     //alert(status);alert(id);
     window.location.href="view-invoices.php?status="+status+"&id="+id+"&action=changestatus";
 }
	$(document).ready(function() {
    $('#example').DataTable({
        order: [[1, 'desc']],
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
