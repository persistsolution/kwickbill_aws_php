<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Resign-Requests";
$Page = "Resign-Requests";
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
$sql7 = "SELECT te.*,tu.Fname,tu.Lname,tu.Phone FROM tbl_resign_requests te LEFT JOIN tbl_users tu ON tu.id=te.UserId WHERE te.id='$id'";
$row7 = getRecord($sql7);
$EmpId = $row7['UserId'];




if(isset($_POST['submit'])){
    $ResignDate = addslashes(trim($_POST["ResignDate"]));
     $Comment = addslashes(trim($_POST["Comment"]));
  $Status = addslashes(trim($_POST["ResignStatus"]));
  $UserId = addslashes(trim($_POST["UserId"]));
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
 //$TicketNo= "#".rand(1000,9999);
    $query2 = "UPDATE tbl_resign_requests SET ResignStatus='$Status',ResignDate='$ResignDate' WHERE id = '$id'";
  $conn->query($query2);
  
  $sql = "UPDATE tbl_users SET ResignStatus='$ResignStatus',ResignDate='$ResignDate',ResignComment='$ResignComment' WHERE id='$UserId'";
  $conn->query($sql);
  
  echo "<script>alert('Status Updated Successfully!');window.location.href='resign-requests.php';</script>";


    //header('Location:courses.php'); 

  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Update Resign Status</h4>

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
                                            <label class="form-label">Employee Name</label>
                                            <input type="text"  class="form-control"
                                                placeholder="" value="<?php echo $row7['Fname']." ".$row7['Lname']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                       
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Contact No</label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $row7['Phone']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Request Date</label>
                                            <input type="date"  class="form-control"
                                                placeholder="" value="<?php echo $row7["ReqDate"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
 <div class="form-group col-md-3">
                                            <label class="form-label">Resign </label>
                                            <select class="form-control" id="ResignStatus" name="ResignStatus" required="">
                                               <!-- <option selected="" disabled="" value="">Select Status</option>-->
                                                <option value="0" <?php if($row7["ResignStatus"]=='0') {?> selected
                                                    <?php } ?>>No</option>
                                                <option value="1" <?php if($row7["ResignStatus"]=='1') {?> selected
                                                    <?php } ?>>Yes</option>
                                               
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                          <div class="form-group col-md-3">
                                            <label class="form-label">Resign Date</label>
                                            <input type="date" name="ResignDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["ResignDate"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Resign Comment</label>
                                            <textarea class="form-control"
                                                placeholder="" readonly><?php echo $row7["ResignComment"]; ?></textarea>
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