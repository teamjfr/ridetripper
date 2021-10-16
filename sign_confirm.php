<?php  
 
    session_start();
    $server="localhost";
    $username="root";
    $password="";
    $con=mysqli_connect($server,$username,$password);
  
    if(isset($_POST["driver_in_submit"])){

      $emailid=mysqli_real_escape_string($con,$_POST['emailid']);
      $password=mysqli_real_escape_string($con,$_POST['password']);

      $sql_query="SELECT *FROM `ride`.`driver_table` WHERE `emailid`='$emailid';";
      $res=mysqli_query($con,$sql_query);

      if((mysqli_num_rows($res))>0){
        $row=mysqli_fetch_assoc($res);
        if($row['password']===$password){
          
          if(isset($_POST['remember'])){
          $_SESSION['emailid']=$row['emailid'];
          $_SESSION['as_a']='driver';
          $_SESSION['redirect']='loginpage';
          setcookie('emailid',$row['emailid'],time()+60*60*24*30);
          setcookie('as_a','driver',time()+60*60*24*30);
          }
          else{
            $_SESSION['emailid']=$row['emailid'];
            $_SESSION['as_a']='driver';
            $_SESSION['redirect']='loginpage';
          }
          echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
          <script type='text/javascript'>
          
          document.addEventListener('DOMContentLoaded', function(event) {
            setTimeout(function(){
              swal({
                title: 'Log In Succssful',
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
                title: 'Password Does not Match. Try Again',
                text: '',
                icon: 'error',
                }).then (function(){
                  window.location.href='driversign.html';
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
                title: 'Email Does Not Exit. Sign Up First to Access.',
                text: '',
                icon: 'error',
                }).then (function(){
                  window.location.href='driversign.html';
                });
            },1000);
          });
           </script>";
      }

    }

    if(isset($_POST["rider_in_submit"])){
      $emailid=mysqli_real_escape_string($con,$_POST['emailid']);
      $password=mysqli_real_escape_string($con,$_POST['password']);

      $sql_query="SELECT *FROM `ride`.`rider_table` WHERE `emailid`='$emailid' AND `password`='$password';";
      $res=mysqli_query($con,$sql_query);

      if((mysqli_num_rows($res))>0){
        $row=mysqli_fetch_assoc($res);
        if($row['password']===$password){
          if(isset($_POST['remember'])){
          $_SESSION['emailid']=$row['emailid'];
          $_SESSION['as_a']='rider';
          $_SESSION['redirect']='loginpage';
          setcookie('emailid',$row['emailid'],time()+60*60*24*30);
          setcookie('as_a','rider',time()+60*60*24*30);
          }else{
            $_SESSION['emailid']=$row['emailid'];
            $_SESSION['as_a']='rider';
            $_SESSION['redirect']='loginpage';
          }
          echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
          <script type='text/javascript'>
          
          document.addEventListener('DOMContentLoaded', function(event) {
            setTimeout(function(){
              swal({
                title: 'Log In Succssful',
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
                title: 'Password Does not Match. Try Again',
                text: '',
                icon: 'error',
                }).then (function(){
                  window.location.href='passengersign.html';
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
                title: 'Email Does Not Exit. Sign Up First to Access.',
                text: '',
                icon: 'error',
                }).then (function(){
                  window.location.href='passengersign.html';
                });
            },1000);
          });
           </script>";
     }
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
    <title>Driver Sign In/Up Form</title>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="src/sign.js"></script>
  </body>
</html>