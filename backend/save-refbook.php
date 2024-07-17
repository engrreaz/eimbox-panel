<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$refno = $_POST['refno'];
$date = $_POST['date'];
$month = $_POST['month'];
$year = $_POST['year'];
$cate = $_POST['cate'];
$title = $_POST['title'];
$descrip = $_POST['descrip'];
$tail = $_POST['tail'];
$slot = $_POST['slot'];

if ($tail == 0) {
    if ($id == 0) {
        $query3g = "INsERT INTO refbook (id, sccode, sessionyear, refno, date, year, month, partid, title, descrip, module, dbtable, sqltext, entryby, entrytime, slot) 
            VALUES (NULL, '$sccode', '$sy', '$refno', '$date', '$year', '$month', '$cate', '$title', '$descrip', '-', '--', '---', '$usr', '$cur' , '$slot' )";
        $conn->query($query3g);
    } else {
        $query3g = "update refbook set refno='$refno', slot='$slot', date='$date', month='$month', year='$year', partid='$cate', title='$title', descrip='$descrip' where id='$id' and sccode='$sccode';";
        $conn->query($query3g);
    }
} else if ($tail == 2){
    $query3g = "DELETE FROM refbook where id='$id' and sccode='$sccode';";
        $conn->query($query3g);
}

// echo $query3g;