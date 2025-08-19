<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Asset";
$Page = "Add-Asset";
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
    <script src="ckeditor/ckeditor.js"></script>
</head>

<body>
    <style type="text/css">
    .password-tog-info {
        display: inline-block;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        position: absolute;
        right: 50px;
        top: 30px;
        text-transform: uppercase;
        z-index: 2;
    }
    </style>
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

             <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


            <div class="layout-container">

                

                <?php 
$id = $_GET['id'];
$sql7 = "SELECT * FROM  tbl_assets WHERE id='$id'";
$row7 = getRecord($sql7);
if($_GET['id']==''){
    $sql78 = "SELECT MAX(asset_id) AS MaxId FROM  tbl_assets";
    $row78 = getRecord($sql78);
    $asset_id = $row78['MaxId']+1;
}
else{
    $asset_id = $row7['asset_id'];
}


if(isset($_POST['submit'])){
    $UserId = addslashes(trim($_POST['UserId']));
    $ProductName = addslashes(trim($_POST['ProductName']));
    $Price = addslashes(trim($_POST['Price']));
    $Phone = addslashes(trim($_POST['Phone']));
    $EmailId = addslashes(trim($_POST['EmailId']));
    $Gst = addslashes(trim($_POST['Gst']));
    $ShopName = addslashes(trim($_POST['ShopName']));
    $Address = addslashes(trim($_POST['Address']));
    $PurchaseDate = addslashes(trim($_POST['PurchaseDate']));
    $WarrantyDate = addslashes(trim($_POST['WarrantyDate']));
    $CreatedDate = date('Y-m-d');
    $CreatedDate2 = date('d-M-Y');
    $CreatedBy = $_POST['CreatedBy'];
    $OtherName = addslashes(trim($_POST['OtherName']));
    
$asset_id = addslashes(trim($_POST['asset_id']));
$asset_name = addslashes(trim($_POST['asset_name']));
$asset_category = addslashes(trim($_POST['asset_category']));
$acquisition_date = addslashes(trim($_POST['acquisition_date']));
$purchase_cost = addslashes(trim($_POST['purchase_cost']));
$vendor_name = addslashes(trim($_POST['vendor_name']));
$vendor_contact = addslashes(trim($_POST['vendor_contact']));
$invoice_number = addslashes(trim($_POST['invoice_number']));
$location = addslashes(trim($_POST['location']));
$department = addslashes(trim($_POST['department']));
$assigned_person = addslashes(trim($_POST['assigned_person']));
$assigned_date = addslashes(trim($_POST['assigned_date']));
$transfer_asset_id = addslashes(trim($_POST['transfer_asset_id']));
$transfer_asset_name = addslashes(trim($_POST['transfer_asset_name']));
$transfer_assigned_person = addslashes(trim($_POST['transfer_assigned_person']));
$transfer_date = addslashes(trim($_POST['transfer_date']));
$transfer_employee = addslashes(trim($_POST['transfer_employee']));
$transfer_location = addslashes(trim($_POST['transfer_location']));
$asset_qty = addslashes(trim($_POST['asset_qty']));
$transfer_asset_qty = addslashes(trim($_POST['transfer_asset_qty']));
$srno = $_POST['srno'];

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
    
    if($_GET['id']==''){
$sql73 = "INSERT INTO tbl_assets SET srno='$srno',UserId='$UserId', ProductName='$ProductName', Phone='$Phone', EmailId='$EmailId', Price='$Price', Gst='$Gst', ShopName='$ShopName', Address='$Address', PurchaseDate='$PurchaseDate', CreatedDate='$CreatedDate', Photo='$Photo', CreatedBy='$CreatedBy', WarrantyDate='$WarrantyDate', OtherName='$OtherName', asset_id='$asset_id', asset_name='$asset_name', asset_category='$asset_category', acquisition_date='$acquisition_date', purchase_cost='$purchase_cost', vendor_name='$vendor_name', vendor_contact='$vendor_contact', invoice_number='$invoice_number', location='$location', department='$department', assigned_person='$assigned_person', assigned_date='$assigned_date', transfer_asset_id='$transfer_asset_id', transfer_asset_name='$transfer_asset_name', transfer_assigned_person='$transfer_assigned_person', transfer_date='$transfer_date', transfer_employee='$transfer_employee', transfer_location='$transfer_location',asset_qty='$asset_qty',transfer_asset_qty='$transfer_asset_qty'";
   $conn->query($sql73);

  echo "<script>alert('New Asset Created Successfully!');window.location.href='view-assets.php';</script>";
    }
    else{
         $sql73 = "UPDATE tbl_assets SET UserId='$UserId',ProductName='$ProductName',Phone='$Phone',EmailId='$EmailId',Price='$Price',Gst='$Gst',ShopName='$ShopName',Address='$Address',PurchaseDate='$PurchaseDate',ModifiedDate='$CreatedDate',Photo='$Photo',ModifiedBy='$user_id',CreatedBy='$CreatedBy',WarrantyDate='$WarrantyDate',OtherName='$OtherName', asset_id='$asset_id', asset_name='$asset_name', asset_category='$asset_category', acquisition_date='$acquisition_date', purchase_cost='$purchase_cost', vendor_name='$vendor_name', vendor_contact='$vendor_contact', invoice_number='$invoice_number', location='$location', department='$department', assigned_person='$assigned_person', assigned_date='$assigned_date', transfer_asset_id='$transfer_asset_id', transfer_asset_name='$transfer_asset_name', transfer_assigned_person='$transfer_assigned_person', transfer_date='$transfer_date', transfer_employee='$transfer_employee', transfer_location='$transfer_location',asset_qty='$asset_qty',transfer_asset_qty='$transfer_asset_qty' WHERE id='$id'";
   $conn->query($sql73);
     echo "<script>alert('Asset Updated Successfully!');window.location.href='view-assets.php';</script>";
    }
  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Add
                            <?php } ?> Asset</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                     

                                  <div class="form-group col-md-12">
