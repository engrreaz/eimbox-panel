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
        // $ = $row5[""];
    }
} else {
    $exid = $title = $descrip = $expdate = $teacher = $smc = $guardian = '';
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
                                    <td>User Group :
                                    </td>
                                    <td>
                                        <?php 
                                        $teacherx = $smcx = $guardianx = '';
                                            if($teacher == 1) {$teacherx = 'checked';}
                                            if($smc == 1) {$smcx = 'checked';}
                                            if($guardian == 1) {$guardianx = 'checked';}
                                        ?>
                                        <input type="checkbox" class="form-control bg-dark" id="teacher"
                                            value="<?php echo $teacher; ?>" <?php echo $teacherx;?> /> Teachers / Staffs

                                        <input type="checkbox" class="form-control bg-dark" id="smc"
                                            value="<?php echo $smc; ?>"  <?php echo $smcx;?> /> SMC Members

                                        <input type="checkbox" class="form-control bg-dark" id="guardian"
                                            value="<?php echo $guardian; ?>"  <?php echo $guardianx;?> /> Students / Guardians
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
                                        $teacher = $row0x["teacher"];
                                        $smc = $row0x["smc"];
                                        $guardian = $row0x["guardian"];
                                        $eby = $row0x["entryby"];
                                        $etime = $row0x["entrytime"];
                                        ?>
                                        <tr>
                                            <td><?php echo $slx; ?></td>
                                            <td><?php echo $title; ?><br><small><?php echo $descrip; ?></small></td>
                                            <td><?php echo date('d/m/y', strtotime($expdate)); ?></td>
                                            <td style="text-align:center;">
                                                <?php
                                                    echo '<i title="Teachers/Staffs" class="mdi mdi-account-circle mdi-18px p-2"></i>';
                                                    echo '<i title="SMC Committee Member" class="mdi mdi-account-box mdi-18px p-2"></i>';
                                                    echo '<i title="Guardians/Students" class="mdi mdi-account-multiple mdi-18px p-2"></i>';
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <small><?php echo $eby; ?></small><br><small><?php echo $etime; ?></small></td>


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
    document.getElementById('defbtn').innerHTML = 'Add New Class';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        addnew();
    }


    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'expenditure.php?&m=' + m + '&y=' + y;
    }
    function setbox() {
        var datt = document.getElementById('clsx').value;
        if (datt == '-') {
            datt = '<?php echo $ccc; ?>';
            document.getElementById('clstr').style.display = 'block';
        } else {
            document.getElementById('clstr').style.display = 'none';
        }
        document.getElementById('cls').value = datt;
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

        var teacher = document.getElementById('teacher').value;
        var smc = document.getElementById('smc').value;
        var guardian = document.getElementById('guardian').value;

        var infor = "id=" + ids + '&ont=' + ont + '&title=' + title + '&descrip=' + descrip + '&expdate=' + expdate + '&teacher=' + teacher + '&smc=' + smc + '&guardian=' + guardian;
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
                window.location.href = 'notice-manager.php';
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