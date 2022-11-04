import * as Carousel from './carousels';
import * as Form from './form';
const getInformation = document.getElementById('getInformation');
const getFormulary = document.getElementById('getFormulary');
const offerContent = document.querySelector('.offer-container-wrapper');
const offerTrigggers = document.querySelectorAll('button.activer-offert');
const thinkusItemWrappers = document.querySelectorAll('.thinkus-item-wrapper');

document.addEventListener('DOMContentLoaded', function () {
	if (getInformation) {
		getInformation.style.width = `${offerContent.clientWidth}px`;
		offerTrigggers.forEach((offerTriggger, i) => {
			offerTriggger.addEventListener('click', () => {
				if (!getFormulary.classList.contains('active')) {
					getInformation.style.width = `0px`;
					getFormulary.classList.add('active');
					getInformation.classList.remove('active');
					offerTrigggers.forEach((button) => {
						button.innerHTML = 'Ver descripción de la oferta';
					});
					getFormulary.style.width = `${offerContent.clientWidth}px`;
				} else {
					getFormulary.classList.remove('active');
					getInformation.classList.add('active');
					getFormulary.style.width = `0px`;
					getInformation.style.width = `${offerContent.clientWidth}px`;
					offerTrigggers.forEach((button) => {
						button.innerHTML = 'Postúlate aquí';
					});
				}
				console.log(offerContent.clientWidth);
			});
		});
	}
});
if (thinkusItemWrappers) {
	let heights = Array.from(thinkusItemWrappers).map((thinkusItemWrapper, i) => {
		return thinkusItemWrapper.clientHeight;
	});
	const uniqueHeights = [...new Set(heights)]; // Array sin duplicados
	console.log(uniqueHeights);
	const height = Math.max(...uniqueHeights);
	thinkusItemWrappers.forEach((element) => {
		element.style.height = `${height}px`;
	});
}
