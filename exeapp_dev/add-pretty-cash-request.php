<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Pretty Cash Request";
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
$sql7 = "SELECT * FROM tbl_prettycash_request WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

<?php 
  if(isset($_POST['submit'])){
$ExpenseDate = $_POST['ExpenseDate'];
    $Amount = $_POST['Amount'];
    $Narration = addslashes(trim($_POST['Narration']));
    $CreatedDate = date('Y-m-d H:i:s');

if($_GET['id']==''){
     $qx = "INSERT INTO tbl_prettycash_request SET UserId='$UserId',ExpenseDate	='$ExpenseDate',Amount='$Amount',Narration='$Narration',CreatedDate='$CreatedDate',CreatedBy='$user_id'";
  $conn->query($qx);
?>
  <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Your Pretty cash request successfully submitted.",
  type: "success",
  confirmButtonText: "OK"
}, 
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-pretty-cash-request.php";
  }
}); });</script>
<?php 
}
else{
 
    $query2 = "UPDATE tbl_prettycash_request SET Narration = '$Narration',Amount='$Amount',ExpenseDate='$ExpenseDate',ModifiedDate='$ModifiedDate',ModifiedBy='$user_id' WHERE id = '$id'";
  $conn->query($query2);
  ?>
  <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Your advance request successfully updated.",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-advance-payment-request.php";
  }
}); });</script>
<?php 

}
    //header('Location:courses.php'); 

  }


  $CurrDate = date('Y-m-d');
    $month = date('m');
    $year = date('Y');
    $totdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $sql2 = "SELECT SalaryType,PerDaySalary FROM tbl_users WHERE id='$UserId'";
    $row2 = getRecord($sql2);
    $SalaryType = $row2['SalaryType'];
    
    if($SalaryType == 1){
        $PerDaySalary = $row2['PerDaySalary'];
    }
    else{
        $MonthSalary = $row2['PerDaySalary'];
        $PerDaySalary = $MonthSalary/$totdays;
    }

    $StartDate = date('Y-m')."-01";
    $EndDate = date('Y-m-d');
    $start_date = strtotime($StartDate);
    $end_date = strtotime($EndDate);
    $interval = ($end_date - $start_date)/60/60/24;

    $sql = "SELECT * FROM `tbl_attendance` WHERE UserId='$UserId' AND Type=2 AND MONTH(CreatedDate) = MONTH(CURRENT_DATE()) AND YEAR(CreatedDate) = YEAR(CURRENT_DATE())";
    $presentday = getRow($sql);
    $absentday = $interval - $presentday;
    $totalsalary = $PerDaySalary*$presentday;
    $advancesalary = $totalsalary*(40/100);
    
    //$mybalance = 4000;
    if ($mybalance >= $PettyAmount) {
    // Wallet has enough or more than needed; no request allowed
    $limit = 0;
} elseif ($mybalance > 0 && $mybalance < $PettyAmount) {
    // Wallet has some balance; request only the difference
    $limit = $PettyAmount - $mybalance;
} else {
    // Wallet is empty; full petty limit can be requested
    $limit = $PettyAmount;
}
 ?>
 
        <div class="main-container">
            <div class="container">
               
                <div class="card">
                  <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                   <div class="card-body">
                       <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                       <input type="hidden" name="PettyLimit" id="PettyLimit" value="<?php echo $PettyAmount; ?>">
                       
                       <div class="form-group float-label active">
                            <input type="text" name="WalletBal" id="WalletBal" class="form-control"
                                                placeholder="" value="<?php echo $mybalance; ?>"
                                                autocomplete="off" readonly>
                            <label class="form-control-label">Wallet Balance</label>
                        </div>
                        
                       <div class="form-group float-label active">
                            <input type="text" name="PettyCashLimit" id="PettyCashLimit" class="form-control"
                                                placeholder="" value="<?php echo $limit; ?>"
                                                autocomplete="off" readonly>
                            <label class="form-control-label">Petty Cash Req Limit</label>
                        </div>
                     
                      <div class="form-group float-label active">
                            <input type="text" name="Amount" id="Amount" class="form-control" placeholder="" value="" autocomplete="off" required oninput="checkReqAmt()">
                            <label class="form-control-label">Amount</label>
                        </div>
                        
                        <div class="form-group float-label active">
                            <input type="date" name="ExpenseDate" id="ExpenseDate" class="form-control"
                                                placeholder="" value="<?php echo date('Y-m-d'); ?>"
                                                autocomplete="off" readonly required>
                            <label class="form-control-label">Date</label>
                        </div>
                        
                       

                        
                   

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="Narration" name="Narration" value="<?php echo $row7['Narration']; ?>">
                            <label class="form-control-label">Narration</label>                            
                        </div>
                        
                         
                            
                
                    </div>
                        
                          <input type="hidden" name="CreatedBy" value="<?php echo $_SESSION['User']['id']; ?>" id="CreatedBy">  
                      <input type="hidden" name="action" value="NewReg" id="action">  
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit">Submit</button>
                        <span id="error_msg" style="color:red;"></span>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </main>

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
   function checkReqAmt(){
       var PettyLimit = $('#PettyCashLimit').val();
       var Amount = $('#Amount').val();
       if(Number(Amount) > Number(PettyLimit)){
               $('#submit').attr("disabled",true);
               $('#error_msg').html('You cannot request more than the permitted limit');
           }
           else{
               $('#submit').attr("disabled",false);
               $('#error_msg').html('');
           }
   }
       function checkBalamt(){
           var WalletBal = $('#WalletBal').val();
           var PettyLimit = $('#PettyLimit').val();
           if(Number(WalletBal) >= Number(PettyLimit)){
               $('#submit').attr("disabled",true);
               $('#error_msg').html('You cannot apply for a petty cash request because you have sufficient wallet balance.');
           }
           else{
               $('#submit').attr("disabled",false);
               $('#error_msg').html('');
           }
       }
       
       $(document).ready(function() {
    checkBalamt();
});
       
       
   </script>
</body>

</html>
