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
if (isset($_GET['slot'])) {
    $slot = $_GET['slot'];
} else {
    $slot = 'School';
}

if (isset($_GET['y'])) {
    $year = $_GET['y'];
} else {
    $year = 0;
}

if (isset($_GET['cal'])) {
    $cal = $_GET['cal'];
} else {
    $cal = 0;
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
if (isset($_GET['all'])) {
    $all = $_GET['all'];
} else {
    $all = $sccode;
}
if (isset($_GET['bank'])) {
    $bank = $_GET['bank'];
} else {
    $bank = 0;
}

if ($bank == 1) {
    $bnkclr = 'warning';
    $sq = '';
} else {
    $bnkclr = 'dark';
    $sq = " and module !='BANK' ";
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

$items = array();
$sql000 = "SELECT * FROM financeitem where sccode='$sccode' or sccode=0  order by id";
$resultixx = $conn->query($sql000);
// $conn -> close();
if ($resultixx->num_rows > 0) {
    while ($row000 = $resultixx->fetch_assoc()) {
        $items[] = $row000;
    }
}

?>


<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Issue Expenditure</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <div id="" class="input-control select full-size error">
                    <div class="row">
                        <div class="col-md-3"><label class="form-control bg-dark">Amount</label></div>
                        <div class="col-md-3"><label id="ssll" class="form-control"></label></div>
                        <div class="col-md-6">
                            <label id="cash" class="form-control text-right ">0.00</label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-control bg-dark">Month</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control " id="monthissue">
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
                        <div class="col-md-3">
                            <label class="form-control ">Year</label>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control " id="yearissue">
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

                    <div class="row">
                        <div class="col-md-3"><label class="form-control">Ref. No.</label></div>
                        <div class="col-md-3">
                            <button onclick="fetchref();" class="btn"><i class="mdi mdi-sync"></i></button>
                        </div>
                        <div id="jabjab"></div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="refissue" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-control">Ref. Title</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="reftitleissue" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-control ">Ref. Description</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="refdescripissue" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-control ">Ref. Category</label>
                        </div>
                        <div class="col-md-9">
                            <select id="partissue" name="partissue" class="form-control " onchange="modal();">

                                <?php
                                $sql0x = "SELECT * FROM financesetup where (sccode='$sccode' or sccode=0) and particulareng!='' and (sessionyear='$sy' or sessionyear=0) order by particulareng ;";
                                $result0xt = $conn->query($sql0x);
                                if ($result0xt->num_rows > 0) {
                                    while ($row0x = $result0xt->fetch_assoc()) {
                                        $partidx = $row0x["id"];
                                        $pe = $row0x["particulareng"];
                                        $pb = $row0x["particularben"];
                                        if ($partidx == $partidq) {
                                            $sel = 'selected';
                                        } else {
                                            $sel = '';
                                        }
                                        echo '<option value="' . $partidx . '" ' . $sel . '>' . $pe . ' &bull; ' . $pb . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-control ">Cheque #</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="chqissue" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-control">Account #</label>
                        </div>
                        <div class="col-md-3">
                            <select id="accissue" name="accissue" class="form-control " onchange="modal();">
                                <option value="">Select Bank Account</option>
                                <?php
                                $sql000 = "SELECT * FROM bankinfo where sccode='$sccode'  order by id";
                                $resultix = $conn->query($sql000);
                                // $conn -> close();
                                if ($resultix->num_rows > 0) {
                                    while ($row000 = $resultix->fetch_assoc()) {
                                        $accno = $row000["accno"];
                                        $acctype = $row000["acctype"];
                                        $bankname = $row000["bankname"];
                                        echo '<option value="' . $accno . '"  >' . $accno . '/' . $acctype . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>












                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <span id="sspdxx"></span>
                <button type="button" class="btn btn-inverse-success" onclick="save(99,5);">Issue</button>
                <button type="button" class="btn btn-inverse-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>









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
// echo $inex . '/' . $btnclr . '/' . $txt; ?>

<div style="float:right;" id="inex">
    <button type="button" class="btn btn-<?php echo $btnclr; ?>"
        onclick="catt('<?php echo $txt; ?>');"><?php echo $txt; ?></button>
</div>
<h3 id="">Income/Expenditure Manager</h3>
<h6 id="lbl-inex"><b><?php echo $inex . ' Management Module'; ?></b></h6>


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Select Month & Year / Ref. No to filter record
                </h6>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Slot</label>
                            <div class="col-12">
                                <select class="form-control" id="dept2x">
                                    <?php
                                    $sql0x = "SELECT * FROM slots where sccode='$sccode' ;";
                                    $result0x2 = $conn->query($sql0x);
                                    if ($result0x2->num_rows > 0) {
                                        while ($row0x = $result0x2->fetch_assoc()) {
                                            $slotname = $row0x["slotname"];
                                            if ($slot == $slotname) {
                                                $sel = 'selected';
                                            } else {
                                                $sel = '';
                                            }
                                            echo '<option value="' . $slotname . '"' . $sel . '>' . $slotname . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Issued Month</label>
                            <div class="col-12">
                                <select class="form-control " id="month">
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

                        <div class="form-group row pl-1">
                            <label class="col-form-label pl-3">Issued Year</label>
                            <div class="col-12">
                                <select class="form-control " id="year">
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

                        <div class="form-group row pl-1">
                            <label class="col-form-label pl-3  ">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-inverse-primary p-2  btn-block " style="" onclick="go();"><i
                                        class="mdi mdi-eye"></i></button>

                            </div>
                        </div>


                    </div>








                    <div class="col-md-2 d-flex">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Ref. No.</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="ref" value="<?php echo $refno; ?>" />
                            </div>
                        </div>
                        <div class="form-group row pl-1">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-inverse-warning p-1 pt-2  pl-3 pr-2 btn-block" style=""
                                    onclick="go2();"><i class="mdi mdi-eye mdi-18px"></i></button>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-4 d-flex d-block btn-group">

                        <div class="btn-group" role="group">
                            <div class="form-group row">
                                <label class="col-form-label d-md-flex d-sm-none pl-3">&nbsp;</label>
                                <div class="col-12">
                                    <button type="button" style="" class="btn btn-inverse-info  p-1 pt-2 btn-block"
                                        title="Undefined Item" style="" onclick="go3();">&nbsp;<i
                                            class="mdi mdi-crop-square mdi-18px"></i>&nbsp;</button>




                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label pl-3  d-md-flex d-sm-none">&nbsp;</label>
                                <div class="col-12">

                                    <button type="button" style="" title="Show All Expenses"
                                        class="btn btn-inverse-secondary  p-1 pt-2  btn-block" style=""
                                        onclick="showall();">&nbsp;<i
                                            class="mdi mdi-receipt mdi-18px"></i>&nbsp;</button>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label pl-3  d-md-flex d-sm-none">&nbsp;</label>
                                <div class="col-12">

                                    <button type="button" style="" title="Add New Expenditure"
                                        class="btn btn-inverse-success  p-1 pt-2  btn-block" style=""
                                        onclick="addnew();">&nbsp;<i
                                            class="mdi mdi-library-plus mdi-18px"></i>&nbsp;</button>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label pl-3  d-md-flex d-sm-none">&nbsp;</label>
                                <div class="col-12">

                                    <button type="button" style="" title="Add New Expenditure"
                                        class="btn btn-inverse-danger  p-1 pt-2  btn-block" style=""
                                        onclick="pdf();">&nbsp;<i class="mdi mdi-file-pdf mdi-18px"></i>&nbsp;</button>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label pl-3  d-md-flex d-sm-none">&nbsp;</label>
                                <div class="col-12">

                                    <button type="button" style="" title="Add New Expenditure"
                                        class="btn btn-inverse-primary  p-1 pt-2  btn-block" style=""
                                        onclick="print();">&nbsp;<i
                                            class="mdi mdi-printer mdi-18px "></i>&nbsp;</button>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label pl-3  d-md-flex d-sm-none">&nbsp;</label>
                                <div class="col-12">


                                    <button type="button" style="" title="Bank On/Off"
                                        class="btn btn-inverse-<?php echo $bnkclr; ?>" style=""
                                        onclick="go4(<?php echo $bank; ?>);">&nbsp;<i
                                            class="mdi mdi-bank mdi-18px"></i>&nbsp;</button>

                                </div>
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
                                <select class="form-control " id="srchval">
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
                        <table class="table table-hover ">
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
                                        $stst = $row0x["status"];
                                        $mmox = $row0x["memono"];
                                    }
                                } else {
                                    $date = '';
                                    $slots = 'school';
                                    $amount = '';
                                    $descrip = '';
                                    $stst = '0';
                                    $mmox = '';

                                }
                                // $ = $row0x[""];
                                ?>
                                <tr>
                                    <td>Dept. :
                                    </td>
                                    <td>
                                        <select class="form-control " id="dept">
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
                                    <td>Memo No (set blank if set memono later.):
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="mmo" value="<?php echo $mmox; ?>" />
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
                                        <select class="form-control " id="cate">
                                            <?php
                                            $sql0x = "SELECT * FROM financesetup where sccode='$sccode' and (sessionyear='$sy' || sessionyear=0) and inexex=1 order by particulareng;";
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
                                        <input type="text" class="form-control" id="descrip" list="itemname"
                                            value="<?php echo $descrip; ?>" />

                                        <datalist id="itemname">
                                            <?php
                                            $sql000 = "SELECT particulars FROM cashbook where sccode='$sccode' or sccode='$sccodes' group by particulars order by particulars";
                                            $result0001 = $conn->query($sql000);
                                            if ($result0001->num_rows > 0) {
                                                while ($row000 = $result0001->fetch_assoc()) {
                                                    $partpart = $row000["particulars"];
                                                    echo '<option value="' . $partpart . '">';
                                                }
                                            }
                                            ?>
                                        </datalist>
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
                                            <?php if ($stst == 0) { ?>

                                                <button class="btn btn-inverse-primary"
                                                    onclick="save(<?php echo $exid; ?>, 1);">Save</button>
                                            <?php } ?>
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

                </h6>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th></th>
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
                                $memotaka = 0;
                                $vouchertotal = 0;

                                if ($refno > 0) {
                                    // echo 'ref<br>';
                                    $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and refno = '$refno' and slots = '$slot'  and type='$inex' " . $sq . "  order by memono, id;";
                                } else if ($month > 0) {
                                    if ($cal == 0) {
                                        // echo 'month<br>';
                                        $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and month = '$month' and year='$year'  and slots = '$slot'  and type='$inex'  " . $sq . "  order by memono, id;";
                                    } else {
                                        // echo 'month<br>';
                                        $monthx = $month - 1;

                                        $d1 = date('Y-m-d' , strtotime($year  . '-' . $monthx . '-01'));
                                        $tt = date('t', strtotime($d1) );
                                        $d2 = date('Y-m-d' , strtotime($year  . '-' . $monthx . '-' .$tt));
                                        $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and date between '$d1' and '$d2'  and slots = '$slot'  and type='$inex'  " . $sq . "  order by memono, date, id;";
                                    }

                                } else if ($undef == '' || $undef == NULL) {
                                    // echo 'undef<br>';
                                    $sql0x = "SELECT * FROM cashbook where ( sccode='$sccodes' or sccode='$sccode')   and (status = 0 or status IS NULL) and type='$inex' and slots='$slot'  and partid > 4  " . $sq . "  order by date desc,  memono desc, id;";
                                } else if ($all != $sccode) {
                                    $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes')   " . $sq . "   order by date desc, memono desc, id;";
                                } else {
                                    $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and refno = 0 and memono = 0  " . $sq . "   order by memono, id;";
                                }
                                // echo $sql0x;
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $date = $row0x["date"];
                                        $memo = $row0x["memono"];

                                        $mm = $row0x["month"];
                                        $yy = $row0x["year"];
                                        $rr = $row0x["refno"];
                                        $pp = $row0x["partid"];
                                        $ind = array_search($pp, array_column($items, 'id'));
                                        $ppp = $items[$ind]['particulareng'] . ' / ' . $items[$ind]['particularben'];
                                        $icons = $items[$ind]['icon'];

                                        $parti = $row0x["particulars"];
                                        $amt = $row0x["amount"];
                                        $module = $row0x["module"];
                                        $status = $row0x["status"];
                                        $otg = $row0x["ongoing"] * 1;
                                        $otgx = 7 - $otg;
                                        if ($otg == 1) {
                                            $otgcol = 'success';
                                        } else {
                                            $otgcol = 'secondary';
                                        }


                                        $mottaka += $amt;
                                        $fn = 'savenx';
                                        if ($memo > 0) {
                                            $memotaka += $amt;
                                            $fn = 'saven';
                                            if ($module == 'VOUCHER' && $status >= 0 && $otg == 1) {
                                                $vouchertotal += $amt;
                                            }
                                        }


                                        ?>
                                        <tr>
                                            <td>
                                                <?php if ($icons == '' || $icons == NULL) {
                                                    $icons = 'hexagon';
                                                }

                                                ?>
                                                <button class="btn" id="bbtn<?php echo $id; ?>"> <i
                                                        class="mdi  mdi-<?php echo $icons; ?> text-<?php echo $otgcol; ?> mdi-18px"
                                                        onclick="<?php echo $fn; ?>(<?php echo $id; ?>, <?php echo $otgx; ?>)"></i></button>

                                            </td>

                                            <td>
                                                <?php echo date('d - m - Y', strtotime($date)); ?>
                                                <small class="d-block text-muted pt-2"><?php echo $mm . '/' . $yy; ?></small>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $memo; ?>
                                                <small class="d-block text-muted pt-2"><?php echo $rr; ?></small>
                                            </td>
                                            <td class="text-wrap " style="line-height:18px;">
                                                <?php echo $parti; ?>
                                                <small class="d-block text-muted pt-2"><?php echo $ppp; ?></small>
                                            </td>
                                            <td style="text-align:right;"><?php echo number_format($amt, 2); ?></td>

                                            <td>
                                                <?php
                                                if ($status == 0) {
                                                    ?>


                                                    <div class="btn-group" role="group" id="ssp<?php echo $id; ?>">
                                                        <button onclick="edit(<?php echo $id; ?>,1);"
                                                            class="btn btn-inverse-primary"><i
                                                                class="mdi mdi-grease-pencil"></i></button>
                                                        <button onclick="save(<?php echo $id; ?>,2);"
                                                            class="btn btn-inverse-danger"><i class="mdi mdi-delete"></i></button>
                                                        <?php if ($memo < 1) { ?>
                                                            <button onclick="save(<?php echo $id; ?>,3);"
                                                                class="btn btn-inverse-info"><i class="mdi mdi-receipt"></i></button>
                                                        <?php } ?>
                                                    </div>

                                                    <?php
                                                } else {
                                                    if ($module == 'BANK') {
                                                        echo '<i class="mdi mdi-bank mdi-24px text-warning"></i>';
                                                    } else {
                                                        echo '<i class="mdi mdi-check-circle mdi-24px text-success"></i>';
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="8">No Data / Records Found.</td>
                                        <td></td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td colspan="4" style="text-align:right;">Total (Filtered Record) : </td>
                                    <td style="text-align:right; font-weight:bold;"><?php echo $mottaka; ?>.00</td>
                                    <td>




                                        <button onclick="save(<?php echo $id; ?>,5);" class="icon-btn btn-success "
                                            hidden><i class="mdi mdi-flower"></i></button>
                                        <!-- set ref no. + month + year + issue check -->
                                    </td>
                                </tr>




                                <tr>
                                    <td colspan="4" style="text-align:right;">Total (Memo Amount) : </td>
                                    <td style="text-align:right; font-weight:bold;"><?php echo $memotaka; ?>.00</td>
                                    <td>

                                        <button onclick="save(<?php echo $id; ?>,5);" class="icon-btn btn-success "
                                            hidden><i class="mdi mdi-flower"></i></button>
                                        <!-- set ref no. + month + year + issue check -->
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align:right;">Total Voucher (Memo Amount) : </td>
                                    <td style="text-align:right; font-weight:bold;"><?php echo $vouchertotal; ?>.00</td>
                                    <td>

                                        <button onclick="save(<?php echo $id; ?>,5);" class="icon-btn btn-success "
                                            hidden><i class="mdi mdi-flower"></i></button>
                                        <!-- set ref no. + month + year + issue check -->
                                        <?php if ($vouchertotal >= 0) { ?>
                                            <button type="button" id="modalbox" class="btn btn-inverse-success btn-block"
                                                data-bs-toggle="modal" data-bs-target="#myModal">
                                                Issue Expense
                                            </button>
                                        <?php } ?>
                                    </td>
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
    document.getElementById("cash").innerHTML = "<small>BDT &nbsp;&nbsp;&nbsp;</small> <?php echo number_format($vouchertotal, 2); ?>";
    document.getElementById("ssll").innerHTML = document.getElementById('dept2x').value;
    function go() {
        var s = document.getElementById('dept2x').value;
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'expenditure.php?&slot=' + s + '&m=' + m + '&y=' + y;
    }
    function go2() {
        var m = document.getElementById('ref').value;
        window.location.href = 'expenditure.php?&ref=' + m;
    }
    function go3() {
        var m = document.getElementById('dept2x').value;
        window.location.href = 'expenditure.php?&undef&slot=' + m;
    }
    function showall() {
        window.location.href = 'expenditure.php?&all';
    }
    function go4(onoff) {
        const searchParams = new URLSearchParams(window.location.search);
        var par = '';
        var bb = 0;
        onoff = Math.abs(onoff - 1);

        for (const param of searchParams) {
            if (param[0] == 'bank') {
                param[1] = onoff;
                bb = 1;
            }
            par += param[0] + '=' + param[1] + '&';
        }

        // alert(searchParams);
        if (bb == 0) {
            par += 'bank=' + onoff;
        }

        var lnk = 'expenditure.php?' + par;
        //    alert(lnk);
        window.location.href = lnk;

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
        if (id == 0) tail = 0;
        if (tail == 0 || tail == 1) {
            var dept = document.getElementById('dept').value;
            var date = document.getElementById('date').value;
            var cate = document.getElementById('cate').value;
            var descrip = document.getElementById('descrip').value;
            var amt = document.getElementById('amt').value;
            var mmo = document.getElementById('mmo').value;

            var infor = "dept=" + dept + '&date=' + date + '&cate=' + cate + '&descrip=' + descrip + '&amt=' + amt + '&id=' + id + "&tail=" + tail + "&mmo=" + mmo;
        } else if (tail == 2 || tail == 3) {
            if (tail == 2) {
                var dia = confirm('Are you sure to delete this Expense?');
                if (dia == false) { id = 0; }
            }
            var infor = 'dept=&date=&cate=&descrip=&amt=&id=' + id + "&tail=" + tail;
        } else if (tail == 5) {
            var month = document.getElementById('monthissue').value;
            var year = document.getElementById('yearissue').value;
            var ref = document.getElementById('refissue').value;
            var chq = document.getElementById('chqissue').value;
            var acc = document.getElementById('accissue').value;

            var partid = document.getElementById('partissue').value;
            var slot = document.getElementById('ssll').innerHTML;

            var title = document.getElementById('reftitleissue').value;
            var descrip = document.getElementById('refdescripissue').value;

            var amt = '<?php echo $vouchertotal; ?>';

            var infor = "month=" + month + '&year=' + year + '&ref=' + ref + '&chq=' + chq + '&amt=' + amt + '&acc=' + acc + "&tail=" + tail + "&title=" + title + "&descrip=" + descrip + "&partid=" + partid + "&slot=" + slot;
        } else if (tail == 6 || tail == 7) {
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
                } else if (tail == 5) {
                    document.getElementById('sspdxx').innerHTML = document.getElementById('sspd').innerHTML;
                    document.getElementById('sspd').innerHTML = '';
                    // window.location.href = 'expenditure.php?addnew' + taild;
                }
            }
        });
    }

</script>

<script>
    function saven(id, tail) {

        var infor = 'dept=&date=&cate=&descrip=&amt=&id=' + id + "&tail=" + tail;


        // alert(infor);
        $("#bbtn" + id).html("");

        $.ajax({
            type: "POST",
            url: "backend/savecash.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#bbtn' + id).html('<span class=""><center>..</center></span>');
            },
            success: function (html) {
                $("#bbtn" + id).html(html);

            }
        });
    }


    function savenx(id, tail) {
        alert('Sorry to select. Issue a memo first.');
    }

</script>

<script>
    function fetchref() {
        var rrr = document.getElementById('refissue').value;
        var infor = 'ref=' + rrr;


        // alert(infor);
        $("#jabjab").html("");

        $.ajax({
            type: "POST",
            url: "backend/fetch-ref-info.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#jabjab').html('<span class=""><center>..</center></span>');
            },
            success: function (html) {
                $("#jabjab").html(html);

                var a1 = document.getElementById('a1').innerHTML;
                document.getElementById('monthissue').value = a1;
                var a2 = document.getElementById('a2').innerHTML;
                document.getElementById('yearissue').value = a2;
                var a3 = document.getElementById('a3').innerHTML;
                document.getElementById('reftitleissue').value = a3;
                var a4 = document.getElementById('a4').innerHTML;
                document.getElementById('refdescripissue').value = a4;
                var a5 = document.getElementById('a5').innerHTML;
                document.getElementById('chqissue').value = a5;
                var a6 = document.getElementById('a6').innerHTML;
                document.getElementById('accissue').value = a6;
                var a8 = document.getElementById('a8').innerHTML;
                document.getElementById('partissue').value = a8;

            }
        });
    }

</script>


<script>
    function catt(tu) {
        localStorage.setItem("inex-category", tu);
        console.log('saved');
        window.location.href = 'expenditure.php';
        window.location.href = uri;

    }
</script>