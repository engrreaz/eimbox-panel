<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

// $refno = $_GET['ref'] ?? 0;
// $undef = $_GET['undef'] ?? 99;

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


$classnamelist = ' playnurseryonetwothreefourfivesixseveneightnineten';
$sql0x = "SELECT count(*) as cnt FROM sessioninfo where  sccode='$sccode' and sessionyear LIKE '$sy%'  ;";
$result0xxd = $conn->query($sql0x);
if ($result0xxd->num_rows > 0) {
    while ($row0x = $result0xxd->fetch_assoc()) {
        $tsc = $row0x['cnt'];
    }
}


// $inex = $_COOKIE['inex'];
// $btnclr = $_COOKIE['clr'];
// $txt = $_COOKIE['txt'];
?>
<style>
    thead th {
        position: sticky;
        top: 0;
    }
</style>


<h3 id="lbl-inex">Student's Payment Setup</h3>

<style>
    #prog.fade {
        opacity: 1;
        transition: opacity 2s;
    }

    #prog {
        opacity: 0;
        transition: opacity 3s;
    }
</style>

<div class="row" style="display:<?php echo $newblock; ?>;">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Add a New Payment Item(s)
                </h6>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover text-white">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sccodes = $sccode * 10;
                                $sql0x = "SELECT * FROM financeitem where sccode='$sccode' and id = '$exid' ;";
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $peng = $row0x["particulareng"];
                                        $pben = $row0x["particularben"];
                                        $mon = $row0x["month"];
                                        $incom = $row0x["income"];
                                        if ($incom == 1) {
                                            $incom = 'checked';
                                        } else {
                                            $incom = '';
                                        }
                                        $expen = $row0x["expenditure"];
                                        if ($expen == 1) {
                                            $expen = 'checked';
                                        } else {
                                            $expen = '';
                                        }
                                    }
                                } else {
                                    $peng = "";
                                    $pben = "";
                                    $mon = "";
                                    $expen = "";
                                    $incom = '';
                                    $expen = '';
                                }
                                // $ = $row0x[""];
                                ?>
                                <tr>
                                    <td>Particulars (In English) :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="peng"
                                            value="<?php echo $peng; ?>" />
                                    </td>

                                </tr>
                                <tr>
                                    <td>Particulars (In Bengali) :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="pben"
                                            value="<?php echo $pben; ?>" />
                                    </td>
                                </tr>

                                <tr>
                                    <td>Month (Payment Applied) :</td>
                                    <td>
                                        <select class="form-control" id="monmon">
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                if ($i == $mon) {
                                                    $yoyo = 'selected';
                                                } else {
                                                    $yoyo = '';
                                                }

                                                if ($i == 0) {
                                                    $mname = 'Every Month';
                                                } else if ($i == 22) {
                                                    $mname = 'February, April, June, August, October, December';
                                                } else if ($i == 33) {
                                                    $mname = 'March, June, September, November';
                                                } else if ($i == 44) {
                                                    $mname = 'April, August, November';
                                                } else if ($i == 66) {
                                                    $mname = 'January, November';
                                                } else {
                                                    $tarikh = '2024-' . $i . '-01';
                                                    $mname = date('F', strtotime($tarikh));
                                                }
                                                echo '<option value="' . $i . ' " ' . $yoyo . '>' . $i . ' - ' . $mname . '</option>';
                                            }
                                            echo '<option value=""></option>';
                                            echo '<option value="0" ' . $yoyo . '>Every Month</option>';
                                            echo '<option value="22" ' . $yoyo . '>2 Months Frequency : February, April, June, August, October, December</option>';
                                            echo '<option value="33" ' . $yoyo . '>3 Months Frequency : March, June, September, November</option>';
                                            echo '<option value="44" ' . $yoyo . '>4 Months Frequency : April, August, November</option>';
                                            echo '<option value="66" ' . $yoyo . '>6 Months Frequency : January, November</option>';

                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Item also Displayed in :</td>
                                    <td>
                                        <table class="borderless">
                                            <tr>
                                                <td><input type="checkbox" class="form-control" id="inin" <?php echo $incom; ?> /></td>
                                                <td>Income</td>
                                                <td><input type="checkbox" class="form-control" id="exex" value="" <?php echo $expen; ?> /></td>
                                                <td>Expenditure</td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>



                                <tr>
                                    <td></td>
                                    <td>
                                        <div id="">
                                            <button class="btn btn-primary"
                                                onclick="crud(<?php echo $exid; ?>, 1);">Save</button>
                                            <div class="text-small text-danger">
                                                <i class="mdi mdi-exclamation mdi-24px text-danger"></i>
                                                Caution ! Update Payment Item Information after synced payment setting
                                                at your own risk.
                                                <br>Please Contact with your system administrator to do this.
                                            </div>
                                            <div id="gex"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div id="sspd"></div>
                <h5 class="text-muted font-weight-normal font-weight-bold">
                    Student's Payment Items List
                </h5>


                <?php
                /*
                                $pick = "SELECT * FROM stfinance where partid='$id'  and sccode='$sccode' and sessionyear LIKE '$sy%' and stid = '$stid2' order by month ;";
                                $result0xx21 = $conn->query($pick);
                                if ($result0xx21->num_rows > 0) {
                                    while ($row0xn = $result0xx21->fetch_assoc()) {
                                        $datam[] = $row0xn;
                                    }
                                } else {
                                    $datam[] = '';
                                }
                                // echo var_dump($datam);
                                */
                ?>




                <div class="box sticky-top">
                    <div class="text-small text-muted ">
                        <input id="progx" class=" borderless bg-dark" style=" accent-color: #333333;" type="radio"
                            checked />
                        <span id="tsc"><?php echo $tsc; ?></span> Students Found.
                    </div>

                    <div id="gexx" class="text-small text-warning mb-2"></div>

                    <div id="prog" style="display:none;" class="progress progress-md portfolio-progress">
                        <div id="progbar" class="progress-bar bg-success" role="progressbar" style="width: 0%;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div id="more" class="text-small text-primary mt-2"></div>
                </div>



                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead style="position:sticky;">
                                <tr>
                                    <th>#</th>
                                    <th>Particulars</th>
                                    <th></th>
                                    <th>All</th>
                                    <?php
                                    $valid_class_list = '';
                                    $sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear like '$sy%' group by areaname order by idno ;";
                                    $result0xxt = $conn->query($sql0x);
                                    if ($result0xxt->num_rows > 0) {
                                        while ($row0x = $result0xxt->fetch_assoc()) {
                                            $cname = strtoupper($row0x["areaname"]);
                                            
                                            if (strpos($classnamelist, strtolower($cname)) > 0) {
                                                echo '<th class=" text-center">' . $cname . '</th>';
                                                $valid_class_list .= strtolower($cname) . '_';
                                            }
                                        }
                                    }

                                    ?>
                                    <th style="text-align:right;"></th>
                                    <th style="text-align:right;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $si = 1;
                                $sql0x = "SELECT * FROM financeitem where payment=1 and (sccode=0 || sccode = '$sccode') order by slno;";
                                // echo $sql0x;
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $slno = $row0x["slno"];
                                        $parteng = $row0x["particulareng"];
                                        $partben = $row0x["particularben"];
                                        $custom = $row0x["sccode"];
                                        $freq = $row0x["month"];

                                        ?>
                                        <tr>
                                            <td><?php echo $si; ?></td>
                                            <td style="line-height:20px;"><?php echo $parteng . '<br>' . $partben; ?></td>
                                            <td style="line-height:20px;">
                                                <?php if ($freq > 12) {
                                                    echo '~' . $freq / 11;
                                                } else {
                                                    echo $freq;
                                                } ?>
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" id="" value=""
                                                    style="width:60px;" disabled />
                                            </td>
                                            <?php
                                            $exp = '';
                                            $sql0x = "SELECT areaname FROM areas where user='$rootuser'  and sessionyear like '$sy%' group by areaname order by idno ;";
                                            // echo $sql0x;
                                            $result0xx = $conn->query($sql0x);
                                            if ($result0xx->num_rows > 0) {
                                                while ($row0x = $result0xx->fetch_assoc()) {
                                                    $clsfld = strtolower($row0x["areaname"]);
                                                    if (strpos($classnamelist, $clsfld) > 0) {

                                                        $sql0x = "SELECT * FROM financesetup where sccode='$sccode' and sessionyear='$sy' and particulareng='$parteng' ;";
                                                        // echo $sql0x;
                                                        $result0xxxr = $conn->query($sql0x);
                                                        if ($result0xxxr->num_rows > 0) {
                                                            while ($row0x = $result0xxxr->fetch_assoc()) {
                                                                $taka = $row0x[$clsfld];
                                                                $idfin = $row0x['id'];
                                                                $nupd = $row0x["need_update"];
                                                                if ($nupd == 0) {
                                                                    $syncclr = 'secondary';
                                                                    $ttl = 'Already Updated';
                                                                } else {
                                                                    $syncclr = 'success';
                                                                    $ttl = 'Need to Update';
                                                                }
                                                            }
                                                        } else {
                                                            $taka = '-';
                                                            $idfin = 0;
                                                            $syncclr = 'warning';
                                                            $ttl = 'Item Not Applied Yet';
                                                        }
                                                        ?>

                                                        <td class="pl-1 pr-1 text-center">
                                                            <div id="div<?php echo $clsfld . $idfin; ?>"></div>
                                                            <input type="text" class="form-control text-right"
                                                                id="<?php echo $clsfld . $idfin; ?>" value="<?php echo $taka; ?>"
                                                                onblur="push(<?php echo $idfin; ?>, <?php echo $id; ?>, '<?php echo $clsfld; ?>', '<?php echo $clsfld . $idfin; ?>' );"
                                                                style="width:55px;" />

                                                        </td>

                                                        <?php
                                                    } else {
                                                        ?>

                                                        <td class="pl-1 pr-1  text-center" hidden>
                                                            <input type="text" class="form-control bg-dark " id="" value=""
                                                                style="width:50px;" hidden />
                                                        </td>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>

                                            <td class="m-0 p-0">
                                                <div id="ssp<?php echo $id; ?>">

                                                    <?php
                                                    if ($custom == $sccode) {
                                                        ?>
                                                        <button onclick="edits(<?php echo $id; ?>);"
                                                            class="btn btn-inverse-primary"><i
                                                                class="mdi mdi-grease-pencil mdi-18px pt-3"></i></button>
                                                        <?php
                                                    }
                                                    ?>
                                            </td>
                                            <td class="m-0 p-0 pr-3">
                                                <div id="tags<?php echo $idfin; ?>" style="display:none;">
                                                    <?php echo $parteng . ' (' . $partben . ')'; ?>
                                                </div>

                                                <div id="freq<?php echo $idfin; ?>" style="display:none;">
                                                    <?php echo $freq; ?>
                                                </div>
                                                
                                                <button onclick="syncfinance(<?php echo $idfin; ?>,1);"
                                                    class="btn btn-inverse-<?php echo $syncclr; ?>"><span
                                                        id="spn<?php echo $idfin; ?>"><i class="mdi mdi-sync mdi-18px pt-2"
                                                            title="<?php echo $ttl; ?>"></i></span></button>
                                                
                                                            <button onclick="syncfinancech(<?php echo $idfin; ?>,1);"
                                                    class="btn btn-inverse-danger"><span
                                                        id="spn2<?php echo $idfin; ?>"><i class="mdi mdi-checkbox-marked-circle-outline mdi-18px pt-2"
                                                            title="<?php echo $ttl; ?>"></i></span></button>
                                                            <?php echo $idfin;?>
                            </div>
                            <div id="sspp<?php echo $id; ?>"></div>
                            </td>
                            </tr>
                            <?php $si++;
                                    }
                                } else { ?>
                        <tr>
                            <td colspan="7">No Data / Records Found.</td>
                        </tr>
                    <?php } ?>
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
    document.getElementById('defbtn').innerHTML = 'Add new Item';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        go();
    }

    function go() {
        window.location.href = 'st-payment-setup.php?&addnew';
    }

    function edits(idn) {
        window.location.href = 'st-payment-setup.php?&addnew=' + idn;
    }
