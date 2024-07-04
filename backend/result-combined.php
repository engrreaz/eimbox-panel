<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$year = $sessionyear = $_POST['year'];
$cn = $_POST['cls'];
$secname = $_POST['sec'];
$exam = $_POST['exam'];

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

$query334 = "UPDATE tabulatingsheet SET 
prevexam = '0', thisexam = '0', 
totalmarks = '0', avgrate = '0', gpa = '0', gla='0', totalfail='0'	, full_marks = '0',
ben_sub = '0', ben_obj = '0', ben_pra = '0', ben_ca = '0', ben_total = '0', ben_gp = '0', ben_gl = '0',
eng_sub = '0', eng_obj = '0', eng_pra = '0', eng_ca = '0', eng_total = '0', eng_gp = '0', eng_gl = '0',
totalgp = '0', totalsubject = '0', failsub = '0'
WHERE sessionyear='$sessionyear' and exam='$exam' and classname='$cn' and sectionname= '$secname'  ";
// echo $query334 . '<br>';
$conn->query($query334);

//************************************************************************************ END OF ATTENDANCE COUNT ********************************************

$sql22v = "SELECT * FROM sessioninfo where classname ='$cn' and sectionname='$secname' and sessionyear ='$sessionyear' and sccode = '$sccode' order by rollno";
$result22v = $conn->query($sql22v);
if ($result22v->num_rows > 0) {
    while ($row22v = $result22v->fetch_assoc()) {
        $stid = $row22v["stid"];
        $rollno = $row22v["rollno"];
        $fourth = $row22v["fourth_subject"];

        $sql22vr = "SELECT * from tabulatingsheet where  classname ='$cn' and sectionname='$secname' and sessionyear ='$sessionyear' and sccode = '$sccode' and stid='$stid' ";
        $result22vr = $conn->query($sql22vr);
        if ($result22vr->num_rows > 0) {
            while ($row22vr = $result22vr->fetch_assoc()) {
                $allfourth = $row22vr["allfourth"];
            }
        }

        $u1 = substr($allfourth, 0, 3) * 1;
        $u2 = substr($allfourth, 3, 3) * 1;
        $u3 = '';//substr($allfourth, 6, 3) * 1;
        $u4 = '';//substr($allfourth, 9, 3) * 1;

        //echo $stid;
        $ben_sub = 0;
        $ben_obj = 0;
        $ben_pra = 0;
        $ben_ca = 0;
        $ben_total = 0;
        $ben_gp = 0;
        $ben_gl = '';
        $eng_sub = 0;
        $eng_obj = 0;
        $eng_pra = 0;
        $eng_ca = 0;
        $eng_total = 0;
        $eng_gp = 0;
        $eng_gl = '';
        $ben_fullmarks = 0;
        $eng_fullmarks = 0;
        $sss = 0;
        $ooo = 0;
        $ppp = 0;
        $ccc = 0;
        $ssss = 0;
        $oooo = 0;
        $pppp = 0;
        $cccc = 0;


        $totalfullmarks = 0;
        $totalmarks = 0;
        $tfail = 0;
        $totalgp = 0;
        $totalsubject = 0;

        include 'result-count-total-avg.php';
        // echo '====' . $totalfullmarks . '************' . $totalsubject . '()()()<br>';
   

        $avgrate = $totalmarks * 100 / $totalfullmarks;
        if ($tfail == 0) {
            $gpa = $totalgp / $totalsubject;
            if ($gpa > 5) {
                $gpa = 5;
            }
            $sql22vnh = "SELECT * FROM gpa where gp<='$gpa' order by gp desc limit 0, 1  ";
            $result22vnh = $conn->query($sql22vnh);
            if ($result22vnh->num_rows > 0) {
                while ($row22vnh = $result22vnh->fetch_assoc()) {
                    $gla = $row22vnh["gl"];

                }
            }
        } else {
            $gla = 'F';
            $gpa = 0;
        }



        //update goes here...............................
        $tms = 0;
        $totaltotal = $totalmarks;


        $sql22vnhg = "SELECT totalmarks FROM tabulatingsheet where classname ='$cn' and sectionname='$secname' and sessionyear ='$sessionyear' and sccode = '$sccode' and rollno='$rollno' and exam='Half Yearly' ";
        $result22vnhg = $conn->query($sql22vnhg);
        if ($result22vnhg->num_rows > 0) {
            while ($row22vnhg = $result22vnhg->fetch_assoc()) {
                $tms = $row22vnhg["totalmarks"];
            }
        } else {
            $tms = 0;
        }


        $totaltotal = round(($totalmarks + $tms) / 2);



        //$fs = $u1 . $u2 . $u3 . $u4;
        
      
        
        

        $query334 = "UPDATE tabulatingsheet SET 
								prevexam = '$tms', thisexam = '$totalmarks', 
								totalmarks = '$totaltotal', avgrate = '$avgrate', gpa = '$gpa', gla='$gla', totalfail='$tfail'	, full_marks = '$totalfullmarks',
								ben_sub = '$ben_sub', ben_obj = '$ben_obj', ben_pra = '$ben_pra', ben_ca = '$ben_ca', ben_total = '$ben_total', ben_gp = '$ben_gp', ben_gl = '$ben_gl',
								eng_sub = '$eng_sub', eng_obj = '$eng_obj', eng_pra = '$eng_pra', eng_ca = '$eng_ca', eng_total = '$eng_total', eng_gp = '$eng_gp', eng_gl = '$eng_gl',
								totalgp = '$totalgp', totalsubject = '$totalsubject', failsub = '$fs'
								WHERE sessionyear='$sessionyear' and exam='$exam' and stid='$stid'  ";
        echo $query334 . '<br>';
  $conn->query($query334);
    }
}

