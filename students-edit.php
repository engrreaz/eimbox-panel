<?php
include 'header.php';

$dismsg = 0;
$cls2 = $sec2 = $roll2 = $rollno = '';
$new = 0; // check new entry or not

if (isset($_GET['stid'])) {
    $stid = $_GET['stid'];
} else {
    $stid = 0;
}

if (isset($_GET['cls'])) {
    $cls2 = $_GET['cls'];
}
if (isset($_GET['sec'])) {
    $sec2 = $_GET['sec'];
}
if (isset($_GET['roll'])) {
    $roll2 = $_GET['roll'];
}

if ($cls2 != '' && $sec2 != '' && $roll2 != '') {
    $sql5 = "SELECT * FROM sessioninfo where classname='$cls2' and sectionname = '$sec2' and rollno='$roll2' and sessionyear LIKE '$sy%' and sccode='$sccode';";
} else {
    $sql5 = "SELECT * FROM sessioninfo where stid='$stid' and sessionyear LIKE '$sy%' and sccode='$sccode';";
}
$result6 = $conn->query($sql5);
if ($result6->num_rows > 0) {
    while ($row5 = $result6->fetch_assoc()) {
        $cls2 = $row5["classname"];
        $sec2 = $row5["sectionname"];
        $rollno = $row5["rollno"];
        $stid = $row5["stid"];

    }
} else {

    $rollno = $roll2;

    $sql5 = "SELECT * FROM students where sccode='$sccode' order by stid desc LIMIT 1;";
    $result6x = $conn->query($sql5);
    if ($result6x->num_rows > 0) {
        while ($row5 = $result6x->fetch_assoc()) {
            $stid = $row5["stid"] + 1;
            $dismsg += 1;
            $new = 1;
        }
    } else {
        $stid = $sccode * 10000 + 1;
        $dismsg += 1;
        $new = 1;
    }

}

if ($new == 1) {
    $btntext = 'Save the Student';
} else {
    $btntext = 'Update Info';
}




$sql5 = "SELECT * FROM students where stid='$stid' and sccode='$sccode' ";
$result7 = $conn->query($sql5);
if ($result7->num_rows > 0) {
    while ($row5 = $result7->fetch_assoc()) {
        $stnameeng = $row5["stnameeng"];
        $stnameben = $row5["stnameben"];
        $fname = $row5["fname"];
        $fprof = $row5["fprof"];
        $fmobile = $row5["fmobile"];
        $fnid = $row5["fnid"];
        $mname = $row5["mname"];
        $mprof = $row5["mprof"];
        $mmobile = $row5["mmobile"];
        $mnid = $row5["mnid"];
        $previll = $row5["previll"];
        $prepo = $row5["prepo"];
        $preps = $row5["preps"];
        $predist = $row5["predist"];
        $pervill = $row5["pervill"];
        $perpo = $row5["perpo"];
        $perps = $row5["perps"];
        $perdist = $row5["perdist"];
        $dob = $row5["dob"];
        $religion = $row5["religion"];
        $brn = $row5["brn"];
        $gender = $row5["gender"];
        $guarname = $row5["guarname"];
        $guaradd = $row5["guaradd"];
        $guarrelation = $row5["guarrelation"];
        $guarmobile = $row5["guarmobile"];
        $tcno = $row5["tcno"];
        $preins = $row5["preins"];
        $preinsadd = $row5["preinsadd"];
        $doa = $row5["doa"];
        $photoid = $row5["photo_id"];
        $dopp = $row5["photo_pick_date"];
        // $ = $row5[""];
        $sscyear = $row5["sscpassyear"];
        if ($sscyear < 1900) {
            $sscyear = '';
        }
        $sscregd = $row5["regdno"];
        $sscroll = $row5["rollno"];
        $sscresult = $row5["gpa"];

        $bgroup = $row5["bgroup"];
        $height = $row5["height"];
        $weight = $row5["weight"];
        $disables = $row5["disables"];
        $guarnid = $row5["guarnid"];
    }
} else {
    $stnameeng = '';
    $stnameben = '';
    $fname = '';
    $fprof = '';
    $fmobile = '';
    $fnid = '';
    $mname = '';
    $mprof = '';
    $mmobile = '';
    $mnid = '';
    $previll = '';
    $prepo = '';
    $preps = '';
    $predist = '';
    $pervill = '';
    $perpo = '';
    $perps = '';
    $perdist = '';
    $dob = '';
    $religion = '';
    $brn = '';
    $gender = '';
    $guarname = '';
    $guaradd = '';
    $guarrelation = '';
    $guarmobile = '';
    $tcno = '';
    $preins = '';
    $preinsadd = '';
    $doa = '';
    $photoid = '';
    $dopp = '';
    // $ = $row5[""];
    $sscyear = '';
    $sscregd = '';
    $sscroll = '';
    $sscresult = '';

    $bgroup = '';
    $height = '';
    $weight = '';
    $disables = '';
    $guarnid = '';
}

