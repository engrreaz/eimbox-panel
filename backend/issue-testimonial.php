<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

// 0 == Add new (Expenditute), 1 == Edit, 2 == Delete, 3 == Set Memo No., 4 == ........, 5 == Add New (Income)

$stid = $_POST['stid'];
$year = $_POST['year'];
$sec = $_POST['sec'];

$center = 'Bancha-2';

$sql0 = "SELECT * FROM students where sccode = '$sccode' and stid='$stid' ;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $regdno = $row0["regdno"];
        $rollno = $row0["rollno"];
        $gpa = $row0["gpa"];
        $gla = $row0["gla"];
    }
}

$sql0 = "SELECT * FROM testimonial where sccode = '$sccode' and passyear='$year' order by slno desc LIMIT 1;";
$result0rtz = $conn->query($sql0);
if ($result0rtz->num_rows > 0) {
    while ($row0 = $result0rtz->fetch_assoc()) {
        $slno = $row0["slno"] + 1;
    }
} else {
    $slno = 1;
}
if ($slno < 10) {
    $sst = '0' . $slno;
} else {
    $sst = $slno;
}

$regdyear = $year - 2;
$session = $regdyear . '-' . ($year - 1) % 100;
$testsl = 'SSC-' . $sccode % 10000 . '-' . $year % 100 . '-' . $sst;
$query331 = "INSERT INTO testimonial (id, sccode, stid, pubexam, regdno, regdyear, rollno, passyear, session, gpa, grade, slno, testslno, testdate, groupsection, examcenter, issueby, issuetime ) 
    values (NULL, '$sccode', '$stid', 'SSC', '$regdno', '$regdyear', '$rollno', '$year', '$session', '$gpa', '$gla', '$slno', '$testsl', '$td', '$sec', '$center', '$usr', '$cur' );";
$conn->query($query331);

echo 'Issued';