<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Lead-Approval";
$Page = "Lead-Approval";
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

if($_REQUEST['action'] == 'changestatus'){
    $id = $_REQUEST["id"];
    $val = $_REQUEST["val"];
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
    $sql3 = "SELECT * FROM tbl_bp_leads WHERE id = '$id'";
    $row3 = getRecord($sql3);
    $UserId = $row3['UserId'];

    $sql4 = "SELECT * FROM tbl_cashback_amount WHERE id=4";
    $row4 = getRecord($sql4);
    $Amount = $row4['Amount'];
    if($val == 0){
        $sql = "UPDATE tbl_bp_leads SET Status=1 WHERE id='$id'";
        $conn->query($sql);
        $sql2 = "INSERT INTO wallet SET LeadId='$id',UserId='$UserId',Amount='$Amount',Narration='Lead Approved',Status='Cr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime'";
        $conn->query($sql2);
    }
    else{
        $sql = "UPDATE tbl_bp_leads SET Status=0 WHERE id='$id'";
        $conn->query($sql);
        $sql2 = "DELETE FROM wallet WHERE LeadId='$id'";
        $conn->query($sql2);
    }
 ?>
    <script type="text/javascript">
      alert("Record Saved Successfully");
      window.location.href="lead-aprroval.php";
    </script>
<?php   
}
?>
<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Leads
  
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>#</th>
              <!-- <th>Change Status</th>-->
               <th>Status</th>
                <th>Business Partner Name</th>
                
                <th>Franchise Name</th>
                <th>Contact No</th>
               <th>Address</th>
               
               
                
                <th>Lead Date</th>
               
                <!--<th>Action</th>-->
               
            </tr>
        </thead>
        <tbody>
             <?php 
             $i=1;
            $sql = "SELECT te.*,tu.Fname,tu.Lname FROM tbl_bp_leads te LEFT JOIN tbl_users tu ON tu.id=te.UserId ORDER BY te.CreatedDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               
             ?>
            <tr>
              <td><?php echo $i;?></td>
            <!--  <td><a href="change-lead-status.php?id=<?php echo $row['id']; ?>">Change Lead Status</a></td>-->
                <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Interested</span>";} 
                else if($row['Status']=='2'){echo "<span style='color:orange;'>Folloup Stage</span>";} 
                else if($row['Status']=='3'){echo "<span style='color:red;'>Closing Stage</span>";} 
                else if($row['Status']=='4'){echo "<span style='color:red;'>Reject </span>";} 
                else if($row['Status']=='5'){echo "<span style='color:blue;'>Hold</span>";} 
                else if($row['Status']=='6'){echo "<span style='color:blue;'>Wrong Lead</span>";} 
                else { echo "<span style='color:red;'>Pending</span>";} ?></td>
               <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
              
                
                <td><?php echo $row['Name']; ?></td>
               <td><?php echo $row['Phone']; ?></td>
                <td><?php echo $row['Address']; ?></td>
                
             
                     
               
              
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
           <!-- <td><label class="switcher switcher-success">
                                        <input type="checkbox" class="switcher-input" onchange="changeStatus(<?php echo $row['id']; ?>,<?php echo $row['Status']; ?>)" value="<?php echo $row['Status']; ?>" <?php if($row['Status']=='1'){?> checked="" <?php } ?>>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes">
                                                <span class="ion ion-md-checkmark"></span>
                                            </span>
                                            <span class="switcher-no">
                                                <span class="ion ion-md-close"></span>
                                            </span>
                                        </span>
                                        <span class="switcher-label">Approve/Pending</span>
                                    </label></td>-->
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
 function changeStatus(id,val){
     window.location.href='lead-aprroval.php?action=changestatus&id='+id+'&status='+val;
 }
    $(document).ready(function() {
    $('#example').DataTable({
    });
});
</script>
</body>
</html>
