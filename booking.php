<?php include 'database/db_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    if (isset($_POST['hotel_id'])) {
        // Sanitize user input
        $hotel_id = filter_input(INPUT_POST, 'hotel_id', FILTER_SANITIZE_STRING);

        // Validate hotel_id format
        if (!preg_match("/./", $hotel_id)) {
            die("Invalid hotel ID");
        }

        // Prepare SQL statement
        $sql = "SELECT * FROM (
                SELECT * FROM bali WHERE hotel = ?
                UNION
                SELECT * FROM caribbean WHERE hotel = ?
                UNION
                SELECT * FROM croatia WHERE hotel = ?
                UNION
                SELECT * FROM china WHERE hotel = ?
                UNION
                SELECT * FROM egypt WHERE hotel = ?
                UNION
                SELECT * FROM spain WHERE hotel = ?
            ) AS combined";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $hotel_id, $hotel_id, $hotel_id, $hotel_id, $hotel_id, $hotel_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<title>Hotel Booking - ' . htmlspecialchars($row['hotel']) . '</title>';
        } else {
            echo '<title>Hotel Booking</title>';
        }
    } else {
        echo '<title>Hotel Booking</title>';
    }

    ?>




    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/booking.css">
    <link rel="icon" type="image/x-icon" href="favicon/favicon.ico">
</head>

<body>
    <div class="container mt-3 mb-2">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center mb-4">Hotel Booking</h1>
                <?php
                if (isset($_POST['hotel_id'])) {
                    $hotel_id = $_POST['hotel_id'];

                    // Fetch hotel details from the database based on hotel_id
                    $sql = "(SELECT * FROM bali WHERE hotel = '$hotel_id')
                        UNION
                        (SELECT * FROM caribbean WHERE hotel = '$hotel_id')
                        UNION
                        (SELECT * FROM croatia WHERE hotel = '$hotel_id')
                        UNION
                        (SELECT * FROM china WHERE hotel = '$hotel_id')
                        UNION
                        (SELECT * FROM egypt WHERE hotel = '$hotel_id')
                        UNION
                        (SELECT * FROM spain WHERE hotel = '$hotel_id')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Display hotel booking information
                        $row = $result->fetch_assoc();
                        $adult = $row['adult'];
                        $children = $row['children'];
                        $guests = $adult + $children;
                        $beds = $row['bed'];
                        echo '<h2 class="text-center">' . $row['hotel'] . '</h2>';
                        echo '<img src="' . $row['image_url'] . '" class="img-fluid mb-4" alt="' . $row['hotel'] . '">';
                        $priceWithoutSymbol = preg_replace('/[^0-9,.]/', '', $row['price']);
                        echo '<p class="text-center">' . $priceWithoutSymbol . ' €' . '</p>';
                        #echo json_encode(array('guests' => $guests, 'beds' => $beds));
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Hotel not found</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Invalid request</div>';
                }

                $conn->close();
                ?>
                <form action="booking_process.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name<span class="asterix">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="asterix">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="checkin" class="form-label">Check-in Date<span class="asterix">*</span></label>
                        <input type="date" class="form-control" id="checkin" name="checkin" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="checkout" class="form-label">Check-out Date<span class="asterix">*</span></label>
                        <input type="date" class="form-control" id="checkout" name="checkout" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="mb-3 number-input-container">
                        <label for="guests" class="form-label">Number of Guests<span class="asterix">*</span></label>
                        <div class="number-input-group">
                            <button type="button" class="btn decrement">-</button>
                            <input type="number" class="form-control number-input" id="guests" name="guests" value="1" required>
                            <button type="button" class="btn increment">+</button>
                        </div>
                    </div>
                    <div class="mb-3 number-input-container">
                        <label for="beds" class="form-label">Number of Beds<span class="asterix"> *</span></label>
                        <div class="number-input-group">
                            <button type="button" class="btn decrement" id="decrementBeds">-</button>
                            <input type="number" class="form-control number-input" id="beds" name="beds" value="1" required>
                            <button type="button" class="btn increment" id="incrementBeds">+</button>
                        </div>
                    </div>
                    <input type="hidden" name="hotel" value="<?php echo $hotel_id; ?>">
                    <button type="submit" class="btn-submit">Submit Booking</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var maxBeds = parseInt(<?php echo json_encode($beds); ?>);
            var maxGuests = parseInt(<?php echo json_encode($guests); ?>);

            $('.increment').click(function() {
                var input = $(this).siblings('.number-input');
                var value = parseInt(input.val());

                if (input.attr('id') === 'beds' && value < maxBeds) {
                    input.val(value + 1);
                } else if (input.attr('id') === 'guests' && value < maxGuests) {
                    input.val(value + 1);
                }
            });

            $('.decrement').click(function() {
                var input = $(this).siblings('.number-input');
                var value = parseInt(input.val());

                if (input.attr('id') === 'beds' && value > 1) {
                    input.val(value - 1);
                } else if (input.attr('id') === 'guests' && value > 1) {
                    input.val(value - 1);
                }
            });
        });

        $('.number-input').on('input', function() {
            var maxBeds = <?php echo json_encode($beds); ?>;
            var maxGuests = <?php echo json_encode($guests); ?>;

            var inputId = $(this).attr('id');
            var maxValue;
            if (inputId === 'beds') {
                maxValue = maxBeds;
            } else if (inputId === 'guests') {
                maxValue = maxGuests;
            }

            var inputValue = $(this).val();
            inputValue = inputValue.replace(/\D/g, '');
            if (parseInt(inputValue) > maxValue) {
                inputValue = maxValue;
                $(this).val(inputValue);
                $('#max-msg').text("The maximum value allowed is " + maxValue + ".");
            } else {
                $(this).val(inputValue);
                $('#max-msg').text("");
            }
        });
    </script>

    <script>
        function setMinCheckoutDate() {
            var checkinDate = new Date(document.getElementById('checkin').value);
            var maxCheckoutDate = new Date(checkinDate);
            maxCheckoutDate.setDate(checkinDate.getDate() + 10); // Adding 10 days to check-in date
            var minCheckoutDate = formatDate(checkinDate);
            var maxCheckoutDateString = formatDate(maxCheckoutDate);
            document.getElementById('checkout').setAttribute('min', minCheckoutDate);
            document.getElementById('checkout').setAttribute('max', maxCheckoutDateString); // Setting max checkout date
        }

        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            return year + '-' + month + '-' + day;
        }

        document.getElementById('checkin').addEventListener('change', setMinCheckoutDate);
    </script>

</body>

</html>