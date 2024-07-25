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

<h3>Bonus & Incentive (Payroll)</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Select Month & Year and press 'Proceed' to proceed
                </h6>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Salary Month</label>
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
                            <label class="col-form-label pl-3">Salary Year</label>
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
                                <button type="button" class="btn btn-inverse-primary btn-block p-2" onclick="go();">View
                                    Info</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" class="btn btn-inverse-success btn-block p-2"
                                    onclick="go2();">Save Info</button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="oop"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

$id = 0;

$govt1title = '';
$govt1type = '';
$govt1value = '';
$govt1pool = '';
$govt1chq = '';
$govt1desc = '';

$govt2title = '';
$govt2type = '';
$govt2value = '';
$govt2pool = '';
$govt2chq = '';
$govt2desc = '';

$govt3title = '';
$govt3type = '';
$govt3value = '';
$govt3pool = '';
$govt3chq = '';
$govt3desc = '';

$school1title = '';
$school1type = '';
$school1value = '';
$school1pool = '';
$school1chq = '';
$school1desc = '';

$school2title = '';
$school2type = '';
$school2value = '';
$school2pool = '';
$school2chq = '';
$school2desc = '';

$school3title = '';
$school3type = '';
$school3value = '';
$school3pool = '';
$school3chq = '';
$school3desc = '';

$sql0x = "SELECT * FROM salaryextracolumn where sccode='$sccode' and sessionyear = '$year' and month='$month' ;";
$result0x = $conn->query($sql0x);
if ($result0x->num_rows > 0) {
    while ($row0x = $result0x->fetch_assoc()) {
        $id = $row0x["id"];

        $govt1title = $row0x["govt1title"];
        $govt1type = $row0x["govt1type"];
        $govt1value = $row0x["govt1value"];
        $govt1pool = $row0x["govt1pool"];
        $govt1chq = $row0x["govt1chq"];
        $govt1desc = $row0x["govt1desc"];

        $govt2title = $row0x["govt2title"];
        $govt2type = $row0x["govt2type"];
        $govt2value = $row0x["govt2value"];
        $govt2pool = $row0x["govt2pool"];
        $govt2chq = $row0x["govt2chq"];
        $govt2desc = $row0x["govt2desc"];

        $govt3title = $row0x["govt3title"];
        $govt3type = $row0x["govt3type"];
        $govt3value = $row0x["govt3value"];
        $govt3pool = $row0x["govt3pool"];
        $govt3chq = $row0x["govt3chq"];
        $govt3desc = $row0x["govt3desc"];

        $school1title = $row0x["school1title"];
        $school1type = $row0x["school1type"];
        $school1value = $row0x["school1value"];
        $school1pool = $row0x["school1pool"];
        $school1chq = $row0x["school1chq"];
        $school1desc = $row0x["school1desc"];

        $school2title = $row0x["school2title"];
        $school2type = $row0x["school2type"];
        $school2value = $row0x["school2value"];
        $school2pool = $row0x["school2pool"];
        $school2chq = $row0x["school2chq"];
        $school2desc = $row0x["school2desc"];

        $school3title = $row0x["school3title"];
        $school3type = $row0x["school3type"];
        $school3value = $row0x["school3value"];
        $school3pool = $row0x["school3pool"];
        $school3chq = $row0x["school3chq"];
        $school3desc = $row0x["school3desc"];
    }
}

