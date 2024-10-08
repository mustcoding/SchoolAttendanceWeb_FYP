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
      Staff has successfully being saved.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert2" style="display: none;">
      Houston....Staff Already Exist.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert3" style="display: none;">
      Houston....Please select atleast 1 image.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="alert alert-danger alert-dismissible fade show" role="alert4" style="display: none;">
      Houston....Please insert all information needed.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="pagetitle">
      <h1>Add New Staff</h1>
    </div><!-- End Page Title -->


    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Upload Staff Pictures</h5>
          <form class="row g-3 align-items-center" enctype="multipart/form-data">
            <div id="imageContainer" class="mt-3">
                <!-- Display selected images here -->
            </div>
            <div class="col-md-6">
              <label for="validationDefault04" class="form-label">Select Picture</label>
              <div class="input-group">
                <input type="file" class="form-control" id="pictureFiles" name="pictureFiles" onchange="displaySelectedImages(this.files)">
                <button type="button" class="btn btn-primary" onclick="uploadPictures()">Upload</button>
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div class="invalid-feedback">
                  Please select at least one picture.
                </div>
              </div>
            </div>
          </form><!-- Horizontal Form -->
        </div>
      </div>


    <section class="section">
        
      <div class="col-lg-12">

          <div class="card">
              <div class="card-body">
                <h5 class="card-title">Staff Details</h5>
  
                <!-- Custom Styled Validation -->
                <form class="row g-3 needs-validation" novalidate>
                
                  <div class="col-12">
                    <label for="validationCustom02" class="form-label">Staff Name<span style="color: red;"> *</label>
                    <input type="text" class="form-control" id="staffName" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                    <div class="invalid-feedback">
                      Please enter Staff Name!
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Nickname <span style="color: red;"> *</label>
                            <input type="text" class="form-control" id="nickname" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                            <div class="invalid-feedback">
                              Please enter Question Text!
                            </div>
                          </div>
                      <div class="col-md-6">
                        <label for="validationDefault04" class="form-label">Position<span style="color: red;"> *</label>
                        <select class="form-select" id="position" required>
                          <option selected value="TEACHER">TEACHER</option>
                        <option value="ADMINISTRATOR">ADMINISTRATOR</option>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                          </div>
                        <div class="invalid-feedback">
                            Please select your position!
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" onclick="addStaff(
                      event,
                      document.getElementById('staffName').value,
                      document.getElementById('nickname').value, 
                      document.getElementById('position').value,
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
      window.location.href = '/indexAdmin'
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
    function uploadPicture() {
      // Get the input element that holds the selected file
      var inputElement = document.getElementById('pictureFiles');
      
      // Get the selected file
      var file = inputElement.files;
  
      // Check if a file is selected
      if (files) {
        // Create a new FileReader
        var file = files;
        var reader = new FileReader();
  
        // Define the onload event handler
        reader.onload = function (e) {
          // e.target.result contains the base64-encoded string
          var base64String = e.target.result;
  
          // Do something with the base64String, such as sending it to the server
          console.log('Base64-encoded image:', base64String);
        };
  
        // Read the file as Data URL (base64 encoding)
        reader.readAsDataURL(file);
      }
    }
  </script>


  <script>

    function addStaff(event, staffName, nickname, position)
   {

      event.preventDefault();

      if (staffName === '' || nickname === '' || position.trim() === '' )
      {
     
        document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert4"]').style.display = 'block';
        return;
      }

    const password="SMAJU123";
    const image=null;
    const is_Delete="0";

      // Create an object to hold the data you want to send
      const data = {
        name: staffName,
        nickname: nickname,
        username: nickname,
        password: password,
        password_confirmation: password,
        position: position,
        image: "",
        is_Delete:is_Delete
      };

      console.log("Here : ",staffName);
      console.log("Here : ",nickname);
      console.log("Here : ",position);
      console.log("Here : ",data);


     
      // Remove properties with null or undefined values
      Object.keys(data).forEach(key => data[key] == null && delete data[key]);

      fetch('/register', 
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
            document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'none';
            document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'block';
          }
        })
        .then(data => {
          // Handle the response from the server
          console.log("IDDDDDDD: ",data.staff.id);
          saveImages(data.staff.id);

        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });

    }
  </script>

<script>
  function saveImages(staffId) {
    var inputElement = document.getElementById('pictureFiles');
    var staffId = staffId;
    var files = inputElement.files;

    if (files.length > 0) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = new Image();
                img.src = e.target.result;

                img.onload = function () {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');

                    // Calculate new dimensions while maintaining aspect ratio
                    var maxWidth = 800; // Set maximum width
                    var maxHeight = 600; // Set maximum height
                    var width = img.width;
                    var height = img.height;

                    if (width > height) {
                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }
                    } else {
                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }
                    }

                    // Set canvas dimensions
                    canvas.width = width;
                    canvas.height = height;

                    // Draw image on canvas
                    ctx.drawImage(img, 0, 0, width, height);

                    // Get compressed data URL
                    var compressedBase64 = canvas.toDataURL('image/jpeg', 0.5); // Adjust quality as needed

                    // Send compressed image data to the server
                    sendImagesToServer(staffId, compressedBase64);
                };
            };

            // Read the file as Data URL (base64 encoding)
            reader.readAsDataURL(file);
        }
    } else {
        setTimeout(function () {
            window.location.href = "searchServices.html";
        }, 1000);
    }
  }


  function sendImagesToServer(staffId, compressedBase64) {

    var isSaved=false;
    // Create an object to hold the data you want to send
    const data = {
      id: staffId,
      image: compressedBase64,
    };

    console.log("Image: FF: ",compressedBase64);

    fetch('/admin/image/'+staffId, {
      method: 'PUT', // Use the POST method
      headers: {
        'Content-Type': 'application/json', // Set the content type to JSON
      },
      body: JSON.stringify(data), // Convert the data object to a JSON string
    })
    .then(response => response.json())
    .then(data => {
      isSaved=true;
      // Handle the response from the server
      console.log('Images successfully saved:', data);

      if(isSaved){
        document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'block';
        document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'none';
        setTimeout(function () {
          window.location.href = "/indexAdmin";
        }, 1000);
      }
    })
    .catch(error => {
      console.error('Error saving images:', error);
      document.querySelector('.alert.alert-success.alert-dismissible.fade.show[role="alert1"]').style.display = 'block';
        document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'none';
        setTimeout(function () {
          window.location.href = "/indexAdmin";
        }, 1000);
    });
  }
</script>

  
<script>
  function displaySelectedImages(files) {
    // Get the container element
    var imageContainer = document.getElementById('imageContainer');
  
    // Clear previous content
    imageContainer.innerHTML = '';
  
    // Iterate through each selected file
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
  
      // Create a new FileReader
      var reader = new FileReader();
  
      // Define the onload event handler
      reader.onload = function (e) {
        // e.target.result contains the base64-encoded string
        var base64String = e.target.result;
  
        // Create an image element
        var img = document.createElement('img');
        img.src = base64String;
        img.alt = 'Selected Image';
  
        // Set styles if needed
        img.style.width = '300px';
        img.style.height = '200px';
        img.style.marginRight = '20px'; // Add margin-right for spacing
        img.style.marginTop = '20px';
  
        // Append the image to the container
        imageContainer.appendChild(img);
      };
  
      // Read the file as Data URL (base64 encoding)
      reader.readAsDataURL(file);
    }
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
