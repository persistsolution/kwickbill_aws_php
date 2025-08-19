<?php
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
?>
<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">

<head>
    <title><?php echo $Proj_Title; ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Codedthemes" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/fonts/linearicons.css">
    <link rel="stylesheet" href="assets/fonts/feather.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap-material.css">
    <link rel="stylesheet" href="assets/css/shreerang-material.css">
    <link rel="stylesheet" href="assets/css/uikit.css">

    <!-- Libs -->
    <link rel="stylesheet" href="assets/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/libs/flot/flot.css">
    <link rel="stylesheet" href="assets/libs/bootstrap-select/bootstrap-select.css">
    <link rel="stylesheet" href="assets/libs/select2/select2.css">

</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] Ebd -->
    <!-- [ Layout wrapper ] Start -->
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">

            <?php //include_once 'lead-sidebar.php'; 
            ?>


            <div class="layout-container">

                <?php //include_once '../top_header.php'; 
                ?>
                <!-- [ Layout content ] Start -->
                <div class="layout-content">
                    <!-- [ content ] Start -->
                    <div class="container flex-grow-1 container-p-y">
                        <h5 class="font-weight-bold py-3 mb-0"><?php if ($_GET['id']) { ?>Edit <?php } else { ?> Take
                        <?php } ?> Action On Task</h5>

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


                                echo "<script>alert('Task Record Saved Successfully!');
  window.close();
  window.opener.location.reload(true);</script>";
                            }

                            //header('Location:courses.php'); 

                        }
                        ?>

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


                    <div class="card mb-4" id="Conversation">
                            <div class="card-body">
                                <div class="row help-desk">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <nav class="navbar justify-content-between p-0 align-items-center shadow-none">
                                                    <h5 class="my-2">Conversation</h5>

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
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- [ content ] End -->
                    <!-- [ Layout footer ] Start -->

                    <!-- [ Layout footer ] End -->
                </div>
                <!-- [ Layout content ] Start -->
            </div>
            <!-- [ Layout container ] End -->
        </div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core scripts -->
    <script src="assets/js/pace.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/libs/popper/popper.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/sidenav.js"></script>
    <script src="assets/js/layout-helpers.js"></script>
    <script src="assets/js/material-ripple.js"></script>

    <!-- Libs -->
    <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/libs/select2/select2.js"></script>
    <script src="assets/libs/bootstrap-select/bootstrap-select.js"></script>
    <!-- Demo -->
    <script src="assets/js/demo.js"></script>
    <script src="assets/js/analytics.js"></script>
    <script src="assets/js/pages/forms_selects.js"></script>
</body>

</html>