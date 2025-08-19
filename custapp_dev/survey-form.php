<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Today Survey";
$UserId = $_SESSION['User']['id'];
$sql11 = "SELECT * FROM tbl_users WHERE id='$UserId'";
$row11 = getRecord($sql11);
$Name = $row11['Fname']." ".$row11['Lname'];
$Phone = $row11['Phone'];
$EmailId = $row11['EmailId']; ?>
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

<style>
    .custom-control {
  line-height: 24px;
  padding-top: 5px;
}
</style>
<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 
        
<?php 
$CreatedDate = date('Y-m-d');
$sql_22 = "SELECT * FROM tbl_survey WHERE CustId='$user_id' AND CreatedDate='$CreatedDate'";
$rncnt = getRow($sql_22);
if($rncnt > 0){
?>
        <!--<script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Today Survey",
  text: " Report Already Given.",
  type: "error",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="home.php";
  }
}); });</script>-->
<?php } ?>
        <div class="main-container">
            <div class="container">
               
<form id="validation-form" method="post" autocomplete="off">
               <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">1. Shop Opening Time</h6>
                    </div>
                    <input type="hidden" name="Question1" value="Shop Opening Time">
                    <div class="card-body">
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer1" value="5 Am" class="custom-control-input" id="Option1">
                            <label class="custom-control-label" for="Option1">5 Am</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer1" value="6 Am" class="custom-control-input" id="Option2">
                            <label class="custom-control-label" for="Option2">6 Am</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer1" value="7 Am" class="custom-control-input" id="Option3">
                            <label class="custom-control-label" for="Option3">7 Am</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer1" value="After 8 Am" class="custom-control-input" id="Option4">
                            <label class="custom-control-label" for="Option4">After 8 Am</label>
                        </div>
                    </div>
                </div>

               <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">2. Stock Check</h6>
                    </div>
                    <input type="hidden" name="Question2" value="Stock Check">
                    <div class="card-body">
                        <!--  <input type="text" name="Answer2" class="form-control"> -->
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="Answer2[]" value="Misal /vadapav premix"  class="custom-control-input" id="Option21">
                            <label class="custom-control-label" for="Option21">Misal /vadapav premix</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="Answer2[]" value="Pavbhaji /shabudana vada premix"  class="custom-control-input" id="Option22">
                            <label class="custom-control-label" for="Option22">Pavbhaji /shabudana vada premix</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="Answer2[]" value="Milk & bakery item"  class="custom-control-input" id="Option23">
                            <label class="custom-control-label" for="Option23">Milk & bakery item </label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="Answer2[]" value="Tea packets & sugar"  class="custom-control-input" id="Option24">
                            <label class="custom-control-label" for="Option24">Tea packets & sugar</label>
                        </div>
                         <div class="custom-control custom-switch">
                            <input type="checkbox" name="Answer2[]" value="Gas & oil"  class="custom-control-input" id="Option25">
                            <label class="custom-control-label" for="Option25">Gas & oil</label>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">3. Cctv / Billing Machine </h6>
                    </div>
                    <input type="hidden" name="Question3" value="Cctv / Billing Machine">
                    <div class="card-body">
                        <!-- <input type="text" name="Answer3" class="form-control"> -->
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer3" value="ON"  class="custom-control-input" id="Option31">
                            <label class="custom-control-label" for="Option31">ON</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer3" value="OFF"  class="custom-control-input" id="Option32">
                            <label class="custom-control-label" for="Option32">OFF</label>
                        </div>
                       
                    </div>
                </div>


                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">4. TV / Sound System</h6>
                    </div>
                      <input type="hidden" name="Question4" value="TV / Sound System">
                    <div class="card-body">
                       <!--  <input type="text" name="Answer4" class="form-control"> -->
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer4" value="ON"  class="custom-control-input" id="Option41">
                            <label class="custom-control-label" for="Option41">ON</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer4" value="OFF"  class="custom-control-input" id="Option42">
                            <label class="custom-control-label" for="Option42">OFF</label>
                        </div>
                       
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">5. 100% staff on dress code</h6>
                    </div>
                    <input type="hidden" name="Question5" value="100% staff on dress code">
                   <div class="card-body">
                       <!--  <input type="text" name="Answer4" class="form-control"> -->
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer5" value="ON"  class="custom-control-input" id="Option51">
                            <label class="custom-control-label" for="Option51">ON</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer5" value="OFF"  class="custom-control-input" id="Option52">
                            <label class="custom-control-label" for="Option52">OFF</label>
                        </div>
                       
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">6. Chai pass sell for the day</h6>
                    </div>
                    <input type="hidden" name="Question6" value="Chai pass sell for the day">
                    <div class="card-body">
                        <!--  <input type="text" name="Answer6" class="form-control"> -->
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer6" value="2" class="custom-control-input" id="Option61">
                            <label class="custom-control-label" for="Option61">2</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer6" value="5" class="custom-control-input" id="Option62">
                            <label class="custom-control-label" for="Option62">5</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer6" value="10" class="custom-control-input" id="Option63">
                            <label class="custom-control-label" for="Option63">10</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer6" value="Zero" class="custom-control-input" id="Option64">
                            <label class="custom-control-label" for="Option64">Zero</label>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">7. Google rating for the day</h6>
                    </div>
                     <input type="hidden" name="Question7" value="Google rating for the day">
                    <div class="card-body">
                        <!--  <input type="text" name="Answer6" class="form-control"> -->
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer7" value="2" class="custom-control-input" id="Option71">
                            <label class="custom-control-label" for="Option71">2</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer7" value="5" class="custom-control-input" id="Option72">
                            <label class="custom-control-label" for="Option72">5</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer7" value="10" class="custom-control-input" id="Option73">
                            <label class="custom-control-label" for="Option73">10</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer7" value="Zero" class="custom-control-input" id="Option74">
                            <label class="custom-control-label" for="Option74">Zero</label>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">8. We are taking care of Client</h6>
                    </div>
                    <input type="hidden" name="Question8" value="We are taking care of Client">
                   <div class="card-body">
                       <!--  <input type="text" name="Answer4" class="form-control"> -->
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer8" value="ON"  class="custom-control-input" id="Option81">
                            <label class="custom-control-label" for="Option81">ON</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer8" value="OFF"  class="custom-control-input" id="Option82">
                            <label class="custom-control-label" for="Option82">OFF</label>
                        </div>
                       
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">9. Our food presentation is good.</h6>
                    </div>
                    <input type="hidden" name="Question9" value="Our food presentation is good.">
                   <div class="card-body">
                       <!--  <input type="text" name="Answer4" class="form-control"> -->
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer9" value="ON"  class="custom-control-input" id="Option91">
                            <label class="custom-control-label" for="Option91">ON</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer9" value="OFF"  class="custom-control-input" id="Option92">
                            <label class="custom-control-label" for="Option92">OFF</label>
                        </div>
                       
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="mb-0" style="color:#e74623;">10. We are using compny premix only .</h6>
                    </div>
                    <input type="hidden" name="Question10" value="We are using compny premix only .">
                   <div class="card-body">
                       <!--  <input type="text" name="Answer4" class="form-control"> -->
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer10" value="ON"  class="custom-control-input" id="Option101">
                            <label class="custom-control-label" for="Option101">ON</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="radio" name="Answer10" value="OFF"  class="custom-control-input" id="Option102">
                            <label class="custom-control-label" for="Option102">OFF</label>
                        </div>
                       
                    </div>
                </div>

                <div class="card">
                     
                
                   
                    <div class="card-body">
                      
                         
                        
                <input type="hidden" name="id" value="<?php echo $_SESSION['User']['id']; ?>" id="UserId">  
                      <input type="hidden" name="action" value="Save" id="action">  
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" id="submit">Submit</button>
                    </div>
               
                </div>
            </div>
             </form>
        </div>
    </main>

    <!-- footer-->
    


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
    
     <script type="text/javascript">
    $(document).ready(function() {
             $('#validation-form').on('submit', function(e){
      e.preventDefault();    
        $.ajax({  
                url :"ajax_files/ajax_survey.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                 beforeSend:function(){
     $('#submit').attr('disabled','disabled');
     $('#submit').text('Please Wait...');
    },
                success:function(data){ 

               
                if(data == 0){
                        toastr.error('Today Survey Report Already Given ', 'Error', {timeOut: 5000}); 
                     
                     }
                     else{
                    toastr.success('Today Survey Report Sent Successfully!', 'Success', {timeOut: 2000}); 
                    window.location.href="survey-thank-you.php";
                     }
                      $('#submit').attr('disabled',false);
                    $('#submit').text('Update');
                }  
           });
        });

  });
</script>
</body>

</html>
