<?php

$mysqlUserName = $username;
$mysqlPassword = $password;
$mysqlHostName = $servername;
$DbName = $dbname;
$backup_name = "mybackup.sql";
$tables = "bankinfo";

echo '**************************************************************<br>';

//or add 5th parameter(array) of specific tables:    array("mytable1","mytable2","mytable3") for multiple tables

Export_Database($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName, $tables = false, $backup_name = false);

function Export_Database($host, $user, $pass, $name, $tables = false, $backup_name = false)
{
    $mysqli = new mysqli($host, $user, $pass, $name);
    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");

    $queryTables = $mysqli->query('SHOW TABLES');
    while ($row = $queryTables->fetch_row()) {
        $target_tables[] = $row[0];
    }
    if ($tables !== false) {
        $target_tables = array_intersect($target_tables, $tables);
    }
    // include_once 'db.php';
    $table = 'bankinfo';

    // foreach ($target_tables as $table) {
    $result = $mysqli->query('SELECT * FROM ' . $table);
    $fields_amount = $result->field_count;
    $rows_num = $mysqli->affected_rows;
    // $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
    // $TableMLine = $res->fetch_row();
    // $content = (!isset($content) ? '' : $content) . "\n\n" . $TableMLine[1] . ";\n\n";
    $content = '';


    $fldblock = '';
    $q = $mysqli->query('DESCRIBE bankinfo');
    while ($row = $q->fetch_assoc()) {
        $fldblock .= $row['Field'] . ', ';
    }
    $fldblock = ' (' . rtrim($fldblock, ', ') . ') ';




    for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
        while ($row = $result->fetch_row()) {
            if ($st_counter % 1 == 0 || $st_counter == 0) {
                $content .= "\nINSERT INTO " . $table . $fldblock . " VALUES";
            }
            $content .= "\n(";
            for ($j = 0; $j < $fields_amount; $j++) {
                $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                if (isset($row[$j])) {
                    $content .= '"' . $row[$j] . '"';
                } else {
                    $content .= '""';
                }
                if ($j < ($fields_amount - 1)) {
                    $content .= ',';
                }
            }
            $content .= ")";
            //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
            if ((($st_counter + 1) % 1 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                $content .= ";\n";
            } else {
                $content .= ",";
            }
            $st_counter = $st_counter + 1;
        }
    }
    $content .= "\n\n\n";
    // }



    $backup_name = "mybackup.sql";
    echo $backup_name;


    $simple_string = $content . "<br>";
    // echo "Original String: " . $simple_string . "\n";
    // $ciphering = "AES-128-CTR";
    $ciphering = "AES-256-CBC";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = "GeeksforGeeks";

    // Use openssl_encrypt() function to encrypt the data
    // $encryption = openssl_encrypt(
    //     $simple_string,
    //     $ciphering,
    //     $encryption_key,
    //     $options,
    //     $encryption_iv
    // );

    // // Display the encrypted string
    // echo "Encrypted String: " . $encryption . "\n";

    // $content = $encryption;








    $myfile = fopen("newfile.sql", "w") or die("Unable to open file!");
    $txt = $content;
    fwrite($myfile, $txt);
    fclose($myfile);

    // header('Content-Type: application/octet-stream');
    // header("Content-Transfer-Encoding: Binary");
    // header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
    echo '<br>-----------------------------------------<br>';
    echo $content;
    // exit;
}

echo '<br>**************************************************************';