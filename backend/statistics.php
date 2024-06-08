<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

// Count Students
$sql0 = "SELECT count(*) as stcnt FROM sessioninfo where sccode = '$sccode' and sessionyear='$sy' ;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $total_students = $row0["stcnt"];
    }
}


$today_st_attnd = 0;
$today_t_attnd = 0;
$total_user = 0;
$user_active = 0;
$expense_month = 0;


$sql0 = "SELECT * FROM classschedule where sccode = '$sccode' and sessionyear='$sy' and timestart<'$cur' and timeend>'$cur';";
$result0rtx = $conn->query($sql0);
if ($result0rtx->num_rows > 0) {
    while ($row0 = $result0rtx->fetch_assoc()) {
        $period = $row0["period"];
        $ts = $row0["timestart"];
        $te = $row0["timeend"];
        $dur = $row0["duration"];
    }
} else {
    $period = '';
    $ts = 0;
    $te = 0;
    $dur = 0;
}
?>


<div id="total_students"><?php echo $total_students; ?></div>
<div id="st_attnd"><?php echo $today_st_attnd; ?></div>
<div id="t_attnd"><?php echo $today_t_attnd; ?></div>
<div id="userstat"><?php echo $total_user; ?></div>
<div id="online"><?php echo $user_active; ?></div>
<div id="expense"><?php echo $expense_month; ?></div>


<div id="main-29"><?php echo $period; ?></div>
<div id="main-30"><?php echo $ts; ?></div>
<div id="main-31"><?php echo $te; ?></div>
<div id="main-32"><?php echo $dur; ?></div>