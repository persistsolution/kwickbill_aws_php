<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reports Menu</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .header {
      background: #6200ee;
      color: #fff;
      padding: 12px 16px;
      font-weight: bold;
    }
    .report-card {
      background: #fff;
      margin: 8px 16px;
      padding: 12px;
      border-radius: 4px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      cursor: pointer;
      transition: background 0.2s ease;
    }
    .report-card:hover {
      background: #ececec;
    }
    footer {
      font-size: 11px;
      color: #999;
      text-align: center;
      padding: 12px;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <div class="header">Reports Menu</div>

  <div class="report-card" onclick="sendInventoryMessage(
    'https://kwickbill.com/flutter_api/fradmin/inventory/api/view-cust-stocks.php?user_id=253',
    [
      {label:'SrNo', key:'SrNo'},
      {label:'ProdId', key:'ProdId'},
      {label:'ProductName', key:'ProductName'},
      {label:'Date', key:'Date'},
      {label:'StockInQty', key:'StockInQty'}
    ],
    'MRP Inventory Stock Report'
  )">MRP Inventory Stock Report</div>

  <div class="report-card" onclick="sendInventoryMessage(
    'https://kwickbill.com/flutter_api/fradmin/products/api/view-raw-products.php?user_id=253',
    [
      {label:'SerialNo', key:'SerialNo'},
      {label:'ProductName', key:'ProductName'},
      {label:'Category', key:'Category'},
      {label:'Unit', key:'Unit'},
      {label:'RegisterDate', key:'RegisterDate'}
    ],
    'Raw Product Stock Report'
  )">Raw Product Stock Report</div>

  <footer>Powered by Luminix IT Solutions | Version 2.0.5</footer>

  <script>
    function sendInventoryMessage(apiUrl, fieldsArray, pageTitle) {
      const msg = 'open_inventory|' +
        'api_url=' + encodeURIComponent(apiUrl) +
        '&fields_json=' + encodeURIComponent(JSON.stringify(fieldsArray)) +
        '&page_title=' + encodeURIComponent(pageTitle);

      if (window.chrome && window.chrome.webview) {
        window.chrome.webview.postMessage(msg);
      } else if (window.Flutter) {
        Flutter.postMessage(msg);
      } else {
        alert('Bridge not available');
      }
    }
  </script>

</body>
</html>
