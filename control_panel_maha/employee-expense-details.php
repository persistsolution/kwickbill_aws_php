<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Expense-Request";
$Page = "Expense-Request";
/*$sql = "SELECT GROUP_CONCAT(id) AS ids
FROM tbl_expense_request
WHERE Narration LIKE '%''%'";
$row = getRecord($sql);
echo $row['ids'];*/
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Raw Stock
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />

    <?php include_once 'header_script.php'; ?>
    <script src="ckeditor/ckeditor.js"></script>
</head>

<body>
  <style type="text/css">
    .password-tog-info {
        display: inline-block;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        position: absolute;
        right: 50px;
        top: 30px;
        text-transform: uppercase;
        z-index: 2;
    }
    
    table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 5px;
}
    </style>
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

             <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


            <div class="layout-container">

                

                <?php 
$id = $_GET['id']; 
$val = $_GET['val'];
$sql7 = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto FROM tbl_expense_request te LEFT JOIN tbl_users tu ON tu.id=te.UserId WHERE te.id='$id'";
$row7 = getRecord($sql7);
$EmpId = $row7['UserId'];

$sql88 = "SELECT SUM(creditAmt) As Credit,SUM(debitAmt) As Debit FROM (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as creditAmt,(case when Status='Dr' then sum(Amount) else 0 end) as debitAmt FROM wallet WHERE UserId='$EmpId' GROUP BY Status) as a";
    $row88 = getRecord($sql88);
    $WalletBal = $row88['Credit'] - $row88['Debit'];

