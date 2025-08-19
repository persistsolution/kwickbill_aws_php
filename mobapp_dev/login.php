<?php require_once 'config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="theme-color" content="#2196f3">
    <meta name="author" content="DexignZone" /> 
    <meta name="keywords" content="" /> 
    <meta name="robots" content="" /> 
    <meta name="description" content="Soziety - Social Network Mobile App Template ( Bootstrap 5 + PWA )"/>
    <meta property="og:title" content="Soziety - Social Network Mobile App Template ( Bootstrap 5 + PWA )" />
    <meta property="og:description" content="Soziety - Social Network Mobile App Template ( Bootstrap 5 + PWA )" />
    <meta property="og:image" content="social-image.png"/>
    <meta name="format-detection" content="telephone=no">
    
    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="login/assets/images/favicon.png" />
    
    <!-- Title -->

    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="login/assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="login/assets/css/style.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="css/toastr.min.css" rel="stylesheet" id="style">

</head>   
<body class="gradiant-bg" style="background-color:#fff;">
<div class="page-wraper" style="background-color:#fff;">
    


    <!-- Welcome Start -->
    <div class="content-body" style="background-color:#fff;">
        <div class="container vh-100">
            <div class="welcome-area">
                <div class="bg-image bg-image-overlay" style="background-image: url(pic22.jpg);height:100vh;"></div>
                <div class="join-area">
                    <div class="started">
                       <!-- <img style="width:100px;" src="logo33.png">-->
                        <h1 class="title">Sign in</h1>
                        <h2 style="text-align:center;color:#000;font-size:14px;">Login With OTP </h2>
                       
                    </div>
                    <form>
                         <div class="alert alert-danger" role="alert" id="danger_message" style="display: none;"></div>
                         <div class="alert alert-success" role="alert" id="success_message" style="display: none;"></div>
                         
                        <div class="mb-3 input-group input-group-icon">
                        <input  type="number" class="form-control  active" placeholder="Phone Number" id="Username" value="">
                        </div>

                        <!--<div class="mb-3 input-group input-group-icon">
                            
                        <input style="color:#000;" type="password" class="form-control  active" id="Password" value="">
                        </div>-->
                        <input type="hidden" id="pageid" value="<?php echo $_GET['page']; ?>">
                        <input type="hidden" id="Roll" value="<?php echo $_GET['roll']; ?>">
                    </form>
                        
                        
                    <button class="btn btn-primary btn-block mb-3" id="login">Get OTP</button>
                   <!-- <h2 style="text-align:center;color:#000;font-size:14px;">OR Login by Password</h2>
                    -->
                     <!--<form>
                        
                        <div class="mb-3 input-group input-group-icon">
                        <input style="color:#000;" type="number" class="form-control  active" id="Username2" placeholder="Phone Number" value="">
                        </div>

                        <div class="mb-3 input-group input-group-icon">
                            
                        <input style="color:#000;" type="password" class="form-control  active" placeholder="Password" id="Password2" value="">
                        </div>
                       
                    </form>
                        
                        
                    <button class="btn btn-primary btn-block mb-3" id="login2">Sign IN</button>-->
                    <?php if($_GET['roll']==55 || $_GET['roll']==9 || $_GET['roll']==3){?>
                   <div class="d-flex align-items-center justify-content-center">
                        <a href="javascript:void(0);" class="text-light text-center d-block">Don’t have an account?</a>
                        <a href="register.php?roll=<?php echo $_GET['roll'];?>" class="btn-link d-block ms-3 text-underline">Signup here</a>
                    </div><?php } ?>
                <br>
            <!--    <div class="d-flex align-items-center justify-content-center" style="float: middle;">
                    
                        <a href="forgot-password.php" class="btn-link d-block ms-3 text-underline">Forgot Password</a>
                        
                        
                    </div>-->
                
                </div>
                
            </div>
        </div>
    </div>
    <!-- Welcome End -->

    
</div>
<!--**********************************
    Scripts
