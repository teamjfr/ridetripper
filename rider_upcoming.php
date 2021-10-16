<?php

session_start();
if(isset($_SESSION['emailid'])){
$server="localhost";
$username="root";
$password="";
$con=mysqli_connect($server,$username,$password);
mysqli_query($con,'SET CHARACTER SET utf8');
mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");

$emailid=$_SESSION['emailid'];
$current_date=date("Y-m-d");
$upcoming_trip_id=array();
$upcoming_trip_fare=array();
$upcoming_trip_occupied_seat=array();
$upcoming_trip_pickup_point=array();
$upcoming_trip_date=array();
$upcoming_trip_starting_time=array();
$upcoming_trip_ending_point=array();
$upcoming_trip_vehicle_number=array();
$upcoming_trip_type=array();
$upcoming_trip_driver_name=array();
$upcoming_trip_driver_phoneno=array();
$upcoming_trip_driver_image=array();

$upcoming_trip_num=0;


$sql_query=("SELECT `t`.`trip_id`,`t`.`trip_date`,`t`.`starting_time`,`t`.`ending_point`,`t`.`vehicle_type`,`t`.`vehicle_number`,`r`.`seats`,`r`.`pickup_point`,`r`.`fare` 
FROM `ride`.`trip_info` `t`,`ride`.`rider_trip` `r` WHERE `r`.`rider_emailid`='$emailid' AND `t`.`trip_id`=`r`.`trip_id` AND `t`.`trip_date`>='$current_date';");
$sql_result=mysqli_query($con,$sql_query);
$num=mysqli_num_rows($sql_result);
if($num>0){
while($row=mysqli_fetch_assoc($sql_result)){
  $upcoming_trip_id[$upcoming_trip_num]=$row['trip_id'];
  $upcoming_trip_occupied_seat[$upcoming_trip_num]=$row['seats'];
  $upcoming_trip_pickup_point[$upcoming_trip_num]=$row['pickup_point'];
  $upcoming_trip_date[$upcoming_trip_num]=$row['trip_date'];
  $upcoming_trip_starting_time[$upcoming_trip_num]=$row['starting_time'];
  $upcoming_trip_starting_time[$upcoming_trip_num]=date('h:i A',strtotime($upcoming_trip_starting_time[$upcoming_trip_num]));
  $upcoming_trip_ending_point[$upcoming_trip_num]=$row['ending_point'];
  $upcoming_trip_vehicle_number[$upcoming_trip_num]=$row['vehicle_number'];
  $upcoming_trip_type[$upcoming_trip_num]=$row['vehicle_type'];
  $upcoming_trip_fare[$upcoming_trip_num]=$row['fare'];
  $upcoming_trip_num++;
}


for($i=0;$i<$num;$i++){
    $sql_query=("SELECT  `name`,`phoneno`,`user_img` FROM `ride`.`driver_table` WHERE `emailid`=(SELECT `driver_emailid` FROM `ride`.`driver_trip` 
    WHERE `trip_id`='$upcoming_trip_id[$i]' );");
     $sql_result=mysqli_query($con,$sql_query);
     if(mysqli_num_rows($sql_result)>0){
     $row=mysqli_fetch_assoc($sql_result);
     $upcoming_trip_driver_name[$i]=$row['name'];
     $upcoming_trip_driver_phoneno[$i]=$row['phoneno'];
     $upcoming_trip_driver_image[$i]=base64_encode($row['user_img']);
     }
     else{
      echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
      
      document.addEventListener('DOMContentLoaded', function(event) {
        setTimeout(function(){
          swal({
            title: 'There are Some Internal Problem.Please Try Again',
            text: '',
            icon: 'error',
            }).then (function(){
              window.location.href='rider_new_trip.html';
            });
        },1000);
      });
       </script>";
     }
    }
  }else{
    $upcoming_trip_id[$upcoming_trip_num]=0;
  }

  }else{
    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    <script type='text/javascript'>
    
    document.addEventListener('DOMContentLoaded', function(event) {
      setTimeout(function(){
        swal({
          title: 'ERROR',
          text: 'You are not Logged In.Log In First',
          icon: 'error',
          }).then (function(){
            window.location.href='driver_rider.html';
          });
      },1000);
    });
     </script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Trip Info</title>
    <style>

      body{
      background-color: #004c66;
      }
    @Keyframes spin{
  	100%{
		transform: rotate(360deg);
	  }
    }
.inside_container{
	width: 40px;
	margin: 250px auto 70px;
}
.dot{
	width: 10px;
	height: 10px;	
	display: inline-block;
	border-radius: 50%;
	
}
.dot1{
	background-color: #1abc9c;
	animation: jump-up 0.6s 0.1s linear infinite;
}
.dot2{
	background-color: #ffd64a;
	animation: jump-up 0.6s 0.2s linear infinite;
}
.dot3{
	background-color: #e067af;
	animation: jump-up 0.6s 0.3s linear infinite;
}
@Keyframes jump-up{
	50%{
		transform: translate(0,15px);
	}
}

h3{
    margin-top: 0px;
    font-size: 3rem;
    font-weight: 600;
    margin-left: 30%;
}

@media(max-width: 900px){
 h3{
     font-size: 2rem;
 }
}
    </style>
    
</head>
<body>
<div class="container">
    <div class="inside_container">
      <div class="dot dot1"></div>
			<div class="dot dot2"></div>
			<div class="dot dot3"></div>
      </div>
        <h3>Please Wait.Collecting Data</h3>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>      
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-3.3.1.min.js"></script> 

  <script>
   const upcoming_trip_seat=<?php echo json_encode($upcoming_trip_occupied_seat); ?>;
   const upcoming_trip_id=<?php echo json_encode($upcoming_trip_id); ?>;
   const upcoming_trip_p_point=<?php echo json_encode($upcoming_trip_pickup_point); ?>;
   const upcoming_trip_date=<?php echo json_encode($upcoming_trip_date); ?>;
   const upcoming_trip_time=<?php echo json_encode($upcoming_trip_starting_time); ?>;
   const upcoming_trip_e_point=<?php echo json_encode($upcoming_trip_ending_point); ?>;
   const upcoming_trip_v_number=<?php echo json_encode($upcoming_trip_vehicle_number); ?>;
   const upcoming_trip_type=<?php echo json_encode($upcoming_trip_type); ?>;
   const upcoming_trip_d_name=<?php echo json_encode($upcoming_trip_driver_name); ?>;
   const upcoming_trip_d_phn=<?php echo json_encode($upcoming_trip_driver_phoneno); ?>;
   const upcoming_trip_d_img=<?php echo json_encode($upcoming_trip_driver_image);?>;
   const upcoming_trip_fare=<?php echo json_encode($upcoming_trip_fare);?>;
   const trip_num = <?php echo $num; ?>;

   $(document).ready(function () {
    window.setTimeout(function () {
        localStorage.setItem("uc_trip_id",JSON.stringify(upcoming_trip_id));
        localStorage.setItem("uc_fare",JSON.stringify(upcoming_trip_fare));
        localStorage.setItem("uc_seat",JSON.stringify(upcoming_trip_seat));
        localStorage.setItem("uc_p_point",JSON.stringify(upcoming_trip_p_point));
        localStorage.setItem("uc_date",JSON.stringify(upcoming_trip_date));
        localStorage.setItem("uc_time",JSON.stringify(upcoming_trip_time));
        localStorage.setItem("uc_e_point",JSON.stringify(upcoming_trip_e_point));
        localStorage.setItem("uc_v_no",JSON.stringify(upcoming_trip_v_number));
        localStorage.setItem("uc_type",JSON.stringify(upcoming_trip_type));
        localStorage.setItem("uc_d_name",JSON.stringify(upcoming_trip_d_name));
        localStorage.setItem("uc_d_phn",JSON.stringify(upcoming_trip_d_phn));
        localStorage.setItem("uc_d_img",JSON.stringify(upcoming_trip_d_img));
        localStorage.setItem("uc_t_num",JSON.stringify(trip_num));
        location.href = "rider_trip_info.html";
        
    }, 5000);
});
    </script>

</body>
</html>