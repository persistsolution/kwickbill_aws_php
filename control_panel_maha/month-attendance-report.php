<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Report";
$Page = "Month-Attendance-Report";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | Attendance Report</title>
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
<h4 class="font-weight-bold py-3 mb-0">Attendance Report</h4>

<div class="card" style="padding: 10px;">
     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

  

  <div class="form-group col-md-5">
                                            <label class="form-label">Executive</label>
                                            <select class="select2-demo form-control" name="UserId" id="UserId">
                                                <option selected="" value="all">All</option>
                                                <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(5,1)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
                                                <option <?php if($_REQUEST['UserId']==$result['id']){ ?> selected <?php } ?>
                                                    value="<?php echo $result['id']; ?>"><?php echo $result['Fname']; ?></option>
                                                <?php } ?>
                                            </select>
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
   <?php if(isset($_POST['Search'])) {?>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
         <thead>
            <tr>
               <th>Employee Name</th>
               <th>Designation</th>
               <th>Location</th>
               <th>Present Day Of Month</th>
               <th>Mobile No</th>
               <th>Status</th>
               <th>Salary</th>
               
            </tr>
        </thead>
        <tbody>
            <?php 
           

            $i=1;
            $sql = "SELECT tu.*,tc.Name AS CityName FROM tbl_users tu LEFT JOIN tbl_city tc ON tu.CityId=tc.id WHERE tu.Status=1 AND tu.Roll NOT IN(1,5,55,9,22,23,63,3)
                    ";
            if($_POST['UserId']){
                $UserId = $_POST['UserId'];
                if($UserId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tu.id='$UserId'";
                }
            }
            $sql.=" ORDER BY tu.Fname";     
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                $sql3 = "SELECT SUM(Status) As TotPresent,SUM(Latemark) AS Latemark FROM tbl_attendance WHERE UserId='".$row['id']."' AND Status=1 AND Type=1";
                if($_POST['UserId']){
                $UserId = $_POST['UserId'];
                if($UserId == 'all'){
                    $sql3.= " ";
                }
                else{
                $sql3.= " AND UserId='$UserId'";
                }
                }
                if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql3.= " AND CreatedDate>='$FromDate'";
                }
                if($_POST['ToDate']){
                    $ToDate = $_POST['ToDate'];
                    $sql3.= " AND CreatedDate<='$ToDate'";
                }
                
                //echo $sql3;
                $row33 = getRecord($sql3);
                if($row33['TotPresent']==''){
                    $TotPresent = 0;
                }
                else{
                    $TotPresent = $row33['TotPresent'];
                }
                
                $now = strtotime($_POST['ToDate']); // or your date as well
                $your_date = strtotime($_POST['FromDate']);
                $datediff = $now - $your_date;

                 $totdays = round($datediff / (60 * 60 * 24))+1; 
                
            
                if($row['SalaryType'] == 1){
                    $PerdaySal = $row['PerDaySalary'];
                    $salary = $TotPresent*$PerdaySal;
                }
                else{
                    $MonthSal = $row['PerDaySalary'];
                    $PerdaySal = $MonthSal/$totdays;
                    $salary = $TotPresent*$PerdaySal;
                }
                
            ?>
                <tr>
                    <td><?php echo $row['Fname']; ?></td> 
                    <td><?php echo $row['Designation']; ?></td>
                    <td><?php echo $row['CityName']; ?></td>
                    <td><?php echo $TotPresent;?></td>
                    <td><?php echo $row['Phone']; ?></td>
                    <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Active</span>";} else { echo "<span style='color:red;'>In Active</span>";} ?></td>
                    <td><?php echo round($salary);?></td>
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
