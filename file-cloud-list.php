<div class="d-flex">
    <div class="p-0 m-0 mr-3">
        <i class="mdi mdi-cloud text-success  mdi-36px"></i>
    </div>
    <div class="d-block">
        <h5 class="text-warning">
            Your Backed up Data in <b>CLOUD</b>
        </h5>
        <h6 class="text-primary text-small m-0 p-0">
            File Count : <span class="font-weight-bold text-secondary pr-4" style="" id="file-count">17</span>
            File Size : <span class="font-weight-bold text-secondary" id="file-size">0.00035 MB</span>
        </h6>
    </div>
</div>



<div class="table-responsive ">
    <table id="file-list" class="table w-100 full-width ">

        <tbody>



            <?php
            $sl = 1;
            $tsize = 0;
            $dir = "/XAMPP\htdocs/eimbox-dashboard/eimbox-panel";
            $dir = "backup/" . $sccode;

            // Sort in ascending order - this is default
            $a = scandir($dir);

            // Sort in descending order
            $b = scandir($dir, 1);

            // print_r($a);
            // print_r($b);
            

            // echo '<hr>';
            
            // $search_results = glob('../edubds/*');
// print_r($search_results);
            
            // echo $search_results[39];
            

            // echo '<hr><hr>';
            

            $gfg_folderpath = $dir;
            // CHECKING WHETHER PATH IS A DIRECTORY OR NOT
            if (is_dir($gfg_folderpath)) {

                // GETTING INTO DIRECTORY
                $files = opendir($gfg_folderpath); {

                    // CHECKING FOR SMOOTH OPENING OF DIRECTORY
                    if ($files) {
                        //READING NAMES OF EACH ELEMENT INSIDE THE DIRECTORY 
                        while (($gfg_subfolder = readdir($files)) !== FALSE) {
                            // CHECKING FOR FILENAME ERRORS
                            if ($gfg_subfolder != '.' && $gfg_subfolder != '..') {
                                ?>


                                <tr>
                                    <td class="p-0 pr-2 text-right"><?php echo $sl; ?></td>
                                    <td class="text-left text-wrap p-2 text-secondary" id="file<?php echo $sl; ?>">
                                        <?php echo $gfg_subfolder; ?>

                                        <div class="pt-2 text-small text-muted">
                                            <?php
                                            $fsize = filesize('backup/' . $sccode . '/' . $gfg_subfolder);
                                            echo $fsize . ' Bytes, ';
                                            echo date('d F Y H:i:s', filemtime('backup/' . $sccode . '/' . $gfg_subfolder));
                                            $tsize += $fsize;
                                            ?>

                                        </div>

                                    </td>
                                    <td class="p-0 text-right">
                                        <div class="button btn-group">
                                            <div id="fl<?php echo $sl; ?>" hidden><?php echo 'backup/' . $sccode . '/' . $gfg_subfolder; ?>
                                            </div>
                                            <a download type="button" class="btn btn-inverse-primary"
                                                href="<?php echo 'backup/' . $sccode . '/' . $gfg_subfolder; ?>"><i
                                                    class="mdi mdi-cloud-download mdi-12px p-0 text-center"></i></a>
                                            <button type="button" class="btn btn-inverse-success"
                                                onclick="restore('<?php echo $gfg_subfolder; ?>');"><i
                                                    class="mdi mdi mdi-sync mdi-12px p-0 text-center"></i></button>

                                            <button class="btn btn-inverse-warning" onclick="sendmail(<?php echo $sl; ?>);"><i
                                                    class="mdi mdi-email mdi-12px p-0 text-center"></i></button>
                                        </div>
                                        <h6 id="callback<?php echo $sl; ?>" class="text-small text-primary mt-2"></h6>

                                    </td>

                                </tr>
                                <?php
                                //******************************************************************************************     
            
                                //***********************************************************************************
                                $sl++;
                            }
                        }
                    }
                }

            } else {
                echo '**** | ';
            }

            $dsize = 0;
            $dg = 3;
            if ($tsize >= 1024 * 1024 * 1024) {
                $dsize = number_format($tsize / (1024 * 1024 * 1024), $dg) . ' GB';
            } else if ($tsize >= 1024 * 1024) {
                $dsize = number_format($tsize / (1024 * 1024), $dg) . ' MB';
            } else if ($tsize >= 1024) {
                $dsize = number_format($tsize / (1024), $dg) . ' KB';
            } else {
                $dsize = $tsize . ' B';
            }

            $taka = $tsize / (1024 * 1024) * 0.01;
            ?>
        </tbody>
    </table>
</div>




<div id="filecount" hidden><?php echo $sl - 1; ?></div>



<script>
    document.getElementById("file-count").innerHTML = '<?php echo $sl - 1; ?>';
    //    document.getElementById("file-size").innerHTML = '<?php echo $dsize . ' TAKA ' . $taka; ?>';
    document.getElementById("file-size").innerHTML = '<?php echo $dsize; ?>';

    function restore(fn) {
        document.cookie = "fn=" + fn;
        window.location.href = 'db-restore.php';
    }
    function sendmail(sl) {
        var cnt = 1;
        var mailto = "&person_1=<?php echo $usr; ?>";
        var replyto = '';
        var cc = "&cc=<?php echo $bup_mail_2; ?>";
        var bcc = "&bcc=";
        var att = 1;
        var fl = document.getElementById("fl" + sl).innerHTML;
        var fllist = "&fl_1=" + fl;
   
        var sub = 'Backup Data';
        var body = "downliad this thidksfsfs";
        var bodyalt = "alt -- body";
        var infor = 'mailcnt=' + cnt + mailto + '&replyto=' + replyto + cc + bcc + "&att=" + att + fllist + '&sub=' + sub + '&body=' + body + '&bodyalt=' + bodyalt;
        // alert(infor);
        $("#callback" + sl).html("");

        $.ajax({
            type: "POST",
            url: "mailer.php",
            data: infor,
            cache: false,
            beforeSend: function () {
                $('#callback' + sl).html('...................');
            },
            success: function (html) {
                $("#callback"+sl).html(html);
                $("#callback" + sl).html("Mail sent successfully");
            }
        });
    }

    $(document).ready(function () {
        $('#file-list').DataTable();
    });
</script>