$(function () {
    var lastLi = $('ol.breadcrumb').children().last();
    var aOfLastLi = $(lastLi).children();
    lastLi.addClass('active').text(aOfLastLi.text());
    aOfLastLi.remove();
});

$(function () {
    if ($("#modalSelectRol").length > 0) {
        var isshow = sessionStorage.getItem('isshow');
        if (isshow == null) {
            sessionStorage.setItem('isshow', 1);
            $('#modalSelectRol').modal({
                backdrop: 'static',
                keyboard: false
            }).show();
        }
        $("input[type='radio']").change(function () {
            $("button[type='submit']").prop("disabled", false);
            $("button[type='submit']").toggleClass("btn-danger btn-success");
        });
    }
});

$(function () {
    $("a[href$='logOut']").click(function () {
        sessionStorage.clear();
    });
});