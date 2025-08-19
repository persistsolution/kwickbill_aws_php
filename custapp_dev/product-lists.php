<?php session_start();
require_once 'config.php';
$CatId = $_GET['cat_id'];
$brand_id = $_GET['brand_id'];
if($_GET['cat_id']){
$sql = "SELECT Name FROM tbl_cust_category WHERE id='$CatId'";
}
if($_GET['brand_id']){
$sql = "SELECT Name FROM brands WHERE id='$brand_id'";
}
$row = getRecord($sql);
$PageName = $row['Name']; 
$Page = "Shop";
//echo "<pre>";
//print_r($_SESSION["cart_item"]);

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
    <link rel="stylesheet" href="dist/css/styles.css" />
    <link rel="stylesheet" href="dist/aos.css" />
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="products">
    <!-- screen loader -->
   



    <!-- Begin page content -->
   <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
      <?php include_once 'back-header.php'; $FrId = $_SESSION['FrId'];?>
       
       <div class="container mb-2"  >
                <!-- Swiper -->
                <div class="swiper-container categoriestab1 text-center">
                    <div class="swiper-wrapper">
                        
                        <?php 
                        $FranchiseId = $_SESSION['FranchiseId'];
                        
                           $sql2 = "SELECT * FROM tbl_cust_category WHERE Status=1 AND CreatedBy IN (0,$FranchiseId) ORDER BY srno asc";
                        
                          $res2 = $conn->query($sql2);
                          while($row2 = $res2->fetch_assoc()){
                            $CatId = $row2['id'];
                             $sql3 = "SELECT * FROM tbl_cust_products WHERE CatId='$CatId'";
                            $rncnt3 = getRow($sql3);
                            if($rncnt3 > 0){
                        ?>
                        
                        <div class="swiper-slide">
                            <div class="">
                                <div class="card-body p-2"
                                <?php if($_GET['cat_id'] == $CatId){?>
                                style="background-color: antiquewhite;border-radius: 10%;" <?php } ?>>
                                    <a href="product-lists.php?cat_id=<?php echo $CatId; ?>"><div class="avatar avatar-60  rounded-circle">
                                        <div class="background">
                                            <?php if($row2["Photo"] == '') {?>
                  <img src="no_image.jpg">
                 <?php } else if(file_exists('../uploads/'.$row2["Photo"])){?>
                 <img src="../uploads/<?php echo $row2["Photo"];?>" alt="">
                  <?php }  else{?>
                 <img src="no_image.jpg"> 
             <?php } ?>
             
                                        </div>
                                        
                                    </div></a>
                                 <p class="" style="line-height: 12px;padding-top: 5px;"><small style="color: black;"><?php echo $row2["Name"];?></small></p>
                                </div>
                                
                            </div>
                        </div>
                         <?php } } ?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination white-pagination text-left mb-3"></div>
                </div>
            </div>
            
        <!-- page content start -->
      
        <div class="main-container">
<div class="container mb-4">
    
    
    <div class="row">
    <?php 
                        $results_per_page = 5000; // number of results per page
      if (isset($_GET["page"])) {
        $page = $_GET["page"];
      } else {
        $page = 1;
        };
     $start_from = ($page - 1) * $results_per_page;  
                        $CatId = $_GET['cat_id'];
                        $SubCatId = $_GET['subid'];
                        $brand_id = $_GET['brand_id'];
                        
                        $query = "SELECT * FROM tbl_cust_products WHERE Status='1' AND CreatedBy IN ($FranchiseId) AND QrDisplay='Yes'";
                    
                        if($_GET['cat_id']!=''){
                            if($_GET['cat_id'] == 'all'){
                                $query.= " ";
                            }
                            else{
                        $query.= " AND CatId='$CatId'";
                            }
                        }
                        $query.= "  ORDER BY srno asc"; 
                        //echo $query;
                        $pagerncnt = getRow($query);
                        $query.="  LIMIT $start_from,$results_per_page";   
                        //echo $query;
                        $rncnt = getRow($query);
                        if($rncnt > 0){
                         $row = getList($query);
                        foreach($row as $result){
                            $Prod_id = $result["id"];
                        $cat_id = $result['CatId'];
                        $SizeId = $result['Size'];
                        $ItemStock = $result['Stock'];
                       
                         ?>
                            
                           <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
  <input type="hidden" value="<?php echo $value;?>" id="wishid<?php echo $result["id"];?>">
   <input type="hidden" id="pid<?php echo $result["id"];?>" value="<?php echo $result["id"];?>">
    <input type="hidden" id="sizeid<?php echo $result["id"];?>" value="<?php echo $result['Size'];?>">
   <input type="hidden" id="ramid<?php echo $result["id"];?>" value="<?php echo $result['Ram'];?>">
    <input type="hidden" id="storageid<?php echo $result["id"];?>" value="<?php echo $result['Storage'];?>">
    <input type="hidden" id="code<?php echo $result["id"];?>" value="<?php echo $result['code'];?>">
     <input type="hidden" id="prd_price<?php echo $result["id"];?>" value="<?php echo $result['MinPrice'];?>"> 
      <input type="hidden" id="qntno<?php echo $result["id"];?>" value="1">   
      
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card border-0 mb-4 overflow-hidden">
                            <div class="card-body h-150 position-relative">
                               
                                <!--<div class="bottom-left m-2">
                                    <button class="btn btn-sm btn-default rounded">New</button>
                                </div>-->
                               
                                   <?php if($result["Photo"] == '') {?>
                  <img src="no_image.jpg" style="width: 120px;height: 120px;"> 
                 <?php } else if(file_exists('../uploads/'.$result["Photo"])){?>
                 <img src="../uploads/<?php echo $result["Photo"];?>" alt="" style="width: 120px;height: 120px;">
                  <?php }  else{?>
                 <img src="no_image.jpg" style="width: 120px;height: 120px;"> 
             <?php } ?>
                               
                            </div>
                            <div class="card-body" style="text-align: center;">
                                
                                    <p class="mb-0"><?php echo $result['ProductName'];?></p>
                              
                              
                        
                                                        <h5 class="mb-0">
                                                             
                                                            &#8377;<?php echo number_format($result['MinPrice'],2);?>/-</h5>
                      
                                 <a href="javascript:void(0)"  id="add-cart<?php echo $result["id"];?>" onclick="addCart(<?php echo $result["id"];?>);" class="btn btn-sm btn-default rounded" style="font-size: 12px;"><i style="font-size:14px;" class="material-icons">local_mall</i> Add To Cart</a>
                            </div>
                        </div>
                    </div>
                    <?php  } } else{ ?>
                            
                            <h5 style="padding-left: 15px;color: red;">No Record Founds...</h5>
                            <?php } ?>
                  
                    
                </div>
                
            
                        
    <br><br><br>

          
             
        </div>
    </main>
  <?php //include_once 'footer.php'; ?>
