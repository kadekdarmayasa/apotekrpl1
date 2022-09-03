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

function confirmation(idpelanggan) {
	Swal.fire({
		icon: 'question',
		text: 'Apakah anda yakin ingin mengahapus pelanggan ini?',
	}).then((result) => {
		if (result.isConfirmed) {
			location.href = '?idpelanggan='.concat(idpelanggan);
		}
	});
}

document.getElementById('add-button').addEventListener('click', function () {
	Swal.fire({
		template: '#tambah-data-pelanggan',
	});
});

const searchForm = document.getElementById('search');
searchForm.addEventListener('input', function () {
	const xhr = new XMLHttpRequest();

	xhr.onreadystatechange = function () {
		if (this.readyState == 4 || this.status == 200) {
			document.querySelector('.cards').innerHTML = this.response;
		}
	};

	xhr.open('GET', '../ajax/pelanggan.php?key=' + this.value);
	xhr.send();
});
