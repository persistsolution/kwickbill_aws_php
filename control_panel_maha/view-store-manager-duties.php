<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Store-Manager-Duties";
$Page = "Store-Manager-Duties";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> </title>
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



<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_store_manager_duties WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="view-store-manager-duties.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Store Manager Duties
    
</h4>

<div class="card" style="padding: 10px;">

     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

 

<div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-3">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
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

<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Oversee restaurant operations and ensure a smooth flow / रेस्टॉरंट ऑपरेशन्स आणि सुचारू प्रवाह सुनिश्चित करा</th>
            <th>Maintain a positive restaurant culture / सकारात्मक रेस्टॉरंट संस्कृती राखा</th>
            <th>Create work schedules that align with the outlet need / आउटलेटच्या गरजेनुसार कामाचे वेळापत्रक तयार करा</th>
            <th>Ensure proper compliance with outlet hygiene regulation / आउटलेट स्वच्छता नियमांचे योग्य पालन सुनिश्चित करा</th>
            <th>Organize and take stock of outlet supplies / आउटलेट पुरवठ्याचे आयोजन आणि स्टॉक घ्या</th>
            <th>Supervise both kitchen staff and floor staff / किचन स्टाफ आणि फ्लोअर स्टाफचे निरीक्षण करा</th>
            <th>Train new employees to help them to meet the restaurants expectation / नवीन कर्मचारी प्रशिक्षित करा जेणेकरून ते रेस्टॉरंटच्या अपेक्षा पूर्ण करू शकतील</th>
            <th>Interact with dining customers and take feedback to gain repeated customers / जेवणाऱ्या ग्राहकांशी संवाद साधा आणि फीडबॅक घ्या</th>
            <th>Follow daily checklist and update regularly / दैनिक चेकलिस्टचा पाठपुरावा करा आणि नियमितपणे अपडेट करा</th>
            <th>Keep staff room area and storing clean on daily basis / कर्मचारी कक्ष क्षेत्र आणि स्टोअरिंग रोज स्वच्छ ठेवा</th>
            <th>Check daily grooming of staff on daily basis / कर्मचाऱ्यांची दररोज ग्रूमिंग तपासा</th>
            <th>Daily security checks of employees going home after completion of shift / शिफ्ट पूर्ण झाल्यानंतर घरी जाणाऱ्या कर्मचाऱ्यांची सुरक्षा तपासा</th>
            <th>Control food wastage to control food cost / अन्नाचा अपव्यय नियंत्रित करा</th>
            <th>Control electricity wastage / वीजेचा अपव्यय नियंत्रित करा</th>
            <th>Cash deposits need to be done on daily basis and upload deposit slip regularly / दररोज रोख ठेवी करा आणि डिपॉझिट स्लिप नियमितपणे अपलोड करा</th>
            <th>Wear dress provided by company and check same with staff on daily basis / कंपनी प्रदान केलेला पोशाख परिधान करा आणि दररोज कर्मचाऱ्यांचे तपासा</th>
            <th>Maintain todays special board, update hotspot discounted products on same / आजचा विशेष बोर्ड राखा आणि त्यावर हॉटस्पॉट डिस्काउंटेड उत्पादने अपडेट करा</th>
            <th>Maintain 100% attendance of all staff / सर्व कर्मचाऱ्यांची 100% उपस्थिती राखा</th>
            <th>Created Date</th>
            <th>Created By</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $sql = "SELECT ts.*,tu.Fname FROM tbl_store_manager_duties ts LEFT JOIN tbl_users tu ON tu.id=ts.userid WHERE 1";

        // Add filters if needed
        if ($_POST['FromDate']) {
            $FromDate = $_POST['FromDate'];
            $sql .= " AND ts.createddate >= '$FromDate'";
        }
        if ($_POST['ToDate']) {
            $ToDate = $_POST['ToDate'];
            $sql .= " AND ts.createddate <= '$ToDate'";
        }
        $sql .= " ORDER BY ts.createddate DESC";

        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['operation_flow']; ?></td>
            <td><?php echo $row['positive_culture']; ?></td>
            <td><?php echo $row['work_schedule']; ?></td>
            <td><?php echo $row['hygiene_compliance']; ?></td>
            <td><?php echo $row['stock_management']; ?></td>
            <td><?php echo $row['staff_supervision']; ?></td>
            <td><?php echo $row['employee_training']; ?></td>
            <td><?php echo $row['customer_feedback']; ?></td>
            <td><?php echo $row['daily_checklist']; ?></td>
            <td><?php echo $row['staff_room_cleaning']; ?></td>
            <td><?php echo $row['staff_grooming']; ?></td>
            <td><?php echo $row['security_checks']; ?></td>
            <td><?php echo $row['food_wastage']; ?></td>
            <td><?php echo $row['electricity_wastage']; ?></td>
            <td><?php echo $row['cash_deposits']; ?></td>
            <td><?php echo $row['staff_uniform']; ?></td>
            <td><?php echo $row['special_board']; ?></td>
            <td><?php echo $row['staff_attendance']; ?></td>
            <td><?php echo date("d/m/Y", strtotime($row['createddate'])); ?></td>
            <td><?php echo $row['Fname']; ?></td>
        </tr>
        <?php $i++; } ?>
    </tbody>
    </table>
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
