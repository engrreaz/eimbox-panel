<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;
if (isset($_GET['m'])) {
    $month = $_GET['m'];
} else {
    $month = 0;
}
if (isset($_GET['y'])) {
    $year = $_GET['y'];
} else {
    $year = 0;
}


?>
<style>
    .amt {
        width: 50px;
        background: dimgray;
        color: lightgray;
        padding: 6px 3px;
        text-align: center;
        border: 1px solid white;
        border-radius: 5px;
    }

    .amt2 {
        padding: 0;
        margin: 0;
    }
</style>

<script>
    function calc(id) {
        var a = parseInt(document.getElementById("a" + id).value);
        var b = parseInt(document.getElementById("b" + id).value);
        var c = parseInt(document.getElementById("c" + id).value);
        var d = parseInt(document.getElementById("d" + id).value);
        var e = parseInt(document.getElementById("e" + id).value);
        var f = parseInt(document.getElementById("f" + id).value);
        var g = parseInt(document.getElementById("g" + id).value);
        var q = parseInt(document.getElementById("q" + id).value);
        var u = parseInt(document.getElementById("u" + id).value);
        var v = parseInt(document.getElementById("v" + id).value);
        var yo = parseInt(document.getElementById("yo" + id).value);

        var h = a + b + c + d + e - f - g + q + u + v + yo;


        var i = parseInt(document.getElementById("i" + id).value);
        var j = parseInt(document.getElementById("j" + id).value);
        var k = parseInt(document.getElementById("k" + id).value);
        var l = parseInt(document.getElementById("l" + id).value);
        var m = parseInt(document.getElementById("m" + id).value);
        var n = parseInt(document.getElementById("n" + id).value);
        var o = parseInt(document.getElementById("o" + id).value);
        var r = parseInt(document.getElementById("r" + id).value);
        var w = parseInt(document.getElementById("w" + id).value);
        var x = parseInt(document.getElementById("x" + id).value);
        var py = parseInt(document.getElementById("py" + id).value);

        var p = i + j + k + l + m + n - o + r + w + x + py;
        console.log(id + '/' + p + '<br>');

        document.getElementById("h" + id).value = h;
        document.getElementById("p" + id).value = p;
        var zz = parseInt(h) + parseInt(p);
        document.getElementById("sto" + id).innerHTML = "<small>BDT</small> &nbsp; " + zz + ".00";
    }
</script>

