<?php
include 'header.php';
$tid = $userid;




$f_date = $sy . '-01-01';
$l_date = $sy . '-12-31';
$sql0 = "SELECT * FROM calendar where (sccode = '$sccode' or sccode=0) and date between '$f_date' and '$l_date' and descrip IS NOT NULL order by date; ;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $datam[] = $row0;
    }
} else {
    $datam[] = '';
}
// echo var_dump($datam);
?>


<div id="wholeblock">



    <?php include 'teacher-header.php'; ?>


    <h3 class="text-center"><b>My Subjects</b></h3>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php
                        $sql0 = "SELECT classname, sectionname, subcode FROM clsroutine where sccode = '$sccode' and sessionyear='$sy' and tid='$tid' group by classname, sectionname order by period, wday ;";
                        $result0rtrx0 = $conn->query($sql0);
                        if ($result0rtrx0->num_rows > 0) {
                            while ($row0 = $result0rtrx0->fetch_assoc()) {
                                $ccc = $row0['classname'];
                                $sss = $row0['sectionname'];
                                $sub = $row0['subcode'];

                                $sql0 = "SELECT * FROM subjects where subcode = '$sub' and (sccode='$sccode' || sccode=0)  ;";
                                $result0rtrx1 = $conn->query($sql0);
                                if ($result0rtrx1->num_rows > 0) {
                                    while ($row0 = $result0rtrx1->fetch_assoc()) {
                                        $sube = $row0['subject'];
                                        $subb = $row0['subben'];
                                    }
                                }
                                ?>
                                <div class="col-md-2 mb-3">
                                    <div class="card w-40 d-block mx-auto">
                                        <img class="card-img-top" src="assets/imgs/book.png" alt="Tutorialspoint Logo">
                                        <p class="card-img-overlay text-center pt-4"
                                            style="line-height:20px; font-size:15px; font-weight:700; color:teal;">
                                            <?php echo $sube; ?>
                                            <br>
                                            <span style="line-height:14px; font-size:20px; font-weight:500; color:crimson;">
                                                <?php echo $subb; ?>
                                            </span>
                                        </p>

                                        <div class=""
                                            style="margin-top:-50px; font-weight:700; text-align:right; margin-right:15px; line-height:20px;">
                                            <small>for class </small> <?php echo $ccc; ?><br>
                                            <span
                                                style="font-size:16px; font-weight:400;"><small><?php echo $sss; ?></small></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-sm-6 grid-margin stretch-card"
                                    onclick="profile(<?php echo $guarstid; ?>);" hidden>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row text-center">
                                                <div class="text-center" style="margin:auto;">
                                                    <img class="guar-stu-image" src="../students/no-img.jpg" />
                                                    <h6 class="pt-3 text-warning font-weight-bold">Iftekhar Amin</h6>
                                                    <div class="text-small">
                                                        <span style="line:height:12px;">
                                                            Student ID # 1031872459<br>
                                                            Class : Ten ; Section : Business Studeies<br>
                                                            Shift : College ; Roll # 12
                                                        </span>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="d-flex align-items-center align-self-start">
                                                        <h3 class="mb-0" id="st_attnd_main">0</h3>
                                                        <p class="text-danger ml-2 mb-0 font-weight-medium"
                                                            id="total_students_main">0</p>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="icon icon-box-danger ">
                                                        <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-muted font-weight-normal">Today's Students</h6>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } ?>














                        <div class="table-responsive ">
                            <table class="table  table-stripe">
                                <thead>
                                    <tr>
                                        <th>Period</th>
                                        <th>Day</th>
                                        <th>Subject</th>
                                        <th>Teacher/Lecturer</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $sql0 = "SELECT * FROM clsroutine where sccode = '$sccode' and sessionyear='$sy' and tid='$tid' order by period, wday ;";
                                    $result0rtrx = $conn->query($sql0);
                                    if ($result0rtrx->num_rows > 0) {
                                        while ($row0 = $result0rtrx->fetch_assoc()) {
                                            $period = $row0['period'];
                                            $wday = $row0['wday'];
                                            $subcode = $row0['subcode'];
                                            $tid = $row0['tid'];

                                            ?>

                                            <tr>
                                                <td><?php echo $period; ?></td>
                                                <td><?php echo $wday; ?></td>
                                                <td><?php echo $subcode; ?></td>
                                                <td><?php echo $tid; ?></td>
                                            </tr>

                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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
    var uri = window.location.href;
</script>