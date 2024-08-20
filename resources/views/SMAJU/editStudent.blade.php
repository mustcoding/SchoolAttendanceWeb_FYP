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
        .image-spacing {
            margin-right: 20px; /* Adjust the value to set the desired spacing */
            width: 300px;
            height: 200px;
            margin-top: 20px;
        }
    </style>

    <div class="d-flex align-items-center justify-content-between">
      <a href="/indexAdmin" class="logo d-flex align-items-center">
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
              <span>BUSINESS SPOT DATA COLLECTOR</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="userProfile.html">
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
        <a class="nav-link " href="/indexAdmin">
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
          <a href="/studentManagement">
            <i class="bi bi-circle"></i><span>STUDENT</span>
          </a>
        </li>
        <li>
            <a href="/staffManagement">
              <i class="bi bi-circle"></i><span>STAFF</span>
            </a>
          </li>
          <li>
            <a href="/classroomManagement">
              <i class="bi bi-circle"></i><span>CLASS</span>
            </a>
          </li>
          <li>
            <a href="/attendanceTimetableManagement">
              <i class="bi bi-circle"></i><span>ATTENDANCE TIMETABLE</span>
            </a>
          </li>
          <li>
            <a href="{{route('Student-In-Class')}}">
              <i class="bi bi-circle"></i><span>CLASSROOM BY SESSION</span>
            </a>
          </li>
          <li>
            <a href="/schoolSessionManagement">
              <i class="bi bi-circle"></i><span>SCHOOL SESSION</span>
            </a>
          </li>
          <li>
             <a href="/activityOccurrenceManagement">
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
            <a href="/AttendanceRecordManagement">
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

    <div class="alert alert-success alert-dismissible fade show" role="alert1" style="display: none;">
      New Information has successfully being saved.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert2" style="display: none;">
      Houston....Can't save the information.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="pagetitle">
      <h1>Edit Student</h1>
    </div><!-- End Page Title -->
    
    <section class="section">
        
      <div class="col-lg-12">

          <div class="card">
              <div class="card-body">
                <h5 class="card-title">Student Details</h5>

                <!-- Custom Styled Validation -->
                <form id="studentForm" class="row g-3 needs-validation" validate>
                    <div class="col-12">
                        <label for="startDate" class="form-label">Student Name<span style="color: red;"> *</label>
                        <input type="type" class="form-control" id="studentName" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a start date.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="startDate" class="form-label">Date Of Birth<span style="color: red;"> *</label>
                        <input type="date" class="form-control" id="dateOfBirth" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a start date.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="startDate" class="form-label">Type Of Student<span style="color: red;"> *</label>
                        <input type="text" class="form-control" id="typeStudent" readonly>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a start date.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="className" class="form-label">Parent @ Guardian Name<span style="color: red;"> *</label>
                        <input type="text" class="form-control" id="parentName" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please Enter Parent @ Guardian Name!
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="endDate" class="form-label">Parent @ Guardian Phone Number<span style="color: red;"> *</label>
                        <input type="type" class="form-control" id="phoneNumber" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please Enter Phone Number.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="endDate" class="form-label">Parent @ Guardian Nickname<span style="color: red;"> *</label>
                        <input type="type" class="form-control" id="nickName" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please Enter Nickname.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="endDate" class="form-label">Address<span style="color: red;"> *</label>
                        <input type="type" class="form-control" id="address" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please Enter Address.
                        </div>
                    </div>
                    
                   
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary" onclick="editStudent(
                      event,
                      document.getElementById('studentName').value,
                      document.getElementById('dateOfBirth').value, 
                      document.getElementById('typeStudent').value,
                      document.getElementById('parentName').value,
                      document.getElementById('phoneNumber').value,
                      document.getElementById('nickName').value,
                      document.getElementById('address').value,
                      )">Save</button>
                      <button type="button" class="btn btn-secondary" onclick="returnToIndex()">
                        Cancel
                      </button>
                    </div>

                </form><!-- End Custom Styled Validation -->
  
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
    function returnToIndex(){
      window.location.href = '/indexAdmin';
    }
  </script>

  <script>
    function updateRoleId(tsId)
    {
        document.getElementById('tsId').value = tsId;
        console.log("Tourism Service ID: ", tsId);
    }
  </script>

  <script>
    function editStudent(event, student_name, date_of_birth,
    type_student, parent_name, phone_number, nickname, address)
   {

      event.preventDefault();

      // Get the questionId from the URL
      const queryString = window.location.search;
       const urlParams = new URLSearchParams(queryString);
       const student_id = urlParams.get('id');

      if (
        student_name.trim() === '' ||
        date_of_birth.trim()=== '' ||
        type_student=== '' ||
        parent_name.trim() === '' ||
        phone_number.trim() === '' ||
        nickname.trim() === '' ||
        address.trim() === '' 
    )
    {
        document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'none';
        document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'block';
      return;
    }
     

      // Create an object to hold the data you want to send
      const data = {
        name:student_name,
        date_of_birth: date_of_birth,
      };

      console.log("Here : ",student_name);
      console.log("Here : ",date_of_birth);


      // Remove properties with null or undefined values
      Object.keys(data).forEach(key => data[key] == null && delete data[key]);

      fetch('/Student/update/'+student_id, {
        method: 'PUT', // Use the POST method
        headers: {
          'Content-Type': 'application/json' // Set the content type to JSON
        },
        body: JSON.stringify(data) // Convert the data object to a JSON string
      })
        .then(response => response.json())
        .then(data => {
          // Handle the response from the server
          console.log("Student Information Successfully being updated ", data);
          updateParent(parent_name, phone_number, nickname, address, parent_id);
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });

    }
  </script>

