<?php 
$sql3 = "SELECT te.* FROM tbl_expense_request te 
                  WHERE te.ManagerStatus='2' AND te.AdminStatus='0' AND te.UserId!=0 AND te.ExpCatId!=3 AND te.UserId!='".$row['id']."' ORDER BY te.ExpenseDate DESC";
               // echo $sql3;
                $row3 = getList($sql3);
                foreach($row3 as $result){
                    $UserId = $result['UserId'];
                    $sql4 = "SELECT UnderByUser FROM tbl_users WHERE id='$UserId'";
                    $row4 = getRecord($sql4);
                    $UnderByUser = $row4['UnderByUser'];
                    if($UnderByUser == $row['id']){
                        $rejcnt++;
                    }
                }
                
                $sql31 = "SELECT te.* FROM tbl_expense_request te 
                  WHERE te.AdminStatus=2 AND te.ManagerStatus='1' AND te.UserId!=0 AND te.ExpCatId!=3 AND te.Amount<=5000 AND te.UserId!='".$row['id']."' ORDER BY te.ExpenseDate DESC";
               // echo $sql3;
                $row31 = getList($sql31);
                foreach($row31 as $result31){
                    $UserId = $result31['UserId'];
                    $sql41 = "SELECT UnderByUser FROM tbl_users WHERE id='$UserId'";
                    $row41 = getRecord($sql41);
                    $UnderByUser41 = $row41['UnderByUser'];

                    $sql42 = "SELECT UnderByUser FROM tbl_users WHERE id='$UnderByUser41'";
                    $row42 = getRecord($sql42);
                    $UnderByUser42 = $row42['UnderByUser'];
                    if($UnderByUser42 == $row['id']){
                        $rejcnt++;
                    }
                }
                ?>