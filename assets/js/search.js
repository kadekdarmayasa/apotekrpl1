const search = (page) => {
	document.getElementById('keyword').addEventListener('input', function () {
		const xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function () {
			document.querySelector('.cards').innerHTML = this.response;
		};
		xhr.open('GET', `../ajax/${page}.php?key=` + this.value);
		xhr.send();
	});
};

export default search;
