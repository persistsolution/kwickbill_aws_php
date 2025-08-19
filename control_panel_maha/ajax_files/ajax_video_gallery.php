<?php 
session_start();
include_once '../config.php';
include_once 'incuserdetails.php';
$user_id = $_SESSION['Admin']['id'];
if($_POST['action'] == 'Add'){
$Name = addslashes(trim($_POST["Name"]));
$VideoFor = addslashes(trim($_POST["VideoFor"]));
$Status = $_POST["Status"];

$randno = rand(1,100);
$src = $_FILES['Photo']['tmp_name'];
$fnm = substr($_FILES["Photo"]["name"], 0,strrpos($_FILES["Photo"]["name"],'.')); 
$fnm = str_replace(" ","_",$fnm);
$ext = substr($_FILES["Photo"]["name"],strpos($_FILES["Photo"]["name"],"."));
$dest = '../../uploads/'. $randno . "_".$fnm . $ext;
$imagepath =  $randno . "_".$fnm . $ext;
if(move_uploaded_file($src, $dest))
{
$Photo = $imagepath ;
} 
else{
  //$Photo = $_POST['OldPhoto'];
}

$qx = "INSERT INTO tbl_video_gallery SET VideoFor='$VideoFor',Name = '$Name',Status='$Status',Photo='$Photo'";
	$conn->query($qx);
	echo 1;

}

if($_POST['action'] == 'fetch_record'){
 $id = $_POST['id'];
    $query = "SELECT * FROM tbl_video_gallery WHERE id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    echo json_encode($row);


}

if($_POST['action'] == 'Edit') {
     $id = $_POST['id'];
$Name = addslashes(trim($_POST["Name"]));
$VideoFor = addslashes(trim($_POST["VideoFor"]));
$Status = $_POST["Status"];

$OldPhoto = $_POST['OldPhoto'];
$randno = rand(1,100);
$src = $_FILES['Photo']['tmp_name'];
$fnm = substr($_FILES["Photo"]["name"], 0,strrpos($_FILES["Photo"]["name"],'.')); 
$fnm = str_replace(" ","_",$fnm);
$ext = substr($_FILES["Photo"]["name"],strpos($_FILES["Photo"]["name"],"."));
$dest = '../../uploads/'. $randno . "_".$fnm . $ext;
$imagepath =  $randno . "_".$fnm . $ext;
if(move_uploaded_file($src, $dest))
{
  $src = "../../uploads/$OldPhoto";
  unlink($src); 
$Photo = $imagepath ;
} 
else{
  $Photo = $_POST['OldPhoto'];
}

  $query2 = "UPDATE tbl_video_gallery SET VideoFor='$VideoFor',Name = '$Name',Status='$Status',Photo='$Photo' WHERE id = '$id'";
 	$conn->query($query2);
  echo 1;

}

  if($_POST['action'] == 'delete') {
   
      $id = $_POST['id'];
      $query = "DELETE FROM tbl_video_gallery WHERE id = '$id'";
      $conn->query($query);
      echo "Delete Successfully";

  }

if($_POST['action'] == 'deletePhoto'){
    $id = $_POST['id'];
    $Photo = $_POST['Photo'];
        $q = "UPDATE tbl_video_gallery SET Photo='' WHERE id=$id";
        $conn->query($q);
      

    echo "Category Photo Delete Successfully";
} 

  if($_POST['action']=='view'){?>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
              <th>#</th>
               <th>Video For</th>
                 <th>Photo</th>
              <th>Video</th>
               <th>Status</th>
               <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
               <th>Action</th>
               <?php } ?>
            </tr>
        </thead>
        <tbody>
          <?php 
 $srno = 1;
  $sql = "SELECT * FROM tbl_video_gallery ORDER BY id DESC";
   $rx = $conn->query($sql);
  while($nx = $rx->fetch_assoc()){

  ?>
           <tr>
             <td><?php echo $srno; ?></td>
            <!--<td><?php if($nx['VideoFor']=='1'){echo "<span style='color:green;'>Franchise</span>";} 
 else if($nx['VideoFor']=='2'){echo "<span style='color:orange;'>Employee</span>";} else if($nx['VideoFor']=='4'){ echo "<span style='color:red;'>Customer</span>";} else { echo "<span style='color:red;'>All</span>";}?></td>-->
 
 <td><?php if($nx['VideoFor']=='1'){echo "<span style='color:green;'>Receipe</span>";} 
 else { echo "<span style='color:red;'>Promotional</span>";}?></td>
  <td><?php if($nx["Photo"] == '') {?>
                  <img src="no_image.jpg" class="img-fluid ui-w-40"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../../uploads/'.$nx["Photo"])){?>
                 <img src="../uploads/<?php echo $nx["Photo"];?>" class="img-fluid ui-w-40" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="no_image.jpg" class="img-fluid ui-w-40"> 
             <?php } ?></td>
             <td>
                
                 <!--<video width="320" height="240" controls>
  <source src="../videos/<?php echo $nx['Name']; ?>" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
Your browser does not support the video tag.
</video>-->
                 <iframe width="380" height="240" src="https://www.youtube.com/embed/<?php echo $nx['Name']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                 </td>
             <td><?php if($nx['Status']=='1'){echo "<span style='color:green;'>Active</span>";} else { echo "<span style='color:red;'>Inactive</span>";} ?></td>
             <?php if(in_array("10", $Options) || in_array("11", $Options)) {?>
             <td>
                 
                  <?php if(in_array("10", $Options)){?>
                 <a data-id="<?php echo $nx['id']; ?>" href='javascript:void(0);' data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit" class="update"><i class="lnr lnr-pencil mr-2"></i></a>&nbsp;&nbsp;
                 <?php } if(in_array("11", $Options)){?><a data-id="<?php echo $nx['id']; ?>" href='javascript:void(0);' data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete" class="delete" id="bootbox-confirm"><i class="lnr lnr-trash text-danger"></i></a>
                 <?php } ?>
             </td><?php } ?>
            </tr>
             <?php $srno++;} ?>
        </tbody>
    </table>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#example').DataTable( {
        responsive: true
      });
      });
    </script>
 <?php }
?>