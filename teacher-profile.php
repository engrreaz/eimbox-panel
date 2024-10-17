<?php
include 'header.php';
$tid = $userid;

$mydata = array();
$sql0 = "SELECT * FROM teacher where sccode = '$sccode'  and tid='$tid' order by id desc limit 1;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $mydata[] = $row0;
    }
} else {
    $mydata[] = '';
}

?>








<div class="row" id="wholeblock">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 mb-4">
                    <?php
                       $stphoto = $BASE__PATH . "/teacher" . "/" . $tid . ".jpg";
                       $stphoto2 = $BASE__PATH . "/students/noimg.jpg";
                       ?>
                       <img class="std-img" src="<?php echo $stphoto; ?>" onerror="this.onerror=null;this.src='<?php echo $stphoto2;?>';" />
                    </div>


                    <div class="col-md-10">
                        <h3><b><?php echo $mydata[0]['tname']; ?></b></h3>
                        <h5><?php echo $mydata[0]['tnameb']; ?></h5>
                        <div class="text-warning pb-3"><small>ID # <?php echo $userid; ?></small></div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">

                    </div>


                    <div class="col-md-10">
                        <div class="text-muted text-small"><b>Academic Info (<?php echo $sy; ?>)</b></div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <b><?php echo $mydata[0]['slots']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Slots/Shift</span>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <b><?php echo $mydata[0]['position']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Position</span>
                            </div>
                            <div class="col-md-3 col-sm-6 ">
                                <b><?php echo $mydata[0]['subjects']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Subject</span>
                            </div>
                            <div class="col-md-3 col-sm-6" hidden>
                                <b><?php echo $mydata[0]['ranks']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <b><?php echo $mydata[0]['mobile']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Mobile Number</span>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <b><?php echo $mydata[0]['email']; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Email</span>
                            </div>
                        </div>



                    </div>
                </div>



                <div class="row mt-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <div>
                            <div class="float-right pt-1"><?php echo $mydata[0]['nid']; ?></div><i
                                class="mdi mdi-account-card-details mdi-12px pr-3"></i> NID
                        </div>
                        <div>
                            <div class="float-right pt-1">
                                <?php echo date('l, j F, Y', strtotime(datetime: $mydata[0]['dob'])); ?></div><i
                                class="mdi mdi-calendar-check mdi-12px pr-3"></i> Date of Birth
                        </div>
                        <div>
                            <div class="float-right pt-1"><?php echo $mydata[0]['religion']; ?></div><i
                                class="mdi mdi-checkbox-blank mdi-12px pr-3"></i> Religion
                        </div>
                        <div>
                            <div class="float-right pt-1"><?php echo $mydata[0]['bgroup']; ?></div><i
                                class="mdi mdi-water mdi-12px pr-3"></i> Blood Group
                        </div>


                    </div>

                    <div class="col-md-5">

                        <div>
                            <div class="float-right pt-1"><?php echo $mydata[0]['fname']; ?></div><i
                                class="mdi mdi-human-male mdi-12px pr-3"></i> Father's Name
                        </div>
                        <div>
                            <div class="float-right pt-1"><?php echo $mydata[0]['mname']; ?></div><i
                                class="mdi mdi-human-female mdi-12px pr-3"></i> Mother's Name
                        </div>
                        <div>
                            <div class="float-right pt-1"><?php echo $mydata[0]['spouse']; ?></div><i
                                class="mdi mdi-human-male-female mdi-12px pr-3"></i> Spouse
                        </div>
                        <div>
                            <div class="float-right pt-1"><?php echo $mydata[0]['emergency']; ?></div><i
                                class="mdi mdi-phone mdi-12px pr-3"></i> Emergency Contact
                        </div>

                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <div class="d-flex mt-3">
                            <i class="mdi mdi-google-maps mdi-12px pr-3"></i>
                            <div>
                                <?php echo $mydata[0]['previll'] . ', ' . $mydata[0]['prepo'] . ', ' . $mydata[0]['preps'] . ', ' . $mydata[0]['predist']; ?>
                                <p class="text-small  text-muted">Present Address</p>
                            </div>
                        </div>

                        <div class="d-flex mt-1">
                            <i class="mdi mdi-google-maps mdi-12px pr-3"></i>
                            <div>
                            <?php echo $mydata[0]['pervill'] . ', ' . $mydata[0]['perpo'] . ', ' . $mydata[0]['perps'] . ', ' . $mydata[0]['perdist']; ?>
                               
                                <p class="text-small  text-muted">Permanent Address</p>
                            </div>
                        </div>



                    </div>


                </div>


                <div class="row mt-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">

                        <div>
                            <div class="float-right pt-1"><?php echo $mydata[0]['mpoindex']; ?></div><i
                                class="mdi mdi-card mdi-12px pr-3"></i> MPO Index
                        </div>
                        <div>
                            <div class="float-right pt-1"><?php echo $mydata[0]['tin']; ?></div><i
                                class="mdi mdi-coin mdi-12px pr-3"></i> TIN Number
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div>
                            <div class="float-right pt-1"><?php echo date('d/m/Y', strtotime($mydata[0]['jdate'])); ?></div><i
                                class="mdi mdi-calendar-check mdi-12px pr-3"></i> First Joining Date
                        </div>
                        <div>
                            <div class="float-right pt-1"><?php echo date('d/m/Y', strtotime($mydata[0]['fjdate'])); ?></div><i
                                class="mdi mdi-calendar-check mdi-12px pr-3"></i> Joining Date (Institute)
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
    var stid = '<?php echo $tid; ?>';
    if (stid < 1) {
        document.getElementById('wholeblock').style.display = 'none';
        $("#modalbox").click();
    }
    function modal() {
        var x = document.getElementById("modaldata").value;
        window.location.href = 'std-profile.php?stid=' + x;
    }
</script>