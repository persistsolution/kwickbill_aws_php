<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Scholarship";
$Page = "Add-Sch-Ques-Ans";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Question & Answer</title>
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
$sql7 = "SELECT * FROM tbl_survey_questions WHERE id='$id'";
$row7 = getRecord($sql7);

if($_GET['id'] == ''){
   $QueNo = 1; 
}
else{
  $QueNo = $row7['QueNo'];
}

if(isset($_POST['submit'])){
  $CourseId = $_POST['CourseId'];
  $DeptId = $_POST['DeptId'];
  $BatchId = $_POST['BatchId'];
  $ShortQues = addslashes(trim($_POST['ShortQues']));
  $Question = addslashes(trim($_POST['Question']));
  $TestSeriesId = addslashes(trim($_POST['TestSeriesId']));
  $SubjectId = addslashes(trim($_POST['SubjectId']));
  $Option1 = addslashes(trim($_POST['Option1']));
  $Option2 = addslashes(trim($_POST['Option2']));
  $Option3 = addslashes(trim($_POST['Option3']));
  $Option4 = addslashes(trim($_POST['Option4']));

  $OptNo1 = addslashes(trim($_POST['OptNo1']));
  $OptNo2 = addslashes(trim($_POST['OptNo2']));
  $OptNo3 = addslashes(trim($_POST['OptNo3']));
  $OptNo4 = addslashes(trim($_POST['OptNo4']));

  $Answer = addslashes(trim($_POST['Answer']));
  $Marks = addslashes(trim($_POST['Marks']));
  $Type = addslashes(trim($_POST['Type']));
  $Explaination = addslashes(trim($_POST['Explaination']));
  $SurveyDate = addslashes(trim($_POST['SurveyDate']));
  $Status = $_POST['Status'];
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

  // $sql3 = "SELECT QueNo FROM tbl_survey_questions WHERE TestSeriesId='$TestSeriesId'";
  // $rncnt3 = getRow($sql3);
  // $row3 = getRecord($sql3);
  // if($rncnt3 > 0){
  //   $QueNo = $row3['QueNo'] + 1;
  // }
  // else{
  //  $QueNo = 1; 
  // }
  $QueNo = $_POST['QueNo'];

if($_GET['id'] == ''){
  if($rncnt7 >= $TotQues){
  $sql11 = "INSERT INTO tbl_survey_questions SET ShortQues='$ShortQues',QueNo='$QueNo',CourseId='$CourseId',DeptId='$DeptId',BatchId='$BatchId',SubjectId='$SubjectId',TestSeriesId='$TestSeriesId',Question='$Question',OptNo1='$OptNo1',Option1='$Option1',OptNo2='$OptNo2',Option2='$Option2',OptNo3='$OptNo3',Option3='$Option3',OptNo4='$OptNo4',Option4='$Option4',Answer='$Answer',Photo='$Photo',Type='$Type',Explaination='$Explaination',Status='$Status',CreatedBy='$user_id',CreatedDate='$CreatedDate',SurveyDate='$SurveyDate'";
  $conn->query($sql11);
  echo "<script>alert('Survey Question Added Successfully!');window.location.href='view-survey.php';</script>";
  }
  else{
   echo "<script>alert('You Cant add question more');window.location.href='add-question-answer.php';</script>"; 
  }
}
else{
$sql11 = "UPDATE tbl_survey_questions SET ShortQues='$ShortQues',QueNo='$QueNo',CourseId='$CourseId',DeptId='$DeptId',BatchId='$BatchId',SubjectId='$SubjectId',TestSeriesId='$TestSeriesId',Question='$Question',OptNo1='$OptNo1',Option1='$Option1',OptNo2='$OptNo2',Option2='$Option2',OptNo3='$OptNo3',Option3='$Option3',OptNo4='$OptNo4',Option4='$Option4',Answer='$Answer',Photo='$Photo',Type='$Type',Explaination='$Explaination',ModifiedBy='$user_id',ModifiedDate='$CreatedDate',SurveyDate='$SurveyDate' WHERE id='$id'";
  $conn->query($sql11);
  echo "<script>alert('Survey  Question Updated Successfully!');window.location.href='view-survey.php';</script>";
}
}
?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Survey Question</h4>
<!-- <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
<li class="breadcrumb-item">Question & Answer</li>
<li class="breadcrumb-item active"><?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Question & Answer</li>
</ol>
</div> -->
<div class="card mb-4">
<div class="card-body">
<div id="alert_message"></div>
<form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data" >
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
  <input type="hidden" name="action" value="Save" id="action">
<div class="form-row">



<div class="form-group col-md-12">
  <label class="form-label">Survey Date</label>
  <input type="date" name="SurveyDate" class="form-control" placeholder="" value="<?php echo $row7["SurveyDate"]; ?>">
<div class="clearfix"></div>
</div>


