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



$f_date = $sy . '-01-01';
$l_date = $sy . '-12-31';
$datam = array('category' => 'blank');
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

$stattnd = array('yn' => 0);
$sql0 = "SELECT * FROM stattnd where sccode = '$sccode' and stid='$stid' and period1=1 order by adate; ;";
$result0rtr = $conn->query($sql0);
if ($result0rtr->num_rows > 0) {
    while ($row0 = $result0rtr->fetch_assoc()) {
        $stattnd[] = $row0;
    }
} else {
    $stattnd[] = '';
}


$sql0 = "SELECT count(DISTINCT  adate) as wdd FROM stattnd where sccode = '$sccode' and  sessionyear='$sy'   ;";
// echo $sql0;
$result0rtn121 = $conn->query($sql0);
if ($result0rtn121->num_rows > 0) {
  while ($row0 = $result0rtn121->fetch_assoc()) {
    $www = $row0['wdd'];
  }
}
$sql0 = "SELECT count(yn) as wd FROM stattnd where sccode = '$sccode' and  sessionyear='$sy' and stid='$userid'  ;";
$result0rtn122 = $conn->query($sql0);
if ($result0rtn122->num_rows > 0) {
  while ($row0 = $result0rtn122->fetch_assoc()) {
    $ppp = $row0['wd'];
  }
}

$rrr = ($ppp * 100 / $www);
$rate = ($ppp * 100 / $www) * 3.6;






$std_right .= '<small>Attendance Summery<br>from <b>01-01-2024</b> to <b> ' . date('d-m-Y', strtotime($td)) . '</b></small>';
$std_right .= '<br><br><small>Total Working days : ' . $www . '  Days.<br>';
$std_right .= 'Present / Absent : ' . $ppp . ' / ' . $www-$ppp . ' Days.<br>';
$std_right .= 'Attnd Rate : ' . $rrr . ' .</small>';
?>



<div id="wholeblock">
    <?php include 'std-header.php'; ?>

    <h3 class="text-center">Attendance Report</h3>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row ">
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            $ccu = $sy . '-' . $i . '-01';
                            $ccu2 = date('Y-m-t', strtotime($ccu));
                            $rrr = $rate = 0;

                            $sql0 = "SELECT count(DISTINCT  adate) as wdd FROM stattnd where sccode = '$sccode' and  sessionyear='$sy' and adate between '$ccu' and '$ccu2'  ;";
                            // echo $sql0;
                            $result0rtn121 = $conn->query($sql0);
                            if ($result0rtn121->num_rows > 0) {
                                while ($row0 = $result0rtn121->fetch_assoc()) {
                                    $www = $row0['wdd'];
                                }
                            }
                            $sql0 = "SELECT count(yn) as wd FROM stattnd where sccode = '$sccode' and  sessionyear='$sy' and stid='$stid'  and adate between '$ccu' and '$ccu2'   ;";
                            $result0rtn122 = $conn->query($sql0);
                            if ($result0rtn122->num_rows > 0) {
                                while ($row0 = $result0rtn122->fetch_assoc()) {
                                    $ppp = $row0['wd'];
                                }
                            }
                            if ($www > 0) {
                                $rrr = ($ppp * 100 / $www);
                                $rate = ($ppp * 100 / $www) * 3.6;
                            }




                            ?>
                            <div class="col-lg-1 col-md-3 col-sm-6">
                                <div class="outer-ring-att" id="attnd" style="background-image: conic-gradient(#52be80  0deg, #52be80 <?php echo $rate; ?>deg, #FFBF00 <?php echo $rate; ?>deg);">
                                    <div class="inner-ring-att">
                                        <div class="inner-text-att text-warning">
                                            <b><?php echo number_format($rrr, 2); ?></b><small> %</small>
                                            <br>
                                            <span class="text-white"><b><?php echo date('M', strtotime($ccu)); ?></b></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <?php
                        $yny = $ynn = $hod = $wds = 0;
                        for ($m = 1; $m <= 12; $m++) {
                            $month = date("F", mktime(0, 0, 0, $m + 1, 0));
                            ?>

                            <div class="col-md-6 text-small">
                                <div class="form-group row">
                                    <label class="col-form-label pl-3"></label><?php echo $month . ' / ' . $sy; ?></label>
                                    <div class="col-12">
                                        <?php

                                        $firstday = date("w", mktime(0, 0, 0, $m, 0, $sy));
                                        $last = date("t", mktime(0, 0, 0, $m + 1, 0, $sy));

                                        echo '<table class="table table-responsivex">';
                                        echo '<thead><tr><td>S</td><td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td></tr></thead>';
                                        for ($j = 0; $j < 6; $j++) {
                                            echo '<tr>';
                                            for ($k = 0; $k < 7; $k++) {
                                                echo '<td>';
                                                if ($firstday == 6) {
                                                    $extd = 7;
                                                } else {
                                                    $extd = 0;
                                                }
                                                $trk = $j * 7 + $k - $firstday + $extd;
                                                if ($trk >= 1 && $trk <= $last) {

                                                    $mkdate = $sy . '-' . str_pad($m, 2, '0', STR_PAD_LEFT) . '-' . str_pad($trk, 2, '0', STR_PAD_LEFT);
                                                    $ind = array_search($mkdate, array_column($datam, 'date'));
                                                    $ind2 = array_search($mkdate, array_column($stattnd, 'adate'));
                                                    $bgc = 'muted';
                                                    if ($k == 5 || $k == 6) {
                                                        $bgc = 'danger';
                                                        $wds++;
                                                    } else {
                                                        if ($ind != '') {
                                                            if ($datam[$ind]['category'] == 'Holiday') {
                                                                $bgc = 'danger';
                                                                $hod++;
                                                            } else if ($datam[$ind]['category'] == 'Events') {
                                                                $bgc = 'Primary';
                                                            } else if ($datam[$ind]['category'] == 'Festival') {
                                                                $bgc = 'Primary';
                                                            }


                                                        } else {
                                                            if (strtotime($mkdate) <= strtotime($td)) {
                                                                if ($ind2 != '') {
                                                                    $bgc = 'success';
                                                                    $yny++;
                                                                } else {
                                                                    $bgc = 'warning';
                                                                    $ynn++;
                                                                }
                                                            }

                                                        }
                                                    }





                                                    echo '<div style="width:24px; text-align:center;" class="bg-' . $bgc . ' p-1 rounded text-white">' . $trk . '</div>';
                                                    // echo '<br>' . $datam[$ind]['descrip'];
                                                }
                                                echo '</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        echo '</table>';

                                        ?>

                                    </div>
                                </div>
                            </div>

                        <?php }
                        echo $yny . '/' . $ynn . '/' . $hod . '/' . $wds; ?>

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
        window.location.href = 'std-attnd.php?stid=' + x;
    }
</script>