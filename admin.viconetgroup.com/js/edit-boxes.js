
$(document).ready(function(){
 $('.edit-role').click(function(){
   var ids = $(this).data('id');
   var typ = 'role';
$.ajax({
      url:"editRoles.php",
      method:"POST",
      data:{id:ids, type:typ},
      success:function(data)
      {
     $('#output').html(data);
      }
    });
});

}); 

$(document).ready(function(){
 $('.edit-skill').click(function(){
   var ids = $(this).data('id');
   var typ = 'skill';
$.ajax({
      url:"editRoles.php",
      method:"POST",
      data:{id:ids,type:typ},
      success:function(data)
      {
     $('#output1').html(data);
      }
    });
});
});
$(document).ready(function(){
 $('.edit-course').click(function(){
   var ids = $(this).data('id');
   var typ = 'course';
$.ajax({
      url:"editRoles.php",
      method:"POST",
      data:{id:ids,type:typ},
      success:function(data)
      {
     $('#output2').html(data);
      }
    });
});
});
$(document).ready(function(){
 $('.edit-education').click(function(){
   var ids = $(this).data('id');
   var typ = 'education';
$.ajax({
      url:"editRoles.php",
      method:"POST",
      data:{id:ids,type:typ},
      success:function(data)
      {
        $('#output3').html(data);
      }
    });
});
});
$(document).ready(function(){
 $('.edit-experience').click(function(){
   var ids = $(this).data('id');
   var typ = 'experience';
$.ajax({
      url:"editRoles.php",
      method:"POST",
      data:{id:ids,type:typ},
      success:function(data)
      {
        $('#output4').html(data);
      }
    });
});
});