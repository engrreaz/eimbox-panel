<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');
$tail = $_POST['tail'];
$id = $_POST['id'];

$year = $_POST['year'];
$cls = $_POST['cls'];
$sub = $_POST['sub'];
$exam = $_POST['exam'];

if ($tail == 5) {
    $skill = $_POST['skill'];
    $code = $_POST['code'];
    $titlex = $_POST['titles'];
    if ($id == 0) {
        //add topic
        $query331 = "INSERT INTO pibitopics (id, sessionyear, class, exam, subcode, skillcode, topiccode, topictitle, level1, level2, level3, continious, total, behave, half_yearly, entrytime) 
                     VALUES (NULL, '$year', '$cls', '$exam', '$sub', '$skill', '$code', '$titlex', '', '', '', '1', '1', '0', '1', '$cur' );";
    } else {
        //edit topic
         $query331 = "UPDATE pibitopics set skillcode='$skill', topiccode='$code', topictitle='$titlex' where id='$id'";
    }

} else if ($tail == 6) {
    // delete topic
}



// echo $query331;
$conn->query($query331);

// if ($ont == 1) {
//     if ($id == '' || $id == 0) {
//         $query331 = "INSERT INTO areas (id, idno, user, areaname, subarea, sessionyear, yesno, entrytime) 
//                 VALUES (NULL, '1', '$rootuser', '$cls', '$sec', '$sy', '1', '$cur');";
//     } else {
//         $query331 = "UPDATE areas SET areaname = '$cls', subarea = '$sec', sessionyear='$sy' where id = '$id' and user='$rootuser'";
//     }
// } else {
//     $query331 = "DELETE FROM areas where id = '$id' and user='$rootuser'";
// }

// echo $query331;


