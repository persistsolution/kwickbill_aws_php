<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Add Store Mgr Duty";
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
$operation_flow = addslashes(trim($_POST['operation_flow']));
$operation_flow_question = addslashes(trim($_POST['operation_flow_question']));
$positive_culture = addslashes(trim($_POST['positive_culture']));
$positive_culture_question = addslashes(trim($_POST['positive_culture_question']));
$work_schedule = addslashes(trim($_POST['work_schedule']));
$work_schedule_question = addslashes(trim($_POST['work_schedule_question']));
$hygiene_compliance = addslashes(trim($_POST['hygiene_compliance']));
$hygiene_compliance_question = addslashes(trim($_POST['hygiene_compliance_question']));
$stock_management = addslashes(trim($_POST['stock_management']));
$stock_management_question = addslashes(trim($_POST['stock_management_question']));
$staff_supervision = addslashes(trim($_POST['staff_supervision']));
$staff_supervision_question = addslashes(trim($_POST['staff_supervision_question']));
$employee_training = addslashes(trim($_POST['employee_training']));
$employee_training_question = addslashes(trim($_POST['employee_training_question']));
$customer_feedback = addslashes(trim($_POST['customer_feedback']));
$customer_feedback_question = addslashes(trim($_POST['customer_feedback_question']));
$daily_checklist = addslashes(trim($_POST['daily_checklist']));
$daily_checklist_question = addslashes(trim($_POST['daily_checklist_question']));
$staff_room_cleaning = addslashes(trim($_POST['staff_room_cleaning']));
$staff_room_cleaning_question = addslashes(trim($_POST['staff_room_cleaning_question']));
$staff_grooming = addslashes(trim($_POST['staff_grooming']));
$staff_grooming_question = addslashes(trim($_POST['staff_grooming_question']));
$security_checks = addslashes(trim($_POST['security_checks']));
$security_checks_question = addslashes(trim($_POST['security_checks_question']));
$food_wastage = addslashes(trim($_POST['food_wastage']));
$food_wastage_question = addslashes(trim($_POST['food_wastage_question']));
$electricity_wastage = addslashes(trim($_POST['electricity_wastage']));
$electricity_wastage_question = addslashes(trim($_POST['electricity_wastage_question']));
$cash_deposits = addslashes(trim($_POST['cash_deposits']));
$cash_deposits_question = addslashes(trim($_POST['cash_deposits_question']));
$staff_uniform = addslashes(trim($_POST['staff_uniform']));
$staff_uniform_question = addslashes(trim($_POST['staff_uniform_question']));
$special_board = addslashes(trim($_POST['special_board']));
$special_board_question = addslashes(trim($_POST['special_board_question']));
$staff_attendance = addslashes(trim($_POST['staff_attendance']));
$staff_attendance_question = addslashes(trim($_POST['staff_attendance_question']));

$CreatedDate = date('Y-m-d');

