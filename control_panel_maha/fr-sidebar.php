<?php 
	$user_id = $_SESSION['Admin']['id'];
	$sql77 = "SELECT * FROM tbl_users WHERE id='$user_id'";
	$row77 = getRecord($sql77);
	$Roll = $row77['Roll'];
	$UserCat = $row77['CatId'];
	//echo $row77['Options'];
	$Options = explode(',',$row77['Options']);
	$ExpCatId = $row77['ExpCatId'];
	$BranchId = $row77['BranchId'];
	$CocoFranchiseAccess = $row77['CocoFranchiseAccess'];
 ?>
 <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
     <div class="app-brand demo">
                    <span class="app-brand-logo demo">
                        <a href="dashboard.php"><img src="logo33.png" alt="Brand Logo" class="img-fluid" style="width: 60px;"></a> 
                    </span>
                    <h3 style="font-size:18px; padding-left:10px;padding-top:10px;">Maha Chai</h3>
                   <!-- <a href="dashboard.php" class="app-brand-text demo sidenav-text font-weight-normal ml-2"><?php echo $Proj_Title; ?></a>-->
                    <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                        <i class="ion ion-md-menu align-middle"></i>
                    </a>
                </div>
                <div class="sidenav-divider mt-0"></div>
    <ul class="sidenav-inner">
        <li class="sidenav-item">
            <a href="fr-dashboard.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Dashboard</div>
                <?php if($Page=='Dashboard') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        
        <li class="sidenav-item">
            <a href="fr-franchises.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Franchise</div>
                <?php if($Page=='Franchise') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        
        <li class="sidenav-item">
            <a href="fr-employee.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Employee</div>
                <?php if($Page=='Employee') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        
       <!-- <li class="sidenav-item">
            <a href="fr-dashboard.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Attendance</div>
                <?php if($Page=='Attendance') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>-->
        
        <li class="sidenav-item <?php if($MainPage=='Task') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Task</div>
</a>
<ul class="sidenav-menu">
<li class="sidenav-item">
<a href="fr-add-task.php" class="sidenav-link">
<div> Add Task</div>
<?php if($Page=='Add-Task') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="fr-view-task.php" class="sidenav-link">
<div> View Task</div>
<?php if($Page=='View-Task') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li>
        
        <li class="sidenav-item <?php if($MainPage=='Report') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-bar-chart"></i>
<div>Report</div>
</a>
<ul class="sidenav-menu"> 
 


 <li class="sidenav-item">
<a href="fr-attendance-report.php" class="sidenav-link">
<div> Employee Attendace Report</div>
<?php if($Page=='Attendance-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="fr-month-attendance-report.php" class="sidenav-link">
<div> Employee Month Attendace Report</div>
<?php if($Page=='Month-Attendance-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="fr-attendance-report-2.php" class="sidenav-link">
<div> Employee Attendace Report 2</div>
<?php if($Page=='Attendance-Report-2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="fr-emp-location-report.php" class="sidenav-link">
<div> Employee Location Report</div>
<?php if($Page=='Employee-Location-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


 <li class="sidenav-item">
<a href="fr-employee-wallet-report.php" class="sidenav-link">
<div> Employee Wallet Report</div>
<?php if($Page=='Employee-Wallet-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


 <li class="sidenav-item">
<a href="fr-employee-wallet-outstanding.php" class="sidenav-link">
<div> Employee Wallet Outstanding</div>
<?php if($Page=='Employee-Wallet-Outstanding') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="fr-expenses-report2.php" class="sidenav-link">
<div> Expenses Report</div>
<?php if($Page=='Expenses-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>



</ul>
</li> 
        

    </ul>
</div>