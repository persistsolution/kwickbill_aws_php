<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];
$sql = "SELECT Lattitude,Longitude,PerDaySalary,SalaryType,CreditSalaryStatus,Roll,MgrCheckpoint,BdmCheckpoint FROM tbl_users WHERE id='$user_id'";
$row = getRecord($sql);
$Latitude = $row['Lattitude'];
$Longitude = $row['Longitude'];
$PerDaySalary = $row['PerDaySalary'];
$SalaryType = $row['SalaryType'];
$CreditSalaryStatus = $row['CreditSalaryStatus'];
$Roll = $row['Roll'];
$MgrCheckpoint = $row['MgrCheckpoint'];
$BdmCheckpoint = $row['BdmCheckpoint'];

function uploadImage($filename, $filesize, $tempfile, $latitude, $longitude) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed_ext = ['png', 'jpg', 'jpeg'];
    if (!in_array($ext, $allowed_ext)) return false;

    $new_name = md5(rand()) . '.' . $ext;
    $path = '../../attendanceimages/' . $new_name;

    list($width, $height) = getimagesize($tempfile);
    $src_image = ($ext === 'png') ? imagecreatefrompng($tempfile) : imagecreatefromjpeg($tempfile);

    // Resize image
    $new_width = 500;
    $new_height = ($height / $width) * 500;
    $image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($image, $src_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    // Overlay
    $overlay_height = 100;
    $overlay_color = imagecolorallocatealpha($image, 0, 0, 0, 70);
    imagefilledrectangle($image, 0, $new_height - $overlay_height, $new_width, $new_height, $overlay_color);

    // Text
    $white = imagecolorallocate($image, 255, 255, 255);
    $font = 5;
    $y = $new_height - $overlay_height + 10;
    $gap = 18;

    if (!empty($latitude) && !empty($longitude)) {
        imagestring($image, $font, 10, $y, "Lat: $latitude", $white); $y += $gap;
        imagestring($image, $font, 10, $y, "Lon: $longitude", $white); $y += $gap;
    } else {
        imagestring($image, $font, 10, $y, "Location not available", $white); $y += $gap;
    }

    imagestring($image, $font, 10, $y, "Time: " . date("d/m/y h:i A") . " GMT+5:30", $white);

    imagejpeg($image, $path, 100);
    imagedestroy($src_image);
    imagedestroy($image);

    return $new_name;
}




