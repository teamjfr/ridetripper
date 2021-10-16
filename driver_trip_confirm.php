<?php
session_start();
   $server="localhost";
   $username="root";
   $password="";
   $con=mysqli_connect($server,$username,$password);

   mysqli_query($con,'SET CHARACTER SET utf8');
mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");

$starting_point=$_SESSION['s_point'];
$ending_point=$_SESSION['e_point'];
$starting_time=$_SESSION['s_time'];
$starting_date=$_SESSION['s_date'];
$vehicle_type=$_SESSION['v_type'];
$vehicle_nuumber=$_SESSION['v_num'];
$starting_lat=$_SESSION['s_lat'];
$starting_lng=$_SESSION['s_lng'];
$ending_lat=$_SESSION['e_lat'];
$ending_lng=$_SESSION['e_lng'];
$number_of_seats=$_SESSION['n_seat'];
$cost=100;
$distance=mysqli_real_escape_string($con,$_POST['distance']);

$distance=floatval($distance);

if($distance<=20){
  if($vehicle_type=='Car'){
    $cost=$distance*42;
  }else if($vehicle_type=='Bike'){
    $cost=$distance*16;
  }else if($vehicle_type=='Micro-car'){
    $cost=$distance*60;
  }else if($vehicle_type=='Mini-bus'){
    $cost=$distance*75;
  }
}
else{
  if($vehicle_type=="Car"){
    $cost=$distance*36;
  }else if($vehicle_type=="Bike"){
    $cost=$distance*16;
  }else if($vehicle_type=='Micro-car'){
    $cost=$distance*45;
  }else if($vehicle_type=='Mini-bus'){
    $cost=$distance*68;
  }
}

$number_of_seats=intval($number_of_seats);
$cost=$cost/$number_of_seats;
$cost=round($cost);
$emailid=$_SESSION['emailid'];

unset($_SESSION['s_point']);
unset($_SESSION['e_point']);
unset($_SESSION['s_time']);
unset($_SESSION['s_date']);
unset($_SESSION['v_type']);
unset($_SESSION['v_num']);
unset($_SESSION['s_lat']);
unset($_SESSION['s_lng']);
unset($_SESSION['e_lat']);
unset($_SESSION['e_lng']);
unset($_SESSION['n_seat']);

$sql_query="INSERT INTO `ride`.`trip_info` (`trip_date`,`starting_point`,`ending_point`,`starting_time`,`starting_lat`,`starting_lng`,`ending_lat`,`ending_lng`,`number_of_seat`,`vehicle_number`,`vehicle_type`,`cost_seat`) 
VALUES('$starting_date','$starting_point','$ending_point','$starting_time','$starting_lat','$starting_lng','$ending_lat','$ending_lng','$number_of_seats','$vehicle_nuumber','$vehicle_type','$cost') ;";
if($con->query($sql_query)==true){
  $last_id=$con->insert_id;
  $sql_query="INSERT INTO `ride`.`driver_trip`(`trip_id`,`driver_emailid`) VALUES('$last_id','$emailid');";
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
             window.location.href='driver_new_trip.html';
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
             window.location.href='driver_trip.html;
          });
      },1000);
    });
     </script>";
  }
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
             window.location.href='driver_trip.html;
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script 
    src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous">
    </script>
    <link rel="shortcut icon" href="img/icon.svg" type="image/x-icon">
    <title>Trip Confirm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    
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
  </body>
</html>