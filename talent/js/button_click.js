
 $(document).ready(function(){
 $('#cand_login').click(function(){
window.location = "login";

});
});
 $(document).ready(function(){
 $('#sign_up').click(function(){
window.location = "corp_login"; 

});
});

 $(document).ready(function(){
 $('#cand_login2').click(function(){
window.location = "../login";
});
});

 $(document).ready(function(){
 $('#sign_up2').click(function(){
window.location = "../sign-up";
});
});

$(document).ready(function(){
 $('#id1').click(function(){
window.location = "talent-profile-view";
});
});
$(document).ready(function(){
 $('#blog1').click(function(){
window.location = "view-blog";
});
}); 

$(document).ready(function(){
 $('#user_profile').click(function(){
window.location = "user-profile";
});
});
$(document).ready(function(){
 $('#corp_profile').click(function(){
window.location = "corporate-profile";
});
});  

$(document).ready(function(){
  //var i=1;
  $('#update_corpu').click(function(){
    //i++;
    $.ajax({
      url:"savePP.php",
      method:"POST",
      data:$('#myForm1').serialize(),
      success:function(data)
      {
     //alert("added");
        document.getElementById('success_mes').innerHTML = '<div class="alert alert-success alert-dismissible" role="alert">Your information has been updated.</div>';
      }
    });
  });
}); 
$(document).ready(function(){
  //var i=1;
  $('#change_pas').click(function(){
    //i++;
    $.ajax({
      url:"updatePassword.php",
      method:"POST",
      data:$('#myForm2').serialize(),
      success:function(data)
      {
     //alert("added");
     $('#myForm2')[0].reset();
        $('#suc-m').html('<div class="alert alert-success alert-dismissible" role="alert">Your information has been updated.</div>'); 
      }
    });
  });
});
$(document).ready(function(){
  //var i=1;
  $('#sendInvoic').click(function(){
    //i++;
    $.ajax({
      url:"send_inv.php",
      method:"POST",
      data:$('#invForm').serialize(),
      success:function(data)
      {        
        document.getElementById('sendInvoic').disabled = true;
        document.getElementById('inv_mes').innerHTML = '<div class="alert alert-success alert-dismissible" role="alert">Invoice sent, please check your email.</div>';
      }
    });
  });
}); 
$(document).ready(function(){
 $('#back_btn').click(function(){
history.back();

});
});
$(document).ready(function(){
 $('#return_home').click(function(){
window.location="index";

});
});
$(document).ready(function(){
 $('#cand_profile').click(function(){
window.location="profile-view";

});
});
$(document).ready(function(){
 $('#cand_profile2').click(function(){
window.location="../profile-view";

});
});
$(document).ready(function(){
  $('#shortlist_cand').click(function(){
    $.ajax({
      url:"shortlist.php",
      method:"POST",
      data:$('#myForm').serialize(),
      success:function(data)
      {
        //console.log(data);
        $('#shortlist_cand').html('shortlisted');
       document.getElementById("shortlist_cand").disabled = true;
       //let numCandSelected = parseInt(document.getElementById("num_candidates").textContent) + 1;
        //$('#num_candidates').html(numCandSelected);
      }
    });
  });
}); 

$(document).ready(function(){
  $('.invite').click(function(){
    $('#meetInter').show();
    
  });
});
//initialising variable to store current form id
var formId = ""; 
function inviteCand(event){
formId='#'+event.id; // creating form id and assigning
}
$(document).ready(function(){
    $("#inviteCand").click(function(){
        var datastring = $(formId).serialize();
        datastring +="&" + $("#lastForm").serialize();
        $.ajax({
            type: "POST",
            url: "save_data.php",
            data: datastring,
            success: function(data) {
               window.location = "project?id="+data;
            },
            error: function() {
               
            }
        });
    });
});

$(document).ready(function(){
$(function() {
$("#corp_logout").click(function(){
  if(typeof(refresherDiv) != 'undefined'){
    clearInterval(refresherDiv);
  }
  window.location = "corp-logout";
    });
  });
});

$(document).ready(function(){
$(function() {
$(".rem-cand").click(function(){
  //Decrease number of selected candidates
//  let numCandSelected = parseInt(document.getElementById("num_candidates").textContent) - 1;
//$('#num_candidates').html(numCandSelected);
//Save the link in a variable called element
var element = $(this).attr('id');
//Find the id of the link that was clicked
var del_id = element;
var table = "basket";
var field = "id";
//Built a url to send
var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;
   $.ajax({
     type: "GET",
     url: "delete.php",
     data: info,
     success: function(){

     }
 });
   $(this).parents(".person-frame").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
   $('#loadCandidates').load('load-shortlist.php');

});

   });
});
$(document).ready(function(){
$(function() {
$(".rem-cand1").click(function(){
//Save the link in a variable called element
var element = $(this).attr('id');
//Find the id of the link that was clicked
var del_id = element.substr(0,element.indexOf("-"));
var string_id = element.substr(element.indexOf("-")+1);
var table = "basket";
var field = "id";
//Built a url to send
var info = 'id=' + del_id +'&ta='+table +'&fi=' + field;
if(confirm("Do you want to delete this Candidate? There is NO undo!"))
    {
   $.ajax({
     type: "GET",
     url: "delete.php",
     data: info,
     success: function(){

     }
 });
 var d_id = "#"+string_id;
 var numCandId = "#numCand";
 var numCandSelected = parseInt(document.getElementById(string_id).textContent) - 1;
 var totNumCand = parseInt(document.getElementById("numCand").textContent) - 1;
 
  $(d_id).html(numCandSelected);
  $(numCandId).html(totNumCand);
   $(this).parents(".shortCand").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
   //Reloading candidates from project.
   $('#loadCandidates').load('load-proj-cand.php');
 }
return false;
});

   });
});
//remove corporate users
$(document).ready(function(){
$(function() {
$(".rem-user").click(function(){
//Save the link in a variable called element
var element = $(this).attr('id');
//Find the id of the link that was clicked
var del_id = element;
var table = "users";
var field = "id";
//Built a url to send
var info = 'id=' + del_id +'&ta='+table +'&fi=' + field; 
if(confirm("Sure you want to delete this user."))
{
   $.ajax({
     type: "GET",
     url: "delete.php",
     data: info,
     success: function(){

     }
 });
    $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
 
 }
  


});

   });
});
$(document).ready(function(){
  $('#checkOut').click(function(){
    $('#projli').show();
  });
});  
$(document).ready(function(){
  $('#addPro').click(function(){
          $('#projli').hide();
          $('#checkOut_modal').show();
    
    });
  });
