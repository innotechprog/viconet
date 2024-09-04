$(document).ready(function(){
var id="subscription";
  $.ajax({
    url:"collect_data.php",
    method:"POST",
    async: false,
     data:{id:id},
    success: function userdata(data){
     var data1 = data.replace(/\s+/g, '');
    let curSubscription = document.getElementById(data1);
   	curSubscription.disabled = true;
   	curSubscription.value="Current subscription";
    console.log(curSubscription);
    //(#data).html('Current');

    if(data != 'vicopac1'){
      document.getElementById('vicopac1').style.display = "none";
    }
    if(data == 'vicopac3' || data == 'vicopac3'){
      document.getElementById('vicopac2').value = "Downgrade";
    }
   if( data == 'vicopac4'){
      document.getElementById('vicopac2').value = "Downgrade";
       document.getElementById('vicopac3').value = "Downgrade";
    }
    }      
  });
});