var next = document.getElementById('next');
var t_and_c = document.getElementById('userT_and_c');
var consent = document.getElementById('consent');

function errors(element,mess)
{ 
const inputControl= element.parentElement;

inputControl.classList.add('error');
inputControl.classList.remove('success');
const errorDisplay =  inputControl.querySelector('.error-message');

errorDisplay.innerText = mess;	
}
function successFul(element, mess)
{
const inputControl= element.parentElement;

inputControl.classList.add('success');
inputControl.classList.remove('error');
const errorDisplay =  inputControl.querySelector('.error-message');

errorDisplay.innerText = mess;	
}
///////

function checkTermsAndCond(){
	if(t_and_c.checked == true){
		successFul(t_and_c, '');
		return true;
	}
	else{
		errors(t_and_c, 'Check Terms and Conditions');
		return false;
	}
}
t_and_c.onchange = function(){
	checkTermsAndCond();
}
function checkConsent(){
	if(consent.checked == true){
		successFul(consent, '');
		return true;
	}
	else{
		errors(consent, 'Check POPIA consent notice');
		return false;
	}
}
consent.onchange = function(){
	checkConsent();
}

setInterval(function(){
if(checkConsent()==true && checkTermsAndCond()==true){
next.disabled = false;
}
else{
next.disabled = true;	
}
},200);