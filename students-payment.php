<?php
include 'header.php';


$refno = '';
$refdate = date('Y-m-d');

if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date('Y');
}

if (isset($_GET['cls'])) {
    $cls2 = $_GET['cls'];
} else {
    $cls2 = '';
}
if (isset($_GET['sec'])) {
    $sec2 = $_GET['sec'];
} else {
    $sec2 = '';
}
if (isset($_GET['exam'])) {
    $exam2 = $_GET['exam'];
} else {
    $exam2 = '';
}

$col = 3;
$status = 0;

if (isset($_GET['addnew'])) {
    $newblock = 'block';
    $exid = $_GET['addnew'];
    if ($exid == '') {
        $exid = 0;
    }
} else {
    $newblock = 'none';
    $exid = 0;
}



?>

<h3 class="d-print-none">Student's List</h3>
<p class="d-print-none">
    <code>Reports <i class="mdi mdi-arrow-right"></i> Students List </code>
</p>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                </h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Year</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="year">
                                    <option value="0"></option>
                                    <?php
                                    for ($y = date('Y'); $y >= 2024; $y--) {
                                        $flt2 = '';
                                        if ($year == $y) {
                                            $flt2 = 'selected';
                                        }
                                        echo '<option value="' . $y . '"' . $flt2 . '>' . $y . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class :</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="cls" onchange="go();">
                                    <option value=" ">---</option>
                                    <?php
                                    $sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear='$year' group by areaname order by idno;";
                                    $result0x = $conn->query($sql0x);
                                    if ($result0x->num_rows > 0) {
                                        while ($row0x = $result0x->fetch_assoc()) {
                                            $cls = $row0x["areaname"];
                                            if ($cls == $cls2) {
                                                $selcls = 'selected';
                                            } else {
                                                $selcls = '';
                                            }
                                            echo '<option value="' . $cls . '" ' . $selcls . ' >' . $cls . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Section</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="sec" onchange="go();">
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT subarea FROM areas where user='$rootuser' and sessionyear='$year' and areaname='$cls2' group by subarea order by idno;";
                                    // echo $sql0x;
                                    $result0r = $conn->query($sql0x);
                                    if ($result0r->num_rows > 0) {
                                        while ($row0x = $result0r->fetch_assoc()) {
                                            $sec = $row0x["subarea"];
                                            if ($sec == $sec2) {
                                                $selsec = 'selected';
                                            } else {
                                                $selsec = '';
                                            }
                                            echo '<option value="' . $sec . '" ' . $selsec . ' >' . $sec . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-outline-success btn-icon-text btn-block" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Generate
                                    Card</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               
                            <div class="form-group row">
                                <div class="col-12 ">
                                    <div class="tabel-responsive">
                                        <table style=""
                                            class="table table-stripe">
                                            <thead>
                                                <tr>
                                                    <td class="txt-right">Roll</td>
                                                    <td class="txt-right">Name of Student</td>
                                                    <td class="txt-right">Dues</td>
                                                    <td class="txt-right"></td>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $cnt = 0;
                                                $cntamt = 0;
                                                $sql0 = "SELECT * FROM sessioninfo where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname = '$sec2' order by rollno";
                                                $result0 = $conn->query($sql0);
                                                if ($result0->num_rows > 0) {
                                                    while ($row0 = $result0->fetch_assoc()) {
                                                        $stid = $row0["stid"];
                                                        $rollno = $row0["rollno"];
                                                        $card = $row0["icardst"];
                                                        $dtid = $row0["id"];
                                                        $status = $row0["status"];
                                                        $rel = $row0["religion"];
                                                        $four = $row0["fourth_subject"];

                                                        $sql00 = "SELECT * FROM students where  sccode='$sccode' and stid='$stid' LIMIT 1";
                                                        $result00 = $conn->query($sql00);
                                                        if ($result00->num_rows > 0) {
                                                            while ($row00 = $result00->fetch_assoc()) {
                                                                $neng = $row00["stnameeng"];
                                                                $nben = $row00["stnameben"];
                                                                $vill = $row00["previll"];
                                                            }
                                                        }

                                                        //if($card == '1'){$qrc = '<img src="https://chart.googleapis.com/chart?chs=20x20&cht=qr&chl=http://www.students.eimbox.com/myinfo.php?id=5000&choe=UTF-8&chld=L|0" />';} else {$qrc = '';}
                                                
                                                        $month = date('m');
                                                        $sql0 = "SELECT sum(dues) as dues, sum(payableamt) as paya, sum(paid) as paid FROM stfinance where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname='$sec2' and month<='$month' and stid='$stid'";
                                                        $result01x = $conn->query($sql0);
                                                        if ($result01x->num_rows > 0) {
                                                            while ($row0 = $result01x->fetch_assoc()) {
                                                                $totaldues = $row0["dues"];
                                                                $tpaya = $row0["paya"];
                                                                $tpaid = $row0["paid"];
                                                            }
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td style="text-align:center; padding : 3px 5px;" class="">
                                                                <?php
                                                                $rl = $rollno;
                                                                echo $rl; //str_replace($enum, $bnum, $rl);
                                                                ?>
                                                            </td>
                                                            <td style="padding : 3px 10px;"><?php echo $nben; ?></td>
                                                            <td style="text-align:right; padding : 3px 5px;" class="text-right">
                                                                <?php
                                                                $tt = number_format($totaldues, 2, ".", ",");
                                                                // echo $tt;
                                                                echo $tt;//str_replace($enum, $bnum, $tt);
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <bttton class="btn btn-inverse-primary"
                                                                    onclick="getdues(<?php echo $stid; ?>);"><i
                                                                        class="mdi mdi-television"></i></bttton>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $cnt++;
                                                        $cntamt = $cntamt + $totaldues;
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


    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row-12" id="getdata">
                    dddd
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
    document.getElementById('defbtn').innerHTML = 'Print Testimonials';
    function defbtn() {
        goprint(0);
    }
    function reload() {
        window.location.href = uri;
    }
    function resultentry(roll) {
        if (roll == 0) {
            document.getElementById('boardroll').value = '';
        } else {
            document.getElementById('boardroll').value = roll;
        }

        document.getElementById('ren').style.display = 'block';
        document.getElementById('boardroll').focus();
    }

    function goprint(stid) {
        var year = document.getElementById('year').value;
        var sec = document.getElementById('sec').value;
        var exam = document.getElementById('exam').value;
        window.location.href = 'testimonial-print.php?sec=' + sec + '&exam=' + exam + '&year=' + year + '&stid=' + stid;
    }

    function go() {
        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        window.location.href = 'students-payment.php?&cls=' + cls + '&sec=' + sec + '&year=' + year;
    }
</script>

<script>
    function issue(stid) {
        window.location.href = 'students-edit.php?stid=' + stid;
    }
    function issuet(stid) {
        window.location.href = 'student-profile.php?stid=' + stid;
    }
</script>

<script>
    function getdues(stid) {
            var infor = "stid=" + stid;

            $("#getdata").html("");

            $.ajax({
                type: "POST",
                url: "backend/fetch-indivisual-dues.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#getdata').html('<small>Processing...</small>');
                },
                success: function (html) {
                    $("#getdata").html(html);
                }
            });

    }


</script>