<?php
include 'header.php';


$refno = '';
$refdate = date('Y-m-d');

if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date('Y');
}

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
if (isset($_GET['ids'])) {
    $ids2 = $_GET['ids'];
    $new = 'block';
} else {
    $ids2 = '0';
    $new = 'none';
}

$sql0 = "SELECT * FROM slots where sccode='$sccode' and id='$ids2'";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    while ($row0 = $result0->fetch_assoc()) {
        $id2 = $row0["id"];
        $sname2 = $row0["slotname"];
    }
} else {
    $id2 = '';
    $sname2 = '';
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

<h3 class="d-print-none">Slots in this institute</h3>






<div class="row d-print-none" id="ren" style="display:<?php echo $new; ?>">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6>Add/Edit Slot : </h6>
                <div class="row">
                    <div class="col-md-3" hidden>
                        <div class="form-group row">
                            <label class="col-form-label pl-3">ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control bg-dark" id="iid" value="<?php echo $ids2; ?>"
                                    disabled />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Slot Name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="gname" value="<?php echo $sname2; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-primary btn-icon-text btn-block p-2" style=""
                                    onclick="savegroup(<?php echo $ids2;?>,1);"><i class="mdi mdi-plus"></i>
                                    Add / Update Slot</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-secondary" style=" ">
                        <thead>
                            <tr>
                                <th class="txt-right">Slot Name <span id="sscspan"></span></th>

                                <th class="txt-right"></th>
                            </tr>
                        </thead>

                        <tbody>



                            <?php
                            $cnt = 0;
                            $cntamt = 0;
                            $sql0 = "SELECT * FROM slots where sccode='$sccode' order by slotname";
                            $result0 = $conn->query($sql0);
                            if ($result0->num_rows > 0) {
                                while ($row0 = $result0->fetch_assoc()) {
                                    $id = $row0["id"];
                                    $sname = $row0["slotname"];





                                    ?>
                                    <tr>

                                        <td style="padding : 3px 10px; border:0px solid gray;">
                                            <div class="ooo"><?php echo $sname; ?></div>
                                        </td>


                                        <td style=" border:0px solid gray; text-align:right;">
                                            <div id="btn<?php echo $stid; ?>">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-inverse-info"
                                                        onclick="issue(<?php echo $id; ?>, 1)">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-inverse-danger"
                                                        onclick="savegroup(<?php echo $id; ?>, 2)">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                    
                                    <?php
                                }
                            } else {
                                echo '<tr><td></td><td colspan="3">No Slot Defined.<br><br>';
                                ?>
                                <button type="button" class="btn btn-inverse-success" onclick="savegroup(0, 5)">
                                    <i class="mdi mdi-check"></i> Set Default
                                </button>
                                <?php
                                echo '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
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
    document.getElementById('defbtn').innerHTML = 'Add New Slot';
    document.getElementById('defmenu').innerHTML = '';

    function defbtn() {
        window.location.href = 'slot.php?&ids=0';
    }
    function reload() {
        window.location.href = uri;
    }


    function goprint(stid) {
        var year = document.getElementById('year').value;
        var sec = document.getElementById('sec').value;
        var exam = document.getElementById('exam').value;
        window.location.href = 'testimonial-print.php?sec=' + sec + '&exam=' + exam + '&year=' + year + '&stid=' + stid;
    }

    function go() {
        window.location.href = 'slot.php';
    }
</script>

<script>
    function issue(id) {
        window.location.href = 'slot.php?&ids=' + id;
    }
</script>

<script>



    function savegroup(id, ont) {


        if (ont == 1) {
            var id = document.getElementById('iid').value;
            var gname = document.getElementById("gname").value;
        } else {
            var gname = '';
        }

        var infor = "id=" + id + "&ont=" + ont + "&gname=" + gname;
        alert(infor);
        $("#sscspan").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-slot.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sscspan').html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#sscspan").html(html);
                go();
            }
        });
    }
</script>