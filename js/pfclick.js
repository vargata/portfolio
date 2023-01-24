function initWindow(){
	for( i = 1; i <= 6; i++){
		let top = 0;
		let left = 0;
		let scale = 160;
		console.log(window);
		
		if(window.innerWidth < 1260 && window.innerWidth > 770){
			scale = 180;
			switch(i){
				case 1: top = 18; left = 12;
					break;
				case 2: top = 18; left = -12;
					break;
				case 3: top = 0; left = 12;
					break;
				case 4: top = 0; left = -12;
					break;
				case 5: top = -18; left = 12;
					break;
				case 6: top = -18; left = -12;
					break;			
			}
		} else if(window.innerWidth >= 1260){
			scale = 220;
			switch(i){
				case 1: top = 7; left = 11;
					break;
				case 2: top = 7; left = 0;
					break;
				case 3: top = 7; left = -11;
					break;
				case 4: top = -7; left = 11;
					break;
				case 5: top = -7; left = 0;
					break;
				case 6: top = -7; left = -11;
					break;			
			}
		}
		document.getElementById("content" + i).classList.add("hiddenbutton");
		
		document.getElementById("content" + i).addEventListener("click", (e) => {
			if(e.currentTarget.style.zIndex == 0){
				e.currentTarget.classList.remove("hiddenbutton");
				e.currentTarget.style.zIndex = "1";
				e.currentTarget.style.position = "absolute";
				e.currentTarget.style.transform = "scale("+scale+"%) translate("+left+"vw, "+top+"vh)";
			} else {
				e.currentTarget.classList.add("hiddenbutton");
				e.currentTarget.style.zIndex = "0";
				e.currentTarget.style.position = "absolute";
				e.currentTarget.style.transform = "scale(100%) translate(0vw, 0vh)";
			}
		});
	}
}

window.addEventListener("resize", initWindow);

initWindow();