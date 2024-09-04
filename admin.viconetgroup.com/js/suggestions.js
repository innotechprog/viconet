
let suggestions="";
  var id='getJobTitle';
    $.ajax({
      url:"job_data.php",
      method:"POST",
      async: false,
       data:{id:id},
      success: function userdata(data){
    suggestions = data.split(',');
      }
    
    }); 
