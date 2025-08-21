<?php session_start();
 $_SESSION['frid'] = $_REQUEST['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GRN</title>
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
      <a href="view-mrp-product-grn.php" class="text-decoration-none">
    <div class="report-item">View MRP Product GRN</div>
  </a>
    <a href="add-mrp-product-grn.php" class="text-decoration-none">
    <div class="report-item">Add MRP Product GRN</div>
  </a>
  
  <a href="view-raw-product-grn.php" class="text-decoration-none">
    <div class="report-item">View Raw Product GRN</div>
  </a>
    <a href="add-raw-product-grn.php" class="text-decoration-none">
    <div class="report-item">Add Raw Product GRN</div>
  </a>
  
  
  </div>

</body>
</html>
