//declaring and assigning variables


//var email = document.myForm.userEmail;
//var name = document.myForm.userName; 
var surname = document.getElementById('userSurname');
var cellphone = document.getElementById('userCell');
var password = document.getElementById('userPassword');
var confPassword = document.getElementById('userConfPassword');
//var idNum = document.getElementById('userID');
var userCell = document.getElementById('phone');
//var nationality = document.getElementById('userNationality');
//var userDOB = document.getElementById('userDOB');
//var consentForm = document.getElementById('userConsentForm');
var t_and_c = document.getElementById('userT_and_c');
var consent = document.getElementById('consent');
var name2 = document.getElementById('userName');
var email = document.getElementById('userEmail')
var add_candidate = document.getElementById('add_candidate');
document.getElementById("error_m").style.display = "none";
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
//Errors for cellphone
function cellErrors(element,mess)
{
//const inputControl= element.parentElement;

element.classList.add('error');
element.classList.remove('success');
//const errorDisplay =  inputControl.querySelector('.error-message');
$('.err-mes').html(mess);

}
function cellSuccessFul(element, mess)
{
const inputControl= element.parentElement;

element.classList.add('success');
element.classList.remove('error');
//const errorDisplay =  inputControl.querySelector('.error-message');
$('.err-mes').html(mess);	
}


function checkName() {
var letters = /^[A-Za-z]+$/;
if (name2.value.length  === 0) {
errors(name2,'Name cannot be empty');
return false;
}
else if (name2.value.length < 2) {
	errors(name2,'Invalid Name');
	return false;
}
else if (!name2.value.match(letters)){
	errors(name2,'Name cannot contain numbers');
	return false;
}
else{
successFul(name2,'');
return true;
}
}
name2.onfocus = function(){
	checkName();
}
function checkSurname() {
var letters = /^[A-Za-z]+$/;
if (surname.value.length  === 0) {
errors(surname,'Surname cannot be empty');
return false;
}
else if (surname.value.length < 2 ) {
errors(surname,'Invalid Surname');
return false;
}
else if (!surname.value.match(letters)){
	errors(surname,'Surname cannot contain numbers');
	return false;
}
else{
successFul(surname,'');
return true;
}

}
surname.onfocus = function(){
	checkSurname();
}

function checkEmail(){
	var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(email.value.trim().match(mailformat) == null)
	{
		errors(email,'invalid email');
		return false;
	}
	else{
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
		  	errors(email,'Email already exist');
		return false;
		  }
		  else{
		  	successFul(email,'');
				return true;
		  }
	} 
}
email.onfocus = function(){
	checkEmail();
}
/*function checkID(){
var idFormat = /^(((\d{2}((0[13578]|1[02])(0[1-9]|[12]\d|3[01])|(0[13456789]|1[012])(0[1-9]|[12]\d|30)|02(0[1-9]|1\d|2[0-8])))|([02468][048]|[13579][26])0229))(( |-)(\d{4})( |-)(\d{3})|(\d{7}))/;
if(idNum.value.match(idFormat)==null)
{
	errors(idNum,'invalid ID Number');
	return false;	
}
else{
	successFul(idNum,'');
	return true;
}
}
*/
function checkCell(){
			var u_data;
			var e = userCell.value;
			var u = "cand";
		  $.ajax({
      url:"cell_api.php",
      method:"POST",
      data:{cell:e,user:u},
     async: false,
      success: function userdata(data){
        u_data = data;
   
        }
    });
		  if(u_data=="valid"){
		  	cellSuccessFul(userCell,'');
				return true;
		  }
		  else{
		  	cellErrors(userCell,'cellphone not valid');
				return false;		
		  }
		  	} 
userCell.onfocus = function(){
	checkCell();
}

/* Password validation*/

//Password variables
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var chars = document.getElementById("chars");
var length = document.getElementById("length");

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
/*function checkNationality()
{
	
	if(nationality.value.length == 0){
		
		errors(nationality, 'Select  nationality');
		return false;
	}
	else{

		successFul(nationality, '');
		return true;
		
	}
}
nationality.onfocus = function(){
	checkNationality();
}


Chech date of birth

function checkDOB()
{
	if(userDOB.value.length == 0)
	{
		errors(userDOB, 'Enter Date of Birth');
		return false;
	}
	else{

		successFul(userDOB, '');
		return true;
	}
}
userDOB.onfocus = function(){
	checkDOB();
}
function checkConsentForm(){
	if(consentForm.checked == true){
		successFul(consentForm, '');
		return true;
	}
	else{
		errors(consentForm, 'Check Consent Form');
		return false;
	}
}
consentForm.onfocus = function(){
	checkConsentForm();
}*/
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
t_and_c.onfocus = function(){
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
consent.onfocus = function(){
	checkConsent();
}
const setInter = setInterval(function(){
if(checkName() == true && checkSurname() == true && checkEmail()==true &&  checkPassword()== true && checkConfirmPassword()==true && checkTermsAndCond()==true&& checkConsent()==true){
add_candidate.disabled = false;
}
else{

add_candidate.disabled = true;	
}
},200);
