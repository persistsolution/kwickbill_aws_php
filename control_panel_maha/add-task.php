<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Task";
$Page = "Add-Task";
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
    </style>
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

             <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


            <div class="layout-container">

                

                <?php 
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_tasks WHERE id='$id'";
$row7 = getRecord($sql7);


if(isset($_POST['submit'])){
    $ExeId = addslashes(trim($_POST["ExeId"]));
     $TaskDate = addslashes(trim($_POST["TaskDate"]));
    $TaskName = addslashes(trim($_POST["TaskName"]));
$Status = 1;
$CreatedDate = date('Y-m-d');
$ModifiedDate = date('Y-m-d');

$sql2 = "SELECT Fname,Phone FROM tbl_users WHERE id='$ExeId'";
$row2 = getRecord($sql2);
$UserPhone = $row2['Phone'];
$Fname = $row2['Fname'];

if($_GET['id']==''){
     $qx = "INSERT INTO tbl_tasks SET ExeId='$ExeId',TaskDate='$TaskDate',TaskName = '$TaskName',Status='$Status',CreatedDate='$CreatedDate',CreatedBy='$user_id'";
  $conn->query($qx);
  
  $Phone = $UserPhone;
	 $smstxt = "Hello ".$Fname." We have assigned a new task to you. Please find the details below: Task Name: ".$TaskName." Task Description: ".$TaskName." Your prompt attention to this task is greatly appreciated. Thank you Maha Chai.";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169876070040755";
  include '../incsmsapi.php';  
  
  echo "<script>alert('Task Created Successfully!');window.location.href='view-tasks.php';</script>";
}
else{
 //$TicketNo= "#".rand(1000,9999);
    $query2 = "UPDATE tbl_tasks SET ExeId='$ExeId',TaskDate='$TaskDate',TaskName = '$TaskName',Status='$Status',ModifiedDate='$ModifiedDate',ModifiedBy='$user_id' WHERE id = '$id'";
  $conn->query($query2);
  
   $Phone = $UserPhone;
	 $smstxt = "Hello ".$Fname." We have assigned a new task to you. Please find the details below: Task Name: ".$TaskName." Task Description: ".$TaskName." Your prompt attention to this task is greatly appreciated. Thank you Maha Chai.";
  $dltentityid = "1501701120000037351";
  $dlttempid = "1707169876070040755";
  include '../incsmsapi.php'; 
  
  echo "<script>alert('Task Updated Successfully!');window.location.href='view-tasks.php';</script>";

}
    //header('Location:courses.php'); 

  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Create Ticket</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                              <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div id="alert_message"></div>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
            <input type="hidden" name="action" value="Save" id="action">

            <div class="form-row">
                <!-- Auto Ticket Number -->
                <div class="form-group col-md-6">
                    <label class="form-label">Ticket No</label>
                    <input type="text" name="TicketNo" class="form-control"
                        value="<?php echo isset($row7['TicketNo']) ? $row7['TicketNo'] : 'TKT'.time(); ?>" readonly>
                </div>

                <!-- Ticket Title -->
                <div class="form-group col-md-6">
                    <label class="form-label">Ticket Title <span class="text-danger">*</span></label>
                    <input type="text" name="Title" class="form-control" 
                        placeholder="Enter short subject" value="<?php echo $row7['Title'] ?? ''; ?>" required>
                </div>

                <!-- Ticket Description -->
                <div class="form-group col-md-12">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="Description" class="form-control" rows="3" required><?php echo $row7['Description'] ?? ''; ?></textarea>
                </div>

                <!-- Priority -->
                <div class="form-group col-md-4">
                    <label class="form-label">Priority <span class="text-danger">*</span></label>
                    <select name="Priority" class="form-control" required>
                        <option value="Low" <?php if($row7['Priority']=='Low') echo 'selected'; ?>>Low</option>
                        <option value="Medium" <?php if($row7['Priority']=='Medium') echo 'selected'; ?>>Medium</option>
                        <option value="High" <?php if($row7['Priority']=='High') echo 'selected'; ?>>High</option>
                        <option value="Critical" <?php if($row7['Priority']=='Critical') echo 'selected'; ?>>Critical</option>
                    </select>
                </div>

                <!-- Category -->
                <div class="form-group col-md-4">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="Category" class="form-control" required>
                        <option value="Bug" <?php if($row7['Category']=='Bug') echo 'selected'; ?>>Bug</option>
                        <option value="Feature Request" <?php if($row7['Category']=='Feature Request') echo 'selected'; ?>>Feature Request</option>
                        <option value="Query" <?php if($row7['Category']=='Query') echo 'selected'; ?>>Query</option>
                        <option value="Maintenance" <?php if($row7['Category']=='Maintenance') echo 'selected'; ?>>Maintenance</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="form-group col-md-4">
                    <label class="form-label">Status</label>
                    <select name="Status" class="form-control">
                        <option value="New" <?php if($row7['Status']=='New') echo 'selected'; ?>>New</option>
                        <option value="Open" <?php if($row7['Status']=='Open') echo 'selected'; ?>>Open</option>
                        <option value="In Progress" <?php if($row7['Status']=='In Progress') echo 'selected'; ?>>In Progress</option>
                        <option value="On Hold" <?php if($row7['Status']=='On Hold') echo 'selected'; ?>>On Hold</option>
                        <option value="Resolved" <?php if($row7['Status']=='Resolved') echo 'selected'; ?>>Resolved</option>
                        <option value="Closed" <?php if($row7['Status']=='Closed') echo 'selected'; ?>>Closed</option>
                    </select>
                </div>

                <!-- Executive -->
                <div class="form-group col-md-12" style="padding-top:10px;">
                    <label class="form-label">Executive <span class="text-danger">*</span></label>
                    <select class="select2-demo form-control" name="ExeId[]" id="ExeId" required >
                        <option value="0" selected>Select Executive</option>
                        <?php 
                        $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63) AND Fname!='' ORDER BY Fname";
                        $row12 = getList($sql12);
                        foreach($row12 as $result){ ?>
                            <option <?php if($row7["ExeId"] == $result['id']) echo 'selected'; ?> 
                                value="<?php echo $result['id'];?>">
                                <?php echo $result['Fname']." (".$result['Phone'].")"; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Task Dates -->
                <div class="form-group col-md-6">
                    <label class="form-label">Ticket Date</label>
                    <input type="date" name="TaskDate" class="form-control"
                        value="<?php echo $row7['TaskDate'] ?? ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label">Ticket Completion Date</label>
                    <input type="date" name="DueDate" class="form-control"
                        value="<?php echo $row7['DueDate'] ?? ''; ?>" required>
                </div>

                <!-- Task Name (Multiple) -->
               <!-- <div class="form-group col-md-12">
                    <label class="form-label">Task Name</label>
                    <div class="input-group">
                        <input type="text" name="Task[]" class="form-control" placeholder="">
                        <div class="input-group-append">
                            <button class="btn btn-success rounded" type="button" id="add_more">+</button>
                        </div>
                    </div>
                </div>-->

                <!-- File Upload -->
                <div class="form-group col-md-12">
                    <label class="form-label">Attach Photo/File</label>
                    <input type="file" class="form-control" name="Photo">
                    <input type="hidden" name="OldPhoto" value="<?php echo $row7['Photo'] ?? ''; ?>">
                    <?php if(!empty($row7['Photo'])){ ?>
                        <div class="pt-2">
                            <img src="../taskfiles/<?php echo $row7['Photo'];?>" style="width:64px;height:64px;">
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Submit -->
            <div class="form-row">
                <div class="form-group col-md-2">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
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

 
</body>

</html>