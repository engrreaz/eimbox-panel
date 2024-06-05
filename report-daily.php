<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;
$refno = '';
$refdate = date('Y-m-d');
// $refno = $_GET['ref'] ?? 0;
// $undef = $_GET['undef'] ?? 99;
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

<h3 class="d-print-none">Overall Daily Report @ <?php echo date('l, d F, Y'); ?> </h3>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Student's Dues Report - <?php echo $year; ?>
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
                                <select class="form-control text-white" id="sec" onchange="gox();">
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT subarea FROM areas where user='$rootuser' and sessionyear='$year' and areaname='$cls2' group by subarea order by idno;";
                                    echo $sql0x;
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
                            <label class="col-form-label pl-3">Section</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="exam">

                                    <!-- <option value="">---</option> -->
                                    <option value="Half-Yearly">Half-Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>






                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-primary btn-block" style="" onclick="go();"><i class="mdi mdi-eye"></i>
                                    Generate
                                    Card</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-info btn-block" style="" onclick="goprint();"><i
                                        class="mdi mdi-eye"></i> Print
                                    View</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

<div id="pad" style="display:none;">
    <div style="font-size:10px; font-style:italic;">
        <?php include ('assets/pad/temp-01.php'); ?>
    </div>
</div>

<div>

    <div class="row d-print-none">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div id="alladmit">

                        <head>
                            <style>
                                * {
                                    font-family: "Noto Sans Bengali", sans-serif;
                                }

                                #main-table td , #hr-attnd-table td, .border-table td{
                                    border: 1px solid black;
                                }

                                .txt-right {
                                    text-align: center;
                                    font-weight: bold;
                                    font-size: 14px;
                                    padding: 5px;
                                }

                                @media print {

                                    .d-print-nones,
                                    #nono {
                                        display: none;
                                    }
                                }
                            </style>
                        </head>



                        <h4>HRD - Attendance</h4>
                        <table style="width:100%; border:1px solid black; border-collapse:collapse;"
                            class="table table-bordered border-table" id="hr-attnd-table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Teachers/Staffs</td>
                                    <td>Intime</td>
                                    <td>Out time</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 2; $i++) { ?>
                                    <tr>
                                        <td>1</td>
                                        <td>Teachers Name</td>
                                        <td>09:07:25</td>
                                        <td>16:12:21</td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>


                        <h4 class="mt-4">Students - Attendance</h4>
                        <table style="width:100%; border:1px solid black; border-collapse:collapse;"
                            class="table table-bordered border-table" id="hr-attnd-table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Teachers/Staffs</td>
                                    <td>Intime</td>
                                    <td>Out time</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 2; $i++) { ?>
                                    <tr>
                                        <td>1</td>
                                        <td>Teachers Name</td>
                                        <td>09:07:25</td>
                                        <td>16:12:21</td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>

                        <h4 class="mt-4">Students - Collection</h4>
                        <table style="width:100%; border:1px solid black; border-collapse:collapse;"
                            class="table table-bordered border-table" id="hr-attnd-table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Teachers/Staffs</td>
                                    <td>Intime</td>
                                    <td>Out time</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 2; $i++) { ?>
                                    <tr>
                                        <td>1</td>
                                        <td>Teachers Name</td>
                                        <td>09:07:25</td>
                                        <td>16:12:21</td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>

                        
                        <h4 class="mt-4">Income - Expenditure</h4>
                        <table style="width:100%; border:1px solid black; border-collapse:collapse;"
                            class="table table-bordered border-table" id="hr-attnd-table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Teachers/Staffs</td>
                                    <td>Intime</td>
                                    <td>Out time</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 2; $i++) { ?>
                                    <tr>
                                        <td>1</td>
                                        <td>Teachers Name</td>
                                        <td>09:07:25</td>
                                        <td>16:12:21</td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>


                        <h4 class="mt-4">Bank Details</h4>
                        <table style="width:100%; border:1px solid black; border-collapse:collapse;"
                            class="table table-bordered border-table" id="hr-attnd-table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Teachers/Staffs</td>
                                    <td>Intime</td>
                                    <td>Out time</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 2; $i++) { ?>
                                    <tr>
                                        <td>1</td>
                                        <td>Teachers Name</td>
                                        <td>09:07:25</td>
                                        <td>16:12:21</td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>

                        <h4 class="mt-4">Log & Data Tracking</h4>
                        <table style="width:100%; border:1px solid black; border-collapse:collapse;"
                            class="table table-bordered border-table" id="hr-attnd-table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Teachers/Staffs</td>
                                    <td>Intime</td>
                                    <td>Out time</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 2; $i++) { ?>
                                    <tr>
                                        <td>1</td>
                                        <td>Teachers Name</td>
                                        <td>09:07:25</td>
                                        <td>16:12:21</td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>














                        <div style="text-align: center;">
                            Class : <b><?php echo $cls2; ?></b>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-:|:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Section : <b><?php echo $sec2; ?></b>
                            <hr style="width:75%" />
                        </div>

                        <table style="width:100%; border:1px solid black; border-collapse:collapse;"
                            class="table table-bordered" id="main-table">
                            <thead>
                                <tr>
                                    <td class="txt-right">Roll</td>
                                    <td class="txt-right">Name of Student</td>
                                    <td class="txt-right">Dues</td>
                                    <td class="txt-right" style="width:100px;">Pay Amount</td>
                                    <td class="txt-right" style="width:120px;">Date</td>
                                </tr>
                            </thead>

                            <tbody>



                                <?php
                                $cnt = 0;
                                $cntamt = 0;
                                $sql0 = "SELECT * FROM sessioninfo where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname = '$sec2' order by rollno LIMIT 5";
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
                                                echo str_replace($enum, $bnum, $rl);
                                                ?>
                                            </td>
                                            <td style="padding : 3px 10px;"><?php echo $nben; ?></td>
                                            <td style="text-align:right; padding : 3px 5px;" class="text-right">
                                                <?php
                                                $tt = number_format($totaldues, 2, ".", ",");
                                                // echo $tt;
                                                echo str_replace($enum, $bnum, $tt);
                                                ?>

                                            </td>
                                            <td></td>
                                            <td></td>
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








    <?php
    include 'footer.php';
    ?>

    <script>
        var uri = window.location.href;
        function reload() {
            window.location.href = uri;
        }
        function goprint() {
            var txt = document.getElementById("alladmit").innerHTML;
            var pad = document.getElementById("pad").innerHTML;
            document.write('<title>Eimbox</title>');
            document.write('<div class="d-print-nones" id="nono"><button style="z-index:9999; position:fixed; right:100px; top:50px; background: black;; color:white; padding:5px; border-radius:5px;"  onclick="reload();">Back to Dues List</button></div>');
            document.write('<div id="margin" style="padding: 0mm 20mm;"></div>');
            // document.write(pad);
            document.getElementById("margin").innerHTML = pad + txt;
            // document.write(txt);
        }


        function go() {
            var year = document.getElementById('year').value;
            var cls = document.getElementById('cls').value;
            var sec = document.getElementById('sec').value;
            var exam = document.getElementById('exam').value;
            window.location.href = 'report-daily.php?&cls=' + cls + '&sec=' + sec + '&exam=' + exam + '&year=' + year;
        }

    </script>