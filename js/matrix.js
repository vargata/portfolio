const canvas = document.getElementById('background');
const bg = canvas.getContext('2d');

const MatrixFont = new FontFace("Matrix Code NFI", "url(../font/matrix code nfi.ttf)");

initwindow();

function matrix() {	
	bg.fillStyle = '#0001';
	bg.fillRect(0, 0, w, h);
	
	bg.fillStyle = '#0a0';
	
	ypos.forEach((y, ind) => {
		let text = String.fromCharCode(Math.random() * 128);
		let x = ind * 20;
		bg.fillText(text, x, y);
		if (y > 100 + Math.random() * 10000)
			ypos[ind] = 0;
		else
			ypos[ind] = y + 20;
	});
}

function initwindow() {
	w = canvas.width = document.body.clientWidth;
	h = canvas.height = document.body.clientHeight;
	cols = Math.floor(w / 20) + 1;
	ypos = Array(cols).fill(0);

	bg.fillStyle = '#000';
	bg.fillRect(0, 0, w, h);

	bg.font = "18px MatrixFont";
}

setInterval(matrix, 50);

window.addEventListener("resize", initwindow);