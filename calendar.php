<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

// $refno = $_GET['ref'] ?? 0;
// $undef = $_GET['undef'] ?? 99;


if (isset($_GET['y'])) {
    $year = $_GET['y'];
} else {
    $year = date('Y');
}
if (isset($_GET['c'])) {
    $cls2 = $_GET['c'];
} else {
    $cls2 = '';
}
if (isset($_GET['s'])) {
    $sec2 = $_GET['s'];
} else {
    $sec2 = '';
}
if (isset($_GET['e'])) {
    $exam2 = $_GET['e'];
} else {
    $exam2 = '';
}

if (isset($_GET['id'])) {
    $schid = $_GET['id'];
} else {
    $schid = 0;
}

if ($schid == 0) {
    $btntxt = 'Save Schedule';
} else {
    $btntxt = 'Update Schedule';
}

$examname = $exam;
$status = 0;

if (isset($_GET['id'])) {
    $anbd = 'block';
} else {
    $anbd = 'none';
}


$f_date = $sy . '-01-01';
$l_date = $sy . '-12-31';
$sql0 = "SELECT * FROM calendar where (sccode = '$sccode' or sccode=0) and date between '$f_date' and '$l_date' and descrip IS NOT NULL order by date; ;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $datam[] = $row0;
    }
} else {
    $datam[] = '';
}
// echo var_dump($datam);
?>

