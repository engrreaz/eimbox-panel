<?php
include 'header.php';
$tid = $userid;




$f_date = $sy . '-01-01';
$l_date = $sy . '-12-31';
$sql0 = "SELECT * FROM calendar where (sccode = '$sccode' or sccode=0) and date between '$f_date' and '$l_date' and descrip IS NOT NULL order by date; ;";
$result0rt = $conn->query($sql0);
if ($result0rt->num_rows > 0) {
    while ($row0 = $result0rt->fetch_assoc()) {
        $datam[] = $row0;
    }
} else {
    $datam[] = '';
}
// echo var_dump($datam);
?>


<div id="wholeblock">



    <?php include 'teacher-header.php'; ?>

    <h3 class="text-center"><b>Marks Entry</b></h3>

    
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exam">Examination</label>
                            <select class="form-control" id="exam" disabled>
                                <option value="Annual">Annual Examination</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="clsname">Class</label>
                            <select class="form-control" id="clsname" disabled>
                                <option value=""><?php echo $clscls;?></option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="secname">Section</label>
                            <select class="form-control" id="secname" disabled>
                                <option value=""><?php echo $clssec;?></option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="subs">My Subjects</label>
                            <select class="form-control" id="subs" disabled>
                                <option value="">Mathematics</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">&nbsp;</label>
                            <button class="btn btn-inverse-primary d-block p-2 pt-2" >Show Mark List</button>
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
                    <div class="row mb-4">
                        Exam : <b>Annual Examination</b>; Class : <b>Ten</b>; Section : <b>Science</b>; Subject : <b>Mathematics</b>
                        Marks Distribution : 70 (S) + 30 (O) + 0 (P) + 0 (CA) = 100
                    </div>
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table  table-stripe">
                                <thead>
                                    <tr>
                                        <th>Roll</th>
                                        <th>Student's Name</th>
                                        <th>Subjective</th>
                                        <th>Objective</th>
                                        <th>Practical</th>
                                        <th>Total</th>
                                        <th>CA</th>
                                        <th>Marks Obtain</th>
                                        <th>Grade/Letter</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $sql0 = "SELECT * FROM clsroutine where sccode = '$sccode' and sessionyear='$sy' and tid='$tid' order by period, wday ;";
                                    $result0rtrx = $conn->query($sql0);
                                    if ($result0rtrx->num_rows > 0) {
                                        while ($row0 = $result0rtrx->fetch_assoc()) {
                                            $period = $row0['period'];
                                            $wday = $row0['wday'];
                                            $subcode = $row0['subcode'];
                                            $tid = $row0['tid'];

                                            ?>

                                            <tr>
                                                <td><?php echo $period; ?></td>
                                                <td><?php echo $wday; ?></td>
                                                <td><?php echo $subcode; ?></td>
                                                <td><?php echo $tid; ?></td>
                                            </tr>

                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>


                    </div>


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
</script>