  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title">Add Expenses</h4>
      </div>
      <div class="modal-body">
        
        <div class="card">
                  <form id="validation-form" method="post" autocomplete="off" enctype="multipart/form-data">
                   <div class="card-body">
                       <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
                        <div class="form-group float-label active">
                               <select class="form-control" name="FrId" id="FrId" required>
<option selected="" value="0">MAHA CHAI PVT LTD KHAMALA Branch (Main)</option>
 

 <?php 
    $sql33 = "SELECT * FROM `tbl_users_bill` WHERE Roll=5 AND ShopName!=''";
    $row33 = getList($sql33);
    foreach($row33 as $result){
?>
<option value="<?php echo $result['id'];?>" <?php if($row7["FrId"] == $result['id']) {?> selected <?php } ?>>
   <?php echo $result['ShopName']." (".$result['Phone'].")";?></option>
     <?php } ?>
</select>
                                  <label class="form-control-label">Franchise</label>
                            </div>
                   <div class="form-group float-label active">
                            <input type="text" class="form-control" name="Amount" id="Amount" value="<?php echo $row7['Amount']; ?>" autofocus required>
                            <label class="form-control-label">Amount</label>
                        </div>
                        
                         <div class="form-group float-label active">
                            <input type="date" class="form-control" name="ExpenseDate" id="ExpenseDate" value="<?php echo $row7['ExpenseDate']; ?>">
                            <label class="form-control-label">Expense Date</label>                            
                        </div>

                        
                          <div class="form-group float-label active">
                               <select class="form-control" name="PaymentMode" id="PaymentMode" required>
<option selected="" value="" disabled>Select Payment Type</option>
  <option value="Cash" <?php if($row7["PaymentMode"] == 'Cash') {?> selected <?php } ?>>
    By Cash</option>
<option value="Online" <?php if($row7["PaymentMode"] == 'Online') {?> selected <?php } ?>>
    By Online</option>
</select>
                                  <label class="form-control-label">Payment Type</label>
                            </div>


                     <div class="form-group float-label active">
                            <input type="number" class="form-control" name="VedPhone" id="VedPhone" value="<?php echo $row7['VedPhone']; ?>" required>
                            <label class="form-control-label">Vendor Mobile No</label>                            
                        </div>

                        <div class="form-group float-label active">
                            <input type="text" class="form-control" id="Narration" name="Narration" value="<?php echo $row7['Narration']; ?>">
                            <label class="form-control-label">Narration</label>                            
                        </div>
                        
                         <div class="form-group float-label active">
                            <input type="file" class="form-control" id="Photo" name="Photo">
                            <label class="form-control-label">Upload Receipt</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto" id="OldPhoto" value="<?php echo $row7['Photo']; ?>">
                        <?php if($row7['Photo'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo']; ?>"><?php echo $row7['Photo']; ?></a><?php } ?>
                       
                      
                      <div class="form-group float-label active">
                            <input type="file" class="form-control" id="Photo2" name="Photo2">
                            <label class="form-control-label">Upload Payment Receipt</label>                            
                        </div>
                          <input type="hidden" name="OldPhoto2" id="OldPhoto2" value="<?php echo $row7['Photo2']; ?>">
                        <?php if($row7['Photo2'] == '') {} else{?>
                        <a href="../uploads/<?php echo $row7['Photo2']; ?>"><?php echo $row7['Photo2']; ?></a><?php } ?>
                     
                  
                   <div class="form-group float-label active">
                               <select class="form-control" name="Gst" id="Gst" required>
<!--<option selected="" value="" disabled>GST</option>-->
<option value="No" <?php if($row7["Gst"] == 'No') {?> selected <?php } ?>>
   No</option>
  <option value="Yes" <?php if($row7["Gst"] == 'Yes') {?> selected <?php } ?>>
   Yes</option>

</select>
                                  <label class="form-control-label">GST</label>
                            </div>
                            
                
                    </div>
                        
                          <input type="hidden" name="CreatedBy" value="<?php echo $_SESSION['User']['id']; ?>" id="CreatedBy">  
                      <input type="hidden" name="action" value="NewReg" id="action">  
                    <div class="card-footer">
                        <button class="btn btn-block btn-default rounded" type="submit" name="submit" id="submit" onclick="save()">Submit</button>
                    </div>
                </form>
                </div>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>