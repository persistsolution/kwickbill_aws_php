<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Advance-Salary";
$Page = "Advance-Salary";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Vendor Account
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
                 

if(isset($_POST['submit'])){
    $UserId = $_POST['UserId'];
    $AdvanceDate = $_POST['AdvanceDate'];
    $TotalDays = $_POST['TotalDays'];
    $PresentDay = $_POST['PresentDay'];
    $AbsentDay = $_POST['AbsentDay'];
    $AdvanceSalary = $_POST['AdvanceSalary'];
    $TotalSalary = $_POST['TotalSalary'];
    $Narration = addslashes(trim($_POST['Narration']));
    $CreatedDate = date('Y-m-d H:i:s');
   
      
    $sql2 = "INSERT INTO tbl_advance_salary SET UserId='$UserId',AdvanceDate='$AdvanceDate',TotalDays='$TotalDays',PresentDay='$PresentDay',AbsentDay='$AbsentDay',AdvanceSalary='$AdvanceSalary',TotalSalary='$TotalSalary',Narration='$Narration',CreatedDate='$CreatedDate',CreatedBy='$user_id'";
    $conn->query($sql2);
      
    
     echo "<script>alert('Attendance Saved Successfully');window.location.href='view-advance-salary.php';</script>";        
        
}

?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Advance Salary</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="alert_message"></div>
                                <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                       
                                       
  <div class="form-group col-md-8">
<label class="form-label"> Employee<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="UserId" id="UserId" required>
<option selected="" value="">Select Employee</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN (1,5,55,9,22,23,63)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_POST["ExeId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>
 
                                    <div class="form-group col-md-2">
                                            <label class="form-label">Date <span class="text-danger">*</span> </label>
                                            <input type="date" name="AdvanceDate" id="AdvanceDate" class="form-control"
                                                placeholder="" value="<?php echo date('Y-m-d'); ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        </div>
                                        
                                        <div class="form-row">

                                        <div class="form-group col-md-2">
                                            <label class="form-label">Total Days <span class="text-danger">*</span> </label>
                                            <input type="text" name="TotalDays" id="TotalDays" class="form-control"
                                                placeholder="" value="<?php echo $row7["FromTime"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                       
                                       
                                         <div class="form-group col-md-2">
                                            <label class="form-label">Present Day <span class="text-danger">*</span> </label>
                                            <input type="text" name="PresentDay" id="PresentDay" class="form-control"
                                                placeholder="" value="<?php echo $row7["FromTime"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                         <div class="form-group col-md-2">
                                            <label class="form-label">Absent Day <span class="text-danger">*</span> </label>
                                            <input type="text" name="AbsentDay" id="AbsentDay" class="form-control"
                                                placeholder="" value="<?php echo $row7["FromTime"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                         <div class="form-group col-md-2">
                                            <label class="form-label">Total Earn Salary <span class="text-danger">*</span> </label>
                                            <input type="text" name="TotalSalary" id="TotalSalary" class="form-control"
                                                placeholder="" value="<?php echo $row7["FromTime"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class="form-label">Advance Salary <span class="text-danger">*</span> </label>
                                            <input type="text" name="AdvanceSalary" id="AdvanceSalary" class="form-control"
                                                placeholder="" value="<?php echo $row7["FromTime"]; ?>"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-10">
                                            <label class="form-label">Narration <span class="text-danger">*</span> </label>
                                            <input type="text" name="Narration" id="Narration" class="form-control"
                                                placeholder="" value="<?php echo $row7["FromTime"]; ?>"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        


                                    </div>
                                    <!-- <button id="growl-default" class="btn btn-default">Default</button> --><br>
                                    <button type="submit" class="btn btn-primary btn-finish" name="submit">Save</button>
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

    <script type="text/javascript">
  
    $(document).ready(function() {
       

        $(document).on("change", "#UserId", function(event) {
            var val = this.value;
            var action = "getUserAttendanceRec";
            $.ajax({
                url: "ajax_files/ajax_attendance.php",
                method: "POST",
                data: {
                    action: action,
                    id: val
                },
                success: function(data) {
                   var res = JSON.parse(data);
                   $('#TotalDays').val(res.TotalDays);
                   $('#PresentDay').val(res.PresentDay);
                   $('#AbsentDay').val(res.AbsentDay);
                   $('#TotalSalary').val(res.TotalSalary);
                   $('#AdvanceSalary').val(res.AdvanceSalary);
                }
            });

        });
    });
    </script>
     
</body>

</html>