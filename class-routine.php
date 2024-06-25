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
if (isset($_GET['ids'])) {
    $ids2 = $_GET['ids'];
    $new = 'block';
} else {
    $ids2 = '0';
    $new = 'none';
}

$sql0 = "SELECT * FROM pibigroup where sessionyear='$sy' and sccode='$sccode' and id='$ids2'";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $id2 = $row0["id"];
        $gname2 = $row0["groupname"];
        $rolls2 = $row0["rolls"];
    }
} else {
    $id2 = '';
    $gname2 = '';
    $rolls2 = '';
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

<h3 class="d-print-none">Class Routine</h3>
<p class="d-print-none">
    <code>Academics <i class="mdi mdi-arrow-right"></i> Class Routine </code>
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
                            <label class="col-form-label pl-3">Session Year</label>
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
                                    class="btn btn-lg btn-inverse-success btn-icon-text btn-block p-2" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i> Show Routine</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row d-print-none" id="ren" style="display:<?php echo $new; ?>">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6>Add/Edit Group : <span id="sscspan"></span></h6>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control bg-dark" id="iid" value="<?php echo $ids2; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Group Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="gname" value="<?php echo $gname2; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Assinged Rolls </label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="rolls"
                                    title="Assigned Roll Number e.g. 1.2.3.4 (Roll Separate with full stop)"
                                    placeholder="" value="<?php echo $rolls2; ?>" />
                                <div class="text-small text-muted mt-2">
                                    Assign Roll Numbers for this group. Roll number must separate with fullstop.
                                    <br>e.g. 1.16.24.29.61.24 .....
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-outline-primary btn-icon-text btn-block p-2" style=""
                                    onclick="savegroup(0,1);"><i class="mdi mdi-plus"></i>
                                    Add / Update Group</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                      <?php if($year>2000 && $cls2 !='' && $sec2 != '') {;?>          
                <!-- ////////////////////////////////////////////////////////////// -->

                <div class="card" style="">
                    <img class="card-img-top" alt="">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="text-white fw-bold">
                                    <tr>
                                        <td>Period</td>
                                        <td>Day</td>
                                        <td><i class="mdi mdi-checkbox-marked-outline mdi-24px"></i></td>
                                        <td>Subject</td>
                                        <td>Teacher</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = 0;
                                    $cls = $cls2;
                                    $sec = $sec2;
                                    //************************************************************************************************************************************************
                                    //****************************************************************************************************************************************************************
                                    
                                    for ($i = 1; $i <= 8; $i++) {

                                        for ($j = 1; $j <= 5; $j++) {
                                            if ($j == 1) {
                                                $day = 'Sunday';
                                                $clr = 'primary';
                                                $icon = 'mdi-arrow-expand-all';
                                            } else if ($j == 2) {
                                                $day = 'Monday';
                                                $clr = 'info';
                                                $icon = 'mdi-arrow-right-bold-circle-outline';
                                            } else if ($j == 3) {
                                                $day = 'Tuesday';
                                                $clr = 'info';
                                                $icon = 'mdi-arrow-right-bold-circle-outline';
                                            } else if ($j == 4) {
                                                $day = 'Wednesday';
                                                $clr = 'info';
                                                $icon = 'mdi-arrow-right-bold-circle-outline';
                                            } else if ($j == 5) {
                                                $day = 'Thursday';
                                                $clr = 'info';
                                                $icon = 'mdi-arrow-right-bold-circle-outline';
                                            }
                                            $sql00xgr = "SELECT * FROM clsroutine where sccode='$sccode' and sessionyear='$sy' and classname='$cls' and sectionname='$sec' and period = '$i' and wday='$j' order by period, wday";
                                            // echo $sql00xgr;
                                            $result00xgr = $conn->query($sql00xgr);
                                            if ($result00xgr->num_rows > 0) {
                                                while ($row00xgr = $result00xgr->fetch_assoc()) {
                                                    $id = $row00xgr["id"];
                                                    $subcode = $row00xgr["subcode"];
                                                    $tidd = $row00xgr["tid"];
                                                }
                                            } else {
                                                $id = 0;
                                                $subcode = 0;
                                                $tidd = 0;
                                            }
                                            ?>

                                            <tr>

                                                <td style="width:50px; font-size:24px; font-weight:bold; text-align:center;">
                                                    <div>
                                                        <?php if ($j == 1) {
                                                            echo '<div style=" border:1px solid white; padding:10px 15px 2px; border-radius:5px;;">' . $i . '<br><span style="font-size:9px;">Period</span></div>';
                                                        } ?>
                                                    </div>
                                                </td>

                                                <td style="display:none;" id="id<?php echo $i . $j; ?>"><?php echo $id; ?></td>
                                                <td style="display:none;">Period : <span
                                                        id="per<?php echo $i . $j; ?>"><?php echo $i; ?></span> Day : <span
                                                        id="wday<?php echo $i . $j; ?>"><?php echo $j; ?></span><?php echo $day; ?>
                                                </td>
                                                <td><?php echo $day; ?></td>

                                                <td>
                                                    <button class="btn btn-outline-<?php echo $clr; ?> pt-1 pl-1 pr-0 pb-0"
                                                        onclick="same(<?php echo $i; ?>, <?php echo $j; ?>);"
                                                        id="same<?php echo $i . $j; ?>"><i
                                                            class="mdi <?php echo $icon; ?> mdi-24px"></i>
                                                    </button>

                                                </td>


                                                <td>
                                                    <div class="form-group input-group">
                                                        <select class="form-control text-white" id="subj<?php echo $i . $j; ?>">

                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $sql00xgr = "SELECT * FROM subsetup where sccode='$sccode' and sessionyear='$year' and classname='$cls2' and sectionname = '$sec2' order by subject";
                                                            $result00xgr4 = $conn->query($sql00xgr);
                                                            if ($result00xgr4->num_rows > 0) {
                                                                while ($row00xgr = $result00xgr4->fetch_assoc()) {
                                                                    $scode = $row00xgr["subject"];

                                                                    $sql00xgr = "SELECT * FROM subjects where subcode='$scode'";
                                                                    $result00xgr4x = $conn->query($sql00xgr);
                                                                    if ($result00xgr4x->num_rows > 0) {
                                                                        while ($row00xgr = $result00xgr4x->fetch_assoc()) {
                                                                            $subj = $row00xgr["subject"];
                                                                        }
                                                                    } else {
                                                                        $subj = '-----';
                                                                    }


                                                                    if ($subcode == $scode) {
                                                                        $aa = 'selected';
                                                                    } else {
                                                                        $aa = '';
                                                                    }
                                                                    echo '<option value="' . $scode . '" ' . $aa . ' >' . $subj . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group input-group">
                                                        <select class="form-control text-white" id="tid<?php echo $i . $j; ?>">
                                                            <option value="">Select Teacher </option>
                                                            <?php
                                                            $sql00xgr = "SELECT * FROM teacher where sccode='$sccode' order by ranks, tid";
                                                            $result00xgr4 = $conn->query($sql00xgr);
                                                            if ($result00xgr4->num_rows > 0) {
                                                                while ($row00xgr = $result00xgr4->fetch_assoc()) {
                                                                    $tid = $row00xgr["tid"];
                                                                    $tname = $row00xgr["tname"];
                                                                    if ($tidd == $tid) {
                                                                        $bb = 'selected';
                                                                    } else {
                                                                        $bb = '';
                                                                    }
                                                                    echo '<option value="' . $tid . '" ' . $bb . ' >' . $tname . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="m-0 p-0" id="exe<?php echo $i . $j; ?>">

                                                    <button class="btn btn-inverse-success mt-0 pt-1 pl-1 pr-0 pb-0"
                                                        onclick="edit(<?php echo $i . $j; ?>);"><i
                                                            class="mdi mdi-content-save mdi-24px"></i></button>

                                                </td>
                                            </tr>

                                            <?php

                                            if ($j == 5) {
                                                echo '<tr><td colspan="7"></td></tr>';
                                            }
                                        }

                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /////////////////////////////////////////////////////////////////////////////  -->
                 <?php }  else {echo 'Please Select Class/Section first.';}  ?>
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
        window.location.href = 'class-routine.php?&cls=' + cls + '&sec=' + sec + '&year=' + year;
    }
</script>

<script>
    function issue(id) {
        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        window.location.href = 'group-manage.php?&cls=' + cls + '&sec=' + sec + '&year=' + year + '&ids=' + id;
    }
    function issuetxx(stid) {
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


    function edit(id) {
        var sub = document.getElementById("subj" + id).value;
        var tid = document.getElementById("tid" + id).value;
        var iid = parseInt(document.getElementById("id" + id).innerHTML) * 1;

        var period = parseInt(document.getElementById("per" + id).innerHTML) * 1;
        var wday = parseInt(document.getElementById("wday" + id).innerHTML) * 1;

        var year = document.getElementById("year").value;
        var cls = document.getElementById("cls").value;
        var sec = document.getElementById("sec").value;

        var infor = "year=" + year + "&cls=" + cls + "&sec=" + sec + "&sub=" + sub + "&tid=" + tid + "&id=" + iid + "&period=" + period + "&wday=" + wday;
        // alert(infor);
        $("#exe" + id).html("");

        $.ajax({
            type: "POST",
            url: "backend/save-class-routine.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#exe' + id).html('.......');
            },
            success: function (html) {
                $("#exe" + id).html(html);
            }
        });
    }
</script>


<script>
    function same(i, j) {
        var subj = document.getElementById("subj" + i + '1').value;
        var tid = document.getElementById("tid" + i + '1').value;
        if (j == 1) {
            var k;
            for (k = 1; k <= 5; k++) {
                document.getElementById("tid" + i + k).value = tid;
                document.getElementById("subj" + i + k).value = subj;
            }
        } else {
            document.getElementById("tid" + i + j).value = tid;
            document.getElementById("subj" + i + j).value = subj;
        }
    }
</script>