<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Today-Calling-Leads";
$Page = "Today-Calling-Leads";
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
<h4 class="font-weight-bold py-3 mb-0">Today Calling Leads
  
</h4>

<div class="card" style="padding: 10px;">
    <form id="validation-form" method="post" enctype="multipart/form-data" action="">
     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                
<div class="form-row">
 <div class="form-group col-lg-4">
<label class="form-label">Lead Status<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="Status" id="Status" required>
<option selected="" value="all">All</option>
 <option value="1" <?php if($_REQUEST["Status"]=='1') {?> selected
                                                    <?php } ?>>Interested</option>
                                                <option value="2" <?php if($_REQUEST["Status"]=='2') {?> selected
                                                    <?php } ?>>Folloup Stage</option>
                                                    <option value="3" <?php if($_REQUEST["Status"]=='3') {?> selected
                                                    <?php } ?>>Closing Stage</option>
                                                    
                                                    <option value="4" <?php if($_REQUEST["Status"]=='4') {?> selected
                                                    <?php } ?>>Reject</option>
                                                    
                                                    <option value="5" <?php if($_REQUEST["Status"]=='5') {?> selected
                                                    <?php } ?>>Hold / wrong lead</option>
                                                    
                                                    <option value="6" <?php if($_REQUEST["Status"]=='6') {?> selected
                                                    <?php } ?>>Wrong Lead</option>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-1" style="padding-top:20px;">
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>


</div>

       

 


                                            </div>
                                        </div>
                                    </div>
   </div>
   </form>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>#</th>
            
                 <th>Status</th>
          
                <th>Franchise Name</th>
                <th>Contact No</th>
               <th>Address</th>
               <th>Lead Date</th>
                 <th>Last Telecaller Name</th>
                <th>Last Calling Date</th>
               <th>Last Talk</th>
               <th>Call After Date</th>
               <th>Time</th>
               
              
               
            </tr>
        </thead>
        <tbody>
             <?php 
             $i=1;
             $currdate = date('Y-m-d');
            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu2.Fname AS Telecaller FROM tbl_bp_leads te 
                    LEFT JOIN tbl_users tu ON tu.id=te.UserId 
                    LEFT JOIN tbl_users tu2 ON tu2.id=te.AllocateTo WHERE te.AllocateStatus=1 AND te.AllocateTo='$user_id' AND (te.AllocateDate='$currdate' OR te.NextDate='$currdate')";
            if($_POST['Status']){
                $Status = $_POST['Status'];
                if($Status == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND te.Status='$Status'";
                }
            }
            $sql.=" ORDER BY te.CreatedDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               
               $sql3 = "SELECT tpf.*,tu.Fname,tu.Lname FROM tbl_lead_details tpf LEFT JOIN tbl_users tu ON tpf.CreatedBy=tu.id WHERE tpf.CompId='".$row['id']."' AND tpf.CreatedDate='".date('Y-m-d')."' ORDER BY tpf.id DESC LIMIT 1";
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
               
                <a href="javascript:void(0)" onclick="getFeedback(<?php echo $row['id']; ?>)" class="btn btn-primary btn-finish" style="padding: 0.5px 1rem">Open</a>
          
            </td>
                 <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Interested</span>";} 
                else if($row['Status']=='2'){echo "<span style='color:orange;'>Folloup Stage</span>";} 
                else if($row['Status']=='3'){echo "<span style='color:red;'>Closing Stage</span>";} 
                else if($row['Status']=='4'){echo "<span style='color:blue;'>Reject  / hold / wrong lead</span>";} 
                else { echo "<span style='color:red;'>Pending</span>";} ?></td>
             
              
                
                <td><?php echo $row['Name']; ?></td>
               <td><?php echo $row['Phone']; ?></td>
                <td><?php echo $row['Address']; ?></td>
                
             
                     
               
              
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
            
              <td><?php echo $row3['Fname']." ".$row3['Lname']; ?></td>
               <td><?php if($row3['CreatedDate'] == '' || $row3['CreatedDate'] == '0000-00-00'){ echo "";} else {echo date("d/m/Y", strtotime(str_replace('-', '/',$row3['CreatedDate'])));} ?></td>
              <td><?php echo $row3['Message']; ?></td>
              <td><?php if($row3['NextDate'] == '' || $row3['NextDate'] == '0000-00-00'){ echo "";} else { echo  date("d/m/Y", strtotime(str_replace('-', '/',$row3['NextDate'])));} ?></td>
              <td><?php echo $row3['NextTime']; ?></td>
         
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
            'take-lead-action-2.php?qid=' + id, 'stickerPrint',
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
