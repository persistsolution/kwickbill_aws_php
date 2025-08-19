<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Video Tutorials";
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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
 
</head>
<style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: #f4f7fa;
      color: #333;
    }

    header {
      background: linear-gradient(135deg, #2c3e50, #34495e);
      padding: 40px 20px;
      color: white;
      text-align: center;
    }

    header h1 {
      font-size: 32px;
      margin: 0 0 10px;
    }

    header p {
      font-size: 16px;
      opacity: 0.9;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 40px 20px;
    }

    .video-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
    }

    .video-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
      overflow: hidden;
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .video-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    }

    .video-card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
    }

    .video-title {
      padding: 16px;
  font-weight: 600;
  font-size: 14px;
  color: #2c3e50;
  text-align: center;
    }

    /* Modal Styling */
    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.85);
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      position: relative;
      background: #000;
      border-radius: 10px;
      overflow: hidden;
      width: 90%;
      max-width: 800px;
    }

    .modal-content iframe {
      width: 100%;
      height: 450px;
    }

    .close {
      position: absolute;
      top: -40px;
      right: 0;
      font-size: 36px;
      color: #fff;
      cursor: pointer;
    }

    @media (max-width: 600px) {
      .modal-content iframe {
        height: 600px;
      }
    }
  </style>
<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 
        
   


        <div class="main-container">
            <div class="container">
               
                <div class="card">
                  <header>
  <h1>Maha Buddy Tutorial Videos</h1>
  <p>Learn how to use the app with these simple step-by-step guides</p>
</header>

<div class="container">
  <div class="video-grid">
      <div class="video-card" onclick="openVideo('T652mVDCtHc')">
      <img src="images/leave_management.jpeg" alt="Video Thumbnail">
      <div class="video-title">Leave Management</div>
    </div>
    
      <div class="video-card" onclick="openVideo('wDe7WoaAOa4')">
      <img src="images/task_management.jpeg" alt="Video Thumbnail">
      <div class="video-title">Task Management</div>
    </div>
    
    <div class="video-card" onclick="openVideo('Guuy2vla3Zo')">
      <img src="images/task_assign.jpeg" alt="Video Thumbnail">
      <div class="video-title">Task Assign or Create</div>
    </div>
    
    <div class="video-card" onclick="openVideo('-2jWyGDA4Lc')">
      <img src="images/advance_1.jpeg" alt="Video Thumbnail">
      <div class="video-title">How to apply for Advance Request</div>
    </div>
    <div class="video-card" onclick="openVideo('UitS4yeElJU')">
      <img src="images/attendance_request.jpg" alt="Video Thumbnail">
      <div class="video-title">How to add Attendance Request</div>
    </div>
    <div class="video-card" onclick="openVideo('UitS4yeElJU')">
      <img src="images/resignations_request.jpg" alt="Video Thumbnail">
      <div class="video-title">How to Apply for Resignation</div>
    </div>
    <div class="video-card" onclick="openVideo('UitS4yeElJU')">
      <img src="images/attendance_request.jpg" alt="Video Thumbnail">
      <div class="video-title">How to Add Multiple Expenses</div>
    </div>
    <!--<div class="video-card" onclick="openVideo('UitS4yeElJU')">-->
    <!--  <img src="https://img.youtube.com/vi/mno654/hqdefault.jpg" alt="Video Thumbnail">-->
    <!--  <div class="video-title">App Dashboard Overview</div>-->
    <!--</div>-->
  </div>
</div>

<!-- Video Modal -->
<div id="videoModal" class="modal" onclick="closeVideo()">
  <div class="modal-content" onclick="event.stopPropagation()">
    <span class="close" onclick="closeVideo()">&times;</span>
    <iframe id="videoFrame" src="" allowfullscreen></iframe>
  </div>
</div>

<script>
  function openVideo(videoId) {
    document.getElementById('videoFrame').src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    document.getElementById('videoModal').style.display = 'flex';
  }

  function closeVideo() {
    document.getElementById('videoFrame').src = '';
    document.getElementById('videoModal').style.display = 'none';
  }
</script>
                </div>
            </div>
        </div>
    </main>

    
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
    <script>
    function daysBetween(date1, date2) {
    const oneDay = 1000 * 60 * 60 * 24;
    const diffDays = Math.floor((new Date(date2) - new Date(date1)) / oneDay) + 1;
    $('#TotDays').val(diffDays);
}

   
      $(document).ready(function() {
     $('#validation-form').on('submit', function(e){
      e.preventDefault();    
     
     $.ajax({  
                url :"ajax_files/ajax_leave_request.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                 beforeSend:function(){
     $('#submit').attr('disabled','disabled');
     $('#submit').text('Please Wait...');
    },
                success:function(data){ 
                    //alert(data);exit();
                // console.log(data);exit();
                     
                    if(data == 1){
                    setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Your leave request successfully submitted.",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-leave-request.php";
  }
}); });
                        
                     }
                    
                    
                     
                      $('#submit').attr('disabled',false);
                    $('#submit').text('Update');
                }  
           })
     });

            
        });
    </script>
   
</body>

</html>
