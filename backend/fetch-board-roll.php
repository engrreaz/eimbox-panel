<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');


$br = $_POST['br'];
$st = '';
$sql0 = "SELECT * FROM students where sccode = '$sccode' and rollno = '$br' ;";
// echo $sql0;
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows == 1) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $st = $st . $row0["stnameeng"];
    } 
} else {
    $st = 'Something went wrong.';
}

echo $st;