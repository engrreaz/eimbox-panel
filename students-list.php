<?php
include 'header.php';


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


$stprofile = array();
$sql00 = "SELECT * FROM students where  sccode='$sccode'";
$result00 = $conn->query($sql00);
if ($result00->num_rows > 0) {
    while ($row00 = $result00->fetch_assoc()) {
        $stprofile[] = $row00;
    }
}

?>

<h3 class="d-print-none">Student's List</h3>
<p class="d-print-none">
    <code>Reports <i class="mdi mdi-arrow-right"></i> Students List </code>
</p>

<div class="row d-print-none">
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
                                <button type="button" class="btn btn-inverse-success btn-block p-2" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Show List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row d-print-none" id="ren">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row">


                    <div id="pad" style="display:none;">
                        <div style="font-size:10px; font-style:italic;">
                            <?php include ('assets/pad/temp-01.php'); ?>
                        </div>
                    </div>


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
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Section : <b><?php echo $sec2; ?></b>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Total <b><span id="cnt"></span> </b>Students Found.

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div id="datam">

    <table class="table table-bordered table-striped "
        style=" border:1px solid gray !important; border-collapse:collapse; width:100%;" id="main-table">
        <thead>
            <tr>
                <th class="txt-right">#</th>
                <th class="txt-right">Name of Student</th>
                <th class="txt-right">Parents</th>
                <th class="txt-right">Address</th>
                <th class="txt-right">Roll/Regd</th>
                <th class="txt-right">Result</th>
                <th class="txt-right d-print-none"></th>
            </tr>
        </thead>

        <tbody>



            <?php
            $cnt = 0;
            $cntamt = 0;
            $sql0 = "SELECT * FROM sessioninfo where sessionyear LIKE '$sy%' and sccode='$sccode' and classname='$cls2' and sectionname = '$sec2' order by rollno";
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


                    $ind = array_search($stid, array_column($stprofile, 'stid'));
                    if ($ind != '') {
                        $neng = $stprofile[$ind]["stnameeng"];
                        $nben = $stprofile[$ind]["stnameben"];
                        $fname = $stprofile[$ind]["fname"];
                        $mname = $stprofile[$ind]["mname"];
                        $vill = $stprofile[$ind]["pervill"];
                        $po = $stprofile[$ind]["perpo"];
                        $ps = $stprofile[$ind]["perps"];
                        $dist = $stprofile[$ind]["perdist"];
                        $dob = $stprofile[$ind]["dob"];

                    } else {
                        $neng = '';
                        $nben = '';
                        $fname = '';
                        $mname = '';
                        $vill = '';
                        $po = '';
                        $ps = '';
                        $dist = '';
                        $dob = '';
                    }






                    //if($card == '1'){$qrc = '<img src="https://chart.googleapis.com/chart?chs=20x20&cht=qr&chl=http://www.students.eimbox.com/myinfo.php?id=5000&choe=UTF-8&chld=L|0" />';} else {$qrc = '';}
            


                    ?>
                    <tr>
                        <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                            <?php
                            echo $rollno;
                            ?>
                        </td>
                        <td style="padding : 3px 10px; border:1px solid gray;">
                            <div class="ooo"><small><?php echo $stid; ?></small></div>
                            <div class="ooo"><?php echo $neng; ?></div>
                            <div class="ooo"><?php echo $nben; ?></div>
                            <?php if ($dob != "") { ?>
                                <div class="ooo">DOB : <?php echo date('d / m / Y', strtotime($dob)); ?></div>
                            <?php } ?>
                        </td>
                        <td style="padding : 3px 10px; border:1px solid gray;">
                            <div class="ooo"><?php echo $fname; ?></div>
                            <div class="ooo"><?php echo $mname; ?></div>
                        </td>
                        <td style="padding : 3px 10px; border:1px solid gray;">
                            <div class="ooo"><?php echo $vill; ?></div>
                            <div class="ooo"><?php echo $po; ?></div>
                            <div class="ooo"><?php echo $ps; ?></div>
                            <div class="ooo"><?php echo $dist; ?></div>
                        </td>
                        <td style="padding : 3px 10px; border:1px solid gray;">
                            <div class="ooo"><?php echo ''; ?></div>
                            <div class="ooo"><?php echo ''; ?></div>
                        </td>

                        <td style=" border:1px solid gray;">

                            <?php echo ''; ?>

                        </td>
                        <td style=" border:1px solid gray;" class="d-print-none">
                            <div id="btn<?php echo $stid; ?>">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-inverse-info" onclick="issue(<?php echo $stid; ?>)">
                                        <i class="mdi mdi-grease-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-inverse-warning"
                                        onclick="issuet(<?php echo $stid; ?>)"  >
                                        <i class="mdi mdi-eye"></i>
                                    </button>

                      

                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $cnt++;
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
    document.getElementById('defbtn').innerHTML = 'Print Student List';
    document.getElementById('defmenu').innerHTML = '';
    document.getElementById("cnt").innerHTML = '<?php echo $cnt-1; ?>';
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

    function goprint() {
        var txt = document.getElementById("alladmit").innerHTML;
        var pad = document.getElementById("pad").innerHTML;
        var datam = document.getElementById("datam").innerHTML;
        document.write('<title>Eimbox</title>');
        document.write('<div class="d-print-nones" id="nono"><button style="z-index:9999; position:fixed; right:100px; top:50px; background: black;; color:white; padding:5px; border-radius:5px;"  onclick="reload();">Back to  List</button></div>');
        document.write('<div id="margin" style="padding:  15mm;"></div>');
        // document.write(pad);
        document.getElementById("margin").innerHTML = pad + txt + datam;
        // document.write(txt);
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