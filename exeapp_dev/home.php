<?php session_start();
$sessionid = session_id();
require_once 'config.php';
//require_once 'auth.php';
$PageName = "Home";


$user_id = $_SESSION['User']['id'];
$uid = $_REQUEST['uid']; 
if($uid == 163){
    echo "<script>window.location.href='../mobapp/login.php';</script>";exit();
}
if($_REQUEST['uid'] == ''){
$sql11 = "SELECT * FROM tbl_users WHERE id='$user_id'";
$row = getRecord($sql11);
$_SESSION['User'] = $row;
}   
else{
$sql11 = "SELECT * FROM tbl_users WHERE id='$uid'";
$row = getRecord($sql11);
$_SESSION['User'] = $row;
}
/*if($row['Roll'] == 55){
  echo "<script>window.location.href='../custapp/home.php';</script>";
    exit();
}
if($row['Roll'] == 5){
  echo "<script>window.location.href='../mobapp/home.php';</script>";
    exit();
}*/

if($row['Status'] == 0){
     echo "<script>window.location.href='../mobapp/login.php';</script>";exit();
}
if($row['Roll'] == 5){
    echo "<script>window.location.href='../mobapp/home.php';</script>";
    exit();
}
else if($row['Roll'] == 55){
    echo "<script>window.location.href='../custapp/home.php';</script>";
    exit();
}
else if($row['Roll'] == 3){
    echo "<script>window.location.href='../vedapp/home.php';</script>";
    exit();
}
else{
    
}

// if($row['KycStatus'] != 1){
//  echo "<script>window.location.href='../mobapp/kyc-form.php';</script>";
//     exit();
// }

$Roll = $row['Roll'];
$names = array('9', '22', '23');
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
    <link rel="manifest" href="manifest.json" />

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
    <link rel="stylesheet" href="dist/css/styles.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
   
</head>

<style>

        /* Popup Overlay */
        #popupOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Popup Container */
        #popupContainer {
            position: relative;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            width: 400px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.6);
            animation: popupIn 0.5s ease-in-out;
        }

        @keyframes popupIn {
            from { transform: scale(0.7); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        /* Popup Image */
        #popupContainer img {
            width: 100%;
            display: block;
        }

        /* Loading Text & Countdown */
        #loadingText {
            font-size: 20px;
            font-weight: bold;
            color: #444;
            margin: 15px 0;
        }

        /* Close Button */
        #closePopup {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff3b3b;
            border: none;
            color: white;
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 6px;
            cursor: not-allowed;
            opacity: 0.6;
        }

        #closePopup.enabled {
            cursor: pointer;
            opacity: 1;
            background: #28a745;
        }
    </style>
    
<div class="container-fluid h-100 loader-display">
        <div class="row h-100">
            <div class="align-self-center col">
                <div class="logo-loading">
                    <div class="icon  ">
                        <img src="logo33.png" alt="">
                    </div><br>
                    <div class="loader-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="shop" style="line-height: 15px;">
 <?php 
 $today = date('Y-m-d');

 
 /*$sql2 = "SELECT * FROM tbl_show_popup_image WHERE showdate='$today' AND userid='$user_id'";
 $rncnt2 = getRow($sql2);
 if($rncnt2 > 0){} else{*/
$sql66 = "SELECT * FROM tbl_popup_image WHERE Status=1 AND id=1";
$rncnt66 = getRow($sql66);
if($rncnt66 > 0){
$row66 = getRecord($sql66);

?>
<div id="popupOverlay">
        <div id="popupContainer">
            <img src="../uploads/<?php echo $row66['Photo'];?>" alt="Popup Image">
            <div id="loadingText">Loading... 5s</div>
            <button id="closePopup" disabled>Close</button>
        </div>
    </div>
<?php }  /*$sql = "INSERT INTO tbl_show_popup_image SET showdate='$today',userid='$user_id'";
 $conn->query($sql); } */


?>
    
    <?php include_once 'sidebar.php'; ?>

    <!-- Begin page content -->
   <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
      <?php include_once 'top_header.php'; ?>

 <?php 
        
        $sql55 = "SELECT * FROM tbl_company_emails WHERE id=1";
        $row55 = getRecord($sql55);
        
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_expense_request WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

