$(document).ready(function () {
    $('input[type="checkbox"], input[type="number"]').change(function () {
        filterResults();
    });

    function filterResults() {
        // Collect the selected checkbox values dynamically
        var tvChecked = $('#rf1').is(':checked');
        var wifiChecked = $('#rf2').is(':checked');
        var acChecked = $('#rf3').is(':checked');
        var parkingChecked = $('#rf4').is(':checked');
        var kitchenChecked = $('#rf5').is(':checked');
        var poolChecked = $('#rf6').is(':checked');
        var adultValue = $('#adult').val();
        var childrenValue = $('#children').val();
        var roomValue = $('#room').val();
        var bedValue = $('#bed').val();

        var selectedRatings = [];
        $('.ratingCheckbox:checked').each(function () {
            selectedRatings.push($(this).val());
        });

        // Construct an object with the collected values
        var formData = {
            'tv': tvChecked ? '1' : '0',
            'wifi': wifiChecked ? '1' : '0',
            'ac': acChecked ? '1' : '0',
            'parking': parkingChecked ? '1' : '0',
            'kitchen': kitchenChecked ? '1' : '0',
            'pool': poolChecked ? '1' : '0',
            'rating': selectedRatings.join(','),
            'adult': adultValue,
            'children': childrenValue,
            'room': roomValue,
            'bed': bedValue,
        };

        // Send AJAX request
        $.ajax({
            type: 'GET',
            url: 'ba_filter.php',
            data: formData,
            success: function (response) {
                $('#content').html(response);
                window.scrollTo(0, 0);
            }
        });

        // Store form data in sessionStorage
        sessionStorage.setItem('formData', JSON.stringify(formData));
    }

    // Update checkboxes based on URL parameters when the page loads
    var params = new URLSearchParams(window.location.search);
    $('#rf1').prop('checked', params.has('tv') && params.get('tv') === '1');
    $('#rf2').prop('checked', params.has('wifi') && params.get('wifi') === '1');
    $('#rf3').prop('checked', params.has('ac') && params.get('ac') === '1');
    $('#rf4').prop('checked', params.has('parking') && params.get('parking') === '1');
    $('#rf5').prop('checked', params.has('kitchen') && params.get('kitchen') === '1');
    $('#rf6').prop('checked', params.has('pool') && params.get('pool') === '1');

    // Update rating checkboxes based on URL parameters when the page loads
    var ratingParams = params.getAll('rating');
    ratingParams.forEach(function (rating) {
        $('#r' + rating).prop('checked', true);
    });

    // Check if the page is being refreshed
    if (performance.navigation.type === 1) {
        // Reset all checkboxes when the page is refreshed
        $('input[type="checkbox"]').prop('checked', false);
        // Trigger AJAX call to reset results
        filterResults();
    } else {
        // Retrieve form data from sessionStorage and populate input fields
        var storedFormData = sessionStorage.getItem('formData');
        if (storedFormData) {
            var formData = JSON.parse(storedFormData);
            $('#adult').val(formData.adult);
            $('#children').val(formData.children);
            $('#room').val(formData.room);
            $('#bed').val(formData.bed);
        }
    }
});
