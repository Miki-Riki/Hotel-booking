<?php include('../components/links.php'); ?>
<?php include('db_adm_conn.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .btn {
            background-color: darkblue;
            border-color: 0;
            color: white;
            font-weight: bold;
            border-radius: .7em;
            padding: .5em;
        }

        .btn:hover {
            background-color: rgb(0, 0, 180);
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 text-center">Admin Login</h1>
        <div class="row my-5">
            <div class="col-md-6 offset-md-3">
                <form id="loginForm" action="admin/login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div id="errorMessage" class="mb-3 text-danger"></div>
                    <button type="submit" class="btn" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('login.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = 'dashboard.php';
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