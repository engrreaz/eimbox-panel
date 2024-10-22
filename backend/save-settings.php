<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');

$tail = $_POST['tail'];

if ($tail == 0) {
    $ch1 = $_POST['ch1'];
    if ($ch1 == 'true') {
        $ch1 = 1;
    } else {
        $ch1 = 0;
    }
    $val1 = $_POST['val1'];
    $ch2 = $_POST['ch2'];
    if ($ch2 == 'true') {
        $ch2 = 1;
    } else {
        $ch2 = 0;
    }
    $val2 = $_POST['val2'];
    $ch3 = $_POST['ch3'];
    if ($ch3 == 'true') {
        $ch3 = 1;
    } else {
        $ch3 = 0;
    }
    $val3 = $_POST['val3'];

    $sy = array('sy' => '');
    $sql0 = "SELECT * FROM sessionyear where sccode = '$sccode' and active=1 order by id";
    $result0 = $conn->query($sql0);
    if ($result0->num_rows > 0) {
        while ($row0 = $result0->fetch_assoc()) {
            $sy[] = $row0;
        }
    }

    $ind1 = array_search($val1, array_column($sy, 'syear'));
    if ($ind1 != '' || $ind1 != null) {
        $id = $sy[$ind1]['id'];
        $q1 = "UPDATE sessionyear SET active = '$ch1'  where id = '$id' and sccode='$sccode'";
    } else {
        $q1 = "INSERT INTO sessionyear(id, sccode, syear, active, entryby, entrytime) VALUES (NULL, '$sccode', '$val1', '$ch1', '$usr', '$cur')";
    }
    $conn->query($q1);

    $ind1 = array_search($val2, array_column($sy, 'syear'));
    if ($ind1 != '' || $ind1 != null) {
        $id = $sy[$ind1]['id'];
        $q1 = "UPDATE sessionyear SET active = '$ch2'  where id = '$id' and sccode='$sccode'";
    } else {
        $q1 = "INSERT INTO sessionyear(id, sccode, syear, active, entryby, entrytime) VALUES (NULL, '$sccode', '$val2', '$ch2', '$usr', '$cur')";
    }
    $conn->query($q1);

    $ind1 = array_search($val3, array_column($sy, 'syear'));
    if ($ind1 != '' || $ind1 != null) {
        $id = $sy[$ind1]['id'];
        $q1 = "UPDATE sessionyear SET active = '$ch3'  where id = '$id' and sccode='$sccode'";
    } else {
        $q1 = "INSERT INTO sessionyear(id, sccode, syear, active, entryby, entrytime) VALUES (NULL, '$sccode', '$val3', '$ch3', '$usr', '$cur')";
    }
    $conn->query($q1);
}