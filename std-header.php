<?php
$sql000 = "SELECT * FROM students where sccode='$sccode' and stid='$stid'";
$resultix1 = $conn->query($sql000);
// $conn -> close();
if ($resultix1->num_rows > 0) {
    while ($row000 = $resultix1->fetch_assoc()) {
        $pronamee = $row000["stnameeng"];
        $pronameb = $row000["stnameben"];
    }
}
$sql000 = "SELECT * FROM sessioninfo where sccode='$sccode' and stid='$stid' and sessionyear='$sy' order by id desc limit 1";
$resultix2 = $conn->query($sql000);
// $conn -> close();
if ($resultix2->num_rows > 0) {
    while ($row000 = $resultix2->fetch_assoc()) {
        $klass = $row000["classname"];
        $seksion = $row000["sectionname"];
        $rol = $row000["rollno"];
        $sloot = $row000["slot"];
    }
}


?>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <?php

                        $stphoto = $BASE__PATH . "/students/" . $stid . ".jpg";
                        echo $stphoto;
                        // echo $stphoto;
                        if (!file_exists($stphoto)) {
                            $stphoto = $BASE__PATH . "/students/no-img.jpg";
                        }
                        ?>
                        <img class="std-img" src="<?php echo $stphoto; ?>" />
                    </div>


                    <div class="col-md-7">
                        <h3><b><?php echo $pronamee; ?></b></h3>
                        <div class="text-warning"><small>ID # <?php echo $userid; ?></small></div>
                        <div class=" text-small">Class : <b><?php echo $klass; ?></b> ; Section :
                            <b><?php echo $seksion; ?></b> ; Roll : <b><?php echo $rol; ?></b> ; Slot :
                            <b><?php echo $sloot; ?></b></div>
                    </div>

                    <div class="col-md-3">
                        <?php echo $std_right; ?>
                    </div>
                </div>
                <!-- SEARCH BLOCK -->
            </div>
        </div>
    </div>
</div>