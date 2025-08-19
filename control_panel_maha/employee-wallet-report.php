<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Report";
$Page = "mployee-Wallet-Report";
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
<h4 class="font-weight-bold py-3 mb-0">Trasaction Report
    
</h4>

<div class="card" style="padding: 10px;">

     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       

<div class="form-group col-md-2">
                                            <label class="form-label">Zone </label>
                                            <select class="form-control" id="ZoneId" name="ZoneId" required="">
                                                <option selected=""  value="all">All</option>
                                                <?php $sql = "SELECT * FROM tbl_zone WHERE Status=1";
                                                    $row = getList($sql);
                                                    foreach($row as $result){?>
                                                <option value="<?php echo $result['id'];?>" <?php if($_POST["ZoneId"]==$result['id']) {?> selected
                                                    <?php } ?>><?php echo $result['Name'];?></option>
                                                <?php } ?>
                                                  
                                            </select>
                                            <div class="clearfix"></div>
                                        </div>
                                        
  <div class="form-group col-md-4">
<label class="form-label"> Accounts<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="UserId" id="UserId" required>
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll!=1";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_POST["UserId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-2">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-2">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1" style="padding-top:30px;">
    <label class="form-label">&nbsp;</label>
<button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
</div>
<?php if(isset($_POST['Search'])) {?>
<div class="form-group col-md-1">
<label class="form-label">&nbsp;</label>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" data-original-title="Clear Filter">X</a>
</div>
<?php } ?>
</div>

</form>
                                            </div>
                                        </div>
                                    </div>
   </div>

<?php if($_REQUEST['Search'] == 'Search'){?>
<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>Sr No</th>
               <th>Account Name</th>
               <th>Employee Id</th>
               <th>Zone</th>
                <th>Date</th>
                 <th>Narration</th>
               <th>Credit</th>
               <th>Debit</th>
               <th>Balance</th>
              
              
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT * FROM `wallet` WHERE 1";
            if($_POST['UserId']){
                $ExeId = $_POST['UserId'];
                if($ExeId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND UserId='$ExeId'";
                }
            }
            $sql.=" GROUP BY UserId";
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
            $sql3 = "select sum(debit) as debit,sum(credit) as credit,(sum(credit)-sum(debit)) as bal from (SELECT (case when Status='Cr' then sum(Amount) else 0 end) as credit,(case when Status='Dr' then sum(Amount) else 0 end) as debit FROM wallet WHERE UserId='".$row['UserId']."'";
                if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql3.= " AND CreatedDate<'$FromDate'";
                }
                $sql3.= " group by Status) as a";
                $row3 = getRecord($sql3);
                $opbal = $row3['bal'];
                if($opbal > 0){
                    $cramt = $opbal;
                    $dramt = 0;
                    $bal = $cramt - $dramt;
                }
                else{
                    $cramt = 0;
                    $dramt = $opbal;
                    $bal = $dramt - $cramt;
                }
                $_SESSION['balamt'] = $opbal;
                
                 $sql2 = "SELECT tu.Fname,tu.CustomerId,tz.Name AS ZoneName FROM tbl_users tu INNER JOIN tbl_zone tz ON tu.ZoneId=tz.id WHERE tu.id='".$row['UserId']."'";
                 if($_POST['ZoneId']){
                $ZoneId = $_POST['ZoneId'];
                if($ZoneId == 'all'){
                    $sql2.= " ";
                }
                else{
                $sql2.= " AND tu.ZoneId='$ZoneId'";
                }
                }
                 $rncnt = getRow($sql2);
                $row2 = getRecord($sql2);
                if($rncnt > 0){
                ?>
                <tr>
                    <td></td>
                    <td><?php echo $row2['Fname']; ?></td> 
                    <td><?php echo $row2['CustomerId']; ?></td> 
                    <td><?php echo $row2['ZoneName']; ?></td> 
                    <td>Upto <?php echo date("d/m/Y", strtotime('-1 day', strtotime($_POST['FromDate']))); ?></td>
                    <td>Opening Balance</td>
                    
                    <td><?php echo $row3['credit'];?></td>
                    <td><?php echo $row3['debit'];?></td>
                    <td><?php echo $opbal;?></td>
                </tr>
            <?php } }
            
            ?>
            
            <?php 
            $i=1;
            $sql = "SELECT * FROM `wallet` WHERE 1";
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
                 
                $sql2 = "SELECT tu.Fname,tu.CustomerId,tz.Name AS ZoneName FROM tbl_users tu INNER JOIN tbl_zone tz ON tu.ZoneId=tz.id WHERE tu.id='".$row['UserId']."'";
                 if($_POST['ZoneId']){
                $ZoneId = $_POST['ZoneId'];
                if($ZoneId == 'all'){
                    $sql2.= " ";
                }
                else{
                $sql2.= " AND tu.ZoneId='$ZoneId'";
                }
                }
                
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
               <td><?php echo $row2['CustomerId']; ?></td> 
            <td><?php echo $row2['ZoneName']; ?></td> 
               <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
                  <td><?php echo $row['Narration']; ?></td> 
                <td><?php echo number_format($Credit,2); ?></td> 
                <td><?php echo number_format($Debit,2); ?></td> 
               
              <td><?php echo number_format($balamt,2); ?></td>
              
              
            </tr>
           <?php $i++;} } ?>

        <tr>
            <td><?php echo $i; ?> </td>
            <th></th>
             <th></th>
              <th></th>
            <th></th>
            <th>Total</th>
            <th><?php echo number_format($TotalCredit+$row3['credit'],2); ?></th> 
                <th><?php echo number_format($TotalDebit+$row3['debit'],2); ?></th> 
                 <th></th> 
        </tr>
        <tr> 
            <td><?php echo $i+1; ?> </td>
            <th></th>
             <th></th>
              <th></th>
            <th></th>
            <th>Balalnce</th>
            <th><?php echo number_format($TotalCredit-$TotalDebit+$opbal,2); ?></th> 
            <th></th> 
            <th></th> 
        </tr>

        </tbody>
    </table>
</div>
<?php } ?>
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
            'excelHtml5'
        ]
    });
});
</script>
</body>
</html>
