<?php
$step = 7;
$point = 0;
$curm = date('m');
$cury = date('Y');
$stepcolor = array('danger', 'warning', 'info', 'primary', 'success');
$stepicon = array('checkbox-blank-circle', 'chevron-right', 'chevron-double-right', 'check-circle-outline', 'check-circle');

$salary_date = date('Y-m-d', strtotime($year . '-' . $month . '-01'));
$structure_count = 0;

$sql0x = "SELECT count(*) as tcnt FROM teacher where sccode='$sccode' and jdate < '$salary_date' ;";
$result0 = $conn->query($sql0x);
if ($result0->num_rows > 0) {
  while ($row0x = $result0->fetch_assoc()) {
    $teacher_count = $row0x['tcnt'];
  }
} else {
  $teacher_count = 0;
}



$sql0x = "SELECT * FROM payroll_track where sccode='$sccode' and salmonth ='$month' and salyear='$year' and period = '$disx' ;";
$result = $conn->query($sql0x);
if ($result->num_rows > 0) {
  while ($row0x = $result->fetch_assoc()) {
    $iidd = $row0x['id'];

    $step1 = $row0x['paystructure'];
    $step2 = $row0x['attnd'];
    $step3 = $row0x['bonus'];
    $step4 = $row0x['calc'];
    $step5 = $row0x['payoff'];
    $step6 = $row0x['dispuch'];
    $step7 = $row0x['cheque'];
  }
} else {
  $iidd = 0;

  $step1 = 0;
  $step2 = 0;
  $step3 = 0;
  $step4 = 0;
  $step5 = 0;
  $step6 = 0;
  $step7 = 0;
  $datax = "INSERT INTO payroll_track (id, sccode, salmonth, salyear, period, date, month, year) 
            VALUES (NULL, '$sccode', '$month', '$year', '$disx', '$td', '$curm', '$cury');";
  $conn->query($datax);
  // echo $datax;
  echo '<script>go();</script>';
  // $lnk = 'payroll-statement.php?y=' . $year . '&m=' . $m . '&p=' . $p;
  // header("location: '$lnk'");

}



if ($step1 == 4) {
  $point += ceil(100 / $step);
} else {
  $sql0x = "SELECT tid, applydate FROM teacher_salary_structure where sccode='$sccode' and applydate < '$salary_date' group by tid order by applydate desc ;";
  // echo $sql0x;
  $result1 = $conn->query($sql0x);
  if ($result1->num_rows > 0) {
    while ($row0x = $result1->fetch_assoc()) {
      $structure_count += 1;
    }
  } else {
    $structure_count = 0;
  }

  if ($structure_count == $teacher_count) {
    $step1 = 4;
  } else if ($structure_count == 0) {
    $step1 = 0;
  } else {
    $step1 = 2;
  }
  $setp1upd = "UPDATE payroll_track set paystructure='$step1' where sccode='$sccode' and id='$iidd'; ";
  $conn->query($setp1upd);

  $point += ceil((100 * $structure_count) / ($teacher_count * $step));
}

// echo $point . '/';

if ($step2 == 4) {
  $point += ceil(100 / $step);
} else {
  if ($month > 0 && $year > 0) {
    $setp2upd = "UPDATE payroll_track set attnd='4' where sccode='$sccode' and id='$iidd'; ";
    $conn->query($setp2upd);
    $step2 = 4;
    $point += ceil(100 / $step);
  }

  // $point += 1;
}
// echo $point . '/';

if ($step3 == 4) {
  $step3link = '';
  $point += ceil(100 / $step);
} else {
  $sql0x = "SELECT * FROM salaryextracolumn where sccode='$sccode' and sessionyear='$year' and month='$month' ;";
  // echo $sql0x;
  $result2 = $conn->query($sql0x);
  if ($result2->num_rows > 0) {
    while ($row0x = $result2->fetch_assoc()) {
      $bonus = $row0x['govt1title'] . ' ' . $row0x['govt2title'] . ' ' . $row0x['govt3title'] . ' ' . $row0x['school1title'] . ' ' . $row0x['school2title'] . ' ' . $row0x['school3title'];
    }
  } else {
    $bonus = '';
  }

  if (strlen($bonus) > 8) {
    $setp3upd = "UPDATE payroll_track set bonus='4' where sccode='$sccode' and id='$iidd'; ";
    $conn->query($setp3upd);
    $step3 = 4;
    $point += 100 / $step;
    $step3link = $bonus;
  } else {
    $step3link = '<small><a href="payroll-bonus.php?m=' . $month . '&y=' . $year . '&p=' . $disx . '">Bonus Setup Now</a> <br></small>';
    $step3link .= '<button class="btn btn-inverse-danger p-1 pl-2 pr-2" onclick="done(' . $iidd . ',3);"><small>Not Applicable</small> </button> ';
  }
  // $point += 1;
}

