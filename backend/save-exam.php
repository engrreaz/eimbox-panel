<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$cls = $_POST['cls'];
$sec = $_POST['sec'];
$ont = $_POST['ont'];
$exam = $_POST['exam'];
$slot = $_POST['slot'];
$date = $_POST['date'];

if ($ont == 1) {
    if ($id == '' || $id == 0) {
        $query331 = "INSERT INTO examlist (id, sccode, sessionyear, slot, examtitle, classname, sectionname, datestart, createdby, createtime, status) 
                VALUES (NULL, '$sccode', '$sy', '$slot', '$exam', '$cls', '$sec', '$date', '$usr', '$cur', '1');";
    } else {
        // $query331 = "UPDATE areas SET areaname = '$cls', subarea = '$sec' where id = '$id' and user='$rootuser'";
    }
} else {
    // $query331 = "DELETE FROM areas where id = '$id' and user='$rootuser'";
}

// echo $query331;
$conn->query($query331);

