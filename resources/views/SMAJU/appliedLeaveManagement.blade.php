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
              <span>SCHOOL ADMINISTRATOR</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/adminProfile" id="userProfileLink">
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
      <h1>Applied Leave Management</h1>
    </div><!-- End Page Title -->

    <div class="alert alert-success alert-dismissible fade show" role="alert1" style="display: none;">
      Here is the student you were searching for.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert2" style="display: none;">
      Houston... we can't find the student you search.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-success alert-dismissible fade show" role="delete" style="display: none;">
      Student Successfully Being Deleted.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Search Student</h5>
    
            <form class="row g-3 align-items-center">
              <div class="col-md-6">
                  <div class="input-group">
                      <input type="text" class="form-control me-2" id="services" placeholder="Enter Student name @ Class">
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
              </h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Parent Name</th>
                    <th scope="col">Class Name</th>
                    <th scope="col">Classroom Teacher</th>
                    <th scope="col">Start Date Of Leave</th>
                    <th scope="col">End Date Of Leave</th>
                    <th scope="col">Supporting Document</th>
                    <th scope="col">Action</th>
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

    function displayAddServicesPage(){
      window.open('tourismserviceadd.html','_self');
    }

  
    // Function to fetch data from the server
    function fetchData() {
      fetch('/ADS/applied-leave')
        .then(response => response.json())
        .then(data => {
          // Call a function to update the table with the fetched data
          updateTable(data);
        })
        .catch(error => {
          console.error('Error fetching data:', error);
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
                      <td>${item.student_name}</td>
                      <td>${item.parent_name}</td>
                      <td>${item.form_number} ${item.class_name}</td>
                      <td>${item.teacher_name}</td>
                      <td>${item.start_date_leave}</td>
                      <td>${item.end_date_leave}</td>
                    <td><a href="absentiesDocument?document_path=${item.document_path}" onclick="viewDocument('${item.document_path}')">View Document</a></td>
                      <td>
                        <div class="button-column">
                          <button type="button" class="btn btn-primary" onclick="approveLeave(${item.student_study_session_id}, '${item.start_date_leave}', '${item.end_date_leave}',${item.absent_supporting_document_id},'${item.username}')">APPROVE</button>
                          <button type="button" class="btn btn-danger" onclick="deleteStudent(${item.student_id})">Delete </button>
                        </div>
                      </td>
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

        fetchData();
        fetchUser(staffId);
    });


    function searchServices() {
    // Get the search term
    var searchTerm = document.getElementById('services').value.toLowerCase();
    console.log('KEYWORD:',searchTerm);

    // Get all rows in the table
    var rows = document.querySelectorAll('table tbody tr');

    var studentFound = false;

    // Loop through each row and hide/show based on the search term
    rows.forEach(function (row) {
        // Update the selector to target the correct cell (company name)
        var studentName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        var parentName = row.querySelector('td:nth-child(6)').textContent.toLowerCase();

        // Convert both the company name and the search term to lowercase for comparison
        if (studentName.includes(searchTerm) || parentName.includes(searchTerm)) {
            row.style.display = 'table-row';
            studentFound = true;
        } else {
            row.style.display = 'none';
        }
    });

    if(studentFound){
      document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'block';
      document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'none';
    }
    else{
      document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'none';
      document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'block';
    }
  }


  function deleteStudent(student_id)
  {
    var is_Delete=1;
    //Create an object to hold the data you want to send
    const data = {
      id : student_id,
      is_Delete:is_Delete,
    };

    fetch('/Student/delete/'+student_id, {
            method: 'PUT', // Use the POST method
            headers: {
            'Content-Type': 'application/json' // Set the content type to JSON
            },
            body: JSON.stringify(data) // Convert the data object to a JSON string
    })
      .then(response => response.json())
      .then(data => {
            // Handle the response from the server
            console.log("Student Successfully deleted ", data);
            deleteCardRFID(data);
            deleteTagRFID(data);
            deleteStudentStudySession(data);
            
        })
      .catch(error => {
            console.error('Error fetching data:', error);
      });
        
    }
    
  </script>
  <script>
    function toggleAlert(role, shouldDisplay) {
      var alertElement = document.querySelector(`.alert[role="${role}"]`);
      if (alertElement) {
        alertElement.style.display = shouldDisplay ? 'block' : 'none';
      }
    }
  </script>

  <script>
    function deleteCardRFID(studentdata)
    {
      var is_Delete=1;
      //Create an object to hold the data you want to send
      const data = {
        id : studentdata.student.card_rfid,
        is_Delete:is_Delete,
      };

      fetch('/rfid/delete/'+studentdata.student.card_rfid, {
        method: 'PUT', // Use the POST method
        headers: {
          'Content-Type': 'application/json' // Set the content type to JSON
        },
        body: JSON.stringify(data) // Convert the data object to a JSON string
      })
      .then(response => response.json())
      .then(data => {
        // Handle the response from the server
        console.log("RFID Successfully deleted ", data);
              
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
          
    }

    function deleteTagRFID(studentdata)
    {
      var is_Delete=1;
      //Create an object to hold the data you want to send
      const data = {
        id : studentdata.student.tag_rfid,
        is_Delete:is_Delete,
      };

      fetch('/rfid/delete/'+studentdata.student.tag_rfid, {
              method: 'PUT', // Use the POST method
              headers: {
              'Content-Type': 'application/json' // Set the content type to JSON
              },
              body: JSON.stringify(data) // Convert the data object to a JSON string
      })
      .then(response => response.json())
      .then(data => {
        // Handle the response from the server
        console.log("RFID Successfully deleted ", data);
        
              
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
          
    }

    function deleteStudentStudySession(studentdata)
    {

      var is_Delete=1;
      //Create an object to hold the data you want to send
      const data = {
        student_id : studentdata.student.id,
        is_Delete:is_Delete,
      };

      fetch('/StudentStudySession/delete', {
        method: 'PUT', // Use the POST method
        headers: {
          'Content-Type': 'application/json' // Set the content type to JSON
        },
        body: JSON.stringify(data) // Convert the data object to a JSON string
      })
      .then(response => response.json())
      .then(data => {
        // Handle the response from the server
        console.log("Student Seccessfully Being Deleted ", data);

        toggleAlert('delete', true);

        setTimeout(function() {
          window.location.href = "/studentManagement";
        }, 2000);
        
              
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
          
    }
    
  </script>

  <script>
    function viewDocument(document_path){
     // Get the tourismServiceId from the URL
    
     sessionStorage.setItem('document', JSON.stringify(document_path));
     window.open(`absentiesDocument`,'_self');

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


<script>
  // Helper function to format the date
  function formatDate(dateString) {
      const date = new Date(dateString);
      if (isNaN(date.getTime())) {
          throw new Error(`Invalid date: ${dateString}`);
      }

      const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based in JavaScript
      const day = String(date.getDate()).padStart(2, '0');
      const year = String(date.getFullYear());

      return `${month}/${day}/${year}`;
  }

  function getCurrentTime() {
  const now = new Date();
  return now.toTimeString().split(' ')[0];
}

// Helper function to get the date range with the specified time
function getDatesInRangeWithTime(startDate, endDate, time) {
  const start = new Date(startDate);
  const end = new Date(endDate);
  const dates = [];

  while (start <= end) {
    // Format date as m/d/y
    const formattedDate = `${('0' + (start.getMonth() + 1)).slice(-2)}/${('0' + start.getDate()).slice(-2)}/${start.getFullYear().toString().slice(-2)}`;
    dates.push(formattedDate);
    start.setDate(start.getDate() + 1);
  }

  return dates;
}


  function approveLeave(student_study_session_id, start_date_leave, end_date_leave, absent_supporting_document_id, username) {
      try {
        
        const time = getCurrentTime();
        const datesInRange = getDatesInRangeWithTime(start_date_leave, end_date_leave, time);
        console.log("Dates with Time:");
        datesInRange.forEach(date => 
        {
          console.log(`${date} ${time}`);
          //Create an object to hold the data you want to send

          const data = {
            date_time_in : date +' '+time,
            is_attend:2,
            checkpoint_id : 1,
            student_study_session_id: student_study_session_id,
          };

          fetch('/Attendance/recordAttendanceLeave', {
            method: 'POST', // Use the POST method
            headers: {
              'Content-Type': 'application/json' // Set the content type to JSON
            },
            body: JSON.stringify(data) // Convert the data object to a JSON string
          })
          .then(response => response.json())
          .then(data => {
            // Handle the response from the server
            if(data.message == 'Attendance recorded successfully'){
              sendNotification(username, start_date_leave, end_date_leave);
            }
            else{
              console.log("ERROR")
            }
                    
          })
          .catch(error => {
            console.error('Error fetching data:', error);
          });
  
        });

        updateStatus(absent_supporting_document_id);


      } catch (error) {
        console.error(error.message);
      }
  }

  function updateStatus(absent_supporting_document_id){
    const ads={
      id: absent_supporting_document_id,
    };

    fetch('/ADS/updateStatus', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(ads)
    })
    .then(response => response.json())
    .then(data => {
      console.log('Response:', data);
                  
      setTimeout(function() {
        window.location.href = "/applied-leave-management";
      }, 2000);
                    
    })
    .catch(error => {
      console.error('Error during fetch:', error);
    });
  }

  function sendNotification(username, start_date_leave, end_date_leave) {
    const notificationData = {
        app_id: "78f2e497-f306-4a96-9f47-c0ae59591675",
        include_external_user_ids: [username],  // Use the username parameter here
        headings: {
            "en": "SMAJU Attendance System"
        },
        contents: {
            "en": "Your Application For Leave Being Approved Starting  " + start_date_leave+" until "+ end_date_leave// Custom message with username
        }
    };

    fetch('https://onesignal.com/api/v1/notifications', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'accept': 'application/json',
            'Authorization': 'Basic OGMxODYyZmMtODllYS00MjYzLThkMzctODQzMTIyZDllZTkw'
        },
        body: JSON.stringify(notificationData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response:', data);

        setTimeout(function() {
            window.location.href = "/applied-leave-management";
        }, 2000);

    })
    .catch(error => {
        console.error('Error during fetch:', error);
    });
}

</script>

</body>

</html>