<label class="form-label">Account </label>
  <select class="select2-demo form-control" id="UserId" name="UserId">
      <option selected="" disabled="" value="">Select Account</option>
     
     <?php 
     $sql1 = "SELECT * FROM tbl_users_bill WHERE Roll=5";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
          
      ?>
    <option <?php if($row7['UserId'] == $result['id']){?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['ShopName']." (".$result['Phone'].")"; ?></option>
<?php } ?>
 

</select>
<div class="clearfix"></div>
</div>


  <div class="form-group col-md-12">
   <label class="form-label">Product Name </label>
     <input type="text" name="ProductName" id="ProductName" class="form-control"
                                                placeholder="" value="<?php echo $row7["ProductName"]; ?>"
                                                autocomplete="off"  required>
    <div class="clearfix"></div>
 </div>

<div class="form-group col-md-6">
                                            <label class="form-label">Product Price </label>
                                            <input type="text" name="Price" id="Price" class="form-control"
                                                placeholder="" value="<?php echo $row7["Price"]; ?>"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>
 
<div class="form-group col-lg-6">
<label class="form-label">GST<span class="text-danger">*</span></label>
<select class="form-control" name="Gst" required="">
    <option value="" selected>Select GST</option>
<option value="Yes" <?php if($row7["Gst"]=='Yes') {?> selected <?php } ?>>Yes</option>
<option value="No" <?php if($row7["Gst"]=='No') {?> selected <?php } ?>>No </option>
</select>
</div>
   <div class="form-group col-md-12">
   <label class="form-label">Bill Upload </label>
    <label class="custom-file">
<input type="file" class="custom-file-input" id="Photo" name="Photo" style="opacity: 1;">
<input type="hidden" name="OldPhoto" id="OldPhoto" value="<?php echo $row7["Photo"]; ?>">
<span class="custom-file-label"></span>
</label>
<?php if($row7['Photo']=='') {} else{?>
  <span id="show_photo">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo"></a><img src="../uploads/<?php echo $row7['Photo'];?>" alt="" class="img-fluid ticket-file-img" style="width: 64px;height: 64px;"></div>
</span>
<?php } ?>
 </div> 
      
       <div class="form-group col-md-12">
                                            <label class="form-label">Shop Name</label>
                                            <input type="text" name="ShopName" class="form-control"
                                                placeholder="" value="<?php echo $row7["ShopName"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                 
                                  <div class="form-group col-md-6">
                                            <label class="form-label">Phone No / Toll Free No</label>
                                            <input type="text" name="Phone" class="form-control"
                                                placeholder="" value="<?php echo $row7["Phone"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>       
                                        
                                         <div class="form-group col-md-6">
                                            <label class="form-label">Email Id</label>
                                            <input type="email" name="EmailId" class="form-control"
                                                placeholder="" value="<?php echo $row7["EmailId"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>       



