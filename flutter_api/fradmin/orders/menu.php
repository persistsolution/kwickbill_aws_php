<?php session_start();
$_SESSION['frid'] = $_REQUEST['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .search-bar {
      padding: 12px 16px;
      background: #fff;
      border-bottom: 1px solid #e0e0e0;
    }

    .report-item {
      background-color: #ffffff;
      padding: 15px 20px;
      border-bottom: 1px solid #e9ecef;
      font-size: 16px;
      font-weight: 500;
      color: #212529;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: background-color 0.2s ease;
    }

    .report-item:hover {
      background-color: #f1f1f1;
    }

    .report-item i {
      font-size: 18px;
      color: #6c757d;
    }

    footer {
      text-align: center;
      font-size: 11px;
      color: #999;
      padding: 12px 0;
      background: #f8f9fa;
      margin-top: 30px;
    }
  </style>
</head>
<body>

  <div class="search-bar">
    <input type="text" id="searchInput" class="form-control" placeholder="🔍 Search orders...">
  </div>

  <div class="container-fluid px-0" id="menuContainer">

    <a href="view-today-orders.php" class="text-decoration-none">
      <div class="report-item"><i class="bi bi-calendar-event"></i> Today Orders</div>
    </a>

    <a href="view-customer-invoices.php?Search=Search" class="text-decoration-none">
      <div class="report-item"><i class="bi bi-receipt"></i> All Orders</div>
    </a>

    <a href="view-today-barcode-orders.php" class="text-decoration-none">
      <div class="report-item"><i class="bi bi-upc-scan"></i> Today Barcode Order</div>
    </a>

    <a href="view-today-online-orders.php" class="text-decoration-none">
      <div class="report-item"><i class="bi bi-globe2"></i> Today Online Order</div>
    </a>

    <a href="view-pending-orders.php?Search=Search" class="text-decoration-none">
      <div class="report-item"><i class="bi bi-hourglass-split"></i> Today Pending Order</div>
    </a>

  </div>

  <footer>
    Powered by Luminix IT Solutions Private Limited | Version 2.0.5
  </footer>

  <script>
    const input = document.getElementById("searchInput");
    input.addEventListener("input", function () {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll(".report-item").forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(keyword) ? "flex" : "none";
      });
    });

    document.addEventListener("keydown", function(e) {
      if (e.key === "/") {
        e.preventDefault();
        input.focus();
      }
    });
  </script>

</body>
</html>
