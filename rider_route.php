<?php  
 
 session_start();
 $server="localhost";
 $username="root";
 $password="";
 $con=mysqli_connect($server,$username,$password);

 function getDistanceFromLatLonInKm($lat1, $lon1, $lat2, $lon2) { 
  $pi80 = M_PI / 180; 
  $lat1 *= $pi80; 
  $lon1 *= $pi80; 
  $lat2 *= $pi80; 
  $lon2 *= $pi80; 
  $r = 6372.797; 
  $dlat = $lat2 - $lat1; 
  $dlon = $lon2 - $lon1; 
  $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2); 
  $c = 2 * atan2(sqrt($a), sqrt(1 - $a)); 
  $km = $r * $c; 
  return $km; 
  }
     $starting_date=mysqli_real_escape_string($con,$_POST['starting_date']);
     $starting_date=date('Y-m-d',strtotime($starting_date));
     $starting_lat=mysqli_real_escape_string($con,$_POST['starting_lat']);
     $starting_lng=mysqli_real_escape_string($con,$_POST['starting_lng']);
     $ending_lat=mysqli_real_escape_string($con,$_POST['ending_lat']);
     $ending_lng=mysqli_real_escape_string($con,$_POST['ending_lng']);
     $number_of_seats=mysqli_real_escape_string($con,$_POST['number_of_seats']); 
     $emailid=$_SESSION['emailid'];
     $pickup_point=mysqli_real_escape_string($con,$_POST['pickup_point']);
     $sql_query="SELECT `trip_id`,`trip_date`,`starting_time`,`starting_lat`,`starting_lng`,`ending_lat`,`ending_lng`,`number_of_seat`,`vehicle_number`,`vehicle_type`,`cost_seat` FROM `ride`.`trip_info` WHERE
      (`ending_lat` BETWEEN $ending_lat  and $ending_lat+0.06 OR `ending_lng` BETWEEN $ending_lng AND $ending_lng+0.06) AND (`starting_lat` BETWEEN $starting_lat  and $starting_lat+0.06 OR `starting_lng` BETWEEN $starting_lng AND $starting_lng+0.06) AND`trip_date`='$starting_date' AND `number_of_seat`>='$number_of_seats' ";
     $sql_result=mysqli_query($con,$sql_query);
     $num=mysqli_num_rows($sql_result);
     
     $trip_id=array();
     $starting_time=array();
     $vehicle_number=array();
     $vehicle_type=array();
     $available_seat=array();
     $driver_name=array();
     $driver_phoneno=array();
     $cost=array();

     $trip_num=0;

    while($row=mysqli_fetch_assoc($sql_result)){
      $db_s_lat=floatval($row['starting_lat']);
      $db_s_lng=floatval($row['starting_lng']);
      $db_e_lat=floatval($row['ending_lat']);
      $db_e_lng=floatval($row['ending_lng']);

      $s_dist=getDistanceFromLatLonInKm($starting_lat,$starting_lng,$db_s_lat,$db_s_lng);
      $e_dist=getDistanceFromLatLonInKm($ending_lat,$ending_lng,$db_e_lat,$db_e_lng);
      
      if($s_dist<=1 && $e_dist<=2){
        $trip_id[$trip_num]=$row['trip_id'];
        $starting_time[$trip_num]=$row['starting_time'];
        $vehicle_number[$trip_num]=$row['vehicle_number'];
        $vehicle_type[$trip_num]=$row['vehicle_type'];
        $available_seat[$trip_num]=$row['number_of_seat'];
        $cost[$trip_num]=$row['cost_seat'];

        $sql_query1="select `name`,`phoneno` from `ride`.`driver_table` where `emailid`=(select `driver_emailid` from `ride`.`driver_trip` where `trip_id`='$trip_id[$trip_num]');";
        $sql_result1=mysqli_query($con,$sql_query1);
        while($row=mysqli_fetch_assoc($sql_result1)){
        $driver_name[$trip_num]=$row['name'];
        $driver_phoneno[$trip_num]=$row['phoneno']; 
        }
        $trip_num++;
      }
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

    <script>
      const s_lat1="<?php echo $starting_lat ?>",
      s_lng1="<?php echo $starting_lng ?>",
      e_lat1="<?php echo $ending_lat ?>",
      e_lng1="<?php echo $ending_lng ?>";
      const trip_id = <?php echo json_encode($trip_id); ?>;
      const starting_time = <?php echo json_encode($starting_time); ?>;
      const vehicle_number = <?php echo json_encode($vehicle_number); ?>;
      const vehicle_type = <?php echo json_encode($vehicle_type); ?>;
      const available_seat = <?php echo json_encode($available_seat); ?>;
      const driver_name = <?php echo json_encode($driver_name); ?>;
      const driver_phoneno = <?php echo json_encode($driver_phoneno); ?>;
      const pickup_point = <?php echo json_encode($pickup_point); ?>;
      const occupied_seat=<?php echo json_encode($number_of_seats); ?>;
      const cost=<?php echo json_encode($cost); ?>;
      const trip_num = <?php echo $trip_num; ?>;
    </script>

    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
      integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
      crossorigin="">
    <link rel="stylesheet" href="style/driver_route.css">

   </head>

<body> 
  <div class="container">
    <div class="inside_container">
      <div class="dot dot1"></div>
			<div class="dot dot2"></div>
			<div class="dot dot3"></div>
      </div>
      <h3>Searching.Please Wait</h3>
  </div>
  <div class="map-popup2">
      <div id="map1"></div>
    </div>
    <div class="map-popup3">
      <button  id="button-for-route-confirmation">Confirm</button>
      <button  id="button-for-cancellation">Cancel</button>
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

  
   <script type="module" src="src/rider_route.js"></script>

    
</body>
</html>