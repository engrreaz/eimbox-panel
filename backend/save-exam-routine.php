<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');


$id = $_POST['id'];
$tail = $_POST['tail'];

$classname = $_POST['cls'];
$sectionname = $_POST['sec'];
$examname = $_POST['exam'];
$examdate = $_POST['date'];
$examtime = $_POST['time'];
$subcode = $_POST['sub'];
$sy = $_POST['year'];


if ($tail == 0) {
    $query33 = "Delete from examroutine where id='$id'";
    $conn->query($query33);
    echo 'Deleted.';
} else {
    $sql000v = "SELECT * from subjects where subcode='$subcode'";
    $result000v = $conn->query($sql000v);
    if ($result000v->num_rows > 0) {
        while ($row000v = $result000v->fetch_assoc()) {
            $subject = $row000v["subject"];
        }
    }

    if ($id == 0) {
        $query33 = "insert into examroutine
                    (id, sessionyear, examname, sccode, date, time, clsname, secname, subcode, subj)
            values 	(NULL, '$sy',  '$examname',  '$sccode',  '$examdate',  '$examtime',  '$classname',  '$sectionname', '$subcode', '$subject' )";
        $conn->query($query33);
        echo 'Inserted';
    }  else {
        $query33 = "UPDATE examroutine set date='$examdate', time='$examtime', subcode='$subcode', subj='$subject' where id='$id'";
        $conn->query($query33);
        echo 'Updated';
    }
}








