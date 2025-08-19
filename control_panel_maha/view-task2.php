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



<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_task_new WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-tasks2.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Task List
    <?php if(in_array("14", $Options)) {?>   
<span style="float: right;">
<a href="add-task2.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add New</a></span><?php } ?>
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
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63) AND Fname!='' ORDER BY Fname";
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
<div class="form-group col-md-1" style="padding-top:25px;">
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
                                            <th>Action</th>
                                             <th>Created By</th> 
                                            <th>Executive Name</th> 
                                            <th>Task</th>
                                            <th>Task Date</th>
                                            <th>Last Action Emp Name</th>
                                            <th>Last Action Date</th>
                                            <th>Last Action</th>
                                            <th>Task Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>  
                                       <?php
                                       $i=1;
                                       $ExeId = $_POST['ExeId'];
                            $sql = "SELECT tp.*,tu.Fname,tu2.Fname AS CreatedByName FROM tbl_task_new tp 
                            LEFT JOIN tbl_users tu ON tu.id=tp.UserId 
                            LEFT JOIN tbl_users tu2 ON tu2.id=tp.CreatedBy WHERE 1";
                            
                            if ($Roll != 1) {
    $sql .= " AND (FIND_IN_SET('$user_id', tp.UserId) > 0 OR FIND_IN_SET('$user_id', tp.CreatedBy) > 0)";
}
            
            if (!empty($ExeId) && $ExeId !== 'all'){
                $sql.=" AND tp.UserId='$ExeId'";
            }
            
                          /*  if($_REQUEST['DeptId']){
                $DeptId = $_REQUEST['DeptId'];
                if($DeptId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tp.DeptId='$DeptId'";
                }
            }*/
                            $sql .= " ORDER BY tp.CreatedDate DESC";
                           // echo $sql;
                                    $row = getList($sql);
                                    foreach ($row as $result) {
                                        $sql3 = "SELECT tpf.*,tu.Fname,tu.Lname FROM tbl_task_details tpf LEFT JOIN tbl_users tu ON tpf.CreatedBy=tu.id WHERE tpf.CompId='".$result['id']."' ORDER BY tpf.id DESC LIMIT 1";
                $rncnt3 = getRow($sql3);
                $row3 = getRecord($sql3);
                if($row3['ClainStatus'] == 'In Progress'){
                    $bcolor = "background-color: #fbc889;";
                }
                else if($row3['ClainStatus'] == 'Completed'){
                    $bcolor = "background-color: #69f769;";
                }
                else if($row3['ClainStatus'] == 'Cancelled'){
                    $bcolor = "background-color: #f98d8d;";
                }
                else{
                    $bcolor = "";
                }
                                    ?>
                                        <tr style="<?php echo $bcolor;?>">
                                            <td><?php echo $i; ?> </td>
                                             <td><a href="javascript:void(0)" onclick="getFeedback(<?php echo $result['id']; ?>)" class="btn btn-primary btn-finish" style="padding: 0.5px 1rem">Open</a></td>
                                             <td><?php echo $result['CreatedByName']; ?></td>
                                             <td><?php echo $result['Fname']; ?></td> 
              <td><?php echo $result['TaskName']; ?></td> 
              <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$result['TaskDate']))); ?></td>
              <td><?php echo $row3['Fname']." ".$row3['Lname']; ?></td>
               <td><?php if($row3['CreatedDate']!=''){ echo date("d/m/Y", strtotime(str_replace('-', '/',$row3['CreatedDate']))); } else { echo "-";}?></td>
              <td><?php echo $row3['Message']; ?></td>
              <td><?php echo $row3['ClainStatus']; ?></td>
             
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
        ]
    });
});

function getFeedback(id) {
            setTimeout(function() {
                window.open(
                    'take-task-action.php?qid=' + id, 'stickerPrint',
                    'toolbar=1, scrollbars=1, location=1,statusbar=0, menubar=1, resizable=1, width=800, height=800,left=250,top=50,right=50'
                );
            }, 1);
        }
</script>
</body>
</html>
