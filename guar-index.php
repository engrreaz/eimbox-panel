<?php include 'header.php'; ?>
<!-- <?php include 'notice.php'; ?> -->

<script type="text/javascript"> document.cookie = "fn=";</script>

<?php
if ($track <= 100 && $usr == 'engrreaz@gmail.com') {
  include 'track-line.php';
}
?>


<style>
  .guar-stu-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border 2px;
    maargin: auto;
  }

  .std-img {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    border 1px;
    ;
  }
</style>





<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <?php
            $stphoto = $BASE__PATH . "/guardian" . "/" . $userid . ".jpg";
            $stphoto2 = $BASE__PATH . "/students/noimg.jpg";
            ?>
            <img class="std-img" src="<?php echo $stphoto; ?>"
              onerror="this.onerror=null;this.src='<?php echo $stphoto2; ?>';" />

          </div>

          <div class="col-md-10">
            <h3><?php echo $fullname; ?></h3>
            <div class="text-warning"><small>ID # <?php echo $userid; ?></small></div>

          </div>
        </div>
        <!-- SEARCH BLOCK -->
      </div>
    </div>
  </div>
</div>

<div class="row">

  <?php
  $sql0 = "SELECT * from guar_student where sccode='$sccode' and guarid='$userid' order by id";
  //echo $sql0;
  $resultu = $conn->query($sql0);
  if ($resultu->num_rows > 0) {
    while ($row0 = $resultu->fetch_assoc()) {
      $guarstid = $row0["stid"];


      $sql0 = "SELECT * from students where sccode='$sccode' and stid='$guarstid'";
      $result0n = $conn->query($sql0);
      if ($result0n->num_rows > 0) {
        while ($row0 = $result0n->fetch_assoc()) {
          $mystname = $row0['stnameeng'];
        }
      }

      $sql0 = "SELECT * from sessioninfo where sccode='$sccode' and stid='$guarstid' and sessionyear='$sy' order by sessionyear desc limit 1";
      $result0nsess = $conn->query($sql0);
      if ($result0nsess->num_rows > 0) {
        while ($row0 = $result0nsess->fetch_assoc()) {
          $mystcls = $row0['classname'];
          $mystsec = $row0['sectionname'];
          $mystroll = $row0['rollno'];
        }
      }

      ?>
      <div class="col-xl-4 col-sm-6 grid-margin stretch-card" onclick="profile(<?php echo $guarstid; ?>);">
        <div class="card">
          <div class="card-body">
            <div class="row text-center">
              <div class="text-center " style="margin:auto;">

                <div class="count-indicator">
                  <?php
                  $stphoto = $BASE__PATH . "/students" . "/" . $guarstid . ".jpg";
                  $stphoto2 = $BASE__PATH . "/students/noimg.jpg";
                  ?>
                  <img class="guar-stu-image rounded-circle" src="<?php echo $stphoto; ?>"
                    onerror="this.onerror=null;this.src='<?php echo $stphoto2; ?>';" />


                  <span class="count"
                    style="font-size:70px; color:green; position:relative; right:25px; top:50px;">&bull;</span>
                </div>

                <h6 class="pt-3 text-warning font-weight-bold"><?php echo $mystname; ?></h6>
                <div class="text-small">
                  <span style="line:height:12px;">
                    Student ID # <?php echo $guarstid; ?><br>
                    Class : <?php echo $mystcls; ?> ; Section : <?php echo $mystsec; ?><br>
                    Shift : College ; Roll # <?php echo $mystroll; ?>
                  </span>

                </div>
              </div>

            </div>

            <div class="row mt-3">
              <div class="col-1"></div>
              <div class="col-2 text-center text-muted" onclick="attnd(<?php echo $guarstid; ?>);">
                <button type="button" class="btn btn-inverse-primary  btn-rounded btn-icon float-right pt-1"
                  onclick="logins(1)">
                  <i class="mdi mdi-fingerprint pl-1 mdi-18px"></i>
                </button>
              </div>
              <div class="col-2 text-center text-muted" onclick="result(<?php echo $guarstid; ?>);">
                <button type="button" class="btn btn-inverse-secondary  btn-rounded btn-icon float-right pt-1"
                  onclick="logins(1)">
                  <i class="mdi mdi-file-document pl-1 mdi-18px"></i>
                </button>
              </div>
              <div class="col-2 text-center text-muted" onclick="message(<?php echo $guarstid; ?>);">
                <button type="button" class="btn btn-inverse-success  btn-rounded btn-icon float-right pt-1"
                  onclick="logins(1)">
                  <i class="mdi mdi-bell pl-1 mdi-18px"></i>
                </button>
              </div>
              <div class="col-2 text-center text-muted" onclick="dues(<?php echo $guarstid; ?>);">
                <button type="button" class="btn btn-inverse-info  btn-rounded btn-icon float-right pt-1"
                  onclick="logins(1)">
                  <i class="mdi mdi-blur-linear pl-1 mdi-18px"></i>
                </button>
              </div>
              <div class="col-2 text-center text-muted" onclick="syllabus(<?php echo $guarstid; ?>);">
                <button type="button" class="btn btn-inverse-warning  btn-rounded btn-icon float-right pt-1"
                  onclick="logins(1)">
                  <i class="mdi mdi-book-open-page-variant pl-1 mdi-18px"></i>
                </button>
              </div>
              <div class="col-1"></div>
            </div>


            <div class="row" hidden>
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0" id="st_attnd_main">0</h3>
                  <p class="text-danger ml-2 mb-0 font-weight-medium" id="total_students_main">0</p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-danger ">
                  <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }
  } ?>


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

  function attnd(stid) {
    event.stopPropagation();
    window.location.href = 'std-attnd.php?stid=' + stid;
  }
  function profile(stid) {
    window.location.href = 'std-profile.php?stid=' + stid;
  }
  function result(stid) {
    event.stopPropagation(); window.location.href = 'std-result.php?stid=' + stid;
  }
  function message(stid) {
    event.stopPropagation(); window.location.href = 'std-messages.php?stid=' + stid;
  }
  function dues(stid) {
    event.stopPropagation(); window.location.href = 'std-payments.php?stid=' + stid;
  }
  function syllabus(stid) {
    event.stopPropagation(); window.location.href = 'std-syllabus.php?stid=' + stid;
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