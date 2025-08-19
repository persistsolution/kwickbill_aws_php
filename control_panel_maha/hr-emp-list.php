<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Report";
$Page = "Daily-Sale-Report-2";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title>Daily Sale Report - <?php echo $Proj_Title; ?> </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

<?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">





<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Employee Report (<?php echo $_GET['zonename'];?> - <?php echo $_GET['subzonename'];?>)
  
</h4>

<div class="card" style="padding: 10px;">
     <ul class="nav nav-tabs" id="reportTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="report-tab" data-toggle="tab" href="#report" role="tab">Report</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="graph-tab" data-toggle="tab" href="#graph" role="tab">Graph</a>
    </li>
  </ul>
  
  <div class="tab-content" id="reportTabContent">
    <!-- Report Tab -->
    <div class="tab-pane fade show active" id="report" role="tabpanel">
       
   <?php if($_REQUEST['Search']=='Search') {?>
<div class="card-datatable table-responsive">


<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
             <th>Photo</th>
           <th>Employee ID</th>
                <th>Employee Name</th>
                 <th>Zone</th>
           
            <th>Today Attendance</th>
            <th>Joining Date</th>
            <th>Since Joining</th>
             <th>Contact No</th>
           <th>Another Contact No</th>
                <th>Status</th>
                <th>Under By Employee</th>
                <th>Under Franchises</th>
                <th>Roll</th>
                <th>Reporting Manager</th>
                 <th>Under By Reporting Manager</th>
                <th>Email Id</th>
               
                
                <th>Address</th>
                 <th>Date of Join</th>
                 <th>Per Day Salary</th>
                 
               
                <th>Register Date</th>
                 <th>City</th>
                  <th>Date Of Birth</th>
               <th>Aadhar Card No</th>
                <th>Blood Group</th>
                <th>Bank Holder Name</th>
                <th>Bank Name</th>
                <th>Account No</th>
                <th>Branch</th>
                <th>IFSC Code</th>
                <th>UPI ID</th>
                <th>Referal Code</th>
                <th>Referral Name</th>
                <th>Reference Mobile No</th>
                <th>Reference Mobile No 2</th>
                <th>Reference Email Id</th>
                <th>Nominee Name</th>
                <th>Nominee Relation</th>
                <th>Nominee Contact No</th>
                <th>Nominee Aadhar Card No</th>
                <th>Monthly Salary</th>
                <th>Resignation Date</th>
                <th>Rejoin Date</th>
                <th>Approve By</th>
        </tr>
    </thead>
    <tbody>
<?php
$zoneid = $_GET['zoneid'];
$subzoneid = $_GET['subzoneid'];
$today = date('Y-m-d');
$sql77 = "SELECT GROUP_CONCAT(id) AS FrId FROM tbl_users WHERE SubZoneId='$subzoneid' AND ZoneId='$zoneid' AND Roll=5 AND Status=1";
  $row77 = getRecord($sql77);
  $frids = $row77['FrId'];
   
    
$sql = "SELECT tu.*,tut.Name,tu2.Fname As UnderName,tu3.ShopName As UnderFrName,tu4.Fname AS UserByEmpName,tc.Name AS CityName,tu5.Fname As ModifiedName FROM tbl_users tu 
                    LEFT JOIN tbl_user_type tut ON tut.id=tu.Roll 
                    LEFT JOIN tbl_users tu2 ON tu.UnderUser=tu2.id 
                    LEFT JOIN tbl_users tu3 ON tu3.id=tu.UnderFrId 
                    LEFT JOIN tbl_city tc ON tc.id=tu.CityId 
                    LEFT JOIN tbl_users tu5 ON tu5.id=tu.ModifiedBy
                    LEFT JOIN tbl_users tu4 ON tu4.id=tu.UnderByUser WHERE tu.UnderFrId IN ($frids) AND tu.Roll NOT IN(1,5,55,9,22,23,63,3) AND tu.OtherEmp=0 AND tu.Status=1 AND tu.ZoneId='$zoneid'";
         $franchises = getList($sql);           
foreach ($franchises as $row) {
    
    
    $sql2 = "SELECT * FROM tbl_attendance ta WHERE ta.CreatedDate='$today' AND ta.Type=1 AND ta.UserId='".$row['id']."'";
    $rncnt2 = getRow($sql2);
          if($rncnt2 > 0){
              $attstatus = "P";
          }         
    else{
        $attstatus = "A";
    }
    
     if($row['UnderUser'] == 0){
                  $UnderUserName = "NA";
                }
                else{
                  $UnderUserName = $row['UnderName'];
                }
                 $sql2 = "SELECT * FROM tbl_zone WHERE id='".$row['ZoneId']."'";
                $row2 = getRecord($sql2);
                
                
                $sql_user = "SELECT * FROM tbl_users 
             WHERE id = '".$row['id']."' 
             AND DATE(JoinDate) <= '$today'";

$res_user = mysqli_query($conn, $sql_user);

if ($row22 = mysqli_fetch_assoc($res_user)) {
      $joinDate = $row22['JoinDate'];
    $date1 = new DateTime($joinDate);
    $date2 = new DateTime($today);
    $interval = $date1->diff($date2);

    $years  = $interval->y;
    $months = $interval->m;
    $days   = $interval->d;

    $duration = "";
    if ($years > 0)  $duration .= "$years year" . ($years > 1 ? "s" : "");
    if ($months > 0) $duration .= ($duration ? " " : "") . "$months month" . ($months > 1 ? "s" : "");
    if ($days > 0)   $duration .= ($duration ? " " : "") . "$days day" . ($days > 1 ? "s" : "");

    if ($duration === "") $duration = "0 days";
    // echo "👤 Name: {$row['Name']}<br>";
    // echo "📅 Join Date: {$joinDate}<br>";
    // echo "🕒 Since Joining: <strong>$duration</strong><br>";
} else {
   // echo "❌ No user found with id=1 and the given conditions.";
}
    ?>
   <tr>
               
              
               <td> <?php if($row["Photo"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Photo"])){?>
                 <img src="../uploads/<?php echo $row["Photo"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
           
             <td><?php echo $row['CustomerId']; ?></td>
               <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
                  <td><?php echo $row2['Name']; ?></td>
           
            <td><?php echo $attstatus;?></td>
                   <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$joinDate)));;?></td>
                   <td><?php echo $duration;?></td>
                 <td><?php echo $row['Phone']; ?></td>
                  <td><?php echo $row['Phone2']; ?></td>
                   <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Active</span>";} else { echo "<span style='color:red;'>In Active</span>";} ?></td>
             
               
               <td><?php echo $row['UserByEmpName'];?></td>
               <td><?php echo $row['UnderFrName'];?></td>
                  <td><?php echo $row['Name'];?></td>
                 
                <td><?php if($row['ReportingMgr']=='1'){echo "<span style='color:green;'>Yes</span>";} else { echo "<span style='color:red;'>No</span>";} ?></td>
              <td><?php echo $UnderUserName;?></td>
                
                <td><?php echo $row['EmailId']; ?></td>
             
              
               <td><?php echo $row['Address']; ?></td>
               <td><?php echo $row['JoinDate']; ?></td>
                <td><?php echo $row['PerDaySalary']; ?></td>
              
               
              
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
            <td><?php echo $row['CityName']; ?></td>
            <td><?php if (!empty($row['Dob']) && $row['Dob'] != '0000-00-00') { echo date("d/m/Y", strtotime($row['Dob']));} ?></td>
             <td><?php echo $row['AadharNo']; ?></td>
            <td><?php echo $row['BloodGroup']; ?></td>
            <td><?php echo $row['AccountName']; ?></td>
            <td><?php echo $row['BankName']; ?></td>
            <td><?php echo $row['AccountNo']; ?></td>
            <td><?php echo $row['Branch']; ?></td>
            <td><?php echo $row['IfscCode']; ?></td>
            <td><?php echo $row['UpiNo']; ?></td>
            <td><?php echo $row['ReferCode'];?></td>
            <td><?php echo $row['ReferName'];?></td>
            <td><?php echo $row['RefPhone']; ?></td>
            <td><?php echo $row['RefPhone2']; ?></td>
            <td><?php echo $row['RefEmailId']; ?></td>
            <td><?php echo $row['NomineeName']; ?></td>
            <td><?php echo $row['NomineeRelation']; ?></td>
            <td><?php echo $row['NomineePhone']; ?></td>
            <td><?php echo $row['NomineeAadharNo']; ?></td>
           
         <td><?php echo $row['MonthlySalary']; ?></td>
                 <td><?php if (!empty($row['ResignDate']) && $row['ResignDate'] != '0000-00-00') { echo date("d/m/Y", strtotime($row['ResignDate']));} ?></td>
                  <td><?php if (!empty($row['ReJoinDate']) && $row['ReJoinDate'] != '0000-00-00') { echo date("d/m/Y", strtotime($row['ReJoinDate']));} ?></td>
                    <td><?php echo $row['ApproveBy']; ?></td>
            </tr>
<?php } ?>
    </tbody>
