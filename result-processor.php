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
    $cls2 = 'Ten';
}
if (isset($_GET['sec'])) {
    $sec2 = $_GET['sec'];
} else {
    $sec2 = 'Science';
}
if (isset($_GET['exam'])) {
    $exam2 = $_GET['exam'];
} else {
    $exam2 = 'Half Yearly';
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

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet">

<style>
    #full-text {

        font-family: "Source Code Pro", monospace;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: italic;

    }
</style>


<h3 class="d-print-none">Data Validating Tool</h3>
<p class="d-print-none">
    <code>Reports <i class="mdi mdi-arrow-right"></i> Students List </code>
</p>



<div class="row d-print-none" id="ren">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div id="countus"></div>
                        <button class="btn btn-inverse-primary p-2 m-2" onclick="checknow();">Check Now</button>




                        <button class="btn btn-inverse-danger p-2 m-2" onclick="combine();">Combined</button>
                        <button class="btn btn-inverse-danger p-2 m-2" onclick="meritcalc();">Merit</button>



                        <div class="text-small mt-2" id="run-text">
                            <div id="totaltotal"></div>

                        </div>

                    </div>
                    <div class="col-12 mt-3 text-small" style="font-style:italic;;" id="full-text">

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
        window.location.href = 'students-list.php?&cls=' + cls + '&sec=' + sec + '&year=' + year;
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
    function combine() {
        var infor = "year=<?php echo $year; ?>&cls=<?php echo $cls2; ?>&sec=<?php echo $sec2; ?>&exam=<?php echo $exam2; ?>";
        $("#run-text").html("");
        $.ajax({
            type: "POST",
            url: "backend/result-combined.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#run-text').html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#run-text").html(html);
                var cnt = parseInt(document.getElementById("totaltotal").innerHTML);
                document.getElementById("countus").innerHTML = cnt;

                var fulltext = document.getElementById("full-text").innerHTML;
                var runtext = document.getElementById("run-text").innerHTML;
                document.getElementById("full-text").innerHTML = runtext + fulltext;


                console.log(cnt + ' Remaing...');

                if (cnt > 0) {
                    checknow();
                } else {
                    document.getElementById("run-text").innerHTML = 'Done. Complete';
                }
            }
        });
    }


    function meritcalc() {
        var infor = "year=<?php echo $year; ?>&cls=<?php echo $cls2; ?>&sec=<?php echo $sec2; ?>&exam=<?php echo $exam2; ?>";
        $("#run-text").html("");
        $.ajax({
            type: "POST",
            url: "backend/result-merit-calc.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#run-text').html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#run-text").html(html);
                var cnt = parseInt(document.getElementById("totaltotal").innerHTML);
                document.getElementById("countus").innerHTML = cnt;

                var fulltext = document.getElementById("full-text").innerHTML;
                var runtext = document.getElementById("run-text").innerHTML;
                document.getElementById("full-text").innerHTML = runtext + fulltext;


                console.log(cnt + ' Remaing...');

                if (cnt > 0) {
                   checknow();
                } else {
                    document.getElementById("run-text").innerHTML = 'Done. Complete';
                }
            }
        });
    }
</script>