<?php include 'header.php'; ?>
<!-- <?php include 'notice.php'; ?> -->

<script type="text/javascript"> document.cookie = "fn=";</script>

<?php
if ($track <= 100 && $usr == 'engrreaz@gmail.com') {
  include 'track-line.php';
}
?>


<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <?php
            $stphoto = $BASE__PATH . "/teacher" . "/" . $userid . ".jpg";
            $stphoto2 = $BASE__PATH . "/students/noimg.jpg";
            ?>
            <img class="std-img" src="<?php echo $stphoto; ?>"
              onerror="this.onerror=null;this.src='<?php echo $stphoto2; ?>';" />
          </div>


          <div class="col-md-10">
            <h3><?php echo $fullname; ?></h3>
            <div class="text-warning"><small><?php echo $userlevel; ?> ID # <?php echo $userid; ?></small></div>
          </div>
        </div>
        <!-- SEARCH BLOCK -->
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0" id="st_attnd_main">0</h3>
              <p class="text-danger ml-2 mb-0 font-weight-medium" id="total_students_main">0</p>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0" id="st_attnd_main">0</h3>
              <p class="text-danger ml-2 mb-0 font-weight-medium" id="total_students_main">0</p>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Today's Attendance</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card ">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="d-block align-items-center align-self-start">
              <progress class="" value="30"></progress>
              <div class="text-small m-0 p-0"><small>My Subjects</small></div>
            </div>
          </div>

        </div>
        <h6 class="text-muted font-weight-normal">Marks Entry Progress</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0" id="users_main">0</h3>
              <p class="text-success ml-2 mb-0 font-weight-medium" id="online_main">0</p>
            </div>
          </div>

        </div>
        <h6 class="text-muted font-weight-normal">My Collections</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0" id="expense_main">100 <small>%</small></h3>
              <p class="text-success ml-2 mb-0 font-weight-medium"></p>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">My Attendance</h6>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-row justify-content-between">
          <h2 class="card-title mb-1" id="time"><?php echo date('H:i:s'); ?></h2>
          <p class="text-muted mb-1"><?php echo date('l, d F, Y'); ?></p>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="preview-list">
              <div class="preview-item border-bottom">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-primary">
                    <i class="mdi mdi-pandora mdi-24px"></i>
                  </div>
                </div>
                <div class="preview-item-content d-sm-flex flex-grow">
                  <div class="flex-grow">
                    <div style="float:right;">
                      <p class="text-muted" id="tete">till 00:30:00</p>
                    </div>
                    <h6 class="preview-subject" id="main-29-main"></h6>

                    <div hidden>
                      <div id="tsts"></div>
                      <!-- <div id="tete"></div> -->
                      <div id="durdur"></div>
                      <div id="onoff"></div>

                    </div>

                    <div class="progress progress-md portfolio-progress">
                      <div class="progress-bar bg-success p-1 text-secondary" role="progressbar" style="width: 0%"
                        aria-valuenow="25" id="pbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div id="scheddd" style="">

                    </div>

                  </div>


                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex flex-row justify-content-between">
          <h4 class="card-title mb-1 mt-4">Notices/Events</h4>
          <p class="text-muted mb-1 mt-1">-</p>
        </div>

        <div class="row" style="display:none;">
          <div class="col-12">
            <div class="preview-list">

              <!-- ITEM -->

              <?php for ($i = 0; $i < 5; $i++) { ?>
                <div class="preview-item border-bottom">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-danger">
                      <i class="mdi mdi-cloud-download"></i>
                    </div>
                  </div>

                  <div class="preview-item-content d-sm-flex flex-grow">
                    <div class="flex-grow">
                      <h6 class="preview-subject">Vacation</h6>
                      <p class="text-muted mb-0">Eid-Ul-Adha Vacation</p>
                    </div>
                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                      <p class="text-muted">1 hour ago</p>
                      <p class="text-muted mb-0">23 tasks, 5 issues </p>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>




      </div>
    </div>





  </div>
  <div class="col-md-12 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">To do list</h4>
        <div id="tas"></div>
        <div class="add-items d-flex">
          <input type="text" id="taskbox" class="form-control todo-list-input" placeholder="enter task..">
          <button class="add btn btn-primary todo-list-add-btn" onclick="addtask(1);">Add</button>
        </div>
        <div class="list-wrapper">
          <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">

            <?php
            $sql000 = "SELECT * FROM todolist where sccode='$sccode' and user='$usr' and (status=0 || date='$td') order by id desc";

            $resultix2j = $conn->query($sql000);
            // $conn -> close();
            if ($resultix2j->num_rows > 0) {
              while ($row000 = $resultix2j->fetch_assoc()) {
                $id = $row000["id"];
                $text = $row000["descrip1"];
                $stt = $row000["status"];
                
                if($stt == 1) {
                  $comp = 'completed';
                  $chk = 'checked';
                } else {
                  $comp = '';
                  $chk = '';
                }
                ?>

                <li class="<?php echo $comp;?>">
                  <div class="form-check form-check-primary">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" <?php echo $chk;?> > <?php echo $text;?> </label>
                  </div>
                  <i class="remove mdi mdi-close-box"></i>
                </li>

              <?php
              }
            } ?>



          </ul>
        </div>
      </div>
    </div>
  </div>
</div>










<div style="display:none;" id="statistics"></div>

<?php include 'footer.php'; ?>

<script>

  document.getElementById('defmenu').innerHTML = '';

  function statistics() {
    var infor = "";
    $("#statistics").html("");
    $.ajax({
      type: "POST",
      url: "backend/statistics.php",
      data: infor,
      cache: false,
      beforeSend: function () {
        $('#statistics').html('');
      },
      success: function (html) {
        $("#statistics").html(html);
        document.getElementById("total_students_main").innerHTML = document.getElementById("total_students").innerHTML;
        document.getElementById("st_attnd_main").innerHTML = document.getElementById("st_attnd").innerHTML;
        document.getElementById("t_attnd_main").innerHTML = document.getElementById("t_attnd").innerHTML;
        document.getElementById("users_main").innerHTML = document.getElementById("userstat").innerHTML;
        document.getElementById("online_main").innerHTML = document.getElementById("online").innerHTML + ' Active Today';
        document.getElementById("expense_main").innerHTML = document.getElementById("expense").innerHTML;

        document.getElementById("tsts").innerHTML = document.getElementById("main-30").innerHTML;
        document.getElementById("tete").innerHTML = document.getElementById("main-31").innerHTML;
        document.getElementById("durdur").innerHTML = document.getElementById("main-32").innerHTML;
        document.getElementById("durdur").innerHTML = document.getElementById("main-32").innerHTML;
        document.getElementById("scheddd").innerHTML = document.getElementById("sche").innerHTML;


        document.getElementById("main-29-main").innerHTML = 'Current Period : <b>' + document.getElementById("main-29").innerHTML + '</b>';
      }
    });
  }

  function addtask(tail) {
    var tas = document.getElementById('taskbox').value;

    var infor = "task=" + tas + '&tail=' + tail;
    $("#tas").html("");
    $.ajax({
      type: "POST",
      url: "backend/addtask.php",
      data: infor,
      cache: false,
      beforeSend: function () {
        $('#tas').html('Adding...');
      },
      success: function (html) {
        $("#tas").html(html);
      }
    });
  }
</script>

<script>
  // A $( document ).ready() block.
  $(document).ready(function () {
    statistics();
  });
</script>



<script>
  function secc() {
    function refr() {
      var t = new Date();
      var h = t.getHours();
      var m = t.getMinutes();
      var s = t.getSeconds();
      if (h <= 9) { h = '0' + h; } if (m <= 9) { m = '0' + m; } if (s <= 9) { s = '0' + s; }
      var k = h + ":" + m + ":" + s;
      document.getElementById("time").innerHTML = k;

      var te = document.getElementById("tete").innerHTML;
      var hx = te.substring(0, 2);
      var mx = te.substring(3, 5);
      var sx = te.substring(6, 8);
      // alert(hx +'/' + mx + '/' + sx);


      var a = new Date(2023, 1, 1, h, m, s);
      var b = new Date(2023, 1, 1, hx, mx, sx);

      var dk = b.getTime() - a.getTime();
      var ela = dk / 1000;  // Second Remaining
      var elas = ela % 60;

      var elam = (ela - elas) / 60;
      if (elas < 10) { elas = '0' + elas; } else if (elas == 0) { elas = '00'; }
      if (elam < 10) { elam = '0' + elam; } else if (elam == 0) { elam = '00'; }
      document.getElementById("onoff").innerHTML = elam + ":" + elas;
      var durs = parseInt(document.getElementById("durdur").innerHTML);
      d = (dk / 1000) * (100 / durs);
      if (d <= 0 && te > 0) { window.location.href = 'index.php'; }

      var f = parseInt(d);
      document.getElementById('pbar').style.width = d + "%";
      document.getElementById('pbar').innerHTML = f + "%";


    }
    setInterval(refr, 1000);
  }
  $(document).ready(secc);

</script>