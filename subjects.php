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
    $btntxt = 'Save Subject';
} else {
    $btntxt = 'Update Subject';
}

$examname = $exam;
$status = 0;

if (isset($_GET['id'])) {
    $anbd = 'block';
} else {
    $anbd = 'none';
}

?>

<h3>Subjects Manager</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Fill out the form below to show routine
                </h6>
                <div class="row">

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


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class :</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="cls" onchange="go();">
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
                                <select class="form-control text-white" id="sec" onchange="go();">
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


                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn-primary btn-block" style="" onclick="go();"><i class="mdi mdi-eye"></i>
                                    View</button>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn-success btn-block" style="" onclick="god();"><i class="mdi mdi-book-open-page-variant"></i>
                                    Add Subject</button>
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
                    Add a Subject to the selected Class/Section 
                </h6>

                <?php
                $sql0x = "SELECT * FROM subsetup where id='$schid' and sccode='$sccode' and sessionyear='$year';";
                $result0xrbg = $conn->query($sql0x);
                if ($result0xrbg->num_rows > 0) {
                    while ($row0x = $result0xrbg->fetch_assoc()) {
                        $scode = $row0x["subject"];
                        $tid = $row0x["tid"];
                    }
                } else {
                    $scode = 0;
                    $tid = 0;
                }
                ?>


                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control bg-dark" value="<?php echo $schid; ?>" id="slid"
                                    disabled />
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

                                    $sql0x = "SELECT * FROM subjects order by subcode ;";
                                    $result0xrb = $conn->query($sql0x);
                                    if ($result0xrb->num_rows > 0) {
                                        while ($row0x = $result0xrb->fetch_assoc()) {
                                            $subname = $row0x["subject"];
                                            $subcode = $row0x["subcode"];

                                            if ($subcode == $scode) {
                                                $sld = 'selected';
                                            } else {
                                                $sld = '';
                                            }

                                            if ($subcode == 901) {
                                                echo '<option value=""  >*****New Curriculum Subjects</option>';
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
                            <label class="col-form-label pl-3">Teacher</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="tid">
                                    <option value="">------</option>
                                    <?php
                                    $sql0x = "SELECT * FROM teacher where sccode='$sccode'  order by sl, id;";
                                    $result0xr2 = $conn->query($sql0x);
                                    if ($result0xr2->num_rows > 0) {
                                        while ($row0x = $result0xr2->fetch_assoc()) {
                                            $tid2 = $row0x["tid"];
                                            $tname = $row0x["tname"];

                                            if ($tid2 == $tid) {
                                                $sld2 = 'selected';
                                            } else {
                                                $sld2 = '';
                                            }
                                            echo '<option value="' . $tid2 . '" ' . $sld2 . ' >' . $tname . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn-warning" style="" onclick="setdef(<?php echo $schid; ?>, 3);"><i
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



<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div id="sspd"></div>
                <h6 class="text-muted font-weight-normal">
                    Subject list of the <b><?php echo $cls2 . ' (' . $sec2 . ')'; ?></b>
                    <div id="sspn"></div>
                </h6>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover text-white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th style="text-align:right;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $slno = 1;
                                $sql0x = "SELECT * FROM subsetup where sccode='$sccode' and sessionyear = '$year' and classname='$cls2' and sectionname='$sec2' order by subject;";
                                $result0xr = $conn->query($sql0x);
                                if ($result0xr->num_rows > 0) {
                                    while ($row0x = $result0xr->fetch_assoc()) {
                                        $subcode = $row0x["subject"];
                                        $id = $row0x["id"];
                                        $ttid = $row0x["tid"];

                                        $sql0x = "SELECT * FROM subjects where subcode='$subcode' ;";
                                        $result0xrb = $conn->query($sql0x);
                                        if ($result0xrb->num_rows > 0) {
                                            while ($row0x = $result0xrb->fetch_assoc()) {
                                                $subname = $row0x["subject"];
                                            }
                                        }

                                        $sql0x = "SELECT * FROM teacher where sccode='$sccode' and tid='$ttid' ;";
                                        $result0xr2 = $conn->query($sql0x);
                                        if ($result0xr2->num_rows > 0) {
                                            while ($row0x = $result0xr2->fetch_assoc()) {
                                                $tnamed = $row0x["tname"];
                                            }
                                        } else {
                                            $tnamed = '';
                                        }

                                        ?>
                                        <tr>
                                            <td><?php echo $slno; ?></td>
                                            <td><?php echo $subcode; ?></td>
                                            <td><?php echo $subname; ?></td>
                                            <td><?php echo $tnamed; ?></td>
                                            <td>
                                                <div id="ssp<?php echo $id; ?>">
                                                    <button onclick="edit(<?php echo $id; ?>);" class="btn btn-inverse-info"><i
                                                            class="mdi mdi-grease-pencil"></i></button>

                                                    <button onclick="setdef(<?php echo $id; ?>,1);"
                                                        class="btn btn-inverse-danger"><i class="mdi mdi-delete"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $slno++;
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="5">
                                            No Data / Records Found.<br><br>
                                            <div id="sspnx">
                                                <button onclick="setdef(0, 0);" class="btn btn-inverse-primary"><i
                                                        class="mdi mdi-book-open-page-variant"></i> Apply Default Settings</button>

                                            </div>

                                        </td>
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
    document.getElementById('defbtn').innerHTML = '';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {

    }

    function go() {
        var y = document.getElementById('year').value;
        var c = document.getElementById('cls').value;
        var s = document.getElementById('sec').value;
        window.location.href = 'subjects.php?&y=' + y + '&c=' + c + '&s=' + s;
    }
</script>

<script>
    function edit(id) {
        var y = document.getElementById('year').value;
        var c = document.getElementById('cls').value;
        var s = document.getElementById('sec').value;
        window.location.href = 'subjects.php?&y=' + y + '&c=' + c + '&s=' + s + '&id=' + id;
    }
    function god() {
        var y = document.getElementById('year').value;
        var c = document.getElementById('cls').value;
        var s = document.getElementById('sec').value;
        window.location.href = 'subjects.php?&y=' + y + '&c=' + c + '&s=' + s + '&id=0';
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

<script>
    function setdef(sl, tail) {

        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        if (tail == 3) {
            var sub = document.getElementById('subcode').value;
            var tid = document.getElementById('tid').value;
            var infor = "year=" + year + '&cls=' + cls + '&sec=' + sec + "&tail=" + tail + '&sl=' + sl + '&tid=' + tid + '&sub=' + sub;
        } else {
            var infor = "year=" + year + '&cls=' + cls + '&sec=' + sec + "&tail=" + tail + '&sl=' + sl;
        }

        // alert(infor);
        $("#sspn").html("");

        $.ajax({
            type: "POST",
            url: "backend/set-default-subjects.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspn').html('<span class=""><center>Please wail while setting ......</center></span>');
            },
            success: function (html) {
                $("#sspn").html(html);
                window.location.href = 'subjects.php?&y=' + year + '&c=' + cls + '&s=' + sec;
            }
        });
    }

</script>