<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$tail = $_POST['tail'];
// 0 == Add new (Expenditute), 1 == Edit, 2 == Delete, 3 == Set Memo No., 4 == ........, 5 == Add New (Income)

// if ($tail != 5) {
//     $id = $_POST['id'];
//     $dept = $_POST['dept'];
//     $date = $_POST['date'];
//     $cate = $_POST['cate'];
//     $descrip = $_POST['descrip'];
//     $amt = $_POST['amt'];
// }


$sccodes = $sccode * 10;


$month = $_POST['month'];
$year = $_POST['year'];
$ref = $_POST['ref'];
$chq = $_POST['chq'];
$acc = $_POST['acc'];
$amt = $_POST['amt'];
$partid = $_POST['partid'];
$slot = $_POST['slot'];
$refdate = $_POST['refdate'];

$sql0 = "SELECT * FROM `financesetup` where (sccode = 0 || sccode = '$sccode') and id='$partid';";
// echo $sql0;
$result0rtdz = $conn->query($sql0);
if ($result0rtdz->num_rows > 0) {
    while ($row0 = $result0rtdz->fetch_assoc()) {
        $pe = $row0["particulareng"];
        $pb = $row0["particularben"];
    }
} else {
    $pe = $pb = '';
}

// check the string 'govt' is in the particular name
if (str_contains(strtolower($pe), 'govt')) {
    $govt_chq = 1;
} else {
    $govt_chq = 0;
}





