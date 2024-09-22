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

if (isset($_GET['subj'])) {
    $subj = $_GET['subj'];
} else {
    $subj = '';
}
if (isset($_GET['assess'])) {
    $assess = $_GET['assess'];
} else {
    $assess = '';
}
if (isset($_GET['sheet'])) {
    $sheet2 = $_GET['sheet'];
} else {
    $sheet2 = 'Blank';
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

$sql0x = "SELECT stid, stnameeng FROM students where sccode='$sccode' ";
$result0xw = $conn->query($sql0x);
if ($result0xw->num_rows > 0) {
    while ($row0x = $result0xw->fetch_assoc()) {
        $stlist[] = $row0x;
    }
}
// echo var_dump($stlist);

?>

<h3 class="d-print-none">PI/BI Sheet</h3>
<p class="d-print-none">
    <code>Gradebook <i class="mdi mdi-arrow-right"></i> PI/BI Sheet </code>
</p>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card p-0">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Session</label>
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
                            <label class="col-form-label pl-3">Examination</label>
                            <div class="col-12">
                                <select class="form-control " id="exam" onchange="go();">

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

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class :</label>
                            <div class="col-12">
                                <select class="form-control " id="classname" onchange="go();">
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
                                <select class="form-control " id="sectionname" onchange="go();">
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




                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Subjects</label>
                            <div class="col-12">
                                <select class="form-control " id="subject">
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
                                            if ($subcode == $subj) {
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
                            <label class="col-form-label pl-3">Assessment</label>
                            <div class="col-12">
                                <select class="form-control " id="assessment" onchange="go();">
                                    <option value="Continious Assessment" <?php if($assess == 'Continious Assessment') echo 'selected';?>>Continious Assessment (PI)</option>
                                    <option value="Total Assessment"  <?php if($assess == 'Total Assessment') echo 'selected';?>>Total Assessment (PI)</option>
                                    <option value="Behavioural Assessment" <?php if($assess == 'Behavioural Assessment') echo 'selected';?>>Behavioural Assessment (BI)</option>

                                    <option value="Merged PI" <?php if($assess == 'Merged PI') echo 'selected';?>>Merged PI (Total)</option>
                                    <option value="Merged BI" <?php if($assess == 'Merged BI') echo 'selected';?>>Merged BI (Total)</option>

                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Sheet Type</label>
                            <div class="col-12">
                                <select class="form-control " id="sheet" onchange="go();">
                                    <option value="Blank" <?php if($sheet2 == 'Blank') echo 'selected';?>>Blank Sheet</option>
                                    <option value="Result"  <?php if($sheet2 == 'Result') echo 'selected';?>>Sheet with Result</option>
                                    

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 6px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-primary btn-icon-text btn-block pt-2 pb-2" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Generate PI/BI (Result)</button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #main-table thead tr th {
        border: 1px solid gray;
        font-weight: 700;
    }
</style>

<div class="row d-print-none" id="ren" hidden>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body p-0 p-3">

                <div class="row">
                    <div class="col-md-2 text-info text-small">
                        <?php echo $year; ?> &nbsp;
                        <h6 class="text-muted"><small>Session</small></h6>
                    </div>
                    <div class="col-md-2 text-info text-small">
                        <?php echo $cls2; ?> &nbsp;
                        <h6 class="text-muted"><small>Class</small></h6>
                    </div>
                    <div class="col-md-2 text-info text-small">
                        <?php echo $sec2; ?> &nbsp;
                        <h6 class="text-muted"><small>Section</small></h6>
                    </div>
                    <div class="col-md-3 text-info text-small">
                        <?php echo date('d/m/Y', strtotime($datefrom)) . ' - ' . date('d/m/Y', strtotime($dateto)); ?>
                        &nbsp;
                        <h6 class="text-muted"><small>Date </small></h6>
                    </div>
                    <div class="col-md-3 text-info text-small">
                        <?php echo $collector; ?> &nbsp;
                        <h6 class="text-muted"><small>Collector</small></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<table class="table table-bordered table-striped " style=" border:1px solid gray !important; border-collapse:collapse;"
    id="main-table">
    <thead>
        <tr>
            <th class="txt-right text-center" rowspan="2">#</th>
            <th class="txt-right" colspan="2">Skill</th>
            <th class="txt-right" colspan="2">Indicator</th>
            <th class="txt-right" rowspan="2">Level 1</th>
            <th class="txt-right text-center" rowspan="2">Level 2</th>
            <th class="txt-right" rowspan="2">level 3</th>

            <th class="txt-right" rowspan="2"></th>
        </tr>
        <tr>
        <th class="txt-right">Code</th>
        <th class="txt-right">Title</th>
        <th class="txt-right">Code</th>
        <th class="txt-right">Title</th>
        </tr>
    </thead>

    <tbody>



        <?php
        $cnt = 0;

        if ($assess == 'Behavioural Assessment') {
            $sql0 = "SELECT * FROM pibitopics where sessionyear = '$year' and exam='$exam2'  and behave=1  order by topiccode";
        } else {
            $sql0 = "SELECT * FROM pibitopics where sessionyear = '$year' and class='$cls2' and subcode='$subj' and exam='$exam2'  and behave=0   order by topiccode";
        }

        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            while ($row0 = $result0->fetch_assoc()) {
                // $stname = $row0["stname"];
                $skillcode = $row0["skillcode"];
                $skilltitle = $row0["skilltitle"];

                $topiccode = $row0["topiccode"];
                $topictitle = $row0["topictitle"];
                $level1 = $row0["level1"];
                $level2 = $row0["level2"];
                $level3 = $row0["level3"];
      

                // $ind = array_search($stid, array_column($stlist, 'stid'));

                //if($card == '1'){$qrc = '<img src="https://chart.googleapis.com/chart?chs=20x20&cht=qr&chl=http://www.students.eimbox.com/myinfo.php?id=5000&choe=UTF-8&chld=L|0" />';} else {$qrc = '';}
        


                ?>
                <tr>
                    <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                        <?php
                        echo $cnt + 1;
                        ?>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $skillcode; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php $skilltitle; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $topiccode; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php $topictitle; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php $level1; ?></div>
                    </td>
                    <td class="text-center" style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php $level2; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php $level3; ?></div>
                    </td>


             

                    <td style=" border:1px solid gray;" class="m-0 p-1 text-center">
                        <div class="p-3"></div>
                        <div id="btn<?php echo $stid; ?>" hidden>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-inverse-info" onclick="issue(<?php echo $stid; ?>)">
                                    <i class="mdi mdi-book-open-page-variant"></i>
                                </button>
                                <button type="button" class="btn btn-inverse-warning" onclick="issuet(<?php echo $stid; ?>)">
                                    <i class="mdi mdi-calendar"></i>
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


<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    document.getElementById('defbtn').innerHTML = 'PI/BI Sheet Print View';
    document.getElementById('defmenu').innerHTML = '';

    document.getElementById('cnt').innerHTML = '<?php echo $cnt; ?>';



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
        var exam = document.getElementById('exam').value;
        var cls = document.getElementById('classname').value;
        var sec = document.getElementById('sectionname').value;

        var subj = document.getElementById('subject').value;
        var assess = document.getElementById('assessment').value;
        var sheet = document.getElementById('sheet').value;

        window.location.href = 'result-pibi-print.php?sec=' + sec + '&cls=' + cls + '&year=' + year + '&exam=' + exam + '&subj=' + subj + '&assess=' + assess + '&sheet=' + sheet;
    }

    function go() {
        var year = document.getElementById('year').value;
        var exam = document.getElementById('exam').value;
        var cls = document.getElementById('classname').value;
        var sec = document.getElementById('sectionname').value;

        var subj = document.getElementById('subject').value;
        var assess = document.getElementById('assessment').value;
        var sheet = document.getElementById('sheet').value;

        window.location.href = 'result-pibi-sheet.php?sec=' + sec + '&cls=' + cls + '&year=' + year + '&exam=' + exam + '&subj=' + subj + '&assess=' + assess + '&sheet=' + sheet;
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