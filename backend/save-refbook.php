<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$refno = $_POST['refno'];
$date = $_POST['date'];
$month = $_POST['month'];
$year = $_POST['year'];
$cate = $_POST['cate'];
$title = $_POST['title'];
$descrip = $_POST['descrip'];
$tail = $_POST['tail'];
$slot = $_POST['slot'];

if ($tail == 0) {
    if ($id == 0) {

        $sql0 = "SELECT * FROM refbook where sccode='$sccode' order by refno desc LIMIT 1 ;";
        $result01rr = $conn->query($sql0);
        if ($result01rr->num_rows > 0) {
            while ($row5 = $result01rr->fetch_assoc()) {
                $refno = $row5["refno"];
            }
        } else {
            $refno = '0/' . $sy;
        }
    
        $rrr = explode('/', $refno)[0]+1 . '/' . $sy;
        
        
        $query3g = "INsERT INTO refbook (id, sccode, sessionyear, refno, date, year, month, partid, title, descrip, module, dbtable, sqltext, entryby, entrytime, slot) 
            VALUES (NULL, '$sccode', '$sy', '$rrr', '$date', '$year', '$month', '$cate', '$title', '$descrip', '-', '--', '---', '$usr', '$cur' , '$slot' )";
        $conn->query($query3g);

    } else {
        $query3g = "update refbook set refno='$refno', slot='$slot', date='$date', month='$month', year='$year', partid='$cate', title='$title', descrip='$descrip' where id='$id' and sccode='$sccode';";
        $conn->query($query3g);
    }
} else if ($tail == 2){
    $query3g = "DELETE FROM refbook where id='$id' and sccode='$sccode';";
        $conn->query($query3g);
}

// echo $query3g;