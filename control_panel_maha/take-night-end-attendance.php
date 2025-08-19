<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Night-End-Attendance";
$Page = "Night-End-Attendance";
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

    
       
   
       $sql2 = "INSERT INTO tbl_attendance SET Salary='$PerDaySalary',Status='$Status',UserId='$UserId',CreatedDate='$ToDate',Latitude='$Latitude',Longitude='$Longitude',Address='',CreatedTime='$ToTime',Latemark='0',HalfDay='0',Type=2,Photo='',TempPrdId=''";
        $conn->query($sql2);

        if($SalaryType == 1){
            if($CreditSalaryStatus == 1){
                $Narration = "Amount Added against today Attendance";
  $sql = "INSERT INTO wallet SET UserId='$userid',Amount='$PerDaySalary',Narration='$Narration',Status='Cr',CreatedDate='$date',CreatedTime='$CreatedTime',Attendance='1'";
  $conn->query($sql);
  
            }
        }
      
    
     echo "<script>alert('Attendance Saved Successfully');window.location.href='night-end-attendance.php';</script>";        
        
}

$sql77 = "SELECT ta.*,tc.Fname FROM tbl_attendance ta LEFT JOIN tbl_users tc ON tc.id=ta.UserId WHERE ta.id='".$_GET['id']."'";
$row77 = getRecord($sql77);
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Take End Attendance</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="alert_message"></div>
                                <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                     <input type="hidden" name="UserId" value="<?php echo $row77["UserId"]; ?>" id="UserId">
                                    <div class="form-row">
                                       

                                        <div class="form-group col-md-6">
                                            <label class="form-label">Employee Name <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control"
                                                placeholder="" value="<?php echo $row77["Fname"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        </div>

                                        <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Date <span class="text-danger">*</span> </label>
                                            <input type="date" name="FromDate" id="FromDate" class="form-control"
                                                placeholder="" value="<?php echo $row77["CreatedDate"]; ?>"
                                                autocomplete="off" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">In Time <span class="text-danger">*</span> </label>
                                            <input type="time" name="FromTime" id="FromTime" class="form-control"
                                                placeholder="" value="<?php echo $row77["CreatedTime"]; ?>"
                                                autocomplete="off" readonly>
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
                                                placeholder="" value=""
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

</body>

</html>