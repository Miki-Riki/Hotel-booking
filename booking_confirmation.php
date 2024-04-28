<?php
session_start();

include 'database/db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Fetch all bookings associated with the user
$stmt = $conn->prepare("SELECT * FROM bookings WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="favicon/favicon.ico">
    <style>
        .table-responsive {
            margin-bottom: 20px;
        }

        .btns {
            margin-top: -.5em;
        }

        .btn-success {
            background-color: darkblue;
            color: white;
            border: 0;
        }

        .btn-success:hover {
            background-color: rgb(0, 0, 180);
        }

        .swal2-confirm:focus {
            box-shadow: none !important;
        }

        .swal2-cancel:focus {
            box-shadow: none !important;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <a href="/hoteli/index.php">Go back to main page</a>
        <h1 class="mb-4">Your Bookings</h1>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered'>";
                echo "<tbody>";

                echo "<tr>";
                echo "<th>Hotel</th><td>" . $row['hotel_name'] . "</td></tr>";
                echo "<th>Name</th><td>" . $row['name'] . "</td></tr>";
                echo "<tr><th>Email</th><td>" . $row['email'] . "</td></tr>";
                echo "<tr><th>Check-in Date</th><td>" . date('d.m.Y.', strtotime($row['checkin'])) . "</td></tr>";
                echo "<tr><th>Check-out Date</th><td>" . date('d.m.Y.', strtotime($row['checkout'])) . "</td></tr>";
                echo "<tr><th>Number of Guests</th><td>" . $row['guests'] . "</td></tr>";
                echo "<tr><th>Number of Beds</th><td>" . $row['beds'] . "</td></tr>";

                echo "</tbody>";
                echo "</table>";

                echo "<div class='btns'>";
                echo "<a href='pdf.php?booking_id=" . $row['id'] . "' class='btn btn-success m-1 float-start' title='Download booking details'><i class='bi bi-download'></i> Download</a>";
                echo "<input type='hidden' name='booking_id' value='" . $row['id'] . "'>";
                echo "<button class='btn btn-danger m-1 float-end cancelBookingBtn' data-booking-id='" . $row['id'] . "' title='Cancel booking'><i class='bi bi-x-circle-fill'></i> Cancel</button>";
                echo "</div>";

                echo "</div>";
            }
        } else {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered'>";
            echo "<tr><td colspan='2'>You have no bookings.</td></tr>";
            echo "</table>";
            echo "</div>";
        }
        ?>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).on('click', '.cancelBookingBtn', function(event) {
            event.preventDefault();
            let bookingId = $(this).data('booking-id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to cancel your booking. This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: 'darkblue',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send an AJAX request to cancel_booking.php
                    $.ajax({
                        url: 'cancel_booking.php',
                        method: 'POST',
                        data: {
                            booking_id: bookingId
                        },
                        success: function(response) {
                            // Display success message
                            Swal.fire({
                                title: 'Cancelled!',
                                text: 'Your booking has been cancelled.',
                                icon: 'success',
                                confirmButtonColor: 'darkblue',
                            }).then(() => {
                                // Redirect the user to a confirmation page
                                window.location.href = '/hoteli/booking_confirmation.php';
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            console.error(xhr.responseText);
                            Swal.fire(
                                'Error',
                                'An error occurred while cancelling the booking.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>