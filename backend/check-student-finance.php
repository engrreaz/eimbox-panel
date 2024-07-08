<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');


$stime = date("Y-m-d H:i:s");
echo $stime . ' ';
$check_count = 0;
$classnamelist = ' play-nursery-one-two-three-four-five-six-seven-eight-nine-ten';
$sql0x = "SELECT count(*) as cnt FROM sessioninfo where  sccode='$sccode' and sessionyear LIKE '$sy%' and validate=0 ;";
$result0xxd = $conn->query($sql0x);
if ($result0xxd->num_rows > 0) {
    while ($row0x = $result0xxd->fetch_assoc()) {
        $total_students_count = $row0x['cnt'];
    }
}

$sql0x = "SELECT count(*) as cnt FROM stfinance where  sccode='$sccode' and sessionyear LIKE '$sy%' and validate=0  ;";
$result0xxdf = $conn->query($sql0x);
if ($result0xxdf->num_rows > 0) {
    while ($row0x = $result0xxdf->fetch_assoc()) {
        $total_records_count = $row0x['cnt'];
    }
}
// echo $total_records_count . "<br><br>";

$part_id_list = '';
$sql0x = "SELECT * FROM financesetup where  sccode='$sccode'  and sessionyear LIKE '$sy%' order by id;";
// echo $sql0x;
$result0xxtr = $conn->query($sql0x);
if ($result0xxtr->num_rows > 0) {
    while ($row0x = $result0xxtr->fetch_assoc()) {
        $part_id_list .= $row0x['id'] . '_';
    }
}
$pil = explode('_', $part_id_list);



$valid_class_list = '';
$sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear like '$sy%' group by areaname order by idno ;";
$result0xxt = $conn->query($sql0x);
if ($result0xxt->num_rows > 0) {
    while ($row0x = $result0xxt->fetch_assoc()) {
        $cname = strtoupper($row0x["areaname"]);

        if (strpos($classnamelist, strtolower($cname)) > 0) {
            $valid_class_list .= strtolower($cname) . '_';
        }
    }
}

$vcl = explode('_', substr($valid_class_list, 0, -1));

$sl = 1;
// foreach ($vcl as $cls) {
// echo $sl . '. ' . $cls . ' ----<br>';
// $stlist = array();

// foreach ($pil as $pid) {




$new = $update = $noneed = 0;

$sql0x = "SELECT id, stid, classname, sectionname, rollno, rate FROM sessioninfo where  sccode='$sccode' and sessionyear LIKE '$sy%' and validate=0 LIMIT 1;";
// echo $sql0x;

