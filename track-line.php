<?php
$scinfo_point = 1;
$scinfo = array();
$sql0x = "SELECT * FROM scinfo where sccode='$sccode' ;";
$result0 = $conn->query($sql0x);
if ($result0->num_rows > 0) {
  while ($row0x = $result0->fetch_assoc()) {
    $scinfo[] = $row0x;
  }
}
// $conn -> close();
// echo var_dump($scinfo);
if($scinfo[0]['logo'] == '' ) {
  $scinfo_point = 0;
}
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
    background-color: rgba(0, 0, 0, 0.04);
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
    background-color: #999999;
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
    font-size: 16px;
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
    <div class="card  bg-danger">
      <div class="card-body">
        <!-- -------------------------------------------------- -->


        <div class="md-stepper-horizontal ">
          <div class="md-step active done">
            <div class="md-step-circle"><span><i class="mdi mdi-check"></i></span></div>
            <div class="md-step-title">Ins. Info</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
          <div class="md-step active editable">
            <div class="md-step-circle"><span>2</span></div>
            <div class="md-step-title">Teacher's Account</div>
            <div class="md-step-optional">Optional</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
          <div class="md-step active">
            <div class="md-step-circle"><span>3</span></div>
            <div class="md-step-title">Teacher's Profile</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
          <div class="md-step">
            <div class="md-step-circle"><span>4</span></div>
            <div class="md-step-title">Class</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
          <div class="md-step">
            <div class="md-step-circle"><span>4</span></div>
            <div class="md-step-title">Subject</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
          <div class="md-step">
            <div class="md-step-circle"><span>4</span></div>
            <div class="md-step-title">Teacher Binding</div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
          </div>
        </div>
        <!-- -------------------------------------------------- -->






        <div style="float:right;">

          <button type="button" class="btn btn-secondary text-danger pt-2">Find It Now</button>
        </div>
        <h4 class="card-title">Detect Issues</h4>
        <div>
          <div class="progress progress-md portfolio-progress">
            <div class="progress-bar bg-secondary" role="progressbar" style="width: 67%" aria-valuenow="67"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="mr-3" id="fixing-status"></div>
        </div>
      </div>
    </div>
  </div>
</div>


Calendar Setting : holioday set. weekend set.....