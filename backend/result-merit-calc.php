<?php
date_default_timezone_set('Asia/Dhaka');
include 'inc2.php';

$year = $sessionyear = $_POST['year'];
$cn = $_POST['cls'];
$secname = $_POST['sec'];
$exam = $_POST['exam'];

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//************************************************************************************ END OF ATTENDANCE COUNT ********************************************

$mp = 1;
$sql22vnp = "SELECT * FROM tabulatingsheet where classname = '$cn'  and sessionyear ='$sessionyear' and exam='$exam' and sccode='$sccode' and sectionname='$secname' order by totalfail, thisexam desc;";
echo $sql22vnp;

$result22vnp = $conn->query($sql22vnp);
if ($result22vnp->num_rows > 0) {
    while ($row22vnp = $result22vnp->fetch_assoc()) {
        $tf = $row22vnp["totalfail"];
        $tm = $row22vnp["totalmarks"];
        $stid = $row22vnp["stid"];

        $sql22vnhx = "SELECT * FROM meritlist where numplace = '$mp'   ";
        $result22vnhx = $conn->query($sql22vnhx);
        if ($result22vnhx->num_rows > 0) {
            while ($row22vnhx = $result22vnhx->fetch_assoc()) {
                $mpla = $row22vnhx["meritplace"];
            }
        }

        // $sql22vnhxc = "SELECT sum(yn) as attcnt FROM stattnd  where  sccode = '$sccode' and yn='1' and adate between '$efrom' and '$eto' and stid='$stid'";
        // $result22vnhxc = $conn->query($sql22vnhxc);
        // if ($result22vnhxc->num_rows > 0) {
        //     while ($row22vnhxc = $result22vnhxc->fetch_assoc()) {
        //         $upo = $row22vnhxc["attcnt"];
        //     }
        // } else {
        //     $upo = 0;
        // }

        $twday = $upo = 0;
        $query3348 = "UPDATE tabulatingsheet SET 
								meritplace = '$mpla' , twday = '$twday'	, attnd = '$upo'							
								WHERE sessionyear='$sessionyear' and exam='$exam' and stid='$stid'  "; //echo $query3348;
        $conn->query($query3348);

        echo $query3348;
        echo '<br><br>';
        $mp = $mp + 1;
    }
}