<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
require_once "database.php";
$user_id = $_SESSION['Admin']['id'];
$MainPage="E-Commerce";
$Page = "Generate-Qty-Orders";
$id = $_GET['id'];
$sql7 = "SELECT * FROM orders WHERE id='$id'";
$row7 = getRecord($sql7);
$OrderType = $row7['OrderType'];
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Order</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />

<?php include_once 'header_script.php'; ?>
<script src="ckeditor/ckeditor.js"></script>
</head>
<body>
<style type="text/css">
  .password-tog-info {
  display: inline-block;
cursor: pointer;
font-size: 12px;
font-weight: 600;
position: absolute;
right: 50px;
top: 30px;
text-transform: uppercase;
z-index: 2;
}


</style>
 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">



<?php 
$id = $_GET['id'];
$sql7 = "SELECT * FROM orders WHERE id='$id'";
$row7 = getRecord($sql7);
$query22 = "SELECT count(*) as totrec FROM order_details WHERE OrderId = '$id'";
$data22 = getRecord($query22);
$row_cnt = $data22['totrec'] + 1;

if($_GET["action"]=="deletemember")
{
  $id = $_GET["id"];
  $bid = $_GET["oid"];
  $sql11 = "DELETE FROM order_details WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="add-orders.php?id=<?php echo $bid;?>";
    </script>
<?php } 

if(isset($_POST['submit'])){
  $UserId = $_POST['UserId'];
  $SubTotal = addslashes(trim($_POST['SubTotal']));
  $Discount = addslashes(trim($_POST['Discount']));
  $TotalAmount = addslashes(trim($_POST['TotalAmount']));
  $PaymentMethod = $_POST['PaymentMethod'];
  $PickupDate = $_POST['PickupDate'];
  $OffPer = $_POST['OffPer'];
   $WashIronType = addslashes(trim($_POST['WashIronType']));
  $PerKg = addslashes(trim($_POST['PerKg']));
  $TotWeight = addslashes(trim($_POST['TotWeight']));
  
  $OrderDate = $_POST['OrderDate'];
  $OrderTime = date('h:i a');
   $CouponCode = addslashes(trim($_POST['CouponCode']));
  $Promoprice = addslashes(trim($_POST['Promoprice']));
  //$Member = addslashes(trim($_POST['Member']));
$Step2Date = date('Y-m-d H:i:s');
  if($_POST['Member'] == 1){
    $OrderType = 3;
  }
  else{
    $OrderType = 2;
  }
  $sql2 = "SELECT * FROM customer_address WHERE UserId='$UserId' ORDER BY id DESC LIMIT 1";
  $row2 = getRecord($sql2);
  $AddressId = $row2['id'];
  if($_GET['id'] == ''){
    $sql = "INSERT INTO orders SET UserId='$UserId',AddressId='$AddressId',OrderTotal='$SubTotal',Discount='$Discount',PaymentMethod='$PaymentMethod',
   Type='Cart',Status=1,OrderProcess=6,OrderDate='$OrderDate',OrderTime='$OrderTime',
   CouponCode='$CouponCode',Promoprice='$Promoprice',Step2='Order Picked',Step2Date='$Step2Date'";
  $conn->query($sql);
  $OrderId = mysqli_insert_id($conn);
  //$OrderNo = "#".rand(1000,9999).$OrderId;
  $OrderNo = "#1000".$OrderId;
  $sql3 = "UPDATE orders SET OrderNo='$OrderNo' WHERE id='$OrderId'";
  $conn->query($sql3);
  $Narration = "Picked Order";
 
}
else{
$sql = "UPDATE orders SET OrderTotal='$SubTotal',Discount='$Discount',PaymentMethod='$PaymentMethod',Type='Cart',Status=1,
OrderDate='$OrderDate',OrderTime='$OrderTime',CouponCode='$CouponCode',Promoprice='$Promoprice' WHERE id='$id'";
  $conn->query($sql);
  $OrderId = $_GET['id'];
  $OrderNo = $row7['OrderNo'];
  $Narration = "Order Edited";
}

if($Promoprice > 0){
          $sql5 = "DELETE FROM tbl_applied_code WHERE Oid='$OrderId' AND UserId='$UserId'";
$conn->query($sql5);
        $sql = "INSERT INTO tbl_applied_code SET Oid='$OrderId',UserId='$UserId',Code='$CouponCode',Amount='$Promoprice',CreatedDate='$OrderDate',Status=0";
        $conn->query($sql);
      }

//       $sql = "INSERT INTO tbl_exe_ord_info SET Oid='$OrderId',EmpId='$user_id',CreatedDate='$OrderDate',CreatedTime='$OrderTime',Details='$Narration'";
// $conn->query($sql);

$Title = "Order Placed Successfully!";
$Message = "Your Order No : ".$OrderNo;
 $sql73 = "SELECT Tokens,id FROM customers WHERE Tokens!='' AND Status=1 AND id='$UserId'";
    $data=mysqli_query($con,$sql73);
        
        while($row=mysqli_fetch_array($data))
        {
            
             $ReceiverId = $row['id'];
             $sql = "INSERT INTO tbl_notifications SET SenderId='$user_id',ReceiverId='$ReceiverId',Title='$Title',Message='$Message',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime'";
            $conn->query($sql);

            $title = $Title;
            $body =  $Message;
            $reg_id = $row[0];
            $registrationIds = array($reg_id);
            //$url = "$SiteUrl/profile.php?id=$UserId";
            include '../incnotification.php';
         
        }
        
$sql5 = "DELETE FROM order_details WHERE OrderId='$OrderId'";
$conn->query($sql5);
  $number = count($_POST['ProductId']);
   if($number > 0)  
            {  
                for($i=0; $i<$number; $i++)  
                {  
                     if(trim($_POST["ProductId"][$i] != ''))  
                     {
                        $CatId = addslashes($_POST['CatId'][$i]);
                        $ProductId = addslashes($_POST['ProductId'][$i]);
                        $Rate = addslashes($_POST['Rate'][$i]);
                        $Quantity = addslashes($_POST['Quantity'][$i]);
                        $Price = addslashes($_POST['Price'][$i]);
                        $PrdType = addslashes($_POST['Type'][$i]);
                        $DisRate = addslashes($_POST['DisRate'][$i]);
                        $PrimeDisc = addslashes($_POST['PrimeDisc'][$i]);

                        $sql = "INSERT INTO order_details SET CatId='$CatId',OrderId='$OrderId',OrderNo='$OrderNo',
                        UserId='$UserId',ProductId='$ProductId',Rate='$Rate',Price='$Price',Quantity='$Quantity',
                        Type='Cart',OrderDate='$OrderDate'";
                        $conn->query($sql);

                     }
                }
             }
     echo "<script>window.location.href='order-details.php?oid=$OrderId';</script>";        
}
?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Generate <?php } ?> Order</h4>

