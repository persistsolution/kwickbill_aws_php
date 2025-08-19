<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "HR-Advance";
$Page = "HR-Pending-Advance-Request";
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
$sql7 = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto FROM tbl_advance_salary te LEFT JOIN tbl_users tu ON tu.id=te.UserId WHERE te.id='$id'";
$row7 = getRecord($sql7);
$EmpId = $row7['UserId'];


if(isset($_POST['submit'])){
    $AccPaidDate = addslashes(trim($_POST["AccPaidDate"]));
    $PayMode = addslashes(trim($_POST["PayMode"]));
    $UtrNo = addslashes(trim($_POST["UtrNo"]));
    $AccComment = addslashes(trim($_POST["AccComment"]));
    $PayAmount = addslashes(trim($_POST["PayAmount"]));
$CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
    $CreatedDate2 = date('Y-m-d H:i:s');
    $AccPaidStatus = 1;
 //$TicketNo= "#".rand(1000,9999);

    $query2 = "UPDATE tbl_advance_salary SET AccPaidDate='$AccPaidDate',AccComment='$AccComment',AccPaidStatus='$AccPaidStatus',AccBy='$user_id',PayAmount='$PayAmount',PayMode='$PayMode',UtrNo='$UtrNo' WHERE id = '$id'";
  $conn->query($query2);
  
  $sql = "INSERT INTO tbl_advance_payment_details SET UserId='$EmpId',ReqId='$id',PayDate='$AccPaidDate',PayMode='$PayMode',Amount='$PayAmount',UtrNo='$UtrNo',CreatedDate='$CreatedDate2'";
  $conn->query($sql);

  echo "<script>alert('Amount Paid Successfully!');window.location.href='account-pay-advance-payment.php';</script>";


    //header('Location:courses.php'); 

  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Pay Advance Amount</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                     

 <div class="form-group col-md-6">
                                            <label class="form-label">Employee Name</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7['Fname']." ".$row7['Lname']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                       
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Request Date</label>
                                            <input type="date" name="ReqDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["AdvanceDate"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="form-label">Total Days <span class="text-danger">*</span> </label>
                                            <input type="text" name="TotalDays" id="TotalDays" class="form-control"
                                                placeholder="" value="<?php echo $row7["TotalDays"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                       
                                       
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Present Day <span class="text-danger">*</span> </label>
                                            <input type="text" name="PresentDay" id="PresentDay" class="form-control"
                                                placeholder="" value="<?php echo $row7["PresentDay"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                         <div class="form-group col-md-3">
                                            <label class="form-label">Absent Day <span class="text-danger">*</span> </label>
                                            <input type="text" name="AbsentDay" id="AbsentDay" class="form-control"
                                                placeholder="" value="<?php echo $row7["AbsentDay"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                         <div class="form-group col-md-3">
                                            <label class="form-label">Total Earn Salary <span class="text-danger">*</span> </label>
                                            <input type="text" name="TotalSalary" id="TotalSalary" class="form-control"
                                                placeholder="" value="<?php echo $row7["TotalSalary"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="form-label">Advance Salary <span class="text-danger">*</span> </label>
                                            <input type="text" name="AdvanceSalary" id="AdvanceSalary" class="form-control"
                                                placeholder="" value="<?php echo $row7["AdvanceSalary"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                         <div class="form-group col-md-12">
                                            <label class="form-label">Advance Salary Reason</label>
                                            <input type="text" name="Narration" class="form-control"
                                                placeholder="" value="<?php echo $row7["Narration"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Pay Amount</label>
                                            <input type="text" name="PayAmount" class="form-control"
                                                placeholder="" value="<?php echo $row7["AdvanceSalary"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                         <div class="form-group col-md-3">
                                            <label class="form-label">Paid Date</label>
                                            <input type="date" name="AccPaidDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["AccPaidDate"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Pay By <span class="text-danger">*</span></label>
                                            <select class="form-control" id="PayMode" name="PayMode" required="">
                                                <option selected="" disabled="" value="">Select Status</option>
                                                <option value="Cash" <?php if($row7["PayMode"]=='Cash') {?> selected
                                                    <?php } ?>>Cash</option>
                                                <option value="UPI" <?php if($row7["PayMode"]=='UPI') {?> selected
                                                    <?php } ?>>UPI</option>
                                                  
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">UTR No</label>
                                            <input type="text" name="UtrNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["UtrNo"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>


 <div class="form-group col-md-12">
                                            <label class="form-label">Narration</label>
                                            <textarea name="AccComment" class="form-control"
                                                placeholder=""><?php echo $row7["AccComment"]; ?></textarea>
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




  
                                

 </div>
 </form>





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

 
</body>

</html>