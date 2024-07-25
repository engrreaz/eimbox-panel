<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$month = $_POST['month'];
$year = $_POST['year'];
$slot = $_POST['slot'];
$category = $_POST['category'];

$month = date('m');
$year = date('Y');


$sql0 = "SELECT * FROM refbook where sccode='$sccode' and month='$month' and year = '$year' and slot='$slot' and category='$category' ;";
$result0 = $conn->query($sql0);
if ($result0->num_rows == 1) {
	while ($row5 = $result0->fetch_assoc()) {
		$id = $row5["id"];
		$refno = $row5["refno"];

	}
} else {
	$refno = 'Not found';
	$sql0 = "SELECT * FROM refbook where sccode='$sccode' order by refno desc LIMIT 1 ;";
	$result01 = $conn->query($sql0);
	if ($result01->num_rows > 0) {
		while ($row5 = $result01->fetch_assoc()) {
			$refno = $row5["refno"];
		}
	} else {
		$refno = '0/' . $sy;
	}

	$rrr = explode('/', $refno)[0]+1 . '/' . $sy;
	// echo $rrr;

	$sql0 = "SELECT * FROM financesetup where (sccode='$sccode' or sccode=0) and particulareng LIKE '%$category%' order by id  LIMIT 1 ;";
	$result02 = $conn->query($sql0);
	if ($result02->num_rows > 0) {
		while ($row5 = $result02->fetch_assoc()) {
			$partid = $row5["id"];
			$tit = $row5["particulareng"];
		}
	} else {
		$partid = 0;
		$tit = 'UNDEFINED';
	}

	$refno = $rrr;
	$ref = "INSERT INTO refbook (id, sccode, slot, sessionyear, refno, date, year, month, category, partid, title, descrip, module, dbtable, sqltext, entryby, entrytime) 
					VALUES (NULL, '$sccode', '$slot', '$sy', '$refno', '$td', '$year', '$month', '$category', '$partid', '$tit', '--', 'Payroll', 'salarysummery', '--', '$usr', '$cur');";
	// echo $ref;
	$conn->query($ref);

}

echo $refno;
