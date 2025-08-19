<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$MainPage="Dashboard";
$Page = "Dashboard";
$user_id = $_SESSION['Admin']['id'];
$sql77 = "SELECT * FROM tbl_users WHERE id='$user_id'";
$row77 = getRecord($sql77);
$Roll = $row77['Roll'];
$UserCat = $row77['CatId'];
$Options = explode(',',$row77['Options']);
if($Roll == 1 || $Roll == 7){}
else{
    // echo "<script>window.location.href='dashboard2.php';</script>";
    // exit();
}

/*function RandomStringGenerator($n)
{
    $generated_string = "";   
    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $len = strlen($domain);
    for ($i = 0; $i < $n; $i++)
    {
        $index = rand(0, $len - 1);
        $generated_string = $generated_string . $domain[$index];
    }
    return $generated_string;
} 
$n = 10;


$sql = "SELECT id FROM `tbl_users` WHERE Roll=5";
$row = getList($sql);
foreach($row as $result){
    $CreatedBy = $result['id'];
   
    $Code = RandomStringGenerator($n); 
    $Code2 = $Code."".$result2['id'];
    $sql3 = "INSERT INTO tbl_cust_products (ProductName,CatId,CgstPer,SgstPer,IgstPer,GstAmt,ProdPrice,MinPrice,Status,SrNo,Photo,CreatedBy)
        SELECT ProductName,CatId,CgstPer,SgstPer,IgstPer,GstAmt,ProdPrice,MinPrice,Status,SrNo,Photo,'$CreatedBy' FROM `tbl_cust_products` WHERE CreatedBy=0";
        $conn->query($sql3);
}


$sql = "SELECT * FROM tbl_cust_products WHERE code is null";
$row = getList($sql);
foreach($row as $result){
    $Code = RandomStringGenerator($n); 
    $Code2 = $Code."".$result['id'];
     $sql2 = "UPDATE tbl_cust_products SET code='$Code2' WHERE id='".$result['id']."'";
    $conn->query($sql2);
  
}*/
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />
    <?php include_once 'header_script.php'; ?>
</head>

<body>
    <style type="text/css">
    .mr_5 {
        margin-right: 3rem !important;
    }
    h6, .h6 {
    font-size: 12px;
}
    </style>
 <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

        <?php include_once 'top_header.php'; include_once 'admin-sidebar2.php'; ?>


            <div class="layout-container">

             


                <div class="layout-content">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                        </div>

