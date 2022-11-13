import search from './search.js';
import { deleteConfirmation } from './action-buttons.js';
import './dropdown.js';
search('supplier');

window.addEventListener('click', (event) => {
	if (event.target.id == 'add-button') {
		Swal.fire({
			template: '#tambah-data-supplier',
		});
	}

	if (event.target.id == 'delete-btn') {
		const name = event.target.dataset.name;
		const value = event.target.dataset.idsupplier;
		deleteConfirmation(name, value);
	}
});
