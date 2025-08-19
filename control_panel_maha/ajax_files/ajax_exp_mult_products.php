<?php
session_start();
include_once '../config.php';
require_once("../dbcontroller.php");
$db_handle = new DBController();
if ($_POST['action'] == 'getProdDetails') {
    $id = $_POST['id'];
    $sql = "SELECT tc.MinPrice,tc.PurchasePrice,tc.code,tu.Name2 AS Unit FROM `tbl_cust_products2` tc LEFT JOIN tbl_units tu ON tu.Name=tc.Unit WHERE tc.id='$id'";
    $row = getRecord($sql);
    echo json_encode(array('MinPrice' => $row['MinPrice'],'Unit' => $row['Unit'], 'PurchasePrice' => $row['PurchasePrice'], 'code' => $row['code']));
}

if ($_POST['action'] == 'getAvailProdStock') {
    $id = $_POST['id'];

    $sql = "SELECT IFNULL(sum(creditqty)-sum(debitqty), 0) AS balqty FROM (SELECT (case when Status='Dr' then sum(Qty) else '0' end) as debitqty,(case when Status='Cr' then sum(Qty) else '0' end) as creditqty FROM `tbl_cust_prod_stock_2025` WHERE ProdId='$id' GROUP by Status) as a";
    $row = getRecord($sql);
    echo $row['balqty'];
}

if($_POST['action'] == 'addToCart'){
         if(!empty($_POST["quantity"])) {
             $prdsrno = $_POST['prdsrno'];
    $productByCode = $db_handle->runQuery("SELECT id,code,ProductName,ProdType FROM tbl_cust_products2 WHERE id='" . $_POST["id"] . "'");
     $itemArray = array($productByCode[0]["code"]=>array('code'=>$productByCode[0]["code"],'prdsrno'=>$_POST['prdsrno'],'id'=>$productByCode[0]["id"],'ProductName'=>$productByCode[0]["ProductName"],'PurchasePrice'=>$_POST["PurchasePrice"],'SellPrice'=>$_POST["SellPrice"],'Qty'=>$_POST["quantity"],'ProdType'=>$productByCode[0]["ProdType"],'Unit'=>$_POST["Unit"]));
      if(!empty($_SESSION["cart_item$prdsrno"])) {
        if(in_array($productByCode[0]["code"],$_SESSION["cart_item$prdsrno"])) {
          foreach($_SESSION["cart_item$prdsrno"] as $k => $v) {
              if($productByCode[0]["code"] == $k)
                $_SESSION["cart_item$prdsrno"][$k]["quantity"] = $_POST["quantity"];
          }
        } else {
          $_SESSION["cart_item$prdsrno"] = array_merge($_SESSION["cart_item$prdsrno"],$itemArray);
        }
      } else {
        $_SESSION["cart_item$prdsrno"] = $itemArray;
      }
    }
    
    //echo "<pre>";print_r($_SESSION["cart_item"]);
    echo 1;
    }
    
    if($_POST['action'] == 'displayCart'){
        $prdsrno = $_POST['prdsrno'];
        //echo "<pre>";print_r($_SESSION["cart_item"]);
        ?>
        <div   style="overflow-x: auto; width: 100%;">
        <table class="table table-striped table-bordered" width="100%">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Qty</th>
            <th nowrap>Purchase Price</th>
            <!--<th nowrap>Sell Price</th>-->
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($_SESSION["cart_item$prdsrno"] as $product){
          
                $totalamt+=$product['Qty']*$product['PurchasePrice'];
        ?>
        <tr>
            <th nowrap><?php echo $product['ProductName'];?></th>
            <th><?php echo $product['Qty']." ".$product['Unit'];?></th>
            <th><?php echo $product['PurchasePrice'];?></th>
            <!--<th><?php echo $product['SellPrice'];?></th>-->
            <th><?php echo $product['Qty']*$product['PurchasePrice'];?></th>
            <th><a href="javascript:void(0)" onclick="edit_prod('<?php echo $product['code'];?>','<?php echo $product['prdsrno'];?>')" data-toggle="tooltip" title="Edit">
    <i class="fa fa-edit text-primary"></i>
  </a>&nbsp;&nbsp;
  <a href="javascript:void(0)" onclick="delete_prod('<?php echo $product['code'];?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash text-danger"></i></a></th>
        </tr>
        <?php }  ?>
        <tr>
            <th></th>
            <th></th>
            <th>Total (Round Off)</th>
            <th><?php echo round($totalamt);?></th>
        </tr>
    </tbody>
</table>
</div>
<?php 
    }
    
    if($_POST['action'] == 'delete_cart_prod'){
        $prdsrno = $_POST['prdsrno'];
        if (!empty($_SESSION["cart_item$prdsrno"])) {
        foreach ($_SESSION["cart_item$prdsrno"] as $k => $v) {
            if ($_POST["code"] == $k)
                unset($_SESSION["cart_item$prdsrno"][$k]);
            if (empty($_SESSION["cart_item$prdsrno"]))
                unset($_SESSION["cart_item$prdsrno"]);
        }
    }
        
    }
    
    if($_POST['action'] == 'calTotalQty'){
        $totqty = 0;
        $prdsrno = $_POST['prdsrno'];
        foreach ($_SESSION["cart_item$prdsrno"] as $product){
            $totqty+=$product['Qty'];
        }
        echo $totqty;
    }
    
    if($_POST['action'] == 'calTotalAmt'){
        $totamt = 0;
        $prdsrno = $_POST['prdsrno'];
        foreach ($_SESSION["cart_item$prdsrno"] as $product){
            $totamt+=$product['Qty']*$product['PurchasePrice'];
        }
        echo round($totamt);
    }
    
    if($_POST['action'] == 'checkProdAdd'){
        $prdsrno = $_POST['srno'];
        $cartKey = "cart_item$prdsrno";

        if (isset($_SESSION[$cartKey]) && is_array($_SESSION[$cartKey])) {
            $count = count($_SESSION[$cartKey]);
            echo 1;
        } else {
            echo 0; //empty cart
        }
    }
    
    if ($_POST['action'] == 'getProduct') {
    $code = $_POST['code'];
    foreach ($_SESSION["cart_item".$_POST['prdsrno']] as $item) {
        if ($item['code'] == $code) {
            echo json_encode($item);
            exit;
        }
    }
    echo json_encode([]);
}
    ?>
