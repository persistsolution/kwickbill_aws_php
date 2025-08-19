<?php session_start();
require_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['User']['id'];
$PageName = "My Expenses";
$Page = "Recharge";
$WallMsg = "NotShow";

for($i=1;$i<=50;$i++){
    //echo $_SESSION["cart_item$i"];
    unset($_SESSION["cart_item$i"]);
}
?>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link href="css/toastr.min.css" rel="stylesheet">
      <script type="text/javascript" src="js/toastr.min.js"></script>
      <!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
 <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4f4;
    }

    body.popup-open {
      overflow: hidden;
    }

    /* Floating Video Button */
    .floating-btn {
      position: fixed;
      bottom: 100px;
      right: 20px;
      background-color: #e2982d;
      color: white;
      border: none;
      padding: 15px 15px;
      border-radius: 50%;
      font-size: 24px;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
      z-index: 999;
      transition: transform 0.2s ease;
    }

    .floating-btn:hover {
      background-color: #e60000;
      transform: scale(1.1);
    }

    /* Popup Overlay */
    .popup-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      backdrop-filter: blur(8px);
      background: rgba(0, 0, 0, 0.6);
      justify-content: center;
      align-items: center;
      z-index: 9999;
      animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    /* Video Popup Box */
    .popup-content {
      position: relative;
      width: 90%;
      max-width: 500px;
      aspect-ratio: 9 / 16;
      background: #000;
      border-radius: 12px;
      overflow: hidden;
     
      animation: fadeIn 0.5s ease;
    }

    .popup-content iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    /* Close Button */
    .close-btn {
      position: absolute;
      top: 10px;
      left: 10px;
      font-size: 22px;
      color: #fff;
      background: red;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      z-index: 10000;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
    }

    .close-btn:hover {
      background: #ff3333;
    }

    /* Open in YouTube button */
    .open-youtube {
      position: absolute;
      bottom: 12px;
      left: 12px;
      background: white;
      color: black;
      border-radius: 6px;
      font-size: 12px;
      padding: 4px 10px;
      z-index: 9999;
      font-weight: bold;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
      text-decoration: none;
    }

    .open-youtube:hover {
      background: #f0f0f0;
    }

    /* Dark Mode */
    @media (prefers-color-scheme: dark) {
      body {
        background: #1e1e1e;
      }

      .popup-content {
        background: rgba(0, 0, 0, 0.85);
      }

      .floating-btn {
        background-color: #bb0000;
      }
    }
  </style>
<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   <!-- Floating Button -->
<button class="floating-btn" onclick="openPopup()">▶</button>

<!-- Video Popup -->
<div class="popup-overlay" id="videoPopup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">&times;</span>
    <a class="open-youtube" href="#" id="youtubeLink" target="_blank"></a>
    <iframe id="youtubeIframe" src="" allowfullscreen allow="autoplay"></iframe>
  </div>
</div>

<script>
  const videoId = "UitS4yeElJU"; // Replace with your Shorts video ID

  function openPopup() {
    document.body.classList.add('popup-open');
    const popup = document.getElementById('videoPopup');
    const iframe = document.getElementById('youtubeIframe');
    const link = document.getElementById('youtubeLink');

    iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    link.href = `https://www.youtube.com/watch?v=${videoId}`;
    popup.style.display = 'flex';
  }

  function closePopup() {
    document.body.classList.remove('popup-open');
    const popup = document.getElementById('videoPopup');
    const iframe = document.getElementById('youtubeIframe');
    iframe.src = "";
    popup.style.display = 'none';
  }
</script>


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <?php include_once 'back-header.php'; ?>

        <!-- page content start -->
<?php
$filename = "1709830561313_42714_save_exp_img2_expenses.png";
$seperate = explode("_",$filename);
  $MrdNo = $seperate[1];
   $MrdNo = $seperate[2];
