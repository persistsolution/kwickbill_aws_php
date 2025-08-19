<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Scholarship";
$Page = "View-Sch-Ques-Ans";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Question & Answer List</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
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
  $sql11 = "DELETE FROM tbl_survey_questions WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-survey.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Survey Question List
 <?php if(in_array("26", $Options)) {?> 
<span style="float: right;">
<a href="add-survey.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add Question </a></span>
<?php } ?>
</h4>


<div class="card">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
               <th>#</th>
                
                <th>Questions</th>
                <th>Status</th>
                <th>Created Date</th>
                <?php if(in_array("27", $Options) || in_array("28", $Options)) {?> <th>Action</th>
              <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            $sql = "SELECT tlc.* FROM tbl_survey_questions tlc 
                    
                    
                     WHERE tlc.Status IN(1,0)"; 
    if($_POST['TestSeriesId']!=''){
    $sql.= " AND tlc.TestSeriesId='".$_POST['TestSeriesId']."'";     
    }
   
     $sql.= "ORDER BY tlc.CreatedDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
             
             ?>
            <tr>
               <td><?php echo $i; ?></td>
         
                <td><a href="javascript:void(0);" data-toggle="modal" data-target="#modals-default<?php echo $row['id']; ?>">View Question</a></td>

              
                 
                 <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Approved</span>";} else { echo "<span style='color:red;'>Pending</span>";} ?></td>
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
             <?php if(in_array("27", $Options) || in_array("28", $Options)) {?>
            <td>
                 <?php if(in_array("27", $Options)) {?>   
              <a href="add-survey.php?id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="lnr lnr-pencil mr-2"></i></a>
              <?php } if(in_array("28", $Options)) {?>
              &nbsp;&nbsp;<a onClick="return confirm('Are you sure you want delete this Question?');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="lnr lnr-trash text-danger"></i></a><?php } ?>
            </td><?php } ?>
         
              
            </tr>
           <?php $i++;} ?>
        </tbody>
    </table>

<?php 
            $i = 1;
            $sql = "SELECT tlc.* FROM tbl_survey_questions tlc 
                    
                    ORDER BY CreatedDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
             
             ?>
      <div class="modal fade insert_frm" id="modals-default<?php echo $row['id']; ?>">
<div class="modal-dialog">
<form class="modal-content" id="validation-form" method="post" novalidate="novalidate" autocomplete="off">
<div class="modal-header">
<h5 class="modal-title">View 
<span class="font-weight-light">Question</span>
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
</div>
<div class="modal-body">
<?php 
if($row['Type'] == 'Text'){?>
<p>Q.&nbsp;<?php echo (int)$row['QueNo']; ?><?php echo $row['Question']; ?></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $row['OptNo1']; ?>)</strong> <?php echo $row['Option1']; ?></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $row['OptNo2']; ?>)</strong> <?php echo $row['Option2']; ?></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $row['OptNo3']; ?>)</strong> <?php echo $row['Option3']; ?></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $row['OptNo4']; ?>)</strong> <?php echo $row['Option4']; ?></p>
<!-- <hr>
<p>Ans :- 
          <?php if($row['Answer'] == 1){
            $opt = $row['Option1'];
            $optno = $row['OptNo1'];
            }
            if($row['Answer'] == 2){
            $opt = $row['Option2'];
            $optno = $row['OptNo2'];
            }
            if($row['Answer'] == 3){
            $opt = $row['Option3'];
            $optno = $row['OptNo3'];
            }
            if($row['Answer'] == 4){
            $opt = $row['Option4'];
            $optno = $row['OptNo4'];
            }
          ?>
      <strong>(<?php echo $optno; ?>) - <?php echo $opt;?></strong></p> -->
<?php }
else{?>
    <p><img src="../uploads/<?php echo $row['Photo']; ?>" style="width: 500px;height: 250px;"></p>
<!-- <hr>
<p>Ans :- <strong>(<?php echo $row['Answer']; ?>) </strong></p> -->

<?php }
?>
  
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
<?php $i++;} ?>
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
<?php include 'incommonscript.php';?>

<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>


<script type="text/javascript">
 
	$(document).ready(function() {
    $('#example').DataTable({
      
    });

     $(document).on("change", "#DeptId", function(event){
  var val = this.value;
   var action = "getTestSeries";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,DeptId:val},
    success:function(data)
    {
        //alert(data);
      $('#TestSeriesId').html(data);
    }
    });

 });

       $(document).on("change", "#BatchId", function(event){
  var val = this.value;
  var DeptId = $('#DeptId').val();
   var action = "getTestSeries";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,id:val,DeptId:DeptId},
    success:function(data)
    {
        //alert(data);
      $('#TestSeriesId').html(data);
    }
    });

 });
});
</script>
</body>
</html>
