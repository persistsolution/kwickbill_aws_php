<?php session_start();
require_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['User']['id'];
$PageName = "Create Order";
$Page = "Recharge";
$WallMsg = "NotShow"; ?>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <?php include_once 'back-header.php'; ?>

        <!-- page content start -->

<?php
$frid = $_GET['frid'];
$sql = "SELECT ShopName FROM tbl_users_bill WHERE id='$frid'";
$row = getRecord($sql);

$sql2 = "SELECT COALESCE(MAX(id), 0) + 1 AS InvNo FROM tbl_vendor_stock_invoice";
$row2 = getRecord($sql2);
$InvNo = $row2['InvNo'];

if (isset($_POST['submit'])) {
    $frid = $_POST['frid'];
    $invoice_no = $_POST['invoice_no'];
    $invoice_date = $_POST['invoice_date'];
    $total_amt = $_POST['total_amt'];
    $narration = addslashes(trim($_POST['narration']));
    $created_at = date('Y-m-d H:i:s');
    
     $randno = rand(1, 100);
            $src = $_FILES['files']['tmp_name'];
            $fnm = substr($_FILES["files"]["name"], 0, strrpos($_FILES["files"]["name"], '.'));
            $fnm = str_replace(" ", "_", $fnm);
            $ext = substr($_FILES["files"]["name"], strpos($_FILES["files"]["name"], "."));
            $dest = '../uploads/' . $randno . "_" . $fnm . $ext;
            $imagepath =  $randno . "_" . $fnm . $ext;
            if (move_uploaded_file($src, $dest)) {
                $files = $imagepath;
            } else {
                $files = $_POST['OldPhoto'];
            }
    

    $sql = "INSERT INTO tbl_vendor_stock_invoice SET files='$files',frid='$frid',vedid='$user_id',invoice_no='$invoice_no',invoice_date='$invoice_date',total_amt='$total_amt',
            narration='$narration',status=1,created_by='$user_id',created_at='$created_at'";
    $conn->query($sql);
    $invid = mysqli_insert_id($conn);
    $number = count($_POST['prod_id']);
    if ($number > 0) {
        for ($i = 0; $i < $number; $i++) {
            if (trim($_POST["qty"][$i] > 0)) {
                $qty = addslashes(trim($_POST['qty'][$i]));
                $prod_id = addslashes(trim($_POST['prod_id'][$i]));
                $prod_type = addslashes(trim($_POST['prod_type'][$i]));
                $unit = addslashes(trim($_POST['unit'][$i]));
                $sql = "INSERT INTO tbl_vendor_stock_invoice_items SET invid='$invid',frid='$frid',vedid='$user_id',invoice_date='$invoice_date',
                                prod_id='$prod_id',qty='$qty',prod_type='$prod_type',unit='$unit'";
                $conn->query($sql);
            }
        }
    }
    
    echo "<script>alert('Order Created Successfully');window.location.href='view-orders.php';</script>";
}
?>
        <div class="main-container">
    <div class="container">
        <form id="validation-form" method="post" enctype="multipart/form-data">
        <div class="card mb-4">

            <div class="card-body">
                
                    <div class="form-group float-label active">
                        <input type="text" class="form-control" value="<?php echo $row['ShopName']; ?>" autofocus disabled>
                        <label class="form-control-label">Franchise Name</label>
                    </div>
                
            </div>
        </div>

        <?php
        $sql = "SELECT id,ProductName FROM tbl_cust_products_2025 WHERE ProdId IN ($AllocateProd) AND CreatedBy='" . $_GET['frid'] . "' AND delete_flag=0 AND ProdType=0 AND checkstatus=1";
        $row = getList($sql);
        foreach ($row as $result) {
            $sql2 = "SELECT IFNULL(sum(creditqty)-sum(debitqty),0) AS balqty FROM (SELECT (case when Status='Dr' then sum(Qty) else '0' end) as debitqty,
                                (case when Status='Cr' then sum(Qty) else '0' end) as creditqty FROM `tbl_cust_prod_stock_2025` WHERE ProdId='" . $result['id'] . "' 
                                GROUP by Status) as a";
            $row2 = getRecord($sql2);
        ?>
        <input type="hidden" name="prod_id[]" id="prod_id" class="form-control" value="<?php echo $result['id']; ?>">
        <input type="hidden" name="prod_type[]" id="prod_type" class="form-control" value="0">
        <input type="hidden" name="unit[]" id="unit" class="form-control" value="NA">
            <div class="card mb-4">

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="mb-1"><?php echo $result['ProductName']; ?> </h5>
                            <p class="text-secondary">
                            <div class="row">
                                <div class="form-group float-label active col-6">
                                    <input type="text" class="form-control" value="<?php echo $row2['balqty']; ?>" disabled>
                                    <label class="form-control-label" style="padding-left: 15px;">Avail Stock</label>
                                </div>
                                <div class="form-group float-label active col-6">
                                    <input type="text" class="form-control" name="qty[]" id="Qty" value="0" required>
                                    <label class="form-control-label" style="padding-left: 15px;">Qty</label>
                                </div>
                            </div>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        
        <?php
        if($AllocateRawProd!=''){
        $sql = "SELECT id,ProductName,Unit FROM tbl_cust_products2 WHERE id IN ($AllocateRawProd)";
        $row = getList($sql);
        foreach ($row as $result) {
            
             $prod_id = $result['id'];
                                $sql4 = "SELECT * FROM tbl_users WHERE id='".$_GET['frid']."' AND Roll=5 AND FIND_IN_SET('$prod_id', AllocateRawProd) > 0";
                                $rncnt4 = getRow($sql4);
                                
             $sql2 = "SELECT IFNULL(sum(creditqty)-sum(debitqty),0) AS balqty FROM (SELECT (case when Status='Dr' then sum(Qty) else '0' end) as debitqty,
                                (case when Status='Cr' then sum(Qty) else '0' end) as creditqty FROM `tbl_cust_prod_stock_2025` WHERE UserId='".$_GET['frid']."' AND ProdId='".$result['id']."' 
                                GROUP by Status) as a";
	                            $row2 = getRecord($sql2);
	                           
                                if($result['Unit']!='Pieces'){
                                $creditqty = ($row2['creditqty']/1000);
                                $debitqty = ($row2['debitqty']/1000);
                                $balqty = ($row2['balqty']/1000);
                                
                            }
                            else{
                                $creditqty = $row2['creditqty'];
                                $debitqty = $row2['debitqty'];
                                $balqty = $row2['balqty'];
                            }
                            
                            $sql3 = "SELECT * FROM tbl_units WHERE Name='".$result['Unit']."'";
                            $row3 = getRecord($sql3);
                            
            if($rncnt4 > 0){
        ?>
        <input type="hidden" name="prod_id[]" id="prod_id" class="form-control" value="<?php echo $result['id']; ?>">
        <input type="hidden" name="prod_type[]" id="prod_type" class="form-control" value="1">
            <div class="card mb-4">

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="mb-1"><?php echo $result['ProductName']; ?> </h5>
                            <p class="text-secondary">
                            <div class="row">
                                <div class="form-group float-label active col-4">
                                    <input type="text" class="form-control" value="<?php echo $balqty; ?>" disabled>
                                    <label class="form-control-label" style="padding-left: 15px;">Avail Stock</label>
                                </div>
                                <div class="form-group float-label active col-2" style="padding-right: 1px;padding-left: 1px;">
                                    <input type="text" class="form-control" value="<?php echo $row3['Name2'];?>" disabled>
                                    <label class="form-control-label" style="padding-left: 15px;"></label>
                                </div>
                                <div class="form-group float-label active col-4">
                                    <input type="text" class="form-control" name="qty[]" id="Qty" value="0" required>
                                    <label class="form-control-label" style="padding-left: 15px;">Qty</label>
                                </div>
                                <div class="form-group float-label active col-2" style="padding-right: 1px;padding-left: 1px;">
                                    <input type="text" class="form-control" name="unit[]" id="unit" value="<?php echo $row3['Name2'];?>" readonly>
                                    <label class="form-control-label" style="padding-left: 15px;"></label>
                                </div>
                            </div>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } } } ?>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="form-group float-label col-6 active">
                        <input type="text" class="form-control" name="invoice_no" value="<?php echo $InvNo; ?>" readonly>
                        <label class="form-control-label" style="padding-left: 15px;">Invoice No</label>
                    </div>
                    
                    <div class="form-group float-label col-6 active">
                        <input type="date" class="form-control" name="invoice_date" value="<?php echo date('Y-m-d'); ?>" required>
                        <label class="form-control-label" style="padding-left: 15px;">Invoice Date</label>
                    </div>
                    
                    <div class="form-group float-label col-12 active">
                        <input type="text" class="form-control" name="total_amt" value="" required>
                        <label class="form-control-label" style="padding-left: 15px;">Total Amount</label>
                    </div>
                    
                    <div class="form-group float-label col-12 active">
                        <input type="file" class="form-control" name="files" value="" required accept=".png">
                        <label class="form-control-label" style="padding-left: 15px;">Upload Invoice</label>
                    </div>
                    
                    <div class="form-group float-label col-12 active">
                        <input type="text" class="form-control" name="narration" value="" required>
                        <label class="form-control-label" style="padding-left: 15px;">Narration</label>
                    </div>
                </div>
                <input type="hidden" name="frid" id="frid" class="form-control" value="<?php echo $_GET['frid'];?>">
                <div align="center">
                         <button type="submit" name="submit" class="btn btn-default mb-2 mx-auto rounded" style="background-color: #e36012;">Submit</button>
                        </div>
            </div>
        </div>
        
        </form>
        
    </div>
</div>
    </main>
<br><br><br><br>
<?php include 'footer.php';?>
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
    function getExpId(id){
        $('#myModal').modal('show');
        $('.Exp_Id').val(id);
    }
</script>
   
</body>

</html>
