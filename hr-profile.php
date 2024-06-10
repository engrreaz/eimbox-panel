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
        $preadd = $row5["preadd"];
        $peradd = 'Permanent Address';
        $dob = $row5["dob"];
        $religion = $row5["religion"];

        $ranks = $row5["ranks"];
        $status = $row5["status"];
        $curin = $row5["curin"];
        $curout = $row5["curout"];
        $fjdate = $row5["fjdate"];
        $tjdate = $row5["jdate"];
        $mpoindex = $row5["mpoindex"];
        $tin = $row5["tin"];

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



        $nid = '1925192750125';
        $bgroup = 'A+';
        $spouse = 'BOU - ER - Nam';
        $emergency = '01919629672';
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
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> <?php echo $nid; ?></p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i>
                            <?php echo date('d F, Y', strtotime($dob)); ?>
                        </p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> <?php echo $religion; ?></p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i>
                            <?php echo $bgroup; ?>
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> <?php echo $fname; ?></p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i>
                            <?php echo $mname; ?>
                        </p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> <?php echo $spouse; ?></p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> <?php echo $emergency; ?></p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i>
                            <?php echo $preadd; ?>
                        </p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i>
                            <?php echo $peradd; ?></p>
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
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> <?php echo $mpoindex; ?></p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> <?php echo $tin; ?> (Circle)</p>
                    </div>

                    <div class="col-md-6">
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> <?php echo $fjdate; ?></p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> <?php echo $tjdate; ?></p>
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
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Govt. Payment</p>
                    </div>
                    <div class="col-md-8">
                        <p><?php echo 'Acc No. # ' . $accno . ', ' . $bankname . ', ' . $branch . '. <br>[Routing # ' . $routing . ']'; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Institute Payment</p>
                    </div>
                    <div class="col-md-8">
                        <p><?php echo 'Acc No. # ' . $accnosch . ', ' . $bnamesch . ', ' . $bbrsch . '. <br>[Routing # ' . $routesch . ']'; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> PF Account</p>
                    </div>
                    <div class="col-md-8">
                        <p><?php echo 'Acc No. # ' . $accnopf . ', ' . $bnamepf . ', ' . $brpf . '. <br>[Routing # ' . $routepf . ']'; ?></p>
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
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale : <?php echo $payscale;?></p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale : <?php echo $paycode;?></p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale : <?php echo $payscale;?></p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale : <?php echo $payscale;?></p>
                    </div>
                    <div class="col-md-4">
                        <div><div class="float-right pt-1"><?php echo $basic;?></div><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale</div>
                        <div><div class="float-right pt-1"><?php echo $incentive;?></div><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale</div>
                        <div><div class="float-right pt-1"><?php echo $house;?></div><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale</div>
                        <div><div class="float-right pt-1"><?php echo $medical;?></div><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale</div>
                        <div><div class="float-right pt-1"><?php echo $welfare;?></div><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale</div>
                        <div><div class="float-right pt-1"><?php echo $retire;?></div><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Pay Scale</div>
                        <div><div class="float-right pt-1"><?php echo $netamtgovt;?></div><i class="mdi mdi-map-marker mdi-12px pr-3"></i> Total (Govt.)</div>
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
    document.getElementById('defbtn').innerHTML = 'Print Profile';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        // window.location.href = 'hr-edit.php?tid=<?php echo $tid; ?>';
    }
</script>