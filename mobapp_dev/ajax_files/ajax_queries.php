<?php
session_start();
include_once '../config.php';
$user_id = $_SESSION['User']['id'];
  
if($_POST['action']=='SaveQuery'){
    $id = $_POST['id'];
    $Questions = addslashes(trim($_POST['Questions']));
    $CreatedDate = date('Y-m-d');
    $sql = "INSERT INTO tbl_query_questions SET StudId='$user_id',Questions='$Questions',Status=1,CreatedDate='$CreatedDate'";
    $conn->query($sql);
    echo 1;
}   

if($_POST['action']=='SaveComments'){
    $QueryId = $_POST['QueryId'];
    $Comments = addslashes(trim($_POST['Comments']));
    $CustName = addslashes(trim($_POST["CustName"]));
$Phone = addslashes(trim($_POST["Phone"]));
$Address = addslashes(trim($_POST['Address']));
    $CreatedDate = date('Y-m-d');
    $CreatedTime = date('h:i a');
    $sql = "INSERT INTO tbl_customer_query_feedback SET SellId='$QueryId',CustId='$user_id',Details='$Comments',CreatedDate='$CreatedDate',CreatedBy='$user_id',Status=1,CreatedTime='$CreatedTime',Diaposition=1,CustName='$CustName',Phone = '$Phone',Address='$Address'";
    $conn->query($sql);
    echo 1;
}  
if($_POST['action']=='searchDoughts'){
    $SearchText = addslashes(trim($_POST['SearchText']));
                    $i=1;
                   
                  
                    $sql2 = "SELECT tq.*,tu.Fname,tu.Lname,tu.Photo FROM tbl_customer_queries tq LEFT JOIN tbl_users tu ON tq.CustId=tu.id WHERE tq.Details LIKE '%$SearchText%' AND tq.CustId='$user_id'"; 
                    //echo $sql2;
                    $rncnt2 = getRow($sql2);
                    if($rncnt2 > 0){
                    $res2 = getList($sql2);
                    foreach($res2 as $row){ 
                         if($i%2==0){
                            $bgcolor = "background-color: #e6f2ff;";
                        }
                        else{
                           $bgcolor = "background-color: #b3d9ff;"; 
                        }
                    $url =  $SiteUrl.'uploads/'.$row["Files"];
                    
                    /*$sql = "SELECT * FROM tbl_query_comments WHERE QueryId='".$row["id"]."'";
                    $rncnt = getRow($sql);
                    
                    $sql3 = "SELECT * FROM tbl_query_views WHERE QueryId='".$row["id"]."'";
                    $rncnt3 = getRow($sql3);*/
                    
                    ?>
                    
                    <input type="hidden" id="user_id" value="<?php echo $UserId; ?>">
 
   <input type="hidden" id="pid<?php echo $row["id"];?>" value="<?php echo $row["id"];?>">
 <input type="hidden" id="code<?php echo $row["id"];?>" value="<?php echo $row['code'];?>">
     <input type="hidden" id="prd_price<?php echo $row["id"];?>" value="<?php echo $row['Amount'];?>"> 
      <input type="hidden" id="qntno<?php echo $row["id"];?>" value="1">         
      
      
            <div class="col-12 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <a href="query-details.php?id=<?php echo $row['id'];?>">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-40 rounded">
                                            <div class="background" style="background-image: url('<?php echo $UploadUrl;?>/uploads/<?php echo $row['Photo'];?>');">
                                                <img src="<?php echo $UploadUrl;?>/uploads/<?php echo $row['Photo'];?>" alt="" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pr-0">
                                        <h6 class=" mb-1" style="font-weight:500;font-size:16px;"><?php echo $row["Details"];?></h6>
                                        <span style="font-size:12px;color:#0066ff;"><?php echo $row['Fname']." ".$row['Lname'];?></span>
                                        <p class="small text-secondary" style="font-size:14px;">
                                            <?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate']))); ?>
                                        </p>
                                    </div>
                                  
                                </div></a>
                                
                              
                            </div>
                        </div>
                    </div>
                    
                  
                     <?php $i++;} } else{?>
                        <h3 style="color:grey;padding-left: 10px;font-size: 15px;">No Queries Found</h3>
                    <?php } 
}

?>