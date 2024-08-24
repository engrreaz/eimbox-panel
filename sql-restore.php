<?php


$insert = $replace = $error = 0;
$ciphering = $bup_algorithm; //"AES-256-CBC";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$decryption_iv = $bup_api;
$decryption_key = $bup_secret;

// echo openssl_encrypt('GeeksforGeeks', $encode_algorithm, $encode_secret, 0, $encode_api);
// echo '<br>';


// $filename = 'daily-backup-103187-2024-08-08-19-11-26.ebd';
// $filename = 'C:\Users\engrr\OneDrive\Desktop\103187-2024-08-08-19-11-26.ebd';
// $filename = $_POST["file"];
echo 'Uploaded File : <b>' . $dispfilename . '</b><br><br>';
$templine = '';
$lines = file($filename);


$file_sccode = openssl_decrypt($lines[7], $encode_algorithm, $encode_secret, $options, $encode_api);
$file_algorithm = openssl_decrypt($lines[8], $encode_algorithm, $encode_secret, $options, $encode_api);
$file_secret = openssl_decrypt($lines[9], $encode_algorithm, $encode_secret, $options, $encode_api);
$file_api = openssl_decrypt($lines[10], $encode_algorithm, $encode_secret, $options, $encode_api);
// $iv_length = openssl_cipher_iv_length($file_algorithm);
// echo $file_sccode . '/' . $file_algorithm . '/' . $file_secret . '/' . $file_api . '<br><br>';
$lno = 1;
if ($file_sccode == $sccode) {
    foreach ($lines as $line) {
        if (substr($line, 0, 9) == '--- Table') {
            // $xn = str_replace('--- Table Name : ', '', $line);
            // echo $xn . ' &bull; ';
            continue;
        }

        if (substr($line, 0, 3) == '---') {
            continue;
        }

        if (substr($line, 0, 2) == '--' || $line == '' || $line == '/*' || $line == ';') {
            echo $line . '<br>';
            // echo '<br>' .  $lno. '/' . $templine . '<br>';
            continue;
        }

        $templine .= $line;


        if (substr(trim($line), -1, 1) == ';') {
            $templine = openssl_decrypt($templine, $file_algorithm, $file_api, $options, $file_secret);
            // echo '<br>' .  $lno. '/' . $templine . '<br>';
            try {
                $kast = $conn->query($templine);
                if ($kast) {
                    $insert++;
                    // echo '+';
                } else {
                    // echo 'x';
                }
            } catch (Throwable $e) {

                $errno = mysqli_errno($conn);
                $errtext = mysqli_error($conn);

                $get_table_name = strpos($templine, '(');
                $get_table_name = substr($templine, 0, $get_table_name);
                $get_table_name = trim(str_replace('INSERT INTO', '', $get_table_name));

                if ($errno == 1062) {
                    $errtext = str_replace("Duplicate entry '", '', $errtext);
                    $id = str_replace("' for key 'PRIMARY'", '', $errtext);

                    $del = "DELETE FROM $get_table_name WHERE sccode='$sccode' and id='$id';";
                    // echo $del;

                    try {
                        $deldel = $conn->query($del);


                        if ($deldel) {
                            $kast = $conn->query($templine);
                            // echo mysqli_get_client_info($kast);
                            if ($kast) {
                                // echo '-';
                                $replace++;
                            } else {
                                // echo '*';
                            }
                        } else {

                            $error++;
                            // echo '<br>Error-- : ' . $lno . ' || ' . $templine ;
                        }
                    } catch (Throwable $e) {

                    }
                } else {
                    $error++;
                    // echo '<br>Error++ : ' . $lno . ' || ' . $templine ;
                }
                // echo '<br>';
            }
            // $conn->query($templine); -----------------------------------------
            // unset($line[0]);
            $templine = '';
        }

        $lno++;
    }

    echo '<br><a href="index.php" style="font-style:normal;" class="btn btn-inverse-success fst-normal p-2 mt-2 text-small">Go Home</a>';
    echo '<a href="db-restore.php" style="font-style:normal;" class=" btn btn-inverse-warning p-2 mt-2 ml-3  text-small">Restore Another</a><br><br>';


} else {
    echo '<span class="text-warning"><b>Invalid File. This Backup file does not contain your institute data.</b></span><br>';
    echo '<br><a href="db-restore.php" class="btn btn-inverse-warning p-2 mt-2">Ok. Try again.</a><br><br>';


}
$te = date('H:i:s');

echo "Process Completed (Time Elapsed : " . strtotime($te) - strtotime($ts) . ' Seconds.)<br>';
echo "Data Inserted : " . $insert . ', Replaced : ' . $replace . ', Error : ' . $error;
