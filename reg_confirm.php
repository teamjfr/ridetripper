<?php  
 
 session_start();
 $server="localhost";
 $username="root";
 $pass="";
 $con=mysqli_connect($server,$username,$pass);

 $status = $statusMsg = ''; 
 if(isset($_POST["driver_up_submit"])){ 

      $status = 'error'; 
      $user_name=mysqli_real_escape_string($con,$_POST['user_name']);
      $emailid=mysqli_real_escape_string($con,$_POST['emailid']);
      $address=mysqli_real_escape_string($con,$_POST['address']);
      $phoneno=mysqli_real_escape_string($con,$_POST['phoneno']);
      $password=mysqli_real_escape_string($con,$_POST['password']);
      $driving_number=mysqli_real_escape_string($con,$_POST['driving_number']);
      $car_license_number=mysqli_real_escape_string($con,$_POST['car_license_number']);
      
      $imgContent=array(); 
      $fileName=array();
      $fileType=array();
      $image=array();
      $allowTypes = array('jpg','png','jpeg','gif'); 

      $fileName[0] = basename($_FILES["user_image"]["name"]); 
      $fileType[0] = pathinfo($fileName[0], PATHINFO_EXTENSION);
      $fileName[1] = basename($_FILES["car_image"]["name"]); 
      $fileType[1] = pathinfo($fileName[1], PATHINFO_EXTENSION);
      $fileName[2] = basename($_FILES["driving_image"]["name"]); 
      $fileType[2] = pathinfo($fileName[2], PATHINFO_EXTENSION);
      $fileName[3] = basename($_FILES["nid_image"]["name"]); 
      $fileType[3] = pathinfo($fileName[3], PATHINFO_EXTENSION);
      $fileName[4] = basename($_FILES["car_license_image"]["name"]); 
      $fileType[4] = pathinfo($fileName[4], PATHINFO_EXTENSION);

      $image[0] = $_FILES['user_image']['tmp_name']; 
      $imgContent[0] = addslashes(file_get_contents($image[0]));  
      $image[1] = $_FILES['car_image']['tmp_name']; 
      $imgContent[1] = addslashes(file_get_contents($image[1]));  
      $image[2] = $_FILES['driving_image']['tmp_name']; 
      $imgContent[2] = addslashes(file_get_contents($image[2]));  
      $image[3] = $_FILES['nid_image']['tmp_name']; 
      $imgContent[3] = addslashes(file_get_contents($image[3]));  
      $image[4] = $_FILES['car_license_image']['tmp_name']; 
      $imgContent[4] = addslashes(file_get_contents($image[4]));  
      $statusMsg="Done";
           
      $sql_query="INSERT INTO `ride`.`driver_table` (`emailid`,`name`,`phoneno`,`address`,`password`,`user_img`,`car_img`,`driving_img`,`driving_num`,`nid_img`,`car_lic_img`,`car_lic_num`) VALUES 
      ('$emailid','$user_name','$phoneno','$address','$password','$imgContent[0]','$imgContent[1]','$imgContent[2]','$driving_number','$imgContent[3]','$imgContent[4]','$car_license_number');";


      if($con->query($sql_query)==TRUE){
        $statusMsg="Success";
        $_SESSION['emailid']=$emailid;
        $_SESSION['as_a']='driver';
        $_SESSION['redirect']='regpage';

        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
          <script type='text/javascript'>
          
          document.addEventListener('DOMContentLoaded', function(event) {
            setTimeout(function(){
              swal({
                title: 'Registration Successful',
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
                title: 'Registration Failure',
                text: 'Due to Some Internal Problem',
                icon: 'error',
                }).then (function(){
                  window.location.href='driversign.html';
                });
            },1000);
          });
           </script>";
      }
}  

if(isset($_POST["rider_up_submit"])){ 

      $status = 'error'; 
    
      $user_name=mysqli_real_escape_string($con,$_POST['user_name']);
      $emailid=mysqli_real_escape_string($con,$_POST['emailid']);
      $address=mysqli_real_escape_string($con,$_POST['address']);
      $phoneno=mysqli_real_escape_string($con,$_POST['phoneno']);
      $password=mysqli_real_escape_string($con,$_POST['password']);
      $re_password=mysqli_real_escape_string($con,$_POST['re_password']);

      $fileName = basename($_FILES["user_image"]["name"]); 
      $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
      $image= $_FILES['user_image']['tmp_name']; 
      $imgContent = addslashes(file_get_contents($image));  
 
      
          $sql_query="INSERT INTO `ride`.`rider_table` (`emailid`,`name`,`phoneno`,`address`,`password`,`user_img`) VALUES 
          ('$emailid','$user_name','$phoneno','$address','$password','$imgContent');";

          if($con->query($sql_query)==TRUE){
            $_SESSION['emailid']=$emailid;
            $_SESSION['as_a']='rider';
            $_SESSION['redirect']='regpage';
            echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
            <script type='text/javascript'>
          
            document.addEventListener('DOMContentLoaded', function(event) {
            setTimeout(function(){
              swal({
                title: 'Registration Successful',
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
                title: 'Registration Failure',
                text: 'Due to Some Internal Problem',
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
  <header>
  <div class="container">
    <div class="inside_container">
      <div class="dot dot1"></div>
			<div class="dot dot2"></div>
			<div class="dot dot3"></div>
      </div>
      <h3>Please Wait.....</h3>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="src/sign.js"></script>
  </body>
</html>