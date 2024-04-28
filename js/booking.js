document.getElementById('registration-form').addEventListener('submit', function (event) {
    event.preventDefault();
    checkEmailAvailability(function (emailAvailable) {
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

    xhr.onreadystatechange = function () {
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

document.getElementById('phone').addEventListener('input', function (event) {
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
document.getElementById('registration-form').addEventListener('submit', function (event) {
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

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('password').addEventListener('input', function () {
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

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('profile_image').addEventListener('change', function (event) {
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
                setTimeout(function () {
                    fileTypeError.style.display = "none";
                    submitButton.disabled = false;
                }, 2500);
            }

            if (file.size > maxFileSize) {
                fileSizeError.textContent = 'File size exceeds the limit (5 MB).';
                fileSizeError.style.display = 'block';
                fileInput.value = '';
                submitButton.disabled = true;
                setTimeout(function () {
                    fileSizeError.style.display = "none";
                    submitButton.disabled = false;
                }, 2000);
            }
        } else {
            submitButton.disabled = false;
        }
    });
});


document.getElementById('loginForm').addEventListener('submit', function (event) {
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