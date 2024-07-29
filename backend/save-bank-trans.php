<?php
date_default_timezone_set('Asia/Dhaka');
include 'inc2.php';

$tail = $_POST['ont'];
$accno = $_POST['accno'];

$rrf = $sccode . date('YmdHis');

if ($tail == 0) {
    $id = $_POST['id'];

    $date = $_POST['date'];
    $type = $_POST['type'];
    $chqno = $_POST['chq'];
    $amount = $_POST['amt'];

    if ($chqno == '') {
        if ($type == 'Deposit') {
            $sql0 = "SELECT * FROM banktrans where accno = '$accno' and sccode='$sccode' and transtype = 'Deposit' order by date desc, id desc limit 1 ";
            $result01xgg = $conn->query($sql0);
            if ($result01xgg->num_rows > 0) {
                while ($row0 = $result01xgg->fetch_assoc()) {
                    $chq = $row0["chqno"];
                }
            } else {
                $chq = ($sccode % 10000) * 10000;
            }

            if ($chq == NULL || $chq == '' || $chq == 0) {
                $chq = ($sccode % 10000) * 10000;
            }
            $chq = $chq * 1;
            $chq = $chq + 1;
        } else if ($type == 'Interest' || $type == 'Deduction') {
            $chqno = 'N/A';
        } else {
            $chqno = '-';
        }
    }

    $sql0 = "SELECT * FROM banktrans where accno='$accno' and sccode='$sccode'  order by entrytime desc limit 1 ";
    $result01xg = $conn->query($sql0);
    if ($result01xg->num_rows > 0) {
        while ($row0 = $result01xg->fetch_assoc()) {
            $accno = $row0["accno"];
            $balance = $row0["balance"];
        }
    } else {
        $accno = 0;
        $balance = 0;
    }

    if ($type == 'Deposit' || $type == 'Interest') {
        $bala = $balance + $amount;
    } else {
        $bala = $balance - $amount;
    }


    if ($type == 'Deposit') {
        $partidx = 1;
        $ddx = 'Expenditure';
    } else if ($type == 'Withdrawal' || $type == 'Withdraw') {
        $partidx = 2;
        $ddx = 'Income';
    } else if ($type == 'Deduction') {
        $partidx = 4;
        $ddx = 'Expenditure';
    } else if ($type == 'Interest') {
        $partidx = 3;
        $ddx = 'Income';
    }

    if ($ddx == 'Income') {
        $iii = $amount;
        $eee = 0;
    } else {
        $eee = $amount;
        $iii = 0;
    }

    $query33 = "insert into banktrans(id, sccode, accid, accno, date, transopening, transtype, partid, amount, balance, entryby, entrytime, verified, chqno, refno)
    		VALUES (NULL,  '$sccode', NULL, '$accno', '$date', '$balance', '$type', '$partidx', '$amount', '$bala', '$usr', '$cur', '0', '$chqno', '$rrf' );";
    $conn->query($query33);
    // echo $query33;


    $mx = date('m', strtotime($date));
    $yx = date('Y', strtotime($date));
    $particularx = 'from Bank Transaction';
    $sql0 = "SELECT * FROM bankinfo where accno='$accno' and sccode='$sccode' ";
    $result01xgd = $conn->query($sql0);
    if ($result01xgd->num_rows > 0) {
        while ($row0 = $result01xgd->fetch_assoc()) {
            $slot = $row0["slot"];
        }
    } else {
        $slot = 'School';
    }

    $query37 = "insert into cashbook(id, sccode, sessionyear, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, ongoing, module, status)
    		VALUES (NULL,  '$sccode', '$sy', '$mx', '$yx', '$slot', '$date', '$ddx', '$rrf', '$partidx', 'Cat-NA', 0, 'Part-NA', '$iii', '$eee', '$amount', 'System-Auto', '$cur', '0', 'BANK', '1' );";
    $conn->query($query37);
    // echo $query37;
    // $sql0 = "SELECT classname, sectionname, pr1date, partid, sum(pr1) as mottaka FROM stfinance where sccode='$sccode' and sessionyear='$sy' and pr1> 0 and cashbook1=0 group by classname, sectionname, pr1date, partid";
    // //echo $sql0;
    // $result0 = $conn->query($sql0);
    // if ($result0->num_rows > 0) {
    //     while ($row0 = $result0->fetch_assoc()) {
    //         $ccc = $row0["classname"];
    //         $sss = $row0["sectionname"];
    //         $aaa = $row0["mottaka"];
    //         $ddd = $row0["pr1date"];
    //         $ppp = $row0["partid"];
    //         $de = 'Collection : ' . $ccc . ' (' . $sss . ')';
    //         $jax = "insert into cashbook (id, sessionyear, sccode, date, type, partid, particulars,income, amount, entryby, entrytime, status) 
    //                                     VALUES (NULL, '$sy', '$sccode', '$ddd', 'Income', '$ppp', '$de', '$aaa', '$aaa', 'System-Auto', '$cur', 1 );";
    //         $conn->query($jax);

    //         $cax = "UPDATE stfinance set cashbook1=1 where sccode='$sccode' and sessionyear='$sy' and pr1> 0 and cashbook1=0 and classname='$ccc' and sectionname='$sss' and pr1date='$ddd';";
    //         $conn->query($cax);
    //     }
    // }
} else if ($tail == 1) {
    $id = $_POST['id'];

    $date = $_POST['date'];
    $type = $_POST['type'];
    $chqno = $_POST['chq'];
    $amount = $_POST['amt'];

    if ($chqno == '') {
        if ($type == 'Deposit') {
            $sql0 = "SELECT * FROM banktrans where accno = '$accno' and sccode='$sccode' and transtype = 'Deposit' order by date desc, id desc limit 1 ";
            $result01xgg = $conn->query($sql0);
            if ($result01xgg->num_rows > 0) {
                while ($row0 = $result01xgg->fetch_assoc()) {
                    $chq = $row0["chqno"];
                }
            } else {
                $chq = ($sccode % 10000) * 10000;
            }

            if ($chq == NULL || $chq == '' || $chq == 0) {
                $chq = ($sccode % 10000) * 10000;
            }
            $chq = $chq * 1;
            $chq = $chq + 1;
        } else if ($type == 'Interest' || $type == 'Deduction') {
            $chqno = 'N/A';
        } else {
            $chqno = '-';
        }
    }

    $sql0 = "SELECT * FROM banktrans where accno='$accno' and sccode='$sccode' and date <= '$date' order by verified desc, date desc, entrytime desc limit 1 ";
    $result01xg = $conn->query($sql0);
    if ($result01xg->num_rows > 0) {
        while ($row0 = $result01xg->fetch_assoc()) {
            $accno = $row0["accno"];
            $balance = $row0["balance"];
        }
    } else {
        $accno = 0;
        $balance = 0;
    }

    if ($type == 'Deposit' || $type == 'Interest') {
        $bala = $balance + $amount;
    } else {
        $bala = $balance - $amount;
    }


    $sql0 = "SELECT * FROM banktrans where id='$id' and sccode='$sccode' and accno='$accno';";
    $result01xg1 = $conn->query($sql0);
    if ($result01xg1->num_rows > 0) {
        while ($row0 = $result01xg1->fetch_assoc()) {
            $refref = $row0["refno"];
        }
    }
    if ($refref == '') {
        $refref = $rrf;
    }

    $query33 = "UPDATE banktrans set date='$date', transopening='$balance', refno='$refref', transtype='$type', chqno='$chqno', amount='$amount', balance='$bala', entryby='$usr', entrytime='$cur', verified='0', verifyby=NULL, verifytime=NULL where id='$id' and sccode='$sccode' and accno='$accno';";
    $conn->query($query33);
    // echo $query33;


    $mx = date('m', strtotime($date));
    $yx = date('Y', strtotime($date));
    $particularx = 'from Bank Transaction';
    $sql0 = "SELECT * FROM bankinfo where accno='$accno' and sccode='$sccode' ";
    $result01xgd = $conn->query($sql0);
    if ($result01xgd->num_rows > 0) {
        while ($row0 = $result01xgd->fetch_assoc()) {
            $slot = $row0["slot"];
        }
    } else {
        $slot = 'School';
    }


    if ($type == 'Deposit') {
        $partidx = 1;
        $ddx = 'Expenditure';
    } else if ($type == 'Withdrawal' || $type == 'Withdraw') {
        $partidx = 2;
        $ddx = 'Income';
    } else if ($type == 'Deduction') {
        $partidx = 4;
        $ddx = 'Expenditure';
    } else if ($type == 'Interest') {
        $partidx = 3;
        $ddx = 'Income';
    }

    if ($ddx == 'Income') {
        $iii = $amount;
        $eee = 0;
    } else {
        $eee = $amount;
        $iii = 0;
    }



    $sql0 = "SELECT * FROM cashbook where sccode='$sccode' and refno='$refref';";
    $result01xg2 = $conn->query($sql0);
    if ($result01xg2->num_rows > 0) {
        while ($row0 = $result01xg2->fetch_assoc()) {
            $id = $row0["id"];
            // echo 'update ' . $id;
            $query370 = "update cashbook set  sessionyear='$sy', month='$mx', year='$yx', slots='$slot', type='$ddx', partid='$partidx', income='$iii', expenditure='$eee', amount='$amount' where sccode='$sccode' and refno='$refref' and id='$id';";
            $conn->query($query370);
            // echo $query370;

        }
    } else {
        // echo 'new entry';
        $query370 = "insert into cashbook(id, sccode, sessionyear, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, ongoing, module, status)
    		VALUES (NULL,  '$sccode', '$sy', '$mx', '$yx', '$slot', '$date', '$ddx', '$refref', '$partidx', 'Cat-NA', 0, 'Part-NA', '$iii', '$eee', '$amount', 'System-Auto', '$cur', '0', 'BANK', '1' );";
        $conn->query($query370);
        // echo $query370;
    }




} else if ($tail == 2) {
    $id = $_POST['id'];


    $date = $_POST['date'];
    $type = $_POST['type'];
    $chqno = $_POST['chq'];
    $amount = $_POST['amt'];



    if ($chqno == '') {
        if ($type == 'Deposit') {
            $sql0 = "SELECT * FROM banktrans where accno = '$accno' and sccode='$sccode' and transtype = 'Deposit' order by date desc, id desc limit 1 ";
            $result01xgg = $conn->query($sql0);
            if ($result01xgg->num_rows > 0) {
                while ($row0 = $result01xgg->fetch_assoc()) {
                    $chq = $row0["chqno"];
                }
            } else {
                $chq = ($sccode % 10000) * 10000;
            }

            if ($chq == NULL || $chq == '' || $chq == 0) {
                $chq = ($sccode % 10000) * 10000;
            }
            $chq = $chq * 1;
            $chq = $chq + 1;
        } else if ($type == 'Interest' || $type == 'Deduction') {
            $chqno = 'N/A';
        } else {
            $chqno = '-';
        }
    }

    $sql0 = "SELECT * FROM banktrans where accno='$accno' and sccode='$sccode' and date <= '$date' order by verified desc, date desc, entrytime desc limit 1 ";
    $result01xg = $conn->query($sql0);
    if ($result01xg->num_rows > 0) {
        while ($row0 = $result01xg->fetch_assoc()) {
            $accno = $row0["accno"];
            $balance = $row0["balance"];
        }
    } else {
        $accno = 0;
        $balance = 0;
    }

    if ($type == 'Deposit' || $type == 'Interest') {
        $bala = $balance + $amount;
    } else {
        $bala = $balance - $amount;
    }

    $query33 = "UPDATE banktrans set date='$date', transopening='$balance', transtype='$type', chqno='$chqno', amount='$amount', balance='$bala', entryby='$usr', entrytime='$cur', verified='0', verifyby=NULL, verifytime=NULL where id='$id' and sccode='$sccode' and accno='$accno';";
    // $conn->query($query33);


    $query34 = "UPDATE banktrans set verified='1', verifyby='$usr', verifytime='$cur' where id='$id' and sccode='$sccode' and accno='$accno';";
    // $conn->query($query34);



    /////////////////////////////////////////////////////
    $mx = date('m', strtotime($date));
    $yx = date('Y', strtotime($date));
    if ($type = 'Deposit' || $type == 'Deduction') {
        $tipe = 'Expenditure';
        $income = 0;
        $expenditure = $amount;
    } else {
        $tipe = 'Income';
        $income = $amount; //
        $expenditure = 0;
    }

    if ($type == 'Deposit') {
        $partidx = 1;
    } else if ($type == 'Withdrawal' || $type == 'Withdraw') {
        $partidx = 2;
    } else if ($type == 'Deduction') {
        $partidx = 4;
    } else if ($type == 'Interest') {
        $partidx = 3;
    }

    // $partidx = '00';
    $particularx = 'from Bank Transaction';
    $sql0 = "SELECT * FROM bankinfo where accno='$accno' and sccode='$sccode' ";
    $result01xgd = $conn->query($sql0);
    if ($result01xgd->num_rows > 0) {
        while ($row0 = $result01xgd->fetch_assoc()) {
            $slot = $row0["slot"];
        }
    } else {
        $slot = 'School';
    }


    $cash = "INSERT INTO cashbook (id, sccode, sessionyear, month, year, slots, date, type, refno, partid, category, memono, particulars, income, expenditure, amount, entryby, entrytime, module, status) 
                VALUES (NULL, '$sccode', '$sy', '$mx', '$yx', '$slot', '$date', '$tipe', '$rrf', '$partidx', '--', '0', '$particularx', '$income', '$expenditure', '$amount', 'System-Auto', '$cur', 'BANK', '1' );";
    $conn->query($cash);
    echo $cash;
    /////////////////////////////////////////////////////////////////////////////////////////

} else if ($tail == 3) {
    $id = $_POST['id'];

    $sql0 = "SELECT * FROM banktrans where sccode='$sccode' and id='$id';";
    $result01xgr = $conn->query($sql0);
    if ($result01xgr->num_rows > 0) {
        while ($row0 = $result01xgr->fetch_assoc()) {
            $refno = $row0["refno"];
        }
    }

    $query33 = "DELETE FROM banktrans  where id='$id' and sccode='$sccode' and accno='$accno';";
    $conn->query($query33);
    $query39 = "DELETE FROM cashbook  where refno='$refno' and sccode='$sccode' ;";
    $conn->query($query39);
}





echo '<i class="mdi mdi-check-circle mdi-24px text-success"></i><b>Entry Saved.</b>';
