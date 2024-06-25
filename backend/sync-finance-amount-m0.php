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




    
    for ($z = 1; $z <= 12; $z++) {
        $tarikh = '2024-' . $z . '-01';
        $mx = ' : ' . date('F/Y', strtotime($tarikh));

        $yx = array_values(array_filter($finlist, fn($bb) => $bb['stid'] == $stid2 && $bb['month'] == $z));
        // array_push($yx, array('stid' => $stid2, 'rollno' => $roll2));
        // echo '<hr>';
        // echo var_dump($yx);
    
    
        $indz = $yx[0]['id'];
        
        // echo '<hr>';


        if ($indz != '') {
            $modi = $yx[0]['modifieddate'];

            if ($modi == NULL) {
                $modi = '2024-01-01 00:00:00';
            }
            $uuuid = $yx[0]['id'];
            if (strtotime($modi) < strtotime($update_time)) {

                $pamt = $taka * $rate2 / 100;
                $joma = $pamt - $yx[0]['paid'];
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

                // echo '[' . $roll2 . ']'; // No need to update
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
            //$disp .= $cls2 . $sec2 . $roll2 . $stid2 . $z;
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


    //$disp .= $cls2 . ' ' . $sec2 . ' ' . $roll2 . ' (' . $stid2 . ') ';
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

