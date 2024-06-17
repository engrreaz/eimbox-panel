document.getElementById('defbtn').innerHTML = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    document.getElementById('defmenu').innerHTML = '';
    function defbtn() {
        goprint(0);
    }

Table : profile-track 
ALTER TABLE `financesetup` ADD `custom` INT NOT NULL DEFAULT '0' AFTER `inexex`;
ALTER TABLE `financeitem` ADD `sccode` INT NOT NULL DEFAULT '0' AFTER `expenditure`;
ALTER TABLE `financesetup` ADD `play_update` DATETIME NULL DEFAULT NULL AFTER `ten`, ADD `nursery_update` DATETIME NULL DEFAULT NULL AFTER `play_update`, ADD `one_update` DATETIME NULL DEFAULT NULL AFTER `nursery_update`, ADD `two_update` DATETIME NULL DEFAULT NULL AFTER `one_update`, ADD `three_update` DATETIME NULL DEFAULT NULL AFTER `two_update`, ADD `four_update` DATETIME NULL DEFAULT NULL AFTER `three_update`, ADD `five_update` DATETIME NULL DEFAULT NULL AFTER `four_update`, ADD `six_update` DATETIME NULL DEFAULT NULL AFTER `five_update`, ADD `seven_update` DATETIME NULL DEFAULT NULL AFTER `six_update`, ADD `eight_update` DATETIME NULL DEFAULT NULL AFTER `seven_update`, ADD `nine_update` DATETIME NULL DEFAULT NULL AFTER `eight_update`, ADD `ten_update` DATETIME NULL DEFAULT NULL AFTER `nine_update`;

ALTER TABLE `stfinance` ADD `last_update` DATE NULL DEFAULT NULL AFTER `extra`;
ALTER TABLE `sessioninfo` CHANGE `rate` `rate` INT(11) NOT NULL DEFAULT '100';
update sessioninfo set rate = 100;

ALTER TABLE `financesetup` ADD `last_update` DATETIME NULL DEFAULT NULL AFTER `custom`, ADD `need_update` INT NOT NULL DEFAULT '1' AFTER `last_update`;

---------- Finance Item Month SETUP -------------------
ALTER TABLE `financesetup` CHANGE `sessionyear` `sessionyear` VARCHAR(7) NOT NULL;
ALTER TABLE `sessioninfo` CHANGE `sessionyear` `sessionyear` VARCHAR(9) NOT NULL;






<?php


if ($ind != '') {


    // $datam = array();
    // $pick = "SELECT * FROM stfinance where partid='$id'  and sccode='$sccode' and sessionyear LIKE '$sy%' and stid = '$stid2' order by month ;";

    // $result0xx21 = $conn->query($pick);
    // if ($result0xx21->num_rows > 0) {
    //     while ($row0xn = $result0xx21->fetch_assoc()) {
    //         $datam[] = $row0xn;
    //     }
    // } else {
    //     $datam = array();
    // }

    $yx = array_values(array_filter($finlist, fn($bb) => $bb['stid'] == $stid2 && $bb['month'] == 3));
    // array_push($yx, array('stid' => $stid2, 'rollno' => $roll2));
    echo '<hr>';
    echo var_dump($yx);


    echo $yx[0]['stid'];
    echo '<hr>';


    
    for ($z = 1; $z <= 12; $z++) {
        $tarikh = '2024-' . $z . '-01';
        $mx = ' : ' . date('F/Y', strtotime($tarikh));

        $indz = array_search($z, array_column($datam, 'month'));


        if ($indz != '') {
            $modi = $datam[$indz]['modifieddate'];

            if ($modi == NULL) {
                $modi = '2024-01-01 00:00:00';
            }
            $uuuid = $datam[$indz]['id'];
            if (strtotime($modi) < strtotime($update_time)) {

                $pamt = $taka * $rate2 / 100;
                $joma = $pamt - $datam[$indz]['paid'];
                // $disp .= '{' . $cls2 . '-' . $sec2 . '-' . $roll2 . '-' . $z . '--' . $uuuid . ' ------- }';
                $query3px = "UPDATE stfinance set amount='$taka', payableamt='$pamt', modifieddate = '$cur', dues = '$joma' where id='$uuuid' and sccode='$sccode' ;";
                // if($stid2 == '1031872887') {
                // echo '<br>' . $query3px . '<br>';
                $conn->query($query3px);
                $update++;
                $count++;
                $query3px = '';
                // }
            } else {

                echo '[' . $roll2 . ']'; // No need to update
                $noneed++;
                // $count++;
            }

        } else {

            $pamt = $taka * $rate2 / 100;
            $mxe = $parte . $mx;
            $mxb = $partb . $mx;
            $query3plo = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, setupdate, setupby, payableamt, modifieddate, modifiedby, paid, dues)
                            VALUES (NULL, '$sccode', '$sy', '$cls2', '$sec2', '$stid2', '$roll2', '$id',  '$mxe', '$mxb', '$taka', '$z', '$cur', '$usr', '$pamt', '$cur', '$usr', '0', '$pamt') ;";
            // $disp .= $stid2 . '/' . $z . '<br>';
            // $newsl++;
            $disp .= $cls2 . $sec2 . $roll2 . $stid2 . $z;
            $new++;
            $count++;
            $conn->query($query3plo);
            $query3plo = '';

        }



        // for.......................
    }

    // $disp .= '@@';
    // m == 0 -------------------------------



    //************************************************************************************************************************** */
} else {


    $disp .= $cls2 . ' ' . $sec2 . ' ' . $roll2 . ' (' . $stid2 . ') ';
    $disp .= '###' . $roll2 . '###'; // Inser new record
    $new++;
    $count++;



    for ($z = 1; $z <= 12; $z++) {
        $tarikh = '2024-' . $z . '-01';
        $mx = ' : ' . date('F', strtotime($tarikh)) . '/' . date('Y');

        $pamt = $taka * $rate2 / 100;
        $mxe = $parte . $mx;
        $mxb = $partb . $mx;
        $query3plo = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, setupdate, setupby, payableamt, modifieddate, modifiedby, paid, dues)
                                           VALUES (NULL, '$sccode', '$sy', '$cls2', '$sec2', '$stid2', '$roll2', '$id',  '$mxe', '$mxb', '$taka', '$z', '$cur', '$usr', '$pamt', '$cur', '$usr', '0', '$pamt') ;";


        // $newsl++;
        // $count++;
        $conn->query($query3plo);
    }

    array_push($finlist, array('stid' => $stid2, 'rollno' => $roll2));
}

