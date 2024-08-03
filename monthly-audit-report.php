<?php
include 'header.php';


$refno = '';
$sccodes = $sccode * 10;
$refdate = date('Y-m-d');



if (isset($_GET['month'])) {
    $month = $_GET['month'];
} else {
    $month = date('m');
}


if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date('Y');
}

// if (isset($_GET['df'])) {
//     $datefrom = $_GET['df'];
// } else {
//     $datefrom = date('Y-m-01');
// }

// if (isset($_GET['dt'])) {
//     $dateto = $_GET['dt'];
// } else {
//     $dateto = date('Y-m-d');
// }

$datefrom = date('Y-m-d', strtotime($year . '-' . $month . '-01'));
$dateto = date('Y-m-d', strtotime($year . '-' . $month . '-' . date('t', strtotime($datefrom))));

echo $datefrom . '/' . $dateto;
$col = 3;
$status = 0;

if (isset($_GET['addnew'])) {
    $newblock = 'block';
    $exid = $_GET['addnew'];
    if ($exid == '') {
        $exid = 0;
    }
} else {
    $newblock = 'none';
    $exid = 0;
}


$stprofile = array();
$sql00 = "SELECT * FROM students where  sccode='$sccode'";
$result00 = $conn->query($sql00);
if ($result00->num_rows > 0) {
    while ($row00 = $result00->fetch_assoc()) {
        $stprofile[] = $row00;
    }
}

?>

<h3 class="d-print-none">Monthly Audit Report</h3>
<p class="d-print-none">
    <code>Reports <i class="mdi mdi-arrow-right"></i> Monthly Audit Report </code>
</p>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                </h6>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Date From</label>
                            <div class="col-12">
                                <input type="date" class="form-control  bg-dark " value="<?php echo $datefrom; ?>"
                                    id="datefrom" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Date To</label>
                            <div class="col-12">
                                <input type="date" class="form-control bg-dark" value="<?php echo $dateto; ?>"
                                    id="dateto" disabled />
                            </div>
                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Month</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="month">
                                    <option value="0"></option>
                                    <?php
                                    for ($x = 1; $x <= 12; $x++) {
                                        $flt = '';
                                        $xx = strtotime(date('Y') . '-' . $x . '-01');
                                        if ($month == $x) {
                                            $flt = 'selected';
                                        }
                                        echo '<option value="' . $x . '"' . $flt . '>' . date('F', $xx) . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Year</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="year">
                                    <option value="0"></option>
                                    <?php
                                    for ($y = date('Y'); $y >= 2024; $y--) {
                                        $flt2 = '';
                                        if ($year == $y) {
                                            $flt2 = 'selected';
                                        }
                                        echo '<option value="' . $y . '"' . $flt2 . '>' . $y . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>






                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" class="btn btn-inverse-success btn-block p-2" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Show Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row d-print-none" id="ren" hidden>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row">


                    <div id="pad" style="display:none;">
                        <div style="font-size:10px; font-style:italic;">
                            <?php include ('assets/pad/temp-01.php'); ?>
                        </div>
                    </div>


                    <div id="alladmit">

                        <head>
                            <style>
                                * {
                                    font-family: "Noto Sans Bengali", sans-serif;
                                }

                                #main-tables td,
                                #main-tablel td,
                                #main-tabler td,
                                #main-table td,
                                #main-table-2 td,
                                #main-table-3 td {
                                    border: 1px solid black;
                                    font-size: 11px;
                                    padding: 3px 10px;
                                    border: 1px solid gray;
                                }

                                .txt-right {
                                    text-align: center;
                                    font-weight: bold;
                                    padding: 2px 5px;
                                    border: 1px solid gray !important;
                                }

                                .txt-right2 {
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 2px 5px;
                                    border: 1px solid gray !important;
                                }



                                @media print {

                                    .d-print-nones,
                                    #nono {
                                        display: none;
                                    }
                                }
                            </style>
                        </head>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$bankbal = 0;
