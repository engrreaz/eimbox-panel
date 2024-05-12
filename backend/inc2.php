<?php
// include 'config.inc.php';
session_start();
date_default_timezone_set('Asia/Dhaka');

$usr = $_SESSION["user"];
$domain = $_SESSION["domain"];
$userlevel = 'Guest';

$pxx = '';
// 
if($domain == 'localhost'){
    include '../db.php';
} else {
    include '../../db.php';
}


//*****************************************************************
$sy = date('Y');
$td = date('Y-m-d');
$cur = date('Y-m-d H:i:s');
//********************************************************************

$sql0 = "SELECT * FROM usersapp where email='$usr' LIMIT 1";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $token = $row0["token"];
        $sccode = $row0["sccode"];
        $fullname = $row0["profilename"];
        $mobile = $row0["mobile"];
        $userlevel = $row0["userlevel"];
        $userid = $row0["userid"];
        $pth = $row0["photourl"];
        $exam = $row0["curexam"];
        $sy = $row0["session"];
        $otp = $row0["otp"];
        $otptime = $row0["otptime"];
    }
} else {
    $_SESSION["user"] = '';
    $sccode = 99;
    $userlevel = 'Guest';
}


if ($sccode > 100) {
    $sql0x = "SELECT * FROM scinfo where sccode='$sccode' LIMIT 1";
    $result0x = $conn->query($sql0x);
    if ($result0x->num_rows > 0) {
        while ($row0x = $result0x->fetch_assoc()) {
            $scname = $row0x["scname"];
            $scadd1 = $row0x["scadd1"];
            $scadd2 = $row0x["scadd2"];
            $ps = $row0x["ps"];
            $dist = $row0x["dist"];
            $logo = $row0x["logo"];
            $mobile = $row0x["mobile"];
            $rootuser = $row0x["rootuser"];
            $pack = $row0x["pack"];
            $short = $row0x["short"];

            $scmail = $row0x["scmail"];
            $scweb = $row0x["scweb"];

            $progressguar = $row0x["progressguar"];

            $scaddress = $scadd1 . ', ' . $ps . ', ' . $dist;
            $contact = $mobile;
        }
    }


}



if ($usr == '') {
    $scname = '';
    $scaddress = '';
    if ($_SERVER['REQUEST_URI'] != "/index.php") {
        header("Location: index.php");
    }
}
