<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Booking</title>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .swal2-confirm:focus {
            box-shadow: none;
            background-color: darkblue;
        }
    </style>
</head>

<body>

    <?php
    session_start();

    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include 'database/db_connection.php';

        // Sanitize input data
        function sanitizeData($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please log in to proceed with the booking.',
                    allowOutsideClick: false
                }).then(() => {
                    // Redirect to the login page after the user clicks OK
                    window.location.href = 'login.php';
                });
            </script>";
        } else {
            // Retrieve user ID from session
            $user_id = $_SESSION['user_id'];

            // Retrieve and sanitize form data
            $name = sanitizeData($_POST['name']);
            $email = sanitizeData($_POST['email']);
            $checkin = sanitizeData($_POST['checkin']);
            $checkout = sanitizeData($_POST['checkout']);
            $guests = sanitizeData($_POST['guests']);
            $beds = sanitizeData($_POST['beds']);
            $hotel_id = sanitizeData($_POST['hotel']);

            // Format dates to MySQL format
            $checkin = date('Y-m-d', strtotime($checkin));
            $checkout = date('Y-m-d', strtotime($checkout));

            // Check if the user has already booked the same hotel for overlapping dates
            $check_existing_user_hotel_booking_sql = "SELECT * FROM bookings 
                WHERE user_id = '$user_id'
                AND hotel_name = '$hotel_id'";
            $existing_user_hotel_booking_result = $conn->query($check_existing_user_hotel_booking_sql);

            if ($existing_user_hotel_booking_result->num_rows > 0) {
                // If the user has already booked the same hotel for overlapping dates, display an error message
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'It looks like you\\'ve already booked this hotel. You can either cancel your existing booking or choose another hotel.',
                    }).then(() => {
                        // Redirect to the booking page after the user clicks OK
                        window.location.href = 'index.php';
                    });
                </script>";
            } else {

                // Check if the user has already booked a hotel
                $check_existing_user_booking_sql = "SELECT * FROM bookings 
                    WHERE user_id != '$user_id'
                    AND checkin <= '$checkout' 
                    AND checkout >= '$checkin'";
                $existing_user_booking_result = $conn->query($check_existing_user_booking_sql);

                if ($existing_user_booking_result->num_rows > 0) {
                    // If the user has already booked a hotel, display an error message
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Sorry, the hotel is already booked for the specified dates. Please select another hotel or choose different dates.',
                        }).then(() => {
                            // Redirect to the booking page after the user clicks OK
                            window.location.href = 'index.php';
                        });
                    </script>";
                } else {
                    // Retrieve the hotel from tables based on the provided hotel ID
                    $hotel_check_sql = "(SELECT * FROM bali WHERE hotel = '$hotel_id')
                            UNION
                            (SELECT * FROM croatia WHERE hotel = '$hotel_id')
                            UNION
                            (SELECT * FROM spain WHERE hotel = '$hotel_id')
                            UNION
                            (SELECT * FROM egypt WHERE hotel = '$hotel_id')
                            UNION
                            (SELECT * FROM caribbean WHERE hotel = '$hotel_id')
                            UNION
                            (SELECT * FROM china WHERE hotel = '$hotel_id')";
                    $hotel_check_result = $conn->query($hotel_check_sql);

                    if ($hotel_check_result->num_rows > 0) {
                        $hotel_row = $hotel_check_result->fetch_assoc();
                        $hotel_id = $hotel_row['hotel'];

                        // Check if the same range of dates exists for any user but different hotel
                        $check_existing_booking_sql = "SELECT * FROM bookings 
                            WHERE checkin <= '$checkout' 
                            AND checkout >= '$checkin'
                            AND (hotel_name = '$hotel_id' OR checkin != '$checkin' OR checkout != '$checkout')";
                        $existing_booking_result = $conn->query($check_existing_booking_sql);

                        if ($existing_booking_result->num_rows > 0) {
                            // If there are overlapping bookings for a different hotel, display an error message
                            echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Seems like you have already booked a hotel for a specified dates. Consider alternative dates or explore other available hotel options for your stay.',
                                }).then(() => {
                                    // Redirect to the booking page after the user clicks OK
                                    window.location.href = 'index.php';
                                });
                            </script>";
                        } else {
                            // Insert the booking details into the database along with user ID
                            $insert_booking_sql = "INSERT INTO bookings (user_id, name, email, checkin, checkout, guests, beds, hotel_name) 
                                VALUES ('$user_id', '$name', '$email', '$checkin', '$checkout', '$guests', '$beds', '$hotel_id')";

                            if ($conn->query($insert_booking_sql) === TRUE) {
                                $_SESSION['booking_id'] = $conn->insert_id; // Store the booking ID in a session variable

                                // Display success message using SweetAlert
                                echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Booking Successful',
                                        text: 'Thank you for your booking, $name! Your reservation has been confirmed.',
                                    }).then(() => {
                                        // Redirect to another page after the user clicks OK
                                        window.location.href = 'booking_confirmation.php';
                                    });
                                </script>";
                            } else {
                                // Error occurred while inserting booking
                                echo "Error: " . $insert_booking_sql . "<br>" . $conn->error;
                            }
                        }
                    } else {
                        // Hotel not found, display an error message
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Selected hotel not found. Please select a valid hotel.',
                            }).then(() => {
                                // Redirect to the booking page after the user clicks OK
                                window.location.href = 'index.php';
                            });
                        </script>";
                    }
                }
            }
        }

        $conn->close();
    } else {
        // If the request method is not POST, redirect to the index page
        header("Location: index.php");
        exit();
    }
    ?>

</body>

</html>