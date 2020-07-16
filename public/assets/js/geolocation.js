var marker;
function initMap(){
    'use strict';
    var latlon = new google.maps.LatLng(-7.952296, 112.613023)
    var myOptions = {
        center:latlon,zoom:14,
        panControl: true,
        zoomControl: true,
        mapTypeId:google.maps.MapTypeId.ROADMAP,
        mapTypeControl:false,
        navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
    }
    var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
    marker = new google.maps.Marker({position:latlon,map:map,title:"Anda SekarangDisini"});

    map.addListener('click', function(event) {
        marker.setMap(null);          
        marker = new google.maps.Marker({
            position: event.latLng,
            map: map,
            title:"You are here!"
          });
        //   console.log(event.latLng);
          $.getJSON('https://geo.ub.ac.id/reverse.php', {
            lat: marker.position.lat,
            lon: marker.position.lng,
            format: 'json',
            }, function (result) {
                // console.log(result);
                $("#lokasi").val(result.display_name);   
        })        
    });    
}

var x = document.getElementById("lokasi");

function getLocation() {
    if (navigator.geolocation) {
    //   navigator.geolocation.watchPosition(showPosition);
      navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else { 
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
      
  function showPosition(position) {
    var lat = position.coords.latitude;
    var lon = position.coords.longitude;
    // var c=[lat,lon]
    // getPos(c)
    // function getPos(value){
    //     google.script.run.getLoc(value);
    // }
    var latlon = new google.maps.LatLng(lat, lon)
    var mapholder = document.getElementById('mapholder')
    // mapholder.style.height = '250px';
    // mapholder.style.width = '500px';
  
    var myOptions = {
      center:latlon,zoom:14,
      mapTypeId:google.maps.MapTypeId.ROADMAP,
      mapTypeControl:false,
      navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
    }
      
    var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
    var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});

    console.log(lat, lon);
    // $("#position").val("");
    // $("#latitude").val(lat);
    // $("#longitude").val(lang);
    //console.log(position);
    $.getJSON('https://geo.ub.ac.id/reverse.php', {
        lat: lat,
        lon: lon,
        format: 'json',
        }, function (result) {
            // console.log(result);
            $("#lokasi").val(result.display_name);   
    })
  }

  function showError(error) {
    switch(error.code) {
      case error.PERMISSION_DENIED:
        x.innerHTML = "User denied the request for Geolocation."
        break;
      case error.POSITION_UNAVAILABLE:
        x.innerHTML = "Location information is unavailable."
        break;
      case error.TIMEOUT:
        x.innerHTML = "The request to get user location timed out."
        break;
      case error.UNKNOWN_ERROR:
        x.innerHTML = "An unknown error occurred."
        break;
    }
  }