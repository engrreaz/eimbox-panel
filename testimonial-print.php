<?php include 'inc.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            margin: 0mm !important;
            font-family: 'Segoe UI';
        }



        .clr {
            color: #0088cd !important;
        }

        @page {
            body {
                margin: 0mm !important;
            }

        }

        @media print {
            .clr {
                color: #0088cd !important;
            }

            * {
                margin: 0mm !important;
                font-family: 'Segoe UI';
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>

<body>
    <?php
    $examname = 'SSC';
    $passingyear = $_GET['year'];
    $groupsection = $_GET['sec'];
    $stid = $_GET['stid'];


    //echo '<b>Examination : ' . $examname . ' | Passing Year : ' . $passingyear . ' | Group : ' . $groupsection . '</b><hr>';
    if ($stid == 0) {
        $sql = "SELECT * FROM testimonial where sccode='$sccode' and pubexam='$examname' and passyear='$passingyear' and groupsection='$groupsection' and testslno!=''";
    } else {
        $sql = "SELECT * FROM testimonial where sccode='$sccode' and pubexam='$examname' and passyear='$passingyear' and groupsection='$groupsection' and testslno!='' and stid='$stid'";
    }

    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stid = $row["stid"];
            $exam = $row["pubexam"];
            $rollno = $row["rollno"];
            $group = $row["groupsection"];
            $gpa = $row["gpa"];
            $grade = $row["grade"];
            $passyear = $row["passyear"];
            $regd = $row["regdno"];
            $session = $row["session"];
            $examcenter = $row["examcenter"];
            $testslno = $row["testslno"];
            $testdate = $row["testdate"];
            $sql2 = "SELECT * FROM students where sccode='$sccode' and stid='$stid' ";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $stname = $row2["stnameeng"];
                    $sex = $row2["gender"];
                    $fname = $row2["fname"];
                    $mname = $row2["mname"];
                    $vill = $row2["previll"];
                    $po = $row2["prepo"];
                    $ps = $row2["preps"];
                    $dist = $row2["predist"];
                    $dob = $row2["dob"];
                }
            }

            if (($sex == 'Boy') || ($sex == 'Male')) {
                $lingo = 'S/O';
                $pronoun = 'He';
                $pnoun = 'he';
                $obj = 'His';
            } else {
                $lingo = 'D/O';
                $pnoun = 'she';
                $pronoun = 'She';
                $obj = "Her";
            }

            //echo '<b>' . $stname . '</b><br>';
            //echo $exam . ' - ' . $rollno . '<br>';
            //echo 'Group : ' . $group . ' | Result : ' . $gpa . ' (' . $grade . ')'; 
    
            ?>
            <div style="padding:12mm 20mm 15mm;">
                <div id="pad" style="display:block; text-align:center;">
                    <div style="font-size:10px; font-style:italic; margin: auto;">
                        <?php include ('assets/pad/pad.php'); ?>
                    </div>
                </div>

                <div style="padding : 1mm 5mm; page-break-after:always;">
                    <table style="border:0; width:100%; ">


                        <tr>
                            <td style="height:10mm;" text-align="left" valign="middle">
                                SL : <b><?php echo $testslno; ?></b>
                            </td>
                            <td style="text-align:right" valign="middle" style="">
                                Date : <b><?php echo date('l, d F, Y', strtotime($testdate)); ?></b>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="height:15mm; text-align:center" valign="bottom">
                                <table style="width:100%">
                                    <tr>
                                        <td>
                                            <img src="assets/images/testimonials.jpg" width="250" />
                                        </td>
                                        <td>
                                        <img src="<?php echo $domain; ?>/students/<?php echo $stid; ?>.jpg" width="100px" />
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"
                                style="line-height:1.75; font-family:'Segoe UI'; font-size:16px; text-align:justify;"
                                valign="top">
                                This is to certify that <b><span class=""
                                        style="font-family:'Segoe UI'; font-size:20px;"><?php echo $stname; ?></span></b>
                                <?php echo $lingo . ' : ' . $fname . ' & ' . $mname; ?> of Village :
                                <?php echo $vill; ?>, Post Office : <?php echo $po; ?>, Police Station : <?php echo $ps; ?>,
                                District :
                                <?php echo $dist; ?> was
                                a student of this school. <?php echo $pronoun; ?> passed the <?php echo $exam; ?> Examination in
                                <?php echo $passyear; ?> from
                                this school bearing Roll <strong><?php echo $examcenter; ?></strong> No
                                <strong><?php echo $rollno; ?></strong>, Registration No. <?php echo $regd; ?> Session :
                                <?php echo $session; ?>
                                obtaining <strong><span class="" style="font-family:'Segoe UI'; font-size:16px; ">GPA
                                        <?php echo $gpa . ' (' . $grade . ' Grade) '; ?> </span></strong>
                                from <?php echo $group; ?> group under Comilla Education Board, Comilla.
                                <br><br>
                                To the best of my knowledge <?php echo $pnoun; ?> did not take part in any activities subversive
                                of
                                the
                                state or of discipline.
                                <?php echo $obj; ?> date of birth as per admission register is
                                <?php echo date('l, d F, Y', strtotime($dob)); ?>
                                <br><br>
                                <?php echo $pronoun; ?> bears a good moral character and amiable disposition.
                                <br>
                                I wish <?php echo $obj; ?> bright future and successful life.



                            </td>

                        </tr>
                        <tr>
                            <td colspan="2">
                                <table style="width:100%; ">
                                    <tr>
                                        <td>
                                            <table style="float:left;">
                                                <tr>
                                                    <td
                                                        style="line-height:1; font-family:'Segoe UI'; font-size:10px; text-align:center; padding-top:15px;">
                                                        To Verify this Testimonial,<br>
                                                        Please scan the QR Code<br>

                                                        <?php
                                                        $lnk = 'https://www.dashboard.eimbox.com/qrcode/verifytestimonial.php?slno=' . $testslno . '&id=' . $stid;
                                                        ?>
                                                        <img style="padding: 5px; background:var(--lighter);"
                                                            src="https://quickchart.io/qr?text=<?php echo $lnk; ?>&size=120" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>



                                        <td style="line-height:1; font-family:'Segoe UI'; font-size:11px; text-align:right; "
                                            valign="bottom">

                                            <table style="float:right;">
                                                <tr>
                                                    <td style="text-align:center;">
                                                        <b><?php echo $headname; ?></b><br>
                                                        <?php echo $headtitle; ?> <br>
                                                        <?php echo $scname; ?> <br>
                                                        <?php echo $scaddress; ?>
                                                    </td>
                                                </tr>
                                            </table>





                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>


                    </table>
                </div>
            </div>

            <?php

        }
    }

    ?>
</body>

</html>