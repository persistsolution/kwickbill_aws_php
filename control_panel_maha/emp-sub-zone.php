<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$MainPage="Dashboard";
$Page = "Dashboard";
$user_id = $_SESSION['Admin']['id'];
$uid = $_REQUEST['uid']; 
if($_REQUEST['uid'] == ''){
$sql11 = "SELECT * FROM tbl_users WHERE id='$user_id'";
$row = getRecord($sql11);
$_SESSION['Admin'] = $row;
}   
else{
$sql11 = "SELECT * FROM tbl_users WHERE id='$uid'";
$row = getRecord($sql11);
$_SESSION['Admin'] = $row;
}
//echo $sql11;
$Roll = $row['Roll'];
/*function RandomStringGenerator($n)
{
    $generated_string = "";   
    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $len = strlen($domain);
    for ($i = 0; $i < $n; $i++)
    {
        $index = rand(0, $len - 1);
        $generated_string = $generated_string . $domain[$index];
    }
    return $generated_string;
} 
$n = 10;


$sql = "SELECT * FROM tbl_cust_products WHERE code=''";
$row = getList($sql);
foreach($row as $result){
    $Code = RandomStringGenerator($n); 
    $Code2 = $Code."".$result['id'];
    $sql2 = "UPDATE tbl_cust_products SET code='$Code2' WHERE id='".$result['id']."'";
    $conn->query($sql2);
}*/
if($Roll == 63){
    echo "<script>window.location.href='emp-dashboard.php';</script>";
    exit();
}
if($Roll == 64){
    echo "<script>window.location.href='preparing-order.php';</script>";
    exit();
}
else{
    
}
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Dashboard</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>
<body>
<style type="text/css">
    .mr_5{
        margin-right: 3rem !important;
    }
    
 </style>
 <style>
   

     

    h2 {
      text-align: center;
      color: #083068;
      margin-bottom: 24px;
      font-size:13px;
    }
@media (max-width: 480px) {
  .chart-legend {
    font-size: 12px;
    gap: 8px;
  }

  .legend-item {
    min-width: 100px;
    flex-direction: column;
    align-items: flex-start;
  }
}

   .chart-legend {
  display: flex;
  flex-wrap: wrap; /* Allow items to wrap in mobile */
  justify-content: center;
  gap: 12px; /* Reduce gap for better fit */
  margin-top: 10px;
  font-size: 13px;
  padding: 0 10px;
  text-align: center;
}

.legend-item {
  display: flex;
  align-items: center;
  gap: 5px;
  min-width: 120px; /* ensures some width on small screens */
  word-break: break-word; /* wraps long names */
}

.legend-color {
  flex-shrink: 0;
  width: 10px;
  height: 10px;
  border-radius: 50%;
}

    table {
      width: 100%;
      margin-top: 30px;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
    }

    th {
      background-color: #083068;
      color: white;
      padding: 14px;
      font-size: 15px;
      text-align: left;
    }

    td {
      padding: 12px 16px;
      font-size: 14px;
      color: #333;
    }

   

    tr:hover {
      background-color: #e6effa;
    }

    canvas {
      max-width: 320px;
      margin: 0 auto;
      display: block;
    }
    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 10;
      left: 0;
      top: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.5);
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      background: #fff;
      padding: 20px 30px;
      border-radius: 10px;
      width: 400px;
      max-width: 90%;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
      font-size: 20px;
      font-weight: bold;
      color: #083068;
      margin-bottom: 10px;
    }

    .modal-close {
      float: right;
      font-size: 20px;
      cursor: pointer;
      color: #999;
    }

    .modal-close:hover {
      color: #000;
    }
    
     .text-secondary {
    color: #000000 !important;
}
  </style>
 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">
    
   
<?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">

<?php //include_once 'top_header.php'; ?>


<div class="layout-content">
<div class="container-fluid flex-grow-1 container-p-y">
<div class="text-muted small mt-0 mb-4 d-block breadcrumb">
</div>

<h3><?php echo $_GET['name'];?> ZONE</h3>     
<?php 
if($_POST['calendar']){
                     $_SESSION['Calendar']=$_POST['calendar'];
                 }
                 else{
                     $_SESSION['Calendar']=$_SESSION['Calendar'];
                 }
                 ?>
