<?php
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Complaints";
$Page = "Add-Complaints";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - <?php if ($_GET['id']) { ?>Edit <?php } else { ?> Add <?php } ?> Raw Stock
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

            <?php include_once 'top_header.php';
            include_once 'sidebar.php'; ?>


            <div class="layout-container">



                <?php
                $id = $_GET['id'];
                $sql7 = "SELECT * FROM tbl_company_policy WHERE id='$id'";
                $row7 = getRecord($sql7);


                if (isset($_POST['submit'])) {
                    $Title = addslashes(trim($_POST['Title']));
                    $Details = addslashes(trim($_POST['Details']));
                    $Status = addslashes(trim($_POST['Status']));
                    $CreatedDate = addslashes(trim($_POST['CreatedDate']));
                    $ModifiedDate = date('d-M-Y H:i:s');
                    
                   $randno = rand(1,100);

// File details
$src = $_FILES['Pdf']['tmp_name'];
$originalName = $_FILES["Pdf"]["name"];
$ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION)); 

// Generate safe filename
$fnm = pathinfo($originalName, PATHINFO_FILENAME);
$fnm = str_replace(" ","_", $fnm);
$imagepath = $randno . "_" . $fnm . "." . $ext;
$dest = '../company_policy/' . $imagepath;

// Upload only if file is selected
if (!empty($src) && is_uploaded_file($src)) {
    if (move_uploaded_file($src, $dest)) {
        $Pdf = $imagepath;  // saved file
    } else {
        $Pdf = $_POST['OldPdf']; // fallback
    }
} else {
    $Pdf = $_POST['OldPdf']; // if no file uploaded
}

                    if ($_GET['id'] == '') {
                        $sql73 = "INSERT INTO tbl_company_policy SET Title='$Title',Status='$Status',CreatedBy='$user_id',Details='$Details',CreatedDate='$CreatedDate',Pdf='$Pdf'";
                        $conn->query($sql73);
                        echo "<script>alert('New Policy Created Successfully!');window.location.href='view-company-policy.php';</script>";
                    }
                    else{
                         $sql73 = "UPDATE tbl_company_policy SET Title='$Title',Status='$Status',ModifiedBy='$user_id',Details='$Details',ModifiedDate='$ModifiedDate',Pdf='$Pdf' WHERE id='$id'";
                        $conn->query($sql73);
                        
                        echo "<script>alert('Policy Updated Successfully!');window.location.href='view-company-policy.php';</script>";
                    }
                }
                ?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if ($_GET['id']) { ?>Edit <?php } else { ?> Add
                        <?php } ?> Company Policy</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div id="alert_message"></div>

                                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                            <input type="hidden" name="action" value="Save" id="action">
                                            <div class="form-row">



                                                <div class="form-group col-md-12">
                                                    <label class="form-label">Title </label>
                                                    <input type="text" name="Title" id="Title" class="form-control"
                                                        placeholder="" value="<?php echo $row7["Title"]; ?>"
                                                        autocomplete="off" required>
                                                    <div class="clearfix"></div>
                                                </div>


                                                


                                                <div class="form-group col-md-12">
                                                    <label class="form-label">Details <span class="text-danger">*</span></label>
                                                    <textarea name="Details" class="form-control" id="editor1" placeholder="Details" required><?php echo $row7['Details']; ?></textarea>
                                                    <div class="clearfix"></div>
                                                </div>

                                          
 <div class="form-group col-md-12">
                                                    <label class="form-label"> Upload Pdf</label>
                                                    <input type="file" name="Pdf" class="form-control"
                                                        placeholder="" value="" >
                                                        
                                         <input type="hidden" name="OldPdf"
                                                    value="<?php echo $row7['Pdf'];?>" id="OldPdf">               
                                                        <?php if($row7['Pdf']=='') {} else{?>
                                            <span id="show_photo">
                                                <div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3"><a
                                                        href="javascript:void(0)"
                                                        class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white"
                                                        id="delete_photo"></a><a href="../company_policy/<?php echo $row7['Pdf'];?>"><?php echo $row7['Pdf'];?></a></div>
                                            </span>
                                            <?php } ?>
                                            
                                                    <div class="clearfix"></div>
                                                </div>

                                        <div class="form-group col-md-6">
                                                    <label class="form-label"> Date</label>
                                                    <input type="date" name="CreatedDate" class="form-control"
                                                        placeholder="" value="<?php echo date('Y-m-d'); ?>" readonly>
                                                    <div class="clearfix"></div>
                                                </div>
                                                
                                                 
                                                
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                                <select class="form-control" id="Status" name="Status" required="">

                                                    <option value="1" <?php if ($row7["Status"] == '1') { ?> selected
                                                        <?php } ?>>Active</option>
                                                    <option value="0" <?php if ($row7["Status"] == '0') { ?> selected
                                                        <?php } ?>>Inctive</option>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
  </div>
<br>
                                            <div class="form-row">
                                                <div class="form-group col-md-2">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Submit</button>
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

    <script>
        CKEDITOR.replace('editor1');
        $(document).ready(function() {

        });
    </script>
</body>

</html>