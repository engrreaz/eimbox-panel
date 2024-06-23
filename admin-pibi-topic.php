<?php
include 'header.php';


$ncode = $nncode = 0;


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
$cls2 = trim($cls2);

if (isset($_GET['exam'])) {
    $exam2 = $_GET['exam'];
} else {
    $exam2 = '';
}


if (isset($_GET['subj'])) {
    $subj2 = $_GET['subj'];
} else {
    $subj2 = date('Y-m-d');
}




$col = 3;
$status = 0;

if (isset($_GET['addnew'])) {
    $newblock1 = 'block';
    $skillid = $_GET['addnew'];
    if ($skillid == '') {
        $skillid = 0;
    }
} else {
    $newblock1 = 'none';
    $skillid = 0;
}

if (isset($_GET['addnew2'])) {
    $newblock2 = 'block';
    $topicid = $_GET['addnew2'];
    if ($topicid == '') {
        $topicid = 0;
    }
} else {
    $newblock2 = 'none';
    $topicid = 0;
}


?>

<h3 class="d-print-none">PI/BI Topic (Admin)</h3>
<p class="d-print-none">
    <code>Reports <i class="mdi mdi-arrow-right"></i> PI/BI Topics </code>
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
                            <label class="col-form-label pl-3">Examination</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="exam" onchange="go();">
                                    <option value="Half Yearly" <?php if ($exam2 == 'Half Yearly')
                                        echo 'selected'; ?>>Half
                                        Yearly</option>
                                    <option value="Annual" <?php if ($exam2 == 'Annual')
                                        echo 'selected'; ?>>Annual</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Subjects</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="subcode" onchange="go();">
                                    <option value="">------</option>
                                    <?php
                                    $sql0x = "SELECT * FROM subsetup where sccode='$sccode' and sessionyear = '$year' and classname='$cls2' group by subject order by subject;";
                                    $result0xr = $conn->query($sql0x);
                                    if ($result0xr->num_rows > 0) {
                                        while ($row0x = $result0xr->fetch_assoc()) {
                                            $subcode = $row0x["subject"];

                                            $sql0x = "SELECT * FROM subjects where subcode='$subcode' ;";
                                            $result0xrb = $conn->query($sql0x);
                                            if ($result0xrb->num_rows > 0) {
                                                while ($row0x = $result0xrb->fetch_assoc()) {
                                                    $subname = $row0x["subject"];
                                                    $ncode = $row0x["ncode"];
                                                }
                                            }
                                            if ($subcode == $subj2) {
                                                $sld = 'selected';
                                                $nncode = $ncode;
                                            } else {
                                                $sld = '';
                                                $nncode = 0;
                                            }
                                            echo '<option value="' . $subcode . '" ' . $sld . ' >' . $subname . '</option>';
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
                                <button type="button" style="padding:4px 10px 6px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-primary btn-icon-text btn-block pt-2 pb-2"
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Show PI/BI Topics</button>
                            </div>
                        </div>
                    </div>




                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">

                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 6px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-primary btn-icon-text btn-block pt-2 pb-2" style=""
                                    onclick="addskill();"><i class="mdi mdi-eye"></i>
                                    Skill +</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 6px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-primary btn-icon-text btn-block pt-2 pb-2" style=""
                                    onclick="addtopic();"><i class="mdi mdi-eye"></i>
                                    Topic +</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row" id="addnewblockskill" style="display:<?php echo $newblock1; ?>">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Add a skill
                </h6>

                <?php
                $sql0x = "SELECT * FROM pibiskill where year='$year' and classname = '$cls2' and subj='$subj2' and id='$skillid' ;";
                $result0xrbg = $conn->query($sql0x);
                if ($result0xrbg->num_rows > 0) {
                    while ($row0x = $result0xrbg->fetch_assoc()) {
                        $sid = $row0x["skillid"];
                        $sno = $row0x["skillno"];
                        $stitle = $row0x["title"];


                    }
                } else {
                    $sid = 0;
                    $sno = '';
                    $stitle = '';


                }
                ?>


                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Skill ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $sid; ?>" id="skillid"
                                    onblur="skillno();" />

                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Skill No</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $stitle; ?>" id="skillno" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Skill Title</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $stitle; ?>"
                                    id="skilltitle" />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="" class="btn btn-inverse-success p-2 btn-block" style=""
                                    onclick="save(<?php echo $topicid; ?>, 1);"><i class="mdi mdi-save"></i>
                                    Save</button>
                                <span id="ssk1"></span>
                            </div>
                        </div>
                    </div>



                </div>



            </div>
        </div>
    </div>
</div>


<div class="row" id="addnewblocktopic" style="display:<?php echo $newblock2; ?>">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Add a Topic
                </h6>

                <?php
                $sql0x = "SELECT * FROM pibitopics where id='$topicid' ;";
                $result0xrbg = $conn->query($sql0x);
                if ($result0xrbg->num_rows > 0) {
                    while ($row0x = $result0xrbg->fetch_assoc()) {
                        $skillx = $row0x["skillcode"];
                        $codex = $row0x["topiccode"];
                        $titlex = $row0x["topictitle"];
                        $level1 = $row0x["level1"];
                        $level2 = $row0x["level2"];
                        $level3 = $row0x["level3"];
                    }
                } else {
                    $skillx = $codex = $titlex = '';
                    $level1 = $level2 = $level3 = '';
                }
                ?>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Skill Code</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $skillx; ?>" id="skcode2" />


                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">PI/BI Code</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $codex; ?>" id="tcode2" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">PI/BI Topic</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $titlex; ?>" id="ttitle2" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Indicator Level - 1</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $level1; ?>" id="level1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Indicator Level - 2</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $level2; ?>" id="level2" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Indicator Level - 3</label>
                            <div class="col-12">
                                <input type="text" class="form-control" value="<?php echo $level3; ?>" id="level3" />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="" class="btn btn-inverse-success p-2 btn-block " style=""
                                    onclick="savetopic(<?php echo $topicid; ?>, 5);"><i class="mdi mdi-disc"></i>
                                    Save/Update</button>
                                <span id="ssk5"></span>
                            </div>
                        </div>
                    </div>



                </div>



            </div>
        </div>
    </div>
</div>





<style>
    #main-table-search thead tr th {
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

<!-- style=" border:1px solid gray !important; border-collapse:collapse;" -->
<table class="table table-bordered table-striped " id="main-table-search">
    <thead>
        <tr>
            <th class="txt-right text-center">#</th>
            <th class="txt-right">Skill</th>
            <th class="">PI/BI</th>
            <th class="">PI/BI Topic</th>

            <th class="txt-right"></th>
        </tr>
    </thead>

    <tbody>



        <?php
        $cnt = 0;
        $tamt = 0;

        $sql0 = "SELECT * FROM pibitopics where sessionyear LIKE '$year%' and class='$cls2'  and exam = '$exam2' and subcode =  '$subj2' order by topiccode";
        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            while ($row0 = $result0->fetch_assoc()) {
                $topicid = $row0["id"];
                // $stname = $row0["stname"];
                $sksk = $row0["skillcode"];
                $code = $row0["topiccode"];

                $title = $row0["topictitle"];

                $ll1 = $row0["level1"];
                $ll2 = $row0["level2"];
                $ll3 = $row0["level3"];

                ?>
                <tr>
                    <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                        <?php
                        echo $cnt + 1;
                        ?>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $sksk; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $code; ?></div>
                    </td>


                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo pt-2 pb-1"><b><?php echo $title; ?></b></div>
                        <?php if ($ll1 != '') {
                            ?>
                            <div class="ooo"><small><?php echo $ll1; ?></small></div>
                            <?php
                        }
                        ?>

                        <?php if ($ll2 != '') {
                            ?>
                            <div class="ooo"><small><?php echo $ll2; ?></small></div>
                            <?php
                        }
                        ?>

                        <?php if ($ll3 != '') {
                            ?>
                            <div class="ooo"><small><?php echo $ll3; ?></small></div>
                            <?php
                        }
                        ?>
                    </td>

                    <td style=" border:1px solid gray;" class="m-0 p-1 text-center">

                        <div id="btn<?php echo $stid; ?>">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-inverse-primary"
                                    onclick="edittopic(<?php echo $topicid; ?>)">
                                    <i class="mdi mdi-grease-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-inverse-warning" onclick="issuet()">
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
    document.getElementById('defbtn').innerHTML = 'Print Receipt';
    document.getElementById('defmenu').innerHTML = '';



    // let table = new DataTable('#main-table-search');


    function defbtn() {
        goprint(0);
    }
    function reload() {
        window.location.href = uri;
    }


    function goprint(stid) {
        var year = document.getElementById('year').value;
        var sec = document.getElementById('sec').value;
        var cls = document.getElementById('cls').value;
        var datefrom = document.getElementById('datefrom').value;
        var dateto = document.getElementById('dateto').value;
        var collector = document.getElementById('collector').value;
        window.location.href = 'report-print-pr.php?sec=' + sec + '&cls=' + cls + '&year=' + year + '&datefrom=' + datefrom + '&dateto=' + dateto + '&collector=' + collector;
    }

    function go() {
        var year = document.getElementById('year').value;
        var exam = document.getElementById('exam').value;
        var cls = document.getElementById('cls').value;
        var subj = document.getElementById('subcode').value;
        window.location.href = 'admin-pibi-topic.php?cls=' + cls + '&year=' + year + '&exam=' + exam + '&subj=' + subj;
    }

    function addskill() {
        var year = document.getElementById('year').value;
        var exam = document.getElementById('exam').value;
        var cls = document.getElementById('cls').value;
        var subj = document.getElementById('subcode').value;
        window.location.href = 'admin-pibi-topic.php?cls=' + cls + '&year=' + year + '&exam=' + exam + '&subj=' + subj + '&addnew';
    }

    function addtopic() {
        var year = document.getElementById('year').value;
        var exam = document.getElementById('exam').value;
        var cls = document.getElementById('cls').value;
        var subj = document.getElementById('subcode').value;
        window.location.href = 'admin-pibi-topic.php?cls=' + cls + '&year=' + year + '&exam=' + exam + '&subj=' + subj + '&addnew2';
    }

    function skillno() {
        var c = '<?php echo $cls2; ?>';
        var s = '<?php echo $nncode; ?>';
        var i = document.getElementById('skillid').value;
        var cc = 0;
        if (c == 'Six') { cc = 6; }
        else if (c == 'Seven') { cc = 7; }
        else if (c == 'Eight') { cc = 8; }
        else if (c == 'Nine') { cc = 9; }
        else if (c == 'Ten') { cc = 10; }
        else { cc = 0; }
        document.getElementById('skillno').value = s + '.' + cc + '.' + i;

    }


</script>

<script>
    function edittopic(id) {
        var year = document.getElementById('year').value;
        var exam = document.getElementById('exam').value;
        var cls = document.getElementById('cls').value;
        var subj = document.getElementById('subcode').value;
        window.location.href = 'admin-pibi-topic.php?cls=' + cls + '&year=' + year + '&exam=' + exam + '&subj=' + subj + '&addnew2=' + id;
    }
    function issuet(stid) {
        // window.location.href = 'student-profile.php?stid=' + stid;
    }
</script>

<script>
    function savetopic(id, tail) {

        //tail ::: 1 -> save skill, 2 -> del skill,  5 -> save topic, 6 -> del topic
        var y = '<?php echo $year; ?>';
        var s = '<?php echo $subj2; ?>';
        var e = '<?php echo $exam2; ?>';
        var c = '<?php echo $cls2; ?>';

        var l1 = document.getElementById("level1").value;
        var l2 = document.getElementById("level2").value;
        var l3 = document.getElementById("level3").value;

        var sk = document.getElementById("skcode2").value;
        var top = document.getElementById("tcode2").value;
        var tit = document.getElementById("ttitle2").value;
        var infor = "skill=" + sk + "&code=" + top + "&titles=" + tit + "&id=" + id + "&tail=" + tail + '&year=' + y + "&cls=" + c + "&sub=" + s + "&exam=" + e + "&level1=" + l1 + "&level2=" + l2 + "&level3=" + l3;
        // alert(infor);
        $("#ssk" + tail).html("");

        $.ajax({
            type: "POST",
            url: "backend/save-del-skill-topic.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#ssk' + tail).html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#ssk" + tail).html(html);
                go();

            }
        });

    }

    function svs(e) {
        if (e.key == 'Enter') {
            savessc();
        }
    }




    $(document).ready(function () {
        $('#main-table-search').DataTable();
    });




</script>