if($_POST['action'] == 'takeAttendance'){
    $date = $_POST['date'];
    $userid = $_POST['userid'];
    $sql55 = "SELECT Lattitude,Longitude FROM `tbl_users` WHERE id='$userid'";
    $row55 = getRecord($sql55);
    $Lattitude = $row55['Lattitude'];
    $Longitude = $row55['Longitude'];
    //$Status = $_POST['status'];
    $Status = 1;
    $SourceLat = $_POST['SourceLat'];
    $SourceLong = $_POST['SourceLong'];
    $SourceAddress = $_POST['SourceAddress'];
    $TempPrdId = $_POST['TempPrdId'];



    $CreatedTime = date('H:i:s');
    if($CreatedTime > '10:10:00'){
            $Latemark = 1;
        }
        else{
            $Latemark = 0;
        }
        
        if($CreatedTime > '14:00:00'){
            $HalfDay = 1;
        }
        else{
            $HalfDay = 0;
        }
        
        $FileName1 = $_FILES["Photo"]["name"];
$FileSize1 = $_FILES["Photo"]["size"];
$TempFile1 = $_FILES["Photo"]["tmp_name"];
$Image = uploadImage($FileName1,$FileSize1,$TempFile1,$Lattitude,$Longitude);



if($MgrCheckpoint==1){
$sql55 = "SELECT * FROM tbl_manager_checkpoint WHERE userid='$userid' AND CreatedDate='$date'";
$rncnt55 = getRow($sql55);
if($rncnt55 > 0){
     $sql = "SELECT * FROM tbl_attendance WHERE UserId='$userid' AND CreatedDate='$date' AND Type=1";
    $rncnt = getRow($sql);

    if($rncnt > 0){
        $sql2 = "UPDATE tbl_attendance SET Salary='$PerDaySalary',Status='$Status',Latitude='$SourceLat',Longitude='$SourceLong',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Photo='$Image',Type=1,TempPrdId='$TempPrdId' WHERE UserId='$userid' AND CreatedDate='$date' AND Type=1";
        $conn->query($sql2);
         echo 1;
       
    }
    else{
       $sql2 = "INSERT INTO tbl_attendance SET Salary='$PerDaySalary',Status='$Status',UserId='$userid',CreatedDate='$date',Latitude='$Latitude',Longitude='$Longitude',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Type=1,Photo='$Image',TempPrdId='$TempPrdId'";
        $conn->query($sql2);
      echo 1;
    }
 }
 else{
    echo 0;
 }
}

else if($BdmCheckpoint==1){
$sql55 = "SELECT * FROM tbl_bdm_checklist_records WHERE userid='$userid' AND visitdate='$date'";
$rncnt55 = getRow($sql55);
if($rncnt55 > 0){
     $sql = "SELECT * FROM tbl_attendance WHERE UserId='$userid' AND CreatedDate='$date' AND Type=1";
    $rncnt = getRow($sql);

    if($rncnt > 0){
        $sql2 = "UPDATE tbl_attendance SET Salary='$PerDaySalary',Status='$Status',Latitude='$SourceLat',Longitude='$SourceLong',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Photo='$Image',Type=1,TempPrdId='$TempPrdId' WHERE UserId='$userid' AND CreatedDate='$date' AND Type=1";
        $conn->query($sql2);
         echo 1;
       
    }
    else{
       $sql2 = "INSERT INTO tbl_attendance SET Salary='$PerDaySalary',Status='$Status',UserId='$userid',CreatedDate='$date',Latitude='$Latitude',Longitude='$Longitude',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Type=1,Photo='$Image',TempPrdId='$TempPrdId'";
        $conn->query($sql2);
      echo 1;
    }
 }
 else{
    echo 2;
 }
}

else{
    $sql = "SELECT * FROM tbl_attendance WHERE UserId='$userid' AND CreatedDate='$date' AND Type=1";
    $rncnt = getRow($sql);

    if($rncnt > 0){
        $sql2 = "UPDATE tbl_attendance SET Salary='$PerDaySalary',Status='$Status',Latitude='$SourceLat',Longitude='$SourceLong',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Photo='$Image',Type=1,TempPrdId='$TempPrdId' WHERE UserId='$userid' AND CreatedDate='$date' AND Type=1";
        $conn->query($sql2);
         echo 1;
       
    }
    else{
       $sql2 = "INSERT INTO tbl_attendance SET Salary='$PerDaySalary',Status='$Status',UserId='$userid',CreatedDate='$date',Latitude='$Latitude',Longitude='$Longitude',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Type=1,Photo='$Image',TempPrdId='$TempPrdId'";
        $conn->query($sql2);
      echo 1;
    }
}
    // $sql = "DELETE FROM tbl_crop_image WHERE UserId='$userid'";
    // $conn->query($sql);
   
}


