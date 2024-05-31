<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

// $refno = $_GET['ref'] ?? 0;
// $undef = $_GET['undef'] ?? 99;

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
if (isset($_GET['ref'])) {
    $refno = $_GET['ref'];
} else {
    $refno = 0;
}
if (isset($_GET['undef'])) {
    $undef = $_GET['undef'];
} else {
    $undef = 99;
}


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

?>
<div id="varvar">

</div>
<script>
    var catts = localStorage.getItem("inex-category");
    // alert(catts);
    if (catts == "Income") {
        document.cookie = "inex=Income;";
        document.cookie = "clr=danger;";
        document.cookie = "txt=Expenditure;";
    } else {
        document.cookie = "inex=Expenditure;";
        document.cookie = "clr=success;";
        document.cookie = "txt=Income;";
    }
    //localStorage.setItem("ex-routine-time", time);
</script>


<?php $inex = $_COOKIE['inex'];
$btnclr = $_COOKIE['clr'];
$txt = $_COOKIE['txt'];
echo $inex . '/' . $btnclr . '/' . $txt; ?>

<div style="float:right;" id="inex">
    <button type="button" class="btn btn-<?php echo $btnclr; ?>"
        onclick="catt('<?php echo $txt; ?>');"><?php echo $txt; ?></button>