<?php 
  if(isset($_POST['submit'])){
$Narration = addslashes(trim($_POST["Narration"]));
$Amount = addslashes(trim($_POST["Amount"]));
$PaymentMode = addslashes(trim($_POST["PaymentMode"]));
$ExpenseDate = addslashes(trim($_POST["ExpenseDate"]));
$Gst = addslashes(trim($_POST["Gst"]));
$VedPhone = addslashes(trim($_POST["VedPhone"]));
$FrId = addslashes(trim($_POST["FrId"]));
$CreatedDate = date('Y-m-d');
$ModifiedDate = date('Y-m-d');

$randno = rand(1,100);
$src = $_FILES['Photo']['tmp_name'];
$fnm = substr($_FILES["Photo"]["name"], 0,strrpos($_FILES["Photo"]["name"],'.')); 
$fnm = str_replace(" ","_",$fnm);
$ext = substr($_FILES["Photo"]["name"],strpos($_FILES["Photo"]["name"],"."));
$dest = '../uploads/'. $randno . "_".$fnm . $ext;
$imagepath =  $randno . "_".$fnm . $ext;
if(move_uploaded_file($src, $dest))
{
$Photo = $imagepath ;
} 
else{
    $Photo = $_POST['OldPhoto'];
}

$randno2 = rand(1,100);
$src2 = $_FILES['Photo2']['tmp_name'];
$fnm2 = substr($_FILES["Photo2"]["name"], 0,strrpos($_FILES["Photo2"]["name"],'.')); 
$fnm2 = str_replace(" ","_",$fnm2);
$ext2 = substr($_FILES["Photo2"]["name"],strpos($_FILES["Photo2"]["name"],"."));
$dest2 = '../uploads/'. $randno2 . "_".$fnm2 . $ext2;
$imagepath2 =  $randno2 . "_".$fnm2 . $ext2;
if(move_uploaded_file($src2, $dest2))
{
$Photo2 = $imagepath2 ;
} 
else{
    $Photo2 = $_POST['OldPhoto2'];
}

if($_GET['id']==''){
     $qx = "INSERT INTO tbl_expense_request SET Photo='$Photo',Photo2='$Photo2',UserId = '$UserId',Status='0',Narration = '$Narration',Amount='$Amount',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',CreatedDate='$CreatedDate',CreatedBy='$user_id',Gst='$Gst',VedPhone='$VedPhone',FrId='$FrId'";
  $conn->query($qx);
  $to = $row55['ExpMail'];
  $allmail = $row55['AllMail'];
  include("incenquirymail.php");
  include("sendmailsmtp.php");?>
  <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Your expenses request successfully submitted.",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-expenses.php";
  }
}); });</script>
<?php 
}
else{
 
    $query2 = "UPDATE tbl_expense_request SET Photo='$Photo',Photo2='$Photo2',Narration = '$Narration',Amount='$Amount',PaymentMode = '$PaymentMode',ExpenseDate='$ExpenseDate',ModifiedDate='$ModifiedDate',ModifiedBy='$user_id',Gst='$Gst',VedPhone='$VedPhone',FrId='$FrId' WHERE id = '$id'";
  $conn->query($query2);
  ?>
  <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Your expenses request successfully updated.",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-expenses.php";
  }
}); });</script>
<?php 

}
    //header('Location:courses.php'); 

  }
 ?>
 
        <!-- page content start -->
<!-- page content start -->
   

        <div class="main-container  text-center" style="background-color:#fff; padding-top:15px;">

          
            
          
           
           <div class="container mb-4">
    <div class="text-center">
        <div class="row justify-content-equal no-gutters mt-2">
