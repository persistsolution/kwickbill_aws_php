<?php 
session_start();
include_once 'config.php';
require_once "database.php";
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Notifications";
$Page = "Employee-Notification";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Notifications</title>
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
  if(isset($_POST['submit'])){
    $AccType = $_POST['AccType'];
    $AccName = $_POST['AccName'];
    $Title = addslashes(trim($_POST['Title']));
    $Message = addslashes(trim($_POST['Message']));
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
    $sql73 = "SELECT Tokens,id FROM tbl_users WHERE Status='1' AND Tokens!=''";
    if($AccName == 'all'){
      $sql73.= "";
    }
    else{
        $sql73.= " AND id='$AccName'";
      }
      
    //echo $sql73;exit();
    $data=mysqli_query($con,$sql73);
        
        while($row=mysqli_fetch_array($data))
        {
            
             $ReceiverId = $row['id'];
             $sql = "INSERT INTO tbl_notifications SET SenderId='$user_id',ReceiverId='$ReceiverId',Title='$Title',Message='$Message',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime'";
            $conn->query($sql);

            $title = $Title;
            $body =  $Message;
            $reg_id = $row[0];
            $registrationIds = array($reg_id);
            //$url = "$SiteUrl/profile.php?id=$UserId";
            include '../incnotification.php';
         
        }
        exit();
    ?>
    <script>
        alert("Notification Sent Successfully");
        window.location.href="employee-notifications.php";
    </script>
    <?php 
  }
 ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Employee Notifications</h4>


<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form id="validation-form" method="post" enctype="multipart/form-data">
<div class="form-row">
<div class="form-group col-md-12">
<label class="form-label">Employee Name<span class="text-danger">*</span></label>
<select class="select2-demo form-control" id="AccName" name="AccName" required>
    <option value="all" selected>All Employee</option>
      <optgroup label="Telecaller">
     <?php 
     $sql1 = "SELECT * FROM tbl_users WHERE Status=1 AND Roll IN(2)";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
      ?>
    <option  value="<?php echo $result['id']; ?>"><?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
 </optgroup>
 
 <optgroup label="Executive">
     <?php 
     $sql1 = "SELECT * FROM tbl_users WHERE Status=1 AND Roll=6";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
      ?>
    <option  value="<?php echo $result['id']; ?>"><?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
 </optgroup>
 
  <!--<optgroup label="Dealer">
     <?php 
     $sql1 = "SELECT * FROM tbl_users WHERE Status=1 AND Roll=7";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
      ?>
    <option  value="<?php echo $result['id']; ?>"><?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
 </optgroup>-->
 
</select>
<div class="clearfix"></div>
</div>
<div class="form-group col-md-12">
<label class="form-label">Title <span class="text-danger">*</span></label>
<input type="text" name="Title" id="Title" class="form-control" placeholder="Title" value="" autocomplete="off" required>
</div>
<div class="form-group col-md-12">
  <label class="form-label">Notification <span class="text-danger">*</span></label>
  <textarea class="form-control" name="Message" required></textarea>
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
<script type="text/javascript">
  function getMembers(val){
    var action = "getMembers";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,id:val},
    success:function(data)
    {
      $('#AccName').html(data);
    }
    });
  }
</script>
</body>
</html>
