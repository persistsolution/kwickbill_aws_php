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
  $sql11 = "DELETE FROM tbl_users WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-inactive-employee.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Inactive Employee Account List
    <?php if(in_array("14", $Options)) {?>   
<span style="float: right;">
<a href="add-employee.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add New</a></span><?php } ?>
</h4>

<div class="card" style="padding: 10px;">
    <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

  <div class="form-group col-md-2">
                                            <label class="form-label">Zone </label>
                                            <select class="form-control" id="ZoneId" name="ZoneId" required="">
                                                <option selected=""  value="all">All</option>
                                                <?php $sql = "SELECT * FROM tbl_zone WHERE Status=1";
                                                    $row = getList($sql);
                                                    foreach($row as $result){?>
                                                <option value="<?php echo $result['id'];?>" <?php if($_POST["ZoneId"]==$result['id']) {?> selected
                                                    <?php } ?>><?php echo $result['Name'];?></option>
                                                <?php } ?>
                                                  
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>

  <div class="form-group col-md-5">
                                            <label class="form-label">Franchise</label>
                                            <select class="select2-demo form-control" name="UserId" id="UserId">
                                                <option selected="" value="all">All</option>
                                                <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll IN(5) AND ShopName!=''";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
                                                <option <?php if($_REQUEST['UserId']==$result['id']){ ?> selected <?php } ?>
                                                    value="<?php echo $result['id']; ?>"><?php echo $result['ShopName']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>


<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top:30px;">
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_POST['Search'])) {?>
<div class="col-md-1">
<label class="form-label d-none d-md-block">&nbsp;</label>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" data-original-title="Clear Filter">X</a>
</div>
<?php } ?>
</div>

