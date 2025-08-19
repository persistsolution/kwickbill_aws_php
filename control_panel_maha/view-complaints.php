<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Complaints";
$Page = "View-Complaints-".$_GET['Status'];
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
  $sql11 = "DELETE FROM tbl_helps_enquiry WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-complaints.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Complaint List
   
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
 <select class="select2-demo form-control" name="AssignTo" id="AssignTo" required>
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option value="<?php echo $result['id'];?>" <?php if($_POST['AssignTo'] == $result['id']){?> selected <?php } ?>>
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
              <th>Complaint Status</th>
               <th>Ticket No</th>
                <th>Name</th> 
                <th>Phone No</th> 
                <th>Email Id</th> 
                <th>Complaints</th>
               
                <th>Complaint Date</th>
                 <th>Employee Name</th>
                <th>Last Action Date</th>
               <th>Last Action</th>
              
                 <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
              <!-- <th>Delete</th>-->
               <?php } ?>
                
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            if($Roll == 1){
             $sql = "SELECT ts.*,tu.Fname AS CoName FROM tbl_helps_enquiry ts 
                    LEFT JOIN tbl_users tu ON tu.id=ts.AssignTo WHERE ts.TokenNo!=''";
             if($_REQUEST['Status']!=""){
                 $sql.=" AND ts.Status='".$_REQUEST['Status']."'";
             }           
            }
            else{
              $sql = "SELECT ts.*,tu.Fname AS CoName FROM tbl_helps_enquiry ts 
                    LEFT JOIN tbl_users tu ON tu.id=ts.AssignTo WHERE ts.TokenNo!='' AND ts.AssignTo='$user_id'";  
            }
            
             if($_POST['AssignTo']){
                $AssignTo = $_POST['AssignTo'];
                if($AssignTo == 'all'){
                   $sql.= " "; 
                }
                else{
                $sql.= " AND ts.AssignTo='$AssignTo'";
                }
            }
           if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND ts.CreatedDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND ts.CreatedDate<='$ToDate'";
            }
            $sql.= " ORDER BY ts.CreatedDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                
                $sql3 = "SELECT tpf.*,tu.Fname,tu.Lname FROM tbl_help_support_details tpf LEFT JOIN tbl_users tu ON tpf.CreatedBy=tu.id WHERE tpf.TokenId='".$row['id']."' AND tpf.CreatedDate='".date('Y-m-d')."' ORDER BY tpf.id DESC LIMIT 1";
                $rncnt3 = getRow($sql3);
                $row3 = getRecord($sql3);
                if($rncnt3 > 0){
                    $bcolor = "background-color: antiquewhite;";
                }
                else{
                    $bcolor = "";
                }
               
             ?>
            <tr style="<?php echo $bcolor;?>">
                
             <td>
                 <?php if($row['Status']=='1' || $row['Status']=='2'){?>
                  <a href="javascript:void(0)" onclick="getFeedback(<?php echo $row['id']; ?>)" class="btn btn-primary btn-finish" style="padding: 0.5px 1rem">Open</a>
                  <?php } else if($row['Status']=='4'){echo "<span style='color:green;'>Completed</span>";} else { echo "<span style='color:red;'>Rejected</span>";} ?>
                  </td>
                  <td><?php if($row['Status']=='1'){echo "<span style='color:red;'>Pending</span>";} else if($row['Status']=='2'){echo "<span style='color:orange;'>In Process</span>";} else if($row['Status']=='4'){echo "<span style='color:green;'>Completed</span>";} else { echo "<span style='color:red;'>Rejected</span>";} ?></td>
              <td><a href="javascript:void(0)" onclick="getFeedback2(<?php echo $row['id']; ?>)"><?php echo $row['TokenNo']; ?></a></td> 
              <td><?php echo $row['Name']; ?></td> 
              <td><?php echo $row['Phone']; ?></td> 
              <td><?php echo $row['EmailId']; ?></td> 
               <td><?php echo $row['Message']; ?></td> 
                
              <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
                <td><?php echo $row3['Fname']; ?></td>
               <td><?php if($row3['CreatedDate'] == '' || $row3['CreatedDate'] == '0000-00-00'){ echo "";} else {echo date("d/m/Y", strtotime(str_replace('-', '/',$row3['CreatedDate'])));} ?></td>
              <td><?php echo $row3['Message']; ?></td>
           
          
       
              
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
