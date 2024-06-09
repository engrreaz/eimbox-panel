<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$tail = $_POST['tail'];
$subcode = $_POST['subcode'];
$sube = $_POST['sube'];
$subb = $_POST['subb'];


if ($tail == 3) {
    if ($id == '' || $id == 0) {
        $query331 = "INSERT INTO subjects (id, sccode, subcode, subject, subben) 
                VALUES (NULL, '$sccode', '$subcode', '$sube', '$subb');";
    } else {
        $query331 = "UPDATE subjects SET subcode = '$subcode', subject = '$sube', subben='$subb' where id = '$id' and sccode='$sccode'";
    }
} else {
    $query331 = "DELETE FROM subjects where id = '$id' and sccode='$sccode'";
}

// echo $query331;
$conn->query($query331);

