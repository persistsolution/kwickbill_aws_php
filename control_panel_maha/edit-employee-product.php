<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="E-Commerce-Employee";
$Page = "Add-Employee-Product";

?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
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
$sql7 = "SELECT * FROM products WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

<?php 
  if(isset($_POST['submit'])){
   $ProductName = addslashes(trim($_POST['ProductName']));
$Details = addslashes(trim($_POST['Details']));
$SubCatId = $_POST['SubCatId'];
$BrandId = $_POST['BrandId'];
$CatId = $_POST['CatId'];
$BatchCode = addslashes(trim($_POST['BatchCode']));
$NameSize = $_POST['NameSize'];
$Size = $_POST['Size'];
$NameColor = $_POST['NameColor'];
//$Color2 = implode(",",$_POST['Color']);
$NameStorage = $_POST['NameStorage'];
$Storage = $_POST['Storage'];
$NameRam = $_POST['NameRam'];
$Ram = $_POST['Ram'];
$MinPrice = $_POST['MinPrice'];
$MaxPrice = $_POST['MinPrice'];
$OfferPrice = $_POST['OfferPrice'];
$OfferPer = $_POST['OfferPer'];
$Cashback = $_POST['Cashback'];
$Featured = $_POST['Featured'];
$FreeShipping = $_POST['FreeShipping'];
$Bestseller = $_POST['Bestseller'];
$ItemStock = $_POST['ItemStock'];
$Subscription = $_POST['Subscription'];
$Stock = $_POST['Stock'];
$Discount = $_POST['Discount'];
$Tax = $_POST['Tax'];
$VedId = $_POST['VedId'];
$Pune = $_POST['Pune'];
$Dhule = $_POST['Dhule'];
$Ahemadnagar = $_POST['Ahemadnagar'];

$Shirpur = $_POST['Shirpur'];
$Mumbai = $_POST['Mumbai'];
$Panvel = $_POST['Panvel'];
$Points = $_POST['Points'];

$Highlight1 = addslashes(trim($_POST['Highlight1']));
$Highlight2 = addslashes(trim($_POST['Highlight2']));
$Highlight3 = addslashes(trim($_POST['Highlight3']));
$Highlight4 = addslashes(trim($_POST['Highlight4']));
$Highlight5 = addslashes(trim($_POST['Highlight5']));

$MetaTag = addslashes(trim($_POST['MetaTag']));
$MetaDesc = addslashes(trim($_POST['MetaDesc']));
$Keywords = addslashes(trim($_POST['Keywords']));
$DeliveryInfo = addslashes(trim($_POST['DeliveryInfo']));
$Offers = addslashes(trim($_POST['Offers']));

$MinQty = addslashes(trim($_POST['MinQty']));
 $Status = $_POST['Status'];
/*if($Stock == 1){
    $Status = 1;
}
else{
    $Status = 0;
}*/
$ProdFor = $_POST['ProdFor'];
$CreatedDate = date('Y-m-d');

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


function RandomStringGenerator($n)
{
    $generated_string = "";   
    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $len = strlen($domain);
    for ($i = 0; $i < $n; $i++)
    {
        $index = rand(0, $len - 1);
        $generated_string = $generated_string . $domain[$index];
    }
    return $generated_string;
} 
$n = 10;
$Code = RandomStringGenerator($n); 


 
   $sql = "UPDATE products SET ProductName='$ProductName',Details='$Details',CatId='$CatId',SubCatId='$SubCatId',BrandId='$BrandId',BatchCode='$BatchCode',NameSize='$NameSize',Size='$Size',NameColor='$NameColor',Color='$Color2',NameStorage='$NameStorage',Storage='$Storage',NameRam='$NameRam',Ram='$Ram',MinPrice='$MinPrice',MaxPrice='$MaxPrice',OfferPrice='$OfferPrice',OfferPer='$OfferPer',Tax='$Tax',Cashback='$Cashback',Featured='$Featured',FreeShipping='$FreeShipping',Bestseller='$Bestseller',Photo='$Photo',ItemStock='$ItemStock',Stock='$Stock',Status='$Status',VedId='$VedId',DeliveryInfo='$DeliveryInfo',Offers='$Offers',MetaTag='$MetaTag',MetaDesc='$MetaDesc',Keywords='$Keywords',ModifiedDate='$CreatedDate',Highlight1='$Highlight1',Highlight2='$Highlight2',Highlight3='$Highlight3',Highlight4='$Highlight4',Highlight5='$Highlight5',Discount='$Discount',Subscription='$Subscription',Pune='$Pune',Dhule='$Dhule',Ahemadnagar='$Ahemadnagar',Shirpur='$Shirpur',Mumbai='$Mumbai',Panvel='$Panvel',DdsOffers='$DdsOffers',MinQty='$MinQty',ProdFor='2',Points='$Points' WHERE id='$id'";
$conn->query($sql);
$ProdId = $id;

if (isset($_FILES['Files'])) {
    $errors = array();
    foreach ($_FILES['Files']['tmp_name'] as $key => $tmp_name) {
        $file_name = $key . $_FILES['Files']['name'][$key];
        $file_size = $_FILES['Files']['size'][$key];
        $file_tmp = $_FILES['Files']['tmp_name'][$key];
        $file_type = $_FILES['Files']['type'][$key];
        $FileName = $_FILES['Files']['name'][$key];
        
        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
        }
        if ($file_name == '0' || $file_size == '0') {} else {
             $query = "INSERT into product_images SET ProductId='$ProdId',Files='$file_name',FileName='$FileName'";
            $desired_dir = "../uploads/";
            if (empty($errors) == true) {
                if (is_dir($desired_dir) == false) {
                    mkdir("$desired_dir", 0700); // Create directory if it does not exist
                }
                if (is_dir("$desired_dir/" . $file_name) == false) {
                    move_uploaded_file($file_tmp, "../uploads/" . $file_name);
                } else {
                    // rename the file if another one exist
                    $new_dir = "../uploads/" . $file_name . time();
                    rename($file_tmp, $new_dir);
                }
                $conn->query($query);
            } else {
                print_r($errors);
            }
        }
        if (empty($error)) {
           
           
        }
    }
}
  echo "<script>alert('Product Updated Successfully!');window.location.href='view-employee-shop-products.php';</script>";


    //header('Location:courses.php'); 

  }
 ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Product</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form id="validation-form" method="post" enctype="multipart/form-data">
