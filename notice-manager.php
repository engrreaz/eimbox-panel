<?php
include 'header.php';

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


$sql0 = "SELECT * FROM notice where id='$exid' and sccode='$sccode';";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row5 = $result0->fetch_assoc()) {
        $exid = $row5["id"];
        $title = $row5["title"];
        $descrip = $row5["descrip"];
        $expdate = $row5["expdate"];
        $teacher = $row5["teacher"];
        $smc = $row5["smc"];
        $guardian = $row5["guardian"];
        $sms = $row5["sms"];
        $pushnoti = $row5["pushnoti"];
        $category = $row5["category"];
        $email = $row5["email"];
    }
} else {
    $exid = $title = $descrip = $expdate = $teacher = $smc = $guardian = $sms = $pushnoti = $category = $email = '';
}
?>
<div class="float-right">
    <button type="button" style="" title="Add New Expenditure" class="btn btn-inverse-success mb-2" style=""
        onclick="addnew();" hidden>
        <i class="mdi mdi-library-plus"> Add New Class </i></button>
</div>
<h3>Notice Manager</h3>

<div class="row" style="display:<?php echo $newblock; ?>;">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover text-white">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ID :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control bg-dark" id="id"
                                            value="<?php echo $exid; ?>" disabled />
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Title :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control bg-dark" id="title"
                                            value="<?php echo $title; ?>" />
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Description :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control bg-dark" id="descrip"
                                            value="<?php echo $descrip; ?>" />
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Display Till :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control bg-dark" id="expdate"
                                            value="<?php echo $expdate; ?>" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Notice Type :
                                    </td>
                                    <td>
                                        <select class="form-control text-white" id="cate" onchange="got();">
                                            <option value="">---</option>
                                            <?php
                                            $sql0x = "SELECT * FROM notice_category order by id;";
                                            echo $sql0x;
                                            $result0rt = $conn->query($sql0x);
                                            if ($result0rt->num_rows > 0) {
                                                while ($row0x = $result0rt->fetch_assoc()) {
                                                    $catcat = $row0x["category"];
                                                    if ($catcat == $category) {
                                                        $selsec = 'selected';
                                                    } else {
                                                        $selsec = '';
                                                    }
                                                    echo '<option value="' . $catcat . '" ' . $selsec . ' >' . $catcat . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>User Group :
                                    </td>
                                    <td>
                                        <?php
                                        $teacherx = $smcx = $guardianx = '';
                                        if ($teacher == 1) {
                                            $teacherx = 'checked';
                                        }
                                        if ($smc == 1) {
                                            $smcx = 'checked';
                                        }
                                        if ($guardian == 1) {
                                            $guardianx = 'checked';
                                        }
                                        ?>
                                        <table style="border:0;" class="table table-borderless">
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-control" id="teacher"
                                                        value="<?php echo $teacher; ?>" <?php echo $teacherx; ?> />
                                                    <br>Teachers / Staffs
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-control" id="smc"
                                                        value="<?php echo $smc; ?>" <?php echo $smcx; ?> /> <br>SMC
                                                    Members
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-control" id="guardian"
                                                        value="<?php echo $guardian; ?>" <?php echo $guardianx; ?> />
                                                    <br>Students /
                                                    Guardians
                                                </td>
                                            </tr>
                                        </table>





                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Notification :
                                    </td>
                                    <td>
                                        <?php
                                        $teacherx = $smcx = $guardianx = $smsx = $pushnotix = $emailx = '';
                                        if ($sms == 1) {
                                            $smsx = 'checked';
                                        }
                                        if ($pushnoti == 1) {
                                            $pushnotix = 'checked';
                                        }
                                        if ($email == 1) {
                                            $emailx = 'checked';
                                        }

                                        ?>
                                        <table style="border:0;" class="table table-borderless">
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-control" id="sms"
                                                        value="<?php echo $sms; ?>" <?php echo $smsx; ?> />
                                                    <br> Send SMS
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-control" id="push"
                                                        value="<?php echo $pushnoti; ?>" <?php echo $pushnotix; ?> />
                                                    <br> Push Notification
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-control" id="email"
                                                     <?php echo $emailx; ?> /> <br> Send Email
                                                </td>
                                            </tr>
                                        </table>





                                    </td>
                                    <td></td>
                                </tr>


                                <tr>
                                    <td></td>
                                    <td>
                                        <div id="">
                                            <button class="btn btn-inverse-primary" onclick="save(0,1);">Save</button>

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

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div id="sspd"></div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover text-white" id="main-table-search">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Notices</th>
                                    <th>Time Till</th>
                                    <th style="text-align:center;">To Whom</th>
                                    <th style="text-align:center;">Notification</th>
                                    <th style="text-align:center;">Submition</th>
                                    <th style="text-align:right;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $slx = 1;
                                $sql0x = "SELECT * FROM notice where sccode='$sccode'   order by id desc;";
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $title = $row0x["title"];
                                        $descrip = $row0x["descrip"];
                                        $expdate = $row0x["expdate"];
                                        $cates = $row0x["category"];

                                        $teacher = $row0x["teacher"];
                                        $smc = $row0x["smc"];
                                        $guardian = $row0x["guardian"];

                                        $sms2 = $row0x["sms"];
                                        $pushnoti2 = $row0x["pushnoti"];
                                        $email2 = $row0x["email"];

                                        $eby = $row0x["entryby"];
                                        $etime = $row0x["entrytime"];
                                        ?>
                                        <tr>
                                            <td><?php echo $slx; ?></td>
                                            <td><?php echo $title; ?><br><small><?php echo $descrip; ?></small></td>
                                            <td><?php echo date('d/m/y', strtotime($expdate)); ?></td>
                                            <td style="text-align:center;">
                                                <?php
                                                echo '<i title="Teachers/Staffs" class="mdi mdi-account-circle mdi-18px p-2 text-muted"></i>';
                                                echo '<i title="SMC Committee Member" class="mdi mdi-account-box mdi-18px p-2 text-muted"></i>';
                                                echo '<i title="Guardians/Students" class="mdi mdi-account-multiple mdi-18px p-2"></i>';
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php
                                                echo '<i title="SMS" class="mdi mdi-message mdi-18px p-2 text-muted"></i>';
                                                echo '<i title="Push Notification" class="mdi mdi-bell mdi-18px p-2"></i>';
                                                echo '<i title="Email Notification" class="mdi mdi-email mdi-18px p-2 text-muted"></i>';
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <small><?php echo $eby; ?></small><br><small><?php echo $etime; ?></small>
                                            </td>


                                            <td style="text-align:right;">
                                                <div id="ssp<?php echo $id; ?>">


                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" title="View Profile" class="btn btn-inverse-info"
                                                            onclick="edit(<?php echo $id; ?>,1);">
                                                            <i class="mdi mdi-grease-pencil"></i>
                                                        </button>

                                                        <button type="button" title="Edit Profile"
                                                            class="btn btn-inverse-danger"
                                                            onclick="save(<?php echo $id; ?>,2);">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $slx++;
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
    document.getElementById('defbtn').innerHTML = 'New Notice';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        addnew();
    }

    function addnew() {
        var tail = '';
        window.location.href = 'notice-manager.php?addnew' + tail;
    }

    function edit(id, taill) {
        window.location.href = 'notice-manager.php?addnew=' + id;
    }

</script>

<script>
    function save(ids, ont) {
        if (ids == 0) {
            var ids = document.getElementById('id').value;
        }
        var title = document.getElementById('title').value;
        var descrip = document.getElementById('descrip').value;
        var expdate = document.getElementById('expdate').value;

        var teacher = document.getElementById('teacher').checked;
        var smc = document.getElementById('smc').checked;
        var guardian = document.getElementById('guardian').checked;

        var sms = document.getElementById('sms').checked;
        var push = document.getElementById('push').checked;
        var email = document.getElementById('email').checked;
        var cate = document.getElementById('cate').value;

        var infor = "id=" + ids + '&ont=' + ont + '&title=' + title + '&descrip=' + descrip + '&expdate=' + expdate + '&teacher=' + teacher + '&smc=' + smc + '&guardian=' + guardian + "&sms=" + sms + "&push=" + push + "&cate=" + cate + "&email=" + email;
        alert(infor);
        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "backend/save-notice.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspd').html('<span class="">Saving Data....');
            },
            success: function (html) {
                $("#sspd").html(html);
                // window.location.href = 'notice-manager.php';
            }
        });
    }
</script>

<script>
    function sl(id, tail) {
        var infor = "id=" + id + '&tail=' + tail;
        // alert(infor);
        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "backend/adjclssl.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspd').html('<span class=""><center>Saving....</center></span>');
            },
            success: function (html) {
                $("#sspd").html(html);
                window.location.href = 'classes.php';
            }
        });
    }


    $(document).ready(function () {
        $('#main-table-search').DataTable();
    });
</script>