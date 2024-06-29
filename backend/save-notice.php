<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$ont = $_POST['ont'];

$title = $_POST['title'];
$descrip = $_POST['descrip'];
$expdate = $_POST['expdate'];


$teacher = $_POST['teacher'];
$smc = $_POST['smc'];
$guardian = $_POST['guardian'];

$sms = $_POST['sms'];
$push = $_POST['push'];
$email = $_POST['email'];
$cate = $_POST['cate'];

if($teacher == 'true'){$teacher = 1;} else {$teacher = 0;}
if($smc == 'true'){$smc = 1;} else {$smc = 0;}
if($guardian == 'true'){$guardian = 1;} else {$guardian = 0;}
if($sms == 'true'){$sms = 1;} else {$sms = 0;}
if($push == 'true'){$push = 1;} else {$push = 0;}
if($email == 'true'){$email = 1;} else {$email = 0;}

if ($ont == 1) {
    if ($id == '' || $id == 0) {
        $query331 = "INSERT INTO notice (id, sccode, title, descrip, expdate, teacher, smc, guardian, entryby, entrytime, sms, pushnoti, category, email) 
                VALUES (NULL, '$sccode', '$title', '$expdate', '$teacher', '$smc', '$guardian', '$usr', '$cur', '$sms', '$push', '$cate', '$email');";
    } else {
        $query331 = "UPDATE notice SET title = '$title', descrip = '$descrip', expdate='$expdate', 
            teacher='$teacher', smc='$smc', guardian = '$guardian', entryby='$usr', entrytime='$cur',  
            sms = '$sms', pushnoti = '$push', category = '$cate', email = '$email'
            where id = '$id' and sccode='$sccode'";
    }
} else {
    $query331 = "DELETE FROM notice where id = '$id' and sccode='$sccode'";
}

// echo $query331;
$conn->query($query331);

