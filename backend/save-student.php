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

$photoid = $_POST['photoid'];
$dopp = $_POST['dopp'];

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


$sql0 = "SELECT * FROM students where stid='$stid' and sccode='$sccode'";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    $query3 = "UPDATE students SET 
					stnameeng = '$stnameeng', 
					stnameben = '$stnameben', 
					fname = '$fname', 
					fprof = '$fprof', 
					fmobile = '$fmobile', 
					mname = '$mname', 
					mprof = '$mprof', 
					mmobile = '$mmobile',
					
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
					photo_pick_date = '$dopp'
		WHERE stid='$stid' and sccode='$sccode'";
} else {
    $query33 = "insert into sessioninfo
				(id, stid, sessionyear, classname, sectionname, rollno, sccode)
		values 	(NULL, '$stid', '$sessionyear','$classname', '$sectionname', '$rollno','$sccode'				
							)";
    if ($conn->query($query33) === TRUE) {
    }

    $query3 = "insert into students
				(id, sccode, stid, stnameeng, stnameben, fname, fprof, fmobile, mname, mprof, mmobile, previll, prepo, preps, predist, pervill, perpo, perps, perdist, dob, religion, brn, gender, guarname, guaradd, guarrelation, guarmobile, tcno, preins, preinsadd, doa, modify, photo_id, photo_pick_date)
		values 	(NULL, '$sccode','$stid','$stnameeng','$stnameben','$fname','$fprof','$fmobile','$mname','$mprof','$mmobile',
							'$previll','$prepo','$preps','$predist','$pervill','$perpo','$perps','$perdist',
							'$dob','$religion','$brn','$gender','$guarname','$guaradd','$guarrelation','$guarmobile','$tcno','$preins','$preinsadd','$doa', '$dt', '$photoid', '$dopp'
							
							)";
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
