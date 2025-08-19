<?php 
// Batch fetch approved expenses where ManagerStatus = 1 and AdminStatus = 0
$sql3 = "SELECT te.UserId, tu.UnderByUser 
         FROM tbl_expense_request te 
         INNER JOIN tbl_users tu ON tu.id = te.UserId
         WHERE te.ManagerStatus = '1' 
         AND te.AdminStatus = '0' 
         AND te.UserId != 0 
         AND te.ExpCatId != 3 
         AND te.UserId != '".$row['id']."' 
         ORDER BY te.ExpenseDate DESC";

$approvedExpenses = $conn->query($sql3);
while ($expense = $approvedExpenses->fetch_assoc()) {
    if ($expense['UnderByUser'] == $row['id']) {
        $appcnt++;
    }
}

// Batch fetch approved expenses where AdminStatus = 1, ManagerStatus = 1, and Amount <= 5000
$sql31 = "SELECT te.UserId, tu1.UnderByUser AS FirstLevel, tu2.UnderByUser AS SecondLevel 
          FROM tbl_expense_request te 
          INNER JOIN tbl_users tu1 ON tu1.id = te.UserId
          LEFT JOIN tbl_users tu2 ON tu2.id = tu1.UnderByUser
          WHERE te.AdminStatus = '1' 
          AND te.ManagerStatus = '1' 
          AND te.UserId != 0 
          AND te.ExpCatId != 3 
          AND te.Amount <= 5000 
          AND te.UserId != '".$row['id']."' 
          ORDER BY te.ExpenseDate DESC";

$approvedExpenses31 = $conn->query($sql31);
while ($expense31 = $approvedExpenses31->fetch_assoc()) {
    if ($expense31['SecondLevel'] == $row['id']) {
        $appcnt++;
    }
}
                ?>