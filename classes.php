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


$sql0 = "SELECT * FROM areas where id='$exid' and user='$rootuser';";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row5 = $result0->fetch_assoc()) {
        $yyy = $row5["sessionyear"];
        $ccc = $row5["areaname"];
        $sss = $row5["subarea"];
        $exid = $row5["id"];
    }
} else {
    $exid = $ccc = $sss = '';
}
?>
<div class="float-right">
    <button type="button" style="" title="Add New Expenditure" class="btn btn-inverse-success mb-2" style=""
        onclick="addnew();" hidden>
        <i class="mdi mdi-library-plus"> Add New Class </i></button>
</div>
<h3>Classes & Sections</h3>



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
                                    <td>Class :
                                    </td>
                                    <td>
                                        <select class="form-control" id="clsx" onchange="setbox();">
                                            <option value=""></option>
                                            <option value="Play" <?php if ($ccc == 'Play') {
                                                echo 'selected';
                                            } ?>>Play
                                            </option>
                                            <option value="Nursery" <?php if ($ccc == 'Nursery') {
                                                echo 'selected';
                                            } ?>>
                                                Nursery</option>
                                            <option value="Pre-School" <?php if ($ccc == 'Pre-School') {
                                                echo 'selected';
                                            } ?>>
                                                Pre-School</option>
                                            <option value="One" <?php if ($ccc == 'One') {
                                                echo 'selected';
                                            } ?>>One</option>
                                            <option value="Two" <?php if ($ccc == 'Two') {
                                                echo 'selected';
                                            } ?>>Two</option>
                                            <option value="Three" <?php if ($ccc == 'Three') {
                                                echo 'selected';
                                            } ?>>Three
                                            </option>
                                            <option value="Four" <?php if ($ccc == 'Four') {
                                                echo 'selected';
                                            } ?>>Four
                                            </option>
                                            <option value="Five" <?php if ($ccc == 'Five') {
                                                echo 'selected';
                                            } ?>>Five
                                            </option>
                                            <option value="Six" <?php if ($ccc == 'Six') {
                                                echo 'selected';
                                            } ?>>Six</option>
                                            <option value="Seven" <?php if ($ccc == 'Seven') {
                                                echo 'selected';
                                            } ?>>Seven
                                            </option>
                                            <option value="Eight" <?php if ($ccc == 'Eight') {
                                                echo 'selected';
                                            } ?>>Eight
                                            </option>
                                            <option value="Nine" <?php if ($ccc == 'Nine') {
                                                echo 'selected';
                                            } ?>>Nine
                                            </option>
                                            <option value="Ten" <?php if ($ccc == 'Ten') {
                                                echo 'selected';
                                            } ?>>Ten</option>
                                            <option value="SSC" <?php if ($ccc == 'SSC') {
                                                echo 'selected';
                                            } ?>>SSC</option>
                                            <option value="Eleven" <?php if ($ccc == 'Eleven') {
                                                echo 'selected';
                                            } ?>>Eleven
                                            </option>
                                            <option value="Twelve" <?php if ($ccc == 'Twelve') {
                                                echo 'selected';
                                            } ?>>Twelve
                                            </option>
                                            <option value="HSC" <?php if ($ccc == 'HSC') {
                                                echo 'selected';
                                            } ?>>HSC</option>
                                            <option value=""></option>
                                            <option value="-">Not in the list</option>
                                        </select>
                                        <div id="clstr" class="mt-2" style="display:none; width:100%;">
                                            <input type="text" class="form-control" id="cls"
                                                value="<?php echo $ccc; ?>" />
                                        </div>

                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Section :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="sec" value="<?php echo $sss; ?>" />
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>Session : 
                                    </td>
                                    <td>
                                        <?php $y1 = date('Y'); $y2 = date('Y') . '-' . date('y') + 1; ?>
                                        <select class="form-control" id="syx" onchange="setbox();">
                                            <option value=""></option>
                                            <option value="<?php echo $y1;?>" <?php if ($yyy == $y1) {
                                                echo 'selected';
                                            } ?>><?php echo $y1;?>
                                            </option>
                                            <option value="<?php echo $y2;?>" <?php if ($yyy == $y2) {
                                                echo 'selected';
                                            } ?>><?php echo $y2;?>
                                            </option>
                                            
                                        </select>
                                        <div id="clstr" class="mt-2" style="display:none; width:100%;">
                                            <input type="text" class="form-control" id="cls"
                                                value="<?php echo $ccc; ?>" />
                                        </div>

                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <div id="">
                                            <button class="btn btn-primary" onclick="save(0,1);">Save</button>

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
                        <table class="table table-hover text-white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Session</th>
                                    <th style="text-align:center;">SL up/dn</th>
                                    <th style="text-align:right;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $slx = 1;
                                $sql0x = "SELECT * FROM areas where user='$rootuser' and sessionyear LIKE '$sy%'  order by idno, id;";
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $cls = $row0x["areaname"];
                                        $sec = $row0x["subarea"];
                                        $slno = $row0x["idno"];
                                        $syear = $row0x["sessionyear"];
                                        ?>
                                        <tr>
                                            <td><?php echo $slx; ?></td>
                                            <td><?php echo $cls; ?></td>
                                            <td><?php echo $sec; ?></td>
                                            <td><?php echo $syear; ?></td>
                                            <td style="text-align:center;">
                                                <div>
                                                    <div class="button-group" role="group" aria-label="Basic example">

                                                        <button type="button" class="btn btn-inverse-primary"
                                                            onclick="sl(<?php echo $id; ?>,1)">
                                                            <i class="mdi mdi-arrow-down"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-inverse-primary"
                                                            onclick="sl(<?php echo $id; ?>,-1)">
                                                            <i class="mdi mdi-arrow-up"></i>
                                                        </button>
                                                    </div>
                                                </div>


                                                <span id="sspd"></span>
                                            </td>

                                            <td>
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
        window.location.href = 'classes.php?addnew' + tail;
    }

    function edit(id, taill) {
        window.location.href = 'classes.php?addnew=' + id;
    }

</script>

<script>
    function save(ids, ont) {
        if (ids == 0) {
            var ids = document.getElementById('id').value;
        }
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        var syx = document.getElementById('syx').value;

        var infor = "id=" + ids + '&cls=' + cls + '&sec=' + sec + '&ont=' + ont + '&sy=' + syx ;
        // alert(infor);
        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "backend/save-class.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspd').html('<span class="">Saving Data....');
            },
            success: function (html) {
                $("#sspd").html(html);
                window.location.href = 'classes.php';
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
</script>