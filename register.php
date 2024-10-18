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
      background: url('assets/images/auth/regd_bg.jpg') no-repeat;
      background-size: cover;
      background-position: center top;
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
  <div class="container-scroller" style="margin:auto auto; top:50%;">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div id="bgn" class="content-wrapper full-page-wrapper d-flexx align-items-center auth bg-gray-dark ">



          <div id="main-box">
            <div class="row col-12">
              <div class="card col-lg-7 md-7 mx-auto formm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2 text-center">
                      <img class="mb-3" src="assets/imgs/logo.png" style="height:50px;">
                    </div>
                    <div class="col-md-5">
                      <div class="">
                        <div style="font-size:30px;margin:0; line-height:26px; font-weight:700;">EIMBox </div>
                        <div class="pb-1" style="font-size:14px;margin-top:5px">School Management System</div>
                      </div>
                    </div>
                    <div class="col-md-5 text-right">
                      <div style="font-size:30px;margin:0; line-height:26px; font-weight:700;">Sign Up </div>
                      <div class="pb-1" style="font-size:14px;margin-top:5px">Register a new account</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-center text-warning text-small font-weight-bold0">
                      Let's identify you. Please fill out the form below to detect you.
                    </div>
                  </div>


                  <form id="loginform" class="mt-3" method="POST" onsubmit="eiin(this);" autocomplete="on">
                    <div class="row">
                      <div class="col-md-6">


                        <div class="form-group">
                          <label class="text-white" for="usrtype">I am a ....</label>
                          <div class="input-group">

                            <select class="form-control border-white" id="usrtype">
                              <option value="student">Student</option>
                              <option value="student">Guardian</option>
                              <option value="student">Teacher</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="text-danger" for="userid">ID*</label>
                          <div class="input-group">

                            <input type="text" id="userid" name="userid" class="form-control bg-transparent text-white"
                              placeholder="Mobile Number" aria-label="ID Number" aria-describedby="basic-addon1">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="text-white" for="dob">Date of Birth</label>
                          <div class="input-group">

                            <input type="date" id="dob" name="dob" class="form-control bg-transparent text-white"
                              placeholder="Mobile Number" aria-label="dob" aria-describedby="basic-addon1">
                          </div>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="text-danger" for="mobile">Mobile Number*</label>
                          <div class="input-group">
                            <input type="text" id="mobile" name="mobile" class="form-control bg-transparent text-white"
                              placeholder="Mobile Number" aria-label="Username" aria-describedby="basic-addon1">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="text-white" for="email">Email Address</label>
                          <div class="input-group">
                            <input type="email" id="email" name="email" class="form-control bg-transparent text-white"
                              placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="text-white" for="password">Password</label>
                          <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control"
                              placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">

                        <div class="text-center">
                          <button id="btn" onclick="eiins();" class="btn btn-inverse-success btn-block enter-btn">Submit
                            Form</button>
                          <div id="status"></div>
                        </div>
                      </div>
                    </div>







                    <!-- <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p> -->
                  </form>
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
  var height = window.innerHeight;
  var mmmm = document.getElementById("main-box").clientHeight;
  var ttt = (height - mmmm) / 2 -20;
  // alert(height + '/' + mmmm + "//" + ttt);
  document.getElementById("main-box").style.marginTop =  ttt+"px";
</script>

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
  function eiins() {
    var usrtype = document.getElementById("usrtype").value;
    var userid = document.getElementById("userid").value;
    var dob = document.getElementById("dob").value;
    var mobile = document.getElementById("mobile").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var infor = "type=" + usrtype + "&userid" + userid + "&dob=" + dob  + "&mobile=" + mobile + "&email=" + email + "&password=" + password;
   alert(infor);
    $("#status").html("");

    $.ajax({
      type: "POST",
      url: "backend/checkdata.php",
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