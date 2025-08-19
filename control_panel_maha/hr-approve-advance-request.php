<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "HR-Advance";
$Page = "HR-Approve-Advance-Request";
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
<h4 class="font-weight-bold py-3 mb-0">HR Approve Advance Request
  
</h4>

<div class="card" style="padding: 10px;">
    <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

 
<div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-3">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top: 30px;">
    <label class="form-label">&nbsp;</label>
<button type="submit" class="btn btn-primary btn-finish">Search</button>
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
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                
                 <th>Request Id</th>
                    <th>Request Date</th>
                    <th>HR Approve</th>
                   <th>Manager Approve</th>
                 
               <th>Photo</th>
                <th>Employee Name</th>
               <th>Advance Salary</th>
                <th>Narration</th>
              <th>Bank Holder Name</th>
                <th>Bank Name</th>
                <th>Account No</th>
                <th>Branch</th>
                <th>IFSC Code</th>
                <th>UPI ID</th>
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
          
         
               $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AccName,tu.AccountName,tu.BankName,tu.AccountNo,tu.Branch,tu.IfscCode,tu.UpiNo FROM tbl_advance_salary te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.HrBy 
                WHERE te.UserId!=0 AND te.HrStatus=1 "; 
             if ($_POST['FromDate']) {
            $FromDate = $_POST['FromDate'];
            $sql .= " AND te.AdvanceDate >= '$FromDate'";
        }
        if ($_POST['ToDate']) {
            $ToDate = $_POST['ToDate'];
            $sql .= " AND te.AdvanceDate <= '$ToDate'";
        }
            $sql.=" ORDER BY te.AdvanceDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                    $MgrName = $row['MgrName'];
                    $AccName = $row['AccName'];
               
             ?>
            <tr>
                

<td><?php echo $row['id'];?></td>
  <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['AdvanceDate']))); ?></td>
  
               <td><?php if($row['HrStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $AccName </span>";} else if($row['HrStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $AccName</span>";} else {?>
                 <span style='color:orange;'>Pending By HR</span><?php } ?></td>
               
 <td id="showstatus<?php echo $row['id']; ?>"><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName </span>";} else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName</span>";} else {?>
 Approve By Manager<?php } ?><br>
  </td>

               <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
               <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
               
                  <td><?php echo $row['AdvanceSalary']; ?></td>
                   <td><?php echo $row['Narration']; ?></td>
             
                
                <td><?php echo $row['AccountName']; ?></td>
            <td><?php echo $row['BankName']; ?></td>
            <td><?php echo $row['AccountNo']; ?></td>
            <td><?php echo $row['Branch']; ?></td>
            <td><?php echo $row['IfscCode']; ?></td>
            <td><?php echo $row['UpiNo']; ?></td>
              
           
           
            </tr>
           <?php $i++;} ?>
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
        ],
        order: [[0, 'desc']]
    });
});
</script>
</body>
</html>
