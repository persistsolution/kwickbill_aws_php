<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Add Manager Checkpoint";
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
        
        $sql55 = "SELECT * FROM tbl_company_emails WHERE id=1";
        $row55 = getRecord($sql55);
        
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_advance_request WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

<?php 
  if(isset($_POST['submit'])){
$staff_grooming = addslashes(trim($_POST['staff_grooming']));
$staff_grooming_question = addslashes(trim($_POST['question_staff_grooming']));

$food_quality_test = addslashes(trim($_POST['food_quality_test']));
$food_quality_test_question = addslashes(trim($_POST['question_food_quality_test']));

$store_stock_check = addslashes(trim($_POST['store_stock_check']));
$store_stock_check_question = addslashes(trim($_POST['question_store_stock_check']));

$problem_solutions = addslashes(trim($_POST['problem_solutions']));
$problem_solutions_question = addslashes(trim($_POST['question_problem_solutions']));

$preparation_freezer = addslashes(trim($_POST['preparation_freezer']));
$preparation_freezer_question = addslashes(trim($_POST['question_preparation_freezer']));

$equipment_maintenance_check = addslashes(trim($_POST['equipment_maintenance_check']));
$equipment_maintenance_check_question = addslashes(trim($_POST['question_equipment_maintenance_check']));

$outlet_running_operation = addslashes(trim($_POST['outlet_running_operation']));
$outlet_running_operation_question = addslashes(trim($_POST['question_outlet_running_operation']));

$unused_product_transfer = addslashes(trim($_POST['unused_product_transfer']));
$unused_product_transfer_question = addslashes(trim($_POST['question_unused_product_transfer']));

$sale_purchase_report = addslashes(trim($_POST['sale_purchase_report']));
$sale_purchase_report_question = addslashes(trim($_POST['question_sale_purchase_report']));

$counter_display_arrangement = addslashes(trim($_POST['counter_display_arrangement']));
$counter_display_arrangement_question = addslashes(trim($_POST['question_counter_display_arrangement']));

$question_issue_observation = addslashes(trim($_POST['question_issue_observation']));
$issue_observation = addslashes(trim($_POST['issue_observation']));

$FrId = addslashes(trim($_POST['FrId']));

$CreatedDate = date('Y-m-d');

if ($_GET['id'] == '') {
    $sql = "SELECT * FROM tbl_manager_checkpoint WHERE userid='$user_id' AND createddate='$CreatedDate'";
    $rncnt = getRow($sql);
    if($rncnt > 0){?>
        <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Error",
  text: "Today Date Form Already Filled.",
  type: "error",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-manager-checkpoint.php";
  }
}); });</script>
<?php
    }
    else {
     $qx = "INSERT INTO tbl_manager_checkpoint SET 
    staff_grooming_question='$staff_grooming_question', 
    staff_grooming='$staff_grooming', 
    food_quality_test_question='$food_quality_test_question', 
    food_quality_test='$food_quality_test', 
    store_stock_check_question='$store_stock_check_question', 
    store_stock_check='$store_stock_check', 
    problem_solutions_question='$problem_solutions_question', 
    problem_solutions='$problem_solutions', 
    preparation_freezer_question='$preparation_freezer_question', 
    preparation_freezer='$preparation_freezer', 
    equipment_maintenance_check_question='$equipment_maintenance_check_question', 
    equipment_maintenance_check='$equipment_maintenance_check', 
    outlet_running_operation_question='$outlet_running_operation_question', 
    outlet_running_operation='$outlet_running_operation', 
    unused_product_transfer_question='$unused_product_transfer_question', 
    unused_product_transfer='$unused_product_transfer', 
    sale_purchase_report_question='$sale_purchase_report_question', 
    sale_purchase_report='$sale_purchase_report', 
    counter_display_arrangement_question='$counter_display_arrangement_question', 
    counter_display_arrangement='$counter_display_arrangement',question_issue_observation='$question_issue_observation',issue_observation='$issue_observation',
        createddate='$CreatedDate', 
        createdby='$user_id', 
        userid='$user_id',FrId='$FrId'";

    $conn->query($qx);
  //$to = $row55['ExpMail'];
 // $allmail = $row55['AllMail'];
  //include("incenquirymail.php");
  //include("sendmailsmtp.php");?>
  <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Form Successfully submitted.",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-manager-checkpoint.php";
  }
}); });</script>
<?php 
} }
else{
 
    $query2 = "UPDATE tbl_manager_checkpoint SET staff_grooming_question='$staff_grooming_question', 
    staff_grooming='$staff_grooming', 
    food_quality_test_question='$food_quality_test_question', 
    food_quality_test='$food_quality_test', 
    store_stock_check_question='$store_stock_check_question', 
    store_stock_check='$store_stock_check', 
    problem_solutions_question='$problem_solutions_question', 
    problem_solutions='$problem_solutions', 
    preparation_freezer_question='$preparation_freezer_question', 
    preparation_freezer='$preparation_freezer', 
    equipment_maintenance_check_question='$equipment_maintenance_check_question', 
    equipment_maintenance_check='$equipment_maintenance_check', 
    outlet_running_operation_question='$outlet_running_operation_question', 
    outlet_running_operation='$outlet_running_operation', 
    unused_product_transfer_question='$unused_product_transfer_question', 
    unused_product_transfer='$unused_product_transfer', 
    sale_purchase_report_question='$sale_purchase_report_question', 
    sale_purchase_report='$sale_purchase_report', 
    counter_display_arrangement_question='$counter_display_arrangement_question', 
    counter_display_arrangement='$counter_display_arrangement',modifieddate='$CreatedDate',modifiedby='$user_id'
    ,question_issue_observation='$question_issue_observation',issue_observation='$issue_observation',FrId='$FrId' WHERE id = '$id'";
  $conn->query($query2);
  ?>
  <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Form Successfully Updated.",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-manager-checkpoint.php";
  }
}); });</script>
<?php 

}
    //header('Location:courses.php'); 

  }
 ?>
 
        <div class="main-container">
            <div class="container">
               
                <div class="card">
                  <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                   <div class="card-body">
                       <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                       
                       
                        <div class="form-group col-md-12">
            <label class="form-label">Branch</label>
           <select class="form-control" name="FrId" id="FrId" required>

 <option value="" selected disabled>Selefct Branch</option>

 <?php  
    $sql33 = "SELECT * FROM `tbl_users_bill` WHERE Roll=5 AND ShopName!='' AND Status=1";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($row7["FrId"] == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['ShopName']." (".$result['Phone'].")";?></option>
     <?php } ?>
