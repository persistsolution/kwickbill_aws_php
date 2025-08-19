<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Sell";
$Page = "Add-Sell";
?>
<!DOCTYPE html>

<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Raw Stock
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />

    <?php include_once 'header_script.php'; ?>
</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] Ebd -->

    <!-- [ Layout wrapper ] Start -->
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">
            <!-- [ Layout sidenav ] Start -->
              <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>
            <!-- [ Layout sidenav ] End -->
            <!-- [ Layout container ] Start -->
            <div class="layout-container">
                <!-- [ Layout navbar ( Header ) ] Start -->
                 
                <!-- [ Layout navbar ( Header ) ] End -->

<?php  
$id = $_GET['id'];
$sql7 = "SELECT tu.*,tb.Name As BranchName,ts.Name As Scheme,tc.Name As Country,ts2.Name As State,tc2.Name As City FROM tbl_users tu 
         LEFT JOIN tbl_branch tb ON tu.BranchId=tb.id 
         LEFT JOIN tbl_scheme ts ON tu.SchemeId=ts.id 
         LEFT JOIN tbl_country tc ON tu.CountryId=tc.id 
         LEFT JOIN tbl_state ts2 ON tu.StateId=ts2.id 
         LEFT JOIN tbl_city tc2 ON tu.CityId=tc2.id WHERE tu.id='$id'";
