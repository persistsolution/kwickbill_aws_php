<?php session_start();
require_once 'config.php';
require_once("dbcontroller.php");
$db_handle = new DBController();
require_once 'auth.php';
$PageName = "Add Expenses";
$UserId = $_SESSION['User']['id'];

//echo "<pre>";print_r($_SESSION["cart_item2"]);exit();
if($_GET['id']!=''){
    $ExpId = $_GET['id'];
    $sql = "SELECT * FROM tbl_emp_expense_prod_items WHERE ExpId='$ExpId'";
    $row = getList($sql);
    foreach($row as $result){
        $ProdType = $result['ProdType'];
        $prdsrno = $result['srno'];
        // if($ProdType == 0){
        //     $ProdId = $result['MainProdId'];
        // }
        // else{
        // $ProdId = $result['ProdId'];
        // }
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">

    <style>
        .expense-block {
            position: relative;
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .btn-group-container {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
            padding: 10px 20px;
        }

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
        $sql = "SELECT ShopName,Phone FROM tbl_users_bill WHERE id='$UnderFrId'";
        $row = getRecord($sql);
        $FrLocations = $row['ShopName'] . "-" . $row['Phone'];

        $sql55 = "SELECT * FROM tbl_company_emails WHERE id=1";
        $row55 = getRecord($sql55);

        $id = $_GET['id'];
        $sql7 = "SELECT * FROM tbl_expense_request WHERE id='$id'";
        $res7 = $conn->query($sql7);
        $row7 = $res7->fetch_assoc();
        if($id == ''){
            $ExpDate = date('Y-m-d');
        }
        else{
            $ExpDate = $row7['ExpenseDate'];
        }
        ?>


        <div class="main-container">
            <div class="container">

                <div class="card">
                    <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                        <div class="card-body">
                            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                            <input type="hidden" id="TempPrdId" name="TempPrdId" value="<?php echo rand(10000, 99999); ?>">
                            <input type="hidden" id="TempPrdId2" name="TempPrdId2" value="<?php echo rand(10000, 99999); ?>">
                            <input type="hidden" name="action" value="saveExpenses" id="action">

                        
                            <div class="form-group float-label active">
                                <select class="form-control" name="Claims" id="Claims" required>
                                    <option value="1" <?php if ($row7["Claims"] == 1) { ?> selected <?php } ?>>
                                        Regular Claims</option>
                                    <option value="2" <?php if ($row7["Claims"] == 2) { ?> selected <?php } ?>>
                                        New Execution</option>

                                </select>
                                <label class="form-control-label">Expense Claim</label>
                            </div>

                            <div class="form-group float-label active">
                                <input type="text" class="form-control" autocomplete="off" name="FrLocations" id="FrLocations" placeholder="search Franchise..." value="<?php echo $FrLocations; ?>" required onClick="this.select();" <?php if($_GET['id']!=''){?> readonly <?php } ?>>
                                <div id="autocomplete-list2" class="autocomplete-list" style="display: none; position: absolute;"></div>
                                <label class="form-control-label">Franchise <span class="text-danger">*</span></label>
                            </div>

                            <div class="form-group float-label active">
                                <input type="text" class="form-control" name="FrId" id="FrId" value="<?php echo $UnderFrId; ?>" readonly>
                                <label class="form-control-label">Location ID <span class="text-danger">*</span></label>
                            </div>


                        </div>


                        <div id="expenseContainer">
                            <?php 
                            $i = 1;
                            $sql33 = "SELECT * FROM tbl_expense_request_items WHERE ExpId='$id'";
                            $row33 = getList($sql33);
                            foreach ($row33 as $result33) {
                            ?>
                                <div class="form-row expense-block" style="padding-left: 20px;border: 1px solid;padding-top: 10px;margin-top: 10px;">
                                    <input type="hidden" name="srno[]" class="srno" id="srno<?php echo $i;?>" value="<?php echo $i;?>">

<div class="form-group float-label active">
                                <select class="form-control" name="ExpCatId[]" id="ExpCatId<?php echo $i;?>" required  onchange="checkExpCatId(this.value,<?php echo $i;?>)">
                                   <option selected="" value="" disabled>Select Expense Category</option>


                                    <?php
                                    $sql33 = "SELECT * FROM `tbl_expenses_category` WHERE Status=1";
                                    $row33 = getList($sql33);
                                    foreach ($row33 as $result) {
                                    ?>
                                        <option value="<?php echo $result['id']; ?>" <?php if ($result33["ExpCatId"] == $result['id']) { ?> selected <?php } ?>>
                                            <?php echo $result['Name']; ?></option>
                                    <?php } ?>
                                </select>
                                <label class="form-control-label">Expense Category</label>
                            </div>
                            
                                    <div class="form-group float-label active col-6">
                                        <input type="text" class="form-control txt" name="Amount[]" id="Amount<?php echo $i;?>" value="<?php echo $result33['Amount']; ?>" autofocus required oninput="calTotAmt()">
                                        <label class="form-control-label">Amount</label>
                                    </div>

                                    <div class="form-group float-label active col-6">
                                        <input type="date" class="form-control" name="ExpenseDate[]" id="ExpenseDate<?php echo $i;?>" value="<?php echo $result33['ExpenseDate']; ?>" required onchange="checkDate(this.value,<?php echo $i;?>)">
                                        <label class="form-control-label">Expense Date</label>
                                    </div>


                                    <div class="form-group float-label active col-6">
                                        <select class="form-control" name="PaymentMode[]" id="PaymentMode<?php echo $i;?>" required>
                                            <option selected="" value="" disabled>Select Payment Type</option>
                                            <option value="Cash" <?php if ($result33["PaymentMode"] == 'Cash') { ?> selected <?php } ?>>
                                                By Cash</option>
                                            <option value="Online" <?php if ($result33["PaymentMode"] == 'Online') { ?> selected <?php } ?>>
                                                By Online</option>
                                        </select>
                                        <label class="form-control-label">Payment Type</label>
                                    </div>

                                    <div class="form-group float-label active col-6">
                                        <input type="number" class="form-control" name="VedPhone[]" id="VedPhone<?php echo $i;?>" value="<?php echo $result33['VedPhone']; ?>" required>
                                        <label class="form-control-label">Vendor Mobile No</label>
                                    </div>


                                    <div class="form-group float-label active col-12">
                                        <input type="text" class="form-control" id="Narration<?php echo $i;?>" name="Narration[]" value="<?php echo $result33['Narration']; ?>" required>
                                        <label class="form-control-label">Narration</label>
                                    </div>

                                   <div class="form-group col-12 file-upload-block">
                                        <label class="upload-label">Upload Receipt</label>
                                        <label for="Photo1" class="custom-file-upload" id="PhotoPreviewBox<?php echo $i;?>">
                                            <div class="upload-box-content">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span>Click or Drag file here to upload (.png)</span>
                                            </div>
                                        </label>
                                        <input type="file" id="Photo<?php echo $i;?>" name="Photo[]" accept=".png">
                                        <input type="hidden" name="OldPhoto[]" id="OldPhoto<?php echo $i;?>" value="<?php echo $result33['Photo']; ?>">
                                        <?php if ($result33['Photo'] != '') { ?>
                                            <a class="old-file-link" href="../expense_files/<?php echo $result33['Photo']; ?>" target="_blank"><?php echo $result33['Photo']; ?></a>
                                        <?php } ?>
                                    </div>


                                    
                                    <div class="form-group col-12 file-upload-block">
                                        <label class="upload-label">Upload Payment Receipt</label>
                                        <label for="Photo21" class="custom-file-upload" id="Photo2PreviewBox<?php echo $i;?>">
                                            <div class="upload-box-content">
                                                <i class="fas fa-file-image"></i>
                                                <span>Click to upload (.png)</span>
                                            </div>
                                        </label>
                                        <input type="file" id="Photo2<?php echo $i;?>" name="Photo2[]" accept=".png">
                                        <input type="hidden" name="OldPhoto2[]" id="OldPhoto2<?php echo $i;?>" value="<?php echo $result33['Photo2']; ?>">
                                        <?php if ($result33['Photo2'] != '') { ?>
                                            <a class="old-file-link" href="../expense_files/<?php echo $result33['Photo2']; ?>" target="_blank">View Existing Receipt</a>
                                        <?php } ?>
                                    </div>

                                    <!-- Upload PDF -->
                                    <div class="form-group col-12 file-upload-block">
                                        <label class="upload-label">Upload PDF</label>
                                        <label for="Photo31" class="custom-file-upload" id="Photo3PreviewBox<?php echo $i;?>">
                                            <div class="upload-box-content">
                                                <i class="fas fa-file-pdf"></i>
                                                <span>Click to upload (.pdf)</span>
                                            </div>
                                        </label>
                                        <input type="file" id="Photo3<?php echo $i;?>" name="Photo3[]" accept=".pdf">
                                        <input type="hidden" name="OldPhoto3[]" id="OldPhoto3<?php echo $i;?>" value="<?php echo $result33['Photo3']; ?>">
                                        <?php if ($result33['Photo3'] != '') { ?>
                                            <a class="old-file-link" href="../expense_files/<?php echo $result33['Photo3']; ?>" target="_blank">View Existing PDF</a>
                                        <?php } ?>
                                    </div>


                                   
                                    <div class="form-group col-12 file-upload-block">
                                        <label class="upload-label">Upload Product Image</label>
                                        <label for="Photo41" class="custom-file-upload" id="Photo4PreviewBox<?php echo $i;?>">
                                            <div class="upload-box-content">
                                                <i class="fas fa-box-open"></i>
                                                <span>Click to upload (.png)</span>
                                            </div>
                                        </label>
                                        <input type="file" id="Photo4<?php echo $i;?>" name="Photo4[]" accept=".png">
                                        <input type="hidden" name="OldPhoto4[]" id="OldPhoto4<?php echo $i;?>" value="<?php echo $result33['Photo4']; ?>">
                                        <?php if ($result33['Photo4'] != '') { ?>
                                            <a class="old-file-link" href="../expense_files/<?php echo $result33['Photo4']; ?>" target="_blank">View Existing Product Image</a>
                                        <?php } ?>
                                    </div>
                                    
                                     
                                      <div class="form-group float-label active col-12">
                                    <input type="file" class="form-control" id="Photo5<?php echo $i;?>" accept=".png" multiple onchange="convertToPDF(<?php echo $i;?>)">
                                    <label class="form-control-label">Upload Multiple Photo For Making PDF</label>
                                    </div>
                                    <input type="hidden" class="form-control" name="PdfLink[]" id="PdfLink<?php echo $i;?>" value="<?php echo $result33['PdfLink']; ?>" autofocus readonly>
                                   <!-- <div style="padding-top:5px;">
                                    <button type="button" class="btn btn-info btn-sm" onclick="convertToPDF(<?php echo $i;?>)" id="makepdf<?php echo $i; ?>">Make Pdf Link</button>
                                    </div>-->
                                
                                

 
 <!--<div class="form-group float-label active col-12">
                                    <input type="text" class="form-control" name="PdfLink[]" id="PdfLink<?php echo $i;?>" value="<?php echo $result33['PdfLink']; ?>" autofocus readonly>
                                    <label class="form-control-label">PDF LInk</label>
                                </div>-->
                               



                                    <div class="form-group float-label active col-12">
                                        <select class="form-control" name="Gst[]" id="Gst<?php echo $i;?>" required>
                                            <!--<option selected="" value="" disabled>GST</option>-->
                                            <option value="No" <?php if ($result33["Gst"] == 'No') { ?> selected <?php } ?>>
                                                No</option>
                                            <option value="Yes" <?php if ($result33["Gst"] == 'Yes') { ?> selected <?php } ?>>
                                                Yes</option>

                                        </select>
                                        <label class="form-control-label">GST</label>
                                    </div>

                                    <div class="form-group float-label active col-10">
                                        <select class="form-control product-select" name="Product[]" id="Product<?php echo $i;?>" required onchange="showAddButton(<?php echo $i;?>,this.value)">
                                            <!--<option selected="" value="" disabled>GST</option>-->
                                             <option value="Yes" <?php if ($result33["Product"] == 'Yes') { ?> selected <?php } ?>>
                                                Yes</option>
                                            <option value="No" <?php if ($result33["Product"] == 'No') { ?> selected <?php } ?>>
                                                No</option>
                                           

                                        </select>
                                       <label class="form-control-label" style="font-size: 10px;font-weight: 500;">Did You Purchase Inventory Product?</label>
                                    </div>



                                    <div class="form-group float-label active col-2 showbutton" id="showbutton<?php echo $i;?>" <?php if ($result33["Product"] == 'Yes') { ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?>>
                                        <button type="button" class="btn btn-info openmodal" onclick="openModal(<?php echo $i;?>)">+</button>
                                    </div>


                                    <div class="col-lg-12 showcart" id="showcart2<?php echo $i;?>" style="overflow-x: auto; width: 100%;">
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
        $prdsrno = $result33["srno"];
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


<input type="hidden" id="TotalAmt<?php echo $i;?>" value="<?php echo $totamt;?>" class="form-control">
                                    <div class="btn-group-container" style="display: flex; gap: 10px; justify-content: flex-start; padding: 10px 20px;">
                                   <!--     <button type="button" class="btn btn-success" onclick="addExpenseRow()">+ Add</button>-->
                                        <button type="button" class="btn btn-danger remove-btn" onclick="this.closest('.expense-block').remove();">&times; Remove</button>
                                    </div>


                                </div>
                            <?php $i++;
                            } ?>

<input type="hidden" name="rncnt" id="rncnt" value="<?php echo $i;?>">
                            <div class="form-row expense-block" style="padding-left: 20px;border: 1px solid;padding-top: 10px;margin-top: 10px;">
                                <input type="hidden" name="srno[]" class="srno" id="srno<?php echo $i;?>" value="<?php echo $i;?>">

<div class="form-group float-label active">
                                <select class="form-control" name="ExpCatId[]" id="ExpCatId<?php echo $i;?>" onchange="checkExpCatId(this.value,<?php echo $i;?>)" required>
                                    <option selected="" value="" disabled>Select Expense Category</option>


                                    <?php
                                    $sql33 = "SELECT * FROM `tbl_expenses_category` WHERE Status=1";
                                    $row33 = getList($sql33);
                                    foreach ($row33 as $result) {
                                    ?>
                                        <option value="<?php echo $result['id']; ?>" <?php if ($row7["ExpCatId"] == $result['id']) { ?> selected <?php } ?>>
                                            <?php echo $result['Name']; ?></option>
                                    <?php } ?>
                                </select>
                                <label class="form-control-label">Expense Category</label>
                            </div>
                            
                                <div class="form-group float-label active col-6">
                                    <input type="text" class="form-control txt" name="Amount[]" id="Amount<?php echo $i;?>" value="" autofocus oninput="calTotAmt()" required>
                                    <label class="form-control-label">Amount</label>
                                </div>

                                <div class="form-group float-label active col-6">
                                    <input type="date" class="form-control" name="ExpenseDate[]" id="ExpenseDate<?php echo $i;?>" value="" onchange="checkDate(this.value,<?php echo $i;?>)" required>
                                    <label class="form-control-label">Expense Date</label>
                                </div>


                                <div class="form-group float-label active col-6">
                                    <select class="form-control" name="PaymentMode[]" id="PaymentMode<?php echo $i;?>" required>
                                        <option selected="" value="" disabled>Select Payment Type</option>
                                        <option value="Cash">
                                            By Cash</option>
                                        <option value="Online">
                                            By Online</option>
                                    </select>
                                    <label class="form-control-label">Payment Type</label>
                                </div>

                                <div class="form-group float-label active col-6">
                                    <input type="number" class="form-control" name="VedPhone[]" id="VedPhone<?php echo $i;?>" value="" required>
                                    <label class="form-control-label">Vendor Mobile No</label>
                                </div>


                                <div class="form-group float-label active col-12">
                                    <input type="text" class="form-control" id="Narration<?php echo $i;?>" name="Narration[]" value="" required>
                                    <label class="form-control-label">Narration</label>
                                </div>

                                <div class="form-group col-12 file-upload-block">
                                    <label class="upload-label">Upload Receipt</label>
                                    <label for="Photo<?php echo $i;?>" class="custom-file-upload" id="PhotoPreviewBox<?php echo $i;?>">
                                        <div class="upload-box-content">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <span>Click or Drag file here to upload (.png)</span>
                                        </div>
                                    </label>
                                    <input type="file" id="Photo<?php echo $i;?>" name="Photo[]" accept=".png">
                                  
                                </div>


                              
                                <div class="form-group col-12 file-upload-block">
                                    <label class="upload-label">Upload Payment Receipt</label>
                                    <label for="Photo2<?php echo $i;?>" class="custom-file-upload" id="Photo2PreviewBox<?php echo $i;?>">
                                        <div class="upload-box-content">
                                            <i class="fas fa-file-image"></i>
                                            <span>Click to upload (.png)</span>
                                        </div>
                                    </label>
                                    <input type="file" id="Photo2<?php echo $i;?>" name="Photo2[]" accept=".png">
                                   
                                </div>

                                <!-- Upload PDF -->
                                <div class="form-group col-12 file-upload-block">
                                    <label class="upload-label">Upload PDF</label>
                                    <label for="Photo3<?php echo $i;?>" class="custom-file-upload" id="Photo3PreviewBox<?php echo $i;?>">
                                        <div class="upload-box-content">
                                            <i class="fas fa-file-pdf"></i>
                                            <span>Click to upload (.pdf)</span>
                                        </div>
                                    </label>
                                    <input type="file" id="Photo3<?php echo $i;?>" name="Photo3[]" accept=".pdf">
                                   
                                </div>


                                <!-- Upload Product Image -->
                               <div class="form-group col-12 file-upload-block">
                                    <label class="upload-label">Upload Product Image</label>
                                    <label for="Photo4<?php echo $i;?>" class="custom-file-upload" id="Photo4PreviewBox<?php echo $i;?>">
                                        <div class="upload-box-content">
                                            <i class="fas fa-box-open"></i>
                                            <span>Click to upload (.png)</span>
                                        </div>
                                    </label>
                                    <input type="file" id="Photo4<?php echo $i;?>" name="Photo4[]" accept=".png">
                                   
                                </div>


                              <div class="form-group float-label active col-12">
                                    <input type="file" class="form-control" id="Photo5<?php echo $i;?>" accept=".png" multiple onchange="convertToPDF(<?php echo $i;?>)">
                                    <label class="form-control-label">Upload Multiple Photo For Making PDF</label>
                                    </div>
                                     <input type="hidden" class="form-control" name="PdfLink[]" id="PdfLink<?php echo $i;?>" value="" autofocus readonly>
                                    <!--<div style="padding-top:5px;">
                                    <button type="button" class="btn btn-info btn-sm" onclick="convertToPDF(<?php echo $i;?>)" id="makepdf<?php echo $i; ?>">Make Pdf Link</button>
                                    </div>-->
                                
                                


 <!--<div class="form-group float-label active col-12">
                                    <input type="text" class="form-control" name="PdfLink[]" id="PdfLink<?php echo $i;?>" value="" autofocus readonly>
                                    <label class="form-control-label">PDF LInk</label>
                                </div>-->


                                <!--<div class="form-group col-12 file-upload-block">
                                    <label class="upload-label">Upload Multiple Receipt</label>
                                    <label for="Photo5<?php echo $i;?>" class="custom-file-upload" id="Photo5PreviewBox<?php echo $i;?>">
                                        <div class="upload-box-content">
                                            <i class="fas fa-box-open"></i>
                                            <span>Click to upload (.png)</span>
                                        </div>
                                    </label>
                                    <input type="file" id="Photo5<?php echo $i;?>" name="Photo5[]" multiple accept=".png">
                                     <div id="photo-info" class="file-info"></div>
                                </div>-->
                             

                                <div class="form-group float-label active col-12">
                                    <select class="form-control" name="Gst[]" id="Gst<?php echo $i;?>">
                                        <!--<option selected="" value="" disabled>GST</option>-->
                                        <option value="No" >
                                            No</option>
                                        <option value="Yes" >
                                            Yes</option>

                                    </select>
                                    <label class="form-control-label">GST</label>
                                </div>

                                <div class="form-group float-label active col-10">
                                    <select class="form-control product-select" name="Product[]" id="Product<?php echo $i;?>" onchange="showAddButton(<?php echo $i;?>,this.value)">
                                        <!--<option selected="" value="" disabled>GST</option>-->
                                        <option value="No" >
                                            No</option>
                                        <option value="Yes" selected>
                                            Yes</option>

                                    </select>
                                    <label class="form-control-label" style="font-size: 10px;font-weight: 500;">Did You Purchase Inventory Product?</label>
                                </div>


                                <div class="form-group float-label active col-2 showbutton" id="showbutton<?php echo $i;?>" style="display:block;">
                                    <button type="button" class="btn btn-info openmodal" onclick="openModal(<?php echo $i;?>)">+</button>
                                </div>


                                <div class="col-lg-12 showcart" id="showcart2<?php echo $i;?>"  style="overflow-x: auto; width: 100%;">


                                </div>

<input type="hidden" id="TotalAmt<?php echo $i;?>" class="form-control">

                              <!--<div class="btn-group-container" style="display: flex; gap: 10px; justify-content: flex-start; padding: 10px 20px;">
                                    <button type="button" class="btn btn-success" onclick="addExpenseRow()">+ Add</button>

                                </div>-->


                            </div>

                        </div>
                </div>
                <br>

                <div class="form-row" style="padding-left: 20px;">
                    <div class="form-group float-label active col-6">
                        <input type="text" class="form-control" id="TotAmt" name="TotAmt" value="<?php echo $row7['Amount']; ?>" readonly>
                        <label class="form-control-label">Total Amount</label>
                    </div>
                    <div class="form-group float-label active col-6">
                        <input type="date" class="form-control" id="ExpDate" name="ExpDate" value="<?php echo $ExpDate; ?>" required readonly>
                        <label class="form-control-label">Date</label>
                    </div>
                    <div class="form-group float-label active col-12">
                        <input type="text" class="form-control" id="Remark" name="Remark" value="<?php echo $row7['Narration']; ?>" required>
                        <label class="form-control-label">Remark/Meesage</label>
                    </div>
                    <div class="form-group float-label active col-12">
                        <select class="form-control product-select" name="SendToApproval" id="SendToApproval" required >
                            <!--<option selected="" value="" disabled>GST</option>-->

                            <option value="Yes" <?php if ($row7["SendToApproval"] == 'Yes') { ?> selected <?php } ?>>
                                Yes</option>
                            <option value="No" <?php if ($row7["SendToApproval"] == 'No') { ?> selected <?php } ?>>
                                No</option>

                        </select>
                        <label class="form-control-label">Send it for Approval</label>
                    </div>
                </div>


                <input type="hidden" name="CreatedBy" value="<?php echo $_SESSION['User']['id']; ?>" id="CreatedBy">

                <div class="card-footer">
                    <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit" disabled>Submit</button>
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
    
    <div id="loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999; backdrop-filter: blur(4px);">
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); text-align:center; width:300px;">
        <div class="progress" style="height: 25px;">
            <div id="loading-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                 role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                0%
            </div>
        </div>
        <p style="margin-top:15px; font-size:16px;">Saving your data, please wait...</p>
    </div>
</div>


<div id="loading-overlay2" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999; backdrop-filter: blur(4px);">
    <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); text-align:center;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
        <p id="loading-percentage2" style="margin-top:10px; font-weight:bold; font-size:18px;">0%</p>
        <p style="font-size:16px;">Converting your photos into pdf. Please wait</p>
    </div>
</div>



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
    <script>
   
    function checkExpCatId(val, srno) {
    var $select = $('#Product' + srno);
    $select.empty(); // Clear all options

    if (val == 1) {
        // Add only 'Yes' option
        $select.append('<option value="Yes" selected>Yes</option>');
        showAddButton(srno, 'Yes');
    } else {
        // Add both options
        $select.append('<option value="No">No</option>');
        $select.append('<option value="Yes">Yes</option>');
        
        // Default select "No" or maintain selection logic
        $select.val('No');
        showAddButton(srno, 'No');
    }
}
        let expenseRowCount = $('#rncnt').val();
        // Initialize preview for all 4 image inputs dynamically
        showPreview('Photo' + expenseRowCount, 'PhotoPreviewBox' + expenseRowCount);
        showPreview('Photo2' + expenseRowCount, 'Photo2PreviewBox' + expenseRowCount);
        showPreview('Photo3' + expenseRowCount, 'Photo3PreviewBox' + expenseRowCount);
        showPreview('Photo4' + expenseRowCount, 'Photo4PreviewBox' + expenseRowCount);
        showPreviewMultiple('Photo5' + expenseRowCount, 'Photo5PreviewBox' + expenseRowCount);

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

 function showPreviewMultiple(inputId, previewBoxId) {
        const input = document.getElementById(inputId);
        const box = document.getElementById(previewBoxId);

        if (!input || !box) return;

        input.addEventListener('change', function () {
        const files = this.files;
        previewBox.innerHTML = ''; // Clear existing previews

        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-img-inside';
                    previewBox.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                const div = document.createElement('div');
                div.className = 'upload-box-content';
                div.innerHTML = `<i class="fas fa-file"></i><span>${file.name}</span>`;
                previewBox.appendChild(div);
            }
        });
    });
    }
    
   function checkProdAdd(srno) {
    const action = "checkProdAdd";
    return $.ajax({
        url: "ajax_files/ajax_exp_mult_products.php",
        method: "POST",
        data: {
            action: action,
            srno: srno
        }
    });
}

 function checkDate(date, srno) {
    if (!date) return false;

    const selectedDate = new Date(date);
    const today = new Date();

    selectedDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);

    const timeDiff = today - selectedDate;
    const daysDiff = timeDiff / (1000 * 60 * 60 * 24);

    if (daysDiff > 20) {
        swal({
            title: "Error",
            text: "You cannot claim this expense. The expense date is more than 20 days old.",
            type: "error",
            confirmButtonText: "OK"
        });
        $('#submit').prop('disabled', true);
        return false;
    } else {
        $('#submit').prop('disabled', false);
        return true;
    }
}

