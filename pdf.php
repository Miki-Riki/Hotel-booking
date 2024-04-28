<?php

include 'database/db_connection.php';

// Check if the booking ID is provided in the URL
if (isset($_GET['booking_id']) && is_numeric($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Initialize PDF library
        require_once('TCPDF-main/tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Booking Details');

        // Add a page
        $pdf->AddPage();

        // Fetch booking details and format them in the PDF
        while ($row = $result->fetch_assoc()) {
            // Escape output to prevent XSS
            $hotel_name = htmlspecialchars($row['hotel_name']);
            $name = htmlspecialchars($row['name']);
            $email = htmlspecialchars($row['email']);
            $checkin = htmlspecialchars($row['checkin']);
            $checkout = htmlspecialchars($row['checkout']);
            $guests = htmlspecialchars($row['guests']);
            $beds = htmlspecialchars($row['beds']);

            $pdf->SetFont('helvetica', '', 12);
            $pdf->Cell(0, 10, 'Hotel: ' . $hotel_name, 0, 1);
            $pdf->Cell(0, 10, 'Name: ' . $name, 0, 1);
            $pdf->Cell(0, 10, 'Email: ' . $email, 0, 1);
            $pdf->Cell(0, 10, 'Check-in Date: ' . $checkin, 0, 1);
            $pdf->Cell(0, 10, 'Check-out Date: ' . $checkout, 0, 1);
            $pdf->Cell(0, 10, 'Number of Guests: ' . $guests, 0, 1);
            $pdf->Cell(0, 10, 'Number of Beds: ' . $beds, 0, 1);
        }

        // Close and output PDF document
        $pdf->Output('Booking details.pdf', 'D');
    } else {
        echo "Booking not found";
    }

    $stmt->close();
} else {
    echo "Invalid booking ID";
}

$conn->close();
