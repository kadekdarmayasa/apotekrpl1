import search from './search.js';
import { deleteConfirmation } from './action-buttons.js';
import './dropdown.js';
search('karyawan');

document.getElementById('add-button').addEventListener('click', function () {
	Swal.fire({
		template: '#tambah-data-karyawan',
	});
});

document.querySelectorAll('#delete-btn').forEach(function (btn) {
	btn.addEventListener('click', function () {
		const name = this.dataset.name;
		const value = this.dataset.idkaryawan;
		deleteConfirmation(name, value);
	});
});
