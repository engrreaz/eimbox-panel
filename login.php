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
</head>

<body>
  <?php include 'db.php'; ?>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flexx align-items-center auth bg-gray-dark ">


          <div class="">
            
            <div class="mb-3">
              <div style="float:right; display:none;" class="d-lg-block d-none pr-5 text-right">
              
              <!-- <small>Need an assistance?<br></small><i class="mdi mdi-phone"></i> 0152365847 -->
          </div>
              <!-- <h2 class="mb-3 text-center"> -->
              <table class="" style="text-align:left; margin:auto;">
                <tr>
                  <td>
                    <img class="pr-3" src="assets/imgs/logo.png" style="height:50px;">
                  </td>
                  <td>
                    <div style="font-size:30px;margin:0; line-height:26px; font-weight:700;">EIMBox
                    </div>
                    <div style="font-size:14px;margin-top:5px">School Management System</div>

                  </td>
                </tr>
              </table>


              <!-- </h2> -->
            </div>
          </div>

          <div class="row col-12">
            <div class="card col-lg-4  md-4 mx-auto">
              <div class="card-body px-5 py-5">

                <div class="d-flexx">
                  <button class="btn  col full-width m-2 p-2 btn-outline-light" disabled>
                    <i class="mdi mdi-facebook"></i> Facebook </button>
                  <a href="<?php echo filter_var($authUrl, FILTER_SANITIZE_URL); ?>">
                    <button class="btn btn-google col full-width m-2 p-2">
                      <i class="mdi mdi-google-plus"></i> Google plus </button></a>
                </div>

                <div class="row ml-1 mt-3">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <div class="template-demox mt-2">
                          <button class="btn btn-outline-light btn-icon-text full-width" disabled>
                            <i class="mdi mdi-apple btn-icon-prepend mdi-36px"></i>
                            <span class="d-inline-block text-left">
                              <small class="font-weight-light d-block">Available on the</small> App Store </span>
                          </button>

                        </div>
                      </div>
                      <div class="col-md-6 col-6">
                        <div class="template-demox mt-2">

                          <button class="btn btn-outline-light btn-icon-text full-width">
                            <i class="mdi mdi-android-debug-bridge btn-icon-prepend mdi-36px"></i>
                            <span class="d-inline-block text-left">
                              <small class="font-weight-light d-block">Get it on the</small> Google Play </span>
                          </button>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>




              </div>
            </div>
            <div class="card col-lg-4 md-4 mx-auto">
              <div class="card-body px-5 py-5">
                <form id="loginform" onsubmit="eiin(this);" autocomplete="on">
                  <div class="form-group">
                    <label>Username or email *</label>
                    <input type="text" id="username" name="username" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="password" id="password" name="password" class="form-control p_input">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" name="rememberme" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="#" class="forgot-pass  ">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" id="btn" onclick="eiin();"
                      class="btn btn-primary btn-block enter-btn">Login</button>
                    <div id="status"></div>
                  </div>

                  <!-- <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p> -->
                </form>
              </div>
            </div>
            <div class="card col-lg-4  md-4 mx-auto">
              <div class="card-body px-5 py-5">

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
                  <img style=" margin-auto;" 
                    src="https://quickchart.io/qr?text=<?php echo $lnk; ?>&size=170" />
                </div>


                <div id="japa"></div>
                <p class="text-center mt-2">
                  <small>Scan the QR Code <br>with EIMBox Approved Android App </small>
                </p>




              </div>
            </div>


            <div class="row text-center pt-4">
              <h6>Login</h6>
            </div>



          </div>




        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
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

  function login(email, qr) {
    // alert(qr+email);
    window.location.href = 'cchlogin.php?token=' + qr + qr + qr + "&em=" + email;
  }



  function proceed() {
    window.location.href = 'index.php?email=<?php echo $usr; ?>';
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