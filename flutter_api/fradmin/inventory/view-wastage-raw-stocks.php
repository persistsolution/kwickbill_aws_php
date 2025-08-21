<?php 
session_start();
include_once '../config.php';
include_once 'auth.php';
$user_id = $_REQUEST['user_id'];
$BillSoftFrId = $_REQUEST['user_id'];
$MainPage = "Raw-Products-2025";
$Page = "Manage-Raw-Stocks-2025";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title>View wastage Raw Stock</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once '../header_script.php'; ?>
</head>
<body>

 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

<?php //include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">



<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_cust_prod_stock_2025 WHERE id = '$id'";
  $conn->query($sql11);
  
  $url = $_SERVER['REQUEST_URI'];
   $createddate = date('Y-m-d H:i:s');
   $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$BillSoftFrId',url='$url',action='raw product stock deleted',invid='$id',createddate='$createddate',roll='raw-product-stock'";
  $conn->query($sql);
  
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-fr-raw-stock-2025.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Wastage Raw Product Stock List
   
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
               <th>Sr No</th>
                <th>Product Name</th> 
                
                 <th>Stock Date</th>
                
              <th>Stock In Qty</th> 
             
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT ts.StockDate,ts.Qty2,ts.Unit2,ts.id, p.ProductName,ts.PurchasePrice,ts.SellPrice 
                          FROM tbl_cust_prod_stock_2025 ts 
                          INNER JOIN tbl_cust_products2 p ON ts.ProdId = p.id 
                          WHERE ts.FrId = '$BillSoftFrId' 
                          AND ts.Status = 'Dr' 
                          AND ts.ProdType = '1' 
                          AND p.delete_flag = 0 AND ts.Wastage=1";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               
             ?>
            <tr>
               <td><?php echo $row['id']; ?> </td>
              
                  <td><?php echo $row['ProductName']; ?></td>
                    <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['StockDate']))); ?></td>
                     
                   <td><?php echo $row['Qty2']." ".$row['Unit2']; ?></td>
     
             
           
              
            </tr>
           <?php $i++;} ?>
        </tbody>
    </table>
</div>
</div>
</div>


<?php //include_once 'footer.php'; ?>

</div>

</div>

</div>

<div class="layout-overlay layout-sidenav-toggle"></div>
</div>


<?php include_once '../footer_script.php'; ?>

<script type="text/javascript">
 
    $(document).ready(function() {
    $('#example').DataTable({
        order: [[0, 'desc']]
    });
});
</script>
</body>
</html>