// echo $point . '/';



$sql0x = "SELECT count(*) as ccc, sum(total) as total FROM salarydetails where sccode='$sccode' and sessionyear='$year' and month='$month' ;";
// echo $sql0x;
$result3 = $conn->query($sql0x);
if ($result3->num_rows > 0) {
  while ($row0x = $result3->fetch_assoc()) {
    $payoff_found = $row0x['ccc'];
    $payoff_amount = $row0x['total'];
  }
} else {
  $payoff_found = 0;
  $payoff_amount = 0;
}



if ($step4 == 4) {
  $point += ceil(100 / $step);
  $step4link = 'All Done';
} else {


  if ($payoff_found == $structure_count && $month > 0 && $year > 0) {
    $setp4upd = "UPDATE payroll_track set calc='4' where sccode='$sccode' and id='$iidd' ; ";
    $conn->query($setp4upd);
    $step4 = 4;
    $point += 100 / $step;
    $step4link = '<small>' . $payoff_found . ' Calc Done</small>';
  } else {
    $step4link = '<small>' . $payoff_found . ' Calc Done</small>';
    $step4link .= '<button class="btn btn-inverse-danger p-1 pl-2 pr-2" onclick="done(' . $iidd . ', 4);"><small>Complete</small> </button> ';
    if ($structure_count > 0) {
      $point += ceil($payoff_found * 100 / ($structure_count * $step));
    }

  }

}

// echo $point . '/';


if ($step5 == 4) {
  $point += ceil(100 / $step);
  $step5link = '<small>TK ' . $payoff_amount . ' Payoff</small>';
} else {

  if ($payoff_found == $teacher_count && $month > 0 && $year > 0) {
    $setp5upd = "UPDATE payroll_track set payoff='4' where sccode='$sccode' and id='$iidd'; ";
    $conn->query($setp5upd);
    $step5 = 4;
    $point += 100 / $step;
    $step5link = '<small>TK ' . $payoff_amount . ' Payoff</small>';
  } else {
    $step5link = '<small>TK ' . $payoff_amount . ' Payoff</small>';
    $step5link .= '<button class="btn btn-inverse-danger p-1 pl-2 pr-2" onclick="done(' . $iidd . ', 5);"><small>Complete</small> </button> ';
  }
  if ($structure_count > 0) {
    $point += ceil($payoff_found * 100 / ($structure_count * $step));
  }
}

// echo $point . '/';

$sql0x = "SELECT count(*) as ccc, sum(total) as total FROM salarydetails where sccode='$sccode' and sessionyear='$year' and month='$month' and edit_lock=1 ;";
// echo $sql0x;
$result4 = $conn->query($sql0x);
if ($result4->num_rows > 0) {
  while ($row0x = $result4->fetch_assoc()) {
    $dispuch_found = $row0x['ccc'];
    $dispuch_amount = $row0x['total'];
  }
} else {
  $dispuch_found = 0;
  $dispuch_amount = 0;
}

if ($step6 == 4) {
  $point += ceil(100 / $step);
  $step6link = '<small>TK ' . $dispuch_amount . ' Dispuched</small>';
} else {

  if ($step5 == 4 && $dispuch_amount == $payoff_amount && $month > 0 && $year > 0) {
    $setp6upd = "UPDATE payroll_track set dispuch='4' where sccode='$sccode' and id='$iidd'; ";
    $conn->query($setp6upd);
    $step6 = 4;
    $point += 100 / $step;
    $step6link = '<small>TK ' . $dispuch_amount . ' Dispuched</small>';
  } else {
    $step6link = '<small>TK ' . $dispuch_amount . ' Dispuched</small>';
    $step6link .= '<button class="btn btn-inverse-danger p-1 pl-2 pr-2" onclick="done(' . $iidd . ', 6);"><small>Complete</small> </button> ';
  }
  if ($payoff_found > 0) {
    $point += ceil($dispuch_found * 100 / ($payoff_found * $step));
  }

}
// echo $point . '/';

$sql0x = "SELECT count(*) as ccc, sum(amount) as total FROM salarysummery where sccode='$sccode' and salaryyear='$year' and salarymonth='$month' and category !='expenditure' and partid !=9 ;";
// echo $sql0x;
$result5 = $conn->query($sql0x);
if ($result5->num_rows > 0) {
  while ($row0x = $result5->fetch_assoc()) {
    $chq_found = $row0x['ccc'];
    $chq_amount = $row0x['total'];
  }
} else {
  $chq_found = 0;
  $chq_amount = 0;
}

