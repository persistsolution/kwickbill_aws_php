<?php 
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Leads";
$Page = "Education-Leads";
?>
<!DOCTYPE html>
<html lang="en" class="default-style">
<head>
<title><?php echo $Proj_Title; ?> | Education Leads List</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="" />
<?php include_once 'header_script.php'; ?>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
</head>
<body>

 <div class="layout-wrapper layout-1 layout-without-sidenav">
<div class="layout-inner">

 <?php include_once 'top_header.php'; include_once 'sidebar.php'; ?>


<div class="layout-container">




<!-- [ content ] Start -->
                    <div class="container-fluid flex-grow-1 container-p-y">
                        

                         <!-- Header -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    
                                    
                                    <div class="col">
                                        
                                        
                                        
                                        <h4 class="font-weight-bold mb-3">Nilesh Giradkar <span class="badge badge-danger" style="background-color:#62d493; font-size:13px;">Intrested</span></h4>
                                       <br>
                                       <a href="javascript:void(0)" class="text-twitter">
                                                        <i class="fas fa-pencil-alt"></i> Edit Profile
                                                    </a>
                                      
                                                
                                        <a href="javascript:void(0)" class="btn btn-primary btn-round">+&nbsp; Upload Documents</a>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Header -->

                        <div class="row">
                            <div class="col">

                                <!-- Info -->
                                <div class="card mb-2">
                                    <div class="card-body">
                                        
                                        <h6 class="">Contacts</h6>
                                        
                                       <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Phone No.:</div>
                                            <div class="col-md-9">
                                               +91 8149693719
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Email ID:</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark">nileshgiradkar1@gmail.com</a>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Address:</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark">Nandanv KDK College Road Napgur.</a>
                                            </div>
                                        </div>


                                        <h6 class="my-3">Interests</h6>

                                        <div class="row mb-2">
                                            <div class="col-md-3 text-muted">Intress:</div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0)" class="text-dark">Personal Loan</a>
                                            </div>
                                        </div>

                                        

                                    </div>
                                    
                                </div>
                                <!-- / Info -->

                                <!-- Posts -->

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row help-desk">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <nav class="navbar justify-content-between p-0 align-items-center shadow-none">
                                            <h5 class="my-2">Conversation</h5>
                                            
                                        </nav>
                                    </div>
                                </div>
                                
                                <?php  
$id = '1';
$sql22 = "SELECT tp.*,tc.Name As Service,td.Name As DiapositionName,tu.Fname,tu.Lname FROM tbl_leads tp 
          LEFT JOIN tbl_courses tc ON tp.Services=tc.id 
          LEFT JOIN tbl_diapostion td ON tp.Diaposition=td.id 
          LEFT JOIN tbl_users tu ON tp.CreatedBy=tu.id WHERE tp.id='$id'"; 
$row22 = getRecord($sql22);
?>
     <div class="container-fluid flex-grow-1 container-p-y">
                      
                        
                        <div class="row help-desk">
                            <div class="col-xl-12 col-lg-12">
                                
                                <div class="ticket-block">
                                    <div class="row">
                                       <!--  <div class="col-sm-auto">
                                            <img class="media-object wid-60 img-radius mb-3" src="assets/img/user/avatar-1.jpg" alt="Generic placeholder image ">
                                        </div> -->
                                        <div class="col">
                                            <div class="card example-popover" data-toggle="modal" data-target="#modals-slide" data-toggle="popover" data-placement="right" data-html="true"
                                                title="<img src='assets/img/user/avatar-1.jpg' class='wid-20 rounded mr-1 img-fluid'><p class='d-inline-block mb-0 ml-2'>You replied</p>" data-content="hello Yogen dra,you need to create "
                                                toolbar-options="div only once in a page in your code, this div fill found every 'td' ...">
                                                <div class="row no-gutters row-bordered row-border-light h-100">
                                                    <div class="d-flex col">
                                                        <div class="card-body">
                                                            <h5 class="mb-0"><?php echo $row22['Fname']." ".$row22['Lname'];?></h5>
                                                            <p class="my-1 text-muted"><i class="feather icon-lock mr-1 f-14"></i>Telecaller</p>
                                                            <ul class="list-inline mt-2 mb-0 hid-sm">
                                                                
                                                                <li class="list-inline-item my-1"><i class="feather icon-calendar mr-1 f-14"></i>Conversation at <?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row22['CreatedDate']))); ?> <?php echo $row22['CreatedTime']; ?></li>
                                                                
                                                            </ul>
                                                            <div class="card bg-light my-3 p-3 hid-md">
                                                                <h6><img src="assets/img/user/avatar-5.jpg" alt="" class="wid-20 avatar mr-2 rounded">Last comment from <a href="#"><?php echo $row22['CustName'];?>:</a></h6>
                                                                <p class="mb-0"><?php echo $row22['Details']; ?></p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <?php 
