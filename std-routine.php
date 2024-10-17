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


$sql0 = "SELECT * FROM sessioninfo where sccode = '$sccode'  and stid='$stid' and sessionyear='$sy' ;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $cn = $row0['classname'];
        $sec = $row0['sectionname'];
    }
} else {
    $datam[] = '';
}
// echo var_dump($datam);

$subname = array();
$sql0 = "SELECT * FROM subjects where ( sccode = '$sccode' or sccode=0)  ;";
$result0rt1 = $conn->query($sql0);
if ($result0rt1->num_rows > 0) {
    while ($row0 = $result0rt1->fetch_assoc()) {
        $subname[] = $row0;
    }
} else {
    $subname[] = '';
}

$tnames = array();
$sql0 = "SELECT * FROM teacher where sccode = '$sccode'   ;";
$result0rt2 = $conn->query($sql0);
if ($result0rt2->num_rows > 0) {
    while ($row0 = $result0rt2->fetch_assoc()) {
        $tnames[] = $row0;
    }
} else {
    $tnames[] = '';
}
$sch = array();
$sql0 = "SELECT * FROM classschedule where sccode = '$sccode' and sessionyear='$sy' order by period   ;";
$result0rt3 = $conn->query($sql0);
if ($result0rt3->num_rows > 0) {
    while ($row0 = $result0rt3->fetch_assoc()) {
        $sch[] = $row0;
    }
} else {
    $sch[] = '';
}

// echo var_dump($tnames);


if (isset($_GET['type'])) {
    $rtntype = $_GET['type'];
} else {
    $rtntype = '1';
}
if ($rtntype == '1') {
    $btntext = 'Whole Routine';
    $fnc = 2;
} else {
    $btntext = 'Individual Routine';
    $fnc = 1;
}

$std_right .= '<button class="btn btn-inverse-warning" onclick="cngroutine(' . $fnc . ');" >Show ' . $btntext . '</button>';
?>


<div id="wholeblock">



    <?php include 'std-header.php'; ?>
    <h3 class="text-center"><b>Class Routine</b></h3> 

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive  ">
                            <table class="table  table-stripe text-white">
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
                                    $dayday = array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                                    $dayno = date('N', strtotime($td)) + 1;
                                    // echo $dayno;
                                    if ($rtntype == '1') {
                                        $sql0 = "SELECT * FROM clsroutine where sccode = '$sccode' and sessionyear='$sy' and classname='$cn' and sectionname='$sec' and wday='$dayno' order by period, wday ;";
                                    } else {
                                        $sql0 = "SELECT * FROM clsroutine where sccode = '$sccode' and sessionyear='$sy' and classname='$cn' and sectionname='$sec' order by period, wday ;";
                                    }
                                    $result0rtrx = $conn->query($sql0);
                                    if ($result0rtrx->num_rows > 0) {
                                        while ($row0 = $result0rtrx->fetch_assoc()) {
                                            $period = $row0['period'];
                                            $wday = $row0['wday'];
                                            $subcode = $row0['subcode'];
                                            $tid = $row0['tid'];

                                            $ind = array_search($subcode, array_column($subname, 'subcode'));
                                            $ind2 = array_search($tid, array_column($tnames, 'tid'));
                                            $ind3 = array_search($period, array_column($sch, 'period'));

                                            ?>

                                            <tr>
                                                <td><?php echo $period . ' : <small>[' . $sch[$ind3]['timestart'] . ' - ' . $sch[$ind3]['timeend'] . ']</small>'; ?>
                                                </td>
                                                <td><?php echo $dayday[$wday]; ?></td>
                                                <td><?php echo $subname[$ind]['subject']; ?></td>
                                                <td><?php echo $tnames[$ind2]['tname']; ?></td>
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
    function refbook() {
        window.location.href = 'refbook.php';
    }
    function cngroutine(rnt) {
        window.location.href = 'std-routine.php?type=' + rnt;
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
        window.location.href = 'std-routine.php?stid=' + x;
    }
</script>