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
var type = document.getElementById('type');

function checkEmail(){
	var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(email.value.length==0)
	{
		email.onfocus = function(){
	errors(email,'Enter email');
	}
		return false;
	}
	else if(email.value.trim().match(mailformat) == null)
	{
		errors(email,'invalid email');
		return false;
	}
	{
		var u_data;
		var e = email.value;
		var u = "cand";
	
	  $.ajax({
			url:"check-email.php",
			method:"POST",
			data:{email:e,user:u},
			async: false,
			success: function userdata(data){
				u_data = data; 
			}
			});
		if(u_data == 1){
			successFul(email,'');
				return true;
		}
		else{
			
				errors(email,'Email does not exist');
		return false;
		}
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
