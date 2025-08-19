<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'Save'){
$id = $_POST['id'];
$RawId = addslashes(trim($_POST['RawId']));
$Price = addslashes(trim($_POST['Price']));
$Qty = addslashes(trim($_POST['Qty']));
$CrDr = $_POST['CrDr'];
$CreatedDate = date('Y-m-d');

if($id == ''){
$sql2 = "INSERT INTO tbl_raw_stock SET RawId='$RawId',Price='$Price',Qty='$Qty',CrDr='$CrDr',Status='1',CreatedDate='$CreatedDate',CreatedBy='$user_id'";
$conn->query($sql2);
echo 1;
}
else{
$sql2 = "UPDATE tbl_raw_stock SET RawId='$RawId',Price='$Price',Qty='$Qty',CrDr='$CrDr',Status='1',ModifiedDate='$CreatedDate',ModifiedBy='$user_id' WHERE id='$id'";
$conn->query($sql2);
echo 1;
}

}

if($_POST['action'] == 'getRawDetails'){
    $id = $_POST['id'];
    $sql = "SELECT * FROM tbl_raw_materials WHERE id='$id'";
    $row = getRecord($sql);
    echo json_encode($row);
}

if($_POST['action'] == 'getAvailProdStock'){
    $id = $_POST['id'];
    $sql = "SELECT sum(creditqty)-sum(debitqty) AS balqty FROM (SELECT (case when crdr='dr' then sum(Qty) else '0' end) as debitqty,(case when crdr='cr' then sum(Qty) else '0' end) as creditqty FROM `tbl_product_stocks` WHERE ProdId='$id' GROUP by CrDr) as a";
    $row = getRecord($sql);
    if($row['balqty'] == ''){
        $balqty = 0;
    }
    else{
        $balqty = $row['balqty'];
    }
    echo $balqty;
}

?>