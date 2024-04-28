$(document).ready(function () {
    $('#mainNavbar a').on('click', function (event) {
        if (this.hash !== '') {
            event.preventDefault();

            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top - $('#mainNavbar').outerHeight()
            }, 10);
        }
    });
});