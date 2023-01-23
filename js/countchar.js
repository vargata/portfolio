const msg = document.querySelector('#msg');

msg.addEventListener('keyup', function(){
	document.querySelector('#charcount').innerText = msg.value.length + '/500';
});