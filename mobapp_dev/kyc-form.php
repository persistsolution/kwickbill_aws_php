<?php session_start();
require_once 'config.php';
$PageName = "New Registration";
$uid = $_SESSION['User']['id'];
$sql11 = "SELECT * FROM tbl_users WHERE id='$uid'";
$row7 = getRecord($sql11);
?>
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
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php //include_once 'back-header.php'; ?> 
   
<style type="text/css">
        .imgcenter {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
    </style>     
        <div class="main-container">

            <div class="container">
                <img src="logo33.png" class="imgcenter"><br>
                <div class="alert alert-success" style="font-size: 15px;" align="center">
                         KYC Verification</div>
                <div class="card">
                  <form id="validation-form" method="post" autocomplete="off">
                   
                    <div class="card-body">

                  <div class="form-group float-label active">
                            <input type="text" name="Name" id="Name" class="form-control"
                                                placeholder="" value="<?php echo $row7["Fname"]; ?>" readonly>
                            <label class="form-control-label">Full Name</label>                            
                        </div>
                        
              

                        <div class="form-group float-label active">
                          <input type="text" name="Address" id="Address" class="form-control"
                                                placeholder="" value="<?php echo $row7["Address"]; ?>" readonly>
                            <label class="form-control-label active">Address</label>
                        </div>

                        <div class="form-group float-label active">
                          <input type="text" name="Phone" id="Phone" class="form-control"
                                                placeholder="" value="<?php echo $row7["Phone"]; ?>" readonly>
                            <label class="form-control-label active">Mobile Number</label>
                        </div>

                        

                        <div class="form-group float-label active">
                          <input type="text" name="Profession" id="Profession" class="form-control"
                                                placeholder="" value="<?php echo $row7["Profession"]; ?>">
                            <label class="form-control-label active">Current Profession</label>
                        </div>

                        <div class="form-group float-label active">
                          <input type="text" name="PanNo" id="PanNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["PanNo"]; ?>">
                            <label class="form-control-label active">Pan Card Number</label>
                        </div>

                         <div class="form-group float-label active">
                          <input type="text" name="AadharNo" id="AadharNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["AadharNo"]; ?>">
                            <label class="form-control-label active">Aadhar Card Number</label>
                        </div>

                        <div class="form-group float-label active">
                          <input type="text" name="FsiicNo" id="FsiicNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["FsiicNo"]; ?>">
                            <label class="form-control-label active">FSIIC Number</label>
                        </div>

                        <div class="form-group float-label active">
                          <input type="text" name="ShopActNo" id="ShopActNo" class="form-control"
                                                placeholder="" value="<?php echo $row7["ShopActNo"]; ?>">
                            <label class="form-control-label active">Shop Act Number</label>
                        </div>

                         <div class="form-group float-label active">
                            <input type="date" name="Dob" id="Dob" class="form-control"
                                                placeholder="" value="<?php echo $row7["Dob"]; ?>">
                            <label class="form-control-label">Date Of Birth</label>                            
                        </div>

                         <div class="form-group float-label active">
                            <input type="date" name="AnniversaryDate" id="AnniversaryDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["AnniversaryDate"]; ?>">
                            <label class="form-control-label">Date Of Anniversary</label>                            
                        </div>

                    </div>
     
                       <input type="hidden" name="ExeId" value="<?php echo $_SESSION['User']['id']; ?>" id="ExeId">  

                      <input type="hidden" name="action" value="SaveKyc" id="action">  
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" id="submit">Pay 1000/-</button>
                    </div>
                </form>
                </div>
            </div>
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
      var userid = $('#ExeId').val();
      var phone = $('#Phone').val();
        $.ajax({  
                url :"ajax_files/ajax_customers.php",  
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
                        toastr.error('KYC Form Not Submitted ', 'Error', {timeOut: 5000}); 
                     
                     }
                     else{
                      var amount = 1000;
                      var oid = 0;
                      var flag = 3;
                      Android.startPay(''+amount+'',''+userid+'',''+phone+'',''+oid+'',''+flag+'');
                    //toastr.success('KYC Form Submitted Successfully!', 'Success', {timeOut: 2000}); 
                    //window.location.href="view-kyc.php";
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
