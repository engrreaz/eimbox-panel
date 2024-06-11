<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$classname = $_POST['classname'];
$sectionname = $_POST['sectionname'];
$rollno = $_POST['rollno'];
$stid = $_POST['stid'];
$stnameeng = $_POST['stnameeng'];
$stnameben = $_POST['stnameben'];
$fname = $_POST['fname'];
$fprof = $_POST['fprof'];
$fmobile = $_POST['fmobile'];
$mname = $_POST['mname'];
$mprof = $_POST['mprof'];
$mmobile = $_POST['mmobile'];
$previll = $_POST['previll'];
$prepo = $_POST['prepo'];
$preps = $_POST['preps'];
$predist = $_POST['predist'];
$pervill = $_POST['pervill'];
$perpo = $_POST['perpo'];
$perps = $_POST['perps'];
$perdist = $_POST['perdist'];

$fnid = $_POST['fnid'];
$mnid = $_POST['mnid'];

$photoid = $_POST['photoid'];
$dopp = '2000-12-31';

$dob2 = $_POST['dob'];
$dob2 = str_replace('/', '-', $dob2);
$dob = date('Y-m-d', strtotime($dob2));

$religion = $_POST['religion'];
$brn = $_POST['brn'];
$gender = $_POST['gender'];
$guarname = $_POST['guarname'];
$guaradd = $_POST['guaradd'];
$guarrelation = $_POST['guarrelation'];
$guarmobile = $_POST['guarmobile'];
$tcno = $_POST['tcno'];
$preins = $_POST['preins'];
$preinsadd = $_POST['preinsadd'];
$doa = $_POST['doa'];
$doa = date('y-m-d', strtotime($doa));

$sessionyear = $sy;

$sscyear = $_POST['sscyear'];
if($sscyear == '') $sscyear = '0';
$sscregd = $_POST['sscregd'];
$sscroll = $_POST['sscroll'];
$sscresult = $_POST['sscresult'];


$bgroup = $_POST['bgroup'];
$disables = $_POST['disables'];
$height = $_POST['height'];
$weight = $_POST['weight'];
if($height == '') $height = '0';
if($weight == '') $weight = '0';

$guarnid = $_POST['guarnid'];

if ($sscyear < 1900 && $sscresult>0) {
	$sscyear = $sy;
}


$sql0 = "SELECT * FROM students where stid='$stid' and sccode='$sccode'";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
	$query3 = "UPDATE students SET 
					stnameeng = '$stnameeng', 
					stnameben = '$stnameben', 
					fname = '$fname', 
					fprof = '$fprof', 
					fmobile = '$fmobile', 
					fnid = '$fnid',
					mname = '$mname', 
					mprof = '$mprof', 
					mmobile = '$mmobile',
					mnid = '$mnid',
					
					previll = '$previll', 
					prepo = '$prepo', 
					preps = '$preps', 
					predist = '$predist',
					
					pervill = '$pervill', 
					perpo = '$perpo', 
					perps = '$perps', 
					perdist = '$perdist',
					
					dob = '$dob', 
					religion = '$religion', 
					brn = '$brn', 
					gender = '$gender',
					
					guarname = '$guarname', 
					guaradd = '$guaradd', 
					guarrelation = '$guarrelation', 
					guarmobile = '$guarmobile',
					
					tcno = '$tcno', 
					preins = '$preins', 
					preinsadd = '$preinsadd', 
					doa = '$doa',
					modify = '$td',
					photo_id = '$photoid',
					photo_pick_date = '$dopp',

					sscpassyear = '$sscyear',
					regdno = '$sscregd',
					rollno = '$sscroll',
					gpa = '$sscresult',
					bgroup = '$bgroup',
					height = '$height',
					weight = '$weight',
					disables = '$disables',
					guarnid = '$guarnid'

		WHERE stid='$stid' and sccode='$sccode'";
	// echo $query3;
} else {
	$query33 = "insert into sessioninfo
				(id, stid, sessionyear, classname, sectionname, rollno, sccode)
		values 	(NULL, '$stid', '$sessionyear','$classname', '$sectionname', '$rollno','$sccode'				
							)";
	$conn->query($query33);

	$query3 = "insert into students
				(id, sccode, stid, stnameeng, stnameben, fname, fprof, fmobile, mname, mprof, mmobile, previll, prepo, preps, predist, pervill, perpo, perps, perdist, 
				dob, religion, brn, gender, guarname, guaradd, guarrelation, guarmobile, tcno, preins, preinsadd, doa, modify, photo_id, photo_pick_date, fnid, mnid,
				bgroup, height, weight, disables, guarnid)
		values 	(NULL, '$sccode','$stid','$stnameeng','$stnameben','$fname','$fprof','$fmobile','$mname','$mprof','$mmobile',
							'$previll','$prepo','$preps','$predist','$pervill','$perpo','$perps','$perdist',
							'$dob','$religion','$brn','$gender','$guarname','$guaradd','$guarrelation','$guarmobile','$tcno','$preins','$preinsadd','$doa', '$td', '$photoid', '$dopp', '$fnid', '$mnid'	,
							'$bgroup', '$height', '$weight', '$disables', '$guarnid')";
}


if ($conn->query($query3) === TRUE) {
	//echo "Data Submitted succesfully";
	// include ('cuslist.php');
	?>

	<div id="lastadd" style="display:none;">
		<span id="vill"><?php echo $previll; ?></span>
		<span id="po"><?php echo $prepo; ?></span>
		<span id="ps"><?php echo $preps; ?></span>
		<span id="dist"><?php echo $predist; ?></span>
	</div>

	<?php
} else {
	echo "Error Submitting Data. Please Try Again.";
}

?>