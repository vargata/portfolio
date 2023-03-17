$(document).ready(function(){
    $("#contact_form").on("submit", function(event){
        event.preventDefault();
        addLoadEffect();
 
 		if(validate()){
	        var formValues = $(this).serialize();
	 
	        $.post("formhandler.php", formValues, function(data){
	            showReturn(data);
        
    			removeLoadEffect();
	        });
        }
	
		$("#resultdiv").css("display", "block");
		location.href="#resultdiv";
    });
});

let loadingbutton = document.querySelector("#submit");

function addLoadEffect(){
	loadingbutton.value = "Sending";
	loadingbutton.setAttribute("disabled", "disabled");
}

function removeLoadEffect(){
	loadingbutton.value = "Submit";
	loadingbutton.removeAttribute("disabled");
}

function showReturn(data){
	$("#resultdiv").html(data);
	            
    if ($("#resultdiv:contains('phone')").length > 0){
		$("#phone").addClass('error');
	} else {
		$("#phone").removeClass('error');
	}
	
	if ($("#resultdiv:contains('email')").length > 0){
		$("#email").addClass('error');
	} else {
		$("#email").removeClass('error');
	}
	
	if ($("#resultdiv:contains('name')").length > 0){
		$("#name").addClass('error');
	} else {
		$("#name").removeClass('error');
	}
	
	if ($("#resultdiv:contains('company')").length > 0){
		$("#company").addClass('error');
	} else {
		$("#company").removeClass('error');
	}
	
	if ($("#resultdiv:contains('subject')").length > 0){
		$("#subject").addClass('error');
	} else {
		$("#subject").removeClass('error');
	}
	
	if ($("#resultdiv:contains('message')").length > 0){
		$("#msg").addClass('error');
	} else {
		$("#msg").removeClass('error');
	}
	
	if ($("#resultdiv:contains('success')").length > 0){
		$("#name").val("");
		$("#company").val("");
		$("#email").val("");
		$("#phone").val("");
		$("#subject").val("");
		$("#msg").val("");
		$("#marketing").prop("checked", false);
		$("#resultdiv").removeClass('error');
		$("#resultdiv").addClass('success');
	} else {		
		$("#resultdiv").removeClass('success');
		$("#resultdiv").addClass('error');
	}
}

function validate(){
	const namereg = /^(?![\- ])(?!.*  )[ \-'\p{L}]+ [ \-'\p{L}]{2,}(?<![\- ])$/u;
	const coreg = /^(?! )(?!.*  )[ \d\p{P}\p{S}\p{L}]+(?<![\- ])$/u;
	const subreg = /^(?! )(?!.*  )[ \d\p{P}\p{S}\p{L}]+(?<![\- ])$/u
	const msgreg = /^(?!\s)(?!.*  )(?!.*\s\s\s)[\s\d\p{P}\p{S}\p{L}]+(?<![\s\-])$/u
	const emailreg = /^(?!\.)[\p{L}0-9\*\+\-\.!#$%&'/=?^_`{|}~]+(?<!\.)@(?![0-9\-])[\p{L}0-9\-]{2,}\.\p{L}{2,}$/u;
	const shortpreg = /^0[0-9]{10}$/;
	const longpreg = /^\+44[0-9]{10}$/
	
	let error = "";
	let retval = true;
	
	if(!namereg.test($("#name").val())){
		error += "<label class='msglabel'>xInvalid name!</label>";
		retval = false;
	}
	if(!coreg.test($("#company").val()) && $("#company").val() != ""){
		error += "<label class='msglabel'>xInvalid company!</label>";
		retval = false;
	}
	if(!subreg.test($("#subject").val())){
		error += "<label class='msglabel'>xInvalid subject!</label>";
		retval = false;
	}
	if(!msgreg.test($("#msg").val())){
		error += "<label class='msglabel'>xInvalid message!</label>";
		retval = false;
	}
	if(!emailreg.test($("#email").val())){
		error += "<label class='msglabel'>xNeed a valid email address.</label>";
		retval = false;
	}
	if(!shortpreg.test($("#phone").val()) && !longpreg.test($("#phone").val())){
		error += "<label class='msglabel'>xNot a valid phone number</label>";
        error += "<label class='msglabel'>has to have a format of 0xxxxxxxxxx</label>";
        error += "<label class='msglabel'>or +44xxxxxxxxxx</label>";
		retval = false;
	}
	
	if(!retval){
		showReturn(error);
    	removeLoadEffect();
	}
	
	return retval;
}