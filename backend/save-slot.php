<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$ont = $_POST['ont'];


if ($ont == 1) {
    $gname = $_POST['gname'];
    if ($id == '' || $id == 0) {
        $query331 = "INSERT INTO slots (id, sccode, slotname) 
                VALUES (NULL, '$sccode', '$gname');";
    } else {
        $query331 = "UPDATE slots SET slotname = '$gname'  where id = '$id' and sccode='$sccode'";
    }
} if ($ont == 5) {
$query331 = "INSERT INTO slots (id, sccode, slotname) 
                VALUES (NULL, '$sccode', 'School');";
} else {
    $query331 = "DELETE FROM slots where id = '$id' and sccode='$sccode'";
}

// echo $query331;
$conn->query($query331);

