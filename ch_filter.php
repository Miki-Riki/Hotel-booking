<?php

include 'database/db_connection.php';

$recordsPerPage = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Function to sanitize input
function sanitizeInput($input)
{
    return htmlspecialchars(strip_tags($input));
}

// Extract and sanitize filter parameters
$tvFilter = isset($_GET['tv']) && $_GET['tv'] == '1' ? 'AND facilities LIKE "%TV%"' : '';
$wifiFilter = isset($_GET['wifi']) && $_GET['wifi'] == '1' ? 'AND facilities LIKE "%Wi-Fi%"' : '';
$acFilter = isset($_GET['ac']) && $_GET['ac'] == '1' ? 'AND facilities LIKE "%AC%"' : '';
$parkFilter = isset($_GET['parking']) && $_GET['parking'] == '1' ? 'AND facilities LIKE "%Parking%"' : '';
$kitchenFilter = isset($_GET['kitchen']) && $_GET['kitchen'] == '1' ? 'AND facilities LIKE "%Kitchen%"' : '';
$poolFilter = isset($_GET['pool']) && $_GET['pool'] == '1' ? 'AND facilities LIKE "%Pool%"' : '';
$ratingFilter = isset($_GET['rating']) ? 'AND score >= ' . floatval($_GET['rating']) : '';
$adultFilter = isset($_GET['adult']) ? 'AND adult >= ' . intval($_GET['adult']) : '';
$childrenFilter = isset($_GET['children']) ? 'AND children >= ' . intval($_GET['children']) : '';
$roomFilter = isset($_GET['room']) ? 'AND room >= ' . intval($_GET['room']) : '';
$bedFilter = isset($_GET['bed']) ? 'AND bed >= ' . intval($_GET['bed']) : '';

// Fetch filtered data from the database (using prepared statements)
$stmt = $conn->prepare("SELECT DISTINCT hotel, price, score, room, bed, adult, children, facilities, image_url 
        FROM china 
        WHERE 1=1 $tvFilter $wifiFilter $acFilter $parkFilter $kitchenFilter $poolFilter $ratingFilter $adultFilter $childrenFilter $roomFilter $bedFilter
        LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $recordsPerPage);
$stmt->execute();
$result = $stmt->get_result();

// Display data on the page
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $decodedPrice = json_decode('"' . sanitizeInput($row['price']) . '"');
        $numericValue = filter_var($decodedPrice, FILTER_SANITIZE_NUMBER_INT);

        echo '<div class="card w-100 mb-3">';
        echo '<div class="row g-0 p-3">';
        echo '<div class="col-md-4">';
        echo '<img src="' . sanitizeInput($row['image_url']) . '" class="img-fluid" alt="' . sanitizeInput($row['hotel']) . '">';
        echo '</div>';
        echo '<div class="col-md-4">';
        echo '<h5 class="card-title">' . sanitizeInput($row['hotel']) . '</h5>';
        echo '<div class="spans">';
        echo '<span class="badge bg-secondary">Rooms ' . sanitizeInput($row['room']) . '</span>';
        echo '<span class="badge bg-secondary">Beds ' . sanitizeInput($row['bed']) . '</span>';
        echo '</div>';
        echo '<div class="spans">';
        echo '<span class="badge bg-secondary">Adult ' . sanitizeInput($row['adult']) . '</span>';
        if ($row['children'] > 0) {
            echo '<span class="badge bg-secondary">Children ' . sanitizeInput($row['children']) . '</span>';
        }
        echo '</div>';
        echo '<div class="facilities">';
        $facilitiesArray = explode(', ', sanitizeInput($row['facilities']));
        foreach ($facilitiesArray as $facility) {
            echo '<span class="badge bg-secondary">' . $facility . '</span>';
        }
        echo '</div>';
        echo '</div>';
        echo '<div class="col-md-4">';
        echo '<div class="card-body">';
        echo '<p class="price">' . $numericValue . " €" . '</p>';
        echo '<div class="rating_bg">';
        echo '<p class="rating">';
        if ($row['score'] >= 10) {
            echo floor($row['score']);
        } else {
            echo sanitizeInput($row['score']);
        }
        echo '</p>';
        echo '</div>';
        echo '</div>';
        echo '<form action="booking.php" method="POST">';
        echo '<input type="hidden" name="hotel_id" value="' . sanitizeInput($row['hotel']) . '">';
        echo '<button type="submit" class="btn btn">Book now</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    // Pagination links
    $sqlCount = "SELECT COUNT(DISTINCT hotel) AS total FROM china WHERE 1=1 $tvFilter $wifiFilter $acFilter $parkFilter $kitchenFilter $poolFilter $ratingFilter $adultFilter $childrenFilter $roomFilter $bedFilter";
    $resultCount = $conn->query($sqlCount);
    $rowCount = $resultCount->fetch_assoc();
    $totalPages = ceil($rowCount['total'] / $recordsPerPage);

    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '">';
        // Maintain other filters in pagination links
        $filters = array(
            'tv' => isset($_GET['tv']) ? $_GET['tv'] : '',
            'wifi' => isset($_GET['wifi']) ? $_GET['wifi'] : '',
            'ac' => isset($_GET['ac']) ? $_GET['ac'] : '',
            'parking' => isset($_GET['parking']) ? $_GET['parking'] : '',
            'kitchen' => isset($_GET['kitchen']) ? $_GET['kitchen'] : '',
            'pool' => isset($_GET['pool']) ? $_GET['pool'] : '',
            'rating' => isset($_GET['rating']) ? $_GET['rating'] : '',
            'adult' => isset($_GET['adult']) ? $_GET['adult'] : '',
            'children' => isset($_GET['children']) ? $_GET['children'] : '',
            'room' => isset($_GET['room']) ? $_GET['room'] : '',
            'bed' => isset($_GET['bed']) ? $_GET['bed'] : ''
        );
        echo '<a class="page-link" href="?page=' . $i . '&' . http_build_query($filters) . '" style="' . ($page == $i ? 'background-color: darkblue; color: white; border: 0;' : '') . '">' . $i . '</a>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
} else {
    echo '<div class="alert alert-warning"> No results found.</div>';
}

#$stmt->close();
#$conn->close();
