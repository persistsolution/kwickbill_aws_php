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
                                            <select class="select2-demo form-control" name="ExeId" id="ExeId">
                                                <option selected="" value="all">All</option>
                                                <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN (1,5)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
                                                <option <?php if($_REQUEST['ExeId']==$result['id']){ ?> selected <?php } ?>
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
               <th>Emp ID</th>
              <th>Emp Name</th>
              <th>Under Franchise</th>
              <th>Zone</th>
              <th>Reporting Manager</th>
              <th>BDM</th>
            
             
                <th>Date</th>
                <th>Start Time</th>
                <th>Start Latitude</th>
              <th>Start Longitude</th>
              <th>Start Photo</th>
              <th>End Time</th>
                <th>End Latitude</th>
              <th>End Longitude</th>
              <th>End Photo</th>
             <th>Present/Absent</th>
             <th>Salary</th>
               <th>Phone No</th>
               
            </tr>
        </thead>
        <tbody>
            <?php 
           
            $i=1;
            $sql = "SELECT ta.*,tu.Fname,tu.Phone,tu.UnderFrId,tu.CustomerId,tu.UnderByBdm,tu.ZoneId,tu.UnderByUser,tu.SalaryType,tu.PerDaySalary,tu.MonthlySalary FROM tbl_attendance ta INNER JOIN tbl_users tu ON tu.id=ta.Userid WHERE tu.Roll NOT IN(1,5,55,9,22,23,63,3)
                    ";
             if($_POST['ExeId']){
                $UserId = $_POST['ExeId'];
                if($UserId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND ta.UserId='$UserId'";
                }
            }
                    
            if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND ta.CreatedDate>='$FromDate'";
                }
                if($_POST['ToDate']){
                    $ToDate = $_POST['ToDate'];
                    $sql.= " AND ta.CreatedDate<='$ToDate'";
                }
            $sql.=" GROUP BY ta.CreatedDate,ta.UserId ORDER BY tu.Fname";      
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                
            $sql33 = "SELECT * FROM tbl_attendance WHERE CreatedDate='".$row['CreatedDate']."' AND UserId='".$row['UserId']."' AND Type=1";
                    $rncnt33 = getRow($sql33);
                    $row33 = getRecord($sql33);

                    $sql34 = "SELECT * FROM tbl_attendance WHERE CreatedDate='".$row['CreatedDate']."' AND UserId='".$row['UserId']."' AND Type=2";
                    $rncnt34 = getRow($sql34);
                    $row34 = getRecord($sql34);

                    if($rncnt33 > 0){
                        $bgcolor = "background-color: #acf3ac;";
                        $st_time = date("h:i a", strtotime(str_replace('-', '/',$row33['CreatedTime'])));
                    }
                    else{
                        $bgcolor = "background-color: #f55d5d;";
                        $st_time = "";
                    }

                    if($rncnt34 > 0){
                        $bgcolor2 = "background-color: #acf3ac;";
                        $ed_time = date("h:i a", strtotime(str_replace('-', '/',$row34['CreatedTime'])));
                    }
                    else{
                        $bgcolor2 = "background-color: #f55d5d;";
                        $ed_time = "";
                    }
                    
                     $sql89 = "SELECT ShopName FROM tbl_users WHERE id='".$row['UnderFrId']."'";
                $row89 = getRecord($sql89);
                
                 $sql891 = "SELECT Fname FROM tbl_users WHERE id='".$row['UnderByBdm']."'";
                $row891 = getRecord($sql891);
                
                $sql892 = "SELECT Name FROM tbl_zone WHERE id='".$row['ZoneId']."'";
                $row892 = getRecord($sql892);
                
                $sql893 = "SELECT Fname FROM tbl_users WHERE id='".$row['UnderByUser']."'";
                $row893 = getRecord($sql893);
                
                
                $SalaryType = $row['SalaryType'];
                if($SalaryType == 2){
                    $Salary = $row['MonthlySalary']/30;
                }
                else{
                    $Salary = $row['PerDaySalary']/30;
                }
                
            ?>
            <tr>
                 <td><?php echo $row['CustomerId'];?></td>
                 <td><?php echo $row['Fname'];?></td>
                  <td><?php echo $row89['ShopName']; ?></td> 
                  <td><?php echo $row892['Name']; ?></td> 
                    <td><?php echo $row893['Fname']; ?></td> 
                    <td><?php echo $row891['Fname']; ?></td> 
                <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
               
                <td><?php echo $st_time; ?></td>
                <td><a href="attendance-track-location.php?Latitude=<?php echo $row33['Latitude'];?>&Longitude=<?php echo $row33['Longitude'];?>" target="_new"><?php echo $row33['Latitude'];?></a></td>
                <td><a href="attendance-track-location.php?Latitude=<?php echo $row33['Latitude'];?>&Longitude=<?php echo $row33['Longitude'];?>" target="_new"><?php echo $row33['Longitude'];?></a></td>
                 <td><?php if($row33["Photo"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row33["Photo"])){?>
                 <img src="../uploads/<?php echo $row33["Photo"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
             
             <td><?php echo $ed_time; ?></td>
                <td><?php echo $row34['Latitude'];?></td>
                <td><?php echo $row34['Longitude'];?></td>
                 <td><?php if($row34["Photo"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row34["Photo"])){?>
                 <img src="../uploads/<?php echo $row34["Photo"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
             <?php if($rncnt34 > 0){?>
           <td>P</td>
           <?php } else {?>
           <td>A</td>
           <?php } ?>
           
           <?php if($rncnt34 > 0){?>
           <td><?php echo number_format($Salary,2);?></td>
            <?php } else {?>
            <td>0</td>
            <?php } ?>
            
            <td><?php echo $row['Phone'];?></td>
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
