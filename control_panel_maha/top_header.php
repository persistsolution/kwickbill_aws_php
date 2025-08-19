<?php 
	$user_id = $_SESSION['Admin']['id'];
	$sql77 = "SELECT * FROM tbl_users WHERE id='$user_id'";
	$row77 = getRecord($sql77);
	$Roll = $row77['Roll'];
	$UserCat = $row77['CatId'];
	//echo $row77['Options'];
	$Options = explode(',',$row77['Options2']);
	$ExpCatId = $row77['ExpCatId'];
	$BranchId = $row77['BranchId'];
	$CocoFranchiseAccess = $row77['CocoFranchiseAccess'];
	$AssignFranchiseVedExp = $row77['AssignFranchiseVedExp'];
	$EmpStatus = $row77['EmpStatus'];
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


/* Hide submenu by default */
.sidenav-item .sidenav-menu {
    display: none;
    position: absolute;
    background-color: white;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    min-width: 200px;
    padding: 10px;
    z-index: 100;
}

/* Show submenu when parent is hovered */
.sidenav-item:hover > .sidenav-menu {
    display: block;
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
<nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-dark container-p-x" id="layout-navbar">
<div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
<a class="nav-item nav-link px-0 mr-lg-4" href="javascript:">
<i class="ion ion-md-menu text-large align-middle"></i>
</a>
</div>
<a href="dashboard.php" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
<!--<span class="app-brand-logo demo">-->
<img src="logo.jpg" alt="" class="img-fluid" style="width: 40px;">
<!--</span>-->
<span class="app-brand-text demo font-weight-normal ml-2" style="font-size: 22px;"><?php echo $Proj_Title; ?></span>
</a>


<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
<span class="navbar-toggler-icon"></span>
</button>
<div class="navbar-collapse collapse" id="layout-navbar-collapse">

<hr class="d-lg-none w-100 my-2">
<div class="navbar-nav align-items-lg-center ml-auto">


<div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">|</div>
<div class="demo-navbar-user nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
<span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
    <?php if($row77['Photo']=='') {?>
<img src="user_icon.jpg" alt class="d-block ui-w-30 rounded-circle">
<?php } else{?>
    <img src="../uploads/<?php echo $row77['Photo']; ?>" alt class="d-block ui-w-30 rounded-circle" style="width: 30px;height: 30px;">
<?php } ?>
<span class="px-1 mr-lg-2 ml-2 ml-lg-0"><?php echo $row77['Fname']." ".$row77['Lname']; ?></span>
</span>
</a>
<div class="dropdown-menu dropdown-menu-right">
<a href="change-password.php" class="dropdown-item">
<i class="feather icon-unlock text-muted"></i> &nbsp; Change Password</a>
<div class="dropdown-divider"></div>
<a href="logout.php" class="dropdown-item">
<i class="feather icon-power text-danger"></i> &nbsp; Log Out</a>
</div>
</div>
</div>
</div>
</nav>