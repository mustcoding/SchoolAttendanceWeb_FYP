<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SMA JAWAHIR AL-ULUM ATTENDANCE SYSTEM</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/SMAJU.png" rel="icon">
  <link href="assets/img/SMAJU.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <style>
      .logo img {
        border-radius: 50%; /* Set border-radius to 50% for a circular or oval shape */
      }
    </style>

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('indexAdmin')}}" class="logo d-flex align-items-center">
        <img src="assets/img/SMAJU.png" alt="">
        <span class="d-none d-lg-block" >School Attendance</span>
      </a>
      <!-- <a href="#" id="userProfileLink" class="some-class"></a>-->
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">Hi, User! </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Hi, User! </h6>
              <span>SCHOOL ADMINISTRATOR</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="adminProfile.html" id="userProfileLink">

                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
            <a href="#" class="dropdown-item d-flex align-items-center" onClick="signOut(event)">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{route('indexAdmin')}}">
          <i class="bi bi-grid"></i>
          <span>DASHBOARD</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="rewards.html">
          <i class="bi bi-ticket-detailed"></i><span>REGISTRATION</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('add-staff')}}">
              <i class="bi bi-circle"></i><span>STAFF</span>
            </a>
          </li>
          <li>
            <a href="{{route('add-class')}}">
              <i class="bi bi-circle"></i><span>CLASS</span>
            </a>
          </li>
          <li>
            <a href="{{route('add-RFID')}}">
              <i class="bi bi-circle"></i><span>RFID</span>
            </a>
          </li>
          <li>
            <a href="{{route('add-student')}}">
              <i class="bi bi-circle"></i><span>STUDENT</span>
            </a>
          </li> 
          <li>
            <a href="{{route('add-school-session')}}">
              <i class="bi bi-circle"></i><span>SCHOOL SESSION</span>
            </a>
          </li>
          <li>
            <a href="{{route('add-activity-occurrences')}}">
             <i class="bi bi-circle"></i><span>ACTIVITY OCCURRENCES </span>
           </a>
         </li>
          <li>
            <a href="{{route('add-attendance-timetable')}}">
              <i class="bi bi-circle"></i><span>ATTENDANCE TIMETABLE</span>
            </a>
          </li>
          <li>
            <a href="{{route('add-classroom-by-session')}}">
              <i class="bi bi-circle"></i><span>CLASSROOM BY SESSION</span>
            </a>
          </li>
        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tourismServicesList" data-bs-toggle="collapse" href="rewards.html">
        <i class="bi bi-ticket-detailed"></i><span>MANAGEMENT</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tourismServicesList" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('studentManagement')}}">
            <i class="bi bi-circle"></i><span>STUDENT</span>
          </a>
        </li>
        <li>
            <a href="{{route('staffManagement')}}">
              <i class="bi bi-circle"></i><span>STAFF</span>
            </a>
          </li>
          <li>
            <a href="{{route('classroomManagement')}}">
              <i class="bi bi-circle"></i><span>CLASS</span>
            </a>
          </li>

          <li>
            <a href="{{route('attendanceTimetableManagement')}}">
              <i class="bi bi-circle"></i><span>ATTENDANCE TIMETABLE</span>
            </a>
          </li>
          <li>
            <a href="{{route('Student-In-Class')}}">
              <i class="bi bi-circle"></i><span>CLASSROOM BY SESSION</span>
            </a>
          </li>
          <li>
            <a href="{{route('schoolSessionManagement')}}">
              <i class="bi bi-circle"></i><span>SCHOOL SESSION</span>
            </a>
          </li>
          <li>
             <a href="{{route('activityOccurrenceManagement')}}">
              <i class="bi bi-circle"></i><span>ACTIVITY OCCURRENCES </span>
            </a>
          </li>
          <li>
             <a href="/applied-leave-management">
              <i class="bi bi-circle"></i><span>APPLIED LEAVES </span>
            </a>
          </li>
      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#Attendance" data-bs-toggle="collapse" href="rewards.html">
        <i class="bi bi-newspaper"></i><span>ATTENDANCE</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="Attendance" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{route('AttendanceRecordManagement')}}">
            <i class="bi bi-circle"></i><span>RECORD ATTENDANCE</span>
          </a>
        </li>
        <li>
          <a href="{{route('attend-to-school')}}">
            <i class="bi bi-circle"></i><span>LIST ATTENDANCE</span>
          </a>
        </li>
        <li>
          <a href="{{route('list-warning')}}">
            <i class="bi bi-circle"></i><span>LIST WARNING</span>
          </a>
        </li>
        
      </ul>
    </li><!-- End Components Nav -->
    
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Administrator Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('indexAdmin')}}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-16">
          <div class="row">

            <!-- TOTAL STUDENTS ALL -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card totalStudent-card">

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Active Students</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" >
                      <i class="bi bi-backpack3"></i>
                    </div>
                    <div class="ps-3">
                      <h6>0</h6>
                        
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Active Student-->

            <!-- ACTIVE Classroom Teachers -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card classroomTeacher-card">

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Classroom Teachers</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-raised-hand"></i>
                    </div>
                    <div class="ps-3">
                      <h6>0</h6>
                   
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Teachers -->

            <!-- Total Classroom -->
            <div class="col-xxl-4 col-md-6">

              <div class="card info-card classroom-card">

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Classrooms</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-pc-display-horizontal"></i>
                    </div>
                    <div class="ps-3">
                      <h6>0</h6>
                    
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Classroom -->         

            <!-- LOCAL Teacher -->
            <div class="col-xxl-4 col-md-6">

            <div class="card info-card teacher-card">

              <div class="card-body">
                <h5 class="card-title">Total <span>| Teachers</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person"></i>
                  </div>
                  <div class="ps-3">
                    <h6>0</h6>
                  
                  </div>
                </div>

              </div>
            </div>

            </div><!-- End Teacher -->    

            <!-- TOTAL ALUMNI -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card totalAlumni-card">

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Alumni</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>0</h6>
                        
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Active Student-->
            
            


          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SMA Jawahir Al-Ulum</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>

      // Initialize variables outside the loop
      var 
          totalStudent=0,
          classroomTeacher=0,
          classroom=0;
 
