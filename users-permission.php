<?php
include 'header.php';

if (isset($_GET['useremail'])) {
    $umail = $_GET['useremail'];
} else {
    $umail = '';
    $id = 0;
    $profilename = '';
    $mobile = '';
    $userlevel = '';
    $photourl = '';
}

?>

<h3>Users Permission / Restriction Management</h3>

<?php
if ($umail != '') {
    $sql0x = "SELECT * FROM usersapp where sccode='$sccode' and email='$umail';";
    $result0x3n = $conn->query($sql0x);
    if ($result0x3n->num_rows > 0) {
        while ($row0x = $result0x3n->fetch_assoc()) {
            $id = $row0x["id"];
            $profilename = $row0x["profilename"];
            $mobile = $row0x["mobile"];
            $userlevel = $row0x["userlevel"];
            $photourl = $row0x["photourl"];
            $userid = $row0x["userid"];

        }
    }


    ?>



    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group row">
                                <div class="col-12">
                                    <img style="width:100px;" src="<?php echo $photourl; ?>" />
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-12">
                                    <h4><?php echo $profilename; ?></h4>
                                    <h6><?php echo $mobile; ?></h6>
                                    <h5><?php echo $umail; ?></h5>
                                    <small><?php echo $userlevel; ?></small>
                                    <br>
                                    <small>Account Link with <?php echo $userid; ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-danger btn-icon-text" disabled>
                                        <i class="mdi mdi-upload btn-icon-prepend"></i> Inactive </button>
                                </div>
                                <div class="col-12">
                                    <select class="form-control d-block mt-3" onchange="save('<?php echo $umail; ?>', 2);"
                                        id="ulevel">
                                        <?php
                                        $sql0x = "SELECT * FROM user_level where levelname !='' and levelrank>5 order by levelrank;";
                                        $result0x3ng = $conn->query($sql0x);
                                        if ($result0x3ng->num_rows > 0) {
                                            while ($row0x = $result0x3ng->fetch_assoc()) {
                                                $levelname = $row0x["levelname"];
                                                if ($levelname == $userlevel) {
                                                    $sel = 'selected';
                                                } else {
                                                    $sel = '';
                                                }
                                                echo '<option value="' . $levelname . '" ' . $sel . '>' . $levelname . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span id="ssd"></span>
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
                    <h3 class="text-muted font-weight-normal text-center">
                        Basic Information
                    </h3>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-hover text-white">

                                <tbody>

                                    <tr>
                                        <td>Display Name :
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="dispname"
                                                value="<?php echo $profilename; ?>" />
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile Number :
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="cell"
                                                value="<?php echo $mobile; ?>" />
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Teacher/Staff (If Applicable) :
                                        </td>
                                        <td>
                                            <select class="form-control" id="userid">
                                                <?php
                                                $sql0x = "SELECT * FROM teacher where sccode='$sccode' order by ranks ;";
                                                $result0x3 = $conn->query($sql0x);
                                                if ($result0x3->num_rows > 0) {
                                                    while ($row0x = $result0x3->fetch_assoc()) {
                                                        $tid = $row0x["tid"];
                                                        $tname = $row0x["tname"];
                                                        $sele = '';
                                                        if ($tid == $userid) {
                                                            $sele = 'selected';
                                                        }
                                                        echo '<option value="' . $tid . '" ' . $sele . ' >' . $tname . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr hidden>
                                        <td>Description :
                                        </td>
                                        <td>
                                            <div class="form-check form-check-success">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" checked=""> Success <i
                                                        class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>
                                            <div id="">
                                                <button class="btn btn-inverse-primary"
                                                    onclick="save('<?php echo $umail; ?>', 3);">Save</button>

                                                <div id="gex"></div>
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

    <div class="row" hidden>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">

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



    <div class="row" hidden>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Transaction History</h4>
                    <canvas id="transaction-history" class="transaction-chart"></canvas>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Transfer to Paypal</h6>
                            <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
                        </div>
                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            <h6 class="font-weight-bold mb-0">$236</h6>
                        </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                        <div class="text-md-center text-xl-left">
                            <h6 class="mb-1">Tranfer to Stripe</h6>
                            <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
                        </div>
                        <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                            <h6 class="font-weight-bold mb-0">$593</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h4 class="card-title mb-1">Open Projects</h4>
                        <p class="text-muted mb-1">Your data status</p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="preview-list">
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-primary">
                                            <i class="mdi mdi-file-document"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Admin dashboard design</h6>
                                            <p class="text-muted mb-0">Broadcast web app mockup</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">15 minutes ago</p>
                                            <p class="text-muted mb-0">30 tasks, 5 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success">
                                            <i class="mdi mdi-cloud-download"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Wordpress Development</h6>
                                            <p class="text-muted mb-0">Upload new design</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">1 hour ago</p>
                                            <p class="text-muted mb-0">23 tasks, 5 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-info">
                                            <i class="mdi mdi-clock"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Project meeting</h6>
                                            <p class="text-muted mb-0">New project discussion</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">35 minutes ago</p>
                                            <p class="text-muted mb-0">15 tasks, 2 issues</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-danger">
                                            <i class="mdi mdi-email-open"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Broadcast Mail</h6>
                                            <p class="text-muted mb-0">Sent release details to team</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">55 minutes ago</p>
                                            <p class="text-muted mb-0">35 tasks, 7 issues </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">UI Design</h6>
                                            <p class="text-muted mb-0">New application planning</p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">50 minutes ago</p>
                                            <p class="text-muted mb-0">27 tasks, 4 issues </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" hidden>
        <div class="col-sm-8 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Revenue</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">$32123</h2>
                                <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                            </div>
                            <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                        </div>

                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="table ">
                                <table>
                                    <?php
                                    for ($i = 0; $i < 7; $i++) {
                                        ?>
                                        <tr>
                                            <?php
                                            for ($j = 0; $j < 3; $j++) {
                                                ?>
                                                <td id="">
                                                    <table class="table">
                                                        <tr>
                                                            <td class="text-left" id="seat<?php echo $i . $j; ?>a">
                                                                <?php echo $i . $j; ?>A
                                                            </td>
                                                            <td class="text-center" id="seat<?php echo $i . $j; ?>b">
                                                                <?php echo $i . $j; ?>B
                                                            </td>
                                                            <td class="text-right" id="seat<?php echo $i . $j; ?>c">
                                                                <?php echo $i . $j; ?>C
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Purchase</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">$2039</h2>
                                <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p>
                            </div>
                            <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 col-xl-12 my-auto">
                            <input type="text" id="place" class="form-control" />
                            <br>
                            <input type="text" id="start" class="form-control" />
                            <br>
                            <button class="btn btn-primary" onclick="setplan();">Assign</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php
} else {
    echo '<div class="">User Not Define!</div>';
}


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
    function save(mail, tail) {
        //2 == user level, 3 -- profile;
        if (tail == 2) {
            var lvl = document.getElementById("ulevel").value;
            var infor = 'mail=' + mail + "&tail=" + tail + "&ulevel=" + lvl;
        } else if (tail == 3) {
            var dispname = document.getElementById("dispname").value;
            var cell = document.getElementById("cell").value;
            var userid = document.getElementById("userid").value;
            var infor = 'mail=' + mail + "&tail=" + tail + "&dispname=" + dispname + "&cell=" + cell + "&userid=" + userid;
        }

        // alert(infor);
        $("#ssd").html("");

        $.ajax({
            type: "POST",
            url: "backend/update-user-info.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#ssd').html('<span class=""><center>Changing User Level...</center></span>');
            },
            success: function (html) {
                $("#ssd").html(html);
            }
        });
    }

</script>