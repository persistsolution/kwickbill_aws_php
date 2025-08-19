<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Products";
$Page = "Add-Products";

?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> - Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="">
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
<style>
    #map {height: 100%;}
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #floating-panel {
      position: absolute;
      top: 10px;
      right: 1%;
      z-index: 5;
      background-color: #fff;
      border: 1px solid #999;
      text-align: center;
    }
    </style>
 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">




<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Track Location</h4>

<div class="row">
   

<div class="col-lg-12">
    <div class="form-group">
   <div id="dvMap" style="width: 100%; height: 500px">
    </div>
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
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyADZAncocVsQMiK8ebIDhli29nk5GWWydk"></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        // Fetch coordinates and title from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const title = urlParams.get('title') || "Default Location";
        const latitude = parseFloat(urlParams.get('lat')) || 0; // Default to 0 if not provided
        const longitude = parseFloat(urlParams.get('lng')) || 0;

        // Validate coordinates
        if (isNaN(latitude) || isNaN(longitude)) {
            alert("Invalid latitude or longitude provided!");
            return;
        }

        // Marker data
        const markers = [
            {
                title: title,
                latitude: latitude,
                longitude: longitude,
                description: 'Location'
            }
        ];

        // Initialize map
        const mapOptions = {
            center: new google.maps.LatLng(latitude, longitude),
            zoom: 3, // Default zoom level
            minZoom: 3, // Minimum zoom level
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        const map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);

        // Enforce the minimum zoom level
        google.maps.event.addListener(map, "zoom_changed", function () {
            if (map.getZoom() < mapOptions.minZoom) {
                map.setZoom(mapOptions.minZoom);
            }
        });

        const infoWindow = new google.maps.InfoWindow();
        const lat_lng = [];
        const latlngbounds = new google.maps.LatLngBounds();

        // Add markers
        markers.forEach(data => {
            const myLatlng = new google.maps.LatLng(data.latitude, data.longitude);
            lat_lng.push(myLatlng);

            const marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title
            });

            latlngbounds.extend(marker.position);

            // Add click event for marker
            google.maps.event.addListener(marker, "click", function () {
                infoWindow.setContent(`<strong>${data.title}</strong><br>${data.description}`);
                infoWindow.open(map, marker);
            });
        });

        // Fit map to bounds
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);

        // Draw paths between markers (if multiple)
        if (lat_lng.length > 1) {
            const service = new google.maps.DirectionsService();

            for (let i = 0; i < lat_lng.length - 1; i++) {
                const src = lat_lng[i];
                const des = lat_lng[i + 1];

                service.route({
                    origin: src,
                    destination: des,
                    travelMode: google.maps.DirectionsTravelMode.WALKING
                }, function (result, status) {
                    if (status === google.maps.DirectionsStatus.OK) {
                        const path = new google.maps.MVCArray();
                        const poly = new google.maps.Polyline({
                            map: map,
                            strokeColor: '#4986E7'
                        });
                        poly.setPath(path);

                        result.routes[0].overview_path.forEach(point => path.push(point));
                    } else {
                        console.error("Directions request failed due to " + status);
                    }
                });
            }
        }
    });
</script>



</body>
</html>