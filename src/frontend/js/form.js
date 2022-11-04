import IMask from 'imask';
import intlTelInput from 'intl-tel-input';
import { Dropzone } from 'dropzone';
import validator from 'validator';
import select2 from 'select2';
import jQuery from 'jquery';
import Swal from 'sweetalert2';
import 'intl-tel-input/build/css/intlTelInput.css';
import 'dropzone/dist/basic.css';
import 'select2/dist/css/select2.css';

document.addEventListener('DOMContentLoaded', function () {
	Dropzone.autoDiscover = false;
	if (document.getElementById('postulation-form')) {
		const form = document.getElementById('postulation-form');
		const addStyles = document.createElement('STYLE');
		const projectUrl = thinkus_employee_front_ajax.project_url;
		addStyles.setAttribute('id', 'mapStyles');
		addStyles.type = 'text/css';
		addStyles.innerHTML = `.iti__flag {
        height: 15px;
        box-shadow: 0px 0px 1px 0px #888;
        background-image: url(${projectUrl}/assets/images/vendor/intl-tel-input/build/flags.png?007b2705c0a8f69dfdf6ea1bfa0341c9);
        background-repeat: no-repeat;
        background-color: #DBDBDB;
        background-position: 20px 0;
    }
    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100%;
    }
    .select2-container {
        box-sizing: border-box;
        display: block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        min-width: 100%  !important;
    }
    textarea.select2-search__field::placeholder{
        font-size:16px;
    }
    textarea.select2-search__field {
        font-size: 18px !important;
        margin: 6px 0px  !important;
        padding: 0px 16px !important;
    }
    `;
		document.getElementsByTagName('head')[0].appendChild(addStyles);
		const phone = document.getElementById('telephone');
		const tecnologies = document.getElementById('tecnologies');
		const salary = document.getElementById('salary');
		jQuery('#tecnologies').select2({
			placeholder: 'Tecnologías que maneja',
			tags: true,
			//multiple: true,
		});
		jQuery('#tecnologies').on('select2:select', function (event) {
			//	console.log(event);
			let newValue = [];
			let value = jQuery('#tecnologies').val();
			newValue.push(value);
			//	console.log(newValue);
			jQuery('#get-tecnologies').val(JSON.stringify(newValue[0]));
			//console.log(jQuery('#get-tecnologies').val());
		});
		jQuery('#tecnologies').on('select2:unselect', function (event) {
			let value = JSON.parse(jQuery('#get-tecnologies').val());
			//console.log(value);
			let unSelected = event.params.data.text;
			let newValue = value.filter((item) => {
				//console.log(item);
				return item != unSelected;
			});
			//console.log(unSelected);
			//console.log(newValue);

			jQuery('#get-tecnologies').val(JSON.stringify(newValue));
			//console.log(jQuery('#get-tecnologies').val());
		});
		const salaryMask = IMask(salary, {
			mask: [
				{
					mask: Number,
				},
			],
		});
		const phoneMask = IMask(phone, {
			mask: [
				{
					mask: '(000) 000-0000',
				},
				{
					mask: /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g,
				},
				{
					mask: Number,
				},
			],
		});
		const interPhone = intlTelInput(phone, {
			formatOnDisplay: true,
			nationalMode: false,
			separateDialCode: true,
			utilsScript: projectUrl + '/assets/js/frontend/utils.js',
			preferredCountries: ['co', 'in', 'de', 'us'],
			localizedCountries: [{ col: 'Colombia' }],
			initialCountry: 'co',
		});
		const myDropzone = new Dropzone('#dropzone-file', {
			url: thinkus_employee_front_ajax.upload_file,

			params: {
				'mwp-dropform-nonce': jQuery('#mwp-dropform-nonce').val(),
			},
			dictDefaultMessage: 'Adjuntar',
			maxFiles: 1,
			parallelUploads: 1,
			paramName: 'mwp-dropform-file', // name of file field
			acceptedFiles: '.doc,.docx,application/msword,application/pdf', // accepted file types
			maxFilesize: 5, // MB
			createImageThumbnails: false,
			addRemoveLinks: true,
			dictMaxFilesExceeded: 'Solo puedo subir un archivo.',
			dictFileTooBig:
				'Archivo muy pesado ({{filesize}}MiB). Tamaño máximo: {{maxFilesize}}MiB.',
			dictInvalidFileType: 'No puede subir este tipo de archivo',
			dictRemoveFile: 'Remover archivo',
			dictCancelUpload: 'Cancelar',
			dictUploadCanceled: 'Cancelado.',
			error: function (file, response) {
				file.previewElement.classList.add('dz-error');
			},
			success: function (file, response) {
				// handle your response object
				file['attachment_id'] = response.attachment_id; // adding uploaded ID to file object
				console.log(
					response,
					document.getElementById('file-id').parentNode.children
				);
				Array.from(
					document.getElementById('file-id').parentNode.children
				).forEach((el) => {
					console.log('b');
					if (el.classList.contains('show')) {
						el.classList.remove('show');
					}
				});
				file.previewElement.classList.add('dz-success');
				jQuery('#file-id').val(response.data[0]);
				//file.previewElement.classList.add('dz-error');
			},
			removedfile: function (file) {
				var _ref;

				// AJAX request for attachment removing
				jQuery.ajax({
					type: 'POST',
					url: thinkus_employee_front_ajax.delete_file,
					data: {
						file_id: jQuery('#file-id').val(),
						'mwp-dropform-nonce': jQuery('#mwp-dropform-nonce').val(),
					},
					// handle response from server
					success: function (response) {
						// handle your response object
						console.log(response);
						jQuery('#file-id').val('');
					},
				});

				return (_ref = file.previewElement) != null
					? _ref.parentNode.removeChild(file.previewElement)
					: void 0;
			},
		});
		const actionMessage = (className, element, action) => {
			if (action == 'add') {
				if (element.id == 'telephone' && element.type == 'tel') {
					const parent = element.parentNode.parentNode;

					Array.from(parent.children).forEach((children) => {
						if (children.classList.contains(className)) {
							children.classList.add('show');
						}
					});
				} else {
					const parent = element.parentNode;
					Array.from(parent.children).forEach((children) => {
						if (children.classList.contains(className)) {
							children.classList.add('show');
						}
					});
				}
			} else {
				if (element.type != 'button' && element.type != 'submit') {
					element.addEventListener('change', () => {
						if (element.id == 'telephone' && element.type == 'tel') {
							const parent = element.parentNode.parentNode;
							Array.from(parent.children).forEach((children) => {
								if (children.classList.contains('show')) {
									children.classList.remove('show');
								}
							});
						} else {
							const parent = element.parentNode;
							Array.from(parent.children).forEach((children) => {
								if (children.classList.contains('show')) {
									children.classList.remove('show');
								}
							});
						}
					});
				}
			}
		};
		const inputs = Array.from(form.elements);
		//console.log(inputs);
		inputs.forEach(function (element, i) {
			actionMessage('show', element, 'remove');
		});
		form.addEventListener('submit', function (event) {
			event.preventDefault();

			let inputsSuccess = Array.from(this.elements).map(function (element, i) {
				if (element.type != 'button' && element.type != 'submit') {
					if (
						element.name != '' &&
						element.name != 'mwp-dropform-nonce' &&
						element.name != '_wp_http_referer'
					) {
						if (element.value != '') {
							if (element.type == 'email') {
								if (!validator.isEmail(element.value)) {
									actionMessage('wrong-format', element, 'add');
									return 'error';
								}
							}

							if (element.type == 'checkbox') {
								if (element.checked) {
									return { [element.name]: true };
								} else {
									return { [element.name]: false };
								}
							}
							if (element.id == 'telephone' && element.type == 'tel') {
								const phoneNumber = interPhone.getNumber(
									intlTelInputUtils.numberFormat.E164
								);
								return { [element.name]: phoneNumber };
							}
							return { [element.name]: element.value };
						} else {
							actionMessage('empty', element, 'add');
							return 'error';
						}
					}
				}
			});
			let values = inputsSuccess.filter((item, index) => {
				return inputsSuccess.indexOf(item) === index && item != undefined;
			});
			let fails = values.includes('error');
			if (!fails) {
				const formData = new FormData();
				values.forEach((value) => {
					formData.append(Object.keys(value), Object.values(value));
				});
				fetch(thinkus_employee_front_ajax.admin_ajax, {
					method: 'POST',
					body: formData,
				})
					.then((res) => res.json())
					.then((res) => {
						console.log(res);
						if (res.success) {
							Swal.fire({
								title: 'Gracias por Registrarse',
								text: 'Proximamente nos contactaremos con usted',
								icon: 'success',
								showCancelButton: false,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Aceptar',
							});
						}
						if (res.success == false) {
							Swal.fire({
								title: res.data.message,
								text: `${res.data.user} pronto nos contactaremos con usted`,
								icon: 'info',
								showCancelButton: false,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Aceptar',
							});
						}
					});
			}
		});
	}
});
