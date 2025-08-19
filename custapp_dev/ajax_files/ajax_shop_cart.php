<?php
session_start();
include_once '../config.php';
require_once("../dbcontroller.php");
require_once "../database.php";
//require_once "../../exe-database.php";
//require_once "../../admin-database.php";
$SiteUrl = "https://dailydoorservices.com/mobapp";
$AdminSiteUrl = "https://dailydoorservices.com/adminapp";
//include_once '../class.phpmailer.php';
//include_once '../class.smtp.php';
$db_handle = new DBController();
$user_id = $_SESSION['User']['id'];
$sql110 = "SELECT * FROM tbl_users WHERE id='$user_id'";
$row110 = getRecord($sql110);
$AccName = $row110['AccName'];
$Roll = $row110['Roll'];
$Member = 0;
$CustLocation = 1;
/*$sql55 = "SELECT * FROM tbl_offer_percentage WHERE AccountId='7'";
$row55 = getRecord($sql55);
$DiscPer = $row55['Percentage'];*/
$UserEmail = $_SESSION['User']['EmailId'];
if($_POST['action'] == 'shop_cart'){
 if(!empty($_POST["quantity"])) {
    $productByCode = $db_handle->runQuery("SELECT * FROM tbl_cust_products_2025 WHERE code='" . $_POST["code"] . "'");
      //$price = $productByCode[0]["MinPrice"];
      $price = $_POST["price"];
      $qty = $_POST["quantity"];
      $total_price = $price * $qty;
      
 
      $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["ProductName"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$_POST["price"],'totalprice'=>$total_price,'sizeid'=>$_POST['sizeid'],'ramid'=>$_POST['ramid'],'storageid'=>$_POST['storageid'],'colorid'=>$_POST['colorid'],'Type'=>'Cart'));
      if(!empty($_SESSION["cart_item"])) {
        if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
          foreach($_SESSION["cart_item"] as $k => $v) {
              if($productByCode[0]["code"] == $k)
                $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }

    echo "Product Added";
}

if($_POST['action'] == 'sub_shop_cart'){
 if(!empty($_POST["quantity"])) {
    $Repeat = $_REQUEST['Repeat'];
    if($Repeat == 'daily'){
    $Daily = implode(",",$_REQUEST['Daily']);
    $WeekDays = '';
    $Weekends = '';  
    }
    else if($Repeat == 'weekdays'){
    $Daily = '';
    $WeekDays = implode(",",$_REQUEST['WeekDays']);
    $Weekends = '';
    }
    else{
    $Daily = '';
    $WeekDays = '';
    $Weekends = implode(",",$_REQUEST['Weekends']);  
    }
    
    $Recharge = $_REQUEST['Recharge'];
    $StartDate = $_REQUEST['StartDate'];
    $pid = $_REQUEST['pid'];
    $sizeid = $_REQUEST['sizeid'];
    $ramid = $_REQUEST['ramid'];
    $storageid = $_REQUEST['storageid'];
    $code = $_REQUEST['code'];
    
    $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_POST["code"] . "'");
      //$price = $productByCode[0]["MinPrice"];
      //$price = $_POST["price"];
     $price = $_REQUEST['prd_price'];
      $qty = $_POST["quantity"];
      $total_price = $price * $qty * $Recharge;
      
 
     $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["ProductName"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$price,'totalprice'=>$total_price,'sizeid'=>$_POST['sizeid'],'Repeat'=>$_POST['Repeat'],'Daily'=>$Daily,'WeekDays'=>$WeekDays,'Weekends'=>$Weekends,'Recharge'=>$_POST['Recharge'],'StartDate'=>$_POST['StartDate'],'Type'=>'Subscription'));
      if(!empty($_SESSION["cart_item2"])) {
        if(in_array($productByCode[0]["code"],$_SESSION["cart_item2"])) {
          foreach($_SESSION["cart_item2"] as $k => $v) {
              if($productByCode[0]["code"] == $k)
                $_SESSION["cart_item2"][$k]["quantity"] = $_POST["quantity"];
          }
        } else {
          $_SESSION["cart_item2"] = array_merge($_SESSION["cart_item2"],$itemArray);
        }
      } else {
        $_SESSION["cart_item2"] = $itemArray;
      }
    }

    echo "Product Added";
}

