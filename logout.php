<?php
session_start();

if(isset($_COOKIE['as_a']) && isset($_COOKIE['emailid'])){
setcookie("emailid","", time() - 3600);
setcookie("as_a","", time() - 3600);
}
unset($_SESSION['emailid']);
unset($_SESSION['as_a']);
unset($_SESSION['redirect']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
    <link rel="stylesheet"  href="style/loading.css">
    <style type="text/css">
    </style>

<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    <script type='text/javascript'>           
                     window.history.forward();         
          document.addEventListener('DOMContentLoaded', function(event) {
            setTimeout(function(){
              swal({
                title: "You Are Logged Out",
                text: "",
                icon: "success",
                }).then (function() {

                    window.location.href='homepage.php';
                  
                });
            },2000);
          });
    </script>
</head>
<body>
  <div class="container">
    <div class="inside_container">
      <div class="dot dot1"></div>
			<div class="dot dot2"></div>
			<div class="dot dot3"></div>
      </div>
      <h3>Signing Out.....</h3>
  </div>
 
</body>
</html>