if($_REQUEST["action"]=="delete")
{
  $id = $_REQUEST["id"];
  if (!empty($id) && is_numeric($id)) {
  $sql11 = "DELETE FROM tbl_expense_request WHERE id = '$id'";
  $conn->query($sql11);
  $sql11 = "DELETE FROM tbl_expense_request_items WHERE ExpId = '$id'";
  $conn->query($sql11);
  $sql11 = "DELETE FROM tbl_emp_expense_prod_items WHERE ExpId = '$id'";
  $conn->query($sql11);
  $sql11 = "DELETE FROM tbl_cust_prod_stock_2025 WHERE EmpExpId = '$id' AND EmpExpItem='Yes'";
  $conn->query($sql11);
  
  ?>
    <script type="text/javascript">
      //alert("Deleted Successfully!");
      window.location.href="view-expenses-mult-prod.php";
    </script>
<?php } } ?>

  <?php 
        
        $sql55 = "SELECT * FROM tbl_company_emails WHERE id=1";
        $row55 = getRecord($sql55);
        
$id = $_GET['id'];
$sql7 = "SELECT * FROM tbl_expense_request WHERE id='$id'";
$res7 = $conn->query($sql7);
$row7 = $res7->fetch_assoc();
?>

 
<style>
   .expense-block {
    position: relative;
    border: 1px solid #ccc;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
}
.btn-group-container {
    display: flex;
    gap: 10px;
    justify-content: flex-start;
    padding: 10px 20px;
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
        
       .switch {
  position: relative;
  display: inline-block;
  width: 42px;
  height: 22px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 34px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #28a745;
}
input:checked + .slider:before {
  transform: translateX(20px);
}


</style>
        <div class="main-container">
            <div class="container">
                 <div style="float:right;">
                                                                   
                 <a href="add-expenses-mult-prod.php" class="btn btn-sm btn-default rounded">Add New</a>
            
                                
                                                                </div><br><br>
               
               
               
</div>
 
<?php 
// $earlier = new DateTime("2024-07-20");
// $later = new DateTime("2024-07-26");
 

// echo $neg_diff = $later->diff($earlier)->format("%r%a"); 
?>

<style>
.nav-tabs .nav-link.active {
    background-color: #f06721;
    color: #fff;
}
</style>


<?php
$filter = $_GET['approval'] ?? 'yes';
?>

<ul class="nav nav-tabs mb-3">
  <li class="nav-item">
    <a class="nav-link <?= $filter === 'yes' ? 'active' : '' ?>" href="?approval=yes">Send for Approval: Yes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $filter === 'no' ? 'active' : '' ?>" href="?approval=no">Send for Approval: No</a>
  </li>
</ul>

<?php
$whereClause = "te.UserId='$user_id'";
if ($filter === 'yes') {
    $whereClause .= " AND te.SendToApproval='Yes'";
} elseif ($filter === 'no') {
    $whereClause .= " AND (te.SendToApproval IS NULL OR te.SendToApproval='No')";
}

$sql = "SELECT te.*, 
               tu2.Fname AS MgrName, 
               tu3.Fname AS AccName,
               u1.Fname AS ReportingManager,
               u1.id AS ReportingManagerId
        FROM tbl_expense_request te
        LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy
        LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy
        LEFT JOIN tbl_users tu ON tu.id = te.UserId
        LEFT JOIN tbl_users u1 ON u1.id = tu.UnderByUser
        WHERE $whereClause 
        ORDER BY te.id DESC";

$rows = getList($sql);

foreach ($rows as $result):
    $AdminStatus = ($result['Amount'] <= 5000 && $result['ExpCatId'] != 3 && $result['ReportingManagerId'])
        ? "Pending by {$result['ReportingManager']}"
        : "Pending by Admin";
?>

<div class="card shadow-sm mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-9">
        <h5 class="text-primary mb-1">&#8377;<?= number_format($result['Amount'], 2); ?></h5>
        <p class="mb-1"><strong>Exp ID:</strong> <?= $result['id']; ?></p>
        <p class="mb-1"><strong>Narration:</strong> <?= $result['Narration']; ?></p>
        <p class="mb-1 text-muted"><i class="fa fa-calendar-alt me-1"></i> <?= date("d M Y", strtotime($result['ExpenseDate'])); ?></p>

        <?php if (!empty($result['ReportingManager'])): ?>
        <p class="mb-1">
          <strong>Manager Status:</strong>
          <?php
          switch ($result['ManagerStatus']) {
              case '1':
                  echo "<span class='text-success'>Approved by {$result['MgrName']} | " . date("d/m/Y", strtotime($result['ApproveDate'])) . "</span>";
                  break;
              case '2':
                  echo "<span class='text-danger'>Rejected by {$result['MgrName']} | " . date("d/m/Y", strtotime($result['ApproveDate'])) . "</span>";
                  break;
              default:
                  echo "<span class='text-warning'>Pending by {$result['ReportingManager']}</span>";
          }
          ?>
          <br><strong>Manager Comment:</strong> <?= $result['MannagerComment'] ?? '-'; ?>
        </p>
        <?php endif; ?>

        <p class="mb-1">
          <strong>Admin Status:</strong>
          <?php
          switch ($result['AdminStatus']) {
              case '1':
                  echo "<span class='text-success'>Approved by {$result['AccName']} | " . date("d/m/Y", strtotime($result['AdminApproveDate'])) . "</span>";
                  break;
              case '2':
                  echo "<span class='text-danger'>Rejected by {$result['AccName']} | " . date("d/m/Y", strtotime($result['AdminApproveDate'])) . "</span>";
                  break;
              default:
                  echo "<span class='text-warning'>Pending</span>";
          }
          ?>
          <br><strong>Admin Comment:</strong> <?= $result['AdminComment'] ?? '-'; ?>
        </p>
      </div>

      <?php if ($result['ManagerStatus'] != '1' || $result['AdminStatus'] != '1'): ?>
      <div class="col-md-3 d-flex align-items-center justify-content-end">
        <div class="d-flex gap-2">
          <!-- Edit Button -->
          <a href="add-expenses-mult-prod.php?id=<?= $result['id']; ?>" 
             class="btn btn-outline-primary btn-sm rounded-circle shadow-sm" 
             title="Edit"
             style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-pen"></i>
          </a>
&nbsp;
          <!-- Delete Button -->
          <a href="view-expenses-mult-prod.php?action=delete&id=<?= $result['id']; ?>" 
             class="btn btn-outline-danger btn-sm rounded-circle shadow-sm" 
             title="Delete"
             onclick="return confirm('Are you sure you want to delete this record?');"
             style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-trash-alt"></i>
          </a>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php endforeach; ?>


                        
                        <input type="text" class="Exp_Id" value="">
                   

            </div>
        </div>
    </main>
<br><br><br><br>
<?php include 'footer.php';?>
    <!--  jquery and libraries -->
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
 <script>
function addExpenseRow() {
    const container = document.getElementById('expenseContainer');
    const lastBlock = container.querySelector('.expense-block:last-child');
    const newBlock = lastBlock.cloneNode(true);

    // Clear inputs except hidden srno
    newBlock.querySelectorAll('input').forEach(input => {
        if (input.type !== 'hidden') input.value = '';
    });

    newBlock.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
    newBlock.querySelectorAll('a').forEach(a => a.remove());

    // Remove old button group if any
    const existingBtnGroup = newBlock.querySelector('.btn-group-container');
    if (existingBtnGroup) existingBtnGroup.remove();

    // Add new buttons
    const btnGroup = document.createElement('div');
    btnGroup.className = 'btn-group-container';
    btnGroup.style = 'display: flex; gap: 10px; justify-content: flex-start; padding: 10px 20px;';

    const addBtn = document.createElement('button');
    addBtn.type = 'button';
    addBtn.className = 'btn btn-success';
    addBtn.innerText = '+ Add';
    addBtn.onclick = addExpenseRow;

    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.className = 'btn btn-danger remove-btn';
    removeBtn.innerHTML = '&times; Remove';
    removeBtn.onclick = function () {
        newBlock.remove();
        updateSrnoFields();
    };

    btnGroup.appendChild(addBtn);
    btnGroup.appendChild(removeBtn);
    newBlock.appendChild(btnGroup);

    container.appendChild(newBlock);
    updateSrnoFields();
}

function updateSrnoFields() {
    const srnos = document.querySelectorAll('.srno');
    const showcarts = document.querySelectorAll('.showcart');

    srnos.forEach((el, i) => {
        el.value = i + 1;
    });

    showcarts.forEach((el, i) => {
        el.id = 'showcart' + (i + 1); // showcart1, showcart2, ...
    });
}
</script>

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
    
    
    <script>
         let currentFocus3 = -1;

        $(document).ready(function() {
            $("#ProductName").on("input", function() {
                let ProductName = $(this).val();
                if (ProductName.length === 0) {
                    $("#autocomplete-list3").hide();
                    return;
                }
                var action = "getProductList";
                var FrId = $('#FrId').val();
                $.ajax({
                    url: "ajax_files/ajax_dropdown.php",
                    method: "POST",
                    data: {
                        action: action,
                        ProductName: ProductName,
                        FrId:FrId
                    },
                    success: function(data) {
                        console.log(data);
                        $("#autocomplete-list3").empty().show();
                        currentFocus3 = -1;

                        if (data.length === 0) {
                            $("#autocomplete-list3").hide();
                            return;
                        }

                        data.forEach(function(item) {
                            $("#autocomplete-list3").append(`<div class="autocomplete-item" onclick="getAvailProdStock(${item.id})">${item.ProductName}</div>`);
                        });

                        $(".autocomplete-item").on("click", function() {
                            $("#ProductName").val($(this).text());
                            $("#autocomplete-list3").hide();
                        });
                    }
                });
            });

            $("#ProductName").on("keydown", function(e) {
                let items = $(".autocomplete-item");

                if (e.key === "ArrowDown") {
                    currentFocus3++;
                    if (currentFocus3 >= items.length) currentFocus3 = 0;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "ArrowUp") {
                    currentFocus3--;
                    if (currentFocus3 < 0) currentFocus3 = items.length - 1;
                    setActive(items);
                    e.preventDefault();
                } else if (e.key === "Enter") {
                    e.preventDefault();
                    if (currentFocus3 > -1 && items[currentFocus3]) {
                        items.eq(currentFocus3).click();
                    }
                }
            });

            function setActive(items) {
                items.removeClass("active");
                if (currentFocus3 >= 0 && currentFocus3 < items.length) {
                    items.eq(currentFocus3).addClass("active");
                    items.eq(currentFocus3)[0].scrollIntoView({
                        block: "nearest"
                    });
                }
            }

            $(document).click(function(e) {
                if (!$(e.target).closest("#ProductName, #autocomplete-list3").length) {
                    $("#autocomplete-list3").hide();
                }
            });
        });
    </script>
<script>
function calTotAmt(){
    getSubTotal();
}
function getSubTotal(){
     var sum = 0;
      $(".txt").each(function() {
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }
   });
     $('#TotAmt').val(sum);
   
    }
    
    function getExpId(id){
        $('#myModal').modal('show');
        $('.Exp_Id').val(id);
    }
    
    function uploadImageSingle(prdid){
    //alert(prdid);
    var action = "save"; 
    var pageval = "expenses";
    //Android.uploadImageSingle(''+prdid+'',''+action+'',''+pageval+'');
}

