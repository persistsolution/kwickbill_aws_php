<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $user_id = $_REQUEST['user_id'] ?? '';

    if (empty($user_id)) {
        throw new Exception("user_id is required");
    }

    $sql = "SELECT tu.*, tut.Name AS RoleName, tu2.Fname AS UnderName
            FROM tbl_users_bill tu
            LEFT JOIN tbl_user_type tut ON tut.id = tu.Roll
            LEFT JOIN tbl_users tu2 ON tu.UnderUser = tu2.id
            WHERE tu.Roll IN (63) AND tu.BillSoftFrId = '$user_id'
            ORDER BY tu.CreatedDate DESC";

    $res = $conn->query($sql);

    $records = [];
    while ($row = $res->fetch_assoc()) {
       

        $records[] = [
            "id" => $row['id'],
            "Name" => $row['Fname'] . ' ' . $row['Lname'],
            "Designation" => $row['Designation'],
            "EmailId" => $row['EmailId'],
            "Phone" => $row['Phone'],
            "Phone2" => $row['Phone2'],
            "Address" => $row['Address'],
            "Status" => ($row['Status'] == '1' ? 'Approved' : 'Pending'),
            "RegisterDate" => date("d/m/Y", strtotime(str_replace('-', '/', $row['CreatedDate']))),
            "AadharNo" => $row['AadharNo'],
            "BloodGroup" => $row['BloodGroup'],
            "AccountName" => $row['AccountName'],
            "BankName" => $row['BankName'],
            "AccountNo" => $row['AccountNo'],
            "Branch" => $row['Branch'],
            "IfscCode" => $row['IfscCode'],
            "UpiNo" => $row['UpiNo']
            
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch employees: " . $e->getMessage()
    ]);
}
?>
