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
      label[for="businessDescription"]:required::before {
        content: '* ';
        color: red;
      }
    </style>

    <div class="d-flex align-items-center justify-content-between">
      <a href="http://127.0.0.1:8000/indexAdmin" class="logo d-flex align-items-center">
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
              <a class="dropdown-item d-flex align-items-center" href="http://127.0.0.1:8000/adminProfile" id="userProfileLink">
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
        <a class="nav-link " href="http://127.0.0.1:8000/indexAdmin">
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
          <a href="http://127.0.0.1:8000/studentManagement">
            <i class="bi bi-circle"></i><span>STUDENT</span>
          </a>
        </li>
        <li>
            <a href="http://127.0.0.1:8000/staffManagement">
              <i class="bi bi-circle"></i><span>STAFF</span>
            </a>
          </li>
          <li>
            <a href="http://127.0.0.1:8000/classroomManagement">
              <i class="bi bi-circle"></i><span>CLASS</span>
            </a>
          </li>
          <li>
            <a href="http://127.0.0.1:8000/attendanceTimetableManagement">
              <i class="bi bi-circle"></i><span>ATTENDANCE TIMETABLE</span>
            </a>
          </li>
          <li>
            <a href="{{route('Student-In-Class')}}">
              <i class="bi bi-circle"></i><span>CLASSROOM BY SESSION</span>
            </a>
          </li>
          <li>
            <a href="http://127.0.0.1:8000/schoolSessionManagement">
              <i class="bi bi-circle"></i><span>SCHOOL SESSION</span>
            </a>
          </li>
          <li>
             <a href="http://127.0.0.1:8000/activityOccurrenceManagement">
              <i class="bi bi-circle"></i><span>ACTIVITY OCCURRENCES </span>
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
            <a href="http://127.0.0.1:8000/AttendanceRecordManagement">
                <i class="bi bi-circle"></i><span>RECORD ATTENDANCE</span>
            </a>
        </li>
        <li>
          <a href="{{route('attend-to-school')}}">
            <i class="bi bi-circle"></i><span>LIST ATTENDANCE</span>
          </a>
        </li>
      
      </ul>
    </li><!-- End Components Nav -->
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="alert alert-success alert-dismissible fade show" role="alert1" style="display: none;">
      School Session has successfully being saved.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert2" style="display: none;">
      Houston....No available student found or all students are already assigned to class..
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert3" style="display: none;">
        Houston....Please Insert Information Needed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="pagetitle">
      <h1>Add New School Session</h1>
    </div><!-- End Page Title -->

    <div class="text-center">
        <button type="button" class="btn btn-primary" onclick="checkSchoolSession(value)">Next</button>
        <button type="button" class="btn btn-secondary" onclick="returnToIndex()">Cancel</button>
    </div>

    
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

        function returnToIndex(){
        window.open("{{route('indexAdmin')}}",'_self');
        }
    </script>

    <script>
        function checkSchoolSession()
        {
            
            console.log("saveSchoolSession function called."); // Debugging statement
            var SchoolSessionClass = JSON.parse(sessionStorage.getItem('SchoolSessionClass'));
            schoolSessionId=SchoolSessionClass.schoolSessionId,
            classroomId=SchoolSessionClass.classroomId,
            staffId=SchoolSessionClass.staffId,

            saveSchoolSession(schoolSessionId, classroomId, staffId);
        
        }
    </script>
    <script>
        function saveSchoolSession(schoolSessionId, classroomId, staffId){

            console.log("fff: ",schoolSessionId);
            console.log("fff: ",classroomId);
            console.log("fff: ",staffId);

            var is_Delete=0;

            const data={
                school_session_id:schoolSessionId,
                class_id:classroomId,
                staff_id:staffId,
                is_Delete:is_Delete
            };

            fetch('http://127.0.0.1:8000/SchoolSessionClass/add', 
            {
                    method: 'POST', // Use the POST method
                    headers: {
                    'Content-Type': 'application/json' // Set the content type to JSON
                    },
                    body: JSON.stringify(data) // Convert the data object to a JSON string
            })
            .then(response => 
            {
                if (response.ok)
                {
                    return response.json();
                }
                else{
                    document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'none';
                    document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'block';
                        
                   setTimeout(function() 
                   {
                        window.location.href = 'http://127.0.0.1:8000/add-classroom-by-session';
                    }, 2000);
                }
            })
            .then(data => {
                        
                var id = data.attendance.id;
                console.log("new School session id: ",id);
                saveStudentInClass(id);

            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }
    </script>

<script>
    function saveStudentInClass(id) {
        // Retrieve selected student IDs
        var selectedStudentIds = getSelectedStudentIds();

        console.log("jkgnkfgnkngf: ", selectedStudentIds);

        // Iterate over each selected student ID
        selectedStudentIds.forEach(function(studentId) {
            console.log("kjgk: ", studentId);
            proceedSave(id,studentId);
            
        });
    }
</script>

<script>
    function proceedSave(id,studentId){

      var is_Delete=0;
        const data = {
            ssc_id: id,
            student_id: studentId,
            is_Delete:is_Delete
        };

        fetch('http://127.0.0.1:8000/StudentStudySession/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
                document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'block';
                document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'none';

                setTimeout(function() {
                window.location.href = 'http://127.0.0.1:8000/indexAdmin';
            }, 2000); // 4000 milliseconds = 4 seconds
        })
        .catch(error => {
            console.error('Error during fetch:', error);
        });
    }
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
      
      var SchoolSessionClass = JSON.parse(sessionStorage.getItem('SchoolSessionClass'));
      var max_capacity = SchoolSessionClass.max_capacity;
      var available_size = SchoolSessionClass.available_size;
      var form_number = SchoolSessionClass.form_number;

      console.log("form number: ",form_number);


      fetchUser(staffId);
      fetchStudentByFormNumber(form_number,available_size);
      
      
    });

  </script>

  <script>
    function fetchStudentByFormNumber(form_number, available_size)
    {
        console.log("haiaih")
         // Get the current date
        var currentDate = new Date();
        // Get the current year
        var currentYear = currentDate.getFullYear();
        // Calculate the birth year based on form number
        var birthYear=0;

      
        if(form_number==1){

            birthYear = currentYear - 13;
        
        }
        else if(form_number==2){

            birthYear = currentYear - 14;

        }
        else if(form_number==3){

            birthYear = currentYear - 15;
        
        }
        else if(form_number==4){

           birthYear = currentYear - 16;
 
        }
        else if(form_number==5){

           birthYear = currentYear - 17;
       
        }
        else if(form_number==6){

            birthYear = currentYear - 18;
     
        }

        console.log("GGGG: ",birthYear);
       
        const data = {
            date_of_birth : birthYear,
        };

        fetch('http://127.0.0.1:8000/Student/get-by-birthYear', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {

          if (data.message =="No student found for the given birth year or all students are already in study sessions."){
           
            document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'block';

            setTimeout(function() {
                window.location.href = 'http://127.0.0.1:8000/indexAdmin';
            }, 2000);

          }
            
            generateSelectElement(available_size, data);
        })
        .catch(error => {
            console.error('Error during fetch:', error);
        });

    }
  </script>

