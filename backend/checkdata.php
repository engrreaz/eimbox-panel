<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
$usr = '';
if(isset($_SESSION["user"])){
    $usr = $_SESSION["user"];
}

$domain = $_SESSION["domain"];
$userlevel = 'Guest';

$pxx = '';
// 
if ($domain == 'localhost') {
    include '../db.php';
} else {
    include '../../db.php';
}

$cur = date('Y-m-d H:i:s');

$type = $_POST['type'];
$userid = $_POST['userid'];
// $userid = '510520530';
$dob = $_POST['dob'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$password = $_POST['password'];

$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$sccode = substr($userid, 6);
$stt = 'Request';
$respon = $responby = null;

$query33 = "INSERT INTO usersrequest(id, usertype, userid, dob, mobile, email, passpin, submittime, ipaddress, useragent, sccode, status, responsetime, responseby) 
values(NULL, '$type', '$userid', '$dob', '$mobile', '$email', '$password', '$cur', '$ip', '$agent', '$sccode', '$stt', '$respon', '$responby')";
// echo $query33;
$conn->query($query33);
// echo 'data submitted su7ccessfully. Please waiting for verifying with an authorizer.';
$last_id = $conn->insert_id;
echo $last_id;

if ($type == 'Student') {
    $sql0 = "SELECT * from students where stid='$userid' and dob='$dob' and guarmobile = '$mobile' ";
    $result01x = $conn->query($sql0);
    if ($result01x->num_rows > 0) {
        while ($row0 = $result01x->fetch_assoc()) {
            $stid = $row0['stid'];    echo 'Found';
        }
    } else {
        $stid = '';  echo 'Not Found';
    }

}