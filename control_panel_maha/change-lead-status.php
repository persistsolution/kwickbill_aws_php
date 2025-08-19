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

             <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


            <div class="layout-container">

                

                <?php 
$id = $_GET['id'];
$sql7 = "SELECT te.*,tu.Fname,tu.Lname FROM tbl_bp_leads te LEFT JOIN tbl_users tu ON tu.id=te.UserId WHERE te.id='$id'";
$row7 = getRecord($sql7);
$EmpId = $row7['UserId'];




if(isset($_POST['submit'])){
    $ApproveDate = addslashes(trim($_POST["ApproveDate"]));
     $Comment = addslashes(trim($_POST["Comment"]));
  $Status = addslashes(trim($_POST["Status"]));
  $UserId = addslashes(trim($_POST["UserId"]));
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
 //$TicketNo= "#".rand(1000,9999);
    $query2 = "UPDATE tbl_bp_leads SET ApproveDate='$ApproveDate',Comment='$MannagerComment',ApproveBy='$user_id',Status='$Status' WHERE id = '$id'";
  $conn->query($query2);
  
  $sql4 = "SELECT * FROM tbl_cashback_amount WHERE id=4";
$row4 = getRecord($sql4);
$Amount = $row4['Amount'];
    
  if($Status == 1){
  $sql = "DELETE FROM wallet WHERE UserId='$UserId' AND LeadId='$id'";
  $conn->query($sql);
  $Narration = "Amount Deducted by paid Advance ";
  $sql2 = "INSERT INTO wallet SET LeadId='$id',UserId='$UserId',Amount='$Amount',Narration='Cashback Amount Added by Lead Approved',Status='Cr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime'";
        $conn->query($sql2);
  }
  else{
      $sql = "DELETE FROM wallet WHERE UserId='$UserId' AND LeadId='$id'";
      $conn->query($sql);
      /*$sql2 = "INSERT INTO wallet SET LeadId='$id',UserId='$UserId',Amount='$Amount',Narration='Cashback Amount deducted by Lead Approved',Status='Dr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime'";
        $conn->query($sql2);*/
  }
  echo "<script>alert('Status Updated Successfully!');window.location.href='lead-aprroval.php';</script>";


    //header('Location:courses.php'); 

  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Update lead Status</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="UserId" value="<?php echo $row7['UserId']; ?>">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                     

 <div class="form-group col-md-12">
                                            <label class="form-label">Business Partner Name</label>
                                            <input type="text"  class="form-control"
                                                placeholder="" value="<?php echo $row7['Fname']." ".$row7['Lname']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Franchise Name</label>
                                            <input type="text"  class="form-control"
                                                placeholder="" value="<?php echo $row7['Name']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-6">
                                            <label class="form-label">Contact No</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $row7['Phone']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-12">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["Address"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                       
                                        
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Lead Date</label>
                                            <input type="date"  class="form-control"
                                                placeholder="" value="<?php echo $row7["CreatedDate"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
 <div class="form-group col-md-4">
                                            <label class="form-label">Confirm Date</label>
                                            <input type="date" name="ApproveDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["ApproveDate"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>

 <div class="form-group col-md-4">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-control" id="Status" name="Status" required="">
                                                <option selected="" disabled="" value="">Select Status</option>
                                                <option value="1" <?php if($row7["Status"]=='1') {?> selected
                                                    <?php } ?>>Interested</option>
                                                <option value="2" <?php if($row7["Status"]=='2') {?> selected
                                                    <?php } ?>>Folloup Stage</option>
                                                    <option value="3" <?php if($row7["Status"]=='3') {?> selected
                                                    <?php } ?>>Closing Stage</option>
                                                    
                                                    <option value="4" <?php if($row7["Status"]=='4') {?> selected
                                                    <?php } ?>>Reject</option>
                                                    
                                                    <option value="5" <?php if($row7["Status"]=='5') {?> selected
                                                    <?php } ?>>Hold / wrong lead</option>
                                                    
                                                    <option value="6" <?php if($row7["Status"]=='6') {?> selected
                                                    <?php } ?>>Wrong Lead</option>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
 <div class="form-group col-md-12">
                                            <label class="form-label">Comment</label>
                                            <textarea name="Comment" class="form-control"
                                                placeholder=""></textarea>
                                            <div class="clearfix"></div>
                                        </div>



                                        
</div>

  


                                   <div class="form-row">
                                    <div class="form-group col-md-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Approve</button>
                                    </div>

                
                                    </div>
                               </div>


 <div class="col-lg-5" id="emidetails" style="display:none;">
    

 </div>

  
                                

 </div>
 </form>





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

 
</body>

</html>