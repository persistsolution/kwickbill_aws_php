 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title">Today Start Attendance</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>

      <div class="modal-body">
        <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
             <input type="hidden" id="TempPrdId" name="TempPrdId" value="<?php echo rand(10000,99999);?>">
        <input type="hidden" name="date" id="CreatedDate" value="<?php echo date('Y-m-d');?>">
    
                       
                        
                        <div class="row">
                                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group float-label active">
                            <input type="file" class="form-control" name="Photo" accept=".jpg">
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
                    
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
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
                    </div>
                    </div>
<input type="hidden" name="userid" value="<?php echo $_SESSION['User']['id']; ?>" id="userid">  
                      <input type="hidden" name="action" value="takeAttendance" id="action">  
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" id="submit">Submit</button>
                    </div>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>