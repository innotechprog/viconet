//declaring and assigning variables


//var email = document.myForm.userEmail; 
//var name = document.myForm.userName;
var surname = document.getElementById('surname');
var userCell = document.getElementById('userCell');
var subject = document.getElementById('subject');
//var consentForm = document.getElementById('userConsentForm');
var message = document.getElementById('message');
var name2 = document.getElementById('name');
var email = document.getElementById('email');
let submitForm= document.getElementById('submit_contactForm');

//Allow only numbers
function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

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
function checkSubject() {
if (subject.value.length  === 0) {
errors(subject,'Subject cannot be empty');
return false;
}
else if (subject.value.length < 3) {
errors(subject,'Subject cannot be less than 3');
return false;
}
else{
successFul(subject,'');
return true;
}
}
subject.onfocus = function(){
	checkSubject();
}

function checkMessage() {
if (message.value.length  === 0) {
errors(message,'Message cannot be empty');
return false;
}
else if (message.value.length < 3) {
errors(message,'Message cannot be less than 3');
return false;
}
else{
successFul(message,'');
return true;
}
}
message.onfocus = function(){
	checkMessage();
}
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

function checkEmail(){
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(email.value.match(mailformat) == null)
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



setInterval(function(){
if(checkName() == true && checkSurname() == true && checkEmail()==true && checkCell()==true && checkSubject()==true && checkMessage()== true ){
submitForm.disabled = false;
}
else{
submitForm.disabled = true;	
}
},200);
