<?php session_start();
$_SESSION['frid'] = $_REQUEST['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inventory Menu</title>
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

    .menu-card {
      background-color: #ffffff;
      padding: 16px 20px;
      border-bottom: 1px solid #e9ecef;
      font-size: 16px;
      font-weight: 500;
      color: #212529;
      cursor: pointer;
      transition: background-color 0.2s ease;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .menu-card:hover {
      background-color: #f1f1f1;
    }

    footer {
      text-align: center;
      font-size: 11px;
      color: #999;
      padding: 12px 0;
      background: #f8f9fa;
      margin-top: 30px;
    }

    @media (prefers-color-scheme: dark) {
      body {
        background-color: #121212;
        color: #ffffff;
      }
      .menu-card {
        background-color: #1e1e1e;
        color: #e0e0e0;
      }
      .search-bar input {
        background-color: #2a2a2a;
        color: #fff;
        border-color: #444;
      }
      footer {
        background-color: #121212;
        color: #888;
      }
    }
  </style>
</head>
<body>

  <div class="search-bar">
    <input type="text" id="searchInput" class="form-control" placeholder="🔍 Search inventory options...">
  </div>

  <div class="container-fluid px-0">

    <a href="view-cust-stocks.php" class="text-decoration-none">
      <div class="menu-card"><i class="bi bi-box"></i> View MRP Manage Stocks</div>
    </a>

    <a href="add-cust-stock.php" class="text-decoration-none">
      <div class="menu-card"><i class="bi bi-boxes"></i> Add MRP Manage Stocks</div>
    </a>

    <a href="view-wastage-stocks.php" class="text-decoration-none">
      <div class="menu-card"><i class="bi bi-trash3"></i> View MRP Wastage Stocks</div>
    </a>

    <a href="add-wastage-stock.php" class="text-decoration-none">
      <div class="menu-card"><i class="bi bi-trash"></i> Add MRP Wastage Stocks</div>
    </a>

    <a href="view-fr-raw-stock-2025.php" class="text-decoration-none">
      <div class="menu-card"><i class="bi bi-droplet-half"></i> View Raw Manage Stocks</div>
    </a>

    <a href="add-raw-prod-stock-2025.php" class="text-decoration-none">
      <div class="menu-card"><i class="bi bi-plus-circle"></i> Add Raw Manage Stocks</div>
    </a>

    <a href="view-wastage-raw-stocks.php" class="text-decoration-none">
      <div class="menu-card"><i class="bi bi-recycle"></i> View Raw Wastage Stocks</div>
    </a>

    <a href="add-wastage-raw-stock.php" class="text-decoration-none">
      <div class="menu-card"><i class="bi bi-journal-plus"></i> Add Raw Wastage Stocks</div>
    </a>

  </div>

  <footer>
    Powered by Luminix IT Solutions Private Limited | Version 1.0.3
  </footer>

  <script>
    const input = document.getElementById("searchInput");
    input.addEventListener("input", function () {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll(".menu-card").forEach(card => {
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
