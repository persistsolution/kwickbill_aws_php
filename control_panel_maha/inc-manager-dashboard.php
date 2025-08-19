<?php if(in_array("44", $Options)) {?>
  <div class="col-sm-6 col-xl-2">
                                <a href="ho-manager-pending-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Pending Expenses</h6>
                                                    <div class="count"><?php
                                                                            $pendingCount = 0;

$sql = "SELECT te.*, tu.Fname, tu.Lname, tu.Photo AS Uphoto, 
               tu2.Fname AS MgrName, tec.Name AS ExpCatName, 
               tub.ShopName, tl.Name AS ExpLocation, 
               tu3.Fname AS AccName 
        FROM tbl_expense_request te 
        INNER JOIN tbl_users tu ON tu.id = te.UserId 
        LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy 
        LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy 
        LEFT JOIN tbl_expenses_category tec ON tec.id = te.ExpCatId 
        LEFT JOIN tbl_users_bill tub ON tub.id = te.FrId 
        LEFT JOIN tbl_locations tl ON tl.id = te.Locations 
        WHERE te.ManagerStatus = '0' 
          AND te.AdminStatus = '0' 
          AND te.UserId != 0 
          AND te.SendToApproval = 'Yes'";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $pendingCount++;
    }
}

echo $pendingCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="ho-manager-approve-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Approve Expenses</h6>
                                                    <div class="count"><?php
                                                                            $approveCount = 0;

$sql = "SELECT te.*, tu.Fname, tu.Lname, tu.Photo AS Uphoto, 
               tu2.Fname AS MgrName, tec.Name AS ExpCatName, 
               tub.ShopName, tl.Name AS ExpLocation, 
               tu3.Fname AS AccName 
        FROM tbl_expense_request te 
        INNER JOIN tbl_users tu ON tu.id = te.UserId 
        LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy 
        LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy 
        LEFT JOIN tbl_expenses_category tec ON tec.id = te.ExpCatId 
        LEFT JOIN tbl_users_bill tub ON tub.id = te.FrId 
        LEFT JOIN tbl_locations tl ON tl.id = te.Locations 
        WHERE te.ManagerStatus = '1'
          AND te.UserId != 0 
          AND te.SendToApproval = 'Yes'";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $approveCount++;
    }
}

echo $approveCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="ho-manager-reject-expense-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Rejected Expenses</h6>
                                                    <div class="count"><?php
                                                                            $rejectCount = 0;

$sql = "SELECT te.*, tu.Fname, tu.Lname, tu.Photo AS Uphoto, 
               tu2.Fname AS MgrName, tec.Name AS ExpCatName, 
               tub.ShopName, tl.Name AS ExpLocation, 
               tu3.Fname AS AccName 
        FROM tbl_expense_request te 
        INNER JOIN tbl_users tu ON tu.id = te.UserId 
        LEFT JOIN tbl_users tu2 ON tu2.id = te.MrgBy 
        LEFT JOIN tbl_users tu3 ON tu3.id = te.AccBy 
        LEFT JOIN tbl_expenses_category tec ON tec.id = te.ExpCatId 
        LEFT JOIN tbl_users_bill tub ON tub.id = te.FrId 
        LEFT JOIN tbl_locations tl ON tl.id = te.Locations 
        WHERE te.ManagerStatus = '2'
          AND te.UserId != 0 
          AND te.SendToApproval = 'Yes'";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $rejectCount++;
    }
}

echo $rejectCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("46", $Options)) {?>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-pending-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Mananger Pending Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                            $pendingCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='0' AND te.UserId!=0 AND te.ExpenseDate>='2025-06-28'";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $pendingCount++;
    }
}

echo $pendingCount;


                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-approve-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Mananger Approve Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                            $approveCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='1' AND te.UserId!=0 AND te.ExpenseDate>='2025-06-28'";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $approveCount++;
    }
}

echo $approveCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-reject-pretty-cash-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Mananger Rejected Petty Cash Request</h6>
                                                    <div class="count"><?php
                                                                            $rejectCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_prettycash_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='2' AND te.UserId!=0 AND te.ExpenseDate>='2025-06-28'";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $rejectCount++;
    }
}

