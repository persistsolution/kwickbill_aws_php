<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Advance-Salary";
$Page = "Advance-Salary";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Complaints List</title>
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
  $sql11 = "DELETE FROM tbl_advance_salary WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-advance-salary.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Advance Payment List
       <?php if(in_array("14", $Options)) {?>   
<span style="float: right;">
<a href="add-advance-salary.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add New</a></span><?php } ?>
</h4>

<div class="card" style="padding: 10px;">

     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

<?php if($Roll == 1){?>
 <div class="form-group col-lg-4">
<label class="form-label"> Employee<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="UserId" id="UserId" required>
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option value="<?php echo $result['id'];?>" <?php if($_POST['UserId'] == $result['id']){?> selected <?php } ?>>
    <?php echo $result['Fname']; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-3">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<input type="hidden" name="Status" value="<?php echo $_REQUEST['Status'];?>">
<div class="form-group col-md-1">
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
             <th>Action</th>
             
                <th>Name</th> 
                <th>Advance Date</th> 
                <th>Total Days</th> 
                <th>Present Days</th>
               
                <th>Absent Days</th>
                 <th>Advance Salary</th>
                <th>Narration</th>
              
                
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            if($Roll == 1){
             $sql = "SELECT ts.*,tu.Fname AS EmpName FROM tbl_advance_salary ts 
                    LEFT JOIN tbl_users tu ON tu.id=ts.UserId WHERE 1";      
            }
            else{
              $sql = "SELECT ts.*,tu.Fname AS EmpName FROM tbl_advance_salary ts 
                    LEFT JOIN tbl_users tu ON tu.id=ts.UserId WHERE ts.CreatedBy='$user_id'";  
            }
            
             if($_POST['UserId']){
                $UserId = $_POST['UserId'];
                if($UserId == 'all'){
                   $sql.= " "; 
                }
                else{
                $sql.= " AND ts.UserId='$UserId'";
                }
            }
           if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND ts.AdvanceDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND ts.AdvanceDate<='$ToDate'";
            }
            $sql.= " ORDER BY ts.AdvanceDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                
                
               
             ?>
            <tr style="<?php echo $bcolor;?>">
                 <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
            <td>
              <?php if(in_array("10", $Options)){?>
              <!-- <a href="add-quotation.php?id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="lnr lnr-pencil mr-2"></i></a> -->
             <?php } if(in_array("11", $Options)){?>
              &nbsp;&nbsp;<a onClick="return confirm('Are you sure you want delete this record');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="lnr lnr-trash text-danger"></i></a>
             <?php } ?>&nbsp;&nbsp;
             
            </td> <?php } ?>
               <td><?php echo $row['EmpName']; ?></td> 
               <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['AdvanceDate']))); ?></td>
               <td><?php echo $row['TotalDays']; ?></td> 
               <td><?php echo $row['PresentDay']; ?></td> 
               <td><?php echo $row['AbsentDay']; ?></td> 
               <td><?php echo $row['AdvanceSalary']; ?></td>
               
                <td><?php echo $row['Narration']; ?></td>
           
          
       
              
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
  function getFeedback(id){
    setTimeout(function() {
        window.open(
            'take-complaint-action.php?qid=' + id, 'stickerPrint',
            'toolbar=1, scrollbars=1, location=1,statusbar=0, menubar=1, resizable=1, width=800, height=800,left=250,top=50,right=50'
        );
    }, 1);
 }
 
   function getFeedback2(id){
    setTimeout(function() {
        window.open(
            'view-complaint-action.php?qid=' + id, 'stickerPrint',
            'toolbar=1, scrollbars=1, location=1,statusbar=0, menubar=1, resizable=1, width=800, height=800,left=250,top=50,right=50'
        );
    }, 1);
 }
    $(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true
    });
});
</script>
</body>
</html>
