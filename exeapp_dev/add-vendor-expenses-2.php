<?php session_start();
require_once 'config.php';
require_once("dbcontroller.php");
$db_handle = new DBController();
require_once 'auth.php';
$PageName = "Vendor Expenses";
$UserId = $_SESSION['User']['id']; 
unset($_SESSION["cart_item1"]);
if($_GET['id']!=''){
    $ExpId = $_GET['id'];
    $sql = "SELECT * FROM tbl_ved_expense_items WHERE ExpId='$ExpId'";
    $row = getList($sql);
    foreach($row as $result){
        $ProdType = $result['ProdType'];
        $prdsrno = $result['srno'];
        $ProdId = $result['MainProdId'];
        $Unit = $result['Unit2'];
        //$Qty2 = $result['Qty2'];
         $productByCode = $db_handle->runQuery("SELECT id,code,ProductName,ProdType FROM tbl_cust_products2 WHERE id='$ProdId'");
     $itemArray = array($productByCode[0]["code"]=>array('code'=>$productByCode[0]["code"],'prdsrno'=>$prdsrno,'id'=>$ProdId,'ProductName'=>$productByCode[0]["ProductName"],'PurchasePrice'=>$result["PurchasePrice"],'SellPrice'=>$result["SellPrice"],'Qty'=>$result["Qty2"],'ProdType'=>$productByCode[0]["ProdType"],'Unit'=>$Unit));
      if(!empty($_SESSION["cart_item$prdsrno"])) {
        if(in_array($productByCode[0]["code"],$_SESSION["cart_item$prdsrno"])) {
          foreach($_SESSION["cart_item$prdsrno"] as $k => $v) {
              if($productByCode[0]["code"] == $k)
                $_SESSION["cart_item$prdsrno"][$k]["quantity"] = $_POST["quantity"];
          }
        } else {
          $_SESSION["cart_item$prdsrno"] = array_merge($_SESSION["cart_item$prdsrno"],$itemArray);
        }
      } else {
        $_SESSION["cart_item$prdsrno"] = $itemArray;
      }
    }
}
?>
<!doctype html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?php echo $Proj_Title; ?></title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
    <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
    <link href="css/toastr.min.css" rel="stylesheet">
    <script src="js/jquery.min3.5.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">

    <style>
    .autocomplete-list3 {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background-color: white;
            z-index: 1000;
            width: 100%;
            margin-top: 35px;
        }
        
        .autocomplete-list2 {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background-color: white;
            z-index: 1000;
            width: 100%;
            margin-top: 35px;
        }

        .autocomplete-list {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background-color: white;
            z-index: 1000;
            width: 100%;
        }

        .autocomplete-item {
            padding: 8px;
            cursor: pointer;
        }

        .autocomplete-item:hover,
        .autocomplete-item.active {
            background-color: #98e6ed;
        }
    </style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .custom-file-upload {
            position: relative;
            width: 100%;
            height: 120px;
            border: 2px dashed #6c757d;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            cursor: pointer;
            transition: 0.3s ease;
            text-align: center;
            overflow: hidden;
        }

        .custom-file-upload:hover {
            background-color: #e9ecef;
            border-color: #343a40;
        }

        .upload-box-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .custom-file-upload i {
            font-size: 32px;
            color: #6c757d;
            margin-bottom: 8px;
        }

        .custom-file-upload span {
            font-size: 14px;
            color: #6c757d;
        }

        .preview-img-inside {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .file-name {
            font-size: 13px;
            color: #333;
            font-style: italic;
            margin-top: 8px;
        }

        .old-file-link {
            display: inline-block;
            font-size: 13px;
            color: #007bff;
            text-decoration: underline;
            margin-top: 5px;
        }

        /*input[type="file"] {
            display: none;
        }*/
        
       
    </style>
    
    <style>
    .form-group {
        font-family: Arial, sans-serif;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .custom-file-upload {
        position: relative;
        margin-top: 10px;
    }

    .custom-upload-label {
        display: inline-block;
        padding: 12px 25px;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        border-radius: 50px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        font-size: 16px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .custom-upload-label:hover {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
        transform: scale(1.05);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .custom-upload-label.video {
        background: linear-gradient(135deg, #11998e, #38ef7d);
    }

    .custom-upload-label.video:hover {
        background: linear-gradient(135deg, #38ef7d, #11998e);
        transform: scale(1.05);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .custom-file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .fa-cloud-upload,
    .fa-video {
        margin-right: 8px;
    }

    .file-info {
        margin-top: 10px;
        font-size: 14px;
        color: #555;
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .file-info ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .file-info ul li {
        margin-bottom: 5px;
    }

    .file-info ul li span {
        font-weight: bold;
        color: #333;
    }

    #loading {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 1000;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #000;
        line-height: 100vh;
    }

    #progress-container {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 1001;
    }

    #progress-bar {
        width: 300px;
        height: 20px;
        background: #f3f3f3;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    #progress-bar div {
        height: 100%;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        width: 0;
    }

    #progress-text {
        font-size: 16px;
        font-weight: bold;
    }

    .screen-blur {
        filter: blur(5px);
        pointer-events: none;
    }
    
    #loading-overlay .spinner-border {
    animation: spinner-border 0.75s linear infinite;
}

#loading-overlay2 .spinner-border {
    animation: spinner-border 0.75s linear infinite;
}

@keyframes spinner-border {
    to {
        transform: rotate(360deg);
    }
}

</style>

    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?>

        <?php

        $sql55 = "SELECT * FROM tbl_company_emails WHERE id=1";
        $row55 = getRecord($sql55);

        $id = $_GET['id'];
        $sql7 = "SELECT * FROM tbl_vendor_expenses WHERE id='$id'";
        $res7 = $conn->query($sql7);
        $row7 = $res7->fetch_assoc();
        if ($_GET['id'] == '') {
            $Locations = $UnderFrId;
            $VedId = 0;
        } else {
            $Locations = $row7["Locations"];
            $VedId = $row7['VedId'];
        }

        $sql = "SELECT ShopName,Phone FROM tbl_users_bill WHERE id='$Locations'";
        $row = getRecord($sql);
        $FrLocations = $row['ShopName'] . "-" . $row['Phone'];

        if ($VedId != 0) {
            $sql2 = "SELECT Fname,Phone FROM tbl_users WHERE id='$VedId'";
            $row2 = getRecord($sql2);
            $VedName = $row2['Fname'] . "-" . $row2['Phone'];
        } else {
            $VedName = "";
        }
        ?>


        <div class="main-container">
            <div class="container">

                <div class="card">
  <form id="validation-form" method="post" enctype="multipart/form-data">
    <div class="card-body">
      <!-- Hidden Inputs -->
      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
      <input type="hidden" name="action" value="saveExpenses" id="action">
      <input type="hidden" name="TempPrdId" value="<?php echo rand(10000, 99999); ?>">
      <input type="hidden" name="TempPrdId2" value="<?php echo rand(10000, 99999); ?>">

      <div class="row">
        <!-- Vendor Name -->
        <div class="form-group col-md-6">
          <label>Vendor <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="VedName" id="VedName" placeholder="Search vendor..." value="<?php echo $VedName; ?>" required autofocus onclick="this.select();">
          <div id="autocomplete-list" class="autocomplete-list" style="display: none; position: absolute;"></div>
        </div>

        <!-- Vendor ID -->
        <div class="form-group col-md-6">
          <label>Vendor ID <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="VedId" id="VedId" value="<?php echo $row7['VedId']; ?>" readonly>
        </div>

        <!-- Trade Name -->
        <div class="form-group col-md-6">
          <label>Trade/Business Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="TradeName" id="TradeName" value="<?php echo $row7['TradeName']; ?>" required>
        </div>

        <!-- Vendor Phone -->
        <div class="form-group col-md-6">
          <label>Vendor Mobile No <span class="text-danger">*</span></label>
          <input type="number" class="form-control" name="VedPhone" id="VedPhone" value="<?php echo $row7['VedPhone']; ?>" required>
        </div>

        <!-- Vendor Type -->
        <div class="form-group col-md-6">
          <label>Type of Vendor</label>
          <select class="form-control" name="TypeOfVendor" id="TypeOfVendor" required>
            <option value="" selected disabled>...</option>
            <?php
              $sql = "SELECT * FROM tbl_common_master WHERE Roll=1 AND Status=1";
              $row = getList($sql);
              foreach ($row as $result) {
            ?>
              <option value="<?php echo $result['id']; ?>" <?php if ($row7["TypeOfVendor"] == $result['id']) echo "selected"; ?>><?php echo $result['Name']; ?></option>
            <?php } ?>
          </select>
        </div>

        <!-- Invoice Info -->
        <div class="form-group col-md-6">
          <label>Invoice No <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="InvoiceNo" value="<?php echo $row7['InvoiceNo']; ?>" required>
        </div>

        <div class="form-group col-md-6">
          <label>Invoice Amount <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Amount" value="<?php echo $row7['Amount']; ?>" required>
        </div>

        <div class="form-group col-md-6">
          <label>Invoice Date <span class="text-danger">*</span></label>
          <input type="date" class="form-control" name="ExpenseDate" value="<?php echo $row7['ExpenseDate']; ?>" required>
        </div>

        <!-- PO No -->
        <div class="form-group col-md-6">
          <label>PO No <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="PoNo" value="<?php echo $row7['PoNo']; ?>" required>
        </div>

        <!-- Location Search -->
        <div class="form-group col-md-6">
          <label>Location <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="FrLocations" id="FrLocations" placeholder="Search location..." value="<?php echo $FrLocations; ?>" required onclick="this.select();">
          <div id="autocomplete-list2" class="autocomplete-list" style="display: none; position: absolute;"></div>
        </div>

        <div class="form-group col-md-6">
          <label>Location ID <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Locations" id="Locations" value="<?php echo $Locations; ?>" readonly>
        </div>

        <!-- Payment Details -->
        <div class="form-group col-md-6">
          <label>Payment Type</label>
          <select class="form-control" name="PaymentMode" id="PaymentMode" required>
            <option value="" disabled selected>Select Payment Type</option>
            <option value="Advance Payment" <?php if ($row7["PaymentMode"] == 'Advance Payment') echo "selected"; ?>>Advance Payment</option>
            <option value="Final Payment" <?php if ($row7["PaymentMode"] == 'Final Payment') echo "selected"; ?>>Final Payment</option>
          </select>
        </div>

        <div class="form-group col-md-6">
          <label>Advance Amount <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="AdvAmount" value="<?php echo $row7['AdvAmount']; ?>" required>
        </div>

        <!-- Invoice Type -->
        <div class="form-group col-md-6">
          <label>Type of Invoice <span class="text-danger">*</span></label>
          <select class="form-control" name="InvType" required>
            <option value="" disabled selected>Select</option>
            <option value="Proforma Invoice" <?php if ($row7["InvType"] == 'Proforma Invoice') echo "selected"; ?>>Proforma Invoice</option>
            <option value="Tax Invoice" <?php if ($row7["InvType"] == 'Tax Invoice') echo "selected"; ?>>Tax Invoice</option>
          </select>
        </div>

        <!-- Narration -->
        <div class="form-group col-md-12">
          <label>Narration</label>
          <textarea class="form-control" name="Narration"><?php echo $row7['Narration']; ?></textarea>
        </div>

        <!-- File Upload -->
        <div class="form-group col-12 file-upload-block">
                                        <label class="upload-label">Upload Invoice</label>
                                        <label for="Photo1" class="custom-file-upload" id="PhotoPreviewBox1">
                                            <div class="upload-box-content">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span>Click or Drag file here to upload (.png)</span>
                                            </div>
                                        </label>
                                        <input type="file" id="Photo1" name="Photo" accept=".png">
                                        <input type="hidden" name="OldPhoto" id="OldPhoto1" value="<?php echo $row7['Photo']; ?>">
                                        <?php if ($row7['Photo'] != '') { ?>
                                            <a class="old-file-link" href="../uploads/<?php echo $row7['Photo']; ?>" target="_blank"><?php echo $row7['Photo']; ?></a>
                                        <?php } ?>
                                    </div>
                                    
                           
                            <div class="form-group col-12 file-upload-block">
                                        <label class="upload-label">Upload PDF</label>
                                        <label for="Photo21" class="custom-file-upload" id="Photo2PreviewBox1">
                                            <div class="upload-box-content">
                                                <i class="fas fa-file-image"></i>
                                                <span>Click to upload (.pdf)</span>
                                            </div>
                                        </label>
                                        <input type="file" id="Photo21" name="Photo2" accept=".pdf">
                                        <input type="hidden" name="OldPhoto2" id="OldPhoto21" value="<?php echo $row7['Photo2']; ?>">
                                        <?php if ($row7['Photo2'] != '') { ?>
                                            <a class="old-file-link" href="../uploads/<?php echo $row7['Photo2']; ?>" target="_blank">View Existing Receipt</a>
                                        <?php } ?>
                                    </div>

        <!-- Inventory Product Purchase -->
        <div class="form-group col-md-10 col-9">
          <label style="font-size: 12px;">Did You Purchase Inventory Product?</label>
          <select class="form-control" name="Product" onchange="showAddButton(1,this.value)">
            <option value="No" <?php if ($row7["Product"] == 'No') echo "selected"; ?>>No</option>
            <option value="Yes" <?php if ($row7["Product"] == 'Yes') echo "selected"; ?>>Yes</option>
          </select>
        </div>
        <div class="form-group col-2 d-flex align-items-end">
          <button type="button" class="btn btn-info w-100" onclick="openModal(1)">+</button>
        </div>

      
        <div class="form-group col-md-12">
          <div id="showcart21" style="overflow-x: auto;">
              
              <table class="table table-striped table-bordered" width="100%">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Qty</th>
            <th nowrap>Purchase Price</th>
            <th nowrap>Total</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $prdsrno = 1;
        $totamt = 0;
        foreach ($_SESSION["cart_item$prdsrno"] as $product){
          $totamt+=$product['Qty']*$product['PurchasePrice'];
                
        ?>
        <tr>
            <th nowrap><?php echo $product['ProductName'];?></th>
            <th><?php echo $product['Qty']." ".$product['Unit'];?></th>
            <th><?php echo $product['PurchasePrice'];?></th>
            <th><?php echo $product['PurchasePrice']*$product['Qty'];?></th>
            <th><a href="javascript:void(0)" onclick="delete_prod('<?php echo $product['code'];?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash text-danger"></i></a></th>
        </tr>
        <?php }  ?>
    </tbody>
</table>
          </div>
        </div>

        <input type="hidden" id="TotalAmt1" class="form-control">
        <input type="hidden" id="Status" name="Status" value="0">
      </div>
    </div>

    <div class="card-footer">
      <button class="btn btn-primary btn-block" type="submit" name="submit" id="submit">Submit</button>
    </div>
  </form>
</div>

                
                
                 <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title">Add Product</h4>
                        </div>
                        <div class="modal-body">

                            <div class="card">
                                <div class="row">
                                    <div class="form-group col-md-3 col-12">
                                        <label class="form-label">Product Name </label>
                                        <input type="text" class="form-control" autocomplete="off" name="ProductName" id="ProductName" placeholder="" value="" onClick="this.select();">
                                        <div id="autocomplete-list3" class="autocomplete-list" style="display: none; position: absolute;"></div>

                                    </div>

                                    <div class="form-group col-md-3 col-12">
                                        <label class="form-label">Product ID </label>
                                        <input type="text" class="form-control" name="ProdId" id="ProdId" value="" readonly>

                                    </div>

                                    <!--<div class="form-group col-md-3 col-6">
                                        <label class="form-label">Available Stock </label>
                                        <input type="text" name="AvailStock" id="AvailStock" class="form-control" placeholder="" value="" autocomplete="off" readonly>
                                        <div class="clearfix"></div>
                                    </div>-->
<input type="hidden" name="AvailStock" id="AvailStock" class="form-control" placeholder="" value="" autocomplete="off" readonly>
                                  <div class="form-group col-md-2 col-6">
    <label class="form-label">Stock In Qty</label>
    <div class="input-group">
        <input type="text" name="Qty" id="Qty" class="form-control" placeholder="" value="<?php echo $row7["Qty"]; ?>" autocomplete="off">
        <input type="text" name="Unit" id="Unit" class="form-control" placeholder="" value="<?php echo $row7["Unit"]; ?>" autocomplete="off" style="max-width: 60px;" readonly>
    </div>
    <div class="clearfix"></div>
</div>


                                    <div class="form-group col-md-3 col-6">
                                        <label class="form-label">Purchase Price (Per Qty) </label>
                                        <input type="text" name="PurchasePrice" id="PurchasePrice" class="form-control" placeholder="" value="" autocomplete="off" required>
                                        <div class="clearfix"></div>
                                    </div>
 <input type="hidden" name="SellPrice" id="SellPrice" class="form-control" placeholder="" value="<?php echo $row7["SellPrice"]; ?>" autocomplete="off" readonly>
                                    <!--<div class="form-group col-md-2 col-6">
                                        <label class="form-label">Sell Price </label>
                                        <input type="text" name="SellPrice" id="SellPrice" class="form-control" placeholder="" value="<?php echo $row7["SellPrice"]; ?>" autocomplete="off" readonly>
                                        <div class="clearfix"></div>
                                    </div>-->

                                    <input type="hidden" name="code" id="code" class="form-control" placeholder="" value="" autocomplete="off" readonly>
                                    <input type="hidden" name="prdsrno" id="prdsrno" class="form-control" placeholder="" value="" autocomplete="off" readonly>
                                    <div class="form-group col-md-3 col-6">
                                        <button type="button" id="add" class="btn btn-success btn-finish" onclick="addToCart()">Add</button>

                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="col-lg-12 showcart" id="showcart" style="overflow-x: auto; width: 100%;">


                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </main>
    <br><br><br><br>
    <!-- footer-->

    <?php include 'footer.php'; ?>

    <!-- Required jquery and libraries -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="js/jquery.cookie.js"></script>

    <!-- Swiper slider  js-->
    <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="js/main.js"></script>
    <script src="js/color-scheme-demo.js"></script>


    <!-- page level custom script -->
    <script src="js/app.js"></script>
    <script type="text/javascript">
    
    let expenseRowCount = 1;
        // Initialize preview for all 4 image inputs dynamically
        showPreview('Photo' + expenseRowCount, 'PhotoPreviewBox' + expenseRowCount);
        showPreview('Photo2' + expenseRowCount, 'Photo2PreviewBox' + expenseRowCount);
        

        function showPreview(inputId, previewBoxId) {
            const input = document.getElementById(inputId);
            const box = document.getElementById(previewBoxId);

            if (!input || !box) {
                console.warn("Element not found:", inputId, previewBoxId);
                return;
            }

            input.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        box.innerHTML = `<img src="${e.target.result}" class="preview-img-inside" alt="Preview">`;
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    box.innerHTML = `<div class="upload-box-content"><i class="fas fa-file-pdf"></i><span>${file.name}</span></div>`;
                } else {
                    box.innerHTML = `<div class="upload-box-content"><i class="fas fa-file"></i><span>${file.name}</span></div>`;
                }
            });
        }
        
    $(function() {
  $('.selectpicker').selectpicker();
});

        let currentFocus = -1;

        $(document).ready(function() {
            $("#VedName").on("input", function() {
                let VedName = $(this).val();

                if (VedName.length === 0) {
                    $("#autocomplete-list").hide();
                    return;
                }
                var action = "getVedList";
                $.ajax({
                    url: "ajax_files/ajax_dropdown.php",
                    method: "POST",
                    data: {
                        action: action,
                        VedName: VedName
                    },
                    success: function(data) {
                        console.log(data);
                        $("#autocomplete-list").empty().show();
                        currentFocus = -1;

                        if (data.length === 0) {
                            $("#autocomplete-list").hide();
                            return;
                        }

                        data.forEach(function(item) {
                            $("#autocomplete-list").append(`<div class="autocomplete-item" onclick="getVedDetails(${item.id})">${item.Fname}-${item.Phone}</div>`);
                        });

                        $(".autocomplete-item").on("click", function() {
                            $("#VedName").val($(this).text());
                            $("#autocomplete-list").hide();
                        });
                    }
                });
            });

            $("#VedName").on("keydown", function(e) {
                let items = $(".autocomplete-item");

                if (e.key === "ArrowDown") {
                    currentFocus++;
                    if (currentFocus >= items.length) currentFocus = 0;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "ArrowUp") {
                    currentFocus--;
                    if (currentFocus < 0) currentFocus = items.length - 1;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "Enter") {
                    e.preventDefault();
                    if (currentFocus > -1 && items[currentFocus]) {
                        items.eq(currentFocus).click();
                    }
                }
            });

            function setActive(items) {
                items.removeClass("active");
                if (currentFocus >= 0 && currentFocus < items.length) {
                    items.eq(currentFocus).addClass("active");
                    items.eq(currentFocus)[0].scrollIntoView({
                        block: "nearest"
                    });
                }
            }

            $(document).click(function(e) {
                if (!$(e.target).closest("#VedName, #autocomplete-list").length) {
                    $("#autocomplete-list").hide();
                }
            });
        });

        function getVedDetails(id) {
            var action = "getUserDetails";
            $.ajax({
                url: "ajax_files/ajax_dropdown.php",
                method: "POST",
                data: {
                    action: action,
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    $('#VedId').val(data.id);
                    $('#TradeName').val(data.TradeName);
                    $('#CustName').val(data.Fname);
                    $('#VedPhone').val(data.Phone);
                    $('#EmailId').val(data.EmailId);
                    $('#AccCode').val(data.CustomerId);
                    $('#TypeOfVendor').val(data.TypeOfVendor).attr("selected", true);
                }
            });
        }
    </script>


    <script type="text/javascript">
        let currentFocus2 = -1;

        $(document).ready(function() {
            $("#FrLocations").on("input", function() {
                let FrLocations = $(this).val();
                if (FrLocations.length === 0) {
                    $("#autocomplete-list2").hide();
                    return;
                }
                var action = "getFrLocationList";
                $.ajax({
                    url: "ajax_files/ajax_dropdown.php",
                    method: "POST",
                    data: {
                        action: action,
                        FrLocations: FrLocations
                    },
                    success: function(data) {
                        console.log(data);
                        $("#autocomplete-list2").empty().show();
                        currentFocus2 = -1;

                        if (data.length === 0) {
                            $("#autocomplete-list2").hide();
                            return;
                        }

                        data.forEach(function(item) {
                            $("#autocomplete-list2").append(`<div class="autocomplete-item" onclick="getFrDetails(${item.id})">${item.ShopName}-${item.Phone}</div>`);
                        });

                        $(".autocomplete-item").on("click", function() {
                            $("#FrLocations").val($(this).text());
                            $("#autocomplete-list2").hide();
                        });
                    }
                });
            });

            $("#FrLocations").on("keydown", function(e) {
                let items = $(".autocomplete-item");

                if (e.key === "ArrowDown") {
                    currentFocus2++;
                    if (currentFocus2 >= items.length) currentFocus2 = 0;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "ArrowUp") {
                    currentFocus2--;
                    if (currentFocus2 < 0) currentFocus2 = items.length - 1;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "Enter") {
                    e.preventDefault();
                    if (currentFocus2 > -1 && items[currentFocus2]) {
                        items.eq(currentFocus2).click();
                    }
                }
            });

            function setActive(items) {
                items.removeClass("active");
                if (currentFocus2 >= 0 && currentFocus2 < items.length) {
                    items.eq(currentFocus2).addClass("active");
                    items.eq(currentFocus2)[0].scrollIntoView({
                        block: "nearest"
                    });
                }
            }

            $(document).click(function(e) {
                if (!$(e.target).closest("#FrLocations, #autocomplete-list2").length) {
                    $("#autocomplete-list2").hide();
                }
            });
        });

        function getFrDetails(id) {
            $('#Locations').val(id);
        }
    </script>
    
    
    <script type="text/javascript">
        let currentFocus3 = -1;

        $(document).ready(function() {
            $("#ProductName").on("input", function() {
                let ProductName = $(this).val();
                if (ProductName.length === 0) {
                    $("#autocomplete-list3").hide();
                    return;
                }
                var action = "getProductList";
                var FrId = $('#Locations').val();
                $.ajax({
                    url: "ajax_files/ajax_dropdown.php",
                    method: "POST",
                    data: {
                        action: action,
                        ProductName: ProductName,
                        FrId:FrId
                    },
                    success: function(data) {
                        console.log(data);
                        $("#autocomplete-list3").empty().show();
                        currentFocus3 = -1;

                        if (data.length === 0) {
                            $("#autocomplete-list3").hide();
                            return;
                        }

                        data.forEach(function(item) {
                            $("#autocomplete-list3").append(`<div class="autocomplete-item" onclick="getAvailProdStock(${item.id})">${item.ProductName}</div>`);
                        });

                        $(".autocomplete-item").on("click", function() {
                            $("#ProductName").val($(this).text());
                            $("#autocomplete-list3").hide();
                        });
                    }
                });
            });

            $("#ProductName").on("keydown", function(e) {
                let items = $(".autocomplete-item");

                if (e.key === "ArrowDown") {
                    currentFocus3++;
                    if (currentFocus3 >= items.length) currentFocus3 = 0;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "ArrowUp") {
                    currentFocus3--;
                    if (currentFocus3 < 0) currentFocus3 = items.length - 1;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "Enter") {
                    e.preventDefault();
                    if (currentFocus3 > -1 && items[currentFocus3]) {
                        items.eq(currentFocus3).click();
                    }
                }
            });

            function setActive(items) {
                items.removeClass("active");
                if (currentFocus3 >= 0 && currentFocus3 < items.length) {
                    items.eq(currentFocus3).addClass("active");
                    items.eq(currentFocus3)[0].scrollIntoView({
                        block: "nearest"
                    });
                }
            }

            $(document).click(function(e) {
                if (!$(e.target).closest("#ProductName, #autocomplete-list3").length) {
                    $("#autocomplete-list3").hide();
                }
            });
        });

        function getFrDetails(id) {
            $('#Locations').val(id);
        }
        
        function showAddButton(srno, val) {
            if (val == 'Yes') {
                $('#showbutton' + srno).show();
                $('#submit').prop('disabled', false);
                
            } else {
                $('#showbutton' + srno).hide();
                $('#showcart2' + srno).html('');
                $('#submit').prop('disabled', false);
            }
    
        }
        function openModal(srno) {
            $('#myModal').modal('show');
            $('#prdsrno').val(srno);
            displayCart();
        }
        
       function addToCart() {
            var action = "addToCart";
            var code = $('#code').val();
            var ProdId = $('#ProdId').val();
            var quantity = $('#Qty').val();
            var Unit = $('#Unit').val();
            var PurchasePrice = $('#PurchasePrice').val();
            var SellPrice = $('#SellPrice').val();
            var prdsrno = $('#prdsrno').val();
            if (ProdId == '') {
                alert("Please Select Product");
            } else if (quantity == '') {
                alert("Please Enter Qty");
            } else {
                $.ajax({
                    url: "ajax_files/ajax_exp_mult_products.php",
                    method: "POST",
                    data: {
                        action: action,
                        code: code,
                        quantity: quantity,
                        id: ProdId,
                        PurchasePrice: PurchasePrice,
                        SellPrice: SellPrice,
                        prdsrno: prdsrno,
                        Unit:Unit
                    },
                    beforeSend: function() {
                        $('#add').attr('disabled', 'disabled');
                        $('#add').text('Please Wait...');
                    },
                    success: function(data) {
                        //alert(data);
                        console.log(data);
                        displayCart();
                        $('#add').attr('disabled', false);
                        $('#add').text('Add');
                        $('#code').val('');
                        $('#ProductName').val('');
                        $('#ProdId').val(0).attr("selected", true);
                        $('#Qty').val('');
                        $('#Unit').val('');
                        $('#PurchasePrice').val('');
                        $('#SellPrice').val('');
                        $('#AvailStock').val('');
                        
                    }
                });
            }
        }

        function displayCart() {
            var action = "displayCart";
            var prdsrno = $('#prdsrno').val();
            $.ajax({
                url: "ajax_files/ajax_exp_mult_products.php",
                type: "POST",
                data: {
                    action: action,
                    prdsrno: prdsrno
                },
                success: function(data) {
                    console.log(data);
                    $('#showcart').html(data);
                    $('#showcart2' + prdsrno).html(data);
                    calTotalQty();
                    calTotal_Amt();
                    calTotAmt();
                },

            });
        }

        function calTotalQty() {
             var prdsrno = $('#prdsrno').val();
            var action = "calTotalQty";
            $.ajax({
                url: "ajax_files/ajax_exp_mult_products.php",
                type: "POST",
                data: {
                    action: action,
                    prdsrno:prdsrno
                },
                success: function(data) {
                    console.log(data);
                    if(data <= 0){
                        $('#submit').prop('disabled', false);
                    }
                    else{
                        $('#submit').prop('disabled', false);
                    }
                    //$('#TotQty').val(data);
                },

            });
        }
        
        function calTotal_Amt() {
             var prdsrno = $('#prdsrno').val();
            var action = "calTotalAmt";
            $.ajax({
                url: "ajax_files/ajax_exp_mult_products.php",
                type: "POST",
                data: {
                    action: action,
                    prdsrno:prdsrno
                },
                success: function(data) {
                   //alert(data);
                   $('#TotalAmt'+ prdsrno).val(data);
                },

            });
        }
        
        

        function delete_prod(code) {
            var prdsrno = $('#prdsrno').val();
            if (confirm("Are you sure you want to delete Record?")) {
                var action = "delete_cart_prod";
                $.ajax({
                    url: "ajax_files/ajax_exp_mult_products.php",
                    type: "POST",
                    data: {
                        action: action,
                        code: code,
                        prdsrno: prdsrno
                    },
                    success: function(data) {
                        console.log(data);
                        displayCart();

                    },

                });
            }
        }

        function getProdDetails(id) {
            var action = "getProdDetails";
            $.ajax({
                url: "ajax_files/ajax_exp_mult_products.php",
                method: "POST",
                data: {
                    action: action,
                    id: id
                },
                success: function(data) {
                    //alert(data);
                    console.log(data);
                    var res = JSON.parse(data);
                    $('#PurchasePrice').val(res.PurchasePrice);
                    $('#SellPrice').val(res.MinPrice);
                    $('#code').val(res.code);
                    $('#Unit').val(res.Unit);

                }
            });
        }

        function getAvailProdStock(id) {
            $('#ProdId').val(id);
            getProdDetails(id);
            var action = "getAvailProdStock";
            $.ajax({
                url: "ajax_files/ajax_exp_mult_products.php",
                method: "POST",
                data: {
                    action: action,
                    id: id
                },
                success: function(data) {
                    //alert(data);
                    console.log(data);
                    $('#AvailStock').val(data);

                }
            });
        }
    </script>
    
    <script>
        $(document).ready(function() {
            $('#validation-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "ajax_files/ajax_vendor_expenses_2.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#submit').attr('disabled', 'disabled');
                        $('#submit').text('Please Wait...');
                    },
                    success: function(data) {
                        //alert(data);exit();
                        //console.log(data);exit();

                        if (data == 1) {
                            // Android.saveProductClick();
                            // toastr.success('Your expenses request successfully submitted.!', 'Success', {timeOut: 5000}); 
                            setTimeout(function() {
                                swal({
                                        title: "Thank you",
                                        text: "Your expenses request successfully submitted.",
                                        type: "success",
                                        confirmButtonText: "OK"
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            window.location.href = "view-vendor-expenses-2.php";
                                        }
                                    });
                            });

                        }
                        else if(data == 0){
                            setTimeout(function() {
    swal({
        title: "Error",
        text: "Same Amount - Same Date Expense is not allowed.",
        type: "error", // use 'icon' instead of 'type' in newer SweetAlert versions
        button: "OK"
    }).then((isConfirm) => {
        // You can handle any logic after confirmation here, if needed
    });
}, 100);
                        }



                        $('#submit').attr('disabled', false);
                        $('#submit').text('Update');
                    }
                })
            });


        });
    </script>

</body>

</html>