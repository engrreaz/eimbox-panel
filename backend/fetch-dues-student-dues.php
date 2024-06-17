<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
$cls2 = $_POST['cls'];
$sec2 = $_POST['sec'];
$cnt = 0;
$cntamt = 0;
$stlist = array();
$paylist = array();

$sql00 = "SELECT * FROM students where  sccode='$sccode'";
$result00 = $conn->query($sql00);
if ($result00->num_rows > 0) {
    while ($row00 = $result00->fetch_assoc()) {
        $stlist[] = $row00;
    }
}
// echo var_dump($stlist);

$month = date('m');
$sql0 = "SELECT stid, sum(dues) as dues, sum(payableamt) as paya, sum(paid) as paid FROM stfinance where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname='$sec2' and month<='$month' group by stid order by stid";
$result01x = $conn->query($sql0);
if ($result01x->num_rows > 0) {
    while ($row0 = $result01x->fetch_assoc()) {
        $paylist[] = $row0;
    }
}




$sql0 = "SELECT * FROM sessioninfo where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname = '$sec2' order by rollno";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $stid = $row0["stid"];
        $clsn = $row0["classname"];
        $secn = $row0["sectionname"];
        $rollno = $row0["rollno"];
        $card = $row0["icardst"];
        $dtid = $row0["id"];
        $status = $row0["status"];
        $rel = $row0["religion"];
        $four = $row0["fourth_subject"];
        $lastpr = $row0["lastpr"];
        if ($lastpr == NULL) {
            $lastpr = 0;
        }



        $stind = array_search($stid, array_column($stlist, 'stid'));
        $neng = $nben = $vill = '';
        if ($stind != '') {
            $neng = $stlist[$stind]["stnameeng"];
            $nben = $stlist[$stind]["stnameben"];
            $vill = $stlist[$stind]["previll"];
            $mno = $stlist[$stind]["guarmobile"];
        }


        $datam = $clsn . '_' . $secn . '_' . $rollno . '_' . $neng . '_' . $nben . '_' . $mno;

        // $sql00 = "SELECT * FROM students where  sccode='$sccode' and stid='$stid' LIMIT 1";
        // $result00 = $conn->query($sql00);
        // if ($result00->num_rows > 0) {
        //     while ($row00 = $result00->fetch_assoc()) {
        //         $neng = $row00["stnameeng"];
        //         $nben = $row00["stnameben"];
        //         $vill = $row00["previll"];
        //     }
        // }

        //if($card == '1'){$qrc = '<img src="https://chart.googleapis.com/chart?chs=20x20&cht=qr&chl=http://www.students.eimbox.com/myinfo.php?id=5000&choe=UTF-8&chld=L|0" />';} else {$qrc = '';}

        // $month = date('m');
        // $sql0 = "SELECT sum(dues) as dues, sum(payableamt) as paya, sum(paid) as paid FROM stfinance where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname='$sec2' and month<='$month' and stid='$stid'";
        // $result01x = $conn->query($sql0);
        // if ($result01x->num_rows > 0) {
        //     while ($row0 = $result01x->fetch_assoc()) {
        //         $totaldues = $row0["dues"];
        //         $tpaya = $row0["paya"];
        //         $tpaid = $row0["paid"];
        //     }
        // }

        $payind = array_search($stid, array_column($paylist, 'stid'));
        $totaldues = $tpaya = $tpaid = 0;
        if ($payind != '') {
            $totaldues = $paylist[$payind]["dues"];
            $tpaya = $paylist[$payind]["paya"];
            $tpaid = $paylist[$payind]["paid"];
        }


        ?>
        <tr>
            <td style="text-align:center; padding : 3px 5px;" class="">
                <?php
                $rl = $rollno;
                echo $rl; //str_replace($enum, $bnum, $rl);
                ?>
            </td>
            <td style="padding : 3px 10px;"><?php echo $nben; ?></td>
            <td style="text-align:right; padding : 3px 5px;" class="text-right">
                <?php
                $tt = number_format($totaldues, 2, ".", ",");
                // echo $tt;
                echo $tt;//str_replace($enum, $bnum, $tt);
                ?>
            </td>
            <td>
                <bttton id="btn<?php echo $stid; ?>" class="btn btn-inverse-primary" onclick="getdues(<?php echo $stid; ?>, <?php echo $lastpr; ?>,'<?php echo $datam; ?>' );"><i
                        class="mdi mdi-arrow-right"></i></bttton>
            </td>
        </tr>
        <?php
        $cnt++;
        $cntamt = $cntamt + $totaldues;
    }
}