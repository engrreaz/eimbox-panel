<?php
include 'header.php';


// $refno = '';
// $refdate = date('Y-m-d');

// if (isset($_GET['year'])) {
//     $year = $_GET['year'];
// } else {
//     $year = date('Y');
// }

// if (isset($_GET['cls'])) {
//     $cls2 = $_GET['cls'];
// } else {
//     $cls2 = '';
// }
// if (isset($_GET['sec'])) {
//     $sec2 = $_GET['sec'];
// } else {
//     $sec2 = '';
// }


if (isset($_GET['hr'])) {
    $hrtype = $_GET['hr'];
    $rnk = '<';
} else {
    $hrtype = 'teacher';
    $rnk = '>';
}

if (isset($_GET['tp'])) {
    $tp = $_GET['tp'];
} else {
    $tp = 'all';
}




?>

<h3 class="d-print-none">Human Resource (<?php echo $hrtype; ?>)</h3>
<p class="d-print-none">
    <code>Reports <i class="mdi mdi-arrow-right"></i> Students List </code>
</p>





<div class="row d-print-none" id="ren">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div id="alladmit">

                        <head>
                            <style>
                                * {
                                    font-family: "Noto Sans Bengali", sans-serif;
                                }

                                #main-table td {
                                    border: 1px solid black;
                                }

                                .txt-right {
                                    text-align: center;
                                    font-weight: bold;
                                    font-size: 14px;
                                    padding: 5px;
                                    border: 1px solid gray !important;
                                }

                                .ooo {
                                    padding: 3px 0;
                                }

                                @media print {

                                    .d-print-nones,
                                    #nono {
                                        display: none;
                                    }
                                }
                            </style>
                        </head>
                        <div style="text-align: left;">
                            <button type="button" onclick="go('all')" class="btn btn-primary">All</button>
                            <?php
                            $sql5 = "SELECT * FROM slots where  sccode='$sccode' order by id ";
                            $result7 = $conn->query($sql5);
                            if ($result7->num_rows > 0) {
                                while ($row5 = $result7->fetch_assoc()) {
                                    $slotname = $row5["slotname"];
                                    ?>
                                    <button type="button" onclick="go('<?php echo $slotname; ?>')"
                                        class="btn btn-inverse-warning"><?php echo $slotname; ?></button>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<table class="table table-bordered table-striped " style=" border:1px solid gray !important; border-collapse:collapse;"
    id="main-table">
    <thead>
        <tr>
            <td class="txt-right">#</td>
            <td class="txt-right">Name of Teachers</td>
            <td class="txt-right">Position</td>
            <td class="txt-right">MPO Index</td>
            <td class="txt-right">Mobile | Email</td>
            <td class="txt-right"></td>
        </tr>
    </thead>

    <tbody>



        <?php
        $cnt = 0;
        $cntamt = 0;
        if ($tp == 'all') {
            $sql0 = "SELECT * FROM teacher where sccode='$sccode'  and ranks $rnk 50  order by ranks, sl";
        } else {
            $sql0 = "SELECT * FROM teacher where sccode='$sccode'  and ranks $rnk 50 and slots='$tp' order by ranks, sl";
        }
        $result0 = $conn->query($sql0);
        if ($result0->num_rows > 0) {
            while ($row0 = $result0->fetch_assoc()) {
                $tid = $row0["tid"];
                $neng = $row0["tname"];
                $nben = $row0["tnameb"];
                $position = $row0["position"];
                $ranks = $row0["ranks"];
                $mobile = $row0["mobile"];
                $email = $row0["email"];
                $mpoindex = $row0["mpoindex"];
                ?>
                <tr>
                    <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                        <?php
                        $tpath = "../teacher/" . $tid . ".jpg";
                        if (!file_exists($tpath)) {
                            $tpath = "../teacher/no-img.jpg";
                        }
                        ?>
                        <img src="<?php echo $tpath; ?>" style="width:30px; height:30px; border-radius:50%;">

                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><small><?php echo $tid; ?></small></div>
                        <div class="ooo"><?php echo $neng; ?></div>
                        <div class="ooo"><?php echo $nben; ?></div>
                    </td>

                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $position; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $mpoindex; ?></div>
                    </td>
                    <td style="padding : 3px 10px; border:1px solid gray;">
                        <div class="ooo"><?php echo $mobile ; ?></div>
                        <div class="ooo"><?php echo  $email; ?></div>
                    </td>

                    <td style=" border:1px solid gray;">
                        <div id="btn<?php echo $stid; ?>">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" title="Edit Profile" class="btn btn-inverse-info" onclick="issue(<?php echo $tid; ?>)">
                                    <i class="mdi mdi-grease-pencil"></i>
                                </button>
                                <button type="button"  title="View Profile" class="btn btn-inverse-warning" onclick="issuet(<?php echo $tid; ?>)">
                                    <i class="mdi mdi-television"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

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

    function go(datam) {
        window.location.href = 'hr-list.php?hr=<?php echo $hrtype; ?>&tp=' + datam;
    }
</script>

<script>
    function issue(tid) {
        window.location.href = 'hr-edit.php?tid=' + tid;
    }
    function issuet(tid) {
        window.location.href = 'hr-profile.php?tid=' + tid;
    }
</script>

<script>
    function fetchs(e) {
        if (e.key == 'Enter') {
            var br = document.getElementById("boardroll").value;
            var infor = "br=" + br;

            $("#sscspan").html("");

            $.ajax({
                type: "POST",
                url: "backend/fetch-board-roll.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#sscspan').html('<small>Processing...</small>');
                },
                success: function (html) {
                    $("#sscspan").html(html);
                    var st = document.getElementById("sscspan").innerHTML;

                    if (st == 'Something went wrong.') {
                        document.getElementById("sscspan").innerHTML = '<code>' + st + '</code><br>Data Missing or Multiple Entry Found.';
                    } else {
                        document.getElementById("stname").value = st;
                        document.getElementById("sscspan").innerHTML = '';
                        document.getElementById("gpagla").focus();
                    }
                }
            });
        }
    }

    function svs(e) {
        if (e.key == 'Enter') {
            savessc();
        }
    }

    function savessc() {
        var br = document.getElementById("boardroll").value;
        var gpgl = document.getElementById("gpagla").value;
        var infor = "br=" + br + "&gpgl=" + gpgl;

        $("#sscspan").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-board-result.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sscspan').html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#sscspan").html(html);
                var st = parseInt(document.getElementById("boardroll").value) + 1;
                document.getElementById("boardroll").value = st;
                document.getElementById("gpagla").value = '';
                document.getElementById("boardroll").focus();

            }
        });
    }
</script>