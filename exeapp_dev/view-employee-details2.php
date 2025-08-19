<?php session_start();
require_once 'config.php';
$id = $_GET['id'];
$PageName = "Employees";
$UserId = $_SESSION['User']['id']; ?>
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
    <link href="vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/daterangepicker-master/daterangepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 

        <!-- page content start -->

       
            <div class="container mb-4" style="padding-right: 1px;
padding-left: 1px;">

                   
                <div class="card">
                   
                
           <?php 
$EmpId = $_GET['id'];

// Get employee info
$sql = "SELECT 
            tu.*, 
            tut.Name AS RoleName,
            tu2.Fname AS UnderName,
            tu3.ShopName AS UnderFrName,
            tu6.Fname AS UserByBdmName,
            tc.Name AS CityName
        FROM tbl_users tu 
        LEFT JOIN tbl_user_type tut ON tut.id = tu.Roll 
        LEFT JOIN tbl_users tu2 ON tu.UnderUser = tu2.id 
        LEFT JOIN tbl_users tu3 ON tu3.id = tu.UnderFrId 
        LEFT JOIN tbl_users tu6 ON tu6.id = tu.UnderByBdm 
        LEFT JOIN tbl_city tc ON tc.id = tu.CityId 
        WHERE tu.id = '$EmpId'";

$emp = getRecord($sql);

// Zone Info
$sql2 = "SELECT * FROM tbl_zone WHERE id='".$emp['ZoneId']."'";
$row2 = getRecord($sql2);

// Get today's attendance
$sql2 = "SELECT 
            DATE_FORMAT(MAX(CASE WHEN Type = 1 THEN CreatedTime END), '%r') AS PunchInTime,
            DATE_FORMAT(MAX(CASE WHEN Type = 2 THEN CreatedTime END), '%r') AS PunchOutTime
         FROM tbl_attendance 
         WHERE CreatedDate = CURDATE() AND UserId = '$EmpId'";
$att = getRecord($sql2);

// This Month Attendance Summary
$today = date('Y-m-d');
$firstDay = date('Y-m-01');

$totalSundays = 0;
$totalDays = 0;
$totalPresent = 0;
$totalAbsent = 0;

$period = new DatePeriod(
    new DateTime($firstDay),
    new DateInterval('P1D'),
    new DateTime(date('Y-m-d', strtotime('+1 day')))
);

foreach ($period as $date) {
    $currentDate = $date->format("Y-m-d");
    $dayOfWeek = $date->format('w'); // 0 = Sunday

    if ($dayOfWeek == 0) {
        $totalSundays++;
        continue;
    }

    $sql = "SELECT 
                MAX(CASE WHEN Type = 1 THEN 1 ELSE 0 END) AS PunchIn,
                MAX(CASE WHEN Type = 2 THEN 1 ELSE 0 END) AS PunchOut
            FROM tbl_attendance 
            WHERE CreatedDate = '$currentDate' AND UserId = '$EmpId'";
    $row = getRecord($sql);

    $totalDays++;
    if ($row['PunchIn'] == 1 && $row['PunchOut'] == 1) {
        $totalPresent++;
    } else {
        $totalAbsent++;
    }
}

$sql_wallet = "SELECT 
                  SUM(CASE WHEN Status = 'Cr' THEN Amount ELSE 0 END) AS TotalCredit,
                  SUM(CASE WHEN Status = 'Dr' THEN Amount ELSE 0 END) AS TotalDebit
               FROM wallet 
               WHERE UserId = '$EmpId'";
$wallet = getRecord($sql_wallet);

$walletBalance = round(($wallet['TotalCredit'] ?? 0) - ($wallet['TotalDebit'] ?? 0));

$joinDate = $emp['JoinDate'];
$today = date('Y-m-d');
$interval = date_diff(date_create($joinDate), date_create($today));

$sinceJoining = '';
if ($interval->y > 0) $sinceJoining .= $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
if ($interval->m > 0) $sinceJoining .= ($sinceJoining ? ' ' : '') . $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
if ($interval->d > 0) $sinceJoining .= ($sinceJoining ? ' ' : '') . $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
if ($sinceJoining === '') $sinceJoining = '0 days';

