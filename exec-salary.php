<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

if(isset($_GET['m'])){$month = $_GET['m'];} else {$month = 0;}
if(isset($_GET['y'])){$year = $_GET['y'];} else {$year = 0;}
?>

<h3>Teachers & Staffs Salary Management</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Select Month & Year and press 'Proceed' to proceed
                </h6>
                <div class="row">
                    <div class="col-md-3">
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
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-fw p-2" style="width:100%;"
                                    onclick="go();">View Statement</button>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" class="btn btn-success btn-fw p-2" style="width:100%;"
                                    onclick="go2();">View Salary Details</button>

                            </div> 
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
                                    <th>Ref.</th>
                                    <th>Slot</th>
                                    <th>Category</th>
                                    <th>Cheque</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql0x = "SELECT * FROM salarysummery where sccode='$sccode' and sessionyear = '$sy' and month='$month' and year='$year' order by refno;";
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $refno = $row0x["refno"];
                                        $slot = $row0x["slot"];
                                        $cat = $row0x["category"];
                                        $chq = $row0x["chequeno"];
                                        $date = $row0x["date"];
                                        $amt = $row0x["amount"];
                                        $status = $row0x["status"];
                                        // $ = $row0x[""];
                                        ?>
                                        <tr>
                                            <td><?php echo $refno; ?></td>
                                            <td><?php echo $slot; ?></td>
                                            <td><?php echo $cat; ?></td>
                                            <td><?php echo $chq; ?></td>
                                            <td><?php echo date('d - m - Y', strtotime($date)); ?></td>
                                            <td class="text-danger"><?php echo $amt; ?><i class="mdi mdi-arrow-up"></i></td>
                                            <td>
                                                <?php
                                                if ($status == 0) {
                                                    ?>
                                                    <div id="ssp<?php echo $id; ?>">
                                                        <label onclick="issue(<?php echo $id; ?>,0);"
                                                            class="badge badge-danger">Remove</label>
                                                        <label id="ssp2<?php echo $id; ?>" onclick="issue(<?php echo $id; ?>,1);"
                                                            class="badge badge-primary">Issue</label>
                                                    </div>

                                                    <?php
                                                } else {
                                                    ?>
                                                    <label class="badge badge-success">Issued</label>
                                                    <?php
                                                }
                                                ?>

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
        window.location.href = 'exec-salary.php?m=' + m + '&y=' + y;
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