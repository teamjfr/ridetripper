$(".menu-toggle-btn").click(function(){
    $(".navigation_bar_class").toggleClass("active");
  });

const confirmtbtn=document.getElementById("button-for-confirmation"),
routeconfirmtbtn=document.getElementById("button-for-route-confirmation"),
cancelconfirmation=document.getElementById("button-for-cancellation"),
popup2 = document.querySelector(".map-popup2"),
popup3=document.querySelector(".map-popup3");
var distance,time;



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
  var marker_icon;
  var control= L.Routing.control({
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
    var h=Math.floor(summary.totalTime/3600);
    var m=Math.floor(summary.totalTime%3600/60);
    time= h+" Hrs and "+m+" Mins";
 });
};

$( document ).ready(function() {
    popup2.classList.toggle("show");
    popup3.classList.toggle("show");
    createroute(s_lat1,s_lng1,e_lat1,e_lng1);
});

function sendvalue(){
  localStorage.setItem("trip_id",JSON.stringify(trip_id));
  localStorage.setItem("starting_time",JSON.stringify(starting_time));
  localStorage.setItem("vehicle_number",JSON.stringify(vehicle_number));
  localStorage.setItem("vehicle_type",JSON.stringify(vehicle_type));
  localStorage.setItem("available_seat",JSON.stringify(available_seat));
  localStorage.setItem("driver_phoneno",JSON.stringify(driver_phoneno));
  localStorage.setItem("trip_num",JSON.stringify(trip_num));
  localStorage.setItem("driver_name",JSON.stringify(driver_name));
  localStorage.setItem("pickup_point",JSON.stringify(pickup_point));
  localStorage.setItem("occupied_seat",JSON.stringify(occupied_seat));
  localStorage.setItem("estimated_distance",JSON.stringify(distance));
  localStorage.setItem("estimated_cost",JSON.stringify(cost));
  localStorage.setItem("estimated_time",JSON.stringify(time));
};
routeconfirmtbtn.onclick=()=>{
    popup2.classList.toggle("show");
    popup3.classList.toggle("show");
    sendvalue();
    setTimeout(function(){
      window.location.href = 'search_trip.html';
    },5000);
       
};
cancelconfirmation.onclick=()=>{
    popup2.classList.toggle("show");
    popup3.classList.toggle("show");
    window.location.href = 'rider_trip.html';
};
