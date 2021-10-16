<?php
session_start();

$server="localhost";
$username="root";
$password="";
$con=mysqli_connect($server,$username,$password);

$emailid=$_SESSION['emailid'];
$t_id=mysqli_real_escape_string($con,$_POST['trip_id']);
$t_fare=mysqli_real_escape_string($con,$_POST['trip_fare']);



if($_SESSION['as_a']=='rider'){
$sql_query="DELETE FROM `ride`.`rider_trip` WHERE `trip_id`='$t_id' and `rider_emailid`='$emailid';";
       if($con->query($sql_query)==true){
              
       }
       else{
              echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
              <script type='text/javascript'>
                      
              document.addEventListener('DOMContentLoaded', function(event) {
              setTimeout(function(){
              swal({
              title: 'Could Not Cancel Trip Due to Some Internal Problem.',
              text: '',
              icon: 'error',
              }).then (function(){
              window.location.href='rider_upcoming.php';
              });
              },1000);
              });
              </script>";
       }
$sql_query="UPDATE `ride`.`trip_info` SET `number_of_seat`=`number_of_seat`+'$t_fare' WHERE `trip_id`='$t_id';";
       if($con->query($sql_query)==true){
              echo "<script type='text/javascript'>
              window.location.href='rider_upcoming.php';
              </script>";
       }
       else{
              echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
              <script type='text/javascript'>
                      
              document.addEventListener('DOMContentLoaded', function(event) {
              setTimeout(function(){
              swal({
              title: 'Could Not Cancel Trip Due to Some Internal Problem.',
              text: '',
              icon: 'error',
              }).then (function(){
              window.location.href='rider_upcoming.php';
              });
              },1000);
              });
              </script>";
       }

}
else if($_SESSION['as_a']=='driver'){
    $sql_query="DELETE FROM `ride`.`rider_trip` WHERE `trip_id`='$t_id';";
       if($con->query($sql_query)==true){
        
       }
       else{
              echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
              <script type='text/javascript'>
                      
              document.addEventListener('DOMContentLoaded', function(event) {
              setTimeout(function(){
              swal({
              title: 'Could Not Cancel Trip Due to Some Internal Problem.',
              text: '',
              icon: 'error',
              }).then (function(){
              window.location.href='driver_upcoming.php';
              });
              },1000);
              });
              </script>";
       }
    $sql_query="DELETE FROM `ride`.`driver_trip` WHERE `trip_id`='$t_id';";
       if($con->query($sql_query)==true){
        
       }
       else{
              echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
              <script type='text/javascript'>
                      
              document.addEventListener('DOMContentLoaded', function(event) {
              setTimeout(function(){
              swal({
              title: 'Could Not Cancel Trip Due to Some Internal Problem.',
              text: '',
              icon: 'error',
              }).then (function(){
              window.location.href='driver_upcoming.php';
              });
              },1000);
              });
              </script>";
       }
$sql_query="DELETE FROM `ride`.`trip_info` WHERE `trip_id`='$t_id';";
       if($con->query($sql_query)==true){
              echo "<script type='text/javascript'>
              window.location.href='driver_upcoming.php';
              </script>";
       }
       else{
              echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
              <script type='text/javascript'>
                      
              document.addEventListener('DOMContentLoaded', function(event) {
              setTimeout(function(){
              swal({
              title: 'Could Not Cancel Trip Due to Some Internal Problem.',
              text: '',
              icon: 'error',
              }).then (function(){
              window.location.href='driver_upcoming.php';
              });
              },1000);
              });
              </script>";
       }
}

?>