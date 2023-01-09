const content1 = document.getElementById("content1");

content1.addEventListener('transitionend', function() {
	if(window.getComputedStyle(content1).zIndex == 1)
		document.getElementById("link1").style.visibility = "visible";
	else
		document.getElementById("link1").style.visibility = "hidden";
		
}, false );

const content2 = document.getElementById("content2");

content2.addEventListener('transitionend', function() {
	if(window.getComputedStyle(content2).zIndex == 1)
		document.getElementById("link2").style.visibility = "visible";
	else
		document.getElementById("link2").style.visibility = "hidden";
		
}, false );

const content3 = document.getElementById("content3");

content3.addEventListener('transitionend', function() {
	if(window.getComputedStyle(content3).zIndex == 1)
		document.getElementById("link3").style.visibility = "visible";
	else
		document.getElementById("link3").style.visibility = "hidden";
		
}, false );

const content4 = document.getElementById("content4");

content4.addEventListener('transitionend', function() {
	if(window.getComputedStyle(content4).zIndex == 1)
		document.getElementById("link4").style.visibility = "visible";
	else
		document.getElementById("link4").style.visibility = "hidden";
		
}, false );

const content5 = document.getElementById("content5");

content5.addEventListener('transitionend', function() {
	if(window.getComputedStyle(content5).zIndex == 1)
		document.getElementById("link5").style.visibility = "visible";
	else
		document.getElementById("link5").style.visibility = "hidden";
		
}, false );

const content6 = document.getElementById("content6");

content6.addEventListener('transitionend', function() {
	if(window.getComputedStyle(content6).zIndex == 1)
		document.getElementById("link6").style.visibility = "visible";
	else
		document.getElementById("link6").style.visibility = "hidden";
		
}, false );