<?php
$sql000 = "SELECT * FROM teacher where sccode='$sccode' and tid='$tid'";
$resultix1 = $conn->query($sql000);
// $conn -> close();
if ($resultix1->num_rows > 0) {
    while ($row000 = $resultix1->fetch_assoc()) {
        $tnamebx = $row000["tname"];
        $positionbx= $row000["position"];
        $subjectbx= $row000["subjects"];
    }
}

$clscls = $clssec = '';
$sql000 = "SELECT * FROM areas where sccode='$sccode' and classteacher='$tid' and sessionyear='$sy'";

$resultix2 = $conn->query($sql000);
// $conn -> close();
if ($resultix2->num_rows > 0) {
    while ($row000 = $resultix2->fetch_assoc()) {
        $clscls = $row000["areaname"];
        $clssec= $row000["subarea"];
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
                        $stphoto = "../teacher/" . $tid . ".jpg";
                        // echo $stphoto;
                        if (!file_exists($stphoto)) {
                            $stphoto = "../students/no-img.jpg";
                        }
                        ?>
                        <img class="std-img" src="<?php echo $stphoto; ?>" />
                    </div>


                    <div class="col-md-6 pt-2">
                        <h4  style="line-height:10px;"><b><?php echo $tnamebx; ?></b></h4>
                        <div class="text-warning"><small>ID # <?php echo $userid; ?></small></div>
                        <div class=" text-small"><?php echo $positionbx; ?> (<?php echo $subjectbx; ?>)</div>
                    </div>

                    <div class="col-md-4 pt-2">
                        <?php echo $tea_right;?>
                    </div>
                </div>
                <!-- SEARCH BLOCK -->
            </div>
        </div>
    </div>
</div>