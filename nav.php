<?php
$pagelist = array(
  'settings.php',
  'ins-profile.php',
  'classes.php',
  'group-manage.php',
  'subjects.php',
  'subjects-list.php',
  'class-routine.php',
  'st-payment-setup.php',
  'access-denied-settings.php',
  'slot.php',
  'basic-settings.php',
  'class-schedule.php',
  'db-backup.php',
  'db-restore.php',
  'db-settings.php',
  'db-bank.php'
);
$accnav = array('account-settings.php');
$adminnav = array('admin.php', 'filelist.php', 'admin-pibi-topic.php');
$supernav = array('account-settings.php', 'bio-tree.php');
$stdnav = array('std-index.php', 'guar-index.php', 'std-attnd.php', 'std-profile.php', 'std-result.php', 'std-payments.php', 'std-messages.php', 'std-routine.php', 'std-syllabus.php');
$teanav = array('teacher-index.php', 'teacher-profile.php', 'teacher-class.php', 'teacher-subject.php', 'teacher-attnd.php', 'teacher-marks.php', 'teacher-collection.php');

if ($userlevel == 'Student') {
  if (!in_array($curfile, $stdnav)) {
    echo "<script>window.location.href = 'std-index.php';</script>";
  }
} else if ($userlevel == 'Guardian') {
  if (!in_array($curfile, $stdnav)) {
    echo "<script>window.location.href = 'guar-index.php';</script>";
  }
} else if ($userlevel == 'Teacher') {
  if (!in_array($curfile, $teanav)) {
    echo "<script>window.location.href = 'teacher-index.php';</script>";
  }
}



?>

