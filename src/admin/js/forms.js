import select2 from 'select2';
import jQuery from 'jquery';
import { Dropzone } from 'dropzone';
import 'select2/dist/css/select2.css';
import 'dropzone/dist/basic.css';

jQuery(document).ready(function () {
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
		jQuery('#get-tecnologies').val('');
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
		jQuery('#get-tecnologies').val('');
		jQuery('#get-tecnologies').val(JSON.stringify(newValue));
		//console.log(jQuery('#get-tecnologies').val());
	});
});
const myDropzone = new Dropzone('#dropzone-file', {
	url: thinkus_employee_admin_ajax.upload_file,

	params: {
		'mwp-dropform-nonce': jQuery('#mwp-dropform-nonce').val(),
	},
	dictDefaultMessage: 'Actualizar HV',
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
	success: async function (file, response) {
		// handle your response object
		file['attachment_id'] = response.attachment_id; // adding uploaded ID to file object
		console.log(
			response,
			document.getElementById('file-id').parentNode.children
		);
		Array.from(document.getElementById('file-id').parentNode.children).forEach(
			(el) => {
				console.log('b');
				if (el.classList.contains('show')) {
					el.classList.remove('show');
				}
			}
		);
		file.previewElement.classList.add('dz-success');
		jQuery('#file-id').val(response.data[0]);
		console.log(response.data[0]);
		//file.previewElement.classList.add('dz-error');
		if (typeof response.data[0] == 'number') {
			await jQuery.ajax({
				type: 'POST',
				url: thinkus_employee_admin_ajax.resume_file,
				data: {
					resume_id: jQuery('#file-id').val(),
					'mwp-dropform-nonce': jQuery('#mwp-dropform-nonce').val(),
				},
				// handle response from server
				success: function (res) {
					// handle your response object
					console.log(res);
					jQuery('#resume_file').attr('href', res.data);
				},
			});
		}
	},
	removedfile: function (file) {
		var _ref;

		// AJAX request for attachment removing
		jQuery.ajax({
			type: 'POST',
			url: thinkus_employee_admin_ajax.delete_file,
			data: {
				file_id: jQuery('#file-id').val(),
				'mwp-dropform-nonce': jQuery('#mwp-dropform-nonce').val(),
			},
			// handle response from server
			success: function (response) {
				// handle your response object
				console.log(response);
				jQuery('#file-id').val('');
				jQuery('#resume_file').attr('href', '');
			},
		});

		return (_ref = file.previewElement) != null
			? _ref.parentNode.removeChild(file.previewElement)
			: void 0;
	},
});
