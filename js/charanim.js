var inputs = document.querySelectorAll('input');

inputs.forEach((input) => {
	input.addEventListener('input', updateValue);
});

var textbox = document.querySelector('textarea');
textbox.addEventListener('input', updateValue);

var id = null;

function updateValue(e) {
	id = setInterval(spinChar, 50);
	let counter = 5;

	function spinChar(){
		e.target.value = e.target.value.substring(0, e.target.value.length - 1) + String.fromCharCode(Math.random() * 128);
		counter-=1;
		if(counter < 1){
			clearInterval(id);
			e.target.value = e.target.value.substring(0, e.target.value.length - 1) + e.data;
		}
	}
}