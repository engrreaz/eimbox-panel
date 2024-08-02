<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$id = $_POST['id'];
$tail = $_POST['tail'];
$editor = $_POST['editor'];
$refno = $_POST['refno'];
$title = $_POST['title'];
$datee = $_POST['date'];

if ($tail == 0) {
    if ($id == 0) {
        $query331 = "INSERT INTO ref_docs (id, sccode, date, refno, title, content, entryby, entrytime) 
                VALUES (NULL, '$sccode', '$datee', '$refno', '$title', '$editor', '$usr', '$cur');";

        $year = date('Y', strtotime($datee));
        $month = date('m', strtotime($datee));
        $descrip = '';
        $query3g = "INsERT INTO refbook (id, sccode, sessionyear, refno, date, year, month, partid, title, descrip, module, dbtable, sqltext, entryby, entrytime, slot) 
                    VALUES (NULL, '$sccode', '$sy', '$refno', '$datee', '$year', '$month', NULL, '$title', '$descrip', '-', '--', '---', '$usr', '$cur' , '' )";
        $conn->query($query3g);

    } else {
        $query331 = "UPDATE ref_docs set date='$datee', refno='$refno', title='$title', content='$editor', entryby='$usr', entrytime='$cur' where id='$id' and sccode='$sccode';";

        $query3g = "update refbook set refno='$refno', date='$datee', title='$title' where id='$id' and sccode='$sccode';";
        // $conn->query($query3g);
    }

}


// echo $query331;

$conn->query($query331);