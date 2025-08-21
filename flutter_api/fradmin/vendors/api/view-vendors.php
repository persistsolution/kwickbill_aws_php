<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../../config.php';

try {
    $sql = "SELECT tu.* FROM tbl_users tu WHERE tu.Roll = 3 ORDER BY tu.CreatedDate DESC";
    $res = $conn->query($sql);

    $records = [];

    while ($row = $res->fetch_assoc()) {
        // Determine photo URL or default
        
        $records[] = [
           
            "VendorName" => trim($row['Fname'] . " " . $row['Lname']),
            "ContactNo" => trim($row['Phone']) . (empty($row['Phone2']) ? '' : ' / ' . trim($row['Phone2'])),
            "EmailId" => $row['EmailId'],
            "Address" => $row['Address'],
            "Status" => $row['Status'] == '1' ? 'Approved' : 'Pending',
            "RegisterDate" => date("d/m/Y", strtotime($row['CreatedDate'])),
            
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch vendor records: " . $e->getMessage()
    ]);
}
?>
