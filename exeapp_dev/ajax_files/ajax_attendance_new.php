<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];
$sql = "SELECT Lattitude,Longitude,PerDaySalary,SalaryType,CreditSalaryStatus FROM tbl_users WHERE id='$user_id'";
$row = getRecord($sql);
$Latitude = $row['Lattitude'];
$Longitude = $row['Longitude'];
$PerDaySalary = $row['PerDaySalary'];
$SalaryType = $row['SalaryType'];
$CreditSalaryStatus = $row['CreditSalaryStatus'];

function uploadImage($filename,$filesize,$tempfile){
    $name = $filename;
 $size = $filesize;
 $ext = end(explode(".", $name));
 $allowed_ext = array("png", "jpg", "jpeg");
 if(in_array($ext, $allowed_ext))
 {
   $new_image = '';
   $new_name = md5(rand()) . '.' . $ext;
   $path = '../../uploads/' . $new_name; 
   list($width, $height) = getimagesize($tempfile);
   if($ext == 'png')
   {
    $new_image = imagecreatefrompng($tempfile);
   }
   if($ext == 'jpg' || $ext == 'jpeg')  
            {  
               $new_image = imagecreatefromjpeg($tempfile);  
            }
            $new_width=500;
            $new_height = ($height/$width)*500;
            $tmp_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($tmp_image, $path, 100);
            imagedestroy($new_image);
            imagedestroy($tmp_image);
           return  $new_name;
  
 }
}

if($_POST['action'] == 'takeAttendance'){
    $date = $_POST['date'];
    $userid = $_POST['userid'];
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
$Image = uploadImage($FileName1,$FileSize1,$TempFile1);

     $sql = "SELECT * FROM tbl_attendance WHERE UserId='$userid' AND CreatedDate='$date' AND Type=1";
    $rncnt = getRow($sql);
    
//   $sql2 = "SELECT * FROM tbl_crop_image WHERE UserId='$userid' AND SrNo=1";
//      $rncnt2 = getRow($sql2);
//     $row2 = getRecord($sql2);
//     $Image = $row2['Image'];
    if($rncnt > 0){
        $sql2 = "UPDATE tbl_attendance SET Salary='$PerDaySalary',Status='$Status',Latitude='$SourceLat',Longitude='$SourceLong',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Photo='$Image',Type=1,TempPrdId='$TempPrdId' WHERE UserId='$userid' AND CreatedDate='$date' AND Type=1";
        $conn->query($sql2);
         echo 1;
       
    }
    else{
       $sql2 = "INSERT INTO tbl_attendance SET Salary='$PerDaySalary',Status='$Status',UserId='$userid',CreatedDate='$date',Latitude='$Latitude',Longitude='$Longitude',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Type=1,Photo='$Image',TempPrdId='$TempPrdId'";
        $conn->query($sql2);
        $AttId = mysqli_insert_id($conn);
        $number = count($_POST["Task"]);
        if($number > 0)  
        {  
         for($i=0; $i<$number; $i++)  
          {  
            if(trim($_POST["Task"][$i] != ''))  
              { 

                $Task = $_POST['Task'][$i];
                $sql = "INSERT INTO tbl_attendance_tasks SET AttId='$AttId',UserId='$userid',Task='$Task',CreatedDate='$date',Latitude='$Latitude',Longitude='$Longitude',Address='$SourceAddress',CreatedTime='$CreatedTime',Type=1,AttRoll=0";
                $conn->query($sql);

              }
          }
      }
      echo 1;
    }
    
    // $sql = "DELETE FROM tbl_crop_image WHERE UserId='$userid'";
    // $conn->query($sql);
   
}


if($_POST['action'] == 'takeAttendance2'){
    $date = $_POST['date'];
    $userid = $_POST['userid'];
    //$Status = $_POST['status'];
    $Status = 1;
    $SourceLat = $_POST['SourceLat'];
    $SourceLong = $_POST['SourceLong'];
    $SourceAddress = $_POST['SourceAddress'];
     $TempPrdId = $_POST['TempPrdId2'];

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
$Photo2 = uploadImage($FileName2,$FileSize2,$TempFile2);

    $sql = "SELECT * FROM tbl_attendance WHERE UserId='$userid' AND CreatedDate='$date' AND Type=2";
    $rncnt = getRow($sql);
    
    // $sql2 = "SELECT * FROM tbl_crop_image WHERE UserId='$userid' AND SrNo=2";
    // $rncnt2 = getRow($sql2);
    // $row2 = getRecord($sql2);
    // $Image = $row2['Image'];
    if($rncnt > 0){
        $sql2 = "UPDATE tbl_attendance SET Salary='$PerDaySalary',Status='$Status',Latitude='$Latitude',Longitude='$Longitude',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Photo='$Photo2',Type=2,TempPrdId='$TempPrdId' WHERE UserId='$userid' AND CreatedDate='$date' AND Type=2";
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
       $sql2 = "INSERT INTO tbl_attendance SET Salary='$PerDaySalary',Status='$Status',UserId='$userid',CreatedDate='$date',Latitude='$Latitude',Longitude='$Longitude',Address='$SourceAddress',CreatedTime='$CreatedTime',Latemark='$Latemark',HalfDay='$HalfDay',Photo='$Photo2',Type=2,TempPrdId='$TempPrdId'";
        $conn->query($sql2);
        $AttId = mysqli_insert_id($conn);
        $rncnt = $_POST['rncnt'];
        
        if($rncnt > 0){
            $number = count($_POST["TaskDone"]);
        if($number > 0)  
        {  
         for($i=0; $i<$number; $i++)  
          {  
            if(trim($_POST["TaskDone"][$i] != ''))  
              { 

                $TaskDone = $_POST['TaskDone'][$i];
                if($TaskDone == 1){
                    $TaskId = addslashes(trim($_POST['TaskId'][$i]));
                $sql = "UPDATE tbl_attendance_tasks SET TaskDone=1 WHERE id='$TaskId'";
                $conn->query($sql);
            }
              }
          }
      }
  }

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
?>