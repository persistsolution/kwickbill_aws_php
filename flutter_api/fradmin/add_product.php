<?php echo $_REQUEST['user_id'];?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Product</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 10px;
    }

    .form-container {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
      font-size: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #444;
      font-size: 14px;
    }

    input[type="text"],
    input[type="number"],
    select,
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
      box-sizing: border-box;
    }

    button {
      background-color: #28a745;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      font-size: 16px;
      width: 100%;
    }

    button:hover {
      background-color: #218838;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      font-size: 14px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    img {
      max-width: 60px;
      height: auto;
    }

    @media screen and (max-width: 600px) {
      h2 {
        font-size: 18px;
      }

      input, select, button {
        font-size: 14px;
      }

      table {
        font-size: 12px;
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }
    }
  </style>
</head>
<body>

<?php
$host = "localhost";
$user = "persistsolution_mahatest";
$pass = "56Et23vxTMl2";
$dbname = "persistsolution_mahatest";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $imageName = '';
    $imageName2 = '';
    $imageName3 = '';
    $pdfName = '';

    if (!is_dir('uploads')) {
        mkdir('uploads', 0755, true);
    }

    // ✅ Image 1 Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$imageName");
    }

    // ✅ Image 2 Upload
    if (isset($_FILES['image2']) && $_FILES['image2']['error'] === 0) {
        $imageName2 = uniqid() . '_' . basename($_FILES['image2']['name']);
        move_uploaded_file($_FILES['image2']['tmp_name'], "uploads/$imageName2");
    }

    // ✅ Image 3 Upload
    if (isset($_FILES['image3']) && $_FILES['image3']['error'] === 0) {
        $imageName3 = uniqid() . '_' . basename($_FILES['image3']['name']);
        move_uploaded_file($_FILES['image3']['tmp_name'], "uploads/$imageName3");
    }

    // ✅ PDF Upload
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === 0) {
        $pdfName = uniqid() . '_' . basename($_FILES['pdf']['name']);
        move_uploaded_file($_FILES['pdf']['tmp_name'], "uploads/$pdfName");
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO tbl_products (name, price, quantity, category, image, image2, image3, image4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdisssss", $name, $price, $quantity, $category, $imageName, $imageName2, $imageName3, $pdfName);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Product added successfully!'); window.location.href='add_product.php';</script>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

?>

<div class="form-container">
  <h2>➕ Add New Product</h2>
  <form action="add_product.php" method="POST" enctype="multipart/form-data">
  <!-- 📦 Product Details -->
  <label for="name">Product Name</label>
  <input type="text" id="name" name="name" required>

  <label for="price">Price</label>
  <input type="number" id="price" name="price" step="0.01" required>

  <label for="quantity">Quantity</label>
  <input type="number" id="quantity" name="quantity" required>

  <label for="category">Category</label>
  <select id="category" name="category" required>
    <option value="">-- Select Category --</option>
    <option value="Food">Food</option>
    <option value="Beverage">Beverage</option>
    <option value="Grocery">Grocery</option>
  </select>

 <!-- 📦 Product Image -->
<label for="image">Product Image (.jpg)</label>
<input type="file" id="image" name="image" accept=".jpg" style="display: none;" required>
<button type="button" onclick="document.getElementById('image').click()">📷 Choose Image</button>

<label for="image">Product Image (.png)</label>
<input type="file" id="image2" name="image2" accept=".png" style="display: none;" required>
<button type="button" onclick="document.getElementById('image2').click()">📷 Choose Image</button>

<label for="image">Product Image (.jpeg)</label>
<input type="file" id="image3" name="image3" accept=".jpeg" style="display: none;" required>
<button type="button" onclick="document.getElementById('image3').click()">📷 Choose Image</button>

<!-- 📄 PDF Upload -->
<label for="pdf">Upload PDF</label>
<input type="file" id="pdf" name="pdf" accept=".pdf" style="display: none;">
<button type="button" onclick="document.getElementById('pdf').click()">📄 Choose PDF</button>


  <!-- ✅ Submit Button -->
  <button type="submit">Add Product</button>
</form>
</div>

<h2>📦 Product List</h2>
<div style="overflow-x:auto;">
<table>
  <tr>
    <th>ID</th>
    <th>Image</th>
     <th>Image2 </th>
      <th>Image3</th>
       <th>Pdf</th>
    <th>Name</th>
    <th>Category</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Created At</th>
  </tr>
  <?php
  $result = $conn->query("SELECT * FROM tbl_products ORDER BY id DESC");
  while ($row = $result->fetch_assoc()):
  ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= !empty($row['image']) ? "<img src='uploads/{$row['image']}' alt='Image'>" : "N/A" ?></td>
      <td><?= !empty($row['image2']) ? "<img src='uploads/{$row['image2']}' alt='Image'>" : "N/A" ?></td>
      <td><?= !empty($row['image3']) ? "<img src='uploads/{$row['image3']}' alt='Image'>" : "N/A" ?></td>
      <td><?= !empty($row['image4']) ? "<a href='uploads/{$row['image4']}'>view</a>" : "N/A" ?></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= $row['category'] ?></td>
      <td>₹<?= number_format($row['price'], 2) ?></td>
      <td><?= $row['quantity'] ?></td>
      <td><?= $row['created_at'] ?></td>
    </tr>
  <?php endwhile; ?>
</table>
</div>

<?php $conn->close(); ?>
</body>
</html>
