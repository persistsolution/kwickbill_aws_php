<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../config.php';

try {
    // Optional filters from POST/REQUEST
    $OwnFranchise = $_REQUEST['OwnFranchise'] ?? '';
    $FromDate = $_REQUEST['FromDate'] ?? '';
    $ToDate = $_REQUEST['ToDate'] ?? '';

    $sql = "SELECT tu.*, tut.Name AS User_Type 
            FROM tbl_users_bill tu 
            LEFT JOIN tbl_user_type tut ON tu.UserType = tut.id 
            WHERE tu.Roll = 5";

    if (!empty($OwnFranchise)) {
        if ($OwnFranchise !== 'all') {
            $sql .= " AND tu.OwnFranchise = '" . $conn->real_escape_string($OwnFranchise) . "'";
        }
    }

    if (!empty($FromDate)) {
        $sql .= " AND tu.CreatedDate >= '" . $conn->real_escape_string($FromDate) . "'";
    }

    if (!empty($ToDate)) {
        $sql .= " AND tu.CreatedDate <= '" . $conn->real_escape_string($ToDate) . "'";
    }

    $sql .= " ORDER BY tu.id DESC";

    $res = $conn->query($sql);

    if (!$res) {
        throw new Exception("Database error: " . $conn->error);
    }

    $records = [];
    while ($row = $res->fetch_assoc()) {
        $records[] = [
            "FranchiseId" => $row['id'],
            "FranchiseName" => $row['Fname'] . ' ' . $row['Lname'],
            "ShopName" => $row['ShopName'],
            "FranchiseType" => $row['OwnFranchise'] == '1' ? 'COCO Franchise' : ($row['OwnFranchise'] == '2' ? 'FOFO Franchise' : 'Other Franchise'),
            "ContactNo" => trim($row['Phone'] . ' ' . $row['Phone2']),
            "Password" => $row['Password'],
            "Status" => $row['Status'] == '1' ? 'Approved' : 'Pending',
            "RegisterDate" => date("d/m/Y", strtotime(str_replace('-', '/', $row['CreatedDate'])))
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
