<?php
session_start();
include_once '../config.php';
require_once("../dbcontroller.php");
$db_handle = new DBController();

if($_POST['action'] == 'addToCart'){
         if(!empty($_POST["quantity"])) {
    $productByCode = $db_handle->runQuery("SELECT id,code,ProductName FROM tbl_cust_products2 WHERE id='" . $_POST["id"] . "'");
     $itemArray = array($productByCode[0]["code"]=>array('code'=>$productByCode[0]["code"],'id'=>$productByCode[0]["id"],'ProductName'=>$productByCode[0]["ProductName"],'TotalPrice'=>$_POST["TotalPrice"],'Price'=>$_POST["Price"],'Qty'=>$_POST["quantity"],'Unit'=>$_POST["Unit"],'WoGstPrice'=>$_POST["MinPrice"],'GstAmt'=>$_POST["GstAmt"],'CgstAmt'=>$_POST["CgstAmt"],'SgstAmt'=>$_POST["SgstAmt"]));
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
    
    //echo "<pre>";print_r($_SESSION["cart_item"]);
    echo 1;
    }
    
    if($_POST['action'] == 'displayCart'){
        ?>
        <table class="table table-striped table-bordered" width="100%">
    <thead>
        <tr>
             <th>Action</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total Price</th>
           
        </tr>
    </thead>

    <tbody>
        <?php foreach ($_SESSION["cart_item"] as $product){?>
        <tr>
            <th><a href="javascript:void(0)" onclick="delete_prod('<?php echo $product['code'];?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="lnr lnr-trash text-danger"></i></a></th>
            <th><?php echo $product['ProductName'];?></th>
            <th><?php echo $product['Qty']." ".$product['Unit'];?></th>
            <th><?php echo $product['Price'];?></th>
            <th><?php echo $product['TotalPrice'];?></th>
            
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php 
    }
    
    if($_POST['action'] == 'delete_cart_prod'){
        if (!empty($_SESSION["cart_item"])) {
        foreach ($_SESSION["cart_item"] as $k => $v) {
            if ($_POST["code"] == $k)
                unset($_SESSION["cart_item"][$k]);
            if (empty($_SESSION["cart_item"]))
                unset($_SESSION["cart_item"]);
        }
    }
        
    }
    
    if($_POST['action'] == 'calTotalQty'){
        $totqty = 0;
        foreach ($_SESSION["cart_item"] as $product){
            $totqty+=$product['Qty'];
            $totamt+=$product['TotalPrice'];
            $totgst+=$product['GstAmt'];
        }
        echo json_encode(array('Qty'=>$totqty,'TotalPrice'=>$totamt,'GstAmt'=>$totgst));
    }
    
    
    if($_POST['action'] == 'addToCart2'){
         if(!empty($_POST["quantity"])) {
    $productByCode = $db_handle->runQuery("SELECT id,code,ProductName FROM tbl_cust_products_2025 WHERE id='" . $_POST["id"] . "'");
     $itemArray = array($productByCode[0]["code"]=>array('code'=>$productByCode[0]["code"],'id'=>$productByCode[0]["id"],'ProductName'=>$productByCode[0]["ProductName"],'TotalPrice'=>$_POST["TotalPrice"],'Price'=>$_POST["Price"],'Qty'=>$_POST["quantity"],'Unit'=>$_POST["Unit"],'WoGstPrice'=>$_POST["MinPrice"],'GstAmt'=>$_POST["GstAmt"],'CgstAmt'=>$_POST["CgstAmt"],'SgstAmt'=>$_POST["SgstAmt"]));
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
    
    //echo "<pre>";print_r($_SESSION["cart_item"]);
    echo 1;
    }
    ?>