
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
            <a href="dashboard.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Dashboard</div>
                <?php if($Page=='Dashboard') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>





<li class="sidenav-item <?php if($MainPage=='Notifications') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Notifications</div>
</a>
<ul class="sidenav-menu">
  
 <li class="sidenav-item">
<a href="customer-notifications.php" class="sidenav-link">

<div>Franchise Notifications</div>
<?php if($Page=='Customer-Notification') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="employee-notifications.php" class="sidenav-link">

<div>Employee Notifications</div>
<?php if($Page=='Employee-Notification') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 

</ul>
</li>


<li class="sidenav-item <?php if($MainPage=='Masters') {?> open active <?php } ?>">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-aperture"></i>
                <div>Masters</div>
            </a>
            <ul class="sidenav-menu">


	<?php if(in_array("1", $Options)) {?>
	<li class="sidenav-item <?php if($Page=='Location') {?> open active <?php } ?>">
	<a href="javascript:" class="sidenav-link sidenav-toggle">
	<div>Locations</div>
	</a>
	<ul class="sidenav-menu">
	<li class="sidenav-item">
	<a href="country.php" class="sidenav-link">
	<div>Country</div>
	<?php if($Page2=='Country') {?>
	<div class="pl-1 ml-auto">
	<span class="badge badge-dot badge-primary"></span>
	</div>
	<?php } ?>	
	</a>
	</li>
	<li class="sidenav-item">
	<a href="state.php" class="sidenav-link">
	<div>State</div>
	<?php if($Page2=='State') {?>
	<div class="pl-1 ml-auto">
	<span class="badge badge-dot badge-primary"></span>
	</div>
	<?php } ?>	
	</a>
	</li>
	<li class="sidenav-item">
	<a href="city.php" class="sidenav-link">
	<div>City</div>
	<?php if($Page2=='City') {?>
	<div class="pl-1 ml-auto">
	<span class="badge badge-dot badge-primary"></span>
	</div>
	<?php } ?>	
	</a>
	</li>
<!--	<li class="sidenav-item">
	<a href="area.php" class="sidenav-link">
	<div>Area</div>
	<?php if($Page2=='Area') {?>
	<div class="pl-1 ml-auto">
	<span class="badge badge-dot badge-primary"></span>
	</div>
	<?php } ?>	
	</a>
	</li>-->
	</ul>
	</li>
	<?php } ?>
	

