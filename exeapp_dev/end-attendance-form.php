<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "End Attendance";
$UserId = $_SESSION['User']['id'];
$sql11 = "SELECT * FROM tbl_users WHERE id='$UserId'";
$row11 = getRecord($sql11);
$Name = $row11['Fname']." ".$row11['Lname'];
$Phone = $row11['Phone'];
$EmailId = $row11['EmailId']; 
$Latitude = $row11['Lattitude']; 
$Longitude = $row11['Longitude']; 

$sql22 = "SELECT Lattitude,Longitude FROM tbl_users WHERE id='".$row11['UnderFrId']."'";
$row22 = getRecord($sql22);
$FrLattitude = $row22['Lattitude'];
$FrLongitude = $row22['Longitude']; ?>
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
        <?php include_once 'back-header.php'; ?> 
        
     
 <?php 
 function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

$tot_dist = round(distance($Latitude, $Longitude, $FrLattitude, $FrLongitude, "K"),1);

$date = date('Y-m-d');
?>

        <div class="main-container">
            <div class="container">
               
                <div class="card" style="padding:5px;">
                    <form id="validation-form2" method="post" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="date" id="CreatedDate" value="<?php echo date('Y-m-d');?>">
         <input type="hidden" id="TempPrdId2" name="TempPrdId2" value="<?php echo rand(10000,99999);?>">
      <!-- <div class="form-group float-label active">
                           
                           
                           <main>
    <div class="slim" data-service="example/async.php?Roll=2" data-did-remove="handleImageRemoval">
        
        <input type="file" name="slim[]" id="Photo" name="car3_logo" class="input_css"/>
      
    </div>
</main>

                            <label class="form-control-label">Upload Selfi</label>                            
                        </div>-->
                        
                        <div class="row">
                                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group float-label active">
                            <input type="file" class="form-control" name="Photo2">
                            <label class="form-control-label">Upload Selfi</label>
                        </div>
                    </div>
                                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <div class="form-group float-label active">
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" readonly>
                            <label class="form-control-label">Date</label>
                        </div>
                    </div>
                    
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" value="<?php echo date('h:i a');?>" readonly>
                            <label class="form-control-label">Time</label>
                        </div>
                    </div>
                    </div>
                    <?php 
                    $sql78 = "SELECT * FROM tbl_attendance_tasks WHERE UserId='$UserId' AND CreatedDate='$date' AND Type=1 ORDER BY id ";
                    $rncnt78 = getRow($sql78);
                    ?>
 <input type="hidden" name="rncnt" value="<?php echo $rncnt78;?>">
                  <div class="row">
                    <?php 
                        $row78 = getList($sql78);
                        foreach($row78 as $result){
                    ?>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 ">
                    <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" aria-label="Checkbox for following text input" style="display: block;" value="0" id="Check_Id<?php echo $result['id']; ?>"onclick="featured(<?php echo $result['id']; ?>)">
                                        </div>
                                    </div>
                                    <input type="hidden" value="0" name="TaskDone[]" id="TaskDone<?php echo $result['id']; ?>">
                                     <input type="hidden" value="<?php echo $result['id']; ?>" name="TaskId[]">
                                    <input type="text" class="form-control" aria-label="Text input with checkbox" readonly value="<?php echo $result['Task'];?>">
                                </div>
                                </div>
                            <?php } ?>
                  </div>
                    
                   <!-- <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" value="<?php echo $Latitude;?>" readonly>
                            <label class="form-control-label">Latitude</label>
                        </div>
                    </div>
                    
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" value="<?php echo $Longitude;?>" readonly>
                            <label class="form-control-label">Longitude</label>
                        </div>
                    </div>-->
                    
                    <div class="row">
                      <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 ">
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" value="<?php echo $tot_dist;?>" readonly>
                            <label class="form-control-label">Your Location From Franchise in Km</label>
                        </div>
                    </div>
                    
                     <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 ">
                        <div class="form-group float-label active">
                     <div id="dvMap" style="width: 100%; height: 300px">
    </div>
    </div>
                    </div>
                    
                    </div>
<input type="hidden" name="userid" value="<?php echo $_SESSION['User']['id']; ?>" id="userid">  

<input type="hidden" name="frlattitude" value="<?php echo $FrLattitude; ?>" id="frlattitude"> 

<input type="hidden" name="frlongitude" value="<?php echo $FrLongitude; ?>" id="frlongitude"> 

                      <input type="hidden" name="action" value="takeAttendance2" id="action">  
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" id="submit2">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </main>
<br><br>
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
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADZAncocVsQMiK8ebIDhli29nk5GWWydk&amp;callback=initMap"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADZAncocVsQMiK8ebIDhli29nk5GWWydk&callback=init&libraries=places&v=weekly&channel=2"></script> 

