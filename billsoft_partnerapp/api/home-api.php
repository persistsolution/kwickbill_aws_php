<?php
header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// Allow specific headers
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
require_once 'config.php';
if ($_REQUEST['token'] != '' && $_REQUEST['fromdate'] != '' && $_REQUEST['todate'] != '') {
    function countval($val, $frid,$fromdate,$todate)
    {
        global $conn;

        if ($val == 'cash_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND PayType='Cash'";
        }
        if ($val == 'upi_payment') {
            $sql = "SELECT SUM(NetAmount) As result FROM tbl_customer_invoice WHERE Roll=2 AND FrId='$frid' AND PayType IN ('Phone Pay','Paytm','UPI','Other UPI')";
        }
        $sql.= " AND InvoiceDate>='$fromdate'";
        $sql.= " AND InvoiceDate<='$todate'";
        //$sql .= " AND InvoiceDate='" . date('Y-m-d') . "'";
        $res2 = $conn->query($sql);
        $row2 = $res2->fetch_assoc();
        return $row2['result'];
    }

    $token = $_REQUEST['token'];
    $fromdate = $_REQUEST['fromdate'];
    $todate = $_REQUEST['todate'];
    $sql = "SELECT id,CocoFranchiseAccess,Percentage FROM tbl_users_bill WHERE AuthToken='$token'";
    $rncnt = getRow($sql);
    if ($rncnt > 0) {
        $row = getRecord($sql);
        $uid = $row['id'];
        $CocoFranchiseAccess = $row['CocoFranchiseAccess'];
        $MyCommPercentage = $row['Percentage'];
        $sql2 = "SELECT SUM(NetAmount) AS NetAmount,COUNT(*) AS TotInv,tc.FrId,tu.ShopName,tu.Address FROM tbl_customer_invoice tc INNER JOIN tbl_users_bill tu ON tu.id=tc.FrId WHERE tu.Roll='5' AND tu.id IN ($CocoFranchiseAccess)";
        $sql2.= " AND tc.InvoiceDate>='$fromdate'";
        $sql2.= " AND tc.InvoiceDate<='$todate'";
        //$sql2.= " AND tc.InvoiceDate='" . date('Y-m-d') . "'";
        $sql2.= " GROUP BY tc.FrId  ORDER BY NetAmount DESC";
        $row2 = getList($sql2);
        foreach ($row2 as $result) {

            $NetAmount2 = $result['NetAmount'];
            if ($NetAmount2 > 0) {
                $NetAmount = $result['NetAmount'];
            } else {
                $NetAmount = 0;
            }
            
            $rncnt224 += $result['TotInv'];
            $TotNetAmount += $NetAmount;
            $TotCashAmount += countval('cash_payment', $result['FrId'], $fromdate,$todate);
            $TotUpiAmount += countval('upi_payment', $result['FrId'], $fromdate,$todate);
            if ($NetAmount > 0) {

                $sql = "SELECT Max(modified_time) AS LastTime FROM `tbl_customer_invoice` WHERE FrId='" . $result['FrId'] . "'";
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
                $cashamt = countval('cash_payment',$result['FrId'], $fromdate,$todate);
                $upiamt = countval('upi_payment',$result['FrId'], $fromdate,$todate);
                $avg = $NetAmount/$result['TotInv'];
                $NetAmount2 = $result['NetAmount'] > 0 ? $result['NetAmount'] : 0;
                
    $response[] = [
        'status' => 1,
        'frid' => $result['FrId'],
        'frname'=>$result['ShopName'],
        'fraddress'=>$result['Address'],
        'uid' => $uid,
        'NetAmount' => $NetAmount2,
        'CashAmount'=>$cashamt,
        'UpiAmt'=>$upiamt,
        'Avg'=>number_format($avg,2),
        'sync'=>$sync_time
    ];
               
            }
        }
        $totamt = number_format(($TotNetAmount+$NetAmount3)/1.05,2);
        $totcommamt = number_format($totamt*($MyCommPercentage/100),2);
        $response[] = [
        'totamt' => $totamt,
        'totcommamt'=>$totcommamt,
        'commisionper'=>$MyCommPercentage
        ];
       echo json_encode($response, JSON_PRETTY_PRINT); 
        
    } 
    
    else {
        echo json_encode(array('status' => 0, 'msg' => "Invalid Token"));
    }
} else {
    echo json_encode(array('status' => 2, 'msg' => "Token Not Received"));
}
