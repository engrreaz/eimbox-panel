<?php
include 'header.php';

$dismsg = 0;
$cls2 = $sec2 = $roll2 = $rollno = '';
$new = 0; // check new entry or not

if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
} else {
    $tid = 0;
}

if ($tid == 0) {
    $disx = 'none';
} else {
    $disx = 'block';
}

$sql5 = "SELECT * FROM teacher where tid='$tid' and sccode='$sccode' ";
$result7 = $conn->query($sql5);
if ($result7->num_rows > 0) {
    while ($row5 = $result7->fetch_assoc()) {
        $tnamee = $row5["tname"];
        $tnameb = $row5["tnameb"];
        $position = $row5["position"];
        $subject = $row5["subjects"];
        $slot = $row5["slots"];
        $gender = $row5["gender"];
        $email = $row5["email"];
        $phone = $row5["mobile"];



        $jdate = $row5["jdate"];
        $fname = $row5["fname"];
        $mname = $row5["mname"];

        $religion = $row5["religion"];

        $ranks = $row5["ranks"];
        $status = $row5["status"];
        $curin = $row5["curin"];
        $curout = $row5["curout"];
        $fjdate = $row5["fjdate"];
        $tjdate = $row5["jdate"];
        $mpoindex = $row5["mpoindex"];
        $tin = $row5["tin"];


        $preadd = $row5["previll"] . ', ' . $row5["prepo"] . ', ' . $row5["preps"] . ', ' . $row5["predist"];
        $peradd = $row5["pervill"] . ', ' . $row5["perpo"] . ', ' . $row5["perps"] . ', ' . $row5["perdist"];

        $dob = $row5["dob"];


        $accno = $row5["accno"];
        $bankname = $row5["bankname"];
        $branch = $row5["branch"];
        $routing = $row5["routing"];
        $accnosch = $row5["accnosch"];
        $bnamesch = $row5["bnamesch"];
        $bbrsch = $row5["bbrsch"];
        $routesch = $row5["routesch"];
        $accnopf = $row5["accnopf"];
        $bnamepf = $row5["bnamepf"];
        $brpf = $row5["bbrpf"];
        $routepf = $row5["routepf"];


        $paycode = $row5["paycode"];
        $payscale = $row5["payscale"];
        $basic = $row5["basic"];
        $incentive = $row5["incentive"];
        $house = $row5["house"];
        $medical = $row5["medical"];
        $arrea = $row5["arrea"];
        $welfare = $row5["welfare"];
        $retire = $row5["retire"];
        $netamtgovt = $row5["netamtgovt"];
        $salary = $row5["salary"];
        $mobilevata = $row5["mobilevata"];
        $travel = $row5["travel"];
        $medical2 = $row5["medical2"];
        $pf = $row5["pf"];
        $net2 = $row5["net2"];



        $nid = $row5["nid"];
        $bgroup = $row5["bgroup"];
        $spouse = $row5["spouse"];
        $emergency = $row5["emergency"];
        // $ = $row5[""];




    }
} else {
    $tnamee = '';
    $tnameb = '';
    $position = '';
    $subject = '';
    $slot = '';
    $jdate = '';
    $fname = '';
    $mname = '';
    $preadd = '';
    $dob = '';
    $religion = '';
    $gender = '';
    $email = '';
    $phone = '';
    $nid = $bgroup = $preadd = $peradd = $spouse = $emergency = $mpoindex = $tin = $fjdate = $tjdate = '';

    $accno = $bankname = $branch = $routing = '';
    $accnosch = $bnamesch = $bbrsch = $routesch = '';
    $accnopf = $bnamepf = $brpf = $routepf = '';


    $paycode = $payscale = $basic = $incentive = $house = $medical = $arrea = $welfare = $retire = $netamtgovt = 0;
    $salary = $mobilevata = $travel = $medical2 = $pf = $net2 = 0;
}



?>
<style>
    .col-form-label {
        color: slategray;
    }
</style>
<h3>HR Profile</h3>



<style>
    h4 {
        font-weight: bold;
    }
</style>

