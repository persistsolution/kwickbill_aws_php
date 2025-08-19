<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Sell";
$Page = "Add-Sell";
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
</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] Ebd -->

    <!-- [ Layout wrapper ] Start -->
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">
            <!-- [ Layout sidenav ] Start -->
              <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>
            <!-- [ Layout sidenav ] End -->
            <!-- [ Layout container ] Start -->
            <div class="layout-container">
                <!-- [ Layout navbar ( Header ) ] Start -->
                 
                <!-- [ Layout navbar ( Header ) ] End -->

<?php  
$id = $_GET['id'];
$sql7 = "SELECT tu.*,tb.Name As BranchName,ts.Name As Scheme,tc.Name As Country,ts2.Name As State,tc2.Name As City,tut.Name AS UserRoll FROM tbl_users tu 
LEFT JOIN tbl_user_type tut ON tut.id=tu.Roll 
         LEFT JOIN tbl_branch tb ON tu.BranchId=tb.id 
         LEFT JOIN tbl_scheme ts ON tu.SchemeId=ts.id 
         LEFT JOIN tbl_country tc ON tu.CountryId=tc.id 
         LEFT JOIN tbl_state ts2 ON tu.StateId=ts2.id 
         LEFT JOIN tbl_city tc2 ON tu.CityId=tc2.id WHERE tu.id='$id'";
$row7 = getRecord($sql7);
if($row7['Roll'] == 5){
    $Roll = "Franchise";
}
if($row7['Roll'] == 55){
    $Roll = "Customer";
}
if($row7['Roll'] == 6){
    $Roll = "Service Manager";
}
if($row7['Roll'] == 20){
    $Roll = "Flexi Manager";
}
if($row7['Roll'] == 2){
    $Roll = "Flexi Manager";
}
if($row7['Roll'] == 9){
    $Roll = "Freelancer";
}
function commonMaster($id){
    global $conn;
    $sql = "SELECT * FROM tbl_common_master WHERE id='$id'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    return $row['Name'];
}

