<?php
// include 'config.inc.php';
session_start();
date_default_timezone_set('Asia/Dhaka');

$rrr = $_SERVER['PHP_SELF'];

if(isset($_GET["email"])){
    $usr = $_GET["email"];
    $_SESSION["user"] = $usr; 
}

if(isset($_GET["token"])){
    $token = $_GET["token"];
}
if(isset($_GET["photo"])){
    $pth = $_GET["photo"];
}

$usr = $_SESSION["user"];
$userlevel = 'Guest';

$pxx = '';
// 
include 'db.php';

//*****************************************************************
$sy = date('Y');
$td = date('Y-m-d');
$cur = date('Y-m-d H:i:s');

//********************************************************************

$exam = 'Test';

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

    $scname = '';
    $scaddress = '';


    if ($_SERVER['REQUEST_URI'] != "/index.php") {
        header("Location: index.php");
    }

    

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

    if ($userlevel == 'Administrator' || $userlevel == 'Head Teacher') {
        if ($scname == '' || $scadd1 == '' || $scadd2 = '' || $ps == '' || $dist == '' || $contact == '' || $logo == '') {
            header("Location: settingsinstituteinfo.php");
        } else if ($pack == 0) {
            header("Location: accountbuypack.php");
        }
    } else if ($userlevel == 'Guest') {
        //
        session_start();

        header("Location: login.php");
        $pxx = "We noticed that,<br>You're in under review by you Head Teacher / any Administrator.<br> Contact with your authority. <br><br> <b>OR</b><br>You may change your EIIN information.";
    }
}


$l = strlen($pth);
if ($l < 5) {
    $pth = "https://eimbox.com/images/no-image.png";
}


// echo $userlevel;