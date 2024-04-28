<?php include 'components/links.php'; ?>
<?php include 'components/header.php'; ?>
<?php
$check_in = $_GET['check_in'] ?? '';
$check_out = $_GET['check_out'] ?? '';
$adult = $_GET['adult'] ?? '';
$children = $_GET['children'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search ...</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-12 mt-5 search">
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
                                <input type="date" class="form-control" id="checkIn" value="<?php echo $check_in; ?>" min="<?php echo date('Y-m-d'); ?>">
                                <label for="checkOut">Check out</label>
                                <input type="date" class="form-control" id="checkOut" value="<?php echo $check_out; ?>" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3">Travelers</h5>
                                <div class="form-group">
                                    <label for="adult">Number of adults</label>
                                    <input type="number" class="form-control" id="adult" value="<?php echo $adult; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="children">Number of children</label>
                                    <input type="number" class="form-control" id="children" value="<?php echo $children; ?>">
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
                </nav>
            </div>
            <div id="hotels" class="col-lg-9 col-md-12 px-4">
                <?php include 'filter_hotels.php'; ?>
            </div>
        </div>
    </div>

    <script>
        function setMinCheckoutDate() {
            var checkinDate = new Date(document.getElementById('checkIn').value);
            var minCheckoutDate = formatDate(checkinDate);
            document.getElementById('checkOut').setAttribute('min', minCheckoutDate);
        }

        function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            return year + '-' + month + '-' + day;
        }
        document.getElementById('checkIn').addEventListener('change', setMinCheckoutDate);
    </script>

    <?php include 'components/footer.php'; ?>

</body>

</html>