<div class="row">
                             
                            
               
                          <!-- Staustic card 2 Start -->
                      
                            
                           <div class="col-sm-6 col-xl-3">
                                <a href="view-orders.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3" style="background: #ff8b69;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql4 = "SELECT * FROM orders WHERE Type='Cart' AND PayStatus=1";
                                                            echo $rncnt4 = getRow($sql4);

                                                        ?></h2>
                                        <h6 class="mb-0">Total Orders</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            
                            <div class="col-sm-6 col-xl-3">
                                <a href="today-orders.php">
                               <div class="card bg-success text-white ui-hover-icon mb-4 bg-pattern-3">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql4 = "SELECT * FROM orders WHERE OrderDate='".date('Y-m-d')."' AND Type='Cart' AND PayStatus=1";
                                                            echo $rncnt4 = getRow($sql4);

                                                        ?></h2>
                                        <h6 class="mb-0">Today Orders</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>

                          
                          
                            
 <div class="col-sm-6 col-xl-3">
                                <a href="view-products.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #ef8080;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql = "SELECT * FROM tbl_products";
                                                            echo $rncnt = getRow($sql);

                                                        ?></h2>
                                        <h6 class="mb-0">Total Products</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                  <a href="view-customers.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #1fb1aa;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql2 = "SELECT * FROM tbl_users WHERE Roll=5";
                                                            echo $rncnt2 = getRow($sql2);

                                                        ?></h2>
                                        <h6 class="mb-0">Total Franchise</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                             
                            
                            <div class="col-sm-6 col-xl-3">
                                  <a href="view-employee.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #8d9fd0;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_users WHERE Roll NOT IN(1,5,55,9,22,23)";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Total Employee</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            
                            
                            
                           
                           <div class="col-sm-6 col-xl-3">
                                <a href="lead-aprroval.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3" style="background: #ff8b69;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql4 = "SELECT * FROM tbl_bp_leads WHERE CreatedDate='".date('Y-m-d')."'";
                                                            echo $rncnt4 = getRow($sql4);

                                                        ?></h2>
                                        <h6 class="mb-0">Today Leads</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                <a href="lead-aprroval.php">
                               <div class="card bg-success text-white ui-hover-icon mb-4 bg-pattern-3">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql4 = "SELECT * FROM tbl_bp_leads";
                                                            echo $rncnt4 = getRow($sql4);

                                                        ?></h2>
                                        <h6 class="mb-0">Total Leads</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="view-freelancer.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3" style="background: #ef8080;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_users WHERE Roll IN (9,22,23) AND CreatedDate='".date('Y-m-d')."'";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Today Business partners</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                          
                          
                              <div class="col-sm-6 col-xl-3">
                                 <a href="view-freelancer.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #1fb1aa;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_users WHERE Roll IN (9,22,23)";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Total Business partners</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="#">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background:#8d9fd0;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_expense_request WHERE CreatedDate='".date('Y-m-d')."'";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Today Expense Request</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="#">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background:#8d9fd0;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_expense_request ";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Total Expense Request</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="manager-pending-expense-request.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #ff8b69;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_expense_request WHERE ManagerStatus='0' AND UserId!=0 AND AdminStatus=0";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Manager Pending Expense Request</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="manager-approve-expense-request.php">
                               <div class="card bg-success text-white ui-hover-icon mb-4 bg-pattern-3" >
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_expense_request WHERE ManagerStatus='1' AND UserId!=0";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Manager Approved Expense Request</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="manager-reject-expense-request.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #b5cd70;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_expense_request WHERE ManagerStatus='2' AND UserId!=0";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Manager Rejected Expenses Request</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="account-pending-expense-request.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #ff8b69;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_expense_request WHERE AdminStatus=0 AND UserId!=0 AND ManagerStatus=1";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Accountant Pending Expense Request</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="account-approve-expense-request.php">
                               <div class="card bg-success text-white ui-hover-icon mb-4 bg-pattern-3" >
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_expense_request WHERE AdminStatus=1 AND UserId!=0 AND ManagerStatus=1";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Accountant Approved Expense Request</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="account-reject-expense-request.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #b5cd70;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_expense_request WHERE AdminStatus=2 AND UserId!=0 AND ManagerStatus=1";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Accountant Rejected Expenses Request</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="amount-request.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #1fb1aa;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_withdraw_request";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Withdrawal Request</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="view-complaints.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #b5cd70;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_helps_enquiry WHERE TokenNo!=''";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Total Complaints</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="view-complaints.php?Status=1">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #b5cd70;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_helps_enquiry WHERE TokenNo!='' AND Status=1";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Pending Complaints</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="view-complaints.php?Status=2">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #b5cd70;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_helps_enquiry WHERE TokenNo!='' AND Status=2";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">In Process Complaints</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="view-complaints.php?Status=3">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #b5cd70;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_helps_enquiry WHERE TokenNo!='' AND Status=3";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Reject Complaints</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="view-complaints.php?Status=4">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #b5cd70;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_helps_enquiry WHERE TokenNo!='' AND Status=4";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Completed Complaints</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-3">
                                 <a href="view-assets.php">
                               <div class="card  text-white ui-hover-icon mb-4 bg-pattern-3"  style="background: #b5cd70;">
                                        <div class="card-body text-center">
                                          <h2><?php  
                                                            $sql3 = "SELECT * FROM tbl_assets";
                                                            echo $rncnt3 = getRow($sql3);

                                                        ?></h2>
                                        <h6 class="mb-0">Total Assets</h6>
                                        <i class="lnr lnr-users hov-icon"></i>
                                     </div>
                                </div></a>
                            </div>
                            
                            
                    </div>
                        

