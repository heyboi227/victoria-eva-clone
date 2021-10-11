// Slider initialisation
document.addEventListener('DOMContentLoaded', function () {
    var splide = new Splide('#image-slider', {
        autoplay: true,
        rewind: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        cover: true,
        height: '89vh'
    });
    splide.mount();

    var secondSplide = new Splide('#image-slider-2', {
        autoplay: true,
        rewind: true,
        pauseOnHover: false,
        pauseOnFocus: false,
        cover: false,
        arrows: false,
        pagination: false,
        height: '370px'
    });
    secondSplide.mount();
});