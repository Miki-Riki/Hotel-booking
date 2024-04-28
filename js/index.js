// Date inputs 

function setMinCheckoutDate() {
    var checkinDate = new Date(document.getElementById('check_in').value);
    var maxCheckoutDate = new Date(checkinDate);
    maxCheckoutDate.setDate(maxCheckoutDate.getDate() + 10);
    var minCheckoutDate = formatDate(checkinDate);
    var maxCheckoutDateString = formatDate(maxCheckoutDate);
    document.getElementById('check_out').setAttribute('min', minCheckoutDate);
    document.getElementById('check_out').setAttribute('max', maxCheckoutDateString);
}

function formatDate(date) {
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2, '0');
    return year + '-' + month + '-' + day;
}

document.getElementById('check_in').addEventListener('change', setMinCheckoutDate);


// Adult input field cannont be 0

$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'manual',
        template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner bg-danger"></div></div>'
    });

    $('#adult').on('input', function() {
        var inputValue = parseInt($(this).val());
        if (inputValue === 0) {
            $(this).addClass('border border-danger');
            $(this).tooltip('show');
            $('#submitButton').prop('disabled', true);
        } else {
            $(this).removeClass('border border-danger');
            $(this).tooltip('hide');
            $('#submitButton').prop('disabled', false);
        }
    });
});