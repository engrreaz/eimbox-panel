<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$ont = $_POST['ont'];

$title = $_POST['title'];
$descrip = $_POST['descrip'];
$expdate = $_POST['expdate'];
$teacher = $_POST['teacher'];
$smc = $_POST['smc'];
$guardian = $_POST['guardian'];

if ($ont == 1) {
    if ($id == '' || $id == 0) {
        $query331 = "INSERT INTO notice (id, sccode, title, descrip, expdate, teacher, smc, guardian, entryby, entrytime) 
                VALUES (NULL, '$sccode', '$title', '$expdate', '$teacher', '$smc', '$guardian', '$usr', '$cur');";
    } else {
        $query331 = "UPDATE notice SET title = '$title', descrip = '$descrip', expdate='$expdate', teacher='$teacher', smc='$smc', guardian = '$guardian', entryby='$usr', entrytime='$cur'  where id = '$id' and sccode='$sccode'";
    }
} else {
    $query331 = "DELETE FROM notice where id = '$id' and sccode='$sccode'";
}

// echo $query331;
$conn->query($query331);

