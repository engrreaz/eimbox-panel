<?php
include 'header.php';
include 'backend/func.php';

$cls2 = $classname = $_GET['cls'];
$sec2 = $sectionname = $_GET['sec'];
$year = $_GET['year'];
$datefrom = $_GET['datefrom'];
$dateto = $_GET['dateto'];
$collector = $_GET['collector'];
if ($collector != "") {
    $uu = " and entryby='$collector' ";
} else {
    $uu = '';
}

$sql0x2 = "SELECT * from areas where areaname='$classname' and subarea = '$sectionname' and sessionyear = '$sy' and user='$rootuser'";
$result0x2 = $conn->query($sql0x2);
if ($result0x2->num_rows > 0) {
    while ($row0x2 = $result0x2->fetch_assoc()) {
        $ctid = $row0x2["classteacher"];
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





?>





<div id="allpr">

    <head>
        <style>
            * {
                font-family: "Noto Sans Bengali", sans-serif;
            }

            .a {
                font-size: 11px;
                font-weight: 700;
            }

            .b {
                font-size: 9px;
            }

            .c {
                font-size: 9px;
            }

            .x {
                font-size: 12px;
            }

            .y {
                font-size: 12px;
                font-weight: bold;
            }

            .pop {
                text-align: center;
                vertical-align: bottom;
            }




            .txt-right {
                text-align: center;
                font-weight: bold;
                font-size: 14px;
                padding: 5px;
            }

            @media print {

                .d-print-nones,
                #nono {
                    display: none;
                }
            }

            table,
            tr,
            td,
            th {
                border-collapse: collapse;
            }


            #itemg td,
            #itemg th {
                border: 1px solid gray;

                padding: 3px 6px;
            }
        </style>
    </head>
