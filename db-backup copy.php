<?php
include 'header.php';

echo date('H:i:s');
$refno = '';
$refdate = date('Y-m-d');

if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date('Y');
}

if (isset($_GET['cls'])) {
    $cls2 = $_GET['cls'];
} else {
    $cls2 = '';
}
if (isset($_GET['sec'])) {
    $sec2 = $_GET['sec'];
} else {
    $sec2 = '';
}
if (isset($_GET['exam'])) {
    $exam2 = $_GET['exam'];
} else {
    $exam2 = '';
}

$col = 3;
$status = 0;

if (isset($_GET['addnew'])) {
    $newblock = 'block';
    $exid = $_GET['addnew'];
    if ($exid == '') {
        $exid = 0;
    }
} else {
    $newblock = 'none';
    $exid = 0;
}



?>

<h3 class="d-print-none">Backup</h3>
<p class="d-print-none">
    <code>Reports <i class="mdi mdi-arrow-right"></i> Students List </code>
</p>

<div class="row d-print-none">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted font-weight-normal">
                </h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Year</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="year">
                                    <option value="0"></option>
                                    <?php
                                    for ($y = date('Y'); $y >= 2024; $y--) {
                                        $flt2 = '';
                                        if ($year == $y) {
                                            $flt2 = 'selected';
                                        }
                                        echo '<option value="' . $y . '"' . $flt2 . '>' . $y . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Class :</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="cls" onchange="go();">
                                    <option value=" ">---</option>
                                    <?php
                                    $sql0x = "SELECT areaname FROM areas where user='$rootuser' and sessionyear='$year' group by areaname order by idno;";
                                    $result0x = $conn->query($sql0x);
                                    if ($result0x->num_rows > 0) {
                                        while ($row0x = $result0x->fetch_assoc()) {
                                            $cls = $row0x["areaname"];
                                            if ($cls == $cls2) {
                                                $selcls = 'selected';
                                            } else {
                                                $selcls = '';
                                            }
                                            echo '<option value="' . $cls . '" ' . $selcls . ' >' . $cls . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-form-label pl-3">Section</label>
                            <div class="col-12">
                                <select class="form-control text-white" id="sec" onchange="go();">
                                    <option value="">---</option>
                                    <?php
                                    $sql0x = "SELECT subarea FROM areas where user='$rootuser' and sessionyear='$year' and areaname='$cls2' group by subarea order by idno;";
                                    // echo $sql0x;
                                    $result0r = $conn->query($sql0x);
                                    if ($result0r->num_rows > 0) {
                                        while ($row0x = $result0r->fetch_assoc()) {
                                            $sec = $row0x["subarea"];
                                            if ($sec == $sec2) {
                                                $selsec = 'selected';
                                            } else {
                                                $selsec = '';
                                            }
                                            echo '<option value="' . $sec . '" ' . $selsec . ' >' . $sec . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="col-form-label pl-3">&nbsp;</label>
                                <button type="button" style="padding:4px 10px 3px; border-radius:5px;"
                                    class="btn btn-lg btn-outline-success btn-icon-text btn-block" style=""
                                    onclick="go();"><i class="mdi mdi-eye"></i>
                                    Generate
                                    Card</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row d-print-none" id="ren">
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
                            Class : <b><?php echo $cls2; ?></b>
                            Section : <b><?php echo $sec2; ?></b>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row d-print-none" id="renxx">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row text-small">

                    <?php
                    $sql = "SHOW TABLES FROM eimbox";
                    $result00 = $conn->query($sql);
                    if ($result00->num_rows > 0) {
                        while ($row0 = $result00->fetch_assoc()) {
                            $lst = $row0["Tables_in_eimbox"];
                            // echo $lst . ' /// ';
                        }
                    }
                    $tablename = 'bankinfo';

                    $fldblock = '';
                    $q = $conn->query('DESCRIBE bankinfo');
                    while ($row = $q->fetch_assoc()) {
                        $fldblock .= $row['Field'] . ', ';
                    }
                    $fldblock = ' (' . rtrim($fldblock, ', ') . ') ';
                    echo $fldblock . "<br>";



                    // print_r(openssl_get_cipher_methods());
                    

                    $simple_string = $fldblock . "<br>";
                    $simple_string = "SXPbuTxYZIqRI3T66igsGwpWtC+Ym0M0XMeHDhleZMjJQ+Oed8+G7YttzJZQAkR7n/2qdOQYFNntk8j3hVtR0Tnm1eQIY+H6wR3D9/cZ38H6Vbm9SpQM+rZS7R3OVEERv5UUEfivYt+jLulN6A63n4OTbrDCmeHWQb0fkBxdZX/EZ5mgis5WEF7K9vlYDXo3y+SGnor5MONIDYFL9OAZmW+MZJ0+nXusNLmXB7HptGGHb82IQsRRpMzYXk31V426CoJs73nNz7WGQt4eIU2nFgyWyzTZkgLcTe2mFhNwz13H1fDdALuFCvGxh1lRdDf0gFC6PHyJwzP4yIzmhVWTojILxu8AQ5J3aNFJHiVIbB981HUFb2KGFMijkYVMwdD4sjyuuvvZp4QBC4hLOYZTOsVnKhFW/v+zWmTQOUJcnP9si1l8IsTwJiEpYHPnbmRqrj39qVn2lFox/1iFbIXpcAdhIe0zxssKqLYsH2EA8r4JciixgSm3LuM6brGEu/aNQzYpMCabaO/ftGRSuVVClFfMpdK8FPMDI5Hq+xK8NXN3ucIb+LhUtdPqGXg+mkEr/rCbrT5cgTqDHSlypYbC6aYe4p/DsYLiuClgO9K5r2YNY/65pkmr1Wwtvd7C9tgc";
                    echo "Original String: " . $simple_string . "\n";
                    // $ciphering = "AES-128-CTR";
                    $ciphering = "AES-256-CBC";
                    $iv_length = openssl_cipher_iv_length($ciphering);
                    $options = 0;
                    $encryption_iv = '1234567891011121';
                    $encryption_key = "GeeksforGeeks";

                    $encryption = openssl_encrypt(
                        $simple_string,
                        $ciphering,
                        $encryption_key,
                        $options,
                        $encryption_iv
                    );

                    // Display the encrypted string
                    // echo "Encrypted String: " . $encryption . "\n";
                    
                    // Non-NULL Initialization Vector for decryption
                    $decryption_iv = '1234567891011121';
                    $decryption_key = "GeeksforGeeks";
                    $decryption = openssl_decrypt(
                        $simple_string,
                        $ciphering,
                        $decryption_key,
                        $options,
                        $decryption_iv
                    );


                    // Display the decrypted string
                    echo "Decrypted String: " . $decryption;





                    ///************************************************************************************** */
///************************************************************************************** */
///************************************************************************************** */
///************************************************************************************** */
///************************************************************************************** */
                    

                    // EXPORT DATA IN TEXT / TAB FORMAT
                    $tableName = 'bankinfo';
                    $backupFile = 'backup/mypet.sql';
                    // $query = "SELECT * INTO OUTFILE '$backupFile' FROM $tableName";
                    // $result = $conn->query($query);
                    // echo $query;
                    
                    // include 'sql-backup.php';
                    
                    ////////////////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////////////////
                    echo '<br><br><br>';
                    $filename = 'newfile.sql';
                    $filename = 'daily-backup-103187-2024-08-08-19-11-26.ebd';
                    $filename = 'C:\Users\engrr\OneDrive\Desktop\daily-backup-103187-2024-08-08-19-11-26.ebd';
                    $templine = '';
                    $lines = file($filename);


                    // $myfile = fopen($filename, "w") or die("Unable to open file!");
                    // unset($lines[8]);
                    // // $txt = $content;
                    // // fwrite($myfile, $txt);
                    // fclose($myfile);


                    // // $lines = openssl_decrypt(
                    // //     $linesx,
                    // //     $ciphering,
                    // //     $decryption_key,
                    // //     $options,
                    // //     $decryption_iv
                    // // );
                    




                    foreach ($lines as $line) {
                        if (substr($line, 0, 3) == '---') {
                            echo $line . '<br>';
                            continue;
                        }


                        if (substr($line, 0, 2) == '--' || $line == '' || $line == '/*') {
                            echo $line . '<br>';
                            continue;
                        }

                        $templine .= $line;

                        if (substr(trim($line), -1, 1) == ';') {
                            // mysqli_query($conn, $templine) ;
                    
                            $templine = openssl_decrypt(
                                $templine,
                                $ciphering,
                                $decryption_key,
                                $options,
                                $decryption_iv
                            );

                            echo $templine . '<br>--------------------------------------------------------------<br>';

                            try {


                                $kast = $conn->query($templine);
                                if ($kast) {
                                    echo 'Executed_______________<br>';
                                } else {
                                    echo '** Error_________________________________________________________________<br>';
                                }
                            } catch (Throwable $e) {
                                // do your handling here 
                                // echo '<br>~~~~~~~~~~~~~~~~~~~~~~~~';
                                // echo $e;
                                // echo '<br>~~~~~~~~~~~~~~~~~~~~~~~~';
                    
                                $errno = mysqli_errno($conn);
                                $errtext = mysqli_error($conn);
                                echo 'Error : ' . $errno . ' - ' . $errtext;

                                if ($errno == 1062) {
                                    $errtext = str_replace("Duplicate entry '", '', $errtext);
                                    $id = str_replace("' for key 'PRIMARY'", '', $errtext);
                                    echo '<br>' . $id;

                                    $del = "DELETE FROM $tablename WHERE sccode='$sccode' and id='$id';";
                                    echo $del;

                                    try {
                                        $deldel = $conn->query($del);


                                        if ($deldel) {
                                            $kast = $conn->query($templine);
                                            // echo mysqli_get_client_info($kast);
                                            if ($kast) {
                                                echo 'Executed TRY/CATCH_______________<br>';
                                            } else {
                                                echo '** Error_________________________________________________________________<br>';
                                            }
                                        } else {
                                            echo 'FAILED';
                                        }
                                    } catch (Throwable $e) {
                                        echo 'FAILED*****************';
                                    }
                                }
                                echo '<br>';
                            }
                            // $conn->query($templine); -----------------------------------------
                            // unset($line[0]);
                            $templine = '';
                        }
                    }
                    echo "Process Completed";
                    echo date('H:i:s');


                    ////////////////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////////////////
                    





                    ?>





                    <table class="table table-bordered table-striped "
                        style=" border:1px solid gray !important; border-collapse:collapse;" id="main-table">
                        <thead>
                            <tr>
                                <td class="txt-right">#</td>
                                <td class="txt-right">Name of Student</td>
                                <td class="txt-right">Parents</td>
                                <td class="txt-right">Address</td>
                                <td class="txt-right">Roll/Regd</td>
                                <td class="txt-right">Result</td>
                                <td class="txt-right"></td>
                            </tr>
                        </thead>

                        <tbody>



                            <?php
                            $cnt = 0;
                            $cntamt = 0;
                            $sql0 = "SELECT * FROM sessioninfo where sessionyear='$sy' and sccode='$sccode' and classname='$cls2' and sectionname = '$sec2' order by rollno";
                            $result0 = $conn->query($sql0);
                            if ($result0->num_rows > 0) {
                                while ($row0 = $result0->fetch_assoc()) {
                                    $stid = $row0["stid"];
                                    $rollno = $row0["rollno"];
                                    $card = $row0["icardst"];
                                    $dtid = $row0["id"];
                                    $status = $row0["status"];
                                    $rel = $row0["religion"];
                                    $four = $row0["fourth_subject"];


                                    $sql00 = "SELECT * FROM students where  sccode='$sccode' and stid='$stid' LIMIT 1";
                                    $result00 = $conn->query($sql00);
                                    if ($result00->num_rows > 0) {
                                        while ($row00 = $result00->fetch_assoc()) {
                                            $neng = $row00["stnameeng"];
                                            $nben = $row00["stnameben"];

                                            $fname = $row00["fname"];
                                            $mname = $row00["mname"];
                                            $vill = $row00["pervill"];
                                            $po = $row00["perpo"];
                                            $ps = $row00["perps"];
                                            $dist = $row00["perdist"];
                                            $dob = $row00["dob"];



                                            $regdno = $row00["regdno"];
                                            $sscroll = $row00["rollno"];
                                            $gpa = $row00["gpa"];
                                            $gla = $row00["gla"];



                                        }
                                    } else {
                                        $neng = '';
                                        $nben = '';

                                        $fname = '';
                                        $mname = '';
                                        $vill = '';
                                        $po = '';
                                        $ps = '';
                                        $dist = '';
                                        $dob = '';

                                        $regdno = '';
                                        $sscroll = '';
                                        $gpa = '';
                                        $gla = '';
                                    }




                                    //if($card == '1'){$qrc = '<img src="https://chart.googleapis.com/chart?chs=20x20&cht=qr&chl=http://www.students.eimbox.com/myinfo.php?id=5000&choe=UTF-8&chld=L|0" />';} else {$qrc = '';}
                            


                                    ?>
                                    <tr>
                                        <td style="text-align:center; padding : 3px 5px; border:1px solid gray;" class="">
                                            <?php
                                            echo $rollno;
                                            ?>
                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><small><?php echo $stid; ?></small></div>
                                            <div class="ooo"><?php echo $neng; ?></div>
                                            <div class="ooo"><?php echo $nben; ?></div>
                                            <?php if ($dob != "") { ?>
                                                <div class="ooo">DOB : <?php echo date('d / m / Y', strtotime($dob)); ?></div>
                                            <?php } ?>
                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><?php echo $fname; ?></div>
                                            <div class="ooo"><?php echo $mname; ?></div>
                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><?php echo $vill; ?></div>
                                            <div class="ooo"><?php echo $po; ?></div>
                                            <div class="ooo"><?php echo $ps; ?></div>
                                            <div class="ooo"><?php echo $dist; ?></div>
                                        </td>
                                        <td style="padding : 3px 10px; border:1px solid gray;">
                                            <div class="ooo"><?php echo $sscroll; ?></div>
                                            <div class="ooo"><?php echo $regdno; ?></div>
                                        </td>

                                        <td style=" border:1px solid gray;">
                                            <?php if ($gpa != "") { ?>
                                                <?php echo $gpa . ' / ' . $gla; ?>
                                            <?php } ?>
                                        </td>
                                        <td style=" border:1px solid gray;">
                                            <div id="btn<?php echo $stid; ?>">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-inverse-info"
                                                        onclick="issue(<?php echo $stid; ?>)">
                                                        <i class="mdi mdi-book-open-page-variant"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-inverse-warning"
                                                        onclick="issuet(<?php echo $stid; ?>)">
                                                        <i class="mdi mdi-calendar"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

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
    document.getElementById('defbtn').innerHTML = 'Print Testimonials';
    function defbtn() {
        goprint(0);
    }
    function reload() {
        window.location.href = uri;
    }
    function resultentry(roll) {
        if (roll == 0) {
            document.getElementById('boardroll').value = '';
        } else {
            document.getElementById('boardroll').value = roll;
        }

        document.getElementById('ren').style.display = 'block';
        document.getElementById('boardroll').focus();
    }

    function goprint(stid) {
        var year = document.getElementById('year').value;
        var sec = document.getElementById('sec').value;
        var exam = document.getElementById('exam').value;
        window.location.href = 'testimonial-print.php?sec=' + sec + '&exam=' + exam + '&year=' + year + '&stid=' + stid;
    }

    function go() {
        var year = document.getElementById('year').value;
        var cls = document.getElementById('cls').value;
        var sec = document.getElementById('sec').value;
        window.location.href = 'students-list.php?&cls=' + cls + '&sec=' + sec + '&year=' + year;
    }
</script>

<script>
    function issue(stid) {
        window.location.href = 'students-edit.php?stid=' + stid;
    }
    function issuet(stid) {
        window.location.href = 'student-profile.php?stid=' + stid;
    }
</script>

<script>
    function fetchs(e) {
        if (e.key == 'Enter') {
            var br = document.getElementById("boardroll").value;
            var infor = "br=" + br;

            $("#sscspan").html("");

            $.ajax({
                type: "POST",
                url: "backend/fetch-board-roll.php",
                data: infor,
                cache: false,
                beforeSend: function () {
                    $('#sscspan').html('<small>Processing...</small>');
                },
                success: function (html) {
                    $("#sscspan").html(html);
                    var st = document.getElementById("sscspan").innerHTML;

                    if (st == 'Something went wrong.') {
                        document.getElementById("sscspan").innerHTML = '<code>' + st + '</code><br>Data Missing or Multiple Entry Found.';
                    } else {
                        document.getElementById("stname").value = st;
                        document.getElementById("sscspan").innerHTML = '';
                        document.getElementById("gpagla").focus();
                    }
                }
            });
        }
    }

    function svs(e) {
        if (e.key == 'Enter') {
            savessc();
        }
    }

    function savessc() {
        var br = document.getElementById("boardroll").value;
        var gpgl = document.getElementById("gpagla").value;
        var infor = "br=" + br + "&gpgl=" + gpgl;

        $("#sscspan").html("");
        $.ajax({
            type: "POST",
            url: "backend/save-board-result.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#sscspan').html('<small>Processing...</small>');
            },
            success: function (html) {
                $("#sscspan").html(html);
                var st = parseInt(document.getElementById("boardroll").value) + 1;
                document.getElementById("boardroll").value = st;
                document.getElementById("gpagla").value = '';
                document.getElementById("boardroll").focus();

            }
        });
    }
</script>