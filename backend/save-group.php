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
        $query331 = "INSERT INTO pibigroup (id, sccode, sessionyear, classname, sectionname, groupname, rolls, entryby, entrytime) 
                VALUES (NULL, '$sccode', '$year', '$cls', '$sec', '$gname', '$rolls', '$usr', '$cur');";
    } else {
        $query331 = "UPDATE pibigroup SET groupname = '$gname', rolls = '$rolls' where id = '$id' and sccode='$sccode'";
    }
} else {
    $query331 = "DELETE FROM pibigroup where id = '$id' and sccode='$sccode'";
}

// echo $query331;
$conn->query($query331);

