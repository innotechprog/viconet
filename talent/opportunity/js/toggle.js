const toggleBtn = document.getElementsByClassName('toggle-btn')[0];
const navLinks = document.getElementsByClassName('links')[0]; 

toggleBtn.addEventListener('click',()=>{
	navLinks.classList.toggle('active');
});

/* Webinar Tab Control*/
  // Get the element with id="defaultOpen" and click on it
  




/*Modal*/

var modalsBtn = document.querySelectorAll(".modal-open");
modalsBtn.forEach(function(btn){
	btn.onclick= function(){
		var modal = btn.getAttribute("data-modal");
		document.getElementById(modal).style.display ="block";
	};
});

var closeModal = document.querySelectorAll(".close");
closeModal.forEach(function(btn){
	btn.onclick= function(){
		var modal= btn.closest(".modal").style.display ="none";
	};
});
var caBtn = document.querySelectorAll(".go_back_btn");
caBtn.forEach(function(btn){
	btn.onclick= function(){
		var modal= btn.closest(".modal").style.display ="none";
		alert(modal);
	};
});

window.onclick = function(e){
	if (e.target.className === 'modal') {
		e.target.style.display = 'none';
	}
}