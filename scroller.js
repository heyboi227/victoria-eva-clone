document.addEventListener("DOMContentLoaded", function () {
    var scroller = document.getElementsByClassName("scroll")[0];

    scroller.setAttribute("style", "opacity: 1; transition: opacity ease-in 0.5s;");

    scroller.addEventListener("mouseover", function () {
        scroller.setAttribute("style", "cursor: pointer; opacity: 1;");
    });
});