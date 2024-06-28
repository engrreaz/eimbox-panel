<?php
// $disp .= $mmm . '=============';

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

        // $yx = array_values(array_filter($finlist, function($bb){return  $bb['stid'] == '$stid2' && $bb['month'] == '$z';}));
        // $yx = array_values(array_filter($finlist, function ($bb) {
        //     return $bb['stid'] == '$stid2' && $bb['month'] == '$z';
        // }));



        // array_push($yx, array('stid' => $stid2, 'rollno' => $roll2));
        $idmon = $stid2 . $z;
        $indz = array_search($idmon, array_column($finlist, 'idmon'));

        // $indz = $yx[0]['id'];
        // $disp .= '((' . ($indz) . '))';

        // echo '<hr>';
        // $disp .= '<br>' . $cls2 . ' - ' . $sec2 . ' - ' . $roll2 . ' (' . $stid2 . ') <br>';

        if ($indz != '') {
            $modi = $finlist[$indz]['modifieddate'];

            if ($modi == NULL) {
                $modi = '2024-01-01 00:00:00';
            }
            $uuuid = $finlist[$indz]['id'];
            if (strtotime($modi) < strtotime($update_time)) {
                $disp .= '.';
                $pamt = $taka * $rate2 / 100;
                $joma = $pamt - $finlist[$indz]['paid'];
                $idmon = $stid2 . $z;
                $disp .= '{' . $cls2 . '-' . $sec2 . '-' . $roll2 . '-' . $z . '--' . $uuuid . ' ------- }';
                $query3px = "UPDATE stfinance set idmon = '$idmon', amount='$taka', payableamt='$pamt', modifieddate = '$cur', dues = '$joma' where id='$uuuid' and sccode='$sccode' ;";
                // if($stid2 == '1031872887') {
                // echo '<br>' . $query3px . '<br>';
                $conn->query($query3px);

                $query3px = '';

                // $fld1 = $stid2 . ' - ' . $z;
                // $fld2 = 'STID found, Month Found, Update Need';
                // $fld3 = $pamt . ' / ' . $joma;
                // $queryhero = "INSERT INTO datatest (id, fld1, fld2, fld3) VALUES (NULL, '$fld1', '$fld2', '$fld3') ;";
                // $conn->query($queryhero);

                $update++;
                $count++;
                // }
            } else {

                // echo '[' . $roll2 . ']'; // No need to update
                $noneed++;
                // $count++;
                // $fld1 = $stid2 . ' - ' . $z;
                // $fld2 = 'STID found, Month Found, Update Not Need';
                // $fld3 = $pamt . ' / ' . $joma;
                // $queryhero = "INSERT INTO datatest (id, fld1, fld2, fld3) VALUES (NULL, '$fld1', '$fld2', '$fld3') ;";
                // $conn->query($queryhero);

            }

        } else {

            $pamt = $taka * $rate2 / 100;
            $mxe = $parte . $mx;
            $mxb = $partb . $mx;
            $idmon = $stid2 . $z;
            $query3plo = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, idmon, setupdate, setupby, payableamt, modifieddate, modifiedby, paid, dues)
                            VALUES (NULL, '$sccode', '$sy', '$cls2', '$sec2', '$stid2', '$roll2', '$id',  '$mxe', '$mxb', '$taka', '$z', '$idmon', '$cur', '$usr', '$pamt', '$cur', '$usr', '0', '$pamt') ;";
            // $disp .= $stid2 . '/' . $z . ' **************** ';
            $newsl++;

            $disp .= $z . ' - ';
            $new++;
            $count++;
            $conn->query($query3plo);
            $query3plo = '';

            $fld1 = $stid2 . ' - ' . $z;
            $fld2 = 'STID found, Month Not Found, Insert';
            $fld3 = $pamt . ' / ' . $joma;
            $queryhero = "INSERT INTO datatest (id, fld1, fld2, fld3) VALUES (NULL, '$fld1', '$fld2', '$fld3') ;";
            // $conn->query($queryhero);

        }

        // for.......................
    }

    // $disp .= '@@';
    // m == 0 -------------------------------



    //************************************************************************************************************************** */
} else {

    // $disp .= $cls2 . ' ' . $sec2 . ' ' . $roll2 . ' (' . $stid2 . ') *** '; //
    // $disp .=  $roll2 . ' * '; //
    $disp .= ' '; // Inser new record
    $new++;
    $count++;

    for ($z = 1; $z <= 12; $z++) {
        $tarikh = '2024-' . $z . '-01';
        $mx = ' : ' . date('F', strtotime($tarikh)) . '/' . date('Y');

        $pamt = $taka * $rate2 / 100;
        $mxe = $parte . $mx;
        $mxb = $partb . $mx;
        $idmon = $stid2 . $z;
        $query3plo = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, idmon, setupdate, setupby, payableamt, modifieddate, modifiedby, paid, dues)
                                           VALUES (NULL, '$sccode', '$sy', '$cls2', '$sec2', '$stid2', '$roll2', '$id',  '$mxe', '$mxb', '$taka', '$z', '$idmon', '$cur', '$usr', '$pamt', '$cur', '$usr', '0', '$pamt') ;";

        $newsl++;
        // $count++;
        $conn->query($query3plo);

        // $fld1 = $stid2 . ' - ' . $z;
        // $fld2 = 'STID Not found, Insert 12 Record';
        // $fld3 = $pamt . ' / ' . $joma;
        // $queryhero = "INSERT INTO datatest (id, fld1, fld2, fld3) VALUES (NULL, '$fld1', '$fld2', '$fld3' );";
        // $conn->query($queryhero);
    }



    array_push($finlist, array('stid' => $stid2, 'rollno' => $roll2));
    // array_push($finlist, $dd);
}