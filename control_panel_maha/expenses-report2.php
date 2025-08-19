<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Report".$_REQUEST['val'];
$Page = "Expenses-Report".$_REQUEST['val'];
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> </title>
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





<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Expense Request
  
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

  <div class="form-group col-md-4">
<label class="form-label"> Employee<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="UserId" id="UserId" required>
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_POST["UserId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-2">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-2">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top:30px;">
    <label class="form-label">&nbsp;</label>
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_POST['Search'])) {?>
<div class="form-group col-md-1">
<label class="form-label">&nbsp;</label>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" data-original-title="Clear Filter">X</a>
</div>
<?php } ?>
</div>

</form>
                                            </div>
                                        </div>
                                    </div>
   </div>
    <?php if(isset($_POST['Search'])) {?>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                 <th>Manager Approve</th>
                  <th>Admin/Account Approve</th>
               <th>Photo</th>
               <th>Zone</th>
                <th>Employee Name</th>
                <th>Category</th>
                 <!--<th>Franchise</th>
                 <th>Locations</th>-->
                <th>Vendor Mobile No</th>
                <th>Amount</th>
                <th>PaymentMode</th>
                <th>Narration</th>
                 <th>Receipt</th>
                 <th>Payment Receipt</th>
                <th>Status</th>
                <th>Expense Date</th>
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT te.*,tu.ZoneId,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AccName,tec.Name As ExpCatName,tub.ShopName,tl.Name AS ExpLocation FROM tbl_expense_request te 
                LEFT JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AccBy 
                LEFT JOIN tbl_expenses_category tec ON tec.id=te.ExpCatId 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.FrId 
                LEFT JOIN tbl_locations tl ON tl.id=te.Locations WHERE 1";
             if($_POST['UserId']){
                $ExeId = $_POST['UserId'];
                if($ExeId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND te.UserId='$ExeId'";
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
           if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND te.ExpenseDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND te.ExpenseDate<='$ToDate'";
            }
            $sql.=" ORDER BY te.ExpenseDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                 $MgrName = $row['MgrName'];
                 $AccName = $row['AccName'];
                 
                 $sql2 = "SELECT * FROM tbl_zone WHERE id='".$row['ZoneId']."'";
                $row2 = getRecord($sql2);
             ?>
            <tr>
                 <td><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName </span>";} else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName</span>";} else { echo "<span style='color:orange;'>Pending By Manager</span>"; } ?></td>
                
  <td><?php if($row['AdminStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $AccName </span>";} else if($row['AdminStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $AccName </span>";} else { echo "<span style='color:ornage;'>Pending </span>";}?></td>
 
               <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
               <td><?php echo $row2['Name']; ?></td> 
               <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
               <td><?php echo $row['ExpCatName'];?></td>
               <!--<td><?php echo $row['ShopName'];?></td>
               <td><?php echo $row['ExpLocation'];?></td>-->
                 <td><?php echo $row['VedPhone']; ?></td>
                <td><?php echo $row['Amount']; ?></td> 
               <td><?php echo $row['PaymentMode']; ?></td>
                  <td><?php echo $row['Narration']; ?></td>
              <td><?php if($row["Photo"] == '') {?>
                  <span style="color:red;">No Receipt Found</span>
                 <?php } else if(file_exists('../uploads/'.$row["Photo"])){?>
                 <a href="../uploads/<?php echo $row["Photo"];?>" target="_blank">View Receipt</a>
                  <?php }  else{?>
                <span style="color:red;">No Receipt Found</span>
             <?php } ?></td>
             
             <td><?php if($row["Photo2"] == '') {?>
                  <span style="color:red;">No Receipt Found</span>
                 <?php } else if(file_exists('../uploads/'.$row["Photo2"])){?>
                 <a href="../uploads/<?php echo $row["Photo2"];?>" target="_blank">View Receipt</a>
                  <?php }  else{?>
                <span style="color:red;">No Receipt Found</span>
             <?php } ?></td>
                     
                 <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Approved</span>";} else { echo "<span style='color:red;'>Pending</span>";} ?></td>
              
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ExpenseDate']))); ?></td>
           
            </tr>
           <?php } ?>
        </tbody>
    </table>
</div><?php } ?>
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
 function changeStatus(id,val){
     window.location.href='expense-request.php?action=changestatus&id='+id+'&status='+val;
 }
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
