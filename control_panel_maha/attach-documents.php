<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage="Documents";
$Page = "Add-Documents";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - <?php if($_GET['id']) {?>Edit <?php } else{?> Add <?php } ?> Vendor Account
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

    fieldset legend {
        background: inherit;
        font-family: "Lato", sans-serif;
        color: #650812;
        font-size: 15px;
        left: 10px;
        padding: 0 10px;
        position: absolute;
        top: -12px;
        font-weight: 400;
        width: auto !important;
        border: none !important;
    }

    fieldset {
        background: #ffffff;
        border: 1px solid #4FAFB8;
        border-radius: 5px;
        margin: 20px 0 1px 0;
        padding: 20px;
        position: relative;
    }
    </style>
     <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

             <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


            <div class="layout-container">

                

                <?php 
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_documents WHERE id='$id'";
$row7 = getRecord($sql7);

if(isset($_POST['submit'])){
    $title = addslashes(trim($_POST['title']));
$file_date= addslashes(trim($_POST['file_date']));
$folder_name = addslashes(trim($_POST['folder_name']));
$sub_folder_name = addslashes(trim($_POST['sub_folder_name']));
$concat_folder = $folder_name;
if ($sub_folder_name != '') {
    $concat_folder .= "/" . $sub_folder_name;
}

$old_folder_name = addslashes(trim($_POST['OldFolderName']));
$old_sub_folder_name = addslashes(trim($_POST['OldSubFolderName']));
$old_concat_folder = addslashes(trim($_POST['OldConcatFolderName']));
$CreatedDate = date('Y-m-d');
$old_file_name = $_POST['OldFiles'];

$oldFolder = '../documents/' . $old_concat_folder.'/'.$old_file_name; // existing folder
$newDest = '../documents/' . $concat_folder.'/'.$old_file_name; 


$randno = rand(1,100);
$src = $_FILES['files']['tmp_name'];
$fnm = substr($_FILES["files"]["name"], 0, strrpos($_FILES["files"]["name"], '.')); 
$fnm = str_replace(" ", "_", $fnm);
$ext = substr($_FILES["files"]["name"], strpos($_FILES["files"]["name"], "."));
$folderPath = '../documents/' . $concat_folder;
// Check if the folder exists, if not, create it
if (!is_dir($folderPath)) {
    mkdir($folderPath, 0777, true); // 0777 permission and recursive
}
$dest = $folderPath . '/' . $randno . "_" . $fnm . $ext;
$imagepath = $randno . "_" . $fnm . $ext;
if (move_uploaded_file($src, $dest)) {
    $files = $imagepath;
} else {
    if (rename($oldFolder, $newDest)) {
        $files = $_POST['OldFiles'];
    }
    
}

if($_GET['id'] == ''){
    $sql = "INSERT INTO tbl_documents SET title='$title',file_date='$file_date',folder_name='$folder_name',sub_folder_name='$sub_folder_name',concat_folder='$concat_folder',files='$files',created_by='$user_id',created_at='$CreatedDate'";
    $conn->query($sql);
    echo "<script>alert('File Uploaded Successfully');window.location.href='view-attach-documents.php';</script>";
}
else{
  $sql = "UPDATE tbl_documents SET title='$title',file_date='$file_date',folder_name='$folder_name',sub_folder_name='$sub_folder_name',concat_folder='$concat_folder',files='$files',modified_by='$user_id',modified_at='$CreatedDate' WHERE id='$id'";
    $conn->query($sql);
    echo "<script>alert('File Update Successfully');window.location.href='view-attach-documents.php';</script>";  
}
}
?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0"><?php if($_GET['id']) {?>Edit <?php } else{?> Upload
                            <?php } ?> Documents</h4>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div id="alert_message"></div>
                                <form id="validation-form" method="post" autocomplete="off" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" id="userid">
                                    <input type="hidden" name="action" value="Save" id="action">
                                   
                    
<fieldset>
 <legend>Upload Documents</legend>
<div class="form-row">               
                                    
                                       <div class="form-group col-md-6">
<label class="form-label">Title <span class="text-danger">*</span></label>
<input type="text" name="title" id="title" class="form-control" placeholder="" value="<?php echo $row7["title"]; ?>" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-6">
<label class="form-label">Date <span class="text-danger">*</span></label>
<input type="date" name="file_date" id="file_date" class="form-control" placeholder="" value="<?php echo $row7["file_date"]; ?>" required>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">Folder Name <span class="text-danger">*</span></label>
<input list="cars" name="folder_name" id="folder_name" class="form-control" placeholder="" value="<?php echo $row7["folder_name"]; ?>" required>
    <datalist id="cars">
        <?php $sql = "SELECT DISTINCT(folder_name) AS folder_name FROM tbl_documents";
        $row = getList($sql);
        foreach($row as $result){?>
      <option value="<?php echo $result['folder_name'];?>" />
      <?php } ?>
    
    </datalist>
<div class="clearfix"></div>
</div>

<div class="form-group col-md-3">
<label class="form-label">Sub Folder Name </label>
<input list="sub_folder" name="sub_folder_name" id="sub_folder_name" class="form-control" placeholder="" value="<?php echo $row7["sub_folder_name"]; ?>">
    <datalist id="sub_folder"> 
        <?php $sql = "SELECT DISTINCT(sub_folder_name) AS sub_folder_name FROM tbl_documents";
        $row = getList($sql);
        foreach($row as $result){?>
      <option value="<?php echo $result['sub_folder_name'];?>" />
      <?php } ?>
    
    </datalist>
<div class="clearfix"></div>
</div>

 <div class="form-group col-md-6">
<label class="form-label">Attach File </label>
<input type="file" name="files" id="files" class="form-control" placeholder="">
<input type="hidden" name="OldFiles" value="<?php echo $row7['files'];?>" id="OldFiles">
<input type="hidden" name="OldFolderName" value="<?php echo $row7['folder_name'];?>" id="OldFolderName">
<input type="hidden" name="OldSubFolderName" value="<?php echo $row7['sub_folder_name'];?>" id="OldSubFolderName">
<input type="hidden" name="OldConcatFolderName" value="<?php echo $row7['concat_folder'];?>" id="OldConcatFolderName">

<span class="custom-file-label"></span>
</label>
<?php if($row7['files']=='') {} else{?>
  <span id="show_photo">
<div class="ui-feed-icon-container float-left pt-2 mr-3 mb-3" style="width: 18%;">
    <a href="javascript:void(0)" class="ui-icon ui-feed-icon ion ion-md-close bg-secondary text-white" id="delete_photo"></a>
    <a href="../documents/<?php echo $row7['folder_name']."/".$row7['files'];?>" alt="" class="img-fluid ticket-file-img" download style="width: 100%;">Download Doc</a></div>
</span>
<?php } ?>
</div>



 


                                    </div> 
                                     </fieldset>
                                     <br>
                                    <!-- <button id="growl-default" class="btn btn-default">Default</button> -->
                                    <button type="submit" name="submit" class="btn btn-primary btn-finish" id="submit">Save</button>
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