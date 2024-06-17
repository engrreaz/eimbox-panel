<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

// 0 == Add new (Expenditute), 1 == Edit, 2 == Delete, 3 == Set Memo No., 4 == ........, 5 == Add New (Income)

$id = $_POST['id'];
$tail = $_POST['tail'];
$eng = $_POST['eng'];
$ben = $_POST['ben'];
$month = $_POST['month'];
$inin = $_POST['inin'];
$exex = $_POST['exex'];
if($inin == 'true') {$inin = 1;} else {$inin = 0;}
if($exex == 'true') {$exex = 1;} else {$exex = 0;}

if ($tail == 1) {
    if ($id == 0) {
        $sql0 = "SELECT slno FROM financeitem where (sccode = '$sccode' or sccode=0) order by slno desc LIMIT 1;";
        $result0rtz = $conn->query($sql0);
        if ($result0rtz->num_rows > 0) {
            while ($row0 = $result0rtz->fetch_assoc()) {
                $slno = $row0["slno"] + 1;
            }
        }

        $query331 = "INSERT INTO financeitem (id, slno, particulareng, particularben, month, payment, income, expenditure, sccode ) 
    values (NULL, '$slno', '$eng', '$ben', '$month', 1, '$inin', '$exex', '$sccode');";
        $conn->query($query331);
    } else {
        $query331 = "UPDATE financeitem set particulareng = '$eng', particularben = '$ben', month = '$month', income = '$inin', expenditure = '$exex' where id='$id' and sccode = '$sccode';";
        $conn->query($query331);
    }
} else {
    $query331 = "DELETE from financeitem  where id='$id' and sccode = '$sccode';";
    $conn->query($query331);
}


// echo $query331;
echo 'Data Processing Successfully';