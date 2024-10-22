<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
// $td = '2024-10-22';

$query331 = "UPDATE stpr SET prno = prno+1 where sccode='$sccode' and prdate='$td'";
$conn->query($query331);

$query332 = "UPDATE stfinance SET pr1no = pr1no+1 where sccode='$sccode' and pr1date='$td'";
$conn->query($query332);