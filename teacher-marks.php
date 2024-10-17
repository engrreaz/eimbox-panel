<?php
include 'header.php';
$tid = $userid;
$lock = 0;

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
if (isset($_GET['sub'])) {
    $sub2 = $_GET['sub'];
} else {
    $sub2 = '';
}

$subj_full = $obj_full = $pra_full = $ca_full = $fullmark = 0;
$sname = '';

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



$marks = array('stid' => '0');
$ex = $exam2;
$sql00x = "SELECT * FROM stmark where  sccode='$sccode' and exam LIKE '$ex%' and classname='$cls2' and sectionname='$sec2' and sessionyear='$sy' and subject ='$sub2' order by stid";
$result00xx = $conn->query($sql00x);
if ($result00xx->num_rows > 0) {
    while ($row00x = $result00xx->fetch_assoc()) {
        $marks[] = $row00x;
    }
}

?>

<style>
    .pic {
        width: 48px;
        width: 48px;
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

    #main th,
    #main td {
        border-bottom: 1px solid white;
    }

    #main th {
        position: sticky;
    }
</style>
<div id="wholeblock">



    <?php include 'teacher-header.php'; ?>

    <h3 class="text-center"><b>Marks Entry</b></h3>


    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exam">Examination</label>
                            <select class="form-control text-white" id="exam" onchange="go();">
                                <option value=""></option>
                                <?php
                                $sql0x = "SELECT * FROM examlist where sccode='$sccode' and sessionyear LIKE '$sy%'  order by id;";
                                echo $sql0x;
                                $result0rdv = $conn->query($sql0x);
                                if ($result0rdv->num_rows > 0) {
                                    while ($row0x = $result0rdv->fetch_assoc()) {
                                        $exam = $row0x["examtitle"];
                                        if ($exam == $exam2) {
                                            $selexam = 'selected';
                                        } else {
                                            $selexam = '';
                                        }
                                        echo '<option value="' . $exam . '" ' . $selexam . ' >' . $exam . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
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
                        <div class="col-md-3">
                            <label for="subs">My Subjects</label>
                            <select class="form-control text-white" id="sub" onchange="go();">
                                <option value="">---</option>
                                <?php
                                $sql0x = "SELECT subject FROM subsetup where sccode='$sccode' and classname='$cls2' and sectionname='$sec2' and sessionyear='$sy' and tid='$userid' order by subject";

                                $result0r = $conn->query($sql0x);
                                if ($result0r->num_rows > 0) {
                                    while ($row0x = $result0r->fetch_assoc()) {
                                        $sub = $row0x["subject"];
                                        if ($sub == $sub2) {
                                            $selsub = 'selected';
                                        } else {
                                            $selsub = '';
                                        }
                                        $sql00 = "SELECT subject FROM subjects where subcode='$sub' ";
                                        $result00 = $conn->query($sql00);
                                        if ($result00->num_rows > 0) {
                                            while ($row00 = $result00->fetch_assoc()) {
                                                $sname = $row00["subject"];
                                            }
                                        }

                                        echo '<option value="' . $sub . '" ' . $selsub . ' >' . $sname . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">&nbsp;</label>
                            <button class="btn btn-inverse-primary d-block p-2 pt-2">Show Mark List</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $classname = $cls2;
    $sectionname = $sec2;
    $subj = $sub2;

    $sql22v = "SELECT * FROM subsetup where classname ='$classname'  and sectionname='$sectionname' and subject ='$subj' and sccode = '$sccode' ";
    $result22v = $conn->query($sql22v);
    if ($result22v->num_rows > 0) {
        while ($row22v = $result22v->fetch_assoc()) {
            $fullmark = $row22v["fullmarks"];
            $careal = $row22v["ca"];
            $checkcamanual = $row22v["camanual"];
            $pass_algorithm = $row22v["pass_algorithm"];
            $subj_full = $row22v["subj"];
            $obj_full = $row22v["obj"];
            $pra_full = $row22v["pra"];
            $ca_full = $row22v["ca"];
        }
    }


    if ($subj_full == 0) {
        $sd = 'disabled';
    } else {
        $sd = '';
    }
    if ($obj_full == 0) {
        $od = 'disabled';
    } else {
        $od = '';
    }
    if ($pra_full == 0) {
        $pd = 'disabled';
    } else {
        $pd = '';
    }
    if ($ca_full == 0) {
        $cd = 'disabled';
    } else {
        $cd = '';
    }

    ?>

    <div class="row mb-3">
        <div class="col-12">
            <div class="card text-left">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div style="font-size:16px; font-weight:700; line-height:15px;">
                                <?php echo strtoupper($exam2); ?>
                            </div>
                            <div
                                style="font-size:12px; font-weight:400; font-style:italic; line-height:18px; color:gray;">
                                Name of Examination</div>
                        </div>
                        <div class="col-md-4">
                            <div style="font-size:16px; font-weight:700; line-height:15px;">
                                <?php echo strtoupper($classname) . ' : ' . strtoupper($sectionname); ?>
                            </div>
                            <div
                                style="font-size:12px; font-weight:400; font-style:italic; line-height:12px; color:gray;">
                                Class & Section/Group</div>
                        </div>

                        <div class="col-md-4">
                            <div style="font-size:16px; font-weight:700; line-height:15px;">
                                <?php echo strtoupper($sname); ?>
                            </div>
                            <div
                                style="font-size:12px; font-weight:400; font-style:italic; line-height:18px; color:gray;">
                                Subject</div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div style="font-size:16px; font-weight:700; line-height:15px;">
                                <?php echo $subj_full . ' + ' . $obj_full . ' + ' . $pra_full . ' =  ' . $fullmark . ' (' . $ca_full . '%)'; ?>
                            </div>
                            <div
                                style="font-size:12px; font-weight:400; font-style:italic; line-height:18px; font-weight:400;">
                                <b>Sub + Obj + Pra = Full Marks (CA%)</b>
                            </div>
                            <div
                                style="font-size:12px; font-weight:400; font-style:italic; line-height:18px; color:gray;">
                                Marks Distribution</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php if ($exam2 != '' || $cls2 != '' || $sec2 != '' || $sub2 != '') { ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="card text-center stbox" id="block<?php echo $stid; ?>">
                            <img class="card-img-top" alt="">
                            <div class="card-body">
                                <table width="100%" id="main">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Roll</th>
                                            <th>Student's Name</th>
                                            <th>CA</th>
                                            <th>Sub</th>
                                            <th>Obj</th>
                                            <th>Pra</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <?php


                                    //**********************************************************************************************************************
                                    $cnt = 0;
                                    $sql0 = "SELECT * FROM sessioninfo where sessionyear='$sy' and sccode='$sccode' and classname='$classname' and sectionname = '$sectionname' order by rollno";
                                    $result0 = $conn->query($sql0);
                                    if ($result0->num_rows > 0) {
                                        while ($row0 = $result0->fetch_assoc()) {
                                            $stid = $row0["stid"];
                                            $rollno = $row0["rollno"];
                                            $card = $row0["icardst"];
                                            $ggg = $row0["groupname"];
                                            $sta = $row0["status"];
                                            if ($subj_full == 0) {
                                                $sd = 'disabled';
                                            } else {
                                                $sd = '';
                                            }
                                            if ($obj_full == 0) {
                                                $od = 'disabled';
                                            } else {
                                                $od = '';
                                            }
                                            if ($pra_full == 0) {
                                                $pd = 'disabled';
                                            } else {
                                                $pd = '';
                                            }
                                            if ($ca_full == 0) {
                                                $cd = 'disabled';
                                            } else {
                                                $cd = '';
                                            }


                                            if ($sta == 0) {
                                                $dsbl = 'disabled';
                                                $bgc = 'light';
                                                $sd = 'disabled';
                                                $od = 'disabled';
                                                $pd = 'disabled';
                                            } else {
                                                $dsbl = '';
                                                $bgc = 'lighter';
                                            }

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


                                            $subje = '';
                                            $obj = '';
                                            $pra = '';
                                            $ca = '';
                                            $gp = '';
                                            $gl = '';
                                            $ind = array_search($stid, array_column($marks, 'stid'));
                                            // echo $ind;
                                            if ($ind != '' || $ind != null) {
                                                $subje = $marks[$ind]["subj"];
                                                $obj = $marks[$ind]["obj"];
                                                $pra = $marks[$ind]["pra"];
                                                $ca = $marks[$ind]["ca"];
                                                $gp = $marks[$ind]["gp"];
                                                $gl = $marks[$ind]["gl"];
                                            }


                                            ?>
                                            <tbody>


                                                <tr>
                                                    <td style="width:30px;">
                                                        <span style="">
                                                            <img src="<?php echo $pth; ?>" class="pic" />
                                                        </span>
                                                    </td>
                                                    <td class="text-center"><span
                                                            style=" font-size:24px; font-weight:700; text-align:center; padding:0 10px;"><?php echo $rollno; ?></span>
                                                    </td>
                                                    <td style="text-align:left; padding:10px 5px;">
                                                        <div class="a"><?php echo $neng; ?></div>
                                                        <div class="b"><?php echo $nben; ?></div>
                                                        <div class="c">ID # <?php echo $stid; ?> </div>
                                                    </td>


                                                    <td>
                                                        <div class="form-group text-center">
                                                            <input type="number" class="form-control" value="<?php echo $ca; ?>"
                                                                style="max-width:100px; margin:auto;" id="ca<?php echo $stid; ?>"
                                                                onfocus="focu(<?php echo $stid; ?>,0);"
                                                                onblur="blurs(<?php echo $stid; ?>,0);" <?php echo $cd; ?>>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group text-center">
                                                            <input type="number" class="form-control" value="<?php echo $subje; ?>"
                                                                style="max-width:100px; margin:auto;" id="sub<?php echo $stid; ?>"
                                                                onfocus="focu(<?php echo $stid; ?>,1);"
                                                                onblur="blurs(<?php echo $stid; ?>,1);" <?php echo $sd; ?>>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" value="<?php echo $obj; ?>"
                                                                style="max-width:100px; margin:auto;" id="obj<?php echo $stid; ?>"
                                                                onfocus="focu(<?php echo $stid; ?>,2);"
                                                                onblur="blurs(<?php echo $stid; ?>,2);" <?php echo $od; ?>>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" value="<?php echo $pra; ?>"
                                                                style="max-width:100px; margin:auto;" id="pra<?php echo $stid; ?>"
                                                                onfocus="focu(<?php echo $stid; ?>,3);"
                                                                onblur="blurs(<?php echo $stid; ?>,3);" <?php echo $pd; ?>>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="padding:7px 3px; margin-left:2px; text-align:center; border:1px solid gray; border-radius:4px;  font-size:16px; font-weight:600; position:relative; margin-top:-10px;"
                                                            id="gg<?php echo $stid; ?>"><?php echo $gp . ' / ' . $gl; ?>
                                                        </div>
                                                    </td>


                                                </tr>

                                            </tbody>
                                            <?php
                                            $cnt++;
                                        }
                                    }
                                    //*****************************************************************************
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="stbox" style="height:0px;"></div>

                    </div>
                </div>
            </div>
        </div>

    <?php } ?>


</div>







<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;


    function go() {
        var exam = document.getElementById('exam').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        var sub = document.getElementById('sub').value;
        window.location.href = 'teacher-marks.php?&cls=' + cls + '&sec=' + sec + '&exam=' + exam + '&sub=' + sub;
    }
</script>



<script>
    function focu(id, port) {
        if (port == 1) {
            $('#sub' + id).css({ "font-size": "30px", "color": "white" }); $('#sub' + id).select();
        } else if (port == 2) {
            $('#obj' + id).css({ "font-size": "30px", "color": "white" }); $('#obj' + id).select();
        } else if (port == 3) {
            $('#pra' + id).css({ "font-size": "30px", "color": "white" }); $('#pra' + id).select();
        } else if (port == 0) {
            $('#ca' + id).css({ "font-size": "30px", "color": "white" }); $('#ca' + id).select();
        }
    }
</script>3

<script>
    function blurs(id, port) {
        let lock = <?php echo $lock * 1; ?>;
        if (lock == 0) {
            let a = '<?php echo $sd; ?>';
            let b = '<?php echo $od; ?>';
            let c = '<?php echo $pd; ?>';
            let d = '<?php echo $cd; ?>';

            let sub = document.getElementById("sub" + id).value;
            let obj = document.getElementById("obj" + id).value;
            let pra = document.getElementById("pra" + id).value;
            let ca = document.getElementById("ca" + id).value;

            if (port == 1) {
                if (sub <= <?php echo $subj_full; ?>) {
                    $('#sub' + id).css({ "font-size": "16px", "color": "white" });
                } else {
                    alert('Invalid Marks'); 
                    document.getElementById("sub" + id).value='';
                    document.getElementById("sub" + id).focus().select();
                }


                if (b == 'disabled') { markcall(id); }
            } else if (port == 2) {
                if (obj <= <?php echo $obj_full; ?>) {
                    $('#obj' + id).css({ "font-size": "16px", "color": "white" });
                } else {
                    alert('Invalid Marks');
                     document.getElementById("obj" + id).value='';
                     document.getElementById("obj" + id).focus().select();
                }


                if (c == 'disabled') { markcall(id); }
            } else if (port == 3) {
                if (pra <= <?php echo $pra_full; ?>) {
                    $('#pra' + id).css({ "font-size": "16px", "color": "black" });
                } else {
                    alert('Invalid Marks'); 
                    document.getElementById("pra" + id).value='';
                    document.getElementById("pra" + id).focus().select();
                }

                markcall(id);
            } else if (port == 0) {
                if (ca <= <?php echo $ca_full; ?>) {
                    $('#ca' + id).css({ "font-size": "16px", "color": "white" });
                } else {
                    alert('Invalid Marks'); 
                    document.getElementById("ca" + id).value='';
                    document.getElementById("ca" + id).focus().select();
                }

                if (a == 'disabled') { markcall(id); }
            }
        }
        else {
            alert('Entry/Modify has been locked.');
        }


    }


</script>
<script>
    function markcall(id) {
        let fm = 100;
        let sub = parseInt(document.getElementById("sub" + id).value) * 1;
        let obj = parseInt(document.getElementById("obj" + id).value) * 1;
        let pra = parseInt(document.getElementById("pra" + id).value) * 1;
        let ca = parseInt(document.getElementById("ca" + id).value) * 1;
        if (isNaN(sub)) sub = 0;
        if (isNaN(obj)) obj = 0;
        if (isNaN(pra)) pra = 0;
        if (isNaN(ca)) ca = 0;

        var infor = "sccode=<?php echo $sccode; ?>&cls=<?php echo $classname; ?>&sec=<?php echo $sectionname; ?>&exam=<?php echo $exam; ?>&sub=<?php echo $subj; ?>&usr=<?php echo $usr; ?>&stid=" + id + "&fm=" + fm + "&subj=" + sub + "&obj=" + obj + "&pra=" + pra + "&ca=" + ca;
        console.log(infor);
        // alert(infor);
        $("#gg" + id).html("");
        $.ajax({
            type: "POST",
            url: "backend/teacher-savestmark.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $("#gg" + id).html('<div style="padding-top:5px;"><i class="material-icons" style="font-size:35px;color:black;">save</i></div>');
            },
            success: function (html) {
                $("#gg" + id).html(html);
            }
        });
    }    
</script>
<script>
    function fetchsection() {
        var cls = document.getElementById("classname").value;

        var infor = "user=<?php echo $rootuser; ?>&cls=" + cls;
        $("#sectionblock").html("");

        $.ajax({
            type: "POST",
            url: "fetchsection.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sectionblock').html('<span class=""><center>Fetching Section Name....</center></span>');
            },
            success: function (html) {
                $("#sectionblock").html(html);
            }
        });
    }
</script>

<script>
    function mentry(id, pi, roll) {
        //alert(id + '/' + pi + '/' + roll);
        var infor = "sccode=<?php echo $sccode; ?>&cls=<?php echo $classname; ?>&sec=<?php echo $sectionname; ?>&exam=<?php echo $exam; ?>&sub=<?php echo $subj; ?>&assess=<?php echo $assess; ?>&topic=<?php echo $id; ?>&usr=<?php echo $usr; ?>&roll=" + roll + "&stid=" + id + "&pi=" + pi;
        // alert(infor);
        if (pi == 1) {
            var k = 's' + id;
        } else if (pi == 2) {
            var k = 'c' + id;
        } else {
            var k = 't' + id;
        }


        $("#" + k).html("");

        $.ajax({
            type: "POST",
            url: "savestmark.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $("#" + k).html('<div style="padding-top:5px;"><i class="material-icons" style="font-size:35px;color:black;">save</i></div>');
            },
            success: function (html) {
                $("#table" + id).html(html);

            }
        });
    }
</script>

<script>
    function grp() {
        let chk = document.getElementById("grp").checked;
        if (chk == true) {
            $('.stbox').hide(); $('.grpbox').show();
        } else {
            $('.stbox').show(); $('.grpbox').hide();
        }
    }
</script>