document.addEventListener("DOMContentLoaded", function () {
  console.log('DOMContentLoaded event fired.');

  // Retrieve the JSON string from sessionStorage DONE
  var storedStaffProfile = JSON.parse(sessionStorage.getItem('staffProfile'));
  console.log('User Profile: ', storedStaffProfile);


  // Update user nickname in the profile dropdown
  var profileDropdownHeader = document.querySelector('.dropdown-menu .dropdown-header h6');
  if (profileDropdownHeader) {
    console.log('Updating user nickname.');
    profileDropdownHeader.textContent = storedStaffProfile.staffName;
  } else {
    console.log('Profile dropdown header not found.');
  }

  // Update user profile information in the navigation link
  var profileDropdownLink = document.querySelector('.nav-link.nav-profile');

  if (profileDropdownLink) {
    var profileNameSpan = profileDropdownLink.querySelector('.dropdown-toggle');
    console.log('Updating user profile information.');

    // Update profile name
    if (profileNameSpan) {
      profileNameSpan.textContent = storedStaffProfile.nickname;
    }
  } else {
    console.log('Profile dropdown link not found.');
  }

      // Construct the profile URL
      var staffId = storedStaffProfile.staffId;

      // Update the href attribute with the appUserId
      var userProfileLink = document.getElementById('userProfileLink');
      if (userProfileLink) {
        userProfileLink.href = "/adminProfile";
      } else {
        console.error('User profile link not found.');
      }

      // Array to store promises for each AJAX call
      var promises = [];
  
        function makeAjaxRequest(url) {
        return new Promise(function (resolve, reject) {
          $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
              if (response.hasOwnProperty('count')) {
                console.log('Total is: ',response.count);
                resolve(response.count);
              } else {
                reject('Count not found in response.');
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              reject(errorThrown);
            }
          });
        });
      }


      // AJAX call to calculate total tourist register MelakaGo
      promises.push(makeAjaxRequest("/Student/total-students"));

      // AJAX call to calculate the active tourist
      promises.push(makeAjaxRequest("/SchoolSessionClass/totalClassroomTeacher"));

      // AJAX call to calculate local tourist
      promises.push(makeAjaxRequest("/classroom/totalClassroom"));

      promises.push(makeAjaxRequest("/staff/totalTeacher"));

      promises.push(makeAjaxRequest("/Student/total-alumni"));

      // Wait for all promises to be resolved
      Promise.all(promises)
        .then(function (results) {
          // Results is an array containing the resolved values from each promise
          var [student, classTeacher, classr, teachers, alumni] = results;

          // Select and update the UI elements
          var totalStudent = document.querySelector('.totalStudent-card h6');
          if (totalStudent) {
            totalStudent.textContent = student;
          } else {
            console.error('ACTIVITIES card <h6> element not found.');
          }

          var classroomTeacher = document.querySelector('.classroomTeacher-card h6');
          if (classroomTeacher) {
            classroomTeacher.textContent = classTeacher;
          } else {
            console.error('ACTIVITIES card <h6> element not found.');
          }

          var classroom = document.querySelector('.classroom-card h6');
          if (classroom) {
            classroom.textContent = classr;
          } else {
            console.error('ACTIVITIES card <h6> element not found.');
          }

          var teacher = document.querySelector('.teacher-card h6');
          if (teacher) {
            teacher.textContent = teachers;
          } else {
            console.error('ACTIVITIES card <h6> element not found.');
          }

          // Select and update the UI elements
          var totalAlumni = document.querySelector('.totalAlumni-card h6');
          if (totalAlumni) {
            totalAlumni.textContent = alumni;
          } else {
            console.error('ACTIVITIES card <h6> element not found.');
          }

        })
        .catch(function (error) {
          console.error('Error:', error);
        });

    });
