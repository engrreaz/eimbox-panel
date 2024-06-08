<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$cls = $_POST['cls'];
$sec = $_POST['sec'];
$year = $_POST['year'];
$gname = $_POST['gname'];
$rolls = $_POST['rolls'];
$ont = $_POST['ont'];


if ($ont == 1) {
    if ($id == '' || $id == 0) {
        $query331 = "INSERT INTO pibigroup (id, sccode, sessionyear, slot, examtitle, classname, sectionname, datestart, createdby, createtime, status) 
                VALUES (NULL, '$sccode', '$sy', '$slot', '$exam', '$cls', '$sec', '$date', '$usr', '$cur', '1');";
    } else {
        // $query331 = "UPDATE areas SET areaname = '$cls', subarea = '$sec' where id = '$id' and user='$rootuser'";
    }
} else {
    // $query331 = "DELETE FROM areas where id = '$id' and user='$rootuser'";
}

// echo $query331;
$conn->query($query331);