?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Employee Expense Details</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <input type="hidden" name="UserId" value="<?php echo $EmpId;?>" id="UserId">
                                    <div class="form-row">
                                    
                                     
 <div class="form-group col-md-2">
                                            <label class="form-label">Expense Id</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7['id']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
 <div class="form-group col-md-6">
                                            <label class="form-label">Employee Name</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7['Fname']." ".$row7['Lname']; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-4">
                                            <label class="form-label">Wallet Amount</label>
                                            <input type="text" class="form-control" id="WalletBal"
                                                placeholder="" value="<?php echo $WalletBal; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-3">
                                            <label class="form-label">Expense Amount</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["Amount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Manager Approve Amount</label>
                                            <input type="text" name="MgrAmount" class="form-control"
                                                placeholder="" value="<?php echo $row7["MgrAmount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Admin Approve Amount</label>
                                            <input type="text" name="AccAmount" class="form-control"
                                                placeholder="" value="<?php echo $row7["Amount"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class="form-label">Expense Date</label>
                                            <input type="date" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["ExpenseDate"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-8">
                                            <label class="form-label">Expense For</label>
                                            <input type="text" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["Narration"]; ?>" readonly>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        
                            
                               <div class="form-group col-md-4">
                                    <label class="form-label">Franchise</label>
                               <select class="form-control" disabled>
<option selected="" value="0" <?php if($row7["FrId"] == 0) {?> selected <?php } ?>>MAHA CHAI PVT LTD KHAMALA Branch (Main)</option>
 

 <?php 
    $sql33 = "SELECT * FROM `tbl_users_bill` WHERE Roll=5 AND ShopName!=''";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($row7["FrId"] == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['ShopName']." (".$result['Phone'].")";?></option>
     <?php } ?>
</select>
                                  
                            </div>
                        
                        
                         </div>

 <?php 
                                        $sql2 = "SELECT tve.* FROM tbl_expense_request_items tve WHERE tve.ExpId='".$_GET['id']."'";
                                        $rncnt2 = getRow($sql2);
                                        if($rncnt2 > 0){?>
                                        <br>
                                            <div class="form-row">
    <h5 style="font-size: 15px;color: blue;padding-left: 10px;">Expenses</h5>
<table>
  <tr>
    <th>Sr.No</th>
    <th>Amount</th>
    <th>Expense Date</th>
    <th>Expense Category</th>
    <th>Payment Type</th>
    <th>Vendor Mobile No</th>
    <th>Narration</th>
    <th>GST</th>
   <th>Receipt</th>
    <th>Payment Receipt</th>
    <th>Attach PDF</th>
    <th>Product Image</th>
    <th>Download PDF</th>
    
  </tr>
  <?php 
  $i=1;
  
  $row2 = getList($sql2);
  foreach($row2 as $result){
    $sql_11 = "SELECT Name FROM tbl_expenses_category WHERE id='".$result['ExpCatId']."'";
    $row_11 = getRecord($sql_11);
  ?>
 <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $result['Amount'];?></td>
    <td><?php echo $result['ExpenseDate'];?></td>
    <td><?php echo $row_11['Name'];?></td>
    <td><?php echo $result['PaymentMode'];?></td>
    <td><?php echo $result['VedPhone'];?></td>
    <td><?php echo $result['Narration'];?></td>
    <td><?php echo $result['Gst'];?></td>
    <td><?php if($result["Photo"] == '') {?>
                  <span style="color:red;">No Receipt Found</span>
                 <?php } else if(file_exists('../expense_files/'.$result["Photo"])){?>
                 <a href="../expense_files/<?php echo $result["Photo"];?>" target="_blank">View Receipt</a>
                  <?php }  else{?>
                <span style="color:red;">No Receipt Found</span>
             <?php } ?></td>
             
              <td><?php if($result["Photo2"] == '') {?>
                  <span style="color:red;">No Receipt Found</span>
                 <?php } else if(file_exists('../expense_files/'.$result["Photo2"])){?>
                 <a href="../expense_files/<?php echo $result["Photo2"];?>" target="_blank">View Receipt</a>
                  <?php }  else{?>
                <span style="color:red;">No Receipt Found</span>
             <?php } ?></td>
             
              <td><?php if($result["Photo3"] == '') {?>
                  <span style="color:red;">No File Found</span>
                 <?php } else if(file_exists('../expense_files/'.$result["Photo3"])){?>
                 <a href="../expense_files/<?php echo $result["Photo3"];?>" target="_blank">View File</a>
                  <?php }  else{?>
                <span style="color:red;">No File Found</span>
             <?php } ?></td>
             
             <td><?php if($result["Photo4"] == '') {?>
                  <span style="color:red;">No Image Found</span>
                 <?php } else if(file_exists('../expense_files/'.$result["Photo4"])){?>
                 <a href="../expense_files/<?php echo $result["Photo4"];?>" target="_blank">View Image</a>
                  <?php }  else{?>
                <span style="color:red;">No Image Found</span>
             <?php } ?></td>
             
             <td><?php if($result['PdfLink']==''){?>
              <span style="color:red;">No PDF Found</span>
              <?php } else {?>
                 <a href="<?php echo $result['PdfLink'];?>" target="_blank">Download</a>
                 <?php } ?>
                 </td>
             <td><a href="view-expense-product-list.php?expid=<?php echo $_GET['id'];?>&expitemid=<?php echo $result['id'];?>" target="_blank">View Products</a></td>
                     
  </tr>
  <?php $i++;} ?>
</table>
                                            </div>

<?php } ?>


 <?php 
                                        $sql2 = "SELECT tve.*,tcp.ProductName FROM tbl_emp_expense_prod_items tve INNER JOIN tbl_cust_products2 tcp ON tcp.id=tve.MainProdId WHERE tve.ExpId='".$_GET['id']."'";
                                        $rncnt2 = getRow($sql2);
                                        if($rncnt2 > 0){?>
                                        <br>
                                            <div class="form-row">
    <h5 style="font-size: 15px;color: blue;padding-left: 10px;">All Expense Products</h5>
<table>
  <tr>
            <th>Sr.No</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Purchase Price (Per Qty)</th>
            <th>Total Price</th>
        </tr>
  <?php 
  $i=1;
  
  $row2 = getList($sql2);
  foreach($row2 as $result){
  $total = $result['Qty2'] * $result['PurchasePrice'];
            $grandTotal += $total;
  ?>
  <tr>
    <td><?php echo $i;?></td>
   <td><?php echo $result['ProductName']; ?></td>
            <td><?php echo $result['Qty2'] . " " . $result['Unit2']; ?></td>
            <td><?php echo $result['PurchasePrice']; ?></td>
            <td><?php echo round($total); ?></td>
  
                     
  </tr>
  <?php $i++;} ?>
  <tfoot>
        <tr>
            <td colspan="4" style="text-align: right;"><strong>Grand Total:</strong></td>
            <td><strong><?php echo round($grandTotal); ?></strong></td>
        </tr>
    </tfoot>
</table>
                                            </div>
<br>
<?php } ?>

<div class="row">
<div class="form-group col-md-6">
                                            <label class="form-label">Receipt</label><br>
                                         <?php if($row7['Photo'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo']; ?>" target="_blank"><img src="../uploads/<?php echo $row7['Photo']; ?>"  style="height:100px;"></a><?php } ?>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Payment Receipt</label><br>
                                            <?php if($row7['Photo2'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo2']; ?>" target="_blank"><img src="../uploads/<?php echo $row7['Photo2']; ?>" style="height:100px;"></a><?php } ?>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                         <div class="form-group col-md-6">
                                            <label class="form-label">Upload PDF</label><br>
                                            <?php if($row7['Photo3'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo3']; ?>" target="_blank">Download Pdf</a><?php } ?>
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Upload Product Image</label><br>
                                            <?php if($row7['Photo4'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo4']; ?>" target="_blank"><img src="../uploads/<?php echo $row7['Photo4']; ?>" style="height:100px;"></a><?php } ?>
                                            <div class="clearfix"></div>
                                        </div>

  </div>


                               </div>


 <div class="col-lg-5" id="emidetails" style="display:none;">
    

 </div>

  
                                

 </div>
 </form>





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
     function checkWalletBal(){
         var UserId = $('#UserId').val();
         
         var action = "checkWalletBal";
            $.ajax({
                url: "ajax_files/ajax_wallet.php",
                method: "POST",
                data: {
                    action: action,
                    UserId: UserId
                    
                },
                success: function(data) {
                  //alert(data);
                  //console.log(data);
                    $('#WalletBal').val(data);
                }
            });
     }
     
      $(document).ready(function() {
   setInterval(function(){  
           checkWalletBal();
        }, 1000);
    });
 </script>
</body>

</html>