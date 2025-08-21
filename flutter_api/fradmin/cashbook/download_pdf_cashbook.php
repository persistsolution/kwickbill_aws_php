<?php
include_once '../config.php';

$frid = $_GET['frid'] ?? 0;
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=cashbook_report_" . date('Ymd_His') . ".pdf");
header("Pragma: no-cache");
header("Expires: 0");

echo "<html><head><meta charset='UTF-8'><style>
  table { border-collapse: collapse; width: 100%; }
  th, td { border: 1px solid #222; padding: 6px; text-align: left; }
  th { background-color: #f2f2f2; }
</style></head><body>";
echo "<h3 style='text-align:center;'>Cashbook Report</h3>";

echo "<table>
<tr>
  <th>#</th>
  <th>Date</th>
  <th>Total Amount</th>
  <th>Transfer Amount</th>
  <th>Balance Amount</th>
  <th>Bank Name</th>
</tr>";

$sql = "SELECT * FROM tbl_cash_book WHERE FrId='$frid'";
if (!empty($from)) $sql .= " AND TransferDate >= '$from'";
if (!empty($to)) $sql .= " AND TransferDate <= '$to'";
$sql .= " ORDER BY id DESC";

$res = $conn->query($sql);
$i = 1;

while ($row = $res->fetch_assoc()) {
  echo "<tr>";
  echo "<td>{$i}</td>";
  echo "<td>" . date("d-m-Y", strtotime($row['TransferDate'])) . "</td>";
  echo "<td>{$row['TotalAmount']}</td>";
  echo "<td>{$row['Amount']}</td>";
  echo "<td>{$row['BalAmt']}</td>";
  echo "<td>{$row['BankName']}</td>";
  echo "</tr>";
  $i++;
}

echo "</table></body></html>";
exit;
?>
