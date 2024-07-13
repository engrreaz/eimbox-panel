<?php
include 'header.php';


$refno = '';
$sccodes = $sccode * 10;
$refdate = date('Y-m-d');

if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date('Y');
}

if (isset($_GET['cls'])) {
    $cls2 = $_GET['cls'];
} else {
    $cls2 = '';
}
if (isset($_GET['sec'])) {
    $sec2 = $_GET['sec'];
} else {
    $sec2 = '';
}
if (isset($_GET['exam'])) {
    $exam2 = $_GET['exam'];
} else {
    $exam2 = '';
}

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

<h3 class="d-print-none">Student's List</h3>
<p class="d-print-none">
    <code>Reports <i class="mdi mdi-arrow-right"></i> Students List </code>
</p>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                </h6>
                <div class="row">
                    <div class="col-md-3">
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

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class :</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="cls" onchange="go();">
                                    <option value=" ">---</option>
                                    <?php
                                    $sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear='$year' group by areaname order by idno;";
                                    $result0x = $conn->query($sql0x);
                                    if ($result0x->num_rows > 0) {
                                        while ($row0x = $result0x->fetch_assoc()) {
                                            $cls = $row0x["areaname"];
                                            if ($cls == $cls2) {
                                                $selcls = 'selected';
                                            } else {
                                                $selcls = '';
                                            }
                                            echo '<option value="' . $cls . '" ' . $selcls . ' >' . $cls . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Section</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="sec" onchange="go();">
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT subarea FROM areas where user='$rootuser' and sessionyear='$year' and areaname='$cls2' group by subarea order by idno;";
                                    // echo $sql0x;
                                    $result0r = $conn->query($sql0x);
                                    if ($result0r->num_rows > 0) {
                                        while ($row0x = $result0r->fetch_assoc()) {
                                            $sec = $row0x["subarea"];
                                            if ($sec == $sec2) {
                                                $selsec = 'selected';
                                            } else {
                                                $selsec = '';
                                            }
                                            echo '<option value="' . $sec . '" ' . $selsec . ' >' . $sec . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" class="btn btn-inverse-success btn-block p-2" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Show List
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
                                    font-size: 12px;
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
$datefrom = '2024-06-01';
$dateto = '2024-07-10';

$sql0x = "SELECT * FROM bankinfo where sccode='$sccode' order by id;";
$result0r10 = $conn->query($sql0x);
if ($result0r10->num_rows > 0) {
    while ($row0x = $result0r10->fetch_assoc()) {
        $ban = $row0x['accno'];

        $bankbal = 0;
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

// echo var_dump($items);
?>

<div id="datam">

    <table class="table table-bordered table-striped "
        style=" border:1px solid gray !important; border-collapse:collapse; width:100%; display:none;" id="main-tables">
        <thead>
            <tr>
                <th class="txt-right">#</th>
                <th class="txt-right">Description</th>
                <th class="txt-right">Income</th>
                <th class="txt-right">Amount</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $cnt = 0;
            $cntamt = 0;
            $sql0 = "SELECT * FROM financeitem where (sccode=0 or sccode='$sccode')  order by slno;";
            $sql0 = "SELECT partid, sum(income) as inco, sum(expenditure) as expe, sum(amount) as taka FROM cashbook where  (sccode='$sccode' || sccode='$sccodes')  and date between '$datefrom' and '$dateto' group by partid order by partid;";
            // echo $sql0; 
            $result0 = $conn->query($sql0);
            if ($result0->num_rows > 0) {
                while ($row0 = $result0->fetch_assoc()) {
                    $partid = $row0["partid"];
                    $inco = $row0["inco"];
                    $expe = $row0["expe"];
                    $taka = $row0["taka"];


                    $ind = array_search($partid, array_column($items, 'id'));
                    $parttext = $items[$ind]['particularben'];

                    ?>
                    <tr>
                        <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                            <?php
                            ;
                            ?>
                        </td>
                        <td style="padding : 3px 10px; border:1px solid gray;">
                            <div class="ooo"><?php echo $parttext; ?></div>
                        </td>
                        <td style="padding : 3px 10px; border:1px solid gray; text-align:right;">
                            <div class="ooo"><?php echo $inco; ?></div>
                        </td>


                        <td style="padding : 3px 10px; border:1px solid gray; text-align:right;">
                            <div class="ooo"><?php echo $expe; ?></div>
                        </td>


                    </tr>
                    <?php
                    $cnt++;
                }
            }
            ?>
        </tbody>
    </table>


    <!-- <div style="page-break-after:always;"></div> -->


    <table style="width:100%;">
        <tr>
            <td style="vertical-align:top;">
                <table class="table table-bordered table-striped "
                    style=" border:1px solid gray !important; border-collapse:collapse; width:100%;" id="main-tablel">
                    <thead>
                        <tr>
                            <th class="txt-right">Description</th>
                            <th class="txt-right">Income</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $cnt = 0;
                        $cntamt = 0;
                        $takain = 0;
                        $sql0 = "SELECT * FROM financeitem where (sccode=0 or sccode='$sccode')  order by slno;";
                        $sql0 = "SELECT partid, sum(income) as inco, sum(expenditure) as expe, sum(amount) as taka FROM cashbook where  (sccode='$sccode' || sccode='$sccodes')  and income > 0 and date between '$datefrom' and '$dateto' group by partid order by partid;";
                        // echo $sql0; 
                        $result0 = $conn->query($sql0);
                        if ($result0->num_rows > 0) {
                            while ($row0 = $result0->fetch_assoc()) {
                                $partid = $row0["partid"];
                                $inco = $row0["inco"];
                                $expe = $row0["expe"];
                                $taka = $row0["taka"];

                                $ind = array_search($partid, array_column($items, 'id'));
                                $parttext = $items[$ind]['particularben'];

                                ?>
                                <tr>

                                    <td style="padding : 2px 10px; border:1px solid gray;">
                                        <div class="ooo"><?php echo $parttext; ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php echo $inco; ?></div>
                                    </td>
                                </tr>
                                <?php 
                                $cnt++;
                                $takain += $inco;
                            }
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
                            <th class="txt-right">Description</th>
                            <th class="txt-right">Expenditure</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $cnt2 = 0;
                        $cntamt = 0;
                        $takaex = 0;
                        $sql0 = "SELECT * FROM financeitem where (sccode=0 or sccode='$sccode')  order by slno;";
                        $sql0 = "SELECT partid, sum(income) as inco, sum(expenditure) as expe, sum(amount) as taka FROM cashbook where (sccode='$sccode' || sccode='$sccodes') and expenditure > 0 and date between '$datefrom' and '$dateto' group by partid order by partid;";
                        // echo $sql0; 
                        $result02 = $conn->query($sql0);
                        if ($result02->num_rows > 0) {
                            while ($row0 = $result02->fetch_assoc()) {
                                $partid = $row0["partid"];
                                $inco = $row0["inco"];
                                $expe = $row0["expe"];
                                $taka = $row0["taka"];

                                $ind = array_search($partid, array_column($items, 'id'));
                                $parttext = $items[$ind]['particularben'];

                                ?>
                                <tr>

                                    <td style="padding : 2px 10px; border:1px solid gray;">
                                        <div class="ooo"><?php echo $parttext; ?></div>
                                    </td>
                                    <td style="padding : 2px 10px; border:1px solid gray; text-align:right;">
                                        <div class="ooo"><?php echo $expe; ?></div>
                                    </td>
                                </tr>
                                <?php
                                $cnt2++;
                                $takaex += $expe;
                            }
                        }
                        ?>
                        <div id="cntcnt2"></div>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <div>Balance Sheet</div>

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
                <td class="txt-right2"><?php echo number_format($bankbal); ?></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Total Income</td>
                <td class="txt-right2"><?php echo number_format($takain); ?></td>
                <td>Total Expenditure</td>
                <td class="txt-right2"><?php echo number_format($takaex); ?></td>
            </tr>

            <?php
            $grand = $bankbal + $takain;
            $tillbal = $grand - $takaex;
            ?>

            <tr>
                <td></td>
                <td></td>
                <td>Balance Till <?php echo $dateto; ?></td>
                <td class="txt-right2"><?php echo number_format($tillbal); ?></td>
            </tr>
            <tr>
                <td></td>
                <td class="txt-right2"><?php echo number_format($grand); ?></td>
                <td></td>
                <td class="txt-right2"><?php echo number_format($grand); ?></td>
            </tr>
        </tbody>
    </table>


    <div>Balance Enquiry</div>

    <table style="width:100%;">
        <tr>
            <td style="width:50%;">
                <table class="table table-bordered table-striped "
                    style=" border:1px solid gray !important; border-collapse:collapse; width:100%;" id="main-table-2">
                    <thead>
                        <tr>
                            <th class="txt-right">Description</th>
                            <th class="txt-right">Amount</th>
                    </thead>

                    <tbody>
                        <?php
                        $sql0 = "SELECT * FROM bankinfo where sccode='$sccode'  order by id;";
                        // echo $sql0; 
                        $result0l = $conn->query($sql0);
                        if ($result0l->num_rows > 0) {
                            while ($row0 = $result0l->fetch_assoc()) {
                                $accnos = $row0["accno"];
                                $acctype = $row0["acctype"];
                                $bankname = $row0["bankname"];
                                $branch = $row0["branch"];

                                $grandtotal = $thisbal = 0;
                                $sql0x = "SELECT * FROM banktrans where sccode='$sccode' and accno='$accnos' and date <= '$dateto' and verified=1  order by verifytime desc limit 1;";
                                $result0r12 = $conn->query($sql0x);
                                if ($result0r12->num_rows > 0) {
                                    while ($row0x = $result0r12->fetch_assoc()) {
                                        $thisbal = $row0x['balance'];
                                        $grandtotal += $thisbal;
                                    }
                                }
                                ?>
                                <tr>
                                    <td><?php echo $accnos . ' (' . $acctype . ')'; ?></td>
                                    <td class="txt-right2"><?php echo number_format($thisbal,2); ?></td>
                                </tr>
                            <?php

                            }
                        } ?>
                        <tr>
                            <td>Total :</td>
                            <td class="txt-right2"><?php echo number_format($grandtotal,2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align:center; vertical-align:bottom;">
                <table style="width:100%;" class="text-small">
                    <tr>
                        <td>
                            Chairman<br>
                            <br>
                            <?php echo $scname;?><br>
                            <?php echo $scaddress;?>
                        </td>
                        <td>
                            Principal<br>
                            <?php ?><br>
                            <?php echo $scname;?><br>
                            <?php echo $scaddress;?>
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
                cell1.innerHTML = "&nbsp;";
                var cell2 = row.insertCell(1);
                cell2.innerHTML = "";
            }
        } else if (cnt2 > cnt) {
            var ex = cnt2 - cnt;
            var lap = 0;

            for (lap = cnt + 1; lap <= cnt2; lap++) {
                // cont += '<tr><td style="padding : 3px 10px; border:1px solid gray;"></td><td style="padding : 3px 10px; border:1px solid gray;"></td></tr>';
                var row = tbll.insertRow(lap);
                var cell1 = row.insertCell(0);
                cell1.innerHTML = "&nbsp;";
                var cell2 = row.insertCell(1);
                cell2.innerHTML = "";
            }
        }

        var totalno = 0;
        if (cnt > cnt2) { totalno = cnt + 1; } else { totalno = cnt2 + 1; }


        var rowx = tbll.insertRow(totalno);
        var rowy = tblr.insertRow(totalno);
        rowx.innerHTML = '<td>Total :</td><td style="text-align:right; padding: 5px; font-weight:700;"><?php echo $takain; ?></td>';
        rowy.innerHTML = '<td>Total :</td><td style="text-align:right; padding: 5px; font-weight:700;"><?php echo $takaex; ?></td>';



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
        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        window.location.href = 'students-list.php?&cls=' + cls + '&sec=' + sec + '&year=' + year;
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