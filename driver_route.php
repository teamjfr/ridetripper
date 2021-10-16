<?php  

session_start();
 $server="localhost";
 $username="root";
 $password="";
 $con=mysqli_connect($server,$username,$password);
 
     $starting_point=mysqli_real_escape_string($con,$_POST['starting_point']);
     $ending_point=mysqli_real_escape_string($con,$_POST['ending_point']);
     $starting_time=mysqli_real_escape_string($con,$_POST['starting_time']);
     $starting_time=date('H:i:s',strtotime($starting_time));
     $starting_date=mysqli_real_escape_string($con,$_POST['starting_date']);
     $starting_date=date('Y-m-d',strtotime($starting_date));
     $vehicle_type=mysqli_real_escape_string($con,$_POST['vehicle_type']);
     $vehicle_nuumber=mysqli_real_escape_string($con,$_POST['vehicle_number']);
     $starting_lat=mysqli_real_escape_string($con,$_POST['starting_lat']);
     $starting_lng=mysqli_real_escape_string($con,$_POST['starting_lng']);
     $ending_lat=mysqli_real_escape_string($con,$_POST['ending_lat']);
     $ending_lng=mysqli_real_escape_string($con,$_POST['ending_lng']);
     $number_of_seats=mysqli_real_escape_string($con,$_POST['number_of_seats']);

     $_SESSION['s_point']=$starting_point;
     $_SESSION['e_point']=$ending_point;
     $_SESSION['s_time']=$starting_time;
     $_SESSION['s_date']=$starting_date;
     $_SESSION['v_type']=$vehicle_type;
     $_SESSION['v_num']=$vehicle_nuumber;
     $_SESSION['s_lat']=$starting_lat;
     $_SESSION['s_lng']=$starting_lng;
     $_SESSION['e_lat']=$ending_lat;
     $_SESSION['e_lng']=$ending_lng;
     $_SESSION['n_seat']=$number_of_seats;
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
      const s_lat="<?php echo $starting_lat ?>",
      s_lng="<?php echo $starting_lng ?>",
      e_lat="<?php echo $ending_lat ?>",
      e_lng="<?php echo $ending_lng ?>";
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
        <h3>Confirming.Please Wait</h3>
  </div>
  <div class="map-popup2">
      <div id="map1"></div>
    </div>
    <div class="map-popup3">
      <button id="button-for-route-confirmation">Confirm</button>
      <button  id="button-for-cancellation">Cancel</button>
    </div>

    <form action="driver_trip_confirm.php" method="POST">
      <input type="hidden" name="distance" id="distance" required>
      <input type="submit" name="submit" id="submit"  required>
    </form>

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

    <script src="src/driver_route.js"></script>
</body>
</html>
