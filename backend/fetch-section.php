<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');


$classname = $_POST['classname'];
;
$usr = $_POST['usr'];
;
?>
<div id="secn" class="input-control select full-size error">
    <select id="sectionname" name="sectionname">
        <option value="">Select a Section</option>





        <?php
        $sy = date("Y");
        $sql5 = "SELECT * FROM areas where areaname='$classname' and user='$usr' and sessionyear = '$sy' order by idno";
        $result5 = $conn->query($sql5);
        if ($result5->num_rows > 0) {
            while ($row5 = $result5->fetch_assoc()) {
                $subarea = $row5["subarea"];
                echo '<option value="' . $subarea . '">' . $subarea . '</option>';
            }
        }


        ?>


    </select>
</div>