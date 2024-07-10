<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$ont = $_POST['ont'];





if ($ont == 1) {

$year = $_POST['year'];
        $slot = $_POST['slot'];
        $period = $_POST['period'];
        $tstart = $_POST['tstart'];
        $tend = $_POST['tend'];

        $dura = strtotime($tend) - strtotime($tstart);
    if ($id == '' || $id == 0) {
        $query331 = "INSERT INTO classschedule (id, sccode, sessionyear, slots, period, timestart, timeend, duration) 
                VALUES (NULL, '$sccode', '$year', '$slot', '$period', '$tstart', '$tend', '$dura');";
    } else {
        $query331 = "UPDATE classschedule SET period = '$period', timestart = '$tstart', timeend='$tend', duration='$dura' where id = '$id' and sccode='$sccode'";
    }
} else {
    $query331 = "DELETE FROM classschedule where id = '$id' and sccode='$sccode'";
}
echo $query331;
$conn->query($query331);

