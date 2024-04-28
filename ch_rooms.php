<?php include 'components/links.php'; ?>
<?php include 'components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>China - Hotels</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="js/ch_filters.js"></script>
</head>

<body>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">our rooms</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <nav class="navbar navbar-expand-lg bg-white mb-3">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">Filters</h4>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="bi bi-funnel"></i>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3">Check availability</h5>
                                <label for="checkIn">Check in</label>
                                <input type="date" class="form-control" id="checkIn">
                                <label for="checkOut">Check out</label>
                                <input type="date" class="form-control" id="checkOut">
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3">Travelers</h5>
                                <div class="form-group">
                                    <label for="adult">Number of adults</label>
                                    <input type="number" class="form-control" id="adult" min="0" max="20">
                                </div>
                                <div class="form-group">
                                    <label for="children">Number of children</label>
                                    <input type="number" class="form-control" id="children" min="0" max="30">
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3">Facilities</h5>
                                <div class="form-group">
                                    <label for="room">Number rooms</label>
                                    <input type="number" class="form-control" id="room" min="0" max="30">
                                </div>
                                <div class="form-group">
                                    <label for="bed">Number of beds</label>
                                    <input type="number" class="form-control" id="bed" min="0" max="30">
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3">Room facilities</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rf1">
                                    <label class="form-check-label" for="rf1">
                                        TV
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rf2">
                                    <label class="form-check-label" for="rf2">
                                        Wi-Fi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rf3">
                                    <label class="form-check-label" for="rf3">
                                        AC
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rf4">
                                    <label class="form-check-label" for="rf4">
                                        Parking
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rf5">
                                    <label class="form-check-label" for="rf5">
                                        Kitchen
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rf6">
                                    <label class="form-check-label" for="rf6">
                                        Pool
                                    </label>
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3">Rating</h5>
                                <div class="form-check">
                                    <?php
                                    $ratingOptions = array(5, 6, 7, 8, 9);

                                    foreach ($ratingOptions as $index => $rating) {
                                        $isChecked = isset($_GET['rating']) && in_array($rating, explode(',', $_GET['rating'])) ? 'checked' : '';
                                        echo '<input class="form-check-input ratingCheckbox" type="checkbox" value="' . $rating . '" id="r' . ($index + 1) . '" ' . $isChecked . '>';
                                        echo '<label class="form-check-label" for="r' . ($index + 1) . '">';
                                        echo $rating . '+';
                                        echo '</label>';
                                        echo '<br>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="content" class="col-lg-9 col-md-12 px-4">

                <?php

                include 'ch_filter.php';

                // Read JSON file
                $jsonData = file_get_contents('hotels_list_china.json');
                $data = json_decode($jsonData, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    die("Error decoding JSON: " . json_last_error_msg());
                }

                // Prepare SQL statement
                $sql = "INSERT INTO china (hotel, price, score, room, bed, adult, children, facilities, image_url) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssiiiss", $hotel, $price, $score, $room, $bed, $adult, $children, $facilities, $image_url);

                // Insert data into MySQL table
                foreach ($data as $hotelData) {
                    // Validate and sanitize input data
                    $hotel = $conn->real_escape_string($hotelData['hotel']);
                    $price = $conn->real_escape_string($hotelData['price']);
                    $score = $conn->real_escape_string($hotelData['score']);
                    $room = $conn->real_escape_string($hotelData['room']);
                    $bed = $conn->real_escape_string($hotelData['bed']);
                    // Check if 'adult' and 'children' keys exist, set default values if they don't
                    $adult = isset($hotelData['adult']) ? $conn->real_escape_string($hotelData['adult']) : 0;
                    $children = isset($hotelData['children']) ? $conn->real_escape_string($hotelData['children']) : 0;
                    $facilities = $conn->real_escape_string(implode(', ', $hotelData['facilities']));
                    $image_url = $conn->real_escape_string($hotelData['image_url']);

                    if (!$stmt->execute()) {
                        echo "Error inserting data: " . $stmt->error;
                    }
                }

                $stmt->close();
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>