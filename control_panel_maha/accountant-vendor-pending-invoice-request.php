<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Accountant-Vendor-Invoices";
$Page = "Accountant-Vendor-Peding-Invoice-Request";
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



<?php
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  $sql11 = "DELETE FROM tbl_vendor_expense_invoices WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="expense-request.php";
    </script>
<?php } 

if($_REQUEST['action'] == 'changestatus'){
    $id = $_REQUEST["id"];
    $val = $_REQUEST["val"];
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
    $sql3 = "SELECT * FROM tbl_vendor_expense_invoices WHERE id = '$id'";
    $row3 = getRecord($sql3);
    $UserId = $row3['UserId'];
    $Amount = $row3['Amount'];
    if($val == 0){
        $sql = "UPDATE tbl_vendor_expense_invoices SET Status=1 WHERE id='$id'";
        $conn->query($sql);
        $sql2 = "INSERT INTO wallet SET ExpId='$id',UserId='$UserId',Amount='$Amount',Narration='Expense Amount Approved',Status='Dr',CreatedDate='$CreatedDate',CreatedTime='$CreatedTime'";
        $conn->query($sql2);
    }
    else{
        $sql = "UPDATE tbl_vendor_expense_invoices SET Status=0 WHERE id='$id'";
        $conn->query($sql);
        $sql2 = "DELETE FROM wallet WHERE ExpId='$id'";
        $conn->query($sql2);
    }
 ?>
    <script type="text/javascript">
      alert("Record Saved Successfully");
      window.location.href="expense-request.php";
    </script>
<?php   
}
?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Accountant Pending Vendor Payment Request
  
</h4>

<div class="card" style="padding: 10px;">
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                
                 <th>Expense Id</th>
                    <th>Expense Date</th>
                   <!--  <th>Admin Approve</th> -->
                   <th>Accoutant Approve</th>
                  <th>Admin Approve</th>
               <th>Photo</th>
                <th>Vendor Name</th>
                <th>Claims</th>
                 <th>Franchise</th>
                 <th>Locations</th>
               
                <th>Amount</th>
                <th>PaymentMode</th>
                <th>Narration</th>
                 <th>Receipt</th>
                <th>Payment Receipt</th>
              <th>Pdf File</th>
               <th>Product Image</th>
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
          
         
               $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tec.Name As ExpCatName,tub.ShopName,tl.Name AS ExpLocation FROM tbl_vendor_expense_invoices te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_expenses_category tec ON tec.id=te.ExpCatId 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.FrId 
                LEFT JOIN tbl_locations tl ON tl.id=te.Locations WHERE te.ManagerStatus='0' AND te.UserId!=0"; 
            /*if($user_id == 1322){
              $sql.=" AND te.Amount<=5000";
          }*/
            if($Roll != 1){
                $sql.=" AND te.UserId!='$user_id'";
            }
            /*if($ExpCatId!=''){
                $sql.=" AND te.ExpCatId IN($ExpCatId)";
            }*/
            $sql.=" ORDER BY te.ExpenseDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                    $MgrName = $row['MgrName'];
                    if($row['Claims'] == 1){
                        $claimname = "Regular Claims";
                    }
                    else{
                        $claimname = "New Execution";
                    }
               
             ?>
            <tr>
                

<td><?php echo $row['id'];?></td>
  <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ExpenseDate']))); ?></td>
   
 <td id="showstatus<?php echo $row['id']; ?>"><a href="approve-vendor-invoices-by-accoutant.php?id=<?php echo $row['id']; ?>&page=ho"><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName </span>";} else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName</span>";} else {?>
 Approve By Manager<?php } ?></a><br>
  <!--<a href="javascript:void(0)" id="add_button<?php echo $row['id']; ?>" onclick="getExpenseVal(<?php echo $row['id']; ?>)">Approve By Popup</a>-->
  </td>
<td></td>
               <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
               <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
               <td><?php echo $claimname;?></td>
              
               <td><?php echo $row['ShopName'];?></td>
               <td><?php echo $row['ExpLocation'];?></td>
             
                
                <td><?php echo $row['Amount']; ?></td>
               <td><?php echo $row['PaymentMode']; ?></td>
                  <td><?php echo $row['Narration']; ?></td>
              <td><?php if($row["Photo"] == '') {?>
                  <span style="color:red;">No Receipt Found</span>
                 <?php } else if(file_exists('../uploads/'.$row["Photo"])){?>
                 <a href="../uploads/<?php echo $row["Photo"];?>" target="_blank">View Receipt</a>
                  <?php }  else{?>
                <span style="color:red;">No Receipt Found</span>
             <?php } ?></td>
             
              <td><?php if($row["Photo2"] == '') {?>
                  <span style="color:red;">No Receipt Found</span>
                 <?php } else if(file_exists('../uploads/'.$row["Photo2"])){?>
                 <a href="../uploads/<?php echo $row["Photo2"];?>" target="_blank">View Receipt</a>
                  <?php }  else{?>
                <span style="color:red;">No Receipt Found</span>
             <?php } ?></td>
             
             <td><?php if($row["Photo3"] == '') {?>
                  <span style="color:red;">No Pdf Found</span>
                 <?php } else if(file_exists('../uploads/'.$row["Photo3"])){?>
                 <a href="../uploads/<?php echo $row["Photo3"];?>" target="_blank">View Pdf</a>
                  <?php }  else{?>
                <span style="color:red;">No Pdf Found</span>
             <?php } ?></td>
             
             <td><?php if($row["Photo4"] == '') {?>
                  <span style="color:red;">No Image Found</span>
                 <?php } else if(file_exists('../uploads/'.$row["Photo4"])){?>
                 <a href="../uploads/<?php echo $row["Photo4"];?>" target="_blank">View Image</a>
                  <?php }  else{?>
                <span style="color:red;">No Image Found</span>
             <?php } ?></td>
                     
                
              
           
           
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
        order: [[0, 'desc']]
    });
    });
</script>
</body>
</html>