</div>
<h3 id="lbl-inex"><?php echo $inex . ' Management'; ?></h3>


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


                    <div class="col-md-1">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-primary" style="" onclick="go();"><i class="mdi mdi-eye"></i></button>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Ref. No.</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="ref" value="<?php echo $refno; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-primary" style="" onclick="go2();"><i class="mdi mdi-eye"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="" class="icon-btn btn-info" title="Undefined Item" style=""
                                    onclick="go3();">&nbsp;<i class="mdi mdi-crop-square"></i>&nbsp;</button>

                                <button type="button" style="" title="Add New Expenditure" class="icon-btn btn-success"
                                    style="" onclick="addnew();">&nbsp;<i
                                        class="mdi mdi-library-plus"></i>&nbsp;</button>
                                <button type="button" style="" title="Search" class="icon-btn btn-warning" style=""
                                    onclick="go4();">&nbsp;<i class="mdi mdi-magnify"></i>&nbsp;</button>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- SEARCH BLOCK -->

                <div class="row" id="search" style="display:none;">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Key</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="srchkey">
                                    <option value="">....</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="srchop">
                                    <option value="">....</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Value</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="srchval">
                                    <option value="">....</option>
                                </select>
                            </div>
                        </div>
                    </div>





                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">

                                <button type="button" style="" title="Search" class="btn btn-info" style=""
                                    onclick="go4();">&nbsp;<i class="mdi mdi-magnify"></i>&nbsp;Find</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="row" style="display:<?php echo $newblock; ?>;">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Add a new expenditure(s)
                </h6>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover text-white">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sccodes = $sccode * 10;
                                $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and id = '$exid' ;";
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $date = $row0x["date"];
                                        $pid = $row0x["partid"];
                                        $descrip = $row0x["particulars"];
                                        $amount = $row0x["amount"];
                                    }
                                } else {
                                    $date = '';
                                    $slots = 'school';
                                    $amount = '';
                                    $descrip = '';

                                }
                                // $ = $row0x[""];
                                ?>
                                <tr>
                                    <td>Dept. :
                                    </td>
                                    <td>
                                        <select class="form-control" id="dept">
                                            <?php
                                            $sql0x = "SELECT * FROM slots where sccode='$sccode' ;";
                                            $result0x2 = $conn->query($sql0x);
                                            if ($result0x2->num_rows > 0) {
                                                while ($row0x = $result0x2->fetch_assoc()) {
                                                    $slotname = $row0x["slotname"];
                                                    echo '<option value="' . $slotname . '">' . $slotname . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Date :
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="date"
                                            value="<?php echo $date; ?>" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Category :
                                    </td>
                                    <td>
                                        <select class="form-control" id="cate">
                                            <?php
                                            $sql0x = "SELECT * FROM financesetup where sccode='$sccode' and (sessionyear='$sy' || sessionyear=0) and inexex=1 ;";
                                            $result0x3 = $conn->query($sql0x);
                                            if ($result0x3->num_rows > 0) {
                                                while ($row0x = $result0x3->fetch_assoc()) {
                                                    $partid = $row0x["id"];
                                                    $parteng = $row0x["particulareng"];
                                                    $sele = '';
                                                    if ($partid == $pid) {
                                                        $sele = 'selected';
                                                    }
                                                    echo '<option value="' . $partid . '" ' . $sele . ' >' . $parteng . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Description :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="descrip"
                                            value="<?php echo $descrip; ?>" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Amount :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="amt"
                                            value="<?php echo $amount; ?>" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div id="">
                                            <button class="btn btn-primary"
                                                onclick="save(<?php echo $exid; ?>, 1);">Save</button>

                                            <div id="gex"></div>
                                        </div>


                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
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

                <div id="sspd"></div>
                <h6 class="text-muted font-weight-normal">
                    Record found for the month of
                    <b><?php $xx = strtotime($year . '-' . $month . '-01');
                    echo date('F, Y', $xx) ?></b>
                </h6>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover text-white">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Memo</th>
                                    <th>Particulars</th>
                                    <th style="text-align:right;">Amount</th>
                                    <th style="text-align:right;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sccodes = $sccode * 10;
                                $mottaka = 0;
                                if ($refno > 0) {
                                    // echo 'ref<br>';
                                    $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and refno = '$refno'  order by memono, id;";
                                } else if ($month > 0) {
                                    // echo 'month<br>';
                                    $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and refno = '$refno'  order by memono, id;";
                                } else if ($undef == '' || $undef == NULL) {
                                    // echo 'undef<br>';
                                    $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and refno = 0 and memono = 0 and type='Expenditure'  order by memono, id;";
                                } else {
                                    $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and refno = 0 and memono = 0 and type='Expenditure'  order by memono, id;";
                                }
                                // echo $sql0x;
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $date = $row0x["date"];
                                        $memo = $row0x["memono"];
                                        $parti = $row0x["particulars"];
                                        $amt = $row0x["amount"];
                                        $mottaka += $amt;
                                        ?>
                                        <tr>
                                            <td><?php echo date('d - m - Y', strtotime($date)); ?></td>
                                            <td><?php echo $memo; ?></td>
                                            <td><?php echo $parti; ?></td>
                                            <td style="text-align:right;"><?php echo $amt; ?>.00</td>

                                            <td>
                                                <?php
                                                if ($status == 0) {
                                                    ?>
                                                    <div id="ssp<?php echo $id; ?>">
                                                        <label onclick="edit(<?php echo $id; ?>,1);" class="icon-btn btn-info"><i
                                                                class="mdi mdi-grease-pencil"></i></label>
                                                        <label onclick="save(<?php echo $id; ?>,2);" class="icon-btn btn-danger"><i
                                                                class="mdi mdi-delete"></i></label>
                                                        <label onclick="save(<?php echo $id; ?>,3);" class="icon-btn btn-success"><i
                                                                class="mdi mdi-receipt"></i></label>
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

                                <tr>
                                    <td colspan="3" style="text-align:right;">Total : </td>
                                    <td style="text-align:right; font-weight:bold;"><?php echo $mottaka; ?>.00</td>
                                    <td></td>
                                </tr>

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
    var uri = window.location.href;
    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'expenditure.php?&m=' + m + '&y=' + y;
    }
    function go2() {
        var m = document.getElementById('ref').value;
        window.location.href = 'expenditure.php?&ref=' + m;
    }
    function go3() {
        var m = document.getElementById('ref').value;
        window.location.href = 'expenditure.php?&undef';
    }
    function go4() {
        document.getElementById('search').style.display = 'block';
    }
    function addnew() {
        var und = '<?php echo $undef; ?>';
        var mmm = '<?php echo $month; ?>';
        var yyy = '<?php echo $year; ?>';
        var rrr = '<?php echo $refno; ?>';
        var tail = '';

        if (und == '') tail = '&undef';
        if (mmm > 0 || yyy > 0) tail = '&m=' + mmm + '&y=' + yyy;
        if (rrr > 0) tail = '&ref=' + rrr;

        window.location.href = 'expenditure.php?addnew' + tail;
    }


    function edit(id, taill) {
        var und = '<?php echo $undef; ?>';
        var mmm = '<?php echo $month; ?>';
        var yyy = '<?php echo $year; ?>';
        var rrr = '<?php echo $refno; ?>';
        var tail = '';

        if (und == '') tail = '&undef';
        if (mmm > 0 || yyy > 0) tail = '&m=' + mmm + '&y=' + yyy;
        if (rrr > 0) tail = '&ref=' + rrr;

        window.location.href = 'expenditure.php?addnew=' + id + tail;
    }

</script>

<script>
    function save(id, tail) {
        // alert(tail);
        if (id == 0) tail = 0;
        if (tail == 0 || tail == 1) {
            var dept = document.getElementById('dept').value;
            var date = document.getElementById('date').value;
            var cate = document.getElementById('cate').value;
            var descrip = document.getElementById('descrip').value;
            var amt = document.getElementById('amt').value;

            var infor = "dept=" + dept + '&date=' + date + '&cate=' + cate + '&descrip=' + descrip + '&amt=' + amt + '&id=' + id + "&tail=" + tail;
        } else if (tail == 2 || tail == 3) {
            var infor = 'dept=&date=&cate=&descrip=&amt=&id=' + id + "&tail=" + tail;
        }

        // alert(infor);
        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "backend/savecash.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspd').html('<span class=""><center>Check Issue....</center></span>');
            },
            success: function (html) {
                $("#sspd").html(html);

                var und = '<?php echo $undef; ?>';
                var mmm = '<?php echo $month; ?>';
                var yyy = '<?php echo $year; ?>';
                var rrr = '<?php echo $refno; ?>';
                var taild = '';

                if (und == '') taild = '&undef';
                if (mmm > 0 || yyy > 0) taild = '&m=' + mmm + '&y=' + yyy;
                if (rrr > 0) taild = '&ref=' + rrr;

                if (tail == 1) {
                    window.location.href = 'expenditure.php?addnews=' + taild;
                } else if (tail == 2 || tail == 3) {
                    window.location.href = 'expenditure.php?q=' + taild;
                } else if (tail == 0) {
                    document.getElementById('gex').innerHTML = document.getElementById('sspd').innerHTML;
                    document.getElementById('sspd').innerHTML = '';
                    window.location.href = 'expenditure.php?addnew' + taild;
                }
            }
        });
    }

</script>

<script>
    function catt(tu) {
        localStorage.setItem("inex-category", tu);
        window.location.reload(true);
    }
</script>