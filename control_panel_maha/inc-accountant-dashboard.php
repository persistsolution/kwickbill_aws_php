                            <?php if(in_array("87", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="pending-cash-book-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Pending Cash Book Request</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT tcb.*,tu.ShopName,tu.Phone FROM tbl_cash_book tcb INNER JOIN tbl_users tu On tu.id=tcb.FrId WHERE tcb.ApproveStatus=0";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="approve-cash-book-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Approve Cash Book Request</h6>
                                                    <div class="count"><?php
                                                                              $sql = "SELECT tcb.*,tu.ShopName,tu.Phone FROM tbl_cash_book tcb INNER JOIN tbl_users tu On tu.id=tcb.FrId WHERE tcb.ApproveStatus=1";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="reject-cash-book-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Reject Cash Book Request</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT tcb.*,tu.ShopName,tu.Phone FROM tbl_cash_book tcb INNER JOIN tbl_users tu On tu.id=tcb.FrId WHERE tcb.ApproveStatus=2";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("17", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-vendor-pending-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Pending Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tub.ShopName FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='0' AND te.UserId!=0 "; 
                  $sql.=" ORDER BY te.ExpenseDate DESC";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-vendor-approve-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Approve Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                             $sql = "SELECT te.*,tu7.Fname AS PayByName,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tub.ShopName,tu6.Fname AS AccName FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users tu6 ON tu6.id=te.AccBy 
                LEFT JOIN tbl_users tu7 ON tu7.id=te.PayBy
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.ManagerStatus='1' AND te.UserId!=0 "; 
                  $sql.=" ORDER BY te.ExpenseDate DESC";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-vendor-reject-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Reject Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu7.Fname AS PayByName,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tub.ShopName,tu6.Fname AS AccName FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users tu6 ON tu6.id=te.AccBy 
                LEFT JOIN tbl_users tu7 ON tu7.id=te.PayBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.ManagerStatus='2' AND te.UserId!=0 ";
                 $sql.=" ORDER BY te.ExpenseDate DESC";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("18", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-nso-vendor-pending-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Pending NSO Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='0' AND te.UserId!=0";
                 $sql.=" ORDER BY te.ExpenseDate DESC";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-nso-vendor-approve-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Approve NSO Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.UserId!=0";
                 $sql.=" ORDER BY te.ExpenseDate DESC";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-nso-vendor-reject-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Reject NSO Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                             $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='2' AND te.UserId!=0"; 
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <?php } if(in_array("28", $Options)) {?>
                             <div class="col-sm-6 col-xl-2">
                                <a href="account-pending-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Pending Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AdminName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AdminBy 
                WHERE te.ManagerStatus='1' AND te.UserId!=0 AND te.AdminStatus=1 AND te.AccStatus='0' AND te.ExpenseDate>='2025-06-28'"; 
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="account-approve-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Approve Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AdminName,tu4.Fname AS AccName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AdminBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                WHERE te.AccStatus='1' AND te.UserId!=0 AND te.ExpenseDate>='2025-06-28' "; 
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="account-reject-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account Reject Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AdminName,tu4.Fname AS AccName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AdminBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                WHERE te.AccStatus='2' AND te.UserId!=0 AND te.ExpenseDate>='2025-06-28' "; 
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                             <!--<div class="col-sm-6 col-xl-2">
                                <a href="#">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account/Admin Pending Advance Request</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT * FROM tbl_purchase_order";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="#">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account/Admin Approve Advance Request</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT * FROM tbl_purchase_order";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="#">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Account/Admin Reject Advance Request</h6>
                                                    <div class="count"><?php
                                                                            $sql4 = "SELECT * FROM tbl_purchase_order";
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>-->
                             <?php } if(in_array("47", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="view-payable-amount-vendors.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Pending Vendor Amount</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS AccName,tub.ShopName FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus='1' AND te.PaymentStatus=0 AND te.UserId!=0 AND te.Locations IN($AssignFranchiseVedExp)"; 
           
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="view-payment-done-amount-vendors.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Paid Vendor Amount</h6>
                                                    <div class="count"><?php
                                                                         $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS AccName,tub.ShopName FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus='1' AND te.PaymentStatus=1 AND te.UserId!=0 AND te.Locations IN($AssignFranchiseVedExp)"; 
           
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("48", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="view-payable-amount-nso-vendors.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Pending NSO Vendor Amount</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS AccName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus='1' AND te.PaymentStatus=0 AND te.UserId!=0 AND te.Locations IN($AssignFranchiseVedExp)"; 
           
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="view-payment-done-amount-nso-vendors.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Paid NSO Vendor Amount</h6>
                                                    <div class="count"><?php
                                                                             $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS AccName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                INNER JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus='1' AND te.PaymentStatus=1 AND te.UserId!=0 AND te.Locations IN($AssignFranchiseVedExp)"; 
           
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } ?>