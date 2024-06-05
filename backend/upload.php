<?php
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




$upload = 'err'; 
if(!empty($_FILES['file'])){ 
     
    // File upload configuration 
    $targetDir = "uploads/"; 
    $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
     
    $fileName = basename($_FILES['file']['name']); 
    $targetFilePath = $targetDir.$fileName; 
     
    // Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    if(in_array($fileType, $allowTypes)){ 
        // Upload file to the server 
        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
            $upload = 'ok'; 
        } 
    } 
} 
echo $upload; 