</script>
<script>
    function push(idfin, id, cls, tail) {
        var taka = document.getElementById(tail).value;
        var infor = "idfin=" + idfin + "&id=" + id + "&cls=" + cls + "&taka=" + taka;
        // alert(id + '/' + tail);
        $("#div" + tail).html("");

        $.ajax({
            url: "backend/set-finance.php", type: "POST", data: infor, cache: false,
            beforeSend: function () {
                $("#div" + tail).html('<span class=""><small></small></span>');
            },
            success: function (html) {
                $("#div" + tail).html(html);
                if (document.getElementById("div" + tail).innerHTML == 'insert') {
                    window.location.href = 'st-payment-setup.php';
                }
                document.getElementById(tail).style.borderColor = 'green';
            }
        });
    }
</script>
<script>
    function crud(id, tail) {
        var eng = document.getElementById('peng').value;
        var ben = document.getElementById('pben').value;
        var month = document.getElementById('monmon').value;
        var inin = document.getElementById('inin').checked;
        var exex = document.getElementById('exex').checked;
        var infor = "id=" + id + "&tail=" + tail + "&eng=" + eng + "&ben=" + ben + "&month=" + month + "&inin=" + inin + "&exex=" + exex;
        // alert(infor);
        $("#gex").html("");

        $.ajax({
            url: "backend/crud-set-finance.php", type: "POST", data: infor, cache: false,
            beforeSend: function () {
                $("#gex").html('<span class=""><small></small></span>');
            },
            success: function (html) {
                $("#gex").html(html);
                window.location.href = 'st-payment-setup.php';
                // if (document.getElementById("div" + tail).innerHTML == 'insert') {
                //     window.location.href = 'st-payment-setup.php';
                // }
                // document.getElementById(tail).style.borderColor = 'green';

            }
        });
    }
