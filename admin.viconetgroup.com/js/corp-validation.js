//declaring and assigning variables


//var email = document.myForm.userEmail;
//var name = document.myForm.userName;
var surname = document.getElementById('userSurname');
var userCell = document.getElementById('userCell');
var telephone = document.getElementById('telephone');
var company_name = document.getElementById('company_name');
var company_email = document.getElementById('company_email');
var conf_comp_email = document.getElementById('conf_company_email');
var company_reg = document.getElementById('company_reg');
var position = document.getElementById('position');
var company_address = document.getElementById('search_location');
//var nationality = document.getElementById('userNationality');
//var userDOB = document.getElementById('userDOB'); 
//var consentForm = document.getElementById('userConsentForm');
var t_and_c = document.getElementById('userTerms');
var privacyP = document.getElementById('privacyPolicy');
var memberTerms = document.getElementById('memberTerms');
var name2 = document.getElementById('userName');
//var email = document.getElementById('userEmail')
var add_corporate = document.getElementById('add_corporate');
var password = document.getElementById('userPassword');
var confPassword = document.getElementById('userConfPassword');
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
//Errors for Telephone
function telErrors(element,mess)
{
element.classList.add('error');
element.classList.remove('success');
$('.err-mess').html(mess);

}
function telSuccessFul(element, mess)
{
element.classList.add('success');
element.classList.remove('error');
$('.err-mess').html(mess);	
}

function checkCompanyReg() {
	var letters = /^[a-zA-Z]+$/;
if (company_reg.value.length  === 0) {
successFul(company_reg,'');
return false;
}
else if(company_reg.value.length < 6) {
errors(company_reg,'Company reg number cannot be less than 6');
return false;
}
else if(letters.test(company_reg.value))
{
errors(company_reg,'Company reg number cannot contain only letters');
return false;
}
else{
			var u_data;
			var e = company_reg.value;
			var u = "compr";
		  $.ajax({
      url:"check-email.php",
      method:"POST",
      data:{reg:e,user:u},
     async: false,
      success: function userdata(data){
        u_data = data;
      }
    });
		  if(u_data == 1){
		  	errors(company_reg,'Company registrion number already exist');
				return false;
		  }
		  else{
			successFul(company_reg,'');
			return true;
		}
}
}
company_reg.onfocus = function(){
	checkCompanyReg();
}

function checkCompanyName() {
if (company_name.value.length  === 0) {
errors(company_name,'Company name cannot be empty');
return false;
}
else if (company_name.value.length < 3) {
errors(company_name,'Company name cannot be less than 3');
return false;
}
else{
successFul(company_name,'');
return true;
}
}
company_name.onfocus = function(){
	checkCompanyName();
}
//check address
function checkCompanyAddress() {
if (company_address.value.length  === 0) {
errors(company_address,'Company address cannot be empty');
return false;
}
else if (company_address.value.length < 3) {
errors(company_address,'Company address cannot be less than 3');
return false;
}
else{
successFul(company_address,'');
return true;
}
}
company_address.onfocus = function(){
	checkCompanyAddress();
}