?>

<div class="card shadow-sm">
    <div class="card-body text-center">
        <div class="avatar avatar-100 rounded-circle mx-auto mb-3 overflow-hidden border">
            <?php if ($emp['Photo'] == '' || !file_exists("../uploads/" . $emp['Photo'])) { ?>
                <img src="no_profile.jpg" alt="No Image" style="width: 100px; height: 100px;">
            <?php } else { ?>
                <img src="../uploads/<?php echo $emp['Photo']; ?>" alt="Profile" style="width: 100px; height: 100px;">
            <?php } ?>
        </div>
        <h4 class="mb-0"><?php echo strtoupper(strtolower($emp['Fname'] . " " . $emp['Lname'])); ?></h4>
        <p class="text-muted"><?php echo $emp['CustomerId']; ?><br><?php echo $emp['RoleName']; ?></p>
        <!--<span class="badge badge-<?php echo ($emp['Status'] == 1) ? 'success' : 'danger'; ?>">
            <?php echo ($emp['Status'] == 1) ? 'Active' : 'Inactive'; ?>
        </span>-->
    </div>
    <hr class="my-0">

    <div class="card-body">
        <h6 class="text-primary">Contact Information</h6>
        <?php if (!empty($emp['Phone'])): ?>
<p><strong>Mobile:</strong> <?php echo $emp['Phone']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['EmailId'])): ?>
<p><strong>Email:</strong> <?php echo $emp['EmailId']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['CityName'])): ?>
<p><strong>City:</strong> <?php echo $emp['CityName']; ?></p>
<?php endif; ?>
        

        <hr>
<h6 class="text-primary">Employment Info</h6>
<?php if (!empty($emp['JoinDate']) && $emp['JoinDate'] !== '0000-00-00'): ?>
<p><strong>Joining Date:</strong> <?php echo date("d/m/Y", strtotime($emp['JoinDate'])); ?></p>
<p><strong>Since Joining:</strong> <?php echo $sinceJoining; ?></p>
<?php endif; ?>

<?php if (!empty($emp['MonthlySalary'])): ?>
<p><strong>Monthly Salary:</strong> ₹<?php echo $emp['MonthlySalary']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['UanNo'])): ?>
<p><strong>UAN No:</strong> <?php echo $emp['UanNo']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['EsicNo'])): ?>
<p><strong>ESIC No:</strong> <?php echo $emp['EsicNo']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['Dob']) && $emp['Dob'] !== '0000-00-00'): ?>
<p><strong>Date of Birth:</strong> <?php echo date("d/m/Y", strtotime($emp['Dob'])); ?></p>
<?php endif; ?>

<?php if (!empty($emp['AadharNo'])): ?>
<p><strong>Aadhar No:</strong> <?php echo $emp['AadharNo']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['PanNo'])): ?>
<p><strong>PAN No:</strong> <?php echo $emp['PanNo']; ?></p>
<?php endif; ?>
       

 <hr>
        <h6 class="text-primary">Organization Details</h6>
        <p><strong>Zone:</strong> <?php echo $row2['Name'] ?? 'NA'; ?></p>
        <p><strong>Reporting Manager:</strong> <?php echo $emp['UnderName'] ?? 'NA'; ?></p>
        <p><strong>BDM:</strong> <?php echo $emp['UserByBdmName'] ?? 'NA'; ?></p>
        <p><strong>Franchise:</strong> <?php echo $emp['UnderFrName'] ?? 'NA'; ?></p>

        <hr>
       
       <?php
$EmpId = $_GET['id'];
$startDate = $_REQUEST['start_date'] ?? date('Y-m-01');
$endDate = $_REQUEST['end_date'] ?? date('Y-m-d');

// Generate date range
$period = new DatePeriod(
    new DateTime($startDate),
    new DateInterval('P1D'),
    (new DateTime($endDate))->modify('+1 day')
);
?>

