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
      <a href="{{route('indexTeacher')}}" class="logo d-flex align-items-center">
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
              <span>CLASSROOM TEACHER</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('teacherProfile')}}" id="userProfileLink">

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
        <a class="nav-link " href="{{route('indexTeacher')}}">
          <i class="bi bi-grid"></i>
          <span>DASHBOARD</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Attendance" data-bs-toggle="collapse" href="rewards.html">
          <i class="bi bi-newspaper"></i><span>ATTENDANCE</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Attendance" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('attendance-in-classroom')}}">
              <i class="bi bi-circle"></i><span>RECORD ATTENDANCE</span>
            </a>
          </li>
          <li>
          <a href="{{route('attendance-to-school')}}">
            <i class="bi bi-circle"></i><span>LIST ATTENDANCE</span>
          </a>
        </li>
        </ul>
      </li><!-- End Components Nav -->
    
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Classroom Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('indexTeacher')}}">Home</a></li>
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
                  <h5 class="card-title">Total <span>| Students In Classroom</span></h5>

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
    var totalStudent=0, classroomTeacher=0, classroom=0;
 
    document.addEventListener("DOMContentLoaded", function () 
    {
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
        userProfileLink.href = "{{route('teacherProfile')}}";
      } else {
        console.error('User profile link not found.');
      }


      const data = 
      {
        staff_id: staffId,
      };

      fetch('http://127.0.0.1:8000/student-data/total-students-in-classroom', 
      {
        method: 'POST', // Use the POST method
        headers: {
          'Content-Type': 'application/json' // Set the content type to JSON
        },
        body: JSON.stringify(data) // Convert the data object to a JSON string
      })
      .then(response => 
      {
        if (response.ok){
          return response.json();
        }
        else{      
          
        }
      })
      .then(data => {

        // Select and update the UI elements
        var totalStudent = document.querySelector('.totalStudent-card h6');
        if (totalStudent) {
          totalStudent.textContent = data.total_students;
        } else {
          console.error('ACTIVITIES card <h6> element not found.');
        }

        var classroom = {
          classId: data.classroom_details[0].class_id,
          name: data.classroom_details[0].name,
          form_number: data.classroom_details[0].form_number,
          
        };

        sessionStorage.setItem('classroom', JSON.stringify(classroom));
        console.log("Classroom : ",sessionStorage);
                  
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
        
    });
</script>

<script>

    function fetchUser(staffId)
    {
        const data = {
            staffId : staffId,
        };

        fetch('http://127.0.0.1:8000/user/'+staffId, {
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

            // Retrieve the current year
            var currentYear = new Date().getFullYear();
            console.log("Current Year: " + currentYear); // For debugging purposes

            getClassId(data.staff.id, currentYear);
          
        })
        .catch(error => {
            console.error('Error during fetch:', error);
        });

    }

    function getClassId(staff_id, year)
    {
      const data={
        staff_id: staff_id,
        year : year
      };

      fetch('http://127.0.0.1:8000/StudentStudySession/findClass', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {

            console.log('Response:', data);

            if(!data.error == "Class not found"){
              var ClassProfile = 
              {
                ssc_id: data.school_session_class_id,
                class_id: data.class_id,
                class_name: data.class_name,
                form_number: data.form_number,
                school_session: data.school_session
              };

              sessionStorage.setItem('ClassProfile', JSON.stringify(ClassProfile));
              console.log('HERE HOI: ', sessionStorage);
            
              updateUserData();
            }
            else{
              
            }

            
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

      fetch('http://127.0.0.1:8000/user/logout', {
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
        window.location.replace('http://127.0.0.1:8000/login');
      })
      .catch(error => {
        console.error('Error during fetch:', error);
      });
    }

  </script>


</body>

</html>
