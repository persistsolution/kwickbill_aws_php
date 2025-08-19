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

            <?php include_once 'fr-sidebar.php'; ?>


            <div class="layout-container">

                

                <?php 
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_tasks WHERE id='$id'";
$row7 = getRecord($sql7);


if(isset($_POST['submit'])){
    $number = count($_POST["Task"]);
    $TaskDate = $_POST["TaskDate"];
    $DueDate = $_POST["DueDate"];
    $date = date('Y-m-d H:i:s');
      if($number > 0)  
        {     
        for ($i = 0; $i < count($_POST['ExeId']); $i++) {
         $ExeId = $_POST['ExeId'][$i];
        
         for($i2=0; $i2<$number; $i2++)  
          {  
            if(trim($_POST["Task"][$i2] != ''))  
              { 

                $Task = $_POST['Task'][$i2];
                $sql = "INSERT INTO tbl_task_new SET UserId='$ExeId',TaskDate='$TaskDate',DueDate='$DueDate',TaskName='$Task',CreatedBy='$user_id',CreatedDate='$date',Status='0'";
                $conn->query($sql);

              }
          }
      
    }
    
    echo "<script>alert('Task Allocated Successfully!');window.location.href='fr-view-task.php';</script>";
        }
  }
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Add
                            <?php } ?> Task</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                 <form id="validation-form" method="post" autocomplete="off">
                                <div class="row">

                                    <div class="col-lg-12">
                                <div id="alert_message"></div>
                               
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                    <div class="form-row">
                                    
                                     

                                    <div class="form-group col-md-12" style="padding-top:10px;">
<label class="form-label"> Executive<span class="text-danger">*</span></label>
 <select class="select2-demo form-control" name="ExeId[]" id="ExeId" required multiple>
<!--<option selected="" value="">Select Executive</option>-->
 <?php 
  $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll NOT IN(1,5,55,9,22,23,63) AND UnderFrId IN ($CocoFranchiseAccess)";
  $row12 = getList($sql12);
  foreach($row12 as $result){
     ?>
  <option <?php if($row7["ExeId"] == $result['id']) {?> selected <?php } ?> value="<?php echo $result['id'];?>">
    <?php echo $result['Fname']." (".$result['Phone'].")"; ?></option>
<?php } ?>
</select>
<div class="clearfix"></div>
</div>


 <div class="form-group col-md-6">
                                            <label class="form-label">Task Date</label>
                                            <input type="date" name="TaskDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["TaskDate"]; ?>">
                                            <div class="clearfix"></div>
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Task Completion Date</label>
                                            <input type="date" name="DueDate" class="form-control"
                                                placeholder="" value="<?php echo $row7["DueDate"]; ?>" required>
                                            <div class="clearfix"></div>
                                        </div>
</div>

<div id="dynamic_field">
                      <div class="row">
 <div class="form-group col-md-12">
                                            <label class="form-label">Task Name</label>
                                            <div class="input-group">
                                            <input type="text" name="Task[]" class="form-control"
                                                placeholder="">
                                                <div class="input-group-append">
           <button class="btn btn-block btn-success rounded" type="button" id="add_more">+</button>
        </div>
        </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        </div>
                    </div>




  


                                   <div class="form-row">
                                    <div class="form-group col-md-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Submit</button>
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
      $(document).ready(function() {
  
    var i=1; 
    $('#add_more').click(function(){  
        var html = '';
        html+='<div class="row" id="row'+i+'">';
        html+='<div class="form-group col-md-12">';
        html+='<label class="form-label">Task Name</label>';
        html+='<div class="input-group">';
        html+='<input type="text" name="Task[]" class="form-control" placeholder="">';
        html+='<div class="input-group-append">';
        html+='<button class="btn btn-block btn-danger rounded btn_remove" type="button" id="'+i+'">X</button>';
        html+='</div>';
        html+='</div>';
        html+='<div class="clearfix"></div>';
        html+='</div>';
        $('#dynamic_field').append(html);
        }); 

         $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete?"))  
           { 
           $('#row'+button_id+'').remove();  
            
           }
      }); 
      }); 
 </script>
</body>

</html>