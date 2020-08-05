$("i").click(
    function () {
        if ($(this).hasClass("fa-plus-circle")) {
            $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
        } else {
            if ($(this).hasClass("fa-minus-circle")) {
                $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
            }
        }
    });