$(document).ready(function(){
  $('#openConsent').click(function(){
        $('#consent1').show();    
    });
  });
$(document).ready(function(){
  $('#closeConsent').click(function(){
        $('#consent1').hide();    
    });
  });
$(document).ready(function(){
  $('#up-cv').click(function(){

      $('#projli').hide();
      $('#modal11').show();    
    });
  });
$(document).ready(function(){
  $('#resetp').click(function(){
    document.getElementById('disppasf').style.display = "block";
  });
});
$(document).ready(function(){
  $('.wy, .wn').click(function(){
    // Toggle the display of 'currwork' based on the clicked element's class
    $('#currwork').toggle(this.classList.contains('wy'));

    // Define an array of element IDs to toggle the 'mendatory_input' class
    var elementsToToggle = ['company_name', 'start_date', 'experience_id', 'job_title'];

    // Cache the clicked element's class
    var isWyClass = this.classList.contains('wy');

    // Loop through the array and add/remove the 'mendatory_input' class based on the clicked element's class
    elementsToToggle.forEach(function(elementID) {
      $('#' + elementID).toggleClass('mendatory_input', isWyClass);
    });
  });
});

$(document).ready(function(){
  $('.pwy').click(function(){
     document.getElementById('prevworkexp').style.display ="block";
     $('.prevcomp').addClass("mendatory_input");
    $('.prevjt').addClass("mendatory_input");
    $('.prevsd').addClass("mendatory_input");
    $('.preved').addClass("mendatory_input");
  });
  $('.pwn').click(function(){
    document.getElementById('prevworkexp').style.display ="none";
     $('.prevcomp').removeClass("mendatory_input");
    $('.prevjt').removeClass("mendatory_input");
    $('.prevsd').removeClass("mendatory_input");
    $('.preved').removeClass("mendatory_input");

    inputControl.classList.add('error');
inputControl.classList.remove('success');
  });
});
function selectAll(obj){
  let id = '#'+obj.id;
  //alert(obj);
  //alert(id);
  $(id).change(function(){
    let select = "."+("selectBox"+ id.substr(10));
    $(select).prop("checked",$(this).prop("checked"))
  });
  };
//save Address
function changePrice(obj,priceId){
  let numUsers= obj.value;
  let initialPrice = "p"+priceId; //initial clicked package price
  let pPrice = document.getElementById(initialPrice).value;
  let newPrice = 0;
  newPrice = numUsers * pPrice;
  let id = "#"+priceId;
  $(id).html('R '+newPrice.toLocaleString('en'));

}
function changePrice2(obj,priceId){
  let numUsers= obj.value;
  let initialPrice = "p"+priceId; //initial clicked package price
  let pPrice = document.getElementById(priceId).value;
  let newPrice = 0;
  newPrice = numUsers * pPrice;
  let id = "#pack";
  $(id).html('R '+newPrice.toLocaleString('en'));

}
$(document).ready(function(){
  $('#add_project').click(function(){
    $.ajax({
      url:"collect_data.php",
      method:"POST",
      data:$('#addProjForm').serialize(),
      success:function(data)
      {
        if(data == 1){
        $('.error-message').html('Project name exist');
      }
      else{
       $('.error-message').html('');
       $.ajax({
        url:"save_data.php",
        method:"POST",
        data:$('#addProjForm').serialize(),
        success:function(data)
        {
          window.location="project?id="+data;
        }
      });
      }
      }
    });
  });
}); 

 $(document).ready(function(){
 $('#business-signin').click(function(){
window.location = "https://business.viconetgroup.com";

});
});
 $(document).ready(function(){
 $('#talent-login').click(function(){
window.location = "index"; 

});
});
 //Notification subscription
 function showNotification() {
        var popup = document.getElementById('popup');
        popup.classList.add('show');

        // Hide the notification after 5 seconds
        setTimeout(function () {
            popup.classList.remove('show');
        }, 5000);
    }

 $(document).ready(function(){
$(function() {
$(".subscr").click(function(){
//Save the link in a variable called element
var element = $(this).attr('id');
//Find the id of the link that was clicked
var value = "";
var notificationType = ""; 
var tableFieldName ="";
if(element === "jobNotify"){
tableFieldName = "job_notification"; 
}
else if(element === "podcastNotify"){
  tableFieldName = "podcast_notification";
}
//Built a url to send
if ($('#'+element).prop('checked')) {
    // Checkbox is checked
    value = "on";
} else {
    // Checkbox is not checked
     value = "off";
}
var info = 'val='+value+'&fld='+tableFieldName; 
  $.ajax({
    type: "GET",
    url: "updateSubscription.php",
    data: info,
    success: function(response){
        showNotification();
    },
    error: function(xhr, status, error) {
        var errorMessage = xhr.status + ': ' + xhr.statusText;
        alert('Error - ' + errorMessage);
    }
});
});

   });
});
 