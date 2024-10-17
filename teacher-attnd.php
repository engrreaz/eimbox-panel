<?php
include 'header.php';
$tid = $userid;
$grnametxt = '';
$qrc = '';




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

    <?php
    include 'teacher-header.php';

    if (isset($_GET['cls'])) {
        $cls2 = $_GET['cls'];
    } else {
        $cls2 = $clscls;
    }
    if (isset($_GET['sec'])) {
        $sec2 = $_GET['sec'];
    } else {
        $sec2 = $clssec;
    }
    if (isset($_GET['adate'])) {
        $adate = $_GET['adate'];
    } else {
        $adate = $td;
    }


    $period = 1;
    $datam = array("stid" => 0);
    $sql00 = "SELECT * FROM stattnd where  (adate='$adate' and sccode='$sccode' and sessionyear='$sy'  and classname = '$cls2' and sectionname='$sec2') or yn=100 order by rollno";
    $result00gt = $conn->query($sql00);
    if ($result00gt->num_rows > 0) {
        while ($row00 = $result00gt->fetch_assoc()) {
            $datam[] = $row00;
        }
    }

    $sql00 = "SELECT * FROM stattndsummery where  date='$adate' and sccode='$sccode' and sessionyear='$sy' and classname = '$cls2' and sectionname='$sec2'";
    $result00gtt = $conn->query($sql00);
    if ($result00gtt->num_rows > 0) {
        while ($row00 = $result00gtt->fetch_assoc()) {
            $rate = $row00["attndrate"];
            $subm = 1;
            $fun = 'grpssx0';
        }
    } else {
        $subm = 0;
        $fun = 'grpssx';
    }

    if ($period >= 2) {
        $fun = 'grpssx2';
    }


    ?>


    <style>
        .pic {
            width: 72px;
            width: 72px;
            border-radius: 50%;
        }

        .a {
            font-size: 16px;
            font-weight: bold;
        }

        .b {
            font-size: 13px;
        }

        .c {
            font-size: 10px;
            color: gray;
            padding-top: 20px;
        }
    </style>
    <h3 class="text-center"><b>Student's Attendance</b></h3>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="clsname">Class</label>
                            <select class="form-control text-white" id="cls" onchange="go();">
                                <option value=" ">---</option>
                                <?php
                                $sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear LIKE '$sy%' group by areaname order by idno;";
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
                        <div class="col-md-3">
                            <label for="secname">Section</label>
                            <select class="form-control text-white" id="sec" onchange="go();">
                                <option value="">---</option>
                                <?php
                                $sql0x = "SELECT subarea FROM areas where user='$rootuser' and sessionyear LIKE '$sy%' and areaname='$cls2' group by subarea order by idno;";
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
                        <div class="col-md-2">
                            <label for="date">Date</label>
                            <input type="date" class="form-control d-block" id="adate" value="<?php echo $adate; ?>"
                                onchange="go();" />
                        </div>
                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button class="btn btn-inverse-primary d-block p-2 pt-2" onchange="go();">View
                                Attendance</button>
                        </div>

                        <div class="col-md-2  ">
                            <div class="d-flex text-center m-0 p-0">
                                <div id="att" style="font-size:36px;"></div>  <div class="text-small pt-4"> / </div>
                            <div id="cnt" class="text-small pt-4"></div>
                            </div>
                            <span class="text-small m-0 p-0">Total Attendance</span>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>

    <?php if ($subm == 1) { ?>
        <tr>
            <td colspan="2">
                <div
                    style="text-align:center; font-size:14px; font-weight:400; font-style:italic; padding: 5px 10px; background:red; color:white; border-radius:15px;; border:1px solid white; ">
                    Attendance already submitted.</div>
            </td>
        </tr>
    <?php } ?>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php
                    $cnt = 0;
                    $found = 0;

                    $sql0 = "SELECT * FROM sessioninfo where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname = '$sec2' order by rollno ";
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


                            $pth = '../students/' . $stid . '.jpg';
                            if (file_exists($pth)) {
                                $pth = 'https://eimbox.com/students/' . $stid . '.jpg';
                            } else {
                                $pth = 'https://eimbox.com/students/noimg.jpg';
                            }

                            $sql00 = "SELECT * FROM students where  sccode='$sccode' and stid='$stid' LIMIT 1";
                            $result00 = $conn->query($sql00);
                            if ($result00->num_rows > 0) {
                                while ($row00 = $result00->fetch_assoc()) {
                                    $neng = $row00["stnameeng"];
                                    $nben = $row00["stnameben"];
                                    $vill = $row00["previll"];
                                }
                            }

                            $key = array_search($stid, array_column($datam, 'stid'));
                            if ($key != NULL || $key != '') {
                                $status = $datam[$key]['yn'];
                            } else {
                                $status = 0;
                            }


                            if ($status == 0) {
                                $bgc = '--light';
                                $dsbl = ' disabled';
                                $gip = '';
                                $found += 0;
                            } else {
                                $bgc = '--lighter';
                                $dsbl = '';
                                $gip = 'checked';
                                $found++;
                            }
                            ?>
                            <div class="card text-center"
                                onclick="<?php echo $fun; ?>(<?php echo $stid; ?>, <?php echo $rollno; ?>)"
                                id="block<?php echo $stid; ?>" <?php echo $dsbl; ?>>
                                <img class="card-img-top" alt="">
                                <div class="card-body">
                                    <table width="100%">
                                        <tr>
                                            <td style="padding-left:10px; width:50px;">

                                                <?php if ($period < 2) { ?>
                                                    <input style="scale:1.25; border:1px solid red;" class="form-control"   type="checkbox" name="darkmode" id="sta<?php echo $stid; ?>"  onchange="grpssx(<?php echo $stid; ?>, <?php echo $rollno; ?>);" <?php echo $gip; ?>>
                                                <?php } else { ?>
                                                    <input style="scale:2; border:1px solid black; " class="form-control"  type="checkbox" name="darkmodes" id="sta2<?php echo $stid; ?>"  onchange="grpssx2(<?php echo $stid; ?>, <?php echo $rollno; ?>);" <?php echo $gip; ?>>
                                                <?php } ?>
                                             
                                            </td>
                                            <td style="padding: 0 5px;"><span
                                                    style="font-size:24px; font-weight:700;"><?php echo $rollno; ?></span>
                                                <span style="">
                                                    <?php echo $qrc; ?>
                                                </span>
                                            </td>
                                            <td style="text-align:left; padding-left:5px;">
                                                <div class="a"><?php echo $neng; ?></div>
                                                <div class="b"><?php echo $nben; ?></div>
                                                <div class="c" style="font-weight:600; font-style:normal; color:gray;">ID #
                                                    <?php echo $stid . $grnametxt; ?>
                                                </div>
                                            </td>
                                            <td style="text-align:right;" id="">
                                                <div id="ut<?php echo $stid; ?>"></div>
                                            <img   src="<?php echo $pth; ?>" class="pic rounded-circle" /></td>
                                        </tr>
                                    </table>


                                </div>
                            </div>
                            <div class="card text-center sele gg"
                                style="background:var(<?php echo $bgc; ?>); display:none; color:var(--darker);"
                                id="blocksel<?php echo $dtid; ?>">

                            </div>

                            <?php
                            $cnt++;
                        }
                    }

                    if ($subm == 0) { ?>
                        <div class="card text-center" id="sfinal" style="padding:8px;"><button
                                style="padding15px; border-radius:5px;" class="btn btn-danger"
                                onclick="submitfinal();">Submit Attendance</button></div>
                    <?php } ?>


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

    function go() {
        // var exam = document.getElementById('exam').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        var adate = document.getElementById('adate').value;
        window.location.href = 'teacher-attnd.php?&cls=' + cls + '&sec=' + sec + '&adate=' + adate;
    }