<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form novalidate="novalidate" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" name="action" value="Add">
<input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>">
<div class="form-row">
 <?php if($_GET['id'] != ''){?> 
 <div class="form-group col-md-12">
<label class="form-label">Order No </label>
<input type="text"  class="form-control" placeholder="e.g.,120" value="<?php echo $row7['OrderNo']; ?>" autocomplete="off" disabled>
</div>
<?php } ?>
<div class="form-group col-md-12">
<label class="form-label">Customer<span class="text-danger">*</span></label>
<select class="select2-demo form-control" id="UserId" name="UserId"  
<?php if($_GET['id'] != ''){?> disabled <?php } else{?>required<?php } ?> onchange="getCustDetails(this.value)">
<option selected="" disabled="">Select Customer</option>
 <?php 
    if($_GET['id']!=''){
       $sql4 = "SELECT * FROM tbl_users WHERE Status=1"; 
    }
    else{
     $sql4 = "SELECT * FROM tbl_users WHERE Status=1";   
    }
     
     $row4 = getList($sql4);
     foreach($row4 as $result)
      {
        if($result['Member'] == 1){
            $Prime = "<span style='color:red;'>- Prime</span>";
        }
        else{
            $Prime = "";
        }
      ?>
    <option <?php if($row7['UserId']==$result['id']){ ?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['Fname']." ".$result['Lname']." (".$result['Phone'].") ".$Prime; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div> 

<input type="hidden" id="Member" value="" name="Member">
</div>

<?php 
$i=1;
$sql_1 = "SELECT * FROM order_details WHERE OrderId='$id'";
$row_1 = getList($sql_1);
foreach($row_1 as $result){
 ?>
 <div class="form-row">

     <div class="form-group col-md-3">
<label class="form-label">Category</label>
 <select class="form-control" id="CatId<?php echo $i; ?>" name="CatId[]" onchange="getProduct(this.value,<?php echo $i; ?>)">
                            <option selected value="">...</option>
                             
 <?php 
     $sql4 = "SELECT * FROM category WHERE Status=1 AND id!=9";
     $row4 = getList($sql4);
     foreach($row4 as $result3)
      {
          if($result3['Roll'] == 1){
            $Roll = "Franchise";  
          }
          else if($result3['Roll'] == 2){
            $Roll = "Employee";  
          }
          else if($result3['Roll'] == 4){
            $Roll = "Customer";  
          }
          else{
              $Roll = "All";
          }
      ?>
    <option <?php if($result['CatId']==$result3['id']){ ?> selected <?php } ?> value="<?php echo $result3['id']; ?>"><?php echo $result3['Name']." (".$Roll.")"; ?></option>
<?php } ?>

 
                           </select>
<div class="clearfix"></div>
</div>
    <div class="form-group col-md-3">
<label class="form-label">Product</label>
<select class="form-control" id="ProductId<?php echo $i; ?>" name="ProductId[]" onchange="getRate(this.value,<?php echo $i; ?>,document.getElementById('Type<?php echo $i; ?>').value,document.getElementById('Quantity<?php echo $i; ?>').value)">
                            <option selected value="">...</option>
                             
 <?php 
     $sql4 = "SELECT * FROM products WHERE Status=1 AND CatId='".$result['CatId']."'";
     $row4 = getList($sql4);
     foreach($row4 as $result2)
      {
      ?>
    <option <?php if($result['ProductId']==$result2['id']){ ?> selected <?php } ?> value="<?php echo $result2['id']; ?>"><?php echo $result2['ProductName']; ?></option>
<?php } ?>
 
                           </select>
<div class="clearfix"></div>
</div>




<div class="form-group col-md-2">
<label class="form-label">Rate </label>
<input type="text" name="Rate[]" id="Rate<?php echo $i;?>" class="form-control" placeholder="e.g.,120" value="<?php echo $result['Rate']; ?>" autocomplete="off" readonly>
</div>
 <div class="form-group col-md-2">
<label class="form-label">Qty </label>
<input type="text" name="Quantity[]" id="Quantity<?php echo $i;?>" class="form-control" placeholder="e.g.,1" value="<?php echo $result['Quantity']; ?>" autocomplete="off" oninput="getTotal(<?php echo $i;?>)">
</div>


<input type="hidden" class="form-control" name="srno[]" id="srno<?php echo $i; ?>" value="<?php echo $i; ?>">
<input type="hidden" class="form-control PrimeDisc" name="PrimeDisc[]" id="PrimeDisc<?php echo $i;?>" value="<?php echo $result['PrimeDisc']; ?>">
<!--<input type="hidden" name="Rate[]" id="Rate<?php echo $i;?>" class="form-control" placeholder="e.g.,120" value="<?php echo $result['Rate']; ?>" autocomplete="off" readonly>-->
<input type="hidden" name="DisRate[]" id="DisRate<?php echo $i;?>" class="form-control DisRate" placeholder="e.g.,120" value="" autocomplete="off" readonly>


 <div class="form-group col-md-2">
<label class="form-label">Total </label>
<div class="input-group">
<input type="text" name="Price[]" id="Price<?php echo $i;?>" class="form-control txt" placeholder="e.g.,120" value="<?php echo $result['Price']; ?>" autocomplete="off" readonly>
<span class="input-group-append">
    <a onClick="return confirm('Are you sure you want delete this Record');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $result['id']; ?>&action=deletemember&oid=<?php echo $_GET['id']; ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
  </span>
</div>
</div>
  </div>
<?php $i++;} ?>

<div id="dynamic_field">
 <div class="form-row">
    <div class="form-group col-md-3">
<label class="form-label">Category</label>
 <select class="form-control" id="CatId<?php echo $row_cnt; ?>" name="CatId[]" onchange="getProduct(this.value,<?php echo $row_cnt; ?>)">
                            <option selected value="">...</option>
                             
 <?php 
     $sql4 = "SELECT * FROM category WHERE Status=1 AND id!=9";
     $row4 = getList($sql4);
     foreach($row4 as $result)
      {
          if($result['Roll'] == 1){
            $Roll = "Franchise";  
          }
          else if($result['Roll'] == 2){
            $Roll = "Employee";  
          }
          else if($result['Roll'] == 4){
            $Roll = "Customer";  
          }
          else{
              $Roll = "All";
          }
      ?>
    <option value="<?php echo $result['id']; ?>"><?php echo $result['Name']." (".$Roll.")"; ?></option>
<?php } ?>

 
                           </select>
<div class="clearfix"></div>
</div>
    <div class="form-group col-md-3">
<label class="form-label">Product</label>
<select class="form-control" id="ProductId<?php echo $row_cnt; ?>" name="ProductId[]" 
onchange="getRate(this.value,<?php echo $row_cnt; ?>,document.getElementById('Quantity<?php echo $row_cnt; ?>').value)">
                            <option selected value="">...</option>
                             
 <?php 
     $sql4 = "SELECT * FROM products WHERE Status=1";
     $row4 = getList($sql4);
     foreach($row4 as $result)
      {
      ?>
    <option value="<?php echo $result['id']; ?>"><?php echo $result['ProductName']; ?></option>
<?php } ?>
 
                           </select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-2">
<label class="form-label">Rate </label>
<input type="text" name="Rate[]" id="Rate<?php echo $row_cnt;?>" class="form-control" placeholder="e.g.,120" value="" autocomplete="off" readonly>
</div>



 <div class="form-group col-md-2">
<label class="form-label">Qty </label>
<input type="text" name="Quantity[]" id="Quantity<?php echo $row_cnt;?>" class="form-control" placeholder="e.g.,1" value="1" autocomplete="off" min="1" oninput="getTotal(<?php echo $row_cnt;?>)">
</div>


<input type="hidden" class="form-control" name="srno[]" id="srno<?php echo $row_cnt; ?>" value="<?php echo $row_cnt; ?>">
<input type="hidden" class="form-control" name="rncnt" id="rncnt" value="<?php echo $row_cnt; ?>">
<input type="hidden" class="form-control PrimeDisc" name="PrimeDisc[]" id="PrimeDisc<?php echo $row_cnt;?>" value="">
<!--<input type="hidden" name="Rate[]" id="Rate<?php echo $row_cnt;?>" class="form-control" placeholder="e.g.,120" value="" autocomplete="off" readonly>-->
<input type="hidden" name="DisRate[]" id="DisRate<?php echo $row_cnt;?>" class="form-control DisRate" placeholder="e.g.,120" value="" autocomplete="off" readonly>


 <div class="form-group col-md-2">
<label class="form-label">Total </label>
<div class="input-group">
<input type="text" name="Price[]" id="Price<?php echo $row_cnt;?>" class="form-control txt" placeholder="e.g.,120" value="" autocomplete="off" readonly>
<span class="input-group-append">
    <button class="btn btn-secondary" type="button" id="add_more"><i class="fa fa-plus"></i></button>
  </span>
</div>
</div>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-4">
<label class="form-label">Sub Total </label>
<input type="text" name="SubTotal" id="SubTotal" class="form-control" placeholder="" value="<?php echo $row7["OrderTotal"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Discount </label>
<input type="text" name="Discount" id="Discount" class="form-control" placeholder="" value="<?php echo $row7["Discount"]; ?>" onKeyPress="return isNumberKey(event)" oninput="netAmount(document.getElementById('SubTotal').value,document.getElementById('Discount').value)">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Coupon Code </label>
<select class="form-control" id="CouponCode" name="CouponCode" onchange="checkCoupon(this.value)">
                            <option selected value="">...</option>
                             
 <?php 
     $sql4 = "SELECT * FROM tbl_coupon_code WHERE Status=1";
     $row4 = getList($sql4);
     foreach($row4 as $result)
      {
      ?>
    <option <?php if($row7["CouponCode"] == $result['Code']){?> selected <?php } ?> value="<?php echo $result['Code']; ?>"><?php echo $result['Code']; ?></option>
<?php } ?>
 
                           </select>
<!-- <input type="text" name="CouponCode" id="CouponCode" class="form-control" placeholder="" value="<?php echo $row7["CouponCode"]; ?>" oninput="checkCoupon()">
<div class="clearfix"></div> -->
 <span id="error_msg" style="color:red;padding-left: 10px;font-size: 11px;"></span>
                    <span id="success_msg" style="color:#46d646;"></span>
</div>

<div class="form-group col-md-4">
<label class="form-label">Coupon Amount </label>
<input type="text" name="Promoprice" id="CouponAmt" class="form-control" placeholder="" value="<?php echo $row7["Promoprice"]; ?>" readonly>
<div class="clearfix"></div>
</div>


<div class="form-group col-md-4">
<label class="form-label">Total Amount</label>
<input type="text" name="TotalAmount" id="TotalAmount" class="form-control" placeholder="" value="<?php echo $row7["OrderTotal"]-$row7["Discount"]-$row7["Promoprice"]; ?>" readonly>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
<label class="form-label">Order Date </label>
<input type="date" name="OrderDate" id="OrderDate" class="form-control" placeholder="" value="<?php echo $row7["OrderDate"]; ?>">
<div class="clearfix"></div>
</div>

<div class="form-group col">
<label class="form-label">Payment Type</label>
  <select class="form-control" id="PaymentMethod" name="PaymentMethod" >
<option selected="" value="">Select Payment Type</option>
<?php 
     $sql4 = "SELECT * FROM payment_method WHERE Status=1 AND id!=2";
     $row4 = getList($sql4);
     foreach($row4 as $result)
      {
      ?>
    <option <?php if($row7['PaymentMethod']==$result['id']){ ?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['Name']; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

</div>



<!-- <button id="growl-default" class="btn btn-default">Default</button> -->
<button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Save</button>
</form>
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
    function getCustDetails(val){
        var action = "getCustDetails";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,id:val},
    success:function(data)
    {
        var res = JSON.parse(data);
        $('#Member').val(res.Member);
        if(res.Member == 1){}
   else{
    $('.PrimeDisc').val(0);
    $('.DisRate').val(0);
   }

    }
    });
    }

      function checkDiscount(userid,catid,srno){
var Member = $('#Member').val();
    var action = "checkDiscount";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,catid:catid,userid:userid},
    success:function(data)
    {
        if(Member == 1){
       $('#PrimeDisc'+srno).val(data);
   }
   else{
    $('#PrimeDisc'+srno).val(0);
$('.PrimeDisc').val(0);
    $('.DisRate').val(0);
   }
    }
    });
}

      function getProduct(val,srno){
          var UserId = $('#UserId').val();
        checkDiscount(UserId,val,srno);
         var action = "getProduct";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,catid:val},
    success:function(data)
    {
        //alert(data);
        //console.log(data);
      $('#ProductId'+srno).html(data);

    }
    });
    }