function addExpenseRow() {
    console.log(expenseRowCount);
    
   const ExpenseDate = $('#ExpenseDate' + expenseRowCount).val();
if (!checkDate(ExpenseDate, expenseRowCount)) {
    return; // Will now correctly stop only if the date is invalid
}

    const Product = $('#Product' + expenseRowCount).val();
    const TotalAmt = parseFloat($('#TotalAmt' + expenseRowCount).val()) || 0;
    const Amount = parseFloat($('#Amount' + expenseRowCount).val()) || 0;

    // Always disable submit at start
    $('#submit').prop('disabled', true);

    const showMismatchAlert = () => {
        swal({
            title: "Error",
            text: "Expense Amount and Product Amount do not match",
            type: "error",
            confirmButtonText: "OK"
        });
    };

    const proceedWithLoading = () => {
        loadExpenseRow();
        $('#submit').prop('disabled', false);
    };

    // Case 1: Product is "Yes" – perform checks
    if (Product === 'Yes') {
        checkProdAdd(expenseRowCount).then(data => {
            console.log("CheckProdAdd Result:", data);

            if (parseInt(data) === 0) {
                swal({
                    title: "Error",
                    text: "Please add Purchase Inventory Product",
                    type: "error",
                    confirmButtonText: "OK"
                });
                return;
            }

            if (TotalAmt === Amount) {
                proceedWithLoading();
            } else {
                showMismatchAlert();
            }
        }).catch(error => {
            console.error("AJAX error in checkProdAdd:", error);
        });
    }

    // Case 2: Product is "No" – directly add row (skip amount match check)
    else {
        proceedWithLoading();
    }
}

