jQuery(document).ready(function($) {
    $('.table tr th').on('click', function (e) {
        // $('.table tr th').removeClass('active');
        if ($(this).children().hasClass('fa-sort-amount-up')) {
            $(this).children().removeClass('fa-sort-amount-up').addClass('fa-sort-amount-down');
        } else if ($(this).children().hasClass('fa-sort-amount-down')) {
            $(this).children().removeClass('fa-sort-amount-down');
        } else {
            $(this).children().addClass('fa-sort-amount-up');
        }
    });




});