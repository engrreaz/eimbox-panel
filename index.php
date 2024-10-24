<?php include 'header.php'; ?>
<!-- <?php include 'notice.php'; ?> -->

<script type="text/javascript"> document.cookie = "fn=";</script>

<?php
if ($track <= 100 && $usr == 'engrreaz@gmail.com') {
  include 'track-line.php';
}

if ($userlevel == 'Student') {
  echo '<script>window.location.href="std-index.php";</script>';
} else if ($userlevel == 'Guardian') {
  echo '<script>window.location.href="guar-index.php";</script>';
} else if ($userlevel == 'Teacher') {
  echo '<script>window.location.href="teacher-index.php";</script>';
} else {
  ?>

      <div class="row">
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

      <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Collections </h4>
              <canvas id="transaction-history" class="transaction-chart"></canvas>
              <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                <div class="text-md-center text-xl-left">
                  <h6 class="mb-1">৳ 0</h6>
                  <p class="text-muted mb-0">Collection (This Month)</p>
                </div>
                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                  <div class="icon icon-box-warning" style="float:right;">
                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                  </div>
                </div>
              </div>
              <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                <div class="text-md-center text-xl-left">
                  <h6 class="mb-1">৳ 0</h6>
                  <p class="text-muted mb-0">Total Dues</p>
                </div>
                <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                  <div class="icon icon-box-warning" style="float:right;">
                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


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

              
              <div class="col-12">
                  <button class="btn btn-danger" onclick="punch();">Resolve Receipt</button>
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




      </div>

      <div class="row" style="display:none;">
        <div class="col-sm-4 grid-margin">
          <div class="card">
            <div class="card-body">
              <h5>Revenue</h5>
              <div class="row">
                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                  <div class="d-flex d-sm-block d-md-flex align-items-center">
                    <h2 class="mb-0">$32123</h2>
                    <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
                  </div>
                  <h6 class="text-muted font-weight-normal">11.38% Since last month</h6>
                </div>
                <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                  <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 grid-margin">
          <div class="card">
            <div class="card-body">
              <h5>Sales</h5>
              <div class="row">
                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                  <div class="d-flex d-sm-block d-md-flex align-items-center">
                    <h2 class="mb-0">$45850</h2>
                    <p class="text-success ml-2 mb-0 font-weight-medium">+8.3%</p>
                  </div>
                  <h6 class="text-muted font-weight-normal"> 9.61% Since last month</h6>
                </div>
                <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                  <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 grid-margin">
          <div class="card">
            <div class="card-body">
              <h5>Purchase</h5>
              <div class="row">
                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                  <div class="d-flex d-sm-block d-md-flex align-items-center">
                    <h2 class="mb-0">$2039</h2>
                    <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p>
                  </div>
                  <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
                </div>
                <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                  <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row ">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Request for Actions</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>
                        <div class="form-check form-check-muted m-0">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                          </label>
                        </div>
                      </th>
                      <th> - </th>
                      <th> - </th>
                      <th> - </th>
                      <th> - </th>
                      <th> - </th>
                      <th> - </th>
                      <th> - </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="display:none;">
                      <td>
                        <div class="form-check form-check-muted m-0">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                          </label>
                        </div>
                      </td>
                      <td>
                        <img src="assets/images/faces/face1.jpg" alt="image" />
                        <span class="pl-2">-</span>
                      </td>
                      <td> - </td>
                      <td> -- </td>
                      <td> - </td>
                      <td> - </td>
                      <td> - </td>
                      <td>
                        <div class="badge badge-outline-success">Approved</div>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php } ?>