</script>

<script>
    function att(id, roll, bl, per) {
        // alert(id + '/' + roll + '/' + bl + '/' + per);
        if (per >= 2) {
            var val = document.getElementById("sta2" + id).checked;
        } else {
            var val = document.getElementById("sta" + id).checked;
        }

        var infor = "stid=" + id + "&roll=" + roll + "&val=" + val + "&opt=2&cls=<?php echo $cls2; ?>&sec=<?php echo $sec2; ?>&per=" + per + "&adate=<?php echo $adate; ?>";
    //   alert(infor);
        $("#ut" + id).html("");

        $.ajax({
            type: "POST",
            url: "backend/teacher-savestattnd.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $("#ut" + id).html('<span class="chk blue"><i class="bi bi-server"></i></span>');
            },
            success: function (html) {
                $("#ut" + id).html(html);
            }
        });
    }

</script><script>
    function dtcng() {
        var ddd = document.getElementById("xp").value;
        window.location.href = 'stattnd.php?cls=<?php echo $classname; ?>&sec=<?php echo $sectionname; ?>&dt=' + ddd;
    }

    </script><script>

    function grpssx(id, roll) {
        var bl = document.getElementById("sta" + id).checked;

        var per = 1;
        var cnt = parseInt(document.getElementById("att").innerHTML) * 1;
        if (bl == true) {
            document.getElementById("sta" + id).checked = false;
            cnt--;
        } else {
            document.getElementById("sta" + id).checked = true;
            cnt++;
        }
       
        document.getElementById("att").innerHTML = cnt;
        att(id, roll, bl, per);
    }
