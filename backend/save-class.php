<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$cls = $_POST['cls'];
$sec = $_POST['sec'];
$ont = $_POST['ont'];
$sy = $_POST['sy'];

if ($ont == 1) {
    if ($id == '' || $id == 0) {
        $query331 = "INSERT INTO areas (id, idno, user, areaname, subarea, sessionyear, yesno, entrytime) 
                VALUES (NULL, '1', '$rootuser', '$cls', '$sec', '$sy', '1', '$cur');";
    } else {
        $query331 = "UPDATE areas SET areaname = '$cls', subarea = '$sec', sessionyear='$sy' where id = '$id' and user='$rootuser'";
    }
} else {
    $query331 = "DELETE FROM areas where id = '$id' and user='$rootuser'";
}

// echo $query331;
$conn->query($query331);

