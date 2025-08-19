<?php
include_once 'config.php';
$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu.CustomerId FROM tbl_vendor_expenses te LEFT JOIN tbl_users tu ON tu.id=te.VedId WHERE te.VedId='8752' AND te.AdminStatus=1 AND te.AccAmount>0 AND te.PaymentStatus=0";
$row = getList($sql);
foreach($row as $result){
    $UtrNo = 'UCBAH25191585315';
    $PayAmount = $result['AccAmount'];
    $PaymentDate = '2025-07-10';
    $PaymentStatus = 1;
    $user_id = 8346;
    $id = $result['id'];
    $CustId = $result['VedId'];
$CustName = $result['Fname'];
$AccCode = $result['CustomerId'];
$InvoiceNo = $result['InvoiceNo'];
$InvAmount = $result['Amount'];
$VedId = $result['VedId'];
$VedNarration = $result['Narration'];
$Created_By = $result['CreatedBy'];
$Created_Date = $result['CreatedDate'];
$PayType = $result['PaymentMode'];
    $query2 = "UPDATE tbl_vendor_expenses SET UtrNo='$UtrNo',PayAmount='$PayAmount',BalAmt='0',PaymentDate='$PaymentDate',PaymentStatus='$PaymentStatus',PayBy='$user_id',PayNarration='Paid Amount' WHERE id = '$id'";
  $conn->query($query2);
  
    $sql = "INSERT INTO tbl_vendor_expense_ledger SET UtrNo='$UtrNo',UserId='$CustId',AccCode='$AccCode',AccountName='$CustName',InvoiceNo='$InvoiceNo',
      Amount='$InvAmount',PaymentDate='$PaymentDate',CrDr='cr',Roll=3,Type='INV',PayMode='',Narration='$VedNarration',ChequeNo='',ChqDate='',
      BankName='',UpiNo='',CreatedBy='$Created_By',CreatedDate='$Created_Date',ExpId='$id'";
    $conn->query($sql);
    $PostId = mysqli_insert_id($conn);
  
  if($PaymentStatus == 1){
      $sql2 = "SELECT MAX(SrNo) as maxid FROM tbl_vendor_expense_ledger WHERE Type='PR'";
    $row2 = getRecord($sql2);
    if($row2['maxid'] == ''){
        $SrNo = 1;
        $Code = "PR".$SrNo;
    }
    else{
        $SrNo = $row2['maxid']+1;
        $Code = "PR".$SrNo;
    }
    
      
      
      $sql = "INSERT INTO tbl_vendor_expense_ledger SET PostId='$PostId',UtrNo='$UtrNo',Code='$Code',SrNo='$SrNo',UserId='$CustId',AccCode='$AccCode',AccountName='$CustName',InvoiceNo='$InvoiceNo',
      Amount='$PayAmount',PaymentDate='$PaymentDate',CrDr='dr',Roll=3,Type='PR',PayMode='$PayType',Narration='$PayNarration',ChequeNo='$ChequeNo',ChqDate='$ChqDate',
      BankName='$BankName',UpiNo='$UpiNo',CreatedBy='$user_id',CreatedDate='$CreatedDate',ExpId='$id'";
      $conn->query($sql);
  
  
  }
  
  $sql = "SELECT Fname,Phone FROM tbl_users WHERE id='$VedId'";
  $row = getRecord($sql);
  $VedName = $row['Fname'];
  $VedPhone = $row['Phone'];
  
  $smstxt = "Dear ".$VedName.", Your payment of Rs. ".$PayAmount." against the invoices submitted has been successfully processed vide UTR No. ".$UtrNo.". - Mahachai";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707174722970840066";
  
  $Phone = $VedPhone;
  //include '../incsmsapi.php';
  
  
}