if($_POST['action'] == 'shop_cart2'){
  $pid = $_POST['pid'];
   $quantity = $_POST['quantity'];
  $code = $_POST['code'];
   $price = $_POST['price'];
  foreach($_SESSION["cart_item"] as &$value){
        if($value['code'] === $_POST["code"]){
            $value['quantity'] = $_POST["quantity"];
             $value['price'] = $_POST["price"];
            $value['totalprice'] = $value['quantity'] * $value['price'];
            break; // Stop the loop after we've found the product
        }
    }
    foreach ($_SESSION["cart_item"] as $product){
        $Type = $product['Type'];
        $Recharge = $product['Recharge'];
         if($Type == 'Subscription'){
            $total_price4_1 += ($product["price"]*$product["quantity"]*$Recharge);
         }
         else{
        $total_price4_2 += ($product["price"]*$product["quantity"]);
        }
        //$total_price4 = ($total_price3 - ($total_price3)*0.18);
        }

            foreach ($_SESSION["cart_item2"] as $product){
        $Type = $product['Type'];
        $Recharge = $product['Recharge'];
         if($Type == 'Subscription'){
            $total_price4_1 += ($product["price"]*$product["quantity"]*$Recharge);
         }
         else{
        $total_price4_2 += ($product["price"]*$product["quantity"]);
        }
        //$total_price4 = ($total_price3 - ($total_price3)*0.18);
        }
$total_price4 = $total_price4_1 + $total_price4_2;

$sql22 = "SELECT * FROM tbl_service_fee";
$res22 = $conn->query($sql22);
$rncnt22 = mysqli_num_rows($res22);
$row22 = $res22->fetch_assoc();
$OrderPrice = $row22['OrderPrice']; 
if($total_price4 <= $OrderPrice){   
                    if($PackageStatus==1){
                        $ShippingPrice = '0.00';
                    }
                    else{
                   $ShippingPrice = $row22['Fee']; 
                    }
                } 
                else{ 
                  $ShippingPrice = '0.00';
               } 
$netamt = $total_price4+$ShippingPrice;
//$disc = $netamt*($DiscPer/100);
//$totnetamt =  $netamt-$disc;
 if($Member == 0){
                  /*if($netamt >= 1200){
                    $totnetamt =  $total_price4+$ShippingPrice-700;
                    $disc = 700;
                    $per_disc = "";
                  }
                  else{
                    $totnetamt = $total_price4+$ShippingPrice;  
                    $per_disc = "";
                  }*/
                   $disc = $netamt*($DiscPer/100);
                    $totnetamt = $netamt - $disc;
                    $per_disc = "(".substr($DiscPer,0,-3)."%)";
                }
                else{
                    $disc = $netamt*($DiscPer/100);
                    $totnetamt = $netamt - $disc;
                    $per_disc = "(".substr($DiscPer,0,-3)."%)";
                }                
$sub_total =  number_format($total_price4,2);
$total_price =  number_format($netamt,2);
$disc_price = number_format($disc,2);

        //$total_price =  number_format($total_price4,2);
        $product_price = $price * $quantity;
        $product_price2 = number_format($product_price,2);
 echo json_encode(array('Price' => $product_price,'Price2' => $product_price2,'total_price'=>$total_price,'ShippingPrice'=>$ShippingPrice,'sub_total'=>$sub_total,'discount'=>$disc_price,'discountwo'=>$disc));
}


if($_POST['action'] == 'delete_shop_prod'){
    $output = "";
    if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_POST["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                        if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                           
                }
            } 

    if(!empty($_SESSION["cart_item2"])) {
                foreach($_SESSION["cart_item2"] as $k => $v) {
                    if($_POST["code"] == $k)
                        unset($_SESSION["cart_item2"][$k]);
                        if(empty($_SESSION["cart_item2"]))
                            unset($_SESSION["cart_item2"]);
                           
                }
            }         
foreach ($_SESSION["cart_item"] as $product){
    $Type = $product['Type'];
        $Recharge = $product['Recharge'];
         if($Type == 'Subscription'){
    $total_price4_1 += ($product["price"]*$product["quantity"]*$Recharge);
    }
    else{
     $total_price4_2 += ($product["price"]*$product["quantity"]);   
        }
    }

    foreach ($_SESSION["cart_item2"] as $product){
    $Type = $product['Type'];
        $Recharge = $product['Recharge'];
         if($Type == 'Subscription'){
    $total_price4_1 += ($product["price"]*$product["quantity"]*$Recharge);
    }
    else{
     $total_price4_2 += ($product["price"]*$product["quantity"]);   
        }
    }
        