$i=2;
$id = '1';
  $sql2 = "SELECT tp.*,tc.Name As Service,td.Name As DiapositionName,tu.Fname,tu.Lname FROM tbl_leads_next_action tp 
          LEFT JOIN tbl_courses tc ON tp.Services=tc.id 
          LEFT JOIN tbl_diapostion td ON tp.Diaposition=td.id 
          LEFT JOIN tbl_users tu ON tp.CreatedBy=tu.id WHERE tp.LeadId='$id'
          ORDER BY tp.CreatedDate DESC"; 

    $res2 = $conn->query($sql2);
    while($row = $res2->fetch_assoc()){ ?>

                                <div class="ticket-block">
                                    <div class="row">
                                     
                                        <div class="col">
                                            <div class="card example-popover" data-toggle="modal" data-target="#modals-slide" data-toggle="popover" data-placement="right" data-html="true"
                                                title="<img src='assets/img/user/avatar-1.jpg' class='wid-20 rounded mr-1 img-fluid'><p class='d-inline-block mb-0 ml-2'>You replied</p>" data-content="hello Yogen dra,you need to create "
                                                toolbar-options="div only once in a page in your code, this div fill found every 'td' ...">
                                                <div class="row no-gutters row-bordered row-border-light h-100">
                                                    <div class="d-flex col">
                                                        <div class="card-body">
                                                            <h5 class="mb-0"><?php echo $row['Fname']." ".$row['Lname'];?></h5>
                                                            <p class="my-1 text-muted"><i class="feather icon-lock mr-1 f-14"></i>Telecaller</p>
                                                            <ul class="list-inline mt-2 mb-0 hid-sm">
                                                                
                                                                <li class="list-inline-item my-1"><i class="feather icon-calendar mr-1 f-14"></i>Conversation at <?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?> <?php echo $row['CreatedTime']; ?></li>
                                                                
                                                            </ul>
                                                            <div class="card bg-light my-3 p-3 hid-md">
                                                                <h6><img src="assets/img/user/avatar-5.jpg" alt="" class="wid-20 avatar mr-2 rounded">Last comment from <a href="#"><?php echo $row['CustName'];?>:</a></h6>
                                                                <p class="mb-0"><?php echo $row['Details']; ?></p>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <?php $i++;} ?>
                                
                                
                            </div>


                            
                            
                        </div>
                    </div>
                    
                                
                                
                                </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                

                            </div>
                            <div class="col-xl-5">

                                <div class="card mb-4">
                            <h6 class="card-header">Notes</h6>
                            <div class="card-body">
                                <textarea class="form-control" rows="3"></textarea>
                                <br>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>

                                

                            </div>
                        </div>

                    </div>
                    <!-- [ content ] End -->

                    

                </div>
                <!-- [ Layout content ] Start -->
                
</div>
</div>
</div>


<?php include_once 'footer.php'; ?>

</div>

</div>

</div>

<div class="layout-overlay layout-sidenav-toggle"></div>
</div>


<?php include_once 'footer_script.php'; ?>


    <!-- Libs -->
    <script src="assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <!-- Demo -->
    <script src="assets/js/demo.js"></script><script src="assets/js/analytics.js"></script>


<script type="text/javascript">
 
	$(document).ready(function() {
    $('#example').DataTable({
        "scrollX": true
    });
});
</script>
</body>
</html>
