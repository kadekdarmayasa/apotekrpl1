const cards = document.querySelectorAll('.card');

document.getElementById('add-button').addEventListener('click', function () {
	Swal.fire({
		template: '#tambah-data-obat',
	});
});

document.querySelectorAll('.detail').forEach(function (item) {
	item.addEventListener('click', function (event) {
		let namaObat = this.dataset.namaobat;
		let keterangan = this.dataset.keterangan;
		let kategoriObat = this.dataset.kategoriobat;
		let hargaJual = this.dataset.hargajual;
		let hargabeli = this.dataset.hargabeli;
		let stokObat = this.dataset.stokobat;
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
		event.preventDefault();
		event.stopPropagation();
	});
});

document.querySelectorAll('.update').forEach(function (item) {
	item.addEventListener('click', function (event) {});
});

document.getElementById('keyword').addEventListener('input', function () {
	const xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		document.querySelector('.cards').innerHTML = this.response;
	};
	xhr.open('GET', '../ajax/obat.php?key=' + this.value);
	xhr.send();
});

function confirmation(idpelanggan) {
	Swal.fire({
		icon: 'question',
		text: 'Apakah anda yakin ingin mengahapus obat ini?',
	}).then((result) => {
		if (result.isConfirmed) {
			location.href = '?idobat='.concat(idpelanggan);
		}
	});
}
