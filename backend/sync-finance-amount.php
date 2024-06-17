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
$stnumber = 1;
foreach ($vcl as $cls) {
    // echo $cls . ' ******* ';
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
        // echo $sql0x . '<br>';
        $result0xx2 = $conn->query($sql0x);
        if ($result0xx2->num_rows > 0) {
            while ($row0x = $result0xx2->fetch_assoc()) {
                $finlist[] = $row0x;
            }
        } else {
            $finlist[] = '';
        }

        // echo var_dump($finlist);


        foreach ($stlist as $stu) {

            $stid2 = $stu['stid'];
            // echo $stnumber . '% ';


            if ($stnumber < 1) {
                $stnumber++;
                continue;
            }

            $cls2 = $stu['classname'];
            $sec2 = $stu['sectionname'];
            $roll2 = $stu['rollno'];
            $rate2 = $stu['rate'];
            // echo $stid2 . $cls2 . $sec2 . $roll2 . '<br>';
            // $disp .= $roll2 . '  ';

            $ind = array_search($stid2, array_column($finlist, 'stid'));
            // $disp .= $ind . ' - ';

            if ($mmm >= 1 && $mmm <= 12) {
                include 'sync-finance-amount-m1.php';
            } else if ($mmm == 0) {
                include 'sync-finance-amount-m0.php';







            } else {
                include 'sync-finance-amount-m2.php';
            }












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

            $stnumber++;
        }











        // echo $query3p;
    }



    // echo '<hr>';
}





// echo $new . ' -- ' . $update . ' -- ' . $noneed . ' ||| ' . $student_count;
echo $new + $update + $noneed . ' Payment Updated ......... ';
// echo 'count' . $count . 'found';
if ($count > 0 || $new + $update == 0) {
    ?>
    <script>
        document.getElementById("more").innerHTML = parseInt(document.getElementById("more").innerHTML) + parseInt(<?php echo $count; ?>) + ' Done!';
    </script>
    <?php

    //UPDATE update information
    $tim = date('Y-m-d H:i:s');
    $query3p = "UPDATE financesetup set last_update = '$tim', need_update = '0' where id='$id' and sccode='$sccode' and sessionyear='$sy' ;";
    // echo $query3p . '<hr>';
    $conn->query($query3p);
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