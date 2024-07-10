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
} else {
    $hrtype = 'teacher';
}

if ($hrtype == 'teacher' || $hrtype == 'Teacher') {
    $rnk = '<';
} else {
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
    <code>Reports <i class="mdi mdi-arrow-right"></i> Teacher's List </code>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row d-print-none" id="ren">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div style="float:right;">
                            <button type="button" onclick="" class="btn btn-outline-danger" disabled>Inactive
                                <?php echo $hrtype; ?>(s)</button>
                        </div>
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
                    <div class="table-responsive">
                        <table class="table table-striped "
                            style=" border:1px solid gray !important; border-collapse:collapse;">
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


                                $deld = "DELETE FROM teacher where sccode='$sccode' and gender='undefi'";
                                $conn->query($deld);

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
                                                $tpath = $BASE__PATH . "/teacher/" . $tid . ".jpg";
                                                
                                                $file_headers = @get_headers($tpath);
                                                if ($file_headers[0] == 'HTTP/1.1 404 Not Found') {
                                                    $tpath = $BASE__PATH . "/teacher/no-img.jpg";
                                                }


                                                //  $tpath = $BASE__PATH . "/teacher/no-img.jpg";
                                        
                                                // if (file_exists($tpath)==FALSE) {
                                                //     $tpath = $BASE__PATH . "/teacher/no-img.jpg";
                                                // }

                                                ?>
                                                <img src="<?php echo $tpath; ?>"
                                                    style="width:30px; height:30px; border-radius:50%;">

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
                                                <div class="ooo"><?php echo $mobile; ?></div>
                                                <div class="ooo"><?php echo $email; ?></div>
                                            </td>

                                            <td style=" border:1px solid gray;">
                                                <div id="btn<?php echo $stid; ?>">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" title="View Profile"
                                                            class="btn btn-inverse-warning"
                                                            onclick="issuet(<?php echo $tid; ?>)">
                                                            <i class="mdi mdi-television"></i>
                                                        </button>

                                                        <button type="button" title="Edit Profile" class="btn btn-inverse-info"
                                                            onclick="issue(<?php echo $tid; ?>)">
                                                            <i class="mdi mdi-grease-pencil"></i>
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
    document.getElementById('defbtn').innerHTML = 'Add New Teacher/Staff';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        addnew();
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
    function addnew() {
        var infor = "hrt=<?php echo $hrtype; ?>";

        $("#defbtn").html("");
        $.ajax({
            type: "POST",
            url: "backend/add-new-hr.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#defbtn').html('Waiting...');
            },
            success: function (html) {
                $("#defbtn").html(html);
                var tid = document.getElementById('defbtn').innerHTML;
                window.location.href = 'hr-edit.php?tid=' + tid;
            }
        });
    }
</script>