<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Vendors";
$Page = "Add-Vendors";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Vendor Account
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="" />
    <meta name="keywords" content="">
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

    fieldset legend {
        background: inherit;
        font-family: "Lato", sans-serif;
        color: #650812;
        font-size: 15px;
        left: 10px;
        padding: 0 10px;
        position: absolute;
        top: -12px;
        font-weight: 400;
        width: auto !important;
        border: none !important;
    }

    fieldset {
        background: #ffffff;
        border: 1px solid #4FAFB8;
        border-radius: 5px;
        margin: 20px 0 1px 0;
        padding: 20px;
        position: relative;
    }
     #loader {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255, 255, 255, 0.7);
    text-align: center;
    padding-top: 20%;
    font-size: 24px;
    font-weight: bold;
    color: #333;
}
    </style>
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

             <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


            <div class="layout-container">

                

                <?php 
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_users WHERE id='$id'";
$row7 = getRecord($sql7);

?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Create Salary Slip</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="alert_message"></div>
                                <form id="validation-form" method="post" autocomplete="off" action="ajax_files/ajax_vendors.php" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <fieldset>
 <legend>Employee Detail</legend>
                                    <div class="form-row">
                                       <div class="form-group col-md-6">
<label class="form-label"> Employee<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="UserId" id="UserId" required onchange="getEmpDetails(this.value)">
<option selected="" value="all">All</option>

 <?php 
  $sql12 = "SELECT id,Fname,CustomerId FROM tbl_users WHERE Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0 AND Status=1";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_REQUEST["UserId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['CustomerId'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

                                        
                                       <div class="form-group col-md-3">
                                            <label class="form-label">Employee Id<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="EmpId" id="EmpId" class="form-control"
                                                placeholder="" value="<?php echo $row7["EmpId"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Designation<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="Designation" id="Designation" class="form-control"
                                                placeholder="" value="<?php echo $row7["Designation"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
<label class="form-label">Month</label>
<select class="form-control" style="width: 100%" name="month" id="month" required onchange="calAttendance(document.getElementById('month').value,document.getElementById('year').value)">
<option <?php if($_POST['month'] == '01'){?> selected <?php } ?> value="01">Jan</option>
<option <?php if($_POST['month'] == '02'){?> selected <?php } ?> value="02">Feb</option>
<option <?php if($_POST['month'] == '03'){?> selected <?php } ?> value="03">Mar</option>
<option <?php if($_POST['month'] == '04'){?> selected <?php } ?> value="04">Apr</option>
<option <?php if($_POST['month'] == '05'){?> selected <?php } ?> value="05">May</option>
<option <?php if($_POST['month'] == '06'){?> selected <?php } ?> value="06">Jun</option>
<option <?php if($_POST['month'] == '07'){?> selected <?php } ?> value="07">Jul</option>
<option <?php if($_POST['month'] == '08'){?> selected <?php } ?> value="08">Aug</option>
<option <?php if($_POST['month'] == '09'){?> selected <?php } ?> value="09">Sep</option>
<option <?php if($_POST['month'] == '10'){?> selected <?php } ?> value="10">Oct</option>
<option <?php if($_POST['month'] == '11'){?> selected <?php } ?> value="11">Nov</option>
<option <?php if($_POST['month'] == '12'){?> selected <?php } ?> value="12">Dec</option>
  </select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-2">
<label class="form-label">Year</label>
<select class="form-control" style="width: 100%" name="year" id="year" required onchange="calAttendance(document.getElementById('month').value,document.getElementById('year').value)">
     <option <?php if($_POST['year'] == '2025'){?> selected <?php } ?> value="2025">2025</option>
    <option <?php if($_POST['year'] == '2024'){?> selected <?php } ?> value="2024">2024</option>
  </select>
<div class="clearfix"></div>
</div>

 <div class="form-group col-md-2">
                                            <label class="form-label">Total Days<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="TotalDays" id="TotalDays" class="form-control"
                                                placeholder="" value="<?php echo $row7["TotalDays"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">Total Present<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="TotalPresent" id="TotalPresent" class="form-control"
                                                placeholder="" value="<?php echo $row7["TotalPresent"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class="form-label">Total Absent<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="TotalAbsent" id="TotalAbsent" class="form-control"
                                                placeholder="" value="<?php echo $row7["TotalAbsent"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                         <div class="form-group col-md-2">
                                            <label class="form-label">Actual Salary<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="ActualSalary" id="ActualSalary" class="form-control"
                                                placeholder="" value="<?php echo $row7["ActualSalary"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Basic Salary<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="BasicSalary" id="BasicSalary" class="form-control"
                                                placeholder="" value="<?php echo $row7["BasicSalary"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">HRA<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="Hra" id="Hra" class="form-control"
                                                placeholder="" value="<?php echo $row7["Hra"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Conveyance<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="Conveyance" id="Conveyance" class="form-control"
                                                placeholder="" value="<?php echo $row7["Conveyance"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Special Allowance<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="SpecialAllowance" id="SpecialAllowance" class="form-control"
                                                placeholder="" value="<?php echo $row7["SpecialAllowance"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Amount Consider For Deduction of EPF<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="EpfAmt" id="EpfAmt" class="form-control"
                                                placeholder="" value="<?php echo $row7["EpfAmt"]; ?>"
                                                autocomplete="off" readonly>
                                        </div>
                                        
                                     

                                      

                                    </div>
                                    </fieldset>
                                    
                                
          
                                     

                                    <button type="submit" class="btn btn-primary btn-finish" id="submit">Save</button>
                                </form>
                            </div>
                        </div>






                    </div>


                    <?php include_once 'footer.php'; ?>
                </div>

            </div>

        </div>

        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
<div id="loader">Please wait...</div>

    <?php include_once 'footer_script.php'; ?>

  <script>
  function calAttendance(month,year){
      var UserId = $('#UserId').val();
      var action = "calAttendance";
            $.ajax({
                url: "ajax_files/ajax_employee.php",
                method: "POST",
                data: {
                    action: action,
                    UserId: UserId,
                    month:month,
                    year:year
                },
                success: function(data) {
                  console.log(data);
                  var res = JSON.parse(data);
                   $('#TotalDays').val(res.total_days);
                   $('#TotalPresent').val(res.total_present);
                   $('#TotalAbsent').val(res.total_absent);
                   calSalary();
                }
            });
  }
      function getEmpDetails(id){
          var action = "getEmpDetails";
            $.ajax({
                url: "ajax_files/ajax_employee.php",
                method: "POST",
                data: {
                    action: action,
                    id: id
                },
                dataType:"json",  
                success: function(data) {
                  console.log(data);
                    $('#EmpId').val(data.CustomerId);  
                    $('#Designation').val(data.Designation);  
                    $('#ActualSalary').val(data.MonthlySalary);
                }
            });
      }
      
      function calSalary(){
          var MonthlySalary = $('#ActualSalary').val();
          var BasicSalary = Number(MonthlySalary)*(40/100);
          $('#BasicSalary').val(BasicSalary);
          var Hra = Number(BasicSalary)*(50/100);
          $('#Hra').val(Hra);
          $('#Conveyance').val(1600);
          var SpecialAllowance = Number(MonthlySalary)-Number(BasicSalary)-Number(Hra)-Number(1600);
          $('#SpecialAllowance').val(SpecialAllowance);
          if(Number(BasicSalary) > 15000){
              $('#EpfAmt').val(15000);
          }
          else{
              $('#EpfAmt').val(Number(BasicSalary));
          }
          
      }
  </script>
</body>

</html>