jQuery(document).ready(function($){

    $('#toggle-navigation').on('click', openNavigation );

    function openNavigation() {
        $('#menu-primary').toggleClass('open');
    }

    $('#learn-more').on('click', scrollDown);

    function scrollDown() {
        $('html,body').animate({
            scrollTop: $('#benefit-1').offset().top
        }, 1000);
        return false;
    }

    $('#ready-to-buy').on('click', scrollUp);

    function scrollUp() {
        $('html,body').animate({
            scrollTop: $('#pricing').offset().top
        }, 1000);
        return false;
    }
});