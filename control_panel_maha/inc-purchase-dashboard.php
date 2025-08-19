<?php if(in_array("41", $Options)) {?>
<div class="col-sm-6 col-xl-2">
                                <a href="purchase-vendor-pending-expense-request.php">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Purchase Dept Pending Vendor Expenses</h6>
                                                    <div class="text-large"><?php
                                                                            $sql = "SELECT te.* FROM tbl_vendor_expenses te WHERE 
                                        te.BdmStatus='1' AND te.PurchaseStatus='0' AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01'"; 
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="purchase-vendor-approve-expense-request.php">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Purchase Dept Approve Vendor Expenses</h6>
                                                    <div class="text-large"><?php
                                                                            $sql = "SELECT te.* FROM tbl_vendor_expenses te WHERE te.PurchaseStatus='1' AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01'"; 
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="purchase-vendor-reject-expense-request.php">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Purchase Dept Rejected Vendor Expenses</h6>
                                                    <div class="text-large"><?php
                                                                            $sql = "SELECT te.* FROM tbl_vendor_expenses te WHERE te.PurchaseStatus='2' AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01'"; 
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div> 
                            <?php } if(in_array("42", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="nso-purchase-vendor-pending-expense-request.php">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Purchase Dept Pending NSO Vendor Expenses</h6>
                                                    <div class="text-large"><?php
                                                                            $sql = "SELECT te.* FROM tbl_nso_vendor_expenses te WHERE 
                                        te.BdmStatus='1' AND te.PurchaseStatus='0' AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01'"; 
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="nso-purchase-vendor-approve-expense-request.php">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Purchase Dept Approve NSO Vendor Expenses</h6>
                                                    <div class="text-large"><?php
                                                                            $sql = "SELECT te.* FROM tbl_nso_vendor_expenses te WHERE te.PurchaseStatus='1' AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01'"; 
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="nso-purchase-vendor-reject-expense-request.php">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Purchase Dept Rejected NSO Vendor Expenses</h6>
                                                    <div class="text-large"><?php
                                                                            $sql = "SELECT te.* FROM tbl_nso_vendor_expenses te WHERE te.PurchaseStatus='2' AND te.UserId!=0 AND te.ExpenseDate>='2025-05-01'"; 
                                                                            echo $rncnt4 = getRow($sql4);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } ?>