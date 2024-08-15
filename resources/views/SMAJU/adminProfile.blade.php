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

    <div class="d-flex align-items-center justify-content-between">
      <a href="/indexAdmin" class="logo d-flex align-items-center">
        <img src="assets/img/SMAJU.png" alt="">
        <span class="d-none d-lg-block">School Attendance</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <div class="alert alert-success alert-dismissible fade show" role="alert1" style="display: none;">
          New Password Successfully being saved...
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    
        <div class="alert alert-danger alert-dismissible fade show" role="alert2" style="display: none;">
          Houston... New Password Doesn't Match The Confirmation Password.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    
        <div class="alert alert-danger alert-dismissible fade show" role="alert3" style="display: none;">
          Houston... Your current password is wrong.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="alert alert-danger alert-dismissible fade show" role="changeUnSuccess" style="display: none;">
          Houston... Your New Password Cannot Being Saved.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Hi, User!</h6>
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
              <a class="dropdown-item d-flex align-items-center" href="#" onClick="signOut()">
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
             <a href="{{route('appliedLeaveManagement')}}">
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

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="indexAdmin.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <h2 id="userName"></h2>
              <h3>SCHOOL ADMINISTRATOR</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8" id="fullName"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nick Name</div>
                    <div class="col-lg-9 col-md-8" id="nickName"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Username</div>
                    <div class="col-lg-9 col-md-8" id="username"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Role</div>
                    <div class="col-lg-9 col-md-8">SCHOOL ADMINISTRATOR</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form onsubmit="return confirmEdit(this);">

                    <div id="successMessage" class="alert alert-success" style="display: none;">
                      Profile successfully updated!
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nick Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="editNickName" value="Kevin">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="editUsername" value="">
                      </div>
                    </div>

                    <div class="text-center">
			                <button type="submit" class="btn btn-primary" onClick="confirmEdit(this.form)">Save Changes</button>
                    
		                 </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form onsubmit ="return confirmChangePassword(this);">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newPassword1" type="password" class="form-control" id="newPassword1">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="confirmPassword" type="password" class="form-control" id="confirmPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" onClick="confirmChangePassword(this.form)">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

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

    // Retrieve the JSON string from sessionStorage
    var storedStaffProfile = JSON.parse(sessionStorage.getItem('staffProfile'));
    console.log('User Profile: ', storedStaffProfile);

    function displayAddServicesPage(){
      window.open('tourismserviceadd.html','_self');
    }

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
        username: data.staff.username,
        password: data.staff.password,
        position: data.staff.position,
        nickname: data.staff.nickname,
        image: data.staff.image,
      };

      sessionStorage.setItem('staff', JSON.stringify(EditStaffProfile));
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

    // Update the user's name in the "Profile" card
    var userNameElement = document.getElementById('userName');
    if (userNameElement) {
      userNameElement.textContent = storedStaffProfile.staffName;
    } else {
      console.log('Element with ID "userName" not found.');
    }

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

    // Update the Full Name in the "Profile Overview" section
    var fullNameElement = document.getElementById('fullName');
    if (fullNameElement) {
      fullNameElement.textContent = storedStaffProfile.staffName;
    } else {
      console.log('Element with ID "fullName" not found.');
    }

    // Update the Full Name in the "Profile Overview" section
    var fullNameElement = document.getElementById('nickName');
    if (fullNameElement) {
      fullNameElement.textContent = storedStaffProfile.nickname;
    } else {
      console.log('Element with ID "fullName" not found.');
    }


    // Update the Full Name in the "Profile Overview" section
    var fullNameElement = document.getElementById('username');
    if (fullNameElement) {
      fullNameElement.textContent = storedStaffProfile.username;
    } else {
      console.log('Element with ID "fullName" not found.');
    }

    // Update the Profile Edit Form with data from localStorage
    document.getElementById('editNickName').value = storedStaffProfile.nickname;
    document.getElementById('editUsername').value = storedStaffProfile.username;

    // Construct the profile URL
    var staffId = storedStaffProfile.staffId;

    // Update the href attribute with the appUserId
    var userProfileLink = document.getElementById('userProfileLink');
    if (userProfileLink) {
      userProfileLink.href = "/adminProfile";
    } else {
      console.error('User profile link not found.');
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
    function confirmEdit(form) 
    {
        // Check if the form is defined
        if (!form) {
            console.error('Form is not defined.');
            return false;
        }
        // Retrieve values from the form
        var storedStaffProfile = JSON.parse(sessionStorage.getItem('staffProfile'));
        var staffId = storedStaffProfile.staffId;
        var nickname = form.elements['editNickName'].value;
        var username = form.elements['editUsername'].value;

        // Do something with the values (e.g., display in console for demonstration)

        console.log('ID::: ', staffId)
        console.log('Nick Name:', nickname);
        console.log('Username:', username);

        // Create an object to hold the data you want to send
        const data = {
            id : staffId,
            nickname: nickname,
            username: username,
        };

        fetch('/admin/'+staffId, {
            method: 'PUT',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => {
        
          return response.json();
        })
        .then(data => {
          // Handle successful response
          fetchNewData(staffId);
        })
          .catch(error => {
          console.error('Fetch error:', error);
        });

            // Show the success message
            var successMessageElement = document.getElementById('successMessage');

            successMessageElement.style.display = 'block';

            // 3000 milliseconds = 3 seconds
            if (successMessageElement) {

              setTimeout(function() {
                successMessageElement.style.display = 'none';
              }, 3000);
              
            }
        return false;
    }
  </script>
  <script>

    // Function to fetch data from the server
    function fetchNewData(staffId) {
      const data = {
          staffId : staffId,
      };

      fetch('/user/'+staffId,
      {
            method: 'POST', // Use the POST method
            headers: {
            'Content-Type': 'application/json' // Set the content type to JSON
            },
            body: JSON.stringify(data) // Convert the data object to a JSON string
      })
        .then(response => response.json())
        .then(data => {
            // Call a function to update the table with the fetched data
          var EditStaffProfile = 
          {
            staffId: data.staff.id,
            staffName: data.staff.name,
            username: data.staff.username,
            password: data.staff.password,
            position: data.staff.position,
            nickname: data.staff.nickname,
            image: data.staff.image,
          };

          sessionStorage.setItem('staffEdit', JSON.stringify(EditStaffProfile));
    
          console.log("HERE HOI: ",sessionStorage);
          updateAfterEdit()
            
      })
        .catch(error => {
            console.error('Error fetching data:', error);
      });
      
    }

  </script>

  <script>
    function updateAfterEdit(){
      // Retrieve the JSON string from sessionStorage
    var storedStaffProfile = JSON.parse(sessionStorage.getItem('staffEdit'));
    console.log('User Profile: ', storedStaffProfile);

    // Update the user's name in the "Profile" card
    var userNameElement = document.getElementById('userName');
    if (userNameElement) {
      userNameElement.textContent = storedStaffProfile.staffName;
    } else {
      console.log('Element with ID "userName" not found.');
    }

    // Update user nickname in the profile dropdown
    var profileDropdownHeader = document.querySelector('.dropdown-header h6');
    if (profileDropdownHeader) 
    {
      profileDropdownHeader.textContent = storedStaffProfile.staffName;

    } 
    else 
    {
      console.log('Profile dropdown header not found.');
    }

    var profileDropdownLink = document.querySelector('.nav-link.nav-profile');
    if (profileDropdownLink) {
        
      var profileNameSpan = profileDropdownLink.querySelector('.dropdown-toggle');

      // Update profile name
      if (profileNameSpan) 
      {
       profileNameSpan.textContent = storedStaffProfile.nickname;
      }
            
    } else {
      console.log('Profile dropdown link not found.');
    }

    // Update the Full Name in the "Profile Overview" section
    var fullNameElement = document.getElementById('fullName');
    if (fullNameElement) {
      fullNameElement.textContent = storedStaffProfile.staffName;
    } else {
      console.log('Element with ID "fullName" not found.');
    }

    // Update the Full Name in the "Profile Overview" section
    var fullNameElement = document.getElementById('nickName');
    if (fullNameElement) {
      fullNameElement.textContent = storedStaffProfile.nickname;
    } else {
      console.log('Element with ID "fullName" not found.');
    }

   
    // Update the Full Name in the "Profile Overview" section
    var fullNameElement = document.getElementById('username');
    if (fullNameElement) {
      fullNameElement.textContent = storedStaffProfile.username;
    } else {
      console.log('Element with ID "fullName" not found.');
    }

    // Update the Profile Edit Form with data from localStorage
    document.getElementById('editNickName').value = storedStaffProfile.nickname;
    document.getElementById('editUsername').value = storedStaffProfile.username;

    }
  </script>

<script>
    function confirmChangePassword(form) {
        var passwordSame = form.elements['newPassword1'].value === form.elements['confirmPassword'].value;

        if (!passwordSame) {
            alert("Passwords do not match.");
            return false;
        }

        var storedStaffProfile = JSON.parse(sessionStorage.getItem('staffProfile'));
        var staffId = storedStaffProfile.staffId;
        const currentPassword = form.elements['currentPassword'].value;
        const newPassword = form.elements['confirmPassword'].value;

        var storedToken = JSON.parse(sessionStorage.getItem('token'));
        console.log("TOKEN    : ",storedToken);
        var token = storedToken;

        console.log("staff id : ", staffId);
        console.log("password : ", currentPassword);
        console.log("Latest password : ", newPassword);

        console.log("YOUR TOKEN : ", token);

        fetch('/staff/check-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
            },
            body: JSON.stringify({ staffId, password: currentPassword }),
        })
        .then(response => {
            if (!response.ok) {
                // Handle non-OK responses
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                return fetch('/staff/change-password', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`,
                    },
                    body: JSON.stringify({ staffId, password: newPassword }),
                });
            }
        })
        .then(response => {
            if (!response.ok) {
                // Handle non-OK responses
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
               
                document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'block';
                setTimeout(function() {
                window.location.href = '/adminProfile';
                }, 2000); 
            } else {
              document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="changeUnSuccess"]').style.display = 'block';
                setTimeout(function() {
                window.location.href = '/adminProfile';
                }, 2000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(`Error: ${error.message}`);
        });

        return false;
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