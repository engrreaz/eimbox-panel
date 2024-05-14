<?php
include 'header.php';

if (isset($_GET['stid'])) {
    $stid = $_GET['stid'];
} else {
    $stid = 0;
}

$sql5 = "SELECT * FROM sessioninfo where stid='$stid' and sessionyear = '$sy' and sccode='$sccode';";
$result6 = $conn->query($sql5);
if ($result6->num_rows > 0) {
    while ($row5 = $result6->fetch_assoc()) {
        $cls = $row5["classname"];
        $sec = $row5["sectionname"];
        $rollno = $row5["rollno"];
        $stid = $row5["stid"];
    }
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
        // $ = $row5["fnid"];
        $mname = $row5["mname"];
        $mprof = $row5["mprof"];
        $mmobile = $row5["mmobile"];
        // $ = $row5["mnid"];
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
        $dopp = $row5["photo_pic_date"];
        // $ = $row5[""];
    }
}
?>
<style>
    .col-form-label{
        color:slategray;
    }
</style>
<h3>Student Editor</h3>

<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Session Information
                </h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class</label>
                            <div class="col-12">
                                <select id="classname" name="classname" class="form-control text-white"
                                    onchange="fetchsection();">
                                    <option value="">Select a class</option>
                                    <?php
                                    $sql000 = "SELECT * FROM areas where user='$rootuser' group by areaname order by idno";
                                    $result000 = $conn->query($sql000);
                                    if ($result000->num_rows > 0) {
                                        while ($row000 = $result000->fetch_assoc()) {
                                            $clsname = $row000["areaname"];

                                            echo '<option value="' . $clsname . '">' . $clsname . '</option>';
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
                                    <select id="sectionname" name="sectionname" class="form-control text-white">
                                        <option value="">Select a Section</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Roll. No.</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="rollno" value="<?php echo $rollno; ?>" />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Student's ID.</label>
                            <div class="col-12">
                                <input type="text" class="form-control bg-dark" id="stid" value="<?php echo $stid; ?>" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="submit" style="padding:4px 10px 3px; border-radius:5px;" name="srchst"
                                    id="srchst" class=" btn-primary" style="" onclick="fetchstudent();"><i
                                        class="mdi mdi-eye"></i></button>
                                <div id="stinfo" style="display:none;"></div>
                            </div>
                        </div>
                    </div>
                    <div id="stinfo" style="display:none;"></div>
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
                                <input type="text" class="form-control" id="stnameeng" value="<?php echo $stnameeng; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Student's Name (In Bengali)</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="stnameben" value="<?php echo $stnameben; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Father's Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="fname" value="<?php echo $fname; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Profession</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="fprof" value="<?php echo $fprof; ?>" />
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
                                <input type="text" class="form-control" id="fnid" value="<?php echo $fmobile; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Mother's Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mname" value="<?php echo $mname; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Profession</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mprof" value="<?php echo $mprof; ?>" />
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
                                <input type="text" class="form-control" id="mnid" value="<?php echo $mmobile; ?>" />
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
                    Present Address
                </h4>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Addree Line 1 / Village</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="previll" value="<?php echo $previll; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Address Line 2 / PO</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="prepo" value="<?php echo $prepo; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Upazila/Police Station</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="preps" value="<?php echo $preps; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">District</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="predist" value="<?php echo $predist; ?>" />
                            </div>
                        </div>
                    </div>
                </div>



                <h4 class="text-muted font-weight-normal">
                    Present Address
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
                                <input type="text" class="form-control" id="dob" value="<?php echo $dob; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Religion</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="religion" value="<?php echo $religion; ?>" />
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
                                <input type="text" class="form-control" id="gender" value="<?php echo $gender; ?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Blood Group</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="bgroup" value="<?php echo $rollno; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">---------</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="ref" value="<?php echo $rollno; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">----------</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="ref" value="<?php echo $rollno; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">---------</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="ref" value="<?php echo $rollno; ?>" />
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
                <h3 class="text-muted font-weight-normal">
                    Guardian Information
                </h3>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Guardian's Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="guarname" value="<?php echo $guarname; ?>" />
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
                                <input type="text" class="form-control" id="guarmobile" value="<?php echo $guarmobile; ?>" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Guardian's NID</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="guarnid" value="<?php echo $rollno; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">-----</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="ref" value="<?php echo $rollno; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">----------</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="ref" value="<?php echo $rollno; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">-----------</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="ref" value="<?php echo $rollno; ?>" />
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
                <h3 class="text-muted font-weight-normal">
                    Transfer Certificate (If Necessary)
                </h3>

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
                                <input type="text" class="form-control" id="preinsadd" value="<?php echo $preinsadd; ?>" />
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


<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Select Month & Year and press 'Proceed' to proceed
                </h6>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Photo ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="photoid" value="<?php echo $photoid; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Photo</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="dopp" value="<?php echo $dopp; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">-------------</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="ref" value="<?php echo $rollno; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Button...../Save</label>
                            <div class="col-12">
                                <button type="submit" id="savest" name="savest" class="btn btn-success"
                                    onclick="savestudent();">Save the Student</button>
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
    $(function () {
        $(".js-select").select2({
            placeholder: "Select a state",
            allowClear: true
        });
    });

</script>

<script>

    function defbtn() {
        savestudent();
    }

    function fetchsection() {

        var classname = document.getElementById("classname").value;
        var infor = "classname=" + classname + "&usr=<?php echo $usr; ?>" ;
        $("#secn").html("");

        $.ajax({
            type: "POST",
            url: "fetch-section.php",
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


    function sameadd() {
        document.getElementById("pervill").value = document.getElementById("previll").value;
        document.getElementById("perpo").value = document.getElementById("prepo").value;
        document.getElementById("perps").value = document.getElementById("preps").value;
        document.getElementById("perdist").value = document.getElementById("predist").value;
    }

    function guarf() {
        document.getElementById("guarname").value = document.getElementById("fname").value;
        document.getElementById("guaradd").value = document.getElementById("previll").value;
        document.getElementById("guarrelation").value = "Father";
        document.getElementById("guarmobile").value = document.getElementById("fmobile").value;
    }

    function guarm() {
        document.getElementById("guarname").value = document.getElementById("mname").value;
        document.getElementById("guaradd").value = document.getElementById("previll").value;
        document.getElementById("guarrelation").value = "Mother";
        document.getElementById("guarmobile").value = document.getElementById("mmobile").value;
    }


    function savestudent() {
       
        var classname = document.getElementById("classname").value;
        var sectionname = document.getElementById("sectionname").value;
        var rollno = document.getElementById("rollno").value;
        var stid = document.getElementById("stid").value;
        var stnameeng = document.getElementById("stnameeng").value;
        var stnameben = document.getElementById("stnameben").value;

        var fname = document.getElementById("fname").value;
        var fprof = document.getElementById("fprof").value;
        var fmobile = document.getElementById("fmobile").value;

        var mname = document.getElementById("mname").value;
        var mprof = document.getElementById("mprof").value;
        var mmobile = document.getElementById("mmobile").value;

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
        var dopp = document.getElementById("dopp").value;





alert("OL");



        if (stid == "" || classname == "" || isNaN(rollno) || rollno == "" || stnameeng == "" || dob == "" || religion == "" || gender == "" || guarname == "" || guaradd == "" || guarrelation == "" || guarmobile == "" || doa == "") {
            if (stid == "") { alert("You must search a student first after input class and roll no."); } else { }
            if (classname == "") { alert("You must select a class first."); } else { }
            if (isNaN(rollno) || rollno == "") { alert("You must enter a numeric value as roll."); } else { }
            if (stnameeng == "") { alert("You must enter Student Name in English."); } else { }
            if (dob == "") { alert("You must select his/her Birth Date."); } else { }
            if (religion == "") { alert("You must select his/her religion"); } else { }
            if (gender == "") { alert("You must select his/her gender"); } else { }
            if (guarname == "") { alert("You must enter his/her guardian's name."); } else { }
            if (guaradd == "") { alert("You must enter guardian's address."); } else { }
            if (guarrelation == "") { alert("You must enter guardian's relation"); } else { }
            if (guarmobile == "") { alert("You must enter a 11 digits valid guardian's mobile number."); } else { }
            if (doa == "") { alert("You must select admission date."); } else { }
        }
        else {


            var infor = "stid=" + stid + "&classname=" + classname + "&sectionname=" + sectionname + "&rollno=" + rollno + "&stnameeng=" + stnameeng + "&stnameben=" + stnameben + "&fname=" + fname + "&fprof=" + fprof + "&fmobile=" + fmobile + "&mname=" + mname + "&mprof=" + mprof + "&mmobile=" + mmobile + "&previll=" + previll + "&prepo=" + prepo + "&preps=" + preps + "&predist=" + predist + "&pervill=" + pervill + "&perpo=" + perpo + "&perps=" + perps + "&perdist=" + perdist + "&dob=" + dob + "&religion=" + religion + "&brn=" + brn + "&gender=" + gender + "&guarname=" + guarname + "&guaradd=" + guaradd + "&guarrelation=" + guarrelation + "&guarmobile=" + guarmobile + "&tcno=" + tcno + "&preins=" + preins + "&preinsadd=" + preinsadd + "&doa=" + doa + "&sccode=" + sccode + "&photoid=" + photoid + "&dopp=" + dopp;
            $("#batchbatch").html("");

            $.ajax({
                type: "POST",
                url: "save-student.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#batchbatch').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
                },
                success: function (html) {
                    $("#batchbatch").html(html);
                    document.getElementById("rollno").focus();



                    document.getElementById("rollno").value = +rollno + +1;
                    document.getElementById("photoid").value = +photoid + +1;
                    document.getElementById("dopp").value = dopp;
                    document.getElementById("stid").value = "";
                    document.getElementById("stnameeng").value = "";
                    document.getElementById("stnameben").value = "";
                    document.getElementById("fname").value = "";
                    document.getElementById("fprof").value = "";
                    document.getElementById("fmobile").value = "";

                    document.getElementById("mname").value = "";
                    document.getElementById("mprof").value = "";
                    document.getElementById("mmobile").value = "";

                    document.getElementById("previll").value = "";
                    document.getElementById("prepo").value = "";
                    document.getElementById("preps").value = "";
                    document.getElementById("predist").value = "";

                    document.getElementById("pervill").value = "";
                    document.getElementById("perpo").value = "";
                    document.getElementById("perps").value = "";
                    document.getElementById("perdist").value = "";

                    document.getElementById("dob").value = "";
                    document.getElementById("religion").value = "";
                    document.getElementById("brn").value = "";
                    document.getElementById("gender").value = "";

                    document.getElementById("guarname").value = "";
                    document.getElementById("guaradd").value = "";
                    document.getElementById("guarrelation").value = "";
                    document.getElementById("guarmobile").value = "";

                    document.getElementById("tcno").value = "";
                    document.getElementById("preins").value = "";
                    document.getElementById("preinsadd").value = "";
                    document.getElementById("doa").value = "";
                    document.getElementById("stid2").value = "";

                    fetchstudent();


                }
            });
        }
    }




    function fetchstudent() {


        var classname = document.getElementById("classname").value;
        var sectionname = document.getElementById("sectionname").value;
        var rollno = document.getElementById("rollno").value;
        var sccode = document.getElementById("sccode").innerHTML;


        var infor = "classname=" + classname + "&sectionname=" + sectionname + "&rollno=" + rollno + "&sccode=" + sccode;
        //alert(infor);
        $("#stinfo").html("");

        $.ajax({
            type: "POST",
            url: "fetchcus.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#stinfo').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#stinfo").html(html);
                var stid = document.getElementById("stid0").innerHTML;
                document.getElementById("stid").value = stid;
                document.getElementById("stnameeng").focus();



                var stnameeng = document.getElementById("stnameeng0").innerHTML;
                document.getElementById("stnameeng").value = stnameeng;
                document.getElementById("ls").innerHTML = stnameeng;
                var stnameben = document.getElementById("stnameben0").innerHTML;
                document.getElementById("stnameben").value = stnameben;
                var fname = document.getElementById("fname0").innerHTML;
                document.getElementById("fname").value = fname;
                var fprof = document.getElementById("fprof0").innerHTML;
                document.getElementById("fprof").value = fprof;
                var fmobile = document.getElementById("fmobile0").innerHTML;
                document.getElementById("fmobile").value = fmobile;
                var mname = document.getElementById("mname0").innerHTML;
                document.getElementById("mname").value = mname;
                var mprof = document.getElementById("mprof0").innerHTML;
                document.getElementById("mprof").value = mprof;
                var mmobile = document.getElementById("mmobile0").innerHTML;
                document.getElementById("mmobile").value = mmobile;
                var previll = document.getElementById("previll0").innerHTML;
                document.getElementById("previll").value = previll;
                var prepo = document.getElementById("prepo0").innerHTML;
                document.getElementById("prepo").value = prepo;
                var preps = document.getElementById("preps0").innerHTML;
                document.getElementById("preps").value = preps;
                var predist = document.getElementById("predist0").innerHTML;
                document.getElementById("predist").value = predist;
                var pervill = document.getElementById("pervill0").innerHTML;
                document.getElementById("pervill").value = pervill;
                var perpo = document.getElementById("perpo0").innerHTML;
                document.getElementById("perpo").value = perpo;
                var perps = document.getElementById("perps0").innerHTML;
                document.getElementById("perps").value = perps;
                var perdist = document.getElementById("perdist0").innerHTML;
                document.getElementById("perdist").value = perdist;
                var dob = document.getElementById("dob0").innerHTML;
                document.getElementById("dob").value = dob;
                var religion = document.getElementById("religion0").innerHTML;
                document.getElementById("religion").value = religion;
                var brn = document.getElementById("brn0").innerHTML;
                document.getElementById("brn").value = brn;
                var gender = document.getElementById("gender0").innerHTML;
                document.getElementById("gender").value = gender;

                var guarname = document.getElementById("guarname0").innerHTML;
                document.getElementById("guarname").value = guarname;
                var guaradd = document.getElementById("guaradd0").innerHTML;
                document.getElementById("guaradd").value = guaradd;
                var guarrelation = document.getElementById("guarrelation0").innerHTML;
                document.getElementById("guarrelation").value = guarrelation;
                var guarmobile = document.getElementById("guarmobile0").innerHTML;
                document.getElementById("guarmobile").value = guarmobile;

                var tcno = document.getElementById("tcno0").innerHTML;
                document.getElementById("tcno").value = tcno;
                var preins = document.getElementById("preins0").innerHTML;
                document.getElementById("preins").value = preins;

                var preinsadd5 = document.getElementById("preisnadd0").innerHTML;
                document.getElementById("preinsadd").value = preinsadd5;

                var doa6 = document.getElementById("doa0").innerHTML;
                document.getElementById("doa").value = doa6;

                var photoid2 = document.getElementById("photoid0").innerHTML;
                document.getElementById("photoid").value = photoid2;

                var dopp3 = document.getElementById("dopp0").innerHTML;
                document.getElementById("dopp").value = dopp3;


                //	savestudent();
                english();

            }
        });
    }

    function lastadd() {
        document.getElementById("previll").value = document.getElementById("vill").innerHTML;
        document.getElementById("prepo").value = document.getElementById("po").innerHTML;
        document.getElementById("preps").value = document.getElementById("ps").innerHTML;
        document.getElementById("predist").value = document.getElementById("dist").innerHTML;

    }









</script>