</div>
<div id="cont">
    <?php
    //    $sql0 = "SELECT count(*) as cnt from stpr where sessionyear='$sy' and classname='$classname' and sectionname='$sectionname' and sccode = '$sccode' and rollno between '$rs' and '$re' and status=1 order by rollno";
    // $sql0 = "SELECT count(*) as cnt from stpr where sessionyear='$sy' and  sccode = '$sccode' and prdate='$datefrom' ";
    if ($cls2 != '') {
        if ($sec2 != '') {
            $sql0 = "SELECT count(*) as cnt from stpr where sessionyear LIKE '$sy%' and sccode='$sccode' and classname='$cls2' and sectionname='$sec2' and prdate between '$datefrom' and '$dateto' $uu order by entrytime desc, id desc";
        } else {
            $sql0 = "SELECT count(*) as cnt from stpr where sessionyear LIKE '$sy%' and sccode='$sccode' and classname='$cls2' and prdate between '$datefrom' and '$dateto' $uu order by entrytime desc, id desc";
        }
    } else {
        $sql0 = "SELECT count(*) as cnt from stpr where sessionyear LIKE '$sy%' and sccode='$sccode' and prdate between '$datefrom' and '$dateto' $uu order by entrytime desc, id desc";
    }
    $result0q = $conn->query($sql0);
    if ($result0q->num_rows > 0) {
        while ($row0 = $result0q->fetch_assoc()) {
            $cnt = $row0["cnt"];
        }
    }

    $pg = ceil($cnt / 3);
    $rest = (ceil($cnt / 3) * 3) - $cnt;
    $run = 0;

    for ($lp = 0; $lp < $pg; $lp++) {
        $offs = $lp * 3;
        ?>








        <div id="pages" style="page-break-after:always;  background-color: white; color:black;">
            <table style="width:100%; border:0; border-collapse:collapse;">
                <tr>
                    <?php
                    if ($cls2 != '') {
                        if ($sec2 != '') {
                            $sql0 = "SELECT * FROM stpr where sessionyear LIKE '$sy%' and sccode='$sccode' and classname='$cls2' and sectionname='$sec2' and prdate between '$datefrom' and '$dateto' $uu order by entrytime desc, id desc  LIMIT 3 offset $offs ";
                        } else {
                            $sql0 = "SELECT * FROM stpr where sessionyear LIKE '$sy%' and sccode='$sccode' and classname='$cls2' and prdate between '$datefrom' and '$dateto' $uu order by entrytime desc, id desc  LIMIT 3 offset $offs ";
                        }
                    } else {
                        $sql0 = "SELECT * FROM stpr where sessionyear LIKE '$sy%' and sccode='$sccode' and prdate between '$datefrom' and '$dateto' $uu order by entrytime desc, id desc  LIMIT 3 offset $offs ";
                    }
                    // $sql0 = "SELECT * from stpr where sessionyear='$sy' and  sccode = '$sccode' and prdate='$datefrom' order by id  LIMIT 3 offset $offs ";
                    $result0 = $conn->query($sql0);
                    if ($result0->num_rows > 0) {
                        while ($row0 = $result0->fetch_assoc()) {
                            $prno = $row0["prno"];
                            $prdate = $row0["prdate"];
                            $pramt = $row0["amount"];
                            $id = $row0["id"];
                            $stid = $row0["stid"];
                            ?>
                            <td
                                style="border-collapse:collapse; border:1px dashed gray; border-top:0; border-bottom:0; padding:6mm 6mm; vertical-align:top; width:33%;">
                                <table>
                                    <tr>
                                        <td style="width:45px;">
                                            <img src="https://eimbox.com/logo/<?php echo $sccode; ?>.png" width="40" />
                                        </td>
                                        <td>
                                            <div class="a"><?php echo $scname; ?></div>
                                            <div class="b"><?php echo $scaddress; ?></div>
                                            <div class="c"><?php echo 'Mobile : ' . $mobile; ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:center;padding-top:5px;">
                                            <div
                                                style="font-size:12px; display:inline; margin:5px 0; padding:2px 10px; border:1px solid black; border-radius: 5px;">
                                                Payment's Receipt</div>
                                        </td>
                                    </tr>

                                </table>

                                <table style="width:100%; margin-top:5px; ">
                                    <tr>
                                        <td>
                                            <div>
                                                <div style="position:relative; font-size:13px; font-weight:bold; line-height:15px;">
                                                    <?php echo $prno . '/' . $id; ?>
                                                </div>
                                                <div
                                                    style="position:relative; font-size:10px; font-style:italic; line-height:13px;">
                                                    Receipt Number</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                style="position:relative; font-size:13px; font-weight:bold; line-height:15px; text-align:right;">
                                                <?php echo date('d F, Y', strtotime($prdate)); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php
                                        $sql0gh = "SELECT * from sessioninfo where sessionyear='$sy' and  sccode = '$sccode' and stid='$stid' ";
                                        $result0gh = $conn->query($sql0gh);
                                        if ($result0gh->num_rows > 0) {
                                            while ($row0gh = $result0gh->fetch_assoc()) {
                                                $cls = $row0gh["classname"];
                                                $sec = $row0gh["sectionname"];
                                                $roll = $row0gh["rollno"];
                                            }
                                        }

                                        $sql0gh = "SELECT * from students where stid='$stid' ";
                                        $result0ghd = $conn->query($sql0gh);
                                        if ($result0ghd->num_rows > 0) {
                                            while ($row0gh = $result0ghd->fetch_assoc()) {
                                                $seng = $row0gh["stnameeng"];
                                                $sben = $row0gh["stnameben"];
                                            }
                                        }
                                        if ($seng == '') {
                                            $sn = $sben;
                                        } else {
                                            $sn = $seng;
                                        }


                                        ?>
                                        <td colspan="2">
                                            <div style="padding-top:8px;">
                                                <div
                                                    style="position:relative; font-size:10px; font-style:italic; line-height:10px;">
                                                    Student's Information</div>
                                                <div style="position:relative; font-size:13px; font-weight:bold; line-height:18px;">
                                                    <?php echo $sn; ?>
                                                </div>
                                                <div
                                                    style="position:relative; font-size:10px; font-style:normal; line-height:10px; font-weight:bold; padding-bottom:5px;">
                                                    ID # <?php echo $stid; ?></div>
                                            </div>
                                            <table width="100%">
                                                <tr>
                                                    <td><span class="x">Class : </span><span class="y"><?php echo $cls; ?> </span>
                                                    </td>
                                                    <td><span class="x">Section : </span><span class="y"><?php echo $sec; ?> </span>
                                                    </td>
                                                    <td><span class="x">Roll : </span><span class="y"><?php echo $roll; ?></span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <table style="width:100%; font-size:12px;" id="itemg">

                                    <tr>
                                        <th style="text-align:center;">#</th>
                                        <th>Particulars</th>
                                        <th style="text-align:right;">Amount</th>
                                    </tr>
                                    <?php
                                    $sln = 1;
                                    $sql0 = "SELECT * from stfinance where sessionyear='$sy' and  sccode = '$sccode' and (pr1no='$prno' || pr2no ='$prno'); ";
                                    $result0r = $conn->query($sql0);
                                    if ($result0r->num_rows > 0) {
                                        while ($row0 = $result0r->fetch_assoc()) {
                                            $pben = $row0["particularben"];
                                            $pr1 = $row0["pr1"];
                                            $pr2 = $row0["pr2"];
                                            $iamt = $pr1 + $pr2;

                                            ?>
                                            <tr>
                                                <td style="text-align:center; "><?php echo $sln; ?></td>
                                                <td><?php echo $pben; ?></td>
                                                <td style="text-align:right; font-size:14px; font-weight:600;">
                                                    <?php echo number_format($iamt, "2", ".", ","); ?>
                                                </td>
                                            </tr>

                                            <?php
                                            $sln++;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <th></th>
                                        <th>Total</th>
                                        <th style="text-align:right;"><?php echo number_format($pramt, "2", ".", ","); ?></th>
                                    </tr>
                                </table>

                                <div style="padding-top:4px;">
                                    <div style="position:relative; font-size:10px; font-style:normal; line-height:10px;">Amount in
                                        Word
                                        :</div>
                                    <div
                                        style="position:relative; font-size:12px; font-style:italic; font-weight:500; line-height:15px;">

                                        <?php echo 'Taka ';
                                        taka($pramt);
                                        echo ' Only.'; ?>

                                    </div>

                                </div>

                                <table style="width:100%; font-size:11px; border:0px solid black;">

                                    <tr>
                                        <td class="pop">
                                            <?php $lnk = 'http://android.eimbox.com/stpr.php?prno=' . $prno; ?>
                                            <img style=" margin-auto;"
                                                src="https://quickchart.io/qr?text=<?php echo $lnk; ?>&size=70" />


                                        </td>
                                        <td class="pop">Principal</td>
                                        <td class="pop">Class Teacher</td>
                                    </tr>
                                </table>
                            </td>
                            <?php
                            $run++;
                        }
                    }


                    if ($run == $cnt) {
                        for ($rst = 0; $rst < $rest; $rst++) {
                            echo '<td style="border:1px dashed gray; padding:4mm; vertical-align:top; width:33%;"></td>';
                        }
                    }



                    ?>
                </tr>
            </table>



        </div>





        <?php

    }
    ?>
</div>
<?php


include 'footer.php';



?>
<script>
    var uri = window.location.href;
    function reload() {
        window.location.href = uri;
    }
    document.getElementById('defbtn').innerHTML = 'Print Receipt';

    function defbtn() {
        goprint(0);
    }


    function goprint() {
        // var txt = document.getElementById("alladmit").innerHTML;
        // document.write('<div class="d-print-nones" id="nono"><button style="z-index:9999; position:fixed; right:100px; top:100px; background: seagreen;; color:white; padding:5px; border-radius:5px;"  onclick="reload();">Back to Admit</button><div>');
        // document.write(txt);

        var contents = $('html').html();

        var txthead = document.getElementById("allpr").innerHTML;
        var txt = document.getElementById("cont").innerHTML;
        document.write('<title>Eimbox</title>');
        document.write(txthead);
        document.write('<div class="d-print-nones" id="nono"><button style="z-index:9999; position:fixed; right:100px; top:50px; background: black;; color:white; padding:5px; border-radius:5px;"  onclick="reload();">Back to Receipt</button></div>');
        document.write('<div id="margin" style=""></div>');
        // document.write(pad);
        document.getElementById("margin").innerHTML = txt;
        // document.write(txt);

        window.print();
       reload();
    }
</script>