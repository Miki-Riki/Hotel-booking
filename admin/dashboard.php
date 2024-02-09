<?php include('../components/links.php'); ?>
<?php include('db_adm_conn.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script defer src="index.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="container">
        <h1 class="text-align">Admin Dashboard</h1>
        <p>Welcome to the admin dashboard. You can manage users here.</p>

        <!-- Users Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../database/db_connection.php';

                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $count = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$count}</td>";
                        echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['gender']}</td>";
                        echo "<td>
                        <button class='btn btn-sm btn-danger' onclick='deleteUser({$row['id']})'>Delete</button>
                        <button class='btn btn-sm btn-primary' onclick='editUser({$row['id']}, \"{$row['first_name']}\", \"{$row['last_name']}\", \"{$row['email']}\")'>Edit</button>
                      </td>";
                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
    <div class="logout-container position-absolute top-0 end-0 p-3">
        <form action="logout.php" method="POST">
            <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        </form>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" onclick="closeEditModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="POST" action="edit_user.php">
                        <input type="hidden" id="user_id" name="user_id">

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name">
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
</body>

</html>