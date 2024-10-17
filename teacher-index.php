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
                       <img class="std-img" src="../teacher/<?php echo $userid; ?>.jpg"/>
                    </div>


                    <div class="col-md-10">
                   <h3><?php echo $fullname;?></h3>
                   <div class="text-warning"><small><?php echo $userlevel;?> ID # <?php echo $userid;?></small></div>
                   </div>
                </div>
                <!-- SEARCH BLOCK -->
            </div>
        </div>
    </div>
</div>

<div class="row" >
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
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
        <h6 class="text-muted font-weight-normal">Today's Students</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0" id="t_attnd_main">0</h3>
              <p class="text-success ml-2 mb-0 font-weight-medium">100%</p>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-success">
              <span class="mdi mdi-arrow-top-right icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Teacher's Attendance</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0" id="users_main">0</h3>
              <p class="text-success ml-2 mb-0 font-weight-medium" id="online_main">0</p>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-danger">
              <span class="mdi mdi-arrow-bottom-left icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Total Users</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0" id="expense_main">0</h3>
              <p class="text-success ml-2 mb-0 font-weight-medium"></p>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-success ">
              <span class="mdi mdi-arrow-top-right icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Expense (Month)</h6>
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