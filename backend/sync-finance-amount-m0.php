<?php



if ($ind != '') {
    for ($z = 1; $z <= 12; $z++) {
        $tarikh = '2024-' . $z . '-01';
        $mx = ' : ' . date('F/Y', strtotime($tarikh));

        $yx = array_values(array_filter($finlist, function ($bb) {
            return $bb['stid'] == '$stid2' && $bb['month'] == '$z';
        }));


        $indz = $yx[0]['id'];

        if ($indz != '') {
            $modi = $yx[0]['modifieddate'];

            if ($modi == NULL) {
                $modi = '2024-01-01 00:00:00';
            }
            $uuuid = $yx[0]['id'];
            if (strtotime($modi) < strtotime($update_time)) {

                $pamt = $taka * $rate2 / 100;
                $joma = $pamt - $yx[0]['paid'];

                $query3px = "UPDATE stfinance set amount='$taka', payableamt='$pamt', modifieddate = '$cur', dues = '$joma' where id='$uuuid' and sccode='$sccode' ;";

                $conn->query($query3px);
                $update++;
                $count++;
                $query3px = '';

                $fld1 = $stid2 . ' - ' . $z;
                $fld2 = 'STID found, Month Found, Update Need';
                $fld3 = $pamt . ' / ' . $joma;
                $queryhero = "INSERT INTO datatest (id, fld1, fld2, fld3) VALUES (NULL, '$fld1', '$fld2', '$cur') ;";
                $conn->query($queryhero);
                // }
            } else {


                $noneed++;

                $fld1 = $stid2 . ' - ' . $z;
                $fld2 = 'STID found, Month Found, Update Not Need';
                $fld3 = $pamt . ' / ' . $joma;
                $queryhero = "INSERT INTO datatest (id, fld1, fld2, fld3) VALUES (NULL, '$fld1', '$fld2', '$cur') ;";
                $conn->query($queryhero);

            }

        } else {

            $pamt = $taka * $rate2 / 100;
            $mxe = $parte . $mx;
            $mxb = $partb . $mx;
            $query3plo = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, setupdate, setupby, payableamt, modifieddate, modifiedby, paid, dues)
                            VALUES (NULL, '$sccode', '$sy', '$cls2', '$sec2', '$stid2', '$roll2', '$id',  '$mxe', '$mxb', '$taka', '$z', '$cur', '$usr', '$pamt', '$cur', '$usr', '0', '$pamt') ;";



            $conn->query($query3plo);
            $query3plo = '';
            $new++;
            $count++;
            $fld1 = $stid2 . ' - ' . $z;
            $fld2 = 'STID found, Month Not Found, Insert';
            $fld3 = $pamt . ' / ' . $joma;
            $queryhero = "INSERT INTO datatest (id, fld1, fld2, fld3) VALUES (NULL, '$fld1', '$fld2', '$cur') ;";
            $conn->query($queryhero);

        }



        // for.......................
    }

    // $disp .= '@@';
    // m == 0 -------------------------------



    //************************************************************************************************************************** */
} else {


    //$disp .= $cls2 . ' ' . $sec2 . ' ' . $roll2 . ' (' . $stid2 . ') '; //
    $disp .= ' '; // Inser new record
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
        // $conn->query($query3plo);


    }

    $xyz = array('stid' => $stid2, 'rollno' => $roll2, 'classname' => $cls2, 'sccode' => $sccode);
    // array_push($finlist, array('stid' => $stid2, 'rollno' => $roll2));
    array_push($finlist, $xyz);
    // $finlist[] = $xyz;

    $fld1 = $stid2;
    $fld2 = $cls2 . '/' . $sec2 . '/' . $roll2 . '/' . array_search($stid2, array_column($finlist, 'stid'));
    $queryhero = "INSERT INTO datatest (id, fld1, fld2, fld3) VALUES (NULL, '$fld1', '$fld2', '$cur') ;";
    $conn->query($queryhero);



}