<h3>Academic Calendar</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Fill out the form below to show routine
                </h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Year</label>
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
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class :</label>
                            <div class="col-12">
                                <select class="form-control " id="cls" onchange="go();">
                                    <option value=" ">---</option>
                                    <?php
                                    $sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear='$year' group by areaname order by idno;";
                                    echo $sql0x;
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
                                <select class="form-control " id="sec" onchange="go();">
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT subarea FROM areas where user='$rootuser' and sessionyear='$year' and areaname='$cls2' group by subarea order by idno;";
                                    echo $sql0x;
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
                            <label class="col-form-label pl-3">Examination</label>
                            <div class="col-12">
                                <select class="form-control " id="exam">

                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT examtitle FROM examlist where sccode='$sccode' and sessionyear='$year'   order by id;";
                                    echo $sql0x;
                                    $result0rt = $conn->query($sql0x);
                                    if ($result0rt->num_rows > 0) {
                                        while ($row0x = $result0rt->fetch_assoc()) {
                                            $exname = $row0x["examtitle"];
                                            if ($exname == $exam2) {
                                                $selex = 'selected';
                                            } else {
                                                $selex = '';
                                            }
                                            echo '<option value="' . $exname . '" ' . $selex . ' >' . $exname . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>






                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn-primary btn-block" style="" onclick="go();"><i class="mdi mdi-eye"></i>
                                    View</button>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn-danger btn-block" style="" onclick="god();"><i class="mdi mdi-plus"></i>
                                    Add New</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- SEARCH BLOCK -->

            </div>
        </div>
    </div>
</div>

<div class="row" id="addnewblock" style="display:<?php echo $anbd; ?>">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Add a schedule
                </h6>

                <?php
                $sql0x = "SELECT * FROM examroutine where id='$schid' ;";
                $result0xrbg = $conn->query($sql0x);
                if ($result0xrbg->num_rows > 0) {
                    while ($row0x = $result0xrbg->fetch_assoc()) {
                        $scode = $row0x["subcode"];
                        $exdate = $row0x["date"];
                        $extime = $row0x["time"];
                    }
                } else {
                    $scode = 0;
                    $exdate = '';
                    $extime = '';
                }
                ?>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class</label>
                            <div class="col-12">
                                <input type="date" class="form-control" value="<?php echo $exdate; ?>" id="exdate" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Section/Group</label>
                            <div class="col-12">
                                <input type="time" class="form-control" value="<?php echo $extime; ?>" id="extime" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Subjects</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="subcode">
                                    <option value="">------</option>
                                    <?php
                                    $sql0x = "SELECT * FROM subsetup where sccode='$sccode' and sessionyear = '$year' and classname='$cls2' and sectionname='$sec2' order by subject;";
                                    $result0xr = $conn->query($sql0x);
                                    if ($result0xr->num_rows > 0) {
                                        while ($row0x = $result0xr->fetch_assoc()) {
                                            $subcode = $row0x["subject"];

                                            $sql0x = "SELECT * FROM subjects where subcode='$subcode' ;";
                                            $result0xrb = $conn->query($sql0x);
                                            if ($result0xrb->num_rows > 0) {
                                                while ($row0x = $result0xrb->fetch_assoc()) {
                                                    $subname = $row0x["subject"];
                                                }
                                            }
                                            if ($subcode == $scode) {
                                                $sld = 'selected';
                                            } else {
                                                $sld = '';
                                            }
                                            echo '<option value="' . $subcode . '" ' . $sld . ' >' . $subname . '</option>';
                                        }
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
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn-success" style="" onclick="save(<?php echo $schid; ?>, 1);"><i
                                        class="mdi mdi-disc"></i>
                                    <?php echo $btntxt; ?></button>
                                <span id="ssk"></span>
                            </div>
                        </div>
                    </div>



                </div>



            </div>
        </div>
    </div>
</div>

<div class="row" style="display:none;">
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
                <div class="row">

                    <?php
                    for ($m = 1; $m <= 12; $m++) {
                        $month = date("F", mktime(0, 0, 0, $m + 1, 0));
                        ?>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-form-label pl-3"></label><?php echo $month . ' / ' . $sy; ?></label>
                                <div class="col-12">
                                    <?php
                                    $firstday = date("w", mktime(0, 0, 0, $m, 0, $sy));
                                    $last = date("t", mktime(0, 0, 0, $m + 1, 0, $sy));

                                    echo '<table class="table table-responsivex">';
                                    echo '<thead><tr><td>S</td><td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td></tr></thead>';
                                    for ($j = 0; $j < 6; $j++) {
                                        echo '<tr>';
                                        for ($k = 0; $k < 7; $k++) {
                                            echo '<td>';
                                            if ($firstday == 6) {
                                                $extd = 7;
                                            } else {
                                                $extd = 0;
                                            }
                                            $trk = $j * 7 + $k - $firstday + $extd;
                                            if ($trk >= 1 && $trk <= $last) {

                                                $mkdate = $sy . '-' . str_pad($m, 2, '0', STR_PAD_LEFT) . '-' . str_pad($trk, 2, '0', STR_PAD_LEFT);
                                                $ind = array_search($mkdate, array_column($datam, 'date'));

                                                if ($ind == '') {
                                                    echo $trk;
                                                } else {
                                                    echo '<span class="bg-primary p-1 rounded text-white">' . $trk . '</span>';
                                                    // echo '<br>' . $datam[$ind]['descrip'];
                                                }
                                            }
                                            echo '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                    echo '</table>';

                                    ?>

                                </div>
                            </div>
                        </div>

                    <?php } ?>

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

    var d = localStorage.getItem("ex-routine-date");
    var t = localStorage.getItem("ex-routine-time");
    document.getElementById("exdate").value = d;
    document.getElementById("extime").value = t;

    function go() {
        var y = document.getElementById('year').value;
        var c = document.getElementById('cls').value;
        var s = document.getElementById('sec').value;
        var e = document.getElementById('exam').value;
        window.location.href = 'exam-routine.php?&y=' + y + '&c=' + c + '&s=' + s + '&e=' + e;
    }
</script>
<script>
    function edit(id, taill) {
        var y = document.getElementById('year').value;
        var c = document.getElementById('cls').value;
        var s = document.getElementById('sec').value;
        var e = document.getElementById('exam').value;
        window.location.href = 'exam-routine.php?&y=' + y + '&c=' + c + '&s=' + s + '&e=' + e + '&id=' + id + '&tail=' + taill;
    }
    function god() {
        var y = document.getElementById('year').value;
        var c = document.getElementById('cls').value;
        var s = document.getElementById('sec').value;
        var e = document.getElementById('exam').value;
        window.location.href = 'exam-routine.php?&y=' + y + '&c=' + c + '&s=' + s + '&e=' + e + '&id=0&tail=1';
    }
</script>

<script>
    function save(id, tail) {
        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        var exam = document.getElementById('exam').value;
        var date = document.getElementById('exdate').value;
        var time = document.getElementById('extime').value;
        var subcode = document.getElementById('subcode').value;
        var infor = "id=" + id + "&tail=" + tail + "&year=" + year + '&cls=' + cls + '&sec=' + sec + '&exam=' + exam + '&date=' + date + '&time=' + time + "&sub=" + subcode;

        $("#ssk").html("");

        $.ajax({
            type: "POST",
            url: "save-exam-routine.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#ssk').html('<span class=""><center>Check Issue....</center></span>');
            },
            success: function (html) {
                $("#ssk").html(html);
                if (tail == 0) {
                    go();
                } else {
                    localStorage.setItem("ex-routine-date", date);
                    localStorage.setItem("ex-routine-time", time);
                    god();
                }
            }
        });
    }
</script>