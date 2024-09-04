var userCell = document.getElementById('phone');
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
        u_data = data;   //Assign to global variable
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
userCell.onblur = function(){
checkCell();
}
