<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Vendor Expenses";
$UserId = $_SESSION['User']['id']; ?>
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
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 
        
        <?php

if($_GET["action"]=="deleteprd")
{
  $id = $_GET["id"];
  $bid = $_GET["oid"];
  $sql11 = "DELETE FROM tbl_invoice_details WHERE id = '$id'";
  $conn->query($sql11);
  $sql11 = "DELETE FROM tbl_raw_stock WHERE InvDetId = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      //alert("Deleted Successfully!");
      window.location.href="edit-vendor-expenses.php?id=<?php echo $bid;?>";
    </script>
<?php }

     
                $id = $_GET['id'];
                $sql8 = "SELECT * FROM tbl_invoice WHERE id='$id'";
                $row7 = getRecord($sql8);

                $query22 = "SELECT count(*) as totrec FROM tbl_invoice_details WHERE InvId = '$id'";
                $data22 = getRecord($query22);
                $row_cnt = $data22['totrec'] + 1;

                if (isset($_POST['submit'])) {
                    
                    $CustId = $_POST['CustId'];
                    $AccCode = addslashes(trim($_POST['AccCode']));
                    $CustName = addslashes(trim($_POST['CustName']));
                    $CellNo = addslashes(trim($_POST['CellNo']));
                    $Address = addslashes(trim($_POST['Address']));
                    $EmailId = addslashes(trim($_POST['EmailId']));
                    $InvoiceDate = addslashes(trim($_POST['InvoiceDate']));
                    $PayType = addslashes(trim($_POST['PayType']));
                    $Narration = addslashes(trim($_POST['Narration']));


                    $SubTotal = addslashes(trim($_POST['SubTotal']));
                    //$SgstPer = addslashes(trim($_POST['SgstPer']));
                    //$CgstPer = addslashes(trim($_POST['CgstPer']));
                    //$IgstPer = addslashes(trim($_POST['IgstPer']));
                    //$GstAmt = addslashes(trim($_POST['GstAmt']));
                    //$ExtraAmount = addslashes(trim($_POST['ExtraAmount']));
                    //$TotalAmount = addslashes(trim($_POST['TotalAmount']));
                    $Discount = addslashes(trim($_POST['Discount']));
                    $NetAmount = addslashes(trim($_POST['NetAmount']));
                    $Advance = addslashes(trim($_POST['Advance']));
                    $Balance = addslashes(trim($_POST['Balance']));
                    //$ExtraReason = addslashes(trim($_POST['ExtraReason']));
                    $PayType = addslashes(trim($_POST['PayType']));
                    $ChequeNo = addslashes(trim($_POST['ChequeNo']));
                    $ChqDate = addslashes(trim($_POST['ChqDate']));
                    $BankName = addslashes(trim($_POST['BankName']));
                    $UpiNo = addslashes(trim($_POST['UpiNo']));
                    $PayType2 = addslashes(trim($_POST['PayType2']));
                    $ChequeNo2 = addslashes(trim($_POST['ChequeNo2']));
                    $ChqDate2 = addslashes(trim($_POST['ChqDate2']));
                    $BankName2 = addslashes(trim($_POST['BankName2']));
                    $UpiNo2 = addslashes(trim($_POST['UpiNo2']));
                    $Amount1 = addslashes(trim($_POST['Amount1']));
                    $Amount2 = addslashes(trim($_POST['Amount2']));
                    $CreatedDate = date('Y-m-d');
                    $CreatedTime = date('h:i a');
                    $Status = $_POST['Status'];
                    $tempDir = '../barcodes/';
                    $sql8 = "SELECT MAX(SrNo) AS MaxId FROM tbl_invoice";
                    $row8 = getRecord($sql8);
                    $MaxId = $row8['MaxId'] + 1;
                    $InvoiceNo = "00" . $MaxId;

                    $randno = rand(1,100);
                    $src = $_FILES['Photo']['tmp_name'];
                    $fnm = substr($_FILES["Photo"]["name"], 0,strrpos($_FILES["Photo"]["name"],'.')); 
                    $fnm = str_replace(" ","_",$fnm);
                    $ext = substr($_FILES["Photo"]["name"],strpos($_FILES["Photo"]["name"],"."));
                    $dest = '../uploads/'. $randno . "_".$fnm . $ext;
                    $imagepath =  $randno . "_".$fnm . $ext;
                    if(move_uploaded_file($src, $dest))
                    {
                    $Photo = $imagepath ;
                    } 
                    else{
                        $Photo = $_POST['OldPhoto'];
                    }


                     $sql = "UPDATE tbl_invoice SET AccCode='$AccCode',CustId='$CustId',CustName='$CustName',
                            CellNo='$CellNo',Address='$Address',EmailId='$EmailId',InvoiceNo='$InvoiceNo',
                            InvoiceDate='$InvoiceDate',PayType='$PayType',Narration='$Narration',
                            CgstPer='$CgstPer',SgstPer='$SgstPer',
                            IgstPer='$IgstPer',SubTotal='$SubTotal',
                            GstAmt='$GstAmt',ModifiedBy='$user_id',ModifiedDate='$CreatedDate',
                            ExtraAmount='$ExtraAmount',TotalAmount='$TotalAmount',Discount='$Discount',
                            NetAmount='$NetAmount',Advance='$Advance',Balance='$Balance',
                            ExtraReason='$ExtraReason',ChequeNo='$ChequeNo',ChqDate='$ChqDate',
                            BankName='$BankName',UpiNo='$UpiNo',PayType2='$PayType2',
                            ChequeNo2='$ChequeNo2',ChqDate2='$ChqDate2',
                            BankName2='$BankName2',UpiNo2='$UpiNo2',Amount1='$Amount1',Amount2='$Amount2',Status='$Status',Photo='$Photo' WHERE id='$id'";
                    $conn->query($sql);
                    $SellId = $id;
                   

                    $sql = "DELETE FROM tbl_general_ledger WHERE SellId='$SellId' AND Flag='Invoice' AND Main=1";
                    $conn->query($sql);


                    $sql2 = "SELECT MAX(SrNo) as maxid FROM tbl_general_ledger WHERE Type='PW'";
                    $row2 = getRecord($sql2);
                    if ($row2['maxid'] == '') {
                        $SrNo = 1;
                        $Code = "PW" . $SrNo;
                    } else {
                        $SrNo = $row2['maxid'] + 1;
                        $Code = "PW" . $SrNo;
                    }

                    $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='0',Code='OB',UserId='$CustId',
                            AccCode='$AccCode',
                            AccountName='$CustName',
                            InvoiceNo='$InvoiceNo',Amount='$NetAmount',CrDr='cr',Roll=3,
                            Type='OB',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                            PayMode='$PayType',Narration='Total Invoice Amount',
                            SellId='$SellId',Flag='Invoice',AccRoll='Vendor',Main=1,CreatedBy='$user_id'";
                    $conn->query($sql4);

                    // $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='0',Code='OB',UserId='0',
                    //         AccCode='AC1',
                    //         AccountName='Comapny Account',
                    //         InvoiceNo='$InvoiceNo',Amount='$NetAmount',CrDr='cr',Roll=3,
                    //         Type='OB',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                    //         PayMode='$PayType',Narration='$Narration',
                    //         SellId='$SellId',Flag='Invoice',AccRoll='Company'";
                    // $conn->query($sql4);

                    if ($Advance > 0) {
                        $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='$SrNo',Code='$Code',UserId='$CustId',
                            AccCode='$AccCode',
                            AccountName='$CustName',
                            InvoiceNo='$InvoiceNo',Amount='$Advance',CrDr='dr',Roll=3,
                            Type='PW',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                            PayMode='$PayType',Narration='$Narration',
                            SellId='$SellId',Flag='Invoice',AccRoll='Vendor',Main=1,CreatedBy='$user_id'";
                        $conn->query($sql4);
                        $PostId = mysqli_insert_id($conn);

                        $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='$SrNo',Code='$Code',UserId='0',
                            AccCode='AC1',
                            AccountName='Comapny Account',
                            InvoiceNo='$InvoiceNo',Amount='$Advance',CrDr='cr',Roll=3,
                            Type='PW',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                            PayMode='$PayType',Narration='$Narration',
                            SellId='$SellId',Flag='Invoice',AccRoll='Company',PostId='$PostId',Main=1,CreatedBy='$user_id'";
                        $conn->query($sql4);
                    }

                    $number = count($_POST["ProdId"]);
                    if ($number > 0) {
                        for ($i = 0; $i < $number; $i++) {
                            if (trim($_POST["ProdId"][$i] != '')) {
                                $ProdId = addslashes(trim($_POST['ProdId'][$i]));
                              
                                $Qty = addslashes(trim($_POST['Qty'][$i]));
                                $Price = addslashes(trim($_POST['Price'][$i]));
                                $Unit = addslashes(trim($_POST['Unit'][$i]));
                                $UnitId = addslashes(trim($_POST['UnitId'][$i]));
                                $CgstPer = addslashes(trim($_POST['CgstPer'][$i]));
                                $SgstPer = addslashes(trim($_POST['SgstPer'][$i]));
                                $GstAmt = addslashes(trim($_POST['GstAmt'][$i]));
                                $Total = addslashes(trim($_POST['Total'][$i]));

                                $sql22 = "INSERT INTO tbl_invoice_details SET InvId='$SellId',ProdId='$ProdId',Qty='$Qty',Price='$Price',CreatedDate='$InvoiceDate'
                ,CgstPer='$CgstPer',SgstPer='$SgstPer',GstAmt='$GstAmt',Total='$Total',Unit='$Unit',UnitId='$UnitId'";
                                $conn->query($sql22);
                                $InvDetId = mysqli_insert_id($conn);

                                  $sql22 = "INSERT INTO tbl_raw_stock SET InvDetId='$InvDetId',InvId='$SellId',ProdId='$ProdId',Qty='$Qty',Price='$Price',CreatedDate='$InvoiceDate'
                ,CgstPer='$CgstPer',SgstPer='$SgstPer',GstAmt='$GstAmt',Total='$Total',CrDr='cr',Narration='Stock Added',Unit='$Unit',UnitId='$UnitId'";
                                $conn->query($sql22);
                            }
                        }
                    }
?>
 <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Success",
  text: "Invoice Updated Successfully!",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-vendor-expenses.php";
  }
}); });</script>
<?php 
                    
                }
                ?>
        <div class="main-container">
            <div class="container">
               
                <div class="card">
                  <form id="validation-form" method="post" enctype="multipart/form-data">
   <div class="card-body">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label class="form-label">Vendor <span class="text-danger">*</span></label>
                                            <select class="select2-demo form-control" style="width: 100%" data-allow-clear="true" name="CustId" id="CustId">
                                                <option>Search Vendor</option>
                                                <?php
                                                $sql4 = "SELECT * FROM tbl_users WHERE Status=1 AND Roll=3";
                                                $row4 = getList($sql4);
                                                foreach ($row4 as $result) {
                                                ?>
                                                    <option <?php if ($row7["CustId"] == $result['id']) { ?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['Fname'] . " - " . $result['Phone']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <input type="hidden" name="AccCode" id="AccCode">
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Contact No </label>
                                            <input type="text" name="CellNo" id="CellNo" class="form-control" placeholder="" value="<?php echo $row7["CellNo"]; ?>" autocomplete="off" oninput="getUserDetails()">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Customer Name </label>
                                            <input type="text" name="CustName" id="CustName" class="form-control" placeholder="" value="<?php echo $row7["CustName"]; ?>" autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label">Email Id </label>
                                            <input type="email" name="EmailId" id="EmailId" class="form-control" placeholder="" value="<?php echo $row7["CustName"]; ?>" autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label">Address</label>
                                            <textarea name="Address" id="Address" class="form-control"><?php echo $row7['Address']; ?></textarea>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label class="form-label">Invoice No </label>
                                            <input type="text" name="InvoiceNo" class="form-control" id="InvoiceNo" placeholder="" value="<?php echo $row7['InvoiceNo']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label">Invoice Date </label>
                                            <input type="date" name="InvoiceDate" id="InvoiceDate" class="form-control" placeholder="" value="<?php echo $row7['InvoiceDate']; ?>" autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div>

                                    </div>

                                   
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
<?php 
$i=1;
  $sql12 = "SELECT * FROM tbl_invoice_details WHERE InvId='$id'";
  $row12 = getList($sql12);
  foreach($row12 as $result12){
     ?>
                                                 <div class="card" style="border: 1px solid;">
                                                    <div class="card-header">
                                                        
                                                    <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label class="form-label">Raw Product </label>
                                                                <select class="form-control" style="width: 100%" data-allow-clear="true" name="ProdId[]" id="ProdId<?php echo $i; ?>" onchange="getPrice(this.value,document.getElementById('srno<?php echo $i; ?>').value)">
                                                                    <option selected value="" disabled>...</option>
                                                                    <?php
                                                                    $sql4 = "SELECT * FROM tbl_raw_products WHERE Status=1";
                                                                    $row4 = getList($sql4);
                                                                    foreach ($row4 as $result) {
                                                                    ?>
                                                                        <option <?php if ($result12["ProdId"] == $result['id']) { ?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['ProductName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            

                                                            <div class="form-group col-md-2">
                                                                <label class="form-label">Price </label>
                                                                <input type="text" name="Price[]" id="Price<?php echo $i; ?>" class="form-control" placeholder="e.g.,S12" value="<?php echo $result12["Price"];?>" autocomplete="off"
                                                                oninput="TotAmount(document.getElementById('Price<?php echo $i; ?>').value,
                                                                document.getElementById('Qty<?php echo $i; ?>').value,
                                                                document.getElementById('srno<?php echo $i; ?>').value)">
                                                            </div>

 <div class="form-group col-md-2">
<label class="form-label">Qty<span class="text-danger">*</span></label>
<div class="input-group">
<input type="text" name="Qty[]" id="Qty<?php echo $i; ?>" class="form-control" placeholder="e.g.,S12" value="<?php echo $result12["Qty"];?>" autocomplete="off"
                                                                oninput="TotAmount(document.getElementById('Price<?php echo $i; ?>').value,
                                                                document.getElementById('Qty<?php echo $i; ?>').value,
                                                                document.getElementById('srno<?php echo $i; ?>').value)">

 <input type="text" name="Unit[]" id="Unit<?php echo $i; ?>" class="form-control" value="<?php echo $result12["Unit"];?>" readonly>
<div class="clearfix"></div>
</div>
</div>
<input type="hidden" name="UnitId[]" id="UnitId<?php echo $i; ?>"  value="<?php echo $result12["UnitId"];?>">

                                                         

                                                            <input type="hidden" class="form-control" name="srno[]" id="srno<?php echo $i; ?>" value="<?php echo $i; ?>">
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">Total Amount <span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="text" name="Total[]" id="Total<?php echo $i; ?>" class="form-control txt" placeholder="e.g.,5000" value="<?php echo $result12["Total"];?>" autocomplete="off" required oninput="getSubTotal()">
                                                                    <div class="clearfix"></div>
                                                                    <span class="input-group-append">
                                                                    <a onClick="return confirm('Are you sure you want delete this Record');" href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $result12['id']; ?>&action=deleteprd&oid=<?php echo $_GET['id']; ?>" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div><br>
 <?php $i++;} ?>
                                                 <div id="dynamic_field">
                                                <div class="card" style="border: 1px solid;">
                                                    <div class="card-header">
                                                        
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label class="form-label">Raw Product </label>
                                                                <select class="form-control" style="width: 100%" data-allow-clear="true" name="ProdId[]" id="ProdId<?php echo $row_cnt; ?>" onchange="getPrice(this.value,document.getElementById('srno<?php echo $row_cnt; ?>').value)">
                                                                    <option selected value="" disabled>...</option>
                                                                    <?php
                                                                    $sql4 = "SELECT * FROM tbl_raw_products WHERE Status=1";
                                                                    $row4 = getList($sql4);
                                                                    foreach ($row4 as $result) {
                                                                    ?>
                                                                        <option <?php if ($row7["TravelId"] == $result['id']) { ?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['ProductName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                           

                                                          
                                                            <div class="form-group col-md-2">
                                                                <label class="form-label">Price </label>
                                                                <input type="text" name="Price[]" id="Price<?php echo $row_cnt; ?>" class="form-control" placeholder="e.g.,S12" value="" autocomplete="off"
                                                                oninput="TotAmount(document.getElementById('Price<?php echo $row_cnt; ?>').value,
                                                                document.getElementById('Qty<?php echo $row_cnt; ?>').value,
                                                                document.getElementById('srno<?php echo $row_cnt; ?>').value)">
                                                            </div>


 <div class="form-group col-md-2">
<label class="form-label">Qty<span class="text-danger">*</span></label>
<div class="input-group">
<input type="text" name="Qty[]" id="Qty<?php echo $row_cnt; ?>" class="form-control" placeholder="e.g.,S12" value="1" autocomplete="off"
                                                                oninput="TotAmount(document.getElementById('Price<?php echo $row_cnt; ?>').value,
                                                                document.getElementById('Qty<?php echo $row_cnt; ?>').value,
                                                                document.getElementById('srno<?php echo $row_cnt; ?>').value)">

 <input type="text" name="Unit[]" id="Unit<?php echo $row_cnt; ?>" class="form-control" value="" readonly>
<div class="clearfix"></div>
</div>
</div>
<input type="hidden" name="UnitId[]" id="UnitId<?php echo $row_cnt; ?>">

                                                            
                                                          

                                                              <input type="hidden" class="form-control" name="srno[]" id="srno<?php echo $row_cnt; ?>" value="<?php echo $row_cnt; ?>">
                                                            <input type="hidden" class="form-control" name="rncnt" id="rncnt" value="<?php echo $row_cnt; ?>">
                                                            <div class="form-group col-md-3">
                                                                <label class="form-label">Total Amount <span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="text" name="Total[]" id="Total<?php echo $row_cnt; ?>" class="form-control txt" placeholder="e.g.,5000" value="" autocomplete="off" required readonly>
                                                                    <div class="clearfix"></div>
                                                                    <span class="input-group-append">
                                                                        <button class="btn btn-secondary" type="button" id="add_more"><i class="fa fa-plus"></i></button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-row">
                                        <div class="form-group col-md-3 col-6">
                                            <label class="form-label">Sub Total <span class="text-danger">*</span></label>
                                            <input type="text" name="SubTotal" id="SubTotal" class="form-control" placeholder="" value="<?php echo $row7["SubTotal"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>

                                      

                                        <div class="form-group col-md-2 col-6">
                                            <label class="form-label">Discount <span class="text-danger">*</span></label>
                                            <input type="text" name="Discount" id="Discount" class="form-control" placeholder="" value="<?php echo $row7["Discount"]; ?>" onKeyPress="return isNumberKey(event)"
                                             oninput="balAmount(document.getElementById('SubTotal').value,
                                             document.getElementById('Discount').value,
                                             document.getElementById('NetAmount').value,
                                             document.getElementById('Advance').value)">
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-3 col-6">
                                            <label class="form-label">Net Payable<span class="text-danger">*</span></label>
                                            <input type="text" name="NetAmount" id="NetAmount" class="form-control" placeholder="" value="<?php echo $row7["TotalAmount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-2 col-6">
                                            <label class="form-label">Paid Amount <span class="text-danger">*</span></label>
                                            <input type="text" name="Advance" id="Advance" class="form-control" placeholder="" value="<?php echo $row7["Advance"]; ?>" onKeyPress="return isNumberKey(event)" 
                                            oninput="balAmount(document.getElementById('SubTotal').value,
                                             document.getElementById('Discount').value,
                                             document.getElementById('NetAmount').value,
                                             document.getElementById('Advance').value)">
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-md-2 col-12">
                                            <label class="form-label">Balance <span class="text-danger">*</span></label>
                                            <input type="text" name="Balance" id="Balance" class="form-control" placeholder="" value="<?php echo $row7["Balance"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>

                                        <!--<div class="form-group col-md-12">
                                            <label class="form-label">Extra Charges Reason </label>
                                            <input type="text" name="ExtraReason" class="form-control" placeholder="" value="<?php echo $result["ExtraReason"]; ?>" autocomplete="off">
                                        </div>-->

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-lg-2">
                                            <label class="form-label">Payment Type <span class="text-danger">*</span></label>
                                            <select class="form-control" id="PayType" name="PayType" required="" onchange="getPayType(this.value);">
                                                <option selected="" disabled="" value="">Select Payment Type</option>
                                                <option <?php if ($row7['PayType'] == 'Cash') { ?> selected <?php } ?> value="Cash">Cash</option>
                                                <option <?php if ($row7['PayType'] == 'Cheque') { ?> selected <?php } ?> value="Cheque">Cheque/Bank Transfer</option>
                                                <option <?php if ($row7['PayType'] == 'UPI') { ?> selected <?php } ?> value="UPI">UPI</option>
                                                <option <?php if ($row7['PayType'] == 'RTGS') { ?> selected <?php } ?> value="RTGS">RTGS</option>
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-lg-2">
                                            <label class="form-label">Amount </label>
                                            <input type="text" name="Amount1" class="form-control" id="Amount1" placeholder="" value="<?php echo $row7['Amount1']; ?>">
                                            <div class="clearfix"></div>
                                        </div>                             


                                        <div class="form-group col-lg-2">
                                            <label class="form-label">Cheque No </label>
                                            <input type="text" name="ChequeNo" class="form-control" id="ChequeNo" placeholder="Cheque No" value="<?php echo $row7['ChequeNo']; ?>">
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-lg-2">
                                            <label class="form-label">Cheque Date </label>
                                            <input type="date" name="ChqDate" class="form-control" id="ChqDate" placeholder="Cheque Date" value="<?php echo $row7['ChqDate']; ?>">
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group col-lg-2">
                                            <label class="form-label">Bank Name </label>
                                            <input type="text" name="BankName" class="form-control" id="BankName" placeholder="Bank Name" value="<?php echo $row7['BankName']; ?>">
                                            <div class="clearfix"></div>

                                        </div>



                                        <div class="form-group col-lg-2">
                                            <label class="form-label">UPI No/ Transaction Id </label>
                                            <input type="text" name="UpiNo" class="form-control" id="UpiNo" placeholder="UPI No/ Transaction Id" value="<?php echo $row7['UpiNo']; ?>">
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Upload Receipt</label>    
                            <input type="file" class="form-control" id="Photo" name="Photo">
                                                    
                        </div>
                          <input type="hidden" name="OldPhoto" id="OldPhoto" value="<?php echo $row7['Photo']; ?>">
                        <?php if($row7['Photo'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo']; ?>"><?php echo $row7['Photo']; ?></a><?php } ?>

                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="form-label">Narration <span class="text-danger">*</span></label>
                                            <input type="text" name="Narration" class="form-control" id="Narration" placeholder="Narration" value="<?php echo $row7['Narration']; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" id="Status" name="Status" value="0">
                                  

<div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit">Submit</button>
                    </div>
  </div>
                                   
                                </form>
                </div>
            </div>
        </div>
    </main>
<br><br><br><br>
    <!-- footer-->
    
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
        function TotAmount(Price,Qty,Srno){
            //var CgstAmt = Number(ServiceAmt) * (Number(CgstPer) / 100);
            //var SgstAmt = Number(ServiceAmt) * (Number(SgstPer) / 100);
            //var GstAmt = Number(CgstAmt) + Number(SgstAmt);
           // $('#GstAmt'+Srno).val(parseFloat(GstAmt).toFixed(2));
            var Total_Amount = Number(Price) * Number(Qty);
            $('#Total'+Srno).val(parseFloat(Total_Amount).toFixed(2));
            getSubTotal();
        }
        function calAge(val, srno) {
            //alert(val);alert(srno);
            var dob = new Date(val);
            //calculate month difference from current date in time  
            var month_diff = Date.now() - dob.getTime();

            //convert the calculated difference in date format  
            var age_dt = new Date(month_diff);

            //extract year from date      
            var year = age_dt.getUTCFullYear();

            //now calculate the age of the user  
            var age = Math.abs(year - 1970);

            $('#Age' + srno).val(age);
            //alert(age);
        }

        // function getPayType(val) {
        //     if (val == 'Cheque') {
        //         $('#chequeoption').show();
        //         $('#upioption').hide();
        //     } else if (val == 'UPI') {
        //         $('#chequeoption').hide();
        //         $('#upioption').show();
        //     } else {
        //         $('#chequeoption').hide();
        //         $('#upioption').hide();
        //     }
        // }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function getSubTotal() {
            var sum = 0;
            $(".txt").each(function() {
                if (!isNaN(this.value) && this.value.length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            $('#SubTotal').val(sum);

            var SubTotal = $('#SubTotal').val();
            //var SgstPer = $('#SgstPer').val();
            //var CgstPer = $('#CgstPer').val();
            //var IgstPer = $('#IgstPer').val();
            //var GstAmt = $('#GstAmt').val();
            var Discount = $('#Discount').val();
            //var ExtraAmount = $('#ExtraAmount').val();
            var NetAmount = $('#NetAmount').val();
            var Advance = $('#Advance').val();
            balAmount(SubTotal, Discount, NetAmount, Advance);
        }

        function balAmount(SubTotal, Discount, NetAmount, Advance) {
            // var CgstAmt = Number(ExtraAmount) * (Number(CgstPer) / 100);
            // var SgstAmt = Number(ExtraAmount) * (Number(SgstPer) / 100);
            // var IgstAmt = Number(ExtraAmount) * (Number(IgstPer) / 100);
            // var GstAmt = Number(CgstAmt) + Number(SgstAmt) + Number(IgstAmt);
            // $('#GstAmt').val(parseFloat(GstAmt).toFixed(2));
            // var Total_Amount = Number(SubTotal) + Number(GstAmt) + Number(ExtraAmount);
            // $('#TotalAmount').val(parseFloat(Total_Amount).toFixed(2));
            var NetAmount = Number(SubTotal) - Number(Discount);
            $('#NetAmount').val(parseFloat(NetAmount).toFixed(2));
            var Balance = Number(NetAmount) - Number(Advance);
            $('#Balance').val(parseFloat(Balance).toFixed(2));
            var Advance = $('#Advance').val();
            $('#Amount1').val(parseFloat(Advance).toFixed(2));
        }

 function calAmt1(){
            var Advance = $('#Advance').val();
            var Amount2 = $('#Amount2').val();
            var Amount1 = Number(Advance) - Number(Amount2);
            $('#Amount1').val(parseFloat(Amount1).toFixed(2));
        }

        function getFareClass(id, srno) {
            var action = "getFareClass";
            $.ajax({
                url: "ajax_files/ajax_invoice.php",
                method: "POST",
                data: {
                    action: action,
                    id: id
                },
                success: function(data) {
                    $('#FareClassId' + srno).html(data);
                }
            });
        }

        function getPrice(id, srno) {
            var action = "getPrice";
            var Qty = $('#Qty'+srno).val();
            $.ajax({
                url: "ajax_files/ajax_invoice.php",
                method: "POST",
                data: {
                    action: action,
                    id: id
                },
                success: function(data) {
                    var res = JSON.parse(data);
                    $('#Price' + srno).val(res.Price);
                    $('#Unit' + srno).val(res.UnitName);
                    $('#UnitId'+srno).val(res.Unit);
                    TotAmount(res.Price,Qty,srno);
                }
            });

        }

function getCustBalAmt(uid){
        var action = "getCustBalAmt";
            $.ajax({
                url: "ajax_files/ajax_general_ledger.php",
                method: "POST",
                data: {
                    action: action,
                    uid: uid
                }, 
                success: function(data) {
                    console.log(data);
                    var res = JSON.parse(data);
                    $('#TotalInvAmt').val(res.TotAmt);
                    $('#PaidAmount').val(res.PaidAmt);
                    $('#BalAmt').val(res.TotBalAmt);
                    
                }
            });
    }



    function addMore(i){
      i2=i+1;  

         var action = "getMore";
    $.ajax({
    url:"ajax_files/ajax_invoice.php",
    method:"POST",
    data : {action:action,id:i2},
    success:function(data)
    {
      $('#dynamic_field').append(data);
    }   
    }); 
    }

        $(document).ready(function() {
            var i = 1;
            $('#add_more').click(function() {
                i++;
                var html = '';
                var action = "getMore";
                $.ajax({
                    url: "ajax_files/ajax_invoice.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: i
                    },
                    success: function(data) {
                        $('#dynamic_field').append(data);
                    }
                });
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                // if (confirm("Are you sure you want to delete?")) {
                    $('#row' + button_id + '').remove();
                    $('#br' + button_id + '').remove();
                    getSubTotal();
                // }
            });

            $(document).on("change", "#CustId", function(event) {
                var val = this.value;
                getCustBalAmt(val);
                var action = "getUserDetails";
                $.ajax({
                    url: "ajax_files/ajax_dropdown.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: val
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#Address').val(data.Address);
                        $('#CustName').val(data.Fname);
                        $('#CellNo').val(data.Phone);
                        $('#EmailId').val(data.EmailId);
                        $('#AccCode').val(data.CustomerId);
                    }
                });

            });
        });
    </script>
   
</body>

</html>
