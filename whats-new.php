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

<h3 class="d-print-none text-warning"> <i class="mdi mdi-help-circle mdi-36px"></i> What's New?</h3>



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
                    <div class="col-12 p-4">

                        <?php
                        if($admin == 0){
                            $sql5 = "SELECT * FROM whatsnew  where id > '$whatsnew' and alert=1 order by id DESC ";
                        } else {
                            $sql5 = "SELECT * FROM whatsnew  where id > '$whatsnew' order by id DESC ";
                        }
                        
                        $result7 = $conn->query($sql5);
                        if ($result7->num_rows > 0) {
                            while ($row5 = $result7->fetch_assoc()) {
                                $title = $row5["title"];
                                $descrip = $row5["descrip"];
                                $type = $row5["type"];
                                $icon = $row5["icon"];
                                $link = $row5["link"];
                                $lnkcolor = $row5["lnkcolor"];
                                $updtime = $row5["updatetime"];
                                $ago = strtotime($cur) - strtotime($updtime);
                                if ($ago > 3600 * 24 * 7) {
                                    $agotext = round($ago / (3600 * 24 * 7)) . ' Week(s) ';
                                } else if ($ago > 3600 * 24) {
                                    $agotext = round($ago / (3600 * 24)) . ' Day(s) ';
                                } else if ($ago > 3600) {
                                    $agotext = round($ago / (3600)) . ' Hour(s) ';
                                } else if ($ago > 60) {
                                    $agotext = round($ago / (60)) . ' Min(s) ';
                                } else {
                                    $agotext = $ago . ' Sec(s) ';
                                }
                                $agotext .= ' ago';

                                ?>
                                <div class="d-flex mb-3">
                                    <i class="mdi mdi-<?php echo $icon; ?> text-<?php echo $lnkcolor; ?> mdi-24px"></i>
                                    <div class="d-block p-2 flex-lg-fill ">
                                        <h5 class="mt-1 mb-0 text-<?php echo $lnkcolor; ?> "><?php echo $title; ?></h5>
                                        <h6 class="m-0 mb-1 text-muted"><small><?php echo $descrip; ?></small></h6>
                                        <sma1ll>
                                            <span class="float-right text-muted"><small><?php echo $agotext; ?></small></span>
                                            <a class="btn btn-inverse-<?php echo $lnkcolor; ?>"
                                                href="<?php echo $link; ?>"><small>Jump to...</small></a>
                                        </sma1ll>
                                    </div>
                                </div>
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