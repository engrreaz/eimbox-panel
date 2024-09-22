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
    $btntxt = 'Save';
} else {
    $btntxt = 'Update';
}

$examname = $exam;
$status = 0;

if (isset($_GET['id'])) {
    $anbd = 'block';
} else {
    $anbd = 'none';
}

?>

<h3>Subjects List </h3>
<code>Allowed in our Institution</code>

<div class="row" hidden>
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
                                    class="btn btn-inverse-primary btn-block" style="" onclick="go();"><i class="mdi mdi-eye"></i>
                                    View</button>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
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
                    Add a New Subject
                </h6>

                <?php
                $sql0x = "SELECT * FROM subjects where id='$schid' and sccode='$sccode';";
                $result0xrbg = $conn->query($sql0x);
                if ($result0xrbg->num_rows > 0) {
                    while ($row0x = $result0xrbg->fetch_assoc()) {
                        $schid = $row0x["id"];
                        $subcode = $row0x["subcode"];
                        $sube = $row0x["subject"];
                        $subb = $row0x["subben"];
                    }
                } else {
                    $schid = 0;
                    $subcode = '';
                    $sube = '';
                    $subb = '';
                }
                ?>


                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $schid; ?>" id="slid"
                                    disabled />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Subject Code</label>
                            <div class="col-12">

                                <input type="text" class="form-control" value="<?php echo $subcode; ?>" id="subcode" />

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Subject Name (English)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $sube; ?>" id="sube" />

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Subject Name (Bengali)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $subb; ?>" id="subb" />

                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-inverse-success p-2 btn-block " style="" onclick="save(<?php echo $schid; ?>, 3);"><i
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
                    <div id="sspn"></div>
                </h6>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th colspan="2">Subject</th>
                                    <th style="text-align:right;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $slno = 1;
                                $sql0x = "SELECT * FROM subjects where (sccode='$sccode' or sccode=0)  order by subcode;";
                                $result0xr = $conn->query($sql0x);
                                if ($result0xr->num_rows > 0) {
                                    while ($row0x = $result0xr->fetch_assoc()) {
                                        $idn = $row0x["id"];
                                        $subcode = $row0x["subcode"];
                                        $sube = $row0x["subject"];
                                        $subb = $row0x["subben"];
                                        $sccodes = $row0x["sccode"];


                                        if ($subcode == 901) {
                                            echo '<tr><td colspan="4" class="text-primary"><b>Subjects for New Curriculam</b></td></tr>';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $subcode; ?></td>
                                            <td><?php echo $sube; ?></td>
                                            <td><?php echo $subb; ?></td>
                                            <td>
                                                <?php if ($sccodes == $sccode) { ?>

                                                    <div id="ssp<?php echo $id; ?>">
                                                        <button onclick="edit(<?php echo $idn; ?>);" class="btn btn-inverse-info"><i
                                                                class="mdi mdi-grease-pencil"></i></button>

                                                        <button onclick="save(<?php echo $idn; ?>,1);"
                                                            class="btn btn-inverse-danger"><i class="mdi mdi-delete"></i></button>
                                                    </div>
                                                <?php } ?>
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
                                                <button onclick="setdef(0, 0);" class="btn btn-inverse-info"><i
                                                        class="mdi mdi-grease-pencil"></i> Apply Default Settings</button>

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
    document.getElementById('defbtn').innerHTML = 'Add New Subject';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        window.location.href = 'subjects-list.php?&id';
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
        window.location.href = 'subjects-list.php?&id=' + id;
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
        var subcode = parseInt(document.getElementById('subcode').value);
        if (subcode < 401 || subcode > 800) {
            alert('Subject Code Must be between 401 to 800');
        } else {
            var sube = document.getElementById('sube').value;
            var subb = document.getElementById('subb').value;
            var infor = "id=" + id + "&tail=" + tail + "&subcode=" + subcode + '&sube=' + sube + '&subb=' + subb;
            // alert(infor);
            $("#ssk").html("");

            $.ajax({
                type: "POST",
                url: "backend/save-new-subject.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#ssk').html('<span class=""><center><small>Updating...</small></center></span>');
                },
                success: function (html) {
                    $("#ssk").html(html);
                    window.location.href = 'subjects-list.php';

                }
            });
        }
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