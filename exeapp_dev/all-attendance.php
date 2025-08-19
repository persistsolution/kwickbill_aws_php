<?php session_start();
require_once 'config.php';
$id = $_GET['id'];
$PageName = "Employee Dashboard";
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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   

<style>

.dashboard-card {
    border-radius: 18px;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: #fff;
    text-decoration: none;
    transition: transform 0.2s ease;
  }

  .dashboard-card:hover {
    transform: translateY(-4px);
    opacity: 0.95;
  }

  .dashboard-icon {
    font-size: 28px;
    margin-bottom: 6px;
  }

  .dashboard-title {
    font-size: 13px;
    font-weight: 500;
    margin: 0;
  }

  .dashboard-count {
    font-size: 22px;
    font-weight: bold;
    margin: 0;
  }

  .mb-3-half {
    margin-bottom: 12px;
  }
  
  
</style>
    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 

        <!-- page content start -->
<div class="container my-2">
  <form method="GET" class="row g-2">
    <input type="hidden" name="frid" value="<?php echo $_GET['frid']; ?>">

    <?php 
      $today = date('Y-m-d'); 
      $yesterday = date('Y-m-d', strtotime('-1 day'));
    ?>

    <!-- Start Date -->
    <div class="col-5">
      <input type="date" name="start_date" class="form-control" 
             value="<?php echo $_GET['start_date'] ?? $yesterday; ?>"
             max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">
    </div>

    <!-- End Date -->
    <div class="col-5">
      <input type="date" name="end_date" class="form-control" 
             value="<?php echo $_GET['end_date'] ?? $yesterday; ?>"
             max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">
    </div>

    <!-- Filter Button -->
    <div class="col-2">
      <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-funnel"></i>
      </button>
    </div>
  </form>
</div>


    <?php
$frid = $_GET['frid'];
$start_date = $_GET['start_date'] ?? $yesterday;
$end_date = $_GET['end_date'] ?? $yesterday;



// Attendance counts (DISTINCT users for Present)
$sql_present = "SELECT COUNT(DISTINCT ta.UserId) AS PresentCount 
                FROM tbl_attendance ta 
                INNER JOIN tbl_users tu ON tu.id = ta.UserId 
                WHERE ta.CreatedDate BETWEEN '$start_date' AND '$end_date' 
                  AND ta.Type = 2 
                  AND tu.UnderFrId = '$frid'";
$row_present = getRecord($sql_present);

// Total Employees (again for safety)
$sql_total_emp = "SELECT COUNT(*) AS TotalEmp 
                  FROM tbl_users 
                  WHERE Status = 1 
                    AND Roll NOT IN(1,5,55,9,22,23,63,3) 
                    AND OtherEmp = 0 
                    AND UnderFrId = '$frid'";
$row_total_emp = getRecord($sql_total_emp);

$present_count = $row_present['PresentCount'] ?? 0;
$absent_count = max(0, ($row_total_emp['TotalEmp'] ?? 0) - $present_count);
?>

<div class="container my-3">
  <div class="row">
    <!-- Total Employees -->
    <div class="col-6 mb-3-half">
      <a href="bdm-employee.php?frid=<?php echo $frid;?>" class="dashboard-card" style="background: linear-gradient(135deg, #1E88E5, #42A5F5);">
        <span class="material-icons dashboard-icon">groups</span>
        <p class="dashboard-title">Total Employees</p>
        <p class="dashboard-count"><?php echo $row_total_emp['TotalEmp']; ?></p>
      </a>
    </div>

    <!-- Total Present -->
    <div class="col-6 mb-3-half">
      <a href="present-employee-datewise.php?val=present&frid=<?php echo $frid;?>&start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date;?>" class="dashboard-card" style="background: linear-gradient(135deg, #00ACC1, #26C6DA);">
        <span class="material-icons dashboard-icon">check_circle</span>
        <p class="dashboard-title">Total Present</p>
        <p class="dashboard-count"><?php echo $present_count; ?></p>
      </a>
    </div>

    <!-- Total Absent -->
    <div class="col-6 mb-3-half">
      <a href="present-employee-datewise.php?val=absent&frid=<?php echo $frid;?>&start_date=<?php echo $start_date;?>&end_date=<?php echo $end_date;?>" class="dashboard-card" style="background: linear-gradient(135deg, #E53935, #EF5350);">
        <span class="material-icons dashboard-icon">cancel</span>
        <p class="dashboard-title">Total Absent</p>
        <p class="dashboard-count"><?php echo $absent_count; ?></p>
      </a>
    </div>
  </div>
</div>




    </main>
    <br><br><br><br>
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
