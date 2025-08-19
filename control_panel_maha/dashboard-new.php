<?php
session_start();
include_once 'config.php';
include_once 'auth.php';
$MainPage = "Dashboard";
$Page = "Dashboard";
$user_id = $_SESSION['Admin']['id'];
$sql77 = "SELECT * FROM tbl_users WHERE id='$user_id'";
$row77 = getRecord($sql77);
$Roll = $row77['Roll'];
$UserCat = $row77['CatId'];
$Options = explode(',', $row77['Options']);
/*if($Roll == 1 || $Roll == 7){}
else{
    echo "<script>window.location.href='dashboard2.php';</script>";
    exit();
}*/

/*function RandomStringGenerator($n)
{
    $generated_string = "";   
    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $len = strlen($domain);
    for ($i = 0; $i < $n; $i++)
    {
        $index = rand(0, $len - 1);
        $generated_string = $generated_string . $domain[$index];
    }
    return $generated_string;
} 
$n = 10;


$sql = "SELECT id FROM `tbl_users` WHERE Roll=5";
$row = getList($sql);
foreach($row as $result){
    $CreatedBy = $result['id'];
   
    $Code = RandomStringGenerator($n); 
    $Code2 = $Code."".$result2['id'];
    $sql3 = "INSERT INTO tbl_cust_products (ProductName,CatId,CgstPer,SgstPer,IgstPer,GstAmt,ProdPrice,MinPrice,Status,SrNo,Photo,CreatedBy)
        SELECT ProductName,CatId,CgstPer,SgstPer,IgstPer,GstAmt,ProdPrice,MinPrice,Status,SrNo,Photo,'$CreatedBy' FROM `tbl_cust_products` WHERE CreatedBy=0";
        $conn->query($sql3);
}


$sql = "SELECT * FROM tbl_cust_products WHERE code is null";
$row = getList($sql);
foreach($row as $result){
    $Code = RandomStringGenerator($n); 
    $Code2 = $Code."".$result['id'];
     $sql2 = "UPDATE tbl_cust_products SET code='$Code2' WHERE id='".$result['id']."'";
    $conn->query($sql2);
  
}*/
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> - Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />
    <?php include_once 'header_script.php'; ?>
</head>

<body>
    <style type="text/css">
        .mr_5 {
            margin-right: 3rem !important;
        }

        h6,
        .h6 {
            font-size: 12px;
        }
    </style>
    <style>
.dashboard-card {
    
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  transition: transform 0.2s, box-shadow 0.2s;
  text-decoration: none;
  display: block;
}
.dashboard-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}
.dashboard-card .card-body {
  padding: 20px;
}
.dashboard-card h6 {
  color: #333;
  font-weight: 600;
  margin-bottom: 5px;
}
.dashboard-card .count {
  font-size: 24px;
  font-weight: bold;
  color: #007bff;
}

</style>
    <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

            <?php include_once 'top_header.php';
            include_once 'sidebar.php'; ?>


            <div class="layout-container">




                <div class="layout-content">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                        </div>

                        <div class="row">
                            <?php if($Roll == 1){?>
<div class="col-sm-6 col-xl-12">
<h5>Admin Dashboard</h5>
</div>
                            <?php include 'incadmin-dashboard.php';?>
                            
                            <?php } if($Roll != 1){
                            if(in_array("17", $Options) || in_array("18", $Options) || in_array("28", $Options) || in_array("47", $Options) || in_array("48", $Options)){
                            ?>
                            
                            <div class="col-sm-6 col-xl-12">
                                <h5>Accountant Dashboard</h5>
                            </div>
 <?php include 'inc-accountant-dashboard.php';?>
    

                            <?php } if(in_array("45", $Options) || in_array("64", $Options) || in_array("65", $Options) || in_array("66", $Options) || in_array("67", $Options)){?>
                            <div class="col-sm-6 col-xl-12">
<h5>HR Dashboard</h5>
</div>
      <?php include 'inc-hr-dashboard.php';?>     
      
      <?php } if(in_array("44", $Options) || in_array("46", $Options) || in_array("68", $Options) || in_array("69", $Options) || in_array("70", $Options) || in_array("71", $Options)){?>
      <div class="col-sm-6 col-xl-12">
<h5>Manager Dashboard</h5>
</div>
      <?php include 'inc-manager-dashboard.php';?>  
      
       <?php } if(in_array("40", $Options)){?>
       <div class="col-sm-6 col-xl-12">
<h5>BDM Dashboard</h5>
</div>
      <?php include 'inc-bdm-dashboard.php';?>  
      
      <?php } if(in_array("41", $Options) || in_array("42", $Options)){?>
      <div class="col-sm-6 col-xl-12">
<h5>Purchase Dept Dashboard</h5>
</div>
      <?php include 'inc-purchase-dashboard.php';?>  
       <?php } if(in_array("43", $Options)){?>
      <div class="col-sm-6 col-xl-12">
<h5>NSO Dept Dashboard</h5>
</div>
      <?php include 'inc-nso-dashboard.php';?>  
                          
                    <?php } } ?>        
                            
                            
                            
                            <?php if(in_array("52", $Options) || in_array("53", $Options) || in_array("54", $Options) || in_array("55", $Options) || in_array("56", $Options) || in_array("57", $Options) || in_array("59", $Options)){?>
                            <div class="col-sm-6 col-xl-12">
<h5>User Account Dashboard</h5>
</div>
                           
                            <?php if(in_array("52", $Options)){?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="zones.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Zone</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT * FROM tbl_zone";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("53", $Options)){?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="sub-zones.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Sub Zone</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT * FROM tbl_sub_zone";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("54", $Options)){?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="view-assign-franchise-to-zone.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Assign Franchise To Zone</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT tpf.* FROM tbl_assign_fr_to_zone tpf INNER JOIN tbl_zone tz ON tz.id=tpf.zone";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("55", $Options)){?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="view-customers.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Franchise</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT tu.*,tut.Name As User_Type FROM tbl_users tu LEFT JOIN tbl_user_type tut ON tu.UserType=tut.id WHERE tu.Roll=5";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("56", $Options)){?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="view-employee.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Employee</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT * FROM tbl_users WHERE Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=0 AND Status=1";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-xl-2">
                                <a href="other-employee.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Other Employee</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT * FROM tbl_users WHERE Roll NOT IN(1,5,55,9,22,23,63,3) AND OtherEmp=1 AND Status=1";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("57", $Options)){?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="view-vendors.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Vendors</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT * FROM tbl_users WHERE Roll=3";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("59", $Options)){?>
                           
                            <div class="col-sm-6 col-xl-2">
                                <a href="view-freelancer.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Freelancer/Business Partner</h6>
                                                    <div class="count"><?php
                                                                           $sql4 = "SELECT * FROM tbl_users WHERE Roll IN(9,22,23)";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } } ?>






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