<div class="form-group col-md-12">
<label class="form-label">Address</label>
<textarea name="Address" class="form-control" id="Address" placeholder="" ><?php echo $row7['Address'];?></textarea>
<div class="clearfix"></div>
</div>



   <div class="form-group col-md-6">
                                            <label class="form-label">Purchase Date</label>
                                            <input type="date" name="PurchaseDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["PurchaseDate"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-6">
                                            <label class="form-label">Warranty Date</label>
                                            <input type="date" name="WarrantyDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["WarrantyDate"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
<label class="form-label">Purchase By </label>
  <select class="select2-demo form-control" id="CreatedBy" name="CreatedBy" >
      <option selected="" disabled="" value="">Select Account</option>
     
     <?php 
     $sql1 = "SELECT tu.*,tut.Name As AccType FROM tbl_users tu LEFT JOIN tbl_user_type tut ON tu.Roll=tut.id WHERE tu.Status=1 AND tu.Roll NOT IN(1,5,55,9,22,23,63)";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
          
      ?>
    <option <?php if($row7['CreatedBy'] == $result['id']){?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['Fname']." (".$result['Phone'].") - ".$result['AccType']; ?></option>
    
<?php } ?>
 <option value="0" <?php if($row7['CreatedBy'] == 0){?> selected <?php } ?>>Other</option>

</select>
<div class="clearfix"></div>
</div>

 <div class="form-group col-md-12">
                                            <label class="form-label">Other Person Name</label>
                                            <input type="text" name="OtherName" class="form-control"
                                                placeholder="" value="<?php echo $row7["OtherName"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        

</div>
 <h4 class="mt-5">Asset Management</h4>
<div class="row">
    <input type="hidden" id="srno" name="srno" value="<?php echo $row7['srno']; ?>">
    <div class="form-group col-md-3">
        <label class="form-label">Asset ID/Serial Number</label>
        <input type="text" name="asset_id" id="asset_id" class="form-control" placeholder="Auto-numbered" value="<?php echo $row7['asset_id']; ?>" readonly>
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Asset Name/Description</label>
        <input type="text" name="asset_name" class="form-control" placeholder="Enter asset description" value="<?php echo $row7['asset_name']; ?>">
    </div>
    <div class="form-group col-md-3">
        <label class="form-label">Qty</label>
        <input type="text" name="asset_qty" id="asset_qty" class="form-control" placeholder="" value="<?php echo $row7['asset_qty']; ?>" >
    </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-6">
        <label class="form-label">Asset Category</label>
        <select name="asset_category" id="asset_category" class="form-control" onchange="getSerialNo(this.value)">
            <option value="" disabled selected>Select category</option>
            <?php 
     $sql1 = "SELECT * FROM tbl_asset_category WHERE status=1 ORDER BY id ASC";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
          
      ?>
    <option <?php if($row7['asset_category'] == $result['id']){?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
    
<?php } ?>

        </select>
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Date of Acquisition</label>
        <input type="date" name="acquisition_date" class="form-control" value="<?php echo $row7['acquisition_date']; ?>">
    </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-6">
        <label class="form-label">Purchase Cost</label>
        <input type="number" name="purchase_cost" class="form-control" placeholder="Enter purchase cost" value="<?php echo $row7['purchase_cost']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Supplier/Vendor Name</label>
        <input type="text" name="vendor_name" class="form-control" placeholder="Enter supplier/vendor name" value="<?php echo $row7['vendor_name']; ?>">
    </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-6">
        <label class="form-label">Supplier/Vendor Contact Number</label>
        <input type="tel" name="vendor_contact" class="form-control" placeholder="Enter contact number" value="<?php echo $row7['vendor_contact']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Invoice/Order Number</label>
        <input type="text" name="invoice_number" class="form-control" placeholder="Enter invoice/order number" value="<?php echo $row7['invoice_number']; ?>">
    </div>
</div>

