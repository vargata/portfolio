setInterval(flashing, 5);

const button = document.querySelector('.mobile_menu');
const buttonbg = document.querySelector('.mobile_bg');
const page = document.querySelector('.content_container');
const menu = document.querySelector('.leftmenu_container');
let effect = 1;
let isOpen = false;

function flashing(){
	button.style.backgroundImage = "linear-gradient(90deg, #000 0%, #0f0 "+effect+"%, #000 100%)";
	if(isOpen){
		effect--;
		if(effect === 0) effect = 99;
	} else{
		effect++;
		if(effect === 100) effect = 1;
	}	
}

function showMenu(){
	if(isOpen){
		menu.style.display = null;
		menu.style.position = null;
		page.style.transform = null;
		button.innerText = "\u232A\u232A\u232A";
		buttonbg.style.left = "10px";
		isOpen = false;
	}else{
		menu.style.display = "block";
		menu.style.position = "absolute";
		button.innerText = "\u2329\u2329\u2329";
		page.style.transform = "translateX(200px)";
		buttonbg.style.left = "200px";
		isOpen = true;
	}
}