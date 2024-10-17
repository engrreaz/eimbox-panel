<?php
include 'inc2.php';
$stid = $_POST['stid'];


$mydata = array();
$sql0 = "SELECT * from students where sccode='$sccode' and stid='$stid'";
$result0n = $conn->query($sql0);
if ($result0n->num_rows > 0) {
    while ($row0 = $result0n->fetch_assoc()) {
        $mydata = $row0;
    }
}

$mydatasess = array();
$sql0 = "SELECT * from sessioninfo where sccode='$sccode' and stid='$stid' and sessionyear='$sy' order by sessionyear desc limit 1";
$result0nsess = $conn->query($sql0);
if ($result0nsess->num_rows > 0) {
    while ($row0 = $result0nsess->fetch_assoc()) {
        $mydatasess = $row0;
    }
}

?>


<div class="row" id="wholeblock">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 mb-4">
                        <?php
                        $stphoto = "../students/" . $stid . ".jpg";
                        // echo $stphoto;
                        if (!file_exists($stphoto)) {
                            $stphoto = "../students/no-img.jpg";
                        }
                        ?>
                        <img class="std-img" src="<?php echo $stphoto; ?>" />
                    </div>


                    <div class="col-md-10">
                        <h3><b><?php echo $mydata['stnameeng']; ?></b></h3>
                        <h5><?php echo $mydata['stnameben']; ?></h5>
                        <div class="text-warning pb-3"><small>ID # <?php echo $userid; ?></small></div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">

                    </div>


                    <div class="col-md-10">
                        <div class="text-muted text-small"><b>Session Info (<?php echo $sy; ?>)</b></div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <b><?php echo $mydatasess['classname']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Class</span>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <b><?php echo $mydatasess['sectionname']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Section</span>
                            </div>
                            <div class="col-md-3 col-sm-6 ">
                                <b><?php echo '***'; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Slot / Shift</span>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <b><?php echo $mydatasess['rollno']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Roll No.</span>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <div class="text-muted text-small"><b>Parents Info </b></div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-2"></div>
                    <div class="col-md-2">Father's Info</div>
                    <div class="col-md-8">
                        <?php echo $mydata['fname']; ?>
                        <br><span class=" text-small"><i class="mdi mdi-checkbox-blank-circle mdi-12px"></i>
                            <?php echo $mydata['fprof']; ?>, <i class="mdi mdi-cellphone-basic mdi-18px"></i>
                            <?php echo $mydata['fmobile']; ?>, <i class="mdi mdi-account-card-details "></i>
                            <?php echo $mydata['fnid']; ?>, </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">Mother's Info</div>
                    <div class="col-md-8">
                        <?php echo $mydata['mname']; ?>
                        <br><span class=" text-small"><i class="mdi mdi-checkbox-blank-circle mdi-12px"></i>
                            <?php echo $mydata['mprof']; ?>, <i class="mdi mdi-cellphone-basic mdi-18px"></i>
                            <?php echo $mydata['mmobile']; ?>, <i class="mdi mdi-account-card-details "></i>
                            <?php echo $mydata['mnid']; ?>, </span>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <div class="text-muted text-small"><b>Address </b></div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-2"></div>
                    <div class="col-md-2">Present</div>
                    <div class="col-md-8">
                        <?php echo $mydata['previll'] . ', ' . $mydata['prepo'] . ', ' . $mydata['preps'] . ', ' . $mydata['predist'] . '. '; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">Permanent </div>
                    <div class="col-md-8">
                        <?php echo $mydata['pervill'] . ', ' . $mydata['perpo'] . ', ' . $mydata['perps'] . ', ' . $mydata['perdist'] . '. '; ?>
                    </div>
                </div>




                <div class="row mt-3">
                    <div class="col-md-2">

                    </div>

                    <div class="col-md-10">
                        <div class="text-muted text-small"><b>Others Info</b></div>
                        <div class="row">
                            <div class="col-3">
                                <b><?php echo $mydata['dob']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Date of Birth</span>
                            </div>
                            <div class="col-3">
                                <b><?php echo $mydata['gender']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Gender</span>
                            </div>
                            <div class="col-3">
                                <b><?php echo $mydata['bgroup']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Blood Group</span>
                            </div>
                            <div class="col-3">
                                <b><?php echo $mydata['brn']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Birth Regd. No.</span>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-2">

                    </div>

                    <div class="col-md-10">
                        <div class="text-muted text-small"><b>Guardian Info</b></div>
                        <div class="row">
                            <div class="col-3">
                                <b><?php echo $mydata['guarname']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Guardian's Name</span>
                            </div>
                            <div class="col-3">
                                <b><?php echo $mydata['guarmobile']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Mobile</span>
                            </div>
                            <div class="col-6">
                                <b><?php echo $mydata['guaradd']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Address</span>
                            </div>
                        </div>




                    </div>
                </div>








                <!-- SEARCH BLOCK -->
            </div>
        </div>
    </div>
</div>








<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    function refbook() {
        window.location.href = 'refbook.php';
    }


</script>


<script>
    var stid = '<?php echo $stid; ?>';
    if (stid < 1) {
        document.getElementById('wholeblock').style.display = 'none';
        $("#modalbox").click();
    }
    function modal() {
        var x = document.getElementById("modaldata").value;
        window.location.href = 'std-profile.php?stid=' + x;
    }
</script>