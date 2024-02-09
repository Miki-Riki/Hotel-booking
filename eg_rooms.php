<?php include 'components/header.php'; ?>
<?php include 'components/links.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Egypt - Hotels</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                <label for="adult">Number of adults</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="3">4</option>
                                    <option value="3">5</option>
                                    <option value="3">6</option>
                                    <option value="3">7</option>
                                    <option value="3">8</option>
                                    <option value="3">9</option>
                                    <option value="3">10</option>
                                </select>
                                <label for="children">Number of children</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="3">4</option>
                                    <option value="3">5</option>
                                    <option value="3">6</option>
                                    <option value="3">7</option>
                                    <option value="3">8</option>
                                    <option value="3">9</option>
                                    <option value="3">10</option>
                                </select>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3">Facilities</h5>
                                <label for="room">Number of rooms</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <label for="bed">Number of beds</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">1</option>
                                    <option selected value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
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
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3">Rating</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="r1">
                                    <label class="form-check-label" for="r1">
                                        5+
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="r2">
                                    <label class="form-check-label" for="r2">
                                        6+
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="r3">
                                    <label class="form-check-label" for="r3">
                                        7+
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="r4">
                                    <label class="form-check-label" for="r4">
                                        8+
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="r5">
                                    <label class="form-check-label" for="r5">
                                        9+
                                    </label>
                                </div>
                            </div>
                        </div>
                </nav>
            </div>
            <div class="col-lg-9 col-md-12 px-4">

                <?php

                include 'database/db_connection.php';

                $recordsPerPage = 4;

                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                $offset = ($page - 1) * $recordsPerPage;

                // Fetch distinct data from the database with pagination
                $sql = "SELECT DISTINCT hotel, price, score, room, bed, facilities, image_url FROM egypt LIMIT $offset, $recordsPerPage";
                $result = $conn->query($sql);

                // Display data on the page
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $decodedPrice = json_decode('"' . $row['price'] . '"');
                        $numericValue = filter_var($decodedPrice, FILTER_SANITIZE_NUMBER_INT);

                        // Use Bootstrap classes for styling the card
                        echo '<div class="card w-100 mb-3">';
                        echo '<div class="row g-0 p-3">';
                        echo '<div class="col-md-4">';
                        echo '<img src="' . $row['image_url'] . '" class="img-fluid" alt="' . $row['hotel'] . '">';
                        echo '</div>';
                        echo '<div class="col-md-4">';
                        echo '<h5 class="card-title">' . $row['hotel'] . '</h5>';
                        echo '<div class="spans">';
                        echo '<span class="badge bg-secondary">Rooms ' . $row['room'] . '</span>';
                        echo '<span class="badge bg-secondary">Beds ' . $row['bed'] . '</span>';
                        echo '</div>';
                        echo '<div class="facilities">';
                        $facilitiesArray = explode(', ', $row['facilities']);
                        foreach ($facilitiesArray as $facility) {
                            echo '<span class="badge bg-secondary">' . $facility . '</span>';
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-4">';
                        echo '<div class="card-body">';
                        echo '<p class="price">' . $numericValue . " €" . '</p>';
                        echo '<div class="rating_bg">';
                        echo '<p class="rating">' . $row['score'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '<button type="button" class="btn btn" id="featureBtn">Book now</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }

                    // Pagination links
                    $sqlCount = "SELECT COUNT(DISTINCT hotel) AS total FROM egypt";
                    $resultCount = $conn->query($sqlCount);
                    $rowCount = $resultCount->fetch_assoc();
                    $totalPages = ceil($rowCount['total'] / $recordsPerPage);

                    echo '<nav aria-label="Page navigation">';
                    echo '<ul class="pagination">';
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '">';
                        echo '<a class="page-link" href="?page=' . $i . '" style="' . ($page == $i ? 'background-color: darkblue; color: white;' : '') . '">' . $i . '</a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</nav>';
                } else {
                    echo "No records found.";
                }

                // Read JSON file
                $jsonData = file_get_contents('hotels_list_egypt.json');
                $data = json_decode($jsonData, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    die("Error decoding JSON: " . json_last_error_msg());
                }

                // Insert data into MySQL table
                foreach ($data as $hotelData) {
                    $hotel = $conn->real_escape_string($hotelData['hotel']);
                    $price = $conn->real_escape_string($hotelData['price']);
                    $score = $conn->real_escape_string($hotelData['score']);
                    $room = $conn->real_escape_string($hotelData['room']);
                    $bed = $conn->real_escape_string($hotelData['bed']);
                    $facilities = $conn->real_escape_string(implode(', ', $hotelData['facilities']));
                    $image_url = $conn->real_escape_string($hotelData['image_url']);

                    $sql = "INSERT INTO egypt (hotel, price, score, room, bed, facilities, image_url) 
                    VALUES ('$hotel', '$price', '$score', '$room', '$bed', '$facilities', '$image_url')";

                    if ($conn->query($sql) !== TRUE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                $conn->close();
                ?>


            </div>
        </div>
    </div>
    <?php include 'components/footer.php'; ?>
</body>

</html>