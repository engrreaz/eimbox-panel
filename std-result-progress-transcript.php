<?php
date_default_timezone_set('Asia/Dhaka');
include('inc2.php');

// $tsheetid = 

$sessionyear = $sy;

$sql0 = "SELECT * FROM tabulatingsheet where sccode='$sccode' and id='$tsheetid' order by id desc limit 1;";
$result0a = $conn->query($sql0);
if ($result0a->num_rows > 0) {
    while ($row5 = $result0a->fetch_assoc()) {
        $stid = $row5['stid'];
        $sy = $row5['sessionyear'];

    }
}

$sql0 = "SELECT * FROM sessioninfo where sccode='$sccode' and stid='$stid' and sessionyear='$sy'  order by id desc limit 1;";
$result0b = $conn->query($sql0);
if ($result0b->num_rows > 0) {
    while ($row5 = $result0b->fetch_assoc()) {
        $cn = $row5['classname'];
        $secname = $row5['sectionname'];
        $rollno = $row5['rollno'];
    }
}

// $tsheet = array();
// $sql0 = "SELECT * FROM tabulatingsheet where sccode='$sccode' and id='$tsheetid' order by id desc limit 1;";
// $result0 = $conn->query($sql0);
// if ($result0->num_rows > 0) {
//     while ($row5 = $result0->fetch_assoc()) {
//         $tsheet[] = $row5;
//     }
// }

?>



<style>
    #trans tr,
    #trans td {
        border: 1px solid black;
        padding: 2px;
    }

    #gsys tr,
    #gsys td {
        border: 1px solid black;
    }
</style>

<?php

$sql0x2 = "SELECT * from areas where areaname='$cn' and subarea = '$secname' and sessionyear = '$sy' and user='$rootuser'";
$result0x2 = $conn->query($sql0x2);
if ($result0x2->num_rows > 0) {
    while ($row0x2 = $result0x2->fetch_assoc()) {
        $ctid = $row0x2["classteacher"];
    }
}

$sql0x2vr = "SELECT * from teacher where sccode='$sccode' and tid='$ctid'";
$result0x2vr = $conn->query($sql0x2vr);
if ($result0x2vr->num_rows > 0) {
    while ($row0x2vr = $result0x2vr->fetch_assoc()) {
        $cteacher = $row0x2vr["tname"];
    }
}


$sql0x2v = "SELECT * from teacher where sccode='$sccode' and (position='Head Teacher' or position='Principal')";
$result0x2v = $conn->query($sql0x2v);
if ($result0x2v->num_rows > 0) {
    while ($row0x2v = $result0x2v->fetch_assoc()) {
        $hname = $row0x2v["tname"];
        $hpos = $row0x2v["position"];
        $htid = $row0x2v["tid"];
    }
}



$sql00011a = "SELECT * FROM users where eiin='$sccode' and user_level='100' ";
$result00011a = $conn->query($sql00011a);
if ($result00011a->num_rows > 0) {
    while ($row00011a = $result00011a->fetch_assoc()) {
        //$einame=$row00011a["einame"]; $eiaddress=$row00011a["eiaddress"]; $eicontact=$row00011a["eicontact"]; 



        $fullname = $row00011a["fullname"];
        $user_group = $row00011a["user_group"];

    }
}
$einame = $scname;
$eiaddress = $scadd2 . ', ' . $ps . ', ' . $dist;
$eicontact = $mobile;

// $sql0001 = "SELECT * FROM sessioninfo where sccode='$sccode' and classname='$cn'  and sectionname='$secname' and sessionyear = '$sessionyear'  order by rollno";
$sql0001 = "SELECT * FROM sessioninfo where sccode='$sccode' and classname='$cn'  and sectionname='$secname' and sessionyear = '$sessionyear' and stid='$stid'  order by rollno";
$result0001 = $conn->query($sql0001);
$num = mysqli_num_rows($result0001);
$run = 0;

