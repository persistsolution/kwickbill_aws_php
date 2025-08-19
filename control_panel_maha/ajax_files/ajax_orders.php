<?php 
session_start();
include_once '../config.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'addMoreService'){
	$i = $_POST['id'];?>
	 <div class="form-row" id="row<?php echo $i;?>">

         <div class="form-group col-md-3">
<label class="form-label">Category</label>
<select class="form-control" id="CatId<?php echo $i; ?>" name="CatId[]" 
    onchange="getProduct(this.value,document.getElementById('srno<?php echo $i; ?>').value)">
<option selected="" disabled="">Select Category</option>
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
</div>

   <div class="form-group col-md-4">
<label class="form-label">Product</label>
<select class="form-control" id="ProductId<?php echo $i; ?>" name="ProductId[]">
<option selected="" disabled="">Select Product</option>
 
</select>
<div class="clearfix"></div>
</div>

<input type="hidden" class="form-control" name="srno[]" id="srno<?php echo $i; ?>" value="<?php echo $i; ?>">

 <div class="form-group col-md-2">
<label class="form-label">Qty </label>
<div class="input-group">
<input type="text" name="Quantity[]" id="Quantity<?php echo $i;?>" class="form-control" placeholder="e.g.,1"  value="1" autocomplete="off" min="1" autocomplete="off">
<span class="input-group-append">
    <button class="btn btn-danger btn_remove" type="button" id="<?php echo $i;?>"><i class="fa fa-times"></i></button>
  </span>
</div>
</div>

  </div>
<?php }

if($_POST['action'] == 'getRate'){
$ProdId = $_POST['val'];
$type = $_POST['type'];
$sql = "SELECT MinPrice FROM products WHERE id='$ProdId'";
$row = getRecord($sql);
$MinPrice = $row['MinPrice'];    
echo $MinPrice;
} 


if($_POST['action'] == 'addMoreService2'){
    $i = $_POST['id'];?>
     <div class="form-row" id="row<?php echo $i;?>">
     <div class="form-group col-md-3">
<label class="form-label">Category</label>
 <select class="form-control" id="CatId<?php echo $i; ?>" name="CatId[]" onchange="getProduct(this.value,<?php echo $i; ?>)">
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
<select class="form-control" id="ProductId<?php echo $i; ?>" name="ProductId[]" onchange="getRate(this.value,<?php echo $i; ?>,document.getElementById('Quantity<?php echo $i; ?>').value)">
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
<!--<input type="hidden" name="Rate[]" id="Rate<?php echo $i;?>" class="form-control" placeholder="e.g.,120" value="" autocomplete="off" readonly>-->
<input type="hidden" name="DisRate[]" id="DisRate<?php echo $i;?>" class="form-control DisRate" placeholder="e.g.,120" value="" autocomplete="off" readonly>
<input type="hidden" class="form-control" name="srno[]" id="srno<?php echo $i; ?>" value="<?php echo $i; ?>">
<input type="hidden" class="form-control PrimeDisc" name="PrimeDisc[]" id="PrimeDisc<?php echo $i;?>" value="">

 <div class="form-group col-md-2">
<label class="form-label">Rate </label>
<input type="text" name="Rate[]" id="Rate<?php echo $i;?>" class="form-control" placeholder="e.g.,120" value="" autocomplete="off" readonly>
</div>
 <div class="form-group col-md-2">
<label class="form-label">Qty </label>
<input type="text" name="Quantity[]" id="Quantity<?php echo $i;?>" class="form-control" placeholder="e.g.,1"  value="1" autocomplete="off" min="1" autocomplete="off" oninput="getTotal(<?php echo $i;?>)">
</div>
 <div class="form-group col-md-2">
<label class="form-label">Total </label>
<div class="input-group">
<input type="text" name="Price[]" id="Price<?php echo $i;?>" class="form-control txt" placeholder="e.g.,120" value="" autocomplete="off" readonly>
<span class="input-group-append">
    <button class="btn btn-danger btn_remove" type="button" id="<?php echo $i;?>"><i class="fa fa-times"></i></button>
  </span>
</div>
</div>
  </div>
<?php } 

