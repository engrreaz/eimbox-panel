<?php
date_default_timezone_set('Asia/Dhaka');

include ('inc2.php');
$iid = $_POST['iid'];

if ($iid == 0) {
    $yyy = $_POST['year'];
    $mmm = $_POST['month'];
    $tid = $_POST['tid'];


    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $e = $_POST['e'];
    $f = $_POST['f'];
    $g = $_POST['g'];
    $h = $_POST['h'];
    $i = $_POST['i'];
    $j = $_POST['j'];
    $k = $_POST['k'];
    $l = $_POST['l'];
    $m = $_POST['m'];
    $n = $_POST['n'];
    $o = $_POST['o'];
    $p = $_POST['p'];
    $q = $_POST['q'];
    $r = $_POST['r'];
    $u = $_POST['u'];
    $v = $_POST['v'];
    $w = $_POST['w'];
    $x = $_POST['x'];
    $yo = $_POST['yo'];
    $py = $_POST['py'];

    $gchq = $_POST['gchq'];
    $schq = $_POST['schq'];

    $tot = $h + $p;

    $des = '';
    $sql0 = "SELECT * FROM designation  where title='$des'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $rnk = $row0["ranks"];
        }
    }

    $sql0 = "SELECT * FROM teacher  where tid='$tid' and sccode='$sccode'";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $slt = $row0["slots"];
            $rnk = $row0["ranks"];
            $jdate = $row0["fjdate"];
            $acc1 = $row0["accno"];
            $bn1 = $row0["bankname"];
            $br1 = $row0["branch"];
            $acc2 = $row0["accnosch"];
            $bn2 = $row0["bnamesch"];
            $br2 = $row0["bbrsch"];
            $acc3 = $row0["accnopf"];
            $bn3 = $row0["bnamepf"];
            $br3 = $row0["bbrpf"];

            //$ = $row0[""]; $ = $row0[""]; $ = $row0[""]; $ = $row0[""]; $ = $row0[""]; $ = $row0[""]; $ = $row0[""]; $ = $row0[""]; 
        }
    }

    $query33 = "INSERT INTO salarydetails(id, sessionyear, sccode, slots, month, year, refnogovt, refnosch, refnopf, tid, ranks, joindate, accno, bankname, bankbr, 
    		                                    basic, incentive, house, medical, arrear, welfare, retire, govt, 
    		                                    accnosch, banknamesch, bankbrsch, salary, mpa, travel, med2, exam, festival, pf, school, other2, arrear2,
    		                                    accnopf, banknamepf, bankbrpf, total, entrytime, govtcol1, govtcol2, schoolcol1, schoolcol2, govtcol3, schoolcol3, govtchq, schoolchq) 
    		                                values(NULL, '$sy', '$sccode', '$slt', '$mmm', '$yyy', '', '', '', '$tid', '$rnk', '$jdate', '$acc1', '$bn1', '$br1', 
    		                                    '$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', 
    		                                    '$acc2', '$bn2', '$br2', '$i', '$j', '$k', '$l', '$m', '$n', '$o', '$p',  '$q',  '$r', 
    		                                    '$acc3', '$bn3', '$br3', '$tot', '$cur', '$u', '$v', '$w', '$x', '$yo', '$py', '$gchq', '$schq')";
    $conn->query($query33);
    // echo $query33;
    echo 'Amount ' . $tot . ' <i class="mdi mdi-check-circle mdi-24px text-success"></i>';
} else {
    $query33 = "DELETE from salarydetails where id='$iid';";
    $conn->query($query33);
    echo 'Reverse  <i class="mdi mdi-delete mdi-24px text-danger"></i>';
}