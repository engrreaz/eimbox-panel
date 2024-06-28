<?php
include '../inc2.php';
// GET FINANCE DATA *************************
$finlist = array();
$sql0x = "SELECT * FROM stfinance where partid='39'  and sccode='$sccode' and sessionyear LIKE '$sy%' and classname = 'six'  order by sectionname, rollno ;";
echo $sql0x . '<br>';
$result0xx2 = $conn->query($sql0x);
if ($result0xx2->num_rows > 0) {
    while ($row0x = $result0xx2->fetch_assoc()) {
        $finlist[] = $row0x;
    }
}
// echo '<pre>';
// print_r($finlist);
// echo '</pre>';


$stid = 1031872929;
$month = 2;
$idmon = $stid . $month;
$ind = array_search($stid, array_column($finlist, 'stid'));
$indx = array_search($idmon, array_column($finlist, 'idmon'));
echo $ind;
echo ' ***' . $indx;


if ($ind != '') {

}