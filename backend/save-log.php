<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
$page = $_POST['page'];

$sql0 = "SELECT * FROM logbook where email = '$usr' and sccode = '$sccode' order by id desc limit 1;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows == 1) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $lastpage = $row0["pagename"];
        $id = $row0["id"];
        if ($lastpage == $page) {
            $query331 = "UPDATE logbook set duration = duration + 3 where id='$id' ;";
        } else {
            $ip = $_SERVER['SERVER_ADDR'];
            $brs = $_SERVER['HTTP_USER_AGENT'];
            $query331 = "INSERT INTO logbook (id, email, sccode, pagename, duration, ipaddr, platform, browser, location, entrytime) 
            VALUES (NULL, '$usr', '$sccode', '$page', '3', '$ip', 'WEB', '$brs', NULL, '$cur');";
        }
    }
} else {
    $ip = $_SERVER['SERVER_ADDR'];
    $brs = $_SERVER['HTTP_USER_AGENT'];
    $query331 = "INSERT INTO logbook (id, email, sccode, pagename, duration, ipaddr, platform, browser, location, entrytime) 
    VALUES (NULL, '$usr', '$sccode', '$page', '3', '$ip', 'WEB', '$brs', NULL, '$cur');";
}

$conn->query($query331);

$curr = date('Y-m-d H:i:s');
$query332 = "UPDATE usersapp set lastaccess = '$curr' where email ='$usr' ;";
$conn->query($query332);