if($_POST['action'] == 'addMoreService3'){
    $i = $_POST['id'];?>
     <div class="form-row" id="row<?php echo $i;?>">
     <div class="form-group col-md-2">
<label class="form-label">Category</label>
 <select class="form-control" id="CatId<?php echo $i; ?>" name="CatId[]" onchange="getProduct(this.value,<?php echo $i; ?>)">
                            <option selected value="">...</option>
                             
 <?php 
     $sql4 = "SELECT * FROM category WHERE Status=1 AND id!=9";
     $row4 = getList($sql4);
     foreach($row4 as $result)
      {
      ?>
    <option value="<?php echo $result['id']; ?>"><?php echo $result['Name']; ?></option>
<?php } ?>

 
                           </select>
<div class="clearfix"></div>
</div>
    <div class="form-group col-md-3">
<label class="form-label">Product</label>
<select class="form-control" id="ProductId<?php echo $i; ?>" name="ProductId[]" onchange="getRate(this.value,<?php echo $i; ?>,document.getElementById('Type<?php echo $i; ?>').value,document.getElementById('Quantity<?php echo $i; ?>').value)">
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
<input type="hidden" name="Rate[]" id="Rate<?php echo $i;?>" class="form-control" placeholder="e.g.,120" value="" autocomplete="off" readonly>
<!--<input type="hidden" name="DisRate[]" id="DisRate<?php echo $i;?>" class="form-control DisRate" placeholder="e.g.,120" value="" autocomplete="off" readonly>-->
<input type="hidden" class="form-control" name="srno[]" id="srno<?php echo $i; ?>" value="<?php echo $i; ?>">
<input type="hidden" class="form-control PrimeDisc" name="PrimeDisc[]" id="PrimeDisc<?php echo $i;?>" value="">
<div class="form-group col-md-2">
<label class="form-label">Type </label>
<select class="form-control" name="Type[]" id="Type<?php echo $i;?>" onchange="getRate(document.getElementById('ProductId<?php echo $i; ?>').value,<?php echo $i; ?>,this.value,document.getElementById('Quantity<?php echo $i; ?>').value)">
    <!--<option value="0" selected>...</option>-->
    <option value="1" selected>Normal</option>
    <option value="2">Heavy</option>
</select>
</div>


<!-- <div class="form-group col-md-2">
<label class="form-label">Rate </label>
<input type="text" name="Rate[]" id="Rate<?php echo $i;?>" class="form-control" placeholder="e.g.,120" value="" autocomplete="off" readonly>
</div>-->
 <div class="form-group col-md-1">
<label class="form-label">Qty </label>
<input type="text" name="Quantity[]" id="Quantity<?php echo $i;?>" class="form-control" placeholder="e.g.,1"  value="1" autocomplete="off" min="1" autocomplete="off" oninput="getTotal(<?php echo $i;?>)">
</div>

 <div class="form-group col-md-2">
     <label class="form-label">Total </label>

<input type="text" name="Price[]" id="Price<?php echo $i;?>" class="form-control txt" placeholder="e.g.,120" value="" autocomplete="off" readonly>

</div>

 <div class="form-group col-md-2">
<label class="form-label">Discount </label>
<div class="input-group">
<input type="text" name="DisRate[]" id="DisRate<?php echo $i;?>" class="form-control DisRate" placeholder="e.g.,1" value="" autocomplete="off" readonly>
<span class="input-group-append">
    <button class="btn btn-danger btn_remove" type="button" id="<?php echo $i;?>"><i class="fa fa-times"></i></button>
  </span>
</div>
</div>
  </div>
<?php } 

if($_POST['action'] == 'getPrimePoint'){
    $ProdId = $_POST['val'];
$sql = "SELECT Points FROM tbl_prime_products WHERE id='$ProdId'";
$row = getRecord($sql);
echo $row['Points'];
}

if($_POST['action'] == 'applyCoupon'){
$CurrDate = date('Y-m-d');    
$CouponCode = addslashes(trim($_POST['CouponCode']));
$GrandTotal = addslashes(trim($_POST['SubTotal']));
$UserId = addslashes(trim($_POST['UserId']));
$id = $_POST['id'];
 $sql = "SELECT * FROM tbl_coupon_code WHERE Code='$CouponCode'";
$rncnt = getRow($sql);
if($rncnt > 0){
    $row = getRecord($sql);
    $FromDate = $row['FromDate'];
    $ToDate = $row['ToDate'];
    $MinOrder = $row['MinOrder'];
    $Discount = $row['Discount'];
    if($row['Type'] == 1){
    $CouponAmt = $GrandTotal * ($Discount/100);
    }
    else{
    $CouponAmt = $Discount;    
    }
    if($GrandTotal >= $MinOrder){
    $sql3 = "SELECT * FROM tbl_applied_code WHERE UserId='$UserId' AND Code='$CouponCode'";
    $rncnt3 = getRow($sql3);
    $sql2 = "SELECT * FROM tbl_coupon_code WHERE Code='$CouponCode' AND FromDate<='$CurrDate' AND ToDate>='$CurrDate'";
    $rncnt2 = getRow($sql2);
    
    if($id==''){
    if($rncnt3 > 0){
        unset($_SESSION['CouponCode']);
        unset($_SESSION['CouponAmt']);
        echo json_encode(array('Status'=>3));//Already Used
    }
    else if($rncnt2 > 0){
        $_SESSION['CouponCode'] = $CouponCode;
        $_SESSION['CouponAmt'] = $CouponAmt;
        echo json_encode(array('CouponAmt'=>$CouponAmt,'Status'=>1));//Applied
    }
    else{
        unset($_SESSION['CouponCode']);
        unset($_SESSION['CouponAmt']);
        echo json_encode(array('Status'=>2));//Coupon Expired
    }
    }
    else{
        if($rncnt2 > 0){
        $_SESSION['CouponCode'] = $CouponCode;
        $_SESSION['CouponAmt'] = $CouponAmt;
        echo json_encode(array('CouponAmt'=>$CouponAmt,'Status'=>1));//Applied
    }
    else{
        unset($_SESSION['CouponCode']);
        unset($_SESSION['CouponAmt']);
        echo json_encode(array('Status'=>2));//Coupon Expired
    }
    }
}
else{
    unset($_SESSION['CouponCode']);
    unset($_SESSION['CouponAmt']);
    echo json_encode(array('MinOrder'=>$MinOrder,'Status'=>4));//Min Order
}
}
else{
    unset($_SESSION['CouponCode']);
    unset($_SESSION['CouponAmt']);
    echo json_encode(array('Status'=>0));//Invalid Coupon
}
}

if($_POST['action'] == 'removeCoupon'){
    unset($_SESSION['CouponCode']);
    unset($_SESSION['CouponAmt']);
}
?>