let isActive = false;

window.addEventListener('click', function (event) {
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