<script src="dist/aos.js"></script>
    <script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>
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
      <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript">
         function getDiffSize(id,pid){
      $('#sizeid'+pid).val(id);
    var sizeid = $('#sizeid'+pid).val();
    getDiffPrice2(id,pid);
   }   
     function getDiffPrice2(sizeid,pid){
     var action = 'getDiffPrice2';
            $.ajax({
  type: "POST",
  url: "ajax_files/ajax_product.php",
   data:{action:action,pid:pid,sizeid:sizeid},  
  success: function(data){
    res = JSON.parse(data);
      var MinPrice = res.MinPrice;
      var MaxPrice = res.MaxPrice;
      var OfferPrice = res.OfferPrice;
      var OfferPer = res.OfferPer;
      var MinPrice2 = res.MinPrice2;
      var MaxPrice2 = res.MaxPrice2;
      var OfferPrice2 = res.OfferPrice2;
      var status = res.status;
      var Stock = res.Stock;
      var ErrorMsg = res.ErrorMsg;
        $('#prd_price'+pid).val(MinPrice);
      if(Stock == 1){


/*$('#MaxPrice3'+pid).html('<del>&#8377;'+MaxPrice2+'</del>');*/
$('#MinPrice3'+pid).html('&#8377;'+MinPrice2);
//$('#OfferPer2'+pid).html('-'+OfferPer+'%');
//$('#notify_btn'+pid).hide();
$('#cart_btn'+pid).show();
      }
      else{
toastr.error('Currently, This Size Of Product is Not Available!', 'Error', {timeOut: 3000});
//$('#notify_btn'+pid).show();
$('#cart_btn'+pid).hide();
      }
    }
                  });
   } 
   
   function countCartProd(){
       var action = "countCartProd";
       $.ajax({
  type: "POST",
  url: "ajax_files/ajax_shop_cart.php",
  data: {action:action},
  success: function(data){
      $('#showcount').html(data);
      }
});
   }
        function addCart(id){
var action = "shop_cart";
var quantity = $('#qntno'+id).val();
var code = $('#code'+id).val();
var pid = $('#pid'+id).val();
var sizeid = $('#sizeid'+id).val();
var ramid = $('#ramid'+id).val();
var storageid = $('#storageid'+id).val();
var price = $('#prd_price'+id).val();
$.ajax({
  type: "POST",
  url: "ajax_files/ajax_shop_cart.php",
  data: {action:action,pid:pid,quantity:quantity,code:code,sizeid:sizeid,ramid:ramid,storageid:storageid,price:price},
   beforeSend:function(){
     $('#add-cart'+id).attr('disabled','disabled');
     $('#add-cart'+id).text('Adding To Cart...');
    },

  success: function(data){
      countCartProd();
       toastr.success('Product Added to Cart', 'Success', {timeOut: 1000});
       $('#add-cart'+id).attr('disabled',false);
                       $('#add-cart'+id).text('Added..');
      }
});

        }
    </script>
</body>

</html>
