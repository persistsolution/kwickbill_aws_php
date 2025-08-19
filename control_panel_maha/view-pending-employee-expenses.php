<?php
session_start();
include_once 'config.php';
include_once 'auth.php';
$user_id = $_SESSION['Admin']['id'];
$MainPage = "Employee";
$Page = "View-Employee";

/*$sql = "SELECT * FROM `tbl_users` WHERE Roll NOT IN(1,5,55,9,22,23,63) AND IdStatus=0";
$row = getList($sql);
foreach($row as $result){
    $Phone = substr($result['Phone'],0,5);
    $CustomerId = "E".$Phone."".$result['id'];
    $sql = "UPDATE tbl_users SET CustomerId='$CustomerId',IdStatus=1 WHERE id='".$result['id']."'";
    $conn->query($sql);
}*/

$sql = "SELECT UnderFrId,id FROM `tbl_users` WHERE Roll NOT IN(1,5,55,9,22,23,63,3) AND ZoneId=0";
$row = getList($sql);
foreach ($row as $result) {
    $UnderFrId = $result['UnderFrId'];
    $sql55 = "SELECT ZoneId FROM tbl_users WHERE id='$UnderFrId'";
    $row55 = getRecord($sql55);
    $ZoneId = $row55['ZoneId'];
    $sql = "UPDATE tbl_users SET ZoneId='$ZoneId' WHERE id='" . $result['id'] . "'";
    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en" class="default-style">

<head>
    <title><?php echo $Proj_Title; ?> | View Employee Account List</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />
    <?php include_once 'header_script.php'; ?>
</head>

<body>

    <div class="layout-wrapper layout-1 layout-without-sidenav">
        <div class="layout-inner">

            <?php include_once 'top_header.php';
            include_once 'sidebar.php'; ?>


            <div class="layout-container">



                <?php
                if ($_REQUEST["action"] == "delete") {
                    $id = $_REQUEST["id"];
                    $sql11 = "DELETE FROM tbl_users WHERE id = '$id'";
                    $conn->query($sql11);
                ?>
                    <script type="text/javascript">
                        alert("Deleted Successfully!");
                        window.location.href = "view-employee.php";
                    </script>
                <?php } ?>

                <div class="layout-content">

                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">View Pending Employee Expenses

                        </h4>

                        <div class="card" style="padding: 10px;">
                            <div id="accordion2">
                                <div class="card mb-2">

                                    <div id="accordion2-2" class="collapse show" data-parent="#accordion2">
                                        <div class="" style="padding:5px;">
                                            <form id="validation-form" method="post" enctype="multipart/form-data" action="">
                                                <div class="form-row">

                                                    <div class="form-group col-md-2">
                                                        <label class="form-label">Zone </label>
                                                        <select class="form-control" id="ZoneId" name="ZoneId" required="">
                                                            <option selected="" value="all">All</option>
                                                            <?php $sql = "SELECT * FROM tbl_zone WHERE Status=1";
                                                            $row = getList($sql);
                                                            foreach ($row as $result) { ?>
                                                                <option value="<?php echo $result['id']; ?>" <?php if ($_POST["ZoneId"] == $result['id']) { ?> selected
                                                                    <?php } ?>><?php echo $result['Name']; ?></option>
                                                            <?php } ?>

                                                        </select>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="form-group col-md-5">
                                                        <label class="form-label">Franchise</label>
                                                        <select class="select2-demo form-control" name="UserId" id="UserId">
                                                            <option selected="" value="all">All</option>
                                                            <?php
                                                            $sql12 = "SELECT * FROM tbl_users WHERE Status='1' AND Roll IN(5) AND ShopName!=''";
                                                            $row12 = getList($sql12);
                                                            foreach ($row12 as $result) {
                                                            ?>
                                                                <option <?php if ($_REQUEST['UserId'] == $result['id']) { ?> selected <?php } ?>
                                                                    value="<?php echo $result['id']; ?>"><?php echo $result['ShopName']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>


                                                    <input type="hidden" name="Search" value="Search">
                                                    <div class="form-group col-md-1" style="padding-top:30px;">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-finish">Search</button>
                                                    </div>
                                                    <?php if (isset($_POST['Search'])) { ?>
                                                        <div class="col-md-1">
                                                            <label class="form-label d-none d-md-block">&nbsp;</label>
                                                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="top" data-original-title="Clear Filter">X</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-datatable table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>


                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Under By Employee</th>
                                            <!--<th>Total Expenses</th>-->
                                            <th>Pending Expenses</th>
                                            <!--<th>Approve Expenses</th>
                                            <th>Reject Expenses</th>-->
                                            <th>Zone</th>
                                            <th>Contact No</th>

                                            <th>Under Franchises</th>
                                            <th>Roll</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch main user data
                                        $sql = "SELECT tu.id, tu.ZoneId, tu.CustomerId, tu.Fname, tu.Lname, tu.Phone, tut.Name, 
                                                tu3.ShopName AS UnderFrName, tu4.Fname AS UserByEmpName, tz.Name AS ZoneName
                                            FROM tbl_users tu 
                                            LEFT JOIN tbl_user_type tut ON tut.id = tu.Roll 
                                            LEFT JOIN tbl_users tu3 ON tu3.id = tu.UnderFrId 
                                            LEFT JOIN tbl_users tu4 ON tu4.id = tu.UnderByUser
                                            LEFT JOIN tbl_zone tz ON tz.id = tu.ZoneId
                                            WHERE tu.Roll NOT IN (1,5,55,9,22,23,63,3) 
                                            AND tu.Status = 1 
                                            AND tu.OtherEmp = 0";

                                        if (!empty($_POST['UserId'])) {
                                            $UserId = $_POST['UserId'];
                                            if ($UserId !== 'all') {
                                                $sql .= " AND tu.UnderFrId = '$UserId'";
                                            }
                                        }

                                        if (!empty($_POST['ZoneId'])) {
                                            $ZoneId = $_POST['ZoneId'];
                                            if ($ZoneId !== 'all') {
                                                $sql .= " AND tu.ZoneId = '$ZoneId'";
                                            }
                                        }

                                        $sql .= " ORDER BY tu.CreatedDate DESC";
                                        $res = $conn->query($sql);

                                        while ($row = $res->fetch_assoc()) {
                                            $cnt = 0;$appcnt = 0;

                                            include 'inc-pending-expenses.php';
                                            

                                            if ($cnt > 0) { ?>
                                                <tr>
                                                    <td><?php echo $row['CustomerId']; ?></td>
                                                    <td><?php echo $row['Fname'] . " " . $row['Lname']; ?></td>
                                                    <td><?php echo $row['UserByEmpName']; ?></td>
                                                    <td><a href="view-employee-pending-expenses.php?id=<?php echo $row['id']; ?>" target="_new"><?php echo $cnt; ?></a></td>
                                                   
                                                    <td><?php echo $row['ZoneName']; ?></td>
                                                    <td><?php echo $row['Phone']; ?></td>
                                                    <td><?php echo $row['UnderFrName']; ?></td>
                                                    <td><?php echo $row['Name']; ?></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <?php include_once 'footer.php'; ?>

                </div>

            </div>

        </div>

        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>


    <?php include_once 'footer_script.php'; ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5'
                ]
            });
        });
    </script>
</body>

</html>