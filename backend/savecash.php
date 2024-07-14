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

    $query331 = "UPDATE cashbook set slots = '$dept', date = '$date', partid = '$cate', particulars = '$descrip', expenditure = '$amt', amount = '$amt' where id = '$id';";
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

    $mottaka = 0;
    $sql0 = "SELECT * FROM `cashbook` where sccode = '$sccodes' and memono>0 order by memono;";
    $result0rtd = $conn->query($sql0);
    if ($result0rtd->num_rows > 0) {
        while ($row0 = $result0rtd->fetch_assoc()) {
            $amount = $row0["amount"];
            $mottaka += $amount;
        }
    }
    if ($amt - $mottaka == 0) {
        $reftitle =  $_POST['title'];
        $refdescrip =   $_POST['descrip'];
        $sql = '-';// 'SELECT * from cashbook where refno="$ref" order by memono, date;'; // $_POST['title']
        $slot = 'School';
        ///////////////////////////////////////////

        $query401 = "INSERT INTO refbook (id, sccode, sessionyear, refno, date, year, month, title, descrip, module, dbtable, sqltext, entryby, entrytime) 
                VALUES (NULL, '$sccode', '$sy', '$ref', '$td', '$year', '$month', '$reftitle', '$refdescrip', 'Expenditure', 'cashbook', '$sql', '$usr', '$cur') ;";
        // echo $query401;
        $conn->query($query401);


        $query402 = "UPDATE cashbook set month='$month', year='$year', sccode='$sccode', refno='$ref', status='1'   where sccode = '$sccodes' and memono > 0 ;";
        // echo $query402;
        $conn->query($query402);
        $query402 = "UPDATE cashbook set month= NULL, year=NULL, sccode='$sccodes', refno=NULL, status='0'   where sccode = '$sccodes' and memono > 0 and refno='$ref' ;";
        // echo $query402;

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


        $query403 = "INSERT INTO banktrans(id, sccode, accid, accno, date, transopening, transtype, amount, balance, entryby, entrytime, verified, chqno)
                    VALUES (NULL,  '$sccode', NULL, '$acc', '$td', '$balance', 'Withdrawal', '$amt', '$bala', '$usr', '$cur', '0', '$chq' );";
        // echo $query403;
        $conn->query($query403);

        $query404 = "INSERT INTO salarysummery(id, sessionyear, sccode, month, year, refno, slot, category, amount, chequeno, date, accid, accno, issuedate, issueby, status)
                    VALUES (NULL, '$sy', '$sccode', '$month', '$year', '$ref', '$slot', 'Expenditure', '$amt', '$chq', '$td', NULL, '$acc', '$cur', '$usr', 1 );";
        // echo $query404;
        $conn->query($query404);





    }

    // Ref Book-------------------------------------------------------------
    // update month, year, refno, status -------------------------------------------

    // salary summery ref...... 

    // bank transaction amount entry................---------------------------------

}


echo 'Update Successfully ';