$sql22 = "SELECT * FROM tbl_service_fee";
$res22 = $conn->query($sql22);
$rncnt22 = mysqli_num_rows($res22);
$row22 = $res22->fetch_assoc();
$OrderPrice = $row22['OrderPrice']; 
if($total_price4 <= $OrderPrice){   
                    if($PackageStatus==1){
                        $ShippingPrice = '0.00';
                    }
                    else{
                   $ShippingPrice = $row22['Fee']; 
                    }
                } 
                else{ 
                  $ShippingPrice = '0.00';
               } 
//$sub_total =  number_format($total_price4,2);
//$total_price =  number_format($total_price4+$ShippingPrice,2);
$netamt = $total_price4+$ShippingPrice;
//$disc = $netamt*($DiscPer/100);
//$totnetamt =  $netamt-$disc;
 if($Member == 0){
                  /*if($netamt >= 1200){
                    $totnetamt =  $total_price4+$ShippingPrice-700;
                    $disc = 700;
                    $per_disc = "";
                  }
                  else{
                    $totnetamt = $total_price4+$ShippingPrice;  
                    $per_disc = "";
                  }*/
                  $disc = $netamt*($DiscPer/100);
                    $totnetamt = $netamt - $disc;
                    $per_disc = "(".substr($DiscPer,0,-3)."%)";
                }
                else{
                    $disc = $netamt*($DiscPer/100);
                    $totnetamt = $netamt - $disc;
                    $per_disc = "(".substr($DiscPer,0,-3)."%)";
                }                        
