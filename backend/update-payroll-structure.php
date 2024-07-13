<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$tid = $_POST['tid'];

$applydate = $_POST['applydate'];



// $mpoindex = $_POST['mpoindex'];
// $tin = $_POST['tin'];
// $thisjoin = $_POST['thisjoin'];
// $firstjoin = $_POST['firstjoin'];

/*
$paycode = $_POST['paycode'];
;
*/

$accno = $_POST['accno'];
$bname = $_POST['bname'];
$bbr = $_POST['bbr'];
$rno = $_POST['rno'];
$accno2 = $_POST['accno2'];
$bname2 = $_POST['bname2'];
$bbr2 = $_POST['bbr2'];
$rno2 = $_POST['rno2'];
$accno3 = $_POST['accno3'];
$bname3 = $_POST['bname3'];
$bbr3 = $_POST['bbr3'];
$rno3 = $_POST['rno3'];

$paycode = $_POST['paycode'];
$pscale = $_POST['pscale'];
$basic = $_POST['basic'];
$inten = $_POST['inten'];
$hra = $_POST['hra'];
$ma = $_POST['ma'];
$welfare = $_POST['welfare'];
$retire = $_POST['retire'];
$net = $_POST['net'];
$salary = $_POST['salary'];
$mpa = $_POST['mpa'];
$travel = $_POST['travel'];
$ma2 = $_POST['ma2'];
$pf = $_POST['pf'];
$net2 = $_POST['net2'];



$sql000 = "SELECT * FROM teacher_salary_structure where sccode='$sccode' and tid='$tid' and applydate='$applydate' ";
$resultix = $conn->query($sql000);
if ($resultix->num_rows == 0) {
    //insert
    $query33x = "INSERT INTO teacher_salary_structure (id, tid, sccode, applydate, 
                accno, bankname, branch, routing, accnosch, bnamesch, bbrsch, routesch, accnopf, bnamepf, bbrpf, routepf, 
                paycode, payscale, basic, incentive, house, medical, arrea, welfare, retire, netamtgovt, 
                salary, mobilevata, travel, medical2, exam, festival, pf, net2) 
                VALUES (NULL, '$tid', '$sccode', '$applydate', '$accno', '$bname', '$bbr', '$rno', 
                '$accno2', '$bname2', '$bbr2', '$rno2', '$accno3', '$bname3', '$bbr3', '$rno3', 
                '$paycode', '$pscale', '$basic', '$inten', '$hra', '$ma', '0', '$welfare', '$retire', '$net', 
                '$salary', '$mpa', '$travel', '$ma2', '0', '0', '$pf', '$net2');";
} else {
    $query33x = "update teacher_salary_structure set 
    paycode = '$paycode' ,
    accno = '$accno' , bankname = '$bname' , branch = '$bbr' , routing = '$rno' ,
    accnosch = '$accno2' , bnamesch = '$bname2' , bbrsch = '$bbr2' , routesch = '$rno2' ,
    accnopf = '$accno3' , bnamepf = '$bname3' , bbrpf = '$bbr3' , routepf = '$rno3' ,
    
    payscale='$pscale', basic = '$basic', incentive ='$inten', house ='$hra', medical='$ma', 
    welfare ='$welfare', retire='$retire', netamtgovt='$net',
    salary='$salary', mobilevata='$mpa', travel ='$travel', medical2 ='$ma2', pf='$pf', net2='$net2'

    where tid='$tid' and sccode='$sccode' and applydate='$applydate';";

}
echo $query33x;
$conn->query($query33x);


$query33 = "update teacher set 
    paycode = '$paycode' ,
    accno = '$accno' , bankname = '$bname' , branch = '$bbr' , routing = '$rno' ,
    accnosch = '$accno2' , bnamesch = '$bname2' , bbrsch = '$bbr2' , routesch = '$rno2' ,
    accnopf = '$accno3' , bnamepf = '$bname3' , bbrpf = '$bbr3' , routepf = '$rno3' ,
    
    payscale='$pscale', basic = '$basic', incentive ='$inten', house ='$hra', medical='$ma', 
    welfare ='$welfare', retire='$retire', netamtgovt='$net',
    salary='$salary', mobilevata='$mpa', travel ='$travel', medical2 ='$ma2', pf='$pf', net2='$net2'

    where tid='$tid' and sccode='$sccode';";
$conn->query($query33);

// echo $query33;
echo 'Update Successfully ';



