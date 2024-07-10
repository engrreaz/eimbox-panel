<?php
include '../incvar.php';

// // Make sure the captured data exists
// if (isset($_FILES['files']) && !empty($_FILES['files'])) {
//     // Upload destination directory
//     $upload_destination = 'uploads/';
//     // Iterate all the files and move the temporary file to the new directory
//     for ($i = 0; $i < count($_FILES['files']['tmp_name']); $i++) {
//         // Add your validation here
//         $file = $upload_destination . $_FILES['files']['name'][$i];
//         // Move temporary files to new specified location
//         move_uploaded_file($_FILES['files']['tmp_name'][$i], $file);
//         echo $_FILES['files']['tmp_name'][$i] . '/' . $file;
//     }
//     // Output response
//     echo 'Upload Complete!';
// }

$catt = $_POST['datam'];
$fn = $_POST['destfilename'];
//echo $catt . $fn;
$dir = '';
if ($catt == 'student') {
    $dir = $BASE__PATH . '/students';
} else if ($catt == 'teacher') {
    $dir = '../../teacher';
} else if ($catt == 'logo') {
    $dir = $BASE__PATH . '/logo';
} 

//echo '///' . $dir . '****';

if (!file_exists($dir)) {
    mkdir($dir . 'uploads/', 0777, true);
}



for ($i = 0; $i < count($_FILES['files']['tmp_name']); $i++) {
    // Add your validation here
    if ($dir == '') {
        $file = "../uploads/" . $_FILES['files']['name'][$i];
    } else {
        $file = $dir . '/' . $fn;
    }


    move_uploaded_file($_FILES['files']['tmp_name'][$i], $file);
    echo 'Uploaded Successfully';



    // if (file_exists($file)) {
    //     echo $file . " already exists. ";
    // } else {
    //     // Move temporary files to new specified location
    //     move_uploaded_file($_FILES['files']['tmp_name'][$i], $file);
    //     // echo $_FILES['files']['tmp_name'][$i] . '/' . $file;
    //     echo$_FILES['files']['tmp_name'][$i] . ' Uploaded Successfully';
    // }
}