if($_POST['action'] == 'takeAttendance2'){
    $date = $_POST['date'];
    $userid = $_POST['userid'];
    
     $sql55 = "SELECT Lattitude,Longitude FROM `tbl_users` WHERE id='$userid'";
    $row55 = getRecord($sql55);
    $Lattitude = $row55['Lattitude'];
    $Longitude = $row55['Longitude'];
    
    //$Status = $_POST['status'];
    $Status = 1;
    $SourceLat = $_POST['SourceLat'];
    $SourceLong = $_POST['SourceLong'];
    $SourceAddress = $_POST['SourceAddress'];
     $TempPrdId = $_POST['TempPrdId2'];

$HandoverAmt = $_POST['HandoverAmt'];
$HandoverUserId = $_POST['HandoverUserId'];
//     $randno = rand(1,100);
// $src = $_FILES['Photo']['tmp_name'];
// $fnm = substr($_FILES["Photo"]["name"], 0,strrpos($_FILES["Photo"]["name"],'.')); 
// $fnm = str_replace(" ","_",$fnm);
// $ext = substr($_FILES["Photo"]["name"],strpos($_FILES["Photo"]["name"],"."));
// $dest = '../../uploads/'. $randno . "_".$fnm . $ext;
// $imagepath =  $randno . "_".$fnm . $ext;
// if(move_uploaded_file($src, $dest))
// {
// $Photo = $imagepath ;
// } 
// else{
//     $Photo = $_POST['OldPhoto'];
// }

    $CreatedTime = date('H:i:s');
    if($CreatedTime > '10:10:00'){
            $Latemark = 1;
        }
        else{
            $Latemark = 0;
        }
        
        /*if($CreatedTime > '14:00:00'){
            $HalfDay = 1;
        }
        else{
            $HalfDay = 0;
        }*/
         
      $sql = "SELECT CreatedTime FROM tbl_attendance WHERE UserId='$userid' AND CreatedDate='$date' AND Type=1";
      $row = getRecord($sql);
        $StartTime = $row['CreatedTime'];
        $dateTime1 = new DateTime($CreatedTime); // Current date and time
$dateTime2 = new DateTime($StartTime); // 1 hour 45 minutes ago
// Calculate the difference between the two dates
$interval = $dateTime1->diff($dateTime2);
// Format the difference
$hours = $interval->h;
$minutes = $interval->i;

if($hours <= 6){
    $HalfDay = 1;
}
else if($hours > 6 && $hours <= 10){
    $HalfDay = 0;
}
else if($hours > 10){
    $HalfDay = 2;
}
        $FileName2 = $_FILES["Photo2"]["name"];
$FileSize2 = $_FILES["Photo2"]["size"];
$TempFile2 = $_FILES["Photo2"]["tmp_name"];
$Photo2 = uploadImage($FileName2,$FileSize2,$TempFile2,$Lattitude,$Longitude);

    $sql = "SELECT * FROM tbl_attendance WHERE UserId='$userid' AND CreatedDate='$date' AND Type=2";
    $rncnt = getRow($sql);
    
    // $sql2 = "SELECT * FROM tbl_crop_image WHERE UserId='$userid' AND SrNo=2";
    // $rncnt2 = getRow($sql2);
    // $row2 = getRecord($sql2);
    // $Image = $row2['Image'];
    if($rncnt > 0){
        $sql2 = "UPDATE tbl_attendance SET HandoverAmt='$HandoverAmt',HandoverUserId='$HandoverUserId',Salary='$PerDaySalary',Status='$Status',Latitude='$SourceLat',Longitude='$SourceLong',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Photo='$Photo2',Type=2,TempPrdId='$TempPrdId' WHERE UserId='$userid' AND CreatedDate='$date' AND Type=2";
        $conn->query($sql2);
        
        $sql = "DELETE FROM wallet WHERE UserId='$userid' AND CreatedDate='$date' AND Attendance='1'";
        $conn->query($sql);
         if($SalaryType == 1){
            if($CreditSalaryStatus == 1){
        $Narration = "Amount Added against today Attendance";
  $sql = "INSERT INTO wallet SET UserId='$userid',Amount='$PerDaySalary',Narration='$Narration',Status='Cr',CreatedDate='$date',CreatedTime='$CreatedTime',Attendance='1'";
  $conn->query($sql);
            }
        }
  
        echo 1;
        /*}
        else{
            echo 0;
        }*/
    }
    else{
        
       /* if($rncnt2 > 0){*/
       $sql2 = "INSERT INTO tbl_attendance SET HandoverAmt='$HandoverAmt',HandoverUserId='$HandoverUserId',Salary='$PerDaySalary',Status='$Status',UserId='$userid',CreatedDate='$date',Latitude='$Latitude',Longitude='$Longitude',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Photo='$Photo2',Type=2,TempPrdId='$TempPrdId'";
        $conn->query($sql2);
        if($SalaryType == 1){
            if($CreditSalaryStatus == 1){
                $Narration = "Amount Added against today Attendance";
  $sql = "INSERT INTO wallet SET UserId='$userid',Amount='$PerDaySalary',Narration='$Narration',Status='Cr',CreatedDate='$date',CreatedTime='$CreatedTime',Attendance='1'";
  $conn->query($sql);
  
            }
        }
          
        echo 1;
        /*}
        else{
            echo 0;
        }*/
    }
    
    $sql = "DELETE FROM tbl_crop_image WHERE UserId='$userid'";
    $conn->query($sql);
  
}


if($_POST['action'] == 'checkToday'){
    $date = $_POST['date'];
    $userid = $_POST['userid'];
     $sql = "SELECT * FROM tbl_attendance WHERE UserId='$userid' AND CreatedDate='$date'";
     $row = getRecord($sql);
     echo $row['Status'];
    
}

if($_POST['action'] == 'checkHoEmp'){
    $userid = $_POST['userid'];
    $sql = "SELECT * FROM tbl_users WHERE id='$userid' AND MainBrEmp=1";
    $rncnt = getRow($sql);
    
    $sql2 = "SELECT * FROM tbl_users WHERE id='$userid' AND MarkAttendance=1";
    $rncnt2 = getRow($sql2);
    if($rncnt > 0){
        echo 1;
    }
    else if($rncnt2 > 0){
        echo 2;
    }
    else{
        echo 0;
    }
}
?>