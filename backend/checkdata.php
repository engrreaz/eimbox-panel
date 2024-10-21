<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
$usr = '';
if (isset($_SESSION["user"])) {
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
$tail = $_POST['tail'];
// Register method ...........................
$method = 'a email mobile ';
$verify = 'a stid mobile ';
$accept = 0;
// Register method ...........................

$otp = rand(100000, 999999);
$cur = date('Y-m-d H:i:s');
$sy = date('Y');


$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];

$stt = 'Request';
$respon = $responby = null;

if ($tail == 0) {
    $type = $_POST['type'];
    $userid = $_POST['userid'];
    $sccode = substr($userid, 0, 6);
    // $userid = '510520530';
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query33 = "INSERT INTO usersrequest(id, usertype, userid, dob, mobile, email, passpin, submittime, ipaddress, useragent, sccode, otp, otptime,  status, responsetime, responseby) 
values(NULL, '$type', '$userid', '$dob', '$mobile', '$email', '$password', '$cur', '$ip', '$agent', '$sccode', '$otp', '$cur', '$stt', '$respon', '$responby')";
    // echo $query33;
    $conn->query($query33);
    // echo 'data submitted su7ccessfully. Please waiting for verifying with an authorizer.';
    $last_id = $conn->insert_id;
    echo $last_id;

    if ($type == 'Student' || $type == 'Guardian') {
        if (str_contains($verify, 'dob')) {
            $sql0 = "SELECT * from students where stid='$userid' and dob='$dob' and guarmobile = '$mobile' ";
        } else {
            $sql0 = "SELECT * from students where stid='$userid' and  guarmobile = '$mobile' ";
        }
        $result01x = $conn->query($sql0);
        if ($result01x->num_rows > 0) {
            while ($row0 = $result01x->fetch_assoc()) {
                $stid = $row0['stid'];
                echo 'Found';
                $accept = 1;
                include 'backend/checkotp.php';
            }
        } else {
            $stid = '';
            echo 'Not Found';
            $accept = 0;
        }

    } else if ($type == 'Teacher') {

    }
} else {
    $iid = $_POST['iid'];
    $otp = $_POST['otp'];
    $otp2 = $_POST['otp2'];
    if ($iid > 0 && $otp == $otp2) {
        $k = "UPDATE usersrequest set status = 'Verified' where id='$iid' ";
        $conn->query($k);
        // $query333 = "INSERT INTO usersapp(id, sccode, email, secretkey, token, profilename, mobile, userlevel, userid, photourl, firstlogin, lastlogin, lastaccess, posx, posy, status, otp, otptime, fixedpin, curexam, session, userdata1, userdata2, admin, login_gmail, login_pass, login_token, login_token, login_qrcode, setup_done, whatsnew_last_id, reg_status, reg_value, active) 
        //         VALUES (null, '$sccode', '$email', NULL, NULL, NULL, '$mobile', '$type', '$userid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '$password', NULL, '$sy', NULL, NULL, 0, 0, 1, 0, 0, 0', 0, 0,  NULL, NULL, 0 );";
        // $conn->query($query333);

    } else {
        ?>
        OTP Mismatch...............

        <?php
    }

}







// Email


// Mobile


// no OTP


// Manually issue


?>