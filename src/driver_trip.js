
const timer=document.querySelector('.timepicker');
    M.Timepicker.init(timer,{
            showClearBtn:true
        });


const date=document.querySelector('.datepicker');
    M.Datepicker.init(date,{
            showClearBtn:true
        });  

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var options = document.querySelectorAll('option');
            var instances = M.FormSelect.init(elems, options);
            });
        
$(".menu-toggle-btn").click(function(){
  $(".navigation_bar_class").toggleClass("active");
});           

const starting_location=document.getElementById("start-location-select"),
end_location=document.getElementById("end-location-select"),
selectbtn=document.getElementById("button-for-selection"),
confirmtbtn=document.getElementById("button-for-confirmation"),
popup = document.querySelector(".map-popup"),
popup1 = document.querySelector(".map-popup1"),
starting_lat=document.getElementById("starting_lat"),
starting_lng=document.getElementById("starting_lng"),
ending_lat=document.getElementById("ending_lat"),
ending_lng=document.getElementById("ending_lng"),
starting_point=document.getElementById("starting_point"),
ending_point=document.getElementById("ending_point");

var x = document.getElementById("location");
var y;
var marker,universal_result=null;

var map = L.map('map').setView([23.8103, 90.4125], 14);
map.locate({setView:true,maxZoom:16});

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


var geocodeService = L.esri.Geocoding.geocodeService();
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
    
  }

  function getLocation(latitude_position,longitude_position){
    geocodeService.reverse().latlng({lat: latitude_position, lng: longitude_position}).run(function (error, result) {
         if (error) {
           return;
         }
         
         universal_result=result;
         x.innerHTML =result.address.Match_addr;
         
       });
  };  
  
function showPosition(position) {
      geocodeService.reverse().latlng({lat: position.coords.latitude, lng: position.coords.longitude}).run(function (error, result) {
          if (error) {
            return;
          }
          universal_result=result;
          x.innerHTML =result.address.Match_addr;
          marker=L.marker(result.latlng,{draggable:true}).addTo(map).bindPopup(result.address.Match_addr).openPopup();
        
        marker.on('dragend', function(event) {

        var latlng = marker.getLatLng();
        getLocation(latlng.lat, latlng.lng);
        });
      });
  };

  
var searchControl=L.esri.Geocoding.geosearch({
  placeholder: "Enter an address or place e.g. 1 York St",
useMapBounds: false
}).addTo(map);
var results = L.layerGroup().addTo(map);

searchControl.on('results', function (data) {
    results.clearLayers();
    map.removeLayer(marker);
    for (var i = data.results.length - 1; i >= 0; i--) {
        universal_result=data.results[i];
        x.innerHTML = data.text;
      marker=L.marker(data.results[i].latlng,{draggable:true});
      results.addLayer(marker);
      marker.on('dragend', function(event) {
        var latlng = marker.getLatLng();
      getLocation(latlng.lat, latlng.lng);
    
    });
    }
  });

  map.on('click', function(e) { 
     map.removeLayer(marker);

     geocodeService.reverse().latlng({lat: e.latlng.lat, lng:e.latlng.lng }).run(function (error, result) {
      if (error) {
        return;
      }
      
      universal_result=result;
      
      x.innerHTML =result.address.Match_addr;
      marker=L.marker(universal_result.latlng,{draggable:true}).addTo(map).bindPopup(universal_result.address.Match_addr).openPopup();


      marker.on('dragend', function(event) {
      var latlng = marker.getLatLng();
    getLocation(latlng.lat, latlng.lng);
  
  });
      
    });
      
  });

  starting_location.onclick = ()=>{
    popup.classList.toggle("show");
    popup1.classList.toggle("show");
    y=1;
  }
  end_location.onclick = ()=>{
    popup.classList.toggle("show");
    popup1.classList.toggle("show");
    y=2;
  }
selectbtn.onclick = ()=>{
    if(y==1){
        starting_location.click();
        starting_location.value=x.innerHTML;
        starting_point.value=x.innerHTML;
        starting_lat.value=universal_result.latlng.lat;
        starting_lng.value=universal_result.latlng.lng;
    }
    else if(y==2){
        end_location.click();
        end_location.value=x.innerHTML;
        ending_point.value=x.innerHTML;
        ending_lat.value=universal_result.latlng.lat;
        ending_lng.value=universal_result.latlng.lng;
    }
  }

