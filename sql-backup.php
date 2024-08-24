<?php

//or add 5th parameter(array) of specific tables:    array("mytable1","mytable2","mytable3") for multiple tables
function Export_Database($host, $user, $pass, $name, $tables = false, $backup_name = false, $table, $sccode, $type, $param1, $param2, $param3)
{
    global $backup_record;
    global $backup_wrong;
    global $backup_mail;
    $mysqli = new mysqli($host, $user, $pass, $name);
    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");

    $sqlp = "SELECT * from scinfo where sccode='$sccode'";
    $result00n = $mysqli->query($sqlp);
    if ($result00n->num_rows > 0) {
        while ($row0 = $result00n->fetch_assoc()) {
            $ciphering = $row0["algorithm"];
            $encryption_iv = $row0["api_key"];
            $encryption_key = $row0["secret_key"];
        }
    } else {
        $ciphering = "AES-256-CBC";
        $encryption_iv = 'EIMBOX';
        $encryption_key = "1234567891011121";
    }

    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    $content = '';
    $content .= "---\n";
    $content .= '--- Table Name : ' . $table . "\n";
    $content .= "---\n";

    $fldblock = '';
    try {
        $q = $mysqli->query("DESCRIBE $table");
        while ($row = $q->fetch_assoc()) {
            $fldblock .= $row['Field'] . ', ';
        }
        $fldblock = ' (' . rtrim($fldblock, ', ') . ') ';
    } catch (Throwable $e) {
        $fldblock = "Error fetch $table" . mysqli_error($mysqli);
    }

    // echo $fldblock;

    if ($type == 'Daily' || $type == 'Monthly' || $type == 'Date-Specified' || $type == 'Rest') {
        $sqlq = "SELECT * FROM  $table  where sccode= '$sccode' and modifieddate between '$param1' and '$param2'";
    } else if ($type == 'Table') {
        $sqlq = "SELECT * FROM  $table  where sccode= '$sccode'";
    } else if ($type == 'Module' || $type == 'Whole') {  
        $param1 = date('Y-01-01');
        $param2 = date('Y-12-31');
        $sqlq = "SELECT * FROM  $table  where sccode= '$sccode' and modifieddate between '$param1' and '$param2'";
    } else {
        $sqlq = "SELECT * FROM  $table  where sccode= '$sccode' order by id LIMIT 1 desc ";
    }


    $cnt = 0;
    // echo $sqlq . '<br>';

    try {
        $result = $mysqli->query($sqlq);
        $fields_amount = $result->field_count;
        $rows_num = $mysqli->affected_rows;

        // echo $rows_num;

        $linetext = '';

        for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
            while ($row = $result->fetch_row()) {
                if ($st_counter % 1 == 0 || $st_counter == 0) {
                    $linetext .= "\nINSERT INTO " . $table . $fldblock . " VALUES";
                }
                $linetext .= " (";
                for ($j = 0; $j < $fields_amount; $j++) {
                    $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                    if (isset($row[$j])) {
                        $linetext .= '"' . $row[$j] . '"';
                    } else {
                        $linetext .= '""';
                    }
                    if ($j < ($fields_amount - 1)) {
                        $linetext .= ',';
                    }
                }
                $linetext .= ")";

                // echo ' ! ' . $st_counter . ' % ' . $rows_num . ' # ';
                if ((($st_counter + 1) % 1 == 0) || $st_counter + 1 == $rows_num) {

                    $content .= openssl_encrypt($linetext, $ciphering, $encryption_key, $options, $encryption_iv);
                    // $content .= $linetext;
                    $content .= ";\n";
                    $linetext = '';
                    $backup_record++;
                    $cnt++;

                } else {
                    $linetext .= ",";
                }
                $st_counter = $st_counter + 1;
            }
        }
    } catch (Throwable $e) {
        // echo 'Something went wrong';
        $backup_wrong++;
    }
    /**/
    if ($cnt > 0) {
        $backup_mail .= 'Table : ' . $table . ', Record : ' . $cnt . '<br>';
    }

    return $content;
}