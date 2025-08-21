<?php 
session_start();
include_once '../config.php';
include_once 'auth.php';
$user_id = $_REQUEST['user_id'];
$BillSoftFrId = $_REQUEST['user_id'];
$MainPage = "Customer-Products-2025";
$Page = "View-Cust-Stock-2025";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title>View Stock List</title>
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
  $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$BillSoftFrId',url='$url',action='customer product stock record deleted',invid='$id',createddate='$createddate',roll='customer-product-stock'";
  $conn->query($sql);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-cust-stocks.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Stock List
   
</h4>

<div class="card" style="padding: 10px;">
      <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       

  <div class="form-group col-md-4">
<label class="form-label">Products</label>
 <select class="select2-demo form-control" name="ProdId" id="ProdId">
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_cust_products_2025 WHERE Status='1' AND CreatedBy='$BillSoftFrId' AND ProdType=0 AND delete_flag=0 AND checkstatus=1";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_REQUEST["ProdId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['ProductName']; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>



<div class="form-group col-md-2">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-2">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top:20px;">
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_POST['Search'])) {?>
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
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>#</th>
               <th>Product Id</th>
                <th>Product Name</th>
                <th>Date</th>
                <th>Stock In Qty</th>
              
              
              
            
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT ts.*,p.ProductName FROM tbl_cust_prod_stock_2025 ts 
                    INNER JOIN tbl_cust_products_2025 p ON ts.ProdId=p.id WHERE ts.FrId='$BillSoftFrId' AND ts.Status='Cr' AND ts.ProdType=0";
            if($_POST['ProdId']){
                $ProdId = $_POST['ProdId'];
                if($ProdId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND ts.ProdId='$ProdId'";
                }
            }
            if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND ts.StockDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND ts.StockDate<='$ToDate'";
            }
            $sql.=" ORDER BY ts.id DESC";    
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               
             ?>
            <tr>
               <td><?php echo $i; ?></td>
                <td><?php echo $row['ProdId']; ?></td>
               <td><?php echo $row['ProductName']; ?></td>
              
               <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['StockDate']))); ?></td>
               <td><?php echo $row['Qty']; ?></td>
             
              
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
        "scrollX": true
    });
});
</script>
</body>
</html>
