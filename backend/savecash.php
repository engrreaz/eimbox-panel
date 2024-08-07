<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$tail = $_POST['tail'];
// 0 == Add new (Expenditute), 1 == Edit, 2 == Delete, 3 == Set Memo No., 4 == ........, 5 == Add New (Income)

if ($tail != 5) {
    $id = $_POST['id'];
    $dept = $_POST['dept'];
    $date = $_POST['date'];
    $cate = $_POST['cate'];
    $descrip = $_POST['descrip'];
    $amt = $_POST['amt'];
}


$sccodes = $sccode * 10;

if ($tail == 0) {
    $query331 = "INSERT INTO cashbook (id, sccode, sessionyear, slots, date, type, refno, partid, category, particulars, income, expenditure, amount, entryby, entrytime, status , memono , module) 
    values (NULL, '$sccodes', '$sy', '$dept', '$date', 'Expenditure', '0', '$cate', '', '$descrip', '0', '$amt', '$amt',  '$usr', '$cur', '0', '0' , 'VOUCHER' );";
    $conn->query($query331);

    // echo $query331;


} else if ($tail == 1) {
    $mmo = $_POST['mmo'];
    $query331 = "UPDATE cashbook set slots = '$dept', date = '$date', memono='$mmo', partid = '$cate', particulars = '$descrip', expenditure = '$amt', amount = '$amt' where id = '$id';";
    $conn->query($query331);
} else if ($tail == 2) {
    $query331 = "DELETE from cashbook  where id = '$id';";
    $conn->query($query331);
} else if ($tail == 3) {



    $sql0 = "SELECT * FROM `cashbook` where (sccode = '$sccode' || sccode = '$sccodes') order by memono desc LIMIT 1;";
    $result0rt = $conn->query($sql0);
    if ($result0rt->num_rows > 0) {
        while ($row0 = $result0rt->fetch_assoc()) {
            $memono = $row0["memono"] + 1;
        }
    }

    $query331 = "UPDATE cashbook set memono='$memono'  where id = '$id';";
    $conn->query($query331);

}

// else if ($tail == 0) {
//     $sccodes = $sccode * 10;
//     $query331 = "INSERT INTO cashbook (id, sccode, sessionyear, slots, date, type, refno, partid, category, particulars, income, expenditure, amount, entryby, entrytime, status , memono ) 
//     values (NULL, '$sccodes', '$sy', '$dept', '$date', 'Income', '0', '$cate', '', '$descrip', '0', '$amt', '$amt',  '$usr', '$cur', '0', '0' );";
//     $conn->query($query331);

