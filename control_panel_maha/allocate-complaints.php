<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Complaints";
$Page = "Allocate-Complaints";
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

if(isset($_POST['submit'])){

   $number = count($_POST['CheckId']);

   $AssignTo = $_POST['AssignTo'];
   $CreatedDate = date('Y-m-d H:i:s');
    if($number > 0)  
      {  
        for($i=0; $i<$number; $i++)  
          {  
            if(trim($_POST["CheckId"][$i] != ''))  
              {
                $CheckId = addslashes(trim($_POST['CheckId'][$i]));
                if($CheckId == 1){
                $CustId = addslashes(trim($_POST['QtnId'][$i]));
                $sql = "UPDATE tbl_helps_enquiry SET AssignStatus='1',AssignTo='$AssignTo',AssignDate='$CreatedDate' WHERE id='$CustId'";
                $conn->query($sql);

                }
              }
            }
        }
        
 

        echo "<script>alert('Complaint Assign To Employee');window.location.href='allocate-complaints.php';</script>";
}
?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Allocate Complaints
    
</h4>

<div class="card" style="padding: 10px;">

     <form id="validation-form" method="post" enctype="multipart/form-data" action="">   
 
 <?php 
            $i=1;
          
                $sql = "SELECT * FROM tbl_helps_enquiry WHERE TokenNo!=''"; 
                $rncnt = getRow($sql);?>
        <input type="hidden" name="rncnt" value="<?php echo $rncnt;?>">

<div id="accordion2">
<div class="card mb-2">
                                        
  <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                
<div class="form-row">
 <div class="form-group col-lg-4">
<label class="form-label"> Employee<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="AssignTo" id="AssignTo" required>
<option selected="" value="">Select</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>
</div>
</div>
 </div>
</div>
   </div>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>#</th>
               <th>Ticket No</th>
                <th>Name</th> 
                <th>Phone No</th> 
                <th>Email Id</th> 
                <th>Complaints</th>
                <th>Complaint Status</th>
                <th>Complaint Date</th>
                <th>Assign To</th>
                
                <th>Assign Date</th>
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT ts.*,tu.Fname AS CoName FROM tbl_helps_enquiry ts 
                    LEFT JOIN tbl_users tu ON tu.id=ts.AssignTo WHERE TokenNo!=''";
          
           if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND ts.CreatedDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND ts.CreatedDate<='$ToDate'";
            }
            $sql.= " ORDER BY ts.CreatedDate DESC";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                $sql22 = "SELECT * FROM tbl_helps_enquiry WHERE AssignStatus=1 AND id='".$row['id']."'";
                $rncnt22 = getRow($sql22);
                if($rncnt22 > 0){
                     $bcolor = "background-color: #b9efb9;";
                }
                else{
                    $bcolor = "";
                }
               
             ?>
            <tr style="<?php echo $bcolor;?>">
               <td><?php if($rncnt22 > 0){} else{?>
                    <label class="custom-control custom-checkbox">
                    <input type="checkbox" id="Check_Id<?php echo $row['id']; ?>" value="0" class="custom-control-input is-valid" onclick="featured(<?php echo $row['id']; ?>)">
                    <span class="custom-control-label">&nbsp;</span>
                 </label><?php } ?> </td>
                 <input type="hidden" value="0" name="CheckId[]" id="CheckId<?php echo $row['id']; ?>">
                 <input type="hidden" value="<?php echo $row['id']; ?>" name="QtnId[]">
               <td><?php echo $row['TokenNo']; ?></td> 
              <td><?php echo $row['Name']; ?></td> 
              <td><?php echo $row['Phone']; ?></td> 
              <td><?php echo $row['EmailId']; ?></td> 
               <td><?php echo $row['Message']; ?></td> 
                <td><?php if($row['Status']=='1'){echo "<span style='color:red;'>Pending</span>";} else if($row['Status']=='2'){echo "<span style='color:orange;'>In Process</span>";} else if($row['Status']=='4'){echo "<span style='color:gressn;'>Completed</span>";} else { echo "<span style='color:red;'>Rejected</span>";} ?></td>
              <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
                
               <td><?php echo $row['CoName']; ?></td> 
              <td><?php if($row['AssignDate']==''){echo "";} else { echo date("d/m/Y", strtotime(str_replace('-', '/',$row['AssignDate']))); } ?></td>  
          
        
              
            </tr>
           <?php $i++;} ?>
        </tbody>
    </table>
</div>
<div class="form-group col-md-1" style="padding-top:20px;">
<button type="submit" name="submit" class="btn btn-primary btn-finish">Assign</button>
</div>
</form>
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
 function featured(id){
        if($('#Check_Id'+id).prop('checked') == true) {
            $('#CheckId'+id).val(1);
        }
        else{
           $('#CheckId'+id).val(0);
            }
        }

    $(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true
    });
});
</script>
</body>
</html>
