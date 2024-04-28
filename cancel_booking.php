<?php
include('components/links.php');

session_start();

include 'database/db_connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate booking_id
    if (isset($_POST['booking_id']) && is_numeric($_POST['booking_id'])) {
        $bookingId = $_POST['booking_id'];

        // Prepare SQL statement to delete the booking
        $sql = "DELETE FROM bookings WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $bookingId);

        if ($stmt->execute()) {
            // Display success message
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Booking Cancelled',
                    text: 'Your booking has been cancelled successfully.',
                }).then(() => {
                    // Redirect to another page after cancellation
                    window.location.href = 'booking_confirmation.php';
                });
            </script>";
        } else {
            // Error occurred while deleting booking
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred while cancelling the booking.',
                });
            </script>";
        }

        $stmt->close();
    } else {
        // Invalid booking_id
        http_response_code(400);
        echo "Invalid booking ID.";
    }
} else {
    // Invalid request method
    http_response_code(405);
    echo "Method Not Allowed.";
}

$conn->close();
