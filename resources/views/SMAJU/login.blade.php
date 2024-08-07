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
  <link href="SMAJU/assets/css/style.css" rel="stylesheet">

  <style>
    body, html {
      height: 100%;
      margin: 0;
    }

    .background-container {
      background-color:#98AFC7;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100%;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
    }

    .content-container {
      position: relative;
      z-index: 1;
    }

    .logo-img {
      width: 60px; /* Adjust the size as needed */
      height: auto; /* Maintain aspect ratio */
      margin-right: 10px; /* Space between the logo and the text */
    }
  </style>
</head>

<body>
  <div class="background-container"></div>

  <main class="content-container">
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <style>
                .logo img {
                  border-radius: 100%; /* Set border-radius to 50% for a circular or oval shape */
                }
              </style>

              <div class="alert alert-danger alert-dismissible fade show" role="alert2" style="display: none;">
                Houston....Email or Password Wrong !!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

              <div class="card mb-3">

                <div class="card-body">

                <div class="pt-4 pb-2">
                  <div class="d-flex align-items-center justify-content-center">
                    <img src="assets/img/SMAJU.png" alt="Logo" class="logo-img">
                    <div>
                      <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                      <p class="text-center small">SMA JAWAHIR AL-ULUM ATTENDANCE SYSTEM</p>
                    </div>
                  </div>
                </div>

                <form class="row g-3 needs-validation" method="post" action="melakago_php/appUserCheckExistence.php" novalidate>

                    <div class="col-12">
                      <label for="Username" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" id="username" required>
                        <div class="invalid-feedback">Please enter your Email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="Password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" id="loginBtn">Login</button>
                    </div>
                    
                    <div class="col-12">
                        <p class="small mb-0">Forget Your Password? <a href="forgetpassword.html">Reset Password</a></p>
                      </div>
                    
                </form>

                </div>
              </div>

              <div class="credits">
                Designed by <a>SMAJU</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

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
    // Wait for the DOM to be loaded
    document.addEventListener('DOMContentLoaded', function () {
      // Get the login button
      const loginBtn = document.getElementById('loginBtn');

      // Add click event listener to the login button
      loginBtn.addEventListener('click', function (event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get the email and password input values
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Call the Login function with email and password
        Login(username, password);
      });
    });

    function Login(username, password) {
      const data = {
        username: username,
        password: password
      };

      fetch('{{route('login')}}', {
          method: 'POST', // Use the POST method
          headers: {
            'Content-Type': 'application/json' // Set the content type to JSON
          },
          body: JSON.stringify(data) // Convert the data object to a JSON string
      })
      .then(response => response.json())
      .then(response => {
        // Handle the response from the server
        console.log('Response:', response);

        var staffProfile = {
          staffId: response.staff.id,
          staffName: response.staff.name,
          email: response.staff.email,
          password: response.staff.password,
          position: response.staff.position,
          nickname: response.staff.nickname,
          image: response.staff.image,
          position:response.staff.position,
        };

        var token = response.token;

        sessionStorage.setItem('staffProfile', JSON.stringify(staffProfile));
        sessionStorage.setItem('token', JSON.stringify(token));

        console.log(sessionStorage);

        if (response.staff.hasOwnProperty('id')) {
          console.log("kbghjbjhg: ",response.staff.id);
          if (response.staff.position == "TEACHER") {
            window.location.href = '{{route('indexTeacher')}}';
          } else if (response.staff.position == "ADMINISTRATOR") {
            window.location.href = '{{route('indexAdmin')}}';
          }
        } else {
          document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'block';
        }
      })
      .catch(error => {
        console.error('Error fetching data:', error);
        document.querySelector('.alert.alert-danger.alert-dismissible.fade.show[role="alert2"]').style.display = 'block';
      });
    }
  </script>
</body>

</html>