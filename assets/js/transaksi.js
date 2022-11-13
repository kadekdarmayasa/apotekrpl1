import { deleteConfirmation } from './action-buttons.js';
import './dropdown.js';
import search from './search.js';
search('transaksi');

document.querySelectorAll('#delete-btn').forEach((btn) => {
	btn.addEventListener('click', function () {
		const name = this.dataset.name;
		const value = this.dataset.id_transaksi;
		deleteConfirmation(name, value);
	});
});
