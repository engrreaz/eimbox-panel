<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

// $refno = $_GET['ref'] ?? 0;
// $undef = $_GET['undef'] ?? 99;

if (isset($_GET['m'])) {
    $month = $_GET['m'];
} else {
    $month = 0;
}
if (isset($_GET['y'])) {
    $year = $_GET['y'];
} else {
    $year = 0;
}
if (isset($_GET['ref'])) {
    $refno = $_GET['ref'];
} else {
    $refno = 0;
}
if (isset($_GET['undef'])) {
    $undef = $_GET['undef'];
} else {
    $undef = 99;
}


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




$sql0x = "SELECT sum(duration) as dur, sum(filesize) as fs FROM logbook where sccode='$sccode'  and email = '$usr' ;";
$result0x = $conn->query($sql0x);
if ($result0x->num_rows > 0) {
    while ($row0x = $result0x->fetch_assoc()) {
        $dur = $row0x["dur"];
        $fs = $row0x["fs"];
    }
}
?>

<h3>Institution Profile </h3>
<code>Settings -> Institute Profile</code>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <?php
                                if (!file_exists('../logo/' . $sccode . '.png')) {
                                    $logopath = 'assets/imgs/logo.png';
                                } else {
                                    $logopath = '../logo/' . $sccode . '.png';
                                }
                                ?>
                                <img style="height:100px;" src="<?php echo $logopath; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label">Upload Logo</label>
                            <div class="col-12">
                                <?php
                                $datamon = 'logo';
                                $dest_file_name = $sccode . '.png';
                                include 'ajax-upload.php';
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group row">
                            <div class="col-12">
                                <h2><?php echo $scname; ?></h2>
                                <h5><?php echo $scaddress; ?></h5>
                                <h6>EIIN : <span class="text-warning"><b><?php echo $sccode; ?></b></span></h6>
                                <h6>Root Username : <span class="text-warning"><b><?php echo $rootuser; ?></b></span>
                                </h6>
                            </div>
                        </div>
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
                <div class="row">
                    <div class="table-responsive">
                        <table class="table text-white">

                            <tbody>
                                <?php
                                $sccodes = $sccode * 10;
                                $sql0x = "SELECT * FROM scinfo where sccode='$sccode'  ;";
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $scname = $row0x["scname"];
                                        $scadd1 = $row0x["scadd1"];
                                        $scadd2 = $row0x["scadd2"];
                                        $ps = $row0x["ps"];
                                        $dist = $row0x["dist"];
                                        $postal_code = $row0x["postal_code"];
                                        $mobile = $row0x["mobile"];
                                        $scmail = $row0x["scmail"];
                                        $scweb = $row0x["scweb"];
                                        $headname = $row0x["headname"];
                                        $headtitle = $row0x["headtitle"];
                                        $geolat = $row0x["geolat"];
                                        $geolon = $row0x["geolon"];
                                        // $ = $row0x[""];
                                
                                    }
                                } else {
                                    $date = '';
                                    $slots = 'school';
                                    $amount = '';
                                    $descrip = '';

                                }
                                // $ = $row0x[""];
                                ?>
                                <tr>
                                    <td>Name of the Institution : </td>
                                    <td colspan="4">
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $scname; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address (Line - 1) : </td>
                                    <td colspan="4">
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $scadd1; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address (Line - 2) : </td>
                                    <td colspan="4">
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $scadd2; ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Upzila / PS : </td>
                                    <td>
                                        <input type="text" class="form-control" id="date" value="<?php echo $ps; ?>" />
                                    </td>
                                    <td></td>
                                    <td>District : </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $dist; ?>" />
                                    </td>
                                </tr>



                                <tr>
                                    <td>Postal Code : </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $postal_code; ?>" />
                                    </td>
                                    <td></td>
                                    <td>Mobile / Office Phone :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $mobile; ?>" />
                                    </td>
                                </tr>

                                <tr>
                                    <td>Geo Location (Lat): </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $geolat; ?>" />
                                    </td>
                                    <td></td>
                                    <td>Geo Location (Lon): </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $geolon; ?>" />
                                    </td>
                                </tr>


                                <tr>
                                    <td>Email :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $scmail; ?>" />
                                    </td>
                                    <td></td>
                                    <td>Web Address :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $scweb; ?>" />
                                    </td>
                                </tr>



                                <tr>
                                    <td>Name of Institute Head :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $headname; ?>" />
                                    </td>
                                    <td></td>
                                    <td>Head Position :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $headtitle; ?>" />
                                    </td>
                                </tr>



                                <tr>
                                    <td></td>
                                    <td colspan="4"><button class="btn btn-inverse-primary p-2"
                                            onclick="save(<?php echo $exid; ?>, 1);">Save
                                            Information</button>

                                        <div id="gex"></div>
                                        <div id="">

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



<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'expenditure.php?&m=' + m + '&y=' + y;
    }



</script>

<script>
    function save(id, tail) {

        var infor = 'dept=&date=&cate=&descrip=&amt=&id=' + id + "&tail=" + tail;

        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "update-ins-info.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspd').html('<span class=""><center>Check Issue....</center></span>');
            },
            success: function (html) {
                $("#sspd").html(html);
            }
        });
    }

</script>