</form>
                                            </div>
                                        </div>
                                    </div>
   </div>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
               <th>Action</th>
               <?php } ?>
               <?php if ($user_id == 2651 || $user_id == 2650){?>
               <th>Modified By</th>
               <?php } ?>
                <th>QR Code</th>
                <th>Photo</th>
                <th>Lattitude</th>
                <th>Longitude</th>
                <th>Track Location</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                 <th>Zone</th>
                <!--<th>Pending 1st Level Expenses</th>
                <th>Pending 2nd Level Expenses</th>-->
               <th>Contact No</th>
               <th>Another Contact No</th>
                <th>Status</th>
                <!--<th>Password</th> -->
                <th>Under By Employee</th>
                <th>Under Franchises</th>
                <th>Roll</th>
                <th>Reporting Manager</th>
                 <th>Under By Reporting Manager</th>
                <th>Email Id</th>
               
                
                <th>Address</th>
                 <th>Date of Join</th>
                 <th>Per Day Salary</th>
                 
               
                <th>Register Date</th>
                 <th>City</th>
                  <th>Date Of Birth</th>
               <th>Aadhar Card No</th>
                <th>Blood Group</th>
                <th>Bank Holder Name</th>
                <th>Bank Name</th>
                <th>Account No</th>
                <th>Branch</th>
                <th>IFSC Code</th>
                <th>UPI ID</th>
                <th>Referal Code</th>
                <th>Referral Name</th>
                <th>Reference Mobile No</th>
                <th>Reference Mobile No 2</th>
                <th>Reference Email Id</th>
                <th>Nominee Name</th>
                <th>Nominee Relation</th>
                <th>Nominee Contact No</th>
                <th>Nominee Aadhar Card No</th>
                <th>Monthly Salary</th>
                <th>Resignation Date</th>
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT tu.*,tut.Name,tu2.Fname As UnderName,tu3.ShopName As UnderFrName,tu4.Fname AS UserByEmpName,tc.Name AS CityName,tu5.Fname As ModifiedName FROM tbl_users tu 
                    LEFT JOIN tbl_user_type tut ON tut.id=tu.Roll 
                    LEFT JOIN tbl_users tu2 ON tu.UnderUser=tu2.id 
                    LEFT JOIN tbl_users tu3 ON tu3.id=tu.UnderFrId 
                    LEFT JOIN tbl_city tc ON tc.id=tu.CityId 
                    LEFT JOIN tbl_users tu5 ON tu5.id=tu.ModifiedBy 
                    LEFT JOIN tbl_users tu4 ON tu4.id=tu.UnderByUser WHERE tu.Roll NOT IN(1,5,55,9,22,23,63,3) AND tu.OtherEmp=0 AND tu.Status=0";
            if($_POST['UserId']){
                $UserId = $_POST['UserId'];
                if($UserId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tu.UnderFrId='$UserId'";
                }
            }        
            if($_POST['ZoneId']){
                $ZoneId = $_POST['ZoneId'];
                if($ZoneId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tu.ZoneId='$ZoneId'";
                }
            }
            $sql.= " ORDER BY tu.CreatedDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               if($row['UnderUser'] == 0){
                  $UnderUserName = "NA";
                }
                else{
                  $UnderUserName = $row['UnderName'];
                }
                 $sql2 = "SELECT * FROM tbl_zone WHERE id='".$row['ZoneId']."'";
                $row2 = getRecord($sql2);
             ?>
            <tr>
                <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
            <td>
              <?php if(in_array("10", $Options)){?>
              <a href="add-employee.php?id=<?php echo $row['id']; ?>" ><i class="lnr lnr-pencil mr-2"></i></a>
             <?php } if(in_array("11", $Options)){?>
              &nbsp;&nbsp;<a onClick="return confirm('Are you sure you want delete this user account?\nNote : Delete all record related this user (Y/N)');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete"><i class="lnr lnr-trash text-danger"></i></a>
             <?php } ?>
            </td> <?php } ?>
            <?php if ($user_id == 2651 || $user_id == 2650){?>
            <td><?php echo $row['ModifiedName'];?></td>
            <?php } ?>
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
             <td><?php echo $row['Lattitude']; ?></td>
             <td><?php echo $row['Longitude']; ?></td>
             <td><a href="track-emp-location.php?id=<?php echo $row['id']; ?>" target="_new">Track Location</a></td>
             <td><?php echo $row['CustomerId']; ?></td>
               <td><a href="customer-profile.php?id=<?php echo $row['id']; ?>" target="_new"><?php echo $row['Fname']." ".$row['Lname']; ?></a></td>
                  <td><?php echo $row2['Name']; ?></td>
               <!--<td><a href="view-first-level-employee-expenses.php?id=<?php echo $row['id']; ?>" target="_new">View</a></td>
               <td><a href="view-second-level-employee-expenses.php?id=<?php echo $row['id']; ?>" target="_new">View</a></td>-->
                 <td><?php echo $row['Phone']; ?></td>
                  <td><?php echo $row['Phone2']; ?></td>
                   <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Active</span>";} else { echo "<span style='color:red;'>In Active</span>";} ?></td>
               <!--<td><?php echo $row['Password']; ?></td> -->
               
               <td><?php echo $row['UserByEmpName'];?></td>
               <td><?php echo $row['UnderFrName'];?></td>
                  <td><?php echo $row['Name'];?></td>
                <td><?php if($row['ReportingMgr']=='1'){echo "<span style='color:green;'>Yes</span>";} else { echo "<span style='color:red;'>No</span>";} ?></td>
              <td><?php echo $UnderUserName;?></td>
                
                <td><?php echo $row['EmailId']; ?></td>
             
              
               <td><?php echo $row['Address']; ?></td>
               <td><?php echo $row['JoinDate']; ?></td>
                <td><?php echo $row['PerDaySalary']; ?></td>
                <!--   -->
              
                  
               
              
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
            <td><?php echo $row['CityName']; ?></td>
            <td><?php if (!empty($row['Dob']) && $row['Dob'] != '0000-00-00') { echo date("d/m/Y", strtotime($row['Dob']));} ?></td>
             <td><?php echo $row['AadharNo']; ?></td>
            <td><?php echo $row['BloodGroup']; ?></td>
            <td><?php echo $row['AccountName']; ?></td>
            <td><?php echo $row['BankName']; ?></td>
            <td><?php echo $row['AccountNo']; ?></td>
            <td><?php echo $row['Branch']; ?></td>
            <td><?php echo $row['IfscCode']; ?></td>
            <td><?php echo $row['UpiNo']; ?></td>
            <td><?php echo $row['ReferCode'];?></td>
            <td><?php echo $row['ReferName'];?></td>
            <td><?php echo $row['RefPhone']; ?></td>
            <td><?php echo $row['RefPhone2']; ?></td>
            <td><?php echo $row['RefEmailId']; ?></td>
            <td><?php echo $row['NomineeName']; ?></td>
            <td><?php echo $row['NomineeRelation']; ?></td>
            <td><?php echo $row['NomineePhone']; ?></td>
            <td><?php echo $row['NomineeAadharNo']; ?></td>
           
         <td><?php echo $row['MonthlySalary']; ?></td>
                 <td><?php if (!empty($row['ResignDate']) && $row['ResignDate'] != '0000-00-00') { echo date("d/m/Y", strtotime($row['ResignDate']));} ?></td>
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
