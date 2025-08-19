<?php 
// Fetch expense requests for this user
$userId = $row['id'];
$sql3 = "SELECT te.UserId, tu.UnderByUser FROM tbl_expense_request te 
        INNER JOIN tbl_users tu ON tu.id = te.UserId
        WHERE te.ManagerStatus = '0' AND te.AdminStatus = '0' AND te.UserId != 0 AND te.ExpCatId != 3 AND te.UserId != '$userId' ORDER BY te.ExpenseDate DESC";

$expenses = $conn->query($sql3);
while ($expense = $expenses->fetch_assoc()) {
    if ($expense['UnderByUser'] == $row['id']) {
        $cnt++;
    }
}

// Fetch expenses where ManagerStatus is '1' and amount <= 5000
$sql31 = "SELECT te.UserId, tu.UnderByUser FROM tbl_expense_request te 
        INNER JOIN tbl_users tu ON tu.id = te.UserId
        WHERE te.AdminStatus = '0' AND te.ManagerStatus = '1' AND te.UserId != 0 AND te.ExpCatId != 3 AND te.Amount <= 5000 AND te.UserId != '$userId' ORDER BY te.ExpenseDate DESC";

$expenses31 = $conn->query($sql31);
while ($expense31 = $expenses31->fetch_assoc()) {
    $UnderByUser = $expense31['UnderByUser'];
    $sql42 = "SELECT UnderByUser FROM tbl_users WHERE id='$UnderByUser'";
    $row42 = getRecord($sql42);
    if ($row42['UnderByUser'] == $row['id']) {
        $cnt++;
    }
}

?>