 <div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title">Today End Attendance</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>

      <div class="modal-body">
        <form id="validation-form2" method="post" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="date" id="CreatedDate" value="<?php echo date('Y-m-d');?>">
         <input type="hidden" id="TempPrdId2" name="TempPrdId2" value="<?php echo rand(10000,99999);?>">
      <!-- <div class="form-group float-label active">
                           
                           
                           <main>
    <div class="slim" data-service="example/async.php?Roll=2" data-did-remove="handleImageRemoval">
        
        <input type="file" name="slim[]" id="Photo" name="car3_logo" class="input_css"/>
      
    </div>
</main>

                            <label class="form-control-label">Upload Selfi</label>                            
                        </div>-->
                        
                        <div class="row">
                                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group float-label active">
                            <input type="file" class="form-control" name="Photo2" accept=".jpg">
                            <label class="form-control-label">Upload Selfi</label>
                        </div>
                    </div>
                                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <div class="form-group float-label active">
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" readonly>
                            <label class="form-control-label">Date</label>
                        </div>
                    </div>
                    
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" value="<?php echo date('h:i a');?>" readonly>
                            <label class="form-control-label">Time</label>
                        </div>
                    </div>
                    
                   <!-- <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" value="<?php echo $Latitude;?>" readonly>
                            <label class="form-control-label">Latitude</label>
                        </div>
                    </div>
                    
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" value="<?php echo $Longitude;?>" readonly>
                            <label class="form-control-label">Longitude</label>
                        </div>
                    </div>-->
                    
                      <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 ">
                        <div class="form-group float-label active">
                            <input type="text" class="form-control" value="<?php echo $tot_dist;?>" readonly>
                            <label class="form-control-label">Your Location From Franchise in Km</label>
                        </div>
                    </div>
                    <?php if($CashHandover == 1){?>
                  <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 ">
                        <div class="form-group float-label active">
                            <input type="number" class="form-control" value="" required name="HandoverAmt" min="1">
                            <label class="form-control-label">Cash Handover</label>
                        </div>
                    </div>
                    
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 ">
                        <div class="form-group float-label active">
                           <select class="form-control" name="HandoverUserId" required>
                               <option value="" selected>...</option>
                               <?php 
                                $sql = "SELECT id,Fname FROM tbl_users WHERE UnderFrId='$UnderFrId' AND id!='$UserId' AND Status=1 AND Roll NOT IN(1,5,55,9,22,23,63,3)";
                                $row = getList($sql);
                                foreach($row as $result){
                                ?>
                                <option value="<?php echo $result['id'];?>"><?php echo ucwords(strtolower($result['Fname'])); ?></option>
                                <?php } ?>
                           </select>
                            <label class="form-control-label">Handover To</label>
                        </div>
                    </div>
                    <?php } ?>
                    
                     <!--<div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12 ">
                        <div class="form-group float-label active">
                     <div id="dvMap2" style="width: 100%; height: 300px">
    </div>
    </div>
                    </div>-->
                    
                    </div>
<input type="hidden" name="userid" value="<?php echo $_SESSION['User']['id']; ?>" id="userid">  

<input type="hidden" name="frlattitude" value="<?php echo $FrLattitude; ?>" id="frlattitude"> 

<input type="hidden" name="frlongitude" value="<?php echo $FrLongitude; ?>" id="frlongitude"> 

                      <input type="hidden" name="action" value="takeAttendance2" id="action">  
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" id="submit2">Submit</button>
                    </div>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>