var uc_trip_id=JSON.parse(localStorage.getItem("uc_trip_id"));
var uc_seat=JSON.parse(localStorage.getItem("uc_seat"));
var uc_fare=JSON.parse(localStorage.getItem("uc_fare"));
var uc_p_point=JSON.parse(localStorage.getItem("uc_p_point"));
var uc_date=JSON.parse(localStorage.getItem("uc_date"));
var uc_time=JSON.parse(localStorage.getItem("uc_time"));
var uc_e_point=JSON.parse(localStorage.getItem("uc_e_point"));
var uc_v_no=JSON.parse(localStorage.getItem("uc_v_no"));
var uc_type=JSON.parse(localStorage.getItem("uc_type"));
var uc_d_name=JSON.parse(localStorage.getItem("uc_d_name"));
var uc_d_phn=JSON.parse(localStorage.getItem("uc_d_phn"));
var uc_d_img=JSON.parse(localStorage.getItem("uc_d_img"));
var uc_trip_num=JSON.parse(localStorage.getItem("uc_t_num"));

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

    for(i=0;i<uc_trip_num;i++){
      $("#myTable tbody").append("<tr>" +
      "<td data-label='Date'>"+uc_date[i]+"</td>" +
      "<td data-label='Time'>"+uc_time[i]+"</td>" +
      "<td data-label='To'>"+uc_p_point[i]+"</td>" +
      "<td data-label='From'>"+uc_e_point[i]+"</td>" +
      "<td data-label='Number Of Seat'>"+uc_seat[i]+"</td>" +
      "<td data-label='Fare'>"+uc_fare[i]+"</td>" +
      "<td data-label='Type'>"+uc_type[i]+"</td>" +
      "<td> <button class='btn-details' onclick='detailpop()'>Details</button></td>" +
      "<td> <button class='btn-details' onclick='cancelTrip()'>Cancel</button></td>" +
      "</tr>");
    }       
};
if(uc_trip_id[0]==0){
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
    $("#myTable1 tbody").append("<tr>" +
        "<td data-label='Image'> <img src='data:image/jpg;charset=utf8;base64,"+uc_d_img[clicktrip]+"'> </td>" +
        "<td data-label='Name'>"+uc_d_name[clicktrip]+"</td>" +
        "<td data-label='Contact No'>"+uc_d_phn[clicktrip]+"</td>" +
        "<td data-label='Vechicle No'>"+uc_v_no[clicktrip]+"</td>" +
        "</tr>");
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
            document.getElementById("trip_id").value=uc_trip_id[selected_trip];
            document.getElementById("trip_fare").value=uc_seat[selected_trip];
            document.getElementById("submit").click();
          } 
        });
});
};

  $(".menu-toggle-btn").click(function(){
    $(".navigation_bar_class").toggleClass("active");
  });