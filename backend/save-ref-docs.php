<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
// 0 = new, 1 = update, 2 = delete;
$id = $_POST['id'];
$tail = $_POST['tail'];
$editor = $_POST['editor'];
$refno = $_POST['refno'];
$title = $_POST['title'];

if ($tail == 0) {
    $query331 = "INSERT INTO ref_docs (id, sccode, date, refno, title, content, entryby, entrytime) 
                VALUES (NULL, '$sccode', '$td', '$refno', '$title', '$editor', '$usr', '$cur');";
}


// if ($ont == 1) {
//     if ($id == '' || $id == 0) {

//     } else {
//         $query331 = "UPDATE areas SET areaname = '$cls', subarea = '$sec', sessionyear='$sy' where id = '$id' and user='$rootuser'";
//     }
// } else {
//     $query331 = "DELETE FROM areas where id = '$id' and user='$rootuser'";
// }

echo $query331;

$conn->query($query331);


$sql0x = "SELECT * FROM ref_docs order by id desc limit 1 ;";
$result0xt = $conn->query($sql0x);
if ($result0xt->num_rows > 0) {
    while ($row0x = $result0xt->fetch_assoc()) {
        $partidx = $row0x["id"];
        $cont = $row0x["content"];
    }
}

echo '<br><br>';
echo $cont;