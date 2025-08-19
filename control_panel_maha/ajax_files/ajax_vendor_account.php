<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'getUserDetails'){
$id = $_POST['id'];
$sql = "SELECT Fname FROM tbl_users WHERE id='$id' AND Roll=3";
$row = getRecord($sql);
echo json_encode($row);
}

if($_POST['action'] == 'getVedInvoice'){?>
 <option value="" selected="selected" disabled="">Select Invoice No</option>
<?php 
    $VedId = $_POST['id'];
        $sql12 = "SELECT InvoiceNo,ExpId FROM tbl_vendor_expense_ledger WHERE Roll='3' AND Type='INV' AND CrDr='cr' AND UserId='$VedId'";
  $row12 = getList($sql12);
  foreach($row12 as $result){
?>
                <option value="<?php echo $result['ExpId']; ?>"><?php echo $result['InvoiceNo']; ?></option>
<?php } } 

if ($_POST['action'] == 'getRecordDetails') {
    $id = $_POST['id'];
    $sql2 = "SELECT Amount FROM tbl_vendor_expense_ledger WHERE UserId='$id' AND Type='INV'";
    $row2 = getRecord($sql2);
    $sql = "SELECT SUM(Amount) AS PaidAmt FROM tbl_vendor_expense_ledger WHERE UserId='$id' AND Type!='INV' AND CrDr='dr'";
    $row = getRecord($sql);
    $BalAmt = $row2['Amount'] - $row['PaidAmt'];
    
    echo json_encode(array('PaidAmt' => $row['PaidAmt'], 'BalAmt' => $BalAmt, 'TotAmt' => $row2['Amount']));
}
?>