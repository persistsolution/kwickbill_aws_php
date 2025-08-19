<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Report";
$Page = "Attendance-Report";
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
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off" required>
</div>
<div class="form-group col-md-2">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off" required>
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
               <th>Under Franchise</th>
               <?php 
               $sql = "SELECT DISTINCT(CreatedDate) AS CreatedDate FROM tbl_attendance WHERE Status IN (1,0)";
               if($_POST['UserId']){
                $UserId = $_POST['UserId'];
                if($UserId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND UserId='$UserId'";
                }
            }
               if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND CreatedDate>='$FromDate'";
                }
                if($_POST['ToDate']){
                    $ToDate = $_POST['ToDate'];
                    $sql.= " AND CreatedDate<='$ToDate'";
                }

                $sql.= " ORDER BY CreatedDate";
               $row = getList($sql);
               foreach($row as $result){
               ?>
                <th><?php echo date("d M", strtotime(str_replace('-', '/',$result['CreatedDate']))); ?></th> 
               <?php } ?>
             
                <th>Total</th>
              <!--  <th>Sundays</th>-->
                <th>Late Marks</th>
              <!--<th>Net Days</th>-->
              
              <th>Total Salary</th>
              
              <th>Advance</th>
              <th>Advance Date</th>
               <th>Paid Salary</th>
            </tr>
        </thead>
        <tbody>
            <?php 
           
            $i=1;
            $sql = "SELECT * FROM tbl_users WHERE Status=1 AND Roll NOT IN(1,5,55,9,22,23,63,3)
                    ";
            if($_POST['UserId']){
                $UserId = $_POST['UserId'];
                if($UserId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND id='$UserId'";
                }
            }
            $sql.=" ORDER BY Fname";    
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
                
                if($row33['Latemark']==''){
                    $Latemark = 0;
                }
                else{
                    $Latemark = $row33['Latemark'];
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
                
                $sql96 = "SELECT SUM(AdvanceSalary) AS AdvanceSalary,AccPaidDate,AccPaidStatus FROM tbl_advance_salary WHERE HrStatus=1 AND UserId='".$row['id']."' ";
                if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql96.= " AND AdvanceDate>='$FromDate'";
                }
                if($_POST['ToDate']){
                    $ToDate = $_POST['ToDate'];
                    $sql96.= " AND AdvanceDate<='$ToDate'";
                }
                $row96 = getRecord($sql96);

                $sql4 = "SELECT MIN(CreatedDate) AS StartDate,MAX(CreatedDate) AS EndDate FROM tbl_attendance WHERE UserId='".$row['id']."' AND Type=1";
                if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql4.= " AND CreatedDate>='$FromDate'";
                }
                if($_POST['ToDate']){
                    $ToDate = $_POST['ToDate'];
                    $sql4.= " AND CreatedDate<='$ToDate'";
                }
                //echo $sql4;
                $row4 = getRecord($sql4);
                $StartDate = $row4['StartDate'];
                $EndDate = $row4['EndDate'];

                $sundays=0; for($i=$StartDate;$i<=$EndDate;$i++) { $day=date("N",strtotime($i)); if($day==7) { $sundays++; } } 

                
                $sql89 = "SELECT ShopName FROM tbl_users WHERE id='".$row['UnderFrId']."'";
                $row89 = getRecord($sql89);
             ?> 
            <tr> 
              
               <td><?php echo $row['Fname']; ?></td> 
               <td><?php echo $row89['ShopName']; ?></td> 
                <?php 
                 $sql2 = "SELECT DISTINCT(CreatedDate) AS CreatedDate FROM tbl_attendance WHERE Status IN (1,0)";
                 if($_POST['UserId']){
                $UserId = $_POST['UserId'];
                if($UserId == 'all'){
                    $sql2.= " ";
                }
                else{
                $sql2.= " AND UserId='$UserId'";
                }
            }
               if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql2.= " AND CreatedDate>='$FromDate'";
                }
                if($_POST['ToDate']){
                    $ToDate = $_POST['ToDate'];
                    $sql2.= " AND CreatedDate<='$ToDate'";
                }

                $sql2.= " ORDER BY CreatedDate";
                 $row2 = getList($sql2);
               foreach($row2 as $result){
                $sql3 = "SELECT * FROM tbl_attendance WHERE UserId='".$row['id']."' AND CreatedDate='".$result['CreatedDate']."' AND Type=1";
                if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql2.= " AND CreatedDate>='$FromDate'";
                }
                if($_POST['ToDate']){
                    $ToDate = $_POST['ToDate'];
                    $sql2.= " AND CreatedDate<='$ToDate'";
                }
               $rncnt3 = getRow($sql3);
               if($rncnt3 > 0){  
                $row3 = getRecord($sql3);
                
                
                
               ?>
                 <!--<td><?php echo $row3['Status'];?></td>-->
                 <td style="color: #20f020;">P</td>
              <?php }  else{ ?>
                <td style="color: red;">A</td>
              <?php } } ?>
            <td><?php echo $TotPresent;?></td>
           <!-- <td><?php echo $sundays;?></td>-->
              <td><?php echo $Latemark;?></td>
           <!-- <td><?php echo $sundays+$row33['TotPresent'];?></td>-->
           <td><?php echo $salary;?></td>
           <?php if($row96['AccPaidStatus']==1){?>
          
           <td><?php echo $row96['AdvanceSalary'];?></td>
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row96['AccPaidDate']))); ?></td>
           <td><?php echo $salary-$row96['AdvanceSalary'];?></td>
           <?php } else { ?>
           <td></td>
           <td>0</td>
           <td><?php echo $salary;?></td>
           <?php } ?>
           
            </tr>
           <?php $i++;} ?>

          
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
