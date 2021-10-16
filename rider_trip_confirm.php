<?php  
 
 session_start();
 $server="localhost";
 $username="root";
 $password="";
 $con=mysqli_connect($server,$username,$password);
 
 mysqli_query($con,'SET CHARACTER SET utf8');
mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");
 

$p_p=mysqli_real_escape_string($con,$_POST['p_point']);
$a_s=mysqli_real_escape_string($con,$_POST['a_seat']);
$t_id=mysqli_real_escape_string($con,$_POST['c_trip_id']);
$c_c=mysqli_real_escape_string($con,$_POST['c_trip_cost']);

$emailid=$_SESSION['emailid'];
$sql_query1="SELECT * FROM `ride`.`rider_trip` WHERE `trip_id`='$t_id' and `rider_emailid`='$emailid';";
$result=mysqli_query($con,$sql_query1);
if( mysqli_num_rows($result) <= 0 ){
$sql_query="INSERT INTO `ride`.`rider_trip` (`trip_id`,`rider_emailid`,`seats`,`pickup_point`,`fare`) VALUES('$t_id','$emailid','$a_s','$p_p','$c_c');";
if($con->query($sql_query)==true){
 
}
else{
  echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
  <script type='text/javascript'>
          
  document.addEventListener('DOMContentLoaded', function(event) {
  setTimeout(function(){
  swal({
  title: 'Can Not Confirm Trip Due to Some Internal Problem.',
  text: '',
  icon: 'error',
  }).then (function(){
    window.location.href='rider_trip.html';
  });
  },1000);
  });
  </script>";
}

}
else{
  $sql_query="UPDATE `ride`.`rider_trip` SET `seats` = `seats`+'$a_s',`fare`=`fare`+'$c_c' WHERE `trip_id` = '$t_id' and `rider_emailid`='$emailid';";
  if($con->query($sql_query)==true){
  }
  else{
    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    <script type='text/javascript'>
            
    document.addEventListener('DOMContentLoaded', function(event) {
    setTimeout(function(){
    swal({
    title: 'Could Not Confirm Trip Due to Some Internal Problem.',
    text: '',
    icon: 'error',
    }).then (function(){
    window.location.href='rider_trip.html';
    });
    },1000);
    });
    </script>";
  }
}
$sql_query="UPDATE `ride`.`trip_info` SET `number_of_seat` = `number_of_seat` - '$a_s' WHERE `trip_id` = '$t_id';";
       if($con->query($sql_query)==true){
        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
  <script type='text/javascript'>
          
  document.addEventListener('DOMContentLoaded', function(event) {
  setTimeout(function(){
  swal({
  title: 'Trip Confirmed',
  text: '',
  icon: 'success',
  }).then (function(){
  window.location.href='rider_new_trip.html';
  });
  },3000);
  });
  </script>";
       }
       else{
        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
  <script type='text/javascript'>
          
  document.addEventListener('DOMContentLoaded', function(event) {
  setTimeout(function(){
  swal({
  title: 'Could Not Confirm Trip Due to Some Internal Problem.',
  text: '',
  icon: 'error',
  }).then (function(){
  window.location.href='rider_trip.html';
  });
  },1000);
  });
  </script>";
       }
     

 ?>
 
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Driver Trip Form</title>
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script 
      src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>

    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
      integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
      crossorigin="">
    <link rel="stylesheet" href="style/loading.css">
   </head>
<body> 
     <div class="container">
      <div class="inside_container">
      <div class="dot dot1"></div>
			<div class="dot dot2"></div>
			<div class="dot dot3"></div>
      </div>
      <h3>Please Wait....</h3>
     </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>      
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" data-auto-replace-svg="nest"></script>

    <script src="https://unpkg.com/esri-leaflet@2.5.0/dist/esri-leaflet.js"
    integrity="sha512-ucw7Grpc+iEQZa711gcjgMBnmd9qju1CICsRaryvX7HJklK0pGl/prxKvtHwpgm5ZHdvAil7YPxI1oWPOWK3UQ=="
    crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
    integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
    crossorigin=""></script>

  
   <script>

  $(".menu-toggle-btn").click(function(){
    $(".navigation_bar_class").toggleClass("active");
  });

  </script>
    
</body>
</html>


