<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$fnltxt = '';
$idfin = $_POST['idfin'];
;
$id = $_POST['id'];
;
$cls = $_POST['cls'];
;
$upd = $cls . '_update';
$taka = $_POST['taka'];
;


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
        
        $query3p = "UPDATE financesetup setup set $cls = '$taka', $upd = '$cur', need_update=1 where sccode = '$sccode' and sessionyear LIKE '$sy%' and id = '$idfin'";
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

