
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
        
        <?php if(in_array("100", $Options)) {?>
        <!--<li class="sidenav-item">
            <a href="backup.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Daily DB Backup</div>
                <?php if($Page=='Backup') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>-->
     <?php } ?>
     
     
      <li class="sidenav-item">
            <a href="add-attendance.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Day Attendance</div>
                <?php if($Page=='Day-Attendance') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        <li class="sidenav-item">
            <a href="night-attendance.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Night Attendance</div>
                <?php if($Page=='Night-Attendance') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        
        <li class="sidenav-item">
            <a href="end-attendance.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Day End Attendance</div>
                <?php if($Page=='End-Attendance') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        
        <li class="sidenav-item">
            <a href="night-end-attendance.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Night End Attendance</div>
                <?php if($Page=='Night-End-Attendance') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
     <?php if(in_array("101", $Options)) {?>

        <li class="sidenav-item">
            <a href="customer-feedback-report.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Customer Feedback</div>
                <?php if($Page=='Customer-Feedback-Report') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        <?php } if(in_array("102", $Options)) {?>
         <li class="sidenav-item">
            <a href="boolet-rally-report.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Boolet Rally</div>
                <?php if($Page=='Boolet-Rally-Report') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        <?php } ?>
        
        <li class="sidenav-item">
            <a href="view-advance-salary.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Advance Salary</div>
                <?php if($Page=='Advance-Salary') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        
        <?php if($Roll == 1 || $Roll == 7){?>
        <!--<li class="sidenav-item">
            <a href="all-admin-pending-expense-request.php" class="sidenav-link">
               <i class="sidenav-icon feather icon-user"></i>
                <div>All Admin Pending Expenses</div>
                <?php if($Page=='All-Admin-Peding-Expense-Request') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>-->
        
         <li class="sidenav-item <?php if($MainPage=='HO-Admin-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>All Admin Expenses</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="ho-admin-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='HO-Admin-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="ho-admin-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='HO-Admin-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="ho-admin-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='HO-Admin-Reject-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  

        <?php } ?>
       
        <li class="sidenav-item <?php if($MainPage=='HO-Manager-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>All Manager Expenses 1st Level</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="ho-manager-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='HO-Manager-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="ho-manager-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='HO-Manager-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="ho-manager-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='HO-Manager-Reject-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  
        <?php  if($Roll == 1 || $Roll == 7){?>
        <!--<li class="sidenav-item <?php if($MainPage=='HO-Admin-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>HO Employee Admin Expenses</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="ho-admin-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='HO-Admin-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="ho-admin-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='HO-Admin-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="ho-admin-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='HO-Admin-Reject-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  -->

<?php } ?>
<!--<li class="sidenav-item <?php if($MainPage=='COCO-Manager-Expenses-Less-Than') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>FOCO/ COCO Employee Expenses Less Than 5000 - 1st Level</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="coco-manager-less-than-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='COCO-Manager-Peding-Expense-Request-Less-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="coco-manager-less-than-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='COCO-Manager-Approve-Expense-Request-Less-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="coco-manager-less-than-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='COCO-Manager-Reject-Expense-Request-Less-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li> -->

<li class="sidenav-item <?php if($MainPage=='COCO-Admin-Expenses-Less-Than') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>All Manager Expenses 2nd Level</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="coco-admin-less-than-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='COCO-Admin-Peding-Expense-Request-Less-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="coco-admin-less-than-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='COCO-Admin-Approve-Expense-Request-Less-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="coco-admin-less-than-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='COCO-Admin-Reject-Expense-Request-Less-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li> 


<!--<li class="sidenav-item <?php if($MainPage=='COCO-Manager-Expenses-More-Than') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>FOCO/ COCO Employee Expenses More Than 5000 - 1st Level</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="coco-manager-more-than-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='COCO-Manager-Peding-Expense-Request-More-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="coco-manager-more-than-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='COCO-Manager-Approve-Expense-Request-More-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="coco-manager-more-than-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='COCO-Manager-Reject-Expense-Request-More-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li> -->
<?php if($Roll == 1 || $Roll == 7){?>
<!--<li class="sidenav-item <?php if($MainPage=='COCO-Admin-Expenses-More-Than') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>FOCO/ COCO Employee Expenses More Than 5000 - 2nd Level</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="coco-admin-more-than-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='COCO-Admin-Peding-Expense-Request-More-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="coco-admin-more-than-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='COCO-Admin-Approve-Expense-Request-More-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="coco-admin-more-than-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='COCO-Admin-Reject-Expense-Request-More-Than') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li> -->
<?php } ?>

