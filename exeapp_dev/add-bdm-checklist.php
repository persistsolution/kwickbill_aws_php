<?php session_start();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Add BDM Checklist";
$UserId = $_SESSION['User']['id']; ?>
<!doctype html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?php echo $Proj_Title; ?></title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
    <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
    <link href="css/toastr.min.css" rel="stylesheet">
      <script src="js/jquery.min3.5.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 
        <style>
             .autocomplete-list3 {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background-color: white;
            z-index: 1000;
            width: 100%;
            margin-top: 35px;
        }

        .autocomplete-list2 {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background-color: white;
            z-index: 1000;
            width: 100%;
            margin-top: 35px;
        }

        .autocomplete-list {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background-color: white;
            z-index: 1000;
            width: 100%;
        }

        .autocomplete-item {
            padding: 8px;
            cursor: pointer;
        }

        .autocomplete-item:hover,
        .autocomplete-item.active {
            background-color: #98e6ed;
        }
        </style>
       

<?php 
  if(isset($_POST['submit'])){
//$userId = $_POST['CreatedBy'];
    $frId = $_POST['FrId'];
    $visitDate = $_POST['VisitDate'];
    $qidList = $_POST['qid'];  // Should be an array
    $answerList = $_POST['answer']; // Should be an array
    $createddate = date('Y-m-d H:i:s');
    // Insert each answer into tbl_bdm_checklist_records
    
     $sql = "SELECT * FROM tbl_bdm_checklist_records WHERE userid='$UserId' AND visitdate='$visitDate' AND frid='$frId'";
    $rncnt = getRow($sql);
    if($rncnt > 0){?>
        <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Error",
  text: "Checklist has already been submitted for the selected franchise.",
  type: "error",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-bdm-checklist.php";
  }
}); });</script>
        <?php } else{
    foreach ($qidList as $index => $qid) {
        $answer = mysqli_real_escape_string($conn, $answerList[$index]);
        $qid = (int)$qid;
        $userId = (int)$UserId;
        $frId = (int)$frId;

         $sql = "INSERT INTO tbl_bdm_checklist_records (userid, frid, qid, answer,visitdate)
                VALUES ('$userId', '$frId', '$qid', '$answer','$visitDate')";
         $conn->query($sql);
    }
    ?>
    <script type="text/javascript">
        setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Form Successfully submitted.",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-bdm-checklist.php";
  }
}); });</script>
<?php 
}

  }
 ?>
 
        <div class="main-container">
            <div class="container">
               
                <div class="card">
                  <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                   <div class="card-body">
                       <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                       
                       <div class="form-group col-md-12">
                             <label class="form-label">Franchise <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" autocomplete="off" name="FrLocations" id="FrLocations" placeholder="search Franchise..." value="<?php echo $FrLocations; ?>" required onClick="this.select();" <?php if($_GET['id']!=''){?> readonly <?php } ?>>
                                <div id="autocomplete-list2" class="autocomplete-list" style="display: none; position: absolute;"></div>
                              
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label class="form-label">Location ID <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="FrId" id="FrId" value="<?php echo $UnderFrId; ?>" readonly>
                                
                            </div>
                            
                            <div class="form-group col-md-12">
                                 <label class="form-label">Visit Date</label>
                                    <input type="date" class="form-control" name="VisitDate" id="VisitDate" value="<?php echo date('Y-m-d');?>" readonly>
                                   
                                </div>
                                
                       <?php 
                        $sql = "SELECT * FROM tbl_bdm_checklist WHERE Status=1";
                        $row = getList($sql);
                       foreach($row as $result){
                       ?>
                    <div class="form-group col-md-12">
    <label class="form-label"><?php echo $result['question'];?></label>
    <textarea name="answer[]" id="answer" class="form-control" placeholder="" required></textarea>
    <input type="hidden" name="qid[]" value="<?php echo $result['id'];?>">
</div>
<?php } ?>
               
                
                    </div>
                        
                          <input type="hidden" name="CreatedBy" value="<?php echo $_SESSION['User']['id']; ?>" id="CreatedBy">  
                      <input type="hidden" name="action" value="NewReg" id="action">  
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </main>
<br><br><br><br>
    <!-- footer-->
    
<?php include 'footer.php';?>

    <!-- Required jquery and libraries -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="js/jquery.cookie.js"></script>

    <!-- Swiper slider  js-->
    <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="js/main.js"></script>
    <script src="js/color-scheme-demo.js"></script>


    <!-- page level custom script -->
    <script src="js/app.js"></script>
    
    <script type="text/javascript">
        let currentFocus2 = -1;

        $(document).ready(function() {
            $("#FrLocations").on("input", function() {
                let FrLocations = $(this).val();
                if (FrLocations.length === 0) {
                    $("#autocomplete-list2").hide();
                    return;
                }
                var action = "getFrLocationList";
                $.ajax({
                    url: "ajax_files/ajax_dropdown.php",
                    method: "POST",
                    data: {
                        action: action,
                        FrLocations: FrLocations
                    },
                    success: function(data) {
                        console.log(data);
                        $("#autocomplete-list2").empty().show();
                        currentFocus2 = -1;

                        if (data.length === 0) {
                            $("#autocomplete-list2").hide();
                            return;
                        }

                        data.forEach(function(item) {
                            $("#autocomplete-list2").append(`<div class="autocomplete-item" onclick="getFrDetails(${item.id})">${item.ShopName}-${item.Phone}</div>`);
                        });

                        $(".autocomplete-item").on("click", function() {
                            $("#FrLocations").val($(this).text());
                            $("#autocomplete-list2").hide();
                        });
                    }
                });
            });

            $("#FrLocations").on("keydown", function(e) {
                let items = $(".autocomplete-item");

                if (e.key === "ArrowDown") {
                    currentFocus2++;
                    if (currentFocus2 >= items.length) currentFocus2 = 0;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "ArrowUp") {
                    currentFocus2--;
                    if (currentFocus2 < 0) currentFocus2 = items.length - 1;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "Enter") {
                    e.preventDefault();
                    if (currentFocus2 > -1 && items[currentFocus2]) {
                        items.eq(currentFocus2).click();
                    }
                }
            });

            function setActive(items) {
                items.removeClass("active");
                if (currentFocus2 >= 0 && currentFocus2 < items.length) {
                    items.eq(currentFocus2).addClass("active");
                    items.eq(currentFocus2)[0].scrollIntoView({
                        block: "nearest"
                    });
                }
            }

            $(document).click(function(e) {
                if (!$(e.target).closest("#FrLocations, #autocomplete-list2").length) {
                    $("#autocomplete-list2").hide();
                }
            });
        });

        function getFrDetails(id) {
            $('#FrId').val(id);
        }
    </script>
</body>

</html>
