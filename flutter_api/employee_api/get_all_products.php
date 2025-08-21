<?php
include 'db.php';

$user_id = $_REQUEST['user_id'] ?? '';

$response = array();

if ($user_id != '') {
    $query = "SELECT * FROM tbl_cust_products_2025 WHERE CreatedBy = '$user_id' AND checkstatus=1 AND ProdType=0 AND ProdType2!=3";
    $result = mysqli_query($conn, $query);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    $response['status'] = true;
    $response['data'] = $data;
} else {
    $response['status'] = false;
    $response['message'] = 'User ID is required';
}

echo json_encode($response);
?>