<div class="form-row">

 <div class="form-group col-lg-12">
<label class="form-label">Product Name<span class="text-danger">*</span></label>
<input type="text" class="form-control" name="ProductName" value="<?php echo $row7["ProductName"]; ?>" required="">
<div class="clearfix"></div>
</div>

 <div class="form-group col-lg-6">
<label class="form-label">Category <span class="text-danger">*</span></label>
  <select class="form-control" id="CatId" name="CatId" required="">
<option selected="" disabled="" value="">Select Category</option>
<?php 
        $q = "select * from category WHERE Status='1' AND Roll IN (2,3)";
        $r = $conn->query($q);
        while($rw = $r->fetch_assoc())
    {
?>
                <option <?php if($row7['CatId']==$rw['id']){ ?> selected <?php } ?> value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
              <?php } ?></select>
<div class="clearfix"></div>
</div>
<div class="form-group col-lg-6">
<label class="form-label">Sub Category</label>
  <select class="form-control" id="SubCatId" name="SubCatId">
<option selected="" value="0">Select Sub Category</option>
<?php 
    $CatId = $row7['CatId'];
        $q = "select * from sub_category WHERE CatId ='$CatId' AND Status='1'";
        $r = $conn->query($q);
        while($rw = $r->fetch_assoc())
    {
?>
                <option <?php if($row7['SubCatId']==$rw['id']){ ?> selected <?php } ?> value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-lg-3">
<label class="form-label">Price In Points<span class="text-danger">*</span></label>
<div class="input-group">

<input type="text" id="MinPrice" name="MinPrice" class="form-control" value="<?php echo $row7["MinPrice"]; ?>" required="" onKeyPress="return isNumberKey(event)">

<div class="clearfix"></div>
</div>
</div>


 <div class="form-group col-lg-3">
<label class="form-label">Cashback Points<span class="text-danger">*</span></label>
<input type="number" class="form-control" name="Points" value="<?php echo $row7["Points"]; ?>" required="" min=0>
<div class="clearfix"></div>
</div> 

<div class="form-group col-lg-3">
<label class="form-label">Product Stock<span class="text-danger">*</span></label>
<select class="form-control" name="Stock" required="">
<option value="1" <?php if($row7["Stock"]=='1') {?> selected <?php } ?>>Instock</option>
<option value="0" <?php if($row7["Stock"]=='0') {?> selected <?php } ?>>Out of stock</option>
</select>
</div>

<div class="form-group col-lg-3">
<label class="form-label">Status<span class="text-danger">*</span></label>
<select class="form-control" name="Status" required="">
<option value="1" <?php if($row7["Status"]=='1') {?> selected <?php } ?>>Publish</option>
<option value="0" <?php if($row7["Status"]=='0') {?> selected <?php } ?>>Not Publish</option>
</select>
</div>

<div class="form-group col-md-12">
  <label class="form-label">Product Details <span class="text-danger">*</span></label>
<textarea class="form-control" rows="10" name="Details" autocomplete="off" required="required" id="editor1"><?php echo $row7["Details"]; ?></textarea>
</div>

<div class="form-group col-md-12">
 <label class="form-label">Product Image <span class="text-danger">*</span></label>
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
   <label class="form-label">Product Image (Multiple) <span class="text-danger">(File size must be less than 2 MB)</span></label>
<label class="custom-file">
<input type="file" class="custom-file-input" id="Photo2" name="Files[]" style="opacity: 1;" multiple="">
<span class="custom-file-label"></span>
</label>
 <span id="show_photo2">
<?php 
  $id = $_GET['id'];
  $sql2 = "SELECT * FROM product_images WHERE ProductId='$id'";
  $res2 = $conn->query($sql2);
  $rncnt = mysqli_num_rows($res2);
  if($rncnt > 0){
    while($row2 = $res2->fetch_assoc()){?>
    <input type="hidden" name="OldMulImage" id="OldMulImage<?php echo $row2["id"]; ?>" value="<?php echo $row2["Files"]; ?>">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" onclick="delete_photo2(<?php echo $row2["id"]; ?>,<?php echo $_GET["id"]; ?>)"></a><img src="../uploads/<?php echo $row2['Files'];?>" alt="" class="img-fluid ticket-file-img" style="width: 64px;height: 64px;"></div>
<?php }} ?>
</span>
</div>


</div>
<button type="submit" name="submit" class="btn btn-primary btn-finish">Submit</button>
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

  $(document).ready(function() {

     $(document).on("change", "#CatId", function(event){
  var val = this.value;
   var action = "getSubCat";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,id:val},
    success:function(data)
    {
      $('#SubCatId').html(data);
    }
    });

       

    //getBrands(val);

 });

            
            });

        CKEDITOR.replace( 'editor1');
</script>
</body>
</html>