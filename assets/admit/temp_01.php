<style>
    #rout td{border:1px solid black;}
    </style>

<tr>
    <td valign="top" class="backpic" background="assets/admit/sample_02.png"
        style="width:210mm;  max-height:140mm; padding:3mm;   font-family:'Segoe UI';">

        <table style="font-size:10px; width:100%; border:0;" class="hideshow">
            <tr>
                <td height="1px"></td>
                <td></td>
            </tr>
            <tr>
                <td width="195px" style="padding-right:0px; text-align:right;" vlign="top">

                    <img src="https://eimbox.com/logo/<?php echo $sccode; ?>.png" width="100px" />
                </td>
                <td style="color:black; padding-left:20px;  font-family:'Segoe UI'; font-size:20px;" vlign="top">
                    <b><?php echo $scname; ?></b>



                    <div style="font-size:12px;">
                        <?php echo $scadd1 . ', ' . $ps . ', ' . $dist; ?>
                    </div>
                    <div style="font-size:12px;">
                        <?php echo 'Contact : ' . $mobile; ?>
                    </div>
                    <div style="text-align:center;">
                        <img src="assets/admit/admit.png" width="200px" style="margin-left:0; " />
                    </div>


                    <div style=" padding:0; margin-top:0px; font-family:Segoe UI; font-size:12px; font-weight: bold; ">
                        <?php echo $exam2 . ' Examination - ' . $sy; ?>
                    </div>

                </td>
            </tr>

        </table>

        <table style="font-size:12px; width:100%; border:0;">
            <tr>


                <td valign="top" style="padding: 8px 0 8px 50px;">
                    Name of Student<br><span style="font-size:18px;  font-weight:bold;"><?php echo $stnameeng; ?></span>
                    <br>
                    Class : <b><?php echo $classname; ?></b>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $secgr; ?> : <b><?php echo $sectionname; ?></b>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Roll : <b><?php echo $rollno; ?></b>
                    <br>
                    Student's ID : <?php echo $stid; ?>
                </td>

                <td style="padding-right:1px;" width="105px">
                    <?php
                    $file_pointer = "../students/" . $stid . ".jpg";
                    if (file_exists($file_pointer) === TRUE) {
                        ?>
                    <img src="<?php echo $domain; ?>/students/<?php echo $stid; ?>.jpg" alt="" height="85px"
                        style="border-radius:0%; border : 1px solid black; padding:3px; " />
                    <?php } else { ?>
                    <img src="http://www.eimbox.com/admit/noimg.jpg" alt="" height="90px"
                        style="border-radius:0%; border : 1px solid black; padding:3px; right:10px;" />

                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left:30px;">
                    <table width="100%">
                        <tr>
                            <td style="padding-right:10px; width:55%;">
                                <table id="rout"
                                    style="width:100%; border:1px solid gray; border-collapse:collapse; font-size:10px;">
                                    <tr>
                                        <td style="text-align:center"><b>Date</b></td>
                                        <td style="text-align:center"><b>Time</b></td>
                                        <td style="text-align:center"><b>Subject</b></td>
                                    </tr>

                                    <?php
                                    $sqlww = "SELECT * FROM examroutine WHERE sccode='$sccode' and clsname = '$classname' and secname='$sectionname' and examname='$exam2' and sessionyear='$sy' order by date, time";

                                    $resultww = $conn->query($sqlww);
                                    if ($resultww->num_rows > 0) {
                                        while ($rowww = $resultww->fetch_assoc()) {
                                            $edate = $rowww["date"];
                                            $etime = $rowww["time"];
                                            $subj = $rowww["subj"];
                                            ?>
                                    <tr>
                                        <td style="text-align:center"><?php echo date('l, d/m/Y', strtotime($edate)); ?>
                                        </td>
                                        <td style="text-align:center"><?php echo date('h:i:s A', strtotime($etime)); ?>
                                        </td>
                                        <td style="text-align:center"><?php echo $subj; ?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </table>
                            </td>


                            <td style="font-size:11px; padding-bottom:10px; text-align:center;" valign="bottom">
                                <table style="width:100%; text-align:center; ">
                                    <tr>
                                        <td colspan="2" style="text-align:left; font-size:10px;">
                                            <ul>
                                                <li>Don’t be late. Report to the hall min 15 min. before the exam
                                                    starts.</li>
                                                <li>Carry your admit card and occupy the seat where your roll is marked.
                                                </li>
                                                <li>Carry your own stationary with calculator. Programmable Calculator
                                                    and any electronic gadgets are not allowed.</li>
                                                <li>Don’t exchange stationary or calculator with others without
                                                    invigilator permission.</li>
                                                <li>Don’t tear/damage your seat card on desk.</li>
                                                <li>Don’t any misbehave/argue with invigilator and others.</li>
                                                <li>Submit all of invalid equipment/docs to the invigilator before start
                                                    exam and collect them before exiting hall.</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:12px;">
                                            <!-- <img src="<?php echo 'https://eimbox.com/sign/' . $sccode; ?>.png"
                                                width="90px" /><br> -->
                                            Class Teacher
                                        </td style="font-size:12px;">
                                        <td style="font-size:12px;">
                                            <img src="<?php echo 'https://eimbox.com/sign/' . $sccode; ?>.png"
                                                height="42px" /><br>
                                            <?php echo '<b>' . $headname . '</b><br>' . $headtitle; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="font-size:10px;">
                                            <?php echo $scname; ?><br>
                                            <?php echo $scadd1 . ', ' . $ps . ', ' . $dist; ?>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
                </td>

            </tr>
            <tr>
                <td valign="top">



                </td>
            </tr>
        </table>

    </td>
</tr>