?>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="text-small pl-4">Govt. Provided Bonus / Incentive # 1</div>
                    <div class=" m-0 col-12 d-flex">
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Title</label>
                            <input type="text" class="form-control" value="<?php echo $govt1title; ?>"
                                id="govt1title" />
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Calculation on</label>
                            <select class="form-control text-secondary" id="govt1type">
                                <option value=""></option>
                                <option value="basic" <?php if ($govt1type == 'basic')
                                    echo 'selected'; ?>>Basic</option>
                                <option value="payscale" <?php if ($govt1type == 'payscale')
                                    echo 'selected'; ?>>Pay Scale
                                </option>
                                <option value="fixed" <?php if ($govt1type == 'fixed')
                                    echo 'selected'; ?>>Fixed Amount
                                </option>
                                <option value="indivisual" <?php if ($govt1type == 'indivisual')
                                    echo 'selected'; ?>>
                                    Indivisual</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="text-small text-muted form-check-label">Value</label>
                            <input type="text" class="form-control" value="<?php echo $govt1value; ?>"
                                id="govt1value" />
                        </div>

                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Category</label>
                            <select class="form-control text-secondary" id="govt1pool">
                                <option value=""></option>
                                <option value="festival" <?php if ($govt1pool == 'festival')
                                    echo 'selected'; ?>>Festival</option>
                                <option value="exam" <?php if ($govt1pool == 'exam')
                                    echo 'selected'; ?>>Exam</option>
                                <option value="bonus" <?php if ($govt1pool == 'bonus')
                                    echo 'selected'; ?>>Bonus</option>
                                <option value="other" <?php if ($govt1pool == 'other')
                                    echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Cheque?</label>
                            <select class="form-control text-secondary" id="govt1chq">
                                <option value=""></option>
                                <option value="1" <?php if ($govt1chq == 1)
                                    echo 'selected'; ?>>Yes</option>
                                <option value="0" <?php if ($govt1chq == 0)
                                    echo 'selected'; ?>>No
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="text-small text-muted form-check-label">Comments</label>
                            <input type="text" class="form-control" value="<?php echo $govt1desc; ?>" id="govt1desc" />
                        </div>

                    </div>

                    <div class="text-small pl-4 mt-3">Govt. Provided Bonus / Incentive # 2</div>
                    <div class=" m-0 col-12 d-flex">
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Title</label>
                            <input type="text" class="form-control" value="<?php echo $govt2title; ?>"
                                id="govt2title" />
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Calculation on</label>
                            <select class="form-control text-secondary" id="govt2type">
                                <option value=""></option>
                                <option value="basic" <?php if ($govt2type == 'basic')
                                    echo 'selected'; ?>>Basic</option>
                                <option value="payscale" <?php if ($govt2type == 'payscale')
                                    echo 'selected'; ?>>Pay Scale
                                </option>
                                <option value="fixed" <?php if ($govt2type == 'fixed')
                                    echo 'selected'; ?>>Fixed Amount
                                </option>
                                <option value="indivisual" <?php if ($govt2type == 'indivisual')
                                    echo 'selected'; ?>>
                                    Indivisual</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="text-small text-muted form-check-label">Value</label>
                            <input type="text" class="form-control" value="<?php echo $govt2value; ?>"
                                id="govt2value" />
                        </div>

                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Category</label>
                            <select class="form-control text-secondary" id="govt2pool">
                                <option value=""></option>
                                <option value="festival" <?php if ($govt2pool == 'festival')
                                    echo 'selected'; ?>>Festival</option>
                                <option value="exam" <?php if ($govt2pool == 'exam')
                                    echo 'selected'; ?>>Exam</option>
                                <option value="bonus" <?php if ($govt2pool == 'bonus')
                                    echo 'selected'; ?>>Bonus</option>
                                <option value="other" <?php if ($govt2pool == 'other')
                                    echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Cheque?</label>
                            <select class="form-control text-secondary" id="govt2chq">
                                <option value=""></option>
                                <option value="1" <?php if ($govt2chq == 1)
                                    echo 'selected'; ?>>Yes</option>
                                <option value="0" <?php if ($govt2chq == 0)
                                    echo 'selected'; ?>>No
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="text-small text-muted form-check-label">Comments</label>
                            <input type="text" class="form-control" value="<?php echo $govt2desc; ?>" id="govt2desc" />
                        </div>

                    </div>

                    <div class="text-small pl-4 mt-3">Govt. Provided Bonus / Incentive # 3</div>
                    <div class=" m-0 col-12 d-flex">
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Title</label>
                            <input type="text" class="form-control" value="<?php echo $govt3title; ?>"
                                id="govt3title" />
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Calculation on</label>
                            <select class="form-control text-secondary" id="govt3type">
                                <option value=""></option>
                                <option value="basic" <?php if ($govt3type == 'basic')
                                    echo 'selected'; ?>>Basic</option>
                                <option value="payscale" <?php if ($govt3type == 'payscale')
                                    echo 'selected'; ?>>Pay Scale
                                </option>
                                <option value="fixed" <?php if ($govt3type == 'fixed')
                                    echo 'selected'; ?>>Fixed Amount
                                </option>
                                <option value="indivisual" <?php if ($govt3type == 'indivisual')
                                    echo 'selected'; ?>>
                                    Indivisual</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="text-small text-muted form-check-label">Value</label>
                            <input type="text" class="form-control" value="<?php echo $govt3value; ?>"
                                id="govt3value" />
                        </div>

                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Category</label>
                            <select class="form-control text-secondary" id="govt3pool">
                                <option value=""></option>
                                <option value="festival" <?php if ($govt3pool == 'festival')
                                    echo 'selected'; ?>>Festival</option>
                                <option value="exam" <?php if ($govt3pool == 'exam')
                                    echo 'selected'; ?>>Exam</option>
                                <option value="bonus" <?php if ($govt3pool == 'bonus')
                                    echo 'selected'; ?>>Bonus</option>
                                <option value="other" <?php if ($govt3pool == 'other')
                                    echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Cheque?</label>
                            <select class="form-control text-secondary" id="govt3chq">
                                <option value=""></option>
                                <option value="1" <?php if ($govt3chq == 1)
                                    echo 'selected'; ?>>Yes</option>
                                <option value="0" <?php if ($govt3chq == 0)
                                    echo 'selected'; ?>>No
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="text-small text-muted form-check-label">Comments</label>
                            <input type="text" class="form-control" value="<?php echo $govt3desc; ?>" id="govt3desc" />
                        </div>

                    </div>





                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="text-small pl-4">Institute Provided Bonus / Incentive # 1</div>
                    <div class=" m-0 col-12 d-flex">
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Title</label>
                            <input type="text" class="form-control" value="<?php echo $school1title; ?>"
                                id="school1title" />
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Calculation on</label>
                            <select class="form-control text-secondary" id="school1type">
                                <option value=""></option>
                                <option value="basic" <?php if ($school1type == 'basic')
                                    echo 'selected'; ?>>Basic</option>
                                <option value="payscale" <?php if ($school1type == 'payscale')
                                    echo 'selected'; ?>>Pay Scale
                                </option>
                                <option value="fixed" <?php if ($school1type == 'fixed')
                                    echo 'selected'; ?>>Fixed Amount
                                </option>
                                <option value="indivisual" <?php if ($school1type == 'indivisual')
                                    echo 'selected'; ?>>
                                    Indivisual</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="text-small text-muted form-check-label">Value</label>
                            <input type="text" class="form-control" value="<?php echo $school1value; ?>"
                                id="school1value" />
                        </div>

                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Category</label>
                            <select class="form-control text-secondary" id="school1pool">
                                <option value=""></option>
                                <option value="festival" <?php if ($school1pool == 'festival')
                                    echo 'selected'; ?>>Festival</option>
                                <option value="exam" <?php if ($school1pool == 'exam')
                                    echo 'selected'; ?>>Exam</option>
                                <option value="bonus" <?php if ($school1pool == 'bonus')
                                    echo 'selected'; ?>>Bonus</option>
                                <option value="other" <?php if ($school1pool == 'other')
                                    echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Cheque?</label>
                            <select class="form-control text-secondary" id="school1chq">
                                <option value=""></option>
                                <option value="1" <?php if ($school1chq == 1)
                                    echo 'selected'; ?>>Yes</option>
                                <option value="0" <?php if ($school1chq == 0)
                                    echo 'selected'; ?>>No
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="text-small text-muted form-check-label">Comments</label>
                            <input type="text" class="form-control" value="<?php echo $school1desc; ?>"
                                id="school1desc" />
                        </div>

                    </div>

                    <div class="text-small pl-4 mt-3">school Provided Bonus / Incentive # 2</div>
                    <div class=" m-0 col-12 d-flex">
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Title</label>
                            <input type="text" class="form-control" value="<?php echo $school2title; ?>"
                                id="school2title" />
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Calculation on</label>
                            <select class="form-control text-secondary" id="school2type">
                                <option value=""></option>
                                <option value="basic" <?php if ($school2type == 'basic')
                                    echo 'selected'; ?>>Basic</option>
                                <option value="payscale" <?php if ($school2type == 'payscale')
                                    echo 'selected'; ?>>Pay Scale
                                </option>
                                <option value="fixed" <?php if ($school2type == 'fixed')
                                    echo 'selected'; ?>>Fixed Amount
                                </option>
                                <option value="indivisual" <?php if ($school2type == 'indivisual')
                                    echo 'selected'; ?>>
                                    Indivisual</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="text-small text-muted form-check-label">Value</label>
                            <input type="text" class="form-control" value="<?php echo $school2value; ?>"
                                id="school2value" />
                        </div>

                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Category</label>
                            <select class="form-control text-secondary" id="school2pool">
                                <option value=""></option>
                                <option value="festival" <?php if ($school2pool == 'festival')
                                    echo 'selected'; ?>>Festival</option>
                                <option value="exam" <?php if ($school2pool == 'exam')
                                    echo 'selected'; ?>>Exam</option>
                                <option value="bonus" <?php if ($school2pool == 'bonus')
                                    echo 'selected'; ?>>Bonus</option>
                                <option value="other" <?php if ($school2pool == 'other')
                                    echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Cheque?</label>
                            <select class="form-control text-secondary" id="school2chq">
                                <option value=""></option>
                                <option value="1" <?php if ($school2chq == 1)
                                    echo 'selected'; ?>>Yes</option>
                                <option value="0" <?php if ($school2chq == 0)
                                    echo 'selected'; ?>>No
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="text-small text-muted form-check-label">Comments</label>
                            <input type="text" class="form-control" value="<?php echo $school2desc; ?>"
                                id="school2desc" />
                        </div>

                    </div>

                    <div class="text-small pl-4 mt-3">school. Provided Bonus / Incentive # 3</div>
                    <div class=" m-0 col-12 d-flex">
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Title</label>
                            <input type="text" class="form-control" value="<?php echo $school3title; ?>"
                                id="school3title" />
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Calculation on</label>
                            <select class="form-control text-secondary" id="school3type">
                                <option value=""></option>
                                <option value="basic" <?php if ($school3type == 'basic')
                                    echo 'selected'; ?>>Basic</option>
                                <option value="payscale" <?php if ($school3type == 'payscale')
                                    echo 'selected'; ?>>Pay Scale
                                </option>
                                <option value="fixed" <?php if ($school3type == 'fixed')
                                    echo 'selected'; ?>>Fixed Amount
                                </option>
                                <option value="indivisual" <?php if ($school3type == 'indivisual')
                                    echo 'selected'; ?>>
                                    Indivisual</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label class="text-small text-muted form-check-label">Value</label>
                            <input type="text" class="form-control" value="<?php echo $school3value; ?>"
                                id="school3value" />
                        </div>

                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Category</label>
                            <select class="form-control text-secondary" id="school3pool">
                                <option value=""></option>
                                <option value="festival" <?php if ($school3pool == 'festival')
                                    echo 'selected'; ?>>Festival</option>
                                <option value="exam" <?php if ($school3pool == 'exam')
                                    echo 'selected'; ?>>Exam</option>
                                <option value="bonus" <?php if ($school3pool == 'bonus')
                                    echo 'selected'; ?>>Bonus</option>
                                <option value="other" <?php if ($school3pool == 'other')
                                    echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="text-small text-muted form-check-label">Cheque?</label>
                            <select class="form-control text-secondary" id="school3chq">
                                <option value=""></option>
                                <option value="1" <?php if ($school3chq == 1)
                                    echo 'selected'; ?>>Yes</option>
                                <option value="0" <?php if ($school3chq == 0)
                                    echo 'selected'; ?>>No
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="text-small text-muted form-check-label">Comments</label>
                            <input type="text" class="form-control" value="<?php echo $school3desc; ?>"
                                id="school3desc" />
                        </div>

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
    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'payroll-bonus.php?m=' + m + '&y=' + y;
    }

