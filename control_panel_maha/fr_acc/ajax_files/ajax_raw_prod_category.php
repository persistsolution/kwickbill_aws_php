<?php 
session_start();
include_once '../config.php';
include_once 'incuserdetails.php';
$user_id = $_SESSION['fr_admin'];
if($_POST['action'] == 'Add'){
$Name = addslashes(trim($_POST["Name"]));
$srno = addslashes(trim($_POST["srno"]));
$Icon = addslashes(trim($_POST["Icon"]));
$Status = $_POST["Status"];
$Roll = $_POST["Roll"];

if($_POST["Featured"] == '1'){
$Featured = 1;
}
else{
  $Featured = 0;
}
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

$randno2 = rand(1,100);
$src2 = $_FILES['Photo2']['tmp_name'];
$fnm2 = substr($_FILES["Photo2"]["name"], 0,strrpos($_FILES["Photo2"]["name"],'.')); 
$fnm2 = str_replace(" ","_",$fnm2);
$ext2 = substr($_FILES["Photo2"]["name"],strpos($_FILES["Photo2"]["name"],"."));
$dest2 = '../../uploads/'. $randno2 . "_".$fnm2 . $ext2;
$imagepath2 =  $randno2 . "_".$fnm2 . $ext2;
if(move_uploaded_file($src2, $dest2))
{
$Photo2 = $imagepath2 ;
} 
else{
  //$Photo = $_POST['OldPhoto'];
}

$CreatedDate = date('Y-m-d');
$modified_time = gmdate('Y-m-d H:i:s.').gettimeofday()['usec'];
/*$query = "SELECT * FROM tbl_raw_prod_category WHERE Name = '$Name'";
$result = $conn->query($query);
$row_cnt = mysqli_num_rows($result);
if($row_cnt > 0){
  echo 0;
}
else{*/
 $qx = "INSERT INTO tbl_raw_prod_category SET CreatedBy='$user_id',Name = '$Name', Icon = '$Icon',Status='$Status',Featured='$Featured',Photo='$Photo',Photo2='$Photo2',CreatedDate='$CreatedDate',Roll='$Roll',srno='$srno',modified_time='$modified_time'"; 
  $conn->query($qx); 
  $InvId = mysqli_insert_id($conn);
  $url = $_SERVER['REQUEST_URI'];
  $createddate = date('Y-m-d H:i:s');
  $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$BillSoftFrId',url='$url',action='new raw product category added',invid='$InvId',createddate='$createddate',roll='raw_prod_category'";
  $conn->query($sql);
  echo 1;
/*}*/
}

if($_POST['action'] == 'fetch_record'){
 $id = $_POST['id'];
    $query = "SELECT * FROM tbl_raw_prod_category WHERE id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    echo json_encode($row);


}

