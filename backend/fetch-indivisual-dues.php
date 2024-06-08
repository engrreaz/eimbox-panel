<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
$stid = $_POST['stid'];
$month = date('m');
?>
<div class="table-responsive">
    <table class="table   ">
        <tbody>

            <?php
            $sql5 = "SELECT * FROM stfinance where sessionyear = '$sy' and sccode='$sccode' and stid='$stid' and dues > 0 and month<='$month' order by partid";
            $result5 = $conn->query($sql5);
            if ($result5->num_rows > 0) {
                while ($row5 = $result5->fetch_assoc()) {
                    $id = $row5["id"];
                    $particulareng = $row5["particulareng"];
                    $dues = $row5["dues"];
                    ?>

                    <tr>
                        <td><?php echo $particulareng; ?></td>
                        <td><?php echo $dues; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            <tr><td></td><td></td></tr>
    </table>
    </table>
</div>