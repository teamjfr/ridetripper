$(".menu-toggle-btn").click(function(){
    $(".navigation_bar_class").toggleClass("active");
  });

const routeconfirmtbtn=document.getElementById("button-for-route-confirmation"),
formsubmit=document.getElementById("submit"),
cancelconfirmation=document.getElementById("button-for-cancellation");
popup2 = document.querySelector(".map-popup2"),
popup3=document.querySelector(".map-popup3");
var input_dis=document.getElementById("distance");

var distance;

    var redIcon = new L.Icon({
      iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/images/marker-shadow.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
    });
    var blueIcon = new L.Icon({
      iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/images/marker-shadow.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
    });

  var map1 = L.map('map1').setView([23.8103, 90.4125], 14);
  
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map1);




  function createroute(start_lat,start_lng,end_lat,end_lng){
  control= L.Routing.control({
    waypoints: [
      L.latLng(start_lat,start_lng),
      L.latLng(end_lat,end_lng)
    ],
    lineOptions: {
      styles: [{color: 'blue', opacity: 1, weight: 5}]
   },
   createMarker: function(i, wp, nWps) {
     if(i==0){
       marker_icon=blueIcon;
     }
     else if(i==nWps-1){
marker_icon=redIcon;
     }
    return L.marker(wp.latLng, {icon: marker_icon });
  }
  }).addTo(map1);
  control.on('routesfound', function(e) {
    var routes = e.routes;
    var summary = routes[0].summary;
    distance=summary.totalDistance/1000;
    distance=Math.round(distance*10)/10;

 });
};

$( document ).ready(function() {
    popup2.classList.toggle("show");
    popup3.classList.toggle("show");
    createroute(s_lat,s_lng,e_lat,e_lng);
    
});
routeconfirmtbtn.onclick=()=>{
    popup2.classList.toggle("show");
    popup3.classList.toggle("show");
    setTimeout(function(){
      input_dis.value=distance;
      document.getElementById("submit").click();
    },0);
};
cancelconfirmation.onclick=()=>{
popup2.classList.toggle("show");
popup3.classList.toggle("show");
window.location.href = 'driver_trip.html';
};
