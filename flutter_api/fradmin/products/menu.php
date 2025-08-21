<?php session_start();
$_SESSION['frid'] = $_REQUEST['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Product Menu</title>
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

    .report-card {
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

    .report-card:hover {
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
      .report-card {
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
    <input type="text" id="searchInput" class="form-control" placeholder="🔍 Search products...">
  </div>

  <div class="container-fluid px-0">

    <a href="view-customer-products.php" class="text-decoration-none">
      <div class="report-card"><i class="bi bi-box-seam"></i> View Selling Products</div>
    </a>

    <a href="view-other-products.php" class="text-decoration-none">
      <div class="report-card"><i class="bi bi-boxes"></i> View Other Products</div>
    </a>

    <a href="view-raw-products-2025.php" class="text-decoration-none">
      <div class="report-card"><i class="bi bi-droplet"></i> View Raw Products</div>
    </a>

  </div>

  <footer>
    Powered by Luminix IT Solutions Private Limited | Version 1.0.3
  </footer>

  <script>
    const input = document.getElementById("searchInput");
    input.addEventListener("input", function () {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll(".report-card").forEach(card => {
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
