<?php
$sql0 = "SELECT * from salarysummery where sccode='$sccode' and month='$month' and year='$year' and category='school' and status = 1";  //ORDER BY , ID
$result0qt1 = $conn->query($sql0);
if ($result0qt1->num_rows > 0) {
    while ($row0 = $result0qt1->fetch_assoc()) {
        $refno = $row0["refno"];
        $slotname = $row0["slot"];
        $chqamt = $row0["amount"];
        $refdate = $row0["issuedate"];
        $chqno = $row0["chequeno"];
        $chqamt = 226598;
        ?>

        <div style="border:0px dashed gray; padding:10mm 25mm;   page-break-before:always; ">
            <?php include 'assets/pad/temp-01.php'; ?>


            <div style="">
                To,<br>
                The Manager,<br>
                <?php echo $pfbankname; ?>Janata Bank Limited<br>
                <?php echo $pfbrname; ?>Ramkrisnopur Branch, Homna, Cumilla.<br>

                <div style="height:5px;"></div>
                Subject : <b>Regarding depositing a total of <?php echo $chqamt; ?> taka in the following bank accounts.</b>
                <div style="height:15px;"></div>
                Sir,
                <br>
                It is requested to deposit taka =<?php echo $chqamt; ?>/- (<?php echo taka($chqamt); ?>) received for the
                honorarium of <span id="cnt"></span> teachers / staffs in the institute in the following bank accounts.
                <br>
                Cheque No. <?php echo $chqno; ?>
            </div>

            <div
                style="padding:5px; margin: 10px auto; border-bottom: 1px solid gray; width: 40%; text-align:center; font-size:16px; font-weight:700;">
                Month : &nbsp;&nbsp;&nbsp; <?php echo $mtxt; ?>
            </div>

            <div style="height:3px;"></div>
            <table style="width:100%; font-size:14px;" class="table table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name of Teacher's/Staff's</th>
                        <th>Designation</th>
                        <th>Name of Bank</th>
                        <th>Branch Name</th>
                        <th>Account No.</th>
                        <th style="text-align:right;">Amount (BDT)</th>
                    </tr>
                </thead>
                <?php
                $sl = 1;
                $taka3 = 0;
                $sql0 = "SELECT * from salarydetails where refnosch='$refno' and slots = '$slotname' order by bankbrsch, ranks, joindate ";
                $result0qt2 = $conn->query($sql0);
                if ($result0qt2->num_rows > 0) {
                    while ($row0 = $result0qt2->fetch_assoc()) {
                        $tid = $row0["tid"];
                        $amount = $row0["salary"];
                        $accno = $row0["accnosch"];
                        $bname = $row0["banknamesch"];
                        $bbr = $row0["bankbrsch"];
                        $ttk = $row0["school"];

                        $sql0 = "SELECT * from teacher where tid='$tid' and sccode = '$sccode'  ";
                        $result0qt3 = $conn->query($sql0);
                        if ($result0qt3->num_rows > 0) {
                            while ($row0 = $result0qt3->fetch_assoc()) {
                                $tname = $row0["tname"];
                                $posi = $row0["position"];
                                $mpoindex = $row0["mpoindex"];
                            }
                        }

                        ?>
                        <tr>
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $tname; ?></td>
                            <td><?php echo $posi; ?></td>
                            <td><?php echo $bname; ?></td>
                            <td><?php echo $bbr; ?></td>
                            <td><?php echo $accno; ?></td>
                            <td style="text-align:right;"><?php echo $ttk; ?></td>
                        </tr>
                        <?php
                        $sl++;
                        $taka3 += $ttk;
                    }
                }


                ?>
                <thead>
                    <tr>
                        <th colspan="6">Grand Total :</th>
                        <th style="text-align:right; font-size:16px;"><?php echo $taka3; ?></th>
                    </tr>
                </thead>

            </table>

            <div style="font-size:13px;">
                Amount in word : <b>Taka <?php echo taka($taka3); ?> Only.</b>
            </div>


            <?php include 'assets/pad/seal.php'; ?>

        </div>


    <?php }
} ?>