if ($step7 == 4) {
  $point += ceil(100 / $step);
} else {

  if ($dispuch_amount == $chq_amount && $month > 0 && $year > 0) {
    $setp7upd = "UPDATE payroll_track set dispuch='4' where sccode='$sccode' and id='$iidd'; ";
    $conn->query($setp7upd);
    $step7 = 4;
    $point += 100 / $step;
    $step7link = '<small>' . $chq_found . ' Cheque<br>TK ' . $chq_amount . '</small>';
  } else {
    $step7link = '<small>' . $chq_found . ' Cheque<br>TK ' . $chq_amount . '</small>';
    // $step3link .= '<button class="btn btn-inverse-success" onclick="done(' . $iidd . ', 6);"><small>Not Applicable</small> </button> ';
  }
  if ($dispuch_amount > 0) {
    $point += ceil($chq_amount * 100 / ($dispuch_amount * $step));
  }

}
/* */
// echo $point . '/';



if ($point >= 100) {

  $step8 = 4;
} else {
  $step8 = floor($point / 25);
}
// echo $point . '/';
?>
















<style>
  html {
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
    -ms-font-smoothing: antialiased !important;
  }

  .md-stepper-horizontal {
    display: table;
    width: 100%;
    margin: 0 auto;
  }

  .md-stepper-horizontal .md-step {
    display: table-cell;
    position: relative;
    padding: 24px;
  }

  .md-stepper-horizontal .md-step:hover,
  .md-stepper-horizontal .md-step:active {
    background-color: rgba(0, 0, 0, 0.99);
  }

  .md-stepper-horizontal .md-step:active {
    border-radius: 15% / 75%;
  }

  .md-stepper-horizontal .md-step:first-child:active {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }

  .md-stepper-horizontal .md-step:last-child:active {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  .md-stepper-horizontal .md-step:hover .md-step-circle {
    background-color: #757575;
  }

  .md-stepper-horizontal .md-step:first-child .md-step-bar-left,
  .md-stepper-horizontal .md-step:last-child .md-step-bar-right {
    display: none;
  }

  .md-stepper-horizontal .md-step .md-step-circle {
    width: 30px;
    height: 30px;
    margin: 0 auto;
    background-color: #000;
    border-radius: 50%;
    text-align: center;
    line-height: 30px;
    font-size: 16px;
    font-weight: 600;
    color: #FFFFFF;
  }

  .md-stepper-horizontal.green .md-step.active .md-step-circle {
    background-color: #00AE4D;
  }

  .md-stepper-horizontal.orange .md-step.active .md-step-circle {
    background-color: #F96302;
  }

  .md-stepper-horizontal .md-step.active .md-step-circle {
    background-color: rgb(33, 150, 243);
  }

  .md-stepper-horizontal .md-step.done .md-step-circle:before {
    font-family: 'FontAwesome';
    font-weight: 100;
    content: "\f00c";
  }

  .md-stepper-horizontal .md-step.done .md-step-circle *,
  .md-stepper-horizontal .md-step.editable .md-step-circle * {
    display: none;
  }

  .md-stepper-horizontal .md-step.editable .md-step-circle {
    -moz-transform: scaleX(-1);
    -o-transform: scaleX(-1);
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
  }

  .md-stepper-horizontal .md-step.editable .md-step-circle:before {
    font-family: 'FontAwesome';
    font-weight: 100;
    content: "\f040";
  }

  .md-stepper-horizontal .md-step .md-step-title {
    margin-top: 16px;
    font-size: 12px;
    font-weight: 600;
  }

  .md-stepper-horizontal .md-step .md-step-title,
  .md-stepper-horizontal .md-step .md-step-optional {
    text-align: center;
    color: rgba(0, 0, 0, .26);
  }

  .md-stepper-horizontal .md-step.active .md-step-title {
    font-weight: 600;
    color: rgba(0, 0, 0, .87);
  }

  .md-stepper-horizontal .md-step.active.done .md-step-title,
  .md-stepper-horizontal .md-step.active.editable .md-step-title {
    font-weight: 600;
  }

  .md-stepper-horizontal .md-step .md-step-optional {
    font-size: 12px;
  }

  .md-stepper-horizontal .md-step.active .md-step-optional {
    color: rgba(0, 0, 0, .54);
  }

  .md-stepper-horizontal .md-step .md-step-bar-left,
  .md-stepper-horizontal .md-step .md-step-bar-right {
    position: absolute;
    top: 36px;
    height: 1px;
    border-top: 1px solid #DDDDDD;
  }

  .md-stepper-horizontal .md-step .md-step-bar-right {
    right: 0;
    left: 50%;
    margin-left: 20px;
  }

  .md-stepper-horizontal .md-step .md-step-bar-left {
    left: 0;
    right: 50%;
    margin-right: 20px;
  }
</style>





<div class="row" style="display:flex;">
  <div class="col-12 grid-margin">
    <div class="card ">
      <div class="card-body text-secondary">
        <!-- -------------------------------------------------- -->


        <div class="md-stepper-horizontal text-white">
          <div class="md-step" onclick="gopage('payroll-list', <?php echo $month;?>,  <?php echo $year;?> );">
            <div class="md-step-circle text-<?php echo $stepcolor[$step1]; ?>"><span><i
                  class="mdi mdi-<?php echo $stepicon[$step1]; ?> mdi-24px"></i></span></div>
            <div class="md-step-title text-secondary">Salary Structure</div>
            <div class="md-step-optional text-muted"><?php echo $structure_count . '/' . $teacher_count; ?> Updated
            </div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>

          <div class="md-step" onclick="gopage('tattnd', <?php echo $month;?>,  <?php echo $year;?> );">
            <div class="md-step-circle text-<?php echo $stepcolor[$step2]; ?>"><span><i
                  class="mdi mdi-<?php echo $stepicon[$step2]; ?> mdi-24px"></i></span></div>
            <div class="md-step-title text-secondary">Attendance</div>
            <div class="md-step-optional text-muted">Not Applicable</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>

          <div class="md-step" onclick="gopage('payroll-bonus', <?php echo $month;?>,  <?php echo $year;?> );">
            <div class="md-step-circle text-<?php echo $stepcolor[$step3]; ?>"><span><i
                  class="mdi mdi-<?php echo $stepicon[$step3]; ?> mdi-24px"></i></span></div>
            <div class="md-step-title text-secondary">Bonus</div>
            <div class="md-step-optional text-muted"><?php echo $step3link; ?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>

          <div class="md-step" onclick="gopage('payroll-calc', <?php echo $month;?>,  <?php echo $year;?> );">
            <div class="md-step-circle text-<?php echo $stepcolor[$step4]; ?>"><span><i
                  class="mdi mdi-<?php echo $stepicon[$step4]; ?> mdi-24px"></i></span></div>
            <div class="md-step-title text-secondary">Calculations</div>
            <div class="md-step-optional text-muted"><?php echo $step4link; ?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
          <div class="md-step" onclick="gopage('payroll-calc', <?php echo $month;?>,  <?php echo $year;?> );">
            <div class="md-step-circle text-<?php echo $stepcolor[$step5]; ?>"><span><i
                  class="mdi mdi-<?php echo $stepicon[$step5]; ?> mdi-24px"></i></span></div>
            <div class="md-step-title text-secondary">Payoff</div>
            <div class="md-step-optional text-muted"><?php echo $step5link; ?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
          <div class="md-step" onclick="gopage('payroll-payoff-dispuch', <?php echo $month;?>,  <?php echo $year;?> );">
            <div class="md-step-circle text-<?php echo $stepcolor[$step6]; ?>"><span><i
                  class="mdi mdi-<?php echo $stepicon[$step6]; ?> mdi-24px"></i></span></div>
            <div class="md-step-title text-secondary">Dispuch</div>
            <div class="md-step-optional text-muted"><?php echo $step6link; ?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
          <div class="md-step" onclick="gopage('payroll-payoff-dispuch', <?php echo $month;?>,  <?php echo $year;?> );">
            <div class="md-step-circle text-<?php echo $stepcolor[$step7]; ?>"><span><i
                  class="mdi mdi-<?php echo $stepicon[$step7]; ?> mdi-24px"></i></span></div>
            <div class="md-step-title text-secondary">Issue Cheque</div>
            <div class="md-step-optional text-muted"><?php echo $step7link; ?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
          <div class="md-step" onclick="gopage('payroll-statement', <?php echo $month;?>,  <?php echo $year;?> );">
            <div class="md-step-circle text-<?php echo $stepcolor[$step8]; ?>"><span><i
                  class="mdi mdi-<?php echo $stepicon[$step8]; ?> mdi-24px"></i></span></div>

            <div class="md-step-title text-secondary">Done</div>
            <div class="md-step-optional text-muted" id="ssp">*</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
        </div>
        <!-- -------------------------------------------------- -->






        <div class="m-0">
          <div class="progress progress-md portfolio-progress">
            <div class="progress-bar bg-secondary" role="progressbar" style="width: <?php echo $point; ?>%"
              aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="mr-3" id="fixing-status"></div>
        </div>
      </div>
    </div>
  </div>
</div>














<script>
  function done(id, step) {
    alert(id + '/' + step);

    var infor = "id="+ id + "&step=" + step;

    // alert(infor);
    $("#ssp").html("");

    $.ajax({
      type: "POST",
      url: "backend/track-done.php",
      data: infor,
      cache: false,
      beforeSend: function () {
        $('#ssp').html('<span class=""><small>Processing...</small></span>');
      },
      success: function (html) {
        $("#ssp").html(html);

        // document.location.href = 'report.php';
      }
    });
  }
</script>