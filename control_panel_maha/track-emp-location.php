<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Employee";
$Page = "View-Employee";

/*$sql = "SELECT * FROM `tbl_users` WHERE Roll NOT IN(1,5,55,9,22,23,63) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "E".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}*/
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Employee Account List</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>
</head>
<body>

 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">


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

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Employee Location

</h4>
<strong>Distance between locations: </strong><span id="dist"></span>
<?php 
$sql = "SELECT tu.Lattitude,tu.Longitude,tub.Lattitude AS FrLattitude,tub.Longitude AS FrLongitude FROM tbl_users tu INNER JOIN tbl_users_bill tub ON tub.id=tu.UnderFrId WHERE tu.id='".$_GET['id']."'";
$row = getRecord($sql);
?>

<div class="card" style="padding: 10px;">
    
 <div id="dvMap" style="width: 100%; height: 300px">
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
    var markers = [
        {
            "title": 'Employee Location',
            "latitude": <?php echo $row['Lattitude'];?>,
            "longitude": <?php echo $row['Longitude'];?>,
            "description": 'Employee Location'
        },
        {
            "title": 'Franchise Location',
            "latitude": <?php echo $row['FrLattitude'];?>,
            "longitude": <?php echo $row['FrLongitude'];?>,
            "description": 'Franchise Location'
        }
    ];

    function calculateDistance(lat1, lon1, lat2, lon2) {
        var R = 6371; // Radius of the Earth in km
        var dLat = (lat2 - lat1) * Math.PI / 180;
        var dLon = (lon2 - lon1) * Math.PI / 180;
        var a = 
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon/2) * Math.sin(dLon/2)
        ;
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c;
        return d.toFixed(2); // Returns distance in KM with 2 decimal points
    }

    window.onload = function () {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].latitude, markers[0].longitude),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        var infoWindow = new google.maps.InfoWindow();
        var lat_lng = [];
        var latlngbounds = new google.maps.LatLngBounds();

        for (var i = 0; i < markers.length; i++) {
            var data = markers[i];
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

        // Draw a line between the two points
        if (lat_lng.length >= 2) {
            var line = new google.maps.Polyline({
                path: [lat_lng[0], lat_lng[1]],
                geodesic: true,
                strokeColor: "#FF0000",
                strokeOpacity: 1.0,
                strokeWeight: 2,
                map: map
            });

            // Calculate distance in KM
            var distanceKm = calculateDistance(
                lat_lng[0].lat(), lat_lng[0].lng(),
                lat_lng[1].lat(), lat_lng[1].lng()
            );
            console.log("Distance between locations: " + distanceKm + " km");
            //alert("Distance between locations: " + distanceKm + " km");
            $('#dist').html(distanceKm+" km");
        }
    };
</script>

<script type="text/javascript">
 
    $(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ]
    });
});
</script>
</body>
</html>
