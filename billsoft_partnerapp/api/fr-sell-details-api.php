<?php
header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// Allow specific headers
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
require_once 'config.php';
if ($_REQUEST['frid'] != '' && $_REQUEST['token'] != '' && $_REQUEST['fromdate'] != '' && $_REQUEST['todate'] != '') {
    function countval($val, $frid, $MyCommPercentage,$fromdate,$todate)
    {
        global $conn;
        if ($val == 'cust_inv') {
            $sql = "SELECT count(*) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid'";
        }
        if ($val == 'today_cust_inv') {
            $sql = "SELECT count(*) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND InvoiceDate='" . date('Y-m-d') . "'";
        }

        if ($val == 'total_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid'";
        }
        if ($val == 'nongstamt') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid'";
        }
        if ($val == 'commisionamt') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid'";
        }
        if ($val == 'cash_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND PayType='Cash'";
        }
        if ($val == 'upi_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND PayType IN ('Phone Pay','Paytm','UPI','Other UPI')";
        }
        if ($val == 'phonepay_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND PayType='Phone Pay'";
        }
        if ($val == 'paytm_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND PayType='Paytm'";
        }
        if ($val == 'googlepay_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND PayType='UPI'";
        }
        if ($val == 'otherupi_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND PayType='Other UPI'";
        }
        if ($val == 'borrow_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND PayType='Borrowing'";
        }
        $sql.= " AND InvoiceDate>='$fromdate'";
        $sql.= " AND InvoiceDate<='$todate'";
        //$sql .= " AND InvoiceDate='" . date('Y-m-d') . "'";

        $res2 = $conn->query($sql);
        $row2 = $res2->fetch_assoc();
        if ($val == 'nongstamt') {
            $result = ($row2['result']) / 1.05;
        } else if ($val == 'commisionamt') {
            $totamt = ($row2['result']) / 1.05;
            $result = $totamt * ($MyCommPercentage / 100);
        } else {
            $result = $row2['result'];
        }
        return $result;
    }

    $FranchiseId = $_REQUEST['frid'];
    $token = $_REQUEST['token'];
    $fromdate = $_REQUEST['fromdate'];
    $todate = $_REQUEST['todate'];
    $sql = "SELECT id,CocoFranchiseAccess,Percentage FROM tbl_users_bill WHERE AuthToken='$token'";
    $rncnt = getRow($sql);
    if ($rncnt > 0) {
        $row = getRecord($sql);
        $uid = $row['id'];
        $MyCommPercentage = $row['Percentage'];
        $sql = "SELECT Max(modified_time) AS LastTime FROM `tbl_customer_invoice` WHERE FrId='$FranchiseId'";
        $row = getRecord($sql);
        $LastTime = $row['LastTime'];
        $date = $LastTime;
        $currtime = gmdate("Y-m-d H:i:s");
        // Create two DateTime objects
        $dateTime1 = new DateTime($currtime); // Current date and time
        $dateTime2 = new DateTime($date); // 1 hour 45 minutes ago

        // Calculate the difference between the two dates
        $interval = $dateTime1->diff($dateTime2);

        // Format the difference
        $hours = $interval->h;
        $minutes = $interval->i;

        if ($hours > 0 && $minutes > 0) {
            $timeDifference = "$hours hour" . ($hours > 1 ? 's' : '') . " $minutes minute" . ($minutes > 1 ? 's' : '') . " ago";
        } elseif ($hours > 0) {
            $timeDifference = "$hours hour" . ($hours > 1 ? 's' : '') . " ago";
        } elseif ($minutes > 0) {
            $timeDifference = "$minutes minute" . ($minutes > 1 ? 's' : '') . " ago";
        } else {
            $timeDifference = "just now";
        }
        $sync_time = $timeDifference;

        $totalsell = countval('total_payment', $FranchiseId, 0, $fromdate,$todate);
        $totcashbpay = countval('cash_payment', $FranchiseId, 0, $fromdate,$todate);
        $totupipay = countval('upi_payment', $FranchiseId, 0, $fromdate,$todate);
        $totcreditpay = countval('borrow_payment', $FranchiseId, 0, $fromdate,$todate);
        $gpay = countval('googlepay_payment', $FranchiseId, 0, $fromdate,$todate);
        $paytm = countval('paytm_payment', $FranchiseId, 0, $fromdate,$todate);
        $phonepay = countval('phonepay_payment', $FranchiseId, 0, $fromdate,$todate);
        $others = countval('otherupi_payment', $FranchiseId, 0, $fromdate,$todate);
        $totalbills = countval('cust_inv', $FranchiseId, 0, $fromdate,$todate);
        $avgtotbill = number_format($totalsell / $totalbills,2);
        $nongstamt = round(countval('nongstamt', $FranchiseId, 0, $fromdate,$todate));
        $commisionper = $MyCommPercentage;
        $commionamt = round(countval('commisionamt',$FranchiseId,$MyCommPercentage, $fromdate,$todate));
        $response[] = [
            'totalsell' => $totalsell,
            'totcashbpay' => $totcashbpay,
            'totupipay' => $totupipay,
            'totcreditpay' => $totcreditpay,
            'gpay' => $gpay,
            'paytm' => $paytm,
            'phonepay' => $phonepay,
            'others' => $others,
            'totalbills' => $totalbills,
            'avgtotbill' => $avgtotbill,
            'nongstamt' => $nongstamt,
            'commisionper' => $commisionper,
            'commionamt'=>$commionamt
        ];
        echo json_encode($response, JSON_PRETTY_PRINT);
    } else {
        echo json_encode(array('status' => 0, 'msg' => "Invalid Reponse"));
    }
} else {
    echo json_encode(array('status' => 2, 'msg' => "Data Not Received"));
}
