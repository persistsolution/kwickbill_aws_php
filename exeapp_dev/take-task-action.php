<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Expenses";
$Page = "Add-Expenses";

?>
<!doctype html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?php echo $Proj_Title; ?></title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
    <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
    <link href="css/toastr.min.css" rel="stylesheet">
    <script src="js/jquery.min3.5.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>
    <link rel="stylesheet" href="example/css/slim.min.css">
    <?php include_once 'header_script.php'; ?>

</head>

<style>
    .custom-control {
  line-height: 24px;
  padding-top: 5px;
}
.card-body p {
    font-size: 14px;
    margin-bottom: 6px;
}
.bg-light {
    background-color: #f9f9f9 !important;
}

</style>
<style>
            .dataTables_filter, .dataTables_info { display: none; }
        </style>
<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 
        

        <div class="main-container">







<?php
                         $id = $_GET['id'];
                        $CompId = $_GET['qid'];
                        $sql7 = "SELECT * FROM tbl_task_details WHERE id='$id'";
                        $row7 = getRecord($sql7);

                        $sql77 = "SELECT * FROM tbl_task_new WHERE id='$CompId'";
                        $row77 = getRecord($sql77);
                        $CustName = $row77['TaskName'];
                        $TaskDate = $row77['TaskDate'];
                        $Address = $row77['Address'];
                        $CloseEmpId = $row77['CloseEmpId'];
                        $ClainStatus = $row77['ClainStatus'];
                        

                        if (isset($_POST['submit'])) {
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
                            $DoneBy = addslashes(trim($_POST["DoneBy"]));
                            $CreatedDate = date('Y-m-d');
                            $ModifiedDate = date('Y-m-d');
                            $CreatedTime = date('h:i a');

                            if ($_GET['id'] == '') {
                                $qx = "INSERT INTO tbl_task_details SET CompId='$CompId',Message='$Message',ClainStatus='$ClainStatus',CreatedDate='$CreatedDate',CreatedBy='$user_id',NextDate='$NextDate',NextTime='$NextTime',DoneBy='$DoneBy'";
                                $conn->query($qx);
                                $PostId = mysqli_insert_id($conn);
                                $sql = "UPDATE tbl_task_new SET ClainStatus='$ClainStatus' WHERE id='$CompId'";
                                $conn->query($sql);


                               echo "<script>alert('Record Updated Successfully!');window.location.href='view-task.php';</script>";
                            }

                            //header('Location:courses.php'); 

                        }
                        ?>
                        
  

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<?php if($ClainStatus != 'Completed'){?>
<h4 class="font-weight-bold py-3 mb-0">Take Task Action</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                     

   
 <div class="form-group col-md-12">
                                                    <label class="form-label">Task Details </label>
                                                    <textarea name="CustName" id="CustName" class="form-control"
                                                        placeholder=""
                                                        autocomplete="off" disabled><?php echo $CustName; ?></textarea>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label class="form-label">Task Date </label>
                                                    <input type="text" name="CellNo" id="CellNo" class="form-control"
                                                        placeholder="" value="<?php echo $TaskDate; ?>"
                                                        autocomplete="off" oninput="getUserDetails()" disabled>
                                                    <div class="clearfix"></div>
                                                </div>


                                                <div class="form-group col-md-12">
                                                    <label class="form-label">Message</label>
                                                    <textarea type="text" name="Message" id="Message" class="form-control" required><?php echo $row7['Message']; ?></textarea>
                                                    <div class="clearfix"></div>
                                                </div>



                                                 <div class="form-group col-md-12">
                                                    <label class="form-label">Task Status <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="ClainStatus" name="ClainStatus" required="">
                                                        
                                                        <option value="In Progress">In Progress</option>
                                                        
                                                        <option value="Completed">Completed</option>
                                                        
                                                        <option value="Cancelled">Cancelled</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                </div>


</div>

  


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
<?php } else { ?>
<!--<h4 class="font-weight-bold py-3 mb-0">View Task History</h4>-->
<?php } ?>

 
<div class="card">
                                            <div class="card-body">
                                                <nav class="navbar justify-content-between p-0 align-items-center shadow-none">
                                                    <h5 class="my-2">Task History</h5>

                                                </nav>
                                            </div>
                                        </div>
<br>
                                        <div class="container-fluid flex-grow-1 container-p-y">


                                            <div class="row help-desk">
    <div class="col-xl-12 col-lg-12 px-2">

        <?php
        $id = $_GET['qid'];
        $sql2 = "SELECT tp.*, tu.Fname, tu.Lname, tut.Name AS Designation 
                 FROM tbl_task_details tp 
                 LEFT JOIN tbl_users tu ON tp.CreatedBy = tu.id 
                 LEFT JOIN tbl_user_type tut ON tut.id = tu.Roll 
                 WHERE tp.CompId = '$id' 
                 ORDER BY tp.id DESC";

        $res2 = $conn->query($sql2);
        while ($row = $res2->fetch_assoc()) {
            $status = $row['ClainStatus'];
            $badgeClass = "secondary";
            if ($status == "In Progress") $badgeClass = "warning";
            else if ($status == "Completed") $badgeClass = "success";
            else if ($status == "Cancelled") $badgeClass = "danger";
            else if ($status == "Open") $badgeClass = "primary";
        ?>
            <div class="card shadow-sm mb-3 border-0 rounded-lg">
                <div class="card-body">
                    <h6 class="mb-1 fw-bold"><?php echo $row['Fname'] . ' ' . $row['Lname']; ?></h6>
                    <p class="mb-1 text-muted small"><?php echo $row['Designation']; ?></p>
                    <p class="mb-2 text-muted small">
                        <i class="feather icon-calendar mr-1"></i>Conversation at 
                        <?php echo date("d/m/Y", strtotime($row['CreatedDate'])); ?>
                    </p>

                    <div class="bg-light rounded p-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong>Last comment :</strong>
                            <span class="badge bg-<?php echo $badgeClass; ?>" style="color:white;"><?php echo $status ?: 'N/A'; ?></span>
                        </div>
                        <p class="mb-0"><?php echo $row['Message']; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>


                                        </div>



                                   
                       
                        
</div>

<?php include_once 'footer.php'; ?>
</div>
 </main><br><br><br>

    <!-- footer-->
    


    <!-- Required jquery and libraries -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="js/jquery.cookie.js"></script>

    <!-- Swiper slider  js-->
    <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="js/main.js"></script>
    <script src="js/color-scheme-demo.js"></script>


    <!-- page level custom script -->
    <script src="js/app.js"></script>
       <?php include_once 'footer_script.php'; ?>
 <script>

  $(document).ready(function() {
           $(document).on("change", "#CatId", function(event) {
            var val = this.value;
            var action = "getBrands";
            $.ajax({
                url: "ajax_files/ajax_dropdown.php",
                method: "POST",
                data: {
                    action: action,
                    id: val
                },
                success: function(data) {
                    $('#BrandId').html(data);
                  
                }
            });

        });

            
            });

        //CKEDITOR.replace( 'editor1');
</script>
</body>
</html>