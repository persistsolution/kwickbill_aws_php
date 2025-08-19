<div class="col-sm-6 col-xl-2">
                                <a href="all-pending-expenses.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">All Pending Expenses</h6>
                                                     <div class="count"><?php
                                                                            /*$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AccName,tec.Name As ExpCatName,tub.ShopName,tl.Name AS ExpLocation FROM tbl_expense_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AccBy 
                LEFT JOIN tbl_expenses_category tec ON tec.id=te.ExpCatId 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.FrId 
                LEFT JOIN tbl_locations tl ON tl.id=te.Locations WHERE te.AdminStatus = 0 
  AND (
        (te.ManagerStatus != 2 AND te.Gst = 'No') 
     OR (te.ManagerStatus != 2 AND te.AccountStatus != 2 AND te.Gst = 'Yes') 
      )
GROUP BY te.id"; */
               
               $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AccName,tec.Name As ExpCatName,tub.ShopName,tl.Name AS ExpLocation FROM tbl_expense_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AccBy 
                LEFT JOIN tbl_expenses_category tec ON tec.id=te.ExpCatId 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.FrId 
                LEFT JOIN tbl_locations tl ON tl.id=te.Locations WHERE te.AdminStatus = 0 
  AND (te.ManagerStatus != 2)
GROUP BY te.id"; 

             $sql.=" ORDER BY te.CreatedDate DESC";  
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="all-pending-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">All Pending Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                             $sql = "SELECT te.*, tu.Fname, tu.Lname, tu.Photo AS Uphoto, 
       tu2.Fname AS MgrName, tu3.Fname AS AccName 
FROM tbl_prettycash_request te 
INNER JOIN tbl_users tu ON tu.id = te.UserId 
LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy 
LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy 
WHERE te.UserId != 0 
  AND (te.ManagerStatus = '0' OR te.AdminStatus = 0 OR te.AccStatus = 0) 
  AND te.ManagerStatus != '2' 
  AND te.AccStatus != '2' 
  AND te.AdminStatus != 2  AND te.ExpenseDate>='2025-06-28'"; 
                
        
            
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
                                <a href="all-pending-vendor-exepense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">All Pending Vendor Expenses Request</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*, tu.Fname, tu.Lname, tu.Photo AS Uphoto, tu2.Fname AS MgrName, tu3.Fname AS VedName, tu4.Fname AS BdmName, tu5.Fname AS PurchaseName, tub.ShopName 
                FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id = te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id = te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id = te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id = te.PurchaseBy 
                LEFT JOIN tbl_users_bill tub ON tub.id = te.Locations 
                WHERE 
    te.UserId != 0 AND 
    te.BdmStatus != '2' AND 
    te.PurchaseStatus != '2' AND 
    te.ManagerStatus != '2' AND 
    te.AdminStatus != '2' AND 
    (
        te.BdmStatus = '0' OR 
        te.PurchaseStatus = '0' OR 
        te.ManagerStatus = '0' OR 
        te.AdminStatus = 0
    )";
    $sql .= " ORDER BY te.ExpenseDate DESC";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                             <div class="col-sm-6 col-xl-2">
                                <a href="all-pending-nso-vendor-exepense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">All Pending NSO Vendor Expenses Request</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*, tu.Fname, tu.Lname, tu.Photo AS Uphoto, tu2.Fname AS MgrName, tu3.Fname AS VedName, tu4.Fname AS BdmName, tu5.Fname AS PurchaseName, tub.ShopName 
                FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id = te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id = te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id = te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id = te.PurchaseBy 
                LEFT JOIN tbl_users_bill tub ON tub.id = te.Locations 
                WHERE 
    te.UserId != 0 AND 
    te.BdmStatus != '2' AND 
    te.PurchaseStatus != '2' AND 
    te.ManagerStatus != '2' AND 
    te.AdminStatus != '2' AND 
    (
        te.BdmStatus = '0' OR 
        te.PurchaseStatus = '0' OR 
        te.ManagerStatus = '0' OR 
        te.AdminStatus = 0
    )";
    
     $sql .= " ORDER BY te.ExpenseDate DESC";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="all-pending-attendance-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">All Pending Attendace Request</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_attendance_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='0' AND te.UserId!=0"; 
            
            $sql.=" ORDER BY te.ReqDate DESC";
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <!--<div class="col-sm-6 col-xl-2">
                                <a href="all-pending-expenses.php">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">All Admin Expenses</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AccName,tec.Name As ExpCatName,tub.ShopName,tl.Name AS ExpLocation FROM tbl_expense_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AccBy 
                LEFT JOIN tbl_expenses_category tec ON tec.id=te.ExpCatId 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.FrId 
                LEFT JOIN tbl_locations tl ON tl.id=te.Locations WHERE te.AdminStatus IN (0) AND te.ManagerStatus!=2"; 
               
             $sql.=" ORDER BY te.CreatedDate DESC";  
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>-->
                            
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="ho-admin-pending-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Pending Employee Expense Request</h6>
                                                    <div class="count"><?php
                                                                           /*$sql = "SELECT te.*, 
       tu.Fname, 
       tu.Lname, 
       tu.Photo AS Uphoto, 
       tu2.Fname AS MgrName, 
       tu3.Fname AS AccName, 
       tu4.Fname AS AccountName
FROM tbl_expense_request te
INNER JOIN tbl_users tu ON tu.id = te.UserId
LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy
LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy
LEFT JOIN tbl_users tu4 ON tu4.id = te.AccountBy
WHERE te.UserId != 0 AND te.SendToApproval = 'Yes' AND
(
    (te.AdminStatus = 0 AND tu.UnderByUser NOT IN (5,384,415) 
     AND (
        (te.ManagerStatus = 1 AND te.Gst = 'No') 
        OR (te.ManagerStatus = 1 AND te.AccountStatus = 1 AND te.Gst = 'Yes')
     )
    )
    OR
    (te.AdminStatus = 0 AND te.AccountStatus = 1 AND tu.UnderByUser IN (5,384,415))
)
GROUP BY te.id
ORDER BY te.CreatedDate DESC";  */