<?php if($user_id == 57){?>
<li class="sidenav-item <?php if($MainPage=='HR-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>HR Salary Expenses</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="hr-pending-expense-request.php" class="sidenav-link">

<div>Pending HR Request</div>
<?php if($Page=='HR-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="hr-approve-expense-request.php" class="sidenav-link">

<div>Approved HR Requests</div>
<?php if($Page=='HR-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="hr-reject-expense-request.php" class="sidenav-link">

<div>Rejected HR Requests</div>
<?php if($Page=='HR-Reject-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li> 

<?php } if($Roll == 1 || $Roll == 7){?>
<!--<li class="sidenav-item <?php if($MainPage=='Admin-Salary-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Salary Expenses Admin Approval</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="admin-salary-pending-expense-request.php" class="sidenav-link">

<div>Pending Salary Expense Request</div>
<?php if($Page=='Admin-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="admin-salary-approve-expense-request.php" class="sidenav-link">

<div>Approved Salary Expense Requests</div>
<?php if($Page=='Admin-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="admin-salary-reject-expense-request.php" class="sidenav-link">

<div>Rejected Salary Expense Requests</div>
<?php if($Page=='Admin-Reject-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li> --> 
<?php } if($Roll == 29){?>
 <!--<li class="sidenav-item <?php if($MainPage=='New-Execution-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>New Execution Manager Expenses</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="new-execution-manager-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='New-Execution-Manager-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="new-execution-manager-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='New-Execution-Manager-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="new-execution-manager-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='New-Execution-Manager-Reject-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  --> 

<?php } if($user_id == 5){?>
        
      <!--  <li class="sidenav-item <?php if($MainPage=='New-Execution-Admin-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>New Execution Admin (PK) Expenses</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="new-execution-admin-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='New-Execution-Admin-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="new-execution-admin-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='New-Execution-Admin-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="new-execution-admin-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='New-Execution-Admin-Reject-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  -->

<?php } if($Roll == 29){?>

<!--<li class="sidenav-item <?php if($MainPage=='Regular-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Regular Manager Expenses</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="regular-manager-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='Regular-Manager-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="regular-manager-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='Regular-Manager-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="regular-manager-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='Regular-Manager-Reject-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  -->
        
        <?php } if($user_id == 384){?>
        <!--<li class="sidenav-item <?php if($MainPage=='Regular-Admin-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Regular Admin (RG) Expenses</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="regular-admin-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='Regular-Admin-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="regular-admin-approve-expense-request.php" class="sidenav-link">

<div>Approved Expense Requests</div>
<?php if($Page=='Regular-Admin-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="regular-admin-reject-expense-request.php" class="sidenav-link">

<div>Rejected Expense Requests</div>
<?php if($Page=='Regular-Admin-Reject-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li> --> 
<?php } ?>

        <?php if($user_id == 475){?>
         <li class="sidenav-item">
            <a href="view-approve-expenses.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Approve Expenses</div>
                <?php if($Page=='Approve-Expenses') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>
        <?php } ?>
        
        <?php if($Roll == 36 || $Roll == 1 || $Roll == 119 || $Roll == 111){?>
        <li class="sidenav-item <?php if($MainPage=='Cash-Book') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Cash Book</div>
</a>
<ul class="sidenav-menu">
    <?php if($Roll == 36 || $Roll == 1 || $Roll == 119 || $Roll == 111){?>
     <li class="sidenav-item">
<a href="add-cash-book.php" class="sidenav-link">

<div>Add Cash Book</div>
<?php if($Page=='Add-Cash-Book') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="view-cash-book.php" class="sidenav-link">

<div>View Cash Book</div>
<?php if($Page=='View-Cash-Book') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>

    <li class="sidenav-item">
<a href="fr-bill-outstanding.php" class="sidenav-link">

<div>Franchise Bill Outstanding</div>
<?php if($Page=='Franchise-Outstanding') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="pending-cash-book-request.php" class="sidenav-link">

<div>Pending Cash Book Request</div>
<?php if($Page=='Pending-Cash-Book-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="approve-cash-book-request.php" class="sidenav-link">

<div>Approved Cash Book Requests</div>
<?php if($Page=='Approve-Cash-Book-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


<li class="sidenav-item">
<a href="reject-cash-book-request.php" class="sidenav-link">

<div>Rejected Cash Book Requests</div>
<?php if($Page=='Reject-Cash-Book-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
 </ul>
</li>   
        
<?php } ?> 

<?php if($Roll == 1){?>

<li class="sidenav-item <?php if($MainPage=='Pretty-Cash-Ho') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Admin Pretty Cash Request (HO Employee)</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="ho-pending-pretty-cash-request.php" class="sidenav-link">

<div>Pending Pretty Cash Request</div>
<?php if($Page=='Ho-Pending-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="ho-approve-pretty-cash-request.php" class="sidenav-link">

<div>Approved Pretty Cash Requests</div>
<?php if($Page=='Ho-Approve-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="ho-reject-pretty-cash-request.php" class="sidenav-link">

<div>Rejected Pretty Cash Requests</div>
<?php if($Page=='Ho-Reject-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  

<li class="sidenav-item <?php if($MainPage=='Pretty-Cash-Manager') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>CEO Pretty Cash Request (FOFO/COCO)</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="manager-pending-pretty-cash-request.php" class="sidenav-link">

<div>Pending Pretty Cash Request</div>
<?php if($Page=='Manager-Pending-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="manager-approve-pretty-cash-request.php" class="sidenav-link">

<div>Approved Pretty Cash Requests</div>
<?php if($Page=='Manager-Approve-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="manager-reject-pretty-cash-request.php" class="sidenav-link">

<div>Rejected Pretty Cash Requests</div>
<?php if($Page=='Manager-Reject-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  


<li class="sidenav-item <?php if($MainPage=='Admin-Above-Pretty-Cash') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Admin Pretty Cash Request (FOFO/COCO) Above 10000</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="admin-above-pending-pretty-cash-request.php" class="sidenav-link">

<div>Pending Pretty Cash Request</div>
<?php if($Page=='Admin-Above-Pending-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="admin-above-approve-pretty-cash-request.php" class="sidenav-link">

<div>Approved Pretty Cash Requests</div>
<?php if($Page=='Admin-Above-Approve-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="admin-above-reject-pretty-cash-request.php" class="sidenav-link">

<div>Rejected Pretty Cash Requests</div>
<?php if($Page=='Admin-Above-Reject-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  
<?php } ?>


<?php if($Roll == 36 || $Roll == 1){?>

    
    <li class="sidenav-item <?php if($MainPage=='Pretty-Cash-Account') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Account Pretty Cash Request</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="account-pending-pretty-cash-request.php" class="sidenav-link"> 

<div>Pending Pretty Cash Request</div>
<?php if($Page=='Account-Pending-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="account-approve-pretty-cash-request.php" class="sidenav-link">

<div>Approved Pretty Cash Requests</div>
<?php if($Page=='Account-Approve-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="account-reject-pretty-cash-request.php" class="sidenav-link">

<div>Rejected Pretty Cash Requests</div>
<?php if($Page=='Account-Reject-Pretty-Cash-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  

    <li class="sidenav-item <?php if($MainPage=='Account-Vendor-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Account Vendor Expenses</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="account-vendor-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='Account-Vendor-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="account-vendor-approve-expense-request.php" class="sidenav-link">

<div>Approve/Reject Expense Requests</div>
<?php if($Page=='Account-Vendor-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
 </ul>
</li>   
<?php } ?>

<?php if(in_array("9", $Options)) {?>
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
<?php } ?>

<?php if(in_array("103", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='Complaints') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Complaints</div>
</a>
<ul class="sidenav-menu">
    <li class="sidenav-item">
<a href="add-complaints.php" class="sidenav-link">
<div>Add Complaints</div>
<?php if($Page=='Add-Complaints') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<li class="sidenav-item">
<a href="view-complaints.php" class="sidenav-link">
<div>View Complaints</div>
<?php if($Page=='View-Complaints') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="allocate-complaints.php" class="sidenav-link">
<div>Allocate Complaints</div>
<?php if($Page=='Allocate-Complaints') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="view-complaints.php?Status=1" class="sidenav-link">
<div>Pending Complaints</div>
<?php if($Page=='View-Complaints-1') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="view-complaints.php?Status=2" class="sidenav-link">
<div>In Process Complaints</div>
<?php if($Page=='View-Complaints-2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>man
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="view-complaints.php?Status=3" class="sidenav-link">
<div>Reject Complaints</div>
<?php if($Page=='View-Complaints-3') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="view-complaints.php?Status=4" class="sidenav-link">
<div>Completed Complaints</div>
<?php if($Page=='View-Complaints-4') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li>
<?php } ?>

<?php if(in_array("104", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='Asset') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Asset management</div>
</a>
<ul class="sidenav-menu">
    <li class="sidenav-item">
<a href="add-asset.php" class="sidenav-link">
<div>Add Asset</div>
<?php if($Page=='Add-Asset') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<li class="sidenav-item">
<a href="view-assets.php" class="sidenav-link">
<div>View Assets</div>
<?php if($Page=='View-Asset') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


</ul>
</li>
<?php } ?>
<?php if(in_array("1", $Options) || in_array("2", $Options) || in_array("3", $Options) || in_array("4", $Options) || in_array("5", $Options) || in_array("6", $Options) || in_array("7", $Options) || in_array("8", $Options)) {?>
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
<div>Designation </div> 
<?php if($Page=='UserType') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="departments.php" class="sidenav-link">
<div>Departments </div> 
<?php if($Page=='Departments') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="franchaise-location.php" class="sidenav-link">
<div>Franchise Locations </div> 
<?php if($Page=='Franchise-Location') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<?php } if(in_array("2", $Options)) {?>
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
<?php } if(in_array("3", $Options)) {?>
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
<?php } if(in_array("4", $Options)) {?>
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
<?php } if(in_array("6", $Options)) {?>
<li class="sidenav-item">
	<a href="cashback-amount.php" class="sidenav-link">
	<div>Cashback Amount</div>
	<?php if($Page=='Cashback-Amount') {?>
	<div class="pl-1 ml-auto">
	<span class="badge badge-dot badge-primary"></span>
	</div>
	<?php } ?>	
	</a>
	</li>
<?php } if(in_array("7", $Options)) {?>
<li class="sidenav-item">
	<a href="sale-price-range.php" class="sidenav-link">
	<div>Shopping Cashback Price Range</div>
	<?php if($Page=='Sell-Price-Range') {?>
	<div class="pl-1 ml-auto">
	<span class="badge badge-dot badge-primary"></span>
	</div>
	<?php } ?>	
	</a>
	</li>
<?php } if(in_array("8", $Options)) {?>
	<li class="sidenav-item">
	<a href="add-money-price-range.php" class="sidenav-link">
	<div>Add Money Cashback Price Range</div>
	<?php if($Page=='Money-Price-Range') {?>
	<div class="pl-1 ml-auto">
	<span class="badge badge-dot badge-primary"></span>
	</div>
	<?php } ?>	
	</a>
	</li>
<?php } ?>

	<li class="sidenav-item">
	<a href="outlet-audit-category.php" class="sidenav-link">
	<div>Outlet Audit Category</div>
	<?php if($Page=='Outlet-Audit-Category') {?>
	<div class="pl-1 ml-auto">
	<span class="badge badge-dot badge-primary"></span>
	</div>
	<?php } ?>	
	</a>
	</li>
	
		<li class="sidenav-item">
	<a href="outlet-audit-questions.php" class="sidenav-link">
	<div>Outlet Audit Questions</div>
	<?php if($Page=='Outlet-Audit-Questions') {?>
	<div class="pl-1 ml-auto">
	<span class="badge badge-dot badge-primary"></span>
	</div>
	<?php } ?>	
	</a>
	</li>
</ul>
</li>

<?php } if(in_array("12", $Options) || in_array("13", $Options) || in_array("15", $Options) || in_array("16", $Options) || in_array("17", $Options) || in_array("18", $Options) || in_array("19", $Options) || in_array("20", $Options) || in_array("21", $Options) || in_array("22", $Options) || in_array("23", $Options) || in_array("24", $Options) || in_array("25", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='E-Commerce') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-headphones"></i>
<div>E-Commerce</div>
</a>
<ul class="sidenav-menu"> 
<?php if(in_array("12", $Options)) {?>
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
<?php } if(in_array("13", $Options)) {?>
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
<?php } if(in_array("15", $Options)) {?>
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
<?php } if(in_array("16", $Options)) {?>
<li class="sidenav-item">
<a href="add-orders.php" class="sidenav-link">
<div> Generate Orders</div>
<?php if($Page=='Generate-Qty-Orders') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("17", $Options)) {?>
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
<?php } if(in_array("18", $Options)) {?>
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
<?php } if(in_array("19", $Options)) {
if(in_array("14", $Options)) {?>
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
<?php } ?>
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
<a href="view-stocks.php" class="sidenav-link">
<div> Products Stock</div>
<?php if($Page=='View-Stock') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("19", $Options)) {?>

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
<?php } if(in_array("20", $Options)) {?>
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
<?php } if(in_array("21", $Options)) {?>
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
<?php } if(in_array("22", $Options)) {?>
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

<?php } if(in_array("23", $Options)) {?>
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
<?php } if(in_array("24", $Options)) {?>
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
<?php } if(in_array("25", $Options)) {?>
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
<?php } ?>
</ul>
</li> 
<?php } ?>

<?php if(in_array("37", $Options)) {?>
<!-- <li class="sidenav-item <?php if($MainPage=='E-Commerce-Employee') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-headphones"></i>
<div>E-Commerce Employee</div>
</a>
<ul class="sidenav-menu"> 


<li class="sidenav-item">
<a href="employee-today-orders.php" class="sidenav-link">
<div> Today's Orders</div>
<?php if($Page=='Employee-Today-Orders') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<li class="sidenav-item">
<a href="employee-view-orders.php" class="sidenav-link">
<div> View Orders</div>
<?php if($Page=='Employee-View-Orders') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="add-employee-shop-product.php" class="sidenav-link">
<div> Add Product</div>
<?php if($Page=='Add-Employee-Product') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<li class="sidenav-item">
<a href="view-employee-shop-products.php" class="sidenav-link">
<div> View Products</div>
<?php if($Page=='View-Employee-Product') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


</ul>
</li>  -->
<?php } ?>

<?php  if(in_array("26", $Options)) {?>
<!--<li class="sidenav-item">
<a href="about-us.php" class="sidenav-link">
    <i class="sidenav-icon feather icon-check-circle"></i>
<div> About Us</div>
<?php if($Page=='About') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>-->

<?php } if(in_array("27", $Options)) {?>
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
<?php } if(in_array("28", $Options)) {?>

<li class="sidenav-item <?php if($MainPage=='Customers2') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Customer</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>   
<li class="sidenav-item">
<a href="add-customer2.php" class="sidenav-link">
<div> Add Customer</div>
<?php if($Page=='Add-Customers2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-customers2.php" class="sidenav-link">
<div> View Customer</div>
<?php if($Page=='View-Customers2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
</ul>
</li>

<?php } if(in_array("29", $Options)) {?>
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

<li class="sidenav-item <?php if($MainPage=='Vendors') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
    <i class="sidenav-icon feather icon-check-circle"></i> 
<div>Vendors</div>
</a>
<ul class="sidenav-menu">
 <?php if(in_array("14", $Options)) {?>    
<li class="sidenav-item">
<a href="add-vendor.php" class="sidenav-link">
<div> Add Vendor</div>
<?php if($Page=='Add-Vendors') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> 
<?php } ?>
<li class="sidenav-item">
<a href="view-vendors.php" class="sidenav-link">
<div> View Vendors</div>
<?php if($Page=='View-Vendors') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
</ul>
</li>

<!--<li class="sidenav-item <?php if($MainPage=='Service-Manager') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Service Manager</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>  
<li class="sidenav-item">
<a href="add-service-manager.php" class="sidenav-link">
<div> Add Service Manager</div>
<?php if($Page=='Add-Service-Manager') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-service-manager.php" class="sidenav-link">
<div> View Service Manager</div>
<?php if($Page=='View-Service-Manager') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li>

<li class="sidenav-item <?php if($MainPage=='Flexi-Manager') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Flexi Manager</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>  
<li class="sidenav-item">
<a href="add-flexi-manager.php" class="sidenav-link">
<div> Add Flexi Manager</div>
<?php if($Page=='Add-Flexi-Manager') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-flexi-manager.php" class="sidenav-link">
<div> View Flexi Manager</div>
<?php if($Page=='View-Flexi-Manager') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li>


<li class="sidenav-item <?php if($MainPage=='Sales-Lead-Manager') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Sales Lead Manager</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>  
<li class="sidenav-item">
<a href="add-sales-lead-manager.php" class="sidenav-link">
<div> Add Sales Lead Manager</div>
<?php if($Page=='Add-Sales-Lead-Manager') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
<li class="sidenav-item">
<a href="view-sales-lead-manager.php" class="sidenav-link">
<div> View Sales Lead Manager</div>
<?php if($Page=='View-Sales-Lead-Manager') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
</ul>
</li>-->
<?php } ?>

<?php 
if($Roll == '9' || $Roll == '22' || $Roll == '23'){?>
<li class="sidenav-item <?php if($MainPage=='Freelancer') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>My Partner</div>
</a>
<ul class="sidenav-menu">

<li class="sidenav-item">
<a href="add-freelancer-2.php" class="sidenav-link">
<div> Add Business Partner</div>
<?php if($Page=='Add-Freelancer') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="view-freelancer-2.php" class="sidenav-link">
<div> View My Partner</div>
<?php if($Page=='View-Freelancer') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li>
<?php } else {
if(in_array("30", $Options)) {?>  
<li class="sidenav-item <?php if($MainPage=='Freelancer') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Freelancer/Business Partner</div>
</a>
<ul class="sidenav-menu">
   <?php if(in_array("14", $Options)) {?>  
<li class="sidenav-item">
<a href="add-freelancer.php" class="sidenav-link">
<div> Add Business Partner</div>
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
<div> View Business Partner</div>
<?php if($Page=='View-Freelancer') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

</ul>
</li>
<?php } } if(in_array("31", $Options)) {?>  
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
<?php } ?>
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

<?php if(in_array("32", $Options)) {?>  
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
<?php } if(in_array("33", $Options)) {?>  
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
        
        <?php } if(in_array("47", $Options)) {?>  
<!-- <li class="sidenav-item">
            <a href="resign-requests.php" class="sidenav-link">
                <i class="sidenav-icon feather icon-home"></i>
                <div>Resign Requests</div>
                <?php if($Page=='Resign-Requests') {?>
                <div class="pl-1 ml-auto">
                    <span class="badge badge-dot badge-primary"></span>
                </div>
                <?php } ?>
            </a>
        </li>-->
<?php } if(in_array("34", $Options)) {?>  
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


<?php } if(in_array("35", $Options) || in_array("43", $Options) || in_array("44", $Options) || in_array("46", $Options)) {?>  
<li class="sidenav-item <?php if($MainPage=='Account') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Leads</div>
</a>
<ul class="sidenav-menu">
<?php if(in_array("35", $Options)) {?>  
 <li class="sidenav-item">
<a href="lead-aprroval.php" class="sidenav-link">

<div>Leads</div>
<?php if($Page=='Lead-Approval') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> 
<?php } if(in_array("43", $Options)) {?>  
<li class="sidenav-item">
<a href="allocate-leads.php" class="sidenav-link">

<div>Allocate Leads</div>
<?php if($Page=='Allocate-Leads') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("44", $Options)) {?>  
<li class="sidenav-item">
<a href="view-allocate-leads.php" class="sidenav-link">

<div>View Allocate Leads</div>
<?php if($Page=='Allocate-Leads') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("46", $Options)) {?>  
<li class="sidenav-item">
<a href="today-calling-leads.php" class="sidenav-link">

<div>Today Calling Leads</div>
<?php if($Page=='Today-Calling-Leads') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?> 
</ul>
</li>
<?php } 
if($user_id == 5){
if(in_array("42", $Options)) {?>

<!--<li class="sidenav-item <?php if($MainPage=='Account') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Expenses</div>
</a>
<ul class="sidenav-menu">
<?php if(in_array("42", $Options)) {?>  
<li class="sidenav-item">
<a href="manager-expense-request.php" class="sidenav-link">

<div>Manager Approve Expense Request</div>
<?php if($Page=='Manager-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> 
<?php } if(in_array("36", $Options)) {?>  
 <li class="sidenav-item">
<a href="expense-request.php" class="sidenav-link">

<div>Account/Admin Expense Request</div>
<?php if($Page=='Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="expense-request2.php" class="sidenav-link">

<div>Manager Expense Requests</div>
<?php if($Page=='Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="expense-request.php?val=0" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='Expense-Request0') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="expense-request.php?val=2" class="sidenav-link">

<div>Reject Expense Request</div>
<?php if($Page=='Expense-Request2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="expense-request.php?val=1" class="sidenav-link">

<div>Approved Expense Request</div>
<?php if($Page=='Expense-Request1') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
 
</ul>
</li>-->
<?php } } ?>
<li class="sidenav-item">
<a href="advance-request.php" class="sidenav-link">
<i class="sidenav-icon feather icon-user-check"></i>
<div>Account/Admin Advance Request</div>
<?php if($Page=='Advance-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>

<?php if($Roll == 123){?>


<li class="sidenav-item <?php if($MainPage=='HR-Resign') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>HR Resign Request</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="hr-pending-resign-request.php" class="sidenav-link">

<div>Pending HR Resign Request</div>
<?php if($Page=='HR-Peding-Resign-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="hr-approve-resign-request.php" class="sidenav-link">

<div>Approved HR Resign Requests</div>
<?php if($Page=='HR-Approve-Resign-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="hr-reject-resign-request.php" class="sidenav-link">

<div>Rejected HR Resign Requests</div>
<?php if($Page=='HR-Reject-Resign-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>   

<li class="sidenav-item <?php if($MainPage=='HR-Advance') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>HR Advance Request</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="hr-pending-advance-request.php" class="sidenav-link">

<div>Pending HR Advance Request</div>
<?php if($Page=='HR-Peding-Advance-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="hr-approve-advance-request.php" class="sidenav-link">

<div>Approved HR Advance Requests</div>
<?php if($Page=='HR-Approve-Advance-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="hr-reject-advance-request.php" class="sidenav-link">

<div>Rejected HR Advance Requests</div>
<?php if($Page=='HR-Reject-Advance-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>   
<?php } ?>

<?php 
if($Roll == 29 || $user_id == 1322){
?>



<li class="sidenav-item <?php if($MainPage=='Resign-Manager-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Manager Resign Request</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="manager-pending-resign-request.php" class="sidenav-link">

<div>Pending Resign Request</div>
<?php if($Page=='Manager-Pending-Resign-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="manager-approve-resign-request.php" class="sidenav-link">

<div>Approved Resign Requests</div>
<?php if($Page=='Manager-Approve-Resign-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="manager-reject-resign-request.php" class="sidenav-link">

<div>Rejected Resign Requests</div>
<?php if($Page=='Manager-Reject-Resign-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  


<li class="sidenav-item <?php if($MainPage=='Advance-Payment-Manager') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Manager Advance Request</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="manager-pending-advance-request.php" class="sidenav-link">

<div>Pending Advance Request</div>
<?php if($Page=='Manager-Pending-Advance-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="manager-approve-advance-request.php" class="sidenav-link">

<div>Approved Advance Requests</div>
<?php if($Page=='Manager-Approve-Advance-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
    <li class="sidenav-item">
<a href="manager-reject-advance-request.php" class="sidenav-link">

<div>Rejected Advance Requests</div>
<?php if($Page=='Manager-Reject-Advance-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 </ul>
</li>  


<?php }  ?>

<?php if(in_array("105", $Options)) {?>
<li class="sidenav-item <?php if($MainPage=='Manager-Vendor-Expenses') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Admin Vendor Expenses</div>
</a>
<ul class="sidenav-menu">
    
 <li class="sidenav-item">
<a href="manager-vendor-pending-expense-request.php" class="sidenav-link">

<div>Pending Expense Request</div>
<?php if($Page=='Manager-Vendor-Peding-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="manager-vendor-approve-expense-request.php" class="sidenav-link">

<div>Approve/Reject Expense Requests</div>
<?php if($Page=='Manager-Vendor-Approve-Expense-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
    
 </ul>
</li>   
    
<?php }  ?>











<?php  if(in_array("37", $Options)) {?>  
<li class="sidenav-item <?php if($MainPage=='Account') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Account</div>
</a>
<ul class="sidenav-menu">

<li class="sidenav-item">
<a href="receive-amount.php" class="sidenav-link">
<div> Receive Amount</div>
<?php if($Page=='Receive-Amount') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li> 
<?php if(in_array("14", $Options)) {?> 
<li class="sidenav-item">
<a href="add-receive-amount.php" class="sidenav-link">
<div> Add Receive Amount</div> 
<?php if($Page=='Add-Receive-Amount') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } ?>
</ul>
</li>
<?php } if(in_array("38", $Options)) {?>  
 <li class="sidenav-item">
<a href="amount-request.php" class="sidenav-link">
<i class="sidenav-icon feather icon-user-check"></i>
<div>Withdraw Amount Request</div>
<?php if($Page=='Amount-Request') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
<?php } if(in_array("39", $Options)) {?>  
 <li class="sidenav-item">
<a href="wallet.php" class="sidenav-link">
<i class="sidenav-icon feather icon-user-check"></i>
<div>Wallet</div>
<?php if($Page=='Wallet') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<?php }  if(in_array("28", $Options)) {?>

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

<?php } if(in_array("40", $Options)) {?>  
<li class="sidenav-item <?php if($MainPage=='Report') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-bar-chart"></i>
<div>Report</div>
</a>
<ul class="sidenav-menu"> 
 
 <li class="sidenav-item">
<a href="franchise-daily-survey-report.php" class="sidenav-link">
<div> Franchise Daily Checklist Report</div>
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

<!-- <li class="sidenav-item">
<a href="franchise-earn-point-report.php" class="sidenav-link">
<div> Franchise Earn Total Points</div>
<?php if($Page=='Franchise-Earn-Point-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>-->

 <li class="sidenav-item">
<a href="employee-daily-report.php" class="sidenav-link">
<div> Employee Task Report</div>
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
<a href="month-attendance-report.php" class="sidenav-link">
<div> Employee Month Attendace Report</div>
<?php if($Page=='Month-Attendance-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="attendance-report-2.php" class="sidenav-link">
<div> Employee Attendace Report 2</div>
<?php if($Page=='Attendance-Report-2') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="emp-location-report.php" class="sidenav-link">
<div> Employee Location Report</div>
<?php if($Page=='Employee-Location-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
 <li class="sidenav-item">
<a href="employee-shop-visit-report.php" class="sidenav-link">
<div> Employee Shop Visit Report</div>
<?php if($Page=='Employee-Visit-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="employee-wallet-report.php" class="sidenav-link">
<div> Employee Wallet Report</div>
<?php if($Page=='Employee-Wallet-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


 <li class="sidenav-item">
<a href="employee-wallet-outstanding.php" class="sidenav-link">
<div> Employee Wallet Outstanding</div>
<?php if($Page=='Employee-Wallet-Outstanding') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="expenses-report2.php" class="sidenav-link">
<div> Expenses Report</div>
<?php if($Page=='Expenses-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<!-- <li class="sidenav-item">
<a href="employee-earn-point-report.php" class="sidenav-link">
<div> Employee Earn Point Report</div>
<?php if($Page=='Employee-Earn-Point-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>-->

<!-- <li class="sidenav-item">
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
</li>-->


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


<li class="sidenav-item <?php if($MainPage=='Report-New') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-bar-chart"></i>
<div>Report New</div>
</a>
<ul class="sidenav-menu"> 
 
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

 <li class="sidenav-item">
<a href="weekly-sale-report.php" class="sidenav-link">
<div> Weekly Sale report</div>
<?php if($Page=='Weekly-Sale-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="item-wise-sale-report.php" class="sidenav-link">
<div> Item Wise Sale Report</div>
<?php if($Page=='Item-Wise-Sale-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="expenses-report.php" class="sidenav-link">
<div> Expense Report</div>
<?php if($Page=='Expense-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

 <li class="sidenav-item">
<a href="expense-summary-report.php" class="sidenav-link">
<div> Expense Summary Report</div>
<?php if($Page=='Expense-Summary-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>


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

</ul>
</li>

<?php } if(in_array("41", $Options)) {?>  
<li class="sidenav-item <?php if($MainPage=='Account-Report') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-user"></i>
<div>Account Report</div>
</a>
<ul class="sidenav-menu">
  
<li class="sidenav-item">
<a href="wallet-balance-report.php" class="sidenav-link">
<div> Wallet Balance Report</div>
<?php if($Page=='Wallet-Balance-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>

<li class="sidenav-item">
<a href="transaction-report.php" class="sidenav-link">
<div> Trasaction Report</div>
<?php if($Page=='Trasaction-Report') {?>
<div class="pl-1 ml-auto">
<span class="badge badge-dot badge-primary"></span>
</div>
<?php } ?>
</a>
</li>
</ul>
</li>
<?php } ?>  

<!-- <li class="sidenav-item <?php if($MainPage=='Feedback') {?> open active <?php } ?>">
<a href="javascript:" class="sidenav-link sidenav-toggle">
<i class="sidenav-icon feather icon-headphones"></i>
<div>Lead Management</div>
</a>
<ul class="sidenav-menu"> 
 <li class="sidenav-item">
            <a href="add-lead.php" class="sidenav-link">
                
                <div>Lead Creation</div>
                
            </a>
        </li>
        <li class="sidenav-item">
            <a href="view-leads.php" class="sidenav-link">
                
                <div>Created Leads</div>
                
            </a>
        </li>
        <li class="sidenav-item">
            <a href="assign-leads.php" class="sidenav-link">
                
                <div>Lead Assign</div>
                
            </a>
        </li>
         <li class="sidenav-item">
            <a href="view-leads-calling.php" class="sidenav-link">
               
                <div>To do Activity</div>
               
            </a>
        </li>
        <li class="sidenav-item">
            <a href="appointment-scheduling.php" class="sidenav-link">
              
                <div>Appointment Scheduling</div>
                
            </a>
        </li>
       
        <li class="sidenav-item">
            <a href="opportunity.php" class="sidenav-link">
              
                <div>Completed</div>
               
            </a>
        </li>

</ul>
</li> -->



<?php  if(in_array("33", $Options)) {?>
<!-- <li class="sidenav-item <?php if($MainPage=='Feedback') {?> open active <?php } ?>">
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
</li>  -->

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