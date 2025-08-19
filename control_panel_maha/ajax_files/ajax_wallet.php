<?php 
session_start();
include_once '../config.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'Add'){
$UserId = addslashes(trim($_POST["UserId"]));
$Amount = $_POST["Amount"];
$Status = $_POST["Status"];
 $CreatedDate = date('Y-m-d');
  $CreatedTime = date('h:i a');
$qx = "INSERT INTO wallet SET UserId = '$UserId',Amount='$Amount',Status='$Status',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime'";
	$conn->query($qx);
	echo 1;
}

if($_POST['action'] == 'fetch_record'){
 $id = $_POST['id'];
    $query = "SELECT * FROM wallet WHERE id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    echo json_encode($row);


}

if($_POST['action'] == 'Edit') {
     $id = $_POST['id'];
$UserId = addslashes(trim($_POST["UserId"]));
$Amount = $_POST["Amount"];
$Status = $_POST["Status"];
 $CreatedDate = date('Y-m-d');
  $CreatedTime = date('h:i a');
  $query2 = "UPDATE wallet SET UserId = '$UserId',Amount='$Amount',Status='$Status',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime' WHERE id = '$id'";
 	$conn->query($query2);
  echo 1;

}

  if($_POST['action'] == 'delete') {
   
      $id = $_POST['id'];
      $query = "DELETE FROM wallet WHERE id = '$id'";
      $conn->query($query);
      echo "Delete Successfully";

  }

if($_POST["action"] == 'getUserDetails')
{
  $RecipientPhone = $_POST['RecipientPhone'];
  $sql2 = "SELECT * FROM customers WHERE Phone='$RecipientPhone'";
  $rncnt2 = getRow($sql2);
  if($rncnt2 > 0){
    $row2 = getRecord($sql2);
    $Name = $row2['Fname']." ".$row2['Lname'];
    $UserId = $row2['id'];
    echo json_encode(array('Name'=>$Name,'UserId'=>$UserId,'Status'=>1));
  }
  else{
    echo json_encode(array('Status'=>0));
  }
}

  if($_POST['action']=='view'){?>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
              <th>#</th>
              
              <th>Employee Name</th>
              <th>Amount</th>
               <th>Date-Time</th>
               <th>Status</th>

               <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?php 
 $srno = 1;
  $sql = "SELECT w.*,c.Fname,c.Mname,c.Lname FROM wallet w LEFT JOIN tbl_users c ON c.id=w.UserId WHERE c.Roll NOT IN(1,3,4,5,9,10,8,11) ORDER BY w.id DESC";
   $rx = $conn->query($sql);
  while($nx = $rx->fetch_assoc()){

  ?>
           <tr>
             <td><?php echo $srno; ?></td>
           
             <td><?php echo $nx['Fname']; ?></td>
              <td>&#8377;<?php echo number_format($nx['Amount'],2); ?></td>
                 <td><?php echo $nx['CreatedDate']." - ".$nx['CreatedTime']; ?></td>
             <td><?php if($nx['Status']=='Cr'){echo "<span style='color:green;'>Credit</span>";} else { echo "<span style='color:red;'>Debit</span>";} ?></td>
             <td><a href='add-wallet.php?id=<?php echo $nx['id']; ?>' data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit" class=""><i class="lnr lnr-pencil mr-2"></i></a><!--&nbsp;&nbsp;<a data-id="<?php echo $nx['id']; ?>" href='javascript:void(0);' data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete" class="delete" id="bootbox-confirm"><i class="lnr lnr-trash text-danger"></i></a>-->
             </td>
            </tr>
             <?php $srno++;} ?>
        </tbody>
    </table>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#example').DataTable( {
        responsive: true
      });
      });
    </script>
 <?php }  
 
 if($_POST["action"] == 'checkWalletBal')
{
    $UserId = $_POST['UserId'];
  $sql88 = "SELECT SUM(creditAmt) As Credit,SUM(debitAmt) As Debit FROM (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as creditAmt,(case when Status='Dr' then sum(Amount) else 0 end) as debitAmt FROM wallet WHERE UserId='$UserId' GROUP BY Status) as a";
    $row88 = getRecord($sql88);
    echo $Wallet = $row88['Credit'] - $row88['Debit'];
}
?>