$result0xxdffl = $conn->query($sql0x);
if ($result0xxdffl->num_rows > 0) {
    while ($row0x = $result0xxdffl->fetch_assoc()) {
        $stid = $row0x['stid'];
        $cls = strtolower($row0x['classname']);
        $sec = strtolower($row0x['sectionname']);
        $roll = strtolower($row0x['rollno']);
        $rate = strtolower($row0x['rate']);


        $query3pd = "UPDATE stfinance set validate = '0' where stid='$stid' and sccode='$sccode' and sessionyear='$sy' ;";
        $conn->query($query3pd);

        $stfinance_array = array();
        $sql0x = "SELECT id, month, idmon, dues, pr1 FROM stfinance where  sccode='$sccode' and sessionyear LIKE '$sy%' and stid='$stid' order by partid, month ;";
        $result0xxdff = $conn->query($sql0x);
        if ($result0xxdff->num_rows > 0) {
            while ($row0x = $result0xxdff->fetch_assoc()) {
                $stfinance_array[] = $row0x;
            }
        }

        // echo '<pre>' . print_r($stfinance_array) . '</pre>';


        $sql0x = "SELECT * FROM financesetup where  sccode='$sccode'  and sessionyear LIKE '$sy%' order by id;";
        // echo $sql0x;
        $result0xxb = $conn->query($sql0x);
        if ($result0xxb->num_rows > 0) {
            while ($row0x = $result0xxb->fetch_assoc()) {
                $partid = $row0x['id'];
                $taka = $row0x[$cls];
                $month = $row0x['month'];
                $parte = $row0x['particulareng'];
                $partb = $row0x['particularben'];


                if ($month > 0 && $month < 13) {
                    $ls = $month;
                    $le = $ls + 1;
                    $lstep = 1;
                } else if ($month == 0) {
                    $ls = 1;
                    $le = 13;
                    $lstep = 1;
                } else {
                    $lstep = $month / 11;
                    $ls = $lstep;
                    $le = 13;
                }
                // echo $ls . ' -- ' . $le . ' -- ' . $lstep . ' **** ';

                for ($z = $ls; $z < $le; $z += $lstep) {
                    if ($month == 0 || $month > 13) {
                        $my = date('Y') . '-' . $z . '-01';
                        $my = date('F/Y', strtotime($my));
                        $partex = $parte . ' : ' . $my;
                        $partbx = $partb . ' : ' . $my;
                    } else {
                        $partex = $parte;
                        $partbx = $partb;
                    }
                    // echo $z . ' ~ ';
                    $idmon = $stid . '-' . $partid . '-' . $z;
                    $indx = '';
                    $indx = array_search($idmon, array_column($stfinance_array, 'idmon'));


                    if ($indx != '') {
                        $fnd = "YES";
                    } else {
                        $fnd = "NO-----------";

                        $paya = $taka * $rate / 100;
                        if ($paya > 0) {
                            $query3pxg = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, idmon, setupdate, setupby, payableamt, modifieddate, paid, dues, last_update, validate, validationtime) 
                                    VALUES (NULL, '$sccode', '$sy', '$cls', '$sec', '$stid', '$roll', '$partid', '$partex', '$partbx', '$taka', '$z', '$idmon', '$cur', '$usr', '$paya', '$cur', '0', '$paya', '$cur', 1, '$cur') ;";
                            $conn->query($query3pxg);
                            // echo $query3pxg . '<br>';

                            $new++;
                        }

                    }



                    if ($taka == 0) {

                        $noneed++;

                        $query3px = "UPDATE stfinance set validate = '1' where stid='$stid' and sccode='$sccode' and sessionyear='$sy' and id='$finid' ;";
                        $conn->query($query3px);
                    } else {
                        if ($fnd == 'YES') {

                            $finid = $stfinance_array[$indx]['id'];
                            $dues = $stfinance_array[$indx]['dues'];
                            if ($dues <= 0) {
                                $noneed++;
                                $fnd .= ' [' . $finid . '] XXX ';

                                // validate....

                            } else {
                                $update++;
                                $fnd .= ' [' . $finid . '] ^^^ ';
                            }

                            $query3px = "UPDATE stfinance set particulareng='$partex', particularben='$partbx', validate = '1' where stid='$stid' and sccode='$sccode' and sessionyear='$sy' and id='$finid' ;";
                            $conn->query($query3px);

                        } else {
                            $paya = $taka * $rate / 100;
                            if ($paya > 0) {
                                $query3pxg = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, idmon, setupdate, setupby, payableamt, modifieddate, paid, dues, last_update, validate, validationtime) 
                                    VALUES (NULL, '$sccode', '$sy', '$cls', '$sec', '$stid', '$roll', '$partid', '$partex', '$partbx', '$taka', '$z', '$idmon', '$cur', '$usr', '$paya', '$cur', '0', '$paya', '$cur', 1, '$cur') ;";
                                $conn->query($query3pxg);
                                // echo $query3pxg . '<br>';

                                $new++;
                            }
                        }
                        // echo '* ' . $cls . ' * / ' . $stid . ' % ' . $partid . ' --- ' . $taka . ' m ' . $z . ' (' . $idmon . ') ' . $indx . ' @ ' . $fnd . '<br>';
                    }
                }

                // echo '<br>';

            }
        }


        $query3pxdel = "DELETE FROM stfinance where stid='$stid' and sccode='$sccode' and sessionyear='$sy' and pr1=0  and validate=0 ;";
        $conn->query($query3pxdel);

        $query3pxdel1 = "update sessioninfo set validate=1, validationtime='$cur' where stid='$stid' and sccode='$sccode' and sessionyear='$sy' ;";
        $conn->query($query3pxdel1);

    }
} else {
    $cls=$sec=$roll=$stid=' ';
}

// End Student Loop


// }

$sl++;
// }


// echo $check_count;


// echo '<br><br>';
$etime = date("Y-m-d H:i:s");
// echo $etime . '<br>';
$time_elapsed = strtotime($etime) - strtotime($stime);

// echo  . ' %%%%% ' . ' / ' . $valid_class_list;
?>
<div class="float-right"><?php echo $time_elapsed; ?>s.</div>
<?php
echo '> ' . $cls . ' (' . $sec . ') : ' . $roll . ' => ' . $stid . '. ';
echo 'Stat -> insert-new ' . $new . ', update ' . $update . ', no-need ' . $noneed . ' [clean tree]<br>';
?>
<div id="totaltotal" hidden><?php echo $total_students_count; ?></div>