<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');


$today_st_attnd = 0;
$today_t_attnd = 0;
$total_user = 0;
$user_active = 0;
$expense_month = 0;



// Count Students
$sql0 = "SELECT count(*) as stcnt FROM sessioninfo where sccode = '$sccode' and sessionyear='$sy' ;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $total_students = $row0["stcnt"];
    }
}
$sql0 = "SELECT count(*) as attndcnt FROM stattnd where sccode = '$sccode' and adate='$td' ;";
$result0rtt = $conn->query($sql0);
if ($result0rtt->num_rows > 0) {
    while ($row0 = $result0rtt->fetch_assoc()) {
        $today_st_attnd = $row0["attndcnt"];
    }
}
$sql0 = "SELECT sum(amount) as taka FROM cashbook where sccode = '$sccode' and month=date('m') and year=date('Y') and category='Expenditure' ;";
$result0rtt = $conn->query($sql0);
if ($result0rtt->num_rows > 0) {
    while ($row0 = $result0rtt->fetch_assoc()) {
        $expense_month = $row0["taka"] + 70;
    }
}

$sql0 = "SELECT sum(amount) as takas FROM stpr where sccode = '$sccode' and prdate='$td' ;";
$result0rttf = $conn->query($sql0);
if ($result0rttf->num_rows > 0) {
    while ($row0 = $result0rttf->fetch_assoc()) {
        $takas = $row0["takas"] + 70;
    }
}




$ccur = date('H:i:s');
$sql0 = "SELECT * FROM classschedule where sccode = '$sccode' and sessionyear='$sy' and timestart<='$ccur' and timeend>='$ccur';";
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

<div id="sche">
    <table class="table " style="width:100%;">
        <?php
        $day = date('l', strtotime($td));
        if ($day == 'Sunday') {
            $wday = 1;
        } else if ($day == 'Monday') {
            $wday = 2;
        } else if ($day == 'Tuesday') {
            $wday = 3;
        } else if ($day == 'Wednesday') {
            $wday = 4;
        } else if ($day == 'Thursday') {
            $wday = 5;
        }

        $sql0 = "SELECT * FROM clsroutine where sccode='$sccode' and sessionyear='$sy' and period='$period' and wday='$wday' order by classname, sectionname;";
        // echo $sql0; 
        $result0a = $conn->query($sql0);
        if ($result0a->num_rows > 0) {
            while ($row0 = $result0a->fetch_assoc()) {
                $cls = $row0["classname"];
                $sec = $row0["sectionname"];
                $tid = $row0["tid"];
                $subj = $row0["subcode"];

                ?>
                <tr>
                    <td><?php echo $cls; ?></td>
                    <td><?php echo $sec; ?></td>
                    <td><?php echo $subj; ?></td>
                    <td><?php echo $tid; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>