<div class="form-group col-md-12">
<label class="form-label"> Question Type <span class="text-danger">*</span></label>
  <select class="form-control" id="Type" name="Type" required="" onchange="getOptions(this.value)">
<option selected="" disabled="" value="">Select Course Type</option>
<option value="Text" <?php if($row7["Type"]=='Text') {?> selected <?php } ?>>Text</option>
<option value="Image" <?php if($row7["Type"]=='Image') {?> selected <?php } ?>>Image</option>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-12 imgtype" <?php if($row7["Type"]=='Image'){?> style="display: block;" <?php } else{?> style="display:none;" <?php } ?>>
  <label class="form-label"> Photo </label>
<label class="custom-file">
<input type="file" class="custom-file-input" name="Photo" style="opacity: 1;">
<input type="hidden" name="OldPhoto" value="<?php echo $row7['Photo'];?>" id="OldPhoto">
<span class="custom-file-label"></span>
</label>
<?php if($row7['Photo']=='') {} else{?>
  <span id="show_photo">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo"></a><img src="../uploads/<?php echo $row7['Photo'];?>" alt="" class="img-fluid ticket-file-img" style="width: 64px;height: 64px;"></div>
</span>
<?php } ?>
</div>



<div class="form-group col-md-12 txttype" <?php if($row7["Type"]=='Text'){?> style="display: block;" <?php } else{?> style="display:none;" <?php } ?>>
<label class="form-label">Question <span class="text-danger">*</span></label>
<textarea name="Question" id="editor1" class="form-control" placeholder="Question" autocomplete="off"><?php echo $row7["Question"]; ?></textarea>
</div>


<div class="form-group col-md-12 txttype" <?php if($row7["Type"]=='Text'){?> style="display: block;" <?php } else{?> style="display:none;" <?php } ?>>
<label class="form-label">Option - 1 <span class="text-danger">*</span></label>
<div class="input-group">
<div class="input-group-prepend">
 <select class="form-control" id="OptNo1" name="OptNo1" required="">
<option value="1" <?php if($row7["OptNo1"]=='1') {?> selected <?php } ?>>1</option>
<option value="A" <?php if($row7["OptNo1"]=='A') {?> selected <?php } ?>>A</option>
<option value="अ" <?php if($row7["OptNo1"]=='अ') {?> selected <?php } ?>>अ</option>
</select>
</div>
<input type="text" name="Option1" id="Option1" class="form-control txttypereq" placeholder="Option - 1" value="<?php echo $row7["Option1"]; ?>">
<div class="clearfix"></div>
</div>
</div>

<div class="form-group col-md-12 txttype" <?php if($row7["Type"]=='Text'){?> style="display: block;" <?php } else{?> style="display:none;" <?php } ?>>
<label class="form-label">Option - 2 <span class="text-danger">*</span></label>
<div class="input-group">
<div class="input-group-prepend">
 <select class="form-control" id="OptNo2" name="OptNo2" required="">
<option value="2" <?php if($row7["OptNo2"]=='2') {?> selected <?php } ?>>2</option>
<option value="B" <?php if($row7["OptNo2"]=='B') {?> selected <?php } ?>>B</option>
<option value="ब" <?php if($row7["OptNo2"]=='ब') {?> selected <?php } ?>>ब</option>
</select>
</div>
<input type="text" name="Option2" id="Option2" class="form-control txttypereq" placeholder="Option - 2" value="<?php echo $row7["Option2"]; ?>">
<div class="clearfix"></div>
</div>
</div>

<div class="form-group col-md-12 txttype" <?php if($row7["Type"]=='Text'){?> style="display: block;" <?php } else{?> style="display:none;" <?php } ?>>
<label class="form-label">Option - 3 <span class="text-danger">*</span></label>
<div class="input-group">
<div class="input-group-prepend">
 <select class="form-control" id="OptNo3" name="OptNo3" required="">
<option value="3" <?php if($row7["OptNo3"]=='3') {?> selected <?php } ?>>3</option>
<option value="C" <?php if($row7["OptNo3"]=='C') {?> selected <?php } ?>>C</option>
<option value="क" <?php if($row7["OptNo3"]=='क') {?> selected <?php } ?>>क</option>
</select>
</div>
<input type="text" name="Option3" id="Option3" class="form-control txttypereq" placeholder="Option - 3" value="<?php echo $row7["Option3"]; ?>">
<div class="clearfix"></div>
</div>
</div>

<div class="form-group col-md-12 txttype" <?php if($row7["Type"]=='Text'){?> style="display: block;" <?php } else{?> style="display:none;" <?php } ?>>
<label class="form-label">Option - 4 <span class="text-danger">*</span></label>
<div class="input-group">
<div class="input-group-prepend">
 <select class="form-control" id="OptNo4" name="OptNo4" required="">
