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

<?php
$tea_right .= '<h2 class="p-0 m-0"><b>0.00</b></h2>';
$tea_right .= '<span class="text-small p-0 m-0">Cash-in-Hand</span>';
?>


    <?php include 'teacher-header.php'; ?>


    <h3 class="text-center"><b>My Collections</b></h3>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table  table-stripe">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Roll</th>
                                        <th>Amount</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $sql0 = "SELECT * FROM stpr where sccode = '$sccode' and sessionyear LIKE '$sy%' and entryby='$usr' order by prdate desc, entrytime desc ;";
                                    $result0rtrx = $conn->query($sql0);
                                    if ($result0rtrx->num_rows > 0) {
                                        while ($row0 = $result0rtrx->fetch_assoc()) {
                                            $prno = $row0['prno'];
                                            $prdate = $row0['prdate'];
                                            $amount = $row0['amount'];
                                            $cc = $row0['classname'];
                                            $ss = $row0['sectionname'];
                                            $rr = $row0['rollno'];
                                            ?>

                                            <tr>
                                                <td><?php echo $prno; ?></td>
                                                <td><?php echo date('d F, Y', strtotime($prdate)); ?></td>
                                                <td><?php echo $cc; ?></td>
                                                <td><?php echo $ss; ?></td>
                                                <td><?php echo $rr; ?></td>
                                                <td><?php echo number_format($amount, 2, '.', ','); ?></td>
                    
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