<!--<div class="card" style="padding: 10px;">
    <h4 class="font-weight-bold py-3 mb-0">Recent Expense Request
  
</h4>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                
                 
                   <th>Manager Approve</th>
                    <th>Admin/Account Approve</th>
               <th>Photo</th>
                <th>Employee Name</th>
                
                <th>Amount</th>
                <th>PaymentMode</th>
                <th>Narration</th>
                 <th>Receipt</th>
               
                <th>Expense Date</th>
               
                
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_expense_request te 
                LEFT JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                ORDER BY te.CreatedDate DESC LIMIT 10";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                    $MgrName = $row['MgrName'];
               
             ?>
            <tr>
                

 
 <td><?php if($row['ManagerStatus']=='1'){ echo "<span style='color:green;'>Approved<br>By $MgrName </span>";} else if($row['ManagerStatus']=='2'){ echo "<span style='color:red;'>Rejected <br> By $MgrName</span>";} else {?>
 <a href="approve-expense-by-manager.php?id=<?php echo $row['id']; ?>">Approve By Manager</a><?php } ?></td>
 
  <td><?php if($row['Status']=='1'){echo "<span style='color:green;'>Approved</span>";} else { echo "<span style='color:red;'>Pending</span>";} ?></td>
               <td> <?php if($row["Uphoto"] == '') {?>
                  <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../uploads/'.$row["Uphoto"])){?>
                 <img src="../uploads/<?php echo $row["Uphoto"];?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="user_icon.jpg" class="d-block ui-w-40 rounded-circle" style="width: 40px;height: 40px;"> 
             <?php } ?></td>
               <td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
              
                
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
                     
                
              
            <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['ExpenseDate']))); ?></td>
           
            </tr>
           <?php } ?>
        </tbody>
    </table>
</div>
</div>



<br>

<div class="card" style="padding: 10px;">
    <h4 class="font-weight-bold py-3 mb-0">Today Orders List</h4>
<div class="card-datatable table-responsive">
<table id="example2" class="table table-striped table-bordered" style="width:100%">
       <thead>
<tr>
<th>Order ID</th>
<th>Customer Name</th>
<th>Order Date</th>
<th>Payment Mode</th>

<th>Sub Price</th>
<th>Discount</th>
<th>Total Price</th>

<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 
$currdate = date('Y-m-d');
 $sql2 = "SELECT ord.*,c.Fname,c.Lname,os.Name As OrderStatus,pm.Name As Payment_Method FROM orders ord 
         LEFT JOIN payment_method pm ON pm.id=ord.PaymentMethod 
         LEFT JOIN order_status os ON os.id=ord.OrderProcess
         LEFT JOIN tbl_users c ON c.id=ord.UserId WHERE ord.OrderDate='$currdate' AND ord.Type='Cart' AND ord.PayStatus=1";
       
  $sql2.= " ORDER BY ord.srno DESC";
  //echo $sql2;
    $res2 = $conn->query($sql2);
    $row_cnt = mysqli_num_rows($res2);
    if($row_cnt > 0){
    while($row = $res2->fetch_assoc()){
      if($row['DeliveryMethod'] == 1){
          $DeliveryMethod = "Home Delivery";
        }
        else if($row['DeliveryMethod'] == 2){
          $DeliveryMethod = "Pickup By Store";
        }
        else{
          $DeliveryMethod = "-";
        }

        if($row['PaStatus'] == 1){
          $bgcolor = "background-color: #daf8da;";
        }
        else{
          $bgcolor = "background-color: #fff2f2;";
        }
     ?>
<tr style="<?php echo $bgcolor;?>">
  <td><?php echo $row['OrderNo']; ?></td>
<td><?php echo $row['Fname']." ".$row['Lname']; ?></td>
 <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['OrderDate'])))."<br>".$row['OrderTime'];?></td>
