<?php session_start();
 $_SESSION['frid'] = $_REQUEST['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cash Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar {
      background-color: #f1f3f5;
      padding: 1rem;
    }

    .navbar h3 {
      margin: 0;
      font-weight: 600;
    }

    .report-item {
      background-color: #ffffff;
      padding: 15px 20px;
      border-bottom: 1px solid #e9ecef;
      font-size: 16px;
      font-weight: 500;
      color: #212529;
      cursor: pointer;
    }

    .report-item:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>
<body>

  <!--<div class="navbar d-flex align-items-center">
   <button class="btn btn-link me-3" onclick="history.back()">
  <i class="bi bi-arrow-left" style="font-size: 1.5rem; color: black;"></i>
</button>

    <h3>CASHBOOK</h3>
  </div>-->

  <div class="container-fluid px-0">
     <a href="customscheme://open_inventory?api_url=https%3A%2F%2Fkwickbill.com%2Fflutter_api%2Ffradmin%2Finventory%2Fapi%2Fview-cust-stocks.php%3Fuser_id%3D1&fields_json=%5B%7B%22label%22%3A%22SrNo%22%2C%22key%22%3A%22SrNo%22%7D%2C%7B%22label%22%3A%22ProdId%22%2C%22key%22%3A%22ProdId%22%7D%2C%7B%22label%22%3A%22ProductName%22%2C%22key%22%3A%22ProductName%22%7D%2C%7B%22label%22%3A%22Date%22%2C%22key%22%3A%22Date%22%7D%2C%7B%22label%22%3A%22StockInQty%22%2C%22key%22%3A%22StockInQty%22%7D%5D" class="text-decoration-none">
  <div class="report-item">MRP Inventory Stock Report</div>
</a>

<a href="raw-inventory-stock-report.php" class="text-decoration-none">
  <div class="report-item">Raw Inventory Stock Report</div>
</a>

<a href="assets-inventory-stock-report.php" class="text-decoration-none">
  <div class="report-item">Assets Inventory Stock Report</div>
</a>

<a href="min-inventory-stock-report.php" class="text-decoration-none">
  <div class="report-item">Min MRP Inventory Stock Report</div>
</a>

<a href="top-selling-product-report.php" class="text-decoration-none">
  <div class="report-item">Top Selling Product</div>
</a>

<a href="stock-level-report.php" class="text-decoration-none">
  <div class="report-item">Stock Level</div>
</a>

  
  
  </div>

</body>
</html>
