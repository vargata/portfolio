var vert = 0;
var horz = 0;
var scale = 0;
		
function clicked(e) {
	if(window.innerWidth < 770){
		vert = 0;
		horz = 0;
		scale = 160;
	} else if(window.innerWidth < 1260 && window.innerWidth > 770){
		scale = 180;
		switch(e.currentTarget.id.charAt(e.currentTarget.id.length - 1)){
			case "1": vert = 18; horz = 12;
				break;
			case "2": vert = 18; horz = -12;
				break;
			case "3": vert = 0; horz = 12;
				break;
			case "4": vert = 0; horz = -12;
				break;
			case "5": vert = -18; horz = 12;
				break;
			case "6": vert = -18; horz = -12;
				break;			
		}
	} else if(window.innerWidth >= 1260){
		scale = 220;
		switch(e.currentTarget.id.charAt(e.currentTarget.id.length - 1)){
			case "1": vert = 7; horz = 11;
				break;
			case "2": vert = 7; horz = 0;
				break;
			case "3": vert = 7; horz = -11;
				break;
			case "4": vert = -7; horz = 11;
				break;
			case "5": vert = -7; horz = 0;
				break;
			case "6": vert = -7; horz = -11;
				break;			
		}
	}
	
	if(e.currentTarget.style.zIndex == 0){
		e.currentTarget.classList.remove("hiddenbutton");
		e.currentTarget.style.zIndex = "4";
		e.currentTarget.style.position = "absolute";
		e.currentTarget.style.transform = "scale("+scale+"%) translate("+horz+"vw, "+vert+"vh)";
		document.getElementById("hidden_overlay").style.visibility = "visible";
	} else {
		e.currentTarget.classList.add("hiddenbutton");
		e.currentTarget.style.zIndex = "0";
		e.currentTarget.style.position = null;
		e.currentTarget.style.transform = null;
		document.getElementById("hidden_overlay").style.visibility = "hidden";
	}
}		

function initWindow(){
	for( i = 1; i <= 6; i++){
		document.getElementById("content" + i).classList.add("hiddenbutton");
		document.getElementById("content" + i).addEventListener("click", clicked);
	}
}

initWindow();