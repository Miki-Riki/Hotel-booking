<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .asterix {
      color: red;
      margin-left: 2px;
    }

    .error-message {
      color: red;
      margin-top: 2px;
    }

    form .gender :hover {
      cursor: pointer;
    }
  </style>
</head>

<body>
  <nav id="mainNavbar" class="navbar sticky-top navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <div class="logo">
        <a class="navbar-brand" href="/hoteli/index.php">
          <img src="logo/logo.png"></a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#about_us">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact_us">Contact</a>
          </li>
        </ul>
        <div class="menu">
          <?php
          include('database/db_connection.php');
          session_start();

          if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT * FROM users WHERE id = $user_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $profile_image = $row["profile_image"];
              $default_image_path = "images/user.png";
              $uploaded_image_directory = "images/";

              if (!empty($profile_image) && file_exists($uploaded_image_directory . $profile_image)) {
                $imagePath = $uploaded_image_directory . $profile_image;
              } else {
                $imagePath = $default_image_path;
              }
              echo '<div class="menu">';
              echo '<div class="dropdown">';
              echo '<img id="profile-pic" src="' . $imagePath . '" alt="Profile Image" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
              echo '<ul class="dropdown-menu">';
              echo '<li><a class="dropdown-item" href="users/user_profile.php">Profile</a></li>';
              echo '<li><hr class="dropdown-divider"></li>';
              echo '<li><a class="dropdown-item" href="users/logout.php">Logout</a></li>';
              echo '</ul>';
              echo '</div>';
              echo '</div>';
            } else {
              echo "No user data found.";
            }
          } else {
          ?>
            <button type="button" class="btn me-1 r_l_btn" data-bs-toggle="modal" data-bs-target="#RegisterModal">
              Register
            </button>
            <button type="button" class="btn r_l_btn" data-bs-toggle="modal" data-bs-target="#LoginModal">
              Login
            </button>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Registration Form -->

  <div class="modal fade modal-dialog modal-dialog-centered modal-lg sticky" id="RegisterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-add mx-2"></i>Registration</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="registration-form" method="POST" action="users/registration.php" enctype="multipart/form-data">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label for="first_name" class="form-label">First name<span class="asterix">*</span></label>
                  <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label for="last_name" class="form-label">Last name<span class="asterix">*</span></label>
                  <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label for="email" class="form-label">Email<span class="asterix">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required>
                  <div id="email-error-message" style="color: red;"></div>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label for="phone" class="form-label">Phone<span class="asterix">*</span></label>
                  <input type="tel" class="form-control" id="phone" name="phone" required>
                  <div id="phoneError" class="error-message"></div>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label for="password" class="form-label">Password<span class="asterix">*</span></label>
                  <input type="password" class="form-control" id="password" name="password" required>
                  <div id="password-error" class="error-message"></div>
                </div>
                <div class="col-md-6 ps-0 mb-3">
                  <label for="profile_image" class="form-label">Upload image</label>
                  <input class="form-control" type="file" id="profile_image" name="profile_image">
                  <div id="fileTypeError" style="display: none; color: red;">
                  </div>
                  <div id="fileSizeError" style="display: none; color: red;"></div>
                </div>
                <label class="label_gender">Gender<span class="asterix">*</span></label>
                <div class="mb-3 d-flex">
                  <div class="form-check gender">
                    <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Male" required>
                    <label class="form-check-label" for="maleGender">
                      Male
                    </label>
                  </div>
                  <div class="form-check mx-2 gender">
                    <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female" required>
                    <label class="form-check-label" for="femaleGender">
                      Female
                  </div>
                  </label>
                </div>
                <div class="text-center my-1">
                  <button type="submit" id="submit-button" class="btn register float-start">Register now</button>
                  <span class="float-end mt-2 me-2 text-secondary">Already have an account?<a href="#LoginModal" data-bs-toggle="modal"> Sign in</a></span>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Login Form -->

  <div id="LoginModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="bi bi-person-circle mx-2"></i>Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="loginForm" action="users/login.php" method="POST">
          <div class="modal-body">
            <div class="mb-3">
              <label for="loginEmail" class="form-label">Email address</label>
              <input type="email" class="form-control" id="loginEmail" name="email" required>
            </div>
            <div class="mb-3">
              <label for="loginPassword" class="form-label">Password</label>
              <input type="password" class="form-control" id="loginPassword" name="password" required>
            </div>
            <div id="errorMessage" class="text-danger"></div>
          </div>
          <div class="text-center my-1">
            <button type="submit" class="btn btn-primary float-start m-3">Login</button>
            <span class="float-end mt-4 text-secondary me-3">Don't have an account?<a href="#RegisterModal" data-bs-toggle="modal"> Sign up</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('registration-form').addEventListener('submit', function(event) {
      event.preventDefault();
      checkEmailAvailability(function(emailAvailable) {
        if (emailAvailable) {
          document.getElementById('registration-form').submit();
        }
      });
    });

    document.getElementById('email').addEventListener('input', checkEmailAvailability);
    function checkEmailAvailability(callback) {
      var email = document.getElementById('email').value;

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'users/check_email.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

      xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
          var response = JSON.parse(xhr.responseText);

          if (response.status === 'error') {
            document.getElementById('email-error-message').innerText = response.message;
            document.getElementById('email').classList.add('is-invalid');
            document.getElementById('submit-button').disabled = true;
            callback(false);
          } else {
            document.getElementById('email-error-message').innerText = '';
            document.getElementById('email').classList.remove('is-invalid');
            document.getElementById('submit-button').disabled = false;
            callback(true);
          }
        }
      };

      xhr.send('email=' + email);
    }


    /* Phone validation */

    document.getElementById('phone').addEventListener('input', function(event) {
      let inputValue = event.target.value;
      let phoneInput = document.getElementById('phone');

      let nonNumericRegex = /[^0-9]/g;

      if (nonNumericRegex.test(inputValue)) {
        document.getElementById('phoneError').textContent = 'Phone number should contain only numbers.';

        phoneInput.classList.add('is-invalid');
        event.target.classList.add('error-input');
        document.getElementById('submit-button').disabled = true;
      } else {
        document.getElementById('phoneError').textContent = '';
        phoneInput.classList.remove('is-invalid');
        event.target.classList.remove('error-input');
        document.getElementById('submit-button').disabled = false;
      }
    });
    document.getElementById('registration-form').addEventListener('submit', function(event) {
      let phoneInputValue = document.getElementById('phone').value;
      let nonNumericRegex = /[^0-9]/g;
      if (nonNumericRegex.test(phoneInputValue)) {
        document.getElementById('phoneError').textContent = 'Phone number should contain only numbers.';
        document.getElementById('phone').classList.add('error-input');
        document.getElementById('submit-button').disabled = true;
        event.preventDefault();
      }
    });


    /* Password Check */

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('password').addEventListener('input', function() {
        var password = this.value;
        var passwordError = document.getElementById('password-error');
        if (password.length === 0) {
          passwordError.textContent = '';
          passwordError.style.display = 'none';
          document.getElementById('submit-button').disabled = true;
        } else if (password.length < 8) {
          passwordError.textContent = 'Password must be at least 8 characters long.';
          passwordError.style.display = 'block';
          document.getElementById('submit-button').disabled = true;
        } else {
          passwordError.textContent = '';
          passwordError.style.display = 'none';
          document.getElementById('submit-button').disabled = false;
        }
      });
    });

    /* File Check */
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('profile_image').addEventListener('change', function(event) {
        var fileInput = event.target;
        var fileTypeError = document.getElementById('fileTypeError');
        var fileSizeError = document.getElementById('fileSizeError');
        var submitButton = document.getElementById('submit-button');

        fileTypeError.style.display = 'none';
        fileSizeError.style.display = 'none';

        if (fileInput.files.length > 0) {
          var file = fileInput.files[0];
          var allowedImageTypes = ['image/jpeg', 'image/png'];
          var maxFileSize = 5 * 1024 * 1024; 

          if (!allowedImageTypes.includes(file.type)) {
            fileTypeError.textContent = 'Invalid file type. Please upload a JPEG or a PNG file.';
            fileTypeError.style.display = 'block';
            fileInput.value = '';
            submitButton.disabled = true;
            setTimeout(function() {
              fileTypeError.style.display = "none";
              submitButton.disabled = false;
            }, 2500);
          }

          if (file.size > maxFileSize) {
            fileSizeError.textContent = 'File size exceeds the limit (5 MB).';
            fileSizeError.style.display = 'block';
            fileInput.value = '';
            submitButton.disabled = true;
            setTimeout(function() {
              fileSizeError.style.display = "none";
              submitButton.disabled = false;
            }, 2000);
          }
        } else {
          submitButton.disabled = false;
        }
      });
    });
  </script>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      event.preventDefault(); 

      const formData = new FormData(this);

      fetch('users/login.php', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (response.ok) {
            window.location.href = 'users/user_profile.php';
          } else {
            return response.text();
          }
        })
        .then(errorMessage => {
          if (errorMessage) {
            console.error('Login failed:', errorMessage);
            document.getElementById('errorMessage').textContent = errorMessage;
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });
  </script>
</body>

</html>