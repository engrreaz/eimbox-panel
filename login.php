<?php
session_start();
if (strlen(isset($_SESSION["user"])) > 0) {
  header("Location:index.php");
}

include_once 'auth/gpConfig.php';
$authUrl = $gClient->createAuthUrl();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EIMBox - Admin Panel</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/imgs/logo.png" />

  <style>
    #bgn {
      background: url('assets/images/auth/Login_bg.jpg') no-repeat;
      background-size: cover;
      background-position: center bottom
    }

    #main-box {
      background: transparent;
    }

    .formm {
      background: rgba(0, 0, 0, 0.5);
    }

    input {
      padding-bottom: 3px;
      background: transparent !important;
      color: white;
    }

    .input-group-prepend,
    input {
      border: 1px solid rgba(255, 255, 255, .3) !important;
      background: transparent;
      color: white;
    }

    .btn-inverse-danger {
      border: 1px solid rgba(255, 0, 0, .4) !important;
    }

    .btn-inverse-primary {
      border: 1px solid rgba(30, 144, 255, .4) !important;
    }

    .btn-inverse-warning {
      border: 1px solid rgba(255, 165, 0, .4) !important;
    }

    .btn-inverse-info {
      border: 1px solid rgba(148, 0, 211, .4) !important;
    }

    #bottim {
      width: 100%;
      position: absolute;
      left: 0;
      bottom: 0;
      color: gray;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php include 'db.php'; ?>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div id="bgn" class="content-wrapper full-page-wrapper d-flexx align-items-center auth bg-gray-dark ">



          <div id="main-box">
            <div class="row col-12">




              <div class="card col-lg-4 md-4 mx-auto formm">
                <div class="card-body">
                  <div class="text-center">
                    <img class="mb-3" src="assets/imgs/logo.png" style="height:50px;">
                    <div style="font-size:30px;margin:0; line-height:26px; font-weight:700;">EIMBox
                    </div>
                    <div class="pb-2" style="font-size:14px;margin-top:5px">School Management System</div>
                  </div>

                  <form id="loginform" class="mt-3" method="POST" onsubmit="eiin(this);" autocomplete="on">

                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="mdi mdi-account text-secondary"></i></span>
                        </div>
                        <input type="text" id="username" name="username" class="form-control bg-transparent text-white" placeholder="Username"
                          aria-label="Username" aria-describedby="basic-addon1">

                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="mdi mdi-lock-open text-secondary"></i></span>
                        </div>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                          aria-label="Password" aria-describedby="basic-addon1">

                      </div>
                    </div>

                    <div class="text-center">
                      <button id="btn" onclick="eiin();"
                        class="btn btn-inverse-primary btn-block enter-btn">Login</button>
                      <div id="status"></div>
                    </div>

                    <!-- <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p> -->
                  </form>

                  <div class="card-body" id="qrcodeblock" style="display:none;">

                    <?php
                    // $key = 'sfdgsht5yryfyfhfgjgjtrfhfhfhfhf1234567890';
                    $qrtoken = '';
                    $keys = array_merge(range(0, 9), range('a', 'z'));
                    for ($i = 0; $i < 30; $i++) {
                      $qrtoken .= $keys[array_rand($keys)];
                    }
                    //echo $qrtoken ;
                    // include ('../db.php');
                    $cur = date('Y-m-d H:i:s');
                    $query35 = "INSERT INTO qrcodelogin (id, token, email, generatetime, logintime, status) VALUES (NULL, '$qrtoken', NULL, '$cur', NULL, 0)";//echo $query35;
                    $conn->query($query35);


                    $lnk = 'http://android.eimbox.com/qrlogin.php?qr=' . $qrtoken;
                    // https://quickchart.io/documentation/qr-codes/
                    ?>

                    <!--<img style="padding: 5px; background:var(--lighter);" src="https://chart.googleapis.com/chart?chs=170x170&cht=qr&chl=<?php echo $lnk; ?>&choe=UTF-8&chld=L|0" />-->

                    <div class="text-center">
                      <img style=" margin-auto;" src="https://quickchart.io/qr?text=<?php echo $lnk; ?>&size=170" />
                    </div>


                    <div id="japa"></div>


                    <div class="text-center mt-2 w-100">
                      <small>Scan the QR Code <br>with EIMBox Approved Android App </small>
                    </div>




                  </div>


                  <div class="m-0 p-0">
                    <button type="button"
                      class="btn btn-inverse-secondary bg-secondary text-dark font-weight-bold  btn-rounded btn-icon"
                      disabled>
                      OR
                    </button>
                    <span class="p-2"></span>
                    <button type="button" class="btn btn-inverse-info  btn-rounded btn-icon float-right pt-1"
                      onclick="logins(0)">
                      <i class="mdi mdi-textbox pl-1 mdi-24px"></i>
                    </button>
                    <span class="p-2 float-right"></span>
                    <button type="button" class="btn btn-inverse-primary  btn-rounded btn-icon float-right pt-1"
                      onclick="logins(1)">
                      <i class="mdi mdi-facebook pl-1 mdi-24px"></i>
                    </button>
                    <span class="p-2 float-right"></span>


                    <a href="<?php echo filter_var($authUrl, FILTER_SANITIZE_URL); ?>">
                      <button type="button" class="btn btn-inverse-danger btn-rounded btn-icon float-right pt-1"
                        onclick="loginsx(2)">
                        <i class="mdi mdi-google-plus pl-2 mdi-24px"></i>
                      </button>
                    </a>

                    <span class="p-2 float-right"></span>
                    <button type="button" class="btn btn-inverse-warning btn-rounded btn-icon float-right pt-1"
                      onclick="logins(3)">
                      <i class="mdi mdi-qrcode pl-1 mdi-24px"></i>
                    </button>
                  </div>
                </div>




              </div>





            </div>
          </div>





        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->





  </div>


  <div id="bottim" class="d-block">
    <small>http://www.eimbox.com</small>
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->

    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->


