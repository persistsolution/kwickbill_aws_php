<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Employee";
$Page = "View-Employee";

/*$sql = "SELECT * FROM `tbl_users` WHERE Roll NOT IN(1,5,55,9,22,23,63) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "E".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}*/

$sql = "SELECT UnderFrId,id FROM `tbl_users` WHERE Roll NOT IN(1,5,55,9,22,23,63,3) AND ZoneId=0";
$row = getList($sql);
foreach($row as $result){
    $UnderFrId = $result['UnderFrId'];
    $sql55 = "SELECT ZoneId FROM tbl_users WHERE id='$UnderFrId'";
    $row55 = getRecord($sql55);
    $ZoneId = $row55['ZoneId'];
    $sql = "UPDATE tbl_users SET ZoneId='$ZoneId' WHERE id='".$result['id']."'";
    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Employee Account List</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>
</head>
<body>

 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">




<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Attendace Report Percentage Wise
    
</h4>

<div class="card" style="padding: 10px;">
    <!-- <ul class="nav nav-tabs" id="reportTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="report-tab" data-toggle="tab" href="#report" role="tab">Report</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="graph-tab" data-toggle="tab" href="#graph" role="tab">Graph</a>
    </li>
  </ul>-->
    <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

  <div class="form-group col-md-2">
                                            <label class="form-label">Zone </label>
                                            <select class="form-control" id="ZoneId" name="ZoneId" required="">
                                                <option selected=""  value="all">All</option>
                                                <?php $sql = "SELECT * FROM tbl_zone WHERE Status=1";
                                                    $row = getList($sql);
                                                    foreach($row as $result){?>
                                                <option value="<?php echo $result['id'];?>" <?php if($_POST["ZoneId"]==$result['id']) {?> selected
                                                    <?php } ?>><?php echo $result['Name'];?></option>
                                                <?php } ?>
                                                  
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">Sub Zone </label>
                                            <select class="form-control" id="SubZoneId" name="SubZoneId" required="">
                                                <option selected=""  value="all">All</option>
                                                <?php $sql = "SELECT * FROM tbl_sub_zone WHERE Status=1";
                                                    $row = getList($sql);
                                                    foreach($row as $result){?>
                                                <option value="<?php echo $result['id'];?>" <?php if($_POST["SubZoneId"]==$result['id']) {?> selected
                                                    <?php } ?>><?php echo $result['Name'];?></option>
                                                <?php } ?>
                                                  
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>

  <div class="form-group col-md-3">
                                            <label class="form-label">Franchise</label>
                                            <select class="select2-demo form-control" name="UserId" id="UserId">
                                                <option selected="" value="all">All</option>
                                                <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll IN(5) AND ShopName!=''";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
                                                <option <?php if($_REQUEST['UserId']==$result['id']){ ?> selected <?php } ?>
                                                    value="<?php echo $result['id']; ?>"><?php echo $result['ShopName']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>


<div class="form-group col-md-2">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_REQUEST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-2">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_REQUEST['ToDate'] ?>" autocomplete="off">
</div>

<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top:30px;">
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_REQUEST['Search'])) {?>
<div class="col-md-1">
<label class="form-label d-none d-md-block">&nbsp;</label>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" data-original-title="Clear Filter">X</a>
</div>
<?php } ?>
</div>

