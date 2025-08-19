<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Customer-Query";
$Page = "Add-Customer-Query";
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
$sql7 = "SELECT * FROM tbl_customer_queries WHERE id='$id'";
$row7 = getRecord($sql7);


if(isset($_POST['submit'])){
    $CustId = addslashes(trim($_POST["CustId"]));
     $CallAfter = addslashes(trim($_POST["CallAfter"]));
$NextDate = addslashes(trim($_POST["NextDate"]));
$NextTime = addslashes(trim($_POST["NextTime"]));
$Details = addslashes(trim($_POST["Details"]));
$Diaposition = addslashes(trim($_POST["Diaposition"]));
$CreatedDate = $_POST['CreatedDate'];
$CreatedTime = date('h:i a');


if($_GET['id']==''){
     $qx = "INSERT INTO tbl_customer_queries SET CustId='$CustId',Status='1',CreatedBy='$user_id',NextDate='$NextDate',NextTime='$NextTime',Details='$Details',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime',Diaposition='$Diaposition'";
  $conn->query($qx);
  echo "<script>alert('Query Added Successfully!');window.location.href='view-customer-query.php';</script>";
}
else{
 //$TicketNo= "#".rand(1000,9999);
    $query2 = "UPDATE tbl_customer_queries SET CustId='$CustId',Status='1',NextDate='$NextDate',NextTime='$NextTime',Details='$Details',CreatedDate='$CreatedDate',Diaposition='$Diaposition',ModifiedDate='$ModifiedDate',ModifiedBy='$user_id' WHERE id = '$id'";
  $conn->query($query2);
  echo "<script>alert('Task Updated Successfully!');window.location.href='view-tasks.php';</script>";

}
    //header('Location:courses.php'); 

  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Add
                            <?php } ?> Customer Query</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                     

                                    <div class="form-group col-md-12" style="padding-top:10px;">
<label class="form-label"> Customer<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="CustId" id="CustId" required>
<option selected="" value="">Select Customer</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll=5";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["CustId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>


<div class="form-group col-lg-12">
<label class="form-label">Query / Conversation <span class="text-danger">*</span></label>
<textarea name="Details" class="form-control" placeholder="Details" required><?php echo $row7['Details'];?></textarea>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6 col-lg-6 col-xl-4">
<label class="form-label">Query Date</label>
<input type="date" name="CreatedDate" class="form-control" id="CreatedDate" placeholder="" value="<?php echo $row7['CreatedDate'];?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6 col-lg-6 col-xl-4">
<label class="form-label">Call After Date</label>
<input type="date" name="NextDate" class="form-control" id="NextDate" placeholder="" value="<?php echo $row7['NextDate'];?>">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6 col-lg-6 col-xl-4">
<label class="form-label">Time</label>
<input type="text" name="NextTime" class="form-control" id="NextTime" placeholder="" value="<?php echo $row7['NextTime'];?>">
<div class="clearfix"></div>
</div>

 <div class="form-group col-md-12">
                                            <label class="form-label"> Status </label>
                                            <select class="form-control" name="Diaposition" id="Diaposition">
                                                <option selected="" disabled="">Select  Status</option>
                                                <?php 
                                        $q = "select * from tbl_diapostion WHERE Status=1 AND id!=2 ORDER BY SrNo ASC";
                                        $r = $conn->query($q);
                                        while($rw = $r->fetch_assoc())
                                    {
                                ?>
                                                <option <?php if($row7['Diaposition']==$rw['id']){ ?> selected <?php } ?>
                                                    value="<?php echo $rw['id']; ?>"><?php echo $rw['Name']; ?></option>
                                                <?php } ?>
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

 
</body>

</html>