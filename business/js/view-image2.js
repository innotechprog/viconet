
  var loadFile = function(event) {
    var output = document.getElementById('display_image');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
    var loadFile1 = function(event) {
    var output = document.getElementById('display_image1');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
  
     var display_img = document.getElementById('display_image'); 
         if(display_img.getAttribute('src')==""){
             display_img.style.display = "none";
             document.getElementById('user_ini').style.display = "block";
         }
         else{
            display_img.style.display = "block";
            document.getElementById('user_ini').style.display = "none";
         }
      
        function changePicture(){
            if(document.getElementById('p_pic').value==""){
            display_img.style.display = "none";
         }
         else{
            display_img.style.display = "block";
            document.getElementById('user_ini').style.display = "none";
         }
      }
      document.getElementById('p_pic').oninput =function(){
         changePicture();        
        $.ajax({
            url: "save-complogo.php", 
            type: "POST",
            dataType: "JSON",             
            data: new FormData(myForm4),
            contentType: false,       
            cache: false,             
            processData:false, 
            success: function(data){
       
              }
        });    
      }
$(document).ready(function(){
  //var i=1;
  $('#update_corp').click(function(){
     $.ajax({
            url: "save-complogo.php", 
            type: "POST",
            dataType: "JSON",             
            data: new FormData(myForm1),
            contentType: false,       
            cache: false,             
            processData:false, 
            success: function(data){
              $("#myForm").html(data);               
            }
        });
  });
});
