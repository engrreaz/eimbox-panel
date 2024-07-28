<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

if (isset($_GET['m'])) {
    $month = $_GET['m'];
} else {
    $month = 0;
}
if (isset($_GET['y'])) {
    $year = $_GET['y'];
} else {
    $year = 0;
}
?>

<h3>Teachers & Staffs Salary Management</h3>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Select Month & Year and press 'Proceed' to proceed
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
                            <div class="col-12">
                                <button type="button" class="btn btn-success btn-fw p-2" style="width:100%;"
                                    onclick="save(0,0);">Save Content</button>
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
                <h6 class="text-muted font-weight-normal">
                    Record found for the month of
                    <b><?php $xx = strtotime($year . '-' . $month . '-01');
                    echo date('F, Y', $xx) ?></b>
                </h6>
                <div class="row">


                    <form class="">
                        <textarea name="textarea" id="default" class="form-control bg-dark"></textarea>

                    </form>
                    <script src="tinymce/tinymce.min.js"></script>
                    <script src="tinymce/setup.js"></script>
                    <div id="ssp"></div>

                    <?php

                    $sql0x = "SELECT * FROM ref_docs order by id desc limit 1 ;";
                    $result0xt = $conn->query($sql0x);
                    if ($result0xt->num_rows > 0) {
                        while ($row0x = $result0xt->fetch_assoc()) {
                            $partidx = $row0x["id"];
                            $cont = $row0x["content"];
                        }
                    }

                    echo '<br><br>';
                    echo $cont;
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
    document.getElementById('default').value = "Hello";
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
        var refno = '1000/100';
        var title = 'Manages the gooods';
        var infor = "editor=" + editor + "&refno=" + refno + "&title=" + title + "&id=" + id + "&tail=" + tail;;
        alert(infor);
        $("#ssp").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-ref-docs.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#ssp').html('<span class=""><center>Check Issue....</center></span>');
            },
            success: function (html) {
                $("#ssp").html(html);
                alert(infor);
            }
        });
    }
</script>