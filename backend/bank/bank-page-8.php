<style>
    .pacpac {
        font-size: 16px;
    }

    .right {
        text-align: right;
    }
</style>

<div style="border:0px dashed gray; padding:15mm 25mm; width:100%; page-break-beforec:always; ">
    <?php $refdate = $td;
    include 'assets/pad/temp-01.php'; ?>



    <div
        style="padding:5px; margin: 0px auto; border-bottom: 1px solid gray; width: 60%; text-align:center; font-size:22px; font-weight:500;">
        Salary/Allowance & Expenditure : At-A-Glance
        <br><br>
        <span style="font-size:17px;">Month : &nbsp;&nbsp;&nbsp; <?php echo $mtxt; ?></span>
    </div>


    <div style="height:30px;"></div>
    <table style="width:100%; font-size:14px;" class="table table-striped">
        <thead>
            <tr>
                <th>SL</th>
                <th>Div/Sector</th>
                <th>Type</th>
                <th>Ref No.</th>
                <th>Cheque No.</th>
                <th class="right">Amount (BDT)</th>
            </tr>
        </thead>
        <?php
        $sl = 1;
        $taka8 = 0;
        $sccode2 = $sccode * 10;
        $sql0 = "SELECT * from salarysummery where sccode='$sccode' and month='$month' and year='$year' and chequeno!=''  order by slot, refno;";
        $result0qt2 = $conn->query($sql0);
        if ($result0qt2->num_rows > 0) {
            while ($row0 = $result0qt2->fetch_assoc()) {
                $slt = $row0["slot"];
                $cates = $row0["category"];
                $chq = $row0["chequeno"];
                // $parti = $row0["particulars"];
                $amount = $row0["amount"];
                $refn = $row0["refno"];

                if ($cates == 'govt') {
                    $cate = 'Govt. Salary';
                } else if ($cates == 'school') {
                    $cate = $slt . ' Salary';
                } else if ($cates == 'pf') {
                    $cate = 'Providend Fund';
                } else if ($cates == 'expenditure') {
                    $cate = 'Expenditure';
                } else if ($cates == 'Eid') {
                    $cate = 'Govt. Festival Bonus';
                } else if ($cates == 'Boishakhi') {
                    $cate = 'Boishakhi Allowance';
                } else {
                    $cate = '***';
                }

                // $sql0 = "SELECT * from teacher where tid='$tid' and sccode = '$sccode'  ";
                // $result0qt3 = $conn->query($sql0);
                // if ($result0qt3->num_rows > 0) {
                //     while ($row0 = $result0qt3->fetch_assoc()) {
                //         $tname = $row0["tname"];
                //         $posi = $row0["position"];
                //         $mpoindex = $row0["mpoindex"];
                //     }
                // }
        
                ?>
                <tr>
                    <td class="pacpac"><?php echo $sl; ?></td>
                    <td class="pacpac"><?php echo $slt; ?></td>
                    <td class="pacpac"><?php echo strtoupper($cate); ?></td>
                    <td class="pacpac"><?php echo $refn; ?></td>
                    <td class="pacpac"><?php echo $chq; ?></td>
                    <td class="pacpac right"><?php echo number_format($amount, 2, ".", ","); ?></td>
                </tr>
                <?php
                $sl++;
                $taka8 += $amount;
            }
        } else {
            $taka8 = 0;
        }


        ?>
        <thead>
            <tr>
                <th colspan="5">Grand Total :</th>
                <th class="right"><?php echo number_format($taka8, 2, ".", ","); ?></th>
            </tr>
        </thead>

    </table>

    <div style="font-size:13px;">
        Amount in word : <b>Taka <?php echo taka($taka8); ?> Only.</b>
    </div>


    <?php include 'assets/pad/seal-both.php'; ?>

</div>