$sql11x = "select sum(debit) as debit,sum(credit) as credit from (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as credit,(case when Status='Dr' then sum(Amount) else 0 end) as debit FROM wallet WHERE UserId='$id' group by Status) as a";
$row11x = getRecord($sql11x);
?>
                <!-- [ Layout content ] Start -->
               <div class="layout-content">

                    <!-- [ content ] Start -->
                     <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">User Account Details</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            
                        </div>

                        <div class="media align-items-center py-3 mb-3">
                            <img src="cust-user-icon.jpg" alt="" class="d-block ui-w-100 rounded-circle">
                            <div class="media-body ml-4">
                                <h4 class="font-weight-bold mb-0"><?php echo $row7["Fname"]; ?></h4>
                               <div class="text-muted mb-2"><?php echo $row7['UserRoll']; ?></div>
                               <div class="text-muted mb-2" style="font-weight: bold;color: #000000 !important;">Wallet Balance : <?php echo $row11x['credit'] - $row11x['debit'];?></div> 
                               <!-- <a href="add-customer.php?id=<?php echo $row7['id']; ?>" class="btn btn-primary btn-sm">Edit</a>&nbsp;-->
                               
                            </div>
                        </div>

                       <div class="nav-tabs-top">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#user-edit-account">Personal Detail</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab2">Product Specification</a>
                                </li> -->
                                <?php if($row7['Roll'] == 5){?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab3">ID Proof Documents</a>
                                </li><?php } ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab4">Bank Account Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab5">Transaction Detail</a>
                                </li>
                                <?php if($row7['Roll'] != 5 || $row7['Roll'] != 55){?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab6">Earning Detail</a>
                                </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="user-edit-account">
                                    <div class="row">
                                        <div class="col-lg-6">
                                    <div class="table-responsive">
                                    <table class="table user-view-table m-0">
                                        <tbody>
                                           
                                            <tr>
                                                <th>Name :</th>
                                                <td><?php echo $row7["Fname"]; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Location:</th>
                                                <td><?php echo $row7["Address"]; ?></td>
                                            </tr>
                                            
                                             <tr>
                                                <th>Mobile No:</th>
                                                <td><?php echo $row7["Phone"]; ?></td>
                                            </tr>
                                             <tr>
                                                <th>Email Id:</th>
                                                <td><?php echo $row7["EmailId"]; ?></td>
                                            </tr>
                                           
                                            
                                        </tbody>
                                    </table>
                                </div>
                                 </div>

                                 <div class="col-lg-6">
                                     <div class="table-responsive">
                                    <table class="table user-view-table m-0">
                                        <tbody>

                                           
                                            </tbody>
                                    </table>
                                 </div>
                                  </div>

                                </div>
                                </div>
                                
                                <?php if($row7['Roll'] == 5){?>
                                <div class="tab-pane fade" id="tab3">

                                   <div class="table-responsive">
                                    <table class="table user-view-table m-0">
                                        <tbody>
<tr>
                                                <th>Front Aadhar Card:</th>
                                                <td><?php if($row7["AadharCard"] != ''){?>
                                                    <a href="../uploads/<?php echo $row7["AadharCard"]; ?>">View Doc</a>
                                                <?php } else { ?>
                                                    <span style="color:red;">No Document Found!</span>
                                                <?php } ?>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <th>Back Aadhar Card:</th>
                                                <td><?php if($row7["AadharCard2"] != ''){?>
                                                    <a href="../uploads/<?php echo $row7["AadharCard2"]; ?>">View Doc</a>
                                                <?php } else { ?>
                                                    <span style="color:red;">No Document Found!</span>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Aadhar Card No:</th>
                                                <td><?php echo $row7["AadharNo"]; ?></td>
                                            </tr>
                                             <tr>
                                                <th>PAN Card No:</th>
                                                <td><?php echo $row7["PanNo"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Front Pan Card:</th>
                                                <td><?php if($row7["PanCard"] != ''){?>
                                                    <a href="../uploads/<?php echo $row7["PanCard"]; ?>">View Doc</a>
                                                <?php } else { ?>
                                                    <span style="color:red;">No Document Found!</span>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Back Pan Card:</th>
                                                <td><?php if($row7["PanCard2"] != ''){?>
                                                    <a href="../uploads/<?php echo $row7["PanCard2"]; ?>">View Doc</a>
                                                <?php } else { ?>
                                                    <span style="color:red;">No Document Found!</span>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>GSTIN No:</th>
                                                <td><?php echo $row7["GstNo"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>GST Certificate:</th>
                                                <td><?php if($row7["GstCertificate"] != ''){?>
                                                    <a href="../uploads/<?php echo $row7["GstCertificate"]; ?>">View Doc</a>
                                                <?php } else { ?>
                                                    <span style="color:red;">No Document Found!</span>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Gumasta No:</th>
                                                <td><?php echo $row7["GumastaNo"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Gumasta Certificate:</th>
                                                <td><?php if($row7["Gumasta"] != ''){?>
                                                    <a href="../uploads/<?php echo $row7["Gumasta"]; ?>">View Doc</a>
                                                <?php } else { ?>
                                                    <span style="color:red;">No Document Found!</span>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>MSME No:</th>
                                                <td><?php echo $row7["MsmeNo"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>MSME Certificate:</th>
                                                <td><?php if($row7["Msme"] != ''){?>
                                                    <a href="../uploads/<?php echo $row7["Msme"]; ?>">View Doc</a>
                                                <?php } else { ?>
                                                    <span style="color:red;">No Document Found!</span>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                           
                                            </tbody>
                                    </table>
                                 </div>

                                </div><?php } ?>

                                <div class="tab-pane fade" id="tab4">

                                   <div class="table-responsive">
                                    <table class="table user-view-table m-0">
                                        <tbody>
<tr>
                                                <th>Bank Holder Name:</th>
                                                <td><?php echo $row7["AccountName"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Bank Name:</th>
                                                <td><?php echo $row7["BankName"];  ?></td>
                                            </tr>
                                            <tr>
                                                <th>Account No:</th>
                                                <td><?php echo $row7["AccountNo"]; ?></td>
                                            </tr>
                                             <tr>
                                                <th>Branch:</th>
                                                <td><?php echo $row7["Branch"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>IFSC Code:</th>
                                                <td><?php echo $row7["IfscCode"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>UPI ID:</th>
                                                <td><?php echo $row7["UpiNo"]; ?></td>
                                            </tr>
                                           
                                            </tbody>
                                    </table>
                                 </div>

                                </div>
                                
                                
                                
                                <div class="tab-pane fade" id="tab5">

                                   <div class="card-datatable table-responsive">
                                       
                                       <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>Sr No</th>
               <th>Account Name</th>
                <th>Date</th>
                
               <th>Credit</th>
               <th>Debit</th>
              
               <th>Narration</th>
              
            </tr>
        </thead>
        <tbody>
            
            <?php 
            $i=1;
            $sql = "SELECT * FROM `wallet` WHERE UserId='$id'";
            if($_POST['UserId']){
                $ExeId = $_POST['UserId'];
                if($ExeId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND UserId='$ExeId'";
                }
            }
           if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND CreatedDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND CreatedDate<='$ToDate'";
            }
            $sql.= " ORDER BY CreatedDate";
           // echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                
               /* $sql33 = "select sum(debit) as debit,sum(credit) as credit,(sum(credit)-sum(debit)) as bal from (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as credit,(case when Status='Dr' then sum(Amount) else 0 end) as debit FROM wallet WHERE UserId='".$row['UserId']."' AND CreatedDate<'".$row['CreatedDate']."'  group by Status) as a";
                 $row33 = getRecord($sql33);
                 $newopbal = $row33['bal'];*/
                 
                $sql2 = "SELECT Fname FROM tbl_users WHERE id='".$row['UserId']."'";
                $rncnt = getRow($sql2);
                $row2 = getRecord($sql2);
                
                if($row['Status'] == 'Cr'){
                    $Credit = $row['Amount'];
                    $Debit = "0";
                    $TotalCredit+=$row['Amount'];
                    $balamt = $_SESSION['balamt']+$Credit;
                }
                else{
                    $Credit = "0";
                    $Debit = $row['Amount'];
                    $TotalDebit+=$row['Amount'];
                    $balamt = $_SESSION['balamt']-$Debit;
                }
                unset($_SESSION['balamt']);
                $_SESSION['balamt'] = $balamt;
                 
                 if($rncnt > 0){
             ?>
            <tr>
               <td><?php echo $i; ?> </td>
               <td><?php echo $row2['Fname']; ?></td> 
            
               <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
                
                <td>&#8377;<?php echo number_format($Credit,2); ?></td> 
                <td>&#8377;<?php echo number_format($Debit,2); ?></td> 
               
               <td><?php echo $row['Narration']; ?></td> 
              
              
            </tr>
           <?php $i++;} } ?>

        <tr>
            <td><?php echo $i; ?> </td>
            <th></th>
             <th>Total</th>
          
           
            <th>&#8377;<?php echo number_format($TotalCredit+$row3['credit'],2); ?></th> 
                <th>&#8377;<?php echo number_format($TotalDebit+$row3['debit'],2); ?></th> 
                   <th></th>
        </tr>
        <tr> 
            <td><?php echo $i+1; ?> </td>
            <th></th>
            <th></th>
            <th>Balalnce</th>
            <th>&#8377;<?php echo number_format($TotalCredit-$TotalDebit+$opbal,2); ?></th> 
            <th></th> 
            
        </tr>

        </tbody>
    </table>
    

</div>

                                </div>
                                <?php if($row7['Roll'] != 5 || $row7['Roll'] != 55){?>
                                <div class="tab-pane fade" id="tab6">

                                   <div class="card-datatable table-responsive">
<table id="example2" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>Sr No</th>
            
               <th>Account Name</th>
                <th>Date</th>
                 <th>Narration</th>
               <th>Credit</th>
              
              
              
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT * FROM `wallet` WHERE UserId='$id' AND Status='Cr'";
            if($_POST['UserId']){
                $ExeId = $_POST['UserId'];
                if($ExeId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND UserId='$ExeId'";
                }
            }
           if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND CreatedDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND CreatedDate<='$ToDate'";
            }
            $sql.= " ";
           // echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                $sql2 = "SELECT Fname FROM tbl_users WHERE id='".$row['UserId']."'";
                $row2 = getRecord($sql2);
                
                if($row['Status'] == 'Cr'){
                    $Credit = $row['Amount'];
                    $Debit = "0";
                    $Total_Credit+=$row['Amount'];
                }
                else{
                    $Credit = "0";
                    $Debit = $row['Amount'];
                    $TotalDebit+=$row['Amount'];
                }
             ?>
            <tr>
               <td><?php echo $i; ?> </td>
               <td><?php echo $row2['Fname']; ?></td> 
            
               <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
                  <td><?php echo $row['Narration']; ?></td> 
                <td><?php echo number_format($Credit,2); ?></td> 
              
               
              
              
              
            </tr>
           <?php $i++;} ?>

        <tr>
            <td><?php echo $i; ?> </td>
            <th></th>
            <th></th>
            <th>Total</th>
            <th><?php echo number_format($Total_Credit,2); ?></th> 
             
        </tr>
       

        </tbody>
    </table>
</div>

                                </div><?php } ?>
                                
                            </div>
                        </div>

                      
                    </div>

                    <!-- [ content ] End -->

                    <!-- [ Layout footer ] Start -->
                    <?php include_once 'footer.php'; ?>
                    <!-- [ Layout footer ] End -->

                </div>
                </div>
                <!-- [ Layout content ] Start -->

            </div>
            <!-- [ Layout container ] End -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

<?php include_once 'footer_script.php'; ?>

<script type="text/javascript">
 
    $(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ],
        order: [[0, 'asc']]
    });
    
     $('#example2').DataTable({
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ],
        order: [[0, 'asc']]
    });
});
</script>
</body>

</html>
