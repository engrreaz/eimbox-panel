<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$tail = $_POST['tail'];
// 0 == Add new (Expenditute), 1 == Edit, 2 == Delete, 3 == Set Memo No., 4 == ........, 5 == Add New (Income)

$id = $_POST['id'];
$dept = $_POST['dept'];
$date = $_POST['date'];
$cate = $_POST['cate'];
$descrip = $_POST['descrip'];
$amt = $_POST['amt'];
$amt = str_replace($enum, $bnum, $amt);


if ($tail == 0) {
    $sccodes = $sccode * 10;
    $query331 = "INSERT INTO cashbook (id, sccode, sessionyear, slots, date, type, refno, partid, category, particulars, income, expenditure, amount, entryby, entrytime, status , memono ) 
    values (NULL, '$sccodes', '$sy', '$dept', '$date', 'Expenditure', '0', '$cate', '', '$descrip', '0', '$amt', '$amt',  '$usr', '$cur', '0', '0' );";
    $conn->query($query331);

    // echo $query331;
} else if ($tail == 1) {

    $query331 = "UPDATE cashbook set slots = '$dept', date = '$date', partid = '$cate', particulars = '$descrip', expenditure = '$amt', amount = '$amt' where id = '$id';";
    $conn->query($query331);
} else if ($tail == 2) {
    $query331 = "DELETE from cashbook  where id = '$id';";
    $conn->query($query331);
} else if ($tail == 3) {
    $sql0 = "SELECT * FROM `cashbook` where (sccode = '$sccode' || sccode = '$sccodes') order by memono desc LIMIT 1;";
    $result0rt = $conn->query($sql0);
    if ($result0rt->num_rows > 0) {
        while ($row0 = $result0rt->fetch_assoc()) {
            $memono = $row0["memono"] + 1;
        }
    }

    $query331 = "UPDATE cashbook set memono='$memono'  where id = '$id';";
    $conn->query($query331);
} else if ($tail == 0) {
    $sccodes = $sccode * 10;
    $query331 = "INSERT INTO cashbook (id, sccode, sessionyear, slots, date, type, refno, partid, category, particulars, income, expenditure, amount, entryby, entrytime, status , memono ) 
    values (NULL, '$sccodes', '$sy', '$dept', '$date', 'Income', '0', '$cate', '', '$descrip', '0', '$amt', '$amt',  '$usr', '$cur', '0', '0' );";
    $conn->query($query331);

    // echo $query331;
} 






echo 'Update Successfully ';