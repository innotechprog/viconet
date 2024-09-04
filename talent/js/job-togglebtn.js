const toggleBtn = document.getElementsByClassName('jobtooglebtn')[0];
const navLinks = document.getElementsByClassName('links2')[0];
toggleBtn.addEventListener('click',()=>{
	navLinks.classList.toggle('active');
});