//     // echo $query331;
// } 
else if ($tail == 5) {

    $month = $_POST['month'];
    $year = $_POST['year'];
    $ref = $_POST['ref'];
    $chq = $_POST['chq'];
    $acc = $_POST['acc'];
    $amt = $_POST['amt'];
    $partid = $_POST['partid'];
    $slot = $_POST['slot'];

    $sql0 = "SELECT * FROM `financesetup` where (sccode = 0 || sccode = '$sccode') and id='$partid';";
    // echo $sql0;
    $result0rtdz = $conn->query($sql0);
    if ($result0rtdz->num_rows > 0) {
        while ($row0 = $result0rtdz->fetch_assoc()) {
            $pe = $row0["particulareng"];
            $pb = $row0["particularben"];
        }
    }

    // Get Total Amount
    $mottaka = 0;
    $sql0 = "SELECT * FROM `cashbook` where (sccode = '$sccodes' || sccode = '$sccode') and slots='$slot' and memono>0 and ongoing=1 and module='VOUCHER' order by memono;";
    // echo $sql0;
    $result0rtd = $conn->query($sql0);
    if ($result0rtd->num_rows > 0) {
        while ($row0 = $result0rtd->fetch_assoc()) {
            $amount = $row0["amount"];
            $mottaka += $amount;
        }
    }
    // echo $amt . '/' . $mottaka;

    if ($amt - $mottaka == 0) {
        // echo 'yes';
        $reftitle = $_POST['title'];
        $refdescrip = $_POST['descrip'];
        $sql = '-';// 'SELECT * from cashbook where refno="$ref" order by memono, date;'; // $_POST['title']
        ///////////////////////////////////////////

        $sql0 = "SELECT * FROM `refbook` where sccode = '$sccode' and refno='$ref';";
        // echo $sql0;
        $result0rtdv1 = $conn->query($sql0);
        if ($result0rtdv1->num_rows > 0) {
            //update
            $query401 = "UPDATE refbook set slot='$slot', partid='$partid', module='Expenditure' where sccode = '$sccode' and refno='$ref'";
            // echo $query401;
            $conn->query($query401);

        } else {
            $query401 = "INSERT INTO refbook (id, sccode, slot, sessionyear, refno, date, year, month, partid, title, descrip, module, dbtable, sqltext, entryby, entrytime) 
                VALUES (NULL, '$sccode', '$slot', '$sy', '$ref', '$td', '$year', '$month', '$partid', '$reftitle', '$refdescrip', 'Expenditure', 'cashbook', '$sql', '$usr', '$cur') ;";
            // echo $query401;
            $conn->query($query401);
        }






        $sql0 = "SELECT * FROM banktrans where accno='$acc' and sccode='$sccode' and date <= '$td' order by verified desc, date desc, entrytime desc limit 1 ";
        $result01xgg = $conn->query($sql0);
        if ($result01xgg->num_rows > 0) {
            while ($row0 = $result01xgg->fetch_assoc()) {
                $accno = $row0["accno"];
                $balance = $row0["balance"];
            }
        } else {
            $accno = 0;
            $balance = 0;
        }
        $bala = $balance - $amt;

        // FINDING CHEQUE NUMBER EXISTS OR NOT......
        $sql0 = "SELECT * FROM banktrans where accno='$acc' and sccode='$sccode' and chqno = '$chq' and amount='$amt' order by entrytime desc limit 1 ";
        // echo $sql0;
        $result01xgg1 = $conn->query($sql0);
        if ($result01xgg1->num_rows > 0) {
            while ($row0 = $result01xgg1->fetch_assoc()) {
                $id = $row0["id"];

                $query403 = "UPDATE banktrans SET transtype = 'Withdrawal', partid = '$partid', particulareng = '$pe', particularben = '$pb', refno = '$ref' where accno='$acc' and sccode='$sccode' and chqno = '$chq' and id='$id';";
                // echo $query403;
                $conn->query($query403);
            }
        } else {
            $query403 = "INSERT INTO banktrans(id, sccode, accid, accno, date, transopening, transtype, partid, particulareng, particularben, chqno, amount, balance, refno, entryby, entrytime, verified, verifyby, verifytime)
            VALUES (NULL,  '$sccode', NULL, '$acc', '$td', '$balance', 'Withdrawal', '$partid', '$pe','$pb', '$chq', '$amt', '$bala', '$ref', '$usr', '$cur', '0', NULL, NULL );";
            // echo $query403;
            $conn->query($query403);
        }


        $sql0 = "SELECT * FROM salarysummery where sccode='$sccode' and category='Expenditure' and amount = '$amt' ";
        $result01xgg2 = $conn->query($sql0);
        if ($result01xgg2->num_rows == 1) {
            while ($row0 = $result01xgg2->fetch_assoc()) {
                $id = $row0["id"];
                //update
                $query404 = "UPDATE salarysummery SET sessionyear = '$sy',  month = '$month', year = '$year', refno = '$ref', slot = '$slot', category = 'Expenditure', partid = '$partid', particulareng = '$pe', particularben = '$pb', amount = '$amt', chequeno = '$chq', accno = '$acc' where sccode='$sccode' and id='$id';";
                // echo $query404;
                $conn->query($query404);
            }
        } else {
            $query404 = "INSERT INTO salarysummery(id, sessionyear, sccode, month, year, refno, slot, category, partid, particulareng, particularben, amount, chequeno, date, accid, accno, issuedate, issueby, status)
                    VALUES (NULL, '$sy', '$sccode', '$month', '$year', '$ref', '$slot', 'Expenditure', '$partid','$pe','$pb', '$amt', '$chq', '$td', NULL, '$acc', '$cur', '$usr', 1 );";
            // echo $query404;
            $conn->query($query404);
        }


      



        $query402 = "UPDATE cashbook set sessionyear='$sy', month='$month', year='$year', sccode='$sccode',  refno='$ref', status='1', ongoing = 0  where (sccode = '$sccodes' or sccode = '$sccode') and memono > 0 and module='VOUCHER' and ongoing = 1 and slots='$slot';";
        // echo $query402;
        $conn->query($query402);
        // $query402 = "UPDATE cashbook set month= NULL, year=NULL, sccode='$sccodes', refno=NULL, status='0'   where sccode = '$sccodes' and memono > 0 and refno='$ref' ;";
        // echo $query402;

    } else {
        echo 'amount mismatch';
    }

    // Ref Book-------------------------------------------------------------
    // update month, year, refno, status -------------------------------------------

    // salary summery ref...... 

    // bank transaction amount entry................---------------------------------

} else if ($tail == 6 || $tail == 7) {
    $ongoing = $tail - 6;
    if ($ongoing == 0) {
        $mod = '';
    } else {
        $mod = 'VOUCHER';
    }
    $query402 = "UPDATE cashbook set ongoing = '$ongoing', module='$mod'  where sccode = '$sccode' and id='$id';";

    $conn->query($query402);
}

if ($tail == 6 || $tail == 7) {
    echo '<i class="mdi mdi-check mdi-18px text-primary"></i>';
} else {
    echo 'Update Successfully ';
}
