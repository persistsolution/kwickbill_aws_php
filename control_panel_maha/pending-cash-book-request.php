<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Cash-Book";
$Page = "Pending-Cash-Book-Request";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> </title>
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
<h4 class="font-weight-bold py-3 mb-0">Pending Cash Book Request
  
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Cash Book Id</th>
               
                  <th>Admin Approve</th>
              
                <th>Franchise Name</th>
                <th>Mobile No</th>
                <th>Amount</th>
                <th>Upload Date</th>
                 <th>Transfer Date</th>
                <th>Narration</th>
                 <th>Receipt</th>
                
                 <th>Bank Name</th>
                  <th>Account No</th>
               
               
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
           
            $sql = "SELECT tcb.*,tu.ShopName,tu.Phone FROM tbl_cash_book tcb INNER JOIN tbl_users tu On tu.id=tcb.FrId WHERE tcb.ApproveStatus=0";
            $sql.=" ORDER BY tcb.CreatedDate DESC";

            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
             ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                
                
  <td id="showstatus<?php echo $row['id']; ?>"><?php if($row['ApproveStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $AccName </span>";} else if($row['ApproveStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $AccName </span>";} else {?>
<a href="approve-cash-book-by-admin.php?id=<?php echo $row['id']; ?>" style="color:orange;">Pending By Accountant</a><br>
 <?php } ?>
 
 </td>
 
              
               <td><a href="fr-bill-outstanding.php?Search=Search&UserId=<?php echo $row['FrId']; ?>" target="_blank"><?php echo $row['ShopName']; ?></a></td>
              <td><?php echo $row['Phone']; ?></td>
                
                <td><?php echo $row['Amount']; ?></td>
               <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
              <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['TransferDate']))); ?></td>
                  <td><?php echo $row['Narration']; ?></td>
              <td><?php if($row["Files"] == '') {?>
                  <span style="color:red;">No Receipt Found</span>
                 <?php } else if(file_exists('../uploads/'.$row["Files"])){?>
                 <a href="../uploads/<?php echo $row["Files"];?>" target="_blank">View Receipt</a>
                  <?php }  else{?>
                <span style="color:red;">No Receipt Found</span>
             <?php } ?></td>
             
            <td><?php echo $row['BankName']; ?></td>
            <td><?php echo $row['AccountNo']; ?></td>
          
           
            </tr>
            
            
           <?php } ?>
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
<script>
    $(document).ready(function() {
    $('#example').DataTable({
    });
    });
</script>

</body>
</html>