// Get Total Amount
$mottaka = 0;
$sql0 = "SELECT * FROM `cashbook` where (sccode = '$sccodes' || sccode = '$sccode') and memono>0 and ongoing=1 and module='VOUCHER' order by memono;";
// echo $sql0;
$result0rtd = $conn->query($sql0);
if ($result0rtd->num_rows > 0) {
    while ($row0 = $result0rtd->fetch_assoc()) {
        $amount = $row0["amount"];
        $mottaka += $amount;
    }
}
// echo $amt . '/' . $mottaka;

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
    $query401 = "UPDATE refbook set slot='$slot', partid='$partid', module='Payroll', dbtable='salarysummery' where sccode = '$sccode' and refno='$ref'";
    // echo $query401;
    $conn->query($query401);

} else {
    $query401 = "INSERT INTO refbook (id, sccode, slot, sessionyear, refno, date, year, month, partid, title, descrip, module, dbtable, sqltext, entryby, entrytime) 
                VALUES (NULL, '$sccode', '$slot', '$sy', '$ref', '$td', '$year', '$month', '$partid', '$reftitle', '$refdescrip', 'Payroll', 'salarysummery', '$sql', '$usr', '$cur') ;";
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


if ($govt_chq == 0) {
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

}

$kotkot = $_POST["kotkot"];
$salmonth = $_POST["salmonth"];
$salyear = $_POST["salyear"];
$sql0 = "SELECT * FROM salarysummery where sccode='$sccode' and chequeno='$chq' and amount = '$amt' and salarymonth='$salmonth' and salaryyear='$salyear' ";
// echo $sql0;
$result01xgg2 = $conn->query($sql0);
if ($result01xgg2->num_rows == 1) {
    while ($row0 = $result01xgg2->fetch_assoc()) {
        $id = $row0["id"];
        //update
        $query404 = "UPDATE salarysummery SET sessionyear = '$sy',  month = '$month', year = '$year', refno = '$ref', slot = '$slot', category = '$kotkot', partid = '$partid', particulareng = '$pe', particularben = '$pb', amount = '$amt', chequeno = '$chq', accno = '$acc' where sccode='$sccode' and id='$id';";
        // echo $query404;
        $conn->query($query404);
    }
} else {
    $query404 = "INSERT INTO salarysummery(id, sessionyear, sccode, month, year, refno, slot, category, partid, particulareng, particularben, amount, chequeno, date, accid, accno, issuedate, issueby, status, salarymonth, salaryyear)
                    VALUES (NULL, '$sy', '$sccode', '$month', '$year', '$ref', '$slot', '$kotkot', '$partid','$pe','$pb', '$amt', '$chq', '$td', NULL, '$acc', '$cur', '$usr', 1, '$salmonth', '$salyear' );";
    // echo $query404;
    $conn->query($query404);
}














$pex = $pe . ' ' . $refdescrip;


if ($partid != 5) {
    $sql0 = "SELECT * FROM cashbook where sccode='$sccode' and refno='$ref' and type='Expenditure';  ";
    // echo $sql0;
    $result01xgg4y = $conn->query($sql0);
    if ($result01xgg4y->num_rows == 1) {
        while ($row0 = $result01xgg4y->fetch_assoc()) {
            $idj = $row0["id"];
            $datex = $row0["date"];
        }
    }
    $query405x = "DELETE FROM cashbook where id='$idj';";
    $conn->query($query405x);

    $query405rx = "INSERT INTO cashbook(id, sessionyear, sccode, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, ongoing, module, status)
    VALUES (NULL, '$sy', '$sccode', '$month', '$year', '$slot', '$refdate', 'Expenditure', '$ref', '$partid', '$pe', 0, '$pex', 0, '$amt', '$amt', '$usr', '$cur', 0, 'BANK', 1);";
    $conn->query($query405rx);
} else {


    // withdrawals entry
    $sql0 = "SELECT * FROM cashbook where sccode='$sccode' and refno='$ref' and category = 'withdrawal' and type='income';  ";
    // echo $sql0;
    $result01xgg3 = $conn->query($sql0);
    if ($result01xgg3->num_rows == 1) {
        while ($row0 = $result01xgg3->fetch_assoc()) {
            $id = $row0["id"];
            //update
            $query405 = "UPDATE cashbook SET month = '$month', year = '$year', refno = '$ref', slots = '$slot',  partid = '2', particulars = '$pex', income='$amt', expenditure='0', amount = '$amt', module = 'BANK', status = '1', date='$refdate' where sccode='$sccode' and id='$id';";
            // echo $query405;
            $conn->query($query405);
        }
    } else {
        $query405 = "INSERT INTO cashbook(id, sessionyear, sccode, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, ongoing, module, status)
                    VALUES (NULL, '$sy', '$sccode', '$month', '$year', '$slot', '$refdate', 'Expenditure', '$ref', '$partid', '$pe', 0, '$pex', 0, '$amt', '$amt', '$usr', '$cur', 0, 'BANK', 1);";
        // echo $query405;
        $conn->query($query405);
    }


    // expenses entry
    $sql0 = "SELECT * FROM cashbook where sccode='$sccode' and refno='$ref' and partid = '$partid' and type='Expenditure';  ";
    $sql0 = "SELECT * FROM cashbook where sccode='$sccode' and refno='$ref' and type='Expenditure';  ";
    // echo $sql0;
    $result01xgg4 = $conn->query($sql0);
    if ($result01xgg4->num_rows == 1) {
        while ($row0 = $result01xgg4->fetch_assoc()) {
            $id = $row0["id"];
            //update
            // echo $id;
            $query406 = "UPDATE cashbook SET month = '$month', year = '$year', refno = '$ref', slots = '$slot', category = '$pe', partid = '$partid', particulars = '$pex', income='0', expenditure='$amt', amount = '$amt', module = 'BANK', status = '1', date='$refdate' where sccode='$sccode' and id='$id';";
            // echo $query406;
            $conn->query($query406);
        }
    } else {
        $query406 = "INSERT INTO cashbook(id, sessionyear, sccode, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, ongoing, module, status)
                    VALUES (NULL, '$sy', '$sccode', '$month', '$year', '$slot', '$refdate', 'Expenditure', '$ref', '$partid', '$pe', 0, '$pex',  0, '$amt', '$amt', 'System-AUTO', '$cur', 0, 'BANK', 1);";
        // echo $query406;
        $conn->query($query406);
    }






}


if ($partid == 6) {
    // expenses entry
    $sql0 = "SELECT * FROM cashbook where sccode='$sccode' and refno='$ref' and type='Income';  ";
    // echo $sql0;
    $result01xgg4 = $conn->query($sql0);
    if ($result01xgg4->num_rows == 1) {
        while ($row0 = $result01xgg4->fetch_assoc()) {
            $id = $row0["id"];
            //update
            // echo $id;
            $query406 = "UPDATE cashbook SET month = '$month', year = '$year', refno = '$ref', slots = '$slot', category = '$pe', partid = '$partid', particulars = '$pex', income='$amt', expenditure='0', amount = '$amt', module = 'BANK', status = '1', date='$refdate' where sccode='$sccode' and id='$id';";
            $conn->query($query406);
        }
    } else {
        $query406 = "INSERT INTO cashbook(id, sessionyear, sccode, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, ongoing, module, status)
                VALUES (NULL, '$sy', '$sccode', '$month', '$year', '$slot', '$refdate', 'Income', '$ref', '$partid', '$pe', 0, '$pex',  '$amt', 0, '$amt', 'System-AUTO', '$cur', 0, 'BANK', 1);";
        // echo $query406;
        $conn->query($query406);
    }
}


if ($partid == 6) {
    $fff = 'refnogovt';
} else if ($partid == 8) {
    $fff = 'refnosch';
} else if ($partid == 9) {
    $fff = 'refnopf';
}
$query414 = "UPDATE salarydetails SET $fff = '$ref'  where sccode='$sccode' and month='$month' and year= '$year' and sccode='$sccode' and slots='$slot';";
echo $query414;
$conn->query($query414);

echo '<i class="mdi mdi-check-circle mdi-24px text-success"></i>';