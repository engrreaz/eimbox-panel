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




?>
<div id="total_students"><?php echo $total_students;?></div>