<script type="text/javascript">
     function featured(id){
        if($('#Check_Id'+id).prop('checked') == true) {
            $('#TaskDone'+id).val(1);
        }
        else{
           $('#TaskDone'+id).val(0);
            }
        }


    var markers = [
        
        {
            "title": 'Your Location',
            "latitude": '<?php echo $Latitude;?>',
            "longitude": '<?php echo $Longitude;?>',
            "description": 'Your Location'
        },
        
        {
            "title": 'Franchise',
            "latitude": '<?php echo $FrLattitude;?>',
            "longitude": '<?php echo $FrLongitude;?>',
            "description": 'Franchise'
        },

        
    ];
    window.onload = function () {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].latitude, markers[0].longitude),
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        var infoWindow = new google.maps.InfoWindow();
        var lat_lng = new Array();
        var latlngbounds = new google.maps.LatLngBounds();
        for (i = 0; i < markers.length; i++) {
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.latitude, data.longitude);
            lat_lng.push(myLatlng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title
            });

            latlngbounds.extend(marker.position);
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent(data.title);
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);

        var service = new google.maps.DirectionsService();

        for (var i = 0; i < lat_lng.length; i++) {
            if ((i + 1) < lat_lng.length) {
                var src = lat_lng[i];
                var des = lat_lng[i + 1];

                service.route({
                    origin: src,
                    destination: des,
                    travelMode: google.maps.DirectionsTravelMode.WALKING
                }, function (result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        var path = new google.maps.MVCArray();
                        var poly = new google.maps.Polyline({
                            map: map,
                            strokeColor: '#4986E7'
                        });
                        poly.setPath(path);
                        for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                            path.push(result.routes[0].overview_path[i]);
                        }
                    }
                });
            }
        }
    }
    
    
    
</script>



<script>

 $(document).ready(function() {

    

     $('#validation-form2').on('submit', function(e){
      e.preventDefault();    
     $.ajax({  
                url :"ajax_files/ajax_attendance_new.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                 beforeSend:function(){
     $('#submit2').attr('disabled','disabled');
     $('#submit2').text('Please Wait...');
    },
                success:function(data){ 
                  console.log(data);
                     
                    if(data == 1){
                        // Android.saveProductClick();
                    toastr.success('Attendance Successfully!', 'Success', {timeOut: 5000}); 
                        setTimeout(function(){ 
                                        window.location.href="attendance-new.php";
                                        }, 3000);
                     }
                     else{
                        toastr.error('Please Upload Selfi/Photo', 'Error', {timeOut: 5000});  
                     }
                    
                     
                      $('#submit2').attr('disabled',false);
                    $('#submit2').text('Update');
                }  
           })
      });
 });

    
    var map;
var directionsDisplay;
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
var marker;
var marker2;
function initMap() {
currentLocation();
}
    
    function init() {
initMap();
}
    
    function currentLocation(){
     var SourceLat = $('#SourceLat').val();
    var SourceLong = $('#SourceLong').val();

    var latlng = new google.maps.LatLng(SourceLat, SourceLong);
    // This is making the Geocode request
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{
        if (status !== google.maps.GeocoderStatus.OK) {
           // alert(status);
        }
        // This is checking to see if the Geoeode Status is OK before proceeding
        if (status == google.maps.GeocoderStatus.OK) {
            console.log(results);
            var address = (results[0].formatted_address);
            $('#SourceAddress').val(address);
        }
    });

     if (marker)
        marker.setMap(null);
var myLatlng = new google.maps.LatLng(SourceLat,SourceLong);
var mapOptions = {
zoom: 18,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP,
disableDefaultUI: true,
};

 map = new google.maps.Map(document.getElementById("map"), mapOptions);

var iconBase = 'icons/Webp.net-gifmaker(14).gif';
marker = new google.maps.Marker({
map: map,
 icon: {
   url: iconBase,
   size: new google.maps.Size(20, 80),
   scaledSize: new google.maps.Size(20, 80),
   anchor: new google.maps.Point(0, 50)
  },
position: myLatlng,
animation: google.maps.Animation.DROP,
draggable: true 
}); 


google.maps.event.addListener(marker, 'dragend', function (event) {
    var lat = this.getPosition().lat();
     var lang = this.getPosition().lng();

     var latlng = new google.maps.LatLng(lat, lang);
    // This is making the Geocode request
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{
        if (status !== google.maps.GeocoderStatus.OK) {
            //alert(status);
        }
        // This is checking to see if the Geoeode Status is OK before proceeding
        if (status == google.maps.GeocoderStatus.OK) {
            //console.log(results);
            var address = (results[0].formatted_address);
             //alert(address);
             $('#origin-input2').val(address);
        }
    });
    
     $('#SourceLat').val(parseFloat(lat).toFixed(7));
        $('#SourceLong').val(parseFloat(lang).toFixed(7));
});
 marker.addListener("click", toggleBounce);
}
</script>
   
</body>

</html>
