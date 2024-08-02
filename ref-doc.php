<?php
include 'header.php';


$id = 0;
$cont = '';
$refno = '';
$date = $td;
$title = '';
$cont = '';
if (isset($_GET['refno'])) {
    $refno = $_GET['refno'];

    if ($refno == '' || $refno == 0) {
        $sql0 = "SELECT * FROM refbook where sccode='$sccode' order by refno desc LIMIT 1 ;";
        $result01 = $conn->query($sql0);
        if ($result01->num_rows > 0) {
            while ($row5 = $result01->fetch_assoc()) {
                $refno = $row5["refno"];
            }
        } else {
            $refno = '0/' . $sy;
        }

        $refno = explode('/', $refno)[0] + 1 . '/' . $sy;
        // echo $rrr;

    } else {
        $sql0x = "SELECT * FROM ref_docs where refno='$refno' ;";
        $result0xtt = $conn->query($sql0x);
        if ($result0xtt->num_rows > 0) {
            while ($row0x = $result0xtt->fetch_assoc()) {
                $id = $row0x["id"];
                $refno = $row0x["refno"];
                $date = $row0x["date"];
                $title = $row0x["title"];
                $cont = $row0x["content"];
            }
        } else {
            $refno = '';
        }
    }

} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql0x = "SELECT * FROM ref_docs where id='$id' ;";
        $result0xtt = $conn->query($sql0x);
        if ($result0xtt->num_rows > 0) {
            while ($row0x = $result0xtt->fetch_assoc()) {
                $id = $row0x["id"];
                $refno = $row0x["refno"];
                $date = $row0x["date"];
                $title = $row0x["title"];
                $cont = $row0x["content"];
            }
        } else {
            $refno = '';
        }


    } else {
        $refno = 0;
        $id = 0;
    }

}




?>

<h3>Documents / Notes / Records</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">

                </h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Month</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="month">
                                    <option value="0"></option>
                                    <?php
                                    for ($x = 1; $x <= 12; $x++) {
                                        $flt = '';
                                        $xx = strtotime(date('Y') . '-' . $x . '-01');
                                        if ($month == $x) {
                                            $flt = 'selected';
                                        }
                                        echo '<option value="' . $x . '"' . $flt . '>' . date('F', $xx) . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Year</label>
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
                            <label class="col-form-label pl-3">&nbsp;</label>
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-fw p-2" style="width:100%;"
                                    onclick="go();">View Statement</button>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">&nbsp;</label>

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
                <h6 class="text-muted font-weight-normal">

                </h6>
                <div class="row">


                    <form class="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row d-flex mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Ref. No.</label>
                                        <input type="text" class="form-control text-dark bg-secondary" id="refno"
                                            value="<?php echo $refno; ?>" disabled />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control text-dark bg-secondary" id="date"
                                            value="<?php echo $date; ?>" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control text-dark bg-secondary" id="title"
                                            value="<?php echo $title; ?>" />
                                    </div>
                                </div>
                                <div class="row d-flex mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Content</label>
                                        <textarea name="textarea" id="default"
                                            class="form-control bg-dark text-warp"><?php echo $cont; ?></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" class="btn btn-inverse-success btn-block p-2" style="width:100%;"
                                    onclick="save(<?php echo $id; ?>, 0);">Save Document</button>

                            </div>
                            <div class="col-md-3 text-left p-0">
                                <div id="ssp"></div>
                            </div>
                        </div>
                    </form>
                    <script src="tinymce/tinymce.min.js"></script>
                    <script src="tinymce/setup.js"></script>


                    <?php

                    $sql0x = "SELECT * FROM ref_docs order by id desc limit 1 ;";
                    $result0xt = $conn->query($sql0x);
                    if ($result0xt->num_rows > 0) {
                        while ($row0x = $result0xt->fetch_assoc()) {
                            $partidx = $row0x["id"];
                            $cont = $row0x["content"];
                        }
                    }

                    // echo '<br><br>';
                    // echo $cont;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>

<script>
    document.getElementById('defbtn').value = "New Ref";
    document.getElementById('defmenu').value = "";

    function defbtn() {
        window.location.href = 'ref-doc.php?refno=';
    }

    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'exec-salary.php?m=' + m + '&y=' + y;
    }
    function go2() {
        var myContent = tinymce.get("default").getContent();
        alert(myContent);
    }
</script>


<script>
    function save(id, tail) {

        var editor = tinymce.get("default").getContent();
        var refno = document.getElementById('refno').value;
        var title = document.getElementById('title').value;
        var ddd = document.getElementById('date').value;
        var infor = "editor=" + editor + "&refno=" + refno + "&title=" + title + "&id=" + id + "&tail=" + tail + "&date=" + ddd;
        // alert(infor);
        $("#ssp").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-ref-docs.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#ssp').html('<span class="text-small">Saving Document <i class="mdi mdi-ray-start-end"></i><i class="mdi mdi-ray-start-end"></i><i class="mdi mdi-ray-start-end"></i> </span>');
            },
            success: function (html) {
                $("#ssp").html(html);
                // alert(infor);
            }
        });
    }
</script>