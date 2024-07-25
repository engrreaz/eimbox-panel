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
if (isset($_GET['disx'])) {
    $disx = $_GET['disx'];
} else {
    $disx = 1;
}
?>

<h3>Payroll Statement</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
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
                            <label class="col-form-label pl-3">Dispuch Period</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="dispuch">

                                    <?php
                                    for ($dis = 1; $dis <= 1; $dis++) {
                                        $flt22 = '';
                                        if ($disx == $dis) {
                                            $flt22 = 'selected';
                                        }
                                        echo '<option value="' . $dis . '"' . $flt22 . '>' . $dis . '</option>';
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
                                <button type="button" class="btn btn-inverse-success btn-block pb-2 pt-1"
                                    onclick="go();"><i class="mdi mdi-check-all mdi-18px"></i> Statement</button>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">

                                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-inverse-info" onclick="view(<?php echo $month;?>,<?php echo $year;?>,1,0);">
                                        <i class="mdi mdi-file-document mdi-18px"></i> View
                                    </button>
                                    <button type="button" class="btn btn-inverse-primary" onclick="view(<?php echo $month;?>,<?php echo $year;?>,1,1);">
                                        <i class="mdi mdi-printer mdi-18px"></i> Print
                                    </button>
                                    <button type="button" class="btn btn-inverse-danger" onclick="view(<?php echo $month;?>,<?php echo $year;?>,1,2);" disabled>
                                        <i class="mdi mdi-file-pdf mdi-18px"></i> PDF
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'track-payroll.php'; ?>



<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Record found for the month of
                    <b><?php $xx = strtotime($year . '-' . $month . '-01');
                    echo date('F, Y', $xx) ?></b>
                </h6>
                <div class="row">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Slot</th>
                                    <th>Govt</th>
                                    <th>Institute</th>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $sql0x = "SELECT * FROM salarysummery where sccode='$sccode' and sessionyear = '$sy' and month='$month' and year='$year' order by refno;";
                                $sql0x = "SELECT * FROM salarydetails where sccode='$sccode' and sessionyear = '$sy' and month='$month' and year='$year' order by ranks";
                                $result0xn = $conn->query($sql0x);
                                if ($result0xn->num_rows > 0) {
                                    while ($row0x = $result0xn->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $slot = $row0x["slots"];
                                        $govt = $row0x["govt"];
                                        $school = $row0x["school"];
                                        $total = $row0x["total"];
                                        $lock = $row0x["edit_lock"];
                                        // $ = $row0x[""];
                                        ?>
                                        <tr>
                                            <td><?php echo $slot; ?></td>
                                            <td><?php echo $govt; ?></td>
                                            <td><?php echo $school; ?></td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo $lock; ?></td>
                                            <td>

                                                <div id="ssp<?php echo $id; ?>">
                                                    <button onclick="issuex(<?php echo $id; ?>,0);"
                                                        class="">Remove</button>

                                                </div>

                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="7">No Data / Records Found.</td>

                                    </tr>
                                <?php } ?>
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
    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        var p = document.getElementById('dispuch').value;
        window.location.href = 'payroll-statement.php?m=' + m + '&y=' + y + '&p=' + p;
    }
    function view(m, y, p, x) {
        // var m = document.getElementById('month').value;
        // var y = document.getElementById('year').value;
        // var p = document.getElementById('dispuch').value;
        window.open('salary-statement.php?m=' + m + '&y=' + y + '&o=' + p + "&x=" + x);
    }
    function go2() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'detail-salary.php?m=' + m + '&y=' + y;
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

<script>
    function gopage(page, month, year) {
        window.open(page + '.php?m=' + month + '&y=' + year);
    }
</script>