// import Swiper JS
import Swiper, { Navigation, Pagination, Scrollbar } from 'swiper';
 
// import Swiper styles
import 'swiper/swiper-bundle.css';

Swiper.use([Navigation, Pagination, Scrollbar]);

var swiper = new Swiper ('.swiper-container', {
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
})