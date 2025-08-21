<?php 
session_start();
include_once '../config.php';
include_once 'auth.php';
$user_id = $_REQUEST['user_id'];
$BillSoftFrId = $_REQUEST['user_id'];
$MainPage = "View-Credit-Account";
$Page = "View-Credit-Account";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title>View Credit Account</title>
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
  $sql11 = "DELETE FROM tbl_cust_general_ledger WHERE id = '$id'";
  $conn->query($sql11);
  
  $url = $_SERVER['REQUEST_URI'];
  $createddate = date('Y-m-d H:i:s');
  $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$BillSoftFrId',url='$url',action='credit record deleted',invid='$id',createddate='$createddate',roll='cashbook'";
  $conn->query($sql);
  
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-manage-credit-accounts.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Payment Credit Account List
    
</h4>

<div class="card" style="padding: 10px;">
      <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       


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
                <th>Action</th>
                 <th>Voucher No</th>
                 
                 <th>Payment Date</th>
                
                <th>Customer Name</th>
              
                <th>Amount</th>
                
                <th>Payment Mode</th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT td.*,tu2.Fname AS CustName FROM tbl_cust_general_ledger td 
            INNER JOIN tbl_users tu2 ON tu2.id=td.UserId WHERE td.Type='PR' AND td.FrId='$BillSoftFrId'";
                  
             
              
            
            if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND td.PaymentDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND td.PaymentDate<='$ToDate'";
            }
            $sql.= " ORDER BY td.id DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                
            ?>
            <tr style="<?php echo $bcolor;?>">
               
              <td><?php echo $i;?></td>
              <td> 
                   <a href="add-credit-account.php?id=<?php echo $row['id']; ?>" ><i class="lnr lnr-pencil mr-2"></i></a>&nbsp;&nbsp;

<a onClick="return confirm('Are you sure you want delete this record');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['id']; ?>&action=delete"><i class="lnr lnr-trash text-danger"></i></a>
            
               </td>
               <td><?php echo $row['Code']; ?></td>
              
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['PaymentDate']))); ?></td>
           
                  <td><?php echo $row['CustName']; ?></td>
            
        <td>₹<?php echo number_format($row['Amount'],2); ?></td>
    
                 <td><?php echo $row['PayMode']; ?></td>
               
               
            </tr>
           <?php $i++;} ?>
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