$row7 = getRecord($sql7);
if($BranchId == ''){
    $BranchId = $row7['BranchId'];
}
else{
    $BranchId = $row77['BranchId'];
}
function commonMaster($id){
    global $conn;
    $sql = "SELECT * FROM tbl_common_master WHERE id='$id'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    return $row['Name'];
}
?>
                <!-- [ Layout content ] Start -->
               <div class="layout-content">

                    <!-- [ content ] Start -->
                     <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Users view</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Users</li>
                                <li class="breadcrumb-item active">Users view</li>
                            </ol>
                        </div>

                        <div class="media align-items-center py-3 mb-3">
                            <img src="cust-user-icon.jpg" alt="" class="d-block ui-w-100 rounded-circle">
                            <div class="media-body ml-4">
                                <h4 class="font-weight-bold mb-0"><?php echo $row7["Fname"]; ?></h4>
                                <div class="text-muted mb-2">ID: <?php echo $row7["BeneficiaryId"]; ?></div>
                               
                               
                            </div>
                        </div>

                       <div class="nav-tabs-top">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#user-edit-account">Customer Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab2">Product Specification</a>
                                </li>
                               
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade " id="user-edit-account">
                                    <div class="row">
                                        <div class="col-lg-6">
                                    <div class="table-responsive">
                                    <table class="table user-view-table m-0">
                                        <tbody>
                                            <tr>
                                                <th>Project Type:</th>
                                                <td><?php if($row7["ProjectType"]=='1') {?> Pump Projects <?php } else { ?> Rooftop Projects <?php } ?></td>
                                            </tr>
                                            <tr>
                                                <th>Beneficiary ID:</th>
                                                <td><?php echo $row7["BeneficiaryId"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Name Of Beneficiary/Grampanchayat:</th>
                                                <td><?php echo $row7["Fname"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Branch:</th>
                                                <td><?php echo $row7["BranchName"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Gov Agency:</th>
                                                <td><?php echo $row7["Scheme"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Location:</th>
                                                <td><?php echo $row7["City"].", ".$row7["State"].", ".$row7["Country"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Taluka / Village / District:</th>
                                                <td><?php echo $row7["Taluka"]." / ".$row7["Village"]." / ".$row7["District"]; ?></td>
                                            </tr>
                                             <tr>
                                                <th>Mobile No:</th>
                                                <td><?php echo $row7["Phone"]; ?></td>
                                            </tr>
                                             <tr>
                                                <th>Email Id:</th>
                                                <td><?php echo $row7["EmailId"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>AC/DC:</th>
                                                <td><?php echo $row7["AcDc"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Type Of Pump:</th>
                                                <td><?php echo commonMaster($row7["Surface"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Capacity:</th>
                                                <td><?php echo commonMaster($row7["PumpCapacity"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Lattitude:</th>
                                                <td><?php echo $row7["Lattitude"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Longitude:</th>
                                                <td><?php echo $row7["Longitude"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Rooftop Plant Capacity:</th>
                                                <td><?php echo $row7["RooftopPlantCapacity"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Off Grid/ On Grid System:</th>
                                                <td><?php echo $row7["OffOnGrid"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Consumer No:</th>
                                                <td><?php echo $row7["ConsumerNo"]; ?></td>
                                            </tr>
                                             <tr>
                                                <th>Sanction Load:</th>
                                                <td><?php echo $row7["SanctionLoad"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Load Extension Required (kW):</th>
                                                <td><?php echo $row7["LoadExtension"]; ?></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                 </div>

                                 <div class="col-lg-6">
                                     <div class="table-responsive">
                                    <table class="table user-view-table m-0">
                                        <tbody>
<tr>
                                                <th>Type Of Source:</th>
                                                <td><?php echo commonMaster($row7["WaterSource"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Bore Diameter:</th>
                                                <td><?php echo commonMaster($row7["BoreDia"]);  ?></td>
                                            </tr>
                                            <tr>
                                                <th>Depth Of Source In Summer:</th>
                                                <td><?php echo $row7["SummerDepth"]; ?></td>
                                            </tr>
                                             <tr>
                                                <th>Depth Of Source In Winter:</th>
                                                <td><?php echo $row7["WinterDepth"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Pump Head:</th>
                                                <td><?php echo commonMaster($row7["PumpHead"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th>BG Number:</th>
                                                <td><?php echo $row7["BgNumber"]; ?></td>
                                            </tr>
                                             <tr>
                                                <th>BG Validity:</th>
                                                <td><?php echo $row7["BgValidity"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>BG Claim Period:</th>
                                                <td><?php echo $row7["BgClaimPeriod"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Insurance Number:</th>
                                                <td><?php echo $row7["InsuranceNumber"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Insurance Agency:</th>
                                                <td><?php echo $row7["InsuranceAgency"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Insurance Validity:</th>
                                                <td><?php echo $row7["InsuranceValidity"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Installation Vendor Name:</th>
                                                <td><?php echo $row7["InstallationVendor"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Date Of Inspection:</th>
                                                <td><?php echo $row7["InspectionDate"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Date Of Commissioning:</th>
                                                <td><?php echo $row7["CommissioningDate"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Customer Type:</th>
                                                <td><?php echo commonMaster($row7["CustType"]); ?></td>
                                            </tr>
                                            <?php if($row7["CustType"] == 34){?>
                                            <tr>
                                                <th>Address:</th>
                                                <td><?php echo commonMaster($row7["CompAddress"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Authorised Person Name:</th>
                                                <td><?php echo commonMaster($row7["AuthorName"]); ?></td>
                                            </tr>
                                        
                                            <tr>
                                                <th>Company Name:</th>
                                                <td><?php echo commonMaster($row7["CompName"]); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Mobile No:</th>
                                                <td><?php echo commonMaster($row7["CompPhone"]); ?></td>
                                            </tr>
                                        <?php } ?>
                                            </tbody>
                                    </table>
                                 </div>
                                  </div>

                                </div>
                                </div>

<?php  
if(isset($_POST['submit'])){
    $CustomerId = $_POST['CustomerId'];
    $LrNo = addslashes(trim($_POST['LrNo']));
$LrDate = addslashes(trim($_POST['LrDate']));
$Transport = addslashes(trim($_POST['Transport']));
$InvoiceNo = addslashes(trim($_POST['InvoiceNo']));
$InvoiceDate = addslashes(trim($_POST['InvoiceDate']));
    $CreatedDate = date('Y-m-d');
    $sql = "INSERT INTO tbl_delivered_invoice SET CustId='$CustomerId',InvoiceDate='$InvoiceDate',Status=1,CreatedBy='$user_id',CreatedDate='$CreatedDate',InvNo='$InvoiceNo',LrNo='$LrNo',LrDate='$LrDate',Transport='$Transport'";
    $conn->query($sql);
    $SellId = mysqli_insert_id($conn);
    /*$InvNo = "VINV00".$SellId;
    $sql = "UPDATE tbl_delivered_invoice SET InvNo='$InvNo' WHERE id='$SellId'";
    $conn->query($sql);*/
$number = count($_POST["ProductId"]);
if($number > 0)  
      {  
        for($i=0; $i<$number; $i++)  
          {  
            if(trim($_POST["ProductId"][$i] != ''))  
              {
                $ProductName = addslashes(trim($_POST['ProductName'][$i]));
                $Qty = addslashes(trim($_POST['Qty'][$i]));
                $ProductId = addslashes(trim($_POST['ProductId'][$i]));
                $CompId = addslashes(trim($_POST['CompId'][$i]));
                //$BranchId = addslashes(trim($_POST['BranchId'][$i]));
                $PostId = addslashes(trim($_POST['PostId'][$i]));
                $SerialNo = addslashes(trim($_POST['SerialNo'][$i]));
                $ModelNo = addslashes(trim($_POST['ModelNo'][$i]));
                $SrNo = addslashes(trim($_POST['SrNo'][$i]));
                $ProdType = addslashes(trim($_POST['ProdType'][$i]));
                
                $sql22 = "INSERT INTO tbl_stocks SET CustomerId='$CustomerId',CompId='0',SellId='$SellId',ProductId='$ProductId',ProductName='$ProductName',Qty='$Qty',Status='1',CrDr='dr',CreatedBy='$user_id',CreatedDate='$CreatedDate',Narration='Stock Delivered',PostId='$PostId',BranchId='$BranchId',SellType='Delivered',SerialNo='$SerialNo',ModelNo='$ModelNo',SrNo='0',ProdType='0'";
                $conn->query($sql22);

            }
        }
    }

    //$SerialProd = implode(",",$_POST['SerialProd']);
$number2 = count($_POST["SerialProd"]);
if($number2 > 0)  
      {  
        for($i=0; $i<$number2; $i++)  
          {  
            if(trim($_POST["SerialProd"][$i] != ''))  
              {
                $StockId = addslashes(trim($_POST['SerialProd'][$i]));
                $sql = "SELECT * FROM tbl_stocks WHERE id='$StockId'";
                $row = getRecord($sql);
                $ProductId = $row['ProductId'];
                $ProductName = $row['ProductName'];
                //$ProductName = $row['ProductName'];
                $SerialNo = $row['SerialNo'];
                $ModelNo = $row['ModelNo'];
                $sql22 = "INSERT INTO tbl_stocks SET CustomerId='$CustomerId',CompId='0',SellId='$SellId',ProductId='$ProductId',ProductName='$ProductName',Qty='1',Status='1',CrDr='dr',CreatedBy='$user_id',CreatedDate='$CreatedDate',Narration='Stock Delivered',PostId='0',BranchId='$BranchId',SellType='Delivered',SerialNo='$SerialNo',ModelNo='$ModelNo',SrNo='0',ProdType='1'";
                $conn->query($sql22);

            }
            }
        }

    echo "<script>alert('Order Delivered to Customer Successfully');window.open='print-delivery-customer-challan.php?id=$SellId';</script>";

    }
    ?>

                                <div class="tab-pane fade show active" id="tab2">
<form id="validation-form" method="post" autocomplete="off">
<input type="hidden" name="CustomerId" id="CustomerId" value="<?php echo $_GET['id'];?>">
                                   <div class="form-row" style="padding: 15px;"> 
                                   
                                   <div class="form-group col-lg-4">
<label class="form-label">DM NO <span class="text-danger">*</span></label>
<input type="text" name="InvoiceNo" class="form-control" id="InvoiceNo" placeholder="" value="<?php echo $Invoice_No; ?>" >
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
                                            <label class="form-label">Date </label>
                                            <input type="date" name="InvoiceDate" id="InvoiceDate" class="form-control"
                                                placeholder="" value="<?php echo date('Y-m-d'); ?>"
                                                autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div> 

<div class="form-group col-lg-4">
<label class="form-label">L.R. NO <span class="text-danger">*</span></label>
<input type="text" name="LrNo" class="form-control" id="LrNo" placeholder="" value="" >
<div class="clearfix"></div>
</div>

<div class="form-group col-md-4">
                                            <label class="form-label">L.R. Date </label>
                                            <input type="date" name="LrDate" id="LrDate" class="form-control"
                                                placeholder="" value="<?php echo date('Y-m-d'); ?>"
                                                autocomplete="off">
                                            <div class="clearfix"></div>
                                        </div> 


<div class="form-group col-lg-4">
<label class="form-label">Transport  <span class="text-danger">*</span></label>
<input type="text" name="Transport" class="form-control" id="Transport" placeholder="" value="" >
<div class="clearfix"></div>
</div>
</div>
<div class="form-row" id="custresult" style="padding: 15px;"> 
                                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              
               <th>Unit</th>
                <th>Total Stock</th>
               <th>Qty</th>
             
             
            </tr>
        </thead>
        <tbody>
          <?php 
 $srno = 1;
  $sql = "SELECT * FROM tbl_cust_product_specification WHERE CustId='$id' ORDER BY id DESC";
   $rx = $conn->query($sql);
  while($nx = $rx->fetch_assoc()){
     $sql11 = "SELECT SUM(Qty) AS CrQty FROM tbl_stocks WHERE CrDr='cr' AND ProductId='".$nx['ProdId']."' AND BranchId='$BranchId'";
    $row11 = getRecord($sql11);
    $CrQty = $row11['CrQty'];

    $sql12 = "SELECT SUM(Qty) AS DrQty FROM tbl_stocks WHERE CrDr='dr' AND ProductId='".$nx['ProdId']."' AND BranchId='$BranchId'";
    $row12 = getRecord($sql12);
    $DrQty = $row12['DrQty'];

    $BalQty = $CrQty - $DrQty;

    $sql44 = "SELECT ModelNo FROM tbl_products WHERE id='".$nx['ProdId']."'";
    $row44 = getRecord($sql44);

  ?>
           <tr>
             <td><?php echo $srno; ?></td>
            
             <td><?php echo $nx['ProdName']; ?></td>
             <td><?php echo $nx['Unit']; ?></td>
             <td><?php echo $BalQty;?></td>
            <td><?php echo $nx['Qty'];?></td>
            <input type="hidden" name="ProductId[]" id="ProductId" value="<?php echo $nx['ProdId'];?>">

 <input type="hidden" name="ProdType[]" id="ProdType1" value='0'>
       <input type="hidden" name="ProductName[]" id="ProductName1" value='<?php echo $nx['ProdName'];?>'>
        <input type="hidden" name="SerialNo[]" id="SerialNo1" value='N/A'>
 <input type="hidden" name="ModelNo[]" id="ModelNo1" value="<?php echo $row44['ModelNo'];?>">
  <input type="hidden" name="Qty[]" id="Qty1" value="<?php echo $nx['Qty'];?>">
   <input type="hidden" name="Purity[]" id="Purity1" value="<?php echo $nx['Unit'];?>">
            </tr>
             <?php $srno++;} ?>
        </tbody>
    </table>

</div>

<div class="form-row" style="padding: 15px;"> 
<h5>Serial No Products</h5>
<div class="col-lg-12">
     <select class="select2-demo form-control" multiple style="width: 100%" name="SerialProd[]">
                                    <?php 
                                        $sql22 = "SELECT * FROM tbl_stocks WHERE BranchId='$BranchId' AND CrDr='cr' AND ProdType='1'";
                                        $row22 = getList($sql22);
                                        foreach($row22 as $result){
                                    ?>
                                        <option value="<?php echo $result['id'];?>"><?php echo $result['ProductName']." (".$result['SerialNo'].")";?></option>
                                   <?php } ?>
                                  
                                </select>
</div>
<div class="col-lg-12" style="padding-top:10px;">
<button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Submit</button>
    </div>
    </div>
    </form>

                                </div>

                               
                            </div>
                        </div>

                      
                    </div>

                    <!-- [ content ] End -->

                    <!-- [ Layout footer ] Start -->
                    <?php include_once 'footer.php'; ?>
                    <!-- [ Layout footer ] End -->

                </div>
                </div>
                <!-- [ Layout content ] Start -->

            </div>
            <!-- [ Layout container ] End -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

<?php include_once 'footer_script.php'; ?>


</body>

</html>
