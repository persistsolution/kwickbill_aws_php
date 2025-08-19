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
    <title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Raw Stock
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />

    <?php include_once 'header_script.php'; ?>
    <script src="ckeditor/ckeditor.js"></script>
</head>

<body>
    <style type="text/css">
    .password-tog-info {
        display: inline-block;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        position: absolute;
        right: 50px;
        top: 30px;
        text-transform: uppercase;
        z-index: 2;
    }
    </style>
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

            <?php //include_once 'sidebar.php'; ?>


            <div class="layout-container">

                <?php //include_once 'top_header.php'; ?>

                <?php 
$id = $_GET['id'];
$CompId = $_GET['qid'];
$sql7 = "SELECT * FROM tbl_help_support_details WHERE id='$id'";
$row7 = getRecord($sql7);

$sql77 = "SELECT * FROM tbl_helps_enquiry WHERE id='$CompId'";
$row77 = getRecord($sql77);
$CustName = $row77['Name'];
$CellNo = $row77['Phone'];
$EmailId = $row77['EmailId'];
$TokenNo = $row77['TokenNo'];

if(isset($_POST['submit'])){
    $CustId = addslashes(trim($_POST["CustId"]));
     //$CellNo = addslashes(trim($_POST["CellNo"]));
    //$CustName = addslashes(trim($_POST["CustName"]));
$Status = 1;
//$Address = addslashes(trim($_POST["Address"]));
$DocumentsStatus = addslashes(trim($_POST['DocumentsStatus']));
$ClainReason = addslashes(trim($_POST["ClainReason"]));
$ClainStatus = addslashes(trim($_POST["ClainStatus"]));
$Message = addslashes(trim($_POST["Message"]));
$NextDate = addslashes(trim($_POST["NextDate"]));
$NextTime = addslashes(trim($_POST["NextTime"]));
$CreatedDate = date('Y-m-d');
$ModifiedDate = date('Y-m-d');
$CreatedTime = date('h:i a');

if($_GET['id']==''){
     $qx = "INSERT INTO tbl_help_support_details SET TokenId='$CompId',TokenNo='$TokenNo',UserId='$CustId',Message='$Message',Status='$ClainStatus',SenderName='Customer',CreatedDate='$CreatedDate',CreatedBy='$user_id',NextDate='$NextDate',NextTime='$NextTime'";
  $conn->query($qx);
 $PostId = mysqli_insert_id($conn);
  $sql = "UPDATE tbl_helps_enquiry SET Status='$ClainStatus',NextDate='$NextDate',NextTime='$NextTime' WHERE id='$CompId'";
  $conn->query($sql);
  


  echo "<script>alert('Record Saved Successfully!');
  window.close();
  window.opener.location.reload(true);</script>";
}
else{
 
    $query2 = "UPDATE tbl_help_support_details SET TokenId='$CompId',TokenNo='$TokenNo',UserId='$CustId',Message='$Message',Status='$ClainStatus',SenderName='Customer',ModifiedDate='$ModifiedDate',ModifiedBy='$user_id',NextDate='$NextDate',NextTime='$NextTime' WHERE id = '$id'";
  $conn->query($query2);

   $sql = "UPDATE tbl_helps_enquiry SET Status='$ClainStatus',NextDate='$NextDate',NextTime='$NextTime' WHERE id='$CompId'";
  $conn->query($sql);
 
  echo "<script>alert('Record Updated Successfully!');window.close();window.opener.location.reload(true);</script>";

}
    //header('Location:courses.php'); 

  }
?>

<style>
    .card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 5px;
}
</style>
                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Take
                            <?php } ?> Action On Complaint</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                    
  <div class="form-group col-md-12">
   <label class="form-label">Customer Name </label>
     <input type="text" name="CustName" id="CustName" class="form-control"
                                                placeholder="" value="<?php echo $row77["Name"]; ?>"
                                                autocomplete="off" disabled>
    <div class="clearfix"></div>
 </div> 

<div class="form-group col-md-6">
                                            <label class="form-label">Contact No </label>
                                            <input type="text" name="CellNo" id="CellNo" class="form-control"
                                                placeholder="" value="<?php echo $row77["Phone"]; ?>"
                                                autocomplete="off" oninput="getUserDetails()" disabled>
                                            <div class="clearfix"></div>
                                        </div>


 
                                      
  <div class="form-group col-md-6">
   <label class="form-label">Email Id </label>
     <input type="text" name="EmailId" id="EmailId" class="form-control"
                                                placeholder="" value="<?php echo $row77["EmailId"]; ?>"
                                                autocomplete="off" disabled>
    <div class="clearfix"></div>
 </div>




<!--<div class="form-group col-lg-4">
<label class="form-label">Call After Date</label>
<input type="date" name="NextDate" class="form-control" id="NextDate" placeholder="" value="">
<div class="clearfix"></div>
</div>

<div class="form-group col-lg-4">
<label class="form-label">Time</label>
<input type="text" name="NextTime" class="form-control" id="NextTime" placeholder="" value="">
<div class="clearfix"></div>
</div>
-->

<div class="form-group col-md-12">
   <label class="form-label">Message</label>
     <textarea  type="text" name="Message" id="Message" class="form-control"><?php echo $row7['Message']; ?></textarea>
    <div class="clearfix"></div>
 </div>   

