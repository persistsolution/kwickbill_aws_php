<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "BDM-Vendor-Expenses";
$Page = "BDM-Vendor-Peding-Expense-Request";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> </title>
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
<h4 class="font-weight-bold py-3 mb-0">Expense Product List
  
</h4>

<div class="card" style="padding: 10px;">
    
   
<div class="card-datatable table-responsive">
    
   <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Expense Id</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Purchase Price (Per Qty)</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $grandTotal = 0;

        $sql = "SELECT tve.*, tcp.ProductName 
                FROM tbl_emp_expense_prod_items tve 
                INNER JOIN tbl_cust_products2 tcp ON tcp.id = tve.MainProdId 
                WHERE tve.ExpId = '".$_GET['expid']."' AND tve.ExpItemId = '".$_GET['expitemid']."'"; 
        
        $row = getList($sql);
        foreach ($row as $result) {
            $total = $result['Qty2'] * $result['PurchasePrice'];
            $grandTotal += $total;
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $result['ExpId']; ?></td>
            <td><?php echo $result['ProductName']; ?></td>
            <td><?php echo $result['Qty2'] . " " . $result['Unit2']; ?></td>
            <td><?php echo $result['PurchasePrice']; ?></td>
            <td><?php echo round($total); ?></td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: right;"><strong>Grand Total:</strong></td>
            <td><strong><?php echo round($grandTotal); ?></strong></td>
        </tr>
    </tfoot>
</table>

    

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
        order: [[0, 'desc']]
    });
    
   
});
</script>
</body>
</html>
