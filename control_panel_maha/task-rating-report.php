<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Task";
$Page = "View-Task";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Task List</title>
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
<h4 class="font-weight-bold py-3 mb-0">Task Rating Report
    
</h4>

<div class="card" style="padding: 10px;">

     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       

  <div class="form-group col-md-4">
<label class="form-label"> Executive<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="ExeId" id="ExeId" required>
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_POST["ExeId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-3">
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

<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
                                        <tr>
                                            <th>#</th>
                                           
                                            <th>Executive Name</th> 
                                            <th>Total Task</th>
                                            <th>Pending Task</th>
                                            <th>Complete Task</th>
                                            <th>%</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>  
                                      <?php 
                                            $i = 1;
                                            $where = [];

if (!empty($_REQUEST['ExeId']) && $_REQUEST['ExeId'] !== 'all') {
    $ExeId = $_REQUEST['ExeId'];
    $where[] = "ts.UserId = '$ExeId'";
}

if (!empty($_POST['FromDate'])) {
    $FromDate = $_POST['FromDate'];
    $where[] = "ts.TaskDate >= '$FromDate'";
}

if (!empty($_POST['ToDate'])) {
    $ToDate = $_POST['ToDate'];
    $where[] = "ts.TaskDate <= '$ToDate'";
}

// Build WHERE clause
$where_clause = '';
if (!empty($where)) {
    $where_clause = "WHERE " . implode(" AND ", $where);
}

// Final SQL query
$sql = "SELECT tu.Fname, ts.UserId, COUNT(*) AS total_tasks,
        SUM(CASE WHEN ts.ClainStatus = 'Pending' THEN 1 ELSE 0 END) AS pending_tasks
        FROM tbl_task_new ts 
        INNER JOIN tbl_users tu ON tu.id = ts.UserId
        $where_clause
        GROUP BY ts.UserId";
                                            $rows = getList($sql);
                                            foreach ($rows as $result) {
                                                $completed_tasks = $result['total_tasks'] - $result['pending_tasks'];
                                                 $completion_percentage = ($result['total_tasks'] > 0) ? round(($completed_tasks / $result['total_tasks']) * 100, 2) : 0;
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo htmlspecialchars($result['Fname']); ?></td>
                                                    <td><?php echo $result['total_tasks']; ?></td>
                                                    <td><?php echo $result['pending_tasks']; ?></td>
                                                    <td><?php echo $completed_tasks; ?></td>
                                                    <td><?php echo $completion_percentage; ?>%</td>
                                                </tr>
                                            <?php 
                                                $i++;
                                            } 
                                        ?>
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