<div class="form-group col-lg-4">
<label class="form-label"> Status<span class="text-danger">*</span></label>
 <select class="form-control" name="ClainStatus" id="ClainStatus" required>
<option selected="" value="">Select</option>
 
  <option <?php if($row7['Status'] == 1){?> selected <?php } ?> value="1">
    Pending</option>
    <option <?php if($row7['Status'] == 2){?> selected <?php } ?> value="2">
    In Process</option>
    <option <?php if($row7['Status'] == 3){?> selected <?php } ?> value="3">
    Reject</option>
    <option <?php if($row7['Status'] == 4){?> selected <?php } ?> value="4">
    Completed</option>

</select>
<div class="clearfix"></div>
</div>
 

</div>
<br>

                                   <div class="form-row">
                                    <div class="form-group col-md-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Submit</button>
                                    </div>

                
                                    </div>
                               </div>


 <div class="col-lg-5" id="emidetails" style="display:none;">
    

 </div>

  
                                

 </div>
 </form>





                            </div>
                        </div>



 <div class="card mb-4" id="Conversation">
                                    <div class="card-body">
                                        <div class="row help-desk">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <nav class="navbar justify-content-between p-0 align-items-center shadow-none">
                                            <h5 class="my-2">Actions</h5>
                                            
                                        </nav>
                                    </div>
                                </div>
                                

     <div class="container-fluid flex-grow-1 container-p-y">
                      
                        
                        <div class="row help-desk">
                            <div class="col-xl-12 col-lg-12">
                                
                            

                          
                                
                                
                                <?php 
$i=2;
$id = $_GET['qid'];
  $sql2 = "SELECT tp.*,tu.Fname,tu.Lname FROM tbl_help_support_details tp 
          LEFT JOIN tbl_users tu ON tp.CreatedBy=tu.id WHERE tp.TokenId='$id'
          ORDER BY tp.id DESC"; 

    $res2 = $conn->query($sql2);
    while($row = $res2->fetch_assoc()){ ?>

                                <div class="ticket-block">
                                    <div class="row">
                                     
                                        <div class="col">
                                            <div class="card example-popover" data-toggle="modal" data-target="#modals-slide" data-toggle="popover" data-placement="right" data-html="true"
                                                title="<img src='assets/img/user/avatar-1.jpg' class='wid-20 rounded mr-1 img-fluid'><p class='d-inline-block mb-0 ml-2'>You replied</p>" data-content="hello Yogen dra,you need to create "
                                                toolbar-options="div only once in a page in your code, this div fill found every 'td' ...">
                                                <div class="row no-gutters row-bordered row-border-light h-100">
                                                    <div class="d-flex col">
                                                        <div class="card-body">
                                                            <h5 class="mb-0"><?php echo $row['Fname']." ".$row['Lname'];?></h5>
                                                           <!-- <p class="my-1 text-muted"><i class="feather icon-lock mr-1 f-14"></i>Telecaller</p>-->
                                                            <ul class="list-inline mt-2 mb-0 hid-sm">
                                                                
                                                                <li class="list-inline-item my-1"><i class="feather icon-calendar mr-1 f-14"></i>Action at <?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?> <?php echo $row['CreatedTime']; ?></li>
                                                                
                                                            </ul>
                                                            <div class="card bg-light my-3 p-3 hid-md">
                                                                <h6><img src="assets/img/user/avatar-5.jpg" alt="" class="wid-20 avatar mr-2 rounded"> Action Taken on complaint : </h6>
                                                                <p class="mb-0"><?php echo $row['Message']; ?></p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <?php $i++;} ?>
                                
                                
                            </div>


                            
                            
                        </div>
                    </div>
                    
                                
                                
                                </div>
                                        </div>
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
 
    function getUserDetails(){
        var CellNo = $('#CellNo').val();
        var action = "getUserDetails2";
            $.ajax({
                url: "ajax_files/ajax_vendor.php",
                method: "POST",
                data: {
                    action: action,
                    CellNo: CellNo
                },
                dataType:"json",  
                success: function(data) {
                    $('#Address').val(data.Address);
                    $('#CustName').val(data.Fname+" "+data.Lname);
                    $('#Gname').val(data.Gname);
                    $('#Gphone').val(data.Gphone);
                    $('#Gname2').val(data.Gname2);
                    $('#Gphone2').val(data.Gphone2);
                    $('#AgentName').val(data.AgentName);
                    
                }
            });

    }
     $(document).ready(function() {


     $(document).on("change", "#CustId", function(event) {
            var val = this.value;
            var action = "getUserDetails";
            $.ajax({
                url: "ajax_files/ajax_vendor.php",
                method: "POST",
                data: {
                    action: action,
                    id: val
                },
                dataType:"json",  
                success: function(data) {
                    
                    $('#Address').val(data.Taluka+", "+data.Village+", "+data.District);
                    $('#CustName').val(data.Fname);
                    $('#CellNo').val(data.Phone);
                     $('#Gname').val(data.Gname);
                    $('#Gphone').val(data.Gphone);
                    $('#Gname2').val(data.Gname2);
                    $('#Gphone2').val(data.Gphone2);
                    $('#AgentName').val(data.AgentName);
                }
            });

        });


    });

     
 </script>
</body>

</html>