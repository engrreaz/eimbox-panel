<?php
include 'header.php';



?>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">All Register of Institution</h4>
            </p>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Register Name </th>
                            <th> Dept. </th>
                            <th> Dept. </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sccodes = $sccode * 10;
                        $sql0x = "SELECT * FROM refbook where sccode='$sccode' order by entrytime desc, id desc ;";
                        $result0x = $conn->query($sql0x);
                        if ($result0x->num_rows > 0) {
                            while ($row0x = $result0x->fetch_assoc()) {
                                $refno = $row0x["refno"];
                                $date = $row0x["date"];
                                $title = $row0x["title"];
                                $descrip = $row0x["descrip"];

                                ?>
                                <tr>
                                    <td class="py-1">
                                        <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td> <?php echo $refno; ?> </td>
                                    <td> <?php echo $date; ?> </td>
                                    <td> <?php echo $title; ?> </td>
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