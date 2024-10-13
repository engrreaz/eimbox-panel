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


    <?php include 'std-header.php'; ?>

    <h3 class="text-center text-small">Attendance Report</h3>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        gggggggg

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
        window.location.href = 'std-messages.php?stid=' + x;
    }
</script>