$(document).ready( function () {
    $('.link-scrolling').on('click', function (event) {
        event.preventDefault();
        $('html body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, 1000);
    })
})