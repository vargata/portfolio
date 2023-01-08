function show($page){
	document.getElementById($page).classList.remove("hide");
	document.getElementById($page).classList.add("show");
	
	document.getElementById("hidden_overlay").style.visibility = "visible";
}

function hide($page){
	document.getElementById($page).classList.remove("show");
	document.getElementById($page).classList.add("hide");
	
	document.getElementById("hidden_overlay").style.visibility = "hidden";
}