<script>

// Define the selectedStudentIds array globally
var selectedStudentIds = [];

function getSelectedStudentIds() {
    return selectedStudentIds;
}

function generateSelectElement(available_size, data) 
{
    var container = document.querySelector('.pagetitle'); // Get the container element where you want to append the select element

    var students = data.students; // Store the list of students

    // Remove the local declaration of selectedStudentIds
    // var selectedStudentIds = []; // Array to store selected student IDs

    // Function to remove a student from the options of all dropdowns except the specified dropdown
    function removeStudentFromOtherDropdowns(studentId, dropdownId) 
    {
        var dropdowns = document.querySelectorAll('.form-select');
        dropdowns.forEach(function(dropdown) {
            if (dropdown.id !== dropdownId) {
                var options = dropdown.querySelectorAll('option');
                options.forEach(function(option) {
                    if (option.value === studentId) {
                        dropdown.removeChild(option); // Remove the option
                    }
                });
            }
        });
    }

    for (var i = 0; i < available_size; i++) {
        // Create the <div> element
        var div = document.createElement('div');
        div.classList.add('col-12');

        // Create the <label> element
        var label = document.createElement('label');
        label.setAttribute('for', 'studentId_' + i);
        label.classList.add('form-label');
        label.textContent = 'Student Name ' + (i + 1);

        // Create the <select> element
        var select = document.createElement('select');
        select.classList.add('form-select');
        select.id = 'studentId_' + i;
        select.required = true;

        // Create the default option
        var defaultOption = document.createElement('option');
        defaultOption.setAttribute('selected', true);
        defaultOption.setAttribute('disabled', true);
        defaultOption.setAttribute('hidden', true);
        defaultOption.textContent = 'Select Student';
        select.appendChild(defaultOption);

        // Generate options based on the data
        students.forEach(function(student) {
            var option = document.createElement('option');
            option.value = student.id; // Assuming student id is used as the value
            option.textContent = student.name; // Assuming student name is used as the text content
            select.appendChild(option);
        });

        // Event listener to handle selection of a student
        select.addEventListener('change', function(event) {
            var selectedStudentId = event.target.value;
            var dropdownId = event.target.id;

            // Update selectedStudentIds array
            if (!selectedStudentIds.includes(selectedStudentId)) {
                 selectedStudentIds.push(selectedStudentId);
            }

            // Remove selected student from other dropdowns
            removeStudentFromOtherDropdowns(selectedStudentId, dropdownId);
        });

        // Append the elements to the container
        div.appendChild(label);
        div.appendChild(select);
        container.appendChild(div);
    }

    // Create the save button
    // var saveButton = document.createElement('button');
    // saveButton.setAttribute('type', 'button');
    // saveButton.classList.add('btn', 'btn-primary');
    // saveButton.textContent = 'Save';
    // saveButton.onclick = checkSchoolSession; // Assign the onclick event handler to the saveSchoolSession function
    // container.appendChild(saveButton);

}
</script>
<script>

  function signOut()
  {
    const data={};

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
