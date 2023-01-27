//const emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validateForm(){
	
	const fname = document.querySelector('#fname');
	const lname = document.querySelector('#lname');
	const email = document.querySelector('#email');
	const phone = document.querySelector('#phone');
	const subject = document.querySelector('#subject');
	const msg = document.querySelector('#msg');
	const submit = document.querySelector('#submit');

	function ecallback(response){	
		let matches = response.match(/"deliverability":"([a-zA-Z]*)"/);
	    if(matches[1] !== 'DELIVERABLE')
			email.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 100, 100, 0.8)";
		
		if(phonenum !== "")
			setTimeout(httpGetAsync, 1000, phoneurl, pcallback);
	}
	
	function pcallback(response){
		let matches = response.match(/"valid":([a-zA-Z]*)/);
	    if(matches[1] !== 'true')
			phone.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 100, 100, 0.8)";
	}

	function httpGetAsync(url, callback) {
    	var xmlHttp = new XMLHttpRequest();
    	xmlHttp.onreadystatechange = function() {
        	if (xmlHttp.readyState === 4 && xmlHttp.status === 200)
        	callback(xmlHttp.responseText);
    	}
    	xmlHttp.open("GET", url, true);
    	xmlHttp.send(null);
	}
	
	let emailurl = "https://emailvalidation.abstractapi.com/v1/?api_key=b3bf35ba5f464bf28cfcd751f842e575&email=" + email.value;

	let phonenum = phone.value;
	if(phonenum !== ""){
		phonenum.replace(" ","");
		phonenum.replace("-","");
		if(phonenum.match(/^0[0-9]*/)){
			phonenum = '+44' + phonenum.substring(1, phonenum.length);
		}
		phone.value = phonenum;
	}
	
	let phoneurl = "https://phonevalidation.abstractapi.com/v1/?api_key=83a5b70894184116ba83fed6d75a103c&phone=" + phonenum;

	//httpGetAsync(emailurl, ecallback);
}