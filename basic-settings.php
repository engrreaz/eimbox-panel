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

// $sql0 = "SELECT * FROM settings where sccode = 0 order by slno";
// $result0 = $conn->query($sql0);
// if ($result0->num_rows > 0) {
//     while ($row0 = $result0->fetch_assoc()) {
//         $id2 = $row0["id"];
//         $setting_title = $row0["setting_title"];
//     }
// }




$sy = array('sy' => '');
$sql0 = "SELECT * FROM sessionyear where sccode = '$sccode' and active=1 order by id";
$result01 = $conn->query($sql0);
if ($result01->num_rows > 0) {
    while ($row0 = $result01->fetch_assoc()) {
        $sy[] = $row0;
    }
}


$sett = array('sccode' => '0');
$sql0 = "SELECT * FROM settings where sccode = '$sccode' order by id";
$result02 = $conn->query($sql0);
if ($result02->num_rows > 0) {
    while ($row0 = $result02->fetch_assoc()) {
        $sett[] = $row0;
    }
}
// echo var_dump($sett);

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

<h3 class="d-print-none">Basic Primary Settings</h3>


<div class="row d-print-none" id="ren" style="display:<?php echo $new; ?>">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6>Add/Edit Slot : </h6>
                <div class="row">
                    <div class="col-md-3" hidden>
                        <div class="form-group row">
                            <label class="col-form-label pl-3">ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="iid" value="<?php echo $ids2; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Slot Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="gname" value="<?php echo $sname2; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-primary btn-icon-text btn-block p-2" style=""
                                    onclick="savegroup(0,1);"><i class="mdi mdi-plus"></i>
                                    Add / Update Slot</button>
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
                <h4 class="m-0">Weekends</h4>
                <small class="text-muted">Mark your weekly holidays / weekends</small>
                <?php
                $indweek = array_search('Weekends', array_column($sett, 'setting_title'));
                if ($indweek != '' || $indweek != null) {
                    $weekends = $sett[$indweek]['settings_value'];
                } else {
                    $weekends = '';
                }
                ?>
                <div class="row ">
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input" value="Sunday" <?php if (str_contains($weekends, 'Sunday')) {
                                    echo 'checked';
                                } else {
                                    echo '';
                                } ?>> Sunday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input" value="Monday" <?php if (str_contains($weekends, 'Monday')) {
                                    echo 'checked';
                                } else {
                                    echo '';
                                } ?>> Monday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input" value="Tuesday" <?php if (str_contains($weekends, 'Tuesday')) {
                                    echo 'checked';
                                } else {
                                    echo '';
                                } ?>> Tuesday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input" value="Wednesday" <?php if (str_contains($weekends, 'Wednesday')) {
                                    echo 'checked';
                                } else {
                                    echo '';
                                } ?>>
                                Wednesday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input" value="Thursday" <?php if (str_contains($weekends, 'Thursday')) {
                                    echo 'checked';
                                } else {
                                    echo '';
                                } ?>> Thursday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input" value="Friday" <?php if (str_contains($weekends, 'Friday')) {
                                    echo 'checked';
                                } else {
                                    echo '';
                                } ?>> Friday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input" value="Saturday" <?php if (str_contains($weekends, 'Saturday')) {
                                    echo 'checked';
                                } else {
                                    echo '';
                                } ?>> Saturday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-10 pt-2 float-right" style="float:right;">
                        <button class="btn btn-inverse-success pt-2" onclick="savesetting(1);" disabled>Update</button>
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
                <h4 class="m-0">Additional Panels</h4>
                <small class="text-muted">Mark your weekly holidays / weekends</small>
                <div class="row ">
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input"> Sunday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input"> Monday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input"> Tuesday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input"> Wednesday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input"> Thursday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input"> Friday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <input type="checkbox" class="form-check-input"> Saturday
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-10 pt-2 float-right" style="float:right;">
                        <button class="btn btn-inverse-success pt-2" onclick="savesetting(2);">Update</button>
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
                <h4 class="m-0">Active Session</h4>
                <small class="text-muted">Check/uncheck session year that currently active or not</small>
                <div class="row ">
                    <div class="col-md-2">

                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <?php
                                $yr2 = date('Y') - 1 . '-' . date('y');
                                $ind2 = array_search($yr2, array_column($sy, 'syear'));
                                if ($ind2 != '' || $ind2 != null) {
                                    $ch2 = 'checked';
                                } else {
                                    $ch2 = '';
                                }


                                ?>
                                <input type="checkbox" class="form-check-input" id="yr2" value="<?php echo $yr2; ?>"
                                    <?php echo $ch2; ?>>
                                <?php echo $yr2; ?>
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <?php
                                $yr1 = date('Y');
                                $ind1 = array_search($yr1, array_column($sy, 'syear'));
                                if ($ind1 != '' || $ind1 != null) {
                                    $ch1 = 'checked';
                                } else {
                                    $ch1 = '';
                                }
                                ?>
                                <input type="checkbox" class="form-check-input" id="yr1" value="<?php echo $yr1; ?>"
                                    <?php echo $ch1; ?>>
                                <?php echo $yr1; ?>
                                <i class="input-helper"></i></label>
                        </div>
                    </div>
                    <div class="col-md-2">



                        <div class="form-check form-check-primary">
                            <label class="form-check-label ">
                                <?php
                                $yr3 = date('Y') . '-' . date('y') + 1;
                                $ind3 = array_search($yr3, array_column($sy, 'syear'));
                                if ($ind3 != '' || $ind3 != null) {
                                    $ch3 = 'checked';
                                } else {
                                    $ch3 = '';
                                }
                                ?>
                                <input type="checkbox" class="form-check-input" id="yr3" value="<?php echo $yr3; ?>"
                                    <?php echo $ch3; ?>>
                                <?php echo $yr3; ?>
                                <i class="input-helper"></i></label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="col-md-10 pt-2 float-right" style="float:right;">
                            <button class="btn btn-inverse-success pt-2 full-width"
                                onclick="savesetting(0);">Update</button>
                        </div>
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
    document.getElementById('defbtn').innerHTML = ' ';
    document.getElementById('defmenu').innerHTML = '';

    function defbtn() {
        window.location.href = 'slot.php?&ids=0';
    }
    function reload() {
        window.location.href = uri;
    }


    function goprint(stid) {
        var year = document.getElementById('year').value;
        var sec = document.getElementById('sec').value;
        var exam = document.getElementById('exam').value;
        window.location.href = 'testimonial-print.php?sec=' + sec + '&exam=' + exam + '&year=' + year + '&stid=' + stid;
    }

    function go() {
        window.location.href = 'slot.php';
    }
</script>

<script>
    function issue(id) {
        window.location.href = 'slot.php?&ids=' + id;
    }
</script>

<script>



    function savesetting(tail) {
        var infor = '';
        if (tail == 0) {    // Session year.............................................
            var a1 = document.getElementById('yr1');
            var a1_ch = a1.checked;
            var a1_val = a1.value;
            var a3 = document.getElementById('yr3');
            var a3_ch = a3.checked;
            var a3_val = a3.value;
            var a2 = document.getElementById('yr2');
            var a2_ch = a2.checked;
            var a2_val = a2.value;
            infor = "tail=" + tail + "&ch1=" + a1_ch + "&val1=" + a1_val + "&ch2=" + a2_ch + "&val2=" + a2_val + "&ch3=" + a3_ch + "&val3=" + a3_val;

        } else if (tail == 1) {

        } else if (tail == 2) {


        } else if (tail == 3) {


        } else if (tail == 4) {


        } else if (tail == 5) {


        } else if (tail == 6) {


        } else if (tail == 7) {

        }
        // alert(infor);
        $("#defbtn").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-settings.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#defbtn').html('<small>Updating...</small>');
            },
            success: function (html) {
                $("#defbtn").html(html);

            }
        });
    }
</script>