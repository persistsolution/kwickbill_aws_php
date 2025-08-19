<?php
session_start();
include_once '../config.php';
include('../../libs/phpqrcode/qrlib.php');

if($_POST['action'] == 'savePrint'){ 
    $CellNo = addslashes(trim($_POST['CellNo']));
    $CustId2 = $_POST['CustId'];
    $CustName = addslashes(trim($_POST['CustName']));
    $AccCode = addslashes(trim($_POST['AccCode']));
    $PayType = addslashes(trim($_POST['PayType']));
    $Featured = 0;
    $Print = addslashes(trim($_POST['Print']));
    $FrId = $_POST['FrId'];
    $value = $_POST['value'];
    foreach ($_SESSION["cart_item"] as $product){
      $total_price3 += ($product["price"]*$product["quantity"]);
    }
    $InvoiceDate = date('Y-m-d');
    $InvoiceDate2 = date('d/m/Y');
    $CreatedTime = date('H:i:s');
    $SubTotal = $total_price3;
    $Discount = 0;
   

    if($_POST['PackageId'] == 0){
        $PkgId = addslashes(trim($_POST['PkgId']));
    }
    else{
        $PkgId = addslashes(trim($_POST['PackageId'])); 
    }
              
     $PkgAmt = addslashes(trim($_POST['PkgAmt']));
    $PkgDiscount = addslashes(trim($_POST['PkgDiscount']));
    $PkgValidity = addslashes(trim($_POST['PkgValidity']));
    $PrimeDiscount = addslashes(trim($_POST['PrimeDiscount']));
    $NetAmount = $total_price3-0;
    $Advance = $total_price3-0;

    $Balance = 0;
    $tempDir = '../../barcodes/';
    $sql8 = "SELECT MAX(SrNo) AS MaxId FROM tbl_customer_invoice WHERE Roll=2";
    $row8 = getRecord($sql8);
    $MaxId = $row8['MaxId'] + 1;
    $InvoiceNo = "00" . $MaxId;
    
    $sql81 = "SELECT MAX(OrderNo) AS MaxId FROM tbl_customer_invoice WHERE Roll=2 AND InvoiceDate='$InvoiceDate'";
    $row81 = getRecord($sql81);
    $MaxId22 = $row81['MaxId'] + 1;
    $OrderNo = $MaxId22;
    
    if($CustId2==0){

      if($CustName!='' && $CellNo!=''){
        $sql = "INSERT INTO tbl_users SET Fname='$CustName',Phone='$CellNo',EmailId='$EmailId',Address='$Address',UnderFr='0',CreatedBy='$FrId',CreatedDate='$CreatedDate',Roll=55,Status=1";
        $conn->query($sql);
        $CustId = mysqli_insert_id($conn);

        $filename = $CustId.".png";
        $codeContents = $CellNo;
        QRcode::png($codeContents, $tempDir.''.$filename, QR_ECLEVEL_L, 5);
        $Barcode = $filename;
        $CustomerId = "C".$CustId;
        $sql3 = "UPDATE tbl_users SET Barcode='$Barcode',CustomerId='$CustomerId' WHERE id='$CustId'";
        $conn->query($sql3);  
         if($PkgId!=0){
                            $sql3 = "UPDATE tbl_users SET PkgId='$PkgId',PkgAmt='$PkgAmt',PkgDiscount='$PkgDiscount',PkgDate='$CreatedDate',PkgValidity='$PkgValidity',Prime=1 WHERE id='$CustId'";
                        $conn->query($sql3);
                        }
    }
    
    else{
                            $CustId = 0;
                        }
    
    
    }
    else{
          $CustId = $_POST['CustId'];
          if($PkgId!=0){
                            $sql3 = "UPDATE tbl_users SET PkgId='$PkgId',PkgAmt='$PkgAmt',PkgDiscount='$PkgDiscount',PkgDate='$CreatedDate',PkgValidity='$PkgValidity',Prime=1 WHERE id='$CustId'";
                        $conn->query($sql3);
                        }
    }
    $sql = "INSERT INTO tbl_customer_invoice SET AccCode='$AccCode',SrNo='$MaxId',CustId='$CustId',CustName='$CustName',
                            CellNo='$CellNo',Address='$Address',EmailId='$EmailId',InvoiceNo='$InvoiceNo',
                            InvoiceDate='$InvoiceDate',PayType='Online',Narration='$Narration',
                            CgstPer='$CgstPer',SgstPer='$SgstPer',
                            IgstPer='$IgstPer',SubTotal='$SubTotal',
                            GstAmt='$GstAmt',CreatedBy='$FrId',CreatedDate='$CreatedDate',
                            ExtraAmount='$ExtraAmount',TotalAmount='$TotalAmount',Discount='$Discount',
                            NetAmount='$NetAmount',Advance='$Advance',Balance='$Balance',
                            ExtraReason='$ExtraReason',ChequeNo='$ChequeNo',ChqDate='$ChqDate',
                            BankName='$BankName',UpiNo='$UpiNo',PayType2='$PayType2',
                            ChequeNo2='$ChequeNo2',ChqDate2='$ChqDate2',
                            BankName2='$BankName2',UpiNo2='$UpiNo2',Amount1='$Amount1',Amount2='$Amount2',Status='0',Roll=2,PkgId='$PkgId',PkgAmt='$PkgAmt',PkgDiscount='$PkgDiscount',PkgDate='$CreatedDate',PkgValidity='$PkgValidity',PrimeDiscount='$PrimeDiscount',OrderNo='$OrderNo',CreatedTime='$CreatedTime',FrId='$FrId',ShopFrom='Barcode'";
                    $conn->query($sql);
                    $SellId = mysqli_insert_id($conn);
                    $filename = $SellId . ".png";
                    $randno = rand(1000,9999);
                    $BillNo = $randno."".$SellId;
                    $sql3 = "UPDATE tbl_customer_invoice SET Barcode='$Barcode',BillNo='$BillNo' WHERE id='$SellId'";
                    $conn->query($sql3);


                    $sql2 = "SELECT MAX(SrNo) as maxid FROM tbl_general_ledger WHERE Type='PR'";
                    $row2 = getRecord($sql2);
                    if ($row2['maxid'] == '') {
                        $SrNo = 1;
                        $Code = "PR" . $SrNo;
                    } else {
                        $SrNo = $row2['maxid'] + 1;
                        $Code = "PR" . $SrNo;
                    }

                    $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='0',Code='OB',UserId='$CustId',
                            AccCode='$AccCode',
                            AccountName='$CustName',
                            InvoiceNo='$InvoiceNo',Amount='$NetAmount',CrDr='dr',Roll=5,
                            Type='OB',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                            PayMode='$PayType',Narration='Total Invoice Amount',
                            SellId='$SellId',Flag='Customer-Invoice',AccRoll='Customer',Main=1,CreatedBy='$FrId'";
                    $conn->query($sql4);
                    if ($Advance > 0) {
                        if($PayType == 'Borrowing'){
                            $BorrowFlag = 1;
                        }
                        else{
                            $BorrowFlag = 0;
                        }
                        $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='$SrNo',Code='$Code',UserId='$CustId',
                            AccCode='$AccCode',
                            AccountName='$CustName',
                            InvoiceNo='$InvoiceNo',Amount='$Advance',CrDr='cr',Roll=5,
                            Type='PR',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                            PayMode='$PayType',Narration='$Narration',
                            SellId='$SellId',Flag='Customer-Invoice',AccRoll='Customer',Main=1,CreatedBy='$FrId',BorrowFlag='$BorrowFlag'";
                        $conn->query($sql4);
                        $PostId = mysqli_insert_id($conn);

                        $sql4 = "INSERT INTO tbl_general_ledger SET SrNo='$SrNo',Code='$Code',UserId='0',
                            AccCode='AC1',
                            AccountName='Comapny Account',
                            InvoiceNo='$InvoiceNo',Amount='$Advance',CrDr='dr',Roll=5,
                            Type='PR',CreatedDate='$CreatedDate',PaymentDate='$InvoiceDate',
                            PayMode='$PayType',Narration='$Narration',
                            SellId='$SellId',Flag='Customer-Invoice',AccRoll='Company',PostId='$PostId',Main=1,CreatedBy='$user_id',BorrowFlag='$BorrowFlag'";
                        $conn->query($sql4);
                    }

 foreach ($_SESSION["cart_item"] as $product){
                        
                     $ProdCode = $product["code"];
                     $sql = "SELECT * FROM tbl_cust_products WHERE code='$ProdCode'";
                     $row = getRecord($sql);
                     $CatId = $row['CatId'];
                     $ActPrice =  $product["price"];
                     $ProdPrice = $row['ProdPrice'];
                     $Qty = $product["quantity"];
                     $TotalPrice = $ProdPrice*$Qty;
                    //  $CgstAmt = $TotalPrice*($row['CgstPer']/100);
                    //  $SgstAmt = $TotalPrice*($row['SgstPer']/100);
                    //  $IgstAmt = $TotalPrice*($row['IgstPer']/100);
                     $CgstAmt = $row['CgstAmt']*$Qty;
                     $SgstAmt = $row['SgstAmt']*$Qty;
                     $IgstAmt = $row['IgstAmt']*$Qty;
                     $CgstPer = $row['CgstPer'];
                     $SgstPer = $row['SgstPer'];
                     $IgstPer = $row['IgstPer'];
                     $GstAmt = $CgstAmt+$SgstAmt+$IgstAmt;
                     $Total = $GstAmt+$TotalPrice;
                     $ProdId = $row['id'];
                     
                     $sql22 = "INSERT INTO tbl_customer_invoice_details SET InvId='$SellId',ProdId='$ProdId',Qty='$Qty',Price='$ProdPrice',CreatedDate='$InvoiceDate',CgstPer='$CgstPer',SgstPer='$SgstPer',IgstPer='$IgstPer',GstAmt='$GstAmt',Total='$Total',CustProd=1,CgstAmt='$CgstAmt',SgstAmt='$SgstAmt',IgstAmt='$IgstAmt',ActPrice='$ActPrice',CatId='$CatId'";
                    $conn->query($sql22);
                    $InvDetId = mysqli_insert_id($conn);
                    $Narration = "Stock Used Against Invoice No : ".$InvoiceNo;
                    $qx = "INSERT INTO tbl_cust_prod_stock SET ProdId='$ProdId',Qty='$Qty',CreatedBy='$FrId',StockDate='$InvoiceDate',Narration='$Narration',Status='Dr',UserId='0',CreatedDate='$InvoiceDate',InvId='$SellId'";
  $conn->query($qx);
       }
       unset($_SESSION["cart_item"]);
       
       if($Featured == 1){
        $smstxt = "POS Receipt: https://mahabuddy.com/in/invoice/$BillNo 
Thank you for purchasing with MAHACHAI.(www.mahachai.in) 
Total Amount $NetAmount $InvoiceDate2 $CreatedTime
Your Feedback Matters : https://mahabuddy.com/feedback";
$Phone = $CellNo;
if($Phone!=''){
    $dltentityid = "1501701120000037351";
  $dlttempid = "1707169839028393861";
       //include '../../incsmsapi.php';
}
}
       $sql55 = "SELECT * FROM tbl_users WHERE id=5";
            $row55 = getRecord($sql55);
            $title = str_replace(" ","#",$row55['ShopName']);
            $Address = str_replace(" ","#",$row55['Address']);
            $Phone = str_replace(" ","#",$row55['Phone']);
            $GstNo = str_replace(" ","#",$row55['GstNo']);
            $terms_condition = str_replace(" ","#",$row55['terms_condition']);
            $bottom_title = str_replace(" ","#",$row55['bottom_title']);
            
            $sql = "SELECT * FROM tbl_customer_invoice WHERE id='$SellId'";
    $row = getRecord($sql);
    $CustName = str_replace(" ","#",$row['CustName']);
        $emparray = array();
            $sql12 = "SELECT * FROM tbl_customer_invoice_details WHERE InvId='".$row['id']."'";
            $row12 = getList($sql12);
            foreach($row12 as $result12){
                $sql13 = "SELECT ProductName FROM  tbl_cust_products WHERE id='".$result12['ProdId']."'";
                $row13 = getRecord($sql13);
                $TotQty+=$result12['Qty'];
                $TotPrice+=$result12['Price'];
                $TotGst+=number_format((float)$result12['GstAmt'], 2, '.', '');
                //$TotGst+=round($result12['GstAmt'],2);
                $Product_name2 = str_replace(" ","#",$row13['ProductName']);
                $Product_name = substr($Product_name2,0,16);
                 $emparray[] = array('item'=>$Product_name,'rate'=>$result12['Price'],'quantity'=>$result12['Qty'],'amount'=>$result12['Total']);
            }
    $dados2 =  json_encode(array('productList' => $emparray));
    $date = date("d/m/Y", strtotime(str_replace('-', '/',$row['InvoiceDate'])));
    $dados1 = json_encode(array('title'=>$title,'address'=>$Address,'mobile'=>$Phone,'gstin'=>$GstNo,'customer_name'=>$CustName,'customer_phone_no'=>$row['CellNo'],'receipt_title'=>'Retail#Receipt','invoice_no'=>$row['InvoiceNo'],'date'=>$date,'sub_total'=>$row['SubTotal'],'discount'=>$row['Discount'],'service_charge'=>0,'gst'=>$TotGst,'total_bill'=>$row['NetAmount'],'total_payable'=>$row['NetAmount'],'terms_condition'=>$terms_condition,'bottom_title'=>$bottom_title)); 
    $invoice_data =  json_encode(array_merge(json_decode($dados1, true),json_decode($dados2, true)));
     if($Print == 1){
    echo $invoice_data;
     }
     else{
         echo json_encode(array('oid'=>$SellId,'amount'=>$NetAmount,'frid'=>$FrId));
     }
   //echo 1;    
}


?>