if ($doa == '') {
    $doa = date('Y-01-01');
}
if ($dob == '') {
    $dob = date('Y-m-d');
}
?>
<style>
    .col-form-label {
        color: slategray;
    }
</style>
<h3>Student Profile Entry / Editing Window</h3>

<div class="row" style="display:<?php if ($dismsg == 0) {
    $dismsg = 'hide';
} else {
    $dismsg = 'block';
}
echo $dismsg; ?>">

    <?php
    if ($new == 0 && ($dob == '' || $dob == '1970-01-01')) {
        ?>
        <div class="col-12 grid-margin stretch-card mb-1">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-inverse-danger rounded p-2 ">
                            <i class="mdi mdi-calendar p-1 pr-3"></i>Missing Date of Birth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    if ($new == 0 && ($guarmobile == '' || strlen($guarmobile) < 11)) {
        ?>
        <div class="col-12 grid-margin stretch-card mb-1">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-inverse-info rounded p-2 ">
                            <i class="mdi mdi-phone p-1 pr-3"></i>Mobile Number Invalid
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    if ($new == 1) {
        ?>
        <div class="col-12 grid-margin stretch-card mb-1">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-inverse-info rounded p-2 ">
                            <i class="mdi mdi-paperclip p-1 pr-3"></i>Entry New Profile
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    if ($new == 0 && ($stnameeng == '' || strlen($stnameeng) < 5)) {
        ?>
        <div class="col-12 grid-margin stretch-card mb-1">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-inverse-danger rounded p-2 ">
                            <i class="mdi mdi-calendar p-1 pr-3"></i>Missing Student's Name in English
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    if ($new == 0 && ($stnameben == '' || strlen($stnameben) < 5)) {
        ?>
        <div class="col-12 grid-margin stretch-card mb-1">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-inverse-warning rounded p-2 ">
                            <i class="mdi mdi-calendar p-1 pr-3"></i>Missing Student's Name in Bengali
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    if ($new == 0 && ($fmobile == '' || strlen($fmobile) < 11 || $mmobile == '' || strlen($mmobile) < 11)) {
        ?>
        <div class="col-12 grid-margin stretch-card mb-1">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-inverse-info rounded p-2 ">
                            <i class="mdi mdi-calendar p-1 pr-3"></i>Missing / Invalid Father's / Mother's Mobile Number.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    if ($new == 0 && ($religion == '')) {
        $religion_check_icon = 'close-circle';
        $religion_check_color = 'danger';
        ?>
        <div class="col-12 grid-margin stretch-card mb-1">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="btn-inverse-danger rounded p-2 ">
                            <i class="mdi mdi-calendar p-1 pr-3"></i>Missing Gender (Important for Result Processing)
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        $religion_check_icon = 'checkbox-marked-circle';
        $religion_check_color = 'success';
    }
    ?>




</div>

<style>
    h4 {
        font-weight: bold;
    }
</style>
<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="text-muted font-weight-normal">
                    Session Information
                </h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class</label>
                            <div class="col-12">
                                <select id="classname" name="classname" class="form-control" onchange="fetchsection();">
                                    <option value="">Select a class</option>
                                    <?php
                                    $sql000 = "SELECT * FROM areas where user='$rootuser' group by areaname order by idno";
                                    $result000 = $conn->query($sql000);
                                    if ($result000->num_rows > 0) {
                                        while ($row000 = $result000->fetch_assoc()) {
                                            $clsname = $row000["areaname"];
                                            if ($cls2 == $clsname) {
                                                $selcls = 'selected';
                                            } else {
                                                $selcls = '';
                                            }
                                            echo '<option value="' . $clsname . '" ' . $selcls . ' >' . $clsname . '</option>';
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
                                <div id="secn" class="input-control select full-size error">
                                    <select id="sectionname" name="sectionname" class="form-control">
                                        <option value="">Select a Section</option>
                                        <?php
                                        $sql000 = "SELECT * FROM areas where user='$rootuser' and areaname = '$cls2' group by subarea order by idno";
                                        $result000 = $conn->query($sql000);
                                        if ($result000->num_rows > 0) {
                                            while ($row000 = $result000->fetch_assoc()) {
                                                $secname = $row000["subarea"];
                                                if ($sec2 == $secname) {
                                                    $selsec = 'selected';
                                                } else {
                                                    $selsec = '';
                                                }
                                                echo '<option value="' . $secname . '" ' . $selsec . ' >' . $secname . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Roll. No.</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="rollno" value="<?php echo $rollno; ?>"
                                    onkeydown="if(event.keyCode==13) document.getElementById('srchst').click()" />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Student's ID.</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="stid" value="<?php echo $stid; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="submit" style="padding:4px 10px 3px; border-radius:5px;" name="srchst"
                                    id="srchst" class="btn btn-inverse-primary pt-2 pb-2 " style=""
                                    title="Get Student Information" onclick="fetchstudent();"><i
                                        class="mdi mdi-arrow-right"></i></button>
                                <div id="stinfo" style="display:none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Student's Name (In English)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="stnameeng" onblur="ucword(this.id);"
                                    value="<?php echo $stnameeng; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Student's Name (In Bengali)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="stnameben"
                                    value="<?php echo $stnameben; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Father's Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="fname" value="<?php echo $fname; ?>"
                                    onblur="ucword(this.id);" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Profession</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="fprof" value="<?php echo $fprof; ?>"
                                    onblur="ucword(this.id);" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Mobile Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="fmobile" value="<?php echo $fmobile; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">NID Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="fnid" value="<?php echo $fnid; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Mother's Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mname" value="<?php echo $mname; ?>"
                                    onblur="ucword(this.id);" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Profession</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mprof" value="<?php echo $mprof; ?>"
                                    onblur="ucword(this.id);" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Mobile Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mmobile" value="<?php echo $mmobile; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">NID Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mnid" value="<?php echo $mnid; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="text-muted font-weight-normal">
                    <div class="float-right">
                        <button type="button" class="btn btn-inverse-info" onclick="sameadd();">Same as Present
                            Address</button>
                    </div>
                    Present Address
                </h4>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Addree Line 1 / Village</label>
                            <div class="col-12">
                                <input type="text" list="village" class="form-control" id="previll"
                                    value="<?php echo $previll; ?>" />
                                <datalist id="village">
                                    <?php
                                    $sql000 = "SELECT previll FROM students where sccode='$sccode'  group by previll order by previll";
                                    $result0001 = $conn->query($sql000);
                                    if ($result0001->num_rows > 0) {
                                        while ($row000 = $result0001->fetch_assoc()) {
                                            $previll = $row000["previll"];
                                            echo '<option value="' . $previll . '">';
                                        }
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Address Line 2 / PO</label>
                            <div class="col-12">
                                <input type="text" list="postoffice" class="form-control" id="prepo"
                                    value="<?php echo $prepo; ?>" />
                                <datalist id="postoffice">
                                    <?php
                                    $sql000 = "SELECT prepo FROM students where sccode='$sccode'  group by prepo order by prepo";
                                    $result0001 = $conn->query($sql000);
                                    if ($result0001->num_rows > 0) {
                                        while ($row000 = $result0001->fetch_assoc()) {
                                            $prepo = $row000["prepo"];
                                            echo '<option value="' . $prepo . '">';
                                        }
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Upazila/Police Station</label>
                            <div class="col-12">
                                <input type="text" list="police" class="form-control" id="preps"
                                    value="<?php echo $preps; ?>" />
                                <datalist id="police">
                                    <?php
                                    $sql000 = "SELECT preps FROM students where sccode='$sccode'  group by preps order by preps";
                                    $result0001 = $conn->query($sql000);
                                    if ($result0001->num_rows > 0) {
                                        while ($row000 = $result0001->fetch_assoc()) {
                                            $preps = $row000["preps"];
                                            echo '<option value="' . $preps . '">';
                                        }
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">District</label>
                            <div class="col-12">
                                <input type="text" list="jila" class="form-control" id="predist"
                                    value="<?php echo $predist; ?>" />
                                <datalist id="jila">
                                    <?php
                                    $sql000 = "SELECT predist FROM students where sccode='$sccode'  group by predist order by predist";
                                    $result0001 = $conn->query($sql000);
                                    if ($result0001->num_rows > 0) {
                                        while ($row000 = $result0001->fetch_assoc()) {
                                            $predist = $row000["predist"];
                                            echo '<option value="' . $predist . '">';
                                        }
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                </div>



                <h4 class="text-muted font-weight-normal">
                    Permanent Address
                </h4>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Addree Line 1 / Village</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pervill" value="<?php echo $pervill; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Address Line 2 / PO</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="perpo" value="<?php echo $perpo; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Upazila/Police Station</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="perps" value="<?php echo $perps; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">District</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="perdist" value="<?php echo $perdist; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Date of Birth</label>
                            <div class="col-12">
                                <input type="date" class="form-control" id="dob" placeholder="YYYY-MM-DD"
                                    value="<?php echo $dob; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Religion</label>
                            <div class="col-12">




                                <div class="form-group">
                                    <div class="input-group">
                                        <select id="religion" name="religion" class="form-control">
                                            <option value=""></option>
                                            <option value="Islam" <?php if ($religion == 'Islam') {
                                                echo 'selected';
                                            } ?>>
                                                Islam</option>
                                            <option value="Hindu" <?php if ($religion == 'Hindu') {
                                                echo 'selected';
                                            } ?>>
                                                Hindu</option>
                                            <option value="Christian" <?php if ($religion == 'Christian') {
                                                echo 'selected';
                                            } ?>>Christian</option>
                                            <option value="Buddist" <?php if ($religion == 'Buddist') {
                                                echo 'selected';
                                            } ?>>
                                                Buddist</option>
                                            <option value="Others" <?php if ($religion == 'Others') {
                                                echo 'selected';
                                            } ?>>
                                                Others</option>
                                        </select>


                                        <div class="input-group-append">
                                            <button class="btn btn-md btn-inverse-<?php echo $religion_check_color; ?>"
                                                type="button">
                                                <i class="mdi mdi-<?php echo $religion_check_icon; ?> mdi-18px"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hide  -->
                                <!-- <div id="the-basics" style="display:none;">
                                    <input class="typeahead" type="text" placeholder="">
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Birth Registration Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="brn" value="<?php echo $brn; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Gender</label>
                            <div class="col-12">
                                <select id="gender" name="gender" class="form-control">
                                    <option value=""></option>
                                    <option value="Boy" <?php if ($gender == 'Boy') {
                                        echo 'selected';
                                    } ?>>
                                        Boy</option>
                                    <option value="Girl" <?php if ($gender == 'Girl') {
                                        echo 'selected';
                                    } ?>>
                                        Girl</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Blood Group</label>
                            <div class="col-12">
                                <select id="bgroup" name="bgroup" class="form-control ">
                                    <option value=""></option>
                                    <option value="A+" <?php if ($bgroup == 'A+') {
                                        echo 'selected';
                                    } ?>> A+ </option>
                                    <option value="A-" <?php if ($bgroup == 'A-') {
                                        echo 'selected';
                                    } ?>> A- </option>
                                    <option value="B+" <?php if ($bgroup == 'B+') {
                                        echo 'selected';
                                    } ?>> B+ </option>
                                    <option value="B-" <?php if ($bgroup == 'B-') {
                                        echo 'selected';
                                    } ?>> B- </option>
                                    <option value="AB+" <?php if ($bgroup == 'AB+') {
                                        echo 'selected';
                                    } ?>> AB+ </option>
                                    <option value="AB-" <?php if ($bgroup == 'AB-') {
                                        echo 'selected';
                                    } ?>> AB- </option>
                                    <option value="O+" <?php if ($bgroup == 'O+') {
                                        echo 'selected';
                                    } ?>> O+ </option>
                                    <option value="O-" <?php if ($bgroup == 'O-') {
                                        echo 'selected';
                                    } ?>> O- </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Disability</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="disables"
                                    value="<?php echo $disables; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Height (CMs)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="height" value="<?php echo $height; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Weight (KGs)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="weight" value="<?php echo $weight; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="text-muted font-weight-normal">
                    Guardian Information
                </h4>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Guardian's Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="guarname"
                                    value="<?php echo $guarname; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Address</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="guaradd" value="<?php echo $guaradd; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Relation</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="guarrelation"
                                    value="<?php echo $guarrelation; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Mobile Number</label>
                            <div class="col-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="guarmobile"
                                        value="<?php echo $guarmobile; ?>" />

                                    <!-- <div class="input-group-append">
                                        <button class="btn btn-md btn-inverse-success" type="button">
                                            <i class="mdi mdi-check-circle"></i>
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Guardian's NID</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="guarnid" value="<?php echo $guarnid; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="" value="" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="" value="" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="" value="" disabled />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="text-muted font-weight-normal">
                    Transfer Certificate (If Necessary)
                </h4>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">TC No.</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="tcno" value="<?php echo $tcno; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Previous Institute</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="preins" value="<?php echo $preins; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Institute Address</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="preinsadd"
                                    value="<?php echo $preinsadd; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Date of Admission</label>
                            <div class="col-12">
                                <input type="date" class="form-control" id="doa" value="<?php echo $doa; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="text-muted font-weight-normal">
                    Public Examination Information
                </h4>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">SSC Passing Year</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="sscyear" value="<?php echo $sscyear; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">SSC Regd. No.</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="sscregd" value="<?php echo $sscregd; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">SSC Roll</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="sscroll" value="<?php echo $sscroll; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Result (GPA)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="sscresult"
                                    value="<?php echo $sscresult; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Photo ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="photoid" value="<?php echo $photoid; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row text-center">

                            <?php
                            $stphotopath = "https://eimbox.com/students/" . $stid . ".jpg";
                            // $file_headers = @get_headers($stphotopath);
                            // if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
                            //     $stphotopath = "https://eimbox.com/students/noimg.jpg";
                            // } else {
                            //     $stphotopath = "https://eimbox.com/students/" . $stid . ".jpg";
                            // }
                            


                            ?>
                            <div
                                style="width:90px; min-height:90px; padding: 3px; border:1px solid gray; border-radius:4px;">
                                <img src="<?php echo $stphotopath; ?>" style="height:80px; border-radius:5px;" alt="">
                                <br><small class="pt-3">
                                    <center>Photo</center>
                                </small>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Upload Photo</label>
                            <div class="col-12">

                                <?php
                                $datamon = 'student';
                                $dest_file_name = $stid . '.jpg';
                                include 'ajax-upload.php';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3 middle"><br><br>&nbsp;</label>
                            <div class="col-12">
                                <button type="submit" id="savest" name="savest" class="btn btn-inverse-success pt-2"
                                    onclick="savestudent();"><?php echo $btntext; ?></button>
                                <div id="batchbatch"></div>
                            </div>
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
    document.getElementById('stnameeng').focus();
    $(function () {
        $(".js-select").select2({
            placeholder: "Select a state",
            allowClear: true
        });
    });

</script>

<script>
    document.getElementById('defbtn').innerHTML = '<?php echo $btntext; ?>';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        savestudent();
    }

    function fetchsection() {
        var classname = document.getElementById("classname").value;
        var infor = "classname=" + classname;
        $("#secn").html("");
        $.ajax({
            type: "POST",
            url: "backend/fetch-section.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#secn').html('<span class="mif-spinner3 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#secn").html(html);
            }
        });
    }

    function sameadd() {//*********************************************** */
        document.getElementById("pervill").value = document.getElementById("previll").value;
        document.getElementById("perpo").value = document.getElementById("prepo").value;
        document.getElementById("perps").value = document.getElementById("preps").value;
        document.getElementById("perdist").value = document.getElementById("predist").value;
    }

    function guarf() {//******************************************** */
        document.getElementById("guarname").value = document.getElementById("fname").value;
        document.getElementById("guaradd").value = document.getElementById("previll").value;
        document.getElementById("guarrelation").value = "Father";
        document.getElementById("guarmobile").value = document.getElementById("fmobile").value;
    }

    function guarm() {//************************************ */
        document.getElementById("guarname").value = document.getElementById("mname").value;
        document.getElementById("guaradd").value = document.getElementById("previll").value;
        document.getElementById("guarrelation").value = "Mother";
        document.getElementById("guarmobile").value = document.getElementById("mmobile").value;
    }
</script>

<script>
    function savestudent() {

        // Including Photo Upload Function
        var filelist = document.getElementById("files").value;
        if (filelist == '') {
            console.log("file not uploaded");
        } else {
            var btn = document.getElementById("uploadfile");
            btn.click();
        }

        //    document.uploadform.submit();

        var classname = document.getElementById("classname").value;
        var sectionname = document.getElementById("sectionname").value;
        var rollno = document.getElementById("rollno").value;
        var stid = document.getElementById("stid").value;
        var stnameeng = document.getElementById("stnameeng").value;
        var stnameben = document.getElementById("stnameben").value;

        var fname = document.getElementById("fname").value;
        var fprof = document.getElementById("fprof").value;
        var fmobile = document.getElementById("fmobile").value;
        var fnid = document.getElementById("fnid").value;

        var mname = document.getElementById("mname").value;
        var mprof = document.getElementById("mprof").value;
        var mmobile = document.getElementById("mmobile").value;
        var mnid = document.getElementById("mnid").value;

        var previll = document.getElementById("previll").value;
        var prepo = document.getElementById("prepo").value;
        var preps = document.getElementById("preps").value;
        var predist = document.getElementById("predist").value;

        var pervill = document.getElementById("pervill").value;
        var perpo = document.getElementById("perpo").value;
        var perps = document.getElementById("perps").value;
        var perdist = document.getElementById("perdist").value;

        var dob = document.getElementById("dob").value;
        var religion = document.getElementById("religion").value;
        var brn = document.getElementById("brn").value;
        var gender = document.getElementById("gender").value;

        var guarname = document.getElementById("guarname").value;
        var guaradd = document.getElementById("guaradd").value;
        var guarrelation = document.getElementById("guarrelation").value;
        var guarmobile = document.getElementById("guarmobile").value;

        var tcno = document.getElementById("tcno").value;
        var preins = document.getElementById("preins").value;
        var preinsadd = document.getElementById("preinsadd").value;
        var doa = document.getElementById("doa").value;
        var photoid = document.getElementById("photoid").value;
        // var dopp = document.getElementById("dopp").value;

        var sscyear = document.getElementById("sscyear").value;
        var sscregd = document.getElementById("sscregd").value;
        var sscroll = document.getElementById("sscroll").value;
        var sscresult = document.getElementById("sscresult").value;

        var bgroup = document.getElementById("bgroup").value;
        var disables = document.getElementById("disables").value;
        var height = document.getElementById("height").value;
        var weight = document.getElementById("weight").value;
        var guarnid = document.getElementById("guarnid").value;

        if (stid == "") {
            // if (stid == "" || classname == "" || isNaN(rollno) || rollno == "" || stnameeng == "" || dob == "" || religion == "" || gender == "" || guarname == "" || guaradd == "" || guarrelation == "" || guarmobile == "" || doa == "") {
            //     if (stid == "") { alert("You must search a student first after input class and roll no."); } else { }
            //     if (classname == "") { alert("You must select a class first."); } else { }
            //     if (isNaN(rollno) || rollno == "") { alert("You must enter a numeric value as roll."); } else { }
            //     if (stnameeng == "") { alert("You must enter Student Name in English."); } else { }
            //     if (dob == "") { alert("You must select his/her Birth Date."); } else { }
            //     if (religion == "") { alert("You must select his/her religion"); } else { }
            //     if (gender == "") { alert("You must select his/her gender"); } else { }
            //     if (guarname == "") { alert("You must enter his/her guardian's name."); } else { }
            //     if (guaradd == "") { alert("You must enter guardian's address."); } else { }
            //     if (guarrelation == "") { alert("You must enter guardian's relation"); } else { }
            //     if (guarmobile == "") { alert("You must enter a 11 digits valid guardian's mobile number."); } else { }
            //     if (doa == "") { alert("You must select admission date."); } else { }
        }
        else {
            var infor = "stid=" + stid + "&classname=" + classname + "&sectionname=" + sectionname + "&rollno=" + rollno + "&stnameeng=" + stnameeng + "&stnameben="
                + stnameben + "&fname=" + fname + "&fprof=" + fprof + "&fmobile=" + fmobile + "&mname="
                + mname + "&mprof=" + mprof + "&mmobile=" + mmobile + "&previll=" + previll + "&prepo="
                + prepo + "&preps=" + preps + "&predist=" + predist + "&pervill=" + pervill + "&perpo="
                + perpo + "&perps=" + perps + "&perdist=" + perdist + "&dob=" + dob + "&religion="
                + religion + "&brn=" + brn + "&gender=" + gender + "&guarname=" + guarname + "&guaradd="
                + guaradd + "&guarrelation=" + guarrelation + "&guarmobile=" + guarmobile + "&tcno="
                + tcno + "&preins=" + preins + "&preinsadd=" + preinsadd + "&doa=" + doa + "&photoid="
                + photoid + "&sscyear=" + sscyear + "&sscregd=" + sscregd + "&sscroll="
                + sscroll + "&sscresult=" + sscresult + "&fnid=" + fnid + "&mnid=" + mnid
                + "&bgroup=" + bgroup + "&height=" + height + "&weight=" + weight + "&guarnid=" + guarnid + "&disables=" + disables


                ;
            $("#batchbatch").html("");

            $.ajax({
                type: "POST",
                url: "backend/save-student.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#batchbatch').html('<span class="">...</span>');
                },
                success: function (html) {
                    $("#batchbatch").html(html);
                    var nextroll = parseInt(rollno) + 1;
                    window.location.href = 'students-edit.php?cls=' + classname + '&sec=' + sectionname + '&roll=' + nextroll;
                }
            });
        }
    }
</script>
<script>
    function fetchstudent() {
        var classname = document.getElementById("classname").value;
        var sectionname = document.getElementById("sectionname").value;
        var rollno = document.getElementById("rollno").value;
        var infor = "classname=" + classname + "&sectionname=" + sectionname + "&rollno=" + rollno;
        //alert(infor);
        $("#stinfo").html("");

        $.ajax({
            type: "POST",
            url: "backend/fetch-stid.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#stinfo').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#stinfo").html(html);
                var stid = document.getElementById("stinfo").innerHTML;
                if (stid == '0') {
                    window.location.href = 'students-edit.php?cls=' + classname + '&sec=' + sectionname + '&roll=' + rollno;
                } else {
                    window.location.href = 'students-edit.php?stid=' + stid;
                }
            }
        });
    }

    function lastadd() {
        document.getElementById("previll").value = document.getElementById("vill").innerHTML;
        document.getElementById("prepo").value = document.getElementById("po").innerHTML;
        document.getElementById("preps").value = document.getElementById("ps").innerHTML;
        document.getElementById("predist").value = document.getElementById("dist").innerHTML;
    }

    function ucword(iid) {
        var str = document.getElementById(iid).value;
        let titleCase = "";
        str.split(" ").forEach(word => {
            const capitalizedWord = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            titleCase += capitalizedWord + " ";
        });
        document.getElementById(iid).value = titleCase.trim();
    }
</script>

<script>
    // Typeahead Javascript Select......................................
    (function ($) {
        'use strict';
        var substringMatcher = function (strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                var substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                for (var i = 0; i < strs.length; i++) {
                    if (substrRegex.test(strs[i])) {
                        matches.push(strs[i]);
                    }
                }

                cb(matches);
            };
        };

        var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
            'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
            'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
            'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
            'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
            'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
            'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
            'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
            'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
        ];

        $('#the-basics .typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'states',
            source: substringMatcher(states)
        });
        // constructs the suggestion engine
        var states = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            // `states` is an array of state names defined in "The Basics"
            local: states
        });

        $('#bloodhound .typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'states',
            source: states
        });
    })(jQuery);
</script>