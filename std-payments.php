<?php
include 'header.php';



if ($userlevel == 'Guardian') {
    if (isset($_GET['stid'])) {
        $stid = $_GET['stid'];
    } else {
        $stid = 0;
        // echo 'stid not define';
        ?>
        <button type="button" id="modalbox" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" hidden>
            Choose Student
        </button>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">My Students List</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="" class="input-control select full-size error">
                            <select id="modaldata" name="modaldata" class="form-control" onchange="modal();">
                                <option value="">Choose a student</option>
                                <?php
                                $sql000 = "SELECT * FROM guar_student where sccode='$sccode' and guarid='$userid' order by id";
                                $resultix = $conn->query($sql000);
                                // $conn -> close();
                                if ($resultix->num_rows > 0) {
                                    while ($row000 = $resultix->fetch_assoc()) {
                                        $stidx = $row000["stid"];

                                        $sql000 = "SELECT * FROM students where sccode='$sccode' and stid='$stidx' order by id";
                                        $resultixx = $conn->query($sql000);
                                        // $conn -> close();
                                        if ($resultixx->num_rows > 0) {
                                            while ($row000 = $resultixx->fetch_assoc()) {
                                                $stnameeng = $row000["stnameeng"];
                                            }
                                        }


                                        echo '<option value="' . $stidx . '"  >' . $stnameeng . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


        <?php
    }
} else {
    $stid = $userid;
}

$lastpr = 0;
if ($lastpr != 'undefined' && $lastpr > 0) {
    $prno = $lastpr + 1;
} else {
    $prno = ($sy % 100) * 1000000 + ($stid % 10000) * 100 + 1;
}

$sql0 = "SELECT * FROM sessioninfo where sccode = '$sccode'  and stid='$stid' and sessionyear='$sy' ;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $cn = $row0['classname'];
        $sec = $row0['sectionname'];
    }
} else {
    $cn = $sec = '';
}
// echo var_dump($datam);


//******************************************************** */



$datam = 'Ten_Science_1_Sadia_mahi_01919629672_';
$b = explode("_", $datam);
$ccc = $b[0];
$sss = $b[1];
$rrr = $b[2];
$eee = $b[3];
$bbb = $b[4];
$mmm = $b[5];


$cnt = 0;
$tamt = 0;
$month = date('m');
?>