</script>
<script>
    function myg() {
        document.getElementById("prog").classList.toggle('fade');
        document.getElementById("prog").style.display = 'none';
        document.getElementById("more").innerHTML = '';
        document.getElementById("gexx").innerHTML = '';
    }
    function done() {
        setTimeout(myg, 2000);
    }
</script>
<script>
    function syncfinance(id, tail) {
        document.getElementById("more").innerHTML = "";
        document.getElementById("prog").style.display = 'flex';
        document.getElementById("progbar").style.width = '0%';
        var tsc = parseInt(<?php echo $tsc; ?>);
        var freq = parseInt(document.getElementById("freq" + id).innerHTML);
        if (freq == 0) {
            // document.getElementById("tsc").innerHTML = tsc * 12;
        }
        document.getElementById("progx").focus();
        // document.getElementById("prog").style.opacity = "1";
        document.getElementById("prog").classList.add('fade');
        syncfinance2(id, tail);
    }
    
    function syncfinancech(id, tail) {
        document.getElementById("more").innerHTML = "";
        document.getElementById("prog").style.display = 'flex';
        document.getElementById("progbar").style.width = '0%';
        var tsc = parseInt(<?php echo $tsc; ?>);
        var freq = parseInt(document.getElementById("freq" + id).innerHTML);
        if (freq == 0) {
            // document.getElementById("tsc").innerHTML = tsc * 12;
        }
        document.getElementById("progx").focus();
        // document.getElementById("prog").style.opacity = "1";
        document.getElementById("prog").classList.add('fade');
        syncfinancech2(id, tail);
    }

    function syncfinance2(id, tail) {
        var mor = document.getElementById("more").innerHTML;
        var txt = document.getElementById("tags" + id).innerHTML;
        // alert("repeta" + mor);
        if (mor == '') { document.getElementById("more").innerHTML = 0; }
        var infor = "id=" + id + "&tail=" + tail + "&vcl=<?php echo $valid_class_list; ?>";
        // alert(infor);
        $("#gexx").html("----------");

        // setInterval(function () {
        //     var object = document.getElementById('spn' + id);
        //     object.style.transform += "rotate(10deg)";
        // }, 10);

        $.ajax({
            url: "backend/sync-finance-amount-slow.php", type: "POST", data: infor, cache: false,
            beforeSend: function () {
                $("#gexx").html('<span class=""><small>Please wait, data syncing continue. It may take some time...</small> <br><span class="text-success">' + txt + '</span> </span>');
            },
            success: function (html) {
                $("#gexx").html(txt + '<br>' + html);
                var more = document.getElementById("more").innerHTML;
                let position = more.search("Done");
                if (position < 0) {
                    var curval = parseInt(more);
                    var totval = parseInt(document.getElementById("tsc").innerHTML);
                    var perc = curval * 100 / totval;
                    document.getElementById("progbar").style.width = perc + '%';
                    syncfinance2(id, tail);
                } else {
                    document.getElementById("progbar").style.width = '100%';
                    document.getElementById("gexx").innerHTML = txt;
                    document.getElementById("more").innerHTML = 'Payment Updated Successfully.';
                    document.getElementById("prog").classList.toggle('fade');
                    done();
                }
                // window.location.href = 'st-payment-setup.php';
                // if (document.getElementById("div" + tail).innerHTML == 'insert') {
                //     window.location.href = 'st-payment-setup.php';
                // }
                // document.getElementById(tail).style.borderColor = 'green';
            }
        });
    }

    function syncfinancech2(id, tail) {
        var mor = document.getElementById("more").innerHTML;
        var txt = document.getElementById("tags" + id).innerHTML;
        // alert("repeta" + mor);
        if (mor == '') { document.getElementById("more").innerHTML = 0; }
        var infor = "id=" + id + "&tail=" + tail + "&vcl=<?php echo $valid_class_list; ?>";
        // alert(infor);
        $("#gexx").html("----------");

        // setInterval(function () {
        //     var object = document.getElementById('spn' + id);
        //     object.style.transform += "rotate(10deg)";
        // }, 10);

        $.ajax({
            url: "backend/sync-finance-check.php", type: "POST", data: infor, cache: false,
            beforeSend: function () {
                $("#gexx").html('<span class=""><small>Please wait, data syncing continue. It may take some time...</small> <br><span class="text-success">' + txt + '</span> </span>');
            },
            success: function (html) {
                $("#gexx").html(txt + '<br>' + html);
                var more = document.getElementById("more").innerHTML;
                let position = more.search("Done");
                if (position < 0) {
                    var curval = parseInt(more);
                    var totval = parseInt(document.getElementById("tsc").innerHTML);
                    var perc = curval * 100 / totval;
                    document.getElementById("progbar").style.width = perc + '%';
                    syncfinance2(id, tail);
                } else {
                    document.getElementById("progbar").style.width = '100%';
                    document.getElementById("gexx").innerHTML = txt;
                    // document.getElementById("more").innerHTML = 'Payment Checked Successfully.';
                    document.getElementById("prog").classList.toggle('fade');
                    // done();
                }
                // window.location.href = 'st-payment-setup.php';
                // if (document.getElementById("div" + tail).innerHTML == 'insert') {
                //     window.location.href = 'st-payment-setup.php';
                // }
                // document.getElementById(tail).style.borderColor = 'green';
            }
        });
    }
</script>