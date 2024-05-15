<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$classname = $_POST['classname'];
$sectionname = $_POST['sectionname'];
$rollno = $_POST['rollno'];

$sessionyear = $sy;


$sql0 = "SELECT * FROM sessioninfo where sccode='$sccode' and classname='$classname' and sectionname='$sectionname' and rollno='$rollno' and sessionyear='$sy';";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
	while ($row5 = $result0->fetch_assoc()) {
		echo $row5["stid"];
	}
} else {
	echo '0';
}