$sub_total =  number_format($total_price4,2);
$total_price =  number_format($netamt,2);
$disc_price = number_format($disc,2);
  echo json_encode(array('cnt_val' => count($_SESSION["cart_item"]),'total_price'=>$total_price,'ShippingPrice'=>$ShippingPrice,'sub_total'=>$sub_total,'discount'=>$disc_price,'discountwo'=>$disc));
 }  


 if($_POST['action'] == 'show_cart'){
 if(isset($_SESSION["cart_item"])){
    $total_price = 0;
       foreach ($_SESSION["cart_item"] as $product){
        if($product['Type'] == 'Cart'){
       $Prod_code = $product["code"];
      $SizeId = $product['sizeid'];
      $sql = "SELECT * FROM products WHERE code = '$Prod_code'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $sql5 = "SELECT * FROM attribute_value WHERE id='$SizeId'";
      $res5 = $conn->query($sql5);
      $row5 = $res5->fetch_assoc();
      $total_price2 = ($product["price"]*$product["quantity"]);
      $total_price3 += ($product["price"]*$product["quantity"]);
      $total_price =  number_format($total_price3,2);
      if($row5['Name'] == ''){
          $attr_name = "";
      }
      else{
        $attr_name = " (".$row5['Name'].")";
      }
      $SubCatId = $row['SubCatId'];
      $sql11 = "SELECT Name FROM sub_category2 WHERE id='$SubCatId'";
      $row11 = getRecord($sql11);
      ?> 
                <div class="media mb-4 w-100">
                    <div class="avatar avatar-60 mr-3 has-background rounded">
                     
                        <a href="product-details.php" class="background">
                             <?php if($row["Photo"] == '') {?>
                  <img src="../no_image.jpg" style="width: 60px;height: 60px;"> 
                 <?php } else if(file_exists('../../uploads/'.$row["Photo"])){?>
                 <img src="../uploads/<?php echo $row["Photo"];?>" alt="" style="width: 60px;height: 60px;">
                  <?php }  else{?>
                 <img src="../no_image.jpg" style="width: 60px;height: 60px;"> 
             <?php } ?>
                            <img src="img/image9.jpg" class="" alt="">
                        </a>
                    </div>
                     <input type="hidden" id="price<?php echo $row["id"]; ?>" value="<?php echo $product["price"]; ?>">
                     <input type="hidden" id="code<?php echo $row["id"]; ?>" value="<?php echo $product["code"]; ?>">
                    <div class="media-body">
                        <small class="text-secondary"><?php echo $row11['Name']; ?></small>
                        <a href="product.html">
                            <p class="mb-1"><?php echo $row["ProductName"]; ?></p>
                        </a>
                        <p><span class="text-success">&#8377;<?php echo number_format($product["price"],2); ?></span>
                           <?php if($attr_name != '') {?> 
                         <span class="text-secondary small">Size: <?php echo $attr_name; ?></span><?php } ?></p>
                    </div>
                    <div class="align-self-center">
                        <div class="input-group cart-count">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" onclick="changeMinus(<?php echo $row["id"]; ?>);">-</button>
                            </div>
                            <input type="text" class="form-control" placeholder="1" value="<?php echo $product["quantity"]; ?>"id="qntno<?php echo $row["id"]; ?>" min="1" readonly="">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="changePlus(<?php echo $row["id"]; ?>);">+</button>
                            </div>
                            
                        </div>
                        <a href="javascript:void(0)" id="<?php echo $product["code"]; ?>" onclick="delete_prod2(this.id)"><i class="fa fa-trash" style="color: red;padding-top: 7px;padding-left: 28px;"></i></a>
                        
                    </div>
                </div>
<?php } } } }

 if($_POST['action'] == 'sub_show_cart'){
if(isset($_SESSION["cart_item2"])){
    $total_price = 0;
       foreach ($_SESSION["cart_item2"] as $product){
        if($product['Type'] == 'Subscription'){
       $Prod_code = $product["code"];
      $SizeId = $product['sizeid'];
      $sql = "SELECT * FROM products WHERE code = '$Prod_code'";
    $result = $conn->query($sql);
   $row = $result->fetch_assoc();
    $sql5 = "SELECT * FROM attribute_value WHERE id='$SizeId'";
     $res5 = $conn->query($sql5);
$row5 = $res5->fetch_assoc();
  $total_price2 = ($product["price"]*$product["quantity"]*$product["Recharge"]);
  $total_price3 += ($product["price"]*$product["quantity"]*$product["Recharge"]);
 $total_price =  number_format($total_price3,2);
  if($row5['Name'] == ''){
     $attr_name = "";
   }
else{
  $attr_name = " (".$row5['Name'].")";
}
 $SubCatId = $row['SubCatId'];
$sql11 = "SELECT Name FROM sub_category2 WHERE id='$SubCatId'";
$row11 = getRecord($sql11);

      ?> 
                <div class="media mb-4 w-100">
                    <div class="avatar avatar-60 mr-3 has-background rounded">
                     
                        <a href="product-details.php" class="background">
                             <?php if($row["Photo"] == '') {?>
                  <img src="no_image.jpg" style="width: 60px;height: 60px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Photo"])){?>
                 <img src=".././uploads/<?php echo $row["Photo"];?>" alt="" style="width: 60px;height: 60px;">
                  <?php }  else{?>
                 <img src="no_image.jpg" style="width: 60px;height: 60px;"> 
             <?php } ?>
                            <img src="img/image9.jpg" class="" alt="">
                        </a>
                    </div>
                     <input type="hidden" id="price<?php echo $row["id"]; ?>" value="<?php echo $product["price"]; ?>">
                     <input type="hidden" id="code<?php echo $row["id"]; ?>" value="<?php echo $product["code"]; ?>">
                    <div class="media-body">
                        <small class="text-secondary"><?php echo $row11['Name']; ?></small>
                        <a href="#">
                            <p class="mb-1"><?php echo $row["ProductName"]; ?></p>

                        </a>
                        <p><span class="text-success">&#8377;<?php echo number_format($product["price"],2); ?></span>
                           <?php if($attr_name != '') {?> 
                         <span class="text-secondary small">Size: <?php echo $attr_name; ?></span><?php } ?><br>
                          <span class="text-secondary small"><?php echo $product["quantity"]; ?> Pkt - <?php echo $product['Repeat']; ?> (<?php echo $product['Recharge']; ?> Days)</span>
                     </p>

                    </div>
                    <div class="align-self-center">
                       <a href="subscribe-product.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-edit"></i> Edit Settings</a><br>
                        <a href="javascript:void(0)" id="<?php echo $product["code"]; ?>" onclick="delete_prod2(this.id)"><i class="fa fa-trash" style="color: red;padding-top: 7px;padding-left: 28px;"></i></a>
                        
                    </div>
                </div>
<?php } } }} 

