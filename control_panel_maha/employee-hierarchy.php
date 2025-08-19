<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Employee";
$Page = "View-Employee";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?></title>
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

   <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
     
    }

    h2 {
      text-align: center;
    }

    .tree {
      padding-left: 20px;
    }

    .tree ul {
      list-style: none;
      padding-left: 20px;
      position: relative;
    }

    .tree ul::before {
      content: '';
      position: absolute;
      top: 0;
      left: 10px;
      border-left: 2px solid #999;
      height: 100%;
    }

    .tree li {
      margin: 0;
      padding: 0 0 0 20px;
      position: relative;
    }

    .tree li::before {
      content: '';
      position: absolute;
      top: 40px;
      left: 0;
      width: 20px;
      height: 0;
      border-top: 2px solid #999;
    }

    .tree li:last-child::after {
      content: '';
      position: absolute;
      left: 10px;
      top: 10px;
      bottom: 0;
      width: 0;
      border-left: 2px solid #f4f4f4; /* hides vertical line after last child */
    }

    .tree li div {
      display: inline-block;
      padding: 8px 12px;
      border: 1px solid #ccc;
      background: #fff;
      border-radius: 5px;
      position: relative;
      z-index: 1;
    }
  </style>
  
<div class="layout-container">





<div class="layout-content">

<div class="container-fluid flex-grow-1 container-p-y">
<h4 class="font-weight-bold py-3 mb-0">Employee Hierarchy

</h4>
<?php 
$id = $_GET['id'];
    $sql = "SELECT tu.Fname,tut.Name,tu.UnderByUser FROM tbl_users tu 
    LEFT JOIN tbl_user_type tut ON tut.id=tu.Roll WHERE tu.id='".$_GET['id']."'";
    $row = getRecord($sql);
    
    $sql2 = "SELECT tu.Fname,tut.Name,tu.UnderByUser FROM tbl_users tu 
    LEFT JOIN tbl_user_type tut ON tut.id=tu.Roll WHERE tu.id='".$row['UnderByUser']."'";
    $row2 = getRecord($sql2);
    
    $sql3 = "SELECT tu.Fname,tut.Name FROM tbl_users tu 
    LEFT JOIN tbl_user_type tut ON tut.id=tu.Roll WHERE tu.id='".$row2['UnderByUser']."'";
    $row3 = getRecord($sql3);
?>
<div class="tree">
  <ul>
      <li style="padding-top: 10px;">
      <div><?php echo $row3['Fname'];?><br><small>👨‍💼 <?php echo $row3['Name'];?></small></div>
      <ul>
      <li style="padding-top: 10px;">
      <div><?php echo $row2['Fname'];?><br><small>👨‍💼 <?php echo $row2['Name'];?></small></div>
      <ul>
    <li style="padding-top: 10px;">
      <div><?php echo $row['Fname'];?><br><small>👨‍💼 <?php echo $row['Name'];?></small></div>
     
    </li>
    </ul>
    </li>
  </ul>
  </li>
  </ul>
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