<script>
    function updateParent(parent_name, phone_number, nickname, address, parent_id)
    {
      
      const data = {
        name:parent_name,
        phone_number: phone_number,
        nickname: nickname,
        address: address,
      };

      // Remove properties with null or undefined values
      Object.keys(data).forEach(key => data[key] == null && delete data[key]);

      fetch('/parent/update/'+parent_id, {
        method: 'PUT', // Use the POST method
        headers: {
          'Content-Type': 'application/json' // Set the content type to JSON
        },
        body: JSON.stringify(data) // Convert the data object to a JSON string
      })
        .then(response => response.json())
        .then(data => {
          // Handle the response from the server
            console.log("Parent Information Successfully being updated ", data);
            document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'block';
            document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'none';

            setTimeout(function() {
                window.location.href = '/studentManagement';
            }, 2000); // 4000 milliseconds = 4 seconds

        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });

    }
  </script>

    <script>
        function fetchDetails(student_id)
        {
          console.log('jkhfjdksfjkddh',student_id);

            const data = 
            {
              id: student_id,
            };

            fetch(`/Student/findStudent`,
            {
                method: 'POST', // Use the POST method
                headers: 
                {
                'Content-Type': 'application/json' // Set the content type to JSON
                },
                body: JSON.stringify(data) // Convert the data object to a JSON string
            })
            .then(response => response.json())
            .then(data => 
            {

              console.log("Successfully Retrieving Data", data);
           
              updateDetails(data);

            })
            .catch(error => {
              console.error('Error fetching data:', error);
            });
        }

        function updateDetails(data)
        {

            // Access the input fields
            const student_name = document.getElementById('studentName');
            const date_of_birth = document.getElementById('dateOfBirth');
            const type_student = document.getElementById('typeStudent');                
            const parent_name = document.getElementById('parentName');
            const phone_number = document.getElementById('phoneNumber');
            const nickname = document.getElementById('nickName');
            const address = document.getElementById('address');
            

            // Set the values of the input fields
            student_name.value = data.name;
            date_of_birth.value = data.date_of_birth;                
            type_student.value = data.type_student;
            parent_name.value = data.parent_name;
            phone_number.value = data.phone_number;
            nickname.value = data.nickname;
            address.value = data.address;
            parent_id = data.parent_id;
            
        // Other code for updating the table can remain the same...
        }
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function () 
        {
            // Get the questionId from the URL
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const student_id = urlParams.get('id');

            // Now you have the questionId, and you can use it as needed
            console.log('student_id:', student_id);
            // Fetch data when the page loads
            fetchDetails(student_id);
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
            var staffId = storedStaffProfile.staffId;

            fetchUser(staffId);

        });

    </script>

    <script>

        function signOut()
        {

        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };

            // Clear the session storage
        sessionStorage.clear();

        // Redirect to the login page
        window.location.replace('login.html');
        }

    </script>

</body>

</html>
