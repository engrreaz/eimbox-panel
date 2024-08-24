<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$algo = $_POST['algo'];
$secret = $_POST['secret'];
$api = $_POST['api'];
$mail2 = $_POST['mail2'];
$mail3 = $_POST['mail3'];


$query331 = "UPDATE scinfo SET algorithm = '$algo', secret_key = '$secret', api_key = '$api', backup_mail_2 = '$mail2', backup_mail_3 = '$mail3' where sccode = '$sccode' ";


// echo $query331;
$conn->query($query331);

