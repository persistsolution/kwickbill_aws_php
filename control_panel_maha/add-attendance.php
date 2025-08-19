<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Day-Attendance";
$Page = "Day-Attendance";
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
    $FromDate = $_POST['FromDate'];
    $FromTime = $_POST['FromTime'];
    $ToDate = $_POST['FromDate'];
    $ToTime = $_POST['ToTime'];
   // $Type = $_POST['Type'];
    $Status = 1;
    $sql = "SELECT Lattitude,Longitude,PerDaySalary,SalaryType,CreditSalaryStatus FROM tbl_users WHERE id='$UserId'";
$row = getRecord($sql);
$Latitude = $row['Lattitude'];
$Longitude = $row['Longitude'];
$PerDaySalary = $row['PerDaySalary'];
$SalaryType = $row['SalaryType'];
$CreditSalaryStatus = $row['CreditSalaryStatus'];
if($FromDate!=''){
    $Type = 1;
}
if($ToDate!=''){
   $Type = 2; 
}

        
      
    $sql = "SELECT * FROM tbl_attendance WHERE UserId='$UserId' AND CreatedDate='$FromDate' AND Type='1'";
    $rncnt = getRow($sql);
    if($rncnt > 0){
        $sql2 = "UPDATE tbl_attendance SET Salary='$PerDaySalary',Status='$Status',CreatedTime='$FromTime',Type=1 WHERE UserId='$UserId' AND CreatedDate='$FromDate' AND Type=1";
        $conn->query($sql2);
         
       
    }
    else{
       $sql2 = "INSERT INTO tbl_attendance SET Salary='$PerDaySalary',Status='$Status',UserId='$UserId',CreatedDate='$FromDate',Latitude='$Latitude',Longitude='$Longitude',Address='',CreatedTime='$FromTime',Latemark='0',HalfDay='0',Type=1,Photo='',TempPrdId=''";
        $conn->query($sql2);
     
    }
        
        
       
            $sql = "SELECT * FROM tbl_attendance WHERE UserId='$UserId' AND CreatedDate='$ToDate' AND Type='2'";
    $rncnt = getRow($sql);
    if($rncnt > 0){
        $sql2 = "UPDATE tbl_attendance SET Salary='$PerDaySalary',Status='$Status',CreatedTime='$ToTime',Type=2 WHERE UserId='$UserId' AND CreatedDate='$ToDate' AND Type=2";
        $conn->query($sql2);
         
       
    }
    else{
       $sql2 = "INSERT INTO tbl_attendance SET Salary='$PerDaySalary',Status='$Status',UserId='$UserId',CreatedDate='$ToDate',Latitude='$Latitude',Longitude='$Longitude',Address='',CreatedTime='$ToTime',Latemark='0',HalfDay='0',Type=2,Photo='',TempPrdId=''";
        $conn->query($sql2);
      
    }
     echo "<script>alert('Attendance Saved Successfully');window.location.href='add-attendance.php';</script>";        
        
}

?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Day Attendance</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="alert_message"></div>
                                <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                       
                                       
  <div class="form-group col-md-6">
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
                                            <input type="date" name="FromDate" id="FromDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["CreatedDate"]; ?>"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">In Time <span class="text-danger">*</span> </label>
                                            <input type="time" name="FromTime" id="FromTime" class="form-control"
                                                placeholder="" value="<?php echo $row7["FromTime"]; ?>"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>
                                       
                                        <!--<div class="form-group col-md-2">
                                            <label class="form-label">To Date <span class="text-danger">*</span> </label>
                                            <input type="date" name="ToDate" id="ToDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["CreatedDate"]; ?>"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>-->
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">Out Time <span class="text-danger">*</span> </label>
                                            <input type="time" name="ToTime" id="ToTime" class="form-control"
                                                placeholder="" value="<?php echo $row7["FromTime"]; ?>"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        


                                    </div>
                                    <!-- <button id="growl-default" class="btn btn-default">Default</button> -->
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
    function checkAttendance(val){
        var action = "checkAttendance";
        var UserId = $('#UserId').val();
        var CreatedDate = $('#CreatedDate').val();
            $.ajax({
                url: "ajax_files/ajax_attendance.php",
                method: "POST",
                data: {
                    action: action,
                    id: val,
                    UserId:UserId,
                    CreatedDate:CreatedDate
                },
                success: function(data) {
                    if(data == 1){
                        $('#AttType').val(2).attr("selected",true);
                        $('#Type').val(2);
                    }
                    else{
                       $('#AttType').val(1).attr("selected",true);
                       $('#Type').val(1);
                    }
                }
            });
    }
    function myFunction2() {

        var x = document.getElementById("Password");
        if (x.type === "password") {
            x.type = "text";
            $('.show2').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
        } else {
            x.type = "password";
            $('.show2').html('<i class="fa fa-eye" aria-hidden="true"></i>');
        }
    }

    function error_toast() {
        var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
        $.growl.error({
            title: 'Error',
            message: 'Email Id / Phone No Already Exists',
            location: isRtl ? 'tl' : 'tr'
        });
    }

    function success_toast() {
        var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
        $.growl.success({
            title: 'Success',
            message: 'Saved Successfully...',
            location: isRtl ? 'tl' : 'tr'
        });
    }
    $(document).ready(function() {
        //$(document).on("click", ".btn-finish", function(event){
        $('#validation-form').on('submit', function(e) {
            exit();
            e.preventDefault();
            if ($('#validation-form').valid()) {

                $.ajax({
                    url: "ajax_files/ajax_vendors.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').text('Please Wait...');
                    },
                    success: function(data) {

                        if (data == 0) {
                            error_toast();

                        } else {
                            success_toast();
                            setTimeout(function() {
                                window.location.href = 'view-vendors.php';
                            }, 2000);
                        }
                        $('#submit').attr('disabled', false);
                        $('#submit').text('Save');
                    }
                })



            } else {
                //$('#Fname').focus();
                return false;
            }
        });

        $(document).on("click", "#delete_photo", function(event) {
            event.preventDefault();
            if (confirm("Are you sure you want to delete Profile Photo?")) {
                var action = "deletePhoto";
                var id = $('#userid').val();
                var Photo = $('#OldPhoto').val();
                $.ajax({
                    url: "ajax_files/ajax_vendors.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id,
                        Photo: Photo
                    },
                    success: function(data) {

                        $('#show_photo').hide();
                        var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr(
                            'dir') === 'rtl';
                        $.growl.success({
                            title: 'Success',
                            message: data,
                            location: isRtl ? 'tl' : 'tr'
                        });

                    }
                });
            }

        });
        $(document).on("change", "#CountryId", function(event) {
            var val = this.value;
            var action = "getState";
            $.ajax({
                url: "ajax_files/ajax_dropdown.php",
                method: "POST",
                data: {
                    action: action,
                    id: val
                },
                success: function(data) {
                    $('#StateId').html(data);
                }
            });

        });

        $(document).on("change", "#StateId", function(event) {
            var val = this.value;
            var action = "getCity";
            $.ajax({
                url: "ajax_files/ajax_dropdown.php",
                method: "POST",
                data: {
                    action: action,
                    id: val
                },
                success: function(data) {
                    $('#CityId').html(data);
                }
            });

        });
    });
    </script>
     <script>
        CKEDITOR.replace( 'editor1');
</script>
</body>

</html>