<?php
include 'header.php';

if (isset($_GET['refno'])) {
    $refno = $_GET['refno'];
    $sql0x = "SELECT * FROM refbook where sccode='$sccode' and refno='$refno' ;";
    $result0xqxx = $conn->query($sql0x);
    if ($result0xqxx->num_rows > 0) {
        while ($row0x = $result0xqxx->fetch_assoc()) {
            $idq = $row0x["id"];
        }
    } else {
        if (isset($_GET['id'])) {
            $idq = $_GET['id'];
        } else {
            $idq = 0;
        }
    }
} else {
    if (isset($_GET['id'])) {
        $idq = $_GET['id'];
    } else {
        $idq = 0;
    }
}





if ($idq > 0) {
    $sql0x = "SELECT * FROM refbook where sccode='$sccode' and id='$idq' ;";
    $result0xq = $conn->query($sql0x);
    if ($result0xq->num_rows > 0) {
        while ($row0x = $result0xq->fetch_assoc()) {
            $refnoq = $row0x["refno"];
            $dateq = $row0x["date"];
            $monthq = $row0x["month"];
            $yearq = $row0x["year"];
            $partidq = $row0x["partid"];
            $titleq = $row0x["title"];
            $descripq = $row0x["descrip"];
            $slot = $row0x["slot"];
        }
    } else {
        $refnoq = '';
        $dateq = $td;
        $titleq = '';
        $descripq = '';
        $monthq = NULL;
        $yearq = NULL;
        $partidq = '';
        $slot = '';
    }
    ?>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body ">
                <div class="row pl-4 d-block">
                    <h4 class="mb-0 pb-0"><small><b>Add New/Edit Reference Information</b></small></h4>
                    <h6 class="text-warning text-small mt-0 pt-0"><small>You'll edit this reference data within 24 hours.
                            After that, it will lock permanently.</small></h6>

                </div>
                <div class="row">
                    <div class="col-12 d-flex">
                        <div class="col-md-2">
                            <label class="form-label text-small">ID</label>
                            <input type="text" class="form-control " value="<?php echo $idq; ?>"
                                id="id" disabled />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small">Ref. No.</label>
                            <input type="text" class="form-control" value="<?php echo $refnoq; ?>" id="refno" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small">Date</label>
                            <input type="date" class="form-control" value="<?php echo $dateq; ?>" id="date" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small">Audit Month</label>

                            <select class="form-control " id="month">
                                <option value="0"></option>
                                <?php
                                for ($x = 1; $x <= 12; $x++) {
                                    $flt = '';
                                    $xx = strtotime(date('Y') . '-' . $x . '-01');
                                    if ($monthq == $x) {
                                        $flt = 'selected';
                                    }
                                    echo '<option value="' . $x . '"' . $flt . '>' . date('F', $xx) . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small">Audit Year</label>
                            <select class="form-control " id="year">
                                <option value="0"></option>
                                <?php
                                for ($y = date('Y'); $y >= 2024; $y--) {
                                    $flt2 = '';
                                    if ($yearq == $y) {
                                        $flt2 = 'selected';
                                    }
                                    echo '<option value="' . $y . '"' . $flt2 . '>' . $y . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group row">
                                <label class="col-form-label pl-3">Slot</label>
                                <div class="col-12">
                                    <select class="form-control " id="slot">
                                        <?php
                                        $sql0x = "SELECT * FROM slots where sccode='$sccode' ;";
                                        $result0x2z = $conn->query($sql0x);
                                        if ($result0x2z->num_rows > 0) {
                                            while ($row0x = $result0x2z->fetch_assoc()) {
                                                $slotname = $row0x["slotname"];
                                                if ($slot == $slotname) {
                                                    $seld = 'selected';
                                                } else {
                                                    $seld = '';
                                                }
                                                echo '<option value="' . $slotname . '"' . $seld . '>' . $slotname . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex">

                        <div class="col-md-3">
                            <label class="form-label text-small">Category</label>
                            <select class="form-control " id="category">
                                <?php
                                $sql0x = "SELECT * FROM financesetup where (sccode=0) and particulareng!='' and (sessionyear=0) order by particulareng ;";
                                $result0xt = $conn->query($sql0x);
                                if ($result0xt->num_rows > 0) {
                                    while ($row0x = $result0xt->fetch_assoc()) {
                                        $partidx = $row0x["id"];
                                        $pe = $row0x["particulareng"];
                                        $pb = $row0x["particularben"];
                                        if ($partidx == $partidq) {
                                            $sel = 'selected';
                                        } else {
                                            $sel = '';
                                        }
                                        echo '<option value="' . $partidx . '" ' . $sel . '>' . $pe . ' &bull; ' . $pb . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-small">Title <b>(in a word only)</b></label>
                            <input type="text" class="form-control" value="<?php echo $titleq; ?>" id="title" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-small">Description</label>
                            <input type="text" class="form-control" value="<?php echo $descripq; ?>" id="descrip" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small " id="stinfo">&nbsp;</label>
                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                <button class="btn btn-inverse-success p-2 "
                                    onclick="save(<?php echo $idq; ?>, 0);">Save</button>

                                <button class="btn btn-inverse-danger p-2"
                                    onclick="save(<?php echo $idq; ?>, 5);">Delete</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
} else {
    echo '<div id="new-part" hidden></div>';
}

?>









<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Reference Register Book</h4>
            </p>
            <div class="table-responsive">
                <table class="table " id="main-table-search">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Ref. No </th>
                            <th> M/Y </th>
                            <th> Date </th>
                            <th> Description </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sccodes = $sccode * 10;
                        $sql0x = "SELECT * FROM refbook where sccode='$sccode' order by id desc ;";
                        $result0x = $conn->query($sql0x);
                        if ($result0x->num_rows > 0) {
                            while ($row0x = $result0x->fetch_assoc()) {
                                $id = $row0x["id"];
                                $refno = $row0x["refno"];
                                $date = $row0x["date"];
                                $title = $row0x["title"];
                                $descrip = $row0x["descrip"];
                                $my = $row0x["month"] . '/' . $row0x["year"];

                                ?>
                                <tr>
                                    <td class="py-1">
                                        <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td> <?php echo $refno; ?> </td>
                                    <td> <?php echo $my; ?> </td>
                                    <td> <?php echo $date; ?> </td>
                                    <td> <?php echo $title; ?> </td>
                                    <td>
                                        <button class="btn btn-inverse-primary border-primary">View Book</button>
                                        <button class="btn btn-inverse-warning border-warning"
                                            onclick="edit(<?php echo $id; ?>);">Edit</button>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    document.getElementById('defbtn').innerHTML = 'New Ref.';
    document.getElementById('defmenu').innerHTML = '';

    function defbtn() {
        document.getElementById("new-part"). innerHTML += '<input id="refno"><input id="date"><input id="month"><input id="year"><input id="category"><input id="title"><input id="descrip"><input id="slot">';
        document.getElementById("refno").value = "";
        document.getElementById("date").value = "<?php echo $td; ?>";
        document.getElementById("month").value = "<?php echo date('m'); ?>";
        document.getElementById("year").value = "<?php echo date('Y'); ?>";;
        document.getElementById("category").value = '';
        document.getElementById("title").value = '';
        document.getElementById("descrip").value = '';
        document.getElementById("slot").value = '';

        save(0, 0);
    }

    function edit(id) {
        window.location.href = 'refbook.php?id=' + id;
    }


    function save(id, tail) {
        var refno = document.getElementById("refno").value;
        var date = document.getElementById("date").value;
        var month = document.getElementById("month").value;
        var year = document.getElementById("year").value;
        var cate = document.getElementById("category").value;
        var title = document.getElementById("title").value;
        var descrip = document.getElementById("descrip").value;
        var slot = document.getElementById("slot").value;

        var infor = "id=" + id + "&refno=" + refno + "&slot=" + slot + "&date=" + date + "&month=" + month + "&year=" + year + "&cate=" + cate + "&title=" + title + "&descrip=" + descrip + "&tail=" + tail;
        // alert(infor);
        $("#stinfo").html("");

        $.ajax({
            type: "POST",
            url: "backend/save-refbook.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#stinfo').html('<span class="mif-spinner4 mif-ani-pulse"></span>');
            },
            success: function (html) {
                $("#stinfo").html(html);
                // var stid = document.getElementById("stinfo").innerHTML;
                // if (stid == '0') {
                //     window.location.href = 'students-edit.php?cls=' + classname + '&sec=' + sectionname + '&roll=' + rollno;
                // } else {
                window.location.href = 'refbook.php';
                // }
            }
        });
    }

    $(document).ready(function () {
        $('#main-table-search').DataTable();
    });

</script>