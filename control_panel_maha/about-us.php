<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="About";
$Page = "About";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - About Us</title>
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

if($_REQUEST["action"]=="deletephoto")
{
  $id = $_REQUEST["id"];
  $pid = $_REQUEST["pid"];
  $sql11 = "UPDATE tbl_cms_details SET Photo='' WHERE id = '1'";
  $conn->query($sql11);
?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
       window.location.href="about-us.php";
    </script>
<?php } 

if($_REQUEST["action"]=="deletephoto2")
{
  $id = $_REQUEST["id"];
  $pid = $_REQUEST["pid"];
  $sql11 = "UPDATE tbl_cms_details SET Photo2='' WHERE id = '1'";
  $conn->query($sql11);
?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
       window.location.href="about-us.php";
    </script>
<?php }

$sql = "SELECT * FROM tbl_cms_details WHERE id=1";
$row = getRecord($sql);


  if(isset($_POST['submit'])){
    $AboutUs = addslashes(trim($_POST['AboutUs']));
    $Video = addslashes(trim($_POST['Video']));
    $Terms_Condition = addslashes(trim($_POST['Terms_Condition']));
    $Details = addslashes(trim($_POST['Details']));
    $Title = addslashes(trim($_POST['Title']));
    $Vision = addslashes(trim($_POST['Vision']));
    $Mission = addslashes(trim($_POST['Mission']));
    
    $Details1 = addslashes(trim($_POST['Detail1']));
    $Title1 = addslashes(trim($_POST['Title1']));
    $Details2 = addslashes(trim($_POST['Detail2']));
    $Title2 = addslashes(trim($_POST['Title2']));

    $OldPhoto = $_POST['OldPhoto'];
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

    $OldPhoto2 = $_POST['OldPhoto2'];
    $randno2 = rand(1,100);
    $src2 = $_FILES['Photo2']['tmp_name'];
    $fnm2 = substr($_FILES["Photo2"]["name"], 0,strrpos($_FILES["Photo2"]["name"],'.')); 
    $fnm2 = str_replace(" ","_",$fnm2);
    $ext2 = substr($_FILES["Photo2"]["name"],strpos($_FILES["Photo2"]["name"],"."));
    $dest2 = '../uploads/'. $randno2 . "_".$fnm2. $ext2;
    $imagepath2 =  $randno2 . "_".$fnm2 . $ext2;
    if(move_uploaded_file($src2, $dest2))
    {
    $Photo2 = $imagepath2 ;
    } 
    else{
      $Photo2 = $_POST['OldPhoto2'];
    }

     $sql = "UPDATE tbl_cms_details SET AboutUs='$AboutUs',Photo='$Photo',Video='$Video',Photo2='$Photo2',Details='$Details',Title='$Title',Vision='$Vision',Mission='$Mission',Detail1='$Details1',Title1='$Title1',Detail2='$Details2',Title2='$Title2' WHERE id='1'";
    $conn->query($sql);?>
    <script>
        alert("Content Update Successfully");
        window.location.href="about-us.php";
    </script>
    <?php 
  }
 ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">About Us</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form id="validation-form" method="post" enctype="multipart/form-data">
<div class="form-row">


<!-- <div class="form-group col-md-12">
<label class="form-label">Title <span class="text-danger">*</span></label>
<input type="text" name="Title" class="form-control" id="Title" placeholder="Title" value="<?php echo $row['Title']; ?>" required>
<div class="clearfix"></div>
</div> -->

<!-- <div class="form-group col-md-12">
  <label class="form-label">Short About Us</label>
  <textarea class="form-control" name="Details" ><?php echo $row["Details"]; ?></textarea>
</div> -->

<div class="form-group col-md-12">
  <label class="form-label">About Us</label>
  <textarea class="form-control" name="AboutUs" id="editor1"><?php echo $row["AboutUs"]; ?></textarea>
</div>



<div class="form-group col-md-12">
  <label class="form-label"> Image </label>
<label class="custom-file">
<input type="file" class="custom-file-input" name="Photo" style="opacity: 1;">
<input type="hidden" name="OldPhoto" value="<?php echo $row['Photo'];?>" id="OldPhoto">
<span class="custom-file-label"></span>
</label>
<?php if($row['Photo']=='') {} else{?>
  <span id="show_photo">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=deletephoto" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo" onClick="return confirm('Are you sure you want delete this Image?');"></a><img src="../uploads/<?php echo $row['Photo'];?>" alt="" class="img-fluid ticket-file-img" style="width: 64px;height: 64px;"></div>
</span>
<?php } ?>
</div>


<!-- <div class="form-group col-md-12">
  <label class="form-label">Vision</label>
  <textarea class="form-control" name="Vision" id="editor2"><?php echo $row["Vision"]; ?></textarea>
</div>


<div class="form-group col-md-12">
  <label class="form-label">Mission</label>
  <textarea class="form-control" name="Mission" id="editor3"><?php echo $row["Mission"]; ?></textarea>
</div>
 -->


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
        CKEDITOR.replace( 'editor1');
        CKEDITOR.replace( 'editor2');
        CKEDITOR.replace( 'editor3');
</script>
</body>
</html>