<option value="4" <?php if($row7["OptNo4"]=='4') {?> selected <?php } ?>>4</option>
<option value="D" <?php if($row7["OptNo4"]=='D') {?> selected <?php } ?>>D</option>
<option value="ड" <?php if($row7["OptNo4"]=='ड') {?> selected <?php } ?>>ड</option>
</select>
</div>
<input type="text" name="Option4" id="Option4" class="form-control txttypereq" placeholder="Option - 4" value="<?php echo $row7["Option4"]; ?>">
<div class="clearfix"></div>
</div>
</div>

<!-- <div class="form-group col-md-12">
<label class="form-label">Correct Answer <span class="text-danger">*</span></label>
<select class="form-control" name="Answer" required>
  <option value="" selected disabled>Select Correct Answer</option>
 
  <option value="1" <?php if($row7["Answer"] == 1) {?> selected <?php } ?>><?php echo "1 - A - अ"; ?></option>
  <option value="2" <?php if($row7["Answer"] == 2) {?> selected <?php } ?>><?php echo "2 - B - ब"; ?></option>
  <option value="3" <?php if($row7["Answer"] == 3) {?> selected <?php } ?>><?php echo "3 - C - क"; ?></option>
  <option value="4" <?php if($row7["Answer"] == 4) {?> selected <?php } ?>><?php echo "4 - D - ड"; ?></option>

</select>
<div class="clearfix"></div>
</div> -->


<div class="form-group col-lg-12">
<label class="form-label">Sr No <span class="text-danger">*</span></label>
<input type="number" name="QueNo" class="form-control" id="QueNo" value="<?php echo $QueNo; ?>" required min="1">
<div class="clearfix"></div>
</div>

<div class="form-group col-md-12">
<label class="form-label">Status <span class="text-danger">*</span></label>
  <select class="form-control" id="Status" name="Status" required="">
<option selected="" disabled="" value="">Select Status</option>
<option value="1" <?php if($row7["Status"]=='1') {?> selected <?php } ?>>Active</option>
<option value="0" <?php if($row7["Status"]=='0') {?> selected <?php } ?>>Inctive</option>
</select>
<div class="clearfix"></div>
</div>


</div>
<!-- <button id="growl-default" class="btn btn-default">Default</button> -->
<button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Save</button>
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
  CKEDITOR.replace( 'editor1');
  function getOptions(val){
    if(val == 'Text'){
      $('.imgtype').hide();
      $('.txttype').show();
    }
    else{
      $('.imgtype').show();
      $('.txttype').hide();
    }
  }
  
    function getSubject(deptid){
    var action = "getTsSubject";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,id:deptid},
    success:function(data)
    {
      $('#SubjectId').html(data);
    }
    });
  }
  function error_toast(){
    var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
   $.growl.error({
      title:    'Error',
      message:  'Email Id / Phone No Already Exists',
      location: isRtl ? 'tl' : 'tr'
    });
  }
    function success_toast(){
    var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
   $.growl.success({
      title:    'Success',
      message:  'Saved Successfully...',
      location: isRtl ? 'tl' : 'tr'
    });
  }
   $(document).ready(function(){
 

/*  $(document).on("change", "#DeptId", function(event){
  var val = this.value;
   var action = "getBatch";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,id:val},
    success:function(data)
    {
      $('#BatchId').html(data);
    }
    });

 });*/
 
 $(document).on("change", "#TestSeriesId", function(event){
var val = this.value;
   var action = "getSubjectRoll";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,id:val},
    success:function(data)
    {
        if(data == 1){
          $('.subroll').show();  
          $('#SubjectId').attr('required',true);
          $('#SubjectId').attr('selected','selected').val('');
        }
        else{
           $('.subroll').hide(); 
           $('#SubjectId').attr('required',false);
           $('#SubjectId').attr('selected','selected').val('');
        }
      
    }
    });

 });
   $(document).on("change", "#DeptId", function(event){
  var val = this.value;
  getSubject(val);
   var action = "getTestSeries";
    $.ajax({
    url:"ajax_files/ajax_dropdown.php",
    method:"POST",
    data : {action:action,id:val},
    success:function(data)
    {
      $('#TestSeriesId').html(data);
    }
    });

 });


   $(document).on("click", "#delete_photo", function(event){
event.preventDefault();  
if(confirm("Are you sure you want to delete Course Photo?"))  
           {  
             var action = "deletePhoto";
             var id = $('#userid').val();
             var Photo = $('#OldPhoto').val();
             $.ajax({
    url:"ajax_files/ajax_sch_ques_ans.php",
    method:"POST",
    data : {action:action,id:id,Photo:Photo},
    success:function(data)
    {

      $('#show_photo').hide();
      var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
   $.growl.success({
      title:    'Success',
      message:  data,
      location: isRtl ? 'tl' : 'tr'
    });

    }
    });
           }

   });

         
});
</script>
</body>
</html>