<div style="overflow-y:auto; " ‍class="sidebar-block">
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
            <a href="account-settings.php" class="dropdown-item preview-item">
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
            <a href="settings.php" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-calendar-today text-success"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Settings</p>
              </div>
            </a>
          </div>
        </div>
      </li>

      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="<?php echo 'https://eimbox.com/logo/' . $sccode . '.png'; ?>"
                alt="">
            </div>
            <div class="profile-namex" style="word-wrap: break-word; ">
              <h6 class="mb-0 font-weight-normal"><small><?php echo $scname; ?></small></h6>

            </div>
          </div>


        </div>

      </li>

      <li class="nav-item nav-category">
        <span class="nav-link"></span>
      </li>

      <li class="nav-item menu-items mb-3" hidden>
        <a class="nav-link  bg-warning" href="whats-new.php">
          <span class="menu-icon bg-dark">
            <i class="mdi mdi-help mdi-24px pt-1"></i>
          </span>
          <span class="menu-title text-dark">What's New</span>
        </a>
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
          <a class="nav-link" href="settings.php">
            <span class="menu-icon">
              <i class="mdi mdi-settings mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Settings Home</span>
          </a>
        </li>


        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#ins-profile" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-checkbox-marked-circle-outline mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Institute Setup</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ins-profile">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="ins-profile.php"><i
                    class="mdi mdi-checkbox-marked-circle-outline"></i>&nbsp; Institute Info</a></li>
              <li class="nav-item"> <a class="nav-link" href="slot.php"><i class="mdi mdi-grid-off"></i>&nbsp; Slots</a>
              </li>
              <li class="nav-item"> <a class="nav-link" href="basic-settings.php">Basic Settings</a></li>
            </ul>
          </div>
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
              <li class="nav-item"> <a class="nav-link" href="classes.php"><i class="mdi mdi-account-multiple"></i>&nbsp;
                  Classes & Sections</a></li>
              <li class="nav-item"> <a class="nav-link" href="group-manage.php"><i class="mdi mdi-group"></i>&nbsp; Group
                  Management</a></li>
              <li class="nav-item"> <a class="nav-link" href="subjects.php"><i
                    class="mdi mdi-book-open-variant"></i>&nbsp; Subjects Manager</a></li>
              <li class="nav-item"> <a class="nav-link" href="subjects-list.php"><i
                    class="mdi mdi-book-open-page-variant"></i>&nbsp; Subjects List</a></li>
              <li class="nav-item"> <a class="nav-link" href="class-schedule.php"><i class="mdi mdi-timer"></i>&nbsp;
                  Class Schedule</a></li>
              <li class="nav-item"> <a class="nav-link" href="class-routine.php"><i class="mdi mdi-timelapse"></i>&nbsp;
                  Class Routine</a></li>
              <li class="nav-item"> <a class="nav-link" href="access-denied-settings.php">Syllabus</a></li>
              <li class="nav-item"> <a class="nav-link" href="access-denied-settings.php">Academic Plan</a></li>
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
          <a class="nav-link" data-toggle="collapse" href="#fees" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-currency-try mdi-24px pt-1"></i>
            </span>
            <span class="menu-title">Payments & Fees</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="fees">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="st-payment-setup.php"><i class="mdi mdi-coin"></i>&nbsp;
                  Fees Setting</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Fine</a></li>
            </ul>
          </div>
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

        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#data-repo" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-laptop"></i>
            </span>
            <span class="menu-title">Data Repository</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="data-repo">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="db-bank.php">Data Bank</a></li>
              <li class="nav-item"> <a class="nav-link" href="db-restore.php">Restore</a></li>
              <li class="nav-item"> <a class="nav-link" href="db-backup.php">Backup</a></li>
              <li class="nav-item"> <a class="nav-link" href="db-settings.php">Settings</a></li>
            </ul>
          </div>
        </li>

        <?php
      } else if (in_array($curfile, $accnav)) {
        ?>

          <li class="nav-item menu-items">
            <a class="nav-link" href="account-settings.php">
              <span class="menu-icon">
                <i class="mdi mdi-settings mdi-24px pt-1"></i>
              </span>
              <span class="menu-title">Account Home</span>
            </a>
          </li>

          <!-- -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          ----------------------------------------------------------------------------------------------------- -->
        <?php
      } else if (in_array($curfile, $stdnav)) {
        ?>
            <li class="nav-item menu-items">
              <a class="nav-link" href="std-profile.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Profile</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="std-attnd.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Attendance</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="std-result.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Results</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="std-payments.php">
                <span class="menu-icon">
                  <i class="mdi mdi-coin mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Payments & Dues</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="std-messages.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Messages</span>
              </a>
            </li>

            <li class="nav-item menu-items">
              <a class="nav-link" href="std-routine.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Class Routine</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="std-syllabus.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Syllabus</span>
              </a>
            </li>

        <?php
      } else if (in_array($curfile, $teanav)) {
        ?>
            <li class="nav-item menu-items">
              <a class="nav-link" href="teacher-profile.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Profile</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="teacher-class.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">My Class</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="teacher-subject.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">My Subjects</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="teacher-attnd.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Attendance</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="teacher-marks.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">Marks Entry</span>
              </a>
            </li>
            <li class="nav-item menu-items">
              <a class="nav-link" href="teacher-collection.php">
                <span class="menu-icon">
                  <i class="mdi mdi-settings mdi-24px pt-1"></i>
                </span>
                <span class="menu-title">My Collection</span>
              </a>
            </li>
        
           


        <?php
      } else if (in_array($curfile, $adminnav)) {
        ?>

              <li class="nav-item menu-items">
                <a class="nav-link" href="admin.php">
                  <span class="menu-icon">
                    <i class="mdi mdi-settings mdi-24px pt-1"></i>
                  </span>
                  <span class="menu-title">Admin Home</span>
                </a>
              </li>
              <li class="nav-item menu-items">
                <a class="nav-link" href="admin-pibi-topic.php">
                  <span class="menu-icon">
                    <i class="mdi mdi-settings mdi-24px pt-1"></i>
                  </span>
                  <span class="menu-title">PI/BI Topics</span>
                </a>
              </li>






              <!-- -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          ----------------------------------------------------------------------------------------------------- -->

        <?php if ($admin > 3) {
          ?>
                <li class="nav-item menu-items">
                  <a class="nav-link" href="filelist.php">
                    <span class="menu-icon">
                      <i class="mdi mdi-settings mdi-24px pt-1"></i>
                    </span>
                    <span class="menu-title">Package Setting</span>
                  </a>
                </li>
                <li class="nav-item menu-items">
                  <a class="nav-link" href="filelist.php">
                    <span class="menu-icon">
                      <i class="mdi mdi-settings mdi-24px pt-1"></i>
                    </span>
                    <span class="menu-title">Privileges Setting</span>
                  </a>
                </li>
          <?php
        } ?>











              <!-- -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          -----------------------------------------------------------------------------------------------------
          ----------------------------------------------------------------------------------------------------- -->


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







              <li class="nav-item menu-items" hidden>
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
                <a class="nav-link" data-toggle="collapse" href="#students" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-icon">
                    <i class="mdi mdi-account-multiple-outline mdi-24px pt-1"></i>
                  </span>
                  <span class="menu-title">Students</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="students">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="students-edit.php"><i class="mdi mdi-account"></i>&nbsp;
                        Student Enrollment</a></li>
                    <li class="nav-item"> <a class="nav-link" href="online-enroll.php"><i
                          class="mdi mdi-account-star"></i>&nbsp; Online Enrollment</a></li>
                    <li class="nav-item"> <a class="nav-link" href="students-payment.php"><i class="mdi mdi-coin"></i>&nbsp;
                        Fees & Payments</a></li>
                    <li class="nav-item"> <a class="nav-link" href="payment-receipt.php"><i class="mdi mdi-printer"></i>&nbsp;
                        Print Receipt</a></li>
                    <li class="nav-item"> <a class="nav-link" href="search-receipt.php"><i
                          class="mdi mdi-file-document-box"></i>&nbsp; Search Receipt</a></li>
                    <li class="nav-item"> <a class="nav-link" href="student-attendance.php">
                        <i class="mdi mdi-account-multiple"></i>
                        &nbsp; Query Attendance</a></li>
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
                    <li class="nav-item"> <a class="nav-link" href="exam-list.php"><i class="mdi mdi-grease-pencil"></i>&nbsp;
                        Exam List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="seat.php"><i class="mdi mdi-note"></i>&nbsp; Seat Card</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="admit-card.php">
                        <i class="mdi mdi-account-card-details"></i>&nbsp;
                        Admit Card</a></li>
                    <li class="nav-item"> <a class="nav-link" href="exam-routine.php"><i class="mdi mdi-timer"></i>&nbsp; Exam
                        Routine</a></li>
                    <!-- <li class="nav-item"> <a class="nav-link" href="seatplan.php">Hall Setup</a></li> -->
                  </ul>
                </div>
              </li>
              <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#result" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-icon">
                    <i class="mdi mdi-file-document  mdi-24px pt-1"></i>
                  </span>
                  <span class="menu-title">Gradebook</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="result">
                  <ul class="nav flex-column sub-menu">
                    <!-- <li class="nav-item"> <a class="nav-link" href="access-denied.php">Marks/Assessment Entry</a></li> -->
                    <li class="nav-item"> <a class="nav-link" href="result-pibi-sheet.php"><i
                          class="mdi mdi-triangle"></i>&nbsp; PI/BI Sheet</a></li>
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Result Processing</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Tabulating Sheet</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Transcript</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Report Card</a></li> -->
                  </ul>
                </div>
              </li>
              <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#hrd" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-icon">
                    <i class="mdi mdi-account-circle mdi-24px pt-1"></i>
                  </span>
                  <span class="menu-title">Teachers/Staffs</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="hrd">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="hr-list.php?hr=Teacher"><i
                          class="mdi mdi-account-box"></i>&nbsp; Teaching Staffs</a></li>
                    <li class="nav-item"> <a class="nav-link" href="hr-list.php?hr=Staff"><i
                          class="mdi mdi-account-box-outline"></i>&nbsp; Management Staffs</a></li>
                    <li class="nav-item"> <a class="nav-link" href="hr-profile.php"><i
                          class="mdi mdi-account-box-outline "></i>&nbsp; View Profile</a></li>
                    <li class="nav-item"> <a class="nav-link" href="hr-edit.php"><i class="mdi mdi-account-box "></i>&nbsp;
                        Profile Editor</a></li>
                    <li class="nav-item"> <a class="nav-link" href="tattnd.php"><i class="mdi mdi-cards-outline "></i>&nbsp; HRD
                        Attendance</a></li>
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
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">MPO Management</a></li> -->
                    <li class="nav-item"> <a class="nav-link" href="exec-salary.php">Monthly Expances</a></li>
                    <li class="nav-item"> <a class="nav-link" href="expenditure.php">Income & Expenditures</a></li>
                    <li class="nav-item"> <a class="nav-link" href="transaction-tracker.php">Transaction Summery</a></li>
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Collections from Students</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Liabilities</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Budgets</a></li> -->
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
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Cheque Management</a></li> -->
                  </ul>
                </div>
              </li>

              <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#finance-sal" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-icon">
                    <i class="mdi mdi-coin mdi-24px pt-1"></i>
                  </span>
                  <span class="menu-title">Payroll Manager</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="finance-sal">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="payroll-list.php"><i
                          class="mdi mdi-numeric-1-box "></i>&nbsp; Payroll List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="payroll-structure.php"><i
                          class="mdi mdi-numeric-1-box "></i>&nbsp; Salary Structure</a></li>

                    <li class="nav-item"> <a class="nav-link" href="payroll-bonus.php">Bonus & Incentive</a></li>


                    <li class="nav-item"> <a class="nav-link" href="detail-salary.php">HRD Salar`y</a></li>
                    <li class="nav-item"> <a class="nav-link" href="payroll-calc.php">Calculation & Payoff</a></li>
                    <li class="nav-item"> <a class="nav-link" href="payroll-payoff-dispuch.php">Dispuch Salary</a></li>
                    <li class="nav-item"> <a class="nav-link" href="payroll-statement.php">Payroll Statement</a></li>
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
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Book Issue & Return</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Book Tracker</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Catalogue management</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Fine/Overdue Settings</a></li> -->
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
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Student Route Manager</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Location Tracking</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Transport Management</a></li> -->
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
                    <!-- <li class="nav-item"> <a class="nav-link" href="under-construction.php">Room Allocation</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Hostel Attendance</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Meal Management</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Event & Activities</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Room Settings</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Management Authority</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Payments & Other Setup</a></li> -->
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
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Extra Curricular Activities</a></li> -->
                    <li class="nav-item"> <a class="nav-link" href="committees.php">Committees</a></li>
                    <li class="nav-item"> <a class="nav-link" href="club-list.php">Clubs in Institution</a></li>
                    <li class="nav-item"> <a class="nav-link" href="data-scanner.php">Data Validation Scanner</a></li>
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Feedback & Surveys</a></li> -->
                    <li class="nav-item"> <a class="nav-link" href="notice-manager.php">Notice Manager</a></li>
                    <li class="nav-item"> <a class="nav-link" href="ref-doc.php">Document Editor</a></li>

                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">My Profile</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">User Log</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">My Notifications</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Voter List for SMC</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Voter List for St. Cabinet</a></li> -->
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
                    <li class="nav-item"> <a class="nav-link" href="ref-doc-archive.php">Documents / Letters</a></li>
                    <li class="nav-item"> <a class="nav-link" href="cashbook.php">Columnar Cash Book</a></li>
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Transfer Certificate</a></li> -->
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
                    <li class="nav-item"> <a class="nav-link" href="report-today-collection.php">Today's Collection</a></li>
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Monthly Collection</a></li> -->

                    <!-- <li class="nav-item"> <a class="nav-link" href="#">Monthly Balance Sheet</a></li> -->

                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Bank Deposit Slip</a></li> -->
                    <li class="nav-item"> <a class="nav-link" href="students-list.php"><i class="mdi mdi-account"></i>&nbsp;
                        Student's List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="admission-form.php"><i class="mdi mdi-accountx"></i>&nbsp;
                        Admission Form</a></li>
                    <li class="nav-item"> <a class="nav-link" href="student-dues-list.php"><i
                          class="mdi mdi-currency-try"></i>&nbsp; Student's Dues List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="balance-sheet.php">Monthly Income-Expenditure</a></li>
                    <li class="nav-item"> <a class="nav-link" href="monthly-audit-report.php">Monthly Audit Report</a></li>

                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">My Transactions</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">All Transactions</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">My Collection</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Bank Report</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">Attendance Report</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">MPO Statement</a></li> -->

                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">MY --------- </a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">My Collections</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">My Transactions</a></li> -->
                    <!-- <li class="nav-item"> <a class="nav-link" href=".php">My Classes</a></li> -->
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
                    <li class="nav-item"> <a class="nav-link" href="users.php"><i class="mdi mdi-account-circle"></i>&nbsp; User
                        List</a></li>
                    <li class="nav-item"> <a class="nav-link" href=".php">User Profile</a></li>
                    <li class="nav-item"> <a class="nav-link" href="users-permission.php"><i class="mdi mdi-key"></i>&nbsp;
                        Access Permission</a></li>
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