//const emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
const regFName = /^(?=(\p{Lu}))(?! )(?!.*  .*)[\p{L}' -]*[\p{L}'-]$/u;
const regLName = /^(?! )(?!.*  .*)[\p{Lu}][\p{L}' -]*[\p{L}'-]$/u;
const regGeneral = /^[\p{L}0-9-_(){}~#:'@*\/&^%$£"!]+[\p{L}0-9 -_(){}~#,.:;'@*\/&^%$£"!]*$/u;

let apiEnabled = false;

const apiSwitch = document.querySelector('.leftmenu_header');
apiSwitch.addEventListener('click', (e) => {
		apiEnabled = !apiEnabled;
		
		if(apiEnabled)
			apiSwitch.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 0, 0, 0.8)";
		else
			apiSwitch.style.boxShadow = null;
});

const fname = document.querySelector('#fname');
const lname = document.querySelector('#lname');
const email = document.querySelector('#email');
const phone = document.querySelector('#phone');
const subject = document.querySelector('#subject');
const msg = document.querySelector('#msg');
const submit = document.querySelector('#submit');
const responsemsg = document.querySelector('#response');

const errfname = 1;
const errlname = 2;
const erremail = 4;
const errphone = 8;
const errsubject = 16;
const errmsg = 32;

let errorCode = 0;

const response_fname = "\ninvalid first name";
const response_lname = "\ninvalid last name";
const response_email = "\ninvalid EMail address";
const response_phone = "\ninvalid phone number";
const response_subject = "\ninvalid subject";
const response_msg = "\ninvalid message";

fname.addEventListener('keyup', removeError);
lname.addEventListener('keyup', removeError);
email.addEventListener('keyup', removeError);
phone.addEventListener('keyup', removeError);
subject.addEventListener('keyup', removeError);
msg.addEventListener('keyup', removeError);

function removeError(e){
	switch(e.currentTarget){
		case fname:
			if(errorCode & errfname)
				errorCode ^= errfname;
			break;
		case lname:			
			if(errorCode & errlname)
				errorCode ^= errlname;
			break;
		case email:
			if(errorCode & erremail)
				errorCode ^= erremail;
			break;
		case phone:
			if(errorCode & errphone)
				errorCode ^= errphone;
			break;
		case subject:
			if(errorCode & errsubject)
				errorCode ^= errsubject;
			break;
		case msg:
			if(errorCode & errmsg)
				errorCode ^= errmsg;
			break;
	}
	
	showError();
}

function showSuccess(success){
	if(success){
		responsemsg.innerText = "Message sent successfully";
		responsemsg.style.boxShadow = "inset 0px 0px 15px 2px rgba(0, 255, 0, 0.8)";
		responsemsg.style.visibility = "visible";
	}
}

function showError(){
	if(errorCode > 0){
		responsemsg.innerText = "There is an error:";
		responsemsg.style.visibility = "visible";
		responsemsg.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 0, 0, 0.8)";
	} else {
		responsemsg.style.visibility = "hidden";
	}
	
	if(errorCode & errfname){
		fname.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 0, 0, 0.8)";
		responsemsg.innerText += response_fname;
	} else{
		fname.style.boxShadow = "inset 0px 0px 15px 2px rgba(0, 255, 0, 0.8)";
	}
	
	if(errorCode & errlname){
		lname.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 0, 0, 0.8)";
		responsemsg.innerText += response_lname;
	} else{
		lname.style.boxShadow = "inset 0px 0px 15px 2px rgba(0, 255, 0, 0.8)";
	}
	
	if(errorCode & erremail){
		email.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 0, 0, 0.8)";
		responsemsg.innerText += response_email;
	} else{
		email.style.boxShadow = "inset 0px 0px 15px 2px rgba(0, 255, 0, 0.8)";
	}
	
	if(errorCode & errphone){
		phone.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 0, 0, 0.8)";
		responsemsg.innerText += response_phone;
	} else{
		phone.style.boxShadow = "inset 0px 0px 15px 2px rgba(0, 255, 0, 0.8)";
	}
	
	if(errorCode & errsubject){
		subject.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 0, 0, 0.8)";
		responsemsg.innerText += response_subject;
	} else{
		subject.style.boxShadow = "inset 0px 0px 15px 2px rgba(0, 255, 0, 0.8)";
	}
	
	if(errorCode & errmsg){
		msg.style.boxShadow = "inset 0px 0px 15px 2px rgba(255, 0, 0, 0.8)";
		responsemsg.innerText += response_msg;
	} else{
		msg.style.boxShadow = "inset 0px 0px 15px 2px rgba(0, 255, 0, 0.8)";
	}
	
	return errorCode;
}

function validateForm(){
	
	let success = true;

	function ecallback(response){	
		let mailObj = JSON.parse(response);
	    if(mailObj['deliverability'] !== 'DELIVERABLE')
			errorCode |= erremail;
		
		if(showError())
			success = false;
			
		showSuccess(success);
		
		if(phonenum !== "")
			setTimeout(httpGetAsync, 1100, phoneurl, pcallback);
	}
	
	function pcallback(response){
		let phoneObj = JSON.parse(response);
	    if(phoneObj['valid'] !== true)
			errorCode |= errphone;
		
		if(showError())
			success = false;
			
		showSuccess(success);
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

	function validateNames(){
		if(!regFName.test(fname.value)){
			errorCode |= errfname;
		}
		if(!regLName.test(lname.value)){
			errorCode |= errlname;
		}
		
		if(showError())
			success = false;
	}
	
	function validateGeneral(){
		if(!regGeneral.test(subject.value)){
			errorCode |= errsubject;
		}		
		if(!regGeneral.test(msg.value)){
			errorCode |= errmsg;
		}
		
		if(showError())
			success = false;
	}
	
	validateNames();
	validateGeneral();
	if(apiEnabled)
		httpGetAsync(emailurl, ecallback);
		
	showSuccess(success);
}