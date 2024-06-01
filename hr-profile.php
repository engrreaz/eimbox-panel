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
    $sql5 = "SELECT * FROM sessioninfo where classname='$cls2' and sectionname = '$sec2' and rollno='$roll2' and sessionyear = '$sy' and sccode='$sccode';";
} else {
    $sql5 = "SELECT * FROM sessioninfo where stid='$stid' and sessionyear = '$sy' and sccode='$sccode';";
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
    // $cls2 = '';
    // $sec2 = '';
    $rollno = $roll2;
    // $stid = '';

    $sql5 = "SELECT * FROM students where sccode='$sccode' order by stid desc LIMIT 1;";
    $result6x = $conn->query($sql5);
    if ($result6x->num_rows > 0) {
        while ($row5 = $result6x->fetch_assoc()) {
            $stid = $row5["stid"] + 1;
            $dismsg += 1;
            $new = 1;
        }
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
        $dopp = $row5["photo_pick_date"];
        // $ = $row5[""];
        $sscyear = $row5["sscpassyear"];
        $sscregd = $row5["regdno"];
        $sscroll = $row5["rollno"];
        $sscresult = $row5["gpa"];

        $fnid = $row5["fnid"];
        $mnid = $row5["mnid"];

    }
} else {
    $stnameeng = '';
    $stnameben = '';
    $fname = '';
    $fprof = '';
    $fmobile = '';
    // $ = $row5["fnid"];
    $mname = '';
    $mprof = '';
    $mmobile = '';
    // $ = $row5["mnid"];
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
    $fnid = '';
    $mnid = '';
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
<h3>Student Profile</h3>

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
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <?php
                                $stpth = "https://www.eimbox.com/student/<?php echo $stid;?>.jpg";
                                if (!file_exists($stpth)) {
                                    $stpth = "https://www.eimbox.com/students/noimg.jpg";
                                }
                                ?>
                                <img src="<?php echo $stpth; ?>" style="height:120px;" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <code>ID # <?php echo $stid; ?></code><br>
                        <h3 class=""><?php echo $doa; ?></h3>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                dddddddd
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

</style>
<div class="row"> <!--   Class/Roll Block -->
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item mr-0" role="presentation">
                                <button class="nav-link active btn-inverse-primary text-secondary" id="pills-home-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true">Personal</button>
                            </li>
                            <li class="nav-item mr-0" role="presentation">
                                <button class="nav-link  btn-inverse-primary text-secondary" id="pills-profile-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">Guardian</button>
                            </li>

                            <li class="nav-item mr-0" role="presentation">
                                <button class="nav-link  btn-inverse-primary text-secondary" id="pills-contact-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Fees</button>
                            </li>
                            <li class="nav-item mr-0" role="presentation">
                                <button class="nav-link  btn-inverse-primary text-secondary" id="pills-contact-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Attendance</button>
                            </li>
                            <li class="nav-item mr-0" role="presentation">
                                <button class="nav-link  btn-inverse-primary text-secondary" id="pills-contact-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Results</button>
                            </li>
                            <li class="nav-item mr-0" role="presentation">
                                <button class="nav-link  btn-inverse-primary text-secondary" id="pills-contact-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Archive</button>
                            </li>
                            <li class="nav-item mr-0" role="presentation">
                                <button class="nav-link  btn-inverse-primary text-secondary" id="pills-contact-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Overall</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Name (In English) :</td>
                                            <td><?php echo $stnameeng; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Name (In Bengali) :</td>
                                            <td><?php echo $stnameben; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth :</td>
                                            <td><?php echo $dob; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Religion :</td>
                                            <td><?php echo $religion; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender :</td>
                                            <td><?php echo $gender; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Birth Registration #</td>
                                            <td><?php echo $brn; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Present Address :</td>
                                            <td><?php echo $previll . ', ' . $prepo . ', ' . $preps . ', ' . $predist; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Present Address :</td>
                                            <td><?php echo $pervill . ', ' . $perpo . ', ' . $perps . ', ' . $perdist; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Father :</td>
                                            <td>
                                                <h4><?php echo $fname; ?></h4>
                                                <h6><?php echo $fprof; ?></h6>
                                                <h5><?php echo $fmobile; ?></h5>
                                                <h6><?php echo $fnid; ?></h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mother :</td>
                                            <td>
                                                <h4><?php echo $mname; ?></h4>
                                                <h6><?php echo $mprof; ?></h6>
                                                <h5><?php echo $mmobile; ?></h5>
                                                <h6><?php echo $mnid; ?></h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Guardian :</td>
                                            <td>
                                                <h4><?php echo $guarname; ?></h4>
                                                <h6><?php echo $guarrelation; ?></h6>
                                                <h5><?php echo $guarmobile; ?></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">xxxxxxxxxxxxxxxxxx</div>
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
    document.getElementById('defbtn').innerHTML = 'Save The Student';
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

        var sscyear = document.getElementById("sscyear").value;
        var sscregd = document.getElementById("sscregd").value;
        var sscroll = document.getElementById("sscroll").value;
        var sscresult = document.getElementById("sscresult").value;



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
            var infor = "stid=" + stid + "&classname=" + classname + "&sectionname=" + sectionname + "&rollno=" + rollno + "&stnameeng=" + stnameeng + "&stnameben=" + stnameben + "&fname=" + fname + "&fprof=" + fprof + "&fmobile=" + fmobile + "&mname=" + mname + "&mprof=" + mprof + "&mmobile=" + mmobile + "&previll=" + previll + "&prepo=" + prepo + "&preps=" + preps + "&predist=" + predist + "&pervill=" + pervill + "&perpo=" + perpo + "&perps=" + perps + "&perdist=" + perdist + "&dob=" + dob + "&religion=" + religion + "&brn=" + brn + "&gender=" + gender + "&guarname=" + guarname + "&guaradd=" + guaradd + "&guarrelation=" + guarrelation + "&guarmobile=" + guarmobile + "&tcno=" + tcno + "&preins=" + preins + "&preinsadd=" + preinsadd + "&doa=" + doa + "&photoid=" + photoid + "&dopp=" + dopp + "&sscyear=" + sscyear + "&sscregd=" + sscregd + "&sscroll=" + sscroll + "&sscresult=" + sscresult;
            $("#batchbatch").html("ddd");

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
                    var nextroll = parseInt(rollno) + 0;
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
        document.getElementById(iid).value = titleCase;
    }
</script>