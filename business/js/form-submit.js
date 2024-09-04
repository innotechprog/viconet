$(document).ready(function(){
  //var i=1;
  var mes= "success";
  $('#add_candidate').click(function(){
     if(checkCell()!=true){
    $('.err-mes').html("Invalid mobile number");
  }
  else{
    clearInterval(setInter);
    $.ajax({
      url:"save_candidate.php",
      method:"POST",
      data:$('#myForm').serialize(),
      success:function(data)
      {
        //$('#myForm')[0].reset();        
         window.location.replace(window.location.protocol + "//" + window.location.host + "/candidate-message");
      }
    });
  }
  
  });
});


$(document).ready(function(){
  //var i=1;
  $('#add_corporate').click(function(){
   clearInterval(setInter);
    $.ajax({
      url:"save_corporate.php",
      method:"POST",
      data:$('#myFormCorp').serialize(),
      success:function(data)
      {
        document.getElementById("myFormCorp").reset();
        //window.location ="message";
        window.location.replace(window.location.protocol + "//" + window.location.host + "/corp-message")
      }
    });
    

  });
  //Submit contact form
    var mes= "corp";
  $('#submit_contactForm').click(function(){
    $.ajax({
      url:"send_form.php",
      method:"POST",
      data:$('#myForm').serialize(),
      success:function(data)
      {
       $('#myForm')[0].reset();
        document.getElementById('success_mes').innerHTML = '<div class="alert alert-success alert-dismissible" role="alert">Message sent!!!</div>';
       }
    });
    });
});



$(document).ready(function(){
  //var i=1;
  $('#reset_pass').click(function(){
    //i++;
    $.ajax({
      url:"saveForgotPass.php",
      method:"POST",
      data:$('#myForm').serialize(),
      success:function(data)
      {
     //alert("added");
        $('#myForm')[0].reset();
        $('#error_mes').html(data);
      }
    });
  });
});

$(document).ready(function(){
  //var i=1;
  $('#resetBtn').click(function(){
    //i++;
    $.ajax({
      url:"updatePassword.php",
      method:"POST",
      data:$('#myForm').serialize(),
      success:function(data)
      {
     //alert("added");
        document.getElementById("pass_input").style.display = "none";
        document.getElementById("reset_mes").style.display = "block";
        $('#error_mes').html(data);
      }
    });
  });
});

$(document).ready(function(){
  //var i=1;
$('#reset_pass').click(function(){
  //i++;
      document.getElementById("reset_pas").style.display = "none";
      document.getElementById("reset_mes").style.display = "block";
    });
});
