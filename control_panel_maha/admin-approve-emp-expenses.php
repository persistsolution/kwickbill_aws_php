<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Pretty-Cash-Ho";
$Page = "Ho-Pending-Pretty-Cash-Request";
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
<h4 class="font-weight-bold py-3 mb-0">All Approve Employee Expenses
  
</h4>

<div class="card" style="padding: 10px;">
     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

 
<div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off" required>
</div>
<div class="form-group col-md-3">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off" required>
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
   
   <?php

if(isset($_POST['submit'])){

$ApproveDate = $_POST['ApproveDate'];
if (!empty($_POST['selected_ids_combined'])) {
        $ids = explode(",", $_POST['selected_ids_combined']);
        foreach ($ids as $QtnId2) {
            $QtnId2 = intval($QtnId2);
            $sql = "UPDATE tbl_expense_request SET FinalAccountStatus='1',FinalAccountApproveDate='$ApproveDate',FinalAccountBy='$user_id' WHERE id='$QtnId2'";
                $conn->query($sql);
        }

        echo "<script>alert('Expense Approved successfully'); window.location.href='admin-approve-emp-expenses.php';</script>";
        exit;
    } else {
        echo "<script>alert('No Expenses selected!'); history.back();</script>";
        exit;
    }
    
}
?>
  <?php if (isset($_POST['Search'])) { ?>
<form id="validation-form" method="post" enctype="multipart/form-data" action="">
    <input type="hidden" name="selected_ids_combined" id="selected_ids_combined" />

    <div class="card-datatable table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Revoke</th>
                    <th>Expense Id</th>
                    <th>Manager Approve</th>
                    <th>Admin Approve</th>
                    <th>Expense Date</th>
                    <th>Employee Name</th>
                    <th>Amount</th>
                    <th>Narration</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT te.*, tu.Fname, tu.Lname, tu.Photo AS Uphoto, 
                               tu2.Fname AS MgrName, tu3.Fname AS AccName, 
                               tec.Name AS ExpCatName, tub.ShopName, 
                               tl.Name AS ExpLocation 
                        FROM tbl_expense_request te 
                        INNER JOIN tbl_users tu ON tu.id = te.UserId 
                        LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy 
                        LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy 
                        LEFT JOIN tbl_expenses_category tec ON tec.id = te.ExpCatId 
                        LEFT JOIN tbl_users_bill tub ON tub.id = te.FrId 
                        LEFT JOIN tbl_locations tl ON tl.id = te.Locations 
                        WHERE te.AdminStatus = 1 
                          AND te.UserId != 0 
                          AND te.ExpenseDate >= '2025-04-01' AND te.FinalAccountStatus=0";

                if (!empty($_POST['FromDate'])) {
                    $FromDate = $_POST['FromDate'];
                    $sql .= " AND te.ExpenseDate >= '$FromDate'";
                }
                if (!empty($_POST['ToDate'])) {
                    $ToDate = $_POST['ToDate'];
                    $sql .= " AND te.ExpenseDate <= '$ToDate'";
                }

                $sql .= " ORDER BY te.CreatedDate DESC";
                $res = $conn->query($sql);

                while ($row = $res->fetch_assoc()) {
                    $mgrdate = !empty($row['ApproveDate']) ? date("d/m/Y", strtotime($row['ApproveDate'])) : '';
                    $accountdate = !empty($row['AdminApproveDate']) ? date("d/m/Y", strtotime($row['AdminApproveDate'])) : '';
                    $MgrName = $row['MgrName'] ?? '';
                    $AccName = $row['AccName'] ?? '';
                ?>
                <tr>
                    <td>
                        <input type="checkbox" class="rowCheckbox" data-id="<?php echo $row['id']; ?>" />
                        <input type="hidden" value="0" name="CheckId2[]" id="CheckId2<?php echo $row['id']; ?>">
                    </td>
                    <td>
                        <a href="revoke-emp-expenses.php?id=<?php echo $row['id']; ?>" class="badge badge-pill badge-danger" target="_blank">Revoke</a>
                    </td>
                    <td>
                        <a href="employee-expense-details.php?id=<?php echo $row['id']; ?>" target="_blank">
                            <?php echo $row['id']; ?>
                        </a>
                    </td>
                    <td>
                        <?php 
                        if ($row['ManagerStatus'] == '1') {
                            echo "<span style='color:green;font-weight:bold;'>Approved<br>By $MgrName | $mgrdate</span>";
                        } elseif ($row['ManagerStatus'] == '2') {
                            echo "<span style='color:red;font-weight:bold;'>Rejected<br>By $MgrName | $mgrdate</span>";
                        } else {
                            echo "<span style='color:orange;font-weight:bold;'>Pending By Manager</span>";
                        }
                        ?>
                    </td>
                    <td id="showstatus<?php echo $row['id']; ?>">
                        <?php 
                        if ($row['AdminStatus'] == '1') {
                            echo "<span style='color:green;font-weight:bold;'>Approved<br>By $AccName | $accountdate</span>";
                        } elseif ($row['AdminStatus'] == '2') {
                            echo "<span style='color:red;font-weight:bold;'>Rejected<br>By $AccName | $accountdate</span>";
                        } else {
                            echo "Approve By Admin<br>";
                        }
                        ?>
                    </td>
                    <td><?php echo date("d/m/Y", strtotime($row['ExpenseDate'])); ?></td>
                    <td><?php echo $row['Fname'] . " " . $row['Lname']; ?></td>
                    <td><?php echo number_format($row['Amount'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['Narration']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="form-row mt-3">
        <div class="form-group col-md-3">
            <label class="form-label">Approve Date</label>
            <input type="date" name="ApproveDate" id="ApproveDate" class="form-control" 
                   value="<?php echo $_POST['ApproveDate'] ?? date('Y-m-d'); ?>" required readonly>
        </div>

        <div class="form-group col-md-1" style="padding-top: 20px;">
            <button type="submit" name="submit" class="btn btn-primary btn-finish">Submit</button>
        </div>
    </div>
</form>
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
    var selectedIds = {};

    function updateHiddenField() {
        const hiddenInput = document.getElementById("selected_ids_combined");
        hiddenInput.value = Object.keys(selectedIds).join(",");
    }

    function toggleCheckbox(checkbox) {
        const id = checkbox.getAttribute("data-id");
        if (checkbox.checked) {
            selectedIds[id] = true;
        } else {
            delete selectedIds[id];
        }
        updateHiddenField();
    }

    $(document).ready(function () {
        var table = $('#example').DataTable({
            order: [[0, 'asc']]
        });

        // Checkbox click event
        $(document).on('change', '.rowCheckbox', function () {
            toggleCheckbox(this);
        });

        // Restore checked state on redraw (pagination/search)
        table.on('draw', function () {
            $('.rowCheckbox').each(function () {
                const id = this.getAttribute("data-id");
                this.checked = !!selectedIds[id];
            });
            updateHiddenField();
        });
    });
</script>
</body>
</html>