</script>

<script>

    function fetchUser(staffId)
    {
        const data = {
            staffId : staffId,
        };

        fetch('/user/'+staffId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response:', data);
                    // Call a function to update the table with the fetched data
            var EditStaffProfile = 
            {
              staffId: data.staff.id,
              staffName: data.staff.name,
              email: data.staff.email,
              password: data.staff.password,
              position: data.staff.position,
              nickname: data.staff.nickname,
              image: data.staff.image,
              position: data.staff.position,
            };

            sessionStorage.setItem('staff', JSON.stringify(EditStaffProfile));
            console.log('HERE HOI: ', sessionStorage);
            updateUserData();
        })
        .catch(error => {
            console.error('Error during fetch:', error);
        });

    }

    function updateUserData()
    {
        // Retrieve the JSON string from sessionStorage
        var storedStaffProfile = JSON.parse(sessionStorage.getItem('staff'));
        console.log('User Profile: ', storedStaffProfile);

        // Update user nickname in the profile dropdown
        var profileDropdownHeader = document.querySelector('.dropdown-header h6');
        if (profileDropdownHeader) 
        {
          console.log('Updating user nickname.');
          profileDropdownHeader.textContent = storedStaffProfile.staffName ;

        } 
        else 
        {
          console.log('Profile dropdown header not found.');
        }

        var profileDropdownLink = document.querySelector('.nav-link.nav-profile');
        if (profileDropdownLink) {
          var profileNameSpan = profileDropdownLink.querySelector('.dropdown-toggle');

          console.log('Updating user profile information.');

          // Update profile name
          if (profileNameSpan) 
          {
          profileNameSpan.textContent = storedStaffProfile.nickname;
          }
                
        } else {
          console.log('Profile dropdown link not found.');
        }
    }
    
    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function () {

      var storedStaffProfile = JSON.parse(sessionStorage.getItem('staffProfile'));
      var storedToken = JSON.parse(sessionStorage.getItem('token'));
      var staffId = storedStaffProfile.staffId;
      var token = storedToken;
      console.log("Staff Token: ",token);
      
      
      fetchUser(staffId);
    });

  </script>

  <script>

    function signOut() {
      const data = {};

      fetch('/user/logout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
      .then(response => response.json())
      .then(data => {
        console.log('Response:', data);
              
        // Clear session storage
        sessionStorage.clear();

        // Redirect to the login page
        window.location.href = '/login';
      })
      .catch(error => {
        console.error('Error during fetch:', error);
      });
    }

  </script>


</body>

</html>
