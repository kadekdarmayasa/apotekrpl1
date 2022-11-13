const arrowDown = document.querySelector('.arrow-down');
const dropdown = document.querySelector('.dropdown');
let state = false;

const toggleDropDown = () => (state == true ? hideDropDown() : showDropDown());

const hideDropDown = () => {
	dropdown.style.opacity = '0';
	dropdown.style.display = 'none';
	state = false;
};

const showDropDown = () => {
	dropdown.style.opacity = '1';
	dropdown.style.display = 'flex';
	state = true;
};

arrowDown.addEventListener('click', (event) => {
	toggleDropDown();
	event.stopPropagation();
});

window.addEventListener('click', () => {
	if (dropdown.style.opacity == '1') {
		dropdown.style.opacity = '0';
	}
});
