$(function () {

    $('#objeto').bind('mousedown', function () {

        $('#objeto').bind('mousemove', function (e) {

            var x = e.pageX,
                y = e.pageY,
                width = $(this).width(),
                height = $(this).height();

            $(this).css({
                'left': (x - (width / 2)) + 'px',
                'top': (y - (height / 2)) + 'px'
            });


        });
    });

    $('#objeto').bind('mouseup', function () {
        $('#objeto').unbind('mousemove');
    });


});
