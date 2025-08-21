<style>
div.scrollmenu {
  background-color: #333;
  overflow: auto;
  white-space: nowrap;
}

div.scrollmenu a {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px;
  text-decoration: none;
}

div.scrollmenu a:hover {
  background-color: #777;
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

 <div class="sidenav bg-dark">
<div id="layout-sidenav" class=" <!--container--> layout-sidenav-horizontal sidenav-horizontal flex-grow-0 bg-dark" style="padding-left:15px;padding-right:15px;">
<div class="app-brand demo">
<span class="app-brand-logo demo">
<a href="dashboard.php" class="app-brand-text demo sidenav-text font-weight-normal ml-2">	
<img src="shalimarlogo.png" alt="<?php echo $Proj_Title; ?>" class="img-fluid" style="height: 60px;">
</a>
</span>
<a href="dashboard.php" class="app-brand-text demo sidenav-text font-weight-normal ml-2">	
</a>
<a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
<i class="ion ion-md-menu align-middle" style="color: #000;"></i>
</a>
</div>
<div class="sidenav-divider  mt-0"></div>
<ul class="sidenav-inner ">
    
   

<li class="sidenav-item <?php if($MainPage=='Pretty-Cash-Ho') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">

<div>Dashboard</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
            <a href="dashboard.php" class="sidenav-link">
                
                <div>Dashboard </div>
                <?php if($Page=='Dashboard') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
<?php  if(in_array("1", $Options)) {?>
 <li class="sidenav-item">
            <a href="expense-sale-dashboard.php" class="sidenav-link">
                
                <div>Sub Zone Expense VS Sale </div>
                <?php if($Page=='') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        <?php } if(in_array("2", $Options)) {?>
         <li class="sidenav-item">
            <a href="expense-sale-dashboard.php?value=zone" class="sidenav-link">
                
                <div>Zone Expense Vs Sale  </div>
                <?php if($Page=='') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        <?php } if(in_array("3", $Options)) {?>
         <li class="sidenav-item">
<a href="expense-sale-report.php" class="sidenav-link">
<div> Franchise Expense Vs Sale Report </div>
<?php if($Page=='Weekly-Sale-Report-2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>  
 </ul>
</li>  

<?php if(in_array("4", $Options) || in_array("5", $Options) || in_array("6", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='Pretty-Cash-Ho') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">

<div>Top Sell Dashboard</div>
</a>
<ul class="sidenav-menu">
    <?php  if(in_array("4", $Options)) {?>
 <li class="sidenav-item">
            <a href="expense-sale-dashboard.php?value=topsellzone" class="sidenav-link">
                
                <div>Zone Wise </div>
                <?php if($Page=='Dashboard') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
<?php } if(in_array("5", $Options)) {?>
 <li class="sidenav-item">
            <a href="expense-sale-dashboard.php?value=topsellsubzone" class="sidenav-link">
                
                <div>Sub Zone Wise </div>
                <?php if($Page=='') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        <?php } if(in_array("6", $Options)) {?>
        
         <li class="sidenav-item">
<a href="franchise-wise-top-sell-dashboard.php" class="sidenav-link">
<div> Franchise Wise </div>
<?php if($Page=='Weekly-Sale-Report-2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
 </ul>
</li> 

<?php } if(in_array("7", $Options)) {?>
<li class="sidenav-item">
<a href="view-franchises.php" class="sidenav-link">
<div>Franchise</div>
<?php if($Page=='View-Customers') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("8", $Options)) {?>
<li class="sidenav-item">
<a href="view-employee.php" class="sidenav-link">
<div> Employees</div>
<?php if($Page=='View-Employee') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("9", $Options) || in_array("12", $Options) || in_array("13", $Options) || in_array("15", $Options) || in_array("16", $Options) || in_array("17", $Options) || in_array("18", $Options) || in_array("19", $Options) || in_array("20", $Options) || in_array("21", $Options) || in_array("22", $Options) || in_array("68", $Options) || in_array("69", $Options)) {?>
<li class="sidenav-item <?php if($MainPage == 'Selling-Products'){?> open active <?php } ?>">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <div>Selling Products</div>
            </a>
            <ul class="sidenav-menu">
                <?php if(in_array("9", $Options)) {?>
                <li class="sidenav-item">
                    <a href="brands.php" class="sidenav-link">
                        <div>Brands</div>
                        <?php if($Page=='Brand') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("68", $Options)) {?>
                <li class="sidenav-item">
                    <a href="customer-category.php" class="sidenav-link">
                        <div>Category</div>
                        <?php if($Page=='Category') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("69", $Options)) {?>
                <li class="sidenav-item">
                    <a href="customer-sub-category.php" class="sidenav-link">
                        <div>Sub Category</div>
                        <?php if($Page=='SubCategory') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("12", $Options)) {?>
                <li class="sidenav-item">
                    <a href="view-customer-products.php" class="sidenav-link">
                        <div>MRP Products</div>
                        <?php if($Page=='Products') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("13", $Options)) {?>
                <li class="sidenav-item">
                    <a href="view-customer-making-products.php" class="sidenav-link">
                        <div>Making Products</div>
                        <?php if($Page=='Making-Products') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                
                <?php } if(in_array("15", $Options)) {?>
                <li class="sidenav-item">
                    <a href="view-allocate-products.php" class="sidenav-link">
                        <div> Allocate Products</div>
                        <?php if($Page=='Allocate-Products') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("16", $Options)) {?>
                <!-- <li class="sidenav-item">
                    <a href="view-allocate-products-vendor.php" class="sidenav-link">
                        <div> Allocate Products To Vendor</div>
                        <?php if($Page=='Allocate-Products') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li> -->
                <?php } if(in_array("17", $Options)) {?>
                <!-- <li class="sidenav-item">
                    <a href="common-master.php?pageid=3" class="sidenav-link">
                        <div>Division</div>
                        <?php if($Page=='Brand') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("18", $Options)) {?>
                <li class="sidenav-item">
                    <a href="common-master.php?pageid=4" class="sidenav-link">
                        <div>Segment</div>
                        <?php if($Page=='Brand') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("19", $Options)) {?>
                 <li class="sidenav-item">
                    <a href="common-master.php?pageid=5" class="sidenav-link">
                        <div>Family</div>
                        <?php if($Page=='Brand') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("20", $Options)) {?>
                <li class="sidenav-item">
                    <a href="common-master.php?pageid=6" class="sidenav-link">
                        <div>Class</div>
                        <?php if($Page=='Brand') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("21", $Options)) {?>
                <li class="sidenav-item">
                    <a href="common-master.php?pageid=7" class="sidenav-link">
                        <div>Mc. Desc</div>
                        <?php if($Page=='Brand') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("22", $Options)) {?>
                <li class="sidenav-item">
                    <a href="common-master.php?pageid=8" class="sidenav-link">
                        <div>Brand Desc</div>
                        <?php if($Page=='Brand') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li> -->
               <?php } ?>
                
            </ul>
        </li>
        
        <?php } if(in_array("23", $Options) || in_array("24", $Options) || in_array("25", $Options) || in_array("26", $Options) || in_array("27", $Options)) {?>
        <li class="sidenav-item <?php if($MainPage == 'Raw-Products'){?> open active <?php } ?>">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <div>Raw Products</div>
            </a>
            <ul class="sidenav-menu">
                <?php if(in_array("23", $Options)) {?>
                <li class="sidenav-item">
                    <a href="raw-product-category.php" class="sidenav-link">
                        <div>Category</div>
                        <?php if($Page=='Raw-Category') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("24", $Options)) {?>
                <li class="sidenav-item">
                    <a href="raw-product-sub-category.php" class="sidenav-link">
                        <div>Sub Category</div>
                        <?php if($Page=='Raw-Sub-Category') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("25", $Options)) {?>
                <li class="sidenav-item">
                    <a href="view-raw-products.php" class="sidenav-link">
                        <div> Products</div>
                        <?php if($Page=='View-Raw-Product') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
<?php } if(in_array("26", $Options)) {?>
                <li class="sidenav-item">
                    <a href="view-allocate-raw-products.php" class="sidenav-link">
                        <div> Allocate Products</div>
                        <?php if($Page=='Allocate-Raw-Products') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("27", $Options)) {?>
                <!-- <li class="sidenav-item">
                    <a href="view-allocate-raw-products-vendor.php" class="sidenav-link">
                        <div> Allocate Products To Vendor</div>
                        <?php if($Page=='Allocate-Products') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li> -->
                <?php } ?>
            </ul>
        </li>


 <?php } if(in_array("70", $Options) || in_array("118", $Options) || in_array("119", $Options) || in_array("120", $Options) || in_array("121", $Options)) {?>
        <li class="sidenav-item <?php if($MainPage == 'Raw-Products'){?> open active <?php } ?>">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <div>Godown Products</div>
            </a>
            <ul class="sidenav-menu">
                <?php if(in_array("118", $Options)) {?>
                <li class="sidenav-item">
                    <a href="godown-product-category.php" class="sidenav-link">
                        <div>Category</div>
                        <?php if($Page=='Raw-Category') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("119", $Options)) {?>
                <li class="sidenav-item">
                    <a href="godown-product-sub-category.php" class="sidenav-link">
                        <div>Sub Category</div>
                        <?php if($Page=='Raw-Sub-Category') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } if(in_array("70", $Options)) {?>
                <li class="sidenav-item">
                    <a href="view-other-products.php" class="sidenav-link">
                        <div> Products</div>
                        <?php if($Page=='View-Raw-Product') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
<?php } if(in_array("120", $Options)) {?>
                <li class="sidenav-item">
                    <a href="view-allocate-godown-products.php" class="sidenav-link">
                        <div> Allocate Godown Products</div>
                        <?php if($Page=='Allocate-Raw-Products') {?>
                        <div class="pl-1 ml-auto">
                            <span class="badge badge-dot badge-primary"></span>
                        </div>
                        <?php } ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </li>


<?php } if(in_array("28", $Options) || in_array("29", $Options) || in_array("30", $Options) || in_array("31", $Options) || in_array("32", $Options) || in_array("33", $Options) || in_array("34", $Options) || in_array("35", $Options)) {?>
 <li class="sidenav-item <?php if($MainPage=='Godown') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<div>Godown</div>
</a>
<ul class="sidenav-menu">
    <?php  if(in_array("28", $Options)) {?>
    <li class="sidenav-item">
<a href="view-godown.php" class="sidenav-link">
<div> Godown Account</div>
<?php if($Page=='View-Godown') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("29", $Options)) {?> 
<li class="sidenav-item">
<a href="add-godown-raw-prod-stock.php" class="sidenav-link">
<div> Add Godown Stock</div>
<?php if($Page=='Add-Godown-Stocks') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("30", $Options)) {?> 
<li class="sidenav-item">
<a href="view-godown-raw-prod-stock.php" class="sidenav-link">
<div> View Godown Stock</div>
<?php if($Page=='View-Godown-Stocks') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("31", $Options)) {?> 
<li class="sidenav-item">
<a href="upload-godown-stock-by-excel.php" class="sidenav-link">
<div> Upload Godown Stock</div>
<?php if($Page=='View-Godown-Stocks') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("122", $Options)) {?> 
<li class="sidenav-item">
<a href="view-transfer-godown-mrp-stock-to-franchise.php?FromDate=<?php echo date('Y-m-d');?>&ToDate=<?php echo date('Y-m-d');?>" class="sidenav-link">
<div> Transfer MRP Stock Godown To Franchise</div>
<?php if($Page=='Transfer-Raw-Stock-Godown-To-Franchise-COCO') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("32", $Options)) {?> 
<!--<li class="sidenav-item">
<a href="view-transfer-godwon-raw-stock-coco.php" class="sidenav-link">
<div> Transfer Stock Godown To COCO Franchise</div>
<?php if($Page=='Transfer-Raw-Stock-Godown-To-Franchise-COCO') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>-->
<?php } if(in_array("33", $Options)) {?> 
<!--<li class="sidenav-item">
<a href="view-transfer-godwon-raw-stock-fofo.php" class="sidenav-link">
<div> Transfer Stock Godown To FOFO Franchise</div>
<?php if($Page=='Transfer-Raw-Stock-Godown-To-Franchise-FOFO') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>-->

<?php } if(in_array("34", $Options)) {?> 
<!--<li class="sidenav-item">
<a href="view-transfer-godwon-raw-stock.php" class="sidenav-link">
<div> Transfer Stock Godown To Other Franchise</div>
<?php if($Page=='Transfer-Raw-Stock-Godown-To-Franchise') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>-->

<!--<li class="sidenav-item">
<a href="view-transfer-godwon-raw-stock.php" class="sidenav-link">
<div> Transfer Stock Godown To FOCO Franchise</div>
<?php if($Page=='Transfer-Raw-Stock-Godown-To-Franchise') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<li class="sidenav-item">
<a href="view-transfer-godwon-raw-stock.php" class="sidenav-link">
<div> Transfer Stock Godown To COFO Franchise</div>
<?php if($Page=='Transfer-Raw-Stock-Godown-To-Franchise') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>-->
<?php } if(in_array("35", $Options)) {?> 
<li class="sidenav-item">
<a href="return-godown-products.php" class="sidenav-link">
<div> Return Godown Product</div>
<?php if($Page=='Return-Godown-Product') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
    </ul>
    </li>


<?php } if(in_array("36", $Options) || in_array("37", $Options) || in_array("38", $Options)) {?>

 <li class="sidenav-item <?php if($MainPage=='Godown') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<div>Franchise Stock Request</div>
</a>
<ul class="sidenav-menu">
   
<?php if(in_array("36", $Options)) {?> 
<li class="sidenav-item">
<a href="view-mrp-product-stock-request.php" class="sidenav-link">
<div>MRP Product Stocks Request </div> 
<?php if($Page=='Approve-Request-Product-Stock') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("37", $Options)) {?> 
<li class="sidenav-item">
<a href="view-raw-product-stock-request.php" class="sidenav-link">
<div>Raw Product Stocks Request </div> 
<?php if($Page=='Create-Invoice-Product-Stock') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("38", $Options)) {?> 
<li class="sidenav-item">
<a href="view-other-product-stock-request.php" class="sidenav-link">
<div>Other Product Stocks Request</div>
<?php if($Page=='Return-Godown-Product') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
    </ul>
    </li>
 
    <?php } if(in_array("39", $Options) || in_array("40", $Options) || in_array("41", $Options) || in_array("42", $Options) || in_array("43", $Options)) {?> 
<li class="sidenav-item <?php if($MainPage=='Target-Complete') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<div>Target Complete</div>
</a>
<ul class="sidenav-menu">
    <?php if(in_array("39", $Options)) {?> 
    <li class="sidenav-item">
<a href="view-set-target.php" class="sidenav-link">
<div>Set Target</div>
<?php if($Page=='Set-Target') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("40", $Options)) {?> 
<li class="sidenav-item">
<a href="target-completion.php" class="sidenav-link">
<div>Target Completion</div>
<?php if($Page=='Target-Completion') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("41", $Options)) {?> 
<li class="sidenav-item">
<a href="target-completion-new.php" class="sidenav-link">
<div>Target Completion New</div>
<?php if($Page=='Target-Completion') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("42", $Options)) {?> 
<li class="sidenav-item">
<a href="target-completion-report.php" class="sidenav-link">
<div>Target Completion Report</div>
<?php if($Page=='Target-Completion-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("43", $Options)) {?> 
<li class="sidenav-item">
<a href="target-completion-report-date-wise.php" class="sidenav-link">
<div>Target Completion Report Date Wise</div>
<?php if($Page=='Target-Completion-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
</ul>
</li>

<?php } if(in_array("44", $Options) || in_array("45", $Options) || in_array("46", $Options) || in_array("47", $Options) || in_array("48", $Options) || in_array("49", $Options) || in_array("50", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='Report') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">

<div>Reports</div>
</a>
<ul class="sidenav-menu">
    <?php if(in_array("44", $Options)) {?> 
 <li class="sidenav-item">
<a href="daily-sale-report.php" class="sidenav-link">
<div> Daily Sale Report</div>
<?php if($Page=='Daily-Sale-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("45", $Options)) {?> 
 <li class="sidenav-item">
<a href="daily-sale-report-2.php" class="sidenav-link">
<div> Daily Sale Report 2</div>
<?php if($Page=='Daily-Sale-Report-2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("46", $Options)) {?> 
 <li class="sidenav-item">
<a href="weekly-sale-report.php" class="sidenav-link">
<div> Weekly Sale Report</div>
<?php if($Page=='Weekly-Sale-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("47", $Options)) {?> 
 <li class="sidenav-item">
<a href="weekly-sale-report-2.php" class="sidenav-link">
<div> Weekly Sale Report 2</div>
<?php if($Page=='Weekly-Sale-Report-2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("123", $Options)) {?> 
 <li class="sidenav-item">
<a href="date-wise-sale-report.php" class="sidenav-link">
<div> Date Wise Sale Report</div>
<?php if($Page=='Daily-Sale-Report-2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>



<!-- <li class="sidenav-item">
<a href="godown-stock-report.php" class="sidenav-link">
<div> Godown Stock Report</div>
<?php if($Page=='Godown-Stock-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>-->
<?php } if(in_array("48", $Options)) {?> 
 <li class="sidenav-item">
<a href="godown-product-stock-report.php" class="sidenav-link">
<div> Godown Product Stock report</div>
<?php if($Page=='Godown-Product-Stock-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("49", $Options)) {?> 
<li class="sidenav-item">
<a href="transfer-stock-godown-to-franchise-report.php" class="sidenav-link">
<div> Transfer Stock Godown To Franchise Report</div>
<?php if($Page=='Transfer-Stock-Godown-To-Franchise-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("50", $Options)) {?> 
<li class="sidenav-item">
<a href="transfer-stock-godown-to-franchise-report-2.php" class="sidenav-link">
<div> Transfer Stock Godown To Franchise Report 2</div>
<?php if($Page=='Transfer-Stock-Godown-To-Franchise-Report-2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
</ul>
</li> 

<?php } if(in_array("51", $Options) || in_array("52", $Options) || in_array("53", $Options) || in_array("54", $Options) || in_array("55", $Options) || in_array("56", $Options) || in_array("57", $Options) || in_array("58", $Options) || in_array("59", $Options)) {?> 

<li class="sidenav-item <?php if($MainPage=='Franchise-Report-2025') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">

<div>Franchise Reports</div>
</a>
<ul class="sidenav-menu"> 
<?php if(in_array("51", $Options)) {?> 
<li class="sidenav-item">
<a href="product-stock-report-2025.php?FromDate=<?php echo date('Y-m-d');?>&ToDate=<?php echo date('Y-m-d');?>&Search=Search" class="sidenav-link">
<div> Product Stock Report</div>
<?php if($Page=='Product-Stock-Report-2025') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("52", $Options)) {?> 
<li class="sidenav-item">
<a href="stock-report-new-2025.php" class="sidenav-link">
<div> Account Product Stock Report</div>
<?php if($Page=='Product-Stock-Report-2-2025') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<?php } if(in_array("53", $Options)) {?> 
<li class="sidenav-item">
<a href="fr-raw-product-stock-report-2025.php" class="sidenav-link">
<div> Raw Product Stock Report</div>
<?php if($Page=='Raw-Product-Stock-Report-2025') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("54", $Options)) {?> 
<li class="sidenav-item">
<a href="sell-by-category-report-2025.php?FromDate=<?php echo date('Y-m-d');?>&ToDate=<?php echo date('Y-m-d');?>" class="sidenav-link">
<div> Category Wise Sell Report</div>
<?php if($Page=='Sell-category-Report-2025') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("55", $Options)) {?> 
<li class="sidenav-item">
<a href="sell-by-product-report-2025.php?FromDate=<?php echo date('Y-m-d');?>&ToDate=<?php echo date('Y-m-d');?>" class="sidenav-link">
<div> Product Wise Sell Report</div>
<?php if($Page=='Sell-Product-Report-2025') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("56", $Options)) {?> 
<li class="sidenav-item">
<a href="sell-by-mrp-product-report-2025.php?FromDate=<?php echo date('Y-m-d');?>&ToDate=<?php echo date('Y-m-d');?>" class="sidenav-link">
<div>MRP Product Wise Sell Report</div>
<?php if($Page=='Sell-Product-Report-2025') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("57", $Options)) {?> 
<li class="sidenav-item">
<a href="category-sale-report.php?FromDate=<?php echo date('Y-m-d');?>&ToDate=<?php echo date('Y-m-d');?>" class="sidenav-link">
<div> Sell Report</div>
<?php if($Page=='Sell-Product-Report-2025') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("58", $Options)) {?> 
<li class="sidenav-item">
<a href="discount-report-2025.php" class="sidenav-link">
<div> Discount Report</div>
<?php if($Page=='Discount-Report-2025') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("59", $Options)) {?> 
<li class="sidenav-item">
<a href="cancelled-report.php" class="sidenav-link">
<div> Cancelled Report</div>
<?php if($Page=='Discount-Report-2025') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
</ul>
</li> 

<?php } if(in_array("60", $Options)) {?> 
<li class="sidenav-item">
<a href="discount-percentage.php" class="sidenav-link">
<div>Discount Percentage</div>
<?php if($Page=='Discount-Percentage') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("61", $Options) || in_array("62", $Options)) {?> 
<li class="sidenav-item <?php if($MainPage=='Financer') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<div>Financer/Partner</div>
</a>
<ul class="sidenav-menu">
    <?php  if(in_array("61", $Options)) {?>
    <li class="sidenav-item">
<a href="view-financer.php" class="sidenav-link">
<div> Financer/Partner Account</div>
<?php if($Page=='View-Financer') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("62", $Options)) {?>
<li class="sidenav-item">
<a href="view-commision-note.php" class="sidenav-link">
<div> Commision Note</div>
<?php if($Page=='Commision-Note') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>

    </ul>
    </li>
<?php } if(in_array("63", $Options) || in_array("64", $Options) || in_array("65", $Options) || in_array("66", $Options) || in_array("67", $Options)) {?>
<!-- <li class="sidenav-item <?php if($MainPage=='Franchise-Report') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">

<div>Franchise Reports 2024</div>
</a>
<ul class="sidenav-menu">   
<?php if(in_array("63", $Options)) {?>
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

<?php } if(in_array("64", $Options)) {?>
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
<?php } if(in_array("65", $Options)) {?>
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
<?php } if(in_array("66", $Options)) {?>
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
<?php } if(in_array("67", $Options)) {?>
<li class="sidenav-item">
<a href="discount-report.php" class="sidenav-link">
<div> Discount Report</div>
<?php if($Page=='Discount-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
</ul>
</li>  -->

<?php } ?>
 <li class="sidenav-item <?php if($MainPage=='Account2') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">

<div>Account Settings</div>
</a>
<ul class="sidenav-menu">
	
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
</div>
