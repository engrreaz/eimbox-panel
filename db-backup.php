<?php
include 'header.php';
include 'sql-backup.php';
$st = date('Y-m-d H:i:s');
$backup_type = '';
$backup_record = 0;
$backup_wrong = 0;
$date1 = $date2 = $table = $module = '';

$param1 = '';//$bup_last_time;
$param2 = '';
$param3 = '';
$submit = 0;


if (isset($_COOKIE['btype'])) {
    $backup_type = $_COOKIE['btype'];
}


if (isset($_GET['type'])) {
    $backup_type = $_GET['type'];
}


if ($backup_type == '') {
    $date1_label = '';
    $date2_label = '';
    $table_label = '';
    $module_label = '';

    $date1_disp = 'hidden';
    $date2_disp = 'hidden';
    $table_disp = 'hidden';
    $module_disp = 'hidden';

    $date1_ena = '';
    $date2_ena = '';
    $table_ena = '';
    $module_ena = '';

    $date1_val = '';
    $date2_val = '';
    $table_val = '';
    $module_val = '';
} else if ($backup_type == 'Daily') {
    $date1_label = 'Today';
    $date2_label = '';
    $table_label = '';
    $module_label = '';

    $date1_disp = '';
    $date2_disp = 'hidden';
    $table_disp = 'hidden';
    $module_disp = 'hidden';

    $date1_ena = 'disabled';
    $date2_ena = '';
    $table_ena = '';
    $module_ena = '';

    $date1_val = $td;
    $date2_val = '';
    $table_val = '';
    $module_val = '';
} else if ($backup_type == 'Monthly') {
    $date1_label = 'Date From';
    $date2_label = 'Date To';
    $table_label = '';
    $module_label = '';

    $date1_disp = '';
    $date2_disp = '';
    $table_disp = 'hidden';
    $module_disp = 'hidden';

    $date1_ena = 'disabled';
    $date2_ena = 'disabled';
    $table_ena = '';
    $module_ena = '';

    $date1_val = date('Y-m-01');
    $date2_val = date('Y-m-t');
    $table_val = '';
    $module_val = '';
} else if ($backup_type == 'Date-Specified') {
    $date1_label = 'Date From';
    $date2_label = 'Date To';
    $table_label = '';
    $module_label = '';

    $date1_disp = '';
    $date2_disp = '';
    $table_disp = 'hidden';
    $module_disp = 'hidden';

    $date1_ena = '';
    $date2_ena = '';
    $table_ena = '';
    $module_ena = '';

    $date1_val = date('Y-m-01');
    $date2_val = date('Y-m-t');
    $table_val = '';
    $module_val = '';
} else if ($backup_type == 'Table') {
    $date1_label = '';
    $date2_label = '';
    $table_label = 'Data Tables';
    $module_label = '';

    $date1_disp = 'hidden';
    $date2_disp = 'hidden';
    $table_disp = '';
    $module_disp = 'hidden';

    $date1_ena = '';
    $date2_ena = '';
    $table_ena = '';
    $module_ena = '';

    $date1_val = '';
    $date2_val = '';
    $table_val = '';////////////////////
    $module_val = '';
} else if ($backup_type == 'Module') {
    $date1_label = '';
    $date2_label = '';
    $table_label = '';
    $module_label = 'Modules List';

    $date1_disp = 'hidden';
    $date2_disp = 'hidden';
    $table_disp = 'hidden';
    $module_disp = '';

    $date1_ena = '';
    $date2_ena = '';
    $table_ena = '';
    $module_ena = '';

    $date1_val = '';
    $date2_val = '';
    $table_val = '';
    $module_val = ''; ///////////////
} else if ($backup_type == 'Rest') {
    $date1_label = '';
    $date2_label = '';
    $table_label = '';
    $module_label = '';

    $date1_disp = 'hidden';
    $date2_disp = 'hidden';
    $table_disp = 'hidden';
    $module_disp = 'hidden';

    $date1_ena = '';
    $date2_ena = '';
    $table_ena = '';
    $module_ena = '';

    $date1_val = '';
    $date2_val = '';
    $table_val = '';
    $module_val = ''; ///////////////
} else if ($backup_type == 'Whole') {
    $date1_label = '';
    $date2_label = '';
    $table_label = '';
    $module_label = '';

    $date1_disp = 'hidden';
    $date2_disp = 'hidden';
    $table_disp = 'hidden';
    $module_disp = 'hidden';

    $date1_ena = '';
    $date2_ena = '';
    $table_ena = '';
    $module_ena = '';

    $date1_val = '';
    $date2_val = '';
    $table_val = '';
    $module_val = ''; ///////////////
} else if ($backup_type == 'User') {
    $date1_label = '';
    $date2_label = '';
    $table_label = 'User Data';
    $module_label = '';

    $date1_disp = 'hidden';
    $date2_disp = 'hidden';
    $table_disp = '';
    $module_disp = 'hidden';

    $date1_ena = '';
    $date2_ena = '';
    $table_ena = '';
    $module_ena = '';

    $date1_val = '';
    $date2_val = '';
    $table_val = $usr;
    $module_val = ''; ///////////////
} else {
    $date1_label = '';
    $date2_label = '';
    $table_label = '';
    $module_label = '';

    $date1_disp = 'hidden';
    $date2_disp = 'hidden';
    $table_disp = 'hidden';
    $module_disp = 'hidden';

    $date1_ena = '';
    $date2_ena = '';
    $table_ena = '';
    $module_ena = '';

    $date1_val = '';
    $date2_val = '';
    $table_val = '';
    $module_val = '';
}