<?php if ($tid !== 0) { ?>
    <div class="row"> <!--   Class/Roll Block -->
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group row">
                                <div class="col-12">
                                    <?php
                                    $tpath = "../teacher/" . $tid . ".jpg";
                                    if (!file_exists($tpath)) {
                                        $tpath = "../teacher/no-img.jpg";
                                    }
                                    ?>
                                    <img src="<?php echo $tpath; ?>"
                                        style="height: 100px; border-radius:5px; border:1px solid gray;;">



                                    <?php
                                    $datamon = 'xdgf';
                                    // include 'ajax-upload.php';
                                    ?>







                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <code>ID # <?php echo $tid; ?></code><br>
                            <h4 class=""><?php echo $tnamee; ?></h4>
                            <h5 class=""><?php echo $tnameb; ?></h5>
                            <h6 class=""><?php echo $position; ?> / <?php echo $slot; ?></h6>
                        </div>

                        <div class="col-md-4">
                            <h5 class=""><i class="mdi mdi-book-open-page-variant mdi-18px pr-3"></i><?php echo $subject; ?>
                            </h5>
                            <h6 class=""><i class="mdi mdi mdi-phone mdi-18px pr-3"></i><small><?php echo $phone; ?>
                                </small></h6>
                            <h6 class=""><i
                                    class="mdi mdi-email-open-outline mdi-18px pr-3"></i><small><?php echo $email; ?>
                                </small></h6>

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
                            <div>
                                <div class="float-right pt-1"><?php echo $nid; ?></div><i
                                    class="mdi mdi-account-card-details mdi-12px pr-3"></i> NID
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo date('l, j F, Y', strtotime($dob)); ?></div><i
                                    class="mdi mdi-calendar-check mdi-12px pr-3"></i> Date of Birth
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo $religion; ?></div><i
                                    class="mdi mdi-checkbox-blank mdi-12px pr-3"></i> Religion
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo $bgroup; ?></div><i
                                    class="mdi mdi-water mdi-12px pr-3"></i> Blood Group
                            </div>


                        </div>

                        <div class="col-md-6">

                            <div>
                                <div class="float-right pt-1"><?php echo $fname; ?></div><i
                                    class="mdi mdi-human-male mdi-12px pr-3"></i> Father's Name
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo $mname; ?></div><i
                                    class="mdi mdi-human-female mdi-12px pr-3"></i> Mother's Name
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo $spouse; ?></div><i
                                    class="mdi mdi-human-male-female mdi-12px pr-3"></i> Spouse
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo $emergency; ?></div><i
                                    class="mdi mdi-phone mdi-12px pr-3"></i> Emergency Contact
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex mt-3">
                                <i class="mdi mdi-google-maps mdi-12px pr-3"></i>
                                <div>
                                    <?php echo $preadd; ?>
                                    <p class="text-small  text-muted">Present Address</p>
                                </div>
                            </div>

                            <div class="d-flex mt-1">
                                <i class="mdi mdi-google-maps mdi-12px pr-3"></i>
                                <div>
                                    <?php echo $peradd; ?>
                                    <p class="text-small  text-muted">Permanent Address</p>
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

                            <div>
                                <div class="float-right pt-1"><?php echo $mpoindex; ?></div><i
                                    class="mdi mdi-phone mdi-12px pr-3"></i> MPO Index
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo $tin; ?></div><i
                                    class="mdi mdi-phone mdi-12px pr-3"></i> TIN Number
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <div class="float-right pt-1"><?php echo date('d/m/Y', strtotime($fjdate)); ?></div><i
                                    class="mdi mdi-phone mdi-12px pr-3"></i> First Joining Date
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo date('d/m/Y', strtotime($tjdate)); ?></div><i
                                    class="mdi mdi-phone mdi-12px pr-3"></i> Joining Date (Institute)
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
                        <div class="col-md-4">
                            <p><i class="mdi mdi-flask-empty mdi-12px pr-3"></i> <b> Govt. Payment</b></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo 'Acc No. # ' . $accno . ', ' . $bankname . ', ' . $branch . '. <br>[Routing # ' . $routing . ']'; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p><i class="mdi mdi-flask-empty mdi-12px pr-3"></i> <b> Institute Payment</b></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo 'Acc No. # ' . $accnosch . ', ' . $bnamesch . ', ' . $bbrsch . '. <br>[Routing # ' . $routesch . ']'; ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p><i class="mdi mdi-flask-empty mdi-12px pr-3"></i> <b> PF Account</b></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo 'Acc No. # ' . $accnopf . ', ' . $bnamepf . ', ' . $brpf . '. <br>[Routing # ' . $routepf . ']'; ?>
                            </p>
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
                        <div class="col-md-4">
                            <h4><b>Salary Structure</b></h4>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($paycode, 0); ?></div><i
                                    class="mdi mdi-currency-try mdi-12px pr-3"></i> Pay Code
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($payscale, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale
                            </div>

                            <div class="m-2">&nbsp;</div>
                        </div>


                        <div class="col-md-4">
                            <h4><b>MPO Information</b></h4>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($basic, 2); ?></div><i
                                    class="mdi mdi-currency-try mdi-12px pr-3"></i> Basic
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($incentive, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Incentive
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($house, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> House Rent
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($medical, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Medical Allowance
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($welfare, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Welfare
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($retire, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Retirement
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($netamtgovt, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Net Salary (MPO)
                            </div>
                            <div class="m-2">&nbsp;</div>
                        </div>



                        <div class="col-md-4">
                            <h4><b>Salary Provided by Institute</b></h4>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($basic, 2); ?></div><i
                                    class="mdi mdi-currency-try mdi-12px pr-3"></i> Basic
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($incentive, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Incentive
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($house, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> House Rent
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($medical, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Medical Allowance
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($welfare, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Welfare
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($retire, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Retirement
                            </div>
                            <div>
                                <div class="float-right pt-1"><?php echo number_format($netamtgovt, 2); ?></div><i
                                    class="mdi mdi-map-marker mdi-12px pr-3"></i> Net Salary (MPO)
                            </div>

                            <div class="m-2">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php } else {
    ?>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center text-danger">
                        <br><br><h4>No Teacher/Staff Selected. Please go to teacher's list page and select one.</h4>
                            <br>
                            <a class="btn btn-inverse-primary p-2" href="hr-list.php?hr=Teacher">Go To Teacher's List</a>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
<?php
} ?>










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
    document.getElementById('defbtn').innerHTML = 'Print Profile';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        // window.location.href = 'hr-edit.php?tid=<?php echo $tid; ?>';
    }
</script>