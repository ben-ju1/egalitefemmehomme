window.addEventListener('DOMContentLoaded', function () {

    $('.menu').on('click', function () {
        $('#sub-menu-instruments').fadeToggle();
    });
    $('.menu2').on('click', function () {
        $('#sub-menu-instruments2').fadeToggle();
    });
    $('.menu3').on('click', function () {
        $('#sub-menu-instruments3').fadeToggle();
    });

    document.addEventListener('click', function (e) {
        if (document.querySelector('.menu') !== null) {
            let menu = document.querySelector('.menu');

            if (e.target !== menu && !menu.contains(e.target)) {
                $('#sub-menu-instruments').fadeOut();
            }
        }
        if (document.querySelector('.menu2') !== null) {
            let menu = document.querySelector('.menu2');

            if (e.target !== menu && !menu.contains(e.target)) {
                $('#sub-menu-instruments2').fadeOut();
            }
        }
        if (document.querySelector('.menu3') !== null) {
            let menu = document.querySelector('.menu3');

            if (e.target !== menu && !menu.contains(e.target)) {
                $('#sub-menu-instruments3').fadeOut();
            }
        }
    });
});