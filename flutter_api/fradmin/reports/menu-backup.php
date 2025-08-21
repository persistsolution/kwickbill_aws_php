<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reports Menu</title>
  <style>
    body { font-family: sans-serif; padding: 20px; }
    .report { 
      display: block; 
      margin: 10px 0; 
      color: blue; 
      text-decoration: underline; 
      cursor: pointer; 
    }
  </style>
</head>
<body>
  <h2>Reports Menu</h2>

  <div class="report" onclick="sendInventoryMessage(
    'https://kwickbill.com/flutter_api/fradmin/inventory/api/view-cust-stocks.php?user_id=<?php echo $_REQUEST['user_id'];?>',
    [
      {label:'SrNo',key:'SrNo'},
      {label:'ProdId',key:'ProdId'},
      {label:'ProductName',key:'ProductName'},
      {label:'Date',key:'Date'},
      {label:'StockInQty',key:'StockInQty'}
    ],
    'MRP Inventory Stock Report'
  )">MRP Inventory Stock Report</div>

  <div class="report" onclick="sendInventoryMessage(
    'https://kwickbill.com/flutter_api/fradmin/products/api/view-raw-products.php?user_id=<?php echo $_REQUEST['user_id'];?>',
    [
      {label:'SerialNo',key:'SerialNo'},
      {label:'ProductName',key:'ProductName'},
      {label:'Category',key:'Category'},
      {label:'Unit',key:'Unit'},
      {label:'RegisterDate',key:'RegisterDate'}
    ],
    'Raw Product Stock Report'
  )">Raw Product Stock Report</div><br>
  <a href="fr-raw-product-stock-report-2025.php" class="text-decoration-none">
      <div class="report-card"><i class="bi bi-droplet-half"></i> Raw Product Stock Report</div>
    </a>

  <script>
    function sendInventoryMessage(apiUrl, fields, pageTitle) {
      const encoded = 'open_inventory|' +
        'api_url=' + encodeURIComponent(apiUrl) +
        '&fields_json=' + encodeURIComponent(JSON.stringify(fields)) +
        '&page_title=' + encodeURIComponent(pageTitle);

      if (window.chrome && window.chrome.webview) {
        // Windows bridge
        window.chrome.webview.postMessage(encoded);
      } else if (window.Flutter) {
        // Android/iOS bridge
        Flutter.postMessage(encoded);
      } else {
        // Fallback: use customscheme link for Windows WebView2 that catches URLs
        window.location.href = 'customscheme://open_inventory?' +
          'api_url=' + encodeURIComponent(apiUrl) +
          '&fields_json=' + encodeURIComponent(JSON.stringify(fields)) +
          '&page_title=' + encodeURIComponent(pageTitle);
      }
    }
  </script>

</body>
</html>
