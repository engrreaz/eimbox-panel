<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$dispname = $_POST['dispname'];
$cellno = $_POST['cellno'];

$query331 = "UPDATE usersapp SET profilename = '$dispname', mobile = '$cellno' where email = '$usr' and sccode='$sccode'";
$conn->query($query331);




echo 'Information Updated Successfully';