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



$sql0 = "SELECT * FROM sessioninfo where sccode='$sccode' and stid='$stid' and sessionyear='$sy'  order by id desc limit 1;";
$result0b = $conn->query($sql0);
if ($result0b->num_rows > 0) {
    while ($row5 = $result0b->fetch_assoc()) {
        $cn = $row5['classname'];
        $secname = $row5['sectionname'];
        $rollno = $row5['rollno'];
    }
}

$sql000 = "SELECT * FROM students where sccode='$sccode' and stid='$stid'";
$resultix1x = $conn->query($sql000);
// $conn -> close();
if ($resultix1x->num_rows > 0) {
    while ($row000 = $resultix1x->fetch_assoc()) {
        $stnamee = $row000["stnameeng"];
        $stnameb = $row000["stnameben"];
    }
}



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


    <?php include 'std-header.php'; ?>

    <h3 class="text-center">Result / Assessment</h3>
    <h6 class="text-small text-center text-info">
        <b>A+ (5.00)</b> &#8702; 80+ &nbsp;&nbsp;&nbsp;&nbsp;
        <b>A (4.00)</b> &#8702; 70-79 &nbsp;&nbsp;&nbsp;&nbsp;
        <b>A- (3.50)</b> &#8702; 60-69 &nbsp;&nbsp;&nbsp;&nbsp;
        <b>B (3.00)</b> &#8702; 50-59 &nbsp;&nbsp;&nbsp;&nbsp;
        <b>C (2.00)</b> &#8702; 40-49 &nbsp;&nbsp;&nbsp;&nbsp;
        <b>D (1.00)</b> &#8702; 33-39 &nbsp;&nbsp;&nbsp;&nbsp;
        <b>F (0.00)</b> &#8702; 0-32
    </h6>



    <div class="row" hidden>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="https://eimbox.com/students/<?php echo $stid; ?>.jpg" width="100px"
                                style="background-image: url('/images/no-image.png') ; height:50px; width:47px;; border:1px solid black ; padding:3px; margin-bottom:10px;"
                                onerror="this.onerror=null; this.src='http://www.eimbox.com/images/no-image.png';" />
                        </div>
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><b><?php echo $stnamee; ?></b></h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">Class : <b><?php echo $cn; ?></b></div>
                                <div class="col-md-3">Section : <b><?php echo $secname; ?></b></div>
                                <div class="col-md-3">Roll No : <b><?php echo $rollno; ?></b></div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row d-block">
                        <?php
                        $tsheetid = 0;
                        $sql0 = "SELECT * FROM tabulatingsheet where sccode = '$sccode' and stid='$stid' and sessionyear='$sy' order by id  ;";
                        $result0rtt = $conn->query($sql0);
                        if ($result0rtt->num_rows > 0) {
                            while ($row0 = $result0rtt->fetch_assoc()) {
                                $tsheetid = $row0['id'];
                                $tsheetexam = $row0['exam'];

                                ?>
                                <button class="btn btn-inverse-primary p-2"
                                    onclick="showresult(<?php echo $tsheetid; ?>)"><?php echo $tsheetexam; ?></button>
                                <?php
                            }
                        } else {
                            echo 'Nothing Found';
                        }

                        echo '<div class="p-lg-2"></div>';


                        if ($tsheetid > 0) {
                            include 'std-result-progress.php';
                        }




                        ?>

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
        window.location.href = 'std-result.php?stid=' + x;
    }
</script>