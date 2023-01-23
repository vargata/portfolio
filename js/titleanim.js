const titles = document.querySelectorAll('.titletext');
const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890 @\'\"\&\\$+-*/=%#_(),.;:?!|{}<>[]^~";

titles.forEach( (item) => {
	const originalText = item.innerText;
	for( i = 0; i < item.innerText.length; i++){
		item.innerText = item.innerText.substring(0, i) + (Math.floor(Math.random() * 2)) + item.innerText.substring(i+1, item.innerText.length);
	}
	
	let textIndex = 0;
	setTimeout(spinText, 10);
	
	function spinText(){
		let charIndex = 0;
		setTimeout(spinChar,10);
		
		function spinChar() {
			item.innerText = item.innerText.substring(0, textIndex) + charset.charAt(Math.random() * charset.length - 1) + item.innerText.substring(textIndex + 1, item.innerText.length);
			if(charIndex < 5) {
				charIndex++;
				setTimeout(spinChar, 10);
			} else {
				item.innerText = item.innerText.substring(0, textIndex) + originalText.charAt(textIndex) + item.innerText.substring(textIndex + 1, item.innerText.length);
				if(textIndex < originalText.length - 1){
					textIndex++;
					setTimeout(spinText, 10);
				}
			}
		}
	};
})