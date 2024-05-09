<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

// $refno = $_GET['ref'] ?? 0;
// $undef = $_GET['undef'] ?? 99;

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

<h3 class="d-print-none">Seat Card of <?php echo $exam2 . ' Examination - ' . $sy; ?> </h3>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Select Class & Section to Generate Seat Card
                </h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class :</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="cls">
                                    <option value=" ">---</option>
                                    <?php
                                    $sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear='$sy' group by areaname order by idno;";
                                    echo $sql0x;
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
                                <select class="form-control text-white" id="sec">
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT subarea FROM areas where user='$rootuser' and sessionyear='$sy' group by subarea order by idno;";
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


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-primary" style="" onclick="go();"><i class="mdi mdi-eye"></i> Generate
                                    Card</button>

                            </div>
                        </div>
                    </div>



                </div>



            </div>
        </div>
    </div>
</div>





<?php
$sqlc = "SELECT count(*) as cnt FROM sessioninfo WHERE sccode='$sccode'  and sessionyear='$sy' and classname = '$cls2' and sectionname = '$sec2'";
$resultc = $conn->query($sqlc);
if ($resultc->num_rows > 0) {
    while ($rowc = $resultc->fetch_assoc()) {
        $cnt = $rowc["cnt"];
    }
}
$pgl = round($cnt / $col);
$pgr = $pgl + 1;
$pgm = $pgl * $col;
?>



<table style="left:0; top:0; border:0;" width="100%">
    <tr>

        <?php for ($i = 0; $i < $col; $i++) {
            $s = $pgl * $i;
            ?>
            <td valign="top">

                <?php
                $sql = "SELECT * FROM sessioninfo WHERE sccode='$sccode'  and sessionyear='$sy'  and classname = '$cls2' and sectionname = '$sec2'  order by classname, sectionname, rollno LIMIT $s, $pgl "; //and (classname='Sux' or classname='Sejven' or classname='Nine') ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $k = $row["id"];
                        $iid = $row["stid"];
                        $clname = $row["classname"];
                        $secname = $row["sectionname"];
                        $roll = $row["rollno"];


                        $sqlw = "SELECT * FROM students WHERE sccode='$sccode' and stid =  '$iid'  ";
                        $resultw = $conn->query($sqlw);
                        if ($resultw->num_rows > 0) {
                            while ($roww = $resultw->fetch_assoc()) {
                                $stname = $roww["stnameben"];
                                $stnameeng = $roww["stnameeng"];
                            }
                        }
                        $loc = '../students/' . $row["stid"] . '.jpg';
                        if (file_exists($loc) == 1) {
                            $pt = $loc;
                        } else {
                            $pt = 'students/noimg.jpg';
                        } ?>
                        <table style=" border:0;">
                            <tr>
                                <td valign="top" style="text-align:center; width:105mm; height:71mm; padding:5mm;"> <br>
                                    <div style="font-size:12px; font-weight:bold;"><?php echo $scname; ?></div>

                                    <div style="font-size:11px;"><?php echo $scadd2 . ', ' . $ps . ', ' . $dist; ?></div>
                                    <div style="font-size:16px; font-weight:bold; margin:10px 0; border:1px">SEAT
                                        CARD</div>
                                    <b><?php echo $exam2 . ' Examination - ' . $sy; ?></b>

                                    <br><br>

                                    <table style="border:0; width:100%;">
                                        <tr>
                                            <td colspan="2" style="text-align:center;">
                                                <span style=" font-weight:bold; font-size:18px;  color:blue;">
                                                    <?php echo $stnameeng; ?>
                                                </span><br>
                                                <span
                                                    style="position:static;  left:240px; top:80px; font-family:SutonnyOMJ; font-weight:bold; font-size:24px;  color:red;">
                                                    <?php echo $stname; ?><br>
                                                </span>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <span
                                                    style="position:static; text-align:left;  left:-50px; top:100px; font-family:Calibri;  font-size:16;">
                                                    CLASS : <?php echo $clname; ?><br>
                                                    Section/Group : <?php echo $secname; ?><br>
                                                    ROLL #<span style="font-size:16px; ">&nbsp;&nbsp;<?php $led = '';
                                                    if ($roll < 10) {
                                                        $led = "0";
                                                    }
                                                    echo $led . $roll; ?></span>
                                                </span>
                                            </td>
                                            <td valign="bottom" style="text-align:center;">
                                                <img src="../sign/<?php echo $sccode; ?>.png" width="80px" /><br>
                                                <span style="font-size:9px;">principal</span>
                                            </td>
                                        </tr>
                                    </table>




                                </td>

                            </tr>
                        </table>
                    <?php }
                } ?>


            </td>
            <!--*****************************************************************************************
            -->
        <?php } ?>


    </tr>
