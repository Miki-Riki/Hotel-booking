<?php
include('../components/links.php');
include('db_adm_conn.php');
?>

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
    <?php

    include '../database/db_connection.php';

    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand"><i class="bi bi-person-square"></i> Dashboard</a>
            <form action="logout.php" method="POST">
                <button type="submit" class="btn btn-danger d-none d-sm-block" name="logout">Logout</button>
                <button type="submit" class="btn btn-danger d-sm-none" name="logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>

        </div>
    </nav>

    <div class="container">
        <h1 class="text-align">Admin Dashboard</h1>

        <div class="row users">
            <div class="col-md-2 m-1 registered">
                <p><span id="total-users" class="badge"><?php echo $result->num_rows; ?></span></p>
                <small>Registered</small>
            </div>
            <div class="col-md-2 m-1 registered">
                <p><span id="satisfied-users" class="badge" data-target="1034"></span></p>
                <small>Satisfied</small>
            </div>
            <div class="col-md-2 m-1 registered">
                <p><span id="visited-users" class="badge" data-target="7867"></span></p>
                <small>Visited</small>
            </div>
        </div>

        <h2 class="mt-5 text-center">Manage Users</h2>
        <div class="row mt-3">
            <?php
            session_start();

            $loggedInUserId = null;

            if (isset($_SESSION['user_id'])) {
                $loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            }

            if ($loggedInUserId) {
                echo "<p class='text-muted text-center'>Note: Currently logged in users cannot be deleted.</p>";
            }
            ?>

            <div class="row mt-3">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $isCurrentUser = ($row['id'] == $loggedInUserId);
                ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card position-relative">
                                <div class="dropdown position-absolute top-0 end-0">
                                    <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <?php
                                        $buttonColorClass = $isCurrentUser ? "text-muted" : "text-danger";
                                        $disabledAttribute = $isCurrentUser ? "disabled" : "";
                                        echo "<li><button class='dropdown-item {$buttonColorClass}' onclick=\"deleteUser({$row['id']}, '{$loggedInUserId}')\" {$disabledAttribute}><i class='bi bi-trash3'></i> Delete</button></li>";
                                        ?>
                                        <li><button class="dropdown-item text-primary" onclick="editUser(<?php echo $row['id']; ?>, '<?php echo $row['first_name']; ?>', '<?php echo $row['last_name']; ?>', '<?php echo $row['email']; ?>')"><i class="bi bi-pencil"></i> Edit</button></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']); ?></h5>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='col alert alert-warning'><p>No users</p></div>";
                }
                ?>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div id="editUserModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close shadow-none" onclick="closeEditModal()" aria-label="Close"></button>
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

                            <button type="submit" class="btn save">Save Changes</button>
                            <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const counters = document.querySelectorAll('.badge');
            const speed = 500;

            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    let count = +counter.innerText;

                    const inc = Math.ceil(target / speed);
                    if (count < target) {
                        if (count + inc > target) {
                            count = target;
                        } else {
                            count += inc;
                        }
                        counter.innerText = count;
                        setTimeout(updateCount, 5);
                    }
                };

                updateCount();
            });
        </script>
</body>

</html>