if($_POST['action'] == 'OrderSummary'){
  //$Product_Count = count($_SESSION['cart_item']);
  $Fname = addslashes(trim($_POST['Fname']));
$Lname = addslashes(trim($_POST['Lname']));
$Phone = $_POST['Phone'];
$EmailId = $_POST['EmailId'];
if($_POST['Password'] == ''){
$Password = rand(1000,9999);
}
else{
  $Password = $_POST['Password'];
}
$CountryId = addslashes($_POST['CountryId']);
$StateId = addslashes($_POST['StateId']);
$CityId = addslashes($_POST['CityId']);
$AreaId = addslashes($_POST['AreaId']);
$Address = addslashes(trim($_POST['Address']));
$Pincode = trim($_POST['Pincode']);
$shipdiff = $_POST['shipdiff'];
$PaymentMethod = $_POST['PaymentMethod'];
$ShippingAddress = $_POST['ShippingAddress'];
$ShippingCharge = $_POST['ShippingCharge'];
$Promoprice = $_POST['promo_price'];
$Promocode = $_POST['Promocode'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$OrderDate = date('Y-m-d');
$OrderTime = date('h:i a');
$Roll = $_POST['Roll'];  
$UnderBy = $_POST['UnderUserId'];
if($Roll == 4){
$AccName = "Doctor";
$Code = "DOC000";
}
if($Roll == 5){
$AccName = "Opticians";
$Code = "OPT000";
}
if($Roll == 6){
$AccName = "Wholesalers";
$Code = "WHOL000";
}
if($Roll == 7){
$AccName = "Customers";
$Code = "CUST000";
}
if($Roll == 8){
$AccName = "Retailer";
$Code = "VED000";
}   

function RandomStringGenerator($n)
{
    $generated_string = "";   
    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $len = strlen($domain);
    for ($i = 0; $i < $n; $i++)
    {
        $index = rand(0, $len - 1);
        $generated_string = $generated_string . $domain[$index];
    }
    return $generated_string;
} 
$n = 12;
$ReferenceNo = RandomStringGenerator($n); 
$sql2 = "SELECT * FROM tbl_users WHERE Phone='$Phone'";
$res2 = $conn->query($sql2);
$row2 = mysqli_num_rows($res2);
if($row2 > 0){
    echo json_encode(array('msg'=>"Your Phone No Already Registered With Us",'status'=>'0'));
}
else{
$sql = "INSERT INTO tbl_users SET Fname='$Fname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',Password='$Password',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',AreaId='$AreaId',Address='$Address',Pincode='$Pincode',Status='1',Roll='$Roll',CreatedDate='$OrderDate'";
$conn->query($sql);
$CustId = mysqli_insert_id($conn);
$CustomerId = "V000".$CustId;
$to = $EmailId;
//include("../inc_register_mail.php");
//include("../sendmailsmtp.php");
    $sql3 = "INSERT INTO customer_address SET UserId='$CustId',Fname='$Fname',Lname='$Lname',Phone='$Phone',EmailId='$EmailId',CountryId='$CountryId',StateId='$StateId',CityId='$CityId',AreaId='$AreaId',Address='$Address',Pincode='$Pincode',Status='1',CreatedDate='$OrderDate'";
$conn->query($sql3);
$addid = mysqli_insert_id($conn);
$sql31 = "UPDATE tbl_users SET CustomerId='$CustomerId' WHERE id='$CustId'";
$conn->query($sql31);

$query = "SELECT * FROM tbl_users WHERE Phone = '$Phone' AND Password = '$Password'";
    $result = $conn->query($query);
    $rncnt = mysqli_num_rows($result);
    $row = $result->fetch_assoc();
    $_SESSION['User'] = $row;
    $Username = $EmailId;
     echo json_encode(array('msg'=>"Registration Successfull!Redirecting...",'status'=>'1','userid'=>$CustId,'Username'=>$Username,'addid'=>$addid));  
}
}

if($_POST['action'] == 'PlaceOrder'){
$PaymentMethod = $_POST['PaymentMethod'];
$user_id = $_POST['user_id'];
$UserId = $_POST['user_id'];


/*$sql110 = "SELECT Location FROM tbl_users WHERE id='$user_id'";
$row110 = getRecord($sql110);
$CustLocation = $row110['Location'];*/

$addid = $_POST['addid'];
$ShippingCharge = $_POST['ShippingCharge'];
$GrandTotal = $_POST['GrandTotal'];
$DeliveryMethod = $_POST['DeliveryMethod'];
$Discount = $_POST['Discount'];
$File = addslashes(trim($_POST['File']));
//$Discount = addslashes(trim($_POST['CouponAmt']));
//$Discount = 0;
$Points = addslashes(trim($_POST['Points']));
$CouponCode = addslashes(trim($_POST['Coupon_Code']));
$ServiceFee = addslashes(trim($_POST['ServiceFee']));
$SevenDaysFree = addslashes(trim($_POST['SevenDaysFree']));
$WalletAmt = addslashes(trim($_POST['WalletAmt']));
$CashbackAmt = addslashes(trim($_POST['CashbackAmt']));
$OrderDate = date('Y-m-d');
$OrderTime = date('h:i a');


$FrId = $_SESSION['FranchiseId'];;
    $value = $_POST['value'];
    foreach ($_SESSION["cart_item"] as $product){
      $total_price3 += ($product["price"]*$product["quantity"]);
    }

     $InvoiceDate = date('Y-m-d');
    $InvoiceDate2 = date('d/m/Y');
    $CreatedTime = date('H:i:s');
    $SubTotal = $total_price3;
    $Discount = 0;
    $CustId = $_POST['user_id'];
    $sql33 = "SELECT Fname,Phone,Address,EmailId FROM customer_address WHERE id='$addid'";
    $row33 = getRecord($sql33);

    $CustName = addslashes(trim($row33['Fname']));
    $CellNo = addslashes(trim($row33['Phone']));
    $Address = addslashes(trim($row33['Address']));
    $EmailId = addslashes(trim($row33['EmailId']));

    if($_POST['PackageId'] == 0){
        $PkgId = addslashes(trim($_POST['PkgId']));
    }
    else{
        $PkgId = addslashes(trim($_POST['PackageId'])); 
    }
              
     $PkgAmt = addslashes(trim($_POST['PkgAmt']));
    $PkgDiscount = addslashes(trim($_POST['PkgDiscount']));
    $PkgValidity = addslashes(trim($_POST['PkgValidity']));
    $PrimeDiscount = addslashes(trim($_POST['PrimeDiscount']));
    $NetAmount = $total_price3-0;
    $Advance = $total_price3-0;

    $Balance = 0;
    $tempDir = '../../barcodes/';
    $sql8 = "SELECT MAX(SrNo) AS MaxId FROM tbl_customer_invoice WHERE Roll=2";
    $row8 = getRecord($sql8);
    $MaxId = $row8['MaxId'] + 1;
    $InvoiceNo = "00" . $MaxId;
    
    $sql81 = "SELECT MAX(OrderNo) AS MaxId FROM tbl_customer_invoice WHERE Roll=2 AND InvoiceDate='$InvoiceDate'";
    $row81 = getRecord($sql81);
    $MaxId22 = $row81['MaxId'] + 1;
    $OrderNo = $MaxId22;

     $sql = "INSERT INTO tbl_customer_invoice SET AccCode='$AccCode',SrNo='$MaxId',CustId='$CustId',CustName='$CustName',
                            CellNo='$CellNo',Address='$Address',EmailId='$EmailId',InvoiceNo='$InvoiceNo',
                            InvoiceDate='$InvoiceDate',PayType='Online Payment',Narration='$Narration',
                            CgstPer='$CgstPer',SgstPer='$SgstPer',
                            IgstPer='$IgstPer',SubTotal='$SubTotal',
                            GstAmt='$GstAmt',CreatedBy='$FrId',CreatedDate='$CreatedDate',
                            ExtraAmount='$ExtraAmount',TotalAmount='$TotalAmount',Discount='$Discount',
                            NetAmount='$NetAmount',Advance='$Advance',Balance='$Balance',
                            ExtraReason='$ExtraReason',ChequeNo='$ChequeNo',ChqDate='$ChqDate',
                            BankName='$BankName',UpiNo='$UpiNo',PayType2='$PayType2',
                            ChequeNo2='$ChequeNo2',ChqDate2='$ChqDate2',
                            BankName2='$BankName2',UpiNo2='$UpiNo2',Amount1='$Amount1',Amount2='$Amount2',Status='1',Roll=2,PkgId='$PkgId',PkgAmt='$PkgAmt',PkgDiscount='$PkgDiscount',PkgDate='$CreatedDate',PkgValidity='$PkgValidity',PrimeDiscount='$PrimeDiscount',OrderNo='$OrderNo',CreatedTime='$CreatedTime',FrId='$FrId',ShopFrom='CustApp',AddressId='$addid'";
                    $conn->query($sql);
                    $SellId = mysqli_insert_id($conn);
                    $filename = $SellId . ".png";
                    $randno = rand(1000,9999);
                    $BillNo = $randno."".$SellId;
                    $sql3 = "UPDATE tbl_customer_invoice SET Barcode='$Barcode',BillNo='$BillNo' WHERE Unqid='$SellId'";
                    $conn->query($sql3);


                    $sql2 = "SELECT MAX(SrNo) as maxid FROM tbl_general_ledger WHERE Type='PR'";
                    $row2 = getRecord($sql2);
                    if ($row2['maxid'] == '') {
                        $SrNo = 1;
                        $Code = "PR" . $SrNo;
                    } else {
                        $SrNo = $row2['maxid'] + 1;
                        $Code = "PR" . $SrNo;
                    }

                    $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='0',Code='OB',UserId='$CustId',
                            AccCode='$AccCode',
                            AccountName='$CustName',
                            InvoiceNo='$InvoiceNo',Amount='$NetAmount',CrDr='dr',Roll=5,
                            Type='OB',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                            PayMode='$PayType',Narration='Total Invoice Amount',
                            SellId='$SellId',Flag='Customer-Invoice',AccRoll='Customer',Main=1,CreatedBy='$FrId'";
                    $conn->query($sql4);
                    if ($Advance > 0) {
                        if($PayType == 'Borrowing'){
                            $BorrowFlag = 1;
                        }
                        else{
                            $BorrowFlag = 0;
                        }
                        $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='$SrNo',Code='$Code',UserId='$CustId',
                            AccCode='$AccCode',
                            AccountName='$CustName',
                            InvoiceNo='$InvoiceNo',Amount='$Advance',CrDr='cr',Roll=5,
                            Type='PR',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                            PayMode='$PayType',Narration='$Narration',
                            SellId='$SellId',Flag='Customer-Invoice',AccRoll='Customer',Main=1,CreatedBy='$FrId',BorrowFlag='$BorrowFlag'";
                        $conn->query($sql4);
                        $PostId = mysqli_insert_id($conn);

                        $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='$SrNo',Code='$Code',UserId='0',
                            AccCode='AC1',
                            AccountName='Comapny Account',
                            InvoiceNo='$InvoiceNo',Amount='$Advance',CrDr='dr',Roll=5,
                            Type='PR',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                            PayMode='$PayType',Narration='$Narration',
                            SellId='$SellId',Flag='Customer-Invoice',AccRoll='Company',PostId='$PostId',Main=1,CreatedBy='$user_id',BorrowFlag='$BorrowFlag'";
                        $conn->query($sql4);
                    }

 foreach ($_SESSION["cart_item"] as $product){
                        
                     $ProdCode = $product["code"];
                     $sql = "SELECT * FROM tbl_cust_products WHERE code='$ProdCode'";
                     $row = getRecord($sql);
                     $CatId = $row['CatId'];
                     $ActPrice =  $product["price"];
                     $ProdPrice = $row['ProdPrice'];
                     $Qty = $product["quantity"];
                     $TotalPrice = $ProdPrice*$Qty;
                    //  $CgstAmt = $TotalPrice*($row['CgstPer']/100);
                    //  $SgstAmt = $TotalPrice*($row['SgstPer']/100);
                    //  $IgstAmt = $TotalPrice*($row['IgstPer']/100);
                     $CgstAmt = $row['CgstAmt']*$Qty;
                     $SgstAmt = $row['SgstAmt']*$Qty;
                     $IgstAmt = $row['IgstAmt']*$Qty;
                     $CgstPer = $row['CgstPer'];
                     $SgstPer = $row['SgstPer'];
                     $IgstPer = $row['IgstPer'];
                     $GstAmt = $CgstAmt+$SgstAmt+$IgstAmt;
                     $Total = $GstAmt+$TotalPrice;
                     $ProdId = $row['id'];
                     
                     $sql22 = "INSERT INTO tbl_customer_invoice_details SET InvId='$SellId',ServerInvId='$SellId',ProdId='$ProdId',Qty='$Qty',Price='$ProdPrice',CreatedDate='$InvoiceDate',CgstPer='$CgstPer',SgstPer='$SgstPer',IgstPer='$IgstPer',GstAmt='$GstAmt',Total='$Total',CustProd=1,CgstAmt='$CgstAmt',SgstAmt='$SgstAmt',IgstAmt='$IgstAmt',ActPrice='$ActPrice',CatId='$CatId',InvoiceNo='$InvoiceNo'";
                    $conn->query($sql22);
                   $InvDetId = mysqli_insert_id($conn);
                    $Narration = "Stock Used Against Invoice No : ".$InvoiceNo;
                    $qx = "INSERT INTO tbl_cust_prod_stock SET ProdId='$ProdId',Qty='$Qty',CreatedBy='$FrId',StockDate='$InvoiceDate',Narration='$Narration',Status='Dr',UserId='0',CreatedDate='$InvoiceDate',InvId='$SellId'";
  $conn->query($qx);
       }
       unset($_SESSION["cart_item"]);
      
         echo json_encode(array('oid'=>$SellId,'amount'=>$NetAmount,'frid'=>$FrId,'CustId'=>$CustId,'phone'=>$CellNo));
    
}


if($_POST['action'] == 'applyCoupon'){
$CurrDate = date('Y-m-d');    
$CouponCode = addslashes(trim($_POST['CouponCode']));
$GrandTotal = addslashes(trim($_POST['GrandTotal']));
$UserId = addslashes(trim($_POST['user_id']));
$sql = "SELECT * FROM tbl_coupon_code WHERE Code='$CouponCode'";
$rncnt = getRow($sql);
if($rncnt > 0){
    $row = getRecord($sql);
    $FromDate = $row['FromDate'];
    $ToDate = $row['ToDate'];
    $MinOrder = $row['MinOrder'];
    $DiscountType = $row['DiscountType'];
    $CouponId = $row['id'];
    if($DiscountType == 1){
       $CouponAmt = $GrandTotal*($row['Discount']/100); 
    }
    else{
      $CouponAmt = $row['Discount'];  
    }
    
    $CouponFor = $row['CouponFor'];
    if($CouponFor == 1){
        $prodstatus = 0;
         foreach ($_SESSION["cart_item"] as $product){
            $Prod_code = $product["code"];
            $sql2 = "SELECT Offers FROM products WHERE code = '$Prod_code'";
            $row2 = getRecord($sql2);
            $Offers = $row2['Offers'];
            if($Offers == $CouponId){
                $prodstatus+=1;
            }
           
         }
         
         if($prodstatus > 0){
             $eligible = 1;
         }
         else{
             $eligible = 0;
         }
         
    }
    else if($CouponFor == 2){
        $CatId = $row['CatId'];
        $catstatus = 0;
         foreach ($_SESSION["cart_item"] as $product){
            $Prod_code = $product["code"];
            $sql2 = "SELECT CatId FROM products WHERE code = '$Prod_code'";
            $row2 = getRecord($sql2);
            $PrdCatId = $row2['CatId'];
            if($CatId == $PrdCatId){
                $catstatus+=1;
            }
           
         }
         
         if($catstatus > 0){
             $eligible = 1;
         }
         else{
             $eligible = 0;
         }
    }
    else{
        
    }
    //$CouponAmt = $GrandTotal * ($Discount/100);
     //$CouponAmt = $row['Discount'];
    $sql3 = "SELECT * FROM tbl_applied_code WHERE UserId='$UserId' AND Code='$CouponCode'";
    $rncnt3 = getRow($sql3);
    $sql2 = "SELECT * FROM tbl_coupon_code WHERE Code='$CouponCode' AND ToDate>='$CurrDate'";
    $rncnt2 = getRow($sql2);
    if($eligible == 1){
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
        echo json_encode(array('Status'=>5));//this coupon Not valid for this order
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

if($_POST['action'] == 'checkWallBal'){
$user_id = $_POST['user_id'];
$sql11x = "select sum(debit) as debit,sum(credit) as credit from (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as credit,(case when Status='Dr' then sum(Amount) else 0 end) as debit FROM wallet WHERE UserId='$user_id' group by Status) as a";
$res11x = $conn->query($sql11x);
$row11x = $res11x->fetch_assoc();
$mybalance = $row11x['credit'] - $row11x['debit'];
echo $mybalance;
}    


if($_POST['action'] == 'countCartProd'){
    echo count($_SESSION["cart_item"]);
    
}
?>