</script>
<script>
    function go2() {
        var i = 1;
        var j = 3;
        var slt = '';
        var a = ''
        var fulltext = 'id=<?php echo $id; ?>&month=<?php echo $month; ?>&year=<?php echo $year; ?>';
        var pnt = '';
        for (i = 0; i <= 1; i++) {
            if (i == 0) { slt = 'govt'; } else { slt = 'school'; }
            for (j = 1; j <= 3; j++) {
                pnt = slt + j;
                a = 'title';
                fulltext += '&' + pnt + a + "=" + document.getElementById(pnt + a).value;
                a = 'type';
                fulltext += '&' + pnt + a + "=" + document.getElementById(pnt + a).value;
                a = 'value';
                fulltext += '&' + pnt + a + "=" + document.getElementById(pnt + a).value;
                a = 'pool';
                fulltext += '&' + pnt + a + "=" + document.getElementById(pnt + a).value;
                a = 'chq';
                fulltext += '&' + pnt + a + "=" + document.getElementById(pnt + a).value;
                a = 'desc';
                fulltext += '&' + pnt + a + "=" + document.getElementById(pnt + a).value;
            }
        }
        console.log(fulltext);


        var infor = fulltext

        // alert(infor);
        $("#oop").html("");

        $.ajax({
            type: "POST",
            url: "backend/save-payroll-bonus.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#oop').html('<span class=""><center>Check Issue....</center></span>');
            },
            success: function (html) {
                $("#oop").html(html);

                // document.location.href = 'report.php';
            }
        });

        // var m = document.getElementById('month').value;
        // var y = document.getElementById('year').value;
        // window.location.href = 'detail-salary.php?m=' + m + '&y=' + y;
    }
</script>


<script>
    function issue(id, tail) {
        var infor = "year=0&month=0&a=0&b=0&c=0&d=0&e=0&f=0&g=0&tail=" + id + "&ttt=" + tail;

        // alert(infor);
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

                // document.location.href = 'report.php';
            }
        });
    }
</script>