</script><script>
    function grpssx2(id, roll) {

        var per = <?php echo $period; ?>;

        var bl = document.getElementById("sta2" + id).checked;
        var cnt = parseInt(document.getElementById("att").innerHTML) * 1;
        if (bl == true) {
            document.getElementById("sta2" + id).checked = false;
            cnt--;
        } else {
            document.getElementById("sta2" + id).checked = true;
            cnt++;
        }
        document.getElementById("att").innerHTML = cnt;
        att(id, roll, bl, per);
    }
</script>



<script>

    function more() {
        let val = document.getElementById("myswitch").checked;
        if (val == true) {
            $(".sele").show();
        } else {
            $(".sele").hide();
        }
    }

    function grp(id) {
        var val = document.getElementById("sel" + id).value;
        var infor = "dtid=" + id + "&val=" + val + "&opt=1";
        $("#blocksel" + id).html("");

        $.ajax({
            type: "POST",
            url: "grpupd.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $("#blocksel" + id).html('<span class=""><center>Fetching Section Name....</center></span>');
            },
            success: function (html) {
                $("#blocksel" + id).html(html);
            }
        });
    }

    function grpp(id) {
        var val = document.getElementById("sel" + id).value;
        var infor = "dtid=" + id + "&val=" + val + "&opt=1";
        $("#blocksel" + id).html("");

        $.ajax({
            type: "POST",
            url: "fourupd.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $("#blocksel" + id).html('<span class=""><center>Fetching Section Name....</center></span>');
            },
            success: function (html) {
                $("#blocksel" + id).html(html);
            }
        });
    }




    function grpss(id) {
        var val = document.getElementById("sta" + id).checked;
        var infor = "dtid=" + id + "&val=" + val + "&opt=3";
        $("#blocksel" + id).html("");

        $.ajax({
            type: "POST",
            url: "grpupd.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $("#blocksel" + id).html('<span class=""><center>Fetching Section Name....</center></span>');
            },
            success: function (html) {
                $("#blocksel" + id).html(html);
            }
        });
    }

    function submitfinal() {
        var fnd = parseInt(document.getElementById("att").innerHTML) * 1;
        var cnt = parseInt(document.getElementById("cnt").innerHTML) * 1;
        var infor = "cnt=" + cnt + "&fnd=" + fnd + "&opt=5&cls=<?php echo $cls2; ?>&sec=<?php echo $sec2; ?>&adate=<?php echo $adate; ?>";
        $("#sfinal").html("");
        $.ajax({
            type: "POST",
            url: "backend/teacher-savestattnd.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $("#sfinal").html('<span class="chk blue"><i class="bi bi-server"></i></span>');
            },
            success: function (html) {
                $("#sfinal").html(html);
            }
        });
    }
</script>

<script>
    document.getElementById("cnt").innerHTML = "<?php echo $cnt; ?>";
    document.getElementById("att").innerHTML = "<?php echo $found; ?>";

    function god(id) {
        window.location.href = "student.php?id=" + id;
    }  
</script>