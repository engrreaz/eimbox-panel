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


$sql0 = "SELECT * FROM areas where id='$exid' and user='$rootuser' and sessionyear='$sy';";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row5 = $result0->fetch_assoc()) {
        $ccc = $row5["areaname"];
        $sss = $row5["subarea"];
        $exid = $row5["id"];
    }
} else {
    $exid = $ccc = $sss = '';
}
?>
<div class="float-right">
    <button type="button" style="" title="Add New Expenditure" class="btn btn-inverse-success" style=""
        onclick="addnew();">
        <i class="mdi mdi-library-plus"> Add New Exam </i></button>
</div>
<h3>Exam Management Tool</h3>



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
                                    <td>Exam Title :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="examtitle" value="<?php echo $sss; ?>" />
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>slot :
                                    </td>
                                    <td>
                                        <select class="form-control" id="slot">
                                            <option value=""></option>
                                            <?php
                                            $sql0 = "SELECT * FROM slots where sccode='$sccode';";
                                            $result03 = $conn->query($sql0);
                                            if ($result03->num_rows > 0) {
                                                while ($row5 = $result03->fetch_assoc()) {
                                                    $slotname = $row5["slotname"];

                                                    echo '<option value="' . $slotname . '">' . $slotname . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>

                                    </td>
                                    <td></td>
                                </tr>


                                <tr>
                                    <td>Class :
                                    </td>
                                    <td>
                                    <select class="form-control" id="cls">
                                            <option value=""></option>
                                            <?php
                                            $sql0 = "SELECT * FROM areas where user='$rootuser' group by areaname order by idno;";
                                            $result03 = $conn->query($sql0);
                                            if ($result03->num_rows > 0) {
                                                while ($row5 = $result03->fetch_assoc()) {
                                                    $clsname = $row5["areaname"];

                                                    echo '<option value="' . $clsname . '">' . $clsname . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
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
                                    <td>Date :
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" id="date" value="<?php echo $sss; ?>" />
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
                                    <th>Exam Title</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Date Start</th>
                                    <th style="text-align:right;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $slx = 1;
                                $sql0x = "SELECT * FROM examlist where sccode='$sccode' and sessionyear='$sy'  order by id;";
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $id = $row0x["id"];
                                        $exam = $row0x["examtitle"];
                                        $cls = $row0x["classname"];
                                        $sec = $row0x["sectionname"];
                                        $datestart = $row0x["datestart"];
                                        ?>
                                        <tr>
                                            <td><?php echo $slx; ?></td>
                                            <td><?php echo $exam; ?></td>
                                            <td><?php echo $cls; ?></td>
                                            <td><?php echo $sec; ?></td>
                                            <td><?php echo date('d F, Y', strtotime($datestart)); ?></td>


                                            <td>
                                                <div id="ssp<?php echo $id; ?>">
                                                    <label onclick="edit(<?php echo $id; ?>,1);" class="icon-btn btn-info"><i
                                                            class="mdi mdi-grease-pencil"></i></label>
                                                    <label onclick="savex(<?php echo $id; ?>,2);" class="icon-btn btn-danger"><i
                                                            class="mdi mdi-delete"></i></label>
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
    document.getElementById('defbtn').innerHTML = 'New Exam';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {

    }


    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'expenditure.php?&m=' + m + '&y=' + y;
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
        window.location.href = 'exam-list.php?addnew' + tail;
    }

    function edit(id, taill) {
        window.location.href = 'classes.php?addnew=' + id;
    }

</script>

<script>
    function save(ids, ont) {
        
        var exam = document.getElementById('examtitle').value;
        var slot = document.getElementById('slot').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        var date = document.getElementById('date').value;
        
        var infor = "id=" + ids + '&cls=' + cls + '&sec=' + sec + '&ont=' + ont + '&exam=' + exam + '&slot=' + slot + '&date=' + date;
 
        $("#gex").html("");

        $.ajax({
            type: "POST",
            url: "backend/save-exam.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#gex').html('<span class="">Saving Data....');
            },
            success: function (html) {
                $("#gex").html(html);
                window.location.href = 'exam-list.php';
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