if (isset($_COOKIE['subm'])) {
    $submit = $_COOKIE['subm'];
}

// if (isset($_GET['submit'])) {
if ($submit == 1) {
    $backup_type = $_COOKIE['btype'];
    $date1 = $_COOKIE['date1'];
    $date2 = $_COOKIE['date2'];
    $table = $_COOKIE['tname'];
    $module = $_COOKIE['mname'];

    // $backup_type = $backup_type;
    $date1_val = $date1;
    $date2_val = $date2;
    $table_val = $table;
    $module_val = $module;



    if ($backup_type == '') {
        $param1 = '';
        $param2 = '';
    } else if ($backup_type == 'Daily') {
        $param1 = $date1_val;
        $param2 = $date1_val;
    } else if ($backup_type == 'Monthly') {
        $param1 = $date1_val;
        $param2 = $date2_val;
    } else if ($backup_type == 'Date-Specified') {
        $param1 = $date1_val;
        $param2 = $date2_val;
    } else if ($backup_type == 'Table') {
        $param1 = $table_val;
        $param2 = '';
    } else if ($backup_type == 'Module') {
        $param1 = $module_val;
        $param2 = '';
    } else if ($backup_type == 'Rest') {
        $param1 = $bup_last_time;
        $param2 = $cur;
    } else if ($backup_type == 'User') {
        $param1 = $usr;
        $param2 = $td;
    } else if ($backup_type == 'Whole') {
        $param1 = '2024-01-01';
        $param2 = $td;
    } else {
        $param1 = '';
        $param2 = '';
    }
}




?>
<style>
    #full-text {

        font-family: "Source Code Pro", monospace;
        font-optical-sizing: auto;
        font-weight: 400;
    }
</style>
<h3 class="d-print-none">Backup Your Data</h3>
<p class="d-print-none">
    <code>Settings > Data Repository > Data Backup </code>
