<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Freelancer";
$Page = "View-Freelancer";

/*$sql = "SELECT * FROM `tbl_users` WHERE Roll IN(9,22,23) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "B".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}*/
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Freelancer Account List</title>
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
  $sql11 = "DELETE FROM tbl_users WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-freelancer.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Business Partner Account List
    <?php if(in_array("14", $Options)) {?>   
<span style="float: right;">
<a href="add-freelancer.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add New</a></span><?php } ?>
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>QR Code</th>
               <th>Photo</th>
               <th>Business ID</th>
                <th>Business Partner Name</th>
                
                <th>Email Id</th>
                <th>Contact No</th>
                <th>Another Contact No</th>
                <th>Address</th>
                
                <th>Account Type</th>
                <th>Under By</th>
                <th>Status</th>
                <th>KYC Status</th>
                <th>Register Date</th>
                <th>Aadhar Card No</th>
                <th>Blood Group</th>
                <th>Bank Holder Name</th>
                <th>Bank Name</th>
                <th>Account No</th>
                <th>Branch</th>
                <th>IFSC Code</th>
                <th>UPI ID</th>
               
                 <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
               <th>Action</th>
               <?php } ?>
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT tu.*,tu2.Fname As UnderName FROM tbl_users tu 
                    LEFT JOIN tbl_users tu2 ON tu.UnderUser=tu2.id WHERE tu.Roll IN(9,22,23) ORDER BY tu.CreatedDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                if($row['Roll'] == 9){
                  $AccType = "Business Devlopment Manager";
                }
                if($row['Roll'] == 22){
                  $AccType = "Area Manager";
                }
                if($row['Roll'] == 23){
                  $AccType = "Regional Manager";
                }

                if($row['UnderUser'] == 0){
                  $UnderUserName = "Self";
                }
                else{
                  $UnderUserName = $row['UnderName'];
                }
             ?>
            <tr>
                <td> <?php if($row["Barcode"] == '') {?>
                  -
                 <?php } else if(file_exists('../barcodes/'.$row["Barcode"])){?>
                 <a href="../barcodes/<?php echo $row["Barcode"];?>" target="_new"><img src="../barcodes/<?php echo $row["Barcode"];?>?nocache=<?php echo time(); ?>" class="d-block ui-w-40" alt="" style="width: 40px;height: 40px;"></a>
                  <?php }  else{?>
                 -
             <?php } ?></td>
               <td> <?php if($row["Photo"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Photo"])){?>
                 <img src="../uploads/<?php echo $row["Photo"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
              <td><?php echo $row['CustomerId']; ?></td>
               <td><a href="customer-profile.php?id=<?php echo $row['id']; ?>" target="_new"><?php echo $row['Fname']." ".$row['Lname']; ?></a></td>
              
                
                <td><?php echo $row['EmailId']; ?></td>
               <td><?php echo $row['Phone']; ?></td>
               <td><?php echo $row['Phone2']; ?></td>
               <td><?php echo $row['Address']; ?></td>
                  <td><?php echo $AccType; ?></td>
                <td><?php echo $UnderUserName;?></td>
                   
                 <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Approved</span>";} else { echo "<span style='color:red;'>Pending</span>";} ?></td>

                  <td><?php if($row['KycStatus']=='1'){echo "<span style='color:green;'>Active</span>";} else { echo "<span style='color:red;'>Pending</span>";} ?></td>
              
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
            <td><?php echo $row['AadharNo']; ?></td>
            <td><?php echo $row['BloodGroup']; ?></td>
            <td><?php echo $row['AccountName']; ?></td>
            <td><?php echo $row['BankName']; ?></td>
            <td><?php echo $row['AccountNo']; ?></td>
            <td><?php echo $row['Branch']; ?></td>
            <td><?php echo $row['IfscCode']; ?></td>
            <td><?php echo $row['UpiNo']; ?></td>
           <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
            <td>
              <?php if(in_array("10", $Options)){?>
              <a href="add-freelancer.php?id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="lnr lnr-pencil mr-2"></i></a>
             <?php } if(in_array("11", $Options)){?>
              &nbsp;&nbsp;<a onClick="return confirm('Are you sure you want delete this user account?\nNote : Delete all record related this user (Y/N)');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="lnr lnr-trash text-danger"></i></a>
             <?php } ?>
            </td> <?php } ?>
        
              
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
