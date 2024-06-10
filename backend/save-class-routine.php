<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$sub = $_POST['sub'];
$tid = $_POST['tid'];
$cls = $_POST['cls'];
$sec = $_POST['sec'];
$period = $_POST['period'];
$wday = $_POST['wday'];

if($wday == 1) {$day = 'Sunday';} else 
if($wday == 2) {$day = 'Monday';} else 
if($wday == 3) {$day = 'Tuesday';} else 
if($wday == 4) {$day = 'Wednesday';} else 
if($wday == 5) {$day = 'Thursday';}  



if ($id > 0) {
    $query33 = "UPDATE clsroutine set subcode='$sub', tid='$tid' where id='$id';";
} else {
    $query33 = "INSERT INTO clsroutine (id, sccode, sessionyear, classname, sectionname, period, wday, day, subcode, tid, entryby ) 
                VALUES (NULL, '$sccode', '$sy', '$cls', '$sec', '$period', '$wday', '$day', '$sub', '$tid', '$usr');";
}

$conn->query($query33);
echo '<span style="font-size:30px;"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span>';
//************************************************************************************************************************************************
// echo $query33;