if ($result0001->num_rows > 0) {
    while ($row0001 = $result0001->fetch_assoc()) {
        $run++;
        if ($num == $run) {
            $lastpad = '0mm';
        } else {
            $lastpad = '20mm';
        }
        $rollno = $row0001["rollno"];



        $stid = $row0001["stid"];
        $fourth = $row0001["fourth_subject"];


        $sql00011 = "SELECT * FROM students where stid='$stid' ";
        $result00011 = $conn->query($sql00011);
        if ($result00011->num_rows > 0) {
            while ($row00011 = $result00011->fetch_assoc()) {
                $stnameeng = $row00011["stnameeng"];
                $stnameben = $row00011["stnameben"];
                $fname = $row00011["fname"];
                $mname = $row00011["mname"];
                $gender = $row00011["gender"];
                $tcno = $row00011["preins"];
                if ($gender == 'Boy') {
                    $lingo = 'S/O';
                } else {
                    $lingo = 'D/O';
                }
            }
        }



        $sql000111 = "SELECT * FROM tabulatingsheet where exam='$exam' and classname='$cn'  and sectionname = '$secname' and sessionyear = '$sessionyear' and stid='$stid' ";
        $sql000111 = "SELECT * FROM tabulatingsheet where id='$tsheetid' and stid='$stid' ";
        // echo $sql000111;
        $result000111 = $conn->query($sql000111);
        if ($result000111->num_rows > 0) {
            while ($row000111 = $result000111->fetch_assoc()) {
                $sub_1 = $row000111["sub_1"];
                $sub_1_sub = $row000111["sub_1_sub"];
                $sub_1_obj = $row000111["sub_1_obj"];
                $sub_1_pra = $row000111["sub_1_pra"];
                $sub_1_ca = $row000111["sub_1_ca"];
                $sub_1_total = $row000111["sub_1_total"];
                $sub_1_gp = $row000111["sub_1_gp"];
                $sub_1_gl = $row000111["sub_1_gl"];
                $sub_2 = $row000111["sub_2"];
                $sub_2_sub = $row000111["sub_2_sub"];
                $sub_2_obj = $row000111["sub_2_obj"];
                $sub_2_pra = $row000111["sub_2_pra"];
                $sub_2_ca = $row000111["sub_2_ca"];
                $sub_2_total = $row000111["sub_2_total"];
                $sub_2_gp = $row000111["sub_2_gp"];
                $sub_2_gl = $row000111["sub_2_gl"];
                $sub_3 = $row000111["sub_3"];
                $sub_3_sub = $row000111["sub_3_sub"];
                $sub_3_obj = $row000111["sub_3_obj"];
                $sub_3_pra = $row000111["sub_3_pra"];
                $sub_3_ca = $row000111["sub_3_ca"];
                $sub_3_total = $row000111["sub_3_total"];
                $sub_3_gp = $row000111["sub_3_gp"];
                $sub_3_gl = $row000111["sub_3_gl"];
                $sub_4 = $row000111["sub_4"];
                $sub_4_sub = $row000111["sub_4_sub"];
                $sub_4_obj = $row000111["sub_4_obj"];
                $sub_4_pra = $row000111["sub_4_pra"];
                $sub_4_ca = $row000111["sub_4_ca"];
                $sub_4_total = $row000111["sub_4_total"];
                $sub_4_gp = $row000111["sub_4_gp"];
                $sub_4_gl = $row000111["sub_4_gl"];
                $sub_5 = $row000111["sub_5"];
                $sub_5_sub = $row000111["sub_5_sub"];
                $sub_5_obj = $row000111["sub_5_obj"];
                $sub_5_pra = $row000111["sub_5_pra"];
                $sub_5_ca = $row000111["sub_5_ca"];
                $sub_5_total = $row000111["sub_5_total"];
                $sub_5_gp = $row000111["sub_5_gp"];
                $sub_5_gl = $row000111["sub_5_gl"];
                $sub_6 = $row000111["sub_6"];
                $sub_6_sub = $row000111["sub_6_sub"];
                $sub_6_obj = $row000111["sub_6_obj"];
                $sub_6_pra = $row000111["sub_6_pra"];
                $sub_6_ca = $row000111["sub_6_ca"];
                $sub_6_total = $row000111["sub_6_total"];
                $sub_6_gp = $row000111["sub_6_gp"];
                $sub_6_gl = $row000111["sub_6_gl"];
                $sub_7 = $row000111["sub_7"];
                $sub_7_sub = $row000111["sub_7_sub"];
                $sub_7_obj = $row000111["sub_7_obj"];
                $sub_7_pra = $row000111["sub_7_pra"];
                $sub_7_ca = $row000111["sub_7_ca"];
                $sub_7_total = $row000111["sub_7_total"];
                $sub_7_gp = $row000111["sub_7_gp"];
                $sub_7_gl = $row000111["sub_7_gl"];
                $sub_8 = $row000111["sub_8"];
                $sub_8_sub = $row000111["sub_8_sub"];
                $sub_8_obj = $row000111["sub_8_obj"];
                $sub_8_pra = $row000111["sub_8_pra"];
                $sub_8_ca = $row000111["sub_8_ca"];
                $sub_8_total = $row000111["sub_8_total"];
                $sub_8_gp = $row000111["sub_8_gp"];
                $sub_8_gl = $row000111["sub_8_gl"];
                $sub_9 = $row000111["sub_9"];
                $sub_9_sub = $row000111["sub_9_sub"];
                $sub_9_obj = $row000111["sub_9_obj"];
                $sub_9_pra = $row000111["sub_9_pra"];
                $sub_9_ca = $row000111["sub_9_ca"];
                $sub_9_total = $row000111["sub_9_total"];
                $sub_9_gp = $row000111["sub_9_gp"];
                $sub_9_gl = $row000111["sub_9_gl"];

                $sub_10 = $row000111["sub_10"];
                $sub_10_sub = $row000111["sub_10_sub"];
                $sub_10_obj = $row000111["sub_10_obj"];
                $sub_10_pra = $row000111["sub_10_pra"];
                $sub_10_ca = $row000111["sub_10_ca"];
                $sub_10_total = $row000111["sub_10_total"];
                $sub_10_gp = $row000111["sub_10_gp"];
                $sub_10_gl = $row000111["sub_10_gl"];

                $sub_11 = $row000111["sub_11"];
                $sub_11_sub = $row000111["sub_11_sub"];
                $sub_11_obj = $row000111["sub_11_obj"];
                $sub_11_pra = $row000111["sub_11_pra"];
                $sub_11_ca = $row000111["sub_11_ca"];
                $sub_11_total = $row000111["sub_11_total"];
                $sub_11_gp = $row000111["sub_11_gp"];
                $sub_11_gl = $row000111["sub_11_gl"];

                $sub_12 = $row000111["sub_12"];
                $sub_12_sub = $row000111["sub_12_sub"];
                $sub_12_obj = $row000111["sub_12_obj"];
                $sub_12_pra = $row000111["sub_12_pra"];
                $sub_12_ca = $row000111["sub_12_ca"];
                $sub_12_total = $row000111["sub_12_total"];
                $sub_12_gp = $row000111["sub_12_gp"];
                $sub_12_gl = $row000111["sub_12_gl"];


                $sub_13 = $row000111["sub_13"];
                $sub_13_sub = $row000111["sub_13_sub"];
                $sub_13_obj = $row000111["sub_13_obj"];
                $sub_13_pra = $row000111["sub_13_pra"];
                $sub_13_ca = $row000111["sub_13_ca"];
                $sub_13_total = $row000111["sub_13_total"];
                $sub_13_gp = $row000111["sub_13_gp"];
                $sub_13_gl = $row000111["sub_13_gl"];

                $sub_14 = $row000111["sub_14"];
                $sub_14_sub = $row000111["sub_14_sub"];
                $sub_14_obj = $row000111["sub_14_obj"];
                $sub_14_pra = $row000111["sub_14_pra"];
                $sub_14_ca = $row000111["sub_14_ca"];
                $sub_14_total = $row000111["sub_14_total"];
                $sub_14_gp = $row000111["sub_14_gp"];
                $sub_14_gl = $row000111["sub_14_gl"];

                $sub_15 = $row000111["sub_15"];
                $sub_15_sub = $row000111["sub_15_sub"];
                $sub_15_obj = $row000111["sub_15_obj"];
                $sub_15_pra = $row000111["sub_15_pra"];
                $sub_15_ca = $row000111["sub_15_ca"];
                $sub_15_total = $row000111["sub_15_total"];
                $sub_15_gp = $row000111["sub_15_gp"];
                $sub_15_gl = $row000111["sub_15_gl"];

                $ben_sub = $row000111["ben_sub"];
                $ben_obj = $row000111["ben_obj"];
                $ben_pra = $row000111["ben_pra"];
                $ben_ca = $row000111["ben_ca"];
                $ben_total = $row000111["ben_total"];
                $ben_gp = $row000111["ben_gp"];
                $ben_gl = $row000111["ben_gl"];



                $eng_sub = $row000111["eng_sub"];
                $eng_obj = $row000111["eng_obj"];
                $eng_pra = $row000111["eng_pra"];
                $eng_ca = $row000111["eng_ca"];
                $eng_total = $row000111["eng_total"];
                $eng_gp = $row000111["eng_gp"];
                $eng_gl = $row000111["eng_gl"];

                $totalmarks = $row000111["totalmarks"];
                $fullmarks = $row000111["full_marks"];
                $avgrate = $row000111["avgrate"];
                $gpa = $row000111["gpa"];
                $gla = $row000111["gla"];
                $meritplace = $row000111["meritplace"];
                $totalfail = $row000111["totalfail"];

                $prevexam = $row000111["prevexam"];
                $thisexam = $row000111["thisexam"];


            }
        } else {
            echo 'data not found';
        }
        //echo $sql000111;
        ?>
        <?php if ($run > 1) {
            echo '<div style="height:0mm;"></div>';
        } ?>
        <div
            style="border:0; background-image: url('https://eimbox.com/transcript/4444.png'); height:290mm;background-size:220mm; page-break-after:always;">
            <div style="padding:8mm 8mm;">

                <table border="0" valign="top" style="border-collapse:collapse; width:193mm; height:270mm; ">
                    <tr>

                        <td valign="top">

                            <div style="height:40mm">
                                <center>
                                    <img src="https://eimbox.com/logo/<?php echo $sccode; ?>.png" width="70px"
                                        style="background-image: url('/images/no-image.png') ;  padding:2px 0 3px 0; margin-bottom:7px;"
                                        onerror="this.onerror=null; this.src='http://www.eimbox.com/images/no-image.png';" />
                                    <br>
                                    <span
                                        style="font-family:segoe ui; font-size:24px; font-weight:bold;"><?php echo $einame; ?></span><br>
                                    <?php echo $eiaddress . "<br>Contact : " . $eicontact; ?>

                                </center>
                            </div>


                            <?php
                            //************************************************************************************************* HEADING..........................................
                    
                            if ($cn == 'Ten') {
                                if ($exam == 'Half Yearly') {
                                    $examt = 'Pre-Test';
                                } else {
                                    $examt = 'Test';
                                }
                            } else {
                                $examt = $exam;
                            }
                            ?>
                            <center>
                                <h4 style=" line-height:28px;"><b><span style="color: #4286f4 !important;">P R O G R E S S
                                            &nbsp;&nbsp;&nbsp;&nbsp; R E P O R T</span></b></h4>
                                <b>
                                    <div style="color: #2c7a64 !important; line-height:12px;">Exam :
                                        <?php echo $examt . ' Examination - ' . $sessionyear; ?>
                                    </div>
                                </b>
                            </center>


                            <table>
                                <tr>
                                    <td width="600px">
                                        <span style="font-size:10px;">Student's Info</span><br>
                                        <b><span
                                                style="font-size:20px; color: #9900cc !important"><?php echo $stnameeng . '<br>' . $stnameben; ?></span></b><br>
                                        <span
                                            style="font-size:12px; "><?php echo $lingo . ' : ' . $fname . ' & ' . $mname; ?></span><br>

                                        <span style="font-size:12px; font-weight:bold;">ID # <?php echo $stid; ?></span>
                                        <br><br><br>


                                        Class : <b><?php echo $cn; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Group : <b><?php echo $secname; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Roll No. : <b>
                                            <?php

                                            //echo $sccode . $cn.$secname;
                                    
                                            echo $rollno;
                                            //echo $tcno;
                                            ?>
                                        </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    </td>

                                    <td width="120px" align="right">
                                        <br>
                                        <img src="https://eimbox.com/students/<?php echo $stid; ?>.jpg" width="100px"
                                            style="background-image: url('/images/no-image.png') ; border:1px solid black ; padding:3px; margin-bottom:10px;"
                                            onerror="this.onerror=null; this.src='http://www.eimbox.com/images/no-image.png';" />
                                    </td>
                                    <td width="10px"></td>
                                    <td width="120px">
                                        <center><span style="font-size:10px">Grading System</span></center>
                                        <table id="gsys" border="1" width="100%"
                                            style="color:#1c702c; border-collapse:collapse;">
                                            <tr>
                                                <td colspan="2" align="center" style="font-size:9px; font-weight:bold;">Grade
                                                </td>
                                                <td align="center" style="font-size:9px; font-weight:bold;">Marks Range</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size:9px;">A+</td>
                                                <td align="center" style="font-size:9px;">5.00</td>
                                                <td align="center" style="font-size:9px;">80+</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size:9px;">A</td>
                                                <td align="center" style="font-size:9px;">4.00</td>
                                                <td align="center" style="font-size:9px;">70 - 79</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size:9px;">A-</td>
                                                <td align="center" style="font-size:9px;">3.50</td>
                                                <td align="center" style="font-size:9px;">60 - 69</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size:9px;">B</td>
                                                <td align="center" style="font-size:9px;">3.00</td>
                                                <td align="center" style="font-size:9px;">50 - 59</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size:9px;">C</td>
                                                <td align="center" style="font-size:9px;">2.00</td>
                                                <td align="center" style="font-size:9px;">40 - 49</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size:9px;">D</td>
                                                <td align="center" style="font-size:9px;">1.00</td>
                                                <td align="center" style="font-size:9px;">33 - 39</td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="font-size:9px;">F</td>
                                                <td align="center" style="font-size:9px;">0.00</td>
                                                <td align="center" style="font-size:9px;">0 - 32</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <style>
                                .mag {
                                    text-align: center;
                                    font-weight: bold;
                                    padding: 7px 0px;
                                }
                            </style>

                            <table id="trans" border="1" width="100%"
                                style="border-collapse:collapse; -webkit-print-color-adjust: exact; border:1px black solid !important; font-family:segoe UI;">
                                <tr height="10px">
                                    <td width="300px" class="mag" rowspan="2">
                                        <center>Subjects
                                            <br><span style="font-size:9px; font-weight:normal; color:red;">with full marks in
                                                bracket</span>
                                        </center>
                                    </td>
                                    <td width="50px" class="mag" colspan="6">Marks Obtained</td>
                                    <td width="200px" class="mag" rowspan="2">
                                        <center>Result</center>
                                    </td>
                                </tr>
                                <tr height="15px">

                                    <td width="50px" class="mag">SUB</td>
                                    <td width="50px" class="mag">OBJ</td>
                                    <td width="50px" class="mag">PRA</td>
                                    <td width="50px" class="mag">TOT</td>
                                    <td width="50px" class="mag">GP</td>
                                    <td width="50px" class="mag">GL</td>

                                </tr>
                                <?php
                                if ($sub_1 == 101 || $sub_1 == 103) {
                                    if ($sub_1_gp == 0) {
                                        $cl = 'red';
                                    } else if ($sub_1_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php
                                        $sql000 = "SELECT * FROM subjects where subcode='$sub_1' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        }
                                        if ($cn == 'Eight') {
                                            $subs = 'Bengali';
                                        }

                                        $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_1' and sessionyear='$sessionyear'  ";
                                        $result000t = $conn->query($sql000t);
                                        if ($result000t->num_rows > 0) {
                                            while ($row000t = $result000t->fetch_assoc()) {
                                                $subsfm = $row000t["fullmarks"];
                                            }
                                        }

                                        echo $subs;// . ' <b>[' . $subsfm . ']</b>' 
                                        ; ?></td>
                                        <td style="text-align:center"><?php echo $sub_1_sub; ?></td>
                                        <td style="text-align:center"><?php echo $sub_1_obj; ?></td>
                                        <td style="text-align:center"><?php echo $sub_1_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_1_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_1_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_1_gl; ?></span></td>

                                        <?php

                                        $sql00011ax = "SELECT count(*) as tsub FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname'  and sessionyear='$sessionyear' ";
                                        $result00011axd = $conn->query($sql00011ax);
                                        if ($result00011axd->num_rows > 0) {
                                            while ($row00011ax = $result00011axd->fetch_assoc()) {
                                                $rowspan = $row00011ax["tsub"];
                                            }
                                        }


                                        $sql00011ax = "SELECT * FROM gpa where gl='$gla'  ";
                                        $result00011ax = $conn->query($sql00011ax);
                                        if ($result00011ax->num_rows > 0) {
                                            while ($row00011ax = $result00011ax->fetch_assoc()) {
                                                $remark = $row00011ax["remark"];
                                                $colorcode = $row00011ax["colorcode"];
                                            }
                                        }
                                        $clc = '#' . $colorcode;
                                        //echo $clc;
                                        //if($gpa == 0){$clc = 'red';} else if ($gpa == 5){$clc = 'green';} else {$clc = 'black';}
                            
                                        if ($cn == 'Nine' || $cn == 'Ten') {
                                            $rowspan = $rowspan + 2;
                                        }

                                        if ($cn == 'Eight') {
                                            $fullmarks = 650;
                                        }
                                        ?>

                                        <style>
                                            .ttb tr td {
                                                border: 1px solid;
                                                gray;
                                            }

                                            .desc {
                                                font-size: 11px;
                                                padding: 2px;
                                            }

                                            .mark {
                                                font-size: 15px;
                                                padding: 2px;
                                            }

                                            .mark b,
                                            .desc b {
                                                color: #990000;
                                            }
                                        </style>
                                        <td rowspan="<?php echo $rowspan; ?>"
                                            style="padding:10px 0 10px 0; border-bottom:1px black solid;">
                                            <center>
                                                <small>Total Marks<br>Obtained</small><br>
                                                <span
                                                    style="font-size:22px; font-weight:bold; color:#cc4400 !important;"><?php echo $thisexam; ?></span>
                                                <br><span style="font-size:10px; ">Out Of
                                                    <?php echo '1300'; //$fullmarks; ?></span><br><br>

                                                <br>Average Achievement<br>
                                                <b><?php echo $avgrate . '%'; ?></b>
                                                <hr width="80%" style="border:1px solid black">

                                                <!--
                                                        Total Working Days<br>
                                                        ........... / 100 days.</b><hr width="80%" style="border:1px solid black">
                                                        -->

                                                Result<br>
                                                <b><span
                                                        style="color:<?php echo $clc; ?> !important;"><?php echo $gpa . ' : ' . $gla; ?></span></b><br>
                                                <strong><span
                                                        style="color:<?php echo $clc; ?> !important;"><?php echo $remark; ?></span></strong>
                                                <hr width="80%" style="border:1px solid black">

                                                <?php
                                                if ($gpa == 0) {
                                                    $ppp = 'Place';
                                                } else {
                                                    $ppp = 'Merit Place';
                                                }
                                                echo $ppp;
                                                ?>
                                                <br>
                                                <span
                                                    style="color:blue !important; font-size:20px; font-weight:bold;"><?php echo $meritplace; ?></span>

                                                <br>
                                            </center>
                                        </td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($sub_2 == 102) {
                                    if ($sub_2_gp == 0) {
                                        $cl = 'red';
                                    } else if ($sub_2_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php
                                        $sql000 = "SELECT * FROM subjects where subcode='$sub_2' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        }

                                        $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_2'  and sessionyear='$sessionyear'";
                                        $result000t = $conn->query($sql000t);
                                        if ($result000t->num_rows > 0) {
                                            while ($row000t = $result000t->fetch_assoc()) {
                                                $subsfm = $row000t["fullmarks"];
                                            }
                                        }

                                        echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                        <td style="text-align:center"><?php echo $sub_2_sub; ?></td>
                                        <td style="text-align:center"><?php echo $sub_2_obj; ?></td>
                                        <td style="text-align:center"><?php echo $sub_2_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_2_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_2_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_2_gl; ?></span></td>

                                    </tr>
                                    <?php
                                }
                                ?>

                                <?php
                                if ($sub_2 == 102) {
                                    if ($ben_gp == 0) {
                                        $cl = 'red';
                                    } else if ($ben_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><b>Bengali</b></td>
                                        <td style="text-align:center"><?php echo $ben_sub; ?></td>
                                        <td style="text-align:center"><?php echo $ben_obj; ?></td>
                                        <td style="text-align:center"><?php echo $ben_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $ben_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $ben_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $ben_gl; ?></span></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($sub_3 == 107) {
                                    if ($sub_3_gp == 0) {
                                        $cl = 'red';
                                    } else if ($sub_3_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php
                                        $sql000 = "SELECT * FROM subjects where subcode='$sub_3' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        }
                                        $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_3'  and sessionyear='$sessionyear'";
                                        $result000t = $conn->query($sql000t);
                                        if ($result000t->num_rows > 0) {
                                            while ($row000t = $result000t->fetch_assoc()) {
                                                $subsfm = $row000t["fullmarks"];
                                            }
                                        }

                                        echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                        <td style="text-align:center"><?php echo $sub_3_sub; ?></td>
                                        <td style="text-align:center"><?php echo $sub_3_obj; ?></td>
                                        <td style="text-align:center"><?php echo $sub_3_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_3_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_3_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_3_gl; ?></span></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($sub_4 == 108) {
                                    if ($sub_4_gp == 0) {
                                        $cl = 'red';
                                    } else if ($sub_4_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php
                                        $sql000 = "SELECT * FROM subjects where subcode='$sub_4' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        }
                                        $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_4'  and sessionyear='$sessionyear'";
                                        $result000t = $conn->query($sql000t);
                                        if ($result000t->num_rows > 0) {
                                            while ($row000t = $result000t->fetch_assoc()) {
                                                $subsfm = $row000t["fullmarks"];
                                            }
                                        }

                                        echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                        <td style="text-align:center"><?php echo $sub_4_sub; ?></td>
                                        <td style="text-align:center"><?php echo $sub_4_obj; ?></td>
                                        <td style="text-align:center"><?php echo $sub_4_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_4_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_4_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_4_gl; ?></span></td>

                                    </tr>
                                    <?php
                                }
                                ?>

                                <?php
                                if ($sub_4 == 108) {
                                    if ($eng_gp == 0) {
                                        $cl = 'red';
                                    } else if ($eng_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><b>English</b></td>
                                        <td style="text-align:center"><?php echo $eng_sub; ?></td>
                                        <td style="text-align:center"><?php echo $eng_obj; ?></td>
                                        <td style="text-align:center"><?php echo $eng_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $eng_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $eng_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $eng_gl; ?></span></td>

                                    </tr>
                                    <?php
                                }
                                //**************************************************************************************************************************************
                                ?>
                                <?php
                                if ($sub_2 == 107 || $sub_2 == 106) {
                                    if ($sub_2_gp == 0) {
                                        $cl = 'red';
                                    } else if ($sub_2_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    } ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php
                                        $sql000 = "SELECT * FROM subjects where subcode='$sub_2' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        }
                                        $subs = 'English';
                                        echo $subs;// . ' (' . $sub_2 . ')' ;
                                        ?></td>
                                        <td style="text-align:center"><?php echo $sub_2_sub; ?></td>
                                        <td style="text-align:center"><?php echo $sub_2_obj; ?></td>
                                        <td style="text-align:center"><?php echo $sub_2_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_2_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_2_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_2_gl; ?></span></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($sub_2 == 107) {
                                    if ($sub_3_gp == 0) {
                                        $cl = 'red';
                                    } else if ($sub_3_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php
                                        $sql000 = "SELECT * FROM subjects where subcode='$sub_3' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        }
                                        echo $subs;// . ' (' . $sub_3 . ')' ;
                                        ?></td>
                                        <td style="text-align:center"><?php echo $sub_3_sub; ?></td>
                                        <td style="text-align:center"><?php echo $sub_3_obj; ?></td>
                                        <td style="text-align:center"><?php echo $sub_3_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_3_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_3_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_3_gl; ?></span></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($sub_2 == 107) {
                                    if ($sub_4_gp == 0) {
                                        $cl = 'red';
                                    } else if ($sub_4_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php
                                        $sql000 = "SELECT * FROM subjects where subcode='$sub_4' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        }
                                        echo $subs;//. ' (' . $sub_4 . ')' ;
                                        ?></td>
                                        <td style="text-align:center"><?php echo $sub_4_sub; ?></td>
                                        <td style="text-align:center"><?php echo $sub_4_obj; ?></td>
                                        <td style="text-align:center"><?php echo $sub_4_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_4_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_4_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_4_gl; ?></span></td>

                                    </tr>
                                    <?php
                                }



                                if ($sub_3 == 109 && $cn == 'Eight') {
                                    /* 
                                                               if($sub_3_gp == 0){$cl = 'red';} else if ($sub_3_gp == 5){$cl = 'green';} else {$cl = 'black';}
                                                               ?>
                                                               <tr >
                                                                   <td style="padding:4px 4px 4px 10px;"><?php 
                                                                   $sql000 = "SELECT * FROM subjects where subcode='$sub_3' ";
                                                                   $result000 = $conn->query($sql000);	if ($result000->num_rows > 0) {while($row000 = $result000->fetch_assoc()) { $subs=$row000["subject"]; }}
                                                                   $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_3' ";
                                                                   $result000t = $conn->query($sql000t);	if ($result000t->num_rows > 0) {while($row000t = $result000t->fetch_assoc()) { $subsfm=$row000t["fullmarks"]; }}
                                                                   
                                                                   echo $subs ;//. ' <b>[' . $subsfm . ']</b>' ;?></td>
                                                                   <td style="text-align:center"><?php echo $sub_3_sub;?></td>
                                                                   <td style="text-align:center"><?php echo $sub_3_obj;?></td>
                                                                   <td style="text-align:center"><?php echo $sub_3_pra;?></td>
                                                                   <td style="text-align:center; "><span style="color:<?php echo $cl;?> !important;"><?php echo $sub_3_total;?></span></td>
                                                                   <td style="text-align:center; "><span style="color:<?php echo $cl;?> !important;"><?php echo $sub_3_gp;?></span></td>
                                                                   <td style="text-align:center; "><span style="color:<?php echo $cl;?> !important;"><?php echo $sub_3_gl;?></span></td>
                                                                   
                                                               </tr>
                                                               <?php
                                                              */
                                }


                                if ($sub_4 == 111 && $cn == 'Eight') {
                                    /*
                                                               if($sub_4_gp == 0){$cl = 'red';} else if ($sub_4_gp == 5){$cl = 'green';} else {$cl = 'black';}
                                                               ?>
                                                               <tr >
                                                                   <td style="padding:4px 4px 4px 10px;"><?php 
                                                                   $sql000 = "SELECT * FROM subjects where subcode='$sub_4' ";
                                                                   $result000 = $conn->query($sql000);	if ($result000->num_rows > 0) {while($row000 = $result000->fetch_assoc()) { $subs=$row000["subject"]; }}
                                                                   $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_4' ";
                                                                   $result000t = $conn->query($sql000t);	if ($result000t->num_rows > 0) {while($row000t = $result000t->fetch_assoc()) { $subsfm=$row000t["fullmarks"]; }}
                                                                   
                                                                   echo $subs ;//. ' <b>[' . $subsfm . ']</b>' ;?></td>
                                                                   <td style="text-align:center"><?php echo $sub_4_sub;?></td>
                                                                   <td style="text-align:center"><?php echo $sub_4_obj;?></td>
                                                                   <td style="text-align:center"><?php echo $sub_4_pra;?></td>
                                                                   <td style="text-align:center; "><span style="color:<?php echo $cl;?> !important;"><?php echo $sub_4_total;?></span></td>
                                                                   <td style="text-align:center; "><span style="color:<?php echo $cl;?> !important;"><?php echo $sub_4_gp;?></span></td>
                                                                   <td style="text-align:center; "><span style="color:<?php echo $cl;?> !important;"><?php echo $sub_4_gl;?></span></td>
                                                                   
                                                               </tr>
                                                               <?php
                                                               */
                                }

                                //***********************************************************************************************************************
                        
                                if ($sub_5 != $fourth) {
                                    if ($sub_5_gp == 0) {
                                        $cl = 'red';
                                    } else if ($sub_5_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php
                                        $sql000 = "SELECT * FROM subjects where subcode='$sub_5' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        } else {
                                            $subs = '&nbsp;';
                                        }
                                        $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_5'  and sessionyear='$sessionyear' ";
                                        $result000t = $conn->query($sql000t);
                                        if ($result000t->num_rows > 0) {
                                            while ($row000t = $result000t->fetch_assoc()) {
                                                $subsfm = $row000t["fullmarks"];
                                            }
                                        }

                                        echo $subs;//. ' <b>[' . $subsfm . ']</b>' ;
                                        ?></td>
                                        <td style="text-align:center"><?php echo $sub_5_sub; ?></td>
                                        <td style="text-align:center"><?php echo $sub_5_obj; ?></td>
                                        <td style="text-align:center"><?php echo $sub_5_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_5_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_5_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_5_gl; ?></span></td>

                                    </tr>
                                    <?php
                                } else {
                                    $fourth_sub = $sub_5_sub;
                                    $fourth_obj = $sub_5_obj;
                                    $fourth_pra = $sub_5_pra;
                                    $fourth_ca = $sub_5_ca;
                                    $fourth_total = $sub_5_total;
                                    $fourth_gp = $sub_5_gp;
                                    $fourth_gl = $sub_5_gl;
                                }

                                if ($sub_6 != $fourth) {
                                    if ($sub_6_gp == 0) {
                                        $cl = 'red';
                                    } else if ($sub_6_gp == 5) {
                                        $cl = 'green';
                                    } else {
                                        $cl = 'black';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php
                                        $sql000 = "SELECT * FROM subjects where subcode='$sub_6' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        } else {
                                            $subs = '&nbsp;';
                                        }
                                        $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_6'  and sessionyear='$sessionyear'";
                                        $result000t = $conn->query($sql000t);
                                        if ($result000t->num_rows > 0) {
                                            while ($row000t = $result000t->fetch_assoc()) {
                                                $subsfm = $row000t["fullmarks"];
                                            }
                                        }

                                        echo $subs;//. ' <b>[' . $subsfm . ']</b>' ;
                            
                                        ?></td>
                                        <td style="text-align:center"><?php echo $sub_6_sub; ?></td>
                                        <td style="text-align:center"><?php echo $sub_6_obj; ?></td>
                                        <td style="text-align:center"><?php echo $sub_6_pra; ?></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_6_total; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_6_gp; ?></span></td>
                                        <td style="text-align:center; "><span
                                                style="color:<?php echo $cl; ?> !important;"><?php echo $sub_6_gl; ?></span></td>

                                    </tr>
                                    <?php
                                } else {
                                    $fourth_sub = $sub_6_sub;
                                    $fourth_obj = $sub_6_obj;
                                    $fourth_pra = $sub_6_pra;
                                    $fourth_ca = $sub_6_ca;
                                    $fourth_total = $sub_6_total;
                                    $fourth_gp = $sub_6_gp;
                                    $fourth_gl = $sub_6_gl;
                                }


                                if ($sub_7_total != NULL) {
                                    if ($sub_7 != $fourth) {
                                        if ($sub_7_gp == 0) {
                                            $cl = 'red';
                                        } else if ($sub_7_gp == 5) {
                                            $cl = 'green';
                                        } else {
                                            $cl = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td style="padding:4px 4px 4px 10px;"><?php
                                            $sql000 = "SELECT * FROM subjects where subcode='$sub_7' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $subs = $row000["subject"];
                                                }
                                            } else {
                                                $subs = '';
                                            }
                                            $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_7'  and sessionyear='$sessionyear'";
                                            $result000t = $conn->query($sql000t);
                                            if ($result000t->num_rows > 0) {
                                                while ($row000t = $result000t->fetch_assoc()) {
                                                    $subsfm = $row000t["fullmarks"];
                                                }
                                            }

                                            echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                            <td style="text-align:center"><?php echo $sub_7_sub; ?></td>
                                            <td style="text-align:center"><?php echo $sub_7_obj; ?></td>
                                            <td style="text-align:center"><?php echo $sub_7_pra; ?></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_7_total; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_7_gp; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_7_gl; ?></span></td>

                                        </tr>
                                        <?php
                                    } else {
                                        $fourth_sub = $sub_7_sub;
                                        $fourth_obj = $sub_7_obj;
                                        $fourth_pra = $sub_7_pra;
                                        $fourth_ca = $sub_7_ca;
                                        $fourth_total = $sub_7_total;
                                        $fourth_gp = $sub_7_gp;
                                        $fourth_gl = $sub_7_gl;
                                    }
                                }


                                if ($sub_8_total != NULL) {
                                    if ($sub_8 != $fourth) {
                                        if ($sub_8_gp == 0) {
                                            $cl = 'red';
                                        } else if ($sub_8_gp == 5) {
                                            $cl = 'green';
                                        } else {
                                            $cl = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td style="padding:4px 4px 4px 10px;"><?php
                                            $sql000 = "SELECT * FROM subjects where subcode='$sub_8' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $subs = $row000["subject"];
                                                }
                                            } else {
                                                $subs = '';
                                            }
                                            $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_8'  and sessionyear='$sessionyear'";
                                            $result000t = $conn->query($sql000t);
                                            if ($result000t->num_rows > 0) {
                                                while ($row000t = $result000t->fetch_assoc()) {
                                                    $subsfm = $row000t["fullmarks"];
                                                }
                                            }

                                            echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                            <td style="text-align:center"><?php echo $sub_8_sub; ?></td>
                                            <td style="text-align:center"><?php echo $sub_8_obj; ?></td>
                                            <td style="text-align:center"><?php echo $sub_8_pra; ?></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_8_total; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_8_gp; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_8_gl; ?></span></td>

                                        </tr>
                                        <?php
                                    } else {
                                        $fourth_sub = $sub_8_sub;
                                        $fourth_obj = $sub_8_obj;
                                        $fourth_pra = $sub_8_pra;
                                        $fourth_ca = $sub_8_ca;
                                        $fourth_total = $sub_8_total;
                                        $fourth_gp = $sub_8_gp;
                                        $fourth_gl = $sub_8_gl;
                                    }
                                }


                                if ($sub_9_total != NULL) {
                                    if ($sub_9 != $fourth) {
                                        if ($sub_9_gp == 0) {
                                            $cl = 'red';
                                        } else if ($sub_9_gp == 5) {
                                            $cl = 'green';
                                        } else {
                                            $cl = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td style="padding:4px 4px 4px 10px;"><?php
                                            $sql000 = "SELECT * FROM subjects where subcode='$sub_9' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $subs = $row000["subject"];
                                                }
                                            } else {
                                                $subs = '';
                                            }
                                            $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_9'  and sessionyear='$sessionyear'";
                                            $result000t = $conn->query($sql000t);
                                            if ($result000t->num_rows > 0) {
                                                while ($row000t = $result000t->fetch_assoc()) {
                                                    $subsfm = $row000t["fullmarks"];
                                                }
                                            }

                                            echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                            <td style="text-align:center"><?php echo $sub_9_sub; ?></td>
                                            <td style="text-align:center"><?php echo $sub_9_obj; ?></td>
                                            <td style="text-align:center"><?php echo $sub_9_pra; ?></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_9_total; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_9_gp; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_9_gl; ?></span></td>

                                        </tr>
                                        <?php
                                    } else {
                                        $fourth_sub = $sub_9_sub;
                                        $fourth_obj = $sub_9_obj;
                                        $fourth_pra = $sub_9_pra;
                                        $fourth_ca = $sub_9_ca;
                                        $fourth_total = $sub_9_total;
                                        $fourth_gp = $sub_9_gp;
                                        $fourth_gl = $sub_9_gl;
                                    }
                                }



                                if ($sub_10_total != NULL) {
                                    if ($sub_10 != $fourth) {
                                        if ($sub_10_gp == 0) {
                                            $cl = 'red';
                                        } else if ($sub_10_gp == 5) {
                                            $cl = 'green';
                                        } else {
                                            $cl = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td style="padding:4px 4px 4px 10px;"><?php
                                            $sql000 = "SELECT * FROM subjects where subcode='$sub_10' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $subs = $row000["subject"];
                                                }
                                            } else {
                                                $subs = '';
                                            }
                                            $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_10'  and sessionyear='$sessionyear'";
                                            $result000t = $conn->query($sql000t);
                                            if ($result000t->num_rows > 0) {
                                                while ($row000t = $result000t->fetch_assoc()) {
                                                    $subsfm = $row000t["fullmarks"];
                                                }
                                            }

                                            echo $subs;// . ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                            <td style="text-align:center"><?php echo $sub_10_sub; ?></td>
                                            <td style="text-align:center"><?php echo $sub_10_obj; ?></td>
                                            <td style="text-align:center"><?php echo $sub_10_pra; ?></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_10_total; ?></span>
                                            </td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_10_gp; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_10_gl; ?></span></td>

                                        </tr>
                                        <?php
                                    } else {
                                        $fourth_sub = $sub_10_sub;
                                        $fourth_obj = $sub_10_obj;
                                        $fourth_pra = $sub_10_pra;
                                        $fourth_ca = $sub_10_ca;
                                        $fourth_total = $sub_10_total;
                                        $fourth_gp = $sub_10_gp;
                                        $fourth_gl = $sub_10_gl;
                                    }
                                }


                                if ($sub_11_total != NULL) {
                                    if ($sub_11 != $fourth) {
                                        if ($sub_11_gp == 0) {
                                            $cl = 'red';
                                        } else if ($sub_11_gp == 5) {
                                            $cl = 'green';
                                        } else {
                                            $cl = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td style="padding:4px 4px 4px 10px;"><?php
                                            $sql000 = "SELECT * FROM subjects where subcode='$sub_11' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $subs = $row000["subject"];
                                                }
                                            } else {
                                                $subs = '';
                                            }
                                            $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_11'  and sessionyear='$sessionyear'";
                                            $result000t = $conn->query($sql000t);
                                            if ($result000t->num_rows > 0) {
                                                while ($row000t = $result000t->fetch_assoc()) {
                                                    $subsfm = $row000t["fullmarks"];
                                                }
                                            }

                                            echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                            <td style="text-align:center"><?php echo $sub_11_sub; ?></td>
                                            <td style="text-align:center"><?php echo $sub_11_obj; ?></td>
                                            <td style="text-align:center"><?php echo $sub_11_pra; ?></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_11_total; ?></span>
                                            </td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_11_gp; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_11_gl; ?></span></td>

                                        </tr>
                                        <?php
                                    } else {
                                        $fourth_sub = $sub_11_sub;
                                        $fourth_obj = $sub_11_obj;
                                        $fourth_pra = $sub_11_pra;
                                        $fourth_ca = $sub_11_ca;
                                        $fourth_total = $sub_11_total;
                                        $fourth_gp = $sub_11_gp;
                                        $fourth_gl = $sub_11_gl;
                                    }
                                }


                                if ($sub_12_total != NULL) {
                                    if ($sub_12 != $fourth) {
                                        if ($sub_12_gp == 0) {
                                            $cl = 'red';
                                        } else if ($sub_12_gp == 5) {
                                            $cl = 'green';
                                        } else {
                                            $cl = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td style="padding:4px 4px 4px 10px;"><?php
                                            $sql000 = "SELECT * FROM subjects where subcode='$sub_12' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $subs = $row000["subject"];
                                                }
                                            } else {
                                                $subs = '';
                                            }
                                            $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_12'  and sessionyear='$sessionyear'";
                                            $result000t = $conn->query($sql000t);
                                            if ($result000t->num_rows > 0) {
                                                while ($row000t = $result000t->fetch_assoc()) {
                                                    $subsfm = $row000t["fullmarks"];
                                                }
                                            }

                                            echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                            <td style="text-align:center"><?php echo $sub_12_sub; ?></td>
                                            <td style="text-align:center"><?php echo $sub_12_obj; ?></td>
                                            <td style="text-align:center"><?php echo $sub_12_pra; ?></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_12_total; ?></span>
                                            </td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_12_gp; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_12_gl; ?></span></td>

                                        </tr>
                                        <?php
                                    } else {
                                        $fourth_sub = $sub_12_sub;
                                        $fourth_obj = $sub_12_obj;
                                        $fourth_pra = $sub_12_pra;
                                        $fourth_ca = $sub_12_ca;
                                        $fourth_total = $sub_12_total;
                                        $fourth_gp = $sub_12_gp;
                                        $fourth_gl = $sub_12_gl;
                                    }
                                }



                                if ($sub_13_total != NULL) {
                                    if ($sub_13 != $fourth) {
                                        if ($sub_13_gp == 0) {
                                            $cl = 'red';
                                        } else if ($sub_13_gp == 5) {
                                            $cl = 'green';
                                        } else {
                                            $cl = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td style="padding:4px 4px 4px 10px;"><?php
                                            $sql000 = "SELECT * FROM subjects where subcode='$sub_13' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $subs = $row000["subject"];
                                                }
                                            } else {
                                                $subs = '';
                                            }
                                            $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_13'  and sessionyear='$sessionyear'";
                                            $result000t = $conn->query($sql000t);
                                            if ($result000t->num_rows > 0) {
                                                while ($row000t = $result000t->fetch_assoc()) {
                                                    $subsfm = $row000t["fullmarks"];
                                                }
                                            }

                                            echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                            <td style="text-align:center"><?php echo $sub_13_sub; ?></td>
                                            <td style="text-align:center"><?php echo $sub_13_obj; ?></td>
                                            <td style="text-align:center"><?php echo $sub_13_pra; ?></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_13_total; ?></span>
                                            </td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_13_gp; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_13_gl; ?></span></td>

                                        </tr>
                                        <?php
                                    } else {
                                        $fourth_sub = $sub_13_sub;
                                        $fourth_obj = $sub_13_obj;
                                        $fourth_pra = $sub_13_pra;
                                        $fourth_ca = $sub_13_ca;
                                        $fourth_total = $sub_13_total;
                                        $fourth_gp = $sub_13_gp;
                                        $fourth_gl = $sub_13_gl;
                                    }
                                }



                                if ($sub_14_total != NULL) {
                                    if ($sub_14 != $fourth) {
                                        if ($sub_14_gp == 0) {
                                            $cl = 'red';
                                        } else if ($sub_14_gp == 5) {
                                            $cl = 'green';
                                        } else {
                                            $cl = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td style="padding:4px 4px 4px 10px;"><?php
                                            $sql000 = "SELECT * FROM subjects where subcode='$sub_14' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $subs = $row000["subject"];
                                                }
                                            } else {
                                                $subs = '';
                                            }
                                            $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_14'  and sessionyear='$sessionyear'";
                                            $result000t = $conn->query($sql000t);
                                            if ($result000t->num_rows > 0) {
                                                while ($row000t = $result000t->fetch_assoc()) {
                                                    $subsfm = $row000t["fullmarks"];
                                                }
                                            }
                                            echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                            <td style="text-align:center"><?php echo $sub_14_sub; ?></td>
                                            <td style="text-align:center"><?php echo $sub_14_obj; ?></td>
                                            <td style="text-align:center"><?php echo $sub_14_pra; ?></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_14_total; ?></span>
                                            </td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_14_gp; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_14_gl; ?></span></td>

                                        </tr>
                                        <?php
                                    } else {
                                        $fourth_sub = $sub_14_sub;
                                        $fourth_obj = $sub_14_obj;
                                        $fourth_pra = $sub_14_pra;
                                        $fourth_ca = $sub_14_ca;
                                        $fourth_total = $sub_14_total;
                                        $fourth_gp = $sub_14_gp;
                                        $fourth_gl = $sub_14_gl;
                                    }
                                }



                                if ($sub_15_total != NULL) {
                                    if ($sub_15 != $fourth) {
                                        if ($sub_15_gp == 0) {
                                            $cl = 'red';
                                        } else if ($sub_15_gp == 5) {
                                            $cl = 'green';
                                        } else {
                                            $cl = 'black';
                                        }
                                        ?>
                                        <tr>
                                            <td style="padding:4px 4px 4px 10px;"><?php
                                            $sql000 = "SELECT * FROM subjects where subcode='$sub_15' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $subs = $row000["subject"];
                                                }
                                            } else {
                                                $subs = '';
                                            }
                                            $sql000t = "SELECT * FROM subsetup where sccode='$sccode' and classname='$cn' and sectionname='$secname' and subject='$sub_15'  and sessionyear='$sessionyear'";
                                            $result000t = $conn->query($sql000t);
                                            if ($result000t->num_rows > 0) {
                                                while ($row000t = $result000t->fetch_assoc()) {
                                                    $subsfm = $row000t["fullmarks"];
                                                }
                                            }

                                            echo $subs;//. ' <b>[' . $subsfm . ']</b>' ; ?></td>
                                            <td style="text-align:center"><?php echo $sub_15_sub; ?></td>
                                            <td style="text-align:center"><?php echo $sub_15_obj; ?></td>
                                            <td style="text-align:center"><?php echo $sub_15_pra; ?></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_15_total; ?></span>
                                            </td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_15_gp; ?></span></td>
                                            <td style="text-align:center; "><span
                                                    style="color:<?php echo $cl; ?> !important;"><?php echo $sub_15_gl; ?></span></td>

                                        </tr>
                                        <?php
                                    } else {
                                        $fourth_sub = $sub_15_sub;
                                        $fourth_obj = $sub_15_obj;
                                        $fourth_pra = $sub_15_pra;
                                        $fourth_ca = $sub_15_ca;
                                        $fourth_total = $sub_15_total;
                                        $fourth_gp = $sub_15_gp;
                                        $fourth_gl = $sub_15_gl;
                                    }
                                }

                                //*******************************************************************************************************************************************
                                if ($fourth > 0) {
                                    ?>
                                    <tr>
                                        <td style="padding:4px 4px 4px 10px;"><?php

                                        if (
                                            ($stid == '1055320001') || ($stid == '1055320002') || ($stid == '1055320003') || ($stid == '1055320007') || ($stid == '1055320013') || ($stid == '1055320014') || ($stid == '1055320015') ||
                                            ($stid == '1055320017') || ($stid == '1055320021') || ($stid == '1055320024') || ($stid == '1055320025') || ($stid == '1055320026') || ($stid == '1055320027')


                                        ) {
                                            $fourth = 126;
                                        }

                                        if (
                                            ($stid == '1055320211') || ($stid == '1055320215') || ($stid == '1055320220') || ($stid == '1055320221') || ($stid == '1055320225') || ($stid == '1055320227') || ($stid == '1055320228') ||
                                            ($stid == '1055320229') || ($stid == '1055320230') || ($stid == '1055320096') || ($stid == '1055320099') || ($stid == '10553200100') || ($stid == '1055320102') || ($stid == '1055320103') ||
                                            ($stid == '1055320104') || ($stid == '1055320106') || ($stid == '1055320107') || ($stid == '1055320108') || ($stid == '10553200109') || ($stid == '1055320110') || ($stid == '1055320111') ||
                                            ($stid == '1055320112') || ($stid == '1055320113') || ($stid == '1055320114') || ($stid == '1055320116')


                                        ) {
                                            $fourth = 134;
                                        }

                                        if ($secname == 'Science (A)') {
                                            if (($rollno == '8') || ($rollno == '16') || ($rollno == '18') || ($rollno == '19') || ($rollno == '20') || ($rollno == '21') || ($rollno == '22') || ($rollno == '23') || ($rollno == '24')) {
                                                $fourth = 134;
                                            }
                                        }
                                        if ($secname == 'Science (B)') {
                                            if (($rollno == '2') || ($rollno == '4') || ($rollno == '12')) {
                                                $fourth = 126;
                                            }
                                        }


                                        $sql000 = "SELECT * FROM subjects where subcode='$fourth' ";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $subs = $row000["subject"];
                                            }
                                        }
                                        echo $subs . ' (' . $fourth . ')*';
                                        if ($fourth_gp >= 2) {
                                            $gp_above = $fourth_gp - 2;
                                        } else {
                                            $gp_above = 0;
                                        }


                                        ?></td>
                                        <td style="text-align:center"><?php echo $fourth_sub; ?></td>
                                        <td style="text-align:center"><?php echo $fourth_obj; ?></td>
                                        <td style="text-align:center"><?php echo $fourth_pra; ?></td>
                                        <td style="text-align:center;"><?php echo $fourth_total; ?></td>
                                        <td style="text-align:center;"><?php echo $fourth_gp; ?></td>
                                        <td style="text-align:center;"><?php echo $fourth_gl; ?></td>

                                    </tr>
                                    <?php
                                }
                                //*******************************************************************************************************************************************
                                ?>


                            </table>



                            <span style="margin : 15px 0 5px 0; font-size:80%">
                                Result Published On : <b><?php $td = '2024-06-11';
                                echo date('l, j F, Y', strtotime($td)); ?></b>

                            </span>




                            <table width="100%" style="margin:5px 0 0 0;" border="0">

                                <tr>
                                    <td valign="bottom">
                                        <?php
                                        if ($exam == 'Half Yearly') {
                                            $exx = 1;
                                        } else {
                                            $exx = 0;
                                        }
                                        $lnk = 'http://www.students.eimbox.com/transcript.php?qr=' . $sessionyear . $stid . $exx;
                                        //echo $lnk;
                                        ?>

                                        <img style="padding: 10px;"
                                            src="https://chart.googleapis.com/chart?chs=75x75&cht=qr&chl=<?php echo $lnk; ?>&choe=UTF-8&chld=L|0" />
                                        <br>

                                    </td>
                                    <?php if ($progressguar == 1) { ?>

                                        <td valign="bottom" style="font-size:11px;">
                                            <center>
                                                ............................................
                                                <br>
                                                Guardian's Signature<br><br><br>
                                            </center>
                                        </td>
                                    <?php } ?>

                                    <td valign="bottom">
                                        <center>
                                            <?php
                                            $tna = 'KKK';
                                            $sql000 = "SELECT * FROM classroutine where sccode='$sccode' and classname='$cn' and sectionname = '$secname' and period='First' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $tid = $row000["tid"];
                                                }
                                            }

                                            $sql000 = "SELECT * FROM teacher where tid='$tid' ";
                                            $result000 = $conn->query($sql000);
                                            if ($result000->num_rows > 0) {
                                                while ($row000 = $result000->fetch_assoc()) {
                                                    $tname = $row000["tname"];
                                                }
                                            }
                                            $tna = $tname;
                                            $tna = '';
                                            ?>
                                        </center>
                                        <center><span style="font-size:11px;">
                                                <!--<img src="sign/<?php echo $tid; ?>.png" width="120px" /><br>-->
                                                <img src="https://eimbox.com/sign/<?php echo $ctid; ?>.png" class="tsign" alt=""
                                                    style="height:12mm;"
                                                    onerror="this.onerror=null;this.src='https://eimbox.com/sign/nosign.png';" /><br><br>

                                                <b><small><?php echo '( ' . $cteacher . ' )'; ?></small></b><br>
                                                Class Teacher (<?php echo $cn . ' : ' . $secname;
                                                ; ?>)<br>
                                                <?php echo $einame; ?><br>
                                                <?php echo $eiaddress; ?>
                                                <!--
                                                <br>
                                                <?php echo '<b>t' . $tna . '</b>'; ?><br><?php echo $mno; ?>
                                                -->
                                            </span></center>
                                    </td>

                                    <td valign="botttom">
                                        <center>
                                            <?php
                                            if ($sign == 'true') {
                                                ?>

                                                <div style="font-size:12px;">
                                                    <img src="https://eimbox.com/sign/<?php echo $htid; ?>.png" class="tsign" alt=""
                                                        style="height:12mm;"
                                                        onerror="this.onerror=null;this.src='https://eimbox.com/sign/nosign.png';" /><br>

                                                </div>



                                                <?php
                                            } else {
                                                echo '<span style="height:100px;"></span>';
                                            }

                                            ?>
                                        </center>

                                        <center><span style="font-size:11px;">
                                                <?php echo '<b>( ' . $hname . ' )</b>'; ?><br>
                                                <small><?php echo $hpos; ?></small><br>
                                                <?php echo $scname; ?><br>
                                                <?php echo $eiaddress; ?>
                                            </span></center>
                                    </td>


                                </tr>
                                <tr>
                                    <td colspan="4" style="height:1mm;">&nbsp;</td>
                                </tr>

                            </table>


                        </td>

                    </tr>


                </table>

            </div>
        </div>

        <div style="height:<?php $lastpad = '0mm';
        echo $lastpad; ?>; "></div>
        <?php


    }
} else {
    echo 'No Student Found.';
}
?>