var windowWidth = screen.width;

if (windowWidth > 1087) {
    var swiper = new Swiper(".mySwiper5", {
        slidesPerView: 7,
        spaceBetween: 30,
        freeMode: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
} else if (windowWidth <= 1087 && windowWidth > 921) {
    var swiper = new Swiper(".mySwiper5", {
        slidesPerView: 6,
        spaceBetween: 30,
        freeMode: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
} else if (windowWidth <= 921 && windowWidth > 718) {
    var swiper = new Swiper(".mySwiper5", {
        slidesPerView: 5,
        spaceBetween: 30,
        freeMode: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
} else if (windowWidth <= 718 && windowWidth > 565) {
    var swiper = new Swiper(".mySwiper5", {
        slidesPerView: 4,
        spaceBetween: 30,
        freeMode: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
} else if (windowWidth <= 565 && windowWidth > 417) {
    var swiper = new Swiper(".mySwiper5", {
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
} else if (windowWidth <= 417) {
    var swiper = new Swiper(".mySwiper5", {
        slidesPerView: 2,
        spaceBetween: 30,
        freeMode: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
}



















