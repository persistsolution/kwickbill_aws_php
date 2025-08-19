<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Employee";
$Page = "View-Employee";

/*$sql = "SELECT * FROM `tbl_users` WHERE Roll NOT IN(1,5,55,9,22,23,63) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "E".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}*/

$sql = "SELECT UnderFrId,id FROM `tbl_users` WHERE Roll NOT IN(1,5,55,9,22,23,63,3) AND ZoneId=0";
$row = getList($sql);
foreach($row as $result){
    $UnderFrId = $result['UnderFrId'];
    $sql55 = "SELECT ZoneId FROM tbl_users WHERE id='$UnderFrId'";
    $row55 = getRecord($sql55);
    $ZoneId = $row55['ZoneId'];
    $sql = "UPDATE tbl_users SET ZoneId='$ZoneId' WHERE id='".$result['id']."'";
    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Employee Account List</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>
</head>
<body>

 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">



<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_bank_details WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-bank-details.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Bank Details
    <?php if(in_array("14", $Options)) {?>   
<span style="float: right;">
<a href="add-bank-details.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add New</a></span><?php } ?>
</h4>

<div class="card" style="padding: 10px;">
    
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
               <th>Action</th>
               <?php } ?>
               
                <th>Bank Holder Name</th>
                <th>Bank Name</th>
                <th>Account No</th>
                <th>Branch</th>
                <th>IFSC Code</th>
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT * FROM tbl_bank_details WHERE AccountNo!='' AND IfscCode!='' AND AccountName!='' AND BankName!='' GROUP BY AccountNo,IfscCode";
            $row = getList($sql); 
            foreach($row as $result){
             ?>
            <tr>
                <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
            <td>
              <?php if(in_array("10", $Options)){?>
              <a href="add-bank-details.php?id=<?php echo $result['id']; ?>" ><i class="lnr lnr-pencil mr-2"></i></a>
             <?php } if(in_array("11", $Options)){?>
              &nbsp;&nbsp;<a onClick="return confirm('Are you sure you want delete this user account?\nNote : Delete all record related this user (Y/N)');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $result['id']; ?>&action=delete"><i class="lnr lnr-trash text-danger"></i></a>
             <?php } ?>
            </td> <?php } ?>
                
            <td><?php echo $result['AccountName']; ?></td>
            <td><?php echo $result['BankName']; ?></td>
            <td><?php echo $result['AccountNo']; ?></td>
            <td><?php echo $result['Branch']; ?></td>
            <td><?php echo $result['IfscCode']; ?></td>

            
    
              
            </tr>
           <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>


<?php include_once 'footer.php'; ?>

</div>

</div>

</div>

<div class="layout-overlay layout-sidenav-toggle"></div>
</div>


<?php include_once 'footer_script.php'; ?>

<script type="text/javascript">
 
    $(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ]
    });
});
</script>
</body>
</html>
