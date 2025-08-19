<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Executive-Visit";
$Page = "View-Executive-Visit";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Executive Visit List</title>
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
      right: 10%;
      z-index: 5;
      background-color: #fff;
      border: 1px solid #999;
      text-align: center;
    }
    </style>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">View Executive Visit List
    
</h4>

<div class="card" style="padding: 10px;">

     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       

  <div class="form-group col-md-4">
<label class="form-label"> Executive<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="ExeId" id="ExeId" required>
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN (1,5,55)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_POST["ExeId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<!-- <div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-3">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div> -->
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1">
    <label class="form-label">&nbsp;</label>
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_POST['Search'])) {?>
<div class="form-group col-md-1">
<label class="form-label">&nbsp;</label>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" data-original-title="Clear Filter">X</a>
</div>
<?php } ?>
</div>

</form>
                                            </div>
                                        </div>
                                    </div>
   </div>


</div>

<div id="map"></div>

</div>


<?php //include_once 'footer.php'; ?>

</div>

</div>

</div>

<div class="layout-overlay layout-sidenav-toggle"></div>
</div>

 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADZAncocVsQMiK8ebIDhli29nk5GWWydk&callback=InitMap&libraries=places"></script>

      <script type="text/javascript">
   var locations = [
            <?php 
           $sql11 = "SELECT * FROM tbl_users WHERE Roll=6 AND Status=1";
           if($_POST['ExeId']){
                $ExeId = $_POST['ExeId'];
                if($ExeId == 'all'){
                    $sql11.= " ";
                }
                else{
                $sql11.= " AND id='$ExeId'";
                }
            }
            //echo $sql11;
    $row22 = getList($sql11);
    foreach($row22 as $result){
        //$IconCab = "marker.png";
        ?>
      ['<?php echo $result['Fname']." ".$result['Lname'];?>', '<?php echo $result['Lattitude'];?>', '<?php echo $result['Longitude'];?>', <?php echo $result['id'];?>],
      <?php } ?>
        ];
    
     function InitMap() {
     var VehicleIcon = "39_ic_mini.png";
           //alert(VehicleIcon);
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: new google.maps.LatLng(21.114404, 79.107916),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
            });
            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            //var iconBase = "marker.png";
            //alert(iconBase);
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                 icon: {
   url: locations[i][4],
   size: new google.maps.Size(150, 150),
   scaledSize: new google.maps.Size(150, 150),
   anchor: new google.maps.Point(0, 50)
  }
                });
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent('<div class="scrollFix">' + '' +  locations[i][0] + '</div>Latitude : '+ locations[i][1] + '<br/> Longitude : '+ locations[i][2]);

                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    
  </script> 

<?php include_once 'footer_script.php'; ?>


</body>
</html>
