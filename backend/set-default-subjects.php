<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$year = $_POST['year'];
$clsf = $_POST['cls'];
$secf = $_POST['sec'];
$tail = $_POST['tail'];
$sl = $_POST['sl'];

if ($tail == 0) { // set default
    if ($clsf == 'Six' || $clsf == 'Seven' || $clsf == 'Eight' || $clsf == 'Nine') {
        for ($l = 901; $l <= 911; $l++) {
            $query3 = "insert into subsetup (id, sccode, sessionyear, classname, sectionname, subject) values (NULL, '$sccode', '$year', '$clsf','$secf','$l')";
            $conn->query($query3);
        }

    } else if ($clsf == 'Ten') {
        $secx = substr($secf, 0, 5);
        $sql242a = "SELECT * FROM subjectsettinglist where classname='$clsf' and sectionname like '%$secx%' order by subject";
        echo$sql242a;
        $result242a = $conn->query($sql242a);
        if ($result242a->num_rows > 0) {
            while ($row242a = $result242a->fetch_assoc()) {
                $subcode = $row242a['subject'];
                $idr = $row242a['id'];

                $qq = "INSERT INTO subsetup (sccode, sessionyear, classname, sectionname, subject,fullmarks, subj, obj, pra, ca, camanual, pass_algorithm, cnt, reverse) SELECT '$sccode', '$year', classname, '$secf', subject,fullmarks, subj, obj, pra, 0, camanual, pass_algorithm, cnt, reverse from subjectsettinglist where id = '$idr';";
                $conn->query($qq);

                echo $qq . '<br>';
            }
        }
    }

} else if ($tail == 1) { // delete
    $query3 = "DELETE FROM subsetup where id = '$sl';";
    $conn->query($query3);
} else if ($tail == 3) { // add or edit

    $tid = $_POST['tid'];
    $sub = $_POST['sub'];

    if ($sl > 0) {
        $query3 = "UPDATE subsetup set subject='$sub', tid='$tid' where id = '$sl';";

    } else {
        $query3 = "insert into subsetup (id, sccode, sessionyear, classname, sectionname, subject, tid) 
        values (NULL, '$sccode', '$year', '$clsf','$secf','$sub', '$tid')";
    }
    $conn->query($query3);

}

// echo $query3;