<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require_once '../config.php';

try {
    // $user_id = $_REQUEST['user_id'] ?? '';

    // if (empty($user_id)) {
    //     throw new Exception("user_id is required");
    // }

    // Get records where user_id field contains the given user_id (can be comma-separated values)
    $sql = "SELECT tsm.*,tm.title AS MenuName FROM tbl_sub_menu tsm INNER JOIN tbl_dynamic_menu tm ON tm.id=tsm.menuid ORDER BY tsm.srno ASC";
    $res = $conn->query($sql);

    $records = [];
    $i = 1;
    while ($row = $res->fetch_assoc()) {
        $records[] = [
            "SrNo" => $i++,
            "Menu" => $row['MenuName'],
            "UserId" => $row['user_id'],
            "Title" => $row['title'],
            "TableValues" => $row['table_values'],
            "Link" => $row['link'],
            "SrnoOrder" => $row['srno']
        ];
    }

    echo json_encode([
        "status" => "success",
        "records" => $records
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to fetch sub menu records: " . $e->getMessage()
    ]);
}
?>