<h3>Payroll Calculation</h3>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row">

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
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" class="btn btn-inverse-success btn-block p-2 pt-2"
                                    onclick="go();">Show Details</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">


                        <div class="col-12 grid-margin stretch-card">

                            <?php

                            $sql0 = "SELECT * FROM salaryextracolumn where sccode='$sccode' and sessionyear='$year' and month='$month' ";
                            // echo $sql0;
                            $result0rt = $conn->query($sql0);
                            if ($result0rt->num_rows > 0) {
                                while ($row0 = $result0rt->fetch_assoc()) {
                                    $g1title = $row0["govt1title"];
                                    $g1type = $row0["govt1type"];
                                    $g1val = $row0["govt1value"];
                                    $g2title = $row0["govt2title"];
                                    $g2type = $row0["govt2type"];
                                    $g2val = $row0["govt2value"];

                                    $s1title = $row0["school1title"];
                                    $s1type = $row0["school1type"];
                                    $s1val = $row0["school1value"];
                                    $s2title = $row0["school2title"];
                                    $s2type = $row0["school2type"];
                                    $s2val = $row0["school2value"];

                                    $g3title = $row0["govt3title"];
                                    $g3type = $row0["govt3type"];
                                    $g3val = $row0["govt3value"];
                                    $s3title = $row0["school3title"];
                                    $s3type = $row0["school3type"];
                                    $s3val = $row0["school3value"];

                                    $g1chq = $row0["govt1chq"];
                                    $g2chq = $row0["govt2chq"];
                                    $g3chq = $row0["govt3chq"];
                                    $s1chq = $row0["school1chq"];
                                    $s2chq = $row0["school2chq"];
                                    $s3chq = $row0["school3chq"];
                                }
                            } else {
                                $g1title = '';
                                $g1type = '';
                                $g1val = '';
                                $g2title = '';
                                $g2type = '';
                                $g2val = '';
                                $s1title = '';
                                $s1type = '';
                                $s1val = '';
                                $s2title = '';
                                $s2type = '';
                                $s2val = '';

                                $g3title = '';
                                $g3type = '';
                                $g3val = '';
                                $s3title = '';
                                $s3type = '';
                                $s3val = '';

                                $g1chq = 0;
                                $g2chq = 0;
                                $g3chq = 0;
                                $s1chq = 0;
                                $s2chq = 0;
                                $s3chq = 0;
                            }

                            $alltitle = $g1title . $g2title . $g3title . $s1title . $s2title . $s3title;


                            ?>

                            <div class="cardx ">
                                <div class="card-bodyx code-pro text-small">
                                    <?php if ($alltitle != '') { ?>
                                        <h6 class="text-muted font-weight-normal text-small">
                                            Bonus/Incentive found for the month of
                                            <b><?php $xx = strtotime($year . '-' . $month . '-01');
                                            echo date('F, Y', $xx) ?></b>
                                        </h6>
                                        <?php
                                        if ($g1title != '') {
                                            echo 'Govt # 1 : ' . $g1title . ' by ' . $g1type . ' of ' . $g1val . '<br>';
                                        }
                                        if ($g2title != '') {
                                            echo 'Govt # 2 : ' . $g2title . ' by ' . $g2type . ' of ' . $g2val . '<br>';
                                        }
                                        if ($g3title != '') {
                                            echo 'Govt # 3 : ' . $g3title . ' by ' . $g3type . ' of ' . $g3val . '<br>';
                                        }
                                        if ($s1title != '') {
                                            echo '<br>Institute # 1 : ' . $s1title . ' by ' . $s1type . ' of ' . $s1val . '<br>';
                                        }
                                        if ($s2title != '') {
                                            echo 'Institute # 2 : ' . $s2title . ' by ' . $s2type . ' of ' . $s2val . '<br>';
                                        }
                                        if ($s3title != '') {
                                            echo 'Institute # 3 : ' . $s3title . ' by ' . $s3type . ' of ' . $s3val . '<br>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>


                    </div>



                </div>
            </div>
        </div>
    </div>
</div>



<?php
$edit_lock = 0;
$total_sanctioned = 0;
$total_total = $total_payoff = $total_dispuch = $total_issue = $total_nooff = 0;
$sql0 = "SELECT * FROM teacher where sccode='$sccode' order by ranks, tid";
// echo $sql0;
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $tid = $row0["tid"];
        $tnamee = $row0["tname"];
        $tnameb = $row0["tnameb"];
        $position = $row0["position"];
        $mobile = $row0["mobile"];
        $email = $row0["email"];

        $rnk = $row0["ranks"];
        $slt = $row0["slots"];
        $pss = $row0["payscale"] * 0;
        $pscd = $row0["payscale"];

        $basic = $row0["basic"];
        $incen = $row0["incentive"];
        $house = $row0["house"];
        $medical = $row0["medical"];
        $arrea = $row0["arrea"];
        $welfare = $row0["welfare"];
        $retire = $row0["retire"];
        $net = $row0["netamtgovt"];  //

        $salary = $row0["salary"];
        $mpa = $row0["mobilevata"];
        $travel = $row0["travel"];
        $med2 = $row0["medical2"];
        $exam = $row0["exam"];
        $fest = $row0["festival"];
        $pf = $row0["pf"];
        $arr2 = 0;
        $net2 = $row0["net2"] + $pss;

        if ($net == 0) {
            $ico = 'na';
        } else {
            $ico = 'govtlogo';
        }

        $gex1 = 0;
        $gex2 = 0;
        $gex3 = 0;
        $sex1 = 0;
        $sex2 = 0;
        $sex3 = 0;

        if ($g1val > 0) {
            if ($g1type == 'scale') {
                $gex1 = $pscd * $g1val / 100;
            } else if ($g1type == 'basic') {
                $gex1 = $basic * $g1val / 100;
            } else if ($g1type == 'fixed') {
                $gex1 = $g1val;
            } else {
                $gex1 = 0;
            }
        }
        if ($g2val > 0) {
            if ($g2type == 'scale') {
                $gex2 = $pscd * $g2val / 100;
            } else if ($g2type == 'basic') {
                $gex2 = $basic * $g2val / 100;
            } else if ($g2type == 'fixed') {
                $gex2 = $g2val;
            } else {
                $gex2 = 0;
            }
        }
        if ($g3val > 0) {
            if ($g3type == 'scale') {
                $gex3 = $pscd * $g3val / 100;
            } else if ($g3type == 'basic') {
                $gex3 = $basic * $g3val / 100;
            } else if ($g3type == 'fixed') {
                $gex3 = $g3val;
            } else {
                $gex3 = 0;
            }
        }



        if ($s1val > 0) {
            if ($s1type == 'scale') {
                $sex1 = $pscd * $s1val / 100;
            } else if ($s1type == 'basic') {
                $sex1 = $basic * $s1val / 100;
            } else if ($s1type == 'fixed') {
                $sex1 = $s1val;
            } else {
                $sex1 = 0;
            }
        }
        if ($s2val > 0) {
            if ($s2type == 'scale') {
                $sex2 = $pscd * $s2val / 100;
            } else if ($s2type == 'basic') {
                $sex2 = $basic * $s2val / 100;
            } else if ($s2type == 'fixed') {
                $sex2 = $s2val;
            } else {
                $sex2 = 0;
            }
        }

        if ($s3val > 0) {
            if ($s3type == 'scale') {
                $sex3 = $pscd * $s3val / 100;
            } else if ($s3type == 'basic') {
                $sex3 = $basic * $s3val / 100;
            } else if ($s3type == 'fixed') {
                $sex3 = $s3val;
            } else {
                $sex3 = 0;
            }
        }

        // $fest = $sex1;
        // $sex1 = 0;


        $sql0 = "SELECT * FROM salarydetails where sccode='$sccode' and month='$month' and year='$year' and tid='$tid' ";
        // echo $sql0;
        $result0345 = $conn->query($sql0);
        if ($result0345->num_rows > 0) {
            while ($row0 = $result0345->fetch_assoc()) {
                $found = 1;
                $kalar = '#eee';
                $iiid = $row0["id"]; // $yes = $row0["tid"];

                $p1 = $row0["refnogovt"];
                $p2 = $row0["refnosch"];
                $p3 = $row0["refnopf"];
                $p4 = $row0["refnogovtcol1"];
                $p5 = $row0["refnogovtcol2"];
                $p6 = $row0["refnogovtcol3"];
                $p7 = $row0["refnoschoolcol1"];
                $p8 = $row0["refnoschoolcol2"];
                $p9 = $row0["refnoschoolcol3"];

                $allp = $p1 . $p2 . $p3 . $p4 . $p5 . $p6 . $p7 . $p8 . $p9;




                $basic = $row0["basic"];
                $incen = $row0["incentive"];
                $house = $row0["house"];
                $medical = $row0["medical"];
                $arrea = $row0["arrear"];
                $welfare = $row0["welfare"];
                $retire = $row0["retire"];
                $gex1 = $row0["govtcol1"];
                $gex2 = $row0["govtcol2"];
                $net = $row0["govt"];  //

                $salary = $row0["salary"];
                $mpa = $row0["mpa"];
                $travel = $row0["travel"];
                $med2 = $row0["med2"];
                $exam = $row0["exam"];
                $fest = $row0["festival"];
                $arr2 = $row0["arrear2"];
                $pf = $row0["pf"];
                $sex1 = $row0["schoolcol1"];
                $sex2 = $row0["schoolcol2"];
                $net2 = $row0["school"];
                $edit_lock = $row0["edit_lock"];

                $total_sanctioned += $net + $net2;
                // $issslot = $row0["slots"]; $issgovt = $row0["govt"]; $isssch = $row0["school"]; $isspf = $row0["pf"];
            }
        } else {
            $found = 0;
            $kalar = 'white';
            $iiid = 0;
            $edit_lock = 0;
            $allp = '';


        }

        $total_total += $net + $net2;
        if ($allp != '') {
            $bbb = 'dark';
            $total_issue += $net + $net2;
        } else {
            if ($edit_lock == 1) {
                $bbb = 'warning';
                $total_dispuch += $net + $net2;
            } else {
                if ($found == 0) {
                    $bbb = 'success';
                    $total_nooff += $net + $net2;
                } else {
                    $bbb = 'danger';
                    $total_payoff += $net + $net2;
                }
            }
        }



        ?>
        <div class="row d-print-none">
            <div class="col-12 grid-margin stretch-card">
                <div class="card border-primary ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9 d-block">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="small"><?php echo $tid; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class=""><?php echo $tnamee . ' / ' . $tnameb;

                                        if ($slt == 'College') {
                                            // echo '<div style="height:5px; background:yellow;"></div>';
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-small">
                                        <?php echo $position; ?>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <span class="p-2 mr-3 text-white border-danger" id="tot<?php echo $tid; ?>"
                                    hidden><?php ; ?></span>
                                <div class="dropdown">
                                    <button class="btn btn-inverse-<?php echo $bbb; ?> btn-block dropdown-toggle text-right"
                                        type="button" id="dropdownMenuOutlineButton1" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class=" text-white mr-2" id="sto<?php echo $tid; ?>"></span>
                                        <img src="assets/imgs/<?php echo $ico; ?>.png" style="width:30px;" />
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton1">
                                        <!-- <h6 class="dropdown-header">Settings</h6> -->

                                        <?php
                                        if ($allp == '') {
                                            if ($edit_lock == 0) {
                                                if ($found == 0) { ?>
                                                    <button class="dropdown-item btn btn-inverse-success btn-fw p-2 "
                                                        id="btt<?php echo $tid; ?>"
                                                        onclick="payoff(<?php echo $tid; ?>, <?php echo $iiid; ?>);">Payoff</button>
                                                <?php } else { ?>
                                                    <button class="dropdown-item btn btn-inverse-danger btn-fw  p-2"
                                                        id="btt<?php echo $tid; ?>"
                                                        onclick="payoff(<?php echo $tid; ?>, <?php echo $iiid; ?>);">Refund
                                                        Amount</button>
                                                <?php }

                                                ?>
                                                <button class="dropdown-item btn btn-inverse-primary btn-fw   p-2"
                                                    onclick="calc(<?php echo $tid; ?>);">Re
                                                    Calc</button>

                                            <?php } else {
                                                ?>
                                                <button class="dropdown-item btn btn-inverse-warning btn-fw   p-2"
                                                    onclick="dissss();">Already Dispuched</button>
                                                <?php
                                            }

                                        } else {
                                            ?>
                                            <button class="dropdown-item btn btn-inverse-dark text-secondary btn-fw   p-2"
                                                onclick="dissss();">Cheque Already Issued.</button>
                                            <?php
                                        }

                                        ?>


                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mt-2"></div>


                        <?php if ($net >= 0) { ?>
                            <!-- MPO Block ........................ -->
                        <?php } ?>

                        <div class="row pb-0">
                            <div class="col-12 d-flex">
                                <div class="ml-1"><input id="a<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $basic; ?>" />
                                    <label class=" text-small pl-2">Basic</label>
                                </div>
                                <div class="ml-1"><input id="b<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $incen; ?>" />
                                    <label class=" text-small pl-2">Incentive</label>
                                </div>

                                <div class="ml-1"><input id="c<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $house; ?>" />
                                    <label class=" text-small pl-2">House Rent</label>
                                </div>
                                <div class="ml-1"><input id="d<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $medical; ?>" /><label class=" text-small pl-2">Medical</label></div>



                                <div class="ml-1"><input id="q<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="0" /><label class=" text-small pl-2">--</label>
                                </div>
                                <div class="ml-1"><input id="f<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $welfare; ?>" /><label
                                        class=" text-small pl-2 text-danger">Welfare</label></div>
                                <div class="ml-1"><input id="g<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $retire; ?>" /><label
                                        class=" text-small pl-2 text-danger">Retirement</label>
                                </div>
                                <div class="ml-1"><input id="e<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $arrea; ?>" />
                                    <label class=" text-small pl-2 text-primary">Arrear</label>
                                </div>
                                <div class="ml-1"><input id="u<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $gex1; ?>" /><label class=" text-small pl-2 text-warning"
                                        id="gex1"><?php echo $g1title; ?></label>
                                </div>
                                <div class="ml-1"><input id="v<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $gex2; ?>" /><label class=" text-small pl-2 text-warning"
                                        id="gex2"><?php echo $g2title; ?></label>
                                </div>
                                <div class="ml-1"><input id="yo<?php echo $tid; ?>" type="text"
                                        class="form-control text-right full-width" value="<?php echo $gex3; ?>" />
                                    <label class=" text-small pl-2 text-warning" id="gex3"><?php echo $g3title; ?></label>
                                </div>

                                <div class="ml-1"><input id="h<?php echo $tid; ?>" type="text"
                                        class="form-control text-right full-width" value="<?php echo $net; ?>" />
                                    <label class=" text-small pl-2">Total</label>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="ml-1">
                                    <input id="i<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $salary; ?>" />
                                    <label class=" text-small pl-2">Salary</label>
                                </div>
                                <div class="ml-1">
                                    <input id="j<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $mpa; ?>" />
                                    <label class=" text-small pl-2">Mobile</label>
                                </div>
                                <div class="ml-1">
                                    <input id="k<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $travel; ?>" />
                                    <label class=" text-small pl-2">Travel</label>
                                </div>
                                <div class="ml-1">
                                    <input id="l<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $med2; ?>" />
                                    <label class=" text-small pl-2">Medical</label>
                                </div>
                                <div class="ml-1">
                                    <input id="m<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $exam; ?>" />
                                    <label class=" text-small pl-2"></label>
                                </div>
                                <div class="ml-1">
                                    <input id="n<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $fest; ?>" />
                                    <label class=" text-small pl-2"></label>
                                </div>
                                <div class="ml-1">
                                    <input id="o<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $pf; ?>" />
                                    <label class=" text-small pl-2 text-danger">PF</label>
                                </div>
                                <div class="ml-1">
                                    <input id="r<?php echo $tid; ?>" type="text" class="form-control text-right" value="0" />
                                    <label class=" text-small pl-2 text-primary">Arrear</label>
                                </div>
                                <div class="ml-1">
                                    <input id="w<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $sex1; ?>" />
                                    <label class=" text-small pl-2 text-warning" id="sex1"><?php echo $s1title; ?></label>
                                </div>
                                <div class="ml-1">
                                    <input id="x<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $sex2; ?>" />
                                    <label class=" text-small pl-2  text-warning" id="sex2"><?php echo $s2title; ?></label>
                                </div>
                                <div class="ml-1">
                                    <input id="py<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $gex3; ?>" />
                                    <label class=" text-small pl-2 text-warning" id="sex3"><?php echo $s3title; ?></label>
                                </div>
                                <div class="ml-1">
                                    <input id="p<?php echo $tid; ?>" type="text" class="form-control text-right"
                                        value="<?php echo $net2; ?>" />
                                    <label class=" text-small pl-2">Total</label>


                                    <?php
                                    // echo $total_sanctioned;
                                    ?>
                                </div>
                            </div>
                        </div>



                        <div class="row" hidden>
                            <div class="row  mt-4">

                                <script> calc(<?php echo $tid; ?>);</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} ?>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="table text-right">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center text-white"><b><?php echo number_format($total_nooff, 2); ?></b></th>
                                <th class="text-center text-white"><b><?php echo number_format($total_payoff, 2); ?></b></th>
                                <th class="text-center text-white"><b><?php echo number_format($total_dispuch, 2); ?></b></th>
                                <th class="text-center text-white"><b><?php echo number_format($total_issue, 2); ?></b></th>
                                <th class="text-center text-white"><b><?php echo number_format($total_total, 2); ?></b></th>
                            </tr>
                            <tr>
                                <th class="text-center text-white table-danger"><b><small>Not Paid</small></b></th>
                                <th class="text-center text-white table-success"><b><small>Paid Off</small></b></th>
                                <th class="text-center text-white table-warning"><b><small>Dispuched</small></b></th>
                                <th class="text-center text-white table-dark"><b><small>Cheque Issued</small></b></th>
                                <th class="text-center text-white table-info"><b><small>Calculated Total</small></b></th>
                            </tr>
                        </thead>
                    </table>
                </div>

           
            </div>
        </div>
    </div>
</div>

<div class="row" hidden>
    <div class="col-12 grid-margin stretch-card">
        <div class="card  ">
            <div class="card-body">

                <div class="row">
                    <h4 class="text-white">Cheque Details</h4>
                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <?php

                                $ratio = 1;
                                $sql0 = "SELECT * FROM slots where sccode='$sccode' order by id ";
                                // echo $sql0;
                                $result03456 = $conn->query($sql0);
                                if ($result03456->num_rows > 0) {
                                    while ($row0 = $result03456->fetch_assoc()) {
                                        $slots = $row0["slotname"];

                                        for ($lp = 0; $lp < 10; $lp++) {
                                            if ($lp == 0) {
                                                $cate = 'govt';
                                                $ratio = 1;
                                                $cad = 'Government Pay';
                                            } else if ($lp == 1) {
                                                $cate = 'school';
                                                $ratio = 1;
                                                $cad = 'School Pay';
                                            } else if ($lp == 2) {
                                                $cate = 'pf';
                                                $ratio = 2;
                                                $cad = 'PF Bill';
                                            } else if ($lp == 3) {
                                                $cate = 'expenditure';
                                                $ratio = 1;
                                                $cad = 'Expenditure';
                                            }





                                            if ($cate == 'expenditure') {
                                                $sccodes = $sccode * 10;
                                                $sql0 = "SELECT sum(amount) as poisa FROM cashbook where sccode='$sccodes' and type='Expenditure' and slots='$slots'  ";
                                                // echo $sql0 . '<br>';
                                                $result03456766 = $conn->query($sql0);
                                                if ($result03456766->num_rows > 0) {
                                                    while ($row0 = $result03456766->fetch_assoc()) {
                                                        $taka = $row0["poisa"] * 1;
                                                    }
                                                } else {
                                                    $taka = 0;
                                                }
                                            } else {
                                                $sql0 = "SELECT sum($cate) as taka FROM salarydetails where sccode='$sccode' and month='$month' and year='$year' and slots='$slots' ";
                                                // echo $sql0 . '<br>';
                                                $result034567 = $conn->query($sql0);
                                                if ($result034567->num_rows > 0) {
                                                    while ($row0 = $result034567->fetch_assoc()) {
                                                        $taka = $row0["taka"] * $ratio;
                                                    }
                                                }
                                            }
                                            $id = 0;
                                            $sql0 = "SELECT * FROM salarysummery where sccode='$sccode' and month='$month' and year='$year' and slot='$slots' and category='$cate'";
                                            $result0345678 = $conn->query($sql0);
                                            if ($result0345678->num_rows > 0) {
                                                while ($row0 = $result0345678->fetch_assoc()) {
                                                    $tonka = $row0["amount"];
                                                    $id = $row0["id"];
                                                    $ref = $row0["refno"];
                                                    $chq = $row0["chequeno"];
                                                    $date = $row0["date"];
                                                    $status = $row0["status"];
                                                }
                                            } else {
                                                $tonka = 0;
                                                $id = 0;
                                                $ref = '';
                                                $chq = '';
                                                $date = '';
                                                $status = 0;
                                            }

                                            ?>
                                            <tr>
                                                <td>

                                                    <span class="x1" id="slot<?php echo $slots; ?><?php echo $cate; ?>"
                                                        style=""><?php echo strtoupper($slots); ?></span>

                                                </td>
                                                <td>
                                                    <span class="x2" id="cate<?php echo $slots; ?><?php echo $cate; ?>"
                                                        style=""><?php echo strtoupper($cate); ?></span>
                                                </td>
                                                <td>
                                                    <input id="ref<?php echo $slots; ?><?php echo $cate; ?>" class="form-control"
                                                        style="width:90px;" type="text" placeholder="Ref No." value="<?php if ($ref != '') {
                                                            echo $ref;
                                                        } ?>" />

                                                </td>
                                                <td>
                                                    <input id="dt<?php echo $slots; ?><?php echo $cate; ?>" class="form-control"
                                                        type="date" placeholder="Date" value="<?php if ($date != '') {
                                                            echo $date;
                                                        } ?>" />
                                                </td>
                                                <td>
                                                    <input id="chq<?php echo $slots; ?><?php echo $cate; ?>" class="form-control"
                                                        style="width:110px;" type="text" placeholder="Cheque No." value="<?php if ($chq != '') {
                                                            echo $chq;
                                                        } ?>" />

                                                </td>
                                                <td>
                                                    <input id="bank<?php echo $slots; ?><?php echo $cate; ?>" class="form-control"
                                                        style="width:40px;" type="text" placeholder="..." />
                                                </td>
                                                <td>
                                                    <div id="amt<?php echo $slots; ?><?php echo $cate; ?>"
                                                        style="font-size:16px; text-align:right; font-weight:bold;">
                                                        <?php echo $taka; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="ssp<?php echo $slots; ?><?php echo $cate; ?>">
                                                        <?php
                                                        if ($status == 0) {
                                                            if ($tonka > 0) { ?>
                                                                <button class="btn btn-danger  btn-rounded btn-icon"
                                                                    style="padding:5px 0 0 3px;"
                                                                    onclick="issue('<?php echo $slots; ?><?php echo $cate; ?>', <?php echo $id; ?>);">
                                                                    <i class="mdi mdi-delete-forever" style="font-size:18px;"></i>
                                                                </button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-success  btn-rounded btn-icon"
                                                                    style="padding:5px 0 0 3px;"
                                                                    onclick="issue('<?php echo $slots; ?><?php echo $cate; ?>', <?php echo $id; ?>);">
                                                                    <i class="mdi mdi-content-save"></i>
                                                                </button>
                                                            <?php }
                                                        } ?>
                                                    </div>
                                                    <div id=""></div>
                                                </td>
                                            </tr>

                                        <?php }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include 'footer.php';
?>
<script>

</script>
<script>
    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'payroll-calc.php?m=' + m + '&y=' + y;
    }
