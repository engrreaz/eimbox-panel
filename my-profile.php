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

<h3>My Profile </h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <img style="" src="<?php echo $pth; ?>" />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-9">
                        <div class="form-group row">
                            <div class="col-12">
                                <h4><?php echo $fullname; ?></h4>
                                <h5><?php echo $usr; ?></h5>
                                <small><?php echo $userlevel; ?></small>
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
                <h3 class="text-muted font-weight-normal text-center">
                    Basic Information
                </h3>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover text-white">
                          
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
                                    <td>Display Name :
                                    </td>
                                    <td>
                                    <input type="text" class="form-control" id="date"
                                            value="<?php echo $fullname; ?>" />
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



<!-- ***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
*************************************************************************************************** -->



<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Transaction History</h4>
                <canvas id="transaction-history" class="transaction-chart"></canvas>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Transfer to Paypal</h6>
                        <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">$236</h6>
                    </div>
                </div>
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Tranfer to Stripe</h6>
                        <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">$593</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1">Open Projects</h4>
                    <p class="text-muted mb-1">Your data status</p>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="preview-list">
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-primary">
                                        <i class="mdi mdi-file-document"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">Admin dashboard design</h6>
                                        <p class="text-muted mb-0">Broadcast web app mockup</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">15 minutes ago</p>
                                        <p class="text-muted mb-0">30 tasks, 5 issues </p>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-cloud-download"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">Wordpress Development</h6>
                                        <p class="text-muted mb-0">Upload new design</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">1 hour ago</p>
                                        <p class="text-muted mb-0">23 tasks, 5 issues </p>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="mdi mdi-clock"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">Project meeting</h6>
                                        <p class="text-muted mb-0">New project discussion</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">35 minutes ago</p>
                                        <p class="text-muted mb-0">15 tasks, 2 issues</p>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-danger">
                                        <i class="mdi mdi-email-open"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">Broadcast Mail</h6>
                                        <p class="text-muted mb-0">Sent release details to team</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">55 minutes ago</p>
                                        <p class="text-muted mb-0">35 tasks, 7 issues </p>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-chart-pie"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">UI Design</h6>
                                        <p class="text-muted mb-0">New application planning</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">50 minutes ago</p>
                                        <p class="text-muted mb-0">27 tasks, 4 issues </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Revenue</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">$32123</h2>
                            <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                        </div>
                        <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                    </div>

                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="table ">
                            <table>
                                <?php
                                for ($i = 0; $i < 7; $i++) {
                                    ?>
                                    <tr>
                                        <?php
                                        for ($j = 0; $j < 3; $j++) {
                                            ?>
                                            <td id="">
                                                <table class="table">
                                                    <tr>
                                                        <td class="text-left" id="seat<?php echo $i . $j; ?>a">
                                                            <?php echo $i . $j; ?>A
                                                        </td>
                                                        <td class="text-center" id="seat<?php echo $i . $j; ?>b">
                                                            <?php echo $i . $j; ?>B
                                                        </td>
                                                        <td class="text-right" id="seat<?php echo $i . $j; ?>c">
                                                            <?php echo $i . $j; ?>C
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Purchase</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0">$2039</h2>
                            <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p>
                        </div>
                        <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-xl-12 my-auto">
                        <input type="text" id="place" class="form-control" />
                        <br>
                        <input type="text" id="start" class="form-control" />
                        <br>
                        <button class="btn btn-primary" onclick="setplan();">Assign</button>
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



</script>

<script>
    function save(id, tail) {
        alert(tail);
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

        alert(infor);
        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "savecash.php",
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