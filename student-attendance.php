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

if (isset($_GET['datefrom'])) {
    $datefrom = $_GET['datefrom'];
} else {
    $datefrom = date('Y-m-d');
}
if (isset($_GET['dateto'])) {
    $dateto = $_GET['dateto'];
} else {
    $dateto = date('Y-m-d');
}

if ($datefrom == '')
    $datefrom = date('Y-m-d');
if ($dateto == '')
    $dateto = date('Y-m-d');

if (isset($_GET['collector'])) {
    $collector = $_GET['collector'];
} else {
    $collector = '';
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

<h3 class="d-print-none">Student's Attendance</h3>
<p class="d-print-none">
    <code>Student <i class="mdi mdi-arrow-right"></i> Attendance </code>
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
                                <label class="col-form-label pl-3">Roll No.</label>
                                <input type="text" class="form-control bg-transparent" value="" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Date From</label>
                            <div class="col-12">
                                <input type="date" onchange="go();" class="form-control" id="datefrom"
                                    value="<?php echo $datefrom; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Date To</label>
                            <div class="col-12">
                                <input type="date" onchange="go();" class="form-control" id="dateto"
                                    value="<?php echo $dateto; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Collector ID/Email</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="collector" onchange="go();">
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT entryby FROM stpr where sccode='$sccode' and sessionyear LIKE '$year%'  group by entryby order by entryby;";
                                    // echo $sql0x;
                                    $result0r = $conn->query($sql0x);
                                    if ($result0r->num_rows > 0) {
                                        while ($row0x = $result0r->fetch_assoc()) {
                                            $eby = $row0x["entryby"];
                                            if ($eby == $collector) {
                                                $ebyby = 'selected';
                                            } else {
                                                $ebyby = '';
                                            }
                                            echo '<option value="' . $eby . '" ' . $ebyby . ' >' . $eby . '</option>';
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
                                <button type="button" style="padding:4px 10px 6px; border-radius:5px;"
                                    class="btn btn-lg btn-outline-primary btn-icon-text btn-block pt-2 pb-2" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Generate Receipt</button>
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

<div class="row d-print-none" id="ren">
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
            <th class="txt-right">Date</th>
            <th class="txt-right">Class</th>
            <th class="txt-right">Section</th>
            <th class="txt-right">Roll</th>
            <th class="txt-right">Name of Student</th>

            <th class="txt-right">Time</th>
            <th class="txt-right"></th>
        </tr>
    </thead>

    <tbody>



        <?php
        $cnt = 0;
        $tamt = 0;

        if ($collector != "") {
            $uu = " and entryby='$collector' ";
        } else {
            $uu = '';
        }
        if ($cls2 != '') {
            if ($sec2 != '') {
                $sql0 = "SELECT * FROM stattnd where sessionyear LIKE '$sy%' and sccode='$sccode' and classname='$cls2' and sectionname='$sec2' and adate between '$datefrom' and '$dateto' $uu order by entrytime desc, id desc";
            } else {
                $sql0 = "SELECT * FROM stattnd where sessionyear LIKE '$sy%' and sccode='$sccode' and classname='$cls2' and adate between '$datefrom' and '$dateto' $uu order by entrytime desc, id desc";
            }
        } else {
            $sql0 = "SELECT * FROM stattnd where sessionyear LIKE '$sy%' and sccode='$sccode' and adate between '$datefrom' and '$dateto' $uu order by entrytime desc, id desc";
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
                $stname = $row0["stname"];
                $adate = $row0["adate"];
                $etime = $row0["entrytime"];

                $ind = array_search($stid, array_column($stlist, 'stid'));

                //if($card == '1'){$qrc = '<img src="https://chart.googleapis.com/chart?chs=20x20&cht=qr&chl=http://www.students.eimbox.com/myinfo.php?id=5000&choe=UTF-8&chld=L|0" />';} else {$qrc = '';}
        


                ?>
                <tr>
                    <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                        <?php
                        echo $cnt + 1;
                        ?>
                    </td>
             
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo date('d/m/Y', strtotime($adate)); ?></div>
                    </td>

                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $clsd; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $secd; ?></div>
                    </td>
                    <td class="text-center" style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $roll; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $stlist[$ind]['stnameeng']; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $etime; ?></div>
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
    document.getElementById('defbtn').innerHTML = 'Attendance Report';
    document.getElementById('defmenu').innerHTML = '';


    // let table = new DataTable('#main-table-search');


    function defbtn() {
        // goprint(0);
        alert('Not Available now.');
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
        var sec = document.getElementById('sec').value;
        var cls = document.getElementById('cls').value;
        var datefrom = document.getElementById('datefrom').value;
        var dateto = document.getElementById('dateto').value;
        var collector = document.getElementById('collector').value;
        window.location.href = 'student-attendance.php?sec=' + sec + '&cls=' + cls + '&year=' + year + '&datefrom=' + datefrom + '&dateto=' + dateto + '&collector=' + collector;
    }


</script>

<script>
    function issue(stid) {
        // window.location.href = 'students-edit.php?stid=' + stid;
    }
    function issuet(stid) {
        // window.location.href = 'student-profile.php?stid=' + stid;
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




    $(document).ready(function () {
        $('#main-table-search').DataTable();
    });




</script>