import search from './search.js';
import { deleteConfirmation } from './action-buttons.js';
import './dropdown.js';
search('pelanggan');

window.addEventListener('click', (event) => {
	if (event.target.id == 'add-button') {
		Swal.fire({
			template: '#tambah-data-pelanggan',
		});
	}

	if (event.target.classList.contains('foto-resep')) {
		Swal.fire({
			imageUrl: '../assets/img/' + event.target.dataset.fotoresep,
			padding: '1em',
			showConfirmButton: false,
		});
	}

	if (event.target.id == 'delete-btn') {
		const name = event.target.dataset.name;
		const value = event.target.dataset.idpelanggan;
		deleteConfirmation(name, value);
	}
});
