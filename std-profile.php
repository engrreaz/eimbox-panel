<?php
include 'header.php';



if ($userlevel == 'Guardian') {
    if (isset($_GET['stid'])) {
        $stid = $_GET['stid'];
    } else {
        $stid = 0;
        // echo 'stid not define';
        ?>
        <button type="button" id="modalbox" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" hidden>
            Choose Student
        </button>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">My Students List</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="" class="input-control select full-size error">
                            <select id="modaldata" name="modaldata" class="form-control" onchange="modal();">
                                <option value="">Choose a student</option>
                                <?php
                                $sql000 = "SELECT * FROM guar_student where sccode='$sccode' and guarid='$userid' order by id";
                                $resultix = $conn->query($sql000);
                                // $conn -> close();
                                if ($resultix->num_rows > 0) {
                                    while ($row000 = $resultix->fetch_assoc()) {
                                        $stidx = $row000["stid"];

                                        $sql000 = "SELECT * FROM students where sccode='$sccode' and stid='$stidx' order by id";
                                        $resultixx = $conn->query($sql000);
                                        // $conn -> close();
                                        if ($resultixx->num_rows > 0) {
                                            while ($row000 = $resultixx->fetch_assoc()) {
                                                $stnameeng = $row000["stnameeng"];
                                            }
                                        }


                                        echo '<option value="' . $stidx . '"  >' . $stnameeng . '</option>';
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
    }
} else {
    $stid = $userid;
}




$mydata = array();
$sql0 = "SELECT * from students where sccode='$sccode' and stid='$stid'";
$result0n = $conn->query($sql0);
if ($result0n->num_rows > 0) {
    while ($row0 = $result0n->fetch_assoc()) {
        $mydata = $row0;
    }
}

?>








<div class="row" id="wholeblock">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <img class="std-img" src="../students/no-img.jpg" />
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
                            <div class="col-3">
                                <b><?php echo 'Honours'; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Class</span>
                            </div>
                            <div class="col-3">
                                <b><?php echo 'Physics'; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Section</span>
                            </div>
                            <div class="col-3">
                                <b><?php echo 'English (Morning)'; ?></b>
                                <br><span class="text-muted text-small m-0 p-0">Slot / Shift</span>
                            </div>
                            <div class="col-3">
                                <b><?php echo '01'; ?></b>
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
                        <br><span class=" text-small"><i class="mdi mdi-checkbox-blank-circle mdi-12px"></i> Doctor, <i
                                class="mdi mdi-cellphone-basic mdi-18px"></i> 018-2365478952, <i
                                class="mdi mdi-account-card-details "></i> 12365479952, </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">Mother's Info</div>
                    <div class="col-md-8">
                        <?php echo $mydata['mname']; ?>
                        <br><span class=" text-small"><i class="mdi mdi-checkbox-blank-circle mdi-12px"></i> Doctor, <i
                                class="mdi mdi-cellphone-basic mdi-18px"></i> 018-2365478952, <i
                                class="mdi mdi-account-card-details "></i> 12365479952, </span>
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