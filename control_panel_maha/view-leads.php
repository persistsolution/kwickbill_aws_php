<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Lead";
$Page = "View-Lead";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Vendors Account List</title>
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
  $sql11 = "DELETE FROM tbl_leads WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-leads.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Lead List
    <?php if(in_array("14", $Options)) {?>   
<span style="float: right;">
<a href="add-lead.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Create Lead</a></span><?php } ?>
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>Sr No</th>
              
               <th>Ticket No</th> 
               <!-- <th>Allocate Lead</th> -->
                <th>Source</th> 
                <th>Customer Name</th> 
                <th>Contact No</th>
               
                <th>Address</th>
             
             
                <th>Lead Status</th>
                <th>Lead Date</th>
               
                 <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
               <th>Action</th>
               <?php } ?>
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT tp.*,tb.Name As BranchName,tu.Fname FROM tbl_leads tp 
                    LEFT JOIN tbl_branch tb ON tp.BranchId=tb.id 
                    LEFT JOIN tbl_users tu ON tp.CustId=tu.id ORDER BY tp.CreatedDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               
             ?>
            <tr>
               <td><?php echo $i; ?> </td>
                 <td><a href="view-lead-action.php?id=<?php echo $row['id']; ?>"><?php echo $row['TicketNo']; ?></a></td> 
               
               <!-- <td><select class="form-control" onchange="allocateLeads(this.value,<?php echo $row['id']; ?>)" style="width: 250px;">
                   <option value="" selected>Select Telecaller</option>
                     <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll IN(2)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row["AllocateId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>

                    
                 </select></td> -->
                 
                  <td>By <?php echo $row['ClainReason']; ?> <?php echo $row['Fname']; ?> </td> 
               <td><?php echo $row['CustName']; ?></td> 
              
                <td><?php echo $row['CellNo']; ?></td>
                 <td><?php echo $row['Address']; ?></td>
                
                  <td><?php echo $row['ClainStatus']; ?></td>
            
             
               
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
           <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
            <td>
              <?php if(in_array("10", $Options)){?>
              <a href="add-lead.php?id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="lnr lnr-pencil mr-2"></i></a>
             <?php } if(in_array("11", $Options)){?>
              &nbsp;&nbsp;<a onClick="return confirm('Are you sure you want delete this record');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="lnr lnr-trash text-danger"></i></a>
             <?php } ?>
            </td> <?php } ?>
        
              
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
 function allocateLeads(allocateid,leadid){
     var action = "allocateLeads";
            $.ajax({
                url: "ajax_files/ajax_leads.php",
                method: "POST",
                data: {
                    action: action,
                    allocateid: allocateid,
                    leadid:leadid
                },
                success: function(data) {
                    alert("Lead Allocates to Telecaller.");
                  
                }
            });
 }
    $(document).ready(function() {
    $('#example').DataTable({
    });
});
</script>
</body>
</html>
