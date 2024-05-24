<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$role = $_POST['role'];
$val = $_POST['val'];

$query3 = "UPDATE permissions_role SET $role = '$val' 	WHERE id='$id' and sccode='$sccode'";
$conn->query($query3);