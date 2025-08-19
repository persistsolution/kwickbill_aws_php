<?php
session_start();
$sessionid = session_id();
include_once '../config.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'fetch_expense_details'){
$id = $_POST['id'];
$sql7 = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto FROM tbl_expense_request te LEFT JOIN tbl_users tu ON tu.id=te.UserId WHERE te.id='$id'";
$row = getRecord($sql7);

$sql88 = "SELECT SUM(creditAmt) As Credit,SUM(debitAmt) As Debit FROM (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as creditAmt,(case when Status='Dr' then sum(Amount) else 0 end) as debitAmt FROM wallet WHERE UserId='".$row['UserId']."' GROUP BY Status) as a";
    $row88 = getRecord($sql88);
    $Wallet = $row88['Credit'] - $row88['Debit'];
    
echo json_encode(array('rowdata'=>$row,'walletamt'=>$Wallet));
    
}

if($_POST['action'] == 'Save'){
    $id = $_POST['id'];
    $EmpId = $_POST['EmpId'];
     $ApproveDate = addslashes(trim($_POST["ApproveDate"]));
     $MannagerComment = addslashes(trim($_POST["MannagerComment"]));
  $AccAmount = addslashes(trim($_POST["AccAmount"]));
  $ManagerStatus = addslashes(trim($_POST["ManagerStatus"]));
  $ExpenseFor  = addslashes(trim($_POST["ExpenseFor"]));
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
 //$TicketNo= "#".rand(1000,9999);
    $query2 = "UPDATE tbl_expense_request SET AdminApproveDate='$ApproveDate',AdminComment='$MannagerComment',AccAmount='$AccAmount',AdminStatus='$ManagerStatus',AccBy='$user_id',Status='$ManagerStatus' WHERE id = '$id'";
  $conn->query($query2);
  
  if($ManagerStatus == 1){
  $sql = "DELETE FROM wallet WHERE UserId='$EmpId' AND ExpId='$id'";
  $conn->query($sql);
  $Narration = "Amount Deduct against Expense For ".$ExpenseFor;
  $sql = "INSERT INTO wallet SET UserId='$EmpId',Amount='$AccAmount',Narration='$Narration',Status='Dr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',ExpId='$id'";
  $conn->query($sql);
  }
  
  $sql33 = "SELECT Fname As AccName FROM tbl_users WHERE id='$user_id'";
  $row33 = getRecord($sql33);
  $AccName = $row33['AccName'];
  if($ManagerStatus=='1'){ 
  $status = "<span style='color:green;'>Approved<br>By $AccName </span>";
  } 
  else if($ManagerStatus=='2'){ 
  $status = "<span style='color:red;'>Rejected <br> By $AccName </span>";}
  else {
 $status = '<a href="approve-expense-by-account.php?id='.$id.'">Approve By Admin/Account</a><br>
 
  <a href="javascript:void(0)" data-toggle="modal" data-target="#modals-default" id="add_button" onclick="getExpenseVal('.$id.')">Approve By Popup</a>';
  } 
  
    echo json_encode(array('response'=>1,'status'=>$status,'id'=>$id));
  
  
}


if($_POST['action'] == 'MgrSave'){
    $id = $_POST['id'];
    $EmpId = $_POST['EmpId'];
     $ApproveDate = addslashes(trim($_POST["ApproveDate"]));
     $MannagerComment = addslashes(trim($_POST["MannagerComment"]));
  $MgrAmount = addslashes(trim($_POST["MgrAmount"]));
  $ManagerStatus = addslashes(trim($_POST["ManagerStatus"]));
   $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');

 //$TicketNo= "#".rand(1000,9999);
    $query2 = "UPDATE tbl_expense_request SET ApproveDate='$ApproveDate',MannagerComment='$MannagerComment',MgrAmount='$MgrAmount',ManagerStatus='$ManagerStatus',MrgBy='$user_id' WHERE id = '$id'";
  $conn->query($query2);
   
    $sql33 = "SELECT Fname As AccName FROM tbl_users WHERE id='$user_id'";
  $row33 = getRecord($sql33);
  $AccName = $row33['AccName'];
   if($ManagerStatus=='1'){ 
  $status = "<span style='color:green;'>Approved<br>By $AccName </span>";
  } 
  else if($ManagerStatus=='2'){ 
  $status = "<span style='color:red;'>Rejected <br> By $AccName </span>";}
  else {
 $status = '<a href="approve-expense-by-manager.php?id='.$id.'">Approve By Manager</a><br>
 
  <a href="javascript:void(0)" data-toggle="modal" data-target="#modals-default" id="add_button" onclick="getExpenseVal('.$id.')">Approve By Popup</a>';
  } 
  
 echo json_encode(array('response'=>1,'status'=>$status,'id'=>$id));
  
}
?>