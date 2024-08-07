<?php
$sql0 = "SELECT * from salarysummery where sccode='$sccode' and month='$month' and year='$year' and (category='govt' or particulareng LIKE '%govt%') and status = 1 ";  //ORDER BY , ID
$result0qt1 = $conn->query($sql0);
if ($result0qt1->num_rows > 0) {
    while ($row0 = $result0qt1->fetch_assoc()) {
        $refno = $row0["refno"];
        $slotname = $row0["slot"];
        $chqamt = $row0["amount"];
        $refdate = $row0["issuedate"];

        ?>
        <style>
            .ttx {
                font-size: 16px;
            }
        </style>
        <div style="border:0px dashed gray; padding:15mm 15mm; page-break-before:always; ">
            <?php include 'assets/pad/temp-01.php'; ?>




            <div class="ttx" style="margin:10mm auto 0; text-align:center;">
                Expiry date of institution sanction : <b><?php echo date('d - m - Y', strtotime($mpodate)); ?></b>
            </div>
            <div class="ttx" style="margin:0mm auto 0; text-align:center;">
                Last Date of Institution Management Parliament : <b><?php echo date('d - m - Y', strtotime($smcdate)); ?></b>
            </div>
            <div
                style="padding:5px; margin: 20px auto; border-bottom: 0px solid gray; width: 100%; text-align:center; font-size:16px; font-weight:700;">
                <table style="margin:auto;">
                    <tr>
                        <td style="border:1px solid gray; padding:10px;">Month</td>
                        <td style="border:1px solid gray; padding:10px;"><?php echo $mtxt; ?></td>
                    </tr>
                </table>
            </div>

            <div style="padding:5px; margin: 30px auto 0px; width: 100%; text-align:center; font-size:24px; font-weight:700;">
                Bill of Pay Scale / Revolving / Subsidiary Allowances
            </div>

            <div class="ttx" style="text-align:center; margin-bottom:10px;">
                Bangladesh Govt. ------------------------------------------------------------------ donor
            </div>

            <table style="width:100%">
                <tr>
                    <td style="border:1px solid black; border-left:0; padding:10px;"><b><?php echo taka($chqamt); ?></b></td>
                    <td style="border:1px solid black; border-right:0; padding:25px 10px; line-height:2;">
                        Please check the order at ------ Bank ----- branch
                        <br>
                        Number: ----------------------------------------------
                        <br>Date : --------------------------------------------
                    </td>
                </tr>
            </table>

            <div style="padding:5px; margin: 5px auto 0px;width: 100%; text-align:left; font-size:14px; font-weight:500;">
                at Janata Bank Bancharampur branch.
            </div>
            <div style="padding:5px; margin: 20px auto 50px;width: 100%; text-align:left; font-size:14px; font-weight:500;">
                The said amount is kindly requested to be deposited in the respective accounts of the teachers and employees of
                <b><?php echo $scname; ?></b>.
            </div>


            <div style="height:10px;">

            </div>


            <?php include 'assets/pad/seal-both.php'; ?>

            <hr>
            <div style="padding:5px; margin: 5px auto 0px;width: 100%; text-align:left; font-size:14px; font-weight:500;">
                A bill of one hundred rupees was paid.
            </div>



        </div>

    <?php
    

}
} ?>