<?php
include 'header.php';

$ts = date('H:i:s');
$refno = '';
$refdate = date('Y-m-d');

if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date('Y');
}

if (isset($_GET['cls'])) {
    $cls2 = $_GET['cls'];
} else {
    $cls2 = '';
}
if (isset($_GET['sec'])) {
    $sec2 = $_GET['sec'];
} else {
    $sec2 = '';
}
if (isset($_GET['exam'])) {
    $exam2 = $_GET['exam'];
} else {
    $exam2 = '';
}

$col = 3;
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

<h3 class="d-print-none">Restore Data</h3>
<p class="d-print-none">
    <code>Settings <i class="mdi mdi-arrow-right"></i> Data Repository > Restore</code>
</p>

<div class="row d-print-none" hidden>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                </h6>
                <div class="row">
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
                            <label class="col-form-label pl-3">Class :</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="cls" onchange="go();">
                                    <option value=" ">---</option>
                                    <?php
                                    $sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear='$year' group by areaname order by idno;";
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
                                    // echo $sql0x;
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
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-outline-success btn-icon-text btn-block" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Generate
                                    Card</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row d-print-none" id="ren" hidden>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div id="alladmit">

                        <head>
                            <style>
                                * {
                                    font-family: "Noto Sans Bengali", sans-serif;
                                }


                                #full-text {

                                    font-family: "Source Code Pro", monospace;
                                    font-optical-sizing: auto;
                                    font-weight: 400;
                                    /* font-style: italic; */
                                }

                                #main-table td {
                                    border: 1px solid black;
                                }

                                .txt-right {
                                    text-align: center;
                                    font-weight: bold;
                                    font-size: 14px;
                                    padding: 5px;
                                    border: 1px solid gray !important;
                                }

                                .ooo {
                                    padding: 3px 0;
                                }

                                @media print {

                                    .d-print-nones,
                                    #nono {
                                        display: none;
                                    }
                                }
                            </style>
                        </head>
                        <div style="text-align: left;">
                            Class : <b><?php echo $cls2; ?></b>
                            Section : <b><?php echo $sec2; ?></b>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row d-print-none" id="renxx">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-12  d-flex">
                    <div class="col-md-5">
                        <div class="row text-small d-block pr-4" id="full-text">

                            <?php

                            if (isset($_POST["submit"])) {
                                $dispfilename = $_FILES["fileToUpload"]["name"];
                                $filename = $_FILES["fileToUpload"]["tmp_name"];
                                $oak = file($filename);
                                $linecount = count($oak);
                                echo '<script>document.getElementById("loader-data").innerHTML="' . $linecount . '";</script>';
                                if ($linecount <= 1000) {
                                    include 'sql-restore.php';
                                } else {
                                    echo LARGE_DATA_FILE;
                                    ?>

                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control " />
                                        <input type="submit" class="btn btn-inverse-success p-2 mt-2" value="Restore Data"
                                            name="submit" />
                                    </form>

                                    <?php
                                }

                            } else if (isset($_GET["cloud"])) {
                                $dispfilename = $_GET["cloud"];
                                $filename = 'backup/' . $sccode . '/' . $_GET["cloud"];
                                $oak = file($filename);
                                $linecount = count($oak);
                                // echo $linecount;
                                if ($linecount <= 1000) {
                                    include 'sql-restore.php';
                                } else {
                                    echo LARGE_DATA_FILE;
                                    ?>

                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control " />
                                            <input type="submit" class="btn btn-inverse-success p-2 mt-2" value="Restore Data"
                                                name="submit" />
                                        </form>

                                    <?php
                                }



                            } else if (isset($_COOKIE["fn"])) {
                                $dispfilename = $_COOKIE["fn"];
                                ?>
                                        <script type="text/javascript"> document.cookie = "fn=";</script>
                                    <?php
                                    if ($dispfilename != '') {
                                        $filename = 'backup/' . $sccode . '/' . $dispfilename;
                                        $oak = file($filename);
                                        $linecount = count($oak);
                                        // echo $linecount;
                                        if ($linecount <= 1000) {
                                            include 'sql-restore.php';
                                        } else {
                                            echo LARGE_DATA_FILE;
                                            ?>

                                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                                                    enctype="multipart/form-data">
                                                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control " />
                                                    <input type="submit" class="btn btn-inverse-success p-2 mt-2" value="Restore Data"
                                                        name="submit" />
                                                </form>

                                        <?php
                                        }

                                    } else {
                                        ?>

                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                                                enctype="multipart/form-data">
                                                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control " />
                                                <input type="submit" class="btn btn-inverse-success p-2 mt-2" value="Restore Data"
                                                    name="submit" />
                                            </form>

                                    <?php
                                    }


                            } else {
                                ?>

                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control " />
                                            <input type="submit" class="btn btn-inverse-success p-2 mt-2" value="Restore Data"
                                                name="submit" />
                                        </form>

                                <?php

                            }






                            // echo var_dump($_POST);
                            

                            ?>

                        </div>
                    </div>

                    <div class="col-md-7">
                        <?php include 'file-cloud-list.php'; ?>
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
    document.getElementById('defbtn').innerHTML = 'Print Testimonials';

    function defbtn() {
        goprint(0);
    }
    function reload() {
        window.location.href = uri;
    }
    function resultentry(roll) {
        if (roll == 0) {
            document.getElementById('boardroll').value = '';
        } else {
            document.getElementById('boardroll').value = roll;
        }

        document.getElementById('ren').style.display = 'block';
        document.getElementById('boardroll').focus();
    }

    function goprint(stid) {
        var year = document.getElementById('year').value;
        var sec = document.getElementById('sec').value;
        var exam = document.getElementById('exam').value;
        window.location.href = 'testimonial-print.php?sec=' + sec + '&exam=' + exam + '&year=' + year + '&stid=' + stid;
    }

    function go() {
        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        window.location.href = 'students-list.php?&cls=' + cls + '&sec=' + sec + '&year=' + year;
    }
</script>

<script>
    function issue(stid) {
        window.location.href = 'students-edit.php?stid=' + stid;
    }
    function issuet(stid) {
        window.location.href = 'student-profile.php?stid=' + stid;
    }
</script>

<script>
    function fetchs(e) {
        if (e.key == 'Enter') {
            var br = document.getElementById("boardroll").value;
            var infor = "br=" + br;

            $("#sscspan").html("");

            $.ajax({
                type: "POST",
                url: "backend/fetch-board-roll.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#sscspan').html('<small>Processing...</small>');
                },
                success: function (html) {
                    $("#sscspan").html(html);
                    var st = document.getElementById("sscspan").innerHTML;

                    if (st == 'Something went wrong.') {
                        document.getElementById("sscspan").innerHTML = '<code>' + st + '</code><br>Data Missing or Multiple Entry Found.';
                    } else {
                        document.getElementById("stname").value = st;
                        document.getElementById("sscspan").innerHTML = '';
                        document.getElementById("gpagla").focus();
                    }
                }
            });
        }
    }

    function svs(e) {
        if (e.key == 'Enter') {
            savessc();
        }
    }

    function savessc() {
        var br = document.getElementById("boardroll").value;
        var gpgl = document.getElementById("gpagla").value;
        var infor = "br=" + br + "&gpgl=" + gpgl;

        $("#sscspan").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-board-result.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sscspan').html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#sscspan").html(html);
                var st = parseInt(document.getElementById("boardroll").value) + 1;
                document.getElementById("boardroll").value = st;
                document.getElementById("gpagla").value = '';
                document.getElementById("boardroll").focus();

            }
        });
    }
</script>