</table>

</div>
<?php } ?>
    </div>

    <!-- Graph Tab -->
    <div class="tab-pane fade" id="graph" role="tabpanel">
    <div class="row">
        <div class="col-lg-6">
            <canvas id="employeeGraph" width="100%" height="40" style="margin-top:20px;"></canvas>
        </div>
        <div class="col-lg-6">
            <canvas id="employeePie" width="100%" height="40" style="margin-top:20px;"></canvas>
        </div>
    </div>
    <!-- Include Chart.js & DataLabels Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<?php
$today = date('Y-m-d');

// Fetch your DB values
$sql4 = "SELECT count(*) AS TotEmp FROM tbl_users tu 
         WHERE tu.UnderFrId IN ($frids) AND tu.ZoneId = '$zoneid' 
         AND tu.Status=1 AND tu.Roll NOT IN(1,5,55,9,22,23,63,3) AND tu.OtherEmp=0";
$totalEmp = getRecord($sql4)['TotEmp'] ?? 0;

$sql2 = "SELECT COUNT(*) AS Present FROM tbl_attendance ta 
         INNER JOIN tbl_users tu ON tu.id=ta.UserId 
         WHERE ta.CreatedDate='$today' AND ta.Type=1 
         AND tu.UnderFrId IN ($frids) AND tu.ZoneId='$zoneid'";
