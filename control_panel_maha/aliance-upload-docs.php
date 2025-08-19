<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Customer-Feedback-Report";
$Page = "Customer-Feedback-Report";
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



<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_control_room WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="control-room-report.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Aliance Upload Documents
    
</h4>

<div class="card" style="padding: 10px;">

     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

  <div class="form-group col-md-4">
<label class="form-label"> Franchise<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="FrId" id="FrId" required>
<option selected="" value="all">All</option>
 <?php 
     $sql1 = "SELECT id,ShopName FROM tbl_users_bill WHERE Roll=5";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
          
      ?>
    <option <?php if($_POST['FrId'] == $result['id']){?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['ShopName']; ?></option>
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
<div class="form-group col-md-1" style="padding-top: 30px;">
    <label class="form-label">&nbsp;</label>
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_POST['Search'])) {?>
<div class="form-group col-md-1" style="padding-top: 30px;">
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
               <th>Sr No</th>
               <th>Franchise Name</th>
              
                <th>Month</th> 
                <th>Year</th> 
                <th>Invoice 1</th> 
                 <th>Invoice 2</th> 
                  <th>Invoice 3</th> 
                <th>Date</th> 
           
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT tc.*,tu.ShopName FROM tbl_save_aliance_mail_files tc 
                    LEFT JOIN tbl_users_bill tu ON tu.id=tc.frid 
                     WHERE 1";
           if($_POST['FrId']){
                $FrId = $_POST['FrId'];
                if($FrId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tc.frid='$FrId'";
                }
            }
           if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND tc.createddate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND tc.createddate<='$ToDate'";
            }
            $sql.= " ORDER BY tc.id DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                
             ?>
            <tr>
               <td><?php echo $i; ?> </td>
               <td><?php echo $row['ShopName']; ?></td> 

               <td><?php echo $row['month']; ?></td> 
            
               <td><?php echo $row['year']; ?></td> 
               
               <td><?php if($row["files"] == '') {?>
                  <span style="color:red;">No Invoice Found</span>
                 <?php } else if(file_exists('../aliance_files/'.$row["files"])){?>
                 <a href="../aliance_files/<?php echo $row["files"];?>" target="_blank">View Invoice</a>
                  <?php }  else{?>
                <span style="color:red;">No Invoice Found</span>
             <?php } ?></td>
             
             <td><?php if($row["files2"] == '') {?>
                  <span style="color:red;">No Invoice Found</span>
                 <?php } else if(file_exists('../aliance_files/'.$row["files2"])){?>
                 <a href="../aliance_files/<?php echo $row["files2"];?>" target="_blank">View Invoice</a>
                  <?php }  else{?>
                <span style="color:red;">No Invoice Found</span>
             <?php } ?></td>
             
             <td><?php if($row["files3"] == '') {?>
                  <span style="color:red;">No Invoice Found</span>
                 <?php } else if(file_exists('../aliance_files/'.$row["files3"])){?>
                 <a href="../aliance_files/<?php echo $row["files3"];?>" target="_blank">View Invoice</a>
                  <?php }  else{?>
                <span style="color:red;">No Invoice Found</span>
             <?php } ?></td>
               
               <td><?php echo date("d/m/Y h:i a", strtotime(str_replace('-', '/',$row['createddate']))); ?></td>
             
              
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
</script>
</body>
</html>