</table>









<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    function go() {
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        var exam = document.getElementById('exam').value;
        window.location.href = 'seat.php?&cls=' + cls + '&sec=' + sec + '&exam=' + exam;
    }
    function go2() {
        var m = document.getElementById('ref').value;
        window.location.href = 'expenditure.php?&ref=' + m;
    }
    function go3() {
        var m = document.getElementById('ref').value;
        window.location.href = 'expenditure.php?&undef';
    }
    function go4() {
        document.getElementById('search').style.display = 'block';
    }
</script>
<script>
    function addnew() {
        var und = '<?php echo $undef; ?>';
        var mmm = '<?php echo $month; ?>';
        var yyy = '<?php echo $year; ?>';
        var rrr = '<?php echo $refno; ?>';
        var tail = '';

        if (und == '') tail = '&undef';
        if (mmm > 0 || yyy > 0) tail = '&m=' + mmm + '&y=' + yyy;
        if (rrr > 0) tail = '&ref=' + rrr;

        window.location.href = 'expenditure.php?addnew' + tail;
    }


    function edit(id, taill) {
        var und = '<?php echo $undef; ?>';
        var mmm = '<?php echo $month; ?>';
        var yyy = '<?php echo $year; ?>';
        var rrr = '<?php echo $refno; ?>';
        var tail = '';

        if (und == '') tail = '&undef';
        if (mmm > 0 || yyy > 0) tail = '&m=' + mmm + '&y=' + yyy;
        if (rrr > 0) tail = '&ref=' + rrr;

        window.location.href = 'expenditure.php?addnew=' + id + tail;
    }

</script>

<script>
    function save(id, tail) {
        alert(tail);
        if (id == 0) tail = 0;
        if (tail == 0 || tail == 1) {
            var dept = document.getElementById('dept').value;
            var date = document.getElementById('date').value;
            var cate = document.getElementById('cate').value;
            var descrip = document.getElementById('descrip').value;
            var amt = document.getElementById('amt').value;

            var infor = "dept=" + dept + '&date=' + date + '&cate=' + cate + '&descrip=' + descrip + '&amt=' + amt + '&id=' + id + "&tail=" + tail;
        } else if (tail == 2 || tail == 3) {
            var infor = 'dept=&date=&cate=&descrip=&amt=&id=' + id + "&tail=" + tail;
        }

        alert(infor);
        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "savecash.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspd').html('<span class=""><center>Check Issue....</center></span>');
            },
            success: function (html) {
                $("#sspd").html(html);

                var und = '<?php echo $undef; ?>';
                var mmm = '<?php echo $month; ?>';
                var yyy = '<?php echo $year; ?>';
                var rrr = '<?php echo $refno; ?>';
                var taild = '';

                if (und == '') taild = '&undef';
                if (mmm > 0 || yyy > 0) taild = '&m=' + mmm + '&y=' + yyy;
                if (rrr > 0) taild = '&ref=' + rrr;

                if (tail == 1) {
                    window.location.href = 'expenditure.php?addnews=' + taild;
                } else if (tail == 2 || tail == 3) {
                    window.location.href = 'expenditure.php?q=' + taild;
                } else if (tail == 0) {
                    document.getElementById('gex').innerHTML = document.getElementById('sspd').innerHTML;
                    document.getElementById('sspd').innerHTML = '';
                    window.location.href = 'expenditure.php?addnew' + taild;
                }
            }
        });
    }

</script>