</select>
        </div>
        
                      
                            
                   <div class="form-group col-md-12">
            <label class="form-label">Staff grooming</label>
            <input type="text" name="staff_grooming" id="staff_grooming" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_staff_grooming" value="Staff grooming">
        </div>

        <div class="form-group col-md-12">
            <label class="form-label">Food Quality and test</label>
            <input type="text" name="food_quality_test" id="food_quality_test" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_food_quality_test" value="Food Quality and test">
        </div>

        <div class="form-group col-md-12">
            <label class="form-label">Store stock check</label>
            <input type="text" name="store_stock_check" id="store_stock_check" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_store_stock_check" value="Store stock check">
        </div>

        <div class="form-group col-md-12">
            <label class="form-label">Problem solutions</label>
            <input type="text" name="problem_solutions" id="problem_solutions" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_problem_solutions" value="Problem solutions">
        </div>

        <div class="form-group col-md-12">
            <label class="form-label">Preparation check in freezer</label>
            <input type="text" name="preparation_freezer" id="preparation_freezer" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_preparation_freezer" value="Preparation check in freezer">
        </div>

        <div class="form-group col-md-12">
            <label class="form-label">Equipment and maintenance check</label>
            <input type="text" name="equipment_maintenance_check" id="equipment_maintenance_check" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_equipment_maintenance_check" value="Equipment and maintenance check">
        </div>

        <div class="form-group col-md-12">
            <label class="form-label">Observe outlet running operation</label>
            <input type="text" name="outlet_running_operation" id="outlet_running_operation" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_outlet_running_operation" value="Observe outlet running operation">
        </div>

        <div class="form-group col-md-12">
            <label class="form-label">Unused product transfer to other outlet</label>
            <input type="text" name="unused_product_transfer" id="unused_product_transfer" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_unused_product_transfer" value="Unused product transfer to other outlet">
        </div>

        <div class="form-group col-md-12">
            <label class="form-label">Check sale and purchase report</label>
            <input type="text" name="sale_purchase_report" id="sale_purchase_report" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_sale_purchase_report" value="Check sale and purchase report">
        </div>

        <div class="form-group col-md-12">
            <label class="form-label">Counter display and arrangement check</label>
            <input type="text" name="counter_display_arrangement" id="counter_display_arrangement" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_counter_display_arrangement" value="Counter display and arrangement check">
        </div>     
        
        <div class="form-group col-md-12">
            <label class="form-label">Hygiene/ comments/ issue observation</label>
            <input type="text" name="issue_observation" id="issue_observation" class="form-control" placeholder="" value="">
            <input type="hidden" name="question_issue_observation" value="Hygiene/ comments/ issue observation">
        </div>     
                
                    </div>
                        
                          <input type="hidden" name="CreatedBy" value="<?php echo $_SESSION['User']['id']; ?>" id="CreatedBy">  
                      <input type="hidden" name="action" value="NewReg" id="action">  
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit">Submit</button>
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
    
   
</body>

</html>
