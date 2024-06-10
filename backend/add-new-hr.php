<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
$hrt = $_POST['hrt'];
if($hrt == 'teacher' || $hrt == 'Teacher'){
    $rnk = 49;
} else $rnk = 99;

$tid = $sccode . '0000';

$sql0 = "SELECT * FROM teacher where sccode='$sccode' and tid > '$tid' order by tid LIMIT 1; ";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $tid = $row0["tid"]-1;
    }
} else {
    $tid = $sccode . '9999';
}

$query33 = "INSERT INTO teacher(id, sccode, tid, ranks) values(NULL, '$sccode', '$tid', '$rnk')";
$conn->query($query33);
echo $tid;
// header("Location:hr-edit.php?tid=". $tid);