$sql0x = "SELECT * FROM bankinfo where sccode='$sccode'  and (closingdate IS NULL or closingdate >= '$dateto')  order by id;";
$sql0x = "SELECT * FROM bankinfo where sccode='$sccode'   order by id;";
$result0r10 = $conn->query($sql0x);
if ($result0r10->num_rows > 0) {
    while ($row0x = $result0r10->fetch_assoc()) {
        $ban = $row0x['accno'];


        $sql0x = "SELECT * FROM banktrans where sccode='$sccode' and accno='$ban' and date < '$datefrom' and verified=1  order by verifytime desc limit 1;";
        $result0r11 = $conn->query($sql0x);
        if ($result0r11->num_rows > 0) {
            while ($row0x = $result0r11->fetch_assoc()) {
                $bankbal += $row0x['balance'];
            }
        }
    }
}




$items = array();
$sql0x = "SELECT * FROM financesetup where (sccode=0 or sccode='$sccode') order by id;";
$result0r1 = $conn->query($sql0x);
if ($result0r1->num_rows > 0) {
    while ($row0x = $result0r1->fetch_assoc()) {
        $items[] = $row0x;
    }
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$deldel = "DELETE FROM audit_temp where sccode='$sccode' and month='$month' and year='$year'";
$conn->query($deldel);

// Collections
$sql0 = "SELECT date, sum(amount) as amount FROM cashbook where  (sccode='$sccode' || sccode='$sccodes')  and income > 0 and particulars LIKE 'Collection%' and date between '$datefrom' and '$dateto'   group by date order by date;";
$result0r1 = $conn->query($sql0);
if ($result0r1->num_rows > 0) {
    while ($row0 = $result0r1->fetch_assoc()) {
        $date = $row0["date"];
        $amt = $row0["amount"];
        $particul = "Collection";
        $in1 = $in2 = $in3 = $out1 = $out2 = $out3 = 0;
        $in1 = $amt;
        $block = 'INSTITUTE';

        $insins = "INSERT INTO audit_temp (id, cashbook_id, sccode, month, year, type, date, particular, institute_in, govt_in, eduboard_in, institute_out, govt_out, bank_out, amount, block) 
                        VALUES (NULL, 0, '$sccode', '$month', '$year', 'Income', '$date', '$particul', '$in1', '$in2', '$in3', '$out1', '$out2', '$out3', '$amt', '$block')";
        $conn->query($insins); //****************************************************************
    }
}

// Govt Salary
$sql0 = "SELECT * FROM cashbook where  (sccode='$sccode' || sccode='$sccodes')  and partid=6 and month = '$month' and year='$year';";
$result0r1 = $conn->query($sql0);
if ($result0r1->num_rows > 0) {
    while ($row0 = $result0r1->fetch_assoc()) {
        $date = $row0["date"];
        $amt = $row0["amount"];
        $type = $row0["type"];
        $particul = "Govt. Salary/MPO";

        $in1 = $in2 = $in3 = $out1 = $out2 = $out3 = 0;
        if ($type == 'Income') {
            $in2 = $amt;
        } else {
            $out2 = $amt;
        }
        $block = 'GOVT';

        $insins = "INSERT INTO audit_temp (id, cashbook_id, sccode, month, year, type, date, particular, institute_in, govt_in, eduboard_in, institute_out, govt_out, bank_out, amount, block) 
                        VALUES (NULL, 0, '$sccode', '$month', '$year', '$type', '$date', '$particul', '$in1', '$in2', '$in3', '$out1', '$out2', '$out3', '$amt', '$block')";
        $conn->query($insins);
    }
}


// Expenses..................................................
$sql0 = "SELECT date, particulars, sum(amount) as amount FROM cashbook where  (sccode='$sccode' || sccode='$sccodes')  and type='Expenditure' and month = '$month' and year='$year' and partid !=6 group by refno order by date;";
$result0r1 = $conn->query($sql0);
if ($result0r1->num_rows > 0) {
    while ($row0 = $result0r1->fetch_assoc()) {
        $date = $row0["date"];
        $amt = $row0["amount"];
        $particulars = 'Aaaa';// $row0["particulars"];
        // $particul = "Govt. Salary/MPO";

        $in1 = $in2 = $in3 = $out1 = $out2 = $out3 = 0;

        $block = '';

        $insins = "INSERT INTO audit_temp (id, cashbook_id, sccode, month, year, type, date, particular, institute_in, govt_in, eduboard_in, institute_out, govt_out, bank_out, amount, block) 
                        VALUES (NULL, 0, '$sccode', '$month', '$year', 'Expenditure', '$date', '$particulars', '$in1', '$in2', '$in3', '$out1', '$out2', '$out3', '$amt', '$block')";
        $conn->query($insins);
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////


// echo var_dump($items);
?>

<div id="datam">

    <div id="apple" class="">
        We, the undersigned members of the Audit Committee, audited the income and expenditure accounts of
        <?php echo $scname; ?> for the month of
        <?php echo $month . '/' . $year . ' (from ' . $datefrom . ' to ' . $dateto . ') on ' . $td; ?>. Thoroughly
        audited all income
        sections and expenditure vouchers including receipts and found correct. All accounts and financial status are
        listed below.
    </div>


    <!-- <div style="page-break-after:always;"></div> -->


    <table style="width:100%;">
        <tr>
            <td style="vertical-align:top;">
                <table class="table table-bordered table-striped "
                    style=" border:1px solid gray !important; border-collapse:collapse; width:100%;" id="main-tablel">
                    <thead>
                        <tr>
                            <th class="txt-right" colspan="6"> <b>Income</b> </th>
                        </tr>
                        <tr>
                            <th class="txt-right"> Date </th>
                            <th class="txt-right"> Description </th>
                            <th class="txt-right"> Institute </th>
                            <th class="txt-right"> Govt. </th>
                            <th class="txt-right"> Others </th>
                            <th class="txt-right"> Total </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $cnt = 0;
                        $cntamt = 0;
                        $takain = 0;
                        $sql0 = "SELECT date, particular, sum(institute_in) as in1, sum(govt_in) as in2, sum(eduboard_in) as in3, sum(amount) as taka FROM audit_temp where  (sccode='$sccode' || sccode='$sccodes')  and type='Income' and amount > 0 and month='$month' and year='$year'   group by date, particular order by date, particular;";
                        // echo $sql0;
                        
                        $result0 = $conn->query($sql0);
                        if ($result0->num_rows > 0) {
                            while ($row0 = $result0->fetch_assoc()) {
                                $date = $row0["date"];
                                $particular = $row0["particular"];
                                $in1 = $row0["in1"];
                                $in2 = $row0["in2"];
                                $in3 = $row0["in3"];
                                $taka = $row0["taka"];

                                ?>
                                <tr>

                                    <td style="padding : 2px 10px; border:1px solid gray;">
                                        <div class="ooo"><?php echo $date; ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray;">
                                        <div class="ooo"><?php echo $particular; ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php if ($in1 > 0)
                                            echo number_format($in1, 2); ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php if ($in2 > 0)
                                            echo number_format($in2, 2); ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php if ($in3 > 0)
                                            echo number_format($in3, 2); ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php echo number_format($taka, 2); ?></div>
                                    </td>
                                </tr>
                                <?php
                                $cnt++;
                                $takain += $taka;
                            }
                        } else {
                            $cnt = 0;
                        }
                        ?>
                        <div id="cntcnt"></div>
                    </tbody>
                </table>
            </td>
            <td style="vertical-align:top;">
                <table class="table table-bordered table-striped "
                    style=" border:1px solid gray !important; border-collapse:collapse; width:100%;" id="main-tabler">
                    <thead>
                        <tr>
                            <th class="txt-right" colspan="6"> <b>Expenditure</b> </th>
                        </tr>
                        <tr>
                            <th class="txt-right"> Date </th>
                            <th class="txt-right"> Description </th>
                            <th class="txt-right"> Institute </th>
                            <th class="txt-right"> Govt. </th>
                            <th class="txt-right"> Others </th>
                            <th class="txt-right"> Total </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $cnt2 = 0;
                        $cntamt = 0;
                        $takaex = 0;
                        // $sql0 = "SELECT * FROM financeitem where (sccode=0 or sccode='$sccode')  order by slno;";
                        // $sql0 = "SELECT partid, sum(income) as inco, sum(expenditure) as expe, sum(amount) as taka FROM cashbook where (sccode='$sccode' || sccode='$sccodes') and expenditure > 0 and date between '$datefrom' and '$dateto' group by partid order by partid;";  and module = 'VOUCHER'
                        $sql0 = "SELECT date, particular, sum(institute_out) as out1, sum(govt_out) as out2, sum(bank_out) as out3, sum(amount) as taka FROM audit_temp where  (sccode='$sccode' || sccode='$sccodes')  and type='Expenditure' and amount > 0 and month='$month' and year='$year'   group by date, particular order by date, particular;";
                        // echo $sql0; 
                        $result02 = $conn->query($sql0);
                        if ($result02->num_rows > 0) {
                            while ($row0 = $result02->fetch_assoc()) {
                                $date = $row0["date"];
                                $particular = $row0["particular"];
                                $out1 = $row0["out1"];
                                $out2 = $row0["out2"];
                                $out3 = $row0["out3"];
                                $taka = $row0["taka"];


                                ?>
                                <tr>

                                    <td style="padding : 2px 10px; border:1px solid gray;">
                                        <div class="ooo"><?php echo $date; ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray;">
                                        <div class="ooo"><?php echo $particular; ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php if ($out1 > 0)
                                            echo number_format($out1, 2); ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php if ($out2 > 0)
                                            echo number_format($out2, 2); ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php if ($out3 > 0)
                                            echo number_format($out3, 2); ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php echo number_format($taka, 2); ?></div>
                                    </td>
                                </tr>
                                <?php
                                $cnt2++;
                                $takaex += $taka;
                            }
                        } else {
                            $cnt2 = 0;
                        }
                        ?>
                        <div id="cntcnt2"></div>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <div style="font-size:16px; font-weight:bold; text-align:center; padding:8px;">Balance Sheet</div>

    <table class="table table-bordered table-striped "
        style=" border:1px solid gray !important; border-collapse:collapse; width:100%;" id="main-table-2">
        <thead>
            <tr>
                <th class="txt-right">Description</th>
                <th class="txt-right">Amount</th>
                <th class="txt-right">Description</th>
                <th class="txt-right">Amount</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Balance Before <?php echo $datefrom; ?></td>
                <td class="txt-right2"><?php echo number_format($bankbal, 2); ?></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Total Income</td>
                <td class="txt-right2"><?php echo number_format($takain, 2); ?></td>
                <td>Total Expenditure</td>
                <td class="txt-right2"><?php echo number_format($takaex, 2); ?></td>
            </tr>

            <?php
            $grand = $bankbal + $takain;
            $tillbal = $grand - $takaex;
            ?>

            <tr>
                <td></td>
                <td></td>
                <td>Balance Till <?php echo $dateto; ?></td>
                <td class="txt-right2"><?php echo number_format($tillbal, 2); ?></td>
            </tr>
            <tr>
                <td></td>
                <td class="txt-right2"><?php echo number_format($grand, 2); ?></td>
                <td></td>
                <td class="txt-right2"><?php echo number_format($grand, 2); ?></td>
            </tr>
        </tbody>
    </table>




    <table style="width:100%; margin-top:5mm;">
        <tr>
            <td style="width:50%;" rowspan="2">
                <table class="table table-bordered table-striped "
                    style=" border:1px solid gray !important; border-collapse:collapse; width:100%;" id="main-table-2">
                    <thead>
                        <tr>
                            <th colspan="2" class="">
                                <div
                                    style="font-size:16px; font-weight:bold; border:0; text-align:center; padding:4px;">
                                    Balance Enquiry</div>
                            </th>
                        </tr>
                        <tr>
                            <th class="txt-right">Description</th>
                            <th class="txt-right">Amount</th>
                    </thead>

                    <tbody>
                        <?php

                        $grandtotal = $thisbal = 0;
                        $sql0 = "SELECT * FROM bankinfo where sccode='$sccode' and (closingdate IS NULL or closingdate >= '$dateto')  order by id;";
                        $sql0 = "SELECT * FROM bankinfo where sccode='$sccode'  order by id;";
                        // echo $sql0; 
                        $result0l = $conn->query($sql0);
                        if ($result0l->num_rows > 0) {
                            while ($row0 = $result0l->fetch_assoc()) {
                                $accnos = $row0["accno"];
                                $acctype = $row0["acctype"];
                                $bankname = $row0["bankname"];
                                $branch = $row0["branch"];


                                $sql0x = "SELECT * FROM banktrans where sccode='$sccode' and accno='$accnos' and date <= '$dateto' and verified=1  order by verifytime desc limit 1;";
                                // echo $sql0x;
                                $result0r12 = $conn->query($sql0x);
                                if ($result0r12->num_rows > 0) {
                                    while ($row0x = $result0r12->fetch_assoc()) {
                                        $thisbal = $row0x['balance'];
                                        $grandtotal += $thisbal;
                                    }
                                } else {
                                    $thisbal = 0;
                                }
                                if ($thisbal > 0) {
                                    ?>
                                    <tr>
                                        <td><?php echo $accnos . ' (' . $acctype . ')'; ?></td>
                                        <td class="text-right"><?php echo number_format($thisbal, 2); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        } ?>
                        <tr>
                            <td>Total :</td>
                            <td class="txt-right2"><?php echo number_format($grandtotal, 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <?php
                $diff = $grandtotal - $tillbal;
                if ($diff < 0) {
                    $notes = 'Short';
                } else if ($diff > 0) {
                    $notes = 'Excess';
                } else {
                    $notes = 'Balanced';
                }
                echo $notes . ' ' . number_format($diff, 2);
                ?>
            </td>

        </tr>
        <tr>
            <td style="text-align:center; vertical-align:bottom;">
                <table style="width:100%; font-size:13px;" class="text-small">
                    <tr>
                        <td style="text-align:center;">
                            Chairman
                        <td style="text-align:center;">
                            Principal
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <?php echo $scname; ?><br>
                            <?php echo $scaddress; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>










</div>

<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    document.getElementById('defbtn').innerHTML = 'Print Student List';
    document.getElementById('defmenu').innerHTML = '';

    bsheet();
    function bsheet() {
        var cont = ''; var cont2 = ''; var cnt = <?php echo $cnt; ?>;
        var cnt2 = <?php echo $cnt2; ?>;
        var tbll = document.getElementById('main-tablel');
        var tblr = document.getElementById('main-tabler');
        if (cnt > cnt2) {
            var ex = cnt - cnt2;
            var lap = 0;

            for (lap = cnt2 + 1; lap <= cnt; lap++) {
                // cont += '<tr><td style="padding : 3px 10px; border:1px solid gray;"></td><td style="padding : 3px 10px; border:1px solid gray;"></td></tr>';
                var row = tblr.insertRow(lap);
                var cell1 = row.insertCell(0);
                cell1.innerHTML = "";
                var cell2 = row.insertCell(1);

                cell2.style.padding = '2px';
                cell2.innerHTML = "&nbsp;";
            }
        } else if (cnt2 > cnt) {
            var ex = cnt2 - cnt;
            var lap = 0;

            for (lap = cnt + 1; lap <= cnt2; lap++) {
                // cont += '<tr><td style="padding : 3px 10px; border:1px solid gray;"></td><td style="padding : 3px 10px; border:1px solid gray;"></td></tr>';
                var row = tbll.insertRow(lap);
                var cell1 = row.insertCell(0);
                cell1.innerHTML = "";
                var cell2 = row.insertCell(1);

                cell2.style.padding = '2px';
                cell2.innerHTML = "&nbsp;";
            }
        }

        var totalno = 0;
        if (cnt > cnt2) { totalno = cnt + 1; } else { totalno = cnt2 + 1; }


        var rowx = tbll.insertRow(totalno);
        var rowy = tblr.insertRow(totalno);
        rowx.innerHTML = '<td>Total :</td><td style="text-align:right; padding: 5px; font-weight:700;"><?php echo number_format($takain, 2); ?></td>';
        rowy.innerHTML = '<td>Total :</td><td style="text-align:right; padding: 5px; font-weight:700;"><?php echo number_format($takaex, 2); ?></td>';



        console.log(cnt);
        console.log(cnt2);


        // cont += '<tr><td style="padding : 3px 10px; border:1px solid gray;">Total :</td><td style="padding : 3px 10px; border:1px solid gray;"><?php echo $cnt; ?></td></tr>';
        // document.getElementById('cntcnt').innerHTML = cont;
        // cont2 += '<tr><td style="padding : 3px 10px; border:1px solid gray;">Total :</td><td style="padding : 3px 10px; border:1px solid gray;"><?php echo $cnt2; ?></td></tr>';
        // document.getElementById('cntcnt2').innerHTML = cont2;
        console.log(cont);
        console.log(cont2);

    }





    document.getElementById("cntcnt").innerHTML;


    function defbtn() {
        goprint(0);
    }
    function reload() {
        window.location.href = uri;
    }
    function resultentry(roll) {
        if (roll == 0) {
            document.getElementById('boardroll').value = '';
        } else {
            document.getElementById('boardroll').value = roll;
        }

        document.getElementById('ren').style.display = 'block';
        document.getElementById('boardroll').focus();
    }




    function goprint() {
        var txt = document.getElementById("alladmit").innerHTML;
        var pad = document.getElementById("pad").innerHTML;
        var datam = document.getElementById("datam").innerHTML;
        document.write('<title>Eimbox</title>');
        document.write('<div class="d-print-nones" id="nono"><button style="z-index:9999; position:fixed; right:100px; top:50px; background: black;; color:white; padding:5px; border-radius:5px;"  onclick="reload();">Back to  List</button></div>');
        document.write('<div id="margin" style="padding: 5mm 15mm;"></div>');
        // document.write(pad);
        document.getElementById("margin").innerHTML = pad + txt + datam;
        // document.write(txt);
    }

    function go() {
        // var datefrom = document.getElementById('month').value;
        // var dateto = document.getElementById('dateto').value;
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        window.location.href = 'monthly-audit-report.php?&month=' + month + '&year=' + year;
    }
</script>

<script>
    function issue(stid) {
        window.location.href = 'students-edit.php?stid=' + stid;
    }
    function issuet(stid) {
        window.location.href = 'student-profile.php?stid=' + stid;
    }
</script>

<script>
    function fetchs(e) {
        if (e.key == 'Enter') {
            var br = document.getElementById("boardroll").value;
            var infor = "br=" + br;

            $("#sscspan").html("");

            $.ajax({
                type: "POST",
                url: "backend/fetch-board-roll.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#sscspan').html('<small>Processing...</small>');
                },
                success: function (html) {
                    $("#sscspan").html(html);
                    var st = document.getElementById("sscspan").innerHTML;

                    if (st == 'Something went wrong.') {
                        document.getElementById("sscspan").innerHTML = '<code>' + st + '</code><br>Data Missing or Multiple Entry Found.';
                    } else {
                        document.getElementById("stname").value = st;
                        document.getElementById("sscspan").innerHTML = '';
                        document.getElementById("gpagla").focus();
                    }
                }
            });
        }
    }

    function svs(e) {
        if (e.key == 'Enter') {
            savessc();
        }
    }

    function savessc() {
        var br = document.getElementById("boardroll").value;
        var gpgl = document.getElementById("gpagla").value;
        var infor = "br=" + br + "&gpgl=" + gpgl;

        $("#sscspan").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-board-result.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sscspan').html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#sscspan").html(html);
                var st = parseInt(document.getElementById("boardroll").value) + 1;
                document.getElementById("boardroll").value = st;
                document.getElementById("gpagla").value = '';
                document.getElementById("boardroll").focus();

            }
        });
    }
</script>