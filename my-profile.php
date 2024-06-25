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

<h3>My Profile </h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <img src="<?php echo $pth; ?>"
                                    style="width:120px; border-radius:5px; border:1px solid gray;" />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-12">
                                <h4 class="text-primary"><?php echo $fullname; ?></h4>
                                <h5 class="mb-0"><?php echo $usr; ?></h5>
                                <small><?php echo $userlevel; ?></small>
                                <br>
                                <small>Linked ID # </small><code><?php echo $userid; ?></code>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-12">
                                <!-- <h4><?php echo $dur / 3600; ?> HRS.</h4>
                                <h5><?php echo $fs / (1024 * 1024); ?> MB</h5> -->
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
                <h3 class="text-muted font-weight-normal font-weight-bold">
                    User Information
                </h3>
                <div class="row">
                    <div class="table-responsive full-width">
                        <table class="table table-hover text-white">

                            <tbody>
                                <?php
                                $sccodes = $sccode * 10;
                                $sql0x = "SELECT * FROM usersapp where sccode='$sccode'  and email = '$usr' ;";
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $fullname = $row0x["profilename"];
                                        $cellno = $row0x["mobile"];
                                        $pin = $row0x["fixedpin"];
                                    }
                                }
                                // $ = $row0x[""];
                                ?>
                                <tr>
                                    <td>Display Name :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="dispname"
                                            value="<?php echo $fullname; ?>" />
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Mobile Number :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="cellno"
                                            value="<?php echo $cellno; ?>" />
                                    </td>
                                    <td></td>
                                </tr>


                                <tr>
                                    <td>Password :
                                    </td>
                                    <td>
                                        <input type="password" class="form-control" id="pin" 
                                            value="" />
                                    </td>
                                    <td></td>
                                </tr>

                                <tr hidden>
                                    <td>Login Method :
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class=" d-flex">

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="" class="font-control " /> Gmail
                                                            Login
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="" class="font-control " />
                                                            Facebook
                                                            Login
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="" class="font-control " /> QR
                                                            Code
                                                            Login
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="" class="font-control " /> Login
                                                            with
                                                            Token
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class=" d-flex">

                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="checkbox" id="" class="font-control " /> Login
                                                            with
                                                            Password
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="cellno"
                                                                value="<?php echo $cellno; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </td>
                                    <td></td>
                                </tr>



                                <tr>
                                    <td></td>
                                    <td>
                                        <div id="">
                                            <button class="btn btn-inverse-primary" onclick="save();">Update Info</button>
                                            &nbsp;&nbsp;&nbsp;
                                            <span id="gex"></span>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- ***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
*************************************************************************************************** -->











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
    function save() {
        var dispname = document.getElementById('dispname').value;
        var cellno = document.getElementById('cellno').value;
        var pin = document.getElementById('pin').value;
        var infor = "dispname=" + dispname + "&cellno=" + cellno + "&pin=" + pin;

        $("#gex").html("");
        $.ajax({
            type: "POST",
            url: "backend/update-my-profile.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#gex').html('Updating...');
            },
            success: function (html) {
                $("#gex").html(html);
            }
        });
    }
</script>