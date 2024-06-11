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
    $year = date('Y');
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

$classnamelist = ' playnurseryonetwothreefourfivesixseveneightnineten';



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
                                    <th>Particulars</th>
                                    <th>All</th>
                                    <?php
                                    $sql0x = "SELECT areaname FROM areas where user='$rootuser' group by areaname order by idno ;";
                                    $result0xxt = $conn->query($sql0x);
                                    if ($result0xxt->num_rows > 0) {
                                        while ($row0x = $result0xxt->fetch_assoc()) {
                                            $cname = strtoupper($row0x["areaname"]);
                                            echo '<th>' . $cname . '</th>';
                                        }
                                    }
                                    ?>
                                    <th style="text-align:right;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql0x = "SELECT * FROM financeitem where payment=1 order by slno;";
                                // echo $sql0x;
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $slno = $row0x["slno"];
                                        $parteng = $row0x["particulareng"];
                                        $partben = $row0x["particularben"];





                                        ?>
                                        <tr>
                                            <td><?php echo $slno; ?></td>
                                            <td style="line-height:20px;"><?php echo $parteng . '<br>' . $partben; ?></td>
                                            <td>
                                                <input type="text" class="form-control" id="" value="" style="width:60px;" />
                                            </td>
                                            <?php

                                            $sql0x = "SELECT areaname FROM areas where user='$rootuser' group by areaname order by idno ;";
                                            // echo $sql0x;
                                            $result0xx = $conn->query($sql0x);
                                            if ($result0xx->num_rows > 0) {
                                                while ($row0x = $result0xx->fetch_assoc()) {
                                                    $clsfld = strtolower($row0x["areaname"]);
                                                    if (strpos($classnamelist, $clsfld) > 0) {
                                                  
                                                        $sql0x = "SELECT * FROM financesetup where sccode='$sccode' and sessionyear='$sy' and particulareng='$parteng' ;";
                                                        // echo $sql0x;
                                                        $result0xxxr = $conn->query($sql0x);
                                                        if ($result0xxxr->num_rows > 0) {
                                                            while ($row0x = $result0xxxr->fetch_assoc()) {
                                                                $taka = $row0x[$clsfld];
                                                                $idfin = $row0x['id'];
                                                            }
                                                        } else {
                                                            $taka = '-';
                                                            $idfin = 0;
                                                        }
                                                        ?>

                                                        <td class="pl-1 pr-1">
                                                            <input type="text" class="form-control" id="<?php echo $clsfld.$idfin;?>" value="<?php echo $taka; ?>"
                                                                style="width:60px;" />
                                                        </td>
                                                        <?php
                                                    } else {
                                                        ?>

                                                        <td class="pl-1 pr-1">
                                                            <input type="text" class="form-control bg-dark" id="" value=""
                                                                style="width:60px;" disabled />
                                                        </td>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>


                                            <td>
                                                <div id="ssp<?php echo $id; ?>">
                                                    <button  onclick="push(<?php echo $idfin; ?>,1);" class="btn btn-inverse-info"><i
                                                            class="mdi mdi-arrow-right"></i></button>
                                                          
                                                </div><div id="sspp<?php echo $id; ?>">Remaining</div>
                                                <!-- <label class="badge badge-success">Issued</label> -->
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
    var uri = window.location.href;
    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'expenditure.php?&m=' + m + '&y=' + y;
    }
</script>


<script>
    function catt(tu) {
        localStorage.setItem("inex-category", tu);
        window.location.reload(true);
    }
</script>


<script>
    function push(id, tail) {
        var infor="id=" + id + "&pp=" + tail; 
        $("#ssp"+id).html( "" );
    
        $.ajax({
            url: "backend/set-finance-setup-single.php", type: "POST", data: infor, cache: false,
            beforeSend: function () {
                $("#ssp"+id).html('<span class=""><small>***</small></span>');
            },
            success: function(html) {
                $("#ssp"+id).html( html );
                // let k = document.getElementById('ssp'+id).innerHTML;
                // if(k != 'Done !'){
                //     document.getElementById('sspp'+id).innerHTML = k;
                //     document.getElementById('ssp'+id).innerHTML = '';
                //      push(id, 0);
                // }
            }
        });
    }
</script>