<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;
$refno = '';
$refdate = date('Y-m-d');
// $refno = $_GET['ref'] ?? 0;
// $undef = $_GET['undef'] ?? 99;
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

<h3 class="d-print-none">Testimonial Issue Register</h3>
<p class="d-print-none">
    <code>Registers <i class="mdi mdi-arrow-right"></i> Testimonial <i class="mdi mdi-arrow-right"></i> <?php echo $year; ?> <i class="mdi mdi-arrow-right"></i> <?php echo $sec2; ?></code>
</p>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Student's Dues Report - <?php echo $year; ?>
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
                            <label class="col-form-label pl-3">Section</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="exam">

                                    <!-- <option value="">---</option> -->
                                    <option value="SSC">SSC</option>
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
                                    class=" btn-primary btn-block" style="" onclick="go();"><i class="mdi mdi-eye"></i>
                                    Generate
                                    Card</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-info btn-block" style="" onclick="goprint(0);"><i
                                        class="mdi mdi-eye"></i> Print
                                    View</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-warning btn-block" style="" onclick="resultentry();"><i
                                        class="mdi mdi-eye"></i> Result Entry</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row d-print-none" id="ren" style="display:none;">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Board Roll</label>
                            <div class="col-12">
                                <input id="boardroll" type="text" class="form-control" onkeydown="fetchs(event);" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Student's Name</label>
                            <div class="col-12">
                                <input id="stname" type="text" style="background:slategray;" class="form-control"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Result</label>
                            <div class="col-12">
                                <input id="gpagla" type="text" class="form-control" onkeydown="svs(event);" />
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-primary btn-block" style="" onclick="savessc();"><i
                                        class="mdi mdi-eye"></i>
                                    Save Result</button><span id="sscspan"></span>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



<div>
    <div id="alladmit">

        <head>
            <style>
                * {
                    font-family: "Noto Sans Bengali", sans-serif;
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

                @media print {

                    .d-print-nones,
                    #nono {
                        display: none;
                    }
                }
            </style>
        </head>
        <div style="text-align: center;">
            Class : <b><?php echo $cls2; ?></b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:|:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Section : <b><?php echo $sec2; ?></b>
            <hr style="width:75%" />
        </div>

        <table class="table table-bordered"
            style="width:100%; border:1px solid gray !important; border-collapse:collapse;" id="main-table">
            <thead>
                <tr>
                    <td class="txt-right">#</td>
                    <td class="txt-right" colspan="2">Name of Student</td>
                    <td class="txt-right">Roll No.</td>
                    <td class="txt-right">Regd.</td>
                    <td class="txt-right" style="width:100px;">result</td>
                    <td class="txt-right" style="width:100px;"></td>
                </tr>
            </thead>

            <tbody>



                <?php
                $cnt = 0;
                $cntamt = 0;
                $sql0 = "SELECT * FROM sessioninfo where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname = '$sec2' order by rollno";
                $result0 = $conn->query($sql0);
                if ($result0->num_rows > 0) {
                    while ($row0 = $result0->fetch_assoc()) {
                        $stid = $row0["stid"];
                        $rollno = $row0["rollno"];
                        $card = $row0["icardst"];
                        $dtid = $row0["id"];
                        $status = $row0["status"];
                        $rel = $row0["religion"];
                        $four = $row0["fourth_subject"];


                        $sql00 = "SELECT * FROM students where  sccode='$sccode' and stid='$stid' LIMIT 1";
                        $result00 = $conn->query($sql00);
                        if ($result00->num_rows > 0) {
                            while ($row00 = $result00->fetch_assoc()) {
                                $neng = $row00["stnameeng"];
                                $nben = $row00["stnameben"];

                                $fname = $row00["fname"];
                                $mname = $row00["mname"];
                                $vill = $row00["previll"];



                                $regdno = $row00["regdno"];
                                $sscroll = $row00["rollno"];
                                $gpa = $row00["gpa"];
                                $gla = $row00["gla"];



                            }
                        }

                        //if($card == '1'){$qrc = '<img src="https://chart.googleapis.com/chart?chs=20x20&cht=qr&chl=http://www.students.eimbox.com/myinfo.php?id=5000&choe=UTF-8&chld=L|0" />';} else {$qrc = '';}
                


                        ?>
                        <tr>
                            <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                                <?php
                                echo $rollno;
                                ?>
                            </td>
                            <td style="padding : 3px 10px; border:1px solid gray;"><?php echo $neng; ?></td>
                            <td style="padding : 3px 10px; border:1px solid gray;"><?php echo $nben; ?></td>
                            <td style="padding : 3px 10px; border:1px solid gray;"><?php echo $sscroll; ?></td>
                            <td style="padding : 3px 10px; border:1px solid gray;"><?php echo $regdno; ?></td>

                            <td style=" border:1px solid gray;"><?php echo $gpa . ' / ' . $gla; ?></td>
                            <td style=" border:1px solid gray;">
                                <?php
                                $sql0 = "SELECT * from testimonial where stid='$stid' and sccode='$sccode' and pubexam = 'SSC' ";
                                $result01xn = $conn->query($sql0);
                                if ($result01xn->num_rows > 0) {
                                    while ($row0 = $result01xn->fetch_assoc()) {
                                        $testslno = $row0["testslno"];
                                        $recid = $row0["id"];
                                        ?>
                                        <div id="btnt<?php echo $stid; ?>">
                                            <button class="btn btn-success btn-block"
                                                onclick="goprint(<?php echo $stid; ?>)">Print</button>
                                        </div>
                                        <?php
                                    }
                                } else {

                                    if($regdno == '' || $sscroll == '') {
                                        ?>
                                        <div id="btn<?php echo $stid; ?>">
                                            <button class="btn btn-danger btn-block" onclick="issuex(<?php echo $stid; ?>)">Modify</button>
                                        </div>
                                        <?php
                                    } else if ($gpa <1) {
                                        ?>
                                        <div id="btn<?php echo $stid; ?>">
                                            <button class="btn btn-warning btn-block" onclick="resultentry()">Result Entry</button>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div id="btn<?php echo $stid; ?>">
                                            <button class="btn btn-info btn-block" onclick="issue(<?php echo $stid; ?>)">Issue
                                                Now</button>
                                        </div>
                                        <?php
                                    }
                                    
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <?php
    include 'footer.php';
    ?>

    <script>
        var uri = window.location.href;
        function reload() {
            window.location.href = uri;
        }
        function resultentry () {
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
            var exam = document.getElementById('exam').value;
            window.location.href = 'testimonial.php?&cls=' + cls + '&sec=' + sec + '&exam=' + exam + '&year=' + year;
        }
    </script>


    <script>
        function issue(stid) {
            var year = document.getElementById("year").value;
            var sec = document.getElementById("sec").value;
            var infor = "stid=" + stid + "&year=" + year + "&sec=" + sec;

            $("#btn" + stid).html("");

            $.ajax({
                type: "POST",
                url: "issue-testimonial.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#btn' + stid).html('<small>Processing...</small>');
                },
                success: function (html) {
                    $("#btn" + stid).html(html);
                }
            });
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