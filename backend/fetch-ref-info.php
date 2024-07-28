<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$ref = $_POST['ref'];


$sql0 = "SELECT * FROM refbook where sccode='$sccode' and refno='$ref';";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
	while ($row5 = $result0->fetch_assoc()) {
		$id = $row5["id"];
		$partid = $row5["partid"];
		$month = $row5["month"];
		$year = $row5["year"];
		$title = $row5["title"];
		$descrip = $row5["descrip"];
		$refdate = $row5["date"];
	}
} else {
	$id = 0;
	$partid = 0;
	$month = 0;
	$year = 0;
	$title = '';
	$descrip = '';
	$refdate=$td;
}


$sql0 = "SELECT * FROM salarysummery where sccode='$sccode' and refno='$ref';";
$result02 = $conn->query($sql0);
if ($result02->num_rows > 0) {
	while ($row5 = $result02->fetch_assoc()) {
		$id2 = $row5["id"];
		$amt = $row5["amount"];
		$chqno = $row5["chequeno"];
		$accno = $row5["accno"];
	}
} else {
	$id2 = 0;
	$amt = 0;
	$chqno = '';
	$accno = '';
}

if($partid == 0) $partid = 5;

?>




<div id="a1" hidden><?php echo $month; ?></div>
<div id="a2" hidden><?php echo $year; ?></div>
<div id="a3" hidden><?php echo $title; ?></div>
<div id="a4" hidden><?php echo $descrip; ?></div>
<div id="a5" hidden><?php echo $chqno; ?></div>
<div id="a6" hidden><?php echo $accno; ?></div>
<div id="a7" hidden><?php echo $amt; ?></div>
<div id="a8" hidden><?php echo $partid; ?></div>
<div id="a9" hidden><?php echo $refdate; ?></div>