***********************************-->
<script src="login/assets/js/jquery.js"></script>
<script src="login/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="login/assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
<script src="login/assets/js/dz.carousel.js"></script><!-- Swiper -->
<script src="login/assets/js/settings.js"></script>
<script src="login/assets/js/custom.js"></script>
 <script src="js/toastr.min.js"></script>
 <script type="text/javascript">
         $(document).ready(function(){
         $(document).on("click", "#login", function(event){
                 var action = "Login";
                var Username = $('#Username').val();
                 var Password = $('#Password').val();
                 var Roll = $('#Roll').val();
                 var pageid = $('#pageid').val();
                 if(Username.trim() == ''){
                    $('#danger_message').css('display','block').html("Please Enter Mobile No");
                    $('#Username').focus();
                      setTimeout(function(){  
                        $('#danger_message').fadeOut("Slow"); 
                    }, 2000); 
                }
               
                else{
                     $.ajax({  
                url :"ajax_files/ajax_customers.php",  
                method:"POST",  
                data:{action:action,Username:Username,Roll:Roll,Password:Password},
                 beforeSend:function(){
     $('#login').attr('disabled','disabled');
     $('#login').text('Please Wait...');
    },
                success:function(data){ 
                    //alert(data);exit();
                     var res = JSON.parse(data);
                    var Status = res.status;
                    var roll = res.roll;
                    var Username = res.Username;
                    var prime = res.prime
                    var uid = res.uid;
                     if(Status == 0){
                         $('#danger_message').css('display','block').html("Invalid Login Details");
                      setTimeout(function(){  
                        $('#danger_message').fadeOut("Slow"); 
                    }, 2000); 
                     }
                     else{
                       
                           
                        $('#success_message').css('display','block').html("OTP Sent On Your Mobile !");
                      setTimeout(function(){  
                        $('#success_message').fadeOut("Slow");
                       
                    //Android.loginUser(Username,uid,0);
                         //Android.startDriverTracking(Username,uid);
                       
                         window.location.href="login-otp-verify.php?phone="+Username+"&uid="+uid;
                        /*if(roll == 9 || roll == 22 || roll == 23){
                            if(KycStatus == 1){
                                //window.location.href="home.php";
                                 window.location.href="login-otp-verify.php?phone="+Username+"&uid="+uid;
                            }
                            else{
                                window.location.href="kyc-form.php";
                            }
                        }
                        else{
                        //window.location.href="home.php";
                         window.location.href="login-otp-verify.php?phone="+Username+"&uid="+uid;
                    }*/
                      
                    
                    }, 2000); 
                     }
                    $('#login').attr('disabled',false);
                    $('#login').text('Login');
                }
                });
                }

              }); 
              
               
              $(document).on("click", "#login2", function(event){
                 var action = "Login2";
                var Username = $('#Username2').val();
                 var Password = $('#Password2').val();
                 var Roll = $('#Roll').val();
                 var pageid = $('#pageid').val();
                 if(Username.trim() == ''){
                    $('#danger_message').css('display','block').html("Please Enter Mobile No");
                    $('#Username2').focus();
                      setTimeout(function(){  
                        $('#danger_message').fadeOut("Slow"); 
                    }, 2000); 
                }
                
                else if(Password.trim() == ''){
                    $('#danger_message').css('display','block').html("Please Enter Password");
                    $('#Password2').focus();
                      setTimeout(function(){  
                        $('#danger_message').fadeOut("Slow"); 
                    }, 2000); 
                }
               
                else{
                     $.ajax({  
                url :"ajax_files/ajax_customers.php",  
                method:"POST",  
                data:{action:action,Username:Username,Roll:Roll,Password:Password},
                 beforeSend:function(){
     $('#login2').attr('disabled','disabled');
     $('#login2').text('Please Wait...');
    },
                success:function(data){ 
                    //alert(data);exit();
                     var res = JSON.parse(data);
                    var Status = res.status;
                    var roll = res.roll;
                    var Username = res.Username;
                    var prime = res.prime
                    var uid = res.uid;
                     if(Status == 0){
                         $('#danger_message').css('display','block').html("Invalid Login Details");
                      setTimeout(function(){  
                        $('#danger_message').fadeOut("Slow"); 
                    }, 2000); 
                     }
                     else{
                       
                           
                        $('#success_message').css('display','block').html("Login Successfully !");
                      setTimeout(function(){  
                        $('#success_message').fadeOut("Slow");
                       
                    Android.loginUser(Username,uid,0);
                         Android.startDriverTracking(Username,uid);
                       
                        if(roll == 9 || roll == 22 || roll == 23){
                            if(KycStatus == 1){
                                window.location.href="home.php";
                            }
                            else{
                                window.location.href="kyc-form.php";
                            }
                        }
                        else{
                        window.location.href="home.php";
                    }
                      
                    
                    }, 2000); 
                     }
                    $('#login2').attr('disabled',false);
                    $('#login2').text('Login');
                }
                });
                }

              });
         }); 
          </script>
</body>
</html>