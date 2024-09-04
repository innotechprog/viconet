var reset_pass = document.getElementById('resetBtn');
var password = document.getElementById('userPassword');
var confPassword = document.getElementById('userConfPassword');
//Password variables
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var chars = document.getElementById("chars");
var length = document.getElementById("length");


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

function checkPassword(){

 var lowerCaseLetters = /[a-z]/g;
 var upperCaseLetters = /[A-Z]/g;
 var numbers = /[0-9]/g;
 var passChars = /^[a-z][A-Z][0-9][!@#$%^&*]{8,16}$/;
 var passChar = /[!@#$%^&*+-/\|]/g;

  if(password.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }

  if(password.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

// Validate numbers
  if(password.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(password.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }

  if(password.value.match(passChar)) {  
    chars.classList.remove("invalid");
    chars.classList.add("valid");
  } else {
    chars.classList.remove("valid");
    chars.classList.add("invalid");
  }
	const inputControl= password.parentElement;
  if(password.value.match(passChar) && password.value.length >= 8 && password.value.match(numbers) && password.value.match(upperCaseLetters) && password.value.match(lowerCaseLetters)){
  	
inputControl.classList.add('success');
inputControl.classList.remove('error');
return true;
  }
  else{
  inputControl.classList.add('error');
inputControl.classList.remove('success');
return false;
  }

}
password.onfocus = function(){
	checkPassword();
	document.getElementById("error_m").style.display = "block";
}

password.onblur = function(){
document.getElementById("error_m").style.display = "none";
}

//Confirm password
function checkConfirmPassword(){
if(confPassword.value == password.value)
{
	successFul(confPassword, '');
	return true;
	
}
else{
	errors(confPassword, 'Password do not match');
	return false;
}
}
confPassword.onfocus = function(){
	checkConfirmPassword();
}

setInterval(function(){
if(checkPassword()== true && checkConfirmPassword()==true){
reset_pass.disabled = false;
}
else{
reset_pass.disabled = true;	
}
},200);