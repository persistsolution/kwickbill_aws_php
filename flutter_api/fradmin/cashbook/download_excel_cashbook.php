<?php
include '../config.php';

$frid = $_GET['frid'] ?? '';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"cashbook_" . date("Y-m-d_H-i-s") . ".xls\"");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";
echo "<tr>
        <th>#</th>
        <th>Date</th>
        <th>Total Cash Amount</th>
        <th>Transfer Amount</th>
        <th>Balance Amount</th>
        <th>Bank Name</th>
      </tr>";

$i = 1;
$sql = "SELECT * FROM tbl_cash_book WHERE FrId = '$frid' ORDER BY id DESC";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    echo "<tr>
            <td>{$i}</td>
            <td>{$row['TransferDate']}</td>
            <td>{$row['TotalAmount']}</td>
            <td>{$row['Amount']}</td>
            <td>{$row['BalAmt']}</td>
            <td>{$row['BankName']}</td>
          </tr>";
    $i++;
}
echo "</table>";
exit;