$sql = "SELECT te.*, 
       tu.Fname, 
       tu.Lname, 
       tu.Photo AS Uphoto, 
       tu2.Fname AS MgrName, 
       tu3.Fname AS AccName, 
       tu4.Fname AS AccountName
FROM tbl_expense_request te
INNER JOIN tbl_users tu ON tu.id = te.UserId
LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy
LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy
LEFT JOIN tbl_users tu4 ON tu4.id = te.AccountBy
WHERE te.UserId != 0 AND te.SendToApproval = 'Yes' AND
(
    (te.AdminStatus = 0 AND tu.UnderByUser NOT IN (5,384,415) 
     AND (te.ManagerStatus = 1)
    )
    OR
    (te.AdminStatus = 0 AND tu.UnderByUser IN (5,384,415))
)
GROUP BY te.id
ORDER BY te.CreatedDate DESC";  
                                                                            echo $rncnt4 = getRow($sql);

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                             <div class="col-sm-6 col-xl-2">
                                <a href="ho-admin-approve-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Approve Employee Expense Request</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AccName,tec.Name As ExpCatName,tub.ShopName,tl.Name AS ExpLocation FROM tbl_expense_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AccBy 
                LEFT JOIN tbl_expenses_category tec ON tec.id=te.ExpCatId 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.FrId 
                LEFT JOIN tbl_locations tl ON tl.id=te.Locations WHERE te.mult=0 AND te.ManagerStatus=1 AND te.AdminStatus=1 AND te.UserId!=0 AND (te.Amount>5000 OR te.ExpCatId=3)"; 
                
            $sql.=" ORDER BY te.CreatedDate DESC";  
                                                                            echo $rncnt4 = getRow($sql);
                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                             <div class="col-sm-6 col-xl-2">
                                <a href="ho-admin-reject-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Reject Employee Expense Request</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AccName,tec.Name As ExpCatName,tub.ShopName,tl.Name AS ExpLocation FROM tbl_expense_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AccBy 
                LEFT JOIN tbl_expenses_category tec ON tec.id=te.ExpCatId 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.FrId 
                LEFT JOIN tbl_locations tl ON tl.id=te.Locations WHERE te.AdminStatus IN (2) AND te.UserId NOT IN(0,57,2003,475,1359) AND (te.Amount>5000 OR te.ExpCatId=3)"; 
                
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
                                <a href="ho-pending-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Pending Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                              $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AdminName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AdminBy 
                WHERE te.ManagerStatus='1' AND te.AdminStatus='0' AND te.UserId!=0 AND te.ExpenseDate>='2025-06-28' "; 
            
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
                                <a href="ho-approve-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Approve Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                             $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AdminName,tu4.Fname AS AccName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AdminBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                WHERE te.AdminStatus='1' AND te.UserId!=0 AND te.ExpenseDate>='2025-06-28' "; 
            
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
                                <a href="ho-reject-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Reject Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                             $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS AdminName,tu4.Fname AS AccName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.AdminBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.AccBy 
                WHERE te.AdminStatus='2' AND te.UserId!=0 AND te.ExpenseDate>='2025-06-28' "; 
            
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
                                <a href="account-vendor-pending-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Pending Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tub.ShopName FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus=0 AND te.UserId!=0 "; 
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
                                <a href="account-vendor-approve-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Approve Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT te.*,tu7.Fname AS PayByName,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tu6.Fname AS AccName,tub.ShopName FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users tu6 ON tu6.id=te.AccBy 
                LEFT JOIN tbl_users tu7 ON tu7.id=te.PayBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus=1 AND te.UserId!=0 "; 
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
                                <a href="account-vendor-reject-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Reject Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tu6.Fname AS AccName,tub.ShopName FROM tbl_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users tu6 ON tu6.id=te.AccBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus=2 AND te.UserId!=0 "; 
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
                                <a href="account-nso-vendor-pending-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Pending NSO Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                            $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus=0 AND te.UserId!=0 "; 
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
                                <a href="account-nso-vendor-pending-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Approve NSO Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tu6.Fname AS AccName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users tu6 ON tu6.id=te.AccBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus=1 AND te.UserId!=0 "; 
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
                                <a href="account-nso-vendor-reject-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Admin Reject NSO Vendor Expenses</h6>
                                                    <div class="count"><?php
                                                                           $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName,tu3.Fname AS VedName,tu4.Fname AS BdmName,tu5.Fname AS PurchaseName,tu6.Fname AS AccName,tub.ShopName FROM tbl_nso_vendor_expenses te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu3 ON tu3.id=te.VedId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                LEFT JOIN tbl_users tu4 ON tu4.id=te.BdmBy 
                LEFT JOIN tbl_users tu5 ON tu5.id=te.PurchaseBy 
                LEFT JOIN tbl_users tu6 ON tu6.id=te.AccBy 
                LEFT JOIN tbl_users_bill tub ON tub.id=te.Locations WHERE te.BdmStatus='1' AND te.PurchaseStatus='1' AND te.ManagerStatus='1' AND te.AdminStatus=2 AND te.UserId!=0 "; 
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