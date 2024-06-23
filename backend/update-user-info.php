<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$mail = $_POST['mail'];
$tail = $_POST['tail'];
$level = $_POST['ulevel'];


if ($tail == 2) {
    $query331 = "UPDATE usersapp SET userlevel = '$level' where email = '$mail' and sccode='$sccode'";
}
// echo $query331;
$conn->query($query331);
