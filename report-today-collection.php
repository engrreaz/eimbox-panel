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

$cls2 = trim($cls2);
$sec2 = trim($sec2);

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

<h3 class="d-print-none" style="float:right;"> <?php echo date('d F, Y');?></h3>
<h3 class="d-print-none">Today's Collection</h3>
<p class="d-print-none">
    <code>Reports <i class="mdi mdi-arrow-right"></i> Today's Collection Report </code>
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
                                    <option value="">---</option>
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
                                <button type="button" style="padding:8px 10px 7px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-success btn-icon-text btn-block" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Show Collection</button>
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
                        <div class="text-small" style="text-align: left;">
                            <span class="mr-0"></span>Class : <b><span class="text-warning" id=""><?php echo $cls2; ?></span></b>
                            <span class="mr-5"></span>Section : <b><span class="text-warning" id=""><?php echo $sec2; ?></span></b>
                            <span class="mr-5"></span>Receipt Count : <b><span class="text-warning" id="cnt"></span></b>
                            <span class="mr-5"></span>Total Amount : <b><span class="text-warning" id="tamt"></span></b>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<table class="table table-bordered  " style=" border:1px solid gray !important; border-collapse:collapse;"
    id="main-table">
    <thead>
        <tr>
            <td class="txt-right">#</td>

            <td class="txt-right">Class</td>
            <td class="txt-right">Section</td>
            <td class="txt-right">Roll</td>
            <td class="txt-right">Name of Student</td>
            <td class="txt-right">PR No.</td>
            <td class="txt-right">Amount</td>
            <td class="txt-right">Collector</td>
            <td class="txt-right"></td>
        </tr>
    </thead>

    <tbody>



        <?php
        $cnt = 0;
        $tamt = 0;
        if ($cls2 != '') {
            if ($sec2 != '') {
                $sql0 = "SELECT * FROM stpr where sessionyear LIKE '$sy%' and sccode='$sccode' and classname='$cls2' and sectionname='$sec2' and prdate='$td' and entryby='$usr' order by entrytime desc, id desc";
            } else {
                $sql0 = "SELECT * FROM stpr where sessionyear LIKE '$sy%' and sccode='$sccode' and classname='$cls2' and prdate='$td' and entryby='$usr' order by entrytime desc, id desc";
            }
        } else {
            $sql0 = "SELECT * FROM stpr where sessionyear LIKE '$sy%' and sccode='$sccode' and prdate='$td' and entryby='$usr' order by entrytime desc, id desc";
        }

        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            while ($row0 = $result0->fetch_assoc()) {
                $stid = $row0["stid"];
                // $stname = $row0["stname"];
                $clsd = $row0["classname"];
                $secd = $row0["sectionname"];
                $roll = $row0["rollno"];
                $entryby = $row0["entryby"];
                $prno = $row0["prno"];
                $amount = $row0["amount"];



                //if($card == '1'){$qrc = '<img src="https://chart.googleapis.com/chart?chs=20x20&cht=qr&chl=http://www.students.eimbox.com/myinfo.php?id=5000&choe=UTF-8&chld=L|0" />';} else {$qrc = '';}
        


                ?>
                <tr>
                    <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                        <?php
                        echo '#';
                        ?>
                    </td>

                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $clsd; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $secd; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $roll; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php ; ?></div>
                    </td>

                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $prno; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $amount; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $entryby; ?></div>
                    </td>

                    <td style=" border:1px solid gray;" class="m-0 p-1 text-center">
                        <div id="btn<?php echo $stid; ?>">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-inverse-danger" onclick="issuex(<?php echo $stid; ?>)">
                                    <i class="mdi mdi-delete mdi-18px"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                $cnt++;
                $tamt += $amount;
            }
        }
        ?>
    </tbody>
</table>


<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    document.getElementById('defbtn').innerHTML = 'Print Report';
    document.getElementById('defbtn').disabled = true;
    document.getElementById('defmenu').innerHTML = '';

    document.getElementById('cnt').innerHTML = '<?php echo $cnt; ?>';
    document.getElementById('tamt').innerHTML = '<?php echo $tamt; ?>.00';


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
        window.location.href = 'report-today-collection.php?&cls=' + cls + '&sec=' + sec + '&year=' + year;
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

    function issuex(id) {
        alert('Deleting records are currenty disabled.');
    }
</script>