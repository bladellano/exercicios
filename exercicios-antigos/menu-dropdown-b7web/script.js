$(function () {

    $('li').hover(function () {
        $(this).find('.sub-item').slideDown();
    }, function () {
        $(this).find('.sub-item').slideUp();
    })
})
