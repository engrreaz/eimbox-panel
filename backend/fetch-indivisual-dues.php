<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
$stid = $_POST['stid'];
$lastpr = $_POST['lastpr'] * 1;
$datam = $_POST['datam'];

if ($lastpr != 'undefined' && $lastpr > 0) {
    $prno = $lastpr + 1;
} else {
    $prno = ($sy % 100) * 1000000 + ($stid % 10000) * 100 + 1;
}

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

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card m-0">
            <div class="card-body p-0 m-0">
                <div class="col-12 p-0  m-0">
                    <h4>
                        <div style="float:right;">
                            <h2 class="btn btn-outline-danger pt-2 font-weight-bold" id="total_due"></h2>
                            <h6 class="text-small text-danger text-center">Total Dues</h6>
                        </div>

                        <b><?php echo $eee; ?></b>
                        <br>
                        <span class="text-small"><?php echo $bbb; ?></span>
                    </h4>
                    <p>Class : <?php echo $ccc; ?> (<?php echo $sss; ?>) - Roll # <?php echo $rrr; ?></p>

                    <h6 style="float:right;" class="text-info"><small><i class="mdi mdi-phone pt-1"></i>
                            <?php echo $mmm; ?></small></h6>
                    <h6 class="text-info"><small>ID : <?php echo $stid; ?></small></h6>
                </div>

                <div class="col-12 grid-margin stretch-card p-0 m-0">
                    <div class="col-3 p-0">
                        <input type="text" class="form-control text-center bg-transparent" value="<?php echo $prno; ?>"
                            id="prno" disabled />
                    </div>
                    <div class="col-3 pl-1 pr-1">
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="prdate" />
                    </div>
                    <div class="col-3   pl-0 pr-1">
                        <input type="text" class="form-control text-right text-warning bg-transparent  " value="0.00"
                            id="amt" style="font-weight:bold; font-size:1.25rem;" disabled />
                    </div>
                    <div class="col-3    p-0" id="btnblock">
                        <button type="button" class="btn btn-inverse-success pb-2 pt-2 text-lg-center w-100"
                            onclick="save(<?php echo $stid; ?>);" id="">
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
    <table class="table   ">
        <tbody>

            <?php
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
            
            $sql5 = "SELECT * FROM stfinance where sessionyear = '$sy' and sccode='$sccode' and stid='$stid' and dues > 0 and month<='$month' order by partid";
            $result5 = $conn->query($sql5);
            if ($result5->num_rows > 0) {
                while ($row5 = $result5->fetch_assoc()) {
                    $fid = $row5["id"];
                    $partid = $row5["partid"];
                    $particulareng = $row5["particulareng"];
                    $dues = $row5["dues"];


                    $src = array_search($partid, array_column($finset, 'id'));
                    $upddate = $finset[$src][$upd];
                    $updtaka = $finset[$src][$ccc];


                    ?>

                    <tr onclick="sell(<?php echo $cnt; ?>);">
                        <td class="p-0 m-0">
                            <div id="fid<?php echo $cnt; ?>" hidden><?php echo $fid; ?></div>

                            <div class="form-check">
                                <input class="form-check-input success" type="checkbox" value="" id="rex<?php echo $cnt; ?>"
                                    style="width:20px; height:20px; top:-10px; border-radius:50%; accent-color: lime; "
                                    onclick="sel(<?php echo $cnt; ?>);">
                            </div>
                        </td>
                        <td><?php echo $particulareng; ?></td>
                        <td class="text-right">
                            <?php
                            if ($updtaka != $dues) {
                                
                                ?><del class="text-danger"><?php echo $dues; ?></del><?php
                                $dues = $updtaka;
                            } 
                                ?>
                                
                                <span id="amt<?php echo $cnt; ?>"><?php echo $updtaka; ?></span>
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
                <td colspan="3"></td>
            </tr>
    </table>

    <input type="number" id="cntp" value="<?php echo $cnt; ?>" hidden />
    <input type="number" id="chk" value="0" hidden />
</div>
<script>document.getElementById("total_due").innerHTML = '<?php echo $tamt; ?>.00';</script>