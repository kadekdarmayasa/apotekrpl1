let isActive = false;

window.addEventListener('click', (event) => {
	if (event.target.classList.contains('button-menu')) {
		if (isActive == false) {
			event.target.nextElementSibling.style.display = 'flex';
			event.target.nextElementSibling.style.opacity = '1';
			isActive = true;
		} else {
			event.target.nextElementSibling.style.display = 'none';
			event.target.nextElementSibling.style.opacity = '0';
			isActive = false;
		}
	}
});

export const deleteConfirmation = (name, value) => {
	Swal.fire({
		icon: 'question',
		text: 'Apakah anda yakin ingin mengahapus data ini?',
		showCancelButton: true,
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Iya',
	}).then((result) => {
		if (result.isConfirmed) {
			location.href = `?${name}=${value}`;
		}
	});
};
