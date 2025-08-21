<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../config.php';

function calMonth($fromdate, $todate) {
    $ts1 = strtotime($fromdate);
    $ts2 = strtotime($todate);
    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);
    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);
    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return max(0, $diff);
}

function ftdRevenue($frid, $fromdate, $todate, $paymode) {
    global $conn;
    $conditions = "";
    if ($paymode !== '') {
        if ($paymode === 'Cash') {
            $conditions = " AND PayType IN ('Cash')";
        } else {
            $conditions = " AND PayType IN ('UPI','Phone Pay','Paytm','Online Payment','Other UPI','Borrowing','Swiggy','Zomato')";
        }
    }

    $sql = "
        SELECT SUM(TotalInv) AS TotalInv FROM (
            SELECT COUNT(*) AS TotalInv FROM tbl_customer_invoice
            WHERE FrId='$frid' AND InvoiceDate>='$fromdate' AND InvoiceDate<='$todate' $conditions
            UNION ALL
            SELECT COUNT(*) AS TotalInv FROM tbl_customer_invoice_2025
            WHERE FrId='$frid' AND InvoiceDate>='$fromdate' AND InvoiceDate<='$todate' $conditions
        ) AS a
    ";

    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    return (int)$row['TotalInv'];
}

function ftdRevenueAmt($frid, $fromdate, $todate, $paymode) {
    global $conn;
    $conditions = "";
    if ($paymode !== '') {
        if ($paymode === 'Cash') {
            $conditions = " AND PayType IN ('Cash')";
        } else {
            $conditions = " AND PayType IN ('UPI','Phone Pay','Paytm','Online Payment','Other UPI')";
        }
    }

    $sql = "
        SELECT SUM(NetAmount) AS NetAmount FROM (
            SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice
            WHERE FrId='$frid' AND InvoiceDate>='$fromdate' AND InvoiceDate<='$todate' $conditions
            UNION ALL
            SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice_2025
            WHERE FrId='$frid' AND InvoiceDate>='$fromdate' AND InvoiceDate<='$todate' $conditions
        ) AS a
    ";

    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    return (float)($row['NetAmount'] ?? 0);
}

try {
    $FromDate = $_REQUEST['FromDate'] ?? date('Y-m-d', strtotime("-1 days"));
    $ToDate = $_REQUEST['ToDate'] ?? date('Y-m-d', strtotime("-1 days"));

    $yesterday = $FromDate;
    $lastmonth2 = date('m', strtotime("-1 month"));
    $lastmonth = ($lastmonth2 == date('m')) ? date('Y') . "-" . (date('m') - 1) : date('Y-m', strtotime("-1 month"));
    $lastmonth_startdate = $lastmonth . "-01";
    $lastmonth_enddate = $lastmonth . "-" . date('d', strtotime("-1 days"));

    $sql = "SELECT * FROM tbl_users_bill WHERE Roll=5 AND Status=1 AND ShowFrStatus=1";
    $res = $conn->query($sql);

    $data = [];
    while ($result = $res->fetch_assoc()) {
        $frid = $result['id'];

        $mtd_inv = ftdRevenue($frid, date('Y-m') . "-01", $yesterday, '');
        $mtd_inv_amt = ftdRevenueAmt($frid, date('Y-m') . "-01", $yesterday, '');

        $pmsd_inv = ftdRevenue($frid, $lastmonth_startdate, $lastmonth_enddate, '');
        $pmsd_inv_amt = ftdRevenueAmt($frid, $lastmonth_startdate, $lastmonth_enddate, '');

        $growth_inv = ($pmsd_inv == 0) ? 0 : round(($mtd_inv - $pmsd_inv) / $pmsd_inv, 2);
        $growth_inv_amt = ($pmsd_inv_amt == 0) ? 0 : round(($mtd_inv_amt - $pmsd_inv_amt) / $pmsd_inv_amt, 2);

        $records = [
            "OutletID" => $result['CustomerId'],
            "OutletName" => $result['ShopName'],
            "Location" => $result['Location'],
            "OpeningDate" => date("d/m/Y", strtotime($result['SellDate'])),
            "OutletVintageInMonths" => calMonth($result['SellDate'], date('Y-m-d')),
            "Manager" => "",

            "FTD_InvoiceCount" => ftdRevenue($frid, $yesterday, $yesterday, ''),
            "FTD_Amount" => ftdRevenueAmt($frid, $yesterday, $yesterday, ''),

            "MTD_InvoiceCount" => $mtd_inv,
            "MTD_Amount" => $mtd_inv_amt,

            "PMSD_InvoiceCount" => $pmsd_inv,
            "PMSD_Amount" => $pmsd_inv_amt,

            "Growth_Invoice_Percentage" => $growth_inv,
            "Growth_Amount_Percentage" => $growth_inv_amt,

            "Cash_InvoiceCount" => ftdRevenue($frid, date('Y-m') . "-01", $yesterday, 'Cash'),
            "Cash_Amount" => ftdRevenueAmt($frid, date('Y-m') . "-01", $yesterday, 'Cash'),

            "UPI_InvoiceCount" => ftdRevenue($frid, date('Y-m') . "-01", $yesterday, 'UPI'),
            "UPI_Amount" => ftdRevenueAmt($frid, date('Y-m') . "-01", $yesterday, 'UPI')
        ];

        $data[] = $records;
    }

    echo json_encode([
        "status" => "success",
        "FromDate" => $FromDate,
        "ToDate" => $ToDate,
        "records" => $data
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch daily sale report: " . $e->getMessage()
    ]);
}
?>
