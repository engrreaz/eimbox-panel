<?php
date_default_timezone_set('Asia/Dhaka');
include ('../inc2.php');

$br = $_POST['br'];
$gpgl = $_POST['gpgl'];

$sql0 = "SELECT * FROM students where sccode = '$sccode' and rollno = '$br' ;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows == 1) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $stid = $row0["stid"];

        if($gpgl==5){$gla = 'A+';}
        else if($gpgl>=4){$gla = 'A';}
        else if($gpgl>=3.5){$gla = 'A-';}
        else if($gpgl>=3){$gla = 'B';}
        else if($gpgl>=2){$gla = 'C';}
        else if($gpgl>=1){$gla = 'D';}
        else {$gla = 'F';}

        $query331 = "UPDATE students set gpa = '$gpgl', gla = '$gla' where stid='$stid' and sccode = '$sccode';";
        $conn->query($query331);
        $st = 'Update Successfully';
    }
} else {
    $st = 'Something went wrong.';
}

