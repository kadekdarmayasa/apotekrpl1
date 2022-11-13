import search from './search.js';
import { deleteConfirmation } from './action-buttons.js';
import './dropdown.js';
search('obat');

window.addEventListener('click', (event) => {
	if (event.target.classList.contains('detail')) {
		let namaObat = event.target.dataset.namaobat;
		let keterangan = event.target.dataset.keterangan;
		let kategoriObat = event.target.dataset.kategoriobat;
		let hargaJual = event.target.dataset.hargajual;
		let hargabeli = event.target.dataset.hargabeli;
		let stokObat = event.target.dataset.stokobat;
		Swal.fire({
			icon: 'info',
			html: `
							<h2>${namaObat}</h2>
							<p class='keterangan-obat-detail'>${kategoriObat}</p><br> 
							<p>${keterangan}</p><br>
							<div class="detail-price-stok">
								<div class="hargajual-detail">
									<p>Harga Jual</p>
									<p>Rp. ${hargaJual}</p>
								</div>
								<div class="hargabeli-detail">
									<p>Harga Beli</p>
									<p>Rp. ${hargabeli}</p>
								</div>
								<div class="stokobat-detail">
									<p>Stok Obat</p>
									<p>Rp. ${stokObat}</p>
								</div>
							</div>
						`,
			showConfirmButton: false,
			showCloseButton: true,
		});
	}

	if (event.target.id == 'add-button') {
		Swal.fire({
			template: '#tambah-data-obat',
		});
	}

	if (event.target.id == 'delete-btn') {
		const name = event.target.dataset.name;
		const value = event.target.dataset.idobat;
		deleteConfirmation(name, value);
	}
});
