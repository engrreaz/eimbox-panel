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
        $jdate = $row5["jdate"];
        $fname = $row5["fname"];
        $mname = $row5["mname"];
        $preadd = $row5["preadd"];
        $dob = $row5["dob"];
        $religion = $row5["religion"];
        $gender = $row5["gender"];
        $email = $row5["email"];
        $phone = $row5["mobile"];
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
                                <img src="<?php echo $tpath; ?>" style="height: 100px; border-radius:5px; border:1px solid gray;;">



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
                        <h6 class=""><i
                                class="mdi mdi-email-open-outline mdi-18px pr-3"></i><small><?php echo $email; ?>
                            </small></h6>
                        <h6 class=""><i class="mdi mdi mdi-phone mdi-18px pr-3"></i><small><?php echo $phone; ?>
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
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> 
                        </p>
                        <p><i class="mdi mdi-map-marker mdi-12px pr-3"></i> 
                        </p>
                    </div>

                    <div class="col-md-6">
                        <h6 class="">..........................</h6>
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