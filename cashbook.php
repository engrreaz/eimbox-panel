<?php
include 'header.php';


if(isset($_GET['datefrom'])){$datefrom = $_GET['datefrom'];} else {$datefrom = date('Y-m-01');}
if(isset($_GET['dateto'])){$dateto = $_GET['dateto'];} else {$dateto = date('Y-m-d');}
if(isset($_GET['dept'])){$dept = $_GET['dept'];} else {$dept = 'School';}


$inlist = $exlist = array();
;
$incnt = $excnt = 0;
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Columner Cashbook</h4>
            <p class="card-description"> Add class <code>.table-dark</code>
            </p>
            <div class="table-responsive">
                <table class="table table-dark" id="example">
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-control" type="date" id="datefrom" value="<?php echo $datefrom; ?>" />
                                <br>
                                <codex>Date From</codex>
                            </td>
                            <td>
                                <input class="form-control" type="date" id="dateto" value="<?php echo $dateto; ?>" />
                                <br>
                                <codex>Date To</codex>
                            </td>
                            <td>
                                <input class="form-control" type="text" id="dept" value="<?php echo $dept; ?>" />
                                <br>
                                <codex>Dept.</codex>
                            </td>
                            <td><label class="badge badge-primary" onclick="go();">Search</label><br>
                                <codex>&nbsp;</codex>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>

        <?php
        $sccodes = $sccode * 10;
        $sql0x = "SELECT partid FROM cashbook where (sccode='$sccode' || sccode='$sccodes' ) and date between '$datefrom' and '$dateto' and slots='$dept' and type='Income'  group by partid order by partid ;";
        // echo $sql0x;
        $result0x1 = $conn->query($sql0x);

        if ($result0x1->num_rows > 0) {
            while ($row0x1 = $result0x1->fetch_assoc()) {
                $inlist[] = $row0x1['partid'];
                // echo $row0x1['partid'];
            }
        }
        // echo var_dump($inlist);
        $incnt = sizeof($inlist);


        // echo '-----' . $incnt;

        // echo '<br>-------------------------------------------<br>';

        $sql0x = "SELECT partid FROM cashbook where (sccode='$sccode' || sccode='$sccodes' )and date between '$datefrom' and '$dateto' and slots='$dept' and type='Expenditure'  group by partid order by partid ;";
        $result0x2 = $conn->query($sql0x);
        if ($result0x2->num_rows > 0) {
            while ($row0x = $result0x2->fetch_assoc()) {
                $exlist[] = $row0x['partid'];
            }
        }

        // echo var_dump($exlist);
        $excnt = sizeof($exlist);

        // echo '-----' . $excnt;
        ?>


        <div class="card-body">
            <p class="card-description"> Cashbook Details from <code><?php echo date('d F, Y', strtotime($datefrom));?></code> to <code><?php echo date('d F, Y', strtotime($dateto));?></code>
            </p>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th rowspan="2"> # </th>
                            <th rowspan="2"> Date </th>
                            <th rowspan="2"> Particulars </th>
                            <th rowspan="2"> Amount </th>
                            <th colspan="<?php echo $incnt; ?>">Income</th>
                            <th rowspan="2"></th>
                            <th colspan="<?php echo $excnt; ?>">Expenditure</th>
                            <th rowspan="2">*</th>
                        </tr>
                        <tr>


                            <?php
                            if ($incnt > 0) {
                                for ($x = 0; $x < $incnt; $x++) {
                                    echo '<th>' . $inlist[$x] . '</th>';
                                }
                            } else {
                                echo '<th>--</th>';
                            }



                            if ($excnt > 0) {
                                for ($y = 0; $y < $excnt; $y++) {
                                    echo '<th>' . $exlist[$y] . '</th>';
                                }
                            } else {
                                echo '<th>--</th>';
                            }
                            ?>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // $dept = '';
                        $sql0x = "SELECT * FROM cashbook where (sccode='$sccode' || sccode='$sccodes' ) and date between '$datefrom' and '$dateto' and slots='$dept' order by entrytime desc, id desc ;";
                        $result0x = $conn->query($sql0x);
                        if ($result0x->num_rows > 0) {
                            while ($row0x = $result0x->fetch_assoc()) {
                                $type = $row0x["type"];
                                $date = $row0x["date"];
                                $partid = $row0x["partid"];
                                $descrip = $row0x["particulars"];
                                $in = $row0x["income"];
                                $ex = $row0x["expenditure"];
                                $amt = $row0x["amount"];
                                ?>

                                <tr>
                                    <td class="py-1">
                                        <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td> <?php echo $date; ?> </td>
                                    <td> <?php echo $descrip; ?> </td>
                                    <td> <?php echo $amt; ?> </td>

                                    <?php

                                    if ($incnt > 0) {
                                        for ($x = 0; $x < $incnt; $x++) {
                                            $curcol = $inlist[$x];
                                            if ($curcol == $partid) {
                                                echo '<th>' . $amt . '</th>';
                                            } else {
                                                echo '<th></th>';
                                            }

                                        }
                                    } else {
                                        echo '<th>QQ</th>';
                                    }

                                    echo '<th></th>';

                                    if ($excnt > 0) {
                                        for ($x = 0; $x < $excnt; $x++) {
                                            $curcol = $exlist[$x];
                                            if ($curcol == $partid) {
                                                echo '<th>' . $amt . '</th>';
                                            } else {
                                                echo '<th></th>';
                                            }
                                        }
                                    } else {
                                        echo '<th>--</th>';
                                    }
                                    ?>
                                    <td><label class="badge badge-primary">View Book</label></td>
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

    function go() {
        var datefrom = document.getElementById('datefrom').value;
        var dateto = document.getElementById('dateto').value;
        var dept = document.getElementById('dept').value;
        window.location.href = 'cashbook.php?datefrom=' + datefrom + '&dateto=' + dateto + '&dept=' + dept;
    }
</script>