<?php
include 'header.php';


// $month = $_GET['m'] ?? 0;
// $year = $_GET['y'] ?? 0;

// $refno = $_GET['ref'] ?? 0;
// $undef = $_GET['undef'] ?? 99;



if(isset($_GET['year'])){$year = $_GET['year'];} else {$year = 0;}

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
if (isset($_GET['exam'])) {
    $exam2 = $_GET['exam'];
} else {
    $exam2 = '';
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

<style>
    .backpic {
        filter: grayscale(100);
        background:black;
    }
</style>


<h3 class="d-print-none">Admit Card of <?php echo $exam2 . ' Examination - ' . $sy; ?> </h3>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                    Select Class & Section to Generate Admit Card
                </h6>
                <div class="row">

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
                            <label class="col-form-label pl-3">Class :</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="cls">
                                    <option value=" ">---</option>
                                    <?php
                                    $sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear='$sy' group by areaname order by idno;";
                                    echo $sql0x;
                                    $result0x = $conn->query($sql0x);
                                    if ($result0x->num_rows > 0) {
                                        while ($row0x = $result0x->fetch_assoc()) {
                                            $cls = $row0x["areaname"];
                                            if ($cls == $cls2) {
                                                $selcls = 'selected';
                                            } else {
                                                $selcls = '';
                                            }
                                            echo '<option value="' . $cls . '" ' . $selcls . ' >' . $cls . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Section</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="sec">
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT subarea FROM areas where user='$rootuser' and sessionyear='$sy' group by subarea order by idno;";
                                    echo $sql0x;
                                    $result0r = $conn->query($sql0x);
                                    if ($result0r->num_rows > 0) {
                                        while ($row0x = $result0r->fetch_assoc()) {
                                            $sec = $row0x["subarea"];
                                            if ($sec == $sec2) {
                                                $selsec = 'selected';
                                            } else {
                                                $selsec = '';
                                            }
                                            echo '<option value="' . $sec . '" ' . $selsec . ' >' . $sec . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Section</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="exam">

                                    <!-- <option value="">---</option> -->
                                    <option value="Half-Yearly">Half-Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    



                </div>

                <div class="row">
                <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-primary btn-block " style="" onclick="go();"><i class="mdi mdi-eye"></i> Generate
                                    Card</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class=" btn-info btn-block" style="" onclick="goprint();"><i class="mdi mdi-eye"></i> Print View</button>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>





<?php
$sqlc = "SELECT count(*) as cnt FROM sessioninfo WHERE sccode='$sccode'  and sessionyear='$sy' and classname = '$cls2' and sectionname = '$sec2'";
$resultc = $conn->query($sqlc);
if ($resultc->num_rows > 0) {
    while ($rowc = $resultc->fetch_assoc()) {
        $cnt = $rowc["cnt"];
    }
}
$pgl = round($cnt / $col);
$pgr = $pgl + 1;
$pgm = $pgl * $col;
?>






<div id="alladmit">
<table>
<?php

    $sqlcccd = "SELECT * from sessioninfo WHERE  sccode='$sccode'  and sessionyear = '$sy' and classname='$cls2' and sectionname='$sec2' order by rollno " ;
//	echo $sqlcccd;
    $resultcccd = $conn->query($sqlcccd);
    if ($resultcccd->num_rows > 0) {
    while($rowcccd = $resultcccd->fetch_assoc()) {
    $stid=$rowcccd["stid"];
    $classname=$rowcccd["classname"];  $sectionname=$rowcccd["sectionname"];  $rollno=$rowcccd["rollno"];	
    $fourth_subject=$rowcccd["fourth_subject"];
    if(($classname == 'Nine')||($classname == 'Ten'))
        {
            $secgr = 'Group';
        } else {
            $secgr = 'Section';
        }

        
            $sqlcccd2 = "SELECT * from students WHERE  stid='$stid' ";
            $resultcccd2 = $conn->query($sqlcccd2);
            if ($resultcccd2->num_rows > 0) {
            while($rowcccd2 = $resultcccd2->fetch_assoc()) {
            $stid=$rowcccd2["stid"];
            $stnameeng = $rowcccd2["stnameeng"];    $stnameben = $rowcccd2["stnameben"];
            
            $fname = $rowcccd2["fname"];    $mname = $rowcccd2["mname"];
            
            $previll = $rowcccd2["previll"];    $prepo = $rowcccd2["prepo"];
            $preps = $rowcccd2["preps"];        $predist = $rowcccd2["predist"];
            
            $guarmobile = $rowcccd2["guarmobile"]; 
            
                            
             
          
            }}
            

            include 'assets/admit/temp_01.php';
            

   

    
    }} 
?>


</table>
</div>



<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    function reload(){
        window.location.href = uri;
    }
    function goprint(){
        var txt =document.getElementById("alladmit").innerHTML;
        document.write('<div class="d-print-none"><button style="z-index:9999; position:fixed; right:100px; top:100px; background: seagreen;; color:white; padding:5px; border-radius:5px;"  onclick="reload();">Back to Admit</button><div>');
        document.write(txt);
        
    }
    function go() {
        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        var exam = document.getElementById('exam').value;
        window.location.href = 'admit-card.php?&cls=' + cls + '&sec=' + sec + '&exam=' + exam + '&year=' + year;
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
</script>
<script>
    function addnew() {
        var und = '<?php echo $undef; ?>';
        var mmm = '<?php echo $month; ?>';
        var yyy = '<?php echo $year; ?>';
        var rrr = '<?php echo $refno; ?>';
        var tail = '';

        if (und == '') tail = '&undef';
        if (mmm > 0 || yyy > 0) tail = '&m=' + mmm + '&y=' + yyy;
        if (rrr > 0) tail = '&ref=' + rrr;

        window.location.href = 'expenditure.php?addnew' + tail;
    }


    function edit(id, taill) {
        var und = '<?php echo $undef; ?>';
        var mmm = '<?php echo $month; ?>';
        var yyy = '<?php echo $year; ?>';
        var rrr = '<?php echo $refno; ?>';
        var tail = '';

        if (und == '') tail = '&undef';
        if (mmm > 0 || yyy > 0) tail = '&m=' + mmm + '&y=' + yyy;
        if (rrr > 0) tail = '&ref=' + rrr;

        window.location.href = 'expenditure.php?addnew=' + id + tail;
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