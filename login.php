<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script defer src="js/booking.js"></script>
</head>
<style>
    .modal .login {
        background-color: darkblue;
        color: white;
        font-weight: bold;
        margin-left: -.5em;
    }

    .modal .login:hover {
        background-color: rgb(0, 0, 180);
    }

    .modal .register {
        background-color: darkblue;
        color: white;
        font-weight: bold;
        margin-left: -.5em;
    }

    .modal .register:hover {
        background-color: rgb(0, 0, 180);
    }

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

<body>

    <!-- Registration Form -->

    <div class="modal fade modal-dialog modal-dialog-centered modal-lg sticky" id="RegisterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-add mx-2"></i>Registration</h1>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
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

    <div id="LoginModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-person-circle mx-2"></i>Login</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <button type="submit" class="btn login float-start m-3">Login</button>
                        <span class="float-end mt-4 text-secondary me-3">Don't have an account?<a href="#RegisterModal" data-bs-toggle="modal"> Sign up</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        var LoginModal = new bootstrap.Modal(document.getElementById('LoginModal'), {
            keyboard: false,
            backdrop: 'static'
        });

        // Add event listener for close button click event for LoginModal
        var loginCloseButton = document.querySelector('#LoginModal .btn-close');
        loginCloseButton.addEventListener('click', function() {
            window.location.href = 'index.php';
        });

        var RegisterModal = new bootstrap.Modal(document.getElementById('RegisterModal'), {
            keyboard: false,
            backdrop: 'static'
        });

        // Add event listener for close button click event for RegisterModal
        var registerCloseButton = document.querySelector('#RegisterModal .btn-close');
        registerCloseButton.addEventListener('click', function() {
            window.location.href = 'index.php';
        });

        LoginModal.show();
    </script>
</body>

</html>