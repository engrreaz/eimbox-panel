<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
$ttt = 0;
$tail = $_POST['tail'];

if ($tail != 5) {
    $yyy = $_POST['year'];
    $mmm = $_POST['month'];
    $a = strtolower($_POST['a']);
    $b = strtolower($_POST['b']);
    $c = $_POST['c'];
    $d = $_POST['d'];
    $e = $_POST['e'];
    $f = $_POST['f'];
    $g = $_POST['g'];

}


if ($tail == 0) {


    $sql0 = "SELECT * FROM salaryextracolumn where sccode='$sccode' and sessionyear='$yyy' and month='$mmm' ";
    // echo $sql0;
    $result0rt = $conn->query($sql0);
    if ($result0rt->num_rows > 0) {
        while ($row0 = $result0rt->fetch_assoc()) {
            $g1title = $row0["govt1title"];
            $g1type = $row0["govt1type"];
            $g1val = $row0["govt1value"];
            $g2title = $row0["govt2title"];
            $g2type = $row0["govt2type"];
            $g2val = $row0["govt2value"];
            $s1title = $row0["school1title"];
            $s1type = $row0["school1type"];
            $s1val = $row0["school1value"];
            $s2title = $row0["school2title"];
            $s2type = $row0["school2type"];
            $s2val = $row0["school2value"];
        }
    } else {
        $g1title = '';
        $g1type = '';
        $g1val = 0;
        $g2title = '';
        $g2type = '';
        $g2val = 0;
        $s1title = '';
        $s1type = '';
        $s1val = 0;
        $s2title = '';
        $s2type = '';
        $s2val = 0;

    }
    echo $g1val . '/';
    $one = 0;
    $two = 0;
    $three = 0;
    $four = 0;
    // echo $b;
    if ($b == 'govt') {
        if ($g1val > 0) {
            $sql0 = "SELECT sum(govtcol1) as one FROM salarydetails where sccode='$sccode' and slots='$a' and  sessionyear='$yyy' and month='$mmm' ";
            // echo $sql0;
            $result0rtoo1 = $conn->query($sql0);
            if ($result0rtoo1->num_rows > 0) {
                while ($row0 = $result0rtoo1->fetch_assoc()) {
                    $one = $row0["one"];
                }
            }

            $query33 = "INSERT INTO salarysummery(id, sessionyear, sccode, month, year, refno, slot, category, amount, chequeno, accid, accno, issuedate, issueby, status, date) 
		                                values(NULL, '$sy', '$sccode', '$mmm', '$yyy', '$d', '$a', '$g1title', '$one', '$e', '$f', '--', '$cur', '$usr', 0, '$g')";
            $conn->query($query33);

            $query331 = "UPDATE salarydetails set refnogovt = '$d' where sccode='$sccode' and month='$mmm' and year ='$yyy' and slots='$a';";
            $conn->query($query331);
        }


        if ($g2val > 0) {
            $sql0 = "SELECT sum(govtcol2) as two FROM salarydetails where sccode='$sccode' and slots='$a' and  sessionyear='$yyy' and month='$mmm' ";
            $result0rtoo2 = $conn->query($sql0);
            if ($result0rtoo2->num_rows > 0) {
                while ($row0 = $result0rtoo2->fetch_assoc()) {
                    $two = $row0["two"];
                }
            }

            $query33 = "INSERT INTO salarysummery(id, sessionyear, sccode, month, year, refno, slot, category, amount, chequeno, accid, accno, issuedate, issueby, status, date) 
		                                values(NULL, '$sy', '$sccode', '$mmm', '$yyy', '$d', '$a', '$g2title', '$two', '$e', '$f', '--', '$cur', '$usr', 0, '$g')";
            $conn->query($query33);

            $query331 = "UPDATE salarydetails set refnogovt = '$d' where sccode='$sccode' and month='$mmm' and year ='$yyy' and slots='$a';";
            $conn->query($query331);
        }
    }
    // $c = $c - $one - $two;*************************************************************


    $query33 = "INSERT INTO salarysummery(id, sessionyear, sccode, month, year, refno, slot, category, amount, chequeno, accid, accno, issuedate, issueby, status, date) 
		                                values(NULL, '$sy', '$sccode', '$mmm', '$yyy', '$d', '$a', '$b', '$c', '$e', '$f', '--', '$cur', '$usr', 0, '$g')";
    $conn->query($query33);

    if ($b == 'govt') {
        $fld = 'refnogovt';
    } else if ($b == 'school') {
        $fld = 'refnosch';
    } else if ($b == 'pf') {
        $fld = 'refnopf';
    } else {
        $fld = 'refnoextra';
    }
    $query331 = "UPDATE salarydetails set $fld = '$d' where sccode='$sccode' and month='$mmm' and year ='$yyy' and slots='$a';";
    echo $query331;
    $conn->query($query331);

    if ($b == 'expenditure') {
        $sccodes = $sccode * 10;
        $sql0 = "UPDATE cashbook set refno='$d' where sccode='$sccodes' and type='$b' and slots='$a' ";
        $conn->query($sql0);
    }



} else if ($tail == 5) {
    $idx = $_POST['id'];
    $ynx = $_POST['yn'];
    if ($ynx == 'yes') {
        $lock = 1;
    } else {
        $lock = 0;
    }

    $query331 = "UPDATE salarydetails set edit_lock = '$lock' where sccode='$sccode' and id='$idx' ;";
    $conn->query($query331);
    echo $query331;




} else {    //*********************************************************************************************************** */
    $ttt = $_POST['ttt'] ?? 0;
    if ($ttt == 0) {
        $query33 = "DELETE FROM salarysummery where id='$tail'";
        $conn->query($query33);
    } else {
        $query33 = "UPDATE salarysummery set status=1 where id='$tail'";
        $conn->query($query33);


        $sql0 = "SELECT * FROM salarysummery where sccode='$sccode' and id='$tail'";
        $result0345678 = $conn->query($sql0);
        if ($result0345678->num_rows > 0) {
            while ($row0 = $result0345678->fetch_assoc()) {
                $sss = $row0["slot"];
                $ccc = $row0["category"];
            }
        }
        if ($ccc == 'expenditure') {
            $sccodes = $sccode * 10;
            $sql0 = "UPDATE cashbook set sccode='$sccode' where sccode='$sccodes' and type='$ccc' and slots='$sss' ";
            $conn->query($sql0);
            // echo $sql0 . '<br>';
        }
    }


    if ($b == 'govt') {
        $fld = 'refnogovt';
    } else if ($b == 'school') {
        $fld = 'refnosch';
    } else if ($b == 'pf') {
        $fld = 'refnopf';
    } else {
        $fld = 'refnoextra';
    }

    if ($yyy != 0) {
        $query331 = "UPDATE salarydetails set $fld = NULL where sccode='$sccode' and month='$mmm' and year ='$yyy' and slots='$a';";
        $conn->query($query331);
        echo $query331;
    }
}

echo 'Update Successfully ';