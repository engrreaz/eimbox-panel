<?php
date_default_timezone_set('Asia/Dhaka');
include 'inc2.php';

$tail = $_POST['ont'];

if ($tail == 0) {
    $id =  $_POST['id'];
    $accno =  $_POST['accno'];
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

    $query33 = "insert into banktrans(id, sccode, accid, accno, date, transopening, transtype, amount, balance, entryby, entrytime, verified, chqno)
    		VALUES (NULL,  '$sccode', NULL, '$accno', '$date', '$balance', '$type', '$amount', '$bala', '$usr', '$cur', '0', '$chqno' );";
    $conn->query($query33);

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
    $id =  $_POST['id'];
    $accno =  $_POST['accno'];
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
    $conn->query($query33);
}  


else if ($tail == 2) {
    $id =  $_POST['id'];
    $accno =  $_POST['accno'];

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
    $conn->query($query33);




    $query34 = "UPDATE banktrans set verified='1', verifyby='$usr', verifytime='$cur' where id='$id' and sccode='$sccode' and accno='$accno';";

    $conn->query($query34);
}
else if ($tail == 3) {
    $id =  $_POST['id'];
    $accno =  $_POST['accno'];

    $query33 = "DELETE FROM banktrans  where id='$id' and sccode='$sccode' and accno='$accno';";

    $conn->query($query33);
}





echo '<b>Entry Saved Successfully.</b>';
