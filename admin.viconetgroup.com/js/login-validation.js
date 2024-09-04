login_btn = document.getElementById("login_btn");
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

var email = document.getElementById('user_email');

function checkEmail(){
	var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(email.value.length==0)
	{
		errors(email,'Enter email');
		return false;
	}
	else if(email.value.trim().match(mailformat) == null)
	{
		errors(email,'invalid email');
		return false;
	}
	else{		
		successFul(email,'');
		return true;
	} 
}
email.onfocus = function(){
	checkEmail();
}

const logInter = setInterval(function(){
if(checkEmail()== true)
{
	login_btn.disabled = false;
}
else{
login_btn.disabled = true;	
}
},200);
