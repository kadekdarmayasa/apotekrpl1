import search from './search.js';
import { deleteConfirmation } from './action-buttons.js';
import './dropdown.js';
search('karyawan');

window.addEventListener('click', (event) => {
	if (event.target.id == 'add-button') {
		Swal.fire({
			template: '#tambah-data-karyawan',
		});
	}

	if (event.target.id == 'delete-btn') {
		const name = event.target.dataset.name;
		const value = event.target.dataset.idkaryawan;
		deleteConfirmation(name, value);
	}
});
