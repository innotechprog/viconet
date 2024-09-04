

var input = document.getElementById('search_location');

var autocomplete = new google.maps.places.Autocomplete(input);



autocomplete.addListener('place_changed', function() {

  var place = autocomplete.getPlace();

 

  // Extract the country and province/state from the address components

  for (var i = 0; i < place.address_components.length; i++) {

    var addressType = place.address_components[i].types[0];

    if (addressType === 'country') {

      var country = place.address_components[i]['long_name'];

      document.getElementById(country).selected=true;
      //document.getElementById('country').value = country;

    }
    else if (addressType === 'administrative_area_level_1') {

        var province = place.address_components[i]['long_name'];

        document.getElementById(province).selected=true;
        //document.getElementById('country').value = country;

      }
  
  }

});


