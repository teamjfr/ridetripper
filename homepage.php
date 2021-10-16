<?php
session_start();
if(isset($_COOKIE['emailid']) || isset($_SESSION['emailid'])){
    if(!isset($_SESSION['emailid'])){
        $_SESSION['emailid']=$_COOKIE['emailid'];
    }
    if(isset($_COOKIE['as_a']) || isset($_SESSION['as_a'])){
    if(!isset($_SESSION['as_a'])){
       $_SESSION['as_a']=$_COOKIE['as_a'];
    }
    if($_SESSION['as_a']==='rider'){
         header('location:rider_new_trip.html');
    }
    else if($_SESSION['as_a']==='driver'){
        header('location:driver_new_trip.html'); 
    }
}
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet"  href="style/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
</head>
<body>

    <header>
        <div class="inner-width">
            <span class="logo">Ridetripper</span>
            <i class="menu-toggle-btn fas fa-bars"></i>
            <div class="navigation_bar_class">
              <a href="./homepage.php"><i class="fas fa-home home"></i> Home</a>
              <a href="./driver_rider.html"><i class="fas fa-sign-in-alt login"></i> Login</a>
              <a href="./contact.php"><i class="fas fa-headset contact"></i> Contact</a>
          </div>
            
        </div>
      </header> 
    <div class="container">
        <img src="./image/background1.png">
        <div>
        <h3>RIDETRIPPER</h3>
        <h4>A Different Approach for Ride Sharing </h4>    
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="src/homepage.js"></script>
    
</body>
</html>