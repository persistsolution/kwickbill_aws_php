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

<?php
include '../config.php'; // DB connection file
$user_id = $_REQUEST['user_id'] ?? '';

$sql = "SELECT * FROM tbl_sub_menu WHERE user_id LIKE '%$user_id%' ORDER BY srno ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $title = htmlspecialchars($row['title']);
        $link = htmlspecialchars($row['link']);
        $table_values_raw = $row['table_values'];
        
        // Convert string to JSON array (ensure it's valid JSON)
        //$table_values_json = str_replace("'", '"', $table_values_raw); 
        $table_values_json = $table_values_raw;
        
        // Build API URL dynamically (you can also store API URL in DB to make this cleaner)
        /*if (stripos($title, 'MRP') !== false) {
            $apiUrl = "https://kwickbill.com/flutter_api/fradmin/inventory/api/view-cust-stocks.php?user_id=$user_id";
        } elseif (stripos($title, 'Raw') !== false) {
            $apiUrl = "https://kwickbill.com/flutter_api/fradmin/products/api/view-raw-products.php?user_id=$user_id";
        } else {
            $apiUrl = "#";
        }*/
        
        $apiUrl = "https://kwickbill.com/flutter_api/fradmin/inventory-reports/api/".$link."?user_id=$user_id";

        echo "<div class='report' onclick=\"sendInventoryMessage('{$apiUrl}', {$table_values_json}, '{$title}')\">{$title}</div>";

        // Optionally add link card (if you want a fallback link)
        // echo "<a href='{$link}' class='text-decoration-none'><div class='report'>{$title} (Link)</div></a>";
    }
} else {
    echo "<div>No reports found.</div>";
}
?>

<script>
function sendInventoryMessage(apiUrl, fields, pageTitle) {
  const encoded = 'open_inventory|' +
    'api_url=' + encodeURIComponent(apiUrl) +
    '&fields_json=' + encodeURIComponent(JSON.stringify(fields)) +
    '&page_title=' + encodeURIComponent(pageTitle);

  if (window.chrome && window.chrome.webview) {
    window.chrome.webview.postMessage(encoded);
  } else if (window.Flutter) {
    Flutter.postMessage(encoded);
  } else {
    window.location.href = 'customscheme://open_inventory?' +
      'api_url=' + encodeURIComponent(apiUrl) +
      '&fields_json=' + encodeURIComponent(JSON.stringify(fields)) +
      '&page_title=' + encodeURIComponent(pageTitle);
  }
}
</script>

</body>
</html>
