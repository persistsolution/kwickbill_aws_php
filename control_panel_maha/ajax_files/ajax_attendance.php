<?php 
session_start();
include_once '../config.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'checkAttendance'){
    $id = $_POST['id'];
    $UserId = $_POST['UserId'];
    $date = $_POST['CreatedDate'];
    $sql = "SELECT * FROM tbl_attendance WHERE UserId='$UserId' AND CreatedDate='$date' AND Type=1";
    $rncnt = getRow($sql);
    if($rncnt > 0){
        echo 1;
    }
    else{
        echo 0;
    }
}


if($_POST['action'] == 'getUserAttendanceRec'){
    $id = $_POST['id'];
    $CurrDate = date('Y-m-d');
    $month = date('m');
    $year = date('Y');
    $totdays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $sql2 = "SELECT SalaryType,PerDaySalary FROM tbl_users WHERE id='$id'";
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

    $sql = "SELECT * FROM `tbl_attendance` WHERE UserId='$id' AND Type=2 AND MONTH(CreatedDate) = MONTH(CURRENT_DATE()) AND YEAR(CreatedDate) = YEAR(CURRENT_DATE())";
    $presentday = getRow($sql);
    $absentday = $interval - $presentday;
    $totalsalary = $PerDaySalary*$presentday;
    $advancesalary = $totalsalary*(40/100);

    echo json_encode(array('TotalDays'=>$interval,'PresentDay'=>$presentday,'AbsentDay'=>$absentday,'TotalSalary'=>$totalsalary,'AdvanceSalary'=>$advancesalary));
}
?>