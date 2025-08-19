<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Report";
$Page = "Franchise-Daily-Survey-Report";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | View Franchise Visit List</title>
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
  $sql11 = "DELETE FROM tbl_customer_visits WHERE id = '$id'";
  $conn->query($sql11);
  ?>
    <script type="text/javascript">
      alert("Deleted Successfully!");
      window.location.href="executive-visit.php";
    </script>
<?php } ?>

<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Franchise Daily Checklist Report
    
</h4>

<div class="card" style="padding: 10px;">

     <div id="accordion2">
<div class="card mb-2">
                                        
                                        <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                            <div class="" style="padding:5px;">
                                                <form id="validation-form" method="post" enctype="multipart/form-data" action="">
<div class="form-row">

       

  <div class="form-group col-md-4">
<label class="form-label"> Franchise<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="ExeId" id="ExeId" required>
<option selected="" value="all">All</option>
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll=5";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($_POST["ExeId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">From Date </label>
<input type="date" name="FromDate" id="FromDate" class="form-control" value="<?php echo $_POST['FromDate'] ?>" autocomplete="off">
</div>
<div class="form-group col-md-3">
<label class="form-label">To Date</label>
<input type="date" name="ToDate" id="ToDate" class="form-control" value="<?php echo $_POST['ToDate'] ?>" autocomplete="off">
</div>
<input type="hidden" name="Search" value="Search">
<div class="form-group col-md-1">
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

<div class="card-datatable table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               <th>Sr No</th>
               <th>Franchise Name</th>
              
                <th>Question 1</th> 
                <th>Answer 1</th> 
                <th>Question 2</th> 
                <th>Answer 2</th> 
                <th>Question 3</th> 
                <th>Answer 3</th> 
                <th>Question 4</th> 
                <th>Answer 4</th> 
                <th>Question 5</th> 
                <th>Answer 5</th> 
                <th>Question 6</th>
                <th>Answer 6</th>  
                <th>Question 7</th> 
                <th>Answer 7</th> 
                <th>Question 8</th> 
                <th>Answer 8</th> 
                <th>Question 9</th> 
                <th>Answer 9</th> 
                <th>Question 10</th> 
                <th>Answer 10</th> 
                <th>Question 11</th> 
                <th>Answer 11</th> 
                <th>Question 12</th> 
                <th>Answer 12</th> 
                <th>Date</th> 
                <th>Time</th> 
                
              
              
               
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1;
            $sql = "SELECT tp.*,tc.Fname FROM tbl_survey tp 
            LEFT JOIN tbl_users tc ON tc.id=tp.CustId 
            WHERE tp.Status IN (1) AND tp.Type=2";
            if($_POST['ExeId']){
                $ExeId = $_POST['ExeId'];
                if($ExeId == 'all'){
                    $sql.= " ";
                }
                else{
                $sql.= " AND tp.CustId='$ExeId'";
                }
            }
           if($_POST['FromDate']){
                $FromDate = $_POST['FromDate'];
                $sql.= " AND tp.CreatedDate>='$FromDate'";
            }
            if($_POST['ToDate']){
                $ToDate = $_POST['ToDate'];
                $sql.= " AND tp.CreatedDate<='$ToDate'";
            }
            $sql.= " ORDER BY tp.CreatedDate DESC";
            //echo $sql;
            $res = $conn->query($sql);
            while($row = $res->fetch_assoc())
            {
                
             ?>
            <tr>
               <td><?php echo $i; ?> </td>
               <td><?php echo $row['Fname']; ?></td> 

               <td><?php echo $row['Question1']; ?></td> 
               <td><?php echo $row['Answer1']; ?></td>
               <td><?php echo $row['Question2']; ?></td> 
               <td><?php echo $row['Answer2']; ?></td>
               <td><?php echo $row['Question3']; ?></td> 
               <td><?php echo $row['Answer3']; ?></td> 
               <td><?php echo $row['Question4']; ?></td>
               <td><?php echo $row['Answer4']; ?></td>
               <td><?php echo $row['Question5']; ?></td> 
               <td><?php echo $row['Answer5']; ?></td> 
               <td><?php echo $row['Question6']; ?></td> 
               <td><?php echo $row['Answer6']; ?></td> 
               <td><?php echo $row['Question7']; ?></td> 
               <td><?php echo $row['Answer7']; ?></td> 
               <td><?php echo $row['Question8']; ?></td> 
               <td><?php echo $row['Answer8']; ?></td> 
               <td><?php echo $row['Question9']; ?></td> 
               <td><?php echo $row['Answer9']; ?></td> 
               <td><?php echo $row['Question10']; ?></td> 
               <td><?php echo $row['Answer10']; ?></td> 
               <td><?php echo $row['Question11']; ?></td> 
               <td><?php echo $row['Answer11']; ?></td> 
               <td><?php echo $row['Question12']; ?></td> 
               <td><?php echo $row['Answer12']; ?></td> 
               <td><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?></td>
               <td><?php echo $row['CreatedTime']; ?></td> 
              
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
            'excelHtml5'
        ]
    });
});
</script>
</body>
</html>
