<?php
include 'header.php';

if (isset($_GET['date'])) {
    $date = $_GET['date'];
} else {
    $date = date('Y-m-d');
}

if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
} else {
    $tid = '0';
}
?>

<h3 class="d-print-none">HRD Attendance</h3>
<p class="d-print-none">
    <code>HRD <i class="mdi mdi-arrow-right"></i> Teachers/Staffs Attendance </code>
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
                            <label class="col-form-label pl-3">Date</label>
                            <div class="col-12">
                                <input id="date" type="date" class="form-control" onchange="go();"
                                    value="<?php echo $date; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Teacher/Staff</label>
                            <div class="col-12">
                                <select class="form-control " id="tidl" onchange="go();">
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT * FROM teacher where sccode='$sccode'  order by ranks, sl;";
                                    $result0x = $conn->query($sql0x);
                                    if ($result0x->num_rows > 0) {
                                        while ($row0x = $result0x->fetch_assoc()) {
                                            $tids = $row0x["tid"];
                                            $tname = $row0x["tname"];
                                            if ($tid == $tids) {
                                                $selcls = 'selected';
                                            } else {
                                                $selcls = '';
                                            }
                                            echo '<option value="' . $tids . '" ' . $selcls . ' >' . $tname . '</option>';
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
                                    onclick="go();"><i class="mdi mdi-eye mdi-18px mt-2"></i> View Attendance</button>
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
                        <div style="text-align: left;">
                            date : <b><?php echo $date; ?></b>

                        </div>


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
            <td class="txt-right">#</td>
            <td class="txt-right">Name</td>
            <td class="txt-right">ID</td>
            <td class="txt-right">Check-In</td>
            <td class="txt-right">Check-Out</td>
            <td class="txt-right">GPS</td>
            <td class="txt-right">Device</td>
            <td class="txt-right">Comments</td>
            <td class="txt-right"></td>
        </tr>
    </thead>

    <tbody>



        <?php
        $cnt = 1;
        if ($tid > 0) {
            $sql0 = "SELECT * FROM teacherattnd where tid='$tid' and sccode='$sccode'  order by  adate desc ";
        } else {
            $sql0 = "SELECT * FROM teacherattnd where adate='$date' and sccode='$sccode'  order by  id desc ";
        }
        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            while ($row0 = $result0->fetch_assoc()) {
                $id = $row0["id"];
                $tid = $row0["tid"];
                ?>
                
                <tr>
                    <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                        <?php
                        echo $cnt;
                        ?>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;"></td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><small><?php echo $tid; ?></small></div>
                        <div class="ooo"><?php ; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;"></td>
                    <td style="padding : 3px 10px; border:1px solid gray;"></td>
                    <td style="padding : 3px 10px; border:1px solid gray;"></td>
                    <td style="padding : 3px 10px; border:1px solid gray;"></td>
                    <td style="padding : 3px 10px; border:1px solid gray;"></td>

                    <td style=" border:1px solid gray;">
                        <div id="btn<?php echo $id; ?>" hidden>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-inverse-info" onclick="issue(<?php echo $id; ?>)">
                                    <i class="mdi mdi-book-open-page-variant"></i>
                                </button>
                                <button type="button" class="btn btn-inverse-warning" onclick="issuet(<?php echo $id; ?>)">
                                    <i class="mdi mdi-calendar"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                $cnt++;
            }
        } else {
            echo '<tr><td colspan="9"><i class="mdi mdi-close mdi-32px text-warning"></i> Data Not Found.</td></tr>';
        }
        ?>
    </tbody>
</table>


<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    document.getElementById('defbtn').innerHTML = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    document.getElementById('defmenu').innerHTML = '';
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
        var date = document.getElementById('date').value;
        var tid = document.getElementById('tidl').value;
        var tail = '?date=' + date + '&tid=' + tid;
        // alert(tail);
        window.location.href = 'tattnd.php' + tail;
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