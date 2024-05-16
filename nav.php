<div style="overflow-y:auto;">



  <nav class="sidebar sidebar-offcanvas no-print d-print-none" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="index.php"><img src="assets/imgs/logo-brand.png" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="index.php"><img src="assets/imgs/logo-bw.png" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="<?php echo $pth; ?>" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal"><?php echo $fullname; ?></h5>
              <span><?php echo $userlevel; ?></span>
            </div>
          </div>
          <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
          <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
            aria-labelledby="profile-dropdown">
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-onepassword  text-info"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-calendar-today text-success"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
              </div>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link"></span>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="index.php">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#execution" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Financial Execution</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="execution">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="exec-salary.php">Management Salary</a></li>
            <li class="nav-item"> <a class="nav-link" href="detail-salary.php">details Exec. Salary</a></li>
            <li class="nav-item"> <a class="nav-link" href="bank-cheque.php">Bank Cheque Management</a></li>
            <li class="nav-item"> <a class="nav-link" href="expenditure.php">Expenditure</a></li>
          </ul>
        </div>
      </li>


      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#hrd" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Human Resource</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="hrd">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="teachers.php">Teachers</a></li>
            <li class="nav-item"> <a class="nav-link" href="staffs.php">Staffs</a></li>
            <li class="nav-item"> <a class="nav-link" href="tattnd.php">Attendance</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#repo" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Reports</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="repo">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="students-list.php">Student's List</a></li>
            <li class="nav-item"> <a class="nav-link" href="student-dues-list.php">Student's Dues List</a></li>
          </ul>
        </div>
      </li>


      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#tttax" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">On Going Module</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tttax">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="regdbook.php">Registers</a></li>
            <li class="nav-item"> <a class="nav-link" href="cashbook.php">Columner Cash Book</a></li>
            <li class="nav-item"> <a class="nav-link" href="seatplan.php">Exam Hall Setup</a></li>
            <li class="nav-item"> <a class="nav-link" href="seat.php">Seat Card</a></li>
            <li class="nav-item"> <a class="nav-link" href="admit-card.php">Admit Card</a></li>
            <li class="nav-item"> <a class="nav-link" href="exam-routine.php">Exam Schedule</a></li>
            <li class="nav-item"> <a class="nav-link" href="testimonial.php">Testimonial</a></li>
            <li class="nav-item"> <a class="nav-link" href="calendar.php">Calendar</a></li>
            <li class="nav-item"> <a class="nav-link" href="users.php">User Manager</a></li>
            <li class="nav-item"> <a class="nav-link" href="students-edit.php">Student Editor</a></li>
          </ul>
        </div>
      </li>

    </ul>
  </nav>

</div>