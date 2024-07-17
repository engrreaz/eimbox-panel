<?php
include 'header.php';


if (isset($_GET['id'])) {
    $idq = $_GET['id'];
} else {
    $idq = 0;
}

if (isset($_GET['id'])) {
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
            <div class="card-body">
                <div class="row">
                    <div class="col-12 d-flex">
                        <div class="col-md-2">
                            <label class="form-label text-small">ID</label>
                            <input type="text" class="form-control" value="<?php echo $idq; ?>" id="id" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small">Ref. No.</label>
                            <input type="text" class="form-control" value="<?php echo $refnoq; ?>" id="refno" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small">Date</label>
                            <input type="text" class="form-control" value="<?php echo $dateq; ?>" id="date" />
                        </div>
                        <div class="col-md-1">
                            <label class="form-label text-small">Month</label>
                            <input type="text" class="form-control" value="<?php echo $monthq; ?>" id="month" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small">Year</label>
                            <input type="text" class="form-control" value="<?php echo $yearq; ?>" id="year" />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-small">Category</label>
                            <select class="form-control text-white" id="category">
                                <?php
                                $sql0x = "SELECT * FROM financesetup where (sccode='$sccode' or sccode=0) and particulareng!='' and (sessionyear='$sy' or sessionyear=0) order by particulareng ;";
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Slot</label>
                            <div class="col-12">
                                <select class="form-control text-secondary" id="slot">
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


                        <div class="col-md-3">
                            <label class="form-label text-small">Title</label>
                            <input type="text" class="form-control" value="<?php echo $titleq; ?>" id="title" />
                        </div>
                        <div class="col-md-5">
                            <label class="form-label text-small">Description</label>
                            <input type="text" class="form-control" value="<?php echo $descripq; ?>" id="descrip" />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-small " id="stinfo">&nbsp;</label>
                            <button class="btn btn-inverse-success p-2 btn-block"
                                onclick="save(<?php echo $idq; ?>, 0);" >Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}

?>









<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Reference Register</h4>
            </p>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Register Name </th>
                            <th> Dept. </th>
                            <th> Dept. </th>
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

                                ?>
                                <tr>
                                    <td class="py-1">
                                        <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td> <?php echo $refno; ?> </td>
                                    <td> <?php echo $date; ?> </td>
                                    <td> <?php echo $title; ?> </td>
                                    <td>
                                        <label class="badge badge-primary">View Book</label>
                                        <button class="btn btn-inverse-warning"
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

        var infor = "id=" + id + "&refno=" + refno  + "&slot=" + slot +  "&date=" + date + "&month=" + month + "&year=" + year + "&cate=" + cate + "&title=" + title + "&descrip=" + descrip + "&tail=" + tail;
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


</script>