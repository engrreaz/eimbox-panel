<?php
include 'header.php';
// include 'notice.php'; 

$sl = 1;
$filelist = array();
$sql0x = "SELECT * FROM filelist  ;";
$result0xx = $conn->query($sql0x);
if ($result0xx->num_rows > 0) {
  while ($row0x = $result0xx->fetch_assoc()) {
    $filelist[] = $row0x;
  }
}


?>

<style>
  th,
  td {
    text-align: center;
  }

  .hand {
    cursor: pointer;
  }
</style>

<div class="row" style="">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><i class="mdi mdi-settings mdi-24px text-warning p-2"></i> Settings</h4>
        <div class="table-responsive full-width">

          <table id="file-list" class="table table-responsive table-striped w-100 ">
            <thead>
              <tr>
                <th>#</th>
                <th class="text-left">File Name</th>
                <th></th>
                <th>Attnd</th>
                <th>Pay</th>
                <th>Result</th>
                <th></th>
              </tr>
            </thead>
            <tbody>



              <?php

              $dir = "/XAMPP\htdocs/eimbox-dashboard/eimbox-panel";

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
                        $ind = array_search($gfg_subfolder, array_column($filelist, 'filename'));
                        if ($ind != '') {
                          $attnd = $filelist[$ind]['attendance'] * 1;
                          $pay = $filelist[$ind]['payment'] * 1;
                          $result = $filelist[$ind]['result'] * 1;
                        } else {
                          $attnd = $pay = $result = 0;
                        }
                        ?>


                        <tr>
                          <td><?php echo $sl; ?></td>
                          <td class="text-left" id="file<?php echo $sl; ?>"><?php echo $gfg_subfolder; ?></td>
                          <td></td>
                          <td class="hand" onclick="onoff('attnd', <?php echo $sl; ?>);">
                            <input type="text" class="form-control w-25" id="attnd<?php echo $sl; ?>"
                              value="<?php echo $attnd; ?>" />
                          </td>
                          <td class="hand" onclick="onoff('pay', <?php echo $sl; ?>);">
                            <input type="text" class="form-control w-25" id="pay<?php echo $sl; ?>" value="<?php echo $pay; ?>" />
                          </td>
                          <td class="hand" onclick="onoff('result', <?php echo $sl; ?>);">
                            <input type="text" class="form-control w-25" id="result<?php echo $sl; ?>"
                              value="<?php echo $result; ?>" />
                          </td>
                          <td>
                            <button type="button" class="btn btn-outline-success"
                              onclick="save(<?php echo $sl; ?>, <?php echo $ind; ?>);">
                              <i class="mdi mdi-arrow-bottom-right"></i>
                            </button>
                          </td>
                        </tr>
                        <?php
                        //******************************************************************************************     
                        $dirpath = $dir . $gfg_subfolder . "/";
                        // GETTING INSIDE EACH SUBFOLDERS
                        if (is_dir($dirpath)) {
                          echo '%%%%%%%%%%%%%%%%%<br>';
                          $file = opendir($dirpath); {
                            if ($file) {
                              echo '~~~~~~~~~~~~~~~~~~~<br>';
                              //READING NAMES OF EACH FILE INSIDE SUBFOLDERS
                              while (($gfg_filename = readdir($file)) !== FALSE) {
                                if ($gfg_filename != '.' && $gfg_filename != '..') {
                                  echo '++ ' . $gfg_filename . '<br>';
                                }
                              }
                            }
                          }
                        }

                        //***********************************************************************************
                        $sl++;
                      }
                    }
                  }
                  echo '</tr>';
                }

              } else {
                echo '**** | ';
              }

              ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>

<div id="filecount"><?php echo $sl; ?></div>

<?php



// echo '<hr><hr><hr><hr><hr>------------------------------';
// $path = $dir;
// $sl = 1;
// $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
// foreach ($iterator as $file)
// {
//     if ($file->isFile())
//     {
//         echo $sl . '. ';
//         echo filemtime($file);
//         echo ' - ';
//         echo filesize($file) / 1024;
//         echo 'KB - ';

//         echo $file, PHP_EOL;
//         echo 'Checked';
//         echo '<br>';
//         $sl++;

//     }
// }
?>

<?php include 'footer.php'; ?>



<script>
  // A $( document ).ready() block.
  $(document).ready(function () {
    // alert("wait...");
  });
</script>

<script>
  function onoff(block, ind) {
    // alert(block + ind);
    var val = document.getElementById(block + ind).innerHTML;
    if (val == 0) { val = 1; } else { val = 0; }
    document.getElementById(block + ind).innerHTML = val;
  }

  $(document).ready(function () {
    $('#file-list').DataTable();
  });
</script>