</script>








<script>
    function issue(slot, cate, id) {

        var year = document.getElementById("year").value;
        var month = document.getElementById("month").value; alert(id); alert(id);
        var a = slot;//document.getElementById("slot" + id).innerHTML;
        var b = cate; //document.getElementById("cate" + id).innerHTML; 
        alert(id); var c = parseInt(document.getElementById("amt" + id).innerHTML);
        var d = document.getElementById("ref" + id).value;
        var e = document.getElementById("chq" + id).value;
        var f = document.getElementById("bank" + id).value;
        var g = document.getElementById("dt" + id).value; alert(id);



        var infor = "year=" + year + "&month=" + month +
            "&a=" + a + "&b=" + b + "&c=" + c + "&d=" + d + "&e=" + e + "&f=" + f + "&g=" + g + "&tail=" + tail;

        alert(infor + id);
        $("#ssp" + id).html("");

        $.ajax({
            type: "POST",
            url: "backend/issuepay.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#ssp' + id).html('<span class=""><center>Check Issue....</center></span>');
            },
            success: function (html) {
                $("#ssp" + id).html(html);
                // $("#gogg").html(html);

                // document.location.href = 'report.php';
            }
        });
    }
</script>


<script>
    function payoff(id, iid) {
        var btt = document.getElementById("btt" + id);
        btt.disabled = true;

        var year = document.getElementById("year").value;
        var month = document.getElementById("month").value;
        var a = document.getElementById("a" + id).value;
        var b = document.getElementById("b" + id).value;
        var c = document.getElementById("c" + id).value;
        var d = document.getElementById("d" + id).value;
        var e = document.getElementById("e" + id).value;
        var f = document.getElementById("f" + id).value;
        var g = document.getElementById("g" + id).value;
        var h = document.getElementById("h" + id).value;
        var i = document.getElementById("i" + id).value;
        var j = document.getElementById("j" + id).value;
        var k = document.getElementById("k" + id).value;
        var l = document.getElementById("l" + id).value;
        var m = document.getElementById("m" + id).value;
        var n = document.getElementById("n" + id).value;
        var o = document.getElementById("o" + id).value;
        var p = document.getElementById("p" + id).value;
        var q = document.getElementById("q" + id).value;
        var r = document.getElementById("r" + id).value;

        var u = document.getElementById("u" + id).value;
        var v = document.getElementById("v" + id).value;
        var w = document.getElementById("w" + id).value;
        var x = document.getElementById("x" + id).value;

        var yo = document.getElementById("yo" + id).value;
        var py = document.getElementById("py" + id).value;

        var g1 = '<?php echo $g1chq; ?>';
        var g2 = '<?php echo $g2chq; ?>';
        var g3 = '<?php echo $g3chq; ?>';
        var gchq = h - (u * g1 + v * g2 + yo * g3);
        var s1 = '<?php echo $s1chq; ?>';
        var s2 = '<?php echo $s2chq; ?>';
        var s3 = '<?php echo $s3chq; ?>';
        var schq = p - (w * s1 + x * s2 + py * s3);

        var infor = "year=" + year + "&month=" + month + "&tid=" + id + "&iid=" + iid
            + "&a=" + a + "&b=" + b + "&c=" + c + "&d=" + d + "&e=" + e + "&f=" + f + "&g=" + g + "&h=" + h
            + "&i=" + i + "&j=" + j + "&k=" + k + "&l=" + l + "&m=" + m + "&n=" + n + "&o=" + o + "&p=" + p + "&q=" + q + "&r=" + r
            + "&u=" + u + "&v=" + v + "&w=" + w + "&x=" + x + "&yo=" + yo + "&py=" + py + "&gchq=" + gchq + "&schq=" + schq
            ;
        $("#sto" + id).html("");

        $.ajax({
            type: "POST",
            url: "payoff.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sto' + id).html('<span class=""><center>Create Salary Satement</center></span>');
            },
            success: function (html) {
                $("#sto" + id).html(html);

                // document.location.href = 'report.php';
            }
        });
    }
</script>