<h6 class="text-primary">Today’s Attendance</h6>
        <p><span class="text-success">Punch In:</span> <?php echo $att['PunchInTime'] ?? '<span class="text-muted">&mdash;</span>'; ?></p>
        <p><span class="text-danger">Punch Out:</span> <?php echo $att['PunchOutTime'] ?? '<span class="text-muted">&mdash;</span>'; ?></p>
        <hr>
<h6 class="text-primary mb-3">
    Attendance Record (<?php echo date('d M Y', strtotime($startDate)); ?> to <?php echo date('d M Y', strtotime($endDate)); ?>)
</h6>

<div class="row">
    
    <?php
    $sr = 1;
    foreach ($period as $date) {
        $currentDate = $date->format("Y-m-d");
        $formattedDate = $date->format("d M Y (D)");

        $sql = "SELECT 
                    DATE_FORMAT(MAX(CASE WHEN Type = 1 THEN CreatedTime END), '%r') AS PunchInTime,
                    DATE_FORMAT(MAX(CASE WHEN Type = 2 THEN CreatedTime END), '%r') AS PunchOutTime
                FROM tbl_attendance 
                WHERE CreatedDate = '$currentDate' AND UserId = '$EmpId'";
        $attRow = getRecord($sql);

        $punchIn = $attRow['PunchInTime'] ?? null;
        $punchOut = $attRow['PunchOutTime'] ?? null;
        $status = ($punchIn && $punchOut) ? 'Present' : 'Absent';
        $badgeClass = ($status === 'Present') ? 'success' : 'danger';
    ?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h6 class="mb-1 text-dark"><?php echo $formattedDate; ?></h6>
                <p class="mb-1"><strong class="text-success">Punch In:</strong> <?php echo $punchIn ? $punchIn : '<span class="text-muted">—</span>'; ?></p>
                <p class="mb-1"><strong class="text-danger">Punch Out:</strong> <?php echo $punchOut ? $punchOut : '<span class="text-muted">—</span>'; ?></p>
                <span class="badge badge-<?php echo $badgeClass; ?>"><?php echo $status; ?></span>
            </div>
        </div>
    </div>
    <?php } ?>
</div>


        <hr>
        <h6 class="text-primary">This Month Attendance Summary</h6>
        <p><strong>Total Working Days (Excl. Sundays):</strong> <?php echo $totalDays; ?></p>
        <p><strong>Total Present Days:</strong> <span class="text-success"><?php echo $totalPresent; ?></span></p>
        <p><strong>Total Absent Days:</strong> <span class="text-danger"><?php echo $totalAbsent; ?></span></p>
        <p><strong>Week Offs (Sundays):</strong> <?php echo $totalSundays; ?></p>
        
        <!--<hr>
<h6 class="text-primary">Wallet Details</h6>
<p><strong>Wallet Balance:</strong> ₹<?php echo $walletBalance; ?></p>

<hr>
<h6 class="text-primary">Bank Details</h6>
<?php if (!empty($emp['AccountName'])): ?>
<p><strong>Account Holder Name:</strong> <?php echo $emp['AccountName']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['BankName'])): ?>
<p><strong>Bank Name:</strong> <?php echo $emp['BankName']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['AccountNo'])): ?>
<p><strong>Account No:</strong> <?php echo $emp['AccountNo']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['Branch'])): ?>
<p><strong>Branch:</strong> <?php echo $emp['Branch']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['IfscCode'])): ?>
<p><strong>IFSC Code:</strong> <?php echo $emp['IfscCode']; ?></p>
<?php endif; ?>

<?php if (!empty($emp['UpiNo'])): ?>
<p><strong>UPI ID:</strong> <?php echo $emp['UpiNo']; ?></p>
<?php endif; ?>-->
    </div>
</div>

            
            
            
                </div>
             
                
            
        </div>
    </main>
    <br><br><br><br><br>
 <?php include_once 'footer.php';?>

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

  <script src="vendor/daterangepicker-master/moment.min.js"></script>
    <script src="vendor/daterangepicker-master/daterangepicker.js"></script>
    <!-- page level custom script -->
    <script src="js/app.js"></script>

    </body>

</html>
