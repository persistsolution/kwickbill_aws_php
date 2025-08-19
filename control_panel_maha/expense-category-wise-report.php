<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "HO-Admin-Expenses";
$Page = "HO-Admin-Approve-Expense-Request";
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



<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_expense_request WHERE id = '$id'";
  $conn->query($sql11);
  $sql = "DELETE FROM wallet WHERE ExpId='$id'";
  $conn->query($sql);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="expense-request.php";
    </script>
<?php } 

?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Expenses Catgeory Wise Report
  
</h4>

<div class="card" style="padding: 10px;">
     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                 <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

 <div class="form-group col-md-4">
                                                    <label class="form-label">Employee</label>
                                                    <select class="select2-demo form-control" name="UserId">
                                                        <option selected="" value="all">All</option>


                                                        <?php
                                                        $sql33 = "SELECT * FROM `tbl_users` WHERE Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0 AND Status=1";
                                                        $row33 = getList($sql33);
                                                        foreach ($row33 as $result) {
                                                        ?>
                                                            <option value="<?php echo $result['id']; ?>" <?php if ($_POST["UserId"] == $result['id']) { ?> selected <?php } ?>>
                                                                <?php echo $result['Fname']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                
 <div class="form-group col-md-4">
                                                    <label class="form-label">Expense Category</label>
                                                    <select class="select2-demo form-control" name="ExpCatId">
                                                        <option selected="" value="all">All</option>


                                                        <?php
                                                        $sql33 = "SELECT * FROM `tbl_expenses_category` WHERE Status=1";
                                                        $row33 = getList($sql33);
                                                        foreach ($row33 as $result) {
                                                        ?>
                                                            <option value="<?php echo $result['id']; ?>" <?php if ($_POST["ExpCatId"] == $result['id']) { ?> selected <?php } ?>>
                                                                <?php echo $result['Name']; ?></option>
                                                        <?php } ?>
                                                    </select>

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
<div class="form-group col-md-1" style="padding-top: 30px;">
    <label class="form-label">&nbsp;</label>
<button type="submit" class="btn btn-primary btn-finish">Search</button>
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
   <?php if(isset($_POST['Search'])) {?>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Expense Id</th>
                
                   <th>Expense Date</th>
              
                <th>Employee Name</th>
                <th>Franchsie Name</th>
               <th>Category</th>
                 
                <th>Amount</th>
              <th>PaymentMode</th>
               <th>Vendor Mobile No</th>
    <th>Narration</th>
    <th>GST</th>
    <th>Receipt</th>
    <th>Payment Receipt</th>
    <th>PDF</th>
    <th>Product Image</th>
           
               
               
                
               
            </tr>
        </thead>
        <tbody>
           <?php 
$ExpCatId = $_POST['ExpCatId'];
$UserId   = $_POST['UserId'];

$sql = "SELECT tei.*,tu.Fname,tu.Lname,tec.Name As ExpCatName,tub.ShopName FROM tbl_expense_request_items tei 
                        INNER JOIN tbl_expense_request te ON tei.ExpId=te.id 
                        INNER JOIN tbl_users tu ON tu.id=te.UserId 
                        LEFT JOIN tbl_expenses_category tec ON tec.id=tei.ExpCatId 
                        LEFT JOIN tbl_users_bill tub ON tub.id=tei.FrId WHERE te.AdminStatus=1 
          ";

if (!empty($ExpCatId) && $ExpCatId !== 'all') {
    $sql .= " AND tei.ExpCatId = '$ExpCatId'";
}

if (!empty($UserId) && $UserId !== 'all') {
    $sql .= " AND te.UserId = '$UserId'";
}

if (!empty($_POST['FromDate'])) {
    $FromDate = $_POST['FromDate'];
    $sql .= " AND tei.ExpenseDate >= '$FromDate'";
}

if (!empty($_POST['ToDate'])) {
    $ToDate = $_POST['ToDate'];
    $sql .= " AND tei.ExpenseDate <= '$ToDate'";
}

$sql .= " ORDER BY tei.ExpenseDate DESC";
//echo $sql;
$res = $conn->query($sql);

if ($res && $res->num_rows > 0) { 
    while ($row = $res->fetch_assoc()) {
        $mgrdate     = !empty($row['ApproveDate']) ? date("d/m/Y", strtotime($row['ApproveDate'])) : '';
        $accountdate = !empty($row['AdminApproveDate']) ? date("d/m/Y", strtotime($row['AdminApproveDate'])) : '';
        $MgrName     = $row['MgrName'];
        $AccName     = $row['AccName'];
?>
        <tr>
            <td><?= $row['ExpId']; ?></td>
            <td><?= date("d/m/Y", strtotime($row['ExpenseDate'])); ?></td>
            <td><?= $row['Fname']." ".$row['Lname']; ?></td>
            <td><?= $row['ShopName']; ?></td>
            <td><?= $row['ExpCatName']; ?></td>
            <td><?= $row['Amount']; ?></td>
            <td><?= $row['PaymentMode']; ?></td>
            <td><?= $row['VedPhone']; ?></td>
            <td><?= nl2br($row['Narration']); ?></td>
            <td><?= $row['Gst']; ?></td>

            <td>
                <?php if (empty($row["Photo"])) { ?>
                    <span style="color:red;">No Receipt Found</span>
                <?php } elseif (file_exists('../uploads/'.$row["Photo"])) { ?>
                    <a href="../uploads/<?= $row["Photo"]; ?>" target="_blank">View Receipt</a>
                <?php } else { ?>
                    <span style="color:red;">No Receipt Found</span>
                <?php } ?>
            </td>

            <td>
                <?php if (empty($row["Photo2"])) { ?>
                    <span style="color:red;">No Receipt Found</span>
                <?php } elseif (file_exists('../uploads/'.$row["Photo2"])) { ?>
                    <a href="../uploads/<?= $row["Photo2"]; ?>" target="_blank">View Receipt</a>
                <?php } else { ?>
                    <span style="color:red;">No Receipt Found</span>
                <?php } ?>
            </td>

            <td>
                <?php if (empty($row["Photo3"])) { ?>
                    <span style="color:red;">No File Found</span>
                <?php } elseif (file_exists('../uploads/'.$row["Photo3"])) { ?>
                    <a href="../uploads/<?= $row["Photo3"]; ?>" target="_blank">View File</a>
                <?php } else { ?>
                    <span style="color:red;">No File Found</span>
                <?php } ?>
            </td>

            <td>
                <?php if (empty($row["Photo4"])) { ?>
                    <span style="color:red;">No Image Found</span>
                <?php } elseif (file_exists('../uploads/'.$row["Photo4"])) { ?>
                    <a href="../uploads/<?= $row["Photo4"]; ?>" target="_blank">View Image</a>
                <?php } else { ?>
                    <span style="color:red;">No Image Found</span>
                <?php } ?>
            </td>
        </tr>
<?php 
    }
} ?>

           
           <?php 


$ExpCatId = $_POST['ExpCatId'] ?? '';
$UserId   = $_POST['UserId'] ?? '';
$FromDate = $_POST['FromDate'] ?? '';
$ToDate   = $_POST['ToDate'] ?? '';

// Base query
$sql = "SELECT te.*, tu.Fname, tu.Lname, tec.Name AS ExpCatName, tub.ShopName 
        FROM tbl_expense_request te
        INNER JOIN tbl_users tu ON tu.id = te.UserId
        LEFT JOIN tbl_expenses_category tec ON tec.id = te.ExpCatId
        LEFT JOIN tbl_users_bill tub ON tub.id = te.FrId
        WHERE te.AdminStatus = 1 ";

// Filters
if (!empty($ExpCatId) && $ExpCatId !== 'all') {
    $sql .= " AND te.ExpCatId = '". $conn->real_escape_string($ExpCatId) ."'";
}

if (!empty($UserId) && $UserId !== 'all') {
    $sql .= " AND te.UserId = '". $conn->real_escape_string($UserId) ."'";
}

if (!empty($FromDate)) {
    $sql .= " AND te.ExpenseDate >= '". $conn->real_escape_string($FromDate) ."'";
}

if (!empty($ToDate)) {
    $sql .= " AND te.ExpenseDate <= '". $conn->real_escape_string($ToDate) ."'";
}

$sql .= " ORDER BY te.ExpenseDate DESC";

$res = $conn->query($sql);

if ($res && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        // Check if there are items for this expense
        $sql2 = "SELECT COUNT(*) AS cnt FROM tbl_expense_request_items WHERE ExpId = '".$conn->real_escape_string($row['id'])."'";
        $rncnt2 = $conn->query($sql2)->fetch_assoc()['cnt'];

        if ($rncnt2 == 0) {
            $mgrdate = !empty($row['ApproveDate']) ? date("d/m/Y", strtotime($row['ApproveDate'])) : '';
            $accountdate = !empty($row['AdminApproveDate']) ? date("d/m/Y", strtotime($row['AdminApproveDate'])) : '';
            $MgrName = $row['MgrName'] ?? '';
            $AccName = $row['AccName'] ?? '';
            //echo $row['id'];
            ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= date("d/m/Y", strtotime($row['ExpenseDate'])); ?></td>
                <td><?= $row['Fname']." ".$row['Lname']; ?></td>
                <td><?= $row['ShopName']; ?></td>
                <td><?= $row['ExpCatName']; ?></td>
                <td><?= $row['Amount']; ?></td>
                <td><?= $row['PaymentMode']; ?></td>
                <td><?= $row['VedPhone']; ?></td>
                <td><?= nl2br($row['Narration']); ?></td>
                <td><?= $row['Gst']; ?></td>
                
                <td>
                    <?php if (empty($row["Photo"])) { ?>
                        <span style="color:red;">No Receipt Found</span>
                    <?php } elseif (file_exists('../uploads/'.$row["Photo"])) { ?>
                        <a href="../uploads/<?= $row["Photo"]; ?>" target="_blank">View Receipt</a>
                    <?php } else { ?>
                        <span style="color:red;">No Receipt Found</span>
                    <?php } ?>
                </td>
                
                <td>
                    <?php if (empty($row["Photo2"])) { ?>
                        <span style="color:red;">No Receipt Found</span>
                    <?php } elseif (file_exists('../uploads/'.$row["Photo2"])) { ?>
                        <a href="../uploads/<?= $row["Photo2"]; ?>" target="_blank">View Receipt</a>
                    <?php } else { ?>
                        <span style="color:red;">No Receipt Found</span>
                    <?php } ?>
                </td>

                <td>
                    <?php if (empty($row["Photo3"])) { ?>
                        <span style="color:red;">No File Found</span>
                    <?php } elseif (file_exists('../uploads/'.$row["Photo3"])) { ?>
                        <a href="../uploads/<?= $row["Photo3"]; ?>" target="_blank">View File</a>
                    <?php } else { ?>
                        <span style="color:red;">No File Found</span>
                    <?php } ?>
                </td>

                <td>
                    <?php if (empty($row["Photo4"])) { ?>
                        <span style="color:red;">No Image Found</span>
                    <?php } elseif (file_exists('../uploads/'.$row["Photo4"])) { ?>
                        <a href="../uploads/<?= $row["Photo4"]; ?>" target="_blank">View Image</a>
                    <?php } else { ?>
                        <span style="color:red;">No Image Found</span>
                    <?php } ?>
                </td>
            </tr>
        <?php 
        }
    }
}  ?>

        </tbody>
    </table>
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

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
         order: [[0, 'desc']],
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