$presentCount = getRecord($sql2)['Present'] ?? 0;

$absentCount = $totalEmp - $presentCount;

$sql_today = "SELECT COUNT(*) AS TodayJoin FROM tbl_users 
              WHERE DATE(JoinDate) = '$today' AND UnderFrId IN ($frids) AND ZoneId = '$zoneid' 
              AND Status = 1 AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$todayCount = getRecord($sql_today)['TodayJoin'] ?? 0;

$sql_below6 = "SELECT COUNT(*) AS Below6 FROM tbl_users 
               WHERE JoinDate >= DATE_SUB('$today', INTERVAL 6 MONTH) AND JoinDate < '$today'
               AND UnderFrId IN ($frids) AND ZoneId = '$zoneid' AND Status = 1 
               AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$below6Count = getRecord($sql_below6)['Below6'] ?? 0;

$sql_6to1 = "SELECT COUNT(*) AS MidJoin FROM tbl_users 
             WHERE JoinDate < DATE_SUB('$today', INTERVAL 6 MONTH)
             AND JoinDate > DATE_SUB('$today', INTERVAL 1 YEAR)
             AND UnderFrId IN ($frids) AND ZoneId = '$zoneid' AND Status = 1 
             AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$between6To1Count = getRecord($sql_6to1)['MidJoin'] ?? 0;

