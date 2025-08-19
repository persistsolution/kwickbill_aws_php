<?php
session_start();
include_once '../config.php';
require_once("../dbcontroller.php");
$db_handle = new DBController();
if ($_POST['action'] == 'getProdDetails') {
    $id = $_POST['id'];
    $sql = "SELECT MinPrice,PurchasePrice,code FROM tbl_cust_products_2025 WHERE id='$id'";
    $row = getRecord($sql);
    echo json_encode(array('MinPrice' => $row['MinPrice'], 'PurchasePrice' => $row['PurchasePrice'], 'code' => $row['code']));
}

if ($_POST['action'] == 'getAvailProdStock') {
    $id = $_POST['id'];

    $sql = "SELECT sum(creditqty)-sum(debitqty) AS balqty FROM (SELECT (case when Status='Dr' then sum(Qty) else '0' end) as debitqty,(case when Status='Cr' then sum(Qty) else '0' end) as creditqty FROM `tbl_cust_prod_stock_2025` WHERE ProdId='$id' GROUP by Status) as a";
    $row = getRecord($sql);
    echo $row['balqty'];
}

if($_POST['action'] == 'addToCart'){
         if(!empty($_POST["quantity"])) {
    $productByCode = $db_handle->runQuery("SELECT id,code,ProductName FROM tbl_cust_products_2025 WHERE id='" . $_POST["id"] . "'");
     $itemArray = array($productByCode[0]["code"]=>array('code'=>$productByCode[0]["code"],'id'=>$productByCode[0]["id"],'ProductName'=>$productByCode[0]["ProductName"],'PurchasePrice'=>$_POST["PurchasePrice"],'SellPrice'=>$_POST["SellPrice"],'Qty'=>$_POST["quantity"]));
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
            <th>Product Name</th>
            <th>Qty</th>
            <th>Purchase Price</th>
            <th>Sell Price</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($_SESSION["cart_item"] as $product){?>
        <tr>
            <th><?php echo $product['ProductName'];?></th>
            <th><?php echo $product['Qty'];?></th>
            <th><?php echo $product['PurchasePrice'];?></th>
            <th><?php echo $product['SellPrice'];?></th>
            <th><a href="javascript:void(0)" onclick="delete_prod('<?php echo $product['code'];?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash text-danger"></i></a></th>
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
        }
        echo $totqty;
    }
    
    ?>
