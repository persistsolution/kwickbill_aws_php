<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Report-New";
$Page = "Expense-Summary-Report";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title>Expense Summary Report - <?php echo $Proj_Title; ?> </title>
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
<h4 class="font-weight-bold py-3 mb-0">Expense Summary Report
  
</h4>

<div class="card" style="padding: 10px;">
    
     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       

  <div class="form-group col-md-4">
<label class="form-label"> Employee<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="UserId" id="UserId" required>
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_POST["UserId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-3">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1">
    <label class="form-label">&nbsp;</label>
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_POST['Search'])) {?>
<div class="form-group col-md-1">
<label class="form-label">&nbsp;</label>
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
               
                  <th>Outlet Name</th>
                <?php 
                    $sql33 = "SELECT * FROM `tbl_expenses_category` WHERE Status=1";
                    $row33 = getList($sql33);
                    foreach($row33 as $result){
                ?>
                <th><?php echo $result['Name'];?></th>
                <?php } ?>
                 <th>Grand Total</th>
                <?php 
                    $sql33 = "SELECT * FROM `tbl_expenses_category` WHERE Status=1";
                    $row33 = getList($sql33);
                    foreach($row33 as $result){
                ?>
                <th>% <?php echo $result['Name'];?></th>
                <?php } ?>
                
               
            </tr>
        </thead>
        <tbody>
          <?php 
                $sql = "SELECT tub.* FROM tbl_users_bill tub INNER JOIN tbl_expense_request te ON te.FrId=tub.id WHERE tub.ShowFrStatus=1 GROUP BY te.FrId";
                $row = getList($sql);
                foreach($row as $result){
          ?>
          <tr>
                <td><?php echo $result['ShopName'];?></td>
                <?php 
                $grandTotal = 0;
                    $sql33 = "SELECT * FROM `tbl_expenses_category` WHERE Status=1";
                    $row33 = getList($sql33);
                    foreach($row33 as $result33){
                        $sql44 = "SELECT SUM(Amount) AS Amount FROM tbl_expense_request WHERE ExpCatId='".$result33['id']."' AND FrId='".$result['id']."'";
                        if($_POST['FromDate']){
                        $FromDate = $_POST['FromDate'];
                        $sql44.= " AND ExpenseDate>='$FromDate'";
                        }
                        if($_POST['ToDate']){
                            $ToDate = $_POST['ToDate'];
                            $sql44.= " AND ExpenseDate<='$ToDate'";
                        }
                        //echo $sql44;
                        $row44 = getRecord($sql44);
                        if($row44['Amount'] == ''){
                            $totamt = 0;
                        }
                        else{
                            $totamt = $row44['Amount'];
                        }

                        $grandTotal+=$totamt;
                ?>
                <td style="text-align: right;"><?php echo $totamt;?></td>
            <?php } ?>
            <td style="text-align: right;"><?php echo $grandTotal;?></td>
            <?php 
                    $grandTotal = 0;
                    $sql33 = "SELECT * FROM `tbl_expenses_category` WHERE Status=1";
                    $row33 = getList($sql33);
                    foreach($row33 as $result33){
                        $sql44 = "SELECT SUM(Amount) AS Amount FROM tbl_expense_request WHERE ExpCatId='".$result33['id']."' AND FrId='".$result['id']."'";
                        if($_POST['FromDate']){
                        $FromDate = $_POST['FromDate'];
                        $sql44.= " AND ExpenseDate>='$FromDate'";
                        }
                        if($_POST['ToDate']){
                            $ToDate = $_POST['ToDate'];
                            $sql44.= " AND ExpenseDate<='$ToDate'";
                        }
                        $row44 = getRecord($sql44);
                        if($row44['Amount'] == ''){
                            $totamt = 0;
                        }
                        else{
                            $totamt = $row44['Amount'];
                        }

                       
                ?>
                <td style="text-align: right;"><?php echo round(($grandTotal-$totamt)/$grandTotal,2);?></td>
            <?php } ?>
          </tr>
            <?php } ?>
        </tbody>
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
         "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ]
    });
});
</script>
</body>
</html>