<!-- Asset Location and Use -->
<h4 class="mt-5">Asset Location and Use</h4>
<div class="row mt-3">
    <div class="form-group col-md-6">
        <label class="form-label">Location</label>
        <select name="location" class="select2-demo form-control">
            <option value="0" disabled selected>Select location</option>

 <?php 
  $sql12 = "SELECT * FROM tbl_users_bill WHERE Roll=5";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["location"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['ShopName']." (".$result['Phone'].")"; ?></option>
<?php } ?>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Department/Unit</label>
        <select name="department" class="form-control">
            <option value="" disabled>Select department</option>
            <option value="HR" <?php echo ($row7['department'] == 'HR' ? 'selected' : ''); ?>>HR</option>
            <option value="IT" <?php echo ($row7['department'] == 'IT' ? 'selected' : ''); ?>>IT</option>
            <option value="Finance" <?php echo ($row7['department'] == 'Finance' ? 'selected' : ''); ?>>Finance</option>
            <option value="Other" <?php echo ($row7['department'] == 'Other' ? 'selected' : ''); ?>>Other</option>
        </select>
    </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-6">
        <label class="form-label">Assigned Person</label>
        <input type="text" name="assigned_person" class="form-control" placeholder="Enter assigned person's name" value="<?php echo $row7['assigned_person']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Assigned Date</label>
        <input type="date" name="assigned_date" class="form-control" value="<?php echo $row7['assigned_date']; ?>">
    </div>
</div>

            <!-- Asset Transfer -->
            <h4 class="mt-5">Asset Transfer</h4>
            <div class="row mt-3">
    <div class="form-group col-md-3">
        <label class="form-label">Asset ID</label>
        <input type="text" name="transfer_asset_id" class="form-control" placeholder="" value="<?php echo $row7['transfer_asset_id']; ?>" >
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Name of Asset</label>
        <input type="text" name="transfer_asset_name" class="form-control" placeholder="" value="<?php echo $row7['transfer_asset_name']; ?>" >
    </div>
    <div class="form-group col-md-3">
        <label class="form-label">Qty</label>
        <input type="text" name="transfer_asset_qty" id="transfer_asset_qty" class="form-control" placeholder="" value="<?php echo $row7['transfer_asset_qty']; ?>" >
    </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-6">
        <label class="form-label">Assigned Person</label>
        <input type="text" name="transfer_assigned_person" class="form-control" placeholder="" value="<?php echo $row7['transfer_assigned_person']; ?>" >
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Transfer Date</label>
        <input type="date" name="transfer_date" class="form-control" value="<?php echo $row7['transfer_date']; ?>">
    </div>
</div>
<div class="row mt-3">
    <div class="form-group col-md-6">
        <label class="form-label">Transfer to Employee</label>
        <select name="transfer_employee" class="form-control">
            <option value="" disabled>Select employee</option>
            <option value="Employee 1" <?php echo ($row7['transfer_employee'] == 'Employee 1' ? 'selected' : ''); ?>>Employee 1</option>
            <option value="Employee 2" <?php echo ($row7['transfer_employee'] == 'Employee 2' ? 'selected' : ''); ?>>Employee 2</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Transfer to Other Location</label>
        <select name="transfer_location" class="form-control">
            <option value="" disabled>Select location</option>
            <option value="Location 1" <?php echo ($row7['transfer_location'] == 'Location 1' ? 'selected' : ''); ?>>Location 1</option>
            <option value="Location 2" <?php echo ($row7['transfer_location'] == 'Location 2' ? 'selected' : ''); ?>>Location 2</option>
        </select>
    </div>
</div>
                                   <div class="form-row">
                                    <div class="form-group col-md-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Submit</button>
                                    </div>

                
                                    </div>
                               </div>


 <div class="col-lg-5" id="emidetails" style="display:none;">
    

 </div>

  
                                

 </div>
 </form>





                            </div>
                        </div>



</div>


                   


                    <?php include_once 'footer.php'; ?>
                </div>

            </div>

        </div>

        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>


    <?php include_once 'footer_script.php'; ?>

 <script>
 function getSerialNo(id){
     var action = "getSerialNo";
            $.ajax({
                url: "ajax_files/ajax_assets.php",
                method: "POST",
                data: {
                    action: action,
                    id: id
                },
                success: function(data) {
                    var res = JSON.parse(data);
                    $('#asset_id').val(res.SerialId);
                   $('#srno').val(res.SrNo);
                    
                }
            });
 }
       $(document).ready(function() {
     $(document).on("change", "#UserId", function(event) {
            var val = this.value;
            var action = "getUserDetails";
            $.ajax({
                url: "ajax_files/ajax_vendor.php",
                method: "POST",
                data: {
                    action: action,
                    id: val
                },
                dataType:"json",  
                success: function(data) {
                    $('#EmailId').val(data.EmailId);
                    $('#Name').val(data.Fname);
                    $('#Phone').val(data.Phone);
                    
                }
            });

        });
       });
 </script>
</body>

</html>