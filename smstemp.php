<?php
include 'header.php';



?>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-lightv">All Register of Institution</h4>
            <p class="card-description"> Add class <code>.table-dark</code>
            </p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Register Name </th>
                            <th> Dept. </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < 100; $i++) {
                            $smstemp = 'OKKK';
                            $sql0x = "SELECT * FROM sms_tempt;";
                            $result0rtx = $conn->query($sql0x);
                            if ($result0rtx->num_rows > 0) {
                                while ($row0x = $result0rtx->fetch_assoc()) {


                                    $smstemp = $row0x["smstemp"];
                                    $stname = "Reazul Hoque";
                                    $ok = 'Class VIII';
                                    $smstemp = str_replace("[", "$", $smstemp);
                                    // $smstemp = str_replace("STNAME", $stname, $smstemp);
                                    // $smstemp = str_replace("OK", $ok, $smstemp);
                                    // $smstemp = "Hello $stname";
                        
                                    ?>
                                    <tr>
                                        <td class="py-1">
                                            <img src="assets/images/faces-clipart/pic-1.png" alt="image" />
                                        </td>
                                        <td> <?php echo $smstemp; ?> </td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>

                                <?php }
                            }
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
    function refbook() {
        window.location.href = 'refbook.php';
    }


</script>