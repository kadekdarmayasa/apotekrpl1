const arrowDown = document.querySelector('.arrow-down');
const dropdown = document.querySelector('.dropdown');
let state = false;

const toggleDropDown = function () {
	if (state == true) {
		dropdown.style.opacity = '0';
		dropdown.style.display = 'none';
		state = false;
	} else {
		dropdown.style.opacity = '1';
		dropdown.style.display = 'flex';
		state = true;
	}
};

arrowDown.addEventListener('click', function (e) {
	toggleDropDown();
	e.stopPropagation();
});

window.addEventListener('click', function (e) {
	if (dropdown.style.opacity == '1') {
		dropdown.style.opacity = '0';
	}
});
