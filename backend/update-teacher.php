<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$tid = $_POST['tid'];

$tnamee = $_POST['tnamee'];
$tnameb = $_POST['tnameb'];
$des = $_POST['des'];
$slot = $_POST['slot'];
$subj = $_POST['subj'];
$gender = $_POST['gender'];
$mob = $_POST['mob'];
$email = $_POST['email'];


$nid = $_POST['nid'];
$dob = $_POST['dob'];
$religion = $_POST['religion'];
$bgroup = $_POST['bgroup'];

$fname = $_POST['fname'];
$mname = $_POST['mname'];
$sname = $_POST['sname'];
$emergency = $_POST['emergency'];

$previll = $_POST['previll'];
$prepo = $_POST['prepo'];
$preps = $_POST['preps'];
$predist = $_POST['predist'];
$pervill = $_POST['pervill'];
$perpo = $_POST['perpo'];
$perps = $_POST['perps'];
$perdist = $_POST['perdist'];

$mpoindex = $_POST['mpoindex'];
$tin = $_POST['tin'];
$thisjoin = $_POST['thisjoin'];
$firstjoin = $_POST['firstjoin'];

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


$sql0 = "SELECT * FROM designation  where title='$des'";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $rnk = $row0["ranks"];
    }
}

$query33 = "update teacher set 
    tname = '$tnamee', tnameb = '$tnameb', position = '$des', slots = '$slot', subjects = '$subj', gender = '$gender', mobile = '$mob', email = '$email', ranks='$rnk',
    nid='$nid', dob = '$dob', religion = '$religion', bgroup  = '$bgroup',
    fname = '$fname', mname = '$mname', spouse = '$sname', emergency = '$emergency', 
    previll = '$previll', prepo = '$prepo', preps = '$preps', predist = '$predist', 
    pervill = '$pervill', perpo = '$perpo', perps = '$perps', perdist = '$perdist', 
    mpoindex='$mpoindex', tin = '$tin',  fjdate='$firstjoin', jdate='$thisjoin',

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


