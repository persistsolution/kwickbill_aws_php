<?php if(in_array("43", $Options)) {?>
 <div class="col-sm-6 col-xl-2">
                                <a href="nso-vendor-pending-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">NSO Dept Pending NSO Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='0' AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01' "; 
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="nso-vendor-approve-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">NSO Dept Approve NSO Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu7.Fname AS PayByName,tu6.Fname AS AccName,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu6 ON tu6.id=te.AccBy 
                LEFT JOIN tbl_users tu7 ON tu7.id=te.PayBy
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01' "; 
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="nso-vendor-reject-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">NSO Dept Rejected NSO Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='2' AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01' "; 
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } ?>