<?php
include 'header.php';

$dismsg = 0;
$cls2 = $sec2 = $roll2 = $rollno = '';
$new = 0; // check new entry or not
?>
<button type="button" id="modalbox" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" hidden>
    Launch demo modal
</button>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Teachers/Staffs List</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="" class="input-control select full-size error">
                    <select id="modaldata" name="modaldata" class="form-control " onchange="modal();">
                        <option value="">Select a Teacher/Staff to Edit</option>
                        <?php
                        $sql000 = "SELECT * FROM teacher where sccode='$sccode'  order by ranks";
                        $resultix = $conn->query($sql000);
                        // $conn -> close();
                        if ($resultix->num_rows > 0) {
                            while ($row000 = $resultix->fetch_assoc()) {
                                $tid = $row000["tid"];
                                $tname = $row000["tname"];
                                echo '<option value="' . $tid . '"  >' . $tname . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<?php
if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
} else {
    $tid = 0;
}




$tinfo = array();
$sql5 = "SELECT * FROM teacher where sccode='$sccode' and tid = '$tid' ;";
$result6 = $conn->query($sql5);
if ($result6->num_rows > 0) {
    while ($row5 = $result6->fetch_assoc()) {
        $tinfo[] = $row5;
    }
}

if ($new == 1) {
    $btntext = 'Save the Teacher/Staff';
} else {
    $btntext = 'Update Info';
}

?>
<style>
    .col-form-label {
        color: slategray;
    }
</style>
<h3>Teacher's / Staff's Profile Editor</h3>

<div class="row" style="display:<?php if ($dismsg == 0) {
    $dismsg = 'hide';
} else {
    $dismsg = 'block';
}
echo $dismsg; ?>">

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
                    Teacher Information
                </h4>
                <div class="row">




                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Teacher's / Staff's ID.</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="tid" value="<?php echo $tid; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="submit" style="padding:4px 10px 3px; border-radius:5px;" name="srchst"
                                    id="srchst" class="btn btn-inverse-success full-width text-center p-2" style=""
                                    title="Get Student Information" onclick="fetchstudentx();"><i
                                        class="mdi mdi-arrow-right"></i></button>
                                <div id="stinfo" style="display:none;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                    </div>

                    <div class="col-md-2">
                    <button type="submit" style="padding:4px 10px 3px; border-radius:5px;" name="srchst"
                                    id="srchstx" class="btn btn-inverse-danger btn-block text-center p-2" style=""
                                    title="Delete this Teacher/Staff" onclick="upd(0);"><i
                                        class="mdi mdi-delete"></i> Delete </button>
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
                            <label class="col-form-label pl-3">Teacher's/Staff's Name (In English)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="tnamee" onblur="ucword(this.id);"
                                    value="<?php echo $tinfo[0]['tname'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Teacher's/Staff's Name (In Bengali)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="tnameb"
                                    value="<?php echo $tinfo[0]['tnameb'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Slot</label>
                            <div class="col-12">
                                <div id="secn" class="input-control select full-size error">
                                    <select id="slot" name="sectionname" class="form-control ">
                                        <option value=""></option>
                                        <?php
                                        $sql000 = "SELECT * FROM slots where sccode='$sccode'  order by slotname";
                                        $resulti = $conn->query($sql000);
                                        if ($resulti->num_rows > 0) {
                                            while ($row000 = $resulti->fetch_assoc()) {
                                                $slotname = $row000["slotname"];
                                                if ($slotname == $tinfo[0]['slots'] ?? '') {
                                                    $selsl = 'selected';
                                                } else {
                                                    $selsl = '';
                                                }
                                                echo '<option value="' . $slotname . '" ' . $selsl . ' >' . $slotname . '</option>';
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
                            <label class="col-form-label pl-3">Disignation</label>
                            <div class="col-12">
                                <div id="" class="input-control select full-size error">
                                    <select id="desig" name="sectionname" class="form-control ">
                                        <option value=""></option>
                                        <?php
                                        $sql000 = "SELECT * FROM designation  order by ranks";
                                        $resulti = $conn->query($sql000);
                                        // $conn -> close();
                                        if ($resulti->num_rows > 0) {
                                            while ($row000 = $resulti->fetch_assoc()) {
                                                $destitle = $row000["title"];
                                                if ($destitle == $tinfo[0]['position'] ?? '') {
                                                    $selsec = 'selected';
                                                } else {
                                                    $selsec = '';
                                                }
                                                echo '<option value="' . $destitle . '" ' . $selsec . ' >' . $destitle . '</option>';
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
                            <label class="col-form-label pl-3">Subject</label>
                            <div class="col-12">
                                <div id="secn" class="input-control select full-size error">
                                    <select id="subj" name="sectionname" class="form-control ">
                                        <option value=""></option>
                                        <?php
                                        $sql000 = "SELECT * FROM subjects  order by subcode";
                                        $resulti = $conn->query($sql000);
                                        // $conn -> close();
                                        if ($resulti->num_rows > 0) {
                                            while ($row000 = $resulti->fetch_assoc()) {
                                                $subname = $row000["subject"];
                                                if ($subname == $tinfo[0]['subjects'] ?? '') {
                                                    $selsub = 'selected';
                                                } else {
                                                    $selsub = '';
                                                }
                                                echo '<option value="' . $subname . '" ' . $selsub . ' >' . $subname . '</option>';
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
                            <label class="col-form-label pl-3">Gender</label>
                            <div class="col-12">
                                <select id="gender" name="gender" class="form-control ">
                                    <option value=""></option>
                                    <option value="Male" <?php if ($tinfo[0]['gender'] == 'Male') {
                                        echo 'selected';
                                    } ?>>
                                        Male</option>
                                    <option value="Female" <?php if ($tinfo[0]['gender'] == 'Female') {
                                        echo 'selected';
                                    } ?>>
                                        Female</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Mobile Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mob"
                                    value="<?php echo $tinfo[0]['mobile'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Email Address</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="email"
                                    value="<?php echo $tinfo[0]['email'] ?? ''; ?>" />
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
                            <label class="col-form-label pl-3">NID Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="nid"
                                    value="<?php echo $tinfo[0]['nid'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Date of Birth</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="dob" placeholder="YYYY-MM-DD"
                                    value="<?php echo $tinfo[0]['dob'] ?? ''; ?>" />
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
                                            <option value="Islam" <?php if ($tinfo[0]['religion'] == 'Islam') {
                                                echo 'selected';
                                            } ?>>
                                                Islam</option>
                                            <option value="Hindu" <?php if ($tinfo[0]['religion'] == 'Hindu') {
                                                echo 'selected';
                                            } ?>>
                                                Hindu</option>
                                            <option value="Christian" <?php if ($tinfo[0]['religion'] == 'Christian') {
                                                echo 'selected';
                                            } ?>>Christian</option>
                                            <option value="Buddist" <?php if ($tinfo[0]['religion'] == 'Buddist') {
                                                echo 'selected';
                                            } ?>>
                                                Buddist</option>
                                            <option value="Others" <?php if ($tinfo[0]['religion'] == 'Others') {
                                                echo 'selected';
                                            } ?>>
                                                Others</option>
                                        </select>


                                        <div class="input-group-append">
                                            <button class="btn btn-md btn-inverse-<?php echo $religion_check_color; ?>"
                                                type="button">
                                                <i class="mdi mdi-<?php echo $religion_check_icon; ?>"></i>
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
                            <label class="col-form-label pl-3">Blood Group</label>
                            <div class="col-12">
                                <select id="bgroup" name="bgroup" class="form-control ">
                                    <option value=""></option>


                                    <option value="A+" <?php if ($tinfo[0]['bgroup'] == 'A+') {
                                        echo 'selected';
                                    } ?>> A+
                                    </option>


                                    <option value="A-" <?php if ($tinfo[0]['bgroup'] == 'A-') {
                                        echo 'selected';
                                    } ?>> A-
                                    </option>
                                    <option value="B+" <?php if ($tinfo[0]['bgroup'] == 'B+') {
                                        echo 'selected';
                                    } ?>> B+
                                    </option>
                                    <option value="B-" <?php if ($tinfo[0]['bgroup'] == 'B-') {
                                        echo 'selected';
                                    } ?>> B-
                                    </option>
                                    <option value="AB+" <?php if ($tinfo[0]['bgroup'] == 'AB+') {
                                        echo 'selected';
                                    } ?>>
                                        AB+ </option>
                                    <option value="AB-" <?php if ($tinfo[0]['bgroup'] == 'AB-') {
                                        echo 'selected';
                                    } ?>>
                                        AB- </option>
                                    <option value="O+" <?php if ($tinfo[0]['bgroup'] == 'O+') {
                                        echo 'selected';
                                    } ?>> O+
                                    </option>
                                    <option value="O-" <?php if ($tinfo[0]['bgroup'] == 'O-') {
                                        echo 'selected';
                                    } ?>> O-
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Father's Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="fname"
                                    value="<?php echo $tinfo[0]['fname'] ?? ''; ?>" onblur="ucword(this.id);" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Mother's Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mname"
                                    value="<?php echo $tinfo[0]['mname'] ?? ''; ?>" onblur="ucword(this.id);" />
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Spouse</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="sname"
                                    value="<?php echo $tinfo[0]['spouse'] ?? ''; ?>" onblur="ucword(this.id);" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Emergency Mobile Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="emergency"
                                    value="<?php echo $tinfo[0]['emergency'] ?? ''; ?>" />
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
                                    value="<?php echo $tinfo[0]['previll'] ?? ''; ?>" />
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
                                    value="<?php echo $tinfo[0]['prepo'] ?? ''; ?>" />
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
                                    value="<?php echo $tinfo[0]['preps'] ?? ''; ?>" />
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
                                    value="<?php echo $tinfo[0]['predist'] ?? ''; ?>" />
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
                                <input type="text" class="form-control" id="pervill"
                                    value="<?php echo $tinfo[0]['pervill'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Address Line 2 / PO</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="perpo"
                                    value="<?php echo $tinfo[0]['perpo'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Upazila/Police Station</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="perps"
                                    value="<?php echo $tinfo[0]['perps'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">District</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="perdist"
                                    value="<?php echo $tinfo[0]['perdist'] ?? ''; ?>" />
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
                            <label class="col-form-label pl-3">MPO Index</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mpoindex"
                                    value="<?php echo $tinfo[0]['mpoindex'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">TIN Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="tin"
                                    value="<?php echo $tinfo[0]['tin'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">First Joining Date</label>
                            <div class="col-12">
                                <input type="date" class="form-control" id="firstjoin"
                                    value="<?php echo $tinfo[0]['fjdate']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Joining Date (This Institute)</label>
                            <div class="col-12">
                                <input type="date" class="form-control" id="thisjoin"
                                    value="<?php echo $tinfo[0]['jdate']; ?>" />
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
                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">MPO Related Account</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Account Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mpoaccno"
                                    value="<?php echo $tinfo[0]['accno'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Bank Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mpobankname"
                                    value="<?php echo $tinfo[0]['bankname'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Branch Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mpobranch"
                                    value="<?php echo $tinfo[0]['branch']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Routing Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mporouting"
                                    value="<?php echo $tinfo[0]['routing']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">Institute Allowance Related Account</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Account Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="schaccno"
                                    value="<?php echo $tinfo[0]['accnosch'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Bank Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="schbankname"
                                    value="<?php echo $tinfo[0]['bnamesch'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Branch Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="schbranch"
                                    value="<?php echo $tinfo[0]['bbrsch']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Routing Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="schrouting"
                                    value="<?php echo $tinfo[0]['routesch']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">PF Related Account</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Account Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pfaccno"
                                    value="<?php echo $tinfo[0]['accnopf'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Bank Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pfbankname"
                                    value="<?php echo $tinfo[0]['bnamepf'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Branch Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pfbranch"
                                    value="<?php echo $tinfo[0]['bbrpf']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Routing Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pfrouting"
                                    value="<?php echo $tinfo[0]['routepf']; ?>" />
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
                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">MPO Information</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Pay Code</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="paycode"
                                    value="<?php echo $tinfo[0]['paycode'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Pay Scale</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="payscale"
                                    value="<?php echo $tinfo[0]['payscale'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Basic Salary</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="basic"
                                    value="<?php echo $tinfo[0]['basic']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">............</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id=""
                                    value="<?php echo $tinfo[0]['routing']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Incentive</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="incentive"
                                    value="<?php echo $tinfo[0]['incentive'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">House Rent</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="houserent"
                                    value="<?php echo $tinfo[0]['house'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Medical Allowance</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="medical"
                                    value="<?php echo $tinfo[0]['medical']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">........</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id=""
                                    value="<?php echo $tinfo[0]['routesch']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Welfare</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="welfare"
                                    value="<?php echo $tinfo[0]['welfare'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Retirement</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="retire"
                                    value="<?php echo $tinfo[0]['retire'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">-----</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id=""
                                    value="<?php echo $tinfo[0]['bbrpf']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">MPO Net Salary</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mpototal"
                                    value="<?php echo $tinfo[0]['netamtgovt']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <div class="card-body">
                <div class="row pl-3">
                    <h4 class="font-weight-bold text-small">School Provided Salary</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Salary</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="salary"
                                    value="<?php echo $tinfo[0]['salary'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Mobile Allowance</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mobilevata"
                                    value="<?php echo $tinfo[0]['mobilevata'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Travel allowance</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="travel"
                                    value="<?php echo $tinfo[0]['travel']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Medical Allowance</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="medical2"
                                    value="<?php echo $tinfo[0]['medical2']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">PF by Institute</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pf"
                                    value="<?php echo $tinfo[0]['pf'] ?? ''; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">...</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">....</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Net Salary</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="net2"
                                    value="<?php echo $tinfo[0]['net2']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



















<div class="row" hidden> <!--   Class/Roll Block -->
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
                                <input type="text" class="form-control bg-dark" id="" value="" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <input type="text" class="form-control bg-dark" id="" value="" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <input type="text" class="form-control bg-dark" id="" value="" disabled />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" hidden> <!--   Class/Roll Block -->
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
                                <input type="text" class="form-control" id="doa" value="<?php echo $doa; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row" hidden> <!--   Class/Roll Block -->
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
                                <input type="text" class="form-control" id="photoid" value="<?php ; ?>" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row text-center">

                            <?php
                            $stphotopath = $BASE__PATH . "/teacher/" . $tid . ".jpg";
                            // $stphotopath = "../teacher/" . $tid . ".jpg";
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
                                $datamon = 'teacher';
                                $dest_file_name = $tid . '.jpg';
                                include 'ajax-upload.php';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3 middle"><br><br>&nbsp;</label>
                            <div class="col-12">
                                <?php if ($tid > 0) { ?>
                                    <button type="submit" id="savest" name="savest" class="btn btn-inverse-success pt-2"
                                        onclick="upd(1);"><?php echo $btntext; ?></button>
                                    <div id="px"></div>
                                <?php } ?>
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
    var tidd = '<?php echo $tid; ?>';
    if (tidd == 0) {
        $("#modalbox").click();
    }

    function modal() {
        var x = document.getElementById("modaldata").value;
        window.location.href = 'hr-edit.php?tid=' + x;
    }
</script>


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
        upd();
    }

    function sameadd() {//*********************************************** */
        document.getElementById("pervill").value = document.getElementById("previll").value;
        document.getElementById("perpo").value = document.getElementById("prepo").value;
        document.getElementById("perps").value = document.getElementById("preps").value;
        document.getElementById("perdist").value = document.getElementById("predist").value;
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
    function upd(tail) {

        var filelist = document.getElementById("files").value;
        if (filelist == '') {
            console.log("file not uploaded");
        } else {
            var btn = document.getElementById("uploadfile");
            btn.click();
        }

        // 		var = document.getElementById("").value;
        var tid = document.getElementById("tid").value;
        var tnamee = document.getElementById("tnamee").value;
        var tnameb = document.getElementById("tnameb").value;
        var des = document.getElementById("desig").value;
        var slot = document.getElementById("slot").value;
        var subj = document.getElementById("subj").value;
        var gender = document.getElementById("gender").value;
        var mob = document.getElementById("mob").value;
        var email = document.getElementById("email").value;


        var nid = document.getElementById("nid").value; ///
        var dob = document.getElementById("dob").value;
        var religion = document.getElementById("religion").value;//
        var bgroup = document.getElementById("bgroup").value;//

        var fname = document.getElementById("fname").value;//
        var mname = document.getElementById("mname").value;//
        var sname = document.getElementById("sname").value;//
        var emergency = document.getElementById("emergency").value;//

        var previll = document.getElementById("previll").value;//
        var prepo = document.getElementById("prepo").value;//
        var preps = document.getElementById("preps").value;//
        var predist = document.getElementById("predist").value;//

        var pervill = document.getElementById("pervill").value;//
        var perpo = document.getElementById("perpo").value;//
        var perps = document.getElementById("perps").value;//
        var perdist = document.getElementById("perdist").value;//


        var mpoindex = document.getElementById("mpoindex").value;
        var tin = document.getElementById("tin").value;//
        var thisjoin = document.getElementById("thisjoin").value;
        var firstjoin = document.getElementById("firstjoin").value;

        var accno = document.getElementById("mpoaccno").value;
        var bname = document.getElementById("mpobankname").value;
        var bbr = document.getElementById("mpobranch").value;
        var rno = document.getElementById("mporouting").value;

        var accno2 = document.getElementById("schaccno").value;
        var bname2 = document.getElementById("schbankname").value;
        var bbr2 = document.getElementById("schbranch").value;
        var rno2 = document.getElementById("schrouting").value;

        var accno3 = document.getElementById("pfaccno").value;
        var bname3 = document.getElementById("pfbankname").value;
        var bbr3 = document.getElementById("pfbranch").value;
        var rno3 = document.getElementById("pfrouting").value;

        var paycode = document.getElementById("paycode").value;
        var pscale = document.getElementById("payscale").value;
        var basic = document.getElementById("basic").value;
        var inten = document.getElementById("incentive").value;
        var hra = document.getElementById("houserent").value;
        var ma = document.getElementById("medical").value;
        // var arrea = document.getElementById("arrea").value;////////////////////////////
        var welfare = document.getElementById("welfare").value;
        var retire = document.getElementById("retire").value;
        var net = document.getElementById("mpototal").value;
        var salary = document.getElementById("salary").value;
        var mpa = document.getElementById("mobilevata").value;
        var travel = document.getElementById("travel").value;
        var ma2 = document.getElementById("medical2").value;
        // var exam = document.getElementById("exam").value;//////////////////////////////////
        // var fest = document.getElementById("fest").value;////////////////////////////

        var pf = document.getElementById("pf").value;
        var net2 = document.getElementById("net2").value;
        // alert("tin");



        var infor = "tid=" + tid
            + "&tnamee=" + tnamee + "&tnameb=" + tnameb + "&des=" + des + "&slot=" + slot + "&subj=" + subj + "&gender=" + gender + "&mob=" + mob + "&email=" + email
            + "&nid=" + nid + "&dob=" + dob + "&religion=" + religion + "&bgroup=" + bgroup
            + "&fname=" + fname + "&mname=" + mname + "&sname=" + sname + "&emergency=" + emergency
            + "&previll=" + previll + "&prepo=" + prepo + "&preps=" + preps + "&predist=" + predist
            + "&pervill=" + pervill + "&perpo=" + perpo + "&perps=" + perps + "&perdist=" + perdist
            + "&mpoindex=" + mpoindex + "&tin=" + tin + "&thisjoin=" + thisjoin + "&firstjoin=" + firstjoin

            + "&paycode=" + paycode + "&pscale=" + pscale + "&basic=" + basic + "&inten=" + inten + "&hra=" + hra + "&ma=" + ma + "&welfare=" + welfare + "&retire=" + retire + "&net=" + net
            + "&salary=" + salary + "&mpa=" + mpa + "&travel=" + travel + "&ma2=" + ma2 + "&pf=" + pf + "&net2=" + net2

            + "&accno=" + accno + "&bname=" + bname + "&bbr=" + bbr + "&rno=" + rno
            + "&accno2=" + accno2 + "&bname2=" + bname2 + "&bbr2=" + bbr2 + "&rno2=" + rno2
            + "&accno3=" + accno3 + "&bname3=" + bname3 + "&bbr3=" + bbr3 + "&rno3=" + rno3
            + "&tail=" + tail



            ;
        // alert(infor);
        $("#px").html("");

        $.ajax({
            type: "POST",
            url: "backend/update-teacher.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#px').html('<span class="">Updating...</span>');
            },
            success: function (html) {
                $("#px").html(html);
                window.location.href = 'hr-list.php';
            }
        });
    }
</script>


<script>
    function calc() {
        var paycode = parseInt(document.getElementById("paycode").value);
        var pscale = parseInt(document.getElementById("pscale").value) * 1;

        var basic = parseInt(document.getElementById("basic").value);
        var inten = parseInt(document.getElementById("inten").value);
        var hra = parseInt(document.getElementById("hra").value);
        var ma = parseInt(document.getElementById("ma").value);
        var arrea = parseInt(document.getElementById("arrea").value);

        var wel = basic * 0.04;
        var ret = basic * 0.06;
        document.getElementById("welfare").value = wel;
        document.getElementById("retire").value = ret;

        var welfare = parseInt(document.getElementById("welfare").value);
        var retire = parseInt(document.getElementById("retire").value);

        var mot = basic + inten + hra + ma + arrea - wel - ret;
        document.getElementById("net").value = Math.round(mot);

        var net = parseInt(document.getElementById("net").value);


        var salary = parseInt(document.getElementById("salary").value);
        var mpa = parseInt(document.getElementById("mpa").value);
        var travel = parseInt(document.getElementById("travel").value);
        var ma2 = parseInt(document.getElementById("ma2").value);
        var exam = parseInt(document.getElementById("exam").value);
        var fest = parseInt(document.getElementById("fest").value);

        var thisjoin = document.getElementById("thisjoin").value;
        thisjoin = new Date(thisjoin);
        const aj = new Date();
        var year1 = aj.getFullYear();
        var month1 = aj.getMonth();

        var year2 = thisjoin.getFullYear();

        var month2 = thisjoin.getMonth();
        var mon = (year2 - year1) * 12 + (month2 - month1) + 1;
        mon = mon * -1;
        var ppf = 0;
        if (mon >= 24) {
            var ppf = pscale * 0.05;
        }
        // 		alert(mon);
        document.getElementById("pf").value = ppf;
        var pf = parseInt(document.getElementById("pf").value);

        var scmot = parseInt(salary + mpa + travel + ma2 + exam + fest - pf);
        document.getElementById("net2").value = scmot;
        // 		var net2 = document.getElementById("net2").value;
    }

    function calc2() {
        var ppp = document.getElementById("paycode").value;
        var tk = document.getElementById("pcs" + ppp).innerHTML;
        document.getElementById("pscale").value = tk;
        calc();
    }
</script>