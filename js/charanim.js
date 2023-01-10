var MatrixFont = new FontFace("Matrix Code NFI", "url(../font/matrix code nfi.ttf)");
var inputs = document.querySelectorAll('input');

inputs.forEach((input) => {
	input.addEventListener('input', updateValue);
});

var textbox = document.querySelector('textarea');
textbox.addEventListener('input', updateValue);

var id = null;
var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890@ \'\"\&\\$+-*/=%#_(),.;:?!|{}<>[]^~";
var lastloc = null;
var lastchar = null;
var lasttext = null;

function updateValue(e) {
	if(charset.includes(e.data)){
		e.target.style.fontFamily = "MatrixFont";
		if(id !== null){		
			clearInterval(id);
			id = null;
			e.target.value = lasttext.substring(0, lastloc) + lastchar + e.data;
			e.target.style.fontFamily = "Arial";
		}
		id = setInterval(spinChar, 50);
		var counter = 5;
		var location = lastloc = e.target.value.length - 1;
		lastchar = e.data;
		lasttext = e.target.value;
	
		function spinChar(){
			e.target.value = e.target.value.substring(0, location) + charset.charAt(Math.random() * charset.length - 1);
			counter -= 1;
			if(counter < 1){
				clearInterval(id);
				id = null;
				e.target.value = e.target.value.substring(0, location) + e.data;
				e.target.style.fontFamily = "Arial";
			}
		}
	}
}