<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$tail = $_POST['tail'];


$sql0 = "UPDATE areas set idno=idno+$tail where user='$rootuser' and sessionyear='$sy' and id='$id';";
// echo $sql0;
$conn->query($sql0);