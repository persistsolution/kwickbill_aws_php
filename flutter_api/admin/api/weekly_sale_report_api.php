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
    $condition = "";
    if ($paymode != '') {
        if ($paymode == 'Cash') {
            $condition = " AND PayType IN ('Cash')";
        } else {
            $condition = " AND PayType IN ('UPI','Phone Pay','Paytm','Online Payment','Other UPI')";
        }
    }

    $sql = "
        SELECT SUM(TotalInv) AS TotalInv FROM (
            SELECT COUNT(*) AS TotalInv FROM tbl_customer_invoice
            WHERE FrId='$frid' AND InvoiceDate>='$fromdate' AND InvoiceDate<='$todate' $condition
            UNION ALL
            SELECT COUNT(*) AS TotalInv FROM tbl_customer_invoice_2025
            WHERE FrId='$frid' AND InvoiceDate>='$fromdate' AND InvoiceDate<='$todate' $condition
        ) AS a
    ";

    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    return (int) $row['TotalInv'];
}

function ftdRevenueAmt($frid, $fromdate, $todate, $paymode) {
    global $conn;
    $condition = "";
    if ($paymode != '') {
        if ($paymode == 'Cash') {
            $condition = " AND PayType IN ('Cash')";
        } else {
            $condition = " AND PayType IN ('UPI','Phone Pay','Paytm','Online Payment','Other UPI')";
        }
    }

    $sql = "
        SELECT SUM(NetAmount) AS NetAmount FROM (
            SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice
            WHERE FrId='$frid' AND InvoiceDate>='$fromdate' AND InvoiceDate<='$todate' $condition
            UNION ALL
            SELECT SUM(NetAmount) AS NetAmount FROM tbl_customer_invoice_2025
            WHERE FrId='$frid' AND InvoiceDate>='$fromdate' AND InvoiceDate<='$todate' $condition
        ) AS a
    ";

    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    return (float) ($row['NetAmount'] ?? 0);
}

try {
    $data = [];
    $cal = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
    $sql = "SELECT * FROM tbl_users_bill WHERE Roll=5 AND Status=1 AND ShowFrStatus=1";
    $res = $conn->query($sql);

    while ($row = $res->fetch_assoc()) {
        $frid = $row['id'];

        $weeks = [
            ['start' => '01', 'end' => '07'],
            ['start' => '08', 'end' => '14'],
            ['start' => '15', 'end' => '21'],
            ['start' => '22', 'end' => '28'],
        ];

        // Add 5th week if applicable
        if ($cal > 28) {
            $weeks[] = ['start' => '29', 'end' => str_pad($cal, 2, '0', STR_PAD_LEFT)];
        }

        $records = [
            "OutletID" => $row['CustomerId'],
            "OutletName" => $row['ShopName'],
            "Location" => $row['Location'],
            "OpeningDate" => date("d/m/Y", strtotime($row['SellDate'])),
            "VintageMonths" => calMonth($row['SellDate'], date('Y-m-d')),
            "OutletManager" => "",
        ];

        foreach ($weeks as $index => $range) {
            $from = date('Y-m') . '-' . $range['start'];
            $to = date('Y-m') . '-' . $range['end'];
            $records["Week" . ($index + 1) . "_Invoices"] = ftdRevenue($frid, $from, $to, '');
            $records["Week" . ($index + 1) . "_Amount"] = ftdRevenueAmt($frid, $from, $to, '');
        }

        // Fill missing Week 5 if not applicable
        if ($cal <= 28) {
            $records["Week5_Invoices"] = 0;
            $records["Week5_Amount"] = 0;
        }

        $data[] = $records;
    }

    echo json_encode([
        "status" => "success",
        "month" => date('F Y'),
        "records" => $data
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch weekly sale report: " . $e->getMessage()
    ]);
}
?>
