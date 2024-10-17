<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');


$tail = $_POST['tail'];

if ($tail == 1) {
    $task = $_POST['task'];
    $query331 = "INSERT INTO todolist (id, sccode, date, user, todotype, descrip1, descrip2, status, creationtime, response, responsetxt, responsetime, modifieddate) 
                VALUES (NULL, '$sccode', '$td', '$usr', '',  '$task', '', '0', '$cur', NULL, NULL, NULL, NULL);";
}


$conn->query($query331);