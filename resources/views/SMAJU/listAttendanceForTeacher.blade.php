<!DOCTYPE html>
<html lang="en">

<head>
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

    <style>
      .button-column {
        display: flex;
        flex-direction: column;
        gap: 10px; /* Adjust the gap between buttons */
      }

      .btn-action {
        width: 80% !important; /* Use !important to ensure that this style takes precedence */
        text-align: center;
      }
    </style>

    <div class="d-flex align-items-center justify-content-between">
      <a href="/indexTeacher" class="logo d-flex align-items-center">
        <img src="assets/img/SMAJU.png" alt="">
        <span class="d-none d-lg-block">School Attendance</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
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
              <a class="dropdown-item d-flex align-items-center" href="/user/logout" onClick="signOut()">
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
      <h1>List Attendance For</h1>
    </div><!-- End Page Title -->

  
    <div class="alert alert-danger alert-dismissible fade show" role="alert1" style="display: none;">
      Houston....No Attendance Being Recorded.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-success alert-dismissible fade show" role="successSearch" style="display: none;">
      Here is the student you were searching for.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="unsuccessSearch" style="display: none;">
      Houston... we can't find the student you search.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Search Student @ Classroom</h5>
    
            <form class="row g-3 align-items-center">
              <div class="col-md-6">
                  <div class="input-group">
                      <input type="text" class="form-control me-2" id="search" placeholder="Enter Student Name @ Class">
                      <button type="button" class="btn btn-primary" onclick="searchServices()">
                          Search
                      </button>
                  </div>
              </div>
          </form><!-- Horizontal Form -->
    
        </div>
    </div>

 

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                List of Student

                <button class="btn btn-primary float-end" onclick="printData()">Print</button>
              </h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Parent Name</th>
                    <th scope="col">Parent Phone Number</th>
                    <th scope="col">Time Attend</th>
                    <th scope="col">Class</th>
                    <th scope="col">Type of Student</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>

                    </td>
                  </tr>
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>
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

    function printData() {
      // You can add additional styling or logic here if needed
      window.print();
    }
    // Function to fetch data from the server
    function fetchData(schoolSession_id, classroom_id, attendanceTimetable_id, attendanceDate) {

      const data = {
        schoolSession_id : schoolSession_id,
        classroom_id : classroom_id,
        attendanceTimetable_id : attendanceTimetable_id,
        attendanceDate: attendanceDate
      };

      fetch('/Attendance/list-attend',{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
      .then(response => response.json())
      .then(data => {
        console.log('List Attendance:', data);

        // Check if the response contains any student_id
        const containsStudentId = data.some(item => item.student_id !== undefined);

      
        if (data.length==0)
        {
          document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert1"]').style.display = "block";
      
          console.log("here")
          updateTable(data);
        }
       
        updateTable(data);
        
      })
      .catch(error => {
        console.error('Error during fetch:', error);
      });

    }

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

      // Function to update the table with data
    function updateTable(data) {
      const tbody = document.querySelector('table tbody');

      // Clear existing rows
      tbody.innerHTML = '';

      
      // Iterate over the data and create rows
      data.forEach((item, index) => 
      {
        
        const row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.parent_name}</td>
                        <td>${item.phone_number}</td>
                        <td>${item.date_time_in}</td>
                        <td>${item.form_number} ${item.class_name}</td> 
                        <td>${item.type_student}</td> 
                      </tr>`;
        // Append the row to the tbody
        tbody.innerHTML += row;
      });


    }

    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function () {

        var storedStaffProfile = JSON.parse(sessionStorage.getItem('staffProfile'));
        var storedToken = JSON.parse(sessionStorage.getItem('token'));
        var staffId = storedStaffProfile.staffId;
        var token = storedToken;
        console.log("Staff Token: ",token);

        var storedListAttend = JSON.parse(sessionStorage.getItem('ListAttend'));
        var schoolSession_id = storedListAttend.schoolSessionId;
        var classroom_id = storedListAttend.classroomId;
        var attendanceTimetable_id = storedListAttend.attendanceTimetableId;
        var TimetableName = storedListAttend.selectedTimetable;
        var attendanceDate = storedListAttend.date;

        console.log("DFGF: ", storedListAttend);

        // Update the card title with the classroom name
        document.querySelector('div.pagetitle h1').textContent = `LIST ATTENDANCE FOR - ${TimetableName}`;

        fetchData(schoolSession_id, classroom_id, attendanceTimetable_id, attendanceDate );
        fetchUser(staffId);
    });


    function searchServices() {
        // Get the search term
        var searchTerm = document.getElementById('search').value.toLowerCase();
        console.log('KEYWORD:',searchTerm);

        // Get all rows in the table
        var rows = document.querySelectorAll('table tbody tr');

        var studentFound = false;

        // Loop through each row and hide/show based on the search term
        rows.forEach(function (row) {
            // Update the selector to target the correct cell (company name)
            var studentName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            var parentName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

            // Convert both the company name and the search term to lowercase for comparison
            if (studentName.includes(searchTerm) || parentName.includes(searchTerm)) {
                row.style.display = 'table-row';
                studentFound = true;
            } else {
                row.style.display = 'none';
            }
        });

        if(studentFound){
            document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="successSearch"]').style.display = 'block';
            document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="unsuccessSearch"]').style.display = 'none';
        }
        else{
            document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="successSearch"]').style.display = 'none';
            document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="unsuccessSearch"]').style.display = 'block';
        }
    }

  </script>

  
    <script>

        function signOut()
        {
        const data={};

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
            
            // Redirect to the login page
            window.location.replace('/login');
                
            })
            .catch(error => {
                console.error('Error during fetch:', error);
            });

        }
    </script>

</body>

</html>
