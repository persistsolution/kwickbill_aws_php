<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Stock";
$Page = "View-Available-Stock";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Stock List</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>
</head>
<body>

 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">





<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Preview Product Stock
    <span style="float: right;">
<a href="add-stock.php" class="btn btn-secondary btn-round"><i class="ion ion-md-add mr-2"></i> Add New</a></span>
</h4>

<div class="card" style="padding: 10px;">
      
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>#</th>
                <th>Quantity</th>
                <th>Company</th>
                <th>Category</th>
                <th>Model</th>
                 <th>Series</th>
                <th>Date</th>
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT ts.*,tc.Name AS Category,tsc.Name AS Brand FROM tbl_stocks ts 
                    LEFT JOIN tbl_category tc ON tc.id=ts.CatId 
                    LEFT JOIN tbl_sub_category tsc ON tsc.id=ts.BrandId WHERE ts.Status=1 AND ts.InvId='".$_GET['id']."'";
           
            $sql.=" GROUP BY ts.ModelNo ORDER BY ts.id DESC";    
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
               $sql2 = "SELECT SUM(Qty) As Qty FROM tbl_stocks WHERE ModelNo='".$row['ModelNo']."' AND BuyStatus=0 AND InvId='".$_GET['id']."'";
               $row2 = getRecord($sql2);
               if($row2['Qty'] == ''){
                    $Qty = 0;
               }
               else{
                    $Qty = $row2['Qty'];
               }

               $sql3 = "SELECT GROUP_CONCAT(ProductNo) AS ProductNo FROM `tbl_stocks` WHERE ModelNo='".$row['ModelNo']."' AND InvId='".$_GET['id']."'";
               $row3 = getRecord($sql3);
               if($row3['ProductNo'] != ''){
                    $ProductNo = $row3['ProductNo'];
               }
               else{
                    $ProductNo = "";
               }
             ?>
            <tr>
               <td><?php echo $i; ?></td>
                 <td><?php echo $Qty;?></td>
                <td><?php echo $row['Category']; ?></td>
               
              <td><?php echo $row['Brand']; ?></td>
              <td><?php echo $row['ModelNo']; ?></td>
              <td><?php echo $ProductNo; ?></td>
         <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
                <!--   <td><a href="javascript:void(0)" onclick="availableSeries(<?php echo $row['ModelNo']; ?>)" class="badge badge-pill badge-primary">Show</a></td> -->
           
              
            </tr>
           <?php $i++;} ?>
        </tbody>
    </table>
</div>
</div>
</div>



<?php include_once 'footer.php'; ?>

</div>

</div>

</div>

<div class="layout-overlay layout-sidenav-toggle"></div>
</div>


<?php include_once 'footer_script.php'; ?>

<script type="text/javascript">

    $(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            
            'pdfHtml5'
        ]
    });

  
});
</script>
</body>
</html>
