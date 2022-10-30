import { deleteConfirmation } from './action-buttons.js';
import './dropdown.js';
import search from './search.js';
search('transaksi');

window.addEventListener('click', function (event) {
	if (event.target.classList.contains('detail')) {
		let tglTransaksi = event.target.dataset.tgl_transaksi;
		let kategoriPelanggan = event.target.dataset.kategori_pelanggan;
		let idKaryawan = event.target.dataset.idkaryawan;
		let idPelanggan = event.target.dataset.idpelanggan;
		let idTransaksi = event.target.dataset.idtransaksi;
		let totalBayar = event.target.dataset.totalbayar;
		let bayar = event.target.dataset.bayar;
		let kembali = event.target.dataset.kembali;

		Swal.fire({
			icon: 'info',
			html: `
            <h2>${tglTransaksi}</h2>
            <p class='keterangan-obat-detail'>${kategoriPelanggan}</p><br> 

            <div class="all-id">
              <div class="idkaryawan">
                <p>ID Karyawan</p>
                <h4>${idKaryawan}</h4>
              </div>
              <div class="idpelanggan">
                <p>ID Pelanggan</p>
                <h4>${idPelanggan}</h4>
              </div>
              <div class="idtransaksi">
                <p>ID Transaksi</p>
                <h4>${idTransaksi}</h4>
              </div>
            </div>

            <div class="pricing">
              <div class="bayar">
                <p>Bayar</p>
                <p>Rp. ${bayar}</p>
              </div>
              <div class="kembali">
                <p>Kembali</p>
                <p>Rp. ${kembali}</p>
              </div>
              <div class="total-bayar">
                <p>Total Bayar</p>
                <p>Rp. ${totalBayar}</p>
              </div>
            </div>

            

           
						`,
			showConfirmButton: false,
			showCloseButton: true,
		});
	}
});

document.querySelectorAll('#delete-btn').forEach(function (btn) {
	btn.addEventListener('click', function () {
		const name = this.dataset.name;
		const value = this.dataset.id_transaksi;
		deleteConfirmation(name, value);
	});
});
