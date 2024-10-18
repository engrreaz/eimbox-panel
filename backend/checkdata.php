<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');

$type = $_POST['type'];
$userid = $_POST['userid'];
$dob = $_POST['dob'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$passsword = $_POST['passsword'];

$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$sccode = substr($userid, 6);
$stt = 'Request';
$respon = $responby = null;

$query33 = "INSERT INTO usersrequest(id, usertype, userid, dob, mobile, email, passpin, submittime, ipaddress, useragent, sccode, status, responsetime, responseby) 
values(NULL, '$type', '$userid', '$dob', '$mobile', '$email', '$password', '$cur', '$ip', '$agent', '$sccode', '$stt', '$respon', '$responby')";
$conn->query($query33);

