<?php


if ($ind != '') {
    $modi = $finlist[$ind]['modifieddate'];
    if ($modi == NULL) {
        $modi = '2024-01-01';
    }
    if (strtotime($modi) < strtotime($update_time)) {
        // echo '(' . $roll2 . ')'; // Update
        $update++;
        $count++;
        $update_id = $finlist[$ind]['id'];
        $update_paid = $finlist[$ind]['paid'];
        $pamt = $taka * $rate2 / 100;
        $dues = $taka - $update_paid;

        $query3p = "UPDATE stfinance set amount='$taka', payableamt='$pamt', modifieddate = '$cur', dues = '$dues' where id='$update_id' and sccode='$sccode' ;";
        // echo $query3p . '<hr>';
        $conn->query($query3p);

    } else {
        // echo '[' . $roll2 . ']'; // No need to update
        $noneed++;
        // $count++;
    }       
} else {
    // $disp .= '###' . $roll2 . '###'; // Inser new record
    $new++;
    $count++;
    $pamt = $taka * $rate2 / 100;
    $query3p = "INSERT INTO stfinance (id, sccode, sessionyear, classname, sectionname, stid, rollno, partid, particulareng, particularben, amount, month, setupdate, setupby, payableamt, modifieddate, modifiedby, paid, dues)
                               VALUES (NULL, '$sccode', '$sy', '$cls2', '$sec2', '$stid2', '$roll2', '$id',  '$parte', '$partb', '$taka', '$mmm', '$cur', '$usr', '$pamt', '$cur', '$usr', '0', '$pamt') ;";
    // echo $newsl . ') ' . $query3p . '<hr>';
    $newsl++;
    $conn->query($query3p);

    array_push($finlist, array('stid' => $stid2, 'rollno' => $roll2));
}

