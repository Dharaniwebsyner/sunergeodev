$(document).ready(function() {
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 0) {
            $(".header").addClass("sticky-header");
        } else {

            $(".header").removeClass("sticky-header");
        }
    });
});


$(document).ready(function() {
    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });
});
