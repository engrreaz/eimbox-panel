<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$stid = $_POST['stid'];

$query331 = "DELETE FROM students where stid = '$stid' and sccode='$sccode';";
$query332 = "DELETE FROM sessioninfo where stid = '$stid' and sccode='$sccode';";
$query333 = "DELETE FROM stfinance where stid = '$stid' and sccode='$sccode';";
$query334 = "DELETE FROM stpr where stid = '$stid' and sccode='$sccode';";
$query335 = "DELETE FROM stattnd where stid = '$stid' and sccode='$sccode';";

$conn->query($query331);
$conn->query($query332);
$conn->query($query333);
$conn->query($query334);
$conn->query($query335);