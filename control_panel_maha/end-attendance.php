<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "End-Attendance";
$Page = "End-Attendance";
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
<h4 class="font-weight-bold py-3 mb-0">End Attendance
</h4>

<div class="card" style="padding: 10px;">

    
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Sr No</th>
                <th>Executive Name</th>
                <th>Date</th> 
                <th>Time</th> 
                <th>Lattitude</th> 
                <th>Longitude</th> 
                <th>End Attendance Status</th> 
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT tp.*,tc.Fname FROM tbl_attendance tp 
            LEFT JOIN tbl_users tc ON tc.id=tp.UserId WHERE tp.Type=1 AND tp.AttRoll=0 AND tp.CreatedDate>='2024-09-01'";
            if($_POST['ExeId']){
                $ExeId = $_POST['ExeId'];
                if($ExeId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tp.UserId='$ExeId'";
                }
            }
           if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND tp.CreatedDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND tp.CreatedDate<='$ToDate'";
            }
            $sql.= " ORDER BY tp.CreatedDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               $sql2 = "SELECT * FROM tbl_attendance WHERE UserId='".$row['UserId']."' AND CreatedDate='".$row['CreatedDate']."' AND Type=2";
               $rncnt2 = getRow($sql2);
               if($rncnt2 > 0){}
                else{
             ?>
            <tr>
                <td><?php echo $i; ?> </td>
                <td><?php echo $row['Fname']; ?></td> 
                <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
                <td><?php echo date("h:i a", strtotime(str_replace('-', '/',$row['CreatedTime']))); ?></td>
                <td><?php echo $row['Latitude']; ?></td> 
                <td><?php echo $row['Longitude']; ?></td> 
                <td><a href="take-end-attendance.php?id=<?php echo $row['id']; ?>" target="_new">Click For End Attendance</a></td>
               
           
         
              
            </tr>
           <?php $i++;} } ?>
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
    });
});
</script>
</body>
</html>
