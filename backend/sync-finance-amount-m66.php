<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$tail = $_POST['tail'];
$vcl = explode('_', $_POST['vcl']);
$stcnt = 0;
// echo $id . '///';
$disp = '';

$new = $update = $noneed = 0;
$query3p = '';
$newsl = 1;
foreach ($vcl as $cls) {
    // echo $disp .= $cls . ' ******* ';
    $stlist = array();

    if ($cls != '') {
        $stlist = array();
        $count = 0;
        $lmt = rand(5, 10);
        $sql0x = "SELECT * FROM sessioninfo where classname='$cls' and sccode='$sccode' and sessionyear LIKE '$sy%' order by sectionname, rollno ;";
        $result0xx = $conn->query($sql0x);
        if ($result0xx->num_rows > 0) {
            while ($row0x = $result0xx->fetch_assoc()) {
                $stlist[] = $row0x;
            }
        } else {
            $stlist[] = '';
        }

        $student_count = count($stlist);


        // echo var_dump($stlist) . '<hr>';

        // RETRIVE UPDATE TIME
        $sql0x = "SELECT * FROM financesetup where id='$id' and sccode='$sccode' and sessionyear LIKE '$sy%';";
        // echo $sql0x;
        $result0xxt = $conn->query($sql0x);
        if ($result0xxt->num_rows > 0) {
            while ($row0x = $result0xxt->fetch_assoc()) {
                $taka = $row0x[$cls];
                $update_time = $row0x[$cls . '_update'];
                $parte = $row0x['particulareng'];
                $partb = $row0x['particularben'];
                $mmm = $row0x['month'];


                // echo $taka . ' | ' . $update_time;
            }
        }


        // GET FINANCE DATA
        $finlist = array();
        $sql0x = "SELECT * FROM stfinance where partid='$id'  and sccode='$sccode' and sessionyear LIKE '$sy%' and classname = '$cls' order by sectionname, rollno ;";
        // echo $sql0x;
        $result0xx2 = $conn->query($sql0x);
        if ($result0xx2->num_rows > 0) {
            while ($row0x = $result0xx2->fetch_assoc()) {
                $finlist[] = $row0x;
            }
        } else {
            $finlist[] = '';
        }


        // echo var_dump($finlist) . '<hr>';


        foreach ($stlist as $stu) {
            $stid2 = $stu['stid'];
            $cls2 = $stu['classname'];
            $sec2 = $stu['sectionname'];
            $roll2 = $stu['rollno'];
            $rate2 = $stu['rate'];
            // echo $stid2 . $cls2 . $sec2 . $roll2 . '<br>';
            $disp .= $stid2 . ' -*- ';

            $ind = array_search($stid2, array_column($finlist, 'stid'));
            $disp .= $ind . ' - ';
            if ($ind != '') {

                if ($mmm > 0) {

                    $modi = $finlist[$ind]['modifieddate'];
                    if ($modi == NULL) {
                        $modi = '2024-01-01';
                    }
                    if (strtotime($modi) < strtotime($update_time)) {
                        echo '(' . $roll2 . ')'; // Update
                        $update++;
                        $count++;
                        $update_id = $finlist[$ind]['id'];
                        $update_paid = $finlist[$ind]['paid'];
                        $pamt = $taka * $rate2 / 100;
                        $dues = $taka - $update_paid;

                        $query3p = "UPDATE stfinance set amount='$taka', payableamt='$pamt', modifieddate = '$cur', dues = '$dues' where id='$update_id' and sccode='$sccode' ;";
                        echo $query3p . '<hr>';
                        $conn->query($query3p);

                    } else {
                        echo '[' . $roll2 . ']'; // No need to update
                        $noneed++;
                        // $count++;
                    }
                    /////////////////////////////////////////////////////////////////////
                } else if ($mmm == 0) {
                    $datam = array();
                    $pick = "SELECT * FROM stfinance where partid='$id'  and sccode='$sccode' and sessionyear LIKE '$sy%' and stid = '$stid2' order by month ;";
                    echo $pick;

                    $result0xx21 = $conn->query($pick);
                    if ($result0xx21->num_rows > 0) {
                        while ($row0xn = $result0xx21->fetch_assoc()) {
                            $datam[] = $row0xn;
                        }
                    } else {
                        $datam = array();
                    }
                    echo var_dump($datam);
                    echo '<hr>';
                    for ($z = 1; $z <= 12; $z++) {
                        $tarikh = '2024-' . $z . '-01';
                        $mx = ' : ' . date('F/Y', strtotime($tarikh));

                        $indz = array_search($z, array_column($datam, 'month'));
                        echo $indz . '-';

                        if ($indz != '') {
                            $modi = $datam[$indz]['modifieddate'];

                            if ($modi == NULL) {
                                $modi = '2024-01-01 00:00:00';
                            }
                            $uuuid = $datam[$indz]['id'];
                            if (strtotime($modi) < strtotime($update_time)) {

                                $pamt = $taka * $rate2 / 100;
                                $joma = $pamt - $datam[$indz]['paid'];
                                // $disp .= '{' . $cls2 . '-' . $sec2 . '-' . $roll2 . '-' . $z . '--' . $uuuid . ' ------- }';
                                $query3px = "UPDATE stfinance set amount='$taka', payableamt='$pamt', modifieddate = '$cur', dues = '$joma' where id='$uuuid' and sccode='$sccode' ;";
                                // if($stid2 == '1031872887') {
                                echo '<br>' . $query3px . '<br>';
                                // $conn->query($query3px);
                                $update++;
                                $count++;
                                $query3px = '';
                                // }
                            } else {

                                // $disp .= '{*' . $z . '--' . $stid2 . ' ------- }';
                                $noneed++;
                                $count++;
                            }






                        }

                        /*
                        else {

                            $pamt = $taka * $rate2 / 100;
                            $mxe = $parte . $mx;
                            $mxb = $partb . $mx;
                            $query3plo = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, setupdate, setupby, payableamt, modifieddate, modifiedby, paid, dues)
                                        VALUES (NULL, '$sccode', '$sy', '$cls2', '$sec2', '$stid2', '$roll2', '$id',  '$mxe', '$mxb', '$taka', '$z', '$cur', '$usr', '$pamt', '$cur', '$usr', '0', '$pamt') ;";
                            // $disp .= $stid2 . '/' . $z . '<br>';
                            // $newsl++;
                            // $disp .= $cls2 . $sec2 . $roll2 . $stid2 . $z;
                            $new++;
                            $count++;
                            // $conn->query($query3plo);
                            $query3plo = '';

                        }

                        */
                        $count++;
                        // for.......................
                    }

                    // $disp .= '@@';
                    // m == 0 -------------------------------

                }




                //************************************************************************************************************************** */          
            } else {
                $disp .= '###' . $roll2 . '###'; // Inser new record
                $new++;
                $count++;
                if ($mmm > 0) {
                    $pamt = $taka * $rate2 / 100;
                    $query3p = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, setupdate, setupby, payableamt, modifieddate, modifiedby, paid, dues)
                               VALUES (NULL, '$sccode', '$sy', '$cls2', '$sec2', '$stid2', '$roll2', '$id',  '$parte', '$partb', '$taka', '$mmm', '$cur', '$usr', '$pamt', '$cur', '$usr', '0', '$pamt') ;";
                    // echo $newsl . ') ' . $query3p . '<hr>';
                    $newsl++;
                    $conn->query($query3p);
                } else if ($mmm == 0) {

                    for ($z = 1; $z <= 12; $z++) {
                        $tarikh = '2024-' . $z . '-01';
                        $mx = ' : ' . date('F', strtotime($tarikh)) . '/' . date('Y');

                        $pamt = $taka * $rate2 / 100;
                        $mxe = $parte . $mx;
                        $mxb = $partb . $mx;
                        $query3plo = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, setupdate, setupby, payableamt, modifieddate, modifiedby, paid, dues)
                                           VALUES (NULL, '$sccode', '$sy', '$cls2', '$sec2', '$stid2', '$roll2', '$id',  '$mxe', '$mxb', '$taka', '$z', '$cur', '$usr', '$pamt', '$cur', '$usr', '0', '$pamt') ;";
                        
                        // $newsl++;
                        // $count++;
                        // $conn->query($query3plo);
                    }



                }
            }

            $ind = '';




            $stcnt++;
            if ($count >= $lmt) {
                $count = 0;
                ?>
                <script>
                    var a = parseInt(document.getElementById("more").innerHTML);
                    var b = parseInt(<?php echo $lmt; ?>);
                    // alert(a);
                    // alert(b);
                    document.getElementById("more").innerHTML = a + b + ' Data Synced. Process Continue .....' + '<br><?php echo $disp; ?>';


                    var curval = parseInt(<?php echo $stcnt; ?>);
                    var totval = parseInt(document.getElementById("tsc").innerHTML);
                    var perc = parseInt(curval * 100 / totval);
                    // alert(perc);
                    document.getElementById("progbar").style.width = perc + '%';
                    // hang();
                </script>
                <?php
                $lmt = rand(10, 20);
                break;
            }

            //student loop
        }
        // echo $query3p;
    }



    // echo '<hr>';
}


