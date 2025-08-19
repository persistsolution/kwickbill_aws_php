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


/*$sql = "SELECT Unqid,CatId,ProdId,MainProdId,FrId FROM `tbl_customer_invoice_details_2025` WHERE MainProdId=0";
$row = getList($sql);
foreach($row as $result){
    $Unqid = $result['Unqid'];
    $ProdId = $result['ProdId'];
    $FrId = $result['FrId'];
    
    $sql2 = "SELECT id,ProdId,ProductName,CreatedBy FROM `tbl_cust_products_2025` WHERE id='$ProdId'";
    $row2 = getRecord($sql2);
    $ProdId2 = $row2['ProdId'];
    
    $sql3 = "SELECT id,ProdId,ProductName,CreatedBy FROM `tbl_cust_products_2025` WHERE ProdId='$ProdId2' AND CreatedBy='$FrId'";
    $row3 = getRecord($sql3);
    $id3 = $row3['id'];
    $ProdId3 = $row3['ProdId'];
    //echo $FrId."-".$ProdId."-".$result['MainProdId']."<br>".$row3['CreatedBy']."-".$id3."-".$ProdId3."-".$row3['ProductName']."<br>";
    $sql4 = "UPDATE tbl_customer_invoice_details_2025 SET ProdId='$id3',MainProdId='$ProdId3',upstatus=1 WHERE Unqid='$Unqid'";
    $conn->query($sql4);
    //echo "<hr>";
   
}*/
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
  <!-- swiper CSS -->
 <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
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

    .chart-legend {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 10px;
      font-size: 14px;
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .legend-color {
      width: 12px;
      height: 12px;
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
<?php  $_SESSION['Calendar']=$_POST['calendar'];?>

 <h3>Employee Dashboard</h3>
<div class="row">
<?php 
    $today = date('Y-m-d');
    $sql = "SELECT * FROM tbl_zone WHERE Status=1";
    $row = getList($sql);
    foreach($row as $result){
        $zoneid = $result['id'];
         $sql3 = "SELECT count(*) AS TotFr FROM tbl_users_bill tu WHERE tu.ZoneId = '$zoneid' AND tu.Status=1 AND tu.Roll=5";
    $row3 = getRecord($sql3);
    
   
    
    $sql2 = "SELECT * FROM tbl_attendance ta INNER JOIN tbl_users tu ON tu.id=ta.UserId WHERE ta.CreatedDate='$today' AND ta.Type=1 AND tu.ZoneId='$zoneid'";
    $rncnt2 = getRow($sql2);
    
   $today = date('Y-m-d');

// Total employees (reference)
 $sql4 = "SELECT count(*) AS TotEmp, SUM(tu.MonthlySalary) AS MonthlySalary FROM tbl_users tu WHERE tu.ZoneId = '$zoneid' AND tu.Status=1 AND tu.Roll NOT IN(1,5,55,9,22,23,63,3) AND tu.OtherEmp=0";
    $row4 = getRecord($sql4);


// Today Joining
$sql_today = "SELECT * FROM tbl_users 
              WHERE DATE(JoinDate) = '$today' AND ZoneId = '$zoneid' AND Status = 1 AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$todayCount = getRow($sql_today) ?? 0;

// Below 6 Months (excluding today)
$sql_below6 = "SELECT * FROM tbl_users 
               WHERE JoinDate >= DATE_SUB('$today', INTERVAL 6 MONTH)
               AND JoinDate < '$today'
               AND ZoneId = '$zoneid' AND Status = 1 AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$below6Count = getRow($sql_below6) ?? 0;

// 6 Months to 1 Year
$sql_6to1 = "SELECT * FROM tbl_users 
             WHERE JoinDate < DATE_SUB('$today', INTERVAL 6 MONTH)
             AND JoinDate > DATE_SUB('$today', INTERVAL 1 YEAR)
             AND ZoneId = '$zoneid' AND Status = 1 AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$between6To1Count = getRow($sql_6to1) ?? 0;

// Above 1 Year
$sql_above1 = "SELECT * FROM tbl_users 
               WHERE JoinDate <= DATE_SUB('$today', INTERVAL 1 YEAR)
               AND ZoneId = '$zoneid' AND Status = 1 AND Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0";
$above1Count = getRow($sql_above1) ?? 0;

$sum = $todayCount + $below6Count + $between6To1Count + $above1Count;

$totfr+=$row3['TotFr'];
$totemp+=$row4['TotEmp'];
$totsal+=$row4['MonthlySalary'];
$totpr+=$rncnt2;
$tottodayjoin+=$todayCount;
$totbelow6Count+=$below6Count;
$totbetween6To1Count+=$between6To1Count;
$totabove1Count+=$above1Count;
$totsum+=$sum;

                                          
?>
        <div class="col-lg-4">
                <div class="card mb-2">
                  
                    <div class=" px-0">
                        <ul class="list-group list-group-flush">
                            
                           <a href="emp-sub-zone.php?zoneid=<?php echo $result['id'];?>&name=<?php echo $result['Name'];?>"> 
                            
                             
                            <li class="list-group-item" style="border-radius: 10px;">
                                
                                <div class="row align-items-center">
                                    <div class="col align-self-center pr-0" width="80%">
                                        <h6 class=" mb-1" style="color:black;font-size:14px;font-weight:500;"><?php echo $result['Name'];?></h6>
                                          <span class="small text-secondary" style=""><?php echo $result['Address'];?></span>
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
                            </li>
                            </a>
                        </ul>
                    </div>
              
                </div>
                </div>
                      <?php } ?>         
                                
                           
                            <div class="col-lg-4">
                <div class="card mb-2">
                   <!-- <a href="product-lists.php?catid=<?php echo $result['id'];?>">-->
                    <div class=" px-0">
                        <ul class="list-group list-group-flush">
                            
                          
                             
                            <li class="list-group-item" style="border-radius: 10px;">
                                
                                <div class="row align-items-center">
                                    <div class="col align-self-center pr-0" width="80%">
                                        <h6 class=" mb-1" style="color:black;font-size:14px;font-weight:500;">Total</h6>
                                        
                                          <p class="small " style="text-transform:capitalize;color:black">
                                             
                                               Franchise : <?php echo $totfr;?><br>
                                          Employee : <?php echo $totemp;?> | Salary : <?php echo number_format($totsal,2);?><br>
                                          Today Present : <?php echo $totpr;?> <br>
                                          Today Abscent : <?php echo $totemp-$totpr;?> <br>
                                          Today Joining : <?php echo $tottodayjoin;?><br>
                                          Below 6 Months : <?php echo $totbelow6Count;?><br>
                                          6 Month To 1 Year : <?php echo $totbetween6To1Count;?><br>
                                          Above 1 Year : <?php echo $totabove1Count;?><br>
                                          
                                          Joining Date Not Update : <?php echo  $totemp-$totsum;?> Employee
                                        
                                          </p>
                                     
                                       
                                    </div>
                                   
                                </div>
                            </li>
                            
                        </ul>
                    </div>
              
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
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script>
 const zoneDetails = <?php echo json_encode($dataValues); ?>;
console.log(zoneDetails);

const zoneLabels = zoneDetails.map(z => z.name);
const zoneData = zoneDetails.map(z => z.income);
const zoneColors = ['#42A5F5', '#66BB6A', '#AB47BC', '#FFB74D'];
const total = zoneData.reduce((a, b) => a + b, 0);
const activeOffsets = zoneData.map(() => 0);

// 🟦 Legend showing name + percent
const legendZone = document.getElementById('legendZone');
zoneDetails.forEach((z, i) => {
  const percent = ((z.income / total) * 100).toFixed(1);
  const item = document.createElement('div');
  item.className = 'legend-item';
  item.innerHTML = `
    <span class="legend-color" style="background:${zoneColors[i]}"></span>
    ${z.name} — ${percent}%`;
  legendZone.appendChild(item);
});

// 📊 Doughnut Chart
const ctx = document.getElementById('zoneChart').getContext('2d');
const zoneChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: zoneLabels,
    datasets: [{
      data: zoneData,
      backgroundColor: zoneColors,
      offset: activeOffsets
    }]
  },
  options: {
    cutout: '50%',
    onClick: (e, elements) => {
      if (elements.length > 0) {
        const i = elements[0].index;
        activeOffsets[i] = activeOffsets[i] === 0 ? 20 : 0;
        zoneChart.data.datasets[0].offset = activeOffsets;
        zoneChart.update();

        // 🪟 Modal details
        const z = zoneDetails[i];
        document.getElementById('zoneModalTitle').innerText = z.name + ' Zone';
        document.getElementById('zoneModalBody').innerHTML = `
          <p><strong>Total Income:</strong> ₹ ${z.income.toLocaleString('en-IN')}</p>
          <p><strong>Franchise:</strong> ${z.franchise}</p>
          <p><strong>Employee:</strong> ${z.employees} | <strong>Salary:</strong> ₹ ${z.salary.toLocaleString('en-IN')}</p>
          <p><strong>Total Invoice:</strong> ${z.invoice}</p>
          <p><strong>Cash:</strong> ₹ ${z.cash.toLocaleString('en-IN')}</p>
          <p><strong>UPI:</strong> ₹ ${z.upi.toLocaleString('en-IN')}</p>
          <p><strong>Avg:</strong> ${z.avg}</p>
        `;
        document.getElementById('zoneModal').style.display = 'flex';
      }
    },
    plugins: {
      legend: { display: false },
      tooltip: { enabled: false },
      datalabels: {
        formatter: () => '', // ❌ Don't show labels in chart
        display: false
      }
    }
  },
  plugins: [
    {
      id: 'centerText',
      beforeDraw(chart) {
        const { width, height } = chart;
        const ctx = chart.ctx;
        ctx.restore();
        ctx.font = 'bold 16px Segoe UI';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('Total Income', width / 2, height / 2 - 12);
        ctx.font = 'bold 20px Segoe UI';
        ctx.fillText(`₹ ${total.toLocaleString('en-IN')}`, width / 2, height / 2 + 12);
        ctx.save();
      }
    },
    ChartDataLabels
  ]
});

// 🧼 Close modal on outside click
window.onclick = function(e) {
  const modal = document.getElementById('zoneModal');
  if (e.target === modal) {
    modal.style.display = 'none';
  }
};

</script>
<script type="text/javascript">
function showdate(val){
    if(val == 'custom'){
        $('.customfmdt').show();
        $('.customtodt').show();
    }
    else{
        $('.customfmdt').hide();
        $('.customtodt').hide();
        $('#FromDate').val('');
        $('ToDate').val('');
    }
}
function printReceipt(invdata){
    console.log(invdata);
     //Android.printReceipt(''+invdata+'');
}
    $(document).ready(function() {
    $('#example').DataTable( {
      "lengthMenu": [[5, 10, 15, 20, 25, 50, -1], [5, 10, 15, 20, 25, 50, "All"]]
    } );

} );
</script>
</body>
</html>
