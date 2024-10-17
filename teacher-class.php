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

    <h3 class="text-center"><b>My Class (<?php echo $clscls . ' / ' . $clssec; ?>)</b></h3>

    <div class="row">
        <div class="col-xl-9 col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table  table-stripe">
                                <thead>
                                    <tr>
                                        <th>Roll</th>
                                        <th>Name of Student</th>
                                        <th>Mobile</th>
                                        <th>Profile</th>
                                        <th>Attendance</th>
                                        <th>Result</th>
                                        <th>Dues</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $sql0 = "SELECT * FROM sessioninfo where sccode = '$sccode' and sessionyear LIKE '$sy%' and classname='$clscls' and sectionname='$clssec' order by rollno ;";
                                    $result0rtrx = $conn->query($sql0);
                                    if ($result0rtrx->num_rows > 0) {
                                        while ($row0 = $result0rtrx->fetch_assoc()) {
                                            $rollno = $row0['rollno'];
                                            $stid = $row0['stid'];


                                            $sql0 = "SELECT * FROM students where sccode = '$sccode' and stid='$stid' ;";
                                            $result0rtrz = $conn->query($sql0);
                                            if ($result0rtrz->num_rows > 0) {
                                                while ($row0 = $result0rtrz->fetch_assoc()) {
                                                    $stname = $row0['stnameeng'];
                                                    $mno = $row0['guarmobile'];
                                                }
                                            }

                                            ?>

                                            <tr>
                                                <td><?php echo $rollno; ?></td>
                                                <td><?php echo $stname; ?></td>
                                                <td><?php echo $mno; ?></td>
                                                <td>
                                                    <button class="btn btn-inverse-primary  btn-rounded btn-icon m-0 p-0"
                                                        onclick="goright(<?php echo $stid; ?>, 1);">
                                                        <img src="../students/<?php echo $stid; ?>.jpg" class="circle p-0 m-0 ">
                                                    </button>



                                                </td>
                                                <td class="text-center">
                                                    <h4 class="text-center m-0 p-0">0 <small>%</small></h4>
                                                    <span class="text-small">25 Days</span>
                                                </td>
                                                <td class="text-center">
                                                    <h4 class="text-center m-0 p-0">79.90 <small>%</small></h4>
                                                    <span class="text-small">7th</span>
                                                </td>
                                                <td class="text-center">
                                                    <h6 class="text-center m-0 p-0"><small>TK </small>655.90</h6>
                                                </td>
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
        <div class="col-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="sspn">

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


<script>
    function goright(stid, tail) {
        var page = '';
        infor = "stid=" + stid;
        // alert(infor);
        if (tail == 1) {
            page = 'teacher-student-profile.php';
        }

        $("#sspn").html("");

        $.ajax({
            type: "POST",
            url: page,
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sspn').html('<span class=""><center><small>Please wail while loading</small></center></span>');
            },
            success: function (html) {
                $("#sspn").html(html);
                // window.location.href = 'subjects.php?&y=' + year + '&c=' + cls + '&s=' + sec;
            }
        });
    }

</script>