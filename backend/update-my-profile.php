<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$dispname = $_POST['dispname'];
$cellno = $_POST['cellno'];
$pin = $_POST['pin'];
$key = md5($pin);
$ppp = ' ';
if(strlen($pin)>0) {
    $ppp = ", fixedpin = '$pin', secretkey = '$key' ";
}

$query331 = "UPDATE usersapp SET setup_done=1, profilename = '$dispname', mobile = '$cellno' $ppp where email = '$usr' and sccode='$sccode'";
$conn->query($query331);




echo 'Information Updated Successfully';