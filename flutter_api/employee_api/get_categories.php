<?php
include 'db.php';

$user_id = $_REQUEST['user_id'] ?? '';
//$user_id = 1;
$response = array();

if ($user_id != '') {
    $query = "SELECT tcc.id,tcc.Name FROM `tbl_cust_products_2025` tc 
    INNER JOIN tbl_cust_category_2025 tcc ON tc.CatId=tcc.id WHERE tc.CreatedBy='$user_id' AND tc.ProdType=0 AND tc.checkstatus=1 AND tc.ProdType2!=3 GROUP BY tc.CatId";
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