//UPDATE update information
$tim = date('Y-m-d H:i:s');
$query3p = "UPDATE financesetup set last_update = '$tim', need_update = '0' where id='$id' and sccode='$sccode' and sessionyear='$sy' ;";
// echo $query3p . '<hr>';
$conn->query($query3p);


// echo $new . ' -- ' . $update . ' -- ' . $noneed . ' ||| ' . $student_count;
echo $new + $update + $noneed . ' Data Updated Successfully';
// echo 'count' . $count . 'found';
if ($count > 0 || $new + $update == 0) {
    ?>
    <script>
        document.getElementById("more").innerHTML = parseInt(document.getElementById("more").innerHTML) + parseInt(<?php echo $count; ?>)  + ' Done!';
    </script>
    <?php
}


/*

if ($idfin > 0) {
    $sql0x = "SELECT * FROM financesetup where id='$idfin' LIMIT 1 ;";
    $result0xx = $conn->query($sql0x);
    if ($result0xx->num_rows > 0) {
        while ($row0x = $result0xx->fetch_assoc()) {
            $val = $row0x[$cls];
        }
    }
    if ($val == $taka) {
        // echo 'no change';
    } else {
        
        $query3p = "UPDATE financesetup setup set $cls = '$taka', $upd = '$cur' where sccode = '$sccode' and sessionyear LIKE '$sy%' and id = '$idfin'";
        $conn->query($query3p);
    }


} else {
    $sql0x = "SELECT * FROM financeitem where id='$id' LIMIT 1 ;";
    $result0xx = $conn->query($sql0x);
    if ($result0xx->num_rows > 0) {
        while ($row0x = $result0xx->fetch_assoc()) {
            $particulareng = $row0x["particulareng"];
            $particularben = $row0x["particularben"];
            $month = $row0x["month"];
            $slno = $row0x["slno"];
        }
    }

    $query3p = "INSERT INTO financesetup (id, sccode, sessionyear, $cls, slno, particulareng, particularben, month, $upd) 
        VALUES (NULL, '$sccode', '$sy', '$taka', '$slno', '$particulareng', '$particularben', '$month', '$cur');";
    $conn->query($query3p);
    echo 'insert';
}

*/
// echo $idlist . '<br>----------------------------<br>';
// echo date('H:i:s');