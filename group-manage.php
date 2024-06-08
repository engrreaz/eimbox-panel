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
    $ids2 = $_GET['ids']; $new='block';
} else {
    $ids2 = '0'; $new='none';
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
        $rolls2 =  '';
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

<h3 class="d-print-none">Group Management</h3>
<p class="d-print-none">
    <code>Academics <i class="mdi mdi-arrow-right"></i> Group Manager </code>
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
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-outline-success btn-icon-text btn-block p-2" style=""
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



<div class="row d-print-none" id="ren" style="display:<?php echo $new;?>">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h6>Add/Edit Group :  <span id="sscspan"></span></h6>
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control bg-dark" id="iid" value="<?php echo $ids2; ?>" disabled/>
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
                                <input type="text" class="form-control" id="rolls" value="<?php echo $rolls2; ?>" />
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
                <div class="table-responsive">
                    <table class="table  table-striped " style=" ">
                        <thead>
                            <tr>
                                <td class="txt-right">#</td>
                                <td class="txt-right">Group Name</td>
                                <td class="txt-right">Assigned Roll</td>
                                <td class="txt-right"></td>
                            </tr>
                        </thead>

                        <tbody>



                            <?php
                            $cnt = 0;
                            $cntamt = 0;
                            $sql0 = "SELECT * FROM pibigroup where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname = '$sec2' order by id";
                            $result0 = $conn->query($sql0);
                            if ($result0->num_rows > 0) {
                                while ($row0 = $result0->fetch_assoc()) {
                                    $id = $row0["id"];
                                    $gname = $row0["groupname"];
                                    $rolls = $row0["rolls"];





                                    ?>
                                    <tr>
                                        <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">

                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><?php echo $gname; ?></div>
                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><?php echo $rolls; ?></div>
                                        </td>

                                        <td style=" border:1px solid gray;">
                                            <div id="btn<?php echo $stid; ?>">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-inverse-info"
                                                        onclick="issue(<?php echo $id; ?>, 1)">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-inverse-danger"
                                                        onclick="savegroup(<?php echo $id; ?>, 2)">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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
    document.getElementById('defbtn').innerHTML = 'Add New Group';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        window.location.href = 'group-manage.php?&cls=' + cls + '&sec=' + sec + '&year=' + year + '&ids=0' ;
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
        window.location.href = 'group-manage.php?&cls=' + cls + '&sec=' + sec + '&year=' + year;
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

    function savegroup(id, ont) {
        if(ont == 1){
             var id = document.getElementById('iid').value;
        }
        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;

        var gname = document.getElementById("gname").value;
        var rolls = document.getElementById("rolls").value;
        var infor = "id=" + id + "&ont=" + ont + "&year=" + year + "&cls=" + cls +  "&sec=" + sec +  "&gname=" + gname +  "&rolls=" + rolls ;

        $("#sscspan").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-group.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sscspan').html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#sscspan").html(html);
                go();
            }
        });
    }
</script>