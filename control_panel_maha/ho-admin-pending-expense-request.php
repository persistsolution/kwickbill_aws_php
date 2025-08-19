<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "HO-Admin-Expenses";
$Page = "HO-Admin-Peding-Expense-Request";
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
<h4 class="font-weight-bold py-3 mb-0">Admin Pending Expense Request
  
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Expense Id</th>
            <th>Manager Status</th>
            <!--<th>Account Status</th>-->
            <th>Admin Status</th>
            <th>Expense Date</th>
            <th>Photo</th>
            <th>Employee Name</th>
            <th>Amount</th>
            <th>Narration</th>
        </tr>
    </thead>
    <tbody>
        <?php 
      /* $sql = "SELECT te.*, 
       tu.Fname, 
       tu.Lname, 
       tu.Photo AS Uphoto, 
       tu2.Fname AS MgrName, 
       tu3.Fname AS AccName, 
       tu4.Fname AS AccountName
FROM tbl_expense_request te
INNER JOIN tbl_users tu ON tu.id = te.UserId
LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy
LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy
LEFT JOIN tbl_users tu4 ON tu4.id = te.AccountBy
WHERE te.AdminStatus = 0 
  AND (
        (te.ManagerStatus = 1 AND te.Gst = 'No' AND te.UserId NOT IN (0,57,2003,475,1359)) 
     OR (te.ManagerStatus = 1 AND te.AccountStatus = 1 AND te.Gst = 'Yes' AND te.UserId NOT IN (0,57,2003,475,1359)) 
     OR (te.Gst = 'No' AND te.UserId IN (57,2003,475,1359)) 
     OR (te.Gst = 'No' AND te.UserId NOT IN (57,2003,475,1359) AND tu.UnderByUser = 5)
      )
GROUP BY te.id
ORDER BY te.CreatedDate DESC";*/
/* $sql = "SELECT te.*, 
       tu.Fname, 
       tu.Lname, 
       tu.UnderByUser,
       tu.Photo AS Uphoto, 
       tu2.Fname AS MgrName, 
       tu3.Fname AS AccName, 
       tu4.Fname AS AccountName
FROM tbl_expense_request te
INNER JOIN tbl_users tu ON tu.id = te.UserId
LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy
LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy
LEFT JOIN tbl_users tu4 ON tu4.id = te.AccountBy
WHERE te.UserId != 0 AND te.SendToApproval = 'Yes' AND
(
    (te.AdminStatus = 0 AND tu.UnderByUser NOT IN (5,384,415) 
     AND (
        (te.ManagerStatus = 1 AND te.Gst = 'No') 
        OR (te.ManagerStatus = 1 AND te.AccountStatus = 1 AND te.Gst = 'Yes')
     )
    )
    OR
    (te.AdminStatus = 0 AND te.AccountStatus = 1 AND tu.UnderByUser IN (5,384,415))
)
GROUP BY te.id
ORDER BY te.CreatedDate DESC";*/

 $sql = "SELECT te.*, 
       tu.Fname, 
       tu.Lname, 
       tu.UnderByUser,
       tu.Photo AS Uphoto, 
       tu2.Fname AS MgrName, 
       tu3.Fname AS AccName, 
       tu4.Fname AS AccountName
FROM tbl_expense_request te
INNER JOIN tbl_users tu ON tu.id = te.UserId
LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy
LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy
LEFT JOIN tbl_users tu4 ON tu4.id = te.AccountBy
WHERE te.UserId != 0 AND te.SendToApproval = 'Yes' AND
(
    (te.AdminStatus = 0 AND tu.UnderByUser NOT IN (5,384,415) 
     AND (
        (te.ManagerStatus = 1)
     )
    )
    OR
    (te.AdminStatus = 0 AND tu.UnderByUser IN (5,384,415))
)
GROUP BY te.id
ORDER BY te.CreatedDate DESC";
$result = getList($sql);
        foreach ($result as $row) {
          
                // Dates
                $mgrDate = !empty($row['ApproveDate']) ? date("d/m/Y", strtotime($row['ApproveDate'])) : '';
                $accDate = !empty($row['AccountApproveDate']) ? date("d/m/Y", strtotime($row['AccountApproveDate'])) : '';
                $adminDate = !empty($row['AdminApproveDate']) ? date("d/m/Y", strtotime($row['AdminApproveDate'])) : '';

                // Names
                $mgrName = $row['MgrName'] ?? '';
                $accName = $row['AccName'] ?? '';
                $accountName = $row['AccountName'] ?? '';

 $UnderByUser = $row['UnderByUser'];
                    
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>

                    <!-- Manager Status -->
                     <?php if (in_array($UnderByUser, [5, 384, 415])) { ?>
               <td style="color:red;">No manager assigned</td>
                    <?php } else {?>
                    <td>
                        <?php
                        if ($row['ManagerStatus'] == 1) {
                            echo "<span style='color:green;'>Approved<br>By $mgrName | $mgrDate</span>";
                        } elseif ($row['ManagerStatus'] == 2) {
                            echo "<span style='color:red;'>Rejected<br>By $mgrName | $mgrDate</span>";
                        } else {
                            echo "<span style='color:orange;'>Pending By Manager</span>";
                        }
                        ?>
                    </td>
                    <?php } ?>

                    <!-- Account Status -->
                    <!--<?php if($row['Gst'] == 'Yes'){?>
                    <td>
                        <?php
                        if ($row['AccountStatus'] == 1) {
                            echo "<span style='color:green;'>Approved<br>By $accountName | $accDate</span>";
                        } elseif ($row['AccountStatus'] == 2) {
                            echo "<span style='color:red;'>Rejected<br>By $accountName | $accDate</span>";
                        } else {
                            echo "<span style='color:orange;'>Pending By Accountant</span>";
                        }
                        ?>
                    </td>
                    <?php } else {?>
                        <td>NA</td>
                    <?php } ?>-->

                    <!-- Admin Status -->
                    <td>
                        <a href="approve-expense-by-account.php?id=<?= $row['id'] ?>&page=ho">
                            <?php
                            if ($row['AdminStatus'] == 1) {
                                echo "<span style='color:green;'>Approved<br>By $accName | $adminDate</span>";
                            } elseif ($row['AdminStatus'] == 2) {
                                echo "<span style='color:red;'>Rejected<br>By $accName | $adminDate</span>";
                            } else {
                                echo "<span style='color:orange;'>Pending By Admin</span>";
                            }
                            ?>
                        </a>
                    </td>

                    <td><?= date("d/m/Y", strtotime($row['ExpenseDate'])) ?></td>

                    <td>
                        <?php 
                        $photoPath = '../uploads/' . $row["Uphoto"];
                        if (!empty($row["Uphoto"]) && file_exists($photoPath)) {
                            echo "<img src='$photoPath' class='d-block ui-w-40 rounded-circle' style='width:40px;height:40px;'>";
                        } else {
                            echo "<img src='user_icon.jpg' class='d-block ui-w-40 rounded-circle' style='width:40px;height:40px;'>";
                        }
                        ?>
                    </td>

                    <td><?= $row['Fname'] . ' ' . $row['Lname'] ?></td>
                    <td><?= $row['Amount'] ?></td>
                    <td><?= $row['Narration'] ?></td>
                </tr>
                <?php
            
        }
        ?>
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
         order: [[0, 'desc']]
    });
});
</script>
</body>
</html>
