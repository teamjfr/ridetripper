var trip_id=JSON.parse(localStorage.getItem("trip_id"));
var starting_time=JSON.parse(localStorage.getItem("starting_time",starting_time));
var vehicle_number=JSON.parse(localStorage.getItem("vehicle_number",vehicle_number));
var vehicle_type=JSON.parse(localStorage.getItem("vehicle_type",vehicle_type));
var available_seat=JSON.parse(localStorage.getItem("available_seat",available_seat));
var driver_phoneno=JSON.parse(localStorage.getItem("driver_phoneno",driver_phoneno));
var trip_num=JSON.parse(localStorage.getItem("trip_num",trip_num));
var driver_name=JSON.parse(localStorage.getItem("driver_name",driver_name)); 
var pickup_point=JSON.parse(localStorage.getItem("pickup_point"));
var occupied_seat=JSON.parse(localStorage.getItem("occupied_seat"));
let selected_trip=100;
var estimated_distance=JSON.parse(localStorage.getItem("estimated_distance"));
var estimated_cost=JSON.parse(localStorage.getItem("estimated_cost"));
var estimated_time=JSON.parse(localStorage.getItem("estimated_time"));

var p_point=document.getElementById("p_point");
var a_seat=document.getElementById("a_seat");
var c_trip_id=document.getElementById("c_trip_id");
var c_trip_cost=document.getElementById("c_trip_cost");

function tripTablemaking() {

    if ($("#searchTable tbody").length == 0) {
        $("#searchTable").append("<tbody></tbody>");
    }
    if ($("#infoTable tbody").length == 0) {
        $("#infoTable").append("<tbody></tbody>");
    }
   var btn= document.createElement('button');
    btn.className="btn-details"
    btn.onclick=function(){detailpop()};
    btn.innerHTML="Details";
    
    if(trip_num==0 || trip_num==null){
       document.getElementById("error_msg").innerHTML="Sorry,There is no available trip. Try Again."
       document.getElementById("searchTable").style.display="none";
        setTimeout(() => {
            window.location.href="rider_trip.html";
        }, 500000);
    }else{

        $("#infoTable tbody").append("<tr>" +
        "<td data-label='Distance'>"+estimated_distance+"</td>" +
        "</tr>");

    for( var i=0;i<trip_num;i++){
        $("#searchTable tbody").append("<tr>" +
        "<td data-label='Name'>"+driver_name[i]+"</td>" +
        "<td data-label='Phone'>"+driver_phoneno[i]+"</td>" +
        "<td data-label='Type'>"+vehicle_type[i]+"</td>" +
        "<td data-label='Vehicle No'>"+vehicle_number[i]+"</td>" +
        "<td data-label='Time'>"+starting_time[i]+"</td>" +
        "<td data-label='Seat'>"+available_seat[i]+"</td>" +
        "<td data-label='Cost'>"+estimated_cost[i]+"</td>" +
        "<td> <button class='btn-details' onclick='selecttrip()'>Confirm</button></td>" +
        "</tr>");
    }
    }
};
tripTablemaking();





function selecttrip(){
    $.when( $('#searchTable').find('tr').click( function(){
        selected_trip= ($(this).index()) ;
        }) ).then(function() {
            p_point.value=pickup_point;
            a_seat.value=occupied_seat;
            c_trip_id.value=trip_id[selected_trip];
            c_trip_cost.value=parseFloat(estimated_cost[selected_trip])*parseInt(occupied_seat);
            document.getElementById("submit").click();
 });
}

    
