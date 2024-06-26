<?php
include 'header.php';
// include 'notice.php'; 
?>
<?php


// Check Slots
$sql0 = "SELECT * FROM slots where sccode='$sccode'";
$result0 = $conn->query($sql0);
if ($result0->num_rows > 0) {
    // while ($row0 = $result0->fetch_assoc()) {
    //     $id2 = $row0["id"];
    //     $sname2 = $row0["slotname"];
    // }
    $slot = 'success';
} else {
  $slot = 'danger';
}


if ($track <= 100 && $usr == 'engrreaz@gmail.com') {
  // include 'track-line.php';
}
?>
<div class="row" style="display:none;">
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">$12.34</h3>
              <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-success ">
              <span class="mdi mdi-arrow-top-right icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Potential growth</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">$17.34</h3>
              <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-success">
              <span class="mdi mdi-arrow-top-right icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Revenue current</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">$12.34</h3>
              <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-danger">
              <span class="mdi mdi-arrow-bottom-left icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Daily Income</h6>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">$31.53</h3>
              <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-success ">
              <span class="mdi mdi-arrow-top-right icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Expense current</h6>
      </div>
    </div>
  </div>
</div>


<div class="row" style="">
  <div class="col-12 grid-margin stretch-card">
    <h3 class="card-title"><i class="mdi mdi-settings mdi-24px text-warning p-2"></i> Settings</h3>
  </div>
</div>



<div class="row">

  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-checkbox-marked-circle-outline mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Institute Settings</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Setup your institute details</h5>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 grid-margin stretch-card text-<?php echo $slot;?>">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-checkbox-multiple-blank-circle mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Slot Manager</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">e.g. School/College/Day-shift etc.
        </h5>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-account-multiple mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Class/Section</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Setup Class/Section</h5>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-book-open-variant mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Subject Management</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Manage Subject with Marks Setup
        </h5>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-calendar-multiple-check mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Academic Calendar</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Manage Holidays, Events ...</h5>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-currency-try mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Fees Setup</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Setup Payment Settings</h5>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-account-card-details mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Attendance Manager</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Manage Card, Fingerprint etc.</h5>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-receipt mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Grading System</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Both Previous/New Curriculam </h5>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-message-text mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">SMS</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Manage your SMS/Notification</h5>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-security mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">User Privileges</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Manage user access</h5>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-coin mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Payment Method</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Bkash, Rocket, Nagod, Bank setup
        </h5>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
    <div class="card p-0 m-0">
      <div class="card-body p-3 m-0">
        <div class="text-center">
          <i class="mdi mdi-account-switch mdi-24px "></i>
        </div>
        <h4 class="mb-0 text-center text-small">Techers Bindings</h4>
        <h5 class="text-muted font-weight-normal text-center d-block text-small m-1">Binding teacher with their account
        </h5>
      </div>
    </div>
  </div>



</div>



<div class="row " style="display:none;">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Order Status</h4>
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
                <th> Client Name </th>
                <th> Order No </th>
                <th> Product Cost </th>
                <th> Project </th>
                <th> Payment Mode </th>
                <th> Start Date </th>
                <th> Payment Status </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input">
                    </label>
                  </div>
                </td>
                <td>
                  <img src="assets/images/faces/face1.jpg" alt="image" />
                  <span class="pl-2">Henry Klein</span>
                </td>
                <td> 02312 </td>
                <td> $14,500 </td>
                <td> Dashboard </td>
                <td> Credit card </td>
                <td> 04 Dec 2019 </td>
                <td>
                  <div class="badge badge-outline-success">Approved</div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input">
                    </label>
                  </div>
                </td>
                <td>
                  <img src="assets/images/faces/face2.jpg" alt="image" />
                  <span class="pl-2">Estella Bryan</span>
                </td>
                <td> 02312 </td>
                <td> $14,500 </td>
                <td> Website </td>
                <td> Cash on delivered </td>
                <td> 04 Dec 2019 </td>
                <td>
                  <div class="badge badge-outline-warning">Pending</div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input">
                    </label>
                  </div>
                </td>
                <td>
                  <img src="assets/images/faces/face5.jpg" alt="image" />
                  <span class="pl-2">Lucy Abbott</span>
                </td>
                <td> 02312 </td>
                <td> $14,500 </td>
                <td> App design </td>
                <td> Credit card </td>
                <td> 04 Dec 2019 </td>
                <td>
                  <div class="badge badge-outline-danger">Rejected</div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input">
                    </label>
                  </div>
                </td>
                <td>
                  <img src="assets/images/faces/face3.jpg" alt="image" />
                  <span class="pl-2">Peter Gill</span>
                </td>
                <td> 02312 </td>
                <td> $14,500 </td>
                <td> Development </td>
                <td> Online Payment </td>
                <td> 04 Dec 2019 </td>
                <td>
                  <div class="badge badge-outline-success">Approved</div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-check form-check-muted m-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input">
                    </label>
                  </div>
                </td>
                <td>
                  <img src="assets/images/faces/face4.jpg" alt="image" />
                  <span class="pl-2">Sallie Reyes</span>
                </td>
                <td> 02312 </td>
                <td> $14,500 </td>
                <td> Website </td>
                <td> Credit card </td>
                <td> 04 Dec 2019 </td>
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


<?php include 'footer.php'; ?>



<script>
  // A $( document ).ready() block.
  $(document).ready(function () {
    // alert("wait...");
  });
</script>