function uploadImageSingle2(prdid){
    //alert(prdid);
    var action = "saveexpimg2";
    var pageval = "expenses";
   // Android.uploadImageSingle(''+prdid+'',''+action+'',''+pageval+'');
}



 $(document).ready(function() {
     $('#validation-form').on('submit', function(e){
      e.preventDefault();    
     
     $.ajax({  
                url :"ajax_files/ajax_expenses_mult.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,  
                processData:false,  
                 beforeSend:function(){
     $('#submit').attr('disabled','disabled');
     $('#submit').text('Please Wait...');
    },
                success:function(data){ 
                    //alert(data);
                     $('#submit').attr('disabled',false);
                    $('#submit').text('Update');
                 //console.log(data);exit();
                     
                    if(data == 1){
                        // Android.saveProductClick();
                    // toastr.success('Your expenses request successfully submitted.!', 'Success', {timeOut: 5000}); 
                    setTimeout(function () { 
swal({
  title: "Thank you",
  text: "Your expenses request successfully submitted.",
  type: "success",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          window.location.href="view-expenses-mult.php";
  }
}); });
                        
                     }
                     else if(data == 0){
                         setTimeout(function () { 
swal({
  title: "Error",
  text: "today Same amount expenses request already exists!",
  type: "error",
  confirmButtonText: "OK"
},
function(isConfirm){
  if (isConfirm) {
          
  }
}); });
                     }
                    
                    
                    
                      $('#submit').attr('disabled',false);
                    $('#submit').text('Update');
                }  
           })
     });
 });

</script>
   
</body>

</html>