function checkName() {
if (name2.value.length  === 0) {
errors(name2,'Name cannot be empty');
return false;
}
else if (name2.value.length < 3) {
errors(name2,'Name cannot be less than 3');
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
if (surname.value.length  === 0) {
errors(surname,'Surname cannot be empty');
return false;
}
else if (surname.value.length < 3 ) {
errors(surname,'Invalid surname');
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

//check company email
function checkCompanyEmail(){
	var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var email_ext = ["gmail.com","outlook.com","icloud.com","yahoo.com","ymail.com","trashmail.com","hotmail.com","lycos.com","aol.com"];
	let em3 = company_email.value;
	em3 = em3.trim();
	let ext = em3.substr(em3.indexOf("@")+1);
	console.log(ext);
	if(em3.match(mailformat) == null)
	{
		errors(company_email,'invalid email');
		return false;
	}
	else if(email_ext.includes(ext))
	{
		errors(company_email,'Domain is not accepted');
		return false;
	}
	else{
		var u_data;
			var e = company_email.value;
			var u = "corpe";
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
		  	errors(company_email,'Email already exist');
		return false;
		  }
		  else{
			successFul(company_email,'');
			return true;
		}
	}
}
company_email.onfocus = function(){
	checkCompanyEmail();
}
//Confirm Email
function checkConfirmEmail(){
if(conf_comp_email.value == company_email.value)
{
	successFul(conf_comp_email, '');
	return true;
	
}
else{
	errors(conf_comp_email, 'Email address do not match');
	return false;
}
}
confPassword.onfocus = function(){
	checkConfirmEmail();
}
/*
function checkEmail(){
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	let em1 = company_email.value;
	let em2 = email.value;
	if(email.value.match(mailformat) == null)
	{
		errors(email,'invalid email');
		return false;
	}
	else if(em1.substr(em1.indexOf("@")) != em2.substr(em2.indexOf("@"))){
		errors(email,'Company domain name do not match');
		return false;
	}
	else if(em1 == em2){
		
	}
	else{
		var u_data;
			var e = email.value;
			var u = "corp";
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
}*/
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
		  	cellErrors(userCell,'Cellphone not valid');
				return false;		
		  }
		  	} 
userCell.onfocus = function(){
	checkCell();
userCell.onblur = function(){
checkCell();
}
}
function checkTelephone(){
			var u_data;
			var e = telephone.value;
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
		  	telSuccessFul(telephone,'');
				return true;
		  }
		  else{
		  	telErrors(telephone,'Telephone not valid');
				return false;		
		  }
		  	} 
telephone.onfocus = function(){
	checkTelephone();
}
telephone.onblur = function(){
	checkTelephone();
}

function checkPosition() {
if (position.value.length  === 0) {
errors(position,'Position cannot be empty');
return false;
}
else if (position.value.length < 3) {
errors(position,'Position cannot be less than 3');
return false;
}
else{
successFul(position,'');
return true;
}
}
position.onfocus = function(){
	checkPosition();
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

/*
function checkCell(){
var cellFormat = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
if(cellphone.value.match(cellFormat)==null)
{
	errors(cellphone,'invalid Mobile Number');
	return false;	
}
else{
	successFul(cellphone,'');
	return true;
}
}
cellphone.onfocus = function(){
	checkCell();
}
function checkTelephone(){
var cellFormat = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
if(telephone.value.match(cellFormat)==null)
{
	errors(telephone,'invalid Mobile Number');
	return false;	
}
else{
	successFul(telephone,'');
	return true;
}
}
telephone.onfocus = function(){
	checkTelephone();
}
*/
/*
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
*/ 
function checkTermsAndCond(){
	if(t_and_c.checked == true){
		successFul(t_and_c, '');
		return true;
	}
	else{
		errors(t_and_c, 'Check Subscription Terms');
		return false;
	}
}
t_and_c.onfocus = function(){
	checkTermsAndCond();
}
function checkMemberTerms(){
	if(memberTerms.checked == true){
		successFul(memberTerms, '');
		return true;
	}
	else{
		errors(memberTerms, 'Check Membership Terms');
		return false;
	}
}
memberTerms.onfocus = function(){
	checkMemberTerms();
}
function checkPrivacyPolicy(){
	if(privacyP.checked == true){
		successFul(privacyP, '');
		return true;
	}
	else{
		errors(privacyP, 'Check Privacy Policy');
		return false;
	}
}
privacyP.onfocus = function(){
	checkPrivacyPolicy();
}
const setInter = setInterval(function(){
if(checkCompanyName()== true &&checkCompanyAddress()==true && checkName() == true && checkSurname() == true  &&  checkPosition()== true && checkCompanyEmail() == true && checkConfirmEmail() == true && checkPassword()== true && checkConfirmPassword()==true && checkMemberTerms() == true && checkTermsAndCond() == true && checkPrivacyPolicy()){
add_corporate.disabled = false;
}
else{
add_corporate.disabled = true;	
}
},200);
