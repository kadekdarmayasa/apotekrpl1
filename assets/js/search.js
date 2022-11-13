const search = (page) => {
	document.getElementById('keyword').addEventListener('input', () => {
		const xhr = new XMLHttpRequest();
		xhr.onreadystatechange = () => {
			document.querySelector('.cards').innerHTML = this.response;
		};
		xhr.open('GET', `../ajax/${page}.php?key=` + this.value);
		xhr.send();
	});
};

export default search;