</p>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                </h6>

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Backup Type</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="backuptype" onchange="backuptype();">
                                    <option value=""></option>
                                    <option value="Daily" <?php if ($backup_type == 'Daily') {
                                        echo 'selected';
                                    } ?>>Daily
                                        Backup (Today)</option>
                                    <option value="Monthly" <?php if ($backup_type == 'Monthly') {
                                        echo 'selected';
                                    } ?>>
                                        Monthly Backup</option>
                                    <option value="Date-Specified" <?php if ($backup_type == 'Date-Specified') {
                                        echo 'selected';
                                    } ?>>Specific Date</option>
                                    <option value="Table" <?php if ($backup_type == 'Table') {
                                        echo 'selected';
                                    } ?>>Specific
                                        Table</option>
                                    <option value="Module" <?php if ($backup_type == 'Module') {
                                        echo 'selected';
                                    } ?>>Module
                                        Based Data</option>
                                    <option value="User" <?php if ($backup_type == 'My Data') {
                                        echo 'selected';
                                    } ?>>User   Data</option>
                                    <option value="Rest" <?php if ($backup_type == 'Rest') {
                                        echo 'selected';
                                    } ?>>From
                                        Previous Backup</option>
                                    <option value="Whole" <?php if ($backup_type == 'Whole') {
                                        echo 'selected';
                                    } ?>>Whole
                                        Backup</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3"><?php echo $date1_label; ?></label>
                            <div class="col-12">
                                <input type="date" id="date1" class="form-control bg-dark"
                                    value="<?php echo $date1_val; ?>" <?php echo $date1_disp . ' ' . $date1_ena; ?> />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3"><?php echo $date2_label; ?></label>
                            <div class="col-12">
                                <input type="date" id="date2" name="date2" class="form-control bg-dark"
                                    value="<?php echo $date2_val; ?>" <?php echo $date2_disp . ' ' . $date2_ena; ?> />
                            </div>
                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3"><?php echo $table_label; ?></label>
                            <div class="col-12">
                                <select class="form-control text-white bg-dark" id="table_list" id="table_list"
                                    value="<?php echo $table_val; ?>" <?php echo $table_disp . ' ' . $table_ena; ?>>
                                    <option value="">---</option>
                                    <option value="cashbook">Cash Book</option>
                                    <option value="examlist">Exam List</option>
                                    <option value="examname">Exam Name</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label class="col-form-label pl-3"><?php echo $module_label; ?></label>
                            <div class="col-12">
                                <select class="form-control text-white bg-dark" id="module_list"
                                    value="<?php echo $module_val; ?>" <?php echo $module_disp . ' ' . $module_ena; ?>>
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT * FROM backup_module order by module_name;";
                                    // echo $sql0x;
                                    $result0r = $conn->query($sql0x);
                                    if ($result0r->num_rows > 0) {
                                        while ($row0x = $result0r->fetch_assoc()) {
                                            $mmnn = $row0x["module_name"];
                                            if ($param1 == $mmnn) {
                                                $selsec = 'selected';
                                            } else {
                                                $selsec = '';
                                            }
                                            echo '<option value="' . $mmnn . '" ' . $selsec . ' >' . $mmnn . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-inverse-success btn-icon-text btn-block p-2" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>Backup Now</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<div class="row d-print-none" id="ren" hidden>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div id="alladmit">

                        <head>
                            <style>
                                * {
                                    font-family: "Noto Sans Bengali", sans-serif;
                                }



                                #full-text {

                                    font-family: "Source Code Pro", monospace;
                                    font-optical-sizing: auto;
                                    font-weight: 400;
                                    /* font-style: italic; */
                                }

                                #main-table td {
                                    border: 1px solid black;
                                }

                                .txt-right {
                                    text-align: center;
                                    font-weight: bold;
                                    font-size: 14px;
                                    padding: 5px;
                                    border: 1px solid gray !important;
                                }

                                .ooo {
                                    padding: 3px 0;
                                }

                                @media print {

                                    .d-print-nones,
                                    #nono {
                                        display: none;
                                    }
                                }
                            </style>
                        </head>
                        <div style="text-align: left;">


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row d-print-none" id="full-textxx">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body ">
                <div class="row text-small text-wrap d-block ml-2" id="full-text">

                    <?php
                    // echo $backup_type . ' &bull; ' . $param1 . ' &bull; ' . $param2 . '<br>';
                    if ($backup_type != '' && $param1 != '') {


                        echo 'Backup Type : ' . $backup_type;
                        echo '<br>Query Parameters : ' . $param1 . ' &bull; ' . $param2 . '<br>';
                        echo '';


                        $backup_mail = '';

                        $backup_file_name = $backup_type . '-' . $sccode . '-' . date('d_m_Y_H_i_s', strtotime($cur)) . '.ebd';
                        $contents = "-- EIMBox Encrypted Data File\n";
                        $contents .= "-- " . $scname . ' (' . $sccode . ')' . "\n";
                        $contents .= '-- Backup Time : ' . date('l, d F, Y H:i:s', strtotime($cur)) . "\n";
                        $contents .= '-- Backup Type : ' . $backup_type . " * " . $param1 . " * " . $param2 . "\n";
                        $contents .= '-- Backup by : ' . $usr . "\n";
                        $contents .= '-- Filename : ' . $backup_file_name . ".ebd\n";
                        $contents .= "\n";

                        $options = 0;
                        $file_sccode = openssl_encrypt($sccode, $encode_algorithm, $encode_secret, $options, $encode_api);
                        $file_algorithm = openssl_encrypt($bup_algorithm, $encode_algorithm, $encode_secret, $options, $encode_api);
                        $file_secret = openssl_encrypt($bup_secret, $encode_algorithm, $encode_secret, $options, $encode_api);
                        $file_api = openssl_encrypt($bup_api, $encode_algorithm, $encode_secret, $options, $encode_api);

                        $contents .= "--- " . $file_sccode . "\n";
                        $contents .= "--- " . $file_algorithm . "\n";
                        $contents .= "--- " . $file_api . "\n";
                        $contents .= "--- " . $file_secret . "\n";
                        $contents .= "-- --------------------------------\n";
                        $contents .= "\n";


                       

                        if ($backup_type == 'Module') {
                            $sql0 = "SELECT * FROM backup_module where module_name='$param1' ;";
                            $result0 = $conn->query($sql0);
                            if ($result0->num_rows > 0) {
                                while ($row5 = $result0->fetch_assoc()) {
                                    $t_list = "-- " . $row5["table_list"];
                                }
                            } else {
                                $t_list = '--';
                            }
                            echo $t_list . ' ---- ';
                        }


                        $sql = "SHOW TABLES FROM $dbname";
                        $result00 = $conn->query($sql);
                        if ($result00->num_rows > 0) {
                            while ($row0 = $result00->fetch_assoc()) {
                                $lst = $row0["Tables_in_" . $dbname];
                                // echo $lst . ' &bull; ';
                                $yn = array_search($lst, $ignore_table);
                                // echo $yn;
                                // if ($lst == 'audit_temp' || $lst == 'branchlist') {
                    
                                if ($backup_type == 'Table' && $param1 != $lst) {
                                    $yn = 1;
                                }

                                if ($backup_type == 'Module') {
                                    $pos = strpos($t_list, "#" . $lst . ',');
                                    if ($pos > 0) {
                                        $yn = '';
                                    } else {
                                        $yn = 1;
                                    }
                                }

                                if ($yn == '' || $yn == NULL) {
                                    // echo $lst;
                                    $cons = '';
                                    $cons = Export_Database($servername, $username, $password, $dbname, $tables = false, $backup_name = false, $lst, $sccode, $backup_type, $param1, $param2, $param3);
                                    $contents .= $cons . "\n\n";
                                }
                            }
                        }


                        if ($backup_record > 0) {
                            $contents .= "-- End of File";
                            $main_name = $backup_file_name;
                            $backup_file_name = 'backup/' . $sccode . '/' . $backup_file_name;
                            // $backup_file_name = 'backup/' . $sccode . '/mydata.ebd';
                    
                            $myfile = fopen($backup_file_name, "w") or die("Unable to open file!");
                            fwrite($myfile, $contents);
                            fclose($myfile);

                            $ftime = date('Y-m-d H:i:s');
                            $fsize = filesize($backup_file_name);
                            $query331 = "INSERT INTO backup_info (id, sccode, type, param1, param2, param3, filename, backupby, backup_time, file_size, restore_time, deletion_time) 
                                        VALUES (NULL, '$sccode', '$backup_type', '$param1', '$param2', '$param3', '$main_name', '$usr', '$ftime', '$fsize', NULL, NULL);";
                            $conn->query($query331);
                            
                            if ($backup_type == 'Rest') {
                                $query332 = "UPDATE scinfo set last_backup_time='$ftime' where sccode='$sccode';";
                                $conn->query($query332);
                            }

                            echo '<br>';
                            echo 'File Name : ' . $main_name;
                            echo '<br>';
                            echo 'File Size : ' . $fsize / (1024) . ' KB';
                            ?>

                            <div class="d-flex">
                                <a download class="btn btn-inverse-primary mt-3"
                                    href="backup/<?php echo $sccode . '/' . $main_name; ?>"><small>Download</small></a>
                                <button class="btn btn-inverse-warning mt-3 ml-2" onclick="mailto();">Send Mail</button>
                                <button class="btn btn-inverse-danger mt-3 ml-2" onclick="del();">Delete Backup</button>
                            </div>

                            <?php



                        }
                        echo '<br><br>' . $backup_mail;


                        // header('Content-Type: application/octet-stream');
                        // header("Content-Transfer-Encoding: Binary");
                        // header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
                        // echo '<br>-----------------------------------------<br>';
                        // echo $contents;
                        // exit;
                        $withwrong = 0;
                        if ($backup_record == 0) {
                            $withwrong = '<span style="color:red; "> No backup file created/stored.</span>';
                        } else if ($backup_wrong > 0) {
                            $withwrong = '<span style="color:red; "> with ' . $backup_wrong . ' wrong executions.</span><br>Please contact with your administrator or system developer to fix this issue.';
                        }
                        echo '<br><br>Total <b>' . $backup_record . '</b> record backup successfully ' . $withwrong;

                        $et = date('Y-m-d H:i:s');
                        $pt = strtotime($et) - strtotime($st);
                        echo "<br>Process Completed in " . $pt . " Seconds.";
                        // echo date('H:i:s');
                    
                        // Record Backup_information
                    
                        ////////////////////////////////////////////////////////////////////////
                        ////////////////////////////////////////////////////////////////////////
                        ////////////////////////////////////////////////////////////////////////
                        ////////////////////////////////////////////////////////////////////////
                        ////////////////////////////////////////////////////////////////////////
                    
                    } else {
                        echo 'Please select backup type and others parameters to backup data';
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>








<?php
include 'footer.php';
?>

<script>
    var uri = window.location.href;
    document.getElementById('defbtn').innerHTML = '----';
    document.getElementById('defmenu').innerHTML = '';
    document.cookie = "btype=";
    document.cookie = "date1=";
    document.cookie = "date2=";
    document.cookie = "tname=";
    document.cookie = "mname=";
    document.cookie = "subm=0";
</script>



<script>
    function backuptype() {
        var type = document.getElementById('backuptype').value;
        // sessionStorage.setItem("btype", type);
        window.location.href = 'db-backup.php?type=' + type;
    }
</script>

<script>
    function go() {
        var submit = '1';
        var backuptype = document.getElementById('backuptype').value;
        var date1 = document.getElementById('date1').value;
        var date2 = document.getElementById('date2').value;
        var table = document.getElementById('table_list').value;
        var module = document.getElementById('module_list').value;
        document.cookie = "btype=" + backuptype;
        document.cookie = "date1=" + date1;
        document.cookie = "date2=" + date2;
        document.cookie = "tname=" + table;
        document.cookie = "mname=" + module;
        document.cookie = "subm=" + submit;
        // window.location.href = 'db-backup.php?&type=' + backuptype + '&date1=' + date1 + '&date2=' + date2 + '&table=' + table + '&module=' + module + '&submit';
        window.location.href = 'db-backup.php';
    }
</script>


<script>
    function del() {
        var fname = '<?php echo $backup_file_name; ?>';
        var fs = require('fs');
        fs.unlink(fname, function (err) {
            alert("Unable to delete file.");
        });
    }
</script>