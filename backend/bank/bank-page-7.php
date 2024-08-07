<?php
$sql0 = "SELECT * from salarysummery where sccode='$sccode' and month='$month' and year='$year' and category='expenditure' and status=1";  //ORDER BY , ID
$result0qt1 = $conn->query($sql0);
if ($result0qt1->num_rows > 0) {
    while ($row0 = $result0qt1->fetch_assoc()) {
        $refno = $row0["refno"];
        $slotname = $row0["slot"];
        $chqamt = $row0["amount"];
        $refdate = $row0["issuedate"];
        $chqno = $row0["chequeno"];
        ?>

        <style>
            .pacpac {
                font-size: 16px;
            }

            .right {
                text-align: right;
            }
        </style>

        <div style="border:0px dashed gray; padding:15mm 25mm;   page-break-before:always; ">
            <?php include 'assets/pad/temp-01.php'; ?>



            <div
                style="padding:5px; margin: 0px auto; border-bottom: 0px solid gray; width: 40%; text-align:center; font-size:22px; font-weight:500;">
                Details of all expenses (<?php echo $slotname; ?>)
            </div>


            <div style="height:3px;"></div>
            <table style="width:100%; font-size:14px;" class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="6" style="font-size:24px; text-align:center; padding-top:25px;">Month : &nbsp;&nbsp;&nbsp;
                            <?php echo $mtxt; ?></th>
                    </tr>
                    <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Pool</th>
                        <th>Memo</th>
                        <th>Description</th>
                        <th class="right">Amount (BDT)</th>
                    </tr>
                </thead>
                <?php
                $sl = 1;
                $taka7 = 0;
                $sccode2 = $sccode * 10;
                $sql0 = "SELECT * from cashbook where (sccode='$sccode2' or sccode='$sccode') and month='$month' and year='$year'   and type='Expenditure' and slots='$slotname' order by memono, date ;"; //echo $sql0;
                $result0qt2 = $conn->query($sql0);
                if ($result0qt2->num_rows > 0) {
                    while ($row0 = $result0qt2->fetch_assoc()) {
                        $partid = $row0["partid"];
                        $date = $row0["date"];
                        $mno = $row0["memono"];
                        $parti = $row0["particulars"];
                        $amount = $row0["amount"];

                        $sql0 = "SELECT * from financesetup where id='$partid' and sccode = '$sccode'  ";
                        $result0qt3 = $conn->query($sql0);
                        if ($result0qt3->num_rows > 0) {
                            while ($row0 = $result0qt3->fetch_assoc()) {
                                $khat = $row0["particularben"];
                                $posi = $row0["position"];
                                $mpoindex = $row0["mpoindex"];
                            }
                        }

                        ?>
                        <tr>
                            <td class="pacpac"><?php echo $sl; ?></td>
                            <td class="pacpac"><?php echo date('d/m/Y', strtotime($date)); ?></td>
                            <td class="pacpac"><?php echo $khat; ?></td>
                            <td class="pacpac"><?php echo $mno; ?></td>
                            <td class="pacpac"><?php echo $parti; ?></td>
                            <td class="pacpac right"><?php echo $amount; ?></td>
                        </tr>
                        <?php
                        $sl++;
                        $taka7 += $amount;
                    }
                }


                ?>
                <thead>
                    <tr>
                        <th colspan="5">Grand Total :</th>
                        <th class="right"><?php echo $taka7; ?></th>
                    </tr>
                </thead>

            </table>

            <div style="font-size:13px;">
                Amount in word : <b><?php echo taka($taka7); ?></b>
            </div>


            <?php include 'assets/pad/seal-both.php'; ?>

        </div>


    <?php }
} ?>