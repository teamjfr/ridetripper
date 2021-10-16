<?php
session_start();
$server="localhost";
$username="root";
$password="";
$con=mysqli_connect($server,$username,$password);

if(isset($_SESSION['as_a'])){
  $emailid=$_SESSION['emailid'];
if($_SESSION['as_a']==='rider'){
     $sql_query=("SELECT  `name`,`phoneno`,`address`,`user_img` FROM `ride`.`rider_table` WHERE `emailid`='$emailid';");
     $sql_result=mysqli_query($con,$sql_query);
     if(mysqli_num_rows($sql_result) == 0){
      echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
      document.addEventListener('DOMContentLoaded', function(event) {
        swal({
        title: 'ERROR',
        text: 'There are some Internal Problem',
        icon: 'error',
        }).then (function(){
        window.location.href='rider_new_trip.html';
        });
      });
      </script>";
     }else{
     $row=mysqli_fetch_assoc($sql_result);
     $user_name=$row['name'];
     $user_phoneno=$row['phoneno'];
     $user_address=$row['address'];
     $user_image=base64_encode($row['user_img']);
     }
}
else if($_SESSION['as_a']==='driver'){
     $sql_query=("SELECT  `name`,`phoneno`,`address`,`user_img` FROM `ride`.`driver_table` WHERE `emailid`='$emailid';");
     $sql_result=mysqli_query($con,$sql_query);
     if(mysqli_num_rows($sql_result) == 0){
      echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
      document.addEventListener('DOMContentLoaded', function(event) {
        swal({
        title: 'ERROR',
        text: 'There are some Internal Problem',
        icon: 'error',
        }).then (function(){
        window.location.href='driver_new_trip.html';
        });
      });
      </script>";
     }else{
     $row=mysqli_fetch_assoc($sql_result);
     $user_name=$row['name'];
     $user_phoneno=$row['phoneno'];
     $user_address=$row['address'];
     $user_image=base64_encode($row['user_img']);
     }
}
}
else{
  echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
  <script type='text/javascript'>
  document.addEventListener('DOMContentLoaded', function(event) {
    swal({
    title: 'ERROR',
    text: 'You are not Logged In.Log In First',
    icon: 'error',
  }).then (function(){
    window.location.href='driver_rider.html';
  });
});
  
  </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CSS User Profile Card</title>
	<link rel="stylesheet" href="style/user_profile.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
<header>
        <div class="inner-width">
            <span class="logo">Ridetripper</span>
          <i class="menu-toggle-btn fas fa-bars"></i>
          <div class="navigation_bar_class">
            <a href="./homepage.php"><i class="fas fa-home home"></i> Home</a>
            <a href=""><i class="fas fa-user user"></i> Profile</a>
            <a id="up_link" href=""><i class="fas fa-car car"></i> Upcoming Trip</a>
            <a href="./logout.php"><i class="fas fa-sign-out-alt logout"></i> Log Out</a>
            <a href="./contact.php"><i class="fas fa-headset contact"></i> Contact</a>
          </div>
            
        </div>
      </header> 
<div class="wrapper">
    <div class="left">
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['user_img']);?>" 
        alt="user" id="user_image" width="100">
        <h4 id="user_name"></h4>
    </div>
    <div class="right">
        <div class="info">
            <h3>Information</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Email</h4>
                    <p id="user_emailid"></p>
                 </div>
                 <div class="data">
                   <h4>Phone</h4>
                    <p id="user_phoneno"></p>
              </div>
            </div>
        </div>
      
      <div class="projects">
            <div class="projects_data">
                 <div class="data">
                    <h4>Address</h4>
                    <p id="user_address"></p>
                 </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
<script>
const user_img=<?php echo json_encode($user_image);?>;
const user_name=<?php echo json_encode($user_name);?>;
const user_phoneno=<?php echo json_encode($user_phoneno);?>;
const user_address=<?php echo json_encode($user_address);?>;
const user_emailid=<?php echo json_encode($emailid);?>;

document.getElementById("user_name").innerHTML=user_name;
document.getElementById("user_emailid").innerHTML=user_emailid;
document.getElementById("user_phoneno").innerHTML=user_phoneno;
document.getElementById("user_address").innerHTML=user_address;

var a=document.getElementById("up_link");
    if(<?php echo isset($_SESSION['as_a']) ?>){
      var as_a='<?php echo $_SESSION['as_a'];?>';
      console.log(as_a);
      if(as_a==='rider'){
    a.addEventListener('click',()=> {
      a.setAttribute("href", "rider_upcoming.php");
    });
    }
    else{
      a.addEventListener('click',()=> {
      a.setAttribute("href", "driver_upcoming.php");
    });
    }
    

    }else{
      console.log("AAAA");
      alert("You are not logged in.Log in first");
      window.location.href="driver_sign.html";
    }
    
$(".menu-toggle-btn").click(function(){
  $(".navigation_bar_class").toggleClass("active");
});
</script>
</body>
</html>