function checkCoupon(CouponCode){
       //var CouponCode = $('#CouponCode').val();
       var SubTotal = $('#SubTotal').val();
       var UserId = $('#UserId').val();
       var action = "applyCoupon";
        var TotalAmount = $('#SubTotal').val();
         var Discount = $('#Discount').val();
         var id = $('#id').val();
        if(CouponCode == ''){
            $('#error_msg').html("");
            $('#success_msg').html("");
      
        $('#CouponAmt').val('');
        $('#Coupon_Code').val('');
        var Total_Amount = Number(TotalAmount) - Number(Discount);
        $('#TotalAmount').val(parseFloat(Total_Amount).toFixed(2));
        }
        else{
    $.ajax({
    url:"ajax_files/ajax_orders.php",
    method:"POST",
    data : {action:action,CouponCode:CouponCode,SubTotal:SubTotal,UserId:UserId,id:id},
    success:function(data)
    {
       
        //alert(data);
        var res = JSON.parse(data);
    var Status = res.Status;
    var MinOrder = res.MinOrder;
    var CouponAmt = parseFloat(res.CouponAmt).toFixed(2);
      if(Status == 1){
        $('#success_msg').html("Coupon Applied Successfully!");
        $('#error_msg').html("");
        $('#CouponCode').attr("disabled",false);
        
        $('#CouponAmt').val(CouponAmt);
        $('#Coupon_Code').val(CouponCode);
        var Total_Amount = Number(TotalAmount) - Number(CouponAmt) - Number(Discount);
       $('#TotalAmount').val(parseFloat(Total_Amount).toFixed(2))
      }
      else if(Status == 2){
        $('#error_msg').html("Coupon Code Expired!");
        $('#success_msg').html("");
      
        $('#CouponAmt').val('');
        $('#Coupon_Code').val('');
        var Total_Amount = Number(TotalAmount) - Number(Discount);
        $('#TotalAmount').val(parseFloat(Total_Amount).toFixed(2));
      }
      else if(Status == 3){
        $('#error_msg').html("Coupon Code Already Used!");
        $('#success_msg').html("");
       
        $('#CouponAmt').val('');
        $('#Coupon_Code').val('');
       var Total_Amount = Number(TotalAmount) - Number(Discount);
        $('#TotalAmount').val(parseFloat(Total_Amount).toFixed(2));
      }
      else if(Status == 4){
        $('#error_msg').html("Min Purchase Order Amount Must Be Greater Than ₹"+MinOrder);
        $('#success_msg').html("");
      
        $('#CouponAmt').val('');
        $('#Coupon_Code').val('');
        var Total_Amount = Number(TotalAmount) - Number(Discount);
        $('#TotalAmount').val(parseFloat(Total_Amount).toFixed(2));
      }
      else{
        $('#error_msg').html("Invalid Coupon Code!!");
        $('#success_msg').html("");
      
        $('#CouponAmt').val('');
        $('#Coupon_Code').val('');
        var Total_Amount = Number(TotalAmount) - Number(Discount);
        $('#TotalAmount').val(parseFloat(Total_Amount).toFixed(2));
      }
       
    }   
    });
        }
   }

   function getDisRateTotal(){
     var sum = 0;
      $(".DisRate").each(function() {
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }
   });
     $('#Discount').val(sum);
   }
  function getSubTotal(){
     var sum = 0;
      $(".txt").each(function() {
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }
   });
     $('#SubTotal').val(sum);
     //getDisRateTotal();
    }

    function netAmount(subtotal,discount){
        var CouponAmt = $('#CouponAmt').val();
  var TotalAmount = Number(subtotal) - Number(discount) - Number(CouponAmt);
      $('#TotalAmount').val(parseFloat(TotalAmount).toFixed(2));
}  

  function getTotal(srno){
     var PrimeDisc = $('#PrimeDisc'+srno).val();
    var Quantity = $('#Quantity'+srno).val();
    var Rate = $('#Rate'+srno).val();
    var Total = Number(Quantity)*Number(Rate);
    $('#Price'+srno).val(Total);
    var Total2 = (Number(Total) * (Number(PrimeDisc)/100));
    $('#DisRate'+srno).val(Total2);
    getSubTotal();
    var SubTotal = $('#SubTotal').val();
    var Discount = $('#Discount').val();
    var CouponCode = $('#CouponCode').val();
    checkCoupon(CouponCode);
    netAmount(SubTotal,Discount);
  }
   function getRate(val,srno,qty){
       //alert(val);alert(srno);alert(type);
    var action = "getRate";
    var PrimeDisc = $('#PrimeDisc'+srno).val();
    $.ajax({
    url:"ajax_files/ajax_orders.php",
    method:"POST",
    data : {action:action,val:val},
    success:function(data)
    {
        console.log(qty,srno,data);
        var Total2 = Number(data)*Number(qty);
      var Total = (Number(Total2) * (Number(PrimeDisc)/100));
      $('#DisRate'+srno).val(Total);
     // var Total = Number(data)*Number(qty);
      $('#Rate'+srno).val(data);
      $('#Price'+srno).val(Total2);
      getSubTotal();
      var SubTotal = $('#SubTotal').val();
      var Discount = $('#Discount').val();
     
      netAmount(SubTotal,Discount);
       var CouponCode = $('#CouponCode').val();
    checkCoupon(CouponCode);
    }   
    }); 
   }
  $(document).ready(function(){
       getSubTotal();
      var SubTotal = $('#SubTotal').val();
      var Discount = $('#Discount').val();
      netAmount(SubTotal,Discount);
      var CouponCode = $('#CouponCode').val();
    checkCoupon(CouponCode);
  var i=$('#rncnt').val(); 
    $('#add_more').click(function(){  
           i++;  
       var action = "addMoreService2";
    $.ajax({
    url:"ajax_files/ajax_orders.php",
    method:"POST",
    data : {action:action,id:i},
    success:function(data)
    {
      $('#dynamic_field').append(data);
    }   
    });  
    }); 

    $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete?"))  
           { 
           $('#row'+button_id+'').remove(); 
            getSubTotal();
     //caldiscount();
     var SubTotal = $('#SubTotal').val();
    var Discount = $('#Discount').val();
     netAmount(SubTotal,Discount);
      var CouponCode = $('#CouponCode').val();
    checkCoupon(CouponCode);
            
           }
      }); 

  }); 
</script>

</body>
</html>