echo $rejectCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("68", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-pending-resign-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Pending Resign Request</h6>
                                                    <div class="count"><?php
                                                                            $pendingCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_resign_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='0' AND te.UserId!=0 ";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $pendingCount++;
    }
}

echo $pendingCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-approve-resign-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Approve Resign Request</h6>
                                                    <div class="count"><?php
                                                                            $approveCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_resign_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='1' AND te.UserId!=0 ";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $approveCount++;
    }
}

echo $approveCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-reject-resign-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Rejected Resign Request</h6>
                                                    <div class="count"><?php
                                                                            $rejectCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_resign_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='1' AND te.UserId!=0 ";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $rejectCount++;
    }
}

echo $rejectCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("69", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-pending-advance-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Pending Advance Request</h6>
                                                    <div class="count"><?php
                                                                            $pendingCount = 0;

$currentMonth = date('n'); 
         
               $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_advance_salary te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='0' AND te.UserId!=0 
        AND MONTH(te.AdvanceDate) = '$currentMonth' "; 

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $pendingCount++;
    }
}

echo $pendingCount;


                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                             <div class="col-sm-6 col-xl-2">
                                <a href="manager-approve-advance-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Approve Advance Request</h6>
                                                    <div class="count"><?php
                                                                            $approveCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_advance_salary te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='1' AND te.UserId!=0 ";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $approveCount++;
    }
}

echo $approveCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                             <div class="col-sm-6 col-xl-2">
                                <a href="manager-reject-advance-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Rejected Advance Request</h6>
                                                    <div class="count"><?php
                                                                            $rejectCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_advance_salary te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='2' AND te.UserId!=0 ";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $rejectCount++;
    }
}

echo $approveCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                             <?php } if(in_array("70", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-pending-attendance-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Pending Attendance Request</h6>
                                                    <div class="count"><?php
                                                                            $pendingCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_attendance_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='0' AND te.UserId!=0 ";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $pendingCount++;
    }
}

echo $pendingCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-approve-attendance-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Approve Attendance Request</h6>
                                                    <div class="count"><?php
                                                                            $approveCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_attendance_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='1' AND te.UserId!=0 ";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $approveCount++;
    }
}

echo $approveCount;


                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-reject-attendance-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Rejected Attendance Request</h6>
                                                    <div class="count"><?php
                                                                            $rejectCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_attendance_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='2' AND te.UserId!=0 ";

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $rejectCount++;
    }
}

echo $rejectCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } if(in_array("71", $Options)) {?>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-pending-leave-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Pending Leave Request</h6>
                                                    <div class="count"><?php
                                                                            $pendingCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_leave_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='0' AND te.UserId!=0"; 

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $pendingCount++;
    }
}

echo $pendingCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-approve-leave-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Approve Leave Request</h6>
                                                    <div class="count"><?php
                                                                            $approveCount = 0;

$sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_leave_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='1' AND te.UserId!=0"; 

$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $approveCount++;
    }
}

echo $approveCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-xl-2">
                                <a href="manager-reject-leave-request.php" class="dashboard-card">
                                    <div class="card mb-4 bg-pattern-3-dark">
                                        <div class="card-body" style="padding-top: 15px; padding-bottom: 15px; padding-right: 5px; padding-left: 10px;">
                                            <div class="d-flex align-items-center">

                                                <div class="ml-3">
                                                    <h6 class="mb-0" style="color: black;">Manager Rejected Leave Request</h6>
                                                    <div class="count"><?php
                                                                            $rejectCount = 0;

  $sql = "SELECT te.*,tu.Fname,tu.Lname,tu.Photo AS Uphoto,tu2.Fname AS MgrName FROM tbl_leave_request te 
                INNER JOIN tbl_users tu ON tu.id=te.UserId 
                LEFT JOIN tbl_users tu2 ON tu2.id=te.MrgBy 
                WHERE te.ManagerStatus='2' AND te.UserId!=0"; 
                
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $UserId = $row['UserId'];
    $sql2 = "SELECT UnderByUser FROM tbl_users WHERE id = '$UserId'";
    $row2 = getRecord($sql2);
    $UnderByUser = $row2['UnderByUser'] ?? 0;

    if ($UnderByUser == $user_id) {
        $rejectCount++;
    }
}

echo $rejectCount;

                                                                            ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php } ?>