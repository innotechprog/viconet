$(document).ready(function(){
var id="subscription";
  $.ajax({
    url:"collect_data.php",
    method:"POST",
    async: false,
     data:{id:id},
    success: function userdata(data){
    let curSubscription = document.getElementById(data);
   	curSubscription.disabled = true;
   	curSubscription.value="Current subscription";
    console.log(data);
    //(#data).html('Current');

    if(data != 'vicopac1'){
      document.getElementById('vicopac1').style.display = "none";
    }
    if(data != 'vicopac1')
    {
      document.getElementById('vicopac1').value = "Downgrade";
    } 
     if(data != 'vicopac2' && data != 'vicopac1'){
      document.getElementById('vicopac2').value = "Downgrade";
    }
    }      
  });
});