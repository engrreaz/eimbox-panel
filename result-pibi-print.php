<?php
include 'header.php';
include 'backend/func.php';

$exam = $_GET['exam'];
$cls2 = $classname = $_GET['cls'];
$sec2 = $sectionname = $_GET['sec'];
$year = $_GET['year'];
$subj = $sub = $_GET['subj'];
$assess = $_GET['assess'];
$sheet = $_GET['sheet'];


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


$sql00v = "SELECT * from subjects where subcode='$subj' ";
$result00v = $conn->query($sql00v);
if ($result00v->num_rows > 0) {
    while ($row00v = $result00v->fetch_assoc()) {
        $subname = $row00v["subject"];
        $subben = $row00v["subben"];
    }
}
if ($assess == 'Behavioural Assessment') {
    $hd = 'Behavioural Indicator / আরচণিক সুচক';
} else {
    $hd = 'Performance Indicator / পারদর্শিতার সুচক ';
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


            #boxtbl td,
            #boxtbl th {
                border: 1px solid gray;

                padding: 3px 6px;
            }
        </style>
    </head>
</div>
<div id="cont">





    <div id="pages" style="page-break-after:always;  background-color: white; color:black; padding:15mm;">

        <?php include 'assets/pibisheet/non-nctb.php'; ?>


        <div>
            <div style="float:right; font-size:10px; margin:10px; color:red;" class="d-print-none" id="prnt">
                <span id="prn0" class="" onclick="prnt(0);">Minimum</span> | 
                <span id="prn1" class="font-weight-bold" onclick="prnt(1);">Standard</span> |
                <span id="prn2" class=""  onclick="prnt(2);">Details</span>
            </div>
            <h5 style="padding:5px 8px 5px 8px;;" class="topic"><b><?php echo $hd; ?></b></h5>
        </div>



        <table id="topic" class="topic">
            <?php
            if ($assess == 'Behavioural Assessment') {
                $sql0 = "SELECT * FROM pibitopics where sessionyear = '$sy' and exam='$exam'  and behave=1  order by topiccode";
            } else {
                $sql0 = "SELECT * FROM pibitopics where sessionyear = '$sy' and class='$classname' and subcode='$sub' and exam='$exam'  and behave=0   order by topiccode";
            }

            $result0g = $conn->query($sql0);
            if ($result0g->num_rows > 0) {
                while ($row0 = $result0g->fetch_assoc()) {
                    $code = $row0["topiccode"];
                    $title = $row0["topictitle"];
                    $id = $row0["id"];
                    $level1 = $row0["level1"];
                    $level2 = $row0["level2"];
                    $level3 = $row0["level3"];
                    ?>
                    <tr>
                        <td style="width:20px;"></td>
                        <td class="gap"><?php echo $code; ?></td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td class="gap">
                            <?php echo $title; ?>
                            <br>
                            <small class="level" style="display:none;">
                                <?php echo '<i class="mdi mdi-square-outline mdi-18px"></i> - ' . $level1; ?><br><?php echo '<i class="mdi mdi-checkbox-blank-circle-outline mdi-18px"></i> - ' . $level2; ?><br><?php echo '<i class="mdi mdi-triangle-outline mdi-18px"></i> - ' . $level3; ?><br>
                            </small>
                        </td>
                    </tr>
                    <?php
                }
            } ?>
        </table>



        <?php
        $toprow = '';
        $cntpibi = 0;
        $genrow = '';
        if ($assess == 'Behavioural Assessment') {
            $sql00 = "SELECT * FROM pibitopics where sessionyear = '$sy' and exam='$exam' and behave=1  order by topiccode";
        } else {
            $sql00 = "SELECT * FROM pibitopics where sessionyear = '$sy' and class='$classname' and subcode='$sub' and exam='$exam'  and behave=0 order by topiccode";
        }
        //$sql00 = "SELECT * from pibitopics where sessionyear='$sy' and subcode= '$sub'  and class='$classname' and exam = '$exam' order by topiccode";
        $result00 = $conn->query($sql00);
        if ($result00->num_rows > 0) {
            while ($row00 = $result00->fetch_assoc()) {
                $tid = $row00["id"];
                $code = $row00["topiccode"];
                $title = $row00["topictitle"];
                $toprow = $toprow . '<td class="top text-center">' . $code . '</td>';
                //$genrow = $genrow . '<td class="gen"><img src="iimg/pibi.png" width="60" /></td>';
        
                if ($cntpibi == 0) {
                    $col0 = $tid;
                } else if ($cntpibi == 1) {
                    $col1 = $tid;
                } else if ($cntpibi == 2) {
                    $col2 = $tid;
                } else if ($cntpibi == 3) {
                    $col3 = $tid;
                } else if ($cntpibi == 4) {
                    $col4 = $tid;
                } else if ($cntpibi == 5) {
                    $col5 = $tid;
                } else if ($cntpibi == 6) {
                    $col6 = $tid;
                } else if ($cntpibi == 7) {
                    $col7 = $tid;
                } else if ($cntpibi == 8) {
                    $col8 = $tid;
                } else if ($cntpibi == 9) {
                    $col9 = $tid;
                } else if ($cntpibi == 10) {
                    $col10 = $tid;
                } else if ($cntpibi == 11) {
                    $col11 = $tid;
                } else if ($cntpibi == 12) {
                    $col12 = $tid;
                } else if ($cntpibi == 13) {
                    $col13 = $tid;
                } else if ($cntpibi == 14) {
                    $col14 = $tid;
                } else if ($cntpibi == 15) {
                    $col15 = $tid;
                } else if ($cntpibi == 16) {
                    $col16 = $tid;
                } else if ($cntpibi == 17) {
                    $col17 = $tid;
                } else if ($cntpibi == 18) {
                    $col18 = $tid;
                } else if ($cntpibi == 19) {
                    $col19 = $tid;
                } else if ($cntpibi == 20) {
                    $col20 = $tid;
                }


                $cntpibi++;
            }
        }

        $trow = '';
        $grow = '';
        /*
        for($x = 1; $x <= 10 - $cntpibi; $x++){
            $no = $x+$cntpibi;
            $trow = $trow . '<td class="top"></td>';
            $grow = $grow . '<td class="gen"></td>';
        }
        */
        ?>




        <h5 style="padding:15px 8px 5px 8px;"><b>Student's List / ছাত্র/ছাত্রীদের তালিকা</b></h5>
        <!--<h5 style="padding:15px 8px 5px 8px; page-break-before:always;"><b>Student's List / ছাত্র/ছাত্রীদের তালিকা</b></h5>-->


        <table style="width:100%;" id="boxtbl">
            <thead>
                <tr>
                    <td class="" style="width:40px; text-align:center" rowspan="2">Roll</td>
                    <td class="" rowspan="2">Student's Name</td>
                    <td colspan="10">
                        <center><b>Applicable PI/BI</b></center>
                    </td>
                </tr>
                <tr><?php echo $toprow . $trow; ?>
            
                </tr>
            </thead>
            <?php

            $sql0 = "SELECT * from sessioninfo where sessionyear='$sy' and classname='$classname' and sectionname='$sectionname' and sccode = '$sccode' order by rollno LIMIT 3";
            // $sql0 = "SELECT * from sessioninfo where sessionyear='$sy' and classname='$classname' and sectionname='$sectionname' and sccode = '$sccode' and rollno between 1 and 40 order by rollno";
            $result0 = $conn->query($sql0);
            if ($result0->num_rows > 0) {
                while ($row0 = $result0->fetch_assoc()) {
                    $rollno = $row0["rollno"];
                    $stid = $row0["stid"];

                    $sql0x = "SELECT * from students where stid='$stid'";
                    $result0x = $conn->query($sql0x);
                    if ($result0x->num_rows > 0) {
                        while ($row0x = $result0x->fetch_assoc()) {
                            $ben = $row0x["stnameben"];
                            $eng = $row0x["stnameeng"];
                        }
                    }
                    if ($ben == '') {
                        $ben = $eng;
                    }

                    $karl = '';

                    ?>






                    <tr>
                        <td style="width:40px; text-align:center"><?php echo $rollno; ?></td>
                        <td style="font-family:sutonnyOMJ; padding-left:5px;"><?php echo $ben; ?></td>
                        <?php for ($lp = 0; $lp < $cntpibi; $lp++) {
                            $ccc = 'col' . $lp;
                            $ccc = $$ccc; ?>
                            <td style="padding:1px 2px 3px; text-align:center;">
                                <?php

                                // $topicidarr = $ccc;
                                $arrsl = 0;

                                $colors = 0;
                                $arrsl = 0;

                                $fol = 0;

                                // echo '---' . $ccc . '/' . $arrsl . '*' . $fol . '---';
                    
                                // $sql0xr = "SELECT * from pibientry where sessionyear='$sy' and exam='$exam' and subcode='$sub' and sccode='$sccode' and classname='$classname' and sectionname='$sectionname' and stid='$stid' and roll='$rollno' and assesstype='$assess' and topicid='$ccc'";
                                // //echo $sql0xr; 
                                // $result0xr = $conn->query($sql0xr);
                                // if ($result0xr->num_rows > 0) 
                                // {while($row0xr = $result0xr->fetch_assoc()) { 
                                //     $fol=$row0xr["assessment"];}} else {$fol = 0;}
                    
                                $sf = '#fff';
                                $sb = 1;
                                $cf = '#fff';
                                $cb = 1;
                                $tf = '#fff';
                                $tb = 1;
                                ?>
                                <svg width="16" height="16">
                                    <rect width="16" height="16"
                                        style="fill:<?php echo $sf; ?>;stroke-width:<?php echo $sb; ?>;stroke:#000" />
                                </svg>
                                <svg height="16" width="18">
                                    <circle cx="9" cy="8" r="8" stroke="#000" stroke-width="<?php echo $cb; ?>"
                                        fill="<?php echo $cf; ?>" />
                                </svg>
                                <svg height="16" width="16">
                                    <polygon points="8,0,0,16,16,16"
                                        style="fill:<?php echo $tf; ?>;stroke:#000;stroke-width:<?php echo $tb; ?>" />
                                </svg>

                            </td>
                        <?php } ?>

                        <?php

                 
                        echo $grow;
                        ?>
                    </tr>
                <?php }
            } ?>

        </table>


    </div>

</div>
<?php


include 'footer.php';



?>
<script>
    var uri = window.location.href;
    function reload() {
        window.location.href = uri;
    }
    document.getElementById('defbtn').innerHTML = 'Print PI/BI Sheet';

    function defbtn() {
        goprint(0);
    }


    function goprint() {
        // var txt = document.getElementById("alladmit").innerHTML;
        // document.write('<div class="d-print-nones" id="nono"><button style="z-index:9999; position:fixed; right:100px; top:100px; background: seagreen;; color:white; padding:5px; border-radius:5px;"  onclick="reload();">Back to Admit</button><div>');
        // document.write(txt);
        var prnt = document.getElementById('prnt');
        prnt.style.display = 'none';


        var contents = $('html').html();

        var txthead = "" +  document.getElementById("allpr").innerHTML;
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

<script>
    function prnt(id) {
        if (id == 0) {
            $('.level').hide();
            $('.topic').hide();
        } else if (id == 1) {
            $('.level').hide();
            $('.topic').show();
        } else if (id == 2) {
            $('.level').show();
            $('.topic').show();
        }
    }
</script>