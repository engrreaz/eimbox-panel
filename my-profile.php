<?php
include 'header.php';

// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

// $refno = $_GET['ref'] ?? 0;
// $undef = $_GET['undef'] ?? 99;

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
if (isset($_GET['ref'])) {
    $refno = $_GET['ref'];
} else {
    $refno = 0;
}
if (isset($_GET['undef'])) {
    $undef = $_GET['undef'];
} else {
    $undef = 99;
}


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




$sql0x = "SELECT sum(duration) as dur, sum(filesize) as fs FROM logbook where sccode='$sccode'  and email = '$usr' ;";
$result0x = $conn->query($sql0x);
if ($result0x->num_rows > 0) {
    while ($row0x = $result0x->fetch_assoc()) {
        $dur = $row0x["dur"];
        $fs = $row0x["fs"];
    }
}
?>

<h3>My Profile </h3>
<code>Page Under Contruction</code>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <img src="<?php echo $pth; ?>" style="width:120px; border-radius:5px; border:1px solid gray;" />
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-12">
                                <h4><?php echo $fullname; ?></h4>
                                <h5><?php echo $usr; ?></h5>
                                <small><?php echo $userlevel; ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <div class="col-12">
                                <!-- <h4><?php echo $dur/3600; ?> HRS.</h4>
                                <h5><?php echo $fs/(1024*1024); ?> MB</h5> -->
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
                <h3 class="text-muted font-weight-normal text-center">
                    Basic Information
                </h3>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover text-white">

                            <tbody>
                                <?php
                                $sccodes = $sccode * 10;
                                $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' or sccode='$sccodes') and id = '$exid' ;";
                                $result0x = $conn->query($sql0x);
                                if ($result0x->num_rows > 0) {
                                    while ($row0x = $result0x->fetch_assoc()) {
                                        $date = $row0x["date"];
                                        $pid = $row0x["partid"];
                                        $descrip = $row0x["particulars"];
                                        $amount = $row0x["amount"];
                                    }
                                } else {
                                    $date = '';
                                    $slots = 'school';
                                    $amount = '';
                                    $descrip = '';

                                }
                                // $ = $row0x[""];
                                ?>
                                <tr>
                                    <td>Display Name :
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="date"
                                            value="<?php echo $fullname; ?>" />
                                    </td>
                                    <td></td>
                                </tr>
                          
                 
                   
                                <tr>
                                    <td></td>
                                    <td>
                                        <div id="">
                                            <button class="btn btn-primary"
                                                onclick="savex(<?php echo $exid; ?>, 1);" disabled>Save</button>

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




<!-- ***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
***************************************************************************************************
*************************************************************************************************** -->











<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    function go() {
        var m = document.getElementById('month').value;
        var y = document.getElementById('year').value;
        window.location.href = 'expenditure.php?&m=' + m + '&y=' + y;
    }



</script>

<script>
    function save(id, tail) {
        alert(tail);
        if (id == 0) tail = 0;
        if (tail == 0 || tail == 1) {
            var dept = document.getElementById('dept').value;
            var date = document.getElementById('date').value;
            var cate = document.getElementById('cate').value;
            var descrip = document.getElementById('descrip').value;
            var amt = document.getElementById('amt').value;

            var infor = "dept=" + dept + '&date=' + date + '&cate=' + cate + '&descrip=' + descrip + '&amt=' + amt + '&id=' + id + "&tail=" + tail;
        } else if (tail == 2 || tail == 3) {
            var infor = 'dept=&date=&cate=&descrip=&amt=&id=' + id + "&tail=" + tail;
        }

        alert(infor);
        $("#sspd").html("");

        $.ajax({
            type: "POST",
            url: "savecash.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspd').html('<span class=""><center>Check Issue....</center></span>');
            },
            success: function (html) {
                $("#sspd").html(html);

                var und = '<?php echo $undef; ?>';
                var mmm = '<?php echo $month; ?>';
                var yyy = '<?php echo $year; ?>';
                var rrr = '<?php echo $refno; ?>';
                var taild = '';

                if (und == '') taild = '&undef';
                if (mmm > 0 || yyy > 0) taild = '&m=' + mmm + '&y=' + yyy;
                if (rrr > 0) taild = '&ref=' + rrr;

                if (tail == 1) {
                    window.location.href = 'expenditure.php?addnews=' + taild;
                } else if (tail == 2 || tail == 3) {
                    window.location.href = 'expenditure.php?q=' + taild;
                } else if (tail == 0) {
                    document.getElementById('gex').innerHTML = document.getElementById('sspd').innerHTML;
                    document.getElementById('sspd').innerHTML = '';
                    window.location.href = 'expenditure.php?addnew' + taild;
                }
            }
        });
    }

</script>