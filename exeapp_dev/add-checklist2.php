<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Add Checklist";
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
 
    <style>
        #map {
            height: 200px;
            width: 100%;
        }
    </style>
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 
        
        <?php 
        
        $sql55 = "SELECT * FROM tbl_company_emails WHERE id=1";
        $row55 = getRecord($sql55);
        
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_fuel_station_details WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

<?php 

  if(isset($_POST['submit'])){
$FuelStationName = addslashes(trim($_POST['FuelStationName']));
$LocationCity = addslashes(trim($_POST['LocationCity']));
$Address = addslashes(trim($_POST['Address']));
$GoogleLocation = addslashes(trim($_POST['GoogleLocation']));
$FuelStationType = addslashes(trim($_POST['FuelStationType']));
$DealerName = addslashes(trim($_POST['DealerName']));
$DealerContact = addslashes(trim($_POST['DealerContact']));
$ManagerName = addslashes(trim($_POST['ManagerName']));
$ManagerContact = addslashes(trim($_POST['ManagerContact']));
$SalesOfficerName = addslashes(trim($_POST['SalesOfficerName']));
$SalesOfficerContact = addslashes(trim($_POST['SalesOfficerContact']));
$PumpOperational = addslashes(trim($_POST['PumpOperational']));
$PetrolSales = addslashes(trim($_POST['PetrolSales']));
$DieselSales = addslashes(trim($_POST['DieselSales']));
$CNGAvailability = addslashes(trim($_POST['CNGAvailability']));
$ElectricChargingAvailability = addslashes(trim($_POST['ElectricChargingAvailability']));
$PumpAreaSqFt = addslashes(trim($_POST['PumpAreaSqFt']));
$NozzleCount = addslashes(trim($_POST['NozzleCount']));
$SpaceAvailability = addslashes(trim($_POST['SpaceAvailability']));
$BuiltSpaceAvailability = addslashes(trim($_POST['BuiltSpaceAvailability']));
$BuiltSpaceAreaSqFt = addslashes(trim($_POST['BuiltSpaceAreaSqFt']));
$VehiclesVisited = addslashes(trim($_POST['VehiclesVisited']));
$ExpectedSales = addslashes(trim($_POST['ExpectedSales']));
$CrossSalesExpected = addslashes(trim($_POST['CrossSalesExpected']));
$OnlineSalesExpected = addslashes(trim($_POST['OnlineSalesExpected']));
$MediaFiles = addslashes(trim($_POST['MediaFiles']));
$Latitude = addslashes(trim($_POST['Latitude']));
$Logitude = addslashes(trim($_POST['Logitude']));
$Comments = addslashes(trim($_POST['Comments']));
$TouristLocation = addslashes(trim($_POST['TouristLocation']));
$MarkLatitude = addslashes(trim($_POST['MarkLatitude']));
$MarkLogitude = addslashes(trim($_POST['MarkLogitude']));
$MarkAddress = addslashes(trim($_POST['MarkAddress']));

$randno = rand(1,100);
$src = $_FILES['Photo']['tmp_name'];
$fnm = substr($_FILES["Photo"]["name"], 0,strrpos($_FILES["Photo"]["name"],'.')); 
$fnm = str_replace(" ","_",$fnm);
$ext = substr($_FILES["Photo"]["name"],strpos($_FILES["Photo"]["name"],"."));
$dest = '../fuel_checklist_images/'. $randno . "_".$fnm . $ext;
$imagepath =  $randno . "_".$fnm . $ext;
if(move_uploaded_file($src, $dest))
{
$Photo = $imagepath ;
} 
else{
	$Photo = $_POST['OldPhoto'];
}

$CreatedDate = date('Y-m-d');
$cnt = 0;
if ($PumpOperational === 'Yes') {
    $cnt++;
}
if ($PetrolSales > 5) {
    $cnt++;
}
if ($DieselSales > 7) {
    $cnt++;
}
if ($CNGAvailability === 'Yes') {
    $cnt++;
}
if ($ElectricChargingAvailability === 'Yes') {
    $cnt++;
}
if ($PumpAreaSqFt >= 10000) {
    $cnt++;
}
if ($NozzleCount >= 6) {
    $cnt++;
}
if ($SpaceAvailability === 'Yes') {
    $cnt++;
}
if ($BuiltSpaceAvailability === 'Yes') {
    $cnt++;
}
if ($BuiltSpaceAreaSqFt >= 200) {
    $cnt++;
}
if ($VehiclesVisited >= 100) {
    $cnt++;
}
if ($ExpectedSales >= 10000) {
    $cnt++;
}
if ($CrossSalesExpected === 'Yes') {
    $cnt++;
}
if ($OnlineSalesExpected === 'Yes') {
    $cnt++;
}
if ($TouristLocation === 'Yes') {
    $cnt+=2;
}


    
//echo $cnt;exit();
if ($_GET['id'] == '') { 
     $qx = "INSERT INTO tbl_fuel_station_details SET 
        FuelStationName='$FuelStationName',
        LocationCity='$LocationCity',
        Address='$Address',
        GoogleLocation='$GoogleLocation',
        FuelStationType='$FuelStationType',
        DealerName='$DealerName',
        DealerContact='$DealerContact',
        ManagerName='$ManagerName',
        ManagerContact='$ManagerContact',
        SalesOfficerName='$SalesOfficerName',
        SalesOfficerContact='$SalesOfficerContact',
        PumpOperational='$PumpOperational',
        PetrolSales='$PetrolSales',
        DieselSales='$DieselSales',
        CNGAvailability='$CNGAvailability',
        ElectricChargingAvailability='$ElectricChargingAvailability',
        PumpAreaSqFt='$PumpAreaSqFt',
        NozzleCount='$NozzleCount',
        SpaceAvailability='$SpaceAvailability',
        BuiltSpaceAvailability='$BuiltSpaceAvailability',
        BuiltSpaceAreaSqFt='$BuiltSpaceAreaSqFt',
        VehiclesVisited='$VehiclesVisited',
        ExpectedSales='$ExpectedSales',
        CrossSalesExpected='$CrossSalesExpected',
        OnlineSalesExpected='$OnlineSalesExpected',
        Latitude='$Latitude',Logitude='$Logitude',
        createddate='$CreatedDate', 
        createdby='$user_id', MediaFiles='$Photo',
        userid='$user_id',points='$cnt',Comments='$Comments',TouristLocation='$TouristLocation',MarkLatitude='$MarkLatitude',MarkLogitude='$MarkLogitude',MarkAddress='$MarkAddress'";
       
    $conn->query($qx);
    $postid = mysqli_insert_id($conn);
    ?>
    <script>
        window.location.href = "upload-checklist-photos.php?id=<?php echo $postid;?>";
    </script>
   
    <?php 
} else {
    $query2 = "UPDATE tbl_fuel_station_details SET 
        FuelStationName='$FuelStationName',
        LocationCity='$LocationCity',
        Address='$Address',
        GoogleLocation='$GoogleLocation',
        FuelStationType='$FuelStationType',
        DealerName='$DealerName',
        DealerContact='$DealerContact',
        ManagerName='$ManagerName',
        ManagerContact='$ManagerContact',
        SalesOfficerName='$SalesOfficerName',
        SalesOfficerContact='$SalesOfficerContact',
        PumpOperational='$PumpOperational',
        PetrolSales='$PetrolSales',
        DieselSales='$DieselSales',
        CNGAvailability='$CNGAvailability',
        ElectricChargingAvailability='$ElectricChargingAvailability',
        PumpAreaSqFt='$PumpAreaSqFt',
        NozzleCount='$NozzleCount',
        SpaceAvailability='$SpaceAvailability',
        BuiltSpaceAvailability='$BuiltSpaceAvailability',
        BuiltSpaceAreaSqFt='$BuiltSpaceAreaSqFt',
        VehiclesVisited='$VehiclesVisited',
        ExpectedSales='$ExpectedSales',
        CrossSalesExpected='$CrossSalesExpected',
        OnlineSalesExpected='$OnlineSalesExpected',
        modifieddate='$CreatedDate',MediaFiles='$Photo',
        modifiedby='$user_id',points='$cnt',Comments='$Comments',TouristLocation='$TouristLocation',MarkLatitude='$MarkLatitude',MarkLogitude='$MarkLogitude',MarkAddress='$MarkAddress' 
        WHERE id = '$id'";
    $conn->query($query2);
    ?>
    <script>
        window.location.href = "upload-checklist-photos.php?id=<?php echo $id;?>";
    </script>
    <?php 
}
}
?>
<div id="map"></div>
 
        <div class="main-container">
            <div class="container">
               
                <div class="card">
                  <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                   <div class="card-body">
                       <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                       
                        
   
    
      <input type="hidden" name="MarkLatitude" id="MarkLatitude" class="form-control" placeholder="" value="<?php echo $row7['MarkLatitude'];?>" readonly>
 <input type="hidden" name="MarkLogitude" id="MarkLogitude" class="form-control" placeholder="" value="<?php echo $row7['MarkLogitude'];?>" readonly>
 <input type="hidden" name="MarkAddress" id="MarkAddress" class="form-control" placeholder="" value="<?php echo $row7['MarkAddress'];?>" readonly>
 <br>
                  <div class="form-group col-md-12">
                <label class="form-label">Name of Fuel Station</label>
                <input type="text" name="FuelStationName" id="FuelStationName" class="form-control" placeholder="" value="<?php echo $row7['FuelStationName'];?>" required>
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Location (City)</label>
                <input type="text" name="LocationCity" id="LocationCity" class="form-control" placeholder="" value="<?php echo $row7['LocationCity'];?>" required>
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Tourist Location</label>
                 <select name="TouristLocation" id="TouristLocation" class="form-control">
                    <option value="">Select</option>
                    <option value="Yes" <?php if($row7['TouristLocation'] == 'Yes'){?> selected <?php } ?>>Yes</option>
                    <option value="No" <?php if($row7['TouristLocation'] == 'No'){?> selected <?php } ?>>No</option>
                </select>
            </div>
            
            
            <div class="form-group col-md-12">
                <label class="form-label">Address</label>
                <textarea name="Address" id="Address" class="form-control" rows="3" required><?php echo $row7['Address'];?></textarea>
            </div>
             <input type="hidden" name="Latitude" id="Latitude" class="form-control" placeholder="" value="<?php echo $Lattitude;?>" readonly>
             <input type="hidden" name="Logitude" id="Logitude" class="form-control" placeholder="" value="<?php echo $Longitude;?>" readonly>

            <div class="form-group col-md-12">
                <label class="form-label">Google Location</label>
                <input type="text" name="GoogleLocation" id="GoogleLocation" class="form-control" placeholder="" value="<?php echo $row7['GoogleLocation'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Type of Fuel Station</label>
                <input type="text" name="FuelStationType" id="FuelStationType" class="form-control" placeholder="" value="<?php echo $row7['FuelStationType'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Name of Dealer</label>
                <input type="text" name="DealerName" id="DealerName" class="form-control" placeholder="" value="<?php echo $row7['DealerName'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Contact No of Dealer</label>
                <input type="text" name="DealerContact" id="DealerContact" class="form-control" placeholder="" value="<?php echo $row7['DealerContact'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Name of Manager</label>
                <input type="text" name="ManagerName" id="ManagerName" class="form-control" placeholder="" value="<?php echo $row7['ManagerName'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Contact No of Manager</label>
                <input type="text" name="ManagerContact" id="ManagerContact" class="form-control" placeholder="" value="<?php echo $row7['ManagerContact'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Name of Sales Officer</label>
                <input type="text" name="SalesOfficerName" id="SalesOfficerName" class="form-control" placeholder="" value="<?php echo $row7['SalesOfficerName'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Contact No of Sales Officer</label>
                <input type="text" name="SalesOfficerContact" id="SalesOfficerContact" class="form-control" placeholder="" value="<?php echo $row7['SalesOfficerContact'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Pump operational for 24 Hours</label>
                <select name="PumpOperational" id="PumpOperational" class="form-control">
                    <option value="">Select</option>
                    <option value="Yes" <?php if($row7['PumpOperational'] == 'Yes'){?> selected <?php } ?>>Yes</option>
                    <option value="No" <?php if($row7['PumpOperational'] == 'No'){?> selected <?php } ?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Petrol (Sales in KL Per Day)</label>
                <input type="text" name="PetrolSales" id="PetrolSales" class="form-control" placeholder="" value="<?php echo $row7['PetrolSales'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Diesel (Sales in KL Per Day)</label>
                <input type="text" name="DieselSales" id="DieselSales" class="form-control" placeholder="" value="<?php echo $row7['DieselSales'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">CNG Availability</label>
                <select name="CNGAvailability" id="CNGAvailability" class="form-control">
                    <option value="">Select</option>
                     <option value="Yes" <?php if($row7['CNGAvailability'] == 'Yes'){?> selected <?php } ?>>Yes</option>
                    <option value="No" <?php if($row7['CNGAvailability'] == 'No'){?> selected <?php } ?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Electric Charging Availability</label>
                <select name="ElectricChargingAvailability" id="ElectricChargingAvailability" class="form-control">
                    <option value="">Select</option>
                   <option value="Yes" <?php if($row7['ElectricChargingAvailability'] == 'Yes'){?> selected <?php } ?>>Yes</option>
                    <option value="No" <?php if($row7['ElectricChargingAvailability'] == 'No'){?> selected <?php } ?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Pump Area (Sq Ft)</label>
                <input type="text" name="PumpAreaSqFt" id="PumpAreaSqFt" class="form-control" placeholder="" value="<?php echo $row7['PumpAreaSqFt'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">No of Nozzle at Pump</label>
                <input type="text" name="NozzleCount" id="NozzleCount" class="form-control" placeholder="" value="<?php echo $row7['NozzleCount'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Space Availability (Min 40 Sq Ft - Entry/Exit)</label>
                <select name="SpaceAvailability" id="SpaceAvailability" class="form-control">
                    <option value="">Select</option>
                    <option value="Yes" <?php if($row7['SpaceAvailability'] == 'Yes'){?> selected <?php } ?>>Yes</option>
                    <option value="No" <?php if($row7['SpaceAvailability'] == 'No'){?> selected <?php } ?>>No</option>
                </select>
               
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Built Space Availability</label>
                <select name="BuiltSpaceAvailability" id="BuiltSpaceAvailability" class="form-control">
                    <option value="">Select</option>
                    <option value="Yes" <?php if($row7['BuiltSpaceAvailability'] == 'Yes'){?> selected <?php } ?>>Yes</option>
                    <option value="No" <?php if($row7['BuiltSpaceAvailability'] == 'No'){?> selected <?php } ?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Built Space Area if Available (In Sq Ft)</label>
                <input type="text" name="BuiltSpaceAreaSqFt" id="BuiltSpaceAreaSqFt" class="form-control" placeholder="" value="<?php echo $row7['BuiltSpaceAreaSqFt'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">No of Vehicles Visited in 10 Mins</label>
                <textarea name="VehiclesVisited" id="VehiclesVisited" class="form-control" rows="3"><?php echo $row7['VehiclesVisited'];?></textarea>
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Per Day Expected Sales of Outlet</label>
                <input type="text" name="ExpectedSales" id="ExpectedSales" class="form-control" placeholder="" value="<?php echo $row7['ExpectedSales'];?>">
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Cross Sales Expected</label>
                <select name="CrossSalesExpected" id="CrossSalesExpected" class="form-control">
                    <option value="">Select</option>
                  <option value="Yes" <?php if($row7['CrossSalesExpected'] == 'Yes'){?> selected <?php } ?>>Yes</option>
                    <option value="No" <?php if($row7['CrossSalesExpected'] == 'No'){?> selected <?php } ?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Online Sales Expected</label>
                <select name="OnlineSalesExpected" id="OnlineSalesExpected" class="form-control">
                    <option value="">Select</option>
                   <option value="Yes" <?php if($row7['OnlineSalesExpected'] == 'Yes'){?> selected <?php } ?>>Yes</option>
                    <option value="No" <?php if($row7['OnlineSalesExpected'] == 'No'){?> selected <?php } ?>>No</option>
                </select>
            </div>
            
 <div class="form-group col-md-12">
                <label class="form-label">Comments</label>
                <textarea name="Comments" id="Comments" class="form-control"><?php echo $row7['Comments'];?></textarea>
            </div>
                
                    </div>
                        
                          <input type="hidden" name="CreatedBy" value="<?php echo $_SESSION['User']['id']; ?>" id="CreatedBy">  
                      <input type="hidden" name="action" value="NewReg" id="action">  
                      
                      
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit">Save & Continue</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </main>
<br><br><br><br>
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
    
   <script>
    let map, marker, geocoder;

    function initMap() {
        // Initialize geocoder
        geocoder = new google.maps.Geocoder();

        // Get latitude and longitude from the input fields
        const latInput = document.getElementById("Latitude");
        const lngInput = document.getElementById("Logitude");

        const initialLat = parseFloat(latInput.value) || 21.1142728; // Default latitude
        const initialLng = parseFloat(lngInput.value) || 79.1098665; // Default longitude

        const initialLocation = {
            lat: initialLat,
            lng: initialLng,
        };

        // Initialize the map
        map = new google.maps.Map(document.getElementById("map"), {
            center: initialLocation,
            zoom: 15,
        });

        // Initialize the marker
        marker = new google.maps.Marker({
            position: initialLocation,
            map: map,
            draggable: true,
        });

        // Update the location details with initial values
        updateLocationDetails(initialLocation);

        // Add an event listener for when the marker is dragged
        marker.addListener("dragend", () => {
            const position = marker.getPosition();
            const newLocation = {
                lat: position.lat(),
                lng: position.lng(),
            };
            updateLocationDetails(newLocation);
        });
    }

    function updateLocationDetails(location) {
        const latInput = document.getElementById("Latitude");
        const lngInput = document.getElementById("Logitude");
        const addressInput = document.getElementById("MarkAddress");

        // Update latitude and longitude input fields
        document.getElementById("MarkLatitude").value = location.lat;
        document.getElementById("MarkLogitude").value = location.lng;

        // Perform reverse geocoding to get the address
        geocoder.geocode({ location: location }, (results, status) => {
            if (status === "OK" && results[0]) {
                document.getElementById("MarkAddress").value = results[0].formatted_address;
            } else {
                document.getElementById("MarkAddress").value = "Unable to retrieve address.";
            }
        });
    }

    // Ensure initMap is called when the Google Maps API is loaded
</script>
   
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADZAncocVsQMiK8ebIDhli29nk5GWWydk&callback=initMap" async defer></script>
</body>

</html>
