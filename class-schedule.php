<?php
include 'header.php';


$refno = '';
$refdate = date('Y-m-d');

if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date('Y');
}

if (isset($_GET['slot'])) {
    $slot2 = $_GET['slot'];
} else {
    $slot2 = 'School';
}

if (isset($_GET['addnew'])) {
    $newblock = 'block';
    $id2 = $_GET['addnew'];
    if ($id2 == '') {
        $id2 = 0;
    }
} else {
    $newblock = 'none';
    $id2 = 0;
}

?>

<h3 class="d-print-none">Class Schedule</h3>
<p class="d-print-none">
    <code>Settings <i class="mdi mdi-arrow-right"></i> Academics / Class Schedule </code>
</p>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                </h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Session Year</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="year">
                                    <option value="0"></option>
                                    <?php
                                    for ($y = date('Y'); $y >= 2024; $y--) {
                                        $flt2 = '';
                                        if ($year == $y) {
                                            $flt2 = 'selected';
                                        }
                                        echo '<option value="' . $y . '"' . $flt2 . '>' . $y . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Slot :</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="slot" onchange="go();">
                                    <option value=" ">---</option>
                                    <?php
                                    $sql0x = "SELECT * FROM slots where sccode='$sccode';";
                                    $result0x = $conn->query($sql0x);
                                    if ($result0x->num_rows > 0) {
                                        while ($row0x = $result0x->fetch_assoc()) {
                                            $slot = $row0x["slotname"];
                                            if ($slot == $slot2) {
                                                $selr = 'selected';
                                            } else {
                                                $selr = '';
                                            }
                                            echo '<option value="' . $slot . '" ' . $selr . ' >' . $slot . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>





                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-success btn-icon-text btn-block p-2" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i> Show Schedule</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row d-print-none" id="ren" style="display:<?php echo $newblock;?>">

<?php 
$sql0x = "SELECT * FROM classschedule where sccode='$sccode' and slots='$slot2' and id='$id2';";
$result0x = $conn->query($sql0x);
if ($result0x->num_rows > 0) {
    while ($row0x = $result0x->fetch_assoc()) {
        $ii = $row0x["id"];
        $pp = $row0x["period"];
        $ts = $row0x["timestart"];
        $te = $row0x["timeend"];
    }} else {
        $ii = 0; $ts = ''; $te = ''; $pp = 0;
    }

?>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h6>Add/Edit Schedule <span id="sscspan"></span></h6>
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Period</label>
                            <div class="col-12">
                                <input type="text" class="form-control bg-dark" id="iid" value="<?php echo $ii; ?>" disabled hidden/>
                                <select class="form-control text-white" id="period">
                             
                                    <?php
                                    for ($r = 0; $r <= 8; $r++) {
                                        $sss = '';
                                        if ($pp == $r) {
                                            $sss = 'selected';
                                        }
                                        echo '<option value="' . $r . '" ' . $sss . '>' . $r . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Time Start</label>
                            <div class="col-12">
                                <input type="time" class="form-control" id="tstart" value="<?php echo $ts; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Time End</label>
                            <div class="col-12">
                                <input type="time" class="form-control" id="tend" value="<?php echo $te; ?>" />
                            </div>
                        </div>
                    </div>
       
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-primary btn-icon-text btn-block p-2" style=""
                                    onclick="save(<?php echo $ii;?>,1);"><i class="mdi mdi-plus"></i>
                                    Add / Update Schedule</button>
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
                    <table class="table  table-striped " style=" ">
                        <thead>
                            <tr>
                                <td class="txt-right">#</td>
                                <td class="txt-right">Period</td>
                                <td class="txt-right">Time Start</td>
                                <td class="txt-right">Time End</td>
                                <td class="txt-right">Duration (min)</td>
                                <td class="txt-right"></td>
                            </tr>
                        </thead>

                        <tbody>



                            <?php
                            $cnt = 0;
                            $cntamt = 0;
                            $sql0 = "SELECT * FROM classschedule where sessionyear='$sy' and sccode='$sccode' and slots='$slot2' order by timestart";
                            $result0 = $conn->query($sql0);
                            if ($result0->num_rows > 0) {
                                while ($row0 = $result0->fetch_assoc()) {
                                    $idx = $row0["id"];
                                    $period = $row0["period"];
                                    $tstart = $row0["timestart"];
                                    $tend = $row0["timeend"];
                                    $dura = round($row0["duration"]/60);





                                    ?>
                                    <tr>
                                        <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">

                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><?php echo $period; ?></div>
                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><?php echo $tstart; ?></div>
                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><?php echo $tend; ?></div>
                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><?php echo $dura; ?></div>
                                        </td>

                                        <td style=" border:1px solid gray;">
                                            <div id="btn<?php echo $stid; ?>">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-inverse-info"
                                                        onclick="issue(<?php echo $idx; ?>)">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-inverse-danger"
                                                        onclick="savegroup(<?php echo $idx; ?>, 2)">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                            
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td></td><td colspan="3">No Group Assigned.</td></tr>';
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
    document.getElementById('defbtn').innerHTML = 'Add New Group';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        addnew();
        
    }
    function reload() {
        window.location.href = uri;
    }
    function resultentry(roll) {
        if (roll == 0) {
            document.getElementById('boardroll').value = '';
        } else {
            document.getElementById('boardroll').value = roll;
        }

        document.getElementById('ren').style.display = 'block';
        document.getElementById('boardroll').focus();
    }

    function addnew() {
        var year = document.getElementById('year').value;
        var slot = document.getElementById('slot').value;
        window.location.href = 'class-schedule.php?&slot=' + slot + '&year=' + year + "&addnew";
         }

    function go() {
        var year = document.getElementById('year').value;
        var slot = document.getElementById('slot').value;
        window.location.href = 'class-schedule.php?&slot=' + slot + '&year=' + year;
    }
</script>

<script>
    function issue(id) {
        var year = document.getElementById('year').value;
        var slot = document.getElementById('slot').value;
        window.location.href = 'class-schedule.php?&slot=' + slot + '&year=' + year + "&addnew=" + id;
    }

</script>

<script>
  

    function save(id, ont) {
        // 1 = save, 2 = del
        if(ont == 1){
             var id = document.getElementById('iid').value;
             var year = document.getElementById('year').value;
        var slot = document.getElementById('slot').value;

        var peri = document.getElementById('period').value;

        var tstart = document.getElementById("tstart").value;
        var tend = document.getElementById("tend").value;

        var infor = "id=" + id + "&ont=" + ont + "&year=" + year + "&slot=" + slot +  "&period=" + peri +  "&tstart=" + tstart +  "&tend=" + tend ;

        } else {
            var infor = "id=" + id + "&ont=" + ont ;
        }
        // alert(infor);
        

        $("#sscspan").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-schedule.php",
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


