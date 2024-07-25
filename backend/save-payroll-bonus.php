<?php
date_default_timezone_set('Asia/Dhaka');
include ('inc2.php');

$id = $_POST['id'];
$month = $_POST['month'];
$year = $_POST['year'];

for ($i = 0; $i <= 1; $i++) {
    if ($i == 0) {
        $slt = 'govt';
    } else {
        $slt = 'school';
    }
    for ($j = 1; $j <= 3; $j++) {
        $pnt = $slt . $j;
        $a = $pnt . 'title';
        $$a = $_POST[$a];
        $a = $pnt . 'type';
        $$a = $_POST[$a];
        $a = $pnt . 'value';
        $$a = $_POST[$a];
        $a = $pnt . 'pool';
        $$a = $_POST[$a];
        $a = $pnt . 'chq';
        $$a = $_POST[$a];
        $a = $pnt . 'desc';
        $$a = $_POST[$a];
    }
}

if ($id == 0) {
    $query331 = "INSERT INTO salaryextracolumn (
            id, sccode, sessionyear, month,
            govt1title, govt1type, govt1value, govt1pool, govt1chq, govt1desc,
            govt2title, govt2type, govt2value, govt2pool, govt2chq, govt2desc,
            govt3title, govt3type, govt3value, govt3pool, govt3chq, govt3desc,
            school1title, school1type, school1value, school1pool, school1chq, school1desc,
            school2title, school2type, school2value, school2pool, school2chq, school2desc,
            school3title, school3type, school3value, school3pool, school3chq, school3desc,
            entrytime) VALUES (NULL, '$sccode', '$year', '$month',
            '$govt1title', '$govt1type', '$govt1value', '$govt1pool', '$govt1chq', '$govt1desc', 
            '$govt2title', '$govt2type', '$govt2value', '$govt2pool', '$govt2chq', '$govt2desc', 
            '$govt3title', '$govt3type', '$govt3value', '$govt3pool', '$govt3chq', '$govt3desc', 
            '$school1title', '$school1type', '$school1value', '$school1pool', '$school1chq', '$school1desc', 
            '$school2title', '$school2type', '$school2value', '$school2pool', '$school2chq', '$school2desc', 
            '$school3title', '$school3type', '$school3value', '$school3pool', '$school3chq', '$school3desc', 
            '$cur');";
} else {
    $query331 = "UPDATE salaryextracolumn set sessionyear='$year', month='$month',
        govt1title='$govt1title', govt1type='$govt1type', govt1value='$govt1value', govt1pool='$govt1pool', govt1chq='$govt1chq', govt1desc='$govt1desc',
        govt2title='$govt2title', govt2type='$govt2type', govt2value='$govt2value', govt2pool='$govt2pool', govt2chq='$govt2chq', govt2desc='$govt2desc',
        govt3title='$govt3title', govt3type='$govt3type', govt3value='$govt3value', govt3pool='$govt3pool', govt3chq='$govt3chq', govt3desc='$govt3desc',
        school1title='$school1title', school1type='$school1type', school1value='$school1value', school1pool='$school1pool', school1chq='$school1chq', school1desc='$school1desc',
        school2title='$school2title', school2type='$school2type', school2value='$school2value', school2pool='$school2pool', school2chq='$school2chq', school2desc='$school2desc',
        school3title='$school3title', school3type='$school3type', school3value='$school3value', school3pool='$school3pool', school3chq='$school3chq', school3desc='$school3desc'
        where sccode='$sccode' and id='$id';
    
    
    ;";

}

// if ($ont == 1) {
//     if ($id == '' || $id == 0) {
//         $query331 = "INSERT INTO examlist (id, sccode, sessionyear, slot, examtitle, classname, sectionname, datestart, createdby, createtime, status) 
//                 VALUES (NULL, '$sccode', '$sy', '$slot', '$exam', '$cls', '$sec', '$date', '$usr', '$cur', '1');";
//     } else {
//         $query331 = "UPDATE examlist SET examtitle = '$exam', classname = '$cls', sectionname='$sec', datestart='$date' where id = '$id' and sccode='$sccode'";
//     }
// } else {
//     $query331 = "DELETE FROM examlist where id = '$id' and sccode='$sccode'";
// }

echo '<br><i class="p-2 mt-3 mdi mdi-check-circle mdi-24px text-success"></i> Data Saved/Updated.';
$conn->query($query331);