function loadExpenseRow() {
    $('#submit').prop('disabled', true); // Keep disabled until next validation

    expenseRowCount++;
    const action = "getExpenseRow";

    $.ajax({
        url: "ajax_files/ajax_expenses_mult_prod.php",
        method: "POST",
        data: {
            action: action,
            id: expenseRowCount
        },
        success: function (data) {
            $('#expenseContainer').append(data);

            setTimeout(() => {
                showPreview('Photo' + expenseRowCount, 'PhotoPreviewBox' + expenseRowCount);
                showPreview('Photo2' + expenseRowCount, 'Photo2PreviewBox' + expenseRowCount);
                showPreview('Photo3' + expenseRowCount, 'Photo3PreviewBox' + expenseRowCount);
                showPreview('Photo4' + expenseRowCount, 'Photo4PreviewBox' + expenseRowCount);
                showPreviewMultiple('Photo5' + expenseRowCount, 'Photo5PreviewBox' + expenseRowCount);
            }, 100);
        }
    });
}

        /*function addExpenseRow() {
            const container = document.getElementById('expenseContainer');
            const lastBlock = container.querySelector('.expense-block:last-child');
            const newBlock = lastBlock.cloneNode(true);

            // Clear inputs except hidden srno
            newBlock.querySelectorAll('input').forEach(input => {
                if (input.type !== 'hidden') input.value = '';
            });

            newBlock.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            newBlock.querySelectorAll('a').forEach(a => a.remove());

            // Remove old button group if any
            const existingBtnGroup = newBlock.querySelector('.btn-group-container');
            if (existingBtnGroup) existingBtnGroup.remove();

            // Add new buttons
            const btnGroup = document.createElement('div');
            btnGroup.className = 'btn-group-container';
            btnGroup.style = 'display: flex; gap: 10px; justify-content: flex-start; padding: 10px 20px;';

            const addBtn = document.createElement('button');
            addBtn.type = 'button';
            addBtn.className = 'btn btn-success';
            addBtn.innerText = '+ Add';
            addBtn.onclick = addExpenseRow;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-danger remove-btn';
            removeBtn.innerHTML = '&times; Remove';
            removeBtn.onclick = function () {
                newBlock.remove();
                updateSrnoFields();
            };

            btnGroup.appendChild(addBtn);
            btnGroup.appendChild(removeBtn);
            newBlock.appendChild(btnGroup);

            container.appendChild(newBlock);
            updateSrnoFields();
        }*/

        function updateSrnoFields() {
            const srnos = document.querySelectorAll('.srno');
            //const showcarts = document.querySelectorAll('.showcart');
            const productSelects = document.querySelectorAll('.product-select');
            const showbutton = document.querySelectorAll('.showbutton');
            const openmodal = document.querySelectorAll('.openmodal');
            srnos.forEach((el, i) => {
                el.value = i + 1;
            });

            // showcarts.forEach((el, i) => {
            //     el.id = 'showcart' + (i + 1);
            // });

            productSelects.forEach((el, i) => {
                el.setAttribute('onchange', `showAddButton(${i + 1}, this.value)`);
                //$(`#showbutton${i + 1}`).hide();
            });

            showbutton.forEach((el, i) => {
                el.id = 'showbutton' + (i + 1);
            });

            openmodal.forEach((el, i) => {
                el.setAttribute('onclick', `openModal(${i + 1})`);
            });

        }

        function showAddButton(srno, val) {
            if (val == 'Yes') {
                $('#showbutton' + srno).show();
                $('#submit').prop('disabled', true);
                
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
            $('#FrId').val(id);
        }
    </script>


    <script>
        let currentFocus3 = -1;

        $(document).ready(function() {
            $("#ProductName").on("input", function() {
                let ProductName = $(this).val();
                if (ProductName.length === 0) {
                    $("#autocomplete-list3").hide();
                    return;
                }
                var action = "getProductList";
                var FrId = $('#FrId').val();
                $.ajax({
                    url: "ajax_files/ajax_dropdown.php",
                    method: "POST",
                    data: {
                        action: action,
                        ProductName: ProductName,
                        FrId: FrId
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
                        $('#submit').prop('disabled', true);
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
        function calTotAmt() {
    var prdsrno = $('#prdsrno').val();
    var prdamt = parseFloat($('#TotalAmt' + prdsrno).val()) || 0;
    var Amount = parseFloat($('#Amount' + prdsrno).val()) || 0;

    console.log("SR No:", prdsrno, "TotalAmt:", prdamt, "Amount:", Amount);

    if (prdamt === Amount) {
        $('#submit').prop('disabled', false);
    } else {
        $('#submit').prop('disabled', true);
    }

    getSubTotal(); 
}


        function getSubTotal() {
            var sum = 0;
            $(".txt").each(function() {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            $('#TotAmt').val(sum);

        }

        function getExpId(id) {
            $('#myModal').modal('show');
            $('.Exp_Id').val(id);
        }

        function uploadImageSingle(prdid) {
            //alert(prdid);
            var action = "save";
            var pageval = "expenses";
            //Android.uploadImageSingle(''+prdid+'',''+action+'',''+pageval+'');
        }

        function uploadImageSingle2(prdid) {
            //alert(prdid);
            var action = "saveexpimg2";
            var pageval = "expenses";
            // Android.uploadImageSingle(''+prdid+'',''+action+'',''+pageval+'');
        }

let progressInterval;

function simulateProgressBar() {
    let percent = 0;
    $('#loading-overlay').show();

    progressInterval = setInterval(function () {
        percent += Math.floor(Math.random() * 10) + 1;
        if (percent >= 95) percent = 95; // prevent hitting 100% too early

        $('#loading-progress-bar')
            .css('width', percent + '%')
            .attr('aria-valuenow', percent)
            .text(percent + '%');
    }, 200);
}

function completeProgressBar() {
    clearInterval(progressInterval);
    $('#loading-progress-bar')
        .css('width', '100%')
        .attr('aria-valuenow', 100)
        .text('100%');

    setTimeout(function () {
        $('#loading-overlay').fadeOut();
    }, 500);
}

let intervalId2;

function simulateProgress2() {
    let percent = 0;
    $('#loading-overlay2').show();
    intervalId = setInterval(function () {
        percent += Math.floor(Math.random() * 10) + 1;
        if (percent >= 100) percent = 99;
        $('#loading-percentage2').text(percent + "%");
    }, 200);
}

function stopProgress2() {
    clearInterval(intervalId2);
    $('#loading-percentage2').text("100%");
    setTimeout(function () {
        $('#loading-overlay2').fadeOut();
    }, 500);
}

      $(document).ready(function () {
    $('#validation-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "ajax_files/ajax_expenses_mult_prod.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#submit').attr('disabled', true).text('Please Wait...');
                simulateProgressBar();
            },
            success: function (data) {
                 completeProgressBar();
                $('#submit').attr('disabled', false).text('Submit');

                if (data == 1) {
                    setTimeout(function () {
                        swal({
                            title: "Thank you",
                            text: "Your expenses request successfully submitted.",
                            type: "success",
                            confirmButtonText: "OK"
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = "view-expenses-mult-prod.php";
                            }
                        });
                    }, 500);
                } else if (data == 0) {
                    setTimeout(function () {
                        swal({
                            title: "Error",
                            text: "Today same amount expenses request already exists!",
                            type: "error",
                            confirmButtonText: "OK"
                        });
                    }, 500);
                }
            }
        });
    });
});
        
        
            const uploadForm = document.getElementById('uploadForm');
    const progressContainer = document.getElementById('progress-container');
    const progressBar = document.querySelector('#progress-bar div');
    const progressText = document.getElementById('progress-text');
    const mainContent = document.getElementById('main-content');
    const submitButton = document.getElementById('submit');

  

    document.getElementById('photos').addEventListener('change', function (event) {
        const fileList = event.target.files;
        const infoDiv = document.getElementById('photo-info');
        if (fileList.length > 0) {
            const fileDetails = Array.from(fileList).map(file => `<li><span>${file.name}</span> - ${(file.size / 1024).toFixed(2)} KB</li>`).join('');
            infoDiv.innerHTML = `<ul>${fileDetails}</ul>`;
        } else {
            infoDiv.innerHTML = '';
        }
    });
    
    
    async function convertToPDF(srno) {
        simulateProgress2();
                        $('#makepdf'+srno).attr('disabled', 'disabled');
                        $('#makepdf'+srno).text('Please Wait...');
                    
      const input = document.getElementById('Photo5'+srno);
      const files = input.files;

      if (files.length === 0) return alert("Please upload at least one image.");

      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF();

      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const imgData = await readFileAsDataURL(file);
        const img = new Image();
        img.src = imgData;

        await new Promise(resolve => {
          img.onload = () => {
            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();

            let imgWidth = img.width;
            let imgHeight = img.height;

            // Calculate scaling
            const widthScale = pageWidth / imgWidth;
            const heightScale = pageHeight / imgHeight;
            const scale = Math.min(widthScale, heightScale);

            const finalWidth = imgWidth * scale;
            const finalHeight = imgHeight * scale;

            // Center image
            const x = (pageWidth - finalWidth) / 2;
            const y = (pageHeight - finalHeight) / 2;

            if (i !== 0) pdf.addPage();
            pdf.addImage(imgData, 'JPEG', x, y, finalWidth, finalHeight);
            resolve();
          };
        });
      }
    const randomDecimal = Math.random();
      // Save to user's device
      //pdf.save("pdffiles/converted-images"+randomDecimal+".pdf");

      // Upload to server
      const pdfBlob = pdf.output("blob");
      const formData = new FormData();
      formData.append("file", pdfBlob, "converted-images"+randomDecimal+".pdf");

      fetch("uploadmultphotos.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.text())
      .then(data => {
          $('#PdfLink'+srno).val('https://kwickfoods.in/pdffiles/converted-images'+randomDecimal+'.pdf');
          $('#makepdf'+srno).attr('disabled', false);
                        $('#makepdf'+srno).text('Make Pdf Link');
                        stopProgress2();
        // alert("PDF uploaded successfully.");
       // window.location.href="create-pdf.php?action=download&filename=converted-images"+randomDecimal+".pdf";
        // const viewer = document.getElementById('pdfViewer');
        // viewer.src = "pdffiles/converted-images"+randomDecimal+".pdf";  // show uploaded PDF
        // viewer.style.display = 'block';
      })
      .catch(error => {
        console.error("Upload Error:", error);
       // alert("PDF upload failed.");
      });
    }

function readFileAsDataURL(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
        reader.readAsDataURL(file);
      });
    }
    </script>

</body>

</html>