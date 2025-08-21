<?php 
session_start();
include_once '../config.php';
include_once 'auth.php';
$user_id = $_REQUEST['user_id'];
$BillSoftFrId = $_REQUEST['user_id'];
$MainPage = "Report-2025";
$Page = "Sell-Product-Report";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title>Sell By Product Report </title>
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



<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Product Wise Sell Report</h4>
<br>

<div class="card">
<div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding: 5px;padding-left: 20px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">



<div class="form-group col-md-3">
<label class="form-label"> Product<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="ProdId" id="ProdId" required>
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_cust_products_2025 WHERE CreatedBy IN ($BillSoftFrId) AND ProdType=0 AND checkstatus=1 AND delete_flag=0";
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
<label class="form-label"> Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_REQUEST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-2">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_REQUEST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top:20px;">
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<!--<div class="col-md-1">
<label class="form-label d-none d-md-block">&nbsp;</label>
<button type="button" id="print" class="btn btn-success btn-finish" onClick=printReport('<?php echo $invoice_data;?>')>Print</button>
</div>-->
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
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>#</th>
               <th>Date</th>
               <th>Product</th> 
               
                <th>Total Sell</th>
                <th>Purchase Amount</th>
                <th>Sell Amount</th>
                <th>Profit Amount</th>
              
   
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
                $fromdate = $_REQUEST['FromDate'];
                $todate = $_REQUEST['ToDate'];
                $sql = "SELECT tc.ProdId,tc.CreatedDate,tp.ProductName,tp.PurchasePrice FROM tbl_customer_invoice_details_2025 tc INNER JOIN tbl_cust_products_2025 tp ON tp.id=tc.ProdId WHERE tc.FrId='$BillSoftFrId' AND tc.CreatedDate>='$fromdate' AND tc.CreatedDate<='$todate'";
                if($_REQUEST['ProdId']){
                $ProdId = $_REQUEST['ProdId'];
                if($ProdId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tc.ProdId='$ProdId'";
                }
            }
                $sql.=" GROUP BY tc.CreatedDate,tc.ProdId";
                //echo $sql;
                $row = getList($sql);
                foreach($row as $result){
                    
                    $sql2 = "SELECT SUM(tcid.Total) AS Total,SUM(tcid.Qty) AS TotProd FROM tbl_customer_invoice_details_2025 tcid 
                             INNER JOIN tbl_customer_invoice_2025 tci ON tci.id=tcid.InvId WHERE tcid.ProdId='".$result['ProdId']."' 
                             AND tci.Roll=2 AND tci.FrId='$BillSoftFrId' AND tci.InvoiceDate='".$result['CreatedDate']."'";
                    $row2 = getRecord($sql2);
            ?>
            <tr>
               <td><?php echo $i; ?> </td>
            
              
                <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$result['CreatedDate']))); ?></td>
                
                  <td><?php echo $result['ProductName']; ?></td>
              
                    <td><?php echo $row2['TotProd']; ?></td>
                    <td>&#8377;<?php echo number_format($result['PurchasePrice']*$row2['TotProd'],2); ?></td>
                <td>&#8377;<?php echo number_format($row2['Total'],2); ?></td>
                <td>&#8377;<?php echo number_format($row2['Total']-($result['PurchasePrice']*$row2['TotProd']),2); ?></td>
          
        
              
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
   function printReport(invdata){
     console.log(invdata);
      Android.printReport(''+invdata+'');
 }
	$(document).ready(function() {
    $('#example').DataTable({
        "pageLength":100,
      "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ]
    });

    $(document).on("change", "#CustId", function(event) {
                var val = this.value;
                var action = "getInvoiceNos";
                $.ajax({
                    url: "../ajax_files/ajax_dropdown.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: val
                    },
                    success: function(data) {
                        $('#InvNo').html(data);
                       
                    }
                });

            });
});
</script>
</body>
</html>
