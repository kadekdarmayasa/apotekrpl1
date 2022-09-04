document.getElementById('add-button').addEventListener('click', function () {
	Swal.fire({
		template: '#tambah-data-supplier',
	});
});

const confirmation = (idsupplier) => {
	Swal.fire({
		icon: 'question',
		text: 'Apakah anda yakin ingin mengahapus obat ini?',
	}).then((result) => {
		if (result.isConfirmed) {
			location.href = '?idsupplier='.concat(idsupplier);
		}
	});
};

document.getElementById('keyword').addEventListener('input', function () {
	const xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function () {
		document.querySelector('.cards').innerHTML = this.response;
	};
	xhr.open('GET', '../ajax/supplier.php?key=' + this.value);
	xhr.send();
});
