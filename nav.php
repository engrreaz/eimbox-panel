<?php 
$pagelist = array('settings.php', 'classes.php', 'subjects.php', 'st-payment-setup.php'); 
?>

<div style="overflow-y:auto; ">
  <nav class="sidebar sidebar-offcanvas no-print d-print-none" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="index.php"><img src="assets/imgs/logo-brand.png" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="index.php"><img src="assets/imgs/logo-bw.png" alt="logo" /></a>
    </div>
    <ul class="nav ">
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
        <div class="profile-desc text-small menu-items"><?php echo $scname; ?></div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link"></span>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="index.php">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer mdi-24px pt-1"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <?php
      if (in_array($curfile, $pagelist)) {
        ?>
        <li class="nav-item menu-items">
          <a class="nav-link" href="ins-profile.php">
            <span class="menu-icon">
              <i class="mdi mdi-checkbox-marked-circle-outline mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Institute Profile</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#academics" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-school mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Academics</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="academics">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="classes.php">Classes & Sections</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Group Management</a></li>
              <li class="nav-item"> <a class="nav-link" href="subjects.php">Subjects Management</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Class Routine</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Syllabus</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Academic Plan</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#examset" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-laptop"></i>
            </span>
            <span class="menu-title">Exam Settings</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="examset">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="#">Grading System</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Result Policies</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Promotion</a></li>
            </ul>
          </div>
        </li>

        <li class="nav-item menu-items">
          <a class="nav-link" href="st-payment-setup.php">
            <span class="menu-icon">
              <i class="mdi mdi-currency-try mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Payments & Fees</span>
          </a>
        </li>

        <li class="nav-item menu-items">
          <a class="nav-link" href="#">
            <span class="menu-icon">
              <i class="mdi mdi-credit-card  mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Payment Method Setup</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="#">
            <span class="menu-icon">
              <i class="mdi mdi-message-text  mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Messaging</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="users-privileges.php">
            <span class="menu-icon">
              <i class="mdi mdi-lock mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Privileges</span>
          </a>
        </li>

        <?php
      } else {
        ?>



        <!-- <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#execution" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-laptop"></i>
            </span>
            <span class="menu-title">Financial Execution</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="execution">
            <ul class="nav flex-column sub-menu"> -->
              <!-- <li class="nav-item"> <a class="nav-link" href="exec-salary.php">Management Salary</a></li> -->
              <!-- <li class="nav-item"> <a class="nav-link" href="detail-salary.php">details Exec. Salary</a></li> -->
              <!-- <li class="nav-item"> <a class="nav-link" href="bank-cheque.php">Bank Cheque Management</a></li> -->
              <!-- <li class="nav-item"> <a class="nav-link" href="expenditure.php">Expenditure</a></li> -->
            <!-- </ul>
          </div>
        </li> -->







        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#tttax" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-laptop mdi-18px pt-1 "></i>
            </span>
            <span class="menu-title">On Going Module</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="tttax">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="#">-</a></li>

            </ul>
          </div>
        </li>

        <!-- -----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------- -->

        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#hrd" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-account-circle mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Human Resources</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="hrd">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="hr-list.php?hr=Teacher">Teaching Staffs</a></li>
              <li class="nav-item"> <a class="nav-link" href="hr-list.php?hr=Staff">Management Staffs</a></li>
              <li class="nav-item"> <a class="nav-link" href="hr-profile.php">View Profile</a></li>
              <li class="nav-item"> <a class="nav-link" href="hr-edit.php">Profile Editor</a></li>
              <li class="nav-item"> <a class="nav-link" href="tattnd.php">HRD Attendance</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#students" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-account-multiple-outline mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Students</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="students">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="students-edit.php">Student's Enrollment</a></li>
              <li class="nav-item"> <a class="nav-link" href="online-enroll.php">Online Enrollment</a></li>
              <li class="nav-item"> <a class="nav-link" href="students-payment.php">Fees & Payments</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#finance" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-coin mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Finance</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="finance">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="detail-salary.php">HRD Salar`y</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">MPO Management</a></li>
              <li class="nav-item"> <a class="nav-link" href="exec-salary.php">Monthly Expances</a></li>
              <li class="nav-item"> <a class="nav-link" href="expenditure.php">Income & Expenditures</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Collections from Students</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Liabilities</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Budgets</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#bank-management" aria-expanded="false"
            aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-currency-try  mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Bank Management</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="bank-management">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="bank-manager.php">Bank Accounts</a></li>
              <li class="nav-item"> <a class="nav-link" href="bank-account.php">Accounts Transactions</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Cheque Management</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#examination" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-pen   mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Examination</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="examination">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="exam-list.php">Exam Schedule</a></li>
              <li class="nav-item"> <a class="nav-link" href="seat.php">Seat Card</a></li>
              <li class="nav-item"> <a class="nav-link" href="admit-card.php">Admit Card</a></li>
              <li class="nav-item"> <a class="nav-link" href="exam-routine.php">Exam Schedule & Routine</a></li>
              <li class="nav-item"> <a class="nav-link" href="seatplan.php">Hall Setup</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#result" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-file-document  mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Result</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="result">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href=".php">Marks/Assessment Entry</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">PI/BI Sheet</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Result Processing</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Transcript</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Report Card</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#modules" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-view-module  mdi-24px pt-2"></i>
            </span>
            <span class="menu-title">Modules</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="modules">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="calendar.php">Academic Calendar</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Extra Curricular Activities</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Committees</a></li>
              <li class="nav-item"> <a class="nav-link" href="club-list.php">Clubs in Institution</a></li>
              <li class="nav-item"> <a class="nav-link" href="data-scanner.php">Data Validation Scanner</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Feedback & Surveys</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Notice Manager</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">My Profile</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">User Log</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">My Notifications</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Voter List for SMC</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Voter List for St. Cabinet</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#library" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-book-open-page-variant  mdi-18px pt-1"></i>
            </span>
            <span class="menu-title">Library</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="library">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href=".php">Book Issue & Return</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Book Tracker</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Catalogue management</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Fine/Overdue Settings</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#transport" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-bus mdi-18px pt-1"></i>
            </span>
            <span class="menu-title">Transport</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="transport">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href=".php">Student Route Manager</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Location Tracking</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Transport Management</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#hostel" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-hotel mdi-18px pt-1"></i>
            </span>
            <span class="menu-title">Hostel Management</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="hostel">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="under-construction.php">Room Allocation</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Hostel Attendance</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Meal Management</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Event & Activities</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Room Settings</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Management Authority</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Payments & Other Setup</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#register" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-folder-multiple mdi-18px pt-1"></i>
            </span>
            <span class="menu-title">Registers</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="register">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="regdbook.php">Register List</a></li>
              <li class="nav-item"> <a class="nav-link" href="refbook.php">Reference Book</a></li>
              <li class="nav-item"> <a class="nav-link" href="cashbook.php">Columnar Cash Book</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Transfer Certificate</a></li>
              <li class="nav-item"> <a class="nav-link" href="testimonial.php">Testimonial</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-file-document mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Reports & Analytics</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="reports">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="live-attendance.php">Live Attendance</a></li>
              <li class="nav-item"> <a class="nav-link" href="report-daily.php">Daily Report</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Collection Report</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Receipt Print</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Bank Deposit Slip</a></li>
              <li class="nav-item"> <a class="nav-link" href="students-list.php">Student's List</a></li>
              <li class="nav-item"> <a class="nav-link" href="student-dues-list.php">Student's Dues List</a></li>



              <li class="nav-item"> <a class="nav-link" href=".php">My Transactions</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">All Transactions</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">My Collection</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Bank Report</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">Attendance Report</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">MPO Statement</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-account mdi-24px"></i>
            </span>
            <span class="menu-title">Users Management</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="users">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="users.php">User List</a></li>
              <li class="nav-item"> <a class="nav-link" href=".php">User Profile</a></li>
              <li class="nav-item"> <a class="nav-link" href="users-permission.php">Access Permission</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="settings.php">
            <span class="menu-icon">
              <i class="mdi mdi-settings mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Settings</span>
          </a>
        </li>



      <?php } ?>
    </ul>
  </nav>

</div>