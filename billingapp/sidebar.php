<?php 
	$user_id = $_SESSION['Admin']['id'];
    $sql77 = "SELECT * FROM tbl_users_bill WHERE id='$user_id'";
	$row77 = getRecord($sql77);
    $Roll = $row77['Roll'];
    //$BillSoftFrId = $row77['BillSoftFrId'];
	$Options = explode(',',$row77['Options']);
	
	$uid = $_REQUEST['uid']; 
if($_REQUEST['uid'] == ''){
$sql11 = "SELECT * FROM tbl_users_bill WHERE id='$user_id'";
$row = getRecord($sql11);
$_SESSION['Admin'] = $row;
}   
else{
$sql11 = "SELECT * FROM tbl_users_bill WHERE id='$uid'";
$row = getRecord($sql11);
$_SESSION['Admin'] = $row;
}
 $Roll = $row['Roll'];
if($Roll == 5){
    $BillSoftFrId = $_SESSION['Admin']['id'];
}
else{
    $BillSoftFrId = $row77['BillSoftFrId'];
}

//echo $row77['Options'];
 ?>
 
 <style>
    .loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.4);
 /* background-image: url("04de2e31234507.564a1d23645bf.gif");
  background-repeat: no-repeat;
  background-position: center center; */
  transition: opacity 0.75s, visibility 0.75s;
  z-index:9999;
}

.loader--hidden {
  opacity: 0;
  visibility: hidden;
}

.loader::after {
  content: "";
  width: 75px;
  height: 75px;
  border: 5px solid #dddddd;
  border-top-color: #f26921;
  border-radius: 50%;
  animation: loading 0.75s ease infinite;
}

@keyframes loading {
  from {
    transform: rotate(0turn);
  }
  to {
    transform: rotate(1turn);
  }
}



</style>

<script>
    window.addEventListener("load", () => {
  const loader = document.querySelector(".loader");

  loader.classList.add("loader--hidden");

  loader.addEventListener("transitionend", () => {
    document.body.removeChild(loader);
  });
});

</script>

<!--<div class="loader"></div>-->

<div class="layout-wrapper layout-2">
<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
<div class="app-brand demo">
<span class="app-brand-logo demo">
<a href="dashboard.php" class="app-brand-text demo sidenav-text font-weight-normal ml-2">	
<img src="logo.jpg" alt="<?php echo $Proj_Title; ?>" class="img-fluid" style="height: 60px;">
</a>
</span>
<a href="dashboard.php" class="app-brand-text demo sidenav-text font-weight-normal ml-2">	
</a>
<a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
<i class="ion ion-md-menu align-middle" style="color: #000;"></i>
</a>
</div>
<div class="sidenav-divider mt-0"></div>
<ul class="sidenav-inner py-1">
<li class="sidenav-item">
<a href="dashboard.php" class="sidenav-link">
<i class="sidenav-icon feather icon-check-circle"></i>
<div>Dashboard</div>
<?php if($Page=='Dashboard') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


<li class="sidenav-item">
<a href="javascript:void(0)" onclick="goToOffline()" class="sidenav-link">
    <i class="sidenav-icon feather icon-check-circle"></i>
<div> Create/Tab Order</div>
<?php if($Page=='View-Customer-Invoice2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="view-today-orders.php" class="sidenav-link">
    <i class="sidenav-icon feather icon-check-circle"></i>
<div> Today Orders</div>
<?php if($Page=='View-Today-Orders') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


<li class="sidenav-item">
<a href="view-customer-invoices.php?Search=Search" class="sidenav-link">
    <i class="sidenav-icon feather icon-check-circle"></i>
<div> All Orders</div>
<?php if($Page=='View-Customer-Invoice') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


<li class="sidenav-item <?php if($MainPage=='Report') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-lock"></i>
<div>Reports</div>
</a>
<ul class="sidenav-menu">
<?php if(in_array("69", $Options)) {?> 
<li class="sidenav-item">
<a href="product-stock-report.php" class="sidenav-link">
<div> Product Stock Report</div>
<?php if($Page=='Product-Stock-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("99", $Options)) {?> 
<li class="sidenav-item">
<a href="fr-raw-product-stock-report.php" class="sidenav-link">
<div> Raw Product Stock Report</div>
<?php if($Page=='Raw-Product-Stock-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("71", $Options)) {?> 
<?php } if(in_array("93", $Options)) {?> 
<li class="sidenav-item">
<a href="sell-by-category-report.php?FromDate=<?php echo date('Y-m-d');?>&ToDate=<?php echo date('Y-m-d');?>" class="sidenav-link">
<div> Category Wise Sell Report</div>
<?php if($Page=='Sell-category-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("94", $Options)) {?> 
<li class="sidenav-item">
<a href="sell-by-product-report.php?FromDate=<?php echo date('Y-m-d');?>&ToDate=<?php echo date('Y-m-d');?>" class="sidenav-link">
<div> Product Wise Sell Report</div>
<?php if($Page=='Sell-Product-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
</ul>
</li> 


<li class="sidenav-item">
<a href="view-cash-book.php" class="sidenav-link">
    <i class="sidenav-icon feather icon-check-circle"></i> 
<div> Cash Book</div>
<?php if($Page=='View-Cash-Book') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> 


<li class="sidenav-item">
<a href="view-employee.php" class="sidenav-link">
    <i class="sidenav-icon feather icon-check-circle"></i> 
<div> Employees</div>
<?php if($Page=='View-Employee') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

  

 <li class="sidenav-item <?php if($MainPage=='Account2') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-lock"></i>
<div>Account Settings</div>
</a>
<ul class="sidenav-menu">
<li class="sidenav-item">
<a href="javascript:void(0)" onclick="logout()" class="sidenav-link">
<div><i class="feather icon-power text-danger"></i> Log Out</div>
</a>
</li>
</ul>
</li> 

</ul>
</div>

<script>
    function logout(){
       Android.logout();
       window.location.href="logout.php";
  }
  
   function goToOffline(){
      Android.goToOfflinePage();
   }
</script>