$sql_above1 = "SELECT COUNT(*) AS Above1 FROM tbl_users 
               WHERE JoinDate <= DATE_SUB('$today', INTERVAL 1 YEAR)
               AND UnderFrId IN ($frids) AND ZoneId = '$zoneid' AND Status = 1 
               AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$above1Count = getRecord($sql_above1)['Above1'] ?? 0;

$sql_not_updated = "SELECT COUNT(*) AS NotUpdated FROM tbl_users 
                    WHERE (JoinDate IS NULL OR JoinDate = '0000-00-00') 
                    AND UnderFrId IN ($frids) AND ZoneId = '$zoneid' AND Status = 1 
                    AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$notUpdated = getRecord($sql_not_updated)['NotUpdated'] ?? 0;

$rawLabels = [
    'Total Employees', 'Today Present', 'Today Absent', 'Today Joining',
    'Below 6 Months', '6 Months to 1 Year', 'Above 1 Year', 'Join Date Not Updated'
];
$rawValues = [
    (int)$totalEmp,
    (int)$presentCount,
    (int)$absentCount,
    (int)$todayCount,
    (int)$below6Count,
    (int)$between6To1Count,
    (int)$above1Count,
    (int)$notUpdated
];

// Filter out 0 values
$filteredLabels = [];
$filteredValues = [];
$filteredLabelsbar = [];
$filteredValuesbar = [];
foreach ($rawValues as $index => $value) {
    if ($value > 0) {
        $filteredLabels[] = $rawLabels[$index];
        $filteredValues[] = $value;
    }
    
    
        $filteredLabelsbar[] = $rawLabels[$index];
        $filteredValuesbar[] = $value;
    
}
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
         "pageLength":50,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ]
    });
});
</script>
<script>
const empLabels = <?= json_encode($filteredLabels); ?>;
const empValues = <?= json_encode($filteredValues); ?>;
const empLabelsbar = <?= json_encode($filteredLabelsbar); ?>;
const empValuesbar = <?= json_encode($filteredValuesbar); ?>;
const empTotal = empValues.reduce((a, b) => a + b, 0);
const empTotalbar = empValuesbar.reduce((a, b) => a + b, 0);
// Bar Chart
const barCtx = document.getElementById('employeeGraph').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: empLabelsbar,
        datasets: [{
            label: 'Employee Count',
            data: empValuesbar,
            backgroundColor: empLabelsbar.map((_, i) => `hsl(${i * 45}, 60%, 60%)`),
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    plugins: [ChartDataLabels],
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Employee Status Summary'
            },
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const val = context.raw;
                        const percent = ((val / empTotalbar) * 100).toFixed(1);
                        return `${context.label}: ${val} (${percent}%)`;
                    }
                }
            },
            datalabels: {
                anchor: 'end',
                align: 'top',
                formatter: function(value) {
                    const percent = ((value / empTotalbar) * 100).toFixed(1);
                    return `${percent}%`;
                },
                font: {
                    weight: 'bold'
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Employee Count'
                }
            }
        }
    }
});

// Doughnut Chart
const doughnutCtx = document.getElementById('employeePie').getContext('2d');
new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
        labels: empLabels,
        datasets: [{
            label: 'Employee Count',
            data: empValues,
            backgroundColor: empLabels.map((_, i) => `hsl(${i * 45}, 60%, 60%)`),
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    plugins: [ChartDataLabels],
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Employee Status (Doughnut)'
            },
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const val = context.raw;
                        const percent = ((val / empTotal) * 100).toFixed(1);
                        return `${context.label}: ${val} (${percent}%)`;
                    }
                }
            },
            datalabels: {
                formatter: function(value) {
                    const percent = ((value / empTotal) * 100).toFixed(1);
                    return `${percent}%`;
                },
                color: '#000',
                font: {
                    weight: 'bold'
                }
            }
        }
    }
});
</script>

</body>
</html>
