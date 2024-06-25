<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$mail = $_POST['mail'];
$tail = $_POST['tail'];



if ($tail == 2) {
    $level = $_POST['ulevel'];
    $query331 = "UPDATE usersapp SET userlevel = '$level' where email = '$mail' and sccode='$sccode'";
} else if ($tail == 3) {
    $dispname = $_POST['dispname'];
    $cell = $_POST['cell'];
    $userid = $_POST['userid'];
    $query331 = "UPDATE usersapp SET profilename = '$dispname', mobile='$cell', userid='$userid' where email = '$mail' and sccode='$sccode'";
}
// echo $query331;
$conn->query($query331);
echo 'Action Applied';