</body>




<script>
  function qrcodecheck() {
    var qr = '<?php echo $qrtoken; ?>';
    var infor = "qr=" + qr;
    $("#japa").html("");

    $.ajax({
      type: "POST",
      url: "checkqr.php",
      data: infor,
      cache: false,
      beforeSend: function () {
        $('#japa').html('');
      },
      success: function (html) {
        $("#japa").html(html);
        var japa = document.getElementById("japa").innerHTML;
        if (japa.length > 10) {
          clearInterval(myInterval);
          login(japa, qr);
        }

      }
    });
  }
  const myInterval = setInterval(qrcodecheck, 500);
</script>


<script>
  function playstore() {
    window.location.href = 'https://play.google.com/store/apps/details?id=com.xeneen.eimbox&hl=en&gl=US&pli=1';
  }
</script>

<script>

  function login(email, qr) {
    // alert(qr+email);
    window.location.href = 'cchlogin.php?token=' + qr + qr + qr + "&em=" + email;
  }

  function proceed() {
    // alert(333);
    window.location.href = 'index.php?email=<?php ; ?>';
  }

</script>

<script>

  function logins(param) {
    if (param == 0) {
      document.getElementById("loginform").style.display = 'block';
      document.getElementById("qrcodeblock").style.display = 'none';
    }
    else if (param == 1) {
      alert('Facebook login is unavailable now.');
    }
    else if (param == 2) {
      document.getElementById("loginform").style.display = 'block';
      document.getElementById("qrcodeblock").style.display = 'none';
    }
    else if (param == 3) {
      document.getElementById("loginform").style.display = 'none';
      document.getElementById("qrcodeblock").style.display = 'flex';
    }
  }
</script>




<script>
  function eiin() {
    var eiin = document.getElementById("username").value;
    var key = document.getElementById("password").value;
    var infor = "user=" + eiin + "&otp=" + key; //alert(infor);
    $("#status").html("");

    $.ajax({
      type: "POST",
      url: "checkeiin.php",
      data: infor,
      cache: false,
      beforeSend: function () {
        $('#status').html('<span class=""><center>Processing....</center></span>');
      },
      success: function (html) {
        $("#status").html(html);
      }
    });
  }
</script>

</html>