<?php
session_start();
include_once '../../config.php';

if($_POST['action'] == 'getCashAmount'){
    $FromDate = $_POST['FromDate'];
    $ToDate = $_POST['ToDate'];
    $FrId = $_POST['FrId'];
    $sql = "SELECT SUM(NetAmount) AS TotalCashAmount FROM `tbl_customer_invoice` WHERE InvoiceDate>='$FromDate' AND InvoiceDate<='$ToDate' AND PayType='Cash' AND FrId=$FrId";
    $row = getRecord($sql);
    
    $sql2 = "SELECT SUM(Amount) AS TranferAmt FROM tbl_cash_book WHERE FrId='$FrId' AND ToDate>='$FromDate' AND FromDate<='$ToDate'";
    $row2 = getRecord($sql2);
    //$TranferAmt = $row2['TranferAmt'];
    echo $row['TotalCashAmount'] - $row2['TranferAmt'];
}

if($_POST['action'] == 'getAccNo'){
    $id = $_POST['id'];
    $sql = "SELECT * FROM tbl_banks WHERE id='$id'";
    $row = getRecord($sql);
    echo json_encode(array('BankName'=>$row['BankName'],'AccNo'=>$row['AccNo']));
}


?>