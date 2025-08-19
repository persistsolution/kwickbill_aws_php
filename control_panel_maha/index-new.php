<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>
</head>
<style>
/* For Chrome, Safari, Edge, Opera */
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* For Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
</style>
<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->
    <!-- [ content ] Start -->
    <div class="authentication-wrapper authentication-3">
        <div class="authentication-inner">

            <!-- [ Side container ] Start -->
            <!-- Do not display the container on extra small, small and medium screens -->
            <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover x p-5" style="background-image:url(back.jpg);">
                <div class="ui-bg-overlay bg-dark opacity-50"></div>
                <!-- [ Text ] Start -->
                <div class="w-100 text-white px-5">
                    <div class="w-100 text-white px-5">
                   
                    
                </div>
                        
                </div>
                <!-- [ Text ] End -->
            </div>
            <!-- [ Side container ] End -->

            <!-- [ Form container ] Start -->
            <div class="d-flex col-lg-4 align-items-center bg-white p-5">
                <!-- Inner container -->
                <!-- Have to add `.d-flex` to control width via `.col-*` classes -->
                <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">
                    <div class="w-100">

                        <!-- [ Logo ] Start -->
                        <div class=" justify-content-center align-items-center">
                            <div>
                                <div class=" position-relative" align="center">
                                    <img src="logo5.png" alt="Brand Logo" width="150px" >
                                    
                                </div>
                            </div>
                        </div>
                        <!-- [ Logo ] End -->

                        <h4 class="text-center  font-weight-normal mt-3 mb-0">
                           Sign in to your account</h4><br>

                        <!-- [ Form ] Start -->
                        <form id="validation-form" method="post">
<div class="form-group">
<label class="form-label">Username</label>
<input type="number" name="Username" class="form-control" required="">
<div class="clearfix"></div>
</div>
<div class="form-group" style="padding-top:10px;">
<label class="form-label d-flex justify-content-between align-items-end">
<span>Password</span>
</label>
<input type="password" name="Password" class="form-control" required="">
<div class="clearfix"></div>
</div>
 <input type="hidden" name="action" class="form-control" value="Login">
<div class="d-flex justify-content-between align-items-center m-0" align="center" style="padding-top:10px;" align="center">
<button type="submit" id="submit" class="btn btn-primary">OTP Verify</button>

<!-- <a href="sign-up.php" class="btn btn-success">Sign Up</a> -->
</div>
</form>
                        <!-- [ Form ] End -->

                       <!--  <div class="text-center text-muted">
                            Don't have an account yet?
                            <a href="pages_authentication_register-v3.html">Sign Up</a>
                        </div> -->

                    </div>
                </div>
            </div>
            <!-- [ Form container ] End -->

        </div>
    </div>
    <!-- [ content ] End -->

   <?php include_once 'footer_script.php'; ?>

<script type="text/javascript">
function error_toast(){
    var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
   $.growl.error({
      title:    'Error',
      message:  'Invalid Username',
      location: isRtl ? 'tl' : 'tr'
    });
  }
  
  function error_toast2(){
    var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
   $.growl.error({
      title:    'Error',
      message:  'Invalid Password',
      location: isRtl ? 'tl' : 'tr'
    });
  }
    function success_toast(){
    var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
   $.growl.success({
      title:    'Success',
      message:  'OTP Sent on your mobile...',
      location: isRtl ? 'tl' : 'tr'
    });
  }
     $(document).ready(function(){
            $('#validation-form').on('submit', function(e){
            e.preventDefault();    
    if ($('#validation-form').valid()){ 
           $.ajax({  
                url :"ajax_files/ajax_login.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                 beforeSend:function(){
     $('#submit').attr('disabled','disabled');
     $('#submit').text('Please Wait...');
    },
                success:function(data){ 
                  //alert(data);
                  console.log(data);
                  res = JSON.parse(data);
                  Status = res.Status;
                  Roll = res.Roll;
                  var Uid = res.Uid;
                  var Phone = res.Phone;
                     if(Status == 1){
                         success_toast();
                     setTimeout(function(){  
                   
                 window.location.href = 'login-otp-verify.php?phone='+Phone+'&Uid='+Uid; 
                 
                    }, 2000);
                     
                     }
                     else if(Status == 0){
                         error_toast();
                     }
                     else{
                    error_toast2();
                  
                     }
                      $('#submit').attr('disabled',false);
                    $('#submit').text('Sign In');
                }  
           })  



    }
else{
  //$('#Fname').focus();
    return false;
}
  });






       });
</script>

</body>

</html>
