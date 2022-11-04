// core version + navigation, pagination modules:
import Swiper, { Navigation, Pagination, EffectFade, Autoplay } from 'swiper';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
//import 'swiper/css/effect-fade';

// init Swiper:
if (document.getElementById('offer-list')) {
	const offerlist = new Swiper('#offer-list', {
		// configure Swiper to use modules
		modules: [EffectFade, Autoplay],

		autoplay: {
			delay: 5000,
		},
		breakpoints: {
			// when window width is >= 320px
			0: {
				slidesPerView: 1,
				spaceBetween: 20,
			},
			// when window width is >= 480px
			768: {
				slidesPerView: 2,
				spaceBetween: 10,
			},
			992: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			1129: {
				slidesPerView: 2,
				spaceBetween: 40,
			},
		},
	});
}