</form>
                                            </div>
                                        </div>
                                    </div>
   </div>
   
   <div class="tab-content" id="reportTabContent">
    <!-- Report Tab -->
    <div class="tab-pane fade show active" id="report" role="tabpanel">
        
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Franchise Name</th>
            <th>Zone</th>
            <th>Sub Zone</th>
            <th>Total Employee</th>
            <th>Total Present</th>
            <th>Total Absent</th>
            <th>Present %</th>
            <th>Absent %</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $fromDate = $_REQUEST['FromDate'] ?? date('Y-m-d');
        $toDate = $_REQUEST['ToDate'] ?? date('Y-m-d');

        $sql = "SELECT tu.ShopName, tu.id, tz.Name AS ZoneName, tsz.Name AS SubZoneName 
                FROM tbl_users_bill tu 
                INNER JOIN tbl_zone tz ON tz.id = tu.ZoneId 
                INNER JOIN tbl_sub_zone tsz ON tsz.id = tu.SubZoneId 
                WHERE tu.Status = 1 AND tu.Roll = 5";

        if ($_POST['UserId'] && $_POST['UserId'] !== 'all') {
            $sql .= " AND tu.id='{$_POST['UserId']}'";
        }
        if ($_POST['ZoneId'] && $_POST['ZoneId'] !== 'all') {
            $sql .= " AND tu.ZoneId='{$_POST['ZoneId']}'";
        }
        if ($_POST['SubZoneId'] && $_POST['SubZoneId'] !== 'all') {
            $sql .= " AND tu.SubZoneId='{$_POST['SubZoneId']}'";
        }

        $franchises = getList($sql);

        // Arrays for Chart (only with >0 emp)
        $franchiseLabels = [];
        $totalEmpArr = [];
        $presentArr = [];
        $absentArr = [];
        $totalOverallEmp = 0;
        $totalOverallPresent = 0;

        foreach ($franchises as $fr) {
            $FrId = $fr['id'];

            // Get all employee IDs
            $empSql = "SELECT id FROM tbl_users WHERE UnderFrId = '$FrId' AND Status = 1 AND OtherEmp = 0";
            $empRecords = getList($empSql);
            $empIds = array_column($empRecords, 'id');
            $totalEmp = count($empIds);
            $empIdStr = implode(',', $empIds);

            $present = 0;
            if ($totalEmp > 0 && !empty($empIdStr)) {
                $presentSql = "SELECT COUNT(DISTINCT UserId) AS presentCount FROM tbl_attendance 
                               WHERE UserId IN ($empIdStr) AND Type = 2 
                               AND DATE(CreatedDate) BETWEEN '$fromDate' AND '$toDate'";
                $presentRow = getRecord($presentSql);
                $present = $presentRow['presentCount'] ?? 0;
            }

            $absent = max(0, $totalEmp - $present);
            $presentPct = ($totalEmp > 0) ? number_format(($present / $totalEmp) * 100, 2) . '%' : '0.00%';
            $absentPct = ($totalEmp > 0) ? number_format(($absent / $totalEmp) * 100, 2) . '%' : '0.00%';

            // Show all in table
        ?>
            <tr>
                <td><?= $fr['ShopName']; ?></td>
                <td><?= $fr['ZoneName']; ?></td>
                <td><?= $fr['SubZoneName']; ?></td>
                <td><span style="color:blue; font-weight:bold;"><?= $totalEmp; ?></span></td>
                <td><span style="color:green; font-weight:bold;"><?= $present; ?></span></td>
                <td><span style="color:red; font-weight:bold;"><?= $absent; ?></span></td>
                <td><span style="color:green; font-weight:bold;"><?= $presentPct; ?></span></td>
                <td><span style="color:red; font-weight:bold;"><?= $absentPct; ?></span></td>
            </tr>
        <?php 
            // Only push into graph if totalEmp > 0
            if ($totalEmp > 0) {
                $franchiseLabels[] = $fr['ShopName'];
                $totalEmpArr[] = $totalEmp;
                $presentArr[] = $present;
                $absentArr[] = $absent;

                $totalOverallEmp += $totalEmp;
                $totalOverallPresent += $present;
            }
        } ?>
    </tbody>
</table>
</div>

</div>

    <!-- Graph Tab -->
    <div class="tab-pane fade" id="graph" role="tabpanel">
       <div class="row mt-5">
    <div class="col-lg-12">
        <canvas id="barChart" height="300"></canvas>
    </div>
    <div class="col-lg-6">
        <canvas id="pieChart" height="300"></canvas>
    </div>
</div>
      <!-- Include Chart.js & DataLabels Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<?php
$overallPresentPct = $totalOverallEmp > 0 ? round(($totalOverallPresent / $totalOverallEmp) * 100, 1) : 0;
$overallAbsentPct = 100 - $overallPresentPct;
?>

        
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

<script type="text/javascript">
 
    $(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ],
        order: [[3, 'desc']]
    });
});
</script>
<script>
const labels = <?= json_encode($franchiseLabels) ?>;
const totalData = <?= json_encode($totalEmpArr) ?>;
const presentData = <?= json_encode($presentArr) ?>;
const absentData = <?= json_encode($absentArr) ?>;
const overallPieData = [<?= $overallPresentPct ?>, <?= $overallAbsentPct ?>];

// Bar Chart
new Chart(document.getElementById('barChart').getContext('2d'), {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [
      {
        label: 'Total Employees',
        data: totalData,
        backgroundColor: 'rgba(0,123,255,0.7)'
      },
      {
        label: 'Present',
        data: presentData,
        backgroundColor: 'rgba(40,167,69,0.7)'
      },
      {
        label: 'Absent',
        data: absentData,
        backgroundColor: 'rgba(220,53,69,0.7)'
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: 'Employee Count by Franchise (Excluding 0 Employees)'
      },
      tooltip: {
        mode: 'index',
        intersect: false
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        title: {
          display: true,
          text: 'Employees'
        }
      }
    }
  }
});

// Pie Chart
new Chart(document.getElementById('pieChart').getContext('2d'), {
  type: 'doughnut',
  data: {
    labels: ['Present %', 'Absent %'],
    datasets: [{
      data: overallPieData,
      backgroundColor: ['#28a745', '#dc3545'],
      borderColor: '#fff',
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: 'Overall Attendance Percentage'
      },
      legend: {
        position: 'bottom'
      },
      tooltip: {
        callbacks: {
          label: ctx => `${ctx.label}: ${ctx.raw}%`
        }
      }
    }
  }
});
</script>
</body>
</html>
