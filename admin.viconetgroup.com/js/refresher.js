$(document).ready(function(){
  var id='countCandAuth';
  var refresherDiv="";
    $.ajax({
      url:"shortlist.php",
      method:"POST",
      async: false,
       data:{id:id},
      success: function userdata(data){
       $('#num_candidates').html(data); 
       $('#num_candidats').html(data); 
      }    
    });
  });
 