<?php  if(in_array("5", $Options)) {?>
<li class="sidenav-item">
<a href="user-type.php" class="sidenav-link">
<div>User Type </div> 
<?php if($Page=='UserType') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>

<li class="sidenav-item">
<a href="view-upload-pdfs.php" class="sidenav-link">
<div> Download Center</div>
<?php if($Page=='View-Upload-Pdf') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="video-gallery.php" class="sidenav-link">
<div> MahaTube</div>
<?php if($Page=='Video-Gallery') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> 

<li class="sidenav-item">
<a href="image-gallery.php" class="sidenav-link">
<div> Image Gallery</div>
<?php if($Page=='Image-Gallery') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
        </li>

<?php if(in_array("37", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='E-Commerce') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-headphones"></i>
<div>E-Commerce</div>
</a>
<ul class="sidenav-menu"> 

<li class="sidenav-item">
<a href="payment-method.php" class="sidenav-link">
<div>Payment Method</div>
<?php if($Page=='PaymentMethod') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="cancel-reason.php" class="sidenav-link">
<div>Cancel Reason</div>
<?php if($Page=='Cancel-Reason') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="coupon-code.php" class="sidenav-link">
<div>Referral/Coupon/Offer Code</div>
<?php if($Page=='Coupon-Code') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="today-orders.php" class="sidenav-link">
<div> Today's Orders</div>
<?php if($Page=='Today-Orders') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<li class="sidenav-item">
<a href="view-orders.php" class="sidenav-link">
<div> View Orders</div>
<?php if($Page=='View-Orders') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="add-shop-product.php" class="sidenav-link">
<div> Add Product</div>
<?php if($Page=='Add-Product') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<li class="sidenav-item">
<a href="view-shop-products.php" class="sidenav-link">
<div> View Products</div>
<?php if($Page=='View-Product') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="shop-category.php" class="sidenav-link">
<div>Category </div> 
<?php if($Page=='Category') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
 <li class="sidenav-item">
<a href="shop-sub-category.php" class="sidenav-link">
<div>Sub Category</div>
<?php if($Page=='Sub-Category') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>	
</a>
</li> 

<!-- <li class="sidenav-item">
<a href="brands.php" class="sidenav-link">
<div>Brands</div>
<?php if($Page=='Brands') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> -->

<li class="sidenav-item">
<a href="attribute-value.php" class="sidenav-link">
<div>Product Attributes</div>
<?php if($Page=='Attributes') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> 

<li class="sidenav-item">
<a href="shipping-price.php" class="sidenav-link">
<div>Shipping Price</div>
<?php if($Page=='Shipping-Price') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


<li class="sidenav-item">
<a href="home-sliders.php" class="sidenav-link">
<div>Home Sliders</div>
<?php if($Page=='Home Slider') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="home-banners.php" class="sidenav-link">
<div>Home Banners</div>
<?php if($Page=='Home Banner') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="faqs.php" class="sidenav-link">
<div>Faq's</div>
<?php if($Page=='Faq') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li> 
<?php } ?>

<li class="sidenav-item">
<a href="about-us.php" class="sidenav-link">
    <i class="sidenav-icon feather icon-check-circle"></i>
<div> About Us</div>
<?php if($Page=='About') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<?php if(in_array("18", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='Customers') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Franchise</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>   
<li class="sidenav-item">
<a href="add-customer.php" class="sidenav-link">
<div> Add Franchise</div>
<?php if($Page=='Add-Customers') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-customers.php" class="sidenav-link">
<div> View Franchise</div>
<?php if($Page=='View-Customers') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
</ul>
</li>



<?php } if(in_array("21", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='Employee') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Employee</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>  
<li class="sidenav-item">
<a href="add-employee.php" class="sidenav-link">
<div> Add Employee</div>
<?php if($Page=='Add-Employee') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-employee.php" class="sidenav-link">
<div> View Employee</div>
<?php if($Page=='View-Employee') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li>

<?php } ?>

<li class="sidenav-item <?php if($MainPage=='Freelancer') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Freelancer</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>  
<li class="sidenav-item">
<a href="add-freelancer.php" class="sidenav-link">
<div> Add Freelancer</div>
<?php if($Page=='Add-Freelancer') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-freelancer.php" class="sidenav-link">
<div> View Freelancer</div>
<?php if($Page=='View-Freelancer') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li>

<li class="sidenav-item <?php if($MainPage=='Task') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Task</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>  
<li class="sidenav-item">
<a href="add-task.php" class="sidenav-link">
<div> Add Task</div>
<?php if($Page=='Add-Task') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-tasks.php" class="sidenav-link">
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

<!-- <li class="sidenav-item <?php if($MainPage=='Survey-Questions') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Survey Questions</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>  
<li class="sidenav-item">
<a href="add-survey.php" class="sidenav-link">
<div> Add Survey</div>
<?php if($Page=='Add-Survey') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-survey.php" class="sidenav-link">
<div> View Survey</div>
<?php if($Page=='View-Survey') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li> -->

<li class="sidenav-item <?php if($MainPage=='Customer-Query') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Franchise Query</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>  
<li class="sidenav-item">
<a href="add-customer-query.php" class="sidenav-link">
<div> Add Franchise Query</div>
<?php if($Page=='Add-Customer-Query') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-customer-query.php" class="sidenav-link">
<div> View Franchise Query</div>
<?php if($Page=='View-Customer-Query') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li>

 <li class="sidenav-item">
            <a href="executive-track.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Executive Track</div>
                <?php if($Page=='Executive-Track') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>

 <li class="sidenav-item">
            <a href="executive-visit.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Executive Visit</div>
                <?php if($Page=='Executive-Visit') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>


<?php  if(in_array("28", $Options)) {?>

<!-- <li class="sidenav-item <?php if($MainPage=='service') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-headphones"></i>
<div>Service Complaint</div>
</a>
<ul class="sidenav-menu">
<?php if(in_array("14", $Options)) {?>
<li class="sidenav-item">
<a href="service-module.php" class="sidenav-link">
<div> Add Service Complaint</div>
<?php if($Page=='Add-Sell') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-service-module.php" class="sidenav-link">
<div> View Service Complaint</div>
<?php if($Page=='View-Sell') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
</ul>
</li> -->

<?php } ?>
<li class="sidenav-item <?php if($MainPage=='Report') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-bar-chart"></i>
<div>Report</div>
</a>
<ul class="sidenav-menu"> 
 
 <li class="sidenav-item">
<a href="franchise-daily-survey-report.php" class="sidenav-link">
<div> Franchise Daily Survey Report</div>
<?php if($Page=='Franchise-Daily-Survey-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="franchise-query-report.php" class="sidenav-link">
<div> Franchise Query report</div>
<?php if($Page=='Franchise-Query-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="franchise-earn-point-report.php" class="sidenav-link">
<div> Franchise Earn Total Points</div>
<?php if($Page=='Franchise-Earn-Point-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="employee-daily-report.php" class="sidenav-link">
<div> Employee Daily Report</div>
<?php if($Page=='Employee-Daily-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="attendance-report.php" class="sidenav-link">
<div> Employee Attendace Report</div>
<?php if($Page=='Attendance-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="employee-visit-report.php" class="sidenav-link">
<div> Employee Daily Visit Report</div>
<?php if($Page=='Employee-Visit-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="employee-earn-point-report.php" class="sidenav-link">
<div> Employee Earn Point Report</div>
<?php if($Page=='Employee-Earn-Point-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="freelancer-visit-report.php" class="sidenav-link">
<div> Freelancer Daily Visit Report</div>
<?php if($Page=='Freelancer-Visit-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="freelancer-earn-point-report.php" class="sidenav-link">
<div> Freelancer Earn Point Report</div>
<?php if($Page=='Freelancer-Earn-Point-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


<?php if(in_array("38", $Options)) {?>

<!-- <li class="sidenav-item">
<a href="all-customer-report.php" class="sidenav-link">
<div> Customer Report</div>
<?php if($Page=='Customer-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> -->
<?php } if(in_array("39", $Options)) {?>
<!-- <li class="sidenav-item">
<a href="daily-record-report.php" class="sidenav-link">
<div> Daily Record Report</div>
<?php if($Page=='Daily-Record-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> -->
<?php } if(in_array("40", $Options)) {?>
<!-- <li class="sidenav-item">
<a href="attendance-report.php" class="sidenav-link">
<div> Attendance Report</div>
<?php if($Page=='Attendance-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> -->
<?php } ?>


</ul>
</li> 



<?php  if(in_array("33", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='Feedback') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-headphones"></i>
<div>Calling</div>
</a>
<ul class="sidenav-menu"> 
<li class="sidenav-item">
<a href="view-purchase-feedback.php" class="sidenav-link">
<div> Calling Customer List</div>
<?php if($Page=='Product-Feedback') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<li class="sidenav-item">
<a href="view-next-call-list.php" class="sidenav-link">
<div>  Today Calling List</div>
<?php if($Page=='Product-Feedback-Calling') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<li class="sidenav-item">
<a href="view-completed-list.php" class="sidenav-link">
<div>  Completed Customer List</div>
<?php if($Page=='Completed-Customer-List') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li> 

<?php }  if(in_array("36", $Options)) {?>
<!-- <li class="sidenav-item <?php if($MainPage=='Daily-Report') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-headphones"></i>
<div>Daily Record</div>
</a>
<ul class="sidenav-menu">
<?php if(in_array("14", $Options)) {?>
<li class="sidenav-item">
<a href="add-daily-report.php" class="sidenav-link">
<div> Add Daily Record</div>
<?php if($Page=='Add-Daily-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-daily-report.php" class="sidenav-link">
<div> View Daily Record</div>
<?php if($Page=='View-Daily-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
</ul>
</li> -->

<?php } ?>

        <li class="sidenav-item <?php if($MainPage=='Account') {?> open active <?php } ?>">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-settings"></i>
                <div><?php echo $row77['Fname']." ".$row77['Lname']; ?></div>
            </a>
            <ul class="sidenav-menu">
<?php 
 if($Roll == 1){?>
 <li class="sidenav-item ">
                    <a href="company-information.php" class="sidenav-link">
                        <div><i class="feather icon-unlock text-muted"></i> Company Profile</div>
                        <?php if($Page=='Company-Profile') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
            <?php } ?>
                <li class="sidenav-item ">
                    <a href="change-password.php" class="sidenav-link">
                        <div><i class="feather icon-unlock text-muted"></i> Change Password</div>
                        <?php if($Page=='Change-Password') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="logout.php" class="sidenav-link">
                        <div><i class="feather icon-power text-danger"></i> Log Out</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>