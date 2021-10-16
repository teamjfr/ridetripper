var d_uc_trip_id=JSON.parse(localStorage.getItem("d_uc_trip_id"));
var d_uc_seat=JSON.parse(localStorage.getItem("d_uc_seat"));
var d_uc_p_point=JSON.parse(localStorage.getItem("d_uc_p_point"));
var d_uc_date=JSON.parse(localStorage.getItem("d_uc_date"));
var d_uc_time=JSON.parse(localStorage.getItem("d_uc_time"));
var d_uc_e_point=JSON.parse(localStorage.getItem("d_uc_e_point"));
var d_uc_s_point=JSON.parse(localStorage.getItem("d_uc_s_point"));
var d_uc_r_name=JSON.parse(localStorage.getItem("d_uc_r_name"));
var d_uc_r_phn=JSON.parse(localStorage.getItem("d_uc_r_phn"));
var d_uc_trip_num=JSON.parse(localStorage.getItem("d_uc_t_num"));
var d_uc_fare=JSON.parse(localStorage.getItem("d_uc_fare"));

var popup= document.querySelector('.popup'),
close=popup.querySelector('.close');

  function tripTablemaking() {
    if ($("#myTable tbody").length == 0) {
        $("#myTable").append("<tbody></tbody>");
    }
   var btn= document.createElement('button');
    btn.className="btn-details"
    btn.onclick=function(){detailpop()};
    btn.innerHTML="Details";

    for(i=0;i<d_uc_trip_num;i++){
      $("#myTable tbody").append("<tr>" +
      "<td data-label='Date'>"+d_uc_date[i]+"</td>" +
      "<td data-label='Time'>"+d_uc_time[i]+"</td>" +
      "<td data-label='To'>"+d_uc_s_point[i]+"</td>" +
      "<td data-label='From'>"+d_uc_e_point[i]+"</td>" +
      "<td> <button class='btn-details' onclick='detailpop()'>Details</button></td>" +
      "<td> <button class='btn-details' onclick='cancelTrip()'>Cancel</button></td>" +
      "</tr>");
    }
};

if(d_uc_trip_num<=0){  
document.getElementById("myTable").style.display="none";
document.getElementById("error_msg").innerHTML="There is no Upcoming Trip."
}else{
tripTablemaking();
}


function passengerTablemaking(clicktrip) {

    $("#myTable1").find("tr:not(:first)").remove();
    if ($("#myTable1 tbody").length == 0) {
        $("#myTable1").append("<tbody></tbody>");
    }

    trip_id=d_uc_trip_id[clicktrip];
    length=d_uc_r_name[trip_id].length;
   for(i=0;i<length;i++){
    $("#myTable1 tbody").append("<tr>" +
        "<td data-label='Name'>"+d_uc_r_name[trip_id][i]+"</td>" +
        "<td data-label='Contact No'>"+d_uc_r_phn[trip_id][i]+"</td>" +
        "<td data-label='Pickup Point'>"+d_uc_p_point[trip_id][i]+"</td>" +
        "<td data-label='Number of Seat'>"+d_uc_seat[trip_id][i]+"</td>" +
        "<td data-label='Fare'>"+d_uc_fare[trip_id][i]+"</td>" +
        "</tr>");
   }
    
};



close.onclick=()=>{
  popup.classList.toggle('show');
};
function detailpop(){
  $.when( $('#myTable').find('tr').click( function(){
      selected_trip= ($(this).index()) ;
      }) ).then(function() {
        passengerTablemaking(selected_trip);
        popup.classList.toggle('show');
        
});
};
function cancelTrip(){
  $.when( $('#myTable').find('tr').click( function(){
      selected_trip= ($(this).index()) ;
      }) ).then(function() {
        swal({
          title: "Are you sure?",
          text: "Once deleted, You won't be able to revert this!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Your Trip is Cancelled!", {
              icon: "success",
            });
            document.getElementById("trip_id").value=d_uc_trip_id[selected_trip];
            document.getElementById("submit").click();
          } 
        });
});
};


  $(".menu-toggle-btn").click(function(){
    $(".navigation_bar_class").toggleClass("active");
  });