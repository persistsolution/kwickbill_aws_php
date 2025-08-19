<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Complaints";
$Page = "Add-Complaints";
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
$sql7 = "SELECT * FROM tbl_tasks WHERE id='$id'";
$row7 = getRecord($sql7);


if(isset($_POST['submit'])){
    $UserId = addslashes(trim($_POST['UserId']));
    $Message = addslashes(trim($_POST['Message']));
    $Name = addslashes(trim($_POST['Name']));
    $Phone = addslashes(trim($_POST['Phone']));
    $EmailId = addslashes(trim($_POST['EmailId']));
    $CreatedDate = addslashes(trim($_POST['CreatedDate']));
    $CreatedDate2 = date('d-M-Y');
    
    if($_GET['id']==''){
$sql73 = "INSERT INTO tbl_helps_enquiry SET UserId='$UserId',Name='$Name',Phone='$Phone',EmailId='$EmailId',Message='$Message',CreatedDate='$CreatedDate'";
   $conn->query($sql73);
   $tokenid = mysqli_insert_id($conn);
   $TokenNo = "#".rand(1000,9999)."".$tokenid;
   $sql = "UPDATE tbl_helps_enquiry SET TokenNo='$TokenNo',Status=1 WHERE id='$tokenid'";
   $conn->query($sql);

    $sql73 = "INSERT INTO tbl_help_support_details SET TokenId='$tokenid',TokenNo='$TokenNo',UserId='$UserId',Status='1',Message='$Message',SenderName='Customer',CreatedBy='$user_id',CreatedDate='$CreatedDate'";
   $conn->query($sql73);
   

 $smstxt = "Thank you for reaching out to Maha Chai customer support. Request No: ".$TokenNo." Date: ".$CreatedDate2." Our dedicated team is working on your request promptly MAHA CHAI";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169875411820018";
  include '../incsmsapi.php';  
  
  echo "<script>alert('New Complaint Created Successfully!');window.location.href='view-complaints.php';</script>";
    }
  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Add
                            <?php } ?> Complaint</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                     

                                  <div class="form-group col-md-12">
<label class="form-label">Account <span class="text-danger">*</span></label>
  <select class="select2-demo form-control" id="UserId" name="UserId" required="">
      <option selected="" disabled="" value="">Select Account</option>
     
     <?php 
     $sql1 = "SELECT tu.*,tut.Name As AccType FROM tbl_users tu LEFT JOIN tbl_user_type tut ON tu.Roll=tut.id WHERE tu.Status=1";
     $row1 = getList($sql1);
     foreach($row1 as $result)
      {
          
      ?>
    <option <?php if($row7['UserId'] == $result['id']){?> selected <?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['Fname']." (".$result['Phone'].") - ".$result['AccType']; ?></option>
<?php } ?>
 

</select>
<div class="clearfix"></div>
</div>


  <div class="form-group col-md-12">
   <label class="form-label">Name </label>
     <input type="text" name="Name" id="Name" class="form-control"
                                                placeholder="" value="<?php echo $row7["Name"]; ?>"
                                                autocomplete="off"  required>
    <div class="clearfix"></div>
 </div>

<div class="form-group col-md-6">
                                            <label class="form-label">Contact No </label>
                                            <input type="text" name="Phone" id="Phone" class="form-control"
                                                placeholder="" value="<?php echo $row7["Phone"]; ?>"
                                                autocomplete="off" required>
                                            <div class="clearfix"></div>
                                        </div>
 

   <div class="form-group col-md-6">
   <label class="form-label">Email Id </label>
     <input type="email" name="EmailId" id="EmailId" class="form-control"
                                                placeholder="" value="<?php echo $row7["EmailId"]; ?>"
                                                autocomplete="off" >
    <div class="clearfix"></div>
 </div> 
                                        
 <div class="form-group col-md-12">
                                            <label class="form-label">Complaint Date</label>
                                            <input type="date" name="CreatedDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["CreatedDate"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>


<div class="form-group col-md-12">
<label class="form-label">Complaints <span class="text-danger">*</span></label>
<textarea name="Message" class="form-control" id="Message" placeholder="Message"  required><?php echo $row7['Message'];?></textarea>
<div class="clearfix"></div>
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