<td><?php echo $row['Payment_Method']; ?></td>

<td>&#8377;<?php echo number_format($row["OrderTotal"],2); ?></td>
<td>&#8377;<?php echo number_format($row["Discount"],2); ?></td>
<td>&#8377;<?php echo number_format($row["OrderTotal"]-$row["Discount"],2); ?></td>

<td><?php if($row['OrderProcess']=='2') {?>
<span class="badge badge-warning">In Progress</span>
<?php } else if($row['OrderProcess']=='3') {?>  
<span class="badge badge-danger">Canceled</span>
<?php } else if($row['OrderProcess']=='4') {?>  
<span class="badge badge-warning">Confirmed</span>
<?php } else if($row['OrderProcess']=='5') {?>  
<span class="badge badge-info">Dispatch</span>
<?php } else{?> 
<span class="badge badge-success">Delivered</span>
<?php } ?>
</td>
<td><div class="card-header-elements ml-auto">
<div class="btn-group">
<button type="button" class="btn btn-sm btn-default icon-btn borderless btn-round md-btn-flat dropdown-toggle hide-arrow" data-toggle="dropdown" aria-expanded="false"><i class="ion ion-ios-more"></i></button>
<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: top, left; top: 25px; left: 25px;">
<a href="order-details.php?oid=<?php echo $row['id']; ?>" class="dropdown-item"><i class="lnr lnr-eye mr-2 text-muted"></i> &nbsp; Information</a>

<a href="order-invoice.php?oid=<?php echo $row['id']; ?>" class="dropdown-item" target="_blank"><i class="ion ion-md-print mr-2 text-muted"></i> &nbsp; Print Invoice</a>

<a href="<?php echo $_SERVER['PHP_SELF']; ?>?oid=<?php echo $row['id']; ?>&action=delete" onClick="return confirm('Are you sure you want delete this Order?');" class="dropdown-item"><i class="feather icon-trash text-muted"></i> &nbsp; Remove</a>
</div>
</div>
</div></td>
</tr>
<?php }} ?>

</tbody>
    </table>
</div>
</div>-->
</div>

                    



                <?php include_once 'footer.php'; ?>

            </div>

        </div>

    </div>

    <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>


    <?php include_once 'footer_script.php'; ?>
    
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    

  
<script type="text/javascript">
 function take_action(id,url){
     //alert(url);
     setTimeout(function() {
        window.open(
            url+'?id=' + id, 'stickerPrint',
            'toolbar=1, scrollbars=1, location=1,statusbar=0, menubar=1, resizable=1, width=800, height=800,left=250,top=50,right=50'
        );
    }, 1);
 
 }

 function getDiapostion(catid){
            var action = "getDiapostion";
            $.ajax({
                url: "ajax_files/ajax_dropdown.php",
                method: "POST",
                data: {
                    action: action,
                    id: catid
                },
                success: function(data) {
                    $('#Diaposition').html(data);
                  
                }
            });
 }
    $(document).ready(function() {
    $('#example').DataTable({
      "scrollX": true,
        "pageLength":50,
        scrollY: '400px',
        scrollCollapse: true
    });
    
    $('#example2').DataTable({
      "scrollX": true,
        "pageLength":50,
        scrollY: '400px',
        scrollCollapse: true
    });

    $(document).on("change", "#CatId", function(event) {
            var val = this.value;
            getDiapostion(val);
            var action = "getServices";
            $.ajax({
                url: "ajax_files/ajax_dropdown.php",
                method: "POST",
                data: {
                    action: action,
                    id: val
                },
                success: function(data) {
                    $('#Services').html(data);
                  
                }
            });

        });
});
</script>
</body>

</html>