<div id="wholeblock">



    <?php include 'std-header.php'; ?>
    <h3 class="text-center"><b>Payments & Dues Details</b></h3>







    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">


                    <div class="row d-print-none">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card m-0 no-border">
                                <div class="card-body p-0 m-0">
                                    <div class="col-12 p-0  m-0">
                                        <h4>
                                            <div style="float:right;">
                                                <h2 class="btn btn-outline-danger pt-2 font-weight-bold" id="total_due">
                                                </h2>
                                                <h6 class="text-small text-danger text-center">Total Dues</h6>
                                            </div>
                                            <span style="display:none;">
                                                <b><?php echo $eee; ?></b>
                                                <br>
                                                <span class="text-small"><?php echo $bbb; ?></span></span>
                                        </h4>
                                        <p hidden>Class : <?php echo $ccc; ?> (<?php echo $sss; ?>) - Roll #
                                            <?php echo $rrr; ?>
                                        </p>

                                        <h6 style="float:right;" class="text-info" hidden><small><i
                                                    class="mdi mdi-phone pt-1"></i>
                                                <?php echo $mmm; ?></small></h6>
                                        <h6 class="text-info" hidden><small>ID : <?php echo $stid; ?></small></h6>
                                    </div>

                                    <div class="col-12 grid-margin stretch-card p-0 m-0" hidden>
                                        <div class="col-3 p-0">
                                            <input type="text" class="form-control text-center bg-transparent"
                                                value="<?php echo $prno; ?>" id="prno" disabled />
                                        </div>
                                        <div class="col-3 pl-1 pr-1">
                                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                                id="prdate" />
                                        </div>
                                        <div class="col-3   pl-0 pr-1">
                                            <input type="text"
                                                class="form-control text-right text-warning bg-transparent  "
                                                value="0.00" onchange="diss();" id="amt"
                                                style="font-weight:bold; font-size:1.25rem;" disabled />
                                        </div>
                                        <div class="col-3    p-0" id="btnblock">
                                            <button type="button"
                                                class="btn btn-inverse-success pb-2 pt-2 text-lg-center w-100"
                                                id="bbttnn" onclick="save(<?php echo $stid; ?>);" disabled>
                                                <div style="margin-top:5px;">Pay Now</div>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <h6 class="text-danger text-small"><b>Items dues are listed below :</b></h6>
                    <div class="table-responsive">
                        <table class="table  text-white ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Particulars</th>
                                    <th>Receipt No.</th>
                                    <th>Date</th>
                                    <th class="text-right">Paid</th>
                                    <th class="text-right">Dues</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $finset = array();
                                $upd = $ccc . '_update';
                                $sql5 = "SELECT id, $ccc, $upd FROM financesetup where sessionyear LIKE '$sy%' and sccode='$sccode'  order by id";
                                // echo $sql5; 
                                $result5r = $conn->query($sql5);
                                if ($result5r->num_rows > 0) {
                                    while ($row5 = $result5r->fetch_assoc()) {
                                        $finset[] = $row5;
                                    }
                                }
                                // echo var_dump($finset);
                                
                                $sql5 = "SELECT * FROM stfinance where sessionyear = '$sy' and sccode='$sccode' and stid='$stid' and dues >= 0 and month<='$month' order by partid, id";
                                $result5 = $conn->query($sql5);
                                if ($result5->num_rows > 0) {
                                    while ($row5 = $result5->fetch_assoc()) {
                                        $fid = $row5["id"];
                                        $partid = $row5["partid"];
                                        $particulareng = $row5["particulareng"];
                                        $dues = $row5["dues"];
                                        
                                        $pr1 = $row5["pr1"];
                                        $pr1no = $row5["pr1no"];
                                        $pr1date = $row5["pr1date"];

                                        if ($dues == 0) {
                                            $amtclr = 'muted';
                                        } else {
                                            $amtclr = 'white';
                                        }


                                        $src = array_search($partid, array_column($finset, 'id'));
                                        $upddate = $finset[$src][$upd];
                                        $updtaka = $finset[$src][$ccc];


                                        ?>

                                        <tr onclick="sell(<?php echo $cnt; ?>);">
                                            <td class="p-0 m-0">
                                                <div id="fid<?php echo $cnt; ?>" hidden><?php echo $fid; ?></div>

                                                <div class="form-check">
                                                    <input class="form-check-input success" type="checkbox" value=""
                                                        id="rex<?php echo $cnt; ?>"
                                                        style="width:20px; height:20px; top:-10px; border-radius:50%; accent-color: lime; "
                                                        onclick="sel(<?php echo $cnt; ?>);" disabled>
                                                </div>
                                            </td>
                                            <td class=" text-<?php echo $amtclr; ?>"><?php echo $particulareng; ?></td>

                                            <td class="text-muted">
                                                <?php if ($dues == 0) {
                                                    echo $pr1no;
                                                } ?>
                                            </td>
                                            <td class="text-muted">
                                                <?php if ($dues == 0) {
                                                    echo date('d/m/Y', strtotime($pr1date));
                                                } ?>
                                            </td>
                                            <td class="text-right text-muted">
                                                <?php if ($dues == 0) {
                                                    echo $pr1 . '.00';
                                                } ?>
                                            </td>


                                            <td class="text-right text-<?php echo $amtclr; ?>">
                                                <?php
                                                // if ($updtaka != $dues) {
                                        
                                                //     ?>
                                                <!-- <del class="text-danger"><?php echo $dues; ?></del> -->
                                                <?php
                                                //        $dues = $updtaka;
                                                // }
                                                ?>

                                                <span id="amt<?php echo $cnt; ?>"><?php echo $dues; ?></span>
                                                <?php


                                                ?>.00
                                            </td>
                                        </tr>
                                        <?php
                                        $tamt = $tamt + $dues;
                                        $cnt++;
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="6"></td>
                                </tr>
                        </table>

                        <input type="number" id="cntp" value="<?php echo $cnt; ?>" hidden />
                        <input type="number" id="chk" value="0" hidden />
                    </div>

                    <script>document.getElementById("total_due").innerHTML = '<?php echo $tamt; ?>.00';</script>


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
    function refbook() {
        window.location.href = 'refbook.php';
    }


</script>



<script>
    var stid = '<?php echo $stid; ?>';
    if (stid < 1) {
        document.getElementById('wholeblock').style.display = 'none';
        $("#modalbox").click();
    }
    function modal() {
        var x = document.getElementById("modaldata").value;
        window.location.href = 'std-payments.php?stid=' + x;
    }
</script>