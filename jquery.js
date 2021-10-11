// Scroller animates the browser scrolling to the "Our Services" section
$("document").ready(function () {
    $(".scroll").click(function () {
        $("html, body").animate({
            scrollTop: $("#services").offset().top - 60
        });
    });
});