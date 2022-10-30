import search from './search.js';
import { deleteConfirmation } from './action-buttons.js';
import './dropdown.js';
search('pelanggan');
const recipePhotos = document.querySelectorAll('.foto-resep');

recipePhotos.forEach(function (item) {
	item.addEventListener('click', function (event) {
		Swal.fire({
			imageUrl: '../assets/img/' + this.dataset.fotoresep,
			padding: '1em',
			showConfirmButton: false,
		});

		event.stopPropagation();
		event.preventDefault();
	});
});

document.querySelectorAll('#delete-btn').forEach(function (btn) {
	btn.addEventListener('click', function () {
		const name = this.dataset.name;
		const value = this.dataset.idpelanggan;
		deleteConfirmation(name, value);
	});
});

document.getElementById('add-button').addEventListener('click', function () {
	Swal.fire({
		template: '#tambah-data-pelanggan',
	});
});