<div class="row">
   
                 <?php 
                $zoneid = $_GET['zoneid'];
                $sql = "SELECT * FROM tbl_sub_zone WHERE CatId='$zoneid'";
                $row = getList($sql);
                foreach($row as $result){
                    $subzoneid = $result['id'];
                    $sql77 = "SELECT GROUP_CONCAT(id) AS FrId FROM tbl_users WHERE SubZoneId='$subzoneid' AND ZoneId='$zoneid' AND Roll=5 AND Status=1";
  $row77 = getRecord($sql77);
  $frids = $row77['FrId'];
   // ✅ Skip this sub-zone if no FrId found
    if (empty($frids)) {
        continue;
    }
    
                     $sql3 = "SELECT count(*) AS TotFr FROM tbl_users_bill tu WHERE tu.ZoneId = '$zoneid' AND tu.SubZoneId='".$result['id']."' AND tu.Status=1 AND tu.Roll=5";
    $row3 = getRecord($sql3);
    
   $today = date('Y-m-d');
    
    $sql2 = "SELECT * FROM tbl_attendance ta INNER JOIN tbl_users tu ON tu.id=ta.UserId WHERE ta.CreatedDate='$today' AND ta.Type=1 AND tu.UnderFrId IN ($frids) AND tu.ZoneId='$zoneid'";
    $rncnt2 = getRow($sql2);
    
   

// Total employees (reference)
 $sql4 = "SELECT count(*) AS TotEmp, SUM(tu.MonthlySalary) AS MonthlySalary FROM tbl_users tu WHERE tu.UnderFrId IN ($frids) AND tu.ZoneId = '$zoneid' AND tu.Status=1 AND tu.Roll NOT IN(1,5,55,9,22,23,63,3) AND tu.OtherEmp=0";
    $row4 = getRecord($sql4);


// Today Joining
$sql_today = "SELECT * FROM tbl_users 
              WHERE DATE(JoinDate) = '$today' AND UnderFrId IN ($frids) AND ZoneId = '$zoneid' AND Status = 1 AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$todayCount = getRow($sql_today) ?? 0;

// Below 6 Months (excluding today)
$sql_below6 = "SELECT * FROM tbl_users 
               WHERE JoinDate >= DATE_SUB('$today', INTERVAL 6 MONTH)
               AND JoinDate < '$today'
               AND UnderFrId IN ($frids) AND ZoneId = '$zoneid' AND Status = 1 AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$below6Count = getRow($sql_below6) ?? 0;

// 6 Months to 1 Year
$sql_6to1 = "SELECT * FROM tbl_users 
             WHERE JoinDate < DATE_SUB('$today', INTERVAL 6 MONTH)
             AND JoinDate > DATE_SUB('$today', INTERVAL 1 YEAR)
             AND UnderFrId IN ($frids) AND ZoneId = '$zoneid' AND Status = 1 AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$between6To1Count = getRow($sql_6to1) ?? 0;

// Above 1 Year
$sql_above1 = "SELECT * FROM tbl_users 
               WHERE JoinDate <= DATE_SUB('$today', INTERVAL 1 YEAR)
               AND UnderFrId IN ($frids) AND ZoneId = '$zoneid' AND Status = 1 AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$above1Count = getRow($sql_above1) ?? 0;

$sum = $todayCount + $below6Count + $between6To1Count + $above1Count;
              
        ?>
               <div class="col-lg-4">
    <div class="card mb-2">
        <div class="px-0">
            <ul class="list-group list-group-flush">
                <a href="hr-emp-list.php?zoneid=<?php echo $result['CatId'];?>&subzoneid=<?php echo $result['id'];?>&zonename=<?php echo $_GET['name'];?>&subzonename=<?php echo $result['Name'];?>&Search=Search"> 
                <li class="list-group-item" style="border-radius: 10px;">
                   
                        <div class="row align-items-center">
                            <div class="col align-self-center pr-0" width="80%">
                                <h6 class="mb-1" style="color:black;font-size:14px;font-weight:500;"><?php echo $result['Name'];?></h6>
                                <span class="small text-secondary"><?php echo $result['Address'];?></span>
                                <p class="small " style="text-transform:capitalize;color:black">
                                             
                                               Franchise : <?php echo $row3['TotFr'];?><br>
                                          Employee : <?php echo $row4['TotEmp'];?> | Salary : <?php echo $row4['MonthlySalary'];?><br>
                                          Today Present : <?php echo $rncnt2;?> <br>
                                          Today Abscent : <?php echo $row4['TotEmp']-$rncnt2;?> <br>
                                         Today Joining : <?php echo $todayCount;?><br>
                                          Below 6 Months : <?php echo $below6Count;?><br>
                                          6 Month To 1 Year : <?php echo $between6To1Count;?><br>
                                          Above 1 Year : <?php echo $above1Count;?><br>
                                          
                                          Joining Date Not Update : <?php echo  $row4['TotEmp']-$sum;?> Employee
                                        
                                          </p>
                            </div>
                            
                        </div>
                    

                    <!-- Action Buttons -->
                    
                </li>
                </a>
            </ul>
        </div>
    </div>
</div>
<?php } ?>
                               
                                
                               
                                
                                 
  

</div>




</div>



<?php include_once 'footer.php'; ?>

</div>

</div>

</div>

<div class="layout-overlay layout-sidenav-toggle"></div>
</div>


<?php include_once 'footer_script.php'; ?>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>


</body>
</html>
