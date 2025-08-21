<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['frid'];
$BillSoftFrId = $_SESSION['frid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Cashbook</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
  <h4 class="text-center mb-3">📒 Cashbook Report</h4>

  <form method="post" class="mb-3">
    <div class="form-row">
      <div class="form-group col-6">
        <input type="date" name="FromDate" class="form-control" value="<?= $_POST['FromDate'] ?? '' ?>" placeholder="From Date">
      </div>
      <div class="form-group col-6">
        <input type="date" name="ToDate" class="form-control" value="<?= $_POST['ToDate'] ?? '' ?>" placeholder="To Date">
      </div>
    </div>
    <div class="text-center mb-3">
      <button type="submit" name="submit" class="btn btn-primary btn-sm">🔍 Search</button>
      <a href="<?= $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary btn-sm">Clear</a>
    </div>
  </form>

  <!-- ✅ Custom Export Buttons -->
  <div class="text-center mb-3">
    <a href="download_excel_cashbook.php?frid=<?= $user_id ?>" class="btn btn-success btn-sm">📥 Excel</a>
    <a href="download_pdf_cashbook.php?frid=<?= $user_id ?>" class="btn btn-danger btn-sm">📄 PDF</a>
    <a href="print_cashbook.php?frid=<?= $user_id ?>" target="_blank" class="btn btn-info btn-sm">🖨️ Print</a>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-sm">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>Date</th>
          <th>Total</th>
          <th>Transfer</th>
          <th>Balance</th>
          <th>Bank</th>
          <th>Receipt</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        $sql = "SELECT ts.* FROM tbl_cash_book ts WHERE ts.FrId='$BillSoftFrId'";
        if (!empty($_POST['FromDate'])) {
          $sql .= " AND ts.TransferDate >= '{$_POST['FromDate']}'";
        }
        if (!empty($_POST['ToDate'])) {
          $sql .= " AND ts.TransferDate <= '{$_POST['ToDate']}'";
        }
        $sql .= " ORDER BY ts.id DESC";
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
        ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= date("d-m-Y", strtotime($row['TransferDate'])) ?></td>
          <td>&#8377;<?= $row['TotalAmount'] ?></td>
          <td>&#8377;<?= $row['Amount'] ?></td>
          <td>&#8377;<?= $row['BalAmt'] ?></td>
          <td><?= $row['BankName'] ?></td>
          <td>
            <?php if ($row['Files'] && file_exists("../uploads/" . $row['Files'])) { ?>
              <a href="../uploads/<?= $row['Files'] ?>" target="_blank">View</a>
            <?php } else { ?>
              <span class="text-danger">N/A</span>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