if ($_GET['id'] == '') {
    $sql = "SELECT * FROM tbl_store_manager_duties WHERE userid='$user_id' AND createddate='$CreatedDate'";
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
          window.location.href="view-store-manager-duties.php";
  }
}); });</script>
<?php
    }
    else {
    $qx = "INSERT INTO tbl_store_manager_duties SET 
        operation_flow_question='$operation_flow_question', 
        operation_flow='$operation_flow', 
        positive_culture_question='$positive_culture_question', 
        positive_culture='$positive_culture', 
        work_schedule_question='$work_schedule_question', 
        work_schedule='$work_schedule', 
        hygiene_compliance_question='$hygiene_compliance_question', 
        hygiene_compliance='$hygiene_compliance', 
        stock_management_question='$stock_management_question', 
        stock_management='$stock_management', 
        staff_supervision_question='$staff_supervision_question', 
        staff_supervision='$staff_supervision', 
        employee_training_question='$employee_training_question', 
        employee_training='$employee_training', 
        customer_feedback_question='$customer_feedback_question', 
        customer_feedback='$customer_feedback', 
        daily_checklist_question='$daily_checklist_question', 
        daily_checklist='$daily_checklist', 
        staff_room_cleaning_question='$staff_room_cleaning_question', 
        staff_room_cleaning='$staff_room_cleaning', 
        staff_grooming_question='$staff_grooming_question', 
        staff_grooming='$staff_grooming', 
        security_checks_question='$security_checks_question', 
        security_checks='$security_checks', 
        food_wastage_question='$food_wastage_question', 
        food_wastage='$food_wastage', 
        electricity_wastage_question='$electricity_wastage_question', 
        electricity_wastage='$electricity_wastage', 
        cash_deposits_question='$cash_deposits_question', 
        cash_deposits='$cash_deposits', 
        staff_uniform_question='$staff_uniform_question', 
        staff_uniform='$staff_uniform', 
        special_board_question='$special_board_question', 
        special_board='$special_board', 
        staff_attendance_question='$staff_attendance_question', 
        staff_attendance='$staff_attendance', 
        createddate='$CreatedDate', 
        createdby='$user_id', 
        userid='$user_id';";
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
          window.location.href="view-store-manager-duties.php";
  }
}); });</script>
<?php 
} }
else{
 
    $query2 = "UPDATE tbl_store_manager_duties SET operation_flow_question='$operation_flow_question', 
        operation_flow='$operation_flow', 
        positive_culture_question='$positive_culture_question', 
        positive_culture='$positive_culture', 
        work_schedule_question='$work_schedule_question', 
        work_schedule='$work_schedule', 
        hygiene_compliance_question='$hygiene_compliance_question', 
        hygiene_compliance='$hygiene_compliance', 
        stock_management_question='$stock_management_question', 
        stock_management='$stock_management', 
        staff_supervision_question='$staff_supervision_question', 
        staff_supervision='$staff_supervision', 
        employee_training_question='$employee_training_question', 
        employee_training='$employee_training', 
        customer_feedback_question='$customer_feedback_question', 
        customer_feedback='$customer_feedback', 
        daily_checklist_question='$daily_checklist_question', 
        daily_checklist='$daily_checklist', 
        staff_room_cleaning_question='$staff_room_cleaning_question', 
        staff_room_cleaning='$staff_room_cleaning', 
        staff_grooming_question='$staff_grooming_question', 
        staff_grooming='$staff_grooming', 
        security_checks_question='$security_checks_question', 
        security_checks='$security_checks', 
        food_wastage_question='$food_wastage_question', 
        food_wastage='$food_wastage', 
        electricity_wastage_question='$electricity_wastage_question', 
        electricity_wastage='$electricity_wastage', 
        cash_deposits_question='$cash_deposits_question', 
        cash_deposits='$cash_deposits', 
        staff_uniform_question='$staff_uniform_question', 
        staff_uniform='$staff_uniform', 
        special_board_question='$special_board_question', 
        special_board='$special_board', 
        staff_attendance_question='$staff_attendance_question', 
        staff_attendance='$staff_attendance',modifieddate='$CreatedDate',modifiedby='$user_id' WHERE id = '$id'";
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
          window.location.href="view-store-manager-duties.php";
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
    <label class="form-label">Oversee restaurant operations and ensure a smooth flow / रेस्टॉरंट ऑपरेशन्स आणि सुचारू प्रवाह सुनिश्चित करा</label>
    <textarea name="operation_flow" id="operation_flow" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="operation_flow_question" value="Oversee restaurant operations and ensure a smooth flow / रेस्टॉरंट ऑपरेशन्स आणि सुचारू प्रवाह सुनिश्चित करा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Maintain a positive restaurant culture / सकारात्मक रेस्टॉरंट संस्कृती राखा</label>
    <textarea name="positive_culture" id="positive_culture" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="positive_culture_question" value="Maintain a positive restaurant culture / सकारात्मक रेस्टॉरंट संस्कृती राखा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Create work schedules that align with the outlet need / आउटलेटच्या गरजेनुसार कामाचे वेळापत्रक तयार करा</label>
    <textarea name="work_schedule" id="work_schedule" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="work_schedule_question" value="Create work schedules that align with the outlet need / आउटलेटच्या गरजेनुसार कामाचे वेळापत्रक तयार करा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Ensure proper compliance with outlet hygiene regulation / आउटलेट स्वच्छता नियमांचे योग्य पालन सुनिश्चित करा</label>
    <textarea name="hygiene_compliance" id="hygiene_compliance" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="hygiene_compliance_question" value="Ensure proper compliance with outlet hygiene regulation / आउटलेट स्वच्छता नियमांचे योग्य पालन सुनिश्चित करा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Organize and take stock of outlet supplies / आउटलेट पुरवठ्याचे आयोजन आणि स्टॉक घ्या</label>
    <textarea name="stock_management" id="stock_management" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="stock_management_question" value="Organize and take stock of outlet supplies / आउटलेट पुरवठ्याचे आयोजन आणि स्टॉक घ्या">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Supervise both kitchen staff and floor staff / किचन स्टाफ आणि फ्लोअर स्टाफचे निरीक्षण करा</label>
    <textarea name="staff_supervision" id="staff_supervision" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="staff_supervision_question" value="Supervise both kitchen staff and floor staff / किचन स्टाफ आणि फ्लोअर स्टाफचे निरीक्षण करा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Train new employees to help them to meet the restaurants expectation / नवीन कर्मचारी प्रशिक्षित करा जेणेकरून ते रेस्टॉरंटच्या अपेक्षा पूर्ण करू शकतील</label>
    <textarea name="employee_training" id="employee_training" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="employee_training_question" value="Train new employees to help them to meet the restaurants expectation / नवीन कर्मचारी प्रशिक्षित करा जेणेकरून ते रेस्टॉरंटच्या अपेक्षा पूर्ण करू शकतील">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Interact with dining customers and take feedback to gain repeated customers / जेवणाऱ्या ग्राहकांशी संवाद साधा आणि फीडबॅक घ्या</label>
    <textarea name="customer_feedback" id="customer_feedback" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="customer_feedback_question" value="Interact with dining customers and take feedback to gain repeated customers / जेवणाऱ्या ग्राहकांशी संवाद साधा आणि फीडबॅक घ्या">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Follow daily checklist and update regularly / दैनिक चेकलिस्टचा पाठपुरावा करा आणि नियमितपणे अपडेट करा</label>
    <textarea name="daily_checklist" id="daily_checklist" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="daily_checklist_question" value="Follow daily checklist and update regularly / दैनिक चेकलिस्टचा पाठपुरावा करा आणि नियमितपणे अपडेट करा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Keep staff room area and storing clean on daily basis / कर्मचारी कक्ष क्षेत्र आणि स्टोअरिंग रोज स्वच्छ ठेवा</label>
    <textarea name="staff_room_cleaning" id="staff_room_cleaning" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="staff_room_cleaning_question" value="Keep staff room area and storing clean on daily basis / कर्मचारी कक्ष क्षेत्र आणि स्टोअरिंग रोज स्वच्छ ठेवा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Check daily grooming of staff on daily basis / कर्मचाऱ्यांची दररोज ग्रूमिंग तपासा</label>
    <textarea name="staff_grooming" id="staff_grooming" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="staff_grooming_question" value="Check daily grooming of staff on daily basis / कर्मचाऱ्यांची दररोज ग्रूमिंग तपासा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Daily security checks of employees going home after completion of shift / शिफ्ट पूर्ण झाल्यानंतर घरी जाणाऱ्या कर्मचाऱ्यांची सुरक्षा तपासा</label>
    <textarea name="security_checks" id="security_checks" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="security_checks_question" value="Daily security checks of employees going home after completion of shift / शिफ्ट पूर्ण झाल्यानंतर घरी जाणाऱ्या कर्मचाऱ्यांची सुरक्षा तपासा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Control food wastage to control food cost / अन्नाचा अपव्यय नियंत्रित करा</label>
    <textarea name="food_wastage" id="food_wastage" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="food_wastage_question" value="Control food wastage to control food cost / अन्नाचा अपव्यय नियंत्रित करा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Control electricity wastage / वीजेचा अपव्यय नियंत्रित करा</label>
    <textarea name="electricity_wastage" id="electricity_wastage" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="electricity_wastage_question" value="Control electricity wastage / वीजेचा अपव्यय नियंत्रित करा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Cash deposits need to be done on daily basis and upload deposit slip regularly / दररोज रोख ठेवी करा आणि डिपॉझिट स्लिप नियमितपणे अपलोड करा</label>
    <textarea name="cash_deposits" id="cash_deposits" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="cash_deposits_question" value="Cash deposits need to be done on daily basis and upload deposit slip regularly / दररोज रोख ठेवी करा आणि डिपॉझिट स्लिप नियमितपणे अपलोड करा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Wear dress provided by company and check same with staff on daily basis / कंपनी प्रदान केलेला पोशाख परिधान करा आणि दररोज कर्मचाऱ्यांचे तपासा</label>
    <textarea name="staff_uniform" id="staff_uniform" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="staff_uniform_question" value="Wear dress provided by company and check same with staff on daily basis / कंपनी प्रदान केलेला पोशाख परिधान करा आणि दररोज कर्मचाऱ्यांचे तपासा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Maintain todays special board, update hotspot discounted products on same / आजचा विशेष बोर्ड राखा आणि त्यावर हॉटस्पॉट डिस्काउंटेड उत्पादने अपडेट करा</label>
    <textarea name="special_board" id="special_board" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="special_board_question" value="Maintain todays special board, update hotspot discounted products on same / आजचा विशेष बोर्ड राखा आणि त्यावर हॉटस्पॉट डिस्काउंटेड उत्पादने अपडेट करा">
</div>

<div class="form-group col-md-12">
    <label class="form-label">Maintain 100% attendance of all staff / सर्व कर्मचाऱ्यांची 100% उपस्थिती राखा</label>
    <textarea name="staff_attendance" id="staff_attendance" class="form-control" placeholder=""></textarea>
    <input type="hidden" name="staff_attendance_question" value="Maintain 100% attendance of all staff / सर्व कर्मचाऱ्यांची 100% उपस्थिती राखा">
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