if($_POST['action'] == 'Edit') {
     $id = $_POST['id'];
$Name = addslashes(trim($_POST["Name"]));
$srno = addslashes(trim($_POST["srno"]));
$Status = $_POST["Status"];
$Roll = $_POST["Roll"];
$Icon = addslashes(trim($_POST["Icon"]));
$OldPhoto = $_POST['OldPhoto'];
$OldPhoto2 = $_POST['OldPhoto2'];
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

$randno2 = rand(1,100);
$src2 = $_FILES['Photo2']['tmp_name'];
$fnm2 = substr($_FILES["Photo2"]["name"], 0,strrpos($_FILES["Photo2"]["name"],'.')); 
$fnm2 = str_replace(" ","_",$fnm2);
$ext2 = substr($_FILES["Photo2"]["name"],strpos($_FILES["Photo2"]["name"],"."));
$dest2 = '../../uploads/'. $randno2 . "_".$fnm2 . $ext2;
$imagepath2 =  $randno2 . "_".$fnm2 . $ext2;
if(move_uploaded_file($src2, $dest2))
{
    $src3 = "../../uploads/$OldPhoto2";
  unlink($src3); 
$Photo2 = $imagepath2 ;
} 
else{
  $Photo2 = $_POST['OldPhoto2'];
}

if($_POST["Featured"] == 1){
$Featured = 1;
}
else{
  $Featured = 0;
}
$ModifiedDate = date('Y-m-d');
$modified_time = gmdate('Y-m-d H:i:s.').gettimeofday()['usec'];
/*$query = "SELECT * FROM tbl_raw_prod_category WHERE Name = '$Name' AND id != '$id'";
$result = $conn->query($query);
$row_cnt = mysqli_num_rows($result);
if($row_cnt > 0){
  echo 0;
}
else{*/ 
  $query2 = "UPDATE tbl_raw_prod_category SET Name = '$Name',Icon = '$Icon',Status='$Status',Featured='$Featured',Photo='$Photo',Photo2='$Photo2',ModifiedDate='$ModifiedDate',Roll='$Roll',srno='$srno',modified_time='$modified_time',push_flag=1 WHERE id = '$id'";
  $conn->query($query2);
  $url = $_SERVER['REQUEST_URI'];
  $createddate = date('Y-m-d H:i:s');
  $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$BillSoftFrId',url='$url',action='raw product category updated',invid='$id',createddate='$createddate',roll='raw_prod_category'";
  $conn->query($sql);
  echo 1;
/*}*/
} 
 
  if($_POST['action'] == 'delete') {
   
      $id = $_POST['id'];
      $modified_time = date('Y-m-d H:i:s');
      $sql = "UPDATE tbl_raw_prod_category SET delete_flag=1,push_flag=1,modified_time='$modified_time' WHERE id = '$id'";
      $conn->query($sql);
      
       $url = $_SERVER['REQUEST_URI'];
  $createddate = date('Y-m-d H:i:s');
  $sql = "INSERT INTO tbl_user_logs SET userid='$user_id',frid='$BillSoftFrId',url='$url',action='raw product category deleted',invid='$id',createddate='$createddate',roll='raw_prod_category'";
  $conn->query($sql);
  
      /* $query2 = "SELECT Photo FROM tbl_raw_prod_category WHERE id = '$id'";
    $result2 = $conn->query($query2);
    $row2 = $result2->fetch_assoc();
    $Photo = $row2['Photo'];
     $Photo2 = $row2['Photo2'];
      $query = "DELETE FROM tbl_raw_prod_category WHERE id = '$id'";
      $conn->query($query);
    
       $src = "../../uploads/$Photo";
        unlink($src);
         $src2 = "../../uploads/$Photo2";
        unlink($src2);*/
      echo "Delete Successfully";

  }

if($_POST['action'] == 'deletePhoto'){
    $id = $_POST['id'];
    $Photo = $_POST['Photo'];
        $q = "UPDATE tbl_raw_prod_category SET Photo='' WHERE id=$id";
        $conn->query($q);
        $src = "../../uploads/$Photo";
        unlink($src);

    echo "Category Photo Delete Successfully";
} 

if($_POST['action'] == 'deletePhoto2'){
    $id = $_POST['id'];
    $Photo = $_POST['Photo'];
        $q = "UPDATE tbl_raw_prod_category SET Photo2='' WHERE id=$id";
        $conn->query($q);
        $src = "../../uploads/$Photo";
        unlink($src);

    echo "Category Icon Delete Successfully";
} 
  if($_POST['action']=='view'){?>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
              <th>#</th>
              <th>Photo</th>
              
              <th>Category</th>
                <th>Sr No</th>
               <th>Status</th>
               
              
            </tr>
        </thead> 
        <tbody> 
          <?php 
 $srno = 1;
  $sql = "SELECT * FROM tbl_raw_prod_category WHERE CreatedBy IN ($BillSoftFrId) ORDER BY srno asc";
   $rx = $conn->query($sql);
  while($nx = $rx->fetch_assoc()){

  ?>
           <tr>
             <td><?php echo $nx["id"]; ?></td>
             <td><?php if($nx["Photo"] == '') {?>
                  <img src="no_image.jpg" class="img-fluid ui-w-40"  style="width: 40px;height: 40px;"> 
                 <?php } else if(file_exists('../../uploads/'.$nx["Photo"])){?>
                 <img src="../uploads/<?php echo $nx["Photo"];?>" class="img-fluid ui-w-40" style="width: 40px;height: 40px;">
                  <?php }  else{?>
                 <img src="no_image.jpg" class="img-fluid ui-w-40"> 
             <?php } ?></td>
           
             <td><?php echo $nx['Name']; ?></td>
            <td><?php echo $nx['srno']; ?></td>
             <td><?php if($nx['Status']=='1'){echo "<span style='color:green;'>Active</span>";} else { echo "<span style='color:red;'>Inactive</span>";} ?></td>
             
            
            </tr>
             <?php $srno++;} ?>
        </tbody>
    </table>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#example').DataTable( {
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5'
        ]
      });
      });
    </script>
 <?php }
?>