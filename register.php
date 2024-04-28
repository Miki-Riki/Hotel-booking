<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
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
</body>

</html>