<div class="row" style="display:none;">
  <div class="col-md-6 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-row justify-content-between">
          <h4 class="card-title">Messages</h4>
          <p class="text-muted mb-1 small">View all</p>
        </div>
        <div class="preview-list">
          <div class="preview-item border-bottom">
            <div class="preview-thumbnail">
              <img src="assets/images/faces/face6.jpg" alt="image" class="rounded-circle" />
            </div>
            <div class="preview-item-content d-flex flex-grow">
              <div class="flex-grow">
                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                  <h6 class="preview-subject">Leonard</h6>
                  <p class="text-muted text-small">5 minutes ago</p>
                </div>
                <p class="text-muted">Well, it seems to be working now.</p>
              </div>
            </div>
          </div>
          <div class="preview-item border-bottom">
            <div class="preview-thumbnail">
              <img src="assets/images/faces/face8.jpg" alt="image" class="rounded-circle" />
            </div>
            <div class="preview-item-content d-flex flex-grow">
              <div class="flex-grow">
                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                  <h6 class="preview-subject">Luella Mills</h6>
                  <p class="text-muted text-small">10 Minutes Ago</p>
                </div>
                <p class="text-muted">Well, it seems to be working now.</p>
              </div>
            </div>
          </div>
          <div class="preview-item border-bottom">
            <div class="preview-thumbnail">
              <img src="assets/images/faces/face9.jpg" alt="image" class="rounded-circle" />
            </div>
            <div class="preview-item-content d-flex flex-grow">
              <div class="flex-grow">
                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                  <h6 class="preview-subject">Ethel Kelly</h6>
                  <p class="text-muted text-small">2 Hours Ago</p>
                </div>
                <p class="text-muted">Please review the tickets</p>
              </div>
            </div>
          </div>
          <div class="preview-item border-bottom">
            <div class="preview-thumbnail">
              <img src="assets/images/faces/face11.jpg" alt="image" class="rounded-circle" />
            </div>
            <div class="preview-item-content d-flex flex-grow">
              <div class="flex-grow">
                <div class="d-flex d-md-block d-xl-flex justify-content-between">
                  <h6 class="preview-subject">Herman May</h6>
                  <p class="text-muted text-small">4 Hours Ago</p>
                </div>
                <p class="text-muted">Thanks a lot. It was easy to fix it .</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Portfolio Slide</h4>
        <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel" id="owl-carousel-basic">
          <div class="item">
            <img src="assets/images/dashboard/Rectangle.jpg" alt="">
          </div>
          <div class="item">
            <img src="assets/images/dashboard/Img_5.jpg" alt="">
          </div>
          <div class="item">
            <img src="assets/images/dashboard/img_6.jpg" alt="">
          </div>
        </div>
        <div class="d-flex py-4">
          <div class="preview-list w-100">
            <div class="preview-item p-0">
              <div class="preview-thumbnail">
                <img src="assets/images/faces/face12.jpg" class="rounded-circle" alt="">
              </div>
              <div class="preview-item-content d-flex flex-grow">
                <div class="flex-grow">
                  <div class="d-flex d-md-block d-xl-flex justify-content-between">
                    <h6 class="preview-subject">CeeCee Bass</h6>
                    <p class="text-muted text-small">4 Hours Ago</p>
                  </div>
                  <p class="text-muted">Well, it seems to be working now.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <p class="text-muted">Well, it seems to be working now. </p>
        <div class="progress progress-md portfolio-progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="25"
            aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">To do list</h4>
        <div class="add-items d-flex">
          <input type="text" class="form-control todo-list-input" placeholder="enter task..">
          <button class="add btn btn-primary todo-list-add-btn">Add</button>
        </div>
        <div class="list-wrapper">
          <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
            <li>
              <div class="form-check form-check-primary">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Create invoice </label>
              </div>
              <i class="remove mdi mdi-close-box"></i>
            </li>
            <li>
              <div class="form-check form-check-primary">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Meeting with Alita </label>
              </div>
              <i class="remove mdi mdi-close-box"></i>
            </li>
            <li class="completed">
              <div class="form-check form-check-primary">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
              </div>
              <i class="remove mdi mdi-close-box"></i>
            </li>
            <li>
              <div class="form-check form-check-primary">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Plan weekend outing </label>
              </div>
              <i class="remove mdi mdi-close-box"></i>
            </li>
            <li>
              <div class="form-check form-check-primary">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Pick up kids from school </label>
              </div>
              <i class="remove mdi mdi-close-box"></i>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row" style="display:none;">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Visitors by Countries</h4>
        <div class="row">
          <div class="col-md-5">
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td>
                      <i class="flag-icon flag-icon-us"></i>
                    </td>
                    <td>USA</td>
                    <td class="text-right"> 1500 </td>
                    <td class="text-right font-weight-medium"> 56.35% </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="flag-icon flag-icon-de"></i>
                    </td>
                    <td>Germany</td>
                    <td class="text-right"> 800 </td>
                    <td class="text-right font-weight-medium"> 33.25% </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="flag-icon flag-icon-au"></i>
                    </td>
                    <td>Australia</td>
                    <td class="text-right"> 760 </td>
                    <td class="text-right font-weight-medium"> 15.45% </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="flag-icon flag-icon-gb"></i>
                    </td>
                    <td>United Kingdom</td>
                    <td class="text-right"> 450 </td>
                    <td class="text-right font-weight-medium"> 25.00% </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="flag-icon flag-icon-ro"></i>
                    </td>
                    <td>Romania</td>
                    <td class="text-right"> 620 </td>
                    <td class="text-right font-weight-medium"> 10.25% </td>
                  </tr>
                  <tr>
                    <td>
                      <i class="flag-icon flag-icon-br"></i>
                    </td>
                    <td>Brasil</td>
                    <td class="text-right"> 230 </td>
                    <td class="text-right font-weight-medium"> 75.00% </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-7">
            <div id="audience-map" class="vector-map"></div>
          </div>
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


<script>
  function punch() {
    var infor = "";
    $("#statistics").html("");
    $.ajax({
      type: "POST",
      url: "backend/punch.php",
      data: infor,
      cache: false,
      beforeSend: function () {
        $('#statistics').html('');
      },
      success: function (html) {
        $("#statistics").html(html);
      }
    });
  }
</script>