<?php if($LoginStatus == 1){?>
            <div class="col-4 col-md-2 mb-3">
                <a href="attendance.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/dayattendance.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Day Attendance</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="evening-attendance.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/night.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Night Attendance</small>
                    </p>
                </a>
            </div>
            <?php } ?>

            <div class="col-4 col-md-2 mb-3">
                <a href="my-attendance.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/attendance.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>My Attendance</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-attendance-request.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/attendance_request.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Attendance Request</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-expenses-mult-prod.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/multiple_expenses_2.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Expense Request</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-advance-payment-request.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/advance_request.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>My Advance</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="add-advance-payment-request.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/advance.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Advance Request</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-resign-request.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/resign.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Resign Request</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-leave-request.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/leave_request.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Leave/Week Off Request</small>
                    </p>
                </a>
            </div>

            <!-- Example conditional PettyCash -->
            <?php if($PettyCash == 'Yes'){ ?>
            <div class="col-4 col-md-2 mb-3">
                <a href="view-pretty-cash-request.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/petty_cash.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Petty Cash</small>
                    </p>
                </a>
            </div>
            <?php } ?>
            
            <?php if($EmpAppDashboard == 1){ ?>
            <div class="col-4 col-md-2 mb-3">
                <a href="employee-dashboard.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/vendors.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Employee Dashboard</small>
                    </p>
                </a>
            </div>
<?php } ?>
            <div class="col-4 col-md-2 mb-3">
                <a href="view-vendors.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/vendors.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Vendors</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="add-vendor.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/add_vendor.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Add Vendor</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-vendor-expenses-2.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/vendor_expens.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Vendor Expenses</small>
                    </p>
                </a>
            </div>
            
            <?php if($VendorExpSecOpt == 1){ ?>
            <div class="col-4 col-md-2 mb-3">
                <a href="view-vendor-expenses-test.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/vendor_expens.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Vendor Expenses New</small>
                    </p>
                </a>
            </div>
<?php } ?>

            <?php if($NsoVedPay == 1){ ?>
            <div class="col-4 col-md-2 mb-3">
                <a href="view-nso-vendor-expenses.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/vendro_expenses_2.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>NSO Vendor Expenses</small>
                    </p>
                </a>
            </div>
            <?php } ?>

            <div class="col-4 col-md-2 mb-3">
                <a href="add-control-room.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/control_room.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Controll Room</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-store-manager-duties.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/store_manager_duties.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Store Manager Duties</small>
                    </p>
                </a>
            </div>

            <?php if($MgrCheckpoint == 1){ ?>
            <div class="col-4 col-md-2 mb-3">
                <a href="view-manager-checkpoint.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/manager1.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Manager Checkpoints</small>
                    </p>
                </a>
            </div>
            <?php } ?>
            
           <?php if($BdmCheckpoint == 1){ ?>
            <div class="col-4 col-md-2 mb-3">
                <a href="view-bdm-checklist.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/manager1.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>BDM Checklist</small>
                    </p>
                </a>
            </div>
            <?php } ?>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-checklist.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/fuelstations_checklist.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Fuel Station Checklist</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="create-task.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/create_task.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Create Task</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-task.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/today_task.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Today Task</small>
                    </p>
                </a>
            </div>
            
            <div class="col-4 col-md-2 mb-3">
    <a href="view-referal-list.php">
        <div class="avatar avatar-70 mb-1 rounded">
            <div class="background">
                <img src="icons/referemp.jpeg" alt="Refer Employee">
            </div>
        </div>
        <p class="text-secondary">
            <small>Refer Employee</small>
        </p>
    </a>
</div>

            
            <div class="col-4 col-md-2 mb-3">
                <a href="company-policy.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/company-policy.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Company Policy</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="survey-form.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/survey.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Today Survey/Feedback</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="view-query.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/ask_query.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Ask For Query</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="complaints.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/suggestions.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Suggestions or Query</small>
                    </p>
                </a>
            </div>

            <div class="col-4 col-md-2 mb-3">
                <a href="video_tutorial.php">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/video_tutorial.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Video Tutorial</small>
                    </p>
                </a>
            </div>
            
             
            <div class="col-4 col-md-2 mb-3">
                <a href="javascript:void(0)" onclick="logout()">
                    <div class="avatar avatar-70 mb-1 rounded">
                        <div class="background">
                            <img src="icons/logout.jpg" alt="">
                        </div>
                    </div>
                    <p class="text-secondary">
                        <small>Logout</small>
                    </p>
                </a>
            </div>

        </div>
    </div>
</div>

            
            <br><br>
              
 
    </main>

    <!-- footer-->
  <?php include_once 'footer.php'; ?>


<script src="dist/aos.js"></script>
    <script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>

<script>
        let countdown = 5;
        const loadingText = document.getElementById("loadingText");
        const closePopup = document.getElementById("closePopup");
        const popupOverlay = document.getElementById("popupOverlay");

        const interval = setInterval(() => {
            countdown--;
            loadingText.textContent = `Loading... ${countdown}s`;

            if (countdown <= 0) {
                clearInterval(interval);
                loadingText.textContent = "You can now close the Noticeboard!";
                closePopup.disabled = false;
                closePopup.classList.add("enabled");
                closePopup.textContent = "Close";
                closePopup.style.cursor = "pointer";
            }
        }, 1000);

        closePopup.addEventListener("click", () => {
            if (!closePopup.disabled) {
                popupOverlay.style.display = "none";
            }
        });
    </script>

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

    <!-- PWA app service registration and works -->
    <script src="js/pwa-services.js"></script>